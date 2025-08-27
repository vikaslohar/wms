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
	
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$rettyp = $_REQUEST['rettyp'];	
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	
	if(isset($_POST['frm_action'])=='submit')
	{
	}

?>

<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />

<title>Qulaity -Report-GS Stock Report</title><table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="916" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-gssample.php?txtcrop=<?php echo $crop;?>&txtvariety=<?php echo $variety;?>&sdate=<?php echo $_REQUEST['sdate']?>&edate=<?php echo $_REQUEST['edate']?>&rettyp=<?php echo $_REQUEST['rettyp']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>


 <?php 
	
	
	$sdt1=explode("-",$sdate);
	$sdt2=explode("-",$edate);
	$sdate=$sdt1[2]."-".$sdt1[1]."-".$sdt1[0];
	$edate=$sdt2[2]."-".$sdt2[1]."-".$sdt2[0];
//echo $rettyp;
	
	
$ver="ALL";
		$sql_crp=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
		$row_crp=mysqli_fetch_array($sql_crp);
		$crp=$row_crp['cropname'];
	if($variety!="ALL")
	{	
		$ver=$variety;
	}
	
if($rettyp=="periodical")
{
	if($variety!="ALL")
	{
		$qry="select * from tbl_gsample where gsdate >= '$sdate' and gsdate <= '$edate' and  gscrop='$crp' and gsvariety='$ver' and gsdisflg=0 order by gsdate asc ";
	}
	else 
	{
		$qry="select * from tbl_gsample where gsdate >= '$sdate' and gsdate <= '$edate' and  gscrop='$crp' and gsdisflg=0 order by gsdate asc ";
	}
}
else
{
	if($variety!="ALL")
	{
		$qry="select * from tbl_gsample where gsdate <= '$sdate' and  gscrop='$crp' and gsvariety='$ver' and gsdisflg=0 order by gsdate asc ";
	}
	else 
	{
		$qry="select * from tbl_gsample where gsdate <= '$sdate' and  gscrop='$crp' and gsdisflg=0 order by gsdate asc ";
	}
}
//echo $qry;
		$sql_arr_home=mysqli_query($link,$qry) or die(mysqli_error($link));
		$tot_arr_home=mysqli_num_rows($sql_arr_home);
 if($tot_arr_home >0) {
?> 
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
<?php 
if($rettyp=="periodical")
{
?>
<tr height="25">
    <td align="center" class="subheading" style="color:#303918;" colspan="2">Periodical Crop Variety wise</td>
</tr>
<tr height="25">	
    <td align="center" class="subheading" style="color:#303918; " colspan="2">Period From:: <?php echo $_REQUEST['sdate'];?>&nbsp;&nbsp;To: <?php echo $_REQUEST['edate'];?></td>
</tr>
<?php
}
else
{
?>
<tr height="25">
    <td align="center" class="subheading" style="color:#303918;" colspan="2">As on Date Crop Variety wise</td>
</tr>
<tr height="25">	
    <td align="center" class="subheading" style="color:#303918; " colspan="2">Date: <?php echo $_REQUEST['sdate'];?></td>
</tr>
<?php
}
?>
  	<tr height="25">
    <td align="left" class="subheading" style="color:#303918;">&nbsp;&nbsp;Crop: <?php echo $crp;?></td>
    <td align="right" class="subheading" style="color:#303918; ">Variety: <?php echo $ver;?>&nbsp;&nbsp;</td>
 	</tr>
</table>
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="3%"align="center" valign="middle" class="tblheading">#</td>
			   <td width="14%" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="17%" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="11%" align="center" valign="middle" class="tblheading">Lot No.</td>
			   <td width="7%" align="center" valign="middle" class="tblheading">SLOC</td>
			   <td width="10%" align="center" valign="middle" class="tblheading">DOA</td>
               <td width="10%" align="center" valign="middle" class="tblheading">GSRP</td>
               <td width="10%" align="center" valign="middle" class="tblheading">GSRP Mat. Date</td>
            </tr>
<?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['gsdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
$arrival_id=$row_arr_home['gsid'];
	$qc1=$row_arr_home['sampleno'];

	
		$lotno=$row_arr_home['lotno'];
	
	$quer333=mysqli_query($link,"SELECT * FROM tblvariety where popularname ='".$row_arr_home['gsvariety']."' "); 
	$row333=mysqli_fetch_array($quer333);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer333);	
	 if($tot > 0)
	 {
	 $vv=$row333['gsdis'];
	 }
	 else
	 {
	  $vv=0;
	  }
	 $tt=$row_arr_home['gsvariety'];

$wh=""; $binn=""; $slocs="";
$wh1=$row_arr_home['gswh']."/";
$binn1=$row_arr_home['gsbin'];

$quer3=mysqli_query($link,"SELECT * FROM tblbin  where binid='".$binn1."'"); 
	$row31=mysqli_fetch_array($quer3);
	  $binn=$row31['binname'];
	
	$quer4=mysqli_query($link,"SELECT * from tblwarehouse where whid ='".$wh1."'"); 
	$row=mysqli_fetch_array($quer4);
	  $wh=$row['perticulars']."/";
$slocs=$wh.$binn."<br/>";

if($vv!=0)
{
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt=$vv;
		
		for($i=0; $i<=$dt; $i++) { $dt1=date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y)); }
		
	
	$trdate1=$dt1;
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
}
else
{
$vv="";
$trdate1="";
}		
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
         <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['gscrop'];?></td>
    	 <td align="center" valign="middle" class="tblheading"><?php echo $tt;?></td>
         <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 <td width="105" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
		 <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
         <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['gscrop'];?></td>
    	 <td align="center" valign="middle" class="tblheading"><?php echo $tt;?></td>
         <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 <td width="105" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
		 <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
?>
</table>	
<?php
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found</td></tr>
  </table>
<?php
}
?>
         		
  <br/>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="916" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-gssample.php?txtcrop=<?php echo $crop;?>&txtvariety=<?php echo $variety;?>&sdate=<?php echo $_REQUEST['sdate']?>&edate=<?php echo $_REQUEST['edate']?>&rettyp=<?php echo $_REQUEST['rettyp']?>" target="_blank"><img src="../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>