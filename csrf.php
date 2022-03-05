<!-- CSRF protection in secure-website.com -->
<?php

session_start();
if (!isset($_SESSION["csrf"])) {
    $csrf_token = bin2hex(random_bytes(32));
} else {
    $csrf_token = $_SESSION["csrf"];
}

function change_email(array $params)
{
    if (!isset($params["csrf-token"])) {
        header("404");
    }

    $token = $params["csrf-token"];
    if ($token !== $_SESSION["csrf"]) {
        header("404");
    }

    // Continue processing
}
?>

<html>

<body>
    <form action="/csrf.php" method="GET">
        <input type="text" name="email" />
        <input type="hidden" id="michael" name="csrf-token" value=<?php echo '"' . $csrf_token . '"'; ?> />
        <input type="submit" />
    </form>
</body>

</html>