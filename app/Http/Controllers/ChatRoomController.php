<?php

namespace App\Http\Controllers;

use App\Models\ChatGroups;
use App\Models\ChatFile;
use App\Models\ChatFiles;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChatRoomController extends Controller
{

    public function file(){
        return $this->belongsTo(ChatFiles::class, 'file_id');
    }

 public function chatRoom(){
    if(Auth::check()){
        $userId = Auth::id();
        $messages = ChatGroups::orderBy('created_at', 'desc')->get();
       // $messages = ChatGroups::with('file')->orderBy('created_at', 'desc')->get();
        $users = User::all();
        return view('index', compact('userId', 'messages', 'users'));
        
    }
}

    function createMessage(Request $request){

        if(Auth::check()){
            $userId = Auth::id();

            $request -> validate([
                'message_details' => 'required_without:file',
                'file' => 'required_without:message_details|file|max:10240',
            ]);

            $fileUrl = null;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
               $fileUrl = $file->storeAs('uploads', $fileName); // Store the file in the 'uploads' directory
                $extension = $file->getClientOriginalExtension() ?? '';
                
                // Create record in the chat_file table
                $chatFile = ChatFiles::create([
                    'fileName' => $fileName,
                    'fileSize' => $file->getSize(),
                    'extension' => $extension,
                ]);
                
               if (!$chatFile) {
                    return redirect(route('home'))->with("error", "Upload failed");
                }
            }

            // Create message data
            $data = [
                'user_id' => $userId,
                'message_details' => $request->message_details,
                'file_id' => $fileUrl ? $chatFile->id : null, // Save file ID if a file is uploaded
            ];
    
            $chat = ChatGroups::create($data);
            if(!$chat){
                return redirect(route('home'))->with("error","Send message failed");
            }
    
            return redirect(route('home'));  
        }

        

    }
}
