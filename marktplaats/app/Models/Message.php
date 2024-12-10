<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'subject',
        'message',
        'is_read',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');

    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');

    }

    public function scopePreviousMessages($query, $senderId, $receiverId)
{
    return $query->where(function ($query) use ($senderId, $receiverId) {
        $query->whereIn('sender_id', [$senderId, $receiverId])
              ->whereIn('receiver_id', [$senderId, $receiverId]);
    })->orderBy('created_at', 'desc');
}



}
