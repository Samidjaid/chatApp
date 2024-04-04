<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'message_details'
    ];

    public function user_id()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
