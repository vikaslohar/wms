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

if(isset($_GET['a']))
	{
	  $a = $_GET['a'];	 
	}
if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}
if($b == "Variety")	
{
?><table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="9" align="center" class="tblheading">Form</td>
</tr>
<tr height="15"><td colspan="9" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td width="96" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="198" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" >
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
    <font color="#FF0000">*</font>&nbsp;</td>
	<td width="131" align="right"  valign="middle" class="tblheading">Select Variety Type&nbsp;</td>
<td width="128" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtvartyp" style="width:80px;" onchange="vartypechk(this.value)" >
<option value="" selected>--Select--</option>
<option value="Hybrid" />Hybrid</option> 
<option value="OP" />OP</option>   
</select>
    <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' order by popularname Asc"); 
?>
	<td width="57" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="226" align="left"  valign="middle" class="tbltext" colspan="3"id="vitem" >&nbsp;
      <select class="tbltext"  name="txtvariety" style="width:170px;" onchange="subblockchk()" id="itm">
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
	<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
<input type="hidden" name="itmdchk" value="" />

</table>
<?php
}
else if($b=="Party")
{

/*if($a=="Commercial")
{		
$quer3=mysqli_query($link,"select * from tblclassification where main='Channel' or main='Stock Transfer' order by classification")or die(mysqli_error($link));
}
else if($a=="TDF")
{
$quer3=mysqli_query($link,"select * from tblclassification where classification='TDF - Individual' order by classification")or die(mysqli_error($link));
}
else
{
$quer3=mysqli_query($link,"select * from tblclassification where main='Channel' or main='Stock Transfer' or classification='TDF - Individual' order by classification")or die(mysqli_error($link));
}
$t=mysqli_num_rows($quer3);*/
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

<!---
<tr class="Light" height="30">
		    <td width="156" align="right"  valign="middle" class="tblheading">Party Type &nbsp;</td>
              <td width="279" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtpartytyp" style="width:170px;" onchange="modetchkparty(this.value)">
<option value="" selected></option>
	<?php //while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php //=$noticia['classification'];?>" />   
		<?php //=$noticia['classification'];?>
		<?php //} ?>
	</select></td>
	<td width="122" align="right"  valign="middle" class="tblheading" >Party Name&nbsp;</td>
    <td width="283" align="left"  valign="middle" class="tbltext" id="vitem" >&nbsp;<select class="tbltext" id="party" name="txtparty" style="width:170px;" onchange="subblockchk()" >
<option value="" selected></option>
</select>&nbsp;</td>
		</tr> 
		--->
		
		<tr class="Dark" height="30">
<td width="199" align="right"  valign="middle" class="tblheading" >Select Order Type&nbsp;</td>
<td width="177" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtpartycat1" style="width:120px;" onchange="partycatsl1(this.value);">
    <option value="" selected="selected">--Select--</option>
	<option value="Sales">Sales</option>
	<option value="Stock Transfer">Stock Transfer</option>
	<option value="TDF">TDF</option>
  </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="122" align="right"  valign="middle" class="tblheading" >Fill Party Name&nbsp;</td>
<td width="342" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="fillpartyname1" class="tbltext" size="35" value="" <?php if($a=="Commercial") echo 'disabled'; ?> title="Fill the TDF Party Name to search which is not available in Party master" onchange="fillpartysl1(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp; <input type="hidden" name="partyname" value="" /></td>
</tr>
<tr height="15"><td colspan="2" align="Left" class="tblheading"><div style="padding-left:3px;">Select Order Type to select Party in cases where party is listed under party master.</div></td><td colspan="2" align="Left" class="tblheading"><div style="padding-left:3px;">In case of TDF, where party is not present in party master. Specify Exact Party Name, here</div></td></tr>	
</table>
<div id="orderpsltyp1" style="display:none"></div>
<div id="selectpartylocation"style="display:none" ></div>		   
<div id="selectparty"style="display:none" ></div>
<?php
}
else if($b="Order")
{
?>	
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

<tr class="Light" height="25">
<td width="376" align="right"  valign="middle" class="tblheading">Order No. Search&nbsp;</td>
<td width="468" align="left"  valign="middle" class="tbltext" ><input type="radio" name="orsearch" value="ordersearch" onclick="ordersrchk(this.value)" /></td>
</tr>

<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >Party Name Search&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" ><input type="radio" name="orsearch" value="partysearch" onclick="ordersrchk(this.value)" /></td>
</tr>

<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading" >Date wise Search&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"><input type="radio" name="orsearch" value="datesearch" onclick="ordersrchk(this.value)" /></td>
</tr>
</table>
<div id="ordersrtyp" style="display:none"></div> 
<?php
}
else
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr height="15"><td colspan="6" align="center" class="tblheading">Type Not Selected</td></tr>
</table>
<?php
}
?>
<div id="div" style="display:block"></div>
<div id="showulform" style="display:block">
  <table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td valign="middle" align="right"><img src="../images/display.gif" border="0"style="display:inline;cursor:pointer;" onclick="showpform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>	