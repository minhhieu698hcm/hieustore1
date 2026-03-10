<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ChatMessage;
use App\Models\ChatSession;
use Carbon\Carbon;

class CleanupOldChatMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:cleanup-old-messages';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Delete chat messages older than 7 days';

    /**
     * Execute the console command.
     */
    public function handle()
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

        $this->info('✅ Deleted ' . $deletedCount . ' old messages (older than 7 days)');
    }
}
