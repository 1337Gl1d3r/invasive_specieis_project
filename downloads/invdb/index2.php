<html>
<body>
<h1>INVASIVE SPECIES DATABASE</h1>
<?php
 echo "Welcome!";
 echo "test2";
?>
</body>
</html>

<!--http://webreference.com/programming/php/search/index-2.html -->
<!DOCTYPE  HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"  "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta  http-equiv="Content-Type" content="text/html;  charset=iso-8859-1">
    <title>Search  Contacts</title>
  </head>
  <p><body>
    <h3>Search </h3>
    <p>Search Shit Here</p>
    <form  method="post" action=""  id="searchform">
      <input  type="text" name="input"><br />
      <input  type="submit" name="submit" value="Search">
    </form>
    <?php
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
    echo "Connected successfully\n";
    echo "<br>";
    echo "<br>";    
	
	////////////////////////////////////////////////////////////////////////////////	
	if(isset($_POST['submit']))
	{ 

		if (!empty($_REQUEST['input'])) 
		{
			$input = mysqli_real_escape_string($conn, $_REQUEST['input']);     
			$sql = $sql = "SELECT * FROM `admin` 
			WHERE `id` LIKE '%" . $input . "%' 
				OR `password` LIKE '%" . $input . "%'";
			$query = mysqli_query($conn, $sql); 

			if($query->num_rows > 0)
			{
				while ($row = mysqli_fetch_array($query))
				{   
					echo "<br>" . "admin id: " . $row["id"];
					echo "<br>" . "password: " . $row["password"];   
				}
			}
			else 
			{
				echo "<br>" . "Sorry, No results found.";
			} 
		}
	}
	////////////////////////////////////////////////////////////////////////////////
 $query = "Ranunculus acris";
    // ====================================================================================
    //                               SPECIFIC PLANTS
    // ====================================================================================    
    $sqlPLANT = "SELECT `e_invasive_species`.*, `e_plants`.*, `r_has`.*, `r_who_can_help`.*,
                        `r_spread_by`.*, `r_legal_status`.*\n"

        . "FROM `e_invasive_species`\n"
        
        . "    LEFT JOIN `e_plants` ON `e_plants`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"
        
        . "    LEFT JOIN `r_has` ON `r_has`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"
        
        . "    LEFT JOIN `r_who_can_help` ON `r_who_can_help`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"

        . "    LEFT JOIN `r_spread_by` ON `r_spread_by`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"

        . "    LEFT JOIN `r_legal_status` ON `r_legal_status`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"        
        
        . "    WHERE `e_invasive_species`.`inv_sci_name` = \"$query\"";  
        
    $result = $conn->query($sqlPLANT);        
    
    if ($result->num_rows > 0)
    {
    // output data of each row
    while($row = $result->fetch_assoc())
    {
    // ===============================================================
    echo "<br>";
    echo "<br>";
    echo "<strong>Scientific Name: </strong>"."<i>".$row["inv_sci_name"]."</i>";
    echo "<br>";
    echo "<br>";
    echo "<strong>Common Name: </strong>".$row["inv_com_name"];
    echo "<br>";
    echo "<br>";
    echo $row["inv_desc"];
    echo "<br>";
    echo "<br>";
    echo "<strong>Is Aquatic: </strong>".$row["aquatic"].".";
    echo "<br>";
    echo "<br>";
    echo "<strong>Concern: </strong>".$row["concern"];    
    echo "<br>";    
    echo "<br>";
    echo "<strong>Spread By: </strong>".$row["dist_type"].".";    
    echo "<br>";    
    echo "<br>";
    echo "<strong>Management: </strong>".$row["management"];
    echo "<br>";
    echo "<br>";
    echo "<strong>Life Cycle: </strong>".$row["lc_type"].".";
    echo "<br>";
    echo "<br>";
    echo "<strong>Flower Description: </strong>".$row["flower_desc"];    
    echo "<br>";   
    echo "<br>";    
    echo "<strong>Leaf Description: </strong>".$row["leaf_desc"];
    echo "<br>";  
    echo "<br>";
    echo "<strong>Stem Description: </strong>".$row["stem_desc"];
    echo "<br>";  
    echo "<br>";
    echo "<strong>Root Description: </strong>".$row["root_desc"];
    echo "<br>";
    echo "<br>";
    echo "<strong>Seed Description: </strong>".$row["seed_desc"];
    echo "<br>";
    echo "<br>";
    echo "<strong>Similar Species: </strong>".$row["similar_species"].".";
    echo "<br>";
    echo "<br>";
    echo "<strong>Legal Status: </strong>".$row["inv_status"].".";
    echo "<br>";
    echo "<br>";
    echo "<strong>Who Can Help: </strong>".$row["agency_name"].".";
    echo "<br>";
    echo "<br>";
    echo "<strong>References: </strong>".$row["inv_ref"].".";
    }
    }
    else
    {
    echo "0 results";
    }

    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";    
    


 $query2 = "Plasmodiophora brassicae";
    // ====================================================================================
    //                               PATHOGENS PLANTS
    // ====================================================================================    
    $sqlPATH = "SELECT `e_invasive_species`.*, `e_pathogens`.*, `r_who_can_help`.*, `r_impacts`.*,
                        `r_spread_by`.*, `e_impacted_species`.*, `r_legal_status`.*\n"

        . "FROM `e_invasive_species`\n"
        
        . "    LEFT JOIN `e_pathogens` ON `e_pathogens`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"
        
        . "    LEFT JOIN `r_who_can_help` ON `r_who_can_help`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"
        
        . "    LEFT JOIN `r_impacts` ON `r_impacts`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"
        
        . "    LEFT JOIN `e_impacted_species` ON `e_impacted_species`.`imp_sci_name` = `r_impacts`.`imp_sci_name`\n"

        . "    LEFT JOIN `r_spread_by` ON `r_spread_by`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"

        . "    LEFT JOIN `r_legal_status` ON `r_legal_status`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"        
        
        . "    WHERE `e_invasive_species`.`inv_sci_name` = \"$query2\"";  
        
    $result = $conn->query($sqlPATH);        
    
    if ($result->num_rows > 0)
    {
    // output data of each row
    while($row = $result->fetch_assoc())
    {
    // ===============================================================
    echo "<br>";
    echo "<br>";
    echo "<strong>Scientific Name: </strong>"."<i>".$row["inv_sci_name"]."</i>";
    echo "<br>";
    echo "<br>";
    echo "<strong>Common Name: </strong>".$row["inv_com_name"];
    echo "<br>";
    echo "<br>";
    echo $row["inv_desc"];
    echo "<br>";
    echo "<br>";
    echo "<strong>Is Aquatic: </strong>".$row["aquatic"].".";
    echo "<br>";
    echo "<br>";
    echo "<strong>Pathogen Type: </strong>".$row["path_type"].".";
    echo "<br>";
    echo "<br>";
    echo "<strong>Impacted Species: </strong>".$row["imp_com_name"].".";    
    echo "<br>";
    echo "<br>";
    echo "<strong>Concern: </strong>".$row["concern"];    
    echo "<br>";    
    echo "<br>";
    echo "<strong>Spread By: </strong>".$row["dist_type"].".";    
    echo "<br>";    
    echo "<br>";
    echo "<strong>Management: </strong>".$row["management"];
    echo "<br>";
    echo "<br>";
    echo "<strong>Legal Status: </strong>".$row["inv_status"].".";
    echo "<br>";
    echo "<br>";
    echo "<strong>Who Can Help: </strong>".$row["agency_name"].".";
    echo "<br>";
    echo "<br>";
    echo "<strong>References: </strong>".$row["inv_ref"].".";
    }
    }
    else
    {
    echo "0 results";
    }

    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";        



    
 $query3 = "Sus scrofus L.";
    // ====================================================================================
    //                               PATHOGENS PLANTS
    // ====================================================================================    
    $sqlPATH = "SELECT `e_invasive_species`.*, `e_animals`.*, `r_who_can_help`.*,
                        `r_spread_by`.*, `r_legal_status`.*\n"

        . "FROM `e_invasive_species`\n"
        
        . "    LEFT JOIN `e_animals` ON `e_animals`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"
        
        . "    LEFT JOIN `r_who_can_help` ON `r_who_can_help`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"       

        . "    LEFT JOIN `r_spread_by` ON `r_spread_by`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"

        . "    LEFT JOIN `r_legal_status` ON `r_legal_status`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"        
        
        . "    WHERE `e_invasive_species`.`inv_sci_name` = \"$query3\"";  
        
    $result = $conn->query($sqlPATH);        
    
    if ($result->num_rows > 0)
    {
    // output data of each row
    while($row = $result->fetch_assoc())
    {
    // ===============================================================
    echo "<br>";
    echo "<br>";
    echo "<strong>Scientific Name: </strong>"."<i>".$row["inv_sci_name"]."</i>";
    echo "<br>";
    echo "<br>";
    echo "<strong>Common Name: </strong>".$row["inv_com_name"];
    echo "<br>";
    echo "<br>";
    echo $row["inv_desc"];
    echo "<br>";
    echo "<br>";
    echo "<strong>Is Aquatic: </strong>".$row["aquatic"].".";
    echo "<br>";
    echo "<br>";
    echo "<strong>Type: </strong>".$row["subphylum"];
    echo "<br>";
    echo "<br>";
    echo "<strong>Concern: </strong>".$row["concern"];    
    echo "<br>";    
    echo "<br>";
    echo "<strong>Spread By: </strong>".$row["dist_type"].".";    
    echo "<br>";    
    echo "<br>";
    echo "<strong>Management: </strong>".$row["management"];
    echo "<br>";
    echo "<br>";
    echo "<strong>Legal Status: </strong>".$row["inv_status"].".";
    echo "<br>";
    echo "<br>";
    echo "<strong>Who Can Help: </strong>".$row["agency_name"].".";
    echo "<br>";
    echo "<br>";
    echo "<strong>References: </strong>".$row["inv_ref"].".";
    }
    }
    else
    {
    echo "0 results";
    }

    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";       
    
    
    
    // ====================================================================================
    //                                     COLOR
    // ====================================================================================
    $COLOR = "yellow";
    echo $COLOR;
    
    $sqlFAM = "SELECT `e_invasive_species`.*, `m_flower_colour`.*, `e_plants`.*\n"

        . "FROM `e_invasive_species`\n"

        . "    LEFT JOIN `e_plants` ON `e_plants`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"
        
        . "    LEFT JOIN `m_flower_colour` ON `m_flower_colour`.`inv_sci_name` = `e_invasive_species`.`inv_sci_name`\n"
       
        . "    WHERE `m_flower_colour`.`color` = \"$COLOR\"";   
   
    $result = $conn->query($sqlFAM);
 
    if ($result->num_rows > 0)
    {
    // output data of each row
    while($row = $result->fetch_assoc())
    {
    echo "<br>"."===================================================";
    echo "<br>"."COLOR QUERY";
    echo "<br>"."===================================================";
    echo "<br>";
    //
    // ===============================================================
    //
    echo "<br>"
    ."<strong>Common Name: </strong>". $row["inv_com_name"];
    echo "<br>";
    $image = $row["thumbnail"];
    $path = "images/";
    echo '<img src="'.$path.''.$image.'" width="200" />';
    echo "<br>";
    echo "<br>";
    echo "<br>";   
    echo "<br>";
    }
    }
    else
    {
    echo "0 results";
    }
    echo "<br>";
    echo "<br>";
   
    // ==================================================================================== 
    
    $conn->close();
    ?>
  </body>
</html>
</p>

