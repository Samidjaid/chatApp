<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatGroups extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_details', 'file_id', 'user_id'
    ];

    public function file_id()
    {
        return $this->belongsTo(ChatFiles::class, 'file_id');
    }

    public function user_id()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
