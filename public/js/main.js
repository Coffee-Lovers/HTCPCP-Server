var conn = new WebSocket("ws://localhost:8085/ws");

conn.onopen = function(e) {
    // subscribe to some id
    conn.send(JSON.stringify({SubscribeTo: "abcd"}))
};

conn.onmessage = function(e) {
    console.log(e.data);
};
