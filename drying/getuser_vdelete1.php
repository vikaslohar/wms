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
	
	
$s_sub="delete from tbl_cobdryingsub where subtrid='".$b."'";
mysqli_query($link,$s_sub) or die(mysqli_error($link));


$sql_t_sub=mysqli_query($link,"select * from tbl_cobdryingsub where plantcode='".$plantcode."' and   trid='".$a."'") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_t_sub);
?><?php
if($tot_sub > 0)
 $tid=$a;
else
{
$s_sub1="delete from tbl_cobdrying where trid='".$a."'";
mysqli_query($link,$s_sub1) or die(mysqli_error($link));
$tid=0;
}
?>
 
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<?php  
$sql_tbl=mysqli_query($link,"select * from tbl_cobdrying where plantcode='".$plantcode."' and   trid='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);

$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['trid'];

$tdate=$row_tbl['dryingdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
$subtid=0;
?>	

<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Cob Drying Slip </td>
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
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input type="text" class="tbltext" name="txtcrop1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropname'];?>" size="25" />   <input type="hidden" class="tbltext" name="txtcrop" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropid'];?>" />&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl['variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<input type="text" class="tbltext" name="txtvariety1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['popularname'];?>" size="25" />   <input type="hidden" class="tbltext" name="txtvariety" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia_item['varietyid'];?>" />&nbsp;</td>
           </tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Drying slip reference No. &nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdrefno" type="text" size="20" class="tbltext" maxlength="20" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_tbl['drefno']?>" /></td>
	</tr>

</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#adad11" style="border-collapse:collapse">

  <?php
/*$sql_tbl=mysqli_query($link,"select * from tbl_cobdrying where plantcode='".$plantcode."' and    trid='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);	*/	

$arrival_id;
$sql_tbl_sub=mysqli_query($link,"select * from tbl_cobdryingsub where plantcode='".$plantcode."' and   trid='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

/*$tdate=$row_tbl['dryingdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;*/
	
?>
<tr class="tblsubtitle" height="20">
              <td width="2%" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
			   <td width="11%" align="center" valign="middle" class="tblheading" rowspan="2">Crop</td>
			   <td width="19%" align="center" valign="middle" class="tblheading" rowspan="2">Variety</td>
			   <td width="9%" align="center" valign="middle" class="tblheading" rowspan="2">DSRN</td>
			   <td width="13%" align="center" valign="middle" class="tblheading"rowspan="2" >Lot No. </td>
			   <td align="center" valign="middle" class="tblheading"  colspan="2">Before Drying </td>
			   <td align="center" valign="middle" class="tblheading" colspan="2">After Drying  </td>
			   <td align="center" valign="middle" class="tblheading" colspan="2">Damage Loss </td>
               <td width="4%" align="center" valign="middle" class="tblheading" rowspan="2">Edit</td>
              <td width="5%" align="center" valign="middle" class="tblheading"rowspan="2" >Delete</td>
  </tr>
  <tr class="tblsubtitle">
                    <td width="6%" align="center" valign="middle" class="tblheading" >NoB</td>
                    <td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">NoB</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
                    <td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">%</td>
                            </tr>
  <?php
 
$srno=1; $difq="";
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$arrival_id=$row_tbl_sub['trid'];

	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl['crop']."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
		
	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl['variety']."' and actstatus='Active'") or die(mysqli_error($link));
	$rowvv=mysqli_fetch_array($sql_variety);
	
if($srno%2!=0)
{
/*$diq=explode(".",$row_tbl_sub['adqty']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['adqty'];}
*/
?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row31['cropname'];?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $rowvv['popularname'];?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl['drefno'];?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl_sub['lotno'];?></td>
	 <td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl_sub['onob'];?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['oqty'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['nob1'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['adnob'];?></td>
	<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['adqty'];?></td>
        <td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['subtrid'];?>);" /></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['subtrid'];?>);" /></td>
  </tr>
  <?php
}
else
{
?>
    <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row31['cropname'];?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $rowvv['popularname'];?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl['drefno'];?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl_sub['lotno'];?></td>
	 <td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl_sub['onob'];?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['oqty'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['nob1'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['adnob'];?></td>
	<td width="140" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['adqty'];?></td>
        <td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['subtrid'];?>);" /></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['subtrid'];?>);" /></td>
  </tr>
  <?php
}
$srno++;
}
}
?>
</table>
  <div id="postingsubtable" style="display:block">	
       <table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="2" >&nbsp;<input type="text" class="tbltext" name="txtstage" size="10" value="Raw" readonly="true" style="background-color:#CCCCCC"  /></td>
</tr>			  
<tr class="Light" height="30">

           <td align="right"  valign="middle" class="tblheading">Lot Number &nbsp;</td>
           <td align="left" width="272" valign="middle" class="tbltext" style="border-color:#F1B01E" >&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();" readonly="true" style="background-color:#CCCCCC"  >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a><input type="hidden" name="txtlotnoid" /></td>
	<td align="left" width="366" valign="middle" class="tblheading" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get Details')</td>	</tr> 
	</table>
	
	<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
	
<div id="postingsubsubtable" style="display:block">
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>	</div>
</div>
