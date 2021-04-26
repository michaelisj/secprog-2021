<?php

header("Content-Security-Policy: script-src 'self' 'unsafe-inline' 'sha256-AQieUlxonCvnH4YT58p6hI/UCV6iq+siNCrJW+LqRLc=' 'sha256-RFWPLDbv2BY+rCkDzsE+0fr8ylGr2R2faWMhq4lfEQc='");

?>
<html>

<head>
    <meta charset="UTF-8">

    <title>SCP</title>
    <script integrity="sha256-aIsWcC+hi5msIoeUoFvuXsblLeeCKM60fTvYd4BL8zI=" src="script.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <script>function doSomething() {alert("OK dude");}doSomething();</script>
    <script>
        alert(1);
    </script>
</body>

</html>