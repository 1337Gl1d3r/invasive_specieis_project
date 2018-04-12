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

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="./">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">          
            <a class="nav-link" href="all_invasive_species.php">All Invasive Species <span class="sr-only">(current)</span></a>
          </li>          
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
           <!-- <a class="nav-link disabled" href="#">Disabled</a> -->
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
        <!-- SEARCHING -->
        <form class="form-inline my-2 my-lg-0" action="index.php" method="post">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="input">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
        </form>
      </div>
    </nav>

    <main role="main" class="container">

      <div class="starter-template">
      <?php
      
      // ================================ FUNCTIONS ======================================
      
      function randallrelevant($conn, $plant_id)
      {
        // print out all plant information
        $sql1 = "SELECT `e_plants`.*, `r_has`.*\n"

            . "FROM `e_plants`\n"

            . "    LEFT JOIN `r_has` ON `r_has`.`inv_sci_name` = `e_plants`.`inv_sci_name`\n"
            
            . "    WHERE `e_plants`.`inv_sci_name` ='$plant_id'";           

            $query = mysqli_query($conn, $sql1);
            $row = mysqli_fetch_assoc($query);  
            $result = $conn->query($sql1);             
            if ($result->num_rows > 0)
              {        
                echo "<p>" ."<strong>Life Cycle: </strong>". $row["lc_type"] .".". '</p>';    
                echo "<p>" ."<strong>Flower Description: </strong>". $row["flower_desc"]. '</p>';      
                echo "<p>" ."<strong>Leaf Description: </strong>". $row["leaf_desc"] .".". '</p>'; 
                echo "<p>" ."<strong>Stem Description: </strong>". $row["stem_desc"]. '</p>';     
                echo "<p>" ."<strong>Root Description: </strong>". $row["root_desc"] .".". '</p>';     
                echo "<p>" ."<strong>Seed Description: </strong>". $row["seed_desc"]. '</p>';
                echo "<p>" ."<strong>Similar Species: </strong>". $row["similar_species"] .".". '</p>';            
              }

              
        // print out all pathogen information
        $sql2 = "SELECT `e_pathogens`.*, `e_impacted_species`.*, `r_impacts`.*\n"

            . "FROM `e_pathogens`\n"
            
            . "    LEFT JOIN `r_impacts` ON `r_impacts`.`inv_sci_name` = `e_pathogens`.`inv_sci_name`\n"
            
            . "    LEFT JOIN `e_impacted_species` ON `e_impacted_species`.`imp_sci_name` = `r_impacts`.`imp_sci_name`\n"
            
            . "    WHERE `e_pathogens`.`inv_sci_name` ='$plant_id'";           

            $query = mysqli_query($conn, $sql2);
            $row = mysqli_fetch_assoc($query);  
            $result = $conn->query($sql2);             
            if ($result->num_rows > 0)
              {        
                echo "<p>" ."<strong>Pathogen Type: </strong>". $row["path_type"] .".". '</p>';    
                echo "<p>" ."<strong>Impacted Species: </strong>". $row["imp_com_name"] .".". '</p>';      
              }              

              
        // print out all animal information
        $sql3 = "SELECT *"

            . "FROM `e_animals`\n"
                        
            . "    WHERE `e_animals`.`inv_sci_name` ='$plant_id'";           

            $query = mysqli_query($conn, $sql3);
            $row = mysqli_fetch_assoc($query);  
            $result = $conn->query($sql3);             
            if ($result->num_rows > 0)
              {        
                echo "<p>" ."<strong>Type: </strong>". $row["subphylum"] . '</p>';    
                echo "<p>" ."<strong>Life Span: </strong>". $row["life_span"] . '</p>';   
                echo "<p>" ."<strong>Reproduction: </strong>". $row["reproduction"] . '</p>';    
                echo "<p>" ."<strong>Habitat: </strong>". $row["habitat"] . '</p>';                    
              }                        
      }
      
      // =============================== /FUNCTIONS ======================================     
      




      // =============================== CONNECTING ======================================
       
      $servername = "localhost";
      $username = "root";
      $password = "";
      $database = "invdb";
      // Create connection
      $conn = mysqli_connect($servername, $username, $password, $database);
      // Check connection
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      echo "Connected successfully";
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
        
      // ============================== /CONNECTING ======================================    


       
      // ================================ ACTIONS ========================================
       
      //
      // -------------------------- Clicking on a Plant ----------------------------------
      //
      elseif (isset($_GET['inv_sci_name']))
      {
        $inv_sci_name = mysqli_real_escape_string($conn, $_GET['inv_sci_name']);
        //$sql = $sql = "SELECT * FROM `e_invasive_species` WHERE `inv_sci_name`='$inv_sci_name'";
        
        $sql = "SELECT `e_invasive_species`.*, `r_who_can_help`.*,
                            `r_spread_by`.*, `r_legal_status`.*\n"

            . "FROM `e_invasive_species`\n"
            
            . "    LEFT JOIN `r_who_can_help` ON `r_who_can_help`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"

            . "    LEFT JOIN `r_spread_by` ON `r_spread_by`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"

            . "    LEFT JOIN `r_legal_status` ON `r_legal_status`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"        
            
            . "    WHERE `e_invasive_species`.`inv_sci_name` ='$inv_sci_name'";            

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
          // LOOKING AT A PARTICULAR PLANT
          echo '<div align="left">';
          echo '<p>'."<strong>Scientific Name: </strong>".'<i>'.$row["inv_sci_name"] .'</i></a></p>';
          echo "<p>"."<strong>Common Name: </strong>".$row["inv_com_name"] . '</p>';              
          echo "<p>" . $row["inv_desc"] . '</p>'; 
          echo "<p>" ."<strong>Aquatic: </strong>". $row["aquatic"] .".". '</p>';    
          echo "<p>" ."<strong>Concern: </strong>". $row["concern"] . '</p>';      
          echo "<p>" ."<strong>Spread By: </strong>". $row["dist_type"] .".". '</p>'; 
          echo "<p>" ."<strong>Management: </strong>". $row["management"] . '</p>';
          randallrelevant($conn, $row["inv_sci_name"]);           
          echo "<p>" ."<strong>Legal Status: </strong>". $row["inv_status"] .".". '</p>';     
          echo "<p>" ."<strong>Who Can Help: </strong>". $row["agency_name"] .".". '</p>';
          echo "<p>" ."<strong>References: </strong>". $row["inv_ref"] .".". '</p>';            
          echo '</div>';
        }
        echo '</div>';
      }     
      //
      // --------------------------- Querying a Plant ------------------------------------
      //
      elseif(isset($_POST['submit']))
      {
        if (isset($_REQUEST['input'])) 
        {

          $input = mysqli_real_escape_string($conn, $_REQUEST['input']);
          $sql = $sql = "SELECT * FROM `e_invasive_species` WHERE `inv_sci_name` LIKE '%".$input."%'";
          $query = mysqli_query($conn, $sql);

          if($query->num_rows > 0)
          {
            echo '<p>'."Your search returned ".$query->num_rows." results.".'</p>';
            while ($row = mysqli_fetch_array($query))
            { echo '<div class="jumbotron">';
              echo '<div align="left">';
              echo '<p>'."<strong>Scientific Name: </strong>".'<i><a href="?inv_sci_name='.$row["inv_sci_name"] .'">' . $row["inv_sci_name"] . '</i></a></p>';
              echo "<p>"."<strong>Common Name: </strong>".$row["inv_com_name"] . '</p>';    
              $image = $row["thumbnail"];              
              $path = "images/";
              echo '<img src="'.$path.''.$image.'" width="200" />';
              echo '</div>';
              echo '</div>';
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
      //
      // ------------------------ Looking at All Plants -----------------------------------
      //
        $sql = $sql = "SELECT * FROM `e_invasive_species` LIMIT 10";
        $query = mysqli_query($conn, $sql);

        if($query->num_rows > 0)
        {
          while ($row = mysqli_fetch_array($query))
          { echo '<div class="jumbotron">';
            echo '<div align="left">';
            echo '<p>'."<strong>Scientific Name: </strong>".'<i><a href="?inv_sci_name='.$row["inv_sci_name"] .'">' . $row["inv_sci_name"] . '</i></a></p>';
            echo "<p>"."<strong>Common Name: </strong>".$row["inv_com_name"] . '</p>';    
            $image = $row["thumbnail"];              
            $path = "images/";
            echo '<img src="'.$path.''.$image.'" width="200" />';
            echo '</div>';
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
