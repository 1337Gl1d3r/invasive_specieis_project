<?php
include_once "header.php";
include_once "../php/commons.php";

if((isset($_SESSION["user"])))
{
	header("Location: admin.php");
	exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{ 

    // Connect to db
    $conn = get_mysqli_localhost();

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
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">
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
	  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </body>
</html>
