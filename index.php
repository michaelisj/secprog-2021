<div>
    <?php
    if (!isset($GLOBALS["mysqlError"])) {
        $mysqlError = [];
    }

    $mysql = @mysqli_connect("localhost", "root", "Password1", "secprog");
    if (!$mysql) {
        array_push($mysqlError, mysqli_connect_error());
    } else {
        try {
            $query = "SELECT * FROM Messages";
            if (isset($_GET["filter"])) {
                $query .= " WHERE " . $_GET["filter"];
            }

            $results = [];

            if (!isset($GLOBALS["noQuery"]) || $noQuery === false) {
                if ($result = mysqli_query($mysql, $query)) {
                    while ($fetched_array = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        array_push($results, $fetched_array);
                    }
                } else {
                    array_push($mysqlError, mysqli_error($mysql));
                }
            }
        } finally {
            mysqli_close($mysql);
        }
    }

    ?>

</div>

<!DOCTYPE html>
<html lang="he">

<head>
    <meta charset="UTF-8">

    <title>צרו קשר</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <nav id="navbar-id"></nav>

    <main role="main">
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-3">צרו קשר</h2>

                    <p>יש לכם שאלות? אנחנו כאן לעזור!</p>
            </div>
        </div>
        <div class="container">

            <div class="row">

                <?php
                if (sizeof($mysqlError) > 0) {
                    $class = "alert-danger";
                } else {
                    $class = "alert-success";
                } ?>
                <div class="col-md-3 alert <?php echo $class; ?>">
                    <h2>Last error:</h2>
                    <?php
                    foreach ($mysqlError as $error) {
                        echo sprintf("%s", $error);
                    }
                    ?>
                </div>

                <div class="col-md-9 mb-5">
                    <form id="contact-form" name="contact-form" action="/request.php" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-0 pt-4">
                                    <input type="text" id="name" name="name" class="form-control form-field" required>
                                    <label for="name" class="form-label">First Name</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-0 pt-4">
                                    <input type="email" id="email" name="email" class="form-control form-field ltr-input" required>
                                    <label for="email" class="form-label">Mail Address</label>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class=" mb-0 pt-4">
                                    <input type="text" id="subject" name="subject" class="form-control form-field" required>
                                    <label for="subject" class="form-label">Subject</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class=" mb-0 pt-4">
                                    <input type="tel" id="phone_number" name="phone_number" class="form-control form-field ltr-input">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">

                            <!--Grid column-->
                            <div class="col-md-12">

                                <div>
                                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea" style="height: 150px;" required></textarea>
                                    <label for="message" class="form-label">Message</label>
                                </div>

                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                            </div>
                        </div>
                        <div class="text-center text-md-left">
                            <input type="submit" id="sendButton" class="btn btn-primary"></input>
                        </div>
                    </form>


                    <div class="status"></div>
                </div>

            </div>
        </div>
        <div class="container">
            <h2>Last sql result</h2>
            <?php
            $message = "";
            if (isset($GLOBALS["lastResult"])) {
                $message .= sprintf("<p>MySQL query: %s</p>", htmlspecialchars($mainQuery));
                if ($lastResult === true) {
                    $class = "alert-primary";
                    $message .= "<h3> Operation completed successfully </h3>";
                } else if ($lastResult === false) {
                    $class = "alert-danger";
                    $message .= "<h3> Operation failed </h3>";
                } else {
                    $class = "alert-success";
                    $message .= "<p>" . print_r($otherResults, true);
                }
            } else {
                $message = "No query was executed";
                $class = "alert-secondary";
            }
            ?>
            <div class="row <?php echo $class ?>" style="display: block">
                <?php echo $message; ?>
            </div>
        </div>
        <div class="container">
            <h2>Messages</h2>
            <?php
            function get_message($result)
            {
                return sprintf(
                    "<h3>Name: %s</h3><h3>Phone: %s</h3><h3>Mail: %s</h3><h3>Subject: %s</h3><p>Message: %s</p>",
                    htmlspecialchars($result["ClientName"]),
                    htmlspecialchars($result["PhoneNumber"]),
                    htmlspecialchars($result["MailAddress"]),
                    htmlspecialchars($result["Subject"]),
                    htmlspecialchars($result["Message"])
                );
            }
            foreach ($results as $result) {
                echo sprintf("<div style=\"display: block\" class=\"row alert-secondary\">%s</div>", get_message($result));
            }

            ?>

        </div>
    </main>
    <footer id="footer-id"></footer>

</body>


</html>