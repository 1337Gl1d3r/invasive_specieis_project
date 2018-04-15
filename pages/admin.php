<?php
include_once "../php/commons.php";
// redirect non-users to homepage
if(!isset($_SESSION["user"]))
{
    header("Location: index.php");
}

if(isset($_POST['Go'])) 
	{
		$query = mysqli_query($conn, $sqld);
		$_SESSION["user"] = null;
		//unset($_SESSION["user"]);
		header("Location: index.php");
		exit;		
	}
// 
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    $conn = get_mysqli_localhost();
    // Check connection
    if (!$conn) 
    {
        die("Connection failed: " . mysqli_connect_error());
    }

    
    
// ***********************************************************************
//            ADDING A NEW INVASIVE PLANT/ANIMAL SPECIES/PATHOGEN
// ***********************************************************************
    if (isset($_POST['scinamep']) || isset($_POST['scinamea']) || isset($_POST['scinamepa']))
    {
      
      // Determine sciname (if plant, animal or pathogen)
      $sciname = NULL;
      if (isset($_POST['scinamep']))
      {
        $sciname = mysqli_real_escape_string($conn, $_REQUEST['scinamep']);
      }
      elseif (isset($_POST['scinamea']))
      {
        $sciname = mysqli_real_escape_string($conn, $_REQUEST['scinamea']);
      }
      elseif (isset($_POST['scinamepa']))
      {
        $sciname = mysqli_real_escape_string($conn, $_REQUEST['scinamepa']);        
      }      
      
      
        // ===============================================================
        //                  INSERT INVASIVE SPECIES
        // ===============================================================        
        $sql = "INSERT INTO `e_invasive_species` (`inv_sci_name`) 
        VALUES ('$sciname')";      
      
        // UPDATE THE DB
        if ($conn->query($sql) == FALSE)
        {
            echo "<br>Error: " . $sql . "<br>" . $conn->error;
        }             
        else
        { 
          // ====================== CHECK FOR AQUATIC =======================
          $aquatic_or_not = NULL;
          if (isset($_POST['aquatic_or_not']))
          {
            $aquatic_or_not = mysqli_real_escape_string($conn, $_REQUEST['aquatic_or_not']);
            if ($aquatic_or_not == "na")
            {
                $aquatic_or_not = "No";
            }
            else
            {
                $aquatic_or_not = "Aquatic";
            }
            $sql = "UPDATE e_invasive_species SET aquatic = '$aquatic_or_not'
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
          if (isset($_POST['common_name']) && mysqli_real_escape_string($conn, $_REQUEST['common_name']) != "")
          {        
            $common_name = mysqli_real_escape_string($conn, $_REQUEST['common_name']);
            $sql = "UPDATE e_invasive_species SET inv_com_name = '$common_name'
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
          if (isset($_POST['references']) && mysqli_real_escape_string($conn, $_REQUEST['references']) != "")
          {        
            $references = mysqli_real_escape_string($conn, $_REQUEST['references']);
            $sql = "UPDATE e_invasive_species SET inv_ref = '$references'
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
          if (isset($_POST['Thumbnail']) && mysqli_real_escape_string($conn, $_REQUEST['Thumbnail']) != "")
          {        
            $Thumbnail = mysqli_real_escape_string($conn, $_REQUEST['Thumbnail']);
            $sql = "UPDATE e_invasive_species SET thumbnail = '$Thumbnail'
                    WHERE inv_sci_name = '$sciname'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                                   
          }        
          
          echo "<br>New Invasive Species record created successfully!";  
          

  // ***********************************************************************
  //                         IF A PLANT IS BEING ADDED
  // ***********************************************************************        
          if (isset($_POST['scinamep']))
          {
            // ===============================================================
            //                         INSERT PLANT
            // ===============================================================  
            $sql = "INSERT INTO `e_plants` (`inv_sci_name`) 
            VALUES ('$sciname')";      
          
            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }         

            
            // ================== CHECK FLOWER DESCRIPTION ===================         
            if (isset($_POST['flowerdesc']) && mysqli_real_escape_string($conn, $_REQUEST['flowerdesc']) != "")
            {        
              $flowerdesc = mysqli_real_escape_string($conn, $_REQUEST['flowerdesc']);
              $sql = "UPDATE e_plants SET flower_desc = '$flowerdesc'
                      WHERE inv_sci_name = '$sciname'";   

              // UPDATE THE DB
              if ($conn->query($sql) == FALSE)
              {
                  echo "<br>Error: " . $sql . "<br>" . $conn->error;
              }                                     
            }           
             
            // =================== CHECK LEAF DESCRIPTION ====================         
            if (isset($_POST['leafdesc']) && mysqli_real_escape_string($conn, $_REQUEST['leafdesc']) != "")
            {        
              $leafdesc = mysqli_real_escape_string($conn, $_REQUEST['leafdesc']);
              $sql = "UPDATE e_plants SET leaf_desc = '$leafdesc'
                      WHERE inv_sci_name = '$sciname'";   

              // UPDATE THE DB
              if ($conn->query($sql) == FALSE)
              {
                  echo "<br>Error: " . $sql . "<br>" . $conn->error;
              }                                     
            }             
             
     
            // =================== CHECK ROOT DESCRIPTION ====================         
            if (isset($_POST['rootdesc']) && mysqli_real_escape_string($conn, $_REQUEST['rootdesc']) != "")
            {        
              $rootdesc = mysqli_real_escape_string($conn, $_REQUEST['rootdesc']);
              $sql = "UPDATE e_plants SET root_desc = '$rootdesc'
                      WHERE inv_sci_name = '$sciname'";   

              // UPDATE THE DB
              if ($conn->query($sql) == FALSE)
              {
                  echo "<br>Error: " . $sql . "<br>" . $conn->error;
              }                                     
            }       

            
            // =================== CHECK SEED DESCRIPTION ====================         
            if (isset($_POST['seeddesc']) && mysqli_real_escape_string($conn, $_REQUEST['seeddesc']) != "")
            {        
              $seeddesc = mysqli_real_escape_string($conn, $_REQUEST['seeddesc']);
              $sql = "UPDATE e_plants SET seed_desc = '$seeddesc'
                      WHERE inv_sci_name = '$sciname'";   

              // UPDATE THE DB
              if ($conn->query($sql) == FALSE)
              {
                  echo "<br>Error: " . $sql . "<br>" . $conn->error;
              }                                     
            }


            // =================== CHECK SIMILAR SPECIES ====================         
            if (isset($_POST['simspec']) && mysqli_real_escape_string($conn, $_REQUEST['simspec']) != "")
            {        
              $simspec = mysqli_real_escape_string($conn, $_REQUEST['simspec']);
              $sql = "UPDATE e_plants SET similar_species = '$simspec'
                      WHERE inv_sci_name = '$sciname'";   

              // UPDATE THE DB
              if ($conn->query($sql) == FALSE)
              {
                  echo "<br>Error: " . $sql . "<br>" . $conn->error;
              }                                     
            }
            
     
            // ================= CHECK STEM DESCRIPTION ====================         
            if (isset($_POST['stemdesc']) && mysqli_real_escape_string($conn, $_REQUEST['stemdesc']) != "")
            {        
              $stemdesc = mysqli_real_escape_string($conn, $_REQUEST['stemdesc']);
              $sql = "UPDATE e_plants SET stem_desc = '$stemdesc'
                      WHERE inv_sci_name = '$sciname'";   

              // UPDATE THE DB
              if ($conn->query($sql) == FALSE)
              {
                  echo "<br>Error: " . $sql . "<br>" . $conn->error;
              }                          
            } 
            
            echo "<br>New Plant record created successfully!";              
          }          
          
          
  // ***********************************************************************
  //                         IF AN ANIMAL IS BEING ADDED
  // ***********************************************************************        
          if (isset($_POST['scinamea']))
          {        
            // ===============================================================
            //                         INSERT ANIMAL
            // ===============================================================  
            $sql = "INSERT INTO `e_animals` (`inv_sci_name`) 
            VALUES ('$sciname')";      
          
            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }  


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
            if (isset($_POST['lifespan']) && mysqli_real_escape_string($conn, $_REQUEST['lifespan']) != "")
            {        
              $lifespan = mysqli_real_escape_string($conn, $_REQUEST['lifespan']);
              $sql = "UPDATE e_animals SET life_span = '$lifespan'
                      WHERE inv_sci_name = '$sciname'";   

              // UPDATE THE DB
              if ($conn->query($sql) == FALSE)
              {
                  echo "<br>Error: " . $sql . "<br>" . $conn->error;
              }                                     
            }          
            
            
            // =================== CHECK REPRODUCTION ========================         
            if (isset($_POST['reproduc']) && mysqli_real_escape_string($conn, $_REQUEST['reproduc']) != "")
            {        
              $reproduc = mysqli_real_escape_string($conn, $_REQUEST['reproduc']);
              $sql = "UPDATE e_animals SET reproduction = '$reproduc'
                      WHERE inv_sci_name = '$sciname'";   

              // UPDATE THE DB
              if ($conn->query($sql) == FALSE)
              {
                  echo "<br>Error: " . $sql . "<br>" . $conn->error;
              }                                     
            }            

            
            // ===================== CHECK SUBPHYLUM ==========================         
            if (isset($_POST['vertebrate_or_invert']) && mysqli_real_escape_string($conn, $_REQUEST['vertebrate_or_invert']) != "")
            {        
              $vertebrate_or_invert = mysqli_real_escape_string($conn, $_REQUEST['vertebrate_or_invert']);
              $sql = "UPDATE e_animals SET subphylum = '$vertebrate_or_invert'
                      WHERE inv_sci_name = '$sciname'";   

              // UPDATE THE DB
              if ($conn->query($sql) == FALSE)
              {
                  echo "<br>Error: " . $sql . "<br>" . $conn->error;
              }                                     
            }              
         
            echo "<br>New Animal record created successfully!";   

          }
        
  // ***********************************************************************
  //                        IF A PATHOGEN IS BEING ADDED
  // ***********************************************************************        
          if (isset($_POST['scinamepa']))
          {      
            // ===============================================================
            //                      INSERT PATHOGEN
            // ===============================================================  
            $sql = "INSERT INTO `e_pathogens` (`inv_sci_name`) 
            VALUES ('$sciname')";      
          
            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }  


            // ======================== CHECK TYPE ==========================         
            if (isset($_POST['type']) && mysqli_real_escape_string($conn, $_REQUEST['type']) != "")
            {        
              $type = mysqli_real_escape_string($conn, $_REQUEST['type']);
              $sql = "UPDATE e_pathogens SET path_type = '$type'
                      WHERE inv_sci_name = '$sciname'";   

              // UPDATE THE DB
              if ($conn->query($sql) == FALSE)
              {
                  echo "<br>Error: " . $sql . "<br>" . $conn->error;
              }                                     
            }              
         
            echo "<br>New Pathogen record created successfully!";   
         
          }
        }
    }
    
    
// ***********************************************************************
//                        ADDING A NEW PLANT FAMILY
// ***********************************************************************    
    elseif (isset($_POST['name']))
    {
        // ===============================================================
        //                    INSERT NEW FAMILY
        // ===============================================================       
        $name = mysqli_real_escape_string($conn, $_REQUEST['name']);
        $sql = "INSERT INTO `e_family` (`family_name`) 
        VALUES ('$name')";      
      
        // UPDATE THE DB
        if ($conn->query($sql) == FALSE)
        {
            echo "<br>Error: " . $sql . "<br>" . $conn->error;
        }
        else
        {
          // ================= CHECK FOR DESCRIPTION ====================  
          if (isset($_POST['famdesc']) && mysqli_real_escape_string($conn, $_REQUEST['famdesc']) != "")
          {        
           $famdesc = mysqli_real_escape_string($conn, $_REQUEST['famdesc']);
            $sql = "UPDATE e_family SET family_desc = '$famdesc'
                    WHERE family_name = '$name'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          } 
          
          echo "<br>New Family record created successfully!";
        }
    }
    
    
// ***********************************************************************
//                        ADDING A NEW LIFE CYCLE
// ***********************************************************************    
    elseif (isset($_POST['type']))
    {
        // ===============================================================
        //                   INSERT NEW LIFE CYCLE
        // ===============================================================       
        $type = mysqli_real_escape_string($conn, $_REQUEST['type']);
        $sql = "INSERT INTO `e_life_cycle` (`lc_type`) 
        VALUES ('$type')";      
      
        // UPDATE THE DB
        if ($conn->query($sql) == FALSE)
        {
            echo "<br>Error: " . $sql . "<br>" . $conn->error;
        }
        else
        {
          // ================= CHECK FOR DESCRIPTION ====================  
          if (isset($_POST['lifecyc']) && mysqli_real_escape_string($conn, $_REQUEST['lifecyc']) != "")
          {        
            $lifecyc = mysqli_real_escape_string($conn, $_REQUEST['lifecyc']);
            $sql = "UPDATE e_life_cycle SET lc_desc = '$lifecyc'
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
          echo "<br>New Life Cycle record created successfully!";  
        }
    }


// ***********************************************************************
//                      ADDING A NEW IMPACTED SPECIES
// ***********************************************************************        
    elseif (isset($_POST['sname']))
    {
        // ===============================================================
        //                  INSERT NEW IMPACTED SPECIES
        // ===============================================================       
        $sname = mysqli_real_escape_string($conn, $_REQUEST['sname']);
        $sql = "INSERT INTO `e_impacted_species` (`imp_sci_name`) 
        VALUES ('$sname')";      
      
        // UPDATE THE DB
        if ($conn->query($sql) == FALSE)
        {
            echo "<br>Error: " . $sql . "<br>" . $conn->error;
        }
        else
        {
        
           // ================== CHECK FOR COMMON NAME ====================  
          if (isset($_POST['cname']) && mysqli_real_escape_string($conn, $_REQUEST['cname']) != "")
          {        
            $cname = mysqli_real_escape_string($conn, $_REQUEST['cname']);
            $sql = "UPDATE e_impacted_species SET imp_com_name = '$cname'
                    WHERE imp_sci_name = '$sname'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          }      
        

           // ================== CHECK FOR DESCRIPTION ====================  
          if (isset($_POST['gendesc']) && mysqli_real_escape_string($conn, $_REQUEST['gendesc']) != "")
          {        
            $gendesc = mysqli_real_escape_string($conn, $_REQUEST['gendesc']);
            $sql = "UPDATE e_impacted_species SET imp_desc = '$gendesc'
                    WHERE imp_sci_name = '$sname'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          }      
            echo "<br>New Impacted Species record created successfully!";     
        }
    }
    
    
// ***********************************************************************
//                          ADDING A NEW AGENCY
// ***********************************************************************           
    elseif (isset($_POST['aname']))
    {
        // ===============================================================
        //                      INSERT NEW AGENCY
        // ===============================================================       
        $name = mysqli_real_escape_string($conn, $_REQUEST['aname']);
        $sql = "INSERT INTO `e_agency` (`agency_name`) 
        VALUES ('$name')";      
      
        // UPDATE THE DB
        if ($conn->query($sql) == FALSE)
        {
            echo "<br>Error: " . $sql . "<br>" . $conn->error;
        }
        else
        {      
          // ================== CHECK FOR WEBSITE ======================  
          if (isset($_POST['site']) && mysqli_real_escape_string($conn, $_REQUEST['site']) != "")
          {        
            $site = mysqli_real_escape_string($conn, $_REQUEST['site']);
            $sql = "UPDATE e_agency SET website = '$site'
                    WHERE agency_name = '$name'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          }
      
          // ============== CHECK FOR JURISDICTION ======================  
          if (isset($_POST['Jurisdiction']) && mysqli_real_escape_string($conn, $_REQUEST['Jurisdiction']) != "")
          {        
            $Jurisdiction = mysqli_real_escape_string($conn, $_REQUEST['Jurisdiction']);
            $sql = "UPDATE e_agency SET jurisdiction = '$Jurisdiction'
                    WHERE agency_name = '$name'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          }      
            echo "<br>New Agency record created successfully!";           
        }
    }
    
    
// ***********************************************************************
//                       ADDING NEW INVASIVE STATUS
// ***********************************************************************        
    elseif (isset($_POST['itype']) && isset($_POST['LAN']))
    {
        // ===============================================================
        //                  INSERT NEW INVASIVE STATUS
        // ===============================================================       
        $type = mysqli_real_escape_string($conn, $_REQUEST['itype']);
        $LAN = mysqli_real_escape_string($conn, $_REQUEST['LAN']);
        $sql = "INSERT INTO `e_invasive_status` (`inv_status`, `legal_act_num`) 
        VALUES ('$type','$LAN')";      
      
        // UPDATE THE DB
        if ($conn->query($sql) == FALSE)
        {
            echo "<br>Error: " . $sql . "<br>" . $conn->error;
        }
        else
        {      
          // ================ CHECK FOR DESCRIPTION ======================  
          if (isset($_POST['invdesc']) && mysqli_real_escape_string($conn, $_REQUEST['invdesc']) != "")
          {        
            $invdesc = mysqli_real_escape_string($conn, $_REQUEST['invdesc']);
            $sql = "UPDATE e_invasive_status SET status_desc = '$invdesc'
                    WHERE inv_status = '$type'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          }      
          echo "<br>New Invasive Status record created successfully!";          
        }
    }
    
    
// ***********************************************************************
//                     ADDING NEW DISTRIBUTION METHOD
// ***********************************************************************        
    elseif (isset($_POST['dtype']))
    {
        // ===============================================================
        //               INSERT NEW DISTRIBUTION METHOD
        // ===============================================================       
        $type = mysqli_real_escape_string($conn, $_REQUEST['dtype']);
        $sql = "INSERT INTO `e_distribution_method` (`dist_type`) 
        VALUES ('$type')";      
      
        // UPDATE THE DB
        if ($conn->query($sql) == FALSE)
        {
            echo "<br>Error: " . $sql . "<br>" . $conn->error;
        }
        else
        {   
      
          // ================ CHECK FOR DESCRIPTION ======================  
          if (isset($_POST['dmdesc']) && mysqli_real_escape_string($conn, $_REQUEST['dmdesc']) != "")
          {        
            $dmdesc = mysqli_real_escape_string($conn, $_REQUEST['dmdesc']);
            $sql = "UPDATE e_distribution_method SET dist_desc = '$dmdesc'
                    WHERE dist_type = '$type'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          }      
      
          // ================ CHECK FOR DESCRIPTION ======================  
          if (isset($_POST['Preventative_Measures']) && mysqli_real_escape_string($conn, $_REQUEST['Preventative_Measures']) != "")
          {        
            $Preventative_Measures = mysqli_real_escape_string($conn, $_REQUEST['Preventative_Measures']);
            $sql = "UPDATE e_distribution_method SET prev_measures = '$Preventative_Measures'
                    WHERE dist_type = '$type'";   

            // UPDATE THE DB
            if ($conn->query($sql) == FALSE)
            {
                echo "<br>Error: " . $sql . "<br>" . $conn->error;
            }                          
          }           
          echo "<br>New Distribution Method record created successfully!";     
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link href="../css/starter-template.css" rel="stylesheet">
  <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>

<?php include_once "header.php"; ?>
<body>


<div class="container">
  <h2>Add Plant</h2>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#plant">Add Plant</button>
  <div id="plant" class="collapse">
    <form class="form-plant" method="post" action="" id="form-plant">

        <h1 class="h3 mb-3 font-weight-normal">Please Enter the Plant information</h1>
        <label for="scinamep" class="sr-only">Scientific Name</label>
        <input type="text" id="scinamep" name="scinamep" class="form-control" placeholder="Scientific Name" required autofocus>

        <label for="Thumbnail" class="sr-only">Thumbnail</label>
        <input type="text" id="Thumbnail" name="Thumbnail" class="form-control" placeholder="Thumbnail" autofocus>

        <label for="common_name" class="sr-only">Common Name</label>
        <input type="text" id="common_name" name="common_name" class="form-control" placeholder="Common Name" autofocus>

        <label for="aquatic_or_not" class="sr-only">Aquatic or Not</label>
        <label><input type="radio" id="aquatic_or_not" name="aquatic_or_not" class="form-control" value="a" autofocus>Aquatic</label>
        <label><input type="radio" id="aquatic_or_not" name="aquatic_or_not" class="form-control" value="na" autofocus>Not aquatic</label>

        <label for="Concern" class="sr-only">Concern</label>
        <input type="text" id="concern" name="concern" class="form-control" placeholder="Concern" autofocus>

        <label for="management" class="sr-only">Management</label>
        <input type="text" id="management" name="management" class="form-control" placeholder="Management" autofocus>
        
        <label for="generaldesc" class="sr-only">General Description</label>
        <input type="text" id="generaldesc" name="generaldesc" class="form-control" placeholder="General Description" autofocus>

        <label for="leaf_desc" class="sr-only">Leaf Description</label>
        <input type="text" id="leaf_desc" name="leaf_desc" class="form-control" placeholder="Leaf Description" autofocus>

        <label for="rootdesc" class="sr-only">Root Description</label>
        <input type="text" id="rootdesc" name="rootdesc" class="form-control" placeholder="Root Description" autofocus>

        <label for="references" class="sr-only">References</label>
        <input type="text" id="references" name="references" class="form-control" placeholder="References" autofocus>

        <label for="flowerdesc" class="sr-only">Flower Description</label>
        <input type="text" id="flowerdesc" name="flowerdesc" class="form-control" placeholder="Flower Description" autofocus>

        <label for="stemdesc" class="sr-only">Stem Description</label>
        <input type="text" id="stemdesc" name="stemdesc" class="form-control" placeholder="Stem Description" autofocus>

        <label for="flowcol" class="sr-only">Flower Colour</label>
        <input type="text" id="flowcol" name="flowcol" class="form-control" placeholder="Flower Colour" autofocus>
        
        <label for="leafdesc" class="sr-only">Leaf Description</label>
        <input type="text" id="leafdesc" name="leafdesc" class="form-control" placeholder="Leaf Description" autofocus>

        <label for="seeddesc" class="sr-only">Seed Description</label>
        <input type="text" id="seeddesc" name="seeddesc" class="form-control" placeholder="Seed Description" autofocus>

        <label for="simspec" class="sr-only">Similar Species</label>
        <input type="text" id="Similar Species" name="simspec" class="form-control" placeholder="Similar Species" autofocus>

        <label for="rootdesc" class="sr-only">Root Description</label>
        <input type="text" id="simspec" name="simspec" class="form-control" placeholder="Similar Species" autofocus>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Enter Plant Info</button>
      </form>
  </div>

  <h2>Add Plant Family</h2>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#plantfam">Simple collapsible</button>
  <div id="plantfam" class="collapse">
  <form class="form-plantlc" method="post" action="" id="form-plantfam">
        <h1 class="h3 mb-3 font-weight-normal">Please Enter the Family information</h1>
        <label for="name" class="sr-only">name</label>
        <input type="name" id="name" name="name" class="form-control" placeholder="Family Name" required>
        <label for="family" class="sr-only">Family Description</label>
        <input type="text" id="famdecs" name="famdesc" class="form-control" placeholder="Family Description" autofocus>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Enter Plant Family</button>
  </form>
  </div>

  <h2>Add Plant Life Cycle</h2>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#plantlife">Add Plant Life Cycle</button>
  <div id="plantlife" class="collapse">
  <form class="form-plantlc" method="post" action="" id="form-plantlc">
  <h1 class="h3 mb-3 font-weight-normal">Please Enter the Life Cycle information</h1>
        <label for="type" class="sr-only">type</label>
		    <input type="type" id="type" name="type" class="form-control" placeholder="Life Cycle Name" required autofocus>  
        <label for="lifecyc" class="sr-only">LifeCycle Description</label>
		    <input type="lifecyc" id="lifecyc" name="lifecyc" class="form-control" placeholder="Life Cycle Description" autofocus>
		    <label for="implication" class="sr-only">implication</label>
        <input type="implication" id="implication" name="implication" class="form-control" placeholder="Implication" autofocus>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Enter Plant Life Cycle</button>
  </form>
  </div>

  <h2>Add Animal</h2>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#animals">Add Animal</button>
  <div id="animals" class="collapse">
  <form class="form-animal" method="post" action="" id="form-animal">
        <h1 class="h3 mb-3 font-weight-normal">Add Animal</h1>
        <label for="scinamea" class="sr-only">Scientific Name</label>
        <input type="text" id="scinamea" name="scinamea" class="form-control" placeholder="Scientific Name" required autofocus>

        <label for="Thumbnail" class="sr-only">Thumbnail</label>
        <input type="text" id="Thumbnail" name="Thumbnail" class="form-control" placeholder="Thumbnail" autofocus>

        <label for="common_name" class="sr-only">Common Name</label>
        <input type="text" id="common_name" name="common_name" class="form-control" placeholder="Common Name" autofocus>

        <label for="aquatic_or_not" class="sr-only">Aquatic or Not</label>
        <label><input type="radio" id="aquatic_or_not" name="aquatic_or_not" class="form-control" value="a" autofocus>Aquatic</label>
        <label><input type="radio" id="aquatic_or_not" name="aquatic_or_not" class="form-control" value="na" autofocus>Not aquatic</label>

        <label for="Concern" class="sr-only">Concern</label>
        <input type="text" id="concern" name="concern" class="form-control" placeholder="Concern" autofocus>

        <label for="management" class="sr-only">Management</label>
        <input type="text" id="management" name="management" class="form-control" placeholder="Management" autofocus>
        
        <label for="generaldesc" class="sr-only">General Description</label>
        <input type="text" id="generaldesc" name="generaldesc" class="form-control" placeholder="General Description" autofocus>

        <label for="references" class="sr-only">References</label>
        <input type="text" id="references" name="references" class="form-control" placeholder="References" autofocus>

        <label for="vertebrate_or_invert" class="sr-only">Type</label>
        <input type="text" id="vertebrate_or_invert" name="vertebrate_or_invert" class="form-control" placeholder="Vertebrate or Invertebrate" autofocus>

        <label for="reproduc" class="sr-only">Reproduction</label>
        <input type="text" id="reproduc" name="reproduc" class="form-control" placeholder="Reproduction" autofocus>

        <label for="lifespan" class="sr-only">Lifespan</label>
        <input type="text" id="lifespan" name="lifespan" class="form-control" placeholder="Lifespan" autofocus>

        <label for="habitat" class="sr-only">Habitat</label>
        <input type="text" id="habitat" name="habitat" class="form-control" placeholder="Habitat" autofocus>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Enter Animal</button>
  </form>
  </div>
  <h2>Add Pathogen</h2>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#pathogen">Add Pathogen</button>
  <div id="pathogen" class="collapse">
  <form class="form-pathogen" method="post" action="" id="form-pathogen">
        <label for="scinamepa" class="sr-only">Scientific Name</label>
        <input type="text" id="scinamepa" name="scinamepa" class="form-control" placeholder="Scientific Name" required autofocus>

        <label for="Thumbnail" class="sr-only">Thumbnail</label>
        <input type="text" id="Thumbnail" name="Thumbnail" class="form-control" placeholder="Thumbnail" autofocus>

        <label for="common_name" class="sr-only">Common Name</label>
        <input type="text" id="common_name" name="common_name" class="form-control" placeholder="Common Name" autofocus>

        <label for="aquatic_or_not" class="sr-only">Aquatic or Not</label>
        <label><input type="radio" id="aquatic_or_not" name="aquatic_or_not" class="form-control" value="a" autofocus>Aquatic</label>
        <label><input type="radio" id="aquatic_or_not" name="aquatic_or_not" class="form-control" value="na" autofocus>Not aquatic</label>

        <label for="Concern" class="sr-only">Concern</label>
        <input type="text" id="concern" name="concern" class="form-control" placeholder="Concern" autofocus>

        <label for="management" class="sr-only">Management</label>
        <input type="text" id="management" name="management" class="form-control" placeholder="Management" autofocus>
        
        <label for="generaldesc" class="sr-only">General Description</label>
        <input type="text" id="generaldesc" name="generaldesc" class="form-control" placeholder="General Description" autofocus>

        <label for="references" class="sr-only">References</label>
        <input type="text" id="references" name="references" class="form-control" placeholder="References" autofocus>

        <label for="type" class="sr-only">Type</label>
        <input type="text" id="type" name="type" class="form-control" placeholder="Type" autofocus>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Enter Pathogen</button>
  </form>
  </div>
  <h2>Add Species Impacted by Pathogen</h2>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#pathspec">Add Species Impacted by Pathogen</button>
  <div id="pathspec" class="collapse">
  <form class="form-specimp" method="post" action="" id="form-specimp">
  <h1 class="h3 mb-3 font-weight-normal">Please Enter Impacted Species information</h1>
        
        <label for="sname" class="sr-only">Scientific name</label>
            <input type="sname" id="sname" name="sname" class="form-control" placeholder="Scientific Name" required autofocus>
            
        <label for="cname" class="sr-only">Common name</label>
            <input type="cname" id="cname" name="cname" class="form-control" placeholder="Common Name" autofocus>
        
        <label for="gendesc" class="sr-only">General Description</label>
            <input type="gendesc" id="gendesc" name="gendesc" class="form-control" placeholder="General Description" autofocus>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Add Species Impacted by Pathogen</button>
  </form>
  </div>
  <h2>Add Agency</h2>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#agency">Add Agency</button>
  <div id="agency" class="collapse">
  <form class="form-agency" method="post" action="" id="form-agency">
  <h1 class="h3 mb-3 font-weight-normal">Please Enter Agency information</h1>
 
        <label for="aname" class="sr-only">name</label>
            <input type="aname" id="aname" name="aname" class="form-control" placeholder="Agency Name" required autofocus>
            
        <label for="site" class="sr-only">Website</label>
            <input type="site" id="site" name="site" class="form-control" placeholder="Website" autofocus>
        
        <label for="Jurisdiction" class="sr-only">Jurisdiction</label>
            <input type="Jurisdiction" id="Jurisdiction" name="Jurisdiction" class="form-control" placeholder="Jurisdiction" >
            <button class="btn btn-lg btn-primary btn-block" type="submit">Add Jurisdiction</button>
  </form>
  </div>
  <h2>Invasive Status</h2>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#invstatus">Add Invasive Status</button>
  <div id="invstatus" class="collapse">
  <form class="form-invstat" method="post" action="" id="form-invstat">
  
  <h1 class="h3 mb-3 font-weight-normal">Please Enter the Invasive Status information</h1>
         <label for="itype" class="sr-only">type</label>
            <input type="itype" id="itype" name="itype" class="form-control" placeholder="Invasive Status Type" required autofocus>
        
        <label for="LAN" class="sr-only">Legal Act Number</label>
            <input type="LAN" id="LAN" name="LAN" class="form-control" placeholder="Legal Act Number" required autofocus>
 
            
        <label for="invdesc" class="sr-only">Invasive Status</label>
            <input type="invdesc" id="invdesc" name="invdesc" class="form-control" placeholder="Invasive Status Description" autofocus>
            
            <button class="btn btn-lg btn-primary btn-block" type="submit">Add Invasive Status</button>                  

  </form>
  </div>
  <h2>Distribution Method</h2>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#distrmethod">Add Species Impacted by Pathogen</button>
  <div id="distrmethod" class="collapse">
  <form class="form-dm" method="post" action="" id="form-dm">
        <h1 class="h3 mb-3 font-weight-normal">Please Enter the Distribution Method information</h1>
 
		<label for="dtype" class="sr-only">type</label>
        <input type="dtype" id="dtype" name="dtype" class="form-control" placeholder="Type" required autofocus>

		<label for="dmdesc" class="sr-only">DM Description</label>
        <input type="dmdesc" id="dmdesc" name="dmdesc" class="form-control" placeholder="Distribution Method Description"  autofocus>
		
		<label for="Preventative_Measures" class="sr-only">Preventative_Measures</label>
        <input type="Preventative_Measures" id="Preventative_Measures" name="Preventative_Measures" class="form-control" placeholder="Preventative_Measures" autofocus>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Add Distribution Method</button>
  </form>
  </div>
  
	<form action="" method="post">
	<br><br>
	<!<input type="submit" name="Go" value="Logout" />
	<button class="btn btn-outline-dark btn-lg " name="Go" type="submit" >Logout</button>
	<br><br>
	</form>  
  
  
  
</div>


</body>
</html>
