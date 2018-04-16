<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/starter-template.css" rel="stylesheet">
  </head>

  <body>
  <body background="../images/background.jpeg">
	  <?php include_once "header.php"; ?>


    <main role="main" class="container">

    <div class="starter-template">
    <?php
	        
      // ================================ CONNECTION =====================================
      include_once "../php/commons.php";

      $conn = get_mysqli_localhost();
      if ($conn->connect_error) {
        die("Connection Error: (" . $conn->connect_errno . ")");
      }	

    // ===================== DETECTS THE DELTE BUTTON BEING PRESSED ======================
    
    
	  if(isset($_POST['KILLPATH'])) 
		{
      // DELETES PLANT
			$inv_sci_name = $_GET['inv_sci_name'];
			$sqld = "DELETE FROM `e_invasive_species`
					WHERE inv_sci_name = '$inv_sci_name'";
			$query = mysqli_query($conn, $sqld);
				echo mysqli_error($conn);
				header("Location: index.php");
				exit;           

    }

    // =====================================================================================            
      
      
      
      // ================================ FUNCTIONS ======================================
       
      if (isset($_POST['UPDATPATH']))
      {
        $sciname = $_GET['inv_sci_name'];
        
          // ====================== CHECK FOR AQUATIC =======================
          if (isset($_POST['aquatic_or_not']))
          {
            $aquatic = mysqli_real_escape_string($conn, $_REQUEST['aquatic_or_not']);
            $sql = "UPDATE e_invasive_species SET aquatic = '$aquatic'
                    WHERE inv_sci_name = '$sciname'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                                     
          }      
          
          
          // ====================== CHECK FOR CONCERN =======================         
          if (isset($_POST['concern']) && mysqli_real_escape_string($conn, $_REQUEST['concern']) != "")
          {       
            $concern = mysqli_real_escape_string($conn, $_REQUEST['concern']);
            $sql = "UPDATE e_invasive_species SET concern = '$concern'
                    WHERE inv_sci_name = '$sciname'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                                     
          }
           
          
          // ==================== CHECK FOR COMMON NAME ======================         
          if (isset($_POST['inv_com_name']) && mysqli_real_escape_string($conn, $_REQUEST['inv_com_name']) != "")
          {        
            $inv_com_name = mysqli_real_escape_string($conn, $_REQUEST['inv_com_name']);
            $sql = "UPDATE e_invasive_species SET inv_com_name = '$inv_com_name'
                    WHERE inv_sci_name = '$sciname'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                                     
          }         
                 
                 
          // ====================== CHECK DESCRIPTION ========================         

          
          
          // *********************** COMPLETE THIS ***************************

          
          
          // ====================== CHECK REFERENCES =========================         
          if (isset($_POST['inv_ref']) && mysqli_real_escape_string($conn, $_REQUEST['inv_ref']) != "")
          {        
            $inv_ref = mysqli_real_escape_string($conn, $_REQUEST['inv_ref']);
            $sql = "UPDATE e_invasive_species SET inv_ref = '$inv_ref'
                    WHERE inv_sci_name = '$sciname'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                                     
          }                
           
           
          // ====================== CHECK MANAGEMENT =========================         
          if (isset($_POST['management']) && mysqli_real_escape_string($conn, $_REQUEST['management']) != "")
          {        
            $management = mysqli_real_escape_string($conn, $_REQUEST['management']);
            $sql = "UPDATE e_invasive_species SET management = '$management'
                    WHERE inv_sci_name = '$sciname'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                                     
          }            
           
           
          // ======================= CHECK THUMBNAIL =========================         
          if (isset($_POST['thumbnail']) && mysqli_real_escape_string($conn, $_REQUEST['thumbnail']) != "")
          {        
            $thumbnail = mysqli_real_escape_string($conn, $_REQUEST['thumbnail']);
            $sql = "UPDATE e_invasive_species SET thumbnail = '$thumbnail'
                    WHERE inv_sci_name = '$sciname'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                                   
          }        
          

  // ***********************************************************************
  //                         IF A PATHOGEN IS BEING ADDED
  // ***********************************************************************        
           
            // ======================= CHECK HABITAT ========================         
            if (isset($_POST['habitat']) && mysqli_real_escape_string($conn, $_REQUEST['habitat']) != "")
            {        
              $habitat = mysqli_real_escape_string($conn, $_REQUEST['habitat']);
              $sql = "UPDATE e_animals SET habitat = '$habitat'
                      WHERE inv_sci_name = '$sciname'";   

              // UPDATE THE DB
              if ($conn->query($sql) == FALSE)
              {
                  echo "<br>Error: " . $sql . "<br>" . $conn->error;
              }                                     
            }
            
            
            // ===================== CHECK LIFE SPAN ========================         
            if (isset($_POST['life_span']) && mysqli_real_escape_string($conn, $_REQUEST['life_span']) != "")
            {        
              $life_span = mysqli_real_escape_string($conn, $_REQUEST['life_span']);
              $sql = "UPDATE e_animals SET life_span = '$life_span'
                      WHERE inv_sci_name = '$sciname'";   

              // UPDATE THE DB
              if ($conn->query($sql) == FALSE)
              {
                  echo "<br>Error: " . $sql . "<br>" . $conn->error;
              }                                     
            }          
            
            
            // =================== CHECK REPRODUCTION ========================         
            if (isset($_POST['reproduction']) && mysqli_real_escape_string($conn, $_REQUEST['reproduction']) != "")
            {        
              $reproduction = mysqli_real_escape_string($conn, $_REQUEST['reproduction']);
              $sql = "UPDATE e_animals SET reproduction = '$reproduction'
                      WHERE inv_sci_name = '$sciname'";   

              // UPDATE THE DB
              if ($conn->query($sql) == FALSE)
              {
                  echo "<br>Error: " . $sql . "<br>" . $conn->error;
              }                                     
            }            

            
            // ===================== CHECK SUBPHYLUM ==========================         
            if (isset($_POST['subphylum']) && mysqli_real_escape_string($conn, $_REQUEST['subphylum']) != "")
            {        
              $subphylum = mysqli_real_escape_string($conn, $_REQUEST['subphylum']);
              $sql = "UPDATE e_animals SET subphylum = '$subphylum'
                      WHERE inv_sci_name = '$sciname'";   

              // UPDATE THE DB
              if ($conn->query($sql) == FALSE)
              {
                  echo "<br>Error: " . $sql . "<br>" . $conn->error;
              }                                     
            }              
         
            // ================= CHECK NAME ====================         
            if (isset($_POST['inv_sci_name']) && mysqli_real_escape_string($conn, $_REQUEST['inv_sci_name']) != "")
            {        
              $inv_sci_name = mysqli_real_escape_string($conn, $_REQUEST['inv_sci_name']);
              $sql = "UPDATE e_invasive_species SET inv_sci_name = '$inv_sci_name'
                      WHERE inv_sci_name = '$sciname'";   

              // UPDATE THE DB
              if ($conn->query($sql) == FALSE)
              {
                  echo "<br>Error: " . $sql . "<br>" . $conn->error;
              }                          
            } 
            
            echo "<br>Animal record updated successfully!";            
      }          
        
        

        

      function randallrelevant($conn, $plant_id)
      {
        // print out all plant information
        // print out all animal information
        $sql3 = "SELECT *"

            . "FROM `e_animals`\n"
                        
            . "    WHERE `e_animals`.`inv_sci_name` ='$plant_id'";           

            $query = mysqli_query($conn, $sql3);
            $row = mysqli_fetch_assoc($query);  
            $result = $conn->query($sql3);             
            if ($result->num_rows > 0)
              {
                if (isset($_SESSION["user"])) {
                  echo '<br><br>';
                  echo "<p>" ."<strong>Type: </strong>";
                  echo '<input name="subphylum" value="'.$row["subphylum"] . '" style="width: 100%;"><br><br>';
                  echo "<p>" ."<strong>Life Span: </strong>";
                  echo '<input name="life_span" value="'.$row["life_span"] . '" style="width: 100%;"><br><br>';                
                  echo "<p>" ."<strong>Reproduction: </strong>";
                  echo '<input name="reproduction" value="'.$row["reproduction"] . '" style="width: 100%;"><br><br>';
                  echo "<p>" ."<strong>Habitat: </strong>";
                  echo '<input name="habitat" value="'.$row["habitat"] . '" style="width: 100%;"><br><br>';                
                } else {       
                  echo "<p>" ."<strong>Type: </strong>". $row["subphylum"] . '</p>';    
                  echo "<p>" ."<strong>Life Span: </strong>". $row["life_span"] . '</p>';   
                  echo "<p>" ."<strong>Reproduction: </strong>". $row["reproduction"] . '</p>';    
                  echo "<p>" ."<strong>Habitat: </strong>". $row["habitat"] . '</p>';            
                }
              }
      }
             
      //
      // -------------------------- Clicking on a Animal ----------------------------------
      //
      if (isset($_GET['inv_sci_name']))
      {
        // If user is logged in, produce an editable information page
        if(isset($_SESSION["user"])) 
        {
          echo '<div class="jumbotron">';
            echo '<form class="edit-info" method="post" action="" id="edit-info">';
            // get scientific name
            $inv_sci_name = mysqli_real_escape_string($conn, $_GET['inv_sci_name']);

            // Get info of invasive specieis using scientific name
            $sql = "SELECT `e_invasive_species`.*, `r_who_can_help`.*,
                                `r_spread_by`.*, `r_legal_status`.*\n"

                . "FROM `e_invasive_species`\n"

                . "    LEFT JOIN `r_who_can_help` ON `r_who_can_help`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"

                . "    LEFT JOIN `r_spread_by` ON `r_spread_by`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"

                . "    LEFT JOIN `r_legal_status` ON `r_legal_status`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"        

                . "    WHERE `e_invasive_species`.`inv_sci_name` ='$inv_sci_name'";            

            
            $query = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($query);
            echo '<div align="left">';
            echo '<p><strong>Scientific Name: </strong></p>';              
            echo '<input name="inv_sci_name" value="'.$row["inv_sci_name"].'" style="width: 100%"><br><br>';    
            echo '<p><strong>Common Name: </strong></p>';
            echo '<input name="inv_com_name" value="'.$row["inv_com_name"].'" style="width: 100%"><br><br>';              
            echo "<p>" . $row["inv_desc"] . '</p>';
            echo '<br><br>';
            echo "<p><strong>Aquatic: </strong></p>";
            echo '<input name="aquatic_or_not" value="'.$row["aquatic"] .'" style="width: 100%;">';
            echo '<br><br>';            
            echo '<p><strong>Concern: </strong></p>';
            echo '<input name="concern" value="'.$row["concern"].'" style="width: 100%;">';
            echo '<br><br>';            
            echo "<p>" ."<strong>Spread By: </strong>". $row["dist_type"] .".". '</p>'; 
            echo '<p><strong>Management: </strong></p>';
            echo '<textarea name="management" row="5" style="width: 100%;">'.$row["management"].'</textarea>';
            randallrelevant($conn, $row["inv_sci_name"]);           
            echo "<p>" ."<strong>Legal Status: </strong>". $row["inv_status"] .".". '</p>';     
            echo "<p>" ."<strong>Who Can Help: </strong>". $row["agency_name"] .".". '</p>';
            echo '<p><strong>References: </strong></p>';
            echo '<input name="inv_ref" value="'. $row["inv_ref"] . '" style="width: 100%;"><br>';            
            echo '</div>';
            echo '<br><br>';
            echo '<button class="btn btn-lg btn-primary btn-block" name="UPDATPATH" type="submit"> Confirm Edits</button>';  
            echo '<br>';
            echo '<button class="btn btn-danger" name="KILLPATH" type="submit">Delete</button>';
            echo '</form>';
          echo '</div>';
		
        } else {
          $inv_sci_name = mysqli_real_escape_string($conn, $_GET['inv_sci_name']);
        
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
          echo '</div>';   
        }
  
      }
      else
      {
      //
      // ------------------------ Looking at All Animals ---------------------------------
      //
        $sql1 = "SELECT `e_animals`.*, `e_invasive_species`.*\n"

            . "FROM `e_animals`\n"

            . "    LEFT JOIN `e_invasive_species` ON `e_invasive_species`.`inv_sci_name` = `e_animals`.`inv_sci_name`\n";
            
    
        $query = mysqli_query($conn, $sql1);

        if($query->num_rows > 0)
        {
          echo '<div align="center">';
          echo '<div class="jumbotron">';
          echo "<strong>"."Your search returned ".$query->num_rows." results."."</strong>";
          echo '</div>';
          echo '</div>';
          while ($row = mysqli_fetch_array($query))
          { echo '<div class="jumbotron">';
            echo '<div align="left">';
            echo '<p>'."<strong>Scientific Name: </strong>".'<i><a href="?inv_sci_name='.$row["inv_sci_name"] .'">' . $row["inv_sci_name"] . '</i></a></p>';
            echo "<p>"."<strong>Common Name: </strong>".$row["inv_com_name"] . '</p>';
            $image = $row["thumbnail"];              
            $path = "../images/";
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
