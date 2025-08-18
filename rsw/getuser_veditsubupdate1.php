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
if(isset($_GET['c']))
	{
	$c = $_GET['c'];	 
	}
/*if(isset($_GET['f']))
	{
	$f = $_GET['f'];	 
	}
*/if(isset($_GET['g']))
	{
	$tid = $_GET['g'];	 
	}
if(isset($_GET['txt1']))
	{
	 $a= $_GET['txt1'];	 
	}
if(isset($_GET['txt12']))
	{
	 $b = $_GET['txt12'];	 
	}
	if(isset($_GET['txt14']))
	{
	 $f = $_GET['txt14'];	 
	}
	if(isset($_GET['txt16']))
	{
	 $d = $_GET['txt16'];	 
	}
	

	if(isset($_GET['date']))
	{
    $ee1= $_GET['date'];	 
	}
	
	
	/*
	$quer_cn=mysqli_query($link,"SELECT * FROM tblcrop ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$o=$row_cls['cropname'];
		*/
	if(isset($_GET['txtcrop']))
	{
	$o = $_GET['txtcrop'];	 
	}
	/*
	$quer_cn=mysqli_query($link,"SELECT * FROM tblvariety ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$p=$row_cls['popularname'];*/
	if(isset($_GET['txtvariety']))
	{
	$p = $_GET['txtvariety'];	 
	}
	if(isset($_GET['maintrid']))
	{
	  $z1 = $_GET['maintrid'];	 
	}

if(isset($_GET['subtrid']))
	{
	  $subtrid = $_GET['subtrid'];	 
	}
	if(isset($_GET['txtdrefno']))
	{
	$txtdrefno = $_GET['txtdrefno'];	 
	}
//		
if(isset($_GET['txtlotno']))
	{
	$txtlotno = $_GET['txtlotno'];	 
	}
	//	End of Main table fields	
	
	if(isset($_GET['txtdisp']))
	{
	$txtdisp= $_GET['txtdisp'];	
	}
	if(isset($_GET['txtqty']))
	{
	$txtqty= $_GET['txtqty'];	
	}
	if(isset($_GET['recqtyp']))
	{
	 $recqty= $_GET['recqtyp'];	
	}
	if(isset($_GET['txtrecbagp']))
	{
	$txtrecbagp= $_GET['txtrecbagp'];	
	}
	if(isset($_GET['txtdqtyp']))
	{
	$txtdqtyp= $_GET['txtdqtyp'];	
	}
	if(isset($_GET['txtdbagp']))
	{
	$txtdbagp= $_GET['txtdbagp'];	
	}
//frm_action=submit&txt11=&txt14=&txtid=19&txtid1=AV19&date=15-05-2009&txtcla=--Select%20Vendor--&txtdcno=&txtporn=&txttname=&txtlrn=&txtvn=&txtcname=&txtdc=&txtclass=--Select%20Classification--&txtitem=--Select%20Item--&txtqtydc=&txtupsdc=&txtupsg=&txtqtyg=&txtqtyd=&txtupsd=&txtexshqty=&txtexshups=&tblslocnog=--Bin--&txtwhslg1=-WH--&txtbinslg1=--Bin--&txtslsubbg1=--Sub%20Bin--&txtslqtyg1=&txtslupsg1=&txtslwhg2=--WH--&txtslbing2=--Bin--&txtslsubbg2=--Sub%20in--&txtslqtyg2=&txtslupsg2=&txtslwhg3=--WH--&txtslbing3=--Bin--&txtslsubbg3=--Sub%20Bin--&txtslqtyg3=&txtslupsg3=&tblslocnod=--Bin-&txtslwhd1=--WH--&txtslbind1=--Bin--&txtslsubbd1=--Sub%20Bin-&txtslqtyd1=&txtslupsd1=&txtslwhd2=--WH--&txtslbind2=--Bin--&txtslsubd2=--Sub%20Bin--&txtslqtyd2=&txtslupsd2=&txtremarks=&maintrid=0
//echo $a; echo $b; exit;
	
	
				
			 $tdate11=$ee1;
		$tday1=substr($tdate11,0,2);
		$tmonth1=substr($tdate11,3,2);
		$tyear1=substr($tdate11,6,4);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;
if($z1 == 0)
{
 $sql_main="insert into tbl_drying(arr_code, dryingdate,crop, variety,stage,drefno,plantcode)values('$c','$tdate1','$o','$p','RSW','$txtdrefno','$plantcode')";
if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=mysqli_insert_id($link);

$sql_sub="insert into tbl_dryingsub (lotno,trid,onob,oqty,nob1,qty1,adnob ,adqty,plantcode)values('$txtlotno','$mainid','$txtdisp','$txtqty','$recqty','$txtrecbagp','$txtdqtyp','$txtdbagp','$plantcode')";
mysqli_query($link,$sql_sub) or die(mysqli_error($link));
}
$z1=$mainid;
}
else
{
 $sql_main="update tbl_drying set  dryingdate='$tdate1',crop='$o',variety='$p',stage='RSW' where trid = '$z1'";
if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=$z1;
 $sql_sub="update tbl_dryingsub set lotno='$txtlotno',onob='$txtdisp', oqty='$txtqty',nob1='$recqty',qty1='$txtrecbagp',adnob='$txtdqtyp',adqty='$txtdbagp',trid='$mainid' where subtrid = '$subtrid'";
mysqli_query($link,$sql_sub) or die(mysqli_error($link));
}
}
	
?>
<?php  

 $tid=$z1;

$sql_tbl=mysqli_query($link,"select * from tbl_drying where  stage='RSW' and trid='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
  $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['trid'];

$tdate=$row_tbl['dryingdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
/*$sql_tbl_sub=mysqli_query($link,"select * from tbl_dryingsub where trid='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);*/
$subtid=0;
?>	
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Drying Slip </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TRD".$row_tbl['arr_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="229" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl['crop']."' order by cropname Asc"); 
$noticia = mysqli_fetch_array($quer3);
?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input type="text" name="txtcrop1" readonly="true" style="background-color:#CCCCCC;" value="<?php echo $noticia['cropname'];?>" size="32"  />&nbsp;<font color="#FF0000">*</font>&nbsp;<input type="hidden" name="txtcrop" value="<?php echo $noticia['cropid'];?>" /></td>
	  <?php
/*$quer3=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl['variety']."' and actstatus='Active' and vertype='PV' order by popularname Asc"); 
//$noticia = mysqli_fetch_array($quer4);

 //$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub['variety']."' and actstatus='Active' and vertype='PV'"); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }*/
?>
	 <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl['variety']."' and actstatus='Active' and vertype='PV' order by popularname Asc"); 
$noticia = mysqli_fetch_array($quer4);
?>
	<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3"  id="vitem" >&nbsp;<input type="text" name="txtvariety1" readonly="true" style="background-color:#CCCCCC;" value="<?php echo $noticia['popularname'];?>" size="32"  />&nbsp;<font color="#FF0000">*</font>&nbsp;<input type="hidden" name="txtvariety" value="<?php echo $noticia['varietyid'];?>" /></td>
  </tr>

  <?php
	 
//$quer5=mysqli_query($link,"SELECT st_id , stage FROM tblstages where stage='".$row_tbl['lotvariety']."' order by stage Asc"); 
//	$row5=mysqli_fetch_array($quer5);
?>

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Drying slip reference No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" >&nbsp;<input type="text" name="txtdrefno" readonly="true" style="background-color:#CCCCCC;"  size="32" value="<?php echo $row_tbl['drefno'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#e48324" style="border-collapse:collapse">

  <?php
/*$sql_tbl=mysqli_query($link,"select * from tbl_drying where stage='RSW' and  trid='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['trid'];*/

$sql_tbl_sub=mysqli_query($link,"select * from tbl_dryingsub where trid='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

/*$tdate=$row_tbl['dryingdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;*/
	
?>
<tr class="tblsubtitle" height="20">
    <td width="43" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
    <td width="112" align="center" valign="middle" class="tblheading"rowspan="2" >Lot No. </td>
    <td align="center" valign="middle" class="tblheading"  colspan="2">Before Drying </td>
    <td align="center" valign="middle" class="tblheading" colspan="2">After Drying </td>
    <td align="center" valign="middle" class="tblheading" colspan="2">Damage Loss </td>
    <td width="31" align="center" valign="middle" class="tblheading" rowspan="2">Edit</td>
    <td width="46" align="center" valign="middle" class="tblheading"rowspan="2" >Delete</td>
  </tr>
  <tr class="tblsubtitle">
    <td width="100" align="center" valign="middle" class="tblheading" >NoB</td>
    <td width="130" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="77" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="109" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="103" align="center" valign="middle" class="tblheading">Qty</td>
    <td width="77" align="center" valign="middle" class="tblheading">%</td>
  </tr>
  <?php
 
$srno=1;
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{

$diq=explode(".",$row_tbl_sub['adqty']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['adqty'];}
if($srno%2!=0)
{

?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl_sub['lotno'];?></td>
	 <td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl_sub['onob'];?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['oqty'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['nob1'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	<td width="140" align="center" valign="middle" class="tblheading"><?php echo $difq['adnob'];?></td>
	<td width="140" align="center" valign="middle" class="tblheading"><?php echo $difq;?></td>
        <td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['subtrid'];?>);" /></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['subtrid'];?>);" /></td>
  </tr>
  <?php
}
else
{
?>
    <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl_sub['lotno'];?></td>
	 <td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl_sub['onob'];?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['oqty'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['nob1'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['adnob'];?></td>
	<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['adqty'];?></td>
        <td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['subtrid'];?>);" /></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['subtrid'];?>);" /></td>
  </tr>
  <?php
}
$srno++;
}
}

?>
</table>

<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

         <tr class="Light" height="30" id="vitem">
           <td align="right"  valign="middle" class="tblheading">Lot Number &nbsp;</td>
           <td align="left" width="272" valign="middle" class="tbltext" style="border-color:#F1B01E" >&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a><input type="hidden" name="txtlotnoid" /></td>
	<td align="left" width="366" valign="middle" class="tblheading" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get Details')</td>	  
		   
</table>


<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /></div>
		  
