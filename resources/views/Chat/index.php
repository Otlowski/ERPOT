<!doctype html>
<html>
    <head>
	<title>Chat</title>
<!--	<script src="/js/AppBase/socketIO/socket.io.js"></script>
	<script src="/js/AppBase/jQuery/jquery-3.1.0.js"></script>-->
        <link type="text/css" rel="stylesheet" href="/css/Modules/Chat/style.css">
        <script src = "https://cdn.socket.io/socket.io-1.4.5.js"></script>
        <script src = "http://code.jquery.com/jquery-3.1.0.js"></script>

    </head>
    <body>
<!--        <div id ="username" data-username ="{{$username}}"></div>-->
        <label id = "notification_label">notifications:<br></label>
        <script>
            function makeId() {
                var possibleChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                var username = '';
                for( var i=0; i < 5; i++ ) {
                    username += possibleChars.charAt(Math.floor(Math.random() * possibleChars.length));
                }
                return username;
            }
            
            var socket = io(':3000');
            
            var notificationLabel = document.getElementById('notification_label');
            
            var possibleRooms = ['r111', 'r222']
            randomRoom = possibleRooms[Math.floor(Math.random() * possibleRooms.length)]
            
            
//            var username = $('#username').data("data-username");

            socket.on('connect', function() {
                console.log('You are connected with chat..');
                
                socket.on('welcome message', function(data) {
                    notificationLabel.innerText = notificationLabel.innerText + data.message + '\n';
//                    document.writeln(data.message);
                    console.log(data.message);
                })
                
                socket.emit('add user', {
                    username:   makeId()
                });
                
                socket.emit('create', {
                    room:       randomRoom
                });
                
//                socket.emit('switch room', {
//                    room:       'myRoom2'
//                });
                
                socket.on('new message', function(data) {
                    notificationLabel.innerText = notificationLabel.innerText + data.message + '\n';
//                    document.writeln(data.message);
                })
                
                // other font / font color
                socket.on('new notification', function(data) {
                    notificationLabel.innerText = notificationLabel.innerText + data.message + '\n';
//                    document.writeln(data.message);
                })
                
//                socket.emit('show room members', {
//                    room:       'myRoom2'
//                });
                
                socket.on('refresh stats', function(data) {
                    console.log('users online: ' + data.usersOnline);
                });
                
            });
            socket.on('disconnection', function() {
                console.log('You are disconnected..');
                //window.location.replace('...');   redirect to main chat page
            });
        </script>
	<ul id="messages"></ul>
	<span id="notifyUser"></span>
	<form id="form" action="" onsubmit="return submitfunction();" > 
            <input type="text" id="user" value="" /><input id="m" autocomplete="off" onkeyup="notifyTyping();" placeholder="Type yor message here.." /><input type="submit" id="button" value="Send"/> 
	</form>
    </body>
</html>