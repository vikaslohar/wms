<?php 
  include("config1.php"); 
    // Connect to Host //
   // $link = mysql_connect($db_host, $db_user, $db_pass)  or die ('Not connected : ' . mysqli_error($link));
  //  mysql_select_db($db_name, $link) or die ('Can\'t use $db_name : ' . mysqli_error($link)); 
	$link = mysqli_connect($db_host, $db_user, $db_pass)  or die ('Not connected : ' . mysqli_error());
    mysqli_select_db($link, $db_name) or die ('Can\'t use $db_name : ' . mysqli_error());
?>