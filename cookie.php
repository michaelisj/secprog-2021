<?php

session_start();
if (isset($_GET["pass"]) && $_GET["pass"] === "Password1") {
    $_SESSION["is_admin"] = 1;
}

var_dump($_SESSION);
var_dump($_COOKIE);

?>

<html>

<body>
    <form action="/csrf.php" method="GET">
        <input type="text" name="email" />
        <input type="submit" />
    </form>
</body>

</html>