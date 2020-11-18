<?php

require_once 'core\\init.php';




?>

<!DOCTYPE html>
<html>
    <head>
        <title>URL Shortner</title>
    </head>
    <body>
        <input type="url" id="url">
        <button id="shorten" onclick="send()">shorten</button>
        <div id="link"></div>
        <script src="js/ajax.js"></script>
    </body>
</html>