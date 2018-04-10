<?php 

include_once "/commons.php";

// connect to the db
$DB = get_mysqli_localhost("471_db");

/**
 * 	Okay so here is the general layout for how the queries should go... I've written some functions that you'll use
 * 	to make everyones lives easier and included them in the library 
 *
 * 	general syntax cor queries should be:
 *
 *  $SQL_QUERY = "SELECT YOUR DATA WITH FORMAT MODIFIERS LIKE '%s'";
 *  $result = attempt_query($DB, sprintf($SQL_QUERY, <%S MODIFIER VARIABLE>);
 */

?>
