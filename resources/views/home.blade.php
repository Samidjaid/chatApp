@extends ('layout')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4">
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
                <!-- Chat messages will be displayed here -->
            </div>
            <form id="chat-form">
                <div class="form-group">
                    <input type="text" class="form-control" id="message" placeholder="Type your message">
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
