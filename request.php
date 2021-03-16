<?php

$mysqlError = [];
$mysql = mysqli_connect("localhost", "root", "Password1", "secprog");

if (isset($_POST["name"])) {
    $mainQuery = sprintf(
        "INSERT INTO Messages(ClientName, MailAddress, Subject, PhoneNumber, Message) VALUES('%s', '%s', '%s', '%s', '%s')",
        $_POST["name"],
        $_POST["email"],
        $_POST["subject"],
        $_POST["phone_number"],
        $_POST["message"]
    );

    if ($lastResult = mysqli_query($mysql, $mainQuery)) {
        if ($lastResult !== true) {
            $otherResults = [];
            while ($fetched_array = mysqli_fetch_array($lastResult, MYSQLI_ASSOC)) {
                array_push($otherResults, $fetched_array);
            }
        }
    } else {
        array_push($mysqlError, mysqli_error($mysql));
    }

    mysqli_close($mysql);
}

require("index.php");
