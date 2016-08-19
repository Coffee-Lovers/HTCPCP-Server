var conn = new WebSocket("ws://wsserver:8081");

conn.onopen = function(e) {
    console.log("Connection established!");
};

conn.onmessage = function(e) {
    console.log(e.data);
};
