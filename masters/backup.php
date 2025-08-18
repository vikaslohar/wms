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
	$year1=$_SESSION['ayear1'];
	$year2=$_SESSION['ayear2'];
	$username= $_SESSION['username'];
	$yearid_id=$_SESSION['yearid_id'];
	$role=$_SESSION['role'];
    $loginid=$_SESSION['loginid'];
    $logid=$_SESSION['logid'];
	$lgnid=$_SESSION['logid'];
	$plantcode=$_SESSION['plantcode'];
	$plantcode1=$_SESSION['plantcode1'];
	$plantcode2=$_SESSION['plantcode2'];
	$plantcode3=$_SESSION['plantcode3'];
	$plantcode4=$_SESSION['plantcode4'];
	}
	require_once("../include/config.php");
	require_once("../include/connection.php");
	ini_set("memory_limit","80M");
	
//$yrs="vnrseeds_lgen";
$yrs="seedtracwms";
$db_host = "localhost";
$db_name = $yrs;
/*$db_user = "vnrseeds";
$db_pass = "ZWDAHcMBBb";*/
$db_user = "root";
$db_pass = "ispl123";
mysql_connect($db_host,$db_user,$db_pass);
@mysql_select_db($db_name) or die("Unable to select database.");
function datadump ($table) 
{
//$result="";  
   $result .= "# Dump of $table \n";
    $result .= "# Dump DATE : " . date("d-M-Y") ."\n\n";
    $query = mysqli_query($link,"select * from $table");
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
$table1 = datadump ("tblarrival");$table2 = datadump ("tblarrival_sub");$table3 = datadump ("tblarr_sloc");$table4 = datadump ("tblbin");$table5 = datadump ("tblclassification");$table6 = datadump ("tblcountry");$table7 = datadump ("tblcrop");$table8 = datadump ("tblcropdesc");$table9 = datadump ("tbldept");$table10 = datadump ("tbldestination");$table11 = datadump ("tblfaq");$table12 = datadump ("tblfarmer");$table13 = datadump ("tblhelp");$table14 = datadump ("tbllot");$table15 = datadump ("tbllotimp");$table16 = datadump ("tblopr");$table17 = datadump ("tblorganiser");$table18 = datadump ("tblproductionlocation");$table19 = datadump ("tblproductionpersonnel");$table20 = datadump ("tblspcodes"); $table21 = datadump ("tblspctmp"); $table22 = datadump ("tblspdec"); $table23 = datadump ("tblstages"); $table24 = datadump ("tblstock"); $table25 = datadump ("tblstock_sub"); $table26 = datadump ("tblsubbin"); $table27 = datadump ("tblups"); $table28 = datadump ("tblups_tdf"); $table29 = datadump ("tbluser"); $table30 = datadump ("tblvariety"); $table31 = datadump ("tblvarietyprevillege"); $table32 = datadump ("tblwarehouse"); $table33 = datadump ("tblyears"); $table34 = datadump ("tbl_arr_pack"); $table35 = datadump ("tbl_bin"); $table36 = datadump ("tbl_csw"); $table37 = datadump ("tbl_csw_main"); $table38 = datadump ("tbl_drying"); $table39 = datadump ("tbl_dryingsub"); $table40 = datadump ("tbl_gate"); $table41 = datadump ("tbl_gotqc"); $table42 = datadump ("tbl_gotqc1"); $table43 = datadump ("tbl_got_update"); $table44 = datadump ("tbl_gsample"); $table45 = datadump ("tbl_gsample1"); $table46 = datadump ("tbl_lgenyear"); $table47 = datadump ("tbl_lot_ldg"); $table48 = datadump ("tbl_lot_ldg_pack"); $table49 = datadump ("tbl_orderm"); $table50 = datadump ("tbl_order_sub"); $table51 = datadump ("tbl_order_sub_sub"); $table52 = datadump ("tbl_parameters"); $table53 = datadump ("tbl_partymaser"); $table54 = datadump ("tbl_qcgen"); $table55 = datadump ("tbl_qcgen1"); $table56 = datadump ("tbl_qctest"); $table57 = datadump ("tbl_rsw"); $table58 = datadump ("tbl_rswrem"); $table59 = datadump ("tbl_rswremsub_sub"); $table60 = datadump ("tbl_rswrem_sub"); $table61 = datadump ("tbl_rsw_main"); $table62 = datadump ("tbl_sloc"); $table63 = datadump ("tbl_sloc_sub"); $table64 = datadump ("tbl_stldg_damage"); $table65 = datadump ("tbl_stldg_good"); $table66 = datadump ("tbl_stlotimp"); $table67 = datadump ("tbl_stlotimp_pack"); $table68 = datadump ("tbl_subbin"); $table69 = datadump ("tbl_susorderm"); $table70 = datadump ("tbl_viewer"); $table71 = datadump ("tbl_warehouse"); 
$content = $table1.$table2.$table3.$table4.$table5.$table6.$table7.$table8.$table9.$table10.$table11.$table12.$table13.$table14.$table15.$table16.$table17.$table18.$table19.$table21.$table22.$table23.$table24.$table25.$table26.$table27.$table28.$table29.$table30.$table31.$table32.$table33.$table34.$table35.$table36.$table37.$table38.$table39.$table40.$table41.$table42.$table43.$table44.$table45.$table46.$table47.$table48.$table49.$table50.$table51.$table52.$table53.$table54.$table55.$table56.$table57.$table58.$table59.$table60.$table61.$table62.$table63.$table64.$table65.$table66.$table67.$table68.$table69.$table70.$table71;
$file_name="Backup_".$yrs."_".date("d-m-Y").'.sql';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$file_name");
echo $content;exit;?>