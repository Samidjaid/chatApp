@extends ('layouts')
@section('content')

<div class="app-container">
        <div class="userlist-card">
                @foreach($users as $user)
                    <div class="user-item">
                            <div class="avatar" style="overflow: hidden;height: 100px;width: 100px;position: relative;">
                                @if($user->avatar)
                                <img style="max-height: 100%;max-width: 100%; position: absolute;top: 0;left:0" src="{{ asset('storage/avatars/' . $user->avatar) }}" >
                                @else     
                                <img style="max-height: 100%;max-width: 100%; position: absolute;top: 0;left:0" src="{{ asset('storage/avatars/user.png') }}" >
                                @endif
                          </div>
                            <div class="username">{{ $user->firstname }}</div>
                            <div class="status-circle" style="background-color: {{ $user->user_status === 'online' ? 'green' : 'red' }}"></div>

                    </div>
                @endforeach
        </div>
        <div class="main-container">
             <div class="chat-handler">   
                @foreach($messages as $message)
                <div class="message-container">
                @if ($message->user_id === $userId)
                <div class="chat-message-outgoing">
                    <div class="outgoing-message">{{ $message->message_details }}</div>
                    @if ($message->file_id)
                    @php
                        $file = \App\Models\ChatFiles::find($message->file_id);
                    @endphp
                    @if ($file)
                    <a href="{{ Storage::url('uploads/' . $file->fileName) }}" download>{{ $file->fileName }}</a>
                    @endif
                     @endif
                </div>

          
                @else
                <div class="chat-message-incoming">
                    <div class="incoming-message">{{ $message->message_details }}</div> 
                    @if ($message->file_id)
                    @php
                        $file = \App\Models\ChatFiles::find($message->file_id);
                    @endphp
                    @if ($file)
                    <a href="{{ Storage::url('uploads/' . $file->fileName) }}" download>{{ $file->fileName }}</a>
                    @endif
                     @endif
                </div>
  
                @endif
                </div>
                @endforeach
            </div>
            <div class="send-panel">
            <form class="form" action="{{route('createMessage')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="message-input">
                    <input type="text" class="form-control message" placeholder="Type your message" name="message_details">
                </div>
                <div class="actions">
                    <input type="file" name="file">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
</div>
        </div>

</div>

@endsection

@section('scripts')
<script>
    // JavaScript code for sending and receiving messages via AJAX
    // Example: $('#chat-form').submit(function() { ... });
</script>
@endsection
