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
	if(isset($_GET['f']))
	{
	$f = $_GET['f'];	
	} 
	
	
$tot_row=0;
$tot_arrsub=0;
$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   old='".$a."' ") or die(mysqli_error($link));
$tot_arrsub=mysqli_num_rows($sql_tbl_sub);

$lotqry=mysqli_query($link,"select * from tbllotimp where    lotnumber='".$a."'and lottrtype='Unidentified'")or die (mysqli_error($link));
$row= mysqli_fetch_array($lotqry);
$tot_row=mysqli_num_rows($lotqry);
$lot=$row['lotcrop'];	
$loc=$row['lotploc'];	
$variety=$lot."-"."Unidentified";

/* $quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer-Plant'"); 

 $sql_month=mysqli_query($link,"select * from tbl_partymaser where p_id='$b'")or die("Error:".mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);*/
// $lot=$row_month['address'];
/* if($row['lotvariety']!="")
 {
 $variety=$row['lotvariety'];
 }
 else
 {
 	$sql_spc=mysqli_query($link,"select * from tblspcodes where  spcodem='".$row['lotspcodem']."' and spcodef='".$row['lotspcodef']."'") or die(mysqli_error($link));
	$row_spc=mysqli_fetch_array($sql_spc);
	$xx=mysqli_num_rows($sql_spc);
	if($xx > 0)
	{
	$x=$row_spc['variety'];
	$z=$row_spc['crop'];
	$lotqry1=mysqli_query($link,"select * from tblvariety where varietyid='".$x."' and actstatus='Active' and vertype='PV'");
	$t=mysqli_num_rows($lotqry1);
	$row11=mysqli_fetch_array($lotqry1)or die (mysqli_error($link));
	$variety=$row11['popularname'];
	$qctyp=$row11['opt'];
	}
	else
	{
	$variety="";
	$qctyp="";
	$x=0;
	}
 }*/
// echo $tot_row;
 $oldlot=$row['lotoldlot'];		
if($tot_row > 0 && $tot_arrsub==0)
{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="4" align="center" class="tblheading">Post Item Form</td>
  </tr>
  <tr height="15">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr> 
  <?php $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		
	$tp1="";
		if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
		else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}
?>
   <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>
 <tr class="Light" height="30">
  <td width="216" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtcrop" type="text" size="20" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row['lotcrop'];?>" maxlength="10"/>&nbsp;</td>
    <td width="131" align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtvariety" type="text" size="30" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $variety;?>" maxlength="10"/>&nbsp;</td>
  </tr>
 
   
  <tr class="Dark" height="30">
  
			  <td align="right"  valign="middle" class="tblheading">NoB&nbsp;</td>
              <td width="236" align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtdcnob" type="text" size="4" class="tbltext" tabindex=""   value="1"  maxlength="4" onchange="bagschk1();" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC"/>
    &nbsp;</td>
    
    <td align="right"  valign="middle" class="tblheading">Quantity&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdcqty" type="text" size="9" class="tbltext" tabindex=""    maxlength="9" onchange="qtychk1(this.value);" onkeypress="return isNumberKey(event)"/> Kgs.&nbsp;<font color="#FF0000">*</font></td>
  </tr>
  <?php if($b=="Fresh Seed Arrival with PDN")
  { ?>
   <tr class="Light" height="30">
    	<td width="191" align="right"  valign="middle" class="tblheading" >Location&nbsp;</td>
    <td width="251"  align="left"  valign="middle" class="tbltext"colspan="5">&nbsp;<input name="txtloc" type="text" size="10" class="tbltext" tabindex="0"  readonly="true"  style="background-color:#CCCCCC" value="<?php echo $loc?>" /></td>
<?php
}
else if($b=="Trading Arrival")
{
 $quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Trading Vendor'"); 
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading"> Vendor Party&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<select class="tbltext" name="txtparty" style="width:190px;"  >
<option value="" selected="selected">--Select--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td></tr>
	<?php
	}
	elseif($b=="Stock Transfer-Plant")
	{
	?>
	<?php 
	$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer-Plant'"); 
?>
 <tr class="light" height="30">
<td align="right"  valign="middle" class="tblheading">Stock Transfer from Plant &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<select class="tbltext" name="txtparty" style="width:220px;"  >
<option value="" selected="selected">--Select--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td></tr>
	<?php
	}?>
	<tr class="Dark" height="30">
    <td colspan="4" align="center" class="tblheading">Preliminary Quality (QC) </td>
  </tr>
 
  <tr class="Light" height="30">
    <td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtmoist" type="text" size="1" class="tbltext" tabindex=""    maxlength="4" onchange="moischk();" onkeypress="return isNumberKey(event)"/>
      %&nbsp;<font color="#FF0000">*</font> </td>
    <td align="right"  valign="middle" class="tblheading">Physical Purity&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtvisualck" style="width:120px;" onchange="visuchk1(this.value)">
          <option value="" selected>--Select--</option>
          <option value="Acceptable" >Acceptable</option>
          <option value="Not-Acceptable" >Not-Acceptable</option>
        </select>
        <font color="#FF0000">*</font> </td>
  </tr>
  <tr class="Dark" height="25">
    <td align="right"  valign="middle" class="tblheading">QC Status&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="qc" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="UT" maxlength="10"/>
   </td>
   <td width="174" align="right" valign="middle" class="tblheading">Seed Status&nbsp;</td>
   <td width="214" align="left" valign="middle" class="tbltext">&nbsp;<input name="sstatus" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"  value="" style="background-color:#CCCCCC" readonly="true" ><a href="Javascript:void(0);" onclick="openslocpop1();">Select</a></td>
  </tr>
  <tr class="Dark" height="25">

 <td align="right"  valign="middle" class="tblheading">GS Sample&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<input name="gs1"  type="checkbox" class="tbltext" tabindex="0" readonly="true" disabled="disabled" checked="checked" style="background-color:#CCCCCC" value="1"  /></td>
 </tr>
</table>
<div id="transs" style="display:none" >
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td align="right" width="240" valign="middle" class="tblheading">&nbsp;Reason&nbsp;</td>
<td width="704" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks1" class="tbltext" size="100" maxlength="90" >&nbsp;<font color="#FF0000">*</font></td>
</tr>
</table>
</div>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Grow Out Test (GOT) </td>
</tr>

 <tr class="Light" height="30">
<td width="238" align="right" valign="middle" class="tblheading">Stage&nbsp;</td>
<td width="260"  align="left" valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtstage" style="width:140px;" onchange="sschk(this.value)">
    <option value="" selected>--Select--</option>
    <option value="Raw" >Raw</option>
    <!--<option value="Condition" >Condition</option>
	<option value="Pack" >Pack</option>-->
  </select>&nbsp;<font color="#FF0000">*</font>	</td>

<td width="191" align="right"  valign="middle" class="tblheading">Got Type&nbsp;</td>
    <td width="251" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtgot" type="text" size="10" class="tbltext" tabindex="0"  readonly="true"  style="background-color:#CCCCCC" value="GOT-R" />
	<!--<select class="tbltext" name="txtgot" style="width:80px;" onchange="visuchk()">
          <option value="" selected>--Select--</option>
          <option value="GOT-R" >GOT-R</option>
          <option value="GOT-NR" >GOT-NR</option>
        </select>
      &nbsp;<font color="#FF0000">*--></font> </td>
</tr>

 <?php $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		$tp1=$row_cls['code'];
		?>
   <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>
<?php
$cod="";
			if($f=="Raw"){$cod="R";}else if($f=="Condition "){$cod="C";}else{$cod="";}
			?>
 <tr class="Dark" height="30">
 <td width="238" align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
 <td align="left"  valign="middle" class="tblheading"  >&nbsp;<input name="txtold" type="text" size="20" class="tblheading" tabindex="" maxlength="20" style="background-color:#CCCCCC" readonly="true" value="<?php echo $tp1?>-<?php echo $a?>/00000/00<?php echo $cod?>" /><input type="hidden" name="gln" value="<?php echo $tp1?><?php echo $a?>/00000/00" /><input type="hidden" name="gln1" value="<?php echo $tp1?><?php echo $a?>/00000/00" /><input type="hidden" name="txtold1" value="<?php echo $a?>" /> </td> 
    
	<td width="191" align="right"  valign="middle" class="tblheading">Got Status&nbsp;</td>
    <td width="251" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtgot1" type="text" size="10" class="tbltext" tabindex="0"  readonly="true"  style="background-color:#CCCCCC" value="GOT-R UT" />
	<!--<select class="tbltext" name="txtgot" style="width:80px;" onchange="visuchk()">
          <option value="" selected>--Select--</option>
          <option value="GOT-R" >GOT-R</option>
          <option value="GOT-NR" >GOT-NR</option>
        </select>
      &nbsp;<font color="#FF0000">*--></font> </td>
  </tr>
  <!--<tr class="Light" height="30">
 <td width="238" align="right"  valign="middle" class="tblheading" >Address&nbsp;</td>
 <td align="left"  valign="middle" class="tblheading" colspan="5" >&nbsp;<div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $row_month['address'];?>, <?php echo $row_month['city'];?>, <?php echo $row_month['state'];?></div><input type="hidden" name="adddchk" value="<?php echo $row_month['stcode'];?>" /></td><input type="hidden" name="gln" value="<?php echo $tp1?><?php echo $a?>/00000<?php echo $cod?>" />
    		</tr>-->
  <!--<tr class="Dark" height="30">
 
	<select class="tbltext" name="txtgot" style="width:80px;" onchange="visuchk()">
          <option value="" selected>--Select--</option>
          <option value="GOT-R" >GOT-R</option>
          <option value="GOT-NR" >GOT-NR</option>
        </select>
      &nbsp;<font color="#FF0000">*</font> </td>
  </tr>-->
</table>


<div id="subsubdivgood" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">Existing SLOC</td>
    <td width="346" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
	<td width="286" rowspan="2" align="center" valign="middle" class="tblheading">Arrival</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="100" align="center" valign="middle" class="tblheading">WH</td>
    <td width="93" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="113" align="center" valign="middle" class="tblheading">Sub Bin</td>
  </tr>
  
</table>

</div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<?php
}
else
{
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;Lot details cannot display reasons:</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;1. Lot number not Imported</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;2. Lot number already arrived.</td>
</tr>
</table>
<?php
}
?>