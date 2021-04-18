<?php

$commands = file_get_contents("setup.sql");

$mysql = mysqli_connect("localhost", "root", "Password1", "secprog");
$mysql->multi_query($commands);

mysqli_close($mysql);

$noQuery = true;
require "index.php";