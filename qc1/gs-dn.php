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

	$ids=trim($_REQUEST['ids']);
	$typ=trim($_REQUEST['typ']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>QC-Transaction  -GSDN</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }

</style>

</head>
<body topmargin="0" >
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
	 <input name="frm_action" value="submit" type="hidden"> 
	  
 <?php 
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);
	?>	
<table align="center" border="0" width="780" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light">
<td width="51" align="center" valign="middle" class="smalltblheading"><img src="<?php echo $row_param['logo']; ?>" width="57" align="middle"></td>
<td width="729" align="left" valign="middle" class="tblheading"><table align="left" border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#378b8b">
<tr class="Light">
<td align="center" valign="middle" class="tblheading"><font size="+3" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $row_param['company_name'];?></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr class="Light">
<td align="left"  valign="middle" class="smalltblheading" colspan="2">&nbsp;Office:&nbsp;<?php echo $row_param['address'];?>, <?php echo $row_param['ccity'];?>-<?php echo $row_param['cpin'];?>, <?php echo $row_param['cstate'];?>, Ph: 0<?php echo $row_param['cstd'];?>-<?php echo $row_param['cphone'];?><?php if($row_param['cphone1'] != ""){  echo ", ".$row_param['cphone1'];}?></td>
</tr>
<tr class="Light">
<td align="left" valign="middle" class="smalltblheading" colspan="2">&nbsp;Plant:&nbsp;<?php echo $row_param['plant'];?>-<?php echo $row_param['ppin'];?>, <?php echo $row_param['pstate'];?>, Ph: 0<?php echo $row_param['pstd'];?>-<?php echo $row_param['pphone'];?><?php if($row_param['pphone1'] != ""){  echo ", ".$row_param['pphone1'];}?></td>
</tr>
</table>
</td>
</tr>
</table><hr />
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr  height="20">
  <td colspan="6" align="center" class="Mainheading"><font color="#000000">Guard Sample Disposal Note (GS-DN)</font></td>
</tr>
</table>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="68" align="right"  valign="middle" class="tblheading" >&nbsp;DOGSD&nbsp;</td>
<td align="left" width="676" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo date("d-m-Y");?></td>
</tr>
</table><br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="23"align="center" valign="middle" class="tblheading">#</td>
			   <td width="116" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="164" align="center" valign="middle" class="tblheading">Variety</td>
			    <td width="118" align="center" valign="middle" class="tblheading">Lot No.</td>
              <td align="center" valign="middle" class="tblheading">SLOC</td>
			   <td width="88" align="center" valign="middle" class="tblheading">DOA</td>
			   <td width="82" align="center" valign="middle" class="tblheading">GSRP</td>
				<td width="82" align="center" valign="middle" class="tblheading">GSRP Mat. Date</td>
              </tr>
<?php
$zzz=explode(",",$ids);
foreach($zzz as $val)
{
if($val<>"")
{
 $sql_arr_home=mysqli_query($link,"select * from tbl_gsample where gsid='".$val."' order by arrivaldate asc") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrivaldate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$arrival_id=$row_arr_home['gsid'];
	$qc1=$row_arr_home['sampleno'];

	
		$lotno=$row_arr_home['lotno'];
	
	 $vv=$row_arr_home['gsdis'];
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
		//echo $dt1;
 $cdate=date("Y-m-d");		
$flg=0;
//if($dt1<=$cdate)	$flg=1; else $flg=0;
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

if($flg==0 && $vv!="")
{
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="23" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
         <td width="116" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['gscrop'];?></td>
    	 <td align="center" valign="middle" class="tblheading"><?php echo $tt;?></td>
         <td width="118" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 <td width="83" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
		 <td width="88" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="82" align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="82" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
		 </tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="23" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
         <td width="116" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['gscrop'];?></td>
    	 <td align="center" valign="middle" class="tblheading"><?php echo $tt;?></td>
         <td width="118" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 <td width="83" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
		 <td width="88" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="82" align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="82" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
		 </tr>  
<?php
}
$srno=$srno+1;
}
}
}
}
}
?>
</table>
          <br />
<br />

<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
		  <tr class="Light" >
<td width="101" align="right" valign="middle" class="smalltblheading" rowspan="3">&nbsp;Prepared By&nbsp;</td>
<td width="150"  align="left" valign="middle" class="smalltbltext">&nbsp;</td>

<td width="77" align="right" valign="middle" class="smalltblheading">&nbsp;Checked By &nbsp;</td>
<td width="192" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
<td width="88" align="right" valign="middle" class="smalltblheading">&nbsp;Dispose By</td>
<td width="142" colspan="3" align="left" valign="middle" class="smalltbltext">&nbsp;</td>
</tr>
	    </table>
<table cellpadding="5" cellspacing="5" border="0" width="750" align="center">
<tr >
<td align="right" colspan="3"><a href="arr_vendor_print_word.php?itmid=<?php echo $itmid?>"><!--<img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" style="cursor:pointer"   />--></a>&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" height="30" border="0" onClick="window.close()"  target="_blank" class="butn" style="cursor:pointer"   />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
