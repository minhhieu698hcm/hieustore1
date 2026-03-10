<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    use HasFactory;

    protected $table = 'chat_sessions';

    protected $fillable = [
        'session_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_message',
        'customer_avatar',
        'total_messages',
        'unread_count',
        'is_customer_online',
        'assigned_admin_id',
        'last_customer_activity',
    ];

    protected $casts = [
        'total_messages' => 'integer',
        'unread_count' => 'integer',
        'is_customer_online' => 'integer',
        'last_customer_activity' => 'datetime',
    ];

    // Relationship với Admin
    public function assignedAdmin()
    {
        return $this->belongsTo(Admin::class, 'assigned_admin_id', 'admin_id');
    }

    // Relationship với ChatMessages
    public function messages()
    {
        return $this->hasMany(ChatMessage::class, 'chat_session_id', 'session_id');
    }
}
