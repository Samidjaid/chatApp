<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatFiles extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = '_chat_file';

    protected $fillable = [
        'fileName', 'fileSize','extention'
    ];

}



