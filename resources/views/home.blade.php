@extends ('layout')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4 userlist-card">
            <h2>User List</h2>
            <ul>
                @foreach($users as $user)
                    <li>{{ $user->firstname }}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-8">
            <h2>Chat</h2>
            <div id="chat-messages">
                
                @foreach($messages as $message)

                @if ($message->user_id === $userId)
                <div style="background-color: green"><p>{{ $message->message_details }}</p></div>
                @if ($message->file)
                  <a href="{{ asset(Storage::url($message->file->file_url)) }}">Download File</a>
               @endif
                @else
                <div style="background-color: red"><p>{{ $message->message_details }}</p></div> 
                @if ($message->file)
                 <a href="{{ asset(Storage::url($message->file->file_url)) }}">Download File</a>
               @endif   
                @endif

                @endforeach
                    
                
            </div>
            <form action="{{route('createMessage')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Type your message" name="message_details">
                </div>
                <div class="form-group">
                    <input type="file" name="file">
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
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
