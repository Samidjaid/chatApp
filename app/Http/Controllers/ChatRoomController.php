<?php

namespace App\Http\Controllers;

use App\Models\ChatGroups;
use App\Models\ChatFiles;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChatRoomController extends Controller
{

 public function chatRoom(){
    if(Auth::check()){
        $userId = Auth::id();
       $messages = ChatGroups::with('file_id')->orderBy('created_at', 'desc')->get();
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
               $fileUrl = $file->storeAs('uploads', $fileName); 
                $extension = $file->getClientOriginalExtension() ?? '';
                
                
                $chatFile = ChatFiles::create([
                    'fileName' => $fileName,
                    'fileSize' => $file->getSize(),
                    'extension' => $extension,
                ]);
                
               if (!$chatFile) {
                    return redirect(route('home'))->with("error", "Upload failed");
                }
            }

            $data = [
                'user_id' => $userId,
                'message_details' => $request->message_details,
                'file_id' => $fileUrl ? $chatFile->id : null, 
            ];
    
            $chat = ChatGroups::create($data);
            if(!$chat){
                return redirect(route('home'))->with("error","Send message failed");
            }
    
            return redirect(route('home'));  
        }

        

    }
}
