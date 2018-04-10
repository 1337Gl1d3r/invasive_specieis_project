<?php
    /** Removes the given session. */
    $QUERY_REMOVE_SESSION = "DELETE FROM sessions WHERE id = '%s'";

    // Include commons
    include_once "server/commons.php";

    // Logout
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        // Determine login page
        $domain = explode(".", $_SERVER["HTTP_HOST"])[0];
        $loginPage = "http://" . $domain . ".seekintoo.net/login";

        // Remove old session and remove login cookie
        if ($_COOKIE["LOGIN"]) {
            // Query the database
            $db = get_mysqli_testing("users");
            $session = $db->real_escape_string($_COOKIE["LOGIN"]);
            query_assert_success($db, sprintf($QUERY_REMOVE_SESSION, $session));

            // Reset the cookie
            setcookie("LOGIN");
        }

        // Redirect user
        header("Location: " . $loginPage);
        die();
    } else {
        http_response_code(405);
        exit("Method Not Allowed.");
    }
?>