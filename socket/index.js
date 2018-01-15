var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');

io.set('origins', 'http://localhost:*');

var redis = new Redis();
  redis.subscribe('files-channel', function(err, count) {
});
redis.on('message', function(channel, message) {
  message = JSON.parse(message);
  console.log('Message Recieved: ' + channel + ':' + message.event);
  io.emit(channel + ':' + message.event, message.data);
});

io.sockets.on('connection', function(socket){
  console.log('a user connected');
});

http.listen(3000, function(){
  console.log('listening on *:3000');
});

app.get('/socket.io/', function(req, res){
  res.send('<h1>Hello world</h1>');
});

