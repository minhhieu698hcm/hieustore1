<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\ChatMessage;
use App\Models\ChatSession;

class ChatController extends Controller
{
    // Lưu thông tin khách hàng và tạo session
    public function createSession(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'customer_email' => 'nullable|email',
            'customer_message' => 'nullable|string',
            'customer_avatar' => 'nullable|string', // URL avatar
        ]);

        $chatSessionId = 'sess_' . \Illuminate\Support\Str::random(32);
        
        // Lưu session vào DB
        $session = ChatSession::create([
            'session_id' => $chatSessionId,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'customer_message' => $request->customer_message,
            'customer_avatar' => $request->customer_avatar,
            'total_messages' => 0,
            'unread_count' => 0,
            'unread_for_customer' => 0,
            'is_customer_online' => true,
            'last_customer_activity' => now(),
        ]);

        // Lưu session vào localStorage via JS
        session()->put('chat_session_id', $chatSessionId);

        return response()->json(['status' => 'success', 'chat_session_id' => $chatSessionId]);
    }

    // Send a chat message from customer (or guest)
    public function send(Request $request)
{
    $request->validate([
        'chat_session_id' => 'required|string',
        'message' => 'nullable|string',
        'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:5120', // max 5MB
    ]);

    $chatSessionId = $request->chat_session_id;

    // Kiểm tra session tồn tại
    $session = ChatSession::where('session_id', $chatSessionId)->first();
    if (!$session) {
        return response()->json(['status' => 'error', 'message' => 'Session not found'], 404);
    }

    $customerId = Auth::check() ? Auth::id() : null;
    $fileName = null;

    // Nếu có file, lưu vào public/chat/images và chỉ lấy tên file
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('chat/images'), $fileName);
    }

    // Nếu message rỗng và không có file thì trả về lỗi
    if (!$request->message && !$fileName) {
        return response()->json(['status' => 'error', 'message' => 'Tin nhắn trống'], 422);
    }

    // Lưu message
    $msg = ChatMessage::create([
        'chat_session_id' => $chatSessionId,
        'message' => $request->message ?? null,
        'file_path' => $fileName, // chỉ lưu tên file
        'customer_id' => $customerId,
        'admin_id' => null,
        'is_admin' => 0,
        'is_read' => 0,
    ]);

    // Update tổng tin nhắn và chưa đọc
    $session->increment('total_messages');
    $session->increment('unread_count');

    return response()->json(['status' => 'success', 'message' => $msg]);
}



    // Fetch messages for a session
    public function messages(Request $request)
{
    $request->validate([
        'chat_session_id' => 'required|string',
    ]);

    $sessionId = $request->chat_session_id;

    $session = ChatSession::where('session_id', $sessionId)->first();
    if (!$session) {
        return response()->json(['status' => 'error', 'message' => 'Session not found'], 404);
    }

    $messages = ChatMessage::where('chat_session_id', $sessionId)
        ->orderBy('created_at', 'asc')
        ->get()
        ->map(function ($m) use ($session) {
            return [
                'id' => $m->id,
                'message' => $m->message,
                'file_path' => $m->file_path,
                'is_admin' => $m->is_admin,

                // ✅ GỬI DATETIME FULL CHO JS
                'created_at' => $m->created_at->toDateTimeString(),

                // ✅ TÊN + AVATAR KHÁCH
                'customer_name'   => $session->customer_name,
                'customer_avatar' => $session->customer_avatar,

                'admin_id' => $m->admin_id,
            ];
        });

    return response()->json([
        'status' => 'success',
        'messages' => $messages,
    ]);
}


    // Update customer online status
public function updateStatus(Request $request)
{
    // ép kiểu boolean đúng
    $request->merge([
        'is_online' => filter_var($request->is_online, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
    ]);

    $request->validate([
        'chat_session_id' => 'required|string',
        'is_online' => 'required|boolean',
    ]);

    $session = ChatSession::where('session_id', $request->chat_session_id)->first();

    if (!$session) {
        return response()->json([
            'status' => 'error',
            'message' => 'Session not found'
        ], 404);
    }

    $session->update([
        'is_customer_online' => $request->is_online,
        'last_customer_activity' => now(),
    ]);

    return response()->json(['status' => 'success']);
}


    // Kiểm tra session còn hợp lệ không (có thể xem tin nhắn trong 2 ngày)
    public function checkSession(Request $request)
    {
        $request->validate([
            'chat_session_id' => 'required|string',
        ]);

        $sessionId = $request->chat_session_id;
        $session = ChatSession::where('session_id', $sessionId)->first();

        if (!$session) {
            return response()->json([
                'status' => 'error',
                'valid' => false,
                'message' => 'Session không tồn tại'
            ]);
        }

        // Kiểm tra xem session còn trong 2 ngày không
        $createdAt = $session->created_at;
        $twoDaysAgo = now()->subDays(2);
        
        if ($createdAt < $twoDaysAgo) {
            // Session đã quá 2 ngày - cần nhập lại hoặc tìm cũ
            return response()->json([
                'status' => 'success',
                'valid' => false,
                'expired' => true,
                'customer_name' => $session->customer_name,
                'customer_phone' => $session->customer_phone,
                'message' => 'Phiên chat đã hết hạn xem (quá 2 ngày). Vui lòng bắt đầu trò chuyện mới hoặc tìm kiếm tin nhắn cũ'
            ]);
        }

        // Kiểm tra nếu còn tin nhắn
        $messageCount = ChatMessage::where('chat_session_id', $sessionId)->count();

        // Session còn hợp lệ
        return response()->json([
            'status' => 'success',
            'valid' => true,
            'customer_name' => $session->customer_name,
            'customer_phone' => $session->customer_phone,
            'message_count' => $messageCount
        ]);
    }
    public function updatePresence(Request $request)
{
    $request->validate([
        'chat_session_id' => 'required|string',
        'status' => 'required|in:0,1,2', // 0 offline, 1 online, 2 away
    ]);

    $session = ChatSession::where('session_id', $request->chat_session_id)->first();

    if (!$session) {
        return response()->json(['status' => 'error', 'message' => 'Session not found'], 404);
    }

    $session->update([
        'is_customer_online' => (int) $request->status,
        'last_customer_activity' => now(),
    ]);

    return response()->json(['status' => 'success']);
}
public function markReadCustomer(Request $request)
{
    $request->validate([
        'chat_session_id' => 'required|string',
    ]);

    // Lấy session theo chat_session_id
    $session = ChatSession::where('session_id', $request->chat_session_id)->first();

    if (!$session) {
        return response()->json([
            'status' => 'error',
            'message' => 'Session not found'
        ], 404);
    }

    // Đánh dấu tất cả tin nhắn admin chưa đọc là đã đọc
    ChatMessage::where('chat_session_id', $session->session_id)
        ->where('is_admin', 1)
        ->where('is_read', 0)
        ->update(['is_read' => 1]);

    // Chỉ update nếu cần thiết để tránh query dư thừa
    if ($session->unread_for_customer > 0) {
        $session->unread_for_customer = 0;
        $session->save();
    }

    return response()->json(['status' => 'success']);
}


}
