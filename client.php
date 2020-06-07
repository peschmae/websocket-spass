<?php



?>

<html>

<head>
<title>Connect to websocket</title>
<head>
<body>
<ul id="event-list">
</ul>

<script>

var conn = new WebSocket('ws://localhost:8090');
conn.onopen = function(e) {
    console.log("Connection established!");
};

var backlog=[];
var sound;

conn.onmessage = function(e) {
    console.log(e.data);
    if (window.sound == undefined || window.sound.paused) {
        window.sound = new Audio('data:audio/mp3;base64,' + e.data);
        window.sound.play();
    } else {
        window.backlog.push(e.data)
    }

};


</script>
</body>
</html>
