<?php
    /** Sanitizes the given string to be echoed as HTML. */
    function sanitizeHTML($html) {
        return filter_var($html, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    /** Checks the given array for the given keys. */
    function array_has_keys($arr, $keys) {
        // Return false if a key is found to not be in the array
        // If the code does not stop (no return false), return true
        foreach ($keys as &$key) {
            if (!array_key_exists($key, $arr)) {
                return false;
            }
        }

        return true;
    }

    /** Logs in to the localhost MySQL server. */
    function get_mysqli_localhost() {
        $con = new mysqli("localhost", "root", "toor", "invdb");
		
		if (mysqli_connect_errno()) {
            printf("Connection Error: %s\n", $con->connect_error);
            die();
		}
        return $con;
    }

    /** Attemps the given query, but dies with an internal server error if it fails. */
    function attempt_query($db, $query) {
        $res = $db->query($query);

        if (!$res) {
            http_response_code(500);
            exit($db->error); // TODO: Use generic message
            exit("Internal Server Error.");
        }

        return $res;
    }

    // Initiate session
    session_start();
?>
