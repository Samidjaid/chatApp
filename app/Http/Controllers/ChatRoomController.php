<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class ChatRoomController extends Controller
{
    public function chatRoom()
    {
        $users = User::all();
        return view('home', compact('users'));
    }
}
