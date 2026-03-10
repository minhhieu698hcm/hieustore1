<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\ChatMessage;
use App\Models\ChatSession;
use App\Models\Admin;
use Illuminate\Support\Str;

class AdminChatController extends Controller
{
    // List distinct chat sessions with last message and unread counts
    public function index()
    {
        // Get all sessions
        $sessions = ChatSession::orderBy('updated_at', 'desc')
            ->get()
            ->map(function($session) {
                $messages = ChatMessage::where('chat_session_id', $session->session_id)
                    ->orderBy('created_at', 'desc')
                    ->get();
                
                $unread = $messages->where('is_admin', 0)->where('is_read', 0)->count();
                $last = $messages->first();
                // Lấy thông tin admin được gán
                $assignedAdmin = $session->assignedAdmin;
                
                return [
                    'chat_session_id' => $session->session_id,
                    'customer_name' => $session->customer_name,
                    'customer_phone' => $session->customer_phone,
                    'customer_email' => $session->customer_email,
                    'customer_avatar' => $session->customer_avatar,
                    'is_customer_online' => (bool) $session->is_customer_online,
                    'last_message' => $last ? $last->message : null,
                    'last_at' => $last ? $last->created_at : $session->created_at,
                   'unread' => $messages->where('is_admin', 0)->where('is_read', 0)->count(),
                    'total_messages' => $messages->count(),
                    'assigned_admin' => $assignedAdmin ? [
                    'admin_id' => $assignedAdmin->admin_id,
                    'admin_name' => $assignedAdmin->admin_name,
                    'admin_avt' => $assignedAdmin->admin_avt,
                    ] : null,
                ];
            })
            ->values()
            ->toArray();

        return view('admin.manage-chat')->with('sessions', $sessions);
    }

    // Fetch messages for a session (admin reading -> mark read)
   public function messages($sessionId)
{
    try {
        $session = ChatSession::where('session_id', $sessionId)
            ->orWhere('id', $sessionId)
            ->first();

        if (!$session) {
            return response()->json(['status' => 'error', 'message' => 'Session not found'], 404);
        }

        $currentAdmin = Auth::guard('admin')->user();

        // Đánh dấu tin nhắn từ khách đã đọc
        ChatMessage::where('chat_session_id', $session->session_id)
            ->where('is_admin', 0)
            ->update(['is_read' => 1]);

        // Reset unread_count
        $session->update(['unread_count' => 0]);

        // Lấy tất cả tin nhắn
        $messages = ChatMessage::where('chat_session_id', $session->session_id)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function($msg) {
                return [
                    'id' => $msg->id,
                    'message' => $msg->message,
                    'file_name' => $msg->file_name,
                    'file_path' => $msg->file_path,
                    'file_type' => $msg->file_type,
                    'file_url' => $msg->file_path ? asset('chat/images/' . $msg->file_path) : null,
                    'is_admin' => $msg->is_admin,
                    'created_at' => $msg->created_at,
                    'admin_info' => $msg->is_admin && $msg->admin_id ? [
                        'admin_id' => $msg->admin_id,
                        'admin_name' => optional(Admin::find($msg->admin_id))->admin_name,
                        'admin_avt' => optional(Admin::find($msg->admin_id))->admin_avt,
                    ] : null,
                ];
            });

        // Lấy danh sách tất cả hình ảnh trong session
        $images = ChatMessage::where('chat_session_id', $session->session_id)
            ->whereNotNull('file_path')
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function($img) {
                return [
                    'file_name' => $img->file_name,
                    'file_path' => $img->file_path,
                    'file_url' => asset('chat/images/' . $img->file_path),
                    'uploaded_by_admin' => $img->is_admin,
                    'created_at' => $img->created_at,
                ];
            });

        $allAdmins = Admin::select('admin_id','admin_name','admin_avt')->get();

        return response()->json([
            'status' => 'success',
            'messages' => $messages,
            'images' => $images,
            'message_count' => $messages->count(),
            'session' => [
                'customer_name' => $session->customer_name,
                'customer_avatar' => $session->customer_avatar,
                'is_customer_online' => $session->is_customer_online,
                'assigned_admin_id' => $session->assigned_admin_id,
            ],
            'admins' => $allAdmins,
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error loading messages: ' . $e->getMessage()
        ], 500);
    }
}



    // Admin reply
   public function reply(Request $request, $sessionId)
{
    try {
        $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        // Lấy session
        $session = ChatSession::where('session_id', $sessionId)
            ->orWhere('id', $sessionId)
            ->first();

        if (!$session) {
            return response()->json(['status' => 'error', 'message' => 'Session not found'], 404);
        }

        $admin = Auth::guard('admin')->user();
        if (!$admin) {
            return response()->json(['status' => 'error', 'message' => 'Not authenticated'], 401);
        }

        $adminId = $admin->admin_id ?? $admin->id;

        // Cập nhật assigned_admin_id kiểu "1,2"
        $existingAdmins = $session->assigned_admin_id 
            ? explode(',', $session->assigned_admin_id) 
            : [];
        if (!in_array($adminId, $existingAdmins)) {
            $existingAdmins[] = $adminId;
            $session->update([
                'assigned_admin_id' => implode(',', $existingAdmins),
            ]);
        }

        // Tạo message mới
        $msg = ChatMessage::create([
            'chat_session_id' => $session->session_id,
            'message' => $request->message,
            'customer_id' => null,
            'admin_id' => $adminId,
            'is_admin' => 1,
            'is_read' => $session->is_customer_online ? 1 : 0, // đọc ngay nếu khách online
        ]);

        // Cập nhật tổng tin nhắn
        $session->increment('total_messages');

        // Nếu khách offline → tăng số tin admin chưa đọc
        if (!$session->is_customer_online) {
            // Tăng trường mới: unread_for_customer
            $session->increment('unread_for_customer');
        }

        // Cập nhật thời gian cập nhật session
        $session->touch();

        return response()->json([
            'status' => 'success',
            'message' => 'Message sent',
            'data' => $msg
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Error sending message: ' . $e->getMessage()
        ], 500);
    }
}

public function sidebar()
{
    $sessions = ChatSession::orderBy('updated_at', 'desc')
        ->get()
        ->map(function($session) {

            $last = ChatMessage::where('chat_session_id', $session->session_id)
                ->orderBy('created_at', 'desc')
                ->first();

            return [
                'chat_session_id' => $session->session_id,
                'customer_name' => $session->customer_name, 

                // TEXT tin cuối
                'last_message' => $last?->message,

                // FILE tin cuối
                'last_file' => $last?->file_name,  // ✔ chỉ lưu tên file là đủ
                'last_file_path' => $last?->file_path, // ✔ JS dùng cái này để check

                // Thời gian tin cuối
                'last_at' => $last ? $last->created_at->format('H:i d/m/y') : '',

                // Trạng thái online
                'is_customer_online' => (bool) $session->is_customer_online,

                // Tin chưa đọc
                'unread' => ChatMessage::where('chat_session_id', $session->session_id)
                    ->where('is_admin', 0)
                    ->where('is_read', 0)
                    ->count(),
            ];
        })
        ->values();

    return response()->json([
        'status' => 'success',
        'sessions' => $sessions
    ]);
}

// AdminChatController.php
public function notifications()
{
    $admin = Auth::guard('admin')->user();
    if (!$admin) {
        return response()->json(['status'=>'error','message'=>'Unauthorized'], 401);
    }

    $sessions = ChatSession::orderBy('updated_at','desc')
        ->get()
        ->map(function($session){
            $messages = ChatMessage::where('chat_session_id', $session->session_id)
                ->where('is_admin', 0)
                ->where('is_read', 0)
                ->count();

            return [
                'chat_session_id' => $session->session_id,
                'unread' => $messages
            ];
        });

    return response()->json([
        'status' => 'success',
        'sessions' => $sessions
    ]);
}
public function sendImage(Request $request, $session)
{
    $request->validate([
        'image' => 'required|image|max:5120', // max 5MB
        'chat_session_id' => 'required|string',
    ]);

    $file = $request->file('image');

    if (!$file->isValid()) {
        return response()->json(['error' => 'File không hợp lệ'], 400);
    }

    // Lấy thông tin file trước khi move
    $fileType = $file->getClientMimeType();
    $fileSize = $file->getSize();
    $originalName = $file->getClientOriginalName();

    // Tạo tên file và thư mục nếu chưa tồn tại
    $filename = time() . '_' . $originalName;
    $storagePath = public_path('chat/images');
    if (!file_exists($storagePath)) {
        mkdir($storagePath, 0755, true);
    }

    // Move file vào thư mục public/chat/images
    $file->move($storagePath, $filename);

    // Chỉ lưu **tên file** vào DB
    \DB::table('chat_messages')->insert([
        'chat_session_id' => $request->chat_session_id,
        'message' => null,
        'file_path' => $filename, // chỉ lưu tên file
        'file_type' => $fileType,
        'file_name' => $originalName,
        'file_size' => $fileSize,
        'customer_id' => null,
        'admin_id' => \Auth::guard('admin')->id() ?? 1,
        'is_admin' => 1,
        'is_read' => 0,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Trả về JSON cho preview
    return response()->json([
        'success' => true,
        'file' => [
            'path' => asset('chat/images/' . $filename), // tạo đường dẫn đầy đủ khi trả về
            'name' => $originalName,
            'size' => $fileSize,
            'type' => $fileType
        ]
    ]);
}
public function markRead(Request $request)
{
    $request->validate([
        'chat_session_id' => 'required|string',
    ]);

    $session = ChatSession::where('session_id', $request->chat_session_id)->first();
    if (!$session) {
        return response()->json(['status' => 'error', 'message' => 'Session not found'], 404);
    }

    // Đánh dấu tất cả tin từ khách là admin đã đọc
    ChatMessage::where('chat_session_id', $session->session_id)
        ->where('is_admin', 0) // tin khách gửi
        ->where('is_read', 0)
        ->update(['is_read' => 1]);

    // Reset số tin chưa đọc cho admin
    $session->update(['unread_count' => 0]);

    return response()->json(['status' => 'success']);
}



}
