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

if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}
if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}

	//if($a==1)
	//{
	//$a=13;
	//}
//$flag=0; 
//echo $a;

$crop="";$variety="";
$sql_month=mysqli_query($link,"select * from tblspcodes where  spcodef='".$a."' and spcodem='".$b."' order by variety")or die(mysqli_error($link));
$row= mysqli_fetch_array($sql_month);
  $tt=mysqli_num_rows($sql_month);
  $variety=$row['variety'];
  $crop=$row['crop'];


 $quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$crop."' order by cropname Asc"); 
 $noticia = mysqli_fetch_array($quer3);
 $crop=$noticia['cropname'];
 
 $quer3=mysqli_query($link,"SELECT varietyid,popularname FROM tblvariety where varietyid ='".$variety."' and actstatus='Active' and vertype='PV' order by popularname"); 
 $rowvv=mysqli_fetch_array($quer3);
 $tt1=$rowvv['popularname'];
 $tot=mysqli_num_rows($quer3);	
	$lotno1="";
	$sql_month1=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   spcodef='".$a."'and spcodem='".$b."'")or die(mysqli_error($link));
	 $tt2=mysqli_num_rows($sql_month1);
while($row_tbl_sub=mysqli_fetch_array($sql_month1))
{
   if($lotno1!="")
   {
   $lotno1=$lotno1.",".$row_tbl_sub['orlot'];
   }
   else
   {
   $lotno1=$row_tbl_sub['orlot'];
   }
}

if($tt > 0)
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="574" bordercolor="#adad11" style="border-collapse:collapse">
 <tr class="Light" height="25">
	<td width="191" align="right"  valign="middle" class="tblheading" >Crop&nbsp;</td>
    <td align="left" width="377" valign="middle" class="tbltext" id="vitem" colspan="3">&nbsp;<input name="txtcrop" class="tbltext" id="itm"  style="width:170px;background-color:#CCCCCC" size="30" maxlength="30" readonly="true" value="<?php echo $crop;?>" ></td>
                </tr>
				
                <tr class="Light" height="25">
	<td width="191" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left" width="377" valign="middle" class="tbltext" id="vitem" colspan="3">&nbsp;<input name="txtvariety" class="tbltext" id="itm"  style="width:170px;background-color:#CCCCCC" size="30" maxlength="30" readonly="true" value="<?php echo $tt1;?>" ></td>
                </tr>
				
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="574" bordercolor="#adad11" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
              <td width="2%"align="center" valign="middle" class="tblheading">#</td> 
			  <td width="8%" align="center" valign="middle" class="tblheading">Lot No.</td>
              <td width="7%" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
              <td width="6%" align="center" valign="middle" class="tblheading">Stage</td>
			  <td align="center" valign="middle" class="tblheading">QC status </td>
			  <td align="center" valign="middle" class="tblheading">GOT Status </td>
			  <td align="center" valign="middle" class="tblheading">Seed Status </td>	
			  <td align="center" valign="middle" class="tblheading">SLOC</td>	
</tr>
<?php
$pl_array=explode(",",$lotno1); $srno=1; 
foreach($pl_array as $lotn)
{
if($lotn<>"")
{
$crop=""; $variety=""; $lotno=""; $bags=0; $qty=0; $stage=""; $got=""; $qc=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_tb="select distinct lotldg_subbinid, lotldg_binid, lotldg_whid from tbl_lot_ldg where plantcode='".$plantcode."' and orlot='".$lotn."' and lotldg_sstage='Raw' order by lotldg_subbinid"; 
$sql_qry=mysqli_query($link,$sql_tb) or die(mysqli_error($link)); 
  
while($row_tbl=mysqli_fetch_array($sql_qry))
{
$sql_tbl1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_whid='".$row_tbl['lotldg_whid']."' and lotldg_binid='".$row_tbl['lotldg_binid']."' and lotldg_subbinid='".$row_tbl['lotldg_subbinid']."' and orlot='".$lotn."' and lotldg_sstage='Raw' order by lotldg_id desc") or die(mysqli_error($link));  
$row_tbl1=mysqli_fetch_array($sql_tbl1);
$t1=mysqli_num_rows($sql_tbl1);

$sql1=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_id='".$row_tbl1[0]."' and lotldg_balqty > 0")or die(mysqli_error($link));

$total_tbl=mysqli_num_rows($sql1);
while($row_tbl_sub=mysqli_fetch_array($sql1))
{
$lrole=$row_tbl_sub['arr_role'];
$arrival_id=$row_tbl_sub['lotldg_trid'];

$aq=explode(".",$row_tbl_sub['lotldg_balbags']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['lotldg_balqty']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['lotldg_balqty'];}

				
		$lotno=$row_tbl_sub['lotldg_lotno'];
		$bags=$bags+$ac;
		$qty=$qty+$acn;
		
		$qc=$row_tbl_sub['lotldg_qc'];
		$stage=$row_tbl_sub['lotldg_sstage'];
		$status=$row_tbl_sub['lotldg_sstatus'];
		$status1=$row_tbl_sub['lotldg_got1']; 	
		
		$wareh=""; $binn=""; $subbinn=""; 

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_tbl_sub['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_tbl_sub['lotldg_binid']."' and whid='".$row_tbl_sub['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_tbl_sub['lotldg_subbinid']."' and binid='".$row_tbl_sub['lotldg_binid']."' and whid='".$row_tbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
}
}
if($qty>0)
{
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		 <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
         <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $qc?></td>
		 <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $status1?></td>
		  <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $status?></td>
		   <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $slocs?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		 <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
         <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $qc?></td>
		 <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $status1?></td>
		  <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $status?></td>
		  <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $slocs?></td>
</tr>
<?php
}
 $srno++;
}
}
}
//}
//}
?>
</table>
<!--<table align="center" width="574" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center">&nbsp;&nbsp;<img src="../images/next.gif" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;"><input type="hidden" name="typ" value="" /></td>
</tr>
</table>-->
<?php
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="574" bordercolor="#adad11" style="border-collapse:collapse">

                <tr class="Light" height="25">
	<td align="left"  valign="middle" class="tblheading" >&nbsp;Record Not Found.</td>
                </tr>
</table>
<?php
}
?>