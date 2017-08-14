var express = require('express');
var io = require('socket.io')(3000);

var usersOnline = 0;
//var users = [];
var rooms = ['Main'];

io.on('connection', function(socket) {
    console.log('connection: ', socket.id);
    
    socket.emit('new notification', {
        message:    "Welcome!!! Create or join to existing room.."
    });
    
//    io.on('new message', function(data) {
//        socket.emit('newMessage', {
//            username:   socket.username,
//            message:    data
//        });
//    });
    
    socket.on('add user', function (data) {
        if (socket.username != undefined) {
            console.log(data.username, ' was added before..');
            return;
        }
        
        usersOnline++;
        
        io.sockets.emit('refresh stats', {
            usersOnline:    usersOnline
        });
        
        socket.username = data.username;
        socket.room = 'Main';
        
        socket.join('Main');
        
        socket.emit('new notification', {
            message:    'You(' + data.username + ') have connected to ' + socket.room + ' room..'
        });
        socket.broadcast.in(socket.room).emit('new notification', {
            message:    data.username + ' has connected to this room..'
        });
        
        console.log(data.username, ' added..');
    });
    
    socket.on('typing', function () {
        socket.broadcast.emit('typing', {
            username:    socket.username
        });
    });
    
    socket.on('stop typing', function () {
        socket.broadcast.emit('stop typing', {
            username:   socket.username
        });
    });
    
    //add room
    socket.on('create', function(data) {
        if (socket.room != 'undefined') {
            var oldRoom = socket.room;
            socket.leave(socket.room);
            socket.room = null;
            socket.broadcast.in(oldRoom).emit('new notification', {
                message:    data.username + ' has left this room..'
            });
        }
        
        socket.join(data.room);
        socket.room = data.room;
        
        
        socket.emit('new notification', {
            message:    'You have connected to ' + socket.room + ' room..'
        });
        socket.broadcast.in(socket.room).emit('new notification', {
            message:    socket.username + ' has connected to this room..'
        });
        
//        io.to(data.room).emit('new message', {
//            message:    socket.username + ' joined to ' + socket.room + ' room'
//        });
//        console.log(socket.username, ' joined to ', socket.room);
    });

    socket.on('switch room', function(data) {
        socket.leave(socket.room);
        console.log('exit: room');
        
        socket.join(data.room);
        socket.room = data.room;
        console.log('joined to: ', socket.room);
        
        socket.emit('new message', {
            message:    'You were moved to ' + socket.room + " room"
        })
    });
    
    socket.on('leave room', function() {
        if (typeof socket.room === undefined) {
            return;
        }
        socket.leave(socket.room);
        socket.room = null;
    })
    
    socket.on('disconnect', function() {
        
        //edit
        if (socket.room != 'undefined') {
            var oldRoom = socket.room;
            //socket.leave(socket.room);
            socket.room = null;
            socket.broadcast.in(oldRoom).emit('new notification', {
                message:    socket.username + ' has left this room..'
            });
        }
        
        usersOnline--;
        
        io.sockets.emit('refresh stats', {
            usersOnline:    usersOnline
        });
        
        console.log('disconnected with chat..');
    }); 
        
    // edit
//    socket.on('show room members', function(data) {
//        console.log('show');
//        var clients = io.sockets.adapter.rooms[data.room];
//        var users = [];
//
//        console.log(clients);
//
//        $.each(clients, function(value) {
//            console.log(value.username);
//        });
//        
//        socket.emit('new notification', {
//            message:    users
//        });
//    });
});

//function refreshStats(room) {
//    var users = io.sockets.clients(data.room);
//    var usersArray = [];
//    usersOnline = 0;
//    
//    users.forEach(function(client) {
//        console.log('Username: ' + client.username);
//    });
    
    
