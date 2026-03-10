<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\ChatMessage;
use App\Models\ChatSession;
use Carbon\Carbon;

class ChatCleanupController extends Controller
{
    // Tìm chat cũ bằng SĐT
    public function findByPhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);

        $phone = $request->phone;
        
        // Tìm session có SĐT này
        $session = ChatSession::where('customer_phone', $phone)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$session) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy cuộc trò chuyện với SĐT này'
            ], 404);
        }

        // Kiểm tra tin nhắn có còn không (nếu hết 7 ngày sẽ không có)
        $messageCount = ChatMessage::where('chat_session_id', $session->session_id)->count();

        return response()->json([
            'status' => 'success',
            'session_id' => $session->session_id,
            'customer_name' => $session->customer_name,
            'message_count' => $messageCount,
            'message' => $messageCount > 0 
                ? 'Tìm thấy cuộc trò chuyện với ' . $messageCount . ' tin nhắn'
                : 'Tin nhắn đã bị xóa sau 7 ngày'
        ]);
    }

    // Lấy danh sách chat cũ theo SĐT (để hiển thị danh sách)
    public function getRecentChats(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);

        $phone = $request->phone;
        
        // Tìm tất cả session với SĐT này
        $sessions = ChatSession::where('customer_phone', $phone)
            ->orderBy('created_at', 'desc')
            ->limit(20)  // Giới hạn 20 chat cũ nhất
            ->get();

        if ($sessions->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy cuộc trò chuyện',
                'chats' => []
            ]);
        }

        // Format lại dữ liệu cho frontend
        $chats = $sessions->map(function($session) {
            $messages = ChatMessage::where('chat_session_id', $session->session_id)
                ->orderBy('created_at', 'desc')
                ->get();
            
            $lastMessage = $messages->first();
            $messageCount = $messages->count();

            return [
                'id' => $session->session_id,
                'customer_name' => $session->customer_name ?: 'Khách hàng',
                'created_at' => $session->created_at->format('d/m/Y H:i'),
                'last_message' => $lastMessage ? $lastMessage->message : 'Không có tin nhắn',
                'message_count' => $messageCount,
                'unread_count' => 0  // Có thể mở rộng thêm tracking unread
            ];
        });

        return response()->json([
            'status' => 'success',
            'chats' => $chats->toArray()
        ]);
    }

    // Xóa tin nhắn cũ hơn 7 ngày (chạy daily via scheduler hoặc command)
    public function cleanupOldMessages()
    {
        $sevenDaysAgo = Carbon::now()->subDays(7);

        // Xóa tin nhắn cũ hơn 7 ngày
        $deletedCount = ChatMessage::where('created_at', '<', $sevenDaysAgo)
            ->delete();

        // Cập nhật count trong session
        ChatSession::all()->each(function($session) {
            $count = ChatMessage::where('chat_session_id', $session->session_id)->count();
            $session->update(['total_messages' => $count]);
        });

        Log::info('Chat cleanup: Deleted ' . $deletedCount . ' messages older than 7 days');

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted ' . $deletedCount . ' old messages'
        ]);
    }
}
