<?php

    // Libraries
    include_once "/commons.php";
    include_once "server/pbkdf2-hash.php";

    // Error message to display to client
    $error_msg = "";

    // Make sure we aren't getting brute forced
    $db = get_mysqli_testing("users");
    $ip = $db->real_escape_string($_SERVER["SERVER_ADDR"]);
    $res = query_assert_success($db, sprintf($GLOBALS["QUERY_GET_LOGIN_ATTEMPTS"], $ip));

    if ($res -> num_rows === 0) {
        $attempts = -1;
    } else {
        $attempts = $res->fetch_assoc()["attempts"] + 1;
    }

    /** Logs the user in from the given $_POST details.
     *  Assumes that the "username" and "password" fields are set.
     *  Username may also be an email.
     *  May fail (invalid credentials).
     */
    function login() {
        // Create MySQL connection
        $db = get_mysqli_testing("users");

        // Sanitize input
        $username = $db->real_escape_string($_POST["username"]);
        $password = $db->real_escape_string($_POST["password"]);
        $remember = array_key_exists("remember", $_POST) ? $_POST["remember"] : false;

        // Brute force protection
        $db = get_mysqli_testing("users");
        $ip = $db->real_escape_string($_SERVER["SERVER_ADDR"]);
        $res = query_assert_success($db, sprintf($GLOBALS["QUERY_GET_LOGIN_ATTEMPTS"], $ip));

        if ($GLOBALS["attempts"] === -1) {
            query_assert_success($db, sprintf($GLOBALS["QUERY_CREATE_LOGIN_ATTEMPTS"], $ip));
        } else {
            query_assert_success($db, sprintf($GLOBALS["QUERY_INCREMENT_LOGIN_ATTEMPTS"], $ip));
        }

        // Get entry
        $res = query_assert_success($db, sprintf($GLOBALS["QUERY_GET_INFOS"], $username));
        
        if ($res->num_rows === 0) {
            return "Invalid Username or Password";
        } else if ($res->num_rows !== 1) {
            http_response_code(500);
            exit("Internal Server Error.");
        }

        // Get database's password
        $row = $res->fetch_assoc();

        if ($row["verified"] == "0") {
            return "Please verify your email before logging in.";
        }

        $dbHash = $row["password"];
        $uid = $row["id"];
        $cid = $row["company"];
        $mfaMethod = $row["mfaMethod"];

        // Check password
        if (!PasswordStorage::verify_password($password, $dbHash)) {
            return "Invalid Username or Password";
        }

        // Get user's domain
        $res = query_assert_success($db, sprintf($GLOBALS["QUERY_GET_COMPANY_DOMAIN"], $cid));
        $row = $res->fetch_assoc();
        $cdomain = $row["domain"];

        // Reset login attempts
        $reset = query_assert_success($db, sprintf($GLOBALS["QUERY_UPDATE_RESET_ATTEMPTS"], $ip));
        if (!reset) {
            http_response_code(500);
            exit("Internal Server Error.");
        }

        // Prompt to create company, or login
        // Note that in the current workflow 2FA cannot be set until a company has been created, so we do not need to check it
        if ($res->num_rows === 0) {
            // Initial company setup
            $key = create_session($uid, $remember, true);
            header("Location: initialsetup.php");
            die();
        } else {
            // Redirect to home page or 2FA page
            if ($mfaMethod == 0) { // No MFA
                $key = create_session($uid, $remember, true);
                domain_transfer($cdomain, "home");
                die();
            } else if ($mfaMethod == 1) { // TOTP
                $key = create_session($uid, $remember, false);
                header("Location: login-duo.php?domain=" . urlencode($cdomain));
                die();
            } else if ($mfaMethod == 2) { // Text message
                $key = create_session($uid, $remember, false);
                header("Location: login-mfa-text.php?domain=" . urlencode($cdomain));
                die();
            } else { // Bad value
                http_response_code(500);
                die("Internal Server Error.");
            }
        }
    }

    // Login if the user is posting
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Ensure correct fields are set
        if (!array_has_keys($_POST, ["username", "password"])) {
            http_response_code(400);
            exit("Bad Request");
        }

        // Check captcha, then query db
        if ($attempts < $CAPTCHA_LIMIT || verify_captcha(@$_POST["g-recaptcha-response"]) === true) {
            // Attempt to login
            $res = login();

            if ($res !== true) {
                $error_msg = $res;
            }
        } else {
            $error_msg = "Invalid Captcha";
        }
    }
?>
<DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://www.google.com/recaptcha/api.js"></script>
    </head>
    <body>
        <center>
            <h1>Login</h1>
            <form method="post">
                Email: <input type="text" name="username" value="<?php echo sanitizeHTML(@$_POST["username"]) ?>"><br>
                Password: <input type="password" name="password"><br>
                <br>
                <?php if ($attempts >= $CAPTCHA_LIMIT): ?>
                <div class="g-recaptcha" data-sitekey="6LdBgycUAAAAAL97XPq4QsWTt-yUxFwxbfJ6cbHZ"></div>
                <?php endif; ?>
                <input type="submit" value="Login">
                <input type="checkbox" name="remember"> Remember Me<br>
                <a style="color: red;">
                    <?php echo $error_msg; ?>
                </a>
            </form>

            <a href="new-user.php">New User</a><br>
            <a href="forgot-password.php">Forgot Password</a>
        </center>
    </body>
</html>
