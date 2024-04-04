<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename','filesize','extention','chat_id'
    ];

    public function chat_id()
    {
        return $this->belongsTo(ChatRoom::class, 'chat_id');
    }

}
