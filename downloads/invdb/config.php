<! Template File from https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php />
<?php
    /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
	
    $servername = "localhost";
    $username = "root";
    $password = '';
    $database = "471";

    // Create connection
    $conn = mysqli_connect($servername, $username, '', $database);
    
    // Check connection
    if($conn === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>