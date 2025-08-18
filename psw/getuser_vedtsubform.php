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
	}require_once("../include/config.php");
	require_once("../include/connection.php");

/*if(isset($_GET['frm_action']))
	{
	$a11= $_GET['txt11'];	 
	}
*/	
//  			main arrival table fields



if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}
	
	if(isset($_GET['b']))
	{
	$tid = $_GET['b'];	 
	}	


	
$sql_tbl_sub=mysqli_query($link,"select * from tbl_psw where plantcode='$plantcode' and arrsub_id='".$a."'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
  $tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
$tid=$row_tbl_sub['arrival_id'];
$subtid=$a;

$sql_tbl=mysqli_query($link,"select * from tbl_psw_main where plantcode='$plantcode' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];
/*$srno=1; $itmdchk="";
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
if($itmdchk!="")
{
$itmdchk=$itmdchk.$row_tbl['nolot'].",";
}
else
{
$itmdchk=$row_tbl['nolot'].",";
}

}
}
else
{
$itmdchk="";
}*/
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
<?php   
// $row_tbl_sub['crop'];
$quer3=mysqli_query($link,"SELECT cropid,cropname from tblcrop  order by cropname Asc"); 	
	//$row31=mysqli_fetch_array($quer3);
?>
<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:150px;"  onchange="modetchk(this.value)">
<option value="" selected="selected">--Select--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option <?php if($noticia['cropid']==$row_tbl_sub['crop']){ echo "Selected";} ?> value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<?php
//echo $row_tbl_sub['variety'];
$sql_qc=mysqli_query($link,"SELECT distinct(variety) FROM tbl_psw WHERE plantcode='$plantcode' and crop='".$row_tbl_sub['crop']."' and variety NOT RLIKE '^[-+0-9.E]+$'") or die(mysqli_error($link)); 
$tt=mysqli_num_rows($sql_qc);

$sql_month=mysqli_query($link,"select varietyid, popularname from tblvariety where cropname='".$row_tbl_sub['crop']."' and actstatus='Active' order by popularname Asc")or die(mysqli_error($link));
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;&nbsp;<select class="tbltext" name="txtvariety" id="itm" style="width:170px;" >
	<option value="" selected>--Select Variety--</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option <?php if($noticia_item['varietyid']==$row_tbl_sub['variety']){ echo "Selected";} ?> value="<?php echo $noticia_item['varietyid'];?>" />
		<?php echo $noticia_item['popularname'];?>
		<?php } ?>
	<?php while($noticia_item1 = mysqli_fetch_array($sql_qc)) { ?>
		<option <?php if($noticia_item1['variety']==$row_tbl_sub['variety']){ echo "Selected";} ?> value="<?php echo $noticia_item1['variety'];?>" />
		<?php echo $noticia_item1['variety'];?>
		<?php } ?>
		</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
	<input type="hidden" name="itmdchk" value="<?php echo $subtbltot;?>" />

<?php $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		
	$tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
			else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}
						?>
<tr class="Light" height="30">
<td width="163" align="right"  valign="middle" class="tblheading"> Lot Number&nbsp;</td>
<td width="222" align="left"  valign="middle" class="tbltext"  >&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex="" maxlength="20" onkeypress="return isNumberKey(event)" onchange="qtychk(this.value);"   style="background-color:#CCCCCC" value="<?php echo $row_tbl_sub['lotno'];?>"  >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
 <td align="right"  valign="middle" class="tblheading">&nbsp;Select QC Tests&nbsp;</td>
  <td  align="left"  valign="middle" class="tbltext" ><input name="txt1" <?php if($row_tbl_sub['pp']=="P"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0" readonly="true" value="P" onclick="clk(this.value);"/>PP   
   &nbsp;
  <input name="txt12" <?php if($row_tbl_sub['moist']=="M"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0" readonly="true" value="M" onclick="clk(this.value);"/>  
    Moisture  
    &nbsp;
    <input name="txt14" <?php if($row_tbl_sub['gemp']=="G"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0" readonly="true" value="G" onclick="clk(this.value);"/>
    Germination 
    &nbsp;
    <!--<input name="txt16" <?php if($row_tbl_sub['got']=="T"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0" readonly="true" value="T" onclick="clk(this.value);" />
GOT <font color="#FF0000">*</font>&nbsp;--></td>
  <?php

// $row_tbl_sub['pp'];
?>
</tr><!--<tr class="Dark" height="30">
  <td align="right"  valign="middle" class="tblheading">&nbsp;QC Type &nbsp;</td>
  <td colspan="3" align="left"  valign="middle" class="tbltext" ><input name="txt1" <?php if($row_tbl_sub['pp']=="PP"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0" readonly="true" value="PP" />PP   
   &nbsp;
  <input name="txt12" <?php if($row_tbl_sub['moist']=="Moisture"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0" readonly="true" value="Moisture" />  
    Moisture % 
    &nbsp;<input name="txt14" <?php if($row_tbl_sub['gemp']=="Germination"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0" readonly="true" value="Germination" />
    Gem % 
    &nbsp;<input name="txt16" <?php if($row_tbl_sub['got']=="Got"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0" readonly="true" value="Got" />
GoT <font color="#FF0000">*</font>&nbsp;</td>
</tr> -->
 

</table>


<br />
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /> <input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<input type="hidden" name="chk1" value="<?php echo $row_tbl_sub['pp'];?>" />
<input type="hidden" name="chk2" value="<?php echo $row_tbl_sub['moist'];?>" />
<input type="hidden" name="chk3" value="<?php echo $row_tbl_sub['gemp'];?>" />
<input type="hidden" name="chk4" value="<?php echo $row_tbl_sub['got'];?>" />
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:Pointer;"  onclick="pformedtup();" />&nbsp;&nbsp;</td>
</tr>
</table>