@extends('admin.master')

@section('head')
<title> Players </title>

<style>
        /* Side users list */
        .users-list {
            max-height: 500px;
            overflow-y: scroll;
            border-right: 1px solid #ccc;
        }

        .users-list-item {
            cursor: pointer;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .users-list-item:hover {
            background-color: #f0f0f0;
        }

        /* Chat box */
        .admin-chat-box {
            height: 400px;
            border: 1px solid #ccc;
            overflow-y: scroll;
            padding: 10px;
            margin-bottom: 10px;
        }

        .received-message, .sent-message {
            max-width: 70%;
            padding: 10px 12px;
            margin-bottom: 10px;
            border-radius: 5px;
            clear: both;
        }

        .received-message {
            background-color: #DCF8C6;
            float: left;
            margin-left: 5%;
        }

        .sent-message {
            background-color: #ECE5DD;
            float: right;
            margin-right: 5%;
        }
    </style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

@endsection

@section('content')

     <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <!-- Users list -->
                <div class="col-md-4 users-list">
                    @foreach($users as $user)
                    <div class="users-list-item" data-user-id="{{ $user->id }}">
                        {{ $user->vplay_id }} ({{ $user->unread_messages }} unread messages)
                    </div>
                    @endforeach
                </div>
        
                <!-- Chat area -->
                <div class="col-md-8">
                    <div class="admin-chat-box">
                        <!-- Chat messages will be displayed here -->
                    </div>
                    
                    <div class="input-group">
                        <input type="text" class="form-control" id="adminMessageInput" placeholder="Type a message" aria-label="Message">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" id="adminSendMessage">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->   
       
       <script>
           $(document).ready(function() {
    $(".users-list-item").click(function() {
        let userId = $(this).data('user-id');

        // Clear the chat box first
        $(".admin-chat-box").html('');

        $.ajax({
            type: 'GET',
            url: '/admin/message/' + userId,
            success: function(data) {
                data.messages.forEach(function(message) {
                    let msgElem = '';
                    if(message.is_admin) {
                        msgElem = '<div class="sent-message">Admin: ' + message.message + '</div>';
                    } else {
                        msgElem = '<div class="received-message">User: ' + message.message + '</div>';
                    }
                    $(".admin-chat-box").append(msgElem);
                });
            },
            error: function(data) {
                console.error("Error fetching messages:", data);
            }
        });
    });
});

       </script>

@endsection
