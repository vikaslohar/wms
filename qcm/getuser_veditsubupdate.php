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
if(isset($_GET['f']))
	{
	$f = $_GET['f'];	 
	}
if(isset($_GET['g']))
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
	
if(isset($_GET['txtid']))
	{
	$c = $_GET['txtid'];	 
	}
	
	if(isset($_GET['date']))
	{
  $dcdate= $_GET['date'];	 
	}
	
	if(isset($_GET['txtlot1']))
	{
	$lot2= $_GET['txtlot1'];	
	}
	if(isset($_GET['txtcrop']))
	{
	$o = $_GET['txtcrop'];	 
	}

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
	if(isset($_GET['logid']))
	{
	$logid = $_GET['logid'];	 
	}
//		
if(isset($_GET['txtremarks']))
	{
	$y1 = $_GET['txtremarks'];	 
	}
	if(isset($_GET['txtstage']))
	{
	$stage= $_GET['txtstage'];	
	}
	
	if(isset($_GET['qcrsl']))
	{
	$qcrsl = $_GET['qcrsl'];	 
	}
	if(isset($_GET['gotrsl']))
	{
	$gotrsl = $_GET['gotrsl'];	 
	}
	//
//frm_action=submit&txt11=&txt14=&txtid=19&txtid1=AV19&date=15-05-2009&txtcla=--Select%20Vendor--&txtdcno=&txtporn=&txttname=&txtlrn=&txtvn=&txtcname=&txtdc=&txtclass=--Select%20Classification--&txtitem=--Select%20Item--&txtqtydc=&txtupsdc=&txtupsg=&txtqtyg=&txtqtyd=&txtupsd=&txtexshqty=&txtexshups=&tblslocnog=--Bin--&txtwhslg1=-WH--&txtbinslg1=--Bin--&txtslsubbg1=--Sub%20Bin--&txtslqtyg1=&txtslupsg1=&txtslwhg2=--WH--&txtslbing2=--Bin--&txtslsubbg2=--Sub%20in--&txtslqtyg2=&txtslupsg2=&txtslwhg3=--WH--&txtslbing3=--Bin--&txtslsubbg3=--Sub%20Bin--&txtslqtyg3=&txtslupsg3=&tblslocnod=--Bin-&txtslwhd1=--WH--&txtslbind1=--Bin--&txtslsubbd1=--Sub%20Bin-&txtslqtyd1=&txtslupsd1=&txtslwhd2=--WH--&txtslbind2=--Bin--&txtslsubd2=--Sub%20Bin--&txtslqtyd2=&txtslupsd2=&txtremarks=&maintrid=0
//echo $a; echo $b; exit;
	
	
				
		$ddate1=$dcdate;
		$dday1=substr($ddate1,0,2);
		$dmonth1=substr($ddate1,3,2);
		$dyear1=substr($ddate1,6,4);
		$ddate1=$dyear1."-".$dmonth1."-".$dday1;
if($z1 == 0)
{
 $sql_main="insert into tbl_qcgen (year_code,arr_code, arrival_date,arr_role,crop, variety,stage)values('$yearid_id','$c','$ddate1','$logid','$o','$p','$stage')";
if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=mysqli_insert_id($link);

 $sql_sub="insert into tbl_qcgen1 (pp,moist,gemp,got,arr_role,lotno ,arrival_id,crop, variety,stage,qcr,gotr)values('$a','$b','$f','$d','$logid','$lot2','$mainid','$o','$p','$stage','$qcrsl','$gotrsl')";
mysqli_query($link,$sql_sub) or die(mysqli_error($link));
}
$z1=$mainid;
}
else
{
  $sql_main="update tbl_qcgen set year_code='$yearid_id', arr_code='$c',crop='$o',variety='$p', stage='$stage',arrival_date='$ddate1',arr_role='$logid' where arrival_id = '$z1'";
if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=$z1;
   $sql_sub="update tbl_qcgen1 set  pp='$a',moist='$b',gemp='$f',got='$d', lotno='$lot2',arr_role='$logid',crop='$o',variety='$p', stage='$stage', qcr='$qcrsl', gotr='$gotrsl' where arrsub_id = '$subtrid'";
mysqli_query($link,$sql_sub) or die(mysqli_error($link));
}
}
	
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#d21704" style="border-collapse:collapse">
  <?php
 $tid=$z1;
?>
  <?php
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
<tr class="tblsubtitle" height="20">
  <td width="2%"  align="center" valign="middle" class="tblheading">#</td>
    <td width="14%"  align="center" valign="middle" class="tblheading">Crop</td>
    <td width="14%"  align="center" valign="middle" class="tblheading">Variety</td>
			  <td width="15%" align="center" valign="middle" class="tblheading">Lot No. </td>
			  <td width="9%" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="10%" align="center" valign="middle" class="tblheading">Qty</td>
			  <td width="15%" align="center" valign="middle" class="tblheading">Stage</td>
               <td width="10%" align="center" valign="middle" class="tblheading">Quality</td>
			   <td width="10%" align="center" valign="middle" class="tblheading">GOT</td>
			   <td width="7%" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="9%" align="center" valign="middle" class="tblheading">Delete</td>
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
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where orlot='".$lot."'") or die(mysqli_error($link));
   $row_tbl=mysqli_fetch_array($sql_tbl);
 $totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; 	$sloc=""; 
	$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  orlot='".$lot."' and lotldg_sstage='".$row_tbl_sub['stage']."'") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and orlot='".$lot."' and lotldg_sstage='".$row_tbl_sub['stage']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 
//echo $row_issue1[0];
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
		$pp=$pp." ".$row_tbl_sub['pp'];
		}
		else
		{
		$pp=$row_tbl_sub['pp'];
		}
		}
		if($row_tbl_sub['moist']!=""){
		if($pp!="")
		{
		$pp=$pp." ".$row_tbl_sub['moist'];
		}
		else
		{
		$pp=$row_tbl_sub['moist'];
		}
		
		}
		if($row_tbl_sub['gemp']!=""){
		if($pp!="")
		{
		$pp=$pp." ".$row_tbl_sub['gemp'];
		}
		else
		{
		$pp=$row_tbl_sub['gemp'];
		}
		}
		if($row_tbl_sub['got']!=""){
		if($pp!="")
		{
		$pp=$pp." ".$row_tbl_sub['got'];
		}
		else
		{
		$pp=$row_tbl_sub['got'];
		}
		}
		
		if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
    <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
  <td align="center" valign="middle" class="tblheading"><?php echo $totnob;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
	   <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stage'];?></td>
	 	<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_got1'];?></td>
        <td width="7%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="9%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
  </tr>
  <?php
}
else
{
?>
   <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
    <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
   <td align="center" valign="middle" class="tblheading"><?php echo $totnob;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
	    <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['stage'];?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
			<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotldg_got1'];?></td>
	        <td width="7%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="9%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
  </tr>
  <?php
}
$srno++;
}
}

?>
</table>
<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<!--<tr class="Light" height="30">
<td width="171" align="right" valign="middle" class="tblheading">Seed Stage&nbsp;</td>
<td  align="left" valign="middle" class="tbltext"  colspan="3">&nbsp;<select class="tbltext" name="txtstage" style="width:170px;" >
    <option value="" selected>--Select--</option>
    <option value="Raw">Raw </option>
    <option value="Condition">Condition</option>
	 <option value="Pack">Pack </option>
  </select>&nbsp;<font color="#FF0000">*</font>	</td>

<td width="131" align="right" valign="middle" class="tblheading">Seed Status&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="sstatus" class="tbltext" readonly="readonly" style="background-color:#EAEAEA">&nbsp;<a href="Javascript:void(0);" onclick="select1();">Select</a><input type="hidden" name="destid" value="" /></td>
</tr>-->
<tr class="Dark" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");
/*$quer3=mysqli_fetch_array($quer3);
		$quer3=$row_cls['cropname'];
*/	
?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' order by popularname Asc"); 
?>
	<td width="101" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="297" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    </tr>


         <tr class="Light" height="30" id="vitem">
           <td align="right"  valign="middle" class="tblheading">Lot Number&nbsp;</td>
           <td align="left" width="271" valign="middle" class="tbltext" style="border-color:#d21704" >&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#ECECEC"   >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a><input type="hidden" name="qcrsl" value="" /><input type="hidden" name="gotrsl" value="" /></td>
		  
		   <td align="right"  valign="middle" class="tblheading">&nbsp;Select QC Tests&nbsp;</td>
  <td  align="left"  valign="middle" class="tbltext" ><input name="txt1" <?php if($row_tbl_sub['pp']=="P"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0" value="P" onclick="clk(this.value);"/>PP   
   &nbsp;
  <input name="txt12" <?php if($row_tbl_sub['moist']=="M"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0"  value="M" onclick="clk(this.value);"/>  
    Moisture  
    &nbsp;
    <input name="txt14" <?php if($row_tbl_sub['gemp']=="G"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0"  value="G" onclick="clk(this.value);"/>
    Germination 
    &nbsp;
    <input name="txt16" <?php if($row_tbl_sub['got']=="T"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0"  value="T" onclick="clk(this.value);" />
GOT <font color="#FF0000">*</font>&nbsp;</td>
</tr>

<!--/*<tr class="Dark" height="30">
  <td align="right"  valign="middle" class="tblheading">&nbsp;QC Type &nbsp;</td>
  <td colspan="3" align="left"  valign="middle" class="tbltext" ><input name="txt1" type="checkbox" class="tbltext" value="PP" onclick="clk(this.value);" />
    PP
    &nbsp;
    <input name="txt12" type="checkbox" class="tbltext" value="Moisture" onclick="clk(this.value);" />
    Moisture % 
    &nbsp;
    <input name="txt15" type="checkbox" class="tbltext" value="Germination" onclick="clk(this.value);" /> 
    Gem % 
    &nbsp;
     <input name="txt16" type="checkbox" class="tbltext" value="GOT" onclick="clk(this.value);" />
GoT <font color="#FF0000">*</font>&nbsp;</td>
</tr> */

<tr class="Light" height="30">
<td colspan="4" align="right"  valign="middle" class="tblheading">&nbsp;</td>
</tr>-->
</table>
<div id="lotdetails"></div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<input type="hidden" name="chk1" value="" />
<input type="hidden" name="chk2" value="" />
<input type="hidden" name="chk3" value="" />
<input type="hidden" name="chk4" value="" />
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table></div>
		  
