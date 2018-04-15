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

      // ================================ FUNCTIONS ======================================
      
      // var_dump($_POST);
	  
	  	  
	  if(isset($_POST['Go'])) 
		{
			$sciname = $_GET['inv_sci_name'];
			$sqld = "DELETE FROM `e_invasive_species`
					WHERE inv_sci_name = '$sciname'";
			$query = mysqli_query($conn, $sqld);
				echo mysqli_error($conn);
				header("Location: index.php");
				exit;
				
		}

      if (isset($_POST['leaf_desc']) && isset($_POST['rootdesc']) && isset($_POST['common_name']) && isset($_POST['concern']) && isset($_POST['management']) && isset($_POST['references']) && isset($_POST['flowerdesc']) && isset($_POST['stemdesc']) && isset($_POST['seeddesc']) && isset($_POST['simspec']))
      {
        $sciname = $_GET['inv_sci_name'];
        $common_name = mysqli_real_escape_string($conn, $_REQUEST['common_name']);
        $aquatic_or_not = mysqli_real_escape_string($conn, $_REQUEST['aquatic_or_not']);

        if ($aquatic_or_not === "No")
        {
            $aquatic_or_not = FALSE;
        }
        else
        {
            $aquatic_or_not = TRUE;
        }
        $concern = mysqli_real_escape_string($conn, $_REQUEST['concern']);
        $management = mysqli_real_escape_string($conn, $_REQUEST['management']);
        $references = mysqli_real_escape_string($conn, $_REQUEST['references']);
        $flowerdesc = mysqli_real_escape_string($conn, $_REQUEST['flowerdesc']);
        $stemdesc = mysqli_real_escape_string($conn, $_REQUEST['stemdesc']);
        $leafdesc = mysqli_real_escape_string($conn, $_REQUEST['leaf_desc']);
        $seeddesc = mysqli_real_escape_string($conn, $_REQUEST['seeddesc']);
        $simspec = mysqli_real_escape_string($conn, $_REQUEST['simspec']);
        $rootdesc = mysqli_real_escape_string($conn, $_REQUEST['rootdesc']);
        $leaf_desc = mysqli_real_escape_string($conn, $_REQUEST['leaf_desc']);
        $sql = "UPDATE e_invasive_species SET inv_com_name = '$common_name', concern = '$concern', management = '$management', inv_ref = '$references'
                WHERE inv_sci_name = '$sciname'";
        if ($conn->query($sql) === TRUE) {
            echo "Successfully Updated";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $sql = "UPDATE e_plants SET root_desc='$rootdesc', seed_desc='$seeddesc', leaf_desc='$leaf_desc', flower_desc='$flowerdesc', stem_desc='$stemdesc', similar_species='$simspec'
                WHERE inv_sci_name = '$sciname'";
        echo mysqli_error($conn);
        if ($conn->query($sql) === TRUE) {
            echo "Successfully updated!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }


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
                if (isset($_SESSION["user"])) {
                  echo "<p><strong>Life Cycle: </strong></p>";    
                  echo '<input name="life_cycle" value="'.$row["lc_type"] . '" style="width: 100%;"><br><br>';
                  echo "<p><strong>Flower Description: </strong></p>";      
                  echo '<textarea name="flowerdesc" row=5 style="width:100%;">'.$row["flower_desc"].'</textarea><br><br>';
                  echo "<p><strong>Leaf Description: </strong></p>"; 
                  echo '<textarea row=5 name="leaf_desc" style="width:100%;">'.$row["leaf_desc"].'</textarea><br><br>';
                  echo "<p><strong>Stem Description: </strong></p>";     
                  echo '<textarea row=5 name="stemdesc" style="width:100%;">'.$row["stem_desc"].'</textarea><br><br>';
                  echo "<p><strong>Root Description: </strong></p>";     
                  echo '<textarea row=5 name="rootdesc" style="width:100%;">'.$row["root_desc"].'</textarea><br><br>';
                  echo "<p><strong>Seed Description: </strong></p>";
                  echo '<textarea row=5 name="seeddesc" style="width:100%;">'.$row["seed_desc"].'</textarea><br><br>';
                  echo "<p><strong>Similar Species: </strong></p>";            
                  echo '<input name="simspec" value="'.$row["similar_species"].'" style="width:100%;"><br><br>';
                } else {       
                  echo "<p>" ."<strong>Life Cycle: </strong>". $row["lc_type"] .".". '</p>';    
                  echo "<p>" ."<strong>Flower Description: </strong>". $row["flower_desc"]. '</p>';      
                  echo "<p>" ."<strong>Leaf Description: </strong>". $row["leaf_desc"]. '</p>'; 
                  echo "<p>" ."<strong>Stem Description: </strong>". $row["stem_desc"]. '</p>';     
                  echo "<p>" ."<strong>Root Description: </strong>". $row["root_desc"]. '</p>';     
                  echo "<p>" ."<strong>Seed Description: </strong>". $row["seed_desc"]. '</p>';
                  echo "<p>" ."<strong>Similar Species: </strong>". $row["similar_species"]. '</p>';            
                }
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
      
      // =============================== Edit Function ===================================    
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
      // ================================ Returning ========================================
       
      //
      // -------------------------- Clicking on a Plant ----------------------------------
      //
      elseif (isset($_GET['inv_sci_name']))
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
              // LOOKING AT A PARTICULAR PLANT
              echo '<div align="left">';
                echo '<p><strong>Scientific Name: </strong><i>'.$row["inv_sci_name"]. '</i></p>';
                echo '<p><strong>Common Name: </strong></p>';
                echo '<input name="common_name" value="'.$row["inv_com_name"].'" style="width: 100%"><br><br>';              
                echo "<p>" . $row["inv_desc"] . '</p>'; 
                echo "<p><strong>Aquatic: </strong></p>";
                echo '<input name="aquatic_or_not" value="'.$row["aquatic"] .'" style="width: 100%;">';    
                echo '<p><strong>Concern: </strong></p>';
                echo '<input name="concern" value="'.$row["concern"].'" style="width: 100%;">';      
                echo '<p><strong>Spread By: </strong></p>';
                echo '<input name="spread_by" value="'.$row["dist_type"].'" style="width: 100%;">'; 
                echo '<p><strong>Management: </strong></p>';
                echo '<textarea name="management" row="5" style="width: 100%;">'.$row["management"].'</textarea>';
                randallrelevant($conn, $row["inv_sci_name"]);           
                echo '<p><strong>Legal Status: </strong></p>';
                echo '<input name="legal_status" value="'. $row["inv_status"]. '" style="width: 100%;"><br><br>';     
                echo '<p><strong>Who Can Help: </strong></p>';
                echo '<input name="who_can_help" value="'. $row["agency_name"] .'" style="width: 100%;"><br><br>';
                echo '<p><strong>References: </strong></p>';
                echo '<input name="references" value="'. $row["inv_ref"] . '" style="width: 100%;"><br>';            
              echo '</div>';
              echo '<br><br>';
              echo '<button class="btn btn-lg btn-primary btn-block" type="submit"> Confirm Edits</button>';
          //  echo '</form>';
          //echo '</div>';   //nates     
			echo '<br>';
			echo '<button class="btn btn-danger" name="Go" type="submit">Delete</button>';
			//echo '<input type="submit" name="Go" value="Delete" />';
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
      //
      // --------------------------- Querying a Plant ------------------------------------
      //
      elseif(isset($_POST['submit']))
      {
        if (isset($_REQUEST['input'])) 
        {

          $input = mysqli_real_escape_string($conn, $_REQUEST['input']);
          $sql = "SELECT * FROM `e_invasive_species` WHERE `inv_sci_name` LIKE '%".$input."%'";
          $query = mysqli_query($conn, $sql);

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
        $sql = "SELECT * FROM `e_invasive_species`";
        $query = mysqli_query($conn, $sql);

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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </body>
</html>
