<?php
ini_set("memory_limit","800M");	
$connnew = mysqli_connect("172.16.16.52:3306","rootnew","New@201786") or die("Error:".mysqli_error($connnew));
$dbnew = mysqli_select_db($connnew,"seedtracwms_hyd") or die("Error:".mysqli_error($connnew));


$sql_crp=mysqli_query($connnew,"select * from tblcrop ") or die(mysqli_error($connnew));
$row_crp=mysqli_fetch_array($sql_crp);
echo $crpn=$row_crp['cropname'];
?>
