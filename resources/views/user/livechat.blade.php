@extends('layouts.master')

@section('head')
    <title>VK Ludo Player-Play Ludo King Win Real Money</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .chat-container {
        height: 500px;
        border-radius: 5px;
        overflow: hidden;
        position: relative;
        background-color: #ECE5DD;
    }

    .chat-box {
        position: absolute;
        top: 0;
        bottom: 50px;
        width: 100%;
        overflow-y: scroll;
        padding: 10px;
    }

    .sent-message, .received-message {
        max-width: 70%;
        padding: 10px 12px;
        margin-bottom: 5px;
        border-radius: 5px;
        position: relative;
        clear: both;
    }

    .sent-message {
        background-color: #DCF8C6;
        float: right;
        margin-right: 5%;
    }

    .received-message {
        background-color: #FFF;
        float: left;
        margin-left: 5%;
    }

    .message-input {
        position: absolute;
        bottom: 0;
        width: 100%;
        padding: 10px;
        background-color: #F4F4F4;
    }

    .input-group {
        box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.1);
    }
</style>

@endsection

@section('content')
<div class="main-area" style="padding-top: 60px;">
    <div class="container">
        <div class="chat-container">
            <div class="chat-box">
                <!-- Sample Messages -->
                @foreach($messages as $message)
                    @if($message->is_admin)
                        <div class="received-message">
                            {{ $message->message }}
                        </div>
                    @else
                        <div class="sent-message">
                            {{ $message->message }}
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Message Input -->
            <div class="message-input">
                <div class="input-group">
                    <input type="text" class="form-control" id="messageInput" placeholder="Type a message" aria-label="Message">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" id="sendMessage">Send</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    $(document).ready(function() {
        $("#sendMessage").click(function() {
            var message = $("#messageInput").val();

            // Send the message via AJAX
            $.ajax({
                type: 'POST',
                url: '/send-message', // Replace with the route to your controller's store method
                data: {
                    message: message,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    // Append the message to the chat box
                    $(".chat-box").append('<div class="sent-message">Me: ' + message + '</div>');
                    // Clear the input box
                    $("#messageInput").val('');
                },
                error: function(data) {
                    console.error("Error sending message:", data);
                }
            });
        });
    });
</script>
<script>
    // Function to fetch latest messages
    function fetchMessages() {
        $.ajax({
            type: 'GET',
            url: '/fetch-messages', // Route to get latest messages
            success: function(data) {
                $(".chat-box").html(''); // Clear chat box
                data.messages.forEach(function(message) {
                    if(message.is_admin) {
                        $(".chat-box").append('<div class="received-message">Admin: ' + message.text + '</div>');
                    } else {
                        $(".chat-box").append('<div class="sent-message">Me: ' + message.text + '</div>');
                    }
                });
            },
            error: function(data) {
                console.error("Error fetching messages:", data);
            }
        });
    }

    // Call fetchMessages initially to load messages
    fetchMessages();

    // Polling: Fetch messages every 10 seconds
    setInterval(fetchMessages, 10000);

</script>
@endsection
