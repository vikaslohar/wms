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
     //$yearid_id="09-10";
	//$logid="OP1";
	//$lgnid="OP1";
	if(isset($_REQUEST['itmid']))
	{
	$itmid = $_REQUEST['itmid'];
	}
	if(isset($_REQUEST['remarks']))
	{
	$remarks = $_REQUEST['remarks'];
	}
	$sql_code="SELECT MAX(arr_code) FROM tbl_csw_main ORDER BY arr_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
			$code1="TAS".$code."/".$yearid_id."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="TAS".$code."/".$yearid_id."/".$lgnid;
		}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Qc- Transaction- QC Sampling Request Form Preview</title>
<link href="../include/vnrtrac_csw.css" rel="stylesheet" type="text/css" />
<script language='javascript'>
/*function test(foccode,emp)
{
if (foccode!="")
{
document.from.foccode.value=foccode;
document.from.empname.value=emp;
}
}	
function post_value()
{
if(document.from.foc.checked=true)
{
opener.document.frmaddDept.regionh.value = document.from.empname.value;
opener.document.frmaddDept.empi.value = document.from.foccode.value;
opener.document.frmaddDept.txtnoofemp.value="";

self.close();
}
}

function mySubmit()
{

if(document.from.foccode.value=="")
{
alert("You must select Zone Head");
return false;
}
return true;
}
	*/
	
			</script>
</head>
<body topmargin="0" >
<?php  
/*$sql_item=mysqli_query($link,"select * from tbl_stores where items_id='".$itmid."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);
$sql1=mysqli_query($link,"select * from tblarr_sloc where item_id='".$itmid."' order by whid")or die(mysqli_error($link));*/
?>
  
<table width="750" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php //=$cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
      <?php
	$tid=$itmid;
$sql_tbl=mysqli_query($link,"select * from tbl_qcgen where arr_role='".$logid."'  and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
 $arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_qcgen1 where arrival_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=$tid;

$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
?>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">QC Sampling Request Preview</td>
</tr>

 <tr class="Dark" height="30">
<td width="159" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="233"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TAS".$row_tbl['arr_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="269" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="179" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?>&nbsp;</td>
</tr>

</table>
<br />


<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#d21704" style="border-collapse:collapse">
   
<tr class="tblsubtitle" height="20">
  <!----><td width="4%"  align="center" valign="middle" class="tblheading">#</td>
    
    <td width="15%"  align="center" valign="middle" class="tblheading">Crop</td>
    <td width="17%"  align="center" valign="middle" class="tblheading">Variety</td>	
			  <td width="15%" align="center" valign="middle" class="tblheading">Lot No. </td>
			  <td width="12%" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="13%" align="center" valign="middle" class="tblheading">Qty</td>
			   <td width="15%" align="center" valign="middle" class="tblheading">Stage</td>
			   <td width="9%" align="center" valign="middle" class="tblheading">GOT</td>
               <td width="15%" align="center" valign="middle" class="tblheading">Quality</td>
	      </tr>
  <?php
 
$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{

  $quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl_sub['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
	
	
   $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	$crop=$row31['cropname'];
	$lot=$row_tbl_sub['lotno'];
		$lot=$row_tbl_sub['lotno'];
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lot."'") or die(mysqli_error($link));
   $row_tbl=mysqli_fetch_array($sql_tbl);
   
    $row_tbl_sub['lotno'];
 $totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; 	$sloc=""; 
	$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_lotno='".$row_tbl_sub['lotno']."' ") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_tbl_sub['lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 
 $row_issue1[0];
$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 
}
}
    $pp="";
			 if($row_tbl_sub['pp']!=""){
		if($pp!="")
		{
		$pp=$pp.",".$row_tbl_sub['pp'];
		}
		else
		{
		$pp=$row_tbl_sub['pp'];
		}
		}
		if($row_tbl_sub['gemp']!=""){
		if($pp!="")
		{
		$pp=$pp.",".$row_tbl_sub['gemp'];
		}
		else
		{
		$pp=$row_tbl_sub['gempp'];
		}
		}
		if($row_tbl_sub['got']!=""){
		if($pp!="")
		{
		$pp=$pp.",".$row_tbl_sub['got'];
		}
		else
		{
		$pp=$row_tbl_sub['got'];
		}
		}
		if($row_tbl_sub['moist']!=""){
		if($pp!="")
		{
		$pp=$pp.",".$row_tbl_sub['moist'];
		}
		else
		{
		$pp=$row_tbl_sub['moist'];
		}
		
		}
		if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
    <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $totnob;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
	  <td width="15%" align="center" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl_sub['stage'];?>&nbsp;</td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_got1'];?></td>
	 	<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
        </tr>
  <?php
}
else
{
?>
   <tr class="Light" height="20">
    <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
    <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $totnob;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
	  <td width="15%" align="center" valign="middle" class="tblheading">&nbsp;<?php echo $row_tbl_sub['stage'];?>&nbsp;</td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_got1'];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
          </tr>
  <?php
}
$srno++;
}
}

?>
</table>
<br />
<table align="center" cellpadding="5" cellspacing="5" border="0" width="850">
<tr >
<td align="right" colspan="3"><img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
