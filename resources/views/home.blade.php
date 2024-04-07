@extends ('layout')
@section('content')

<div class="app-container">
        <div class="userlist-card">
                @foreach($users as $user)
                    <div class="user-item">
                            <div class="avatar"></div>
                            <div class="username">{{ $user->firstname }}</div>
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
                    @if ($message->file)
                        <a href="{{ asset(Storage::url($message->file->file_url)) }}">Download File</a>
                     @endif
                </div>

          
                @else
                <div class="chat-message-incoming">
                    <div class="incoming-message">{{ $message->message_details }}</div> 
                    @if ($message->file)
                        <a href="{{ asset(Storage::url($message->file->file_url)) }}">Download File</a>
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
