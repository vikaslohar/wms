<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}
	else
	{
	$yearname=$_SESSION['cropname'];
	}
	require_once("../include/config.php");
	require_once("../include/connection.php");
	ini_set("memory_limit","80M");
	
$yrs="seedtraccsw$yearname";
$db_host = "localhost";
$db_name = $yrs;
$db_user = "root";
$db_pass = "";
mysql_connect($db_host,$db_user,$db_pass);
@mysql_select_db($db_name) or die("Unable to select database.");
function datadump ($table){
//$result="";  

    $result .= "# Dump of $table \n";
    $result .= "# Dump DATE : " . date("d-M-Y") ."\n\n";
    $query = mysqli_query($link,"select * from tblcrop");
    $num_fields = @mysql_num_fields($query);
    $numrow = mysqli_num_rows($query);
	
	
    for ($i =0; $i<$numrow; $i++)
	{
	while($row = mysqli_fetch_row($query))
	{
      $result .= "INSERT INTO ".$table." VALUES(";
          for($j=0; $j<$num_fields; $j++)
		  {
          $row[$j] = addslashes($row[$j]);
          $row[$j] = ereg_replace("\n","\\n",$row[$j]);
          if (isset($row[$j])) $result .= "\"$row[$j]\"" ; else $result .= "\"\"";
          if ($j<($num_fields-1)) $result .= ",";
         }   
      $result .= ");\n";
     }}
     return $result . "\n\n\n";
  }
$table1 = datadump ("tblcrop");$table2 = datadump ("tblvariety");
$content = $table2.$table2.
$file_name="Backup_".$yrs."_".date("d-m-Y").'.sql';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$file_name");
echo $content;exit;?>