<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
  </head>

<?php include_once "header.php"; ?>
    <main role="main" class="container">

      <div class="starter-template">
      <?php
      include_once "php/commons.php";

      // Create connection
      $conn = get_mysqli_localhost();

      if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
      }

      function relevant($conn, $plant_id)
      {
        $sql = $sql = "SELECT * FROM `responsibilities` WHERE `invasive_id`='$plant_id'";
        $responsibilities_query = mysqli_query($conn, $sql);
        if($responsibilities_query->num_rows > 0)
        {
          echo ('<p>Agencies to contact:</p>');
          while ($row = mysqli_fetch_array($responsibilities_query))
          {
            $agency_id = $row['agency_id'];
            $agency_sql = $sql = "SELECT * FROM `agency` WHERE `id`='$agency_id'";
            $agency_query = mysqli_query($conn, $sql);
            $agency_row = mysqli_fetch_assoc($agency_query);
            echo ('<p><a href="' . $agency_row['website'] . '"> ' . $agency_row['name']. '</a></p>');
          }
        }
        $spread_by_sql = "SELECT * FROM `spread_by` WHERE `invasive_id`='$plant_id'";
        $spread_by_query = mysqli_query($conn, $spread_by_sql);
        if($spread_by_query->num_rows > 0)
        {
          echo ('<p>Distribution Methods:</p>');
          while ($row = mysqli_fetch_array($spread_by_query))
          {
            $distribution_id = $row['distribution_id'];
            $distribution_sql = $sql = "SELECT * FROM `distribution_methods` WHERE `id`='$distribution_id'";
            $distribution_query = mysqli_query($conn, $sql);
            $distribution_row = mysqli_fetch_assoc($distribution_query);
            echo ('<p>Description: ' . $distribution_row['description'] . '</p>');
            echo ('<p>Type: ' . $distribution_row['type'] . '</p>');
            echo ('<p>Preventative measures: ' . $distribution_row['preventative_measures'] . '</p>');
          }
        }
        $legal_status_sql = "SELECT * FROM `legal_status` WHERE `invasive_id`='$plant_id'";
        $legal_status_query = mysqli_query($conn, $legal_status_sql);
        if($legal_status_query->num_rows > 0)
        {
          echo ('<p>Legal Status:</p>');
          while ($row = mysqli_fetch_array($legal_status_query))
          {
            $invasive_status_id = $row['status_id'];
            $invasive_status_sql = $sql = "SELECT * FROM `invasive_status` WHERE `id`='$invasive_status_id'";
            $invasive_status_query = mysqli_query($conn, $sql);
            $invasive_status_row = mysqli_fetch_assoc($invasive_status_query);
            echo ('<p>Legal Act: '.$invasive_status_row['legal_act'].'</p>');
            echo ('<p>Type: '.$invasive_status_row['type'].'</p>');
            echo ('<p>Description: '.$invasive_status_row['description'].'</p>');
          }
        }
      }
        if (isset($_GET['edit']))
        {
          $inv_sci_name = mysqli_real_escape_string($conn, $_GET['edit']);
          if (isset($_POST['type']))
          {
            $edit_type = $_POST['type'];
            if ($edit_type==='invasive_species')
            {
              if (isset($_POST['name']) && isset($_POST['concern']) && isset($_POST['description']))
              {
                $name = mysqli_real_escape_string($conn, $_POST['name']);
                $concern = mysqli_real_escape_string($conn, $_POST['concern']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                $sql = "UPDATE `e_invasive_species` SET `inv_sci_name` = '$name', `concern`='$concern', `inv_desc`='$description' WHERE `e_invasive_species`.`inv_sci_name` = '$inv_sci_name'; ";
                if ($conn->query($sql) === TRUE) 
                {
                    echo "Record succesfully updated";
                } 
                else 
                {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
              }
            }
          }
        }
        elseif (isset($_GET['inv_sci_name']))
        {
          $inv_sci_name = mysqli_real_escape_string($conn, $_GET['inv_sci_name']);
          $sql = $sql = "SELECT * FROM `e_invasive_species` WHERE `inv_sci_name`='$inv_sci_name'";
          $query = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($query);
          echo '<div class="jumbotron">';
          if(isset($_SESSION["user"]))
          {
            echo ('<form class="form-edit" method="post" action="?edit='.$row['inv_sci_name'].'" id="form-edit">');
            echo ('<input type="hidden" name="type" value="invasive_species">');
            echo ('<input type="text" name="name" value="'.$row['inv_sci_name'].'">');
            echo ('<input type="text" name="description" value="'.$row['inv_desc'].'">');
            echo ('<input type="text" name="concern" value="'.$row['concern'].'">');
            echo ('<button class="btn btn-lg btn-primary" type="submit">Edit Inavasive Species Info</button>');
            echo ('</form>');
          }
          else
          {
            echo ('<p>' . $row['inv_sci_name'] . '</p>');
            echo ('<p>' .$row['inv_sci_name'] . '</p>');
            echo ('<p>' .$row['inv_desc'] . '</p>');
          }
          echo '</div>';
        }
        elseif(isset($_POST['submit']))
        {
          if (isset($_REQUEST['input'])) 
          {
            $input = mysqli_real_escape_string($conn, $_REQUEST['input']);
            $sql = $sql = "SELECT * FROM `e_invasive_species` WHERE `inv_sci_name` LIKE '%".$input."%'";
            $query = mysqli_query($conn, $sql);

            if($query->num_rows > 0)
            {
              while ($row = mysqli_fetch_array($query))
              {
                $aquatic = Null;
                if ($row['aquatic'])
                {
                  $aquatic = "Aquatic";
                }
                else
                {
                  $aquatic = "Not aquatic";
                }
                echo "<p>" . "Scientific name: " . $row["inv_sci_name"] . '</p>';   
                echo "<p>" . "description: " . $row["inv_desc"] . '</p>';   
                echo "<p>" . "Aquatic or not: " . $aquatic . '</p>';   
                echo '<p><a href="?inv_sci_name=' . $row["inv_sci_name"] . '">' . $row["inv_sci_name"] . '</a></p>';
              }
            }
            else 
            {
              echo "<br>" . "Sorry, No results found.";
            } 
          }
        }
        else
        {
          $sql = $sql = "SELECT * FROM `e_invasive_species` LIMIT 10";
          $query = mysqli_query($conn, $sql);

          if($query->num_rows > 0)
          {
            while ($row = mysqli_fetch_array($query))
            {  
              echo '<div class="jumbotron">';
              echo "<p>" . "Scientific name: " . $row["inv_sci_name"] . '</p>';   
              echo "<p>" . "description: " . $row["inv_desc"] . '</p>';   
              echo '<p><a href="?inv_sci_name=' . $row["inv_sci_name"] . '">' . $row["inv_sci_name"] . '</a></p>';
              relevant($conn, $row["inv_sci_name"]);
              echo '<img src="images/'.$row['thumbnail'].'">';
              echo '</div>';
            }
          }
        }
      $conn->close();
      ?>
        </div>

    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>
