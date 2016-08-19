var exampleSocket = new WebSocket("ws:///wsserver", "socket");

exampleSocket.on("mesage", function(msg){
    console.log($msg)
});
