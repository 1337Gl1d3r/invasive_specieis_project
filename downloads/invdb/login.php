<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{ 
	//init session
	session_start();
	
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "invdb";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) 
	  {
        die("Connection failed: " . mysqli_connect_error());
    }
    //echo "Connected successfully\n";  

	////////////////////////////////////////////////////////////////////////////////	
		if (!empty($_REQUEST['user']) && $_POST['pass']) 
		{	
			$Uin = mysqli_real_escape_string($conn, $_REQUEST['user']);     
			$Pin = mysqli_real_escape_string($conn, $_REQUEST['pass']);
			$sql = $sql = "SELECT * FROM `e_admin`
							WHERE `admin_id` LIKE '%" . $Uin . "%' 
							AND `admin_pass` LIKE '%" . $Pin . "%'";
				
			$query = mysqli_query($conn, $sql); 
			if($query->num_rows == 1)
			{
        $_SESSION["user"] = "true";
				header("Location: admin.php");
				exit;
			}
		}
		$conn->close();		
	}
?>


<! Bootstrap Example: sign-in https://getbootstrap.com/docs/4.1/examples/sign-in/ />
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Sign-in to edit Invasive Species Database</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="post" action="" id="form-signin">
      <img class="mb-4" src="ID_GUIDE_LOGO.png" alt="" width="150" height="150">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="id" class="sr-only">Email address</label>
      <input type="text" id="id" name="user" class="form-control" placeholder="Email address" required autofocus>
      <label for="password" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
  </body>
</html>