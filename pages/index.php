<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta  http-equiv="Content-Type" content="text/html;  charset=iso-8859-1">

    <title>Invasive Species DataBase</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/starter-template.css" rel="stylesheet">
  </head>
  
  

  
  
  <div class="jumbotron">
  <div align="center">
  <img src="../images/ID_GUIDE_LOGO.png"/>

  <p><body>
    <h3>Search </h3>
  <p></p>  
  <form action="index.php" method="post" >
     <input  type="text" name="input"><body>&nbsp;&nbsp;&nbsp;&nbsp;</body>
     <select name="drop">
      <option value="">Select...</option>
      <option value="e_agency">Agency</option>     
      <option value="e_animals">Animal</option>	  
      <option value="e_distribution_method">Distribution Method</option>	
      <option value="e_family">Family</option>	 
      <option value="e_impacted_species">Impacted Species</option>
      <option value="e_invasive_species">Invasive Species</option>
      <option value="e_invasive_status">Invasive Status</option>   
      <option value="e_life_cycle">Life Cycle</option>
      <option value="e_plants">Plants</option>
      <option value="e_pathogens">Pathogen</option>
    </select> 
    <body>&nbsp;&nbsp;&nbsp;&nbsp;</body>
    <input type="submit" name="Go" value="Submit Query" />
  </form>  
  </div>
  </div>
  
  
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
	  if(isset($_POST['KILLAGENCY'])) 
		{
      // DELETES AGENCY
			$agency_name = $_GET['agency_name'];
			$sqld = "DELETE FROM `e_agency`
					WHERE agency_name = '$agency_name'";
			$query = mysqli_query($conn, $sqld);
				echo mysqli_error($conn);
				header("Location: index.php");
				exit;           

    }
    elseif(isset($_POST['KILLDISTRIBUTION'])) 
    {    
      // DELETES DISTRIBUTION
			$distribution = $_GET['distribution'];
			$sqld = "DELETE FROM `e_distribution_method`
					WHERE dist_type = '$distribution'";
			$query = mysqli_query($conn, $sqld);
				echo mysqli_error($conn);
				header("Location: index.php");
				exit;           
    }
    elseif(isset($_POST['KILLFAMILY'])) 
    {
    // DELETES FAMILY
    $family = $_GET['family'];
    $sqld = "DELETE FROM `e_family`
        WHERE family_name = '$family'";
    $query = mysqli_query($conn, $sqld);
      echo mysqli_error($conn);
      header("Location: index.php");
      exit;           
    }
    
     elseif(isset($_POST['KILLIMPACTED'])) 
    {
      // DELETES IMPACTED SPECIES
			$impacted = $_GET['impacted'];
			$sqld = "DELETE FROM `e_impacted_species`
					WHERE imp_sci_name = '$impacted'";
			$query = mysqli_query($conn, $sqld);
				echo mysqli_error($conn);
				header("Location: index.php");
				exit;             
    }   
    
     elseif(isset($_POST['KILLSTATUS'])) 
    {
      // DELETES STATUS
			$status = $_GET['status'];
			$sqld = "DELETE FROM `e_invasive_status`
					WHERE inv_status = '$status'";
			$query = mysqli_query($conn, $sqld);
				echo mysqli_error($conn);
				header("Location: index.php");
				exit;     
    }       
    
     elseif(isset($_POST['KILLCYCLE'])) 
    {
      // DELETES LIFE CYCLE
			$cycle = $_GET['cycle'];
			$sqld = "DELETE FROM `e_life_cycle`
					WHERE lc_type = '$cycle'";
			$query = mysqli_query($conn, $sqld);
				echo mysqli_error($conn);
				header("Location: index.php");
				exit;    
    }        

    // =====================================================================================      
      
      
      
      
 
    // ======================== DETECTS THE EDIT BUTTON BEING PRESSED ======================
    
    
      if (isset($_POST['AGENCY']))
      {   
          $name = $_GET['agency_name'];    
          // ================== CHECK FOR WEBSITE ======================  
          if (isset($_POST['website']) && mysqli_real_escape_string($conn, $_REQUEST['website']) != "")
          {        
            $website = mysqli_real_escape_string($conn, $_REQUEST['website']);
            $sql = "UPDATE e_agency SET website = '$website'
                    WHERE agency_name = '$name'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          }
      
          // ============== CHECK FOR JURISDICTION ======================  
          if (isset($_POST['jurisdiction']) && mysqli_real_escape_string($conn, $_REQUEST['jurisdiction']) != "")
          {        
            $jurisdiction = mysqli_real_escape_string($conn, $_REQUEST['jurisdiction']);
            $sql = "UPDATE e_agency SET jurisdiction = '$jurisdiction'
                    WHERE agency_name = '$name'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          }    

          // ================== CHECK FOR NAME ======================  
          if (isset($_POST['agency_name']) && mysqli_real_escape_string($conn, $_REQUEST['agency_name']) != "")
          { 
            $agency_name = mysqli_real_escape_string($conn, $_REQUEST['agency_name']);        
            $sql = "UPDATE e_agency SET agency_name = '$agency_name'
                    WHERE agency_name = '$name'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          }    
            echo "<br>Agency record updated successfully!";           
      }
      
      
      
      if (isset($_POST['DISTRIBUTION']))
      {   
          $type = $_GET['distribution'];    
          // ================ CHECK FOR DESCRIPTION ======================  
          if (isset($_POST['dist_desc']) && mysqli_real_escape_string($conn, $_REQUEST['dist_desc']) != "")
          {        
            $dist_desc = mysqli_real_escape_string($conn, $_REQUEST['dist_desc']);
            $sql = "UPDATE e_distribution_method SET dist_desc = '$dist_desc'
                    WHERE dist_type = '$type'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          }      
      
          // ================ CHECK FOR PREVENTATIVE ======================  
          if (isset($_POST['prev_measures']) && mysqli_real_escape_string($conn, $_REQUEST['prev_measures']) != "")
          {        
            $prev_measures = mysqli_real_escape_string($conn, $_REQUEST['prev_measures']);
            $sql = "UPDATE e_distribution_method SET prev_measures = '$prev_measures'
                    WHERE dist_type = '$type'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          } 
          // ================ CHECK FOR NAME ======================  
          if (isset($_POST['dist_type']) && mysqli_real_escape_string($conn, $_REQUEST['dist_type']) != "")
          {        
            $dist_type = mysqli_real_escape_string($conn, $_REQUEST['dist_type']);
            $sql = "UPDATE e_distribution_method SET dist_type = '$dist_type'
                    WHERE dist_type = '$type'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          } 

          
          echo "<br>Distribution Method record updated successfully!";           
      }      
 

      if (isset($_POST['FAMILY']))
      {   
          $name = $_GET['family'];    
           // ================= CHECK FOR DESCRIPTION ====================  
          if (isset($_POST['family_desc']) && mysqli_real_escape_string($conn, $_REQUEST['family_desc']) != "")
          {        
           $family_desc = mysqli_real_escape_string($conn, $_REQUEST['family_desc']);
            $sql = "UPDATE e_family SET family_desc = '$family_desc'
                    WHERE family_name = '$name'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          } 
          // ================= CHECK FOR NAME ====================  
          if (isset($_POST['family_name']) && mysqli_real_escape_string($conn, $_REQUEST['family_name']) != "")
          {        
           $family_name = mysqli_real_escape_string($conn, $_REQUEST['family_name']);
            $sql = "UPDATE e_family SET family_name = '$family_name'
                    WHERE family_name = '$name'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          }           
          
          echo "<br>Family record updated successfully!";
      }  
 
 
 
      if (isset($_POST['IMPACTED']))
      {   
          $sname = $_GET['impacted'];    
           // ================== CHECK FOR COMMON NAME ====================  
          if (isset($_POST['imp_com_name']) && mysqli_real_escape_string($conn, $_REQUEST['imp_com_name']) != "")
          {        
            $imp_com_name = mysqli_real_escape_string($conn, $_REQUEST['imp_com_name']);
            $sql = "UPDATE e_impacted_species SET imp_com_name = '$imp_com_name'
                    WHERE imp_sci_name = '$sname'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          }      
        

           // ================== CHECK FOR DESCRIPTION ====================  
          if (isset($_POST['imp_desc']) && mysqli_real_escape_string($conn, $_REQUEST['imp_desc']) != "")
          {        
            $imp_desc = mysqli_real_escape_string($conn, $_REQUEST['imp_desc']);
            $sql = "UPDATE e_impacted_species SET imp_desc = '$imp_desc'
                    WHERE imp_sci_name = '$sname'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          }      
          
            // ================== CHECK FOR NAME ====================  
          if (isset($_POST['imp_sci_name']) && mysqli_real_escape_string($conn, $_REQUEST['imp_sci_name']) != "")
          {        
            $imp_sci_name = mysqli_real_escape_string($conn, $_REQUEST['imp_sci_name']);
            $sql = "UPDATE e_impacted_species SET imp_sci_name = '$imp_sci_name'
                    WHERE imp_sci_name = '$sname'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          }             
          
          
            echo "<br>Impacted Species record updated successfully!";     
      }  

      
      
      if (isset($_POST['STATUS']))
      {   
          $type = $_GET['status'];    
          // ================ CHECK FOR DESCRIPTION ======================  
          if (isset($_POST['status_desc']) && mysqli_real_escape_string($conn, $_REQUEST['status_desc']) != "")
          {        
            $status_desc = mysqli_real_escape_string($conn, $_REQUEST['status_desc']);
            $sql = "UPDATE e_invasive_status SET status_desc = '$status_desc'
                    WHERE inv_status = '$type'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          }
 
          // ================ CHECK FOR ACT NUMBER ======================  
          if (isset($_POST['legal_act_num']) && mysqli_real_escape_string($conn, $_REQUEST['legal_act_num']) != "")
          {        
            $legal_act_num = mysqli_real_escape_string($conn, $_REQUEST['legal_act_num']);
            $sql = "UPDATE e_invasive_status SET legal_act_num = '$legal_act_num'
                    WHERE inv_status = '$type'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          } 

          // ================ CHECK FOR STATUS ======================  
          if (isset($_POST['inv_status']) && mysqli_real_escape_string($conn, $_REQUEST['inv_status']) != "")
          {        
            $inv_status = mysqli_real_escape_string($conn, $_REQUEST['inv_status']);
            $sql = "UPDATE e_invasive_status SET inv_status = '$inv_status'
                    WHERE inv_status = '$type'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          }     
      
          echo "<br>Invasive Status record updated successfully!";   
      }        
      
      
      
      if (isset($_POST['CYCLE']))
      {   
          $type = $_GET['cycle'];    
          // ================= CHECK FOR DESCRIPTION ====================  
          if (isset($_POST['lc_desc']) && mysqli_real_escape_string($conn, $_REQUEST['lc_desc']) != "")
          {        
            $lc_desc = mysqli_real_escape_string($conn, $_REQUEST['lc_desc']);
            $sql = "UPDATE e_life_cycle SET lc_desc = '$lc_desc'
                    WHERE lc_type = '$type'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          } 
          
          // ================= CHECK FOR IMPLICATION ====================  
          if (isset($_POST['implication']) && mysqli_real_escape_string($conn, $_REQUEST['implication']) != "")
          {        
            $implication = mysqli_real_escape_string($conn, $_REQUEST['implication']);
            $sql = "UPDATE e_life_cycle SET implication = '$implication'
                    WHERE lc_type = '$type'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          }       

          // ================= CHECK FOR TYPE ====================  
          if (isset($_POST['lc_type']) && mysqli_real_escape_string($conn, $_REQUEST['lc_type']) != "")
          {        
            $lc_type = mysqli_real_escape_string($conn, $_REQUEST['lc_type']);
            $sql = "UPDATE e_life_cycle SET lc_type = '$lc_type'
                    WHERE lc_type = '$type'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          }      
          
          echo "<br>Life Cycle record updated successfully!";  
          
      }        
      
      
    // =====================================================================================  


 
    // ============================ DETECTS CLICKING ON A LINK =============================    
 
      //
      // -------------------------- Clicking on a Agency ----------------------------------
      //
      if (isset($_GET['agency_name']))
      {       
        $agency_name = mysqli_real_escape_string($conn, $_GET['agency_name']);
        //$sql = $sql = "SELECT * FROM `e_invasive_species` WHERE `inv_sci_name`='$inv_sci_name'";
        
        $sql = "SELECT *"

            . "FROM `e_agency`\n"
            
            . "    WHERE `e_agency`.`agency_name` ='$agency_name'";            

        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);
        echo '<div class="jumbotron">';
        echo '<div align="left">';       
        
        // LOOKING AT AN AGENCY AS AN ADMIN
        // HAVING THE REDIRECT FOR AGENCY IN INVASIVE SPECIES WON'T LET YOU MOVE BACK A PAGE - WE MIGHT WANT TO PUT THIS SOMEWHERE ELSE
        // ****NOTE: I WAS ABLE TO GET DELETE WORKING, I DON'T UNDERSTAND HOW NATE IMPLEMENTED EDIT FOR PLANTS ABOVE.
        if(isset($_SESSION["user"])) 
        {
     
          echo '<form class="edit-info" method="post" action="" id="edit-info">';          
          echo '<p><strong>Agency Name: </strong></p>';
          echo '<input name="agency_name" value="'.$row["agency_name"].'" style="width: 100%"><br><br>';           
          echo '<p><strong>Website: </strong></p>';
          echo '<input name="website" value="'.$row["website"].'" style="width: 100%"><br><br>';          
          echo '<p><strong>Jurisdiction: </strong></p>';
          echo '<input name="jurisdiction" value="'.$row["jurisdiction"].'" style="width: 100%"><br><br>';             
  
          echo '<br><br>';
          echo '<button class="btn btn-lg btn-primary btn-block" name="AGENCY" type="submit"> Confirm Edits</button>';
          echo '<br>';
          echo '<button class="btn btn-danger" name="KILLAGENCY" type="submit">Delete</button>';
          echo '</form>';
      
        }
        else
        {
          // LOOKING AT AN AGENCY AS AS A REGULAR USER
          
          echo "<p><strong><u>".$row["agency_name"].'</u></strong></p>';
          echo "<p>" ."<strong>Jurisdiction: </strong>". $row["jurisdiction"] . '</p>';       
          echo "<p>" ."<strong>Website: </strong>". $row["website"] . '</p>';                                   
        }
        echo '</div>';
        echo '</div>';
      }         
      

      
      
      //
      // -------------------------- Clicking on a Distribution Type ------------------------------
      //
      elseif (isset($_GET['distribution']))
      {       
        $dist_type = mysqli_real_escape_string($conn, $_GET['distribution']);
        
        $sql = "SELECT *"

            . "FROM `e_distribution_method`\n"
            
            . "    WHERE `e_distribution_method`.`dist_type` ='$dist_type'";            

        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);
        echo '<div class="jumbotron">';
        echo '<div align="left">';       
        
        // LOOKING AT AN DISTRIBUTION AS AN ADMIN
        // HAVING THE REDIRECT WON'T LET YOU MOVE BACK A PAGE - WE MIGHT WANT TO PUT THIS SOMEWHERE ELSE
        // ****NOTE: I WAS ABLE TO GET DELETE WORKING, I DON'T UNDERSTAND HOW NATE IMPLEMENTED EDIT FOR PLANTS ABOVE.
        if(isset($_SESSION["user"])) 
        {
     
          echo '<form class="edit-info" method="post" action="" id="edit-info">';          
          echo '<p><strong>Distribution Type: </strong></p>'; 
          echo '<input name="dist_type" value="'.$row["dist_type"].'" style="width: 100%"><br><br>';            
          echo '<p><strong>Description: </strong></p>';
          echo '<input name="dist_desc" value="'.$row["dist_desc"].'" style="width: 100%"><br><br>';          
          echo '<p><strong>Preventative Measures: </strong></p>';
          echo '<input name="prev_measures" value="'.$row["prev_measures"].'" style="width: 100%"><br><br>';             
  
          echo '<br><br>';
          echo '<button class="btn btn-lg btn-primary btn-block" name="DISTRIBUTION" type="submit"> Confirm Edits</button>';
          echo '<br>';
          echo '<button class="btn btn-danger" name="KILLDISTRIBUTION" type="submit">Delete</button>';
          echo '</form>';
      
        }
        else
        {
          // LOOKING AT AN DISTRIBUTION AS AS A REGULAR USER
          
          echo "<p><strong><u>".$row["dist_type"].'</u></strong></p>';
          echo "<p>" ."<strong>Description: </strong>". $row["dist_desc"] . '</p>';       
          echo "<p>" ."<strong>Preventative Measures: </strong>". $row["prev_measures"] . '</p>';                                   
        }
        echo '</div>';
        echo '</div>';
      }      
      
      //
      // -------------------------- Clicking on a Family ------------------------------
      //
      elseif (isset($_GET['family']))
      {       
        $family = mysqli_real_escape_string($conn, $_GET['family']);
        
        $sql = "SELECT *"

            . "FROM `e_family`\n"
            
            . "    WHERE `e_family`.`family_name` ='$family'";            

        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);
        echo '<div class="jumbotron">';
        echo '<div align="left">';       
        
        // LOOKING AT FAMILY AS AN ADMIN
        // HAVING THE REDIRECT WON'T LET YOU MOVE BACK A PAGE - WE MIGHT WANT TO PUT THIS SOMEWHERE ELSE
        // ****NOTE: I WAS ABLE TO GET DELETE WORKING, I DON'T UNDERSTAND HOW NATE IMPLEMENTED EDIT FOR PLANTS ABOVE.
        if(isset($_SESSION["user"])) 
        {
     
          echo '<form class="edit-info" method="post" action="" id="edit-info">';                 
          echo '<p><strong>Name: </strong></p>';
          echo '<input name="family_name" value="'.$row["family_name"].'" style="width: 100%"><br><br>';          
          echo '<p><strong>Description: </strong></p>';
          echo '<input name="family_desc" value="'.$row["family_desc"].'" style="width: 100%"><br><br>';             
  
          echo '<br><br>';
          echo '<button class="btn btn-lg btn-primary btn-block" name="FAMILY" type="submit"> Confirm Edits</button>';
          echo '<br>';
          echo '<button class="btn btn-danger" name="KILLFAMILY" type="submit">Delete</button>';
          echo '</form>';
      
        }
        else
        {
          // LOOKING AT A FAMILY AS AS A REGULAR USER
          echo "<p><strong><u>".$row["family_name"].'</u></strong></p>';
          echo "<p>" ."<strong>Description: </strong>". $row["family_desc"] . '</p>';                                    
        }
        echo '</div>';
        echo '</div>';
      }   

      
      //
      // --------------------- Clicking on a Impacted Species ------------------------------
      //
      elseif (isset($_GET['impacted']))
      {       
        $impacted = mysqli_real_escape_string($conn, $_GET['impacted']);
        
        $sql = "SELECT *"

            . "FROM `e_impacted_species`\n"
            
            . "    WHERE `e_impacted_species`.`imp_sci_name` ='$impacted'";            

        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);
        echo '<div class="jumbotron">';
        echo '<div align="left">';       
        
        // LOOKING AT IMPACTED SPECIES AS AN ADMIN
        // HAVING THE REDIRECT WON'T LET YOU MOVE BACK A PAGE - WE MIGHT WANT TO PUT THIS SOMEWHERE ELSE
        // ****NOTE: I WAS ABLE TO GET DELETE WORKING, I DON'T UNDERSTAND HOW NATE IMPLEMENTED EDIT FOR PLANTS ABOVE.
        if(isset($_SESSION["user"])) 
        {
     
          echo '<form class="edit-info" method="post" action="" id="edit-info">';                 
          echo '<p><strong>Scientific Name: </strong></p>';
          echo '<input name="imp_sci_name" value="'.$row["imp_sci_name"].'" style="width: 100%"><br><br>';          
          echo '<p><strong>Common Name: </strong></p>';
          echo '<input name="imp_com_name" value="'.$row["imp_com_name"].'" style="width: 100%"><br><br>';      
          echo '<p><strong>Description: </strong></p>';
          echo '<input name="imp_desc" value="'.$row["imp_desc"].'" style="width: 100%"><br><br>';  
  
          echo '<br><br>';
          echo '<button class="btn btn-lg btn-primary btn-block" name="IMPACTED" type="submit"> Confirm Edits</button>';
          echo '<br>';
          echo '<button class="btn btn-danger" name="KILLIMPACTED" type="submit">Delete</button>';
          echo '</form>';
      
        }
        else
        {
          // LOOKING AT A IMPACTED SPECIES AS AS A REGULAR USER
          echo "<p><strong><u>".$row["imp_sci_name"].'</u></strong></p>';
          echo "<p>" ."<strong>Common Name: </strong>". $row["imp_com_name"] . '</p>'; 
          echo "<p>" ."<strong>Description: </strong>". $row["imp_desc"] . '</p>';           
        }
        echo '</div>';
        echo '</div>';
      }  
      
      //
      // --------------------- Clicking on a Invasive Status ------------------------------
      //
      elseif (isset($_GET['status']))
      {       
        $status = mysqli_real_escape_string($conn, $_GET['status']);
        
        $sql = "SELECT *"

            . "FROM `e_invasive_status`\n"
            
            . "    WHERE `e_invasive_status`.`inv_status` ='$status'";            

        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);
        echo '<div class="jumbotron">';
        echo '<div align="left">';       
        
        // LOOKING AT INVASIVE STATUS AS AN ADMIN
        // HAVING THE REDIRECT WON'T LET YOU MOVE BACK A PAGE - WE MIGHT WANT TO PUT THIS SOMEWHERE ELSE
        // ****NOTE: I WAS ABLE TO GET DELETE WORKING, I DON'T UNDERSTAND HOW NATE IMPLEMENTED EDIT FOR PLANTS ABOVE.
        if(isset($_SESSION["user"])) 
        {
     
          echo '<form class="edit-info" method="post" action="" id="edit-info">';                 
          echo '<p><strong>Invasive Status: </strong></p>';
          echo '<input name="inv_status" value="'.$row["inv_status"].'" style="width: 100%"><br><br>';          
          echo '<p><strong>Legal Act Number: </strong></p>';
          echo '<input name="legal_act_num" value="'.$row["legal_act_num"].'" style="width: 100%"><br><br>';      
          echo '<p><strong>Description: </strong></p>';
          echo '<input name="status_desc" value="'.$row["status_desc"].'" style="width: 100%"><br><br>';  
  
          echo '<br><br>';
          echo '<button class="btn btn-lg btn-primary btn-block" name="STATUS" type="submit"> Confirm Edits</button>';
          echo '<br>';
          echo '<button class="btn btn-danger" name="KILLSTATUS" type="submit">Delete</button>';
          echo '</form>';
      
        }
        else
        {
          // LOOKING AT A INVASIVE STATUS AS AS A REGULAR USER
          echo "<p><strong><u>".$row["inv_status"].'</u></strong></p>';
          echo "<p>" ."<strong>Legal Act Number: </strong>". $row["legal_act_num"] . '</p>'; 
          echo "<p>" ."<strong>Description: </strong>". $row["status_desc"] . '</p>';           
        }
        echo '</div>';
        echo '</div>';
      }  
      

      //
      // --------------------- Clicking on a Life Cycle ------------------------------
      //
      elseif (isset($_GET['cycle']))
      {       
        $cycle = mysqli_real_escape_string($conn, $_GET['cycle']);
        
        $sql = "SELECT *"

            . "FROM `e_life_cycle`\n"
            
            . "    WHERE `e_life_cycle`.`lc_type` ='$cycle'";            

        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);
        echo '<div class="jumbotron">';
        echo '<div align="left">';       
        
        // LOOKING AT LIFE CYCLE AS AN ADMIN
        // HAVING THE REDIRECT WON'T LET YOU MOVE BACK A PAGE - WE MIGHT WANT TO PUT THIS SOMEWHERE ELSE
        // ****NOTE: I WAS ABLE TO GET DELETE WORKING, I DON'T UNDERSTAND HOW NATE IMPLEMENTED EDIT FOR PLANTS ABOVE.
        if(isset($_SESSION["user"])) 
        {
     
          echo '<form class="edit-info" method="post" action="" id="edit-info">';                 
          echo '<p><strong>Life Cycle: </strong></p>';
          echo '<input name="lc_type" value="'.$row["lc_type"].'" style="width: 100%"><br><br>';          
          echo '<p><strong>Description: </strong></p>';
          echo '<input name="lc_desc" value="'.$row["lc_desc"].'" style="width: 100%"><br><br>';      
          echo '<p><strong>Implication: </strong></p>';
          echo '<input name="implication" value="'.$row["implication"].'" style="width: 100%"><br><br>';  
  
          echo '<br><br>';
          echo '<button class="btn btn-lg btn-primary btn-block" name="CYCLE" type="submit"> Confirm Edits</button>';
          echo '<br>';
          echo '<button class="btn btn-danger" name="KILLCYCLE" type="submit">Delete</button>';
          echo '</form>';
      
        }
        else
        {
          // LOOKING AT LIFE CYCLE AS AS A REGULAR USER
          echo "<p><strong><u>".$row["lc_type"].'</u></strong></p>';
          echo "<p>" ."<strong>Description: </strong>". $row["lc_desc"] . '</p>';           
        }
        echo '</div>';
        echo '</div>';
      }        
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      

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
                echo "<p>" ."<strong>Leaf Description: </strong>". $row["leaf_desc"]. '</p>'; 
                echo "<p>" ."<strong>Stem Description: </strong>". $row["stem_desc"]. '</p>';     
                echo "<p>" ."<strong>Root Description: </strong>". $row["root_desc"]. '</p>';     
                echo "<p>" ."<strong>Seed Description: </strong>". $row["seed_desc"]. '</p>';
                echo "<p>" ."<strong>Similar Species: </strong>". $row["similar_species"]. '</p>';            
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
              $sql = "UPDATE `e_invasive_species` SET `inv_sci_name` = '$name', `concern`='$concern', `inv_desc`='blobtexts/'.'$description' WHERE `e_invasive_species`.`inv_sci_name` = '$inv_sci_name'; ";
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
      
      
      /*
      // DON'T NEED THIS ANYMORE
      // ==================== REDIRECTS TO ALL_INVASIVE_SPECIES.PHP ====================
      
      elseif (isset($_GET['agency_name']))
      {  
        $scinamec = $_GET['agency_name'];
        header("Location: all_invasive_species.php?agency_name=$scinamec");     
      }
      elseif (isset($_GET['distribution']))
      {  
        $scinamec = $_GET['distribution'];
        header("Location: all_invasive_species.php?distribution=$scinamec");     
      }  
      elseif (isset($_GET['family']))
      {  
        $scinamec = $_GET['family'];
        header("Location: all_invasive_species.php?family=$scinamec");     
      }        
      elseif (isset($_GET['impacted']))
      {  
        $scinamec = $_GET['impacted'];
        header("Location: all_invasive_species.php?impacted=$scinamec");     
      }

      elseif (isset($_GET['status']))
      {  
        $scinamec = $_GET['status'];
        header("Location: all_invasive_species.php?status=$scinamec");     
      }
      
      elseif (isset($_GET['cycle']))
      {  
        $scinamec = $_GET['cycle'];
        header("Location: all_invasive_species.php?cycle=$scinamec");     
      }      
      
      // ================================================================================
      
      */
      
      
      
      
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
        // XX FOR DEBUGGING - CAUSING EDIT ISSUES
        if(isset($_SESSION["xx"]))
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
//==========================================================================


	if(isset($_POST['Go'])) 
	{
		$search = $_REQUEST['drop'];
		
		if(!empty($search)) 
		{
			if(!empty($_REQUEST['input'])) 
			{
				$input = mysqli_real_escape_string($conn, $_REQUEST['input']);

				switch($search)
				{

					case "e_animals": 
					$sql = "SELECT * FROM " . "`" .$search. "`" . "JOIN `e_invasive_species`  ON `e_invasive_species`.inv_sci_name = " . "`" . $search . "`.inv_sci_name " . 
																  "WHERE `" . $search . "`.inv_sci_name LIKE '%" . $input . "%' 
																	OR `subphylum` LIKE '%" . $input . "%'
																	OR `reproduction` LIKE '%" . $input . "%'
																	OR `life_span` LIKE '%" . $input . "%'
																	OR `inv_com_name` LIKE '%" . $input . "%'
																	OR `thumbnail` LIKE '%" . $input . "%'
																	OR `aquatic` LIKE '%" . $input . "%'
																	OR `inv_desc` LIKE '%" . $input . "%'
																	OR `concern` LIKE '%" . $input . "%'
																	OR `management` LIKE '%" . $input . "%'																	
																	OR `inv_ref` LIKE '%" . $input . "%'                                  
																	OR `habitat` LIKE '%" . $input . "%'"; break;
																	
					case "e_plants":
					$sql = "SELECT * FROM " . "`" .$search. "`" . "JOIN `e_invasive_species`  ON `e_invasive_species`.inv_sci_name = " . "`" . $search . "`.inv_sci_name " . 
																  "WHERE `" . $search . "`.inv_sci_name LIKE '%" . $input . "%' 
																	OR `root_desc` LIKE '%" . $input . "%'
																	OR `seed_desc` LIKE '%" . $input . "%'
																	OR `leaf_desc` LIKE '%" . $input . "%'
																	OR `flower_desc` LIKE '%" . $input . "%'
                                  OR `inv_com_name` LIKE '%" . $input . "%'
																	OR `thumbnail` LIKE '%" . $input . "%'
																	OR `aquatic` LIKE '%" . $input . "%'
																	OR `inv_desc` LIKE '%" . $input . "%'
																	OR `concern` LIKE '%" . $input . "%'
																	OR `management` LIKE '%" . $input . "%'																	
																	OR `inv_ref` LIKE '%" . $input . "%'
																	OR `stem_desc` LIKE '%" . $input . "%'																	
																	OR `similar_species` LIKE '%" . $input . "%'"; break;
					
					case "e_pathogens":
					$sql = "SELECT * FROM " . "`" .$search. "`" . "JOIN `e_invasive_species`  ON `e_invasive_species`.inv_sci_name = " . "`" . $search . "`.inv_sci_name " .
																  "WHERE `" . $search . "`.inv_sci_name LIKE '%" . $input . "%' 
																	OR `path_type` LIKE '%" . $input . "%'
                                  OR `inv_com_name` LIKE '%" . $input . "%'
																	OR `thumbnail` LIKE '%" . $input . "%'
																	OR `aquatic` LIKE '%" . $input . "%'
																	OR `inv_desc` LIKE '%" . $input . "%'
																	OR `concern` LIKE '%" . $input . "%'
																	OR `management` LIKE '%" . $input . "%'																	
																	OR `inv_ref` LIKE '%" . $input . "%'"; break;
					
					case "e_agency":
					$sql = "SELECT * FROM " . "`" .$search. "`" . "WHERE `agency_name` LIKE '%" . $input . "%' 
																	OR `website` LIKE '%" . $input . "%'
																	OR `jurisdiction` LIKE '%" . $input . "%'"; break;
					
					case "e_distribution_method":
					$sql = "SELECT * FROM " . "`" .$search. "`" . "WHERE `dist_type` LIKE '%" . $input . "%' 
																	OR `prev_measures` LIKE '%" . $input . "%'
																	OR `dist_desc` LIKE '%" . $input . "%'"; break;
					
					case "e_family": 
					$sql = "SELECT * FROM " . "`" .$search. "`" . "WHERE `family_name` LIKE '%" . $input . "%' 
																	OR `family_desc` LIKE '%" . $input . "%'"; break;
																	
					case "e_invasive_species": 
					$sql = "SELECT * FROM " . "`" .$search. "`" . "WHERE `inv_sci_name` LIKE '%" . $input . "%' 
																	OR `inv_com_name` LIKE '%" . $input . "%'
																	OR `thumbnail` LIKE '%" . $input . "%'
																	OR `aquatic` LIKE '%" . $input . "%'
																	OR `inv_desc` LIKE '%" . $input . "%'
																	OR `concern` LIKE '%" . $input . "%'
																	OR `management` LIKE '%" . $input . "%'																	
																	OR `inv_ref` LIKE '%" . $input . "%'"; break;
					
					case "e_invasive_status": 
					$sql = "SELECT * FROM " . "`" .$search. "`" . "WHERE `inv_status` LIKE '%" . $input . "%' 
																	OR `legal_act_num` LIKE '%" . $input . "%'
																	OR `status_desc` LIKE '%" . $input . "%'"; break;
					
					case "e_impacted_species": 
					$sql = "SELECT * FROM " . "`" .$search. "`" . "WHERE `imp_sci_name` LIKE '%" . $input . "%' 
																	OR `imp_com_name` LIKE '%" . $input . "%'
																	OR `imp_desc` LIKE '%" . $input . "%'"; break;
					
					case "e_life_cycle": 
					$sql = "SELECT * FROM " . "`" .$search. "`" . "WHERE `lc_type` LIKE '%" . $input . "%' 
																	OR `implication` LIKE '%" . $input . "%'
																	OR `lc_desc` LIKE '%" . $input . "%'"; break;
					
					default: echo("Error!"); exit(); break;
				}


				
				$query = mysqli_query($conn, $sql);
				echo mysqli_error($conn);
				if($query->num_rows > 0)
				{
          echo '<div align="center">';
          echo '<div class="jumbotron">';
          echo "<strong>"."Your search returned ".$query->num_rows." results."."</strong>";
          echo '</div>';
          echo '</div>';
					while($row = mysqli_fetch_assoc($query))
					{
              if($search == "e_animals" or $search == "e_pathogens" or $search == "e_plants" or $search == "e_invasive_species")
              {
                echo '<div class="jumbotron">';
                echo '<div align="left">';
                echo '<p>'."<strong>Scientific Name: </strong>".'<i><a href="?inv_sci_name='.$row["inv_sci_name"] .'">' . $row["inv_sci_name"] . '</i></a></p>';
                echo "<p>"."<strong>Common Name: </strong>".$row["inv_com_name"] . '</p>';    
                $image = $row["thumbnail"];              
                $path = "../images/";
                echo '<img src="'.$path.''.$image.'" width="200" />';
                echo '</div>';
                echo '</div>';
              }
              elseif($search == "e_agency")
              {
                              
                echo '<div class="jumbotron">';
                echo '<div align="left">';
                echo "<p>" ."<u>".'<i><a href="?agency_name='.$row["agency_name"].'">'. $row["agency_name"] . '</i></a></u></p>';
                echo "<p>" ."<strong>Jurisdiction: </strong>". $row["jurisdiction"] . '</p>';       
                echo "<p>" ."<strong>Website: </strong>". $row["website"] . '</p>';                                   
                echo '</div>';
                echo '</div>';
              } 
              elseif($search == "e_distribution_method")
              {
                echo '<div class="jumbotron">';
                echo '<div align="left">';
                echo "<p>" ."<u>".'<i><a href="?distribution='.$row["dist_type"].'">'. $row["dist_type"] . '</i></a></u></p>';
                echo "<p>" ."<strong>Description: </strong>". $row["dist_desc"] . '</p>';       
                echo "<p>" ."<strong>Preventative Measures: </strong>". $row["prev_measures"] . '</p>';                                   
                echo '</div>';
                echo '</div>';
              }     
              elseif($search == "e_family")
              {
                echo '<div class="jumbotron">';
                echo '<div align="left">';
                echo "<p>" ."<u>".'<i><a href="?family='.$row["family_name"].'">'. $row["family_name"] . '</i></a></u></p>';                           
                echo '</div>';
                echo '</div>';
              }   
              elseif($search == "e_impacted_species")
              {
                echo '<div class="jumbotron">';
                echo '<div align="left">';
                echo "<p>" ."<u>".'<i><a href="?impacted='.$row["imp_sci_name"].'">'. $row["imp_sci_name"] . '</i></a></u></p>';       
                echo "<p>" ."<strong>Common Name: </strong>". $row["imp_com_name"] . '</p>';                    
                echo '</div>';
                echo '</div>';
              } 
              elseif($search == "e_life_cycle")
              {
                echo '<div class="jumbotron">';
                echo '<div align="left">';
                echo "<p>" ."<u>".'<i><a href="?cycle='.$row["lc_type"].'">'. $row["lc_type"] . '</i></a></u></p>'; 
                echo "<p>" ."<strong>Descrption: </strong>". $row["lc_desc"] . '</p>';                    
                echo '</div>';
                echo '</div>';
              }   
              elseif($search == "e_invasive_status")
              {
                echo '<div class="jumbotron">';
                echo '<div align="left">';
                echo "<p>" ."<u>".'<i><a href="?status='.$row["inv_status"].'">'. $row["inv_status"] . '</i></a></u></p>';     
                echo "<p>" ."<strong>Act: </strong>". $row["legal_act_num"] . '</p>';                    
                echo '</div>';
                echo '</div>';
              }                    
					}
				}
				else 
				{
          echo '<div align="center">';
          echo '<div class="jumbotron">';
					echo "<br>" . "Sorry, No results found.";
          echo '</div>';
          echo '</div>';

				} 
			}
			else 
			{	
				switch($search)
				{
					case "e_animals": 
					$sql = "SELECT * FROM " . "`" .$search. "`" . "JOIN `e_invasive_species`  
																ON `e_invasive_species`.inv_sci_name = " . "`" . $search . "`.inv_sci_name " ; break;
																	
					case "e_plants":
					$sql = "SELECT * FROM " . "`" .$search. "`" . "JOIN `e_invasive_species`  
																ON `e_invasive_species`.inv_sci_name = " . "`" . $search . "`.inv_sci_name "; break;
					
					case "e_pathogens":
					$sql = "SELECT * FROM " . "`" .$search. "`" . "JOIN `e_invasive_species`  
																ON `e_invasive_species`.inv_sci_name = " . "`" . $search . "`.inv_sci_name "; break;
						
					default: $sql = "SELECT * FROM " . $search;
				}
					
				$query = mysqli_query($conn, $sql); 
				echo "<br>" . mysqli_error($conn);
				if($query->num_rows > 0)
				{
          echo '<div align="center">';
          echo '<div class="jumbotron">';
          echo "<strong>"."Your search returned ".$query->num_rows." results."."</strong>";
          echo '</div>';
          echo '</div>';
					while($row = mysqli_fetch_assoc($query))
					{
              if($search == "e_animals" or $search == "e_pathogens" or $search == "e_plants" or $search == "e_invasive_species")
              {
                echo '<div class="jumbotron">';
                echo '<div align="left">';
                echo '<p>'."<strong>Scientific Name: </strong>".'<i><a href="?inv_sci_name='.$row["inv_sci_name"] .'">' . $row["inv_sci_name"] . '</i></a></p>';
                echo "<p>"."<strong>Common Name: </strong>".$row["inv_com_name"] . '</p>';    
                $image = $row["thumbnail"];              
                $path = "../images/";
                echo '<img src="'.$path.''.$image.'" width="200" />';
                echo '</div>';
                echo '</div>';
              }
              elseif($search == "e_agency")
              {
                echo '<div class="jumbotron">';
                echo '<div align="left">';
                echo "<p>" ."<u>".'<i><a href="?agency_name='.$row["agency_name"].'">'. $row["agency_name"] . '</i></a></u></p>';
                echo "<p>" ."<strong>Jurisdiction: </strong>". $row["jurisdiction"] . '</p>';       
                echo "<p>" ."<strong>Website: </strong>". $row["website"] . '</p>';                                   
                echo '</div>';
                echo '</div>';
              } 
              elseif($search == "e_distribution_method")
              {
                echo '<div class="jumbotron">';
                echo '<div align="left">';
                echo "<p>" ."<u>".'<i><a href="?distribution='.$row["dist_type"].'">'. $row["dist_type"] . '</i></a></u></p>';
                echo "<p>" ."<strong>Description: </strong>". $row["dist_desc"] . '</p>';       
                echo "<p>" ."<strong>Preventative Measures: </strong>". $row["prev_measures"] . '</p>';                                   
                echo '</div>';
                echo '</div>';
              }     
              elseif($search == "e_family")
              {
                echo '<div class="jumbotron">';
                echo '<div align="left">';
                echo "<p>" ."<u>".'<i><a href="?family='.$row["family_name"].'">'. $row["family_name"] . '</i></a></u></p>';                                
                echo '</div>';
                echo '</div>';
              }   
              elseif($search == "e_impacted_species")
              {
                echo '<div class="jumbotron">';
                echo '<div align="left">';
                echo "<p>" ."<u>".'<i><a href="?impacted='.$row["imp_sci_name"].'">'. $row["imp_sci_name"] . '</i></a></u></p>';       
                echo "<p>" ."<strong>Common Name: </strong>". $row["imp_com_name"] . '</p>';                    
                echo '</div>';
                echo '</div>';
              } 
              elseif($search == "e_life_cycle")
              {
                echo '<div class="jumbotron">';
                echo '<div align="left">';
                echo "<p>" ."<u>".'<i><a href="?cycle='.$row["lc_type"].'">'. $row["lc_type"] . '</i></a></u></p>'; 
                echo "<p>" ."<strong>Descrption: </strong>". $row["lc_desc"] . '</p>';                    
                echo '</div>';
                echo '</div>';
              }   
              elseif($search == "e_invasive_status")
              {
                echo '<div class="jumbotron">';
                echo '<div align="left">';
                echo "<p>" ."<u>".'<i><a href="?status='.$row["inv_status"].'">'. $row["inv_status"] . '</i></a></u></p>'; 
                echo "<p>" ."<strong>Act: </strong>". $row["legal_act_num"] . '</p>';                    
                echo '</div>';
                echo '</div>';
              }                    
					}	
					
				}
				else 
				{
				echo "<br>" . "Sorry, No results found.";
				}
			}
		}
		else
			echo "<br>" . "Please Select a Category.";
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
