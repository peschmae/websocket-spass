<?php

    $url = 'https://texttospeech.googleapis.com/v1/text:synthesize';

    $curl = curl_init();
    $body = array(
                "input"         => array("text" => $_POST['text']),
                "voice"         => array("languageCode" => "de-DE", "name" => "de-DE-Wavenet-B"),
                "audioConfig"   => array("audioEncoding" => "MP3")
            );

    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));

    curl_setopt($curl, CURLOPT_URL, $url . "?key=<INSERT_API_KEY_HERE>");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    $response = json_decode($result, true);

?>

<html>
    <head>
        <title>Audio Output</title>
    </head>
    <body>
        MP3: <?php echo $response["audioContent"]; ?>

        <script>
            var conn = new WebSocket('ws://localhost:8090');
            conn.onopen = function(e) {
                console.log("Connection established!");

                conn.send("<?php echo $response["audioContent"]; ?>");
            };

        </script>
    </body>
</html>
