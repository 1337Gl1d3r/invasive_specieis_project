<?php
include_once "../php/commons.php";

if(!isset($_SESSION["user"]))
{
    header("Location: index.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    $conn = get_mysqli_localhost();
    // Check connection
    if (!$conn) 
	{
        die("Connection failed: " . mysqli_connect_error());
    }
    //echo "Connected successfully\n";  
    if (isset($_POST['leaf_desc']) && isset($_POST['rootdesc']) && isset($_POST['sciname']) && isset($_POST['Thumbnail']) && isset($_POST['common_name']) && isset($_POST['aquatic_or_not']) && isset($_POST['aquatic_or_not']) && isset($_POST['concern']) && isset($_POST['management']) && isset($_POST['generaldesc']) && isset($_POST['references']) && isset($_POST['flowerdesc']) && isset($_POST['stemdesc']) && isset($_POST['flowcol']) && isset($_POST['leafdesc']) && isset($_POST['seeddesc']) && isset($_POST['simspec']) && isset($_POST['simspec']))
    {
        $sciname = mysqli_real_escape_string($conn, $_REQUEST['sciname']);
        $Thumbnail = mysqli_real_escape_string($conn, $_REQUEST['Thumbnail']);
        $common_name = mysqli_real_escape_string($conn, $_REQUEST['common_name']);
        $aquatic_or_not = mysqli_real_escape_string($conn, $_REQUEST['aquatic_or_not']);
        if ($aquatic_or_not === "na")
        {
            $aquatic_or_not = FALSE;
        }
        else
        {
            $aquatic_or_not = TRUE;
        }
        $concern = mysqli_real_escape_string($conn, $_REQUEST['concern']);
        $management = mysqli_real_escape_string($conn, $_REQUEST['management']);
        $generaldesc = mysqli_real_escape_string($conn, $_REQUEST['generaldesc']);
        $references = mysqli_real_escape_string($conn, $_REQUEST['references']);
        $flowerdesc = mysqli_real_escape_string($conn, $_REQUEST['flowerdesc']);
        $stemdesc = mysqli_real_escape_string($conn, $_REQUEST['stemdesc']);
        $flowcol = mysqli_real_escape_string($conn, $_REQUEST['flowcol']);
        $leafdesc = mysqli_real_escape_string($conn, $_REQUEST['leafdesc']);
        $seeddesc = mysqli_real_escape_string($conn, $_REQUEST['seeddesc']);
        $simspec = mysqli_real_escape_string($conn, $_REQUEST['simspec']);
        $rootdesc = mysqli_real_escape_string($conn, $_REQUEST['rootdesc']);
        $leaf_desc = mysqli_real_escape_string($conn, $_REQUEST['leaf_desc']);
        $sql = "INSERT INTO `e_invasive_species` (`inv_sci_name`, `inv_com_name`, `thumbnail`, `aquatic`, `inv_desc`, `concern`, `management`, `inv_ref`) 
        VALUES ('$sciname', '$common_name', '$Thumbnail', '$aquatic_or_not', NULL, '$concern', '$management', '$references')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $sql = "INSERT INTO `e_plants` (`inv_sci_name`, `root_desc`, `seed_desc`, `leaf_desc`, `flower_desc`, `stem_desc`, `similar_species`) 
        VALUES ('$sciname', '$rootdesc', '$seeddesc', '$leaf_desc', '$flowerdesc', '$stemdesc', '$simspec')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    elseif (isset($_POST['famdesc']) && isset($_POST['name']))
    {
        $famdesc = mysqli_real_escape_string($conn, $_REQUEST['famdesc']);
        $name = mysqli_real_escape_string($conn, $_REQUEST['name']);
        $sql = "INSERT INTO `e_family` (`family_name`, `family_desc`) 
        VALUES ('$name', '$famdesc')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    elseif (isset($_POST['lifecyc']) && isset($_POST['type']) && isset($_POST['implication']))
    {
        $lifecyc = mysqli_real_escape_string($conn, $_REQUEST['lifecyc']);
        $type = mysqli_real_escape_string($conn, $_REQUEST['type']);
        $implication = mysqli_real_escape_string($conn, $_REQUEST['implication']);
        $sql = "INSERT INTO `e_life_cycle` (`lc_type`, `implication`, `lc_desc`) 
        VALUES ('$lifecyc', '$type', '$implication')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    elseif (isset($_POST['sciname']) && isset($_POST['Thumbnail']) && isset($_POST['common_name']) && isset($_POST['aquatic_or_not']) && isset($_POST['concern']) && isset($_POST['management']) && isset($_POST['generaldesc']) && isset($_POST['references']) && isset($_POST['vertebrate_or_invert']) && isset($_POST['reproduc']) && isset($_POST['lifespan']) && isset($_POST['habitat']))
    {
        $sciname = mysqli_real_escape_string($conn, $_REQUEST['sciname']);
        $Thumbnail = mysqli_real_escape_string($conn, $_REQUEST['Thumbnail']);
        $common_name = mysqli_real_escape_string($conn, $_REQUEST['common_name']);
        $aquatic_or_not = mysqli_real_escape_string($conn, $_REQUEST['aquatic_or_not']);
        if ($aquatic_or_not === "na")
        {
            $aquatic_or_not = FALSE;
        }
        else
        {
            $aquatic_or_not = TRUE;
        }
        $concern = mysqli_real_escape_string($conn, $_REQUEST['concern']);
        $management = mysqli_real_escape_string($conn, $_REQUEST['management']);
        $generaldesc = mysqli_real_escape_string($conn, $_REQUEST['generaldesc']);
        $references = mysqli_real_escape_string($conn, $_REQUEST['references']);
        $vertebrate_or_invert = mysqli_real_escape_string($conn, $_REQUEST['vertebrate_or_invert']);
        $reproduc = mysqli_real_escape_string($conn, $_REQUEST['reproduc']);
        $lifespan = mysqli_real_escape_string($conn, $_REQUEST['lifespan']);
        $habitat = mysqli_real_escape_string($conn, $_REQUEST['habitat']);
        $sql = "INSERT INTO `e_invasive_species` (`inv_sci_name`, `inv_com_name`, `thumbnail`, `aquatic`, `inv_desc`, `concern`, `management`, `inv_ref`) 
        VALUES ('$sciname', '$common_name', '$Thumbnail', '$aquatic_or_not', NULL, '$concern', '$management', '$references')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $sql = "INSERT INTO `e_animals` (`inv_sci_name`, `subphylum`, `reproduction`, `life_span`, `habitat`) 
        VALUES ('$sciname', NULL, '$reproduc', '$lifespan', '$habitat')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    elseif (isset($_POST['sciname']) && isset($_POST['Thumbnail']) && isset($_POST['common_name']) && isset($_POST['aquatic_or_not']) && isset($_POST['concern']) && isset($_POST['management']) && isset($_POST['generaldesc']) && isset($_POST['references']) && isset($_POST['type']))
    {
        $sciname = mysqli_real_escape_string($conn, $_REQUEST['sciname']);
        $Thumbnail = mysqli_real_escape_string($conn, $_REQUEST['Thumbnail']);
        $common_name = mysqli_real_escape_string($conn, $_REQUEST['common_name']);
        $aquatic_or_not = mysqli_real_escape_string($conn, $_REQUEST['aquatic_or_not']);
        if ($aquatic_or_not === "na")
        {
            $aquatic_or_not = FALSE;
        }
        else
        {
            $aquatic_or_not = TRUE;
        }
        $concern = mysqli_real_escape_string($conn, $_REQUEST['concern']);
        $management = mysqli_real_escape_string($conn, $_REQUEST['management']);
        $generaldesc = mysqli_real_escape_string($conn, $_REQUEST['generaldesc']);
        $references = mysqli_real_escape_string($conn, $_REQUEST['references']);
        $type = mysqli_real_escape_string($conn, $_REQUEST['type']);
        $sql = "INSERT INTO `e_invasive_species` (`inv_sci_name`, `inv_com_name`, `thumbnail`, `aquatic`, `inv_desc`, `concern`, `management`, `inv_ref`) 
        VALUES ('$sciname', '$common_name', '$Thumbnail', '$aquatic_or_not', NULL, '$concern', '$management', '$references')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $sql = "INSERT INTO `e_pathogens` (`inv_sci_name`, `path_type`) 
        VALUES ('$sciname', '$type')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    elseif (isset($_POST['sname']) && isset($_POST['cname']) && isset($_POST['gendesc']))
    {
        $sname = mysqli_real_escape_string($conn, $_REQUEST['sname']);
        $cname = mysqli_real_escape_string($conn, $_REQUEST['cname']);
        $gendesc = mysqli_real_escape_string($conn, $_REQUEST['gendesc']);
        $sql = "INSERT INTO `e_impacted_species` (`imp_sci_name`, `imp_com_name`, `imp_desc`) 
        VALUES ('$sname', '$cname', '$gendesc')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    elseif (isset($_POST['site']) && isset($_POST['name']) && isset($_POST['Jurisdiction']))
    {
        $site = mysqli_real_escape_string($conn, $_REQUEST['site']);
        $name = mysqli_real_escape_string($conn, $_REQUEST['name']);
        $Jurisdiction = mysqli_real_escape_string($conn, $_REQUEST['Jurisdiction']);
        $sql = "INSERT INTO `e_agency` (`agency_name`, `website`, `jurisdiction`) 
        VALUES ('$name', '$site', '$Jurisdiction')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    elseif (isset($_POST['invdesc']) && isset($_POST['type']) && isset($_POST['LAN']))
    {
        $invdesc = mysqli_real_escape_string($conn, $_REQUEST['invdesc']);
        $type = mysqli_real_escape_string($conn, $_REQUEST['type']);
        $LAN = mysqli_real_escape_string($conn, $_REQUEST['LAN']);
        $sql = "INSERT INTO `e_invasive_status` (`inv_status`, `legal_act_num`, `status_desc`) 
        VALUES ('$LAN', '$type', '$invdesc')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    elseif (isset($_POST['dmdesc']) && isset($_POST['type']) && isset($_POST['Preventative_Measures']))
    {
        $dmdesc = mysqli_real_escape_string($conn, $_REQUEST['dmdesc']);
        $type = mysqli_real_escape_string($conn, $_REQUEST['type']);
        $Preventative_Measures = mysqli_real_escape_string($conn, $_REQUEST['Preventative_Measures']);
        $sql = "INSERT INTO `e_distribution_method` (`dist_type`, `prev_measures`, `dist_desc`) 
        VALUES ('$type', '$Preventative_Measures', '$dmdesc')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}
?>



<!DOCTYPE html>
<html>
<!--
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="starter-template.css" rel="stylesheet">
</head>
-->

<?php include_once "header.php"; ?>
<body>


<div class="container">
  <h2>Add Plant</h2>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#plant">Add Plant</button>
  <div id="plant" class="collapse">
    <form class="form-plant" method="post" action="" id="form-plant">

        <h1 class="h3 mb-3 font-weight-normal">Please Enter the Plant information</h1>
        <label for="sciname" class="sr-only">Scientific Name</label>
        <input type="text" id="sciname" name="sciname" class="form-control" placeholder="Scientific Name" required autofocus>

        <label for="Thumbnail" class="sr-only">Thumbnail</label>
        <input type="text" id="Thumbnail" name="Thumbnail" class="form-control" placeholder="Thumbnail" required autofocus>

        <label for="common_name" class="sr-only">Common Name</label>
        <input type="text" id="common_name" name="common_name" class="form-control" placeholder="Common Name" required autofocus>

        <label for="aquatic_or_not" class="sr-only">Aquatic or Not</label>
        <label><input type="radio" id="aquatic" name="aquatic_or_not" class="form-control" value="a" required autofocus>Aquatic</label>
        <label><input type="radio" id="aquatic" name="aquatic_or_not" class="form-control" value="na" required autofocus>Not aquatic</label>

        <label for="Concern" class="sr-only">Concern</label>
        <input type="text" id="concern" name="concern" class="form-control" placeholder="Concern" required autofocus>

        <label for="management" class="sr-only">Management</label>
        <input type="text" id="management" name="management" class="form-control" placeholder="Management" required autofocus>
        
        <label for="generaldesc" class="sr-only">General Description</label>
        <input type="text" id="generaldesc" name="generaldesc" class="form-control" placeholder="General Description" required autofocus>

        <label for="leaf_desc" class="sr-only">Leaf Description</label>
        <input type="text" id="leaf_desc" name="leaf_desc" class="form-control" placeholder="Leaf Description" required autofocus>

        <label for="rootdesc" class="sr-only">Root Description</label>
        <input type="text" id="rootdesc" name="rootdesc" class="form-control" placeholder="Root Description" required autofocus>

        <label for="references" class="sr-only">References</label>
        <input type="text" id="references" name="references" class="form-control" placeholder="References" required autofocus>

        <label for="flowerdesc" class="sr-only">Flower Description</label>
        <input type="text" id="flowerdesc" name="flowerdesc" class="form-control" placeholder="Flower Description" required autofocus>

        <label for="stemdesc" class="sr-only">Stem Description</label>
        <input type="text" id="stemdesc" name="stemdesc" class="form-control" placeholder="Stem Description" required autofocus>

        <label for="flowcol" class="sr-only">Flower Colour</label>
        <input type="text" id="flowcol" name="flowcol" class="form-control" placeholder="Flower Colour" required autofocus>
        
        <label for="leafdesc" class="sr-only">Leaf Description</label>
        <input type="text" id="leafdesc" name="leafdesc" class="form-control" placeholder="Leaf Description" required autofocus>

        <label for="seeddesc" class="sr-only">Seed Description</label>
        <input type="text" id="seeddesc" name="seeddesc" class="form-control" placeholder="Seed Description" required autofocus>

        <label for="simspec" class="sr-only">Similar Species</label>
        <input type="text" id="Similar Species" name="simspec" class="form-control" placeholder="Similar Species" required autofocus>

        <label for="rootdesc" class="sr-only">Root Description</label>
        <input type="text" id="simspec" name="simspec" class="form-control" placeholder="Similar Species" required autofocus>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Enter Plant Info</button>
      </form>
  </div>

  <h2>Add Plant Family</h2>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#plantfam">Simple collapsible</button>
  <div id="plantfam" class="collapse">
  <form class="form-plantlc" method="post" action="" id="form-plantfam">
        <h1 class="h3 mb-3 font-weight-normal">Please Enter the Family information</h1>
        <label for="family" class="sr-only">Family Description</label>
        <input type="text" id="famdecs" name="famdesc" class="form-control" placeholder="Family Description" required autofocus>
        <label for="name" class="sr-only">name</label>
        <input type="name" id="name" name="name" class="form-control" placeholder="Family Name" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Enter Plant Family</button>
  </form>
  </div>

  <h2>Add Plant Life Cycle</h2>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#plantlife">Add Plant Life Cycle</button>
  <div id="plantlife" class="collapse">
  <form class="form-plantlc" method="post" action="" id="form-plantlc">
  <h1 class="h3 mb-3 font-weight-normal">Please Enter the Life Cycle information</h1>
        <label for="lifecyc" class="sr-only">LifeCycle Description</label>
		    <input type="lifecyc" id="lifecyc" name="lifecyc" class="form-control" placeholder="Life Cycle Description" required autofocus>
        <label for="type" class="sr-only">type</label>
		    <input type="type" id="type" name="type" class="form-control" placeholder="Type" required>
		    <label for="implication" class="sr-only">implication</label>
        <input type="implication" id="implication" name="implication" class="form-control" placeholder="Implication" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Enter Plant Life Cycle</button>
  </form>
  </div>

  <h2>Add Animal</h2>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#animals">Add Animal</button>
  <div id="animals" class="collapse">
  <form class="form-animal" method="post" action="" id="form-animal">
        <h1 class="h3 mb-3 font-weight-normal">Add Animal</h1>
        <label for="sciname" class="sr-only">Scientific Name</label>
        <input type="text" id="sciname" name="sciname" class="form-control" placeholder="Scientific Name" required autofocus>

        <label for="Thumbnail" class="sr-only">Thumbnail</label>
        <input type="text" id="Thumbnail" name="Thumbnail" class="form-control" placeholder="Thumbnail" required autofocus>

        <label for="common_name" class="sr-only">Common Name</label>
        <input type="text" id="common_name" name="common_name" class="form-control" placeholder="Common Name" required autofocus>

        <label for="aquatic_or_not" class="sr-only">Aquatic or Not</label>
        <label><input type="radio" id="aquatic" name="aquatic_or_not" class="form-control" value="a" required autofocus>Aquatic</label>
        <label><input type="radio" id="aquatic" name="aquatic_or_not" class="form-control" value="na" required autofocus>Not aquatic</label>

        <label for="Concern" class="sr-only">Concern</label>
        <input type="text" id="concern" name="concern" class="form-control" placeholder="Concern" required autofocus>

        <label for="management" class="sr-only">Management</label>
        <input type="text" id="management" name="management" class="form-control" placeholder="Management" required autofocus>
        
        <label for="generaldesc" class="sr-only">General Description</label>
        <input type="text" id="generaldesc" name="generaldesc" class="form-control" placeholder="General Description" required autofocus>

        <label for="references" class="sr-only">References</label>
        <input type="text" id="references" name="references" class="form-control" placeholder="References" required autofocus>

        <label for="vertebrate_or_invert" class="sr-only">Type</label>
        <input type="text" id="vertebrate_or_invert" name="vertebrate_or_invert" class="form-control" placeholder="Vertebrate or Invertebrate" required autofocus>

        <label for="reproduc" class="sr-only">Reproduction</label>
        <input type="text" id="reproduc" name="reproduc" class="form-control" placeholder="Reproduction" required autofocus>

        <label for="lifespan" class="sr-only">Lifespan</label>
        <input type="text" id="lifespan" name="lifespan" class="form-control" placeholder="Lifespan" required autofocus>

        <label for="habitat" class="sr-only">Habitat</label>
        <input type="text" id="habitat" name="habitat" class="form-control" placeholder="Habitat" required autofocus>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Enter Animal</button>
  </form>
  </div>
  <h2>Add Pathogen</h2>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#pathogen">Add Pathogen</button>
  <div id="pathogen" class="collapse">
  <form class="form-pathogen" method="post" action="" id="form-pathogen">
        <label for="sciname" class="sr-only">Scientific Name</label>
        <input type="text" id="sciname" name="sciname" class="form-control" placeholder="Scientific Name" required autofocus>

        <label for="Thumbnail" class="sr-only">Thumbnail</label>
        <input type="text" id="Thumbnail" name="Thumbnail" class="form-control" placeholder="Thumbnail" required autofocus>

        <label for="common_name" class="sr-only">Common Name</label>
        <input type="text" id="common_name" name="common_name" class="form-control" placeholder="Common Name" required autofocus>

        <label for="aquatic_or_not" class="sr-only">Aquatic or Not</label>
        <label><input type="radio" id="aquatic" name="aquatic_or_not" class="form-control" value="a" required autofocus>Aquatic</label>
        <label><input type="radio" id="aquatic" name="aquatic_or_not" class="form-control" value="na" required autofocus>Not aquatic</label>

        <label for="Concern" class="sr-only">Concern</label>
        <input type="text" id="concern" name="concern" class="form-control" placeholder="Concern" required autofocus>

        <label for="management" class="sr-only">Management</label>
        <input type="text" id="management" name="management" class="form-control" placeholder="Management" required autofocus>
        
        <label for="generaldesc" class="sr-only">General Description</label>
        <input type="text" id="generaldesc" name="generaldesc" class="form-control" placeholder="General Description" required autofocus>

        <label for="references" class="sr-only">References</label>
        <input type="text" id="references" name="references" class="form-control" placeholder="References" required autofocus>

        <label for="type" class="sr-only">Type</label>
        <input type="text" id="type" name="type" class="form-control" placeholder="Type" required autofocus>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Enter Pathogen</button>
  </form>
  </div>
  <h2>Add Species Impacted by Pathogen</h2>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#pathspec">Add Species Impacted by Pathogen</button>
  <div id="pathspec" class="collapse">
  <form class="form-specimp" method="post" action="" id="form-specimp">
  <h1 class="h3 mb-3 font-weight-normal">Please Enter Impacted Species information</h1>
        
        <label for="sname" class="sr-only">Scientific name</label>
            <input type="sname" id="sname" name="sname" class="form-control" placeholder="Scientific Name" required>
            
        <label for="cname" class="sr-only">Common name</label>
            <input type="cname" id="cname" name="cname" class="form-control" placeholder="Common Name" required>
        
        <label for="gendesc" class="sr-only">General Description</label>
            <input type="gendesc" id="gendesc" name="gendesc" class="form-control" placeholder="General Description" required autofocus>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Add Species Impacted by Pathogen</button>
  </form>
  </div>
  <h2>Add Agency</h2>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#agency">Add Agency</button>
  <div id="agency" class="collapse">
  <form class="form-agency" method="post" action="" id="form-agency">
  <h1 class="h3 mb-3 font-weight-normal">Please Enter Agency information</h1>
        
        <label for="site" class="sr-only">Website</label>
            <input type="site" id="site" name="site" class="form-control" placeholder="Agency" required autofocus>
            
        <label for="name" class="sr-only">name</label>
            <input type="name" id="name" name="name" class="form-control" placeholder="Agency Name" required>
        
        <label for="Jurisdiction" class="sr-only">Jurisdiction</label>
            <input type="Jurisdiction" id="Jurisdiction" name="Jurisdiction" class="form-control" placeholder="Jurisdiction" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Add Agency</button>
  </form>
  </div>
  <h2>Invasive Status</h2>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#invstatus">Add Invasive Status</button>
  <div id="invstatus" class="collapse">
  <form class="form-invstat" method="post" action="" id="form-invstat">
  <h1 class="h3 mb-3 font-weight-normal">Please Enter the Invasive Status information</h1>
        
        <label for="invdesc" class="sr-only">Invasive Status</label>
            <input type="invdesc" id="invdesc" name="invdesc" class="form-control" placeholder="Invasive Status Description" required autofocus>
            
        <label for="type" class="sr-only">type</label>
            <input type="type" id="type" name="type" class="form-control" placeholder="Type" required>
        
        <label for="LAN" class="sr-only">Legal Act Number</label>
            <input type="LAN" id="LAN" name="LAN" class="form-control" placeholder="Legal Act Number" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Add Invasive Status</button>
  </form>
  </div>
  <h2>Distribution Method</h2>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#distrmethod">Add Species Impacted by Pathogen</button>
  <div id="distrmethod" class="collapse">
  <form class="form-dm" method="post" action="" id="form-dm">
        <h1 class="h3 mb-3 font-weight-normal">Please Enter the Distribution Method information</h1>
        
		<label for="dmdesc" class="sr-only">DM Description</label>
        <input type="dmdesc" id="dmdesc" name="dmdesc" class="form-control" placeholder="Distribution Method Description" required autofocus>
        
		<label for="type" class="sr-only">type</label>
        <input type="type" id="type" name="type" class="form-control" placeholder="Type" required>
		
		<label for="Preventative_Measures" class="sr-only">Preventative_Measures</label>
        <input type="Preventative_Measures" id="Preventative_Measures" name="Preventative_Measures" class="form-control" placeholder="Preventative_Measures" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Add Distribution Method</button>
  </form>
  </div>
</div>


</body>
</html>