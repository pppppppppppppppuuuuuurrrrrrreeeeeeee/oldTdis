const express = require('express');
const app = express();
app.use(express.static('public'))
const http = require('http').createServer(app);
const io = require('socket.io')(http);
const port = process.env.port || 3000;

http.listen(port, () => {
    console.log('listening on *:', port);
});


io.on('connection', (socket) => {
    console.log(socket.id);
    socket.on('recordId', (recordId) => {
        // console.log(`recordId: ${recordId}`);
        io.sockets.emit('recordId', recordId);
    });
});
