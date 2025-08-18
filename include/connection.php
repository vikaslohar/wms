<?php 
  include("config.php"); 
ini_set('memory_limit', '5120M');
	set_time_limit(0);	
	ini_set('max_input_vars','3000' );
	global $link;
error_reporting(E_ERROR | E_PARSE);
    // Connect to Host //
   // $link = mysql_connect($db_host, $db_user, $db_pass)  or die ('Not connected : ' . mysqli_error($link));
  //  mysql_select_db($db_name, $link) or die ('Can\'t use $db_name : ' . mysqli_error($link));
	
	$link = mysqli_connect($db_host, $db_user, $db_pass)  or die ('Not connected : ' . mysqli_error());
    mysqli_select_db($link, $db_name) or die ('Can\'t use $db_name : ' . mysqli_error());

	$flg=0; $flg1=0; $flg2=0;
?>
