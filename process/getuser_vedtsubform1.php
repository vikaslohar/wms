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
	
	/*if(isset($_GET['b']))
	{
	$tid = $_GET['b'];	 
	}	
*/

	
$sql_tbl_sub=mysqli_query($link,"select * from tbl_dryingsub where subtrid='".$a."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row=mysqli_fetch_array($sql_tbl_sub);
  $tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
$tid=$row['trid'];
$subtid=$a;

$sql_tbl=mysqli_query($link,"select * from tbl_drying where trid='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['trid'];
$srno=1;
/*if($srno%2!=0)
{*/
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="10" align="center" class="tblheading">Post Item Form</td>
  </tr>
 <tr height="15">
 <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
 </tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="2" >&nbsp;<?php echo $row['sstage']; ?><input type="hidden" name="txtstage" value="<?php echo $row['sstage']; ?>"  /></td>
	</tr>

 <tr class="Light" height="30" id="vitem">
           <td align="right"  valign="middle" class="tblheading">Lot Number &nbsp;</td>
           <td align="left" width="272" valign="middle" class="tbltext" style="border-color:#F1B01E" >&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="<?php echo $row['lotno'];?>" readonly="true" style="background-color:#CCCCCC" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();" ><input type="hidden" name="txtlotnoid" /></td>
	<td align="left" width="366" valign="middle" class="tblheading">&nbsp;<!--<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get Details')--></td>	  
	</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /> <input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<div id="postingsubsubtable" style="display:block">	
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
 <tr class="tblsubtitle" height="20">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>-->
    <td width="106" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Before Drying</td>
	<td align="center" valign="middle" class="smalltblheading" rowspan="2">Store in same Bin</td>
    <td colspan="3" align="center" valign="middle" class="smalltblheading">Updated SLOC</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">After Drying </td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Drying Loss </td>
  </tr>
  <tr class="tblsubtitle">
    <td width="69" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="81" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="96" align="center" valign="middle" class="smalltblheading">WH</td>
    <td width="109" align="center" valign="middle" class="smalltblheading">Bin</td>
    <td width="89" align="center" valign="middle" class="smalltblheading">Subbin</td>
	<td width="89" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="89" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="56" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="100" align="center" valign="middle" class="smalltblheading">%</td>
  </tr>
  <?php

$totqty=0; $totnob=0; $tqty=0; $tnob=0; $srno2=0;
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$row['lotno']."'  and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row['lotno']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { $srno2++;
 	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 
	$tqty=$row_issuetbl['lotldg_balqty']; 
	$tnob=$row_issuetbl['lotldg_balbags']; 

$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sloc=$wareh."/".$binn."/".$subbinn;


$sql_tbl_subsub=mysqli_query($link,"select * from tbl_dryingsubsub where subtrid='".$a."' and owh='".$row_issuetbl['lotldg_whid']."' and obin='".$row_issuetbl['lotldg_binid']."' and osubbin='".$row_issuetbl['lotldg_subbinid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$rowsubsub=mysqli_fetch_array($sql_tbl_subsub);
 echo $tot_tbl_subsub=mysqli_num_rows($sql_tbl_subsub);
?>
  <tr class="Light" height="30">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading"><?php echo $srno2;?></td>-->
    <td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?><!--<input name="sloc<?php echo $srno2?>" type="text" size="10" class="smalltbltext"  maxlength="12" style="background-color:#CCCCCC" value=""/>--><input type="hidden" name="extslwhg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_whid'];?>" /><input type="hidden" name="extslbing<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_binid'];?>" /><input type="hidden" name="extslsubbg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_subbinid'];?>" /></td>

    <td width="69"  align="center" valign="middle" class="smallsmalltbltext"><?php echo $tnob;?>
    <input name="txtdisp<?php echo $srno2?>" id="txtdisp<?php echo $srno2?>" type="hidden" size="4" class="smalltbltext" tabindex="" maxlength="5"  onkeypress="return isNumberKey(event)" value="<?php echo $tnob;?>" style="background-color:#CCCCCC"  readonly="true" /></td>
    <td width="81" align="center"  valign="middle" class="smalltbltext"><?php echo $tqty;?>
    <input name="txtqty<?php echo $srno2?>" id="txtqty<?php echo $srno2?>" type="hidden" size="8" class="smalltbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $tqty;?>"/></td>
	<td width="62" align="center"  valign="middle" class="smalltbltext"><input type="checkbox" name="chkbox<?php echo $srno2;?>" id="chkbox<?php echo $srno2;?>" <?php if($rowsubsub['samebin']=="Yes") echo "checked"; ?> onclick="chkboxchk(<?php echo $srno2?>,<?php echo $row_issuetbl['lotldg_whid'];?>,<?php echo $row_issuetbl['lotldg_binid'];?>,<?php echo $row_issuetbl['lotldg_subbinid'];?>)" value="samebin" /> <input type="hidden" name="samebin<?php echo $srno2;?>" id="samebin<?php echo $srno2;?>" value="<?php echo $rowsubsub['samebin'];?>" /></td>

    <td  align="center"  colspan="3" valign="middle" class="smalltbltext">
<div id="samesloc<?php echo $srno2?>">
<?php
if($rowsubsub['samebin']=="No")
{
?>
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<tr>	
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="96" align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg<?php echo $srno2?>" name="txtslwhg<?php echo $srno2?>" style="width:70px;" onchange="wh<?php echo $srno2?>(this.value,<?php echo $srno2?>);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option <?php if($rowsubsub['nwh']==$noticia_whd1['whid']) echo "selected"; ?> value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where whid='".$rowsubsub['nwh']."' and plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="109" align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $srno2?>"><select class="smalltbltext" name="txtslbing<?php echo $srno2?>" style="width:60px;" onchange="bin<?php echo $srno2?>(this.value,<?php echo $srno2?>);" >
<option value="" selected>Bin</option>
<?php while($noticia_bing1 = mysqli_fetch_array($bind1_query)) { ?>
		<option <?php if($rowsubsub['nbin']==$noticia_bing1['binid']) echo "selected"; ?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000" >* </font>&nbsp;
		</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where binid='".$rowsubsub['nbin']."' and plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	
<td width="89" align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno2?>"><select class="smalltbltext" name="txtslsubbg<?php echo $srno2?>" id="txtslsubbg<?php echo $srno2?>" style="width:60px;" onchange="subbin<?php echo $srno2?>(this.value,<?php echo $srno2?>);"  >
<option value="" selected>Subbin</option>
<?php while($noticia_subbing1 = mysqli_fetch_array($subbind1_query)) { ?>
		<option <?php if($rowsubsub['nsubbin']==$noticia_subbing1['sid']) echo "selected"; ?> value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000" >* </font>&nbsp;
		</td>
  </tr>
</table>
<?php
}
else
{
?>
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<tr>	
<?php
$sql_whouse1=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$rowsubsub['nwh']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse1=mysqli_fetch_array($sql_whouse1);
$wareh1=$row_whouse1['perticulars'];

$sql_binn1=mysqli_query($link,"select binname from tbl_bin where binid='".$rowsubsub['nbin']."' and whid='".$rowsubsub['nwh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn1=mysqli_fetch_array($sql_binn1);
$binn1=$row_binn1['binname'];

$sql_subbinn1=mysqli_query($link,"select sname from tbl_subbin where sid='".$rowsubsub['nsubbin']."' and binid='".$rowsubsub['nbin']."' and whid='".$rowsubsub['nwh']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn1=mysqli_fetch_array($sql_subbinn1);
$subbinn1=$row_subbinn1['sname'];
?>

<td width="96" align="center"  valign="middle" class="smalltbltext"><?php echo $wareh1;?><input type="hidden" class="smalltbltext" id="txtslwhg<?php echo $srno2?>" name="txtslwhg<?php echo $srno2?>" value="<?php echo $rowsubsub['nwh'];?>"  >
</td>
<td width="109" align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $srno2?>"><?php echo $binn1;?><input type="hidden" class="smalltbltext" name="txtslbing<?php echo $srno2?>" id="txtslbing<?php echo $srno2?>" value="<?php echo $rowsubsub['nbin'];?>" >
</td>
<td width="89" align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno2?>"><?php echo $subbinn1;?><input type="hidden" class="smalltbltext" name="txtslsubbg<?php echo $srno2?>" id="txtslsubbg<?php echo $srno2?>" value="<?php echo $rowsubsub['nsubbin'];?>"  >
</td>
</tr>
</table>
<?php
}
?>
</div>


<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno2;?>">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="recqtyp<?php echo $srno2?>" id="recqtyp<?php echo $srno2?>" type="text" size="4" class="smalltbltext" tabindex="" value="<?php echo $rowsubsub['nnob'];?>"   maxlength="7" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,<?php echo $srno2?>);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtrecbagp<?php echo $srno2?>" id="txtrecbagp<?php echo $srno2?>" type="text" size="5" class="smalltbltext" tabindex="" value="<?php echo $rowsubsub['nqty'];?>" maxlength="7" onchange="Bagschk1(this.value,<?php echo $srno2?>);"  onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>


      <td align="center"  valign="middle" class="smalltbltext"><input name="txtdqtyp<?php echo $srno2?>" id="txtdqtyp<?php echo $srno2?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $rowsubsub['dryingloss'];?>" /></td>
       
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtdbagp<?php echo $srno2?>" id="txtdbagp<?php echo $srno2?>" type="text" size="2" class="smalltbltext" tabindex=""   maxlength="3" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $rowsubsub['dlossper'];?>" /></td>
  </tr>
 <?php
  }
}
?>


<tr class="Light" height="30">
    <td align="center" valign="middle" class="smalltblheading">Total<input name="txtlotno" type="hidden" size="15" class="smalltbltext"  maxlength="15" style="background-color:#CCCCCC" value="<?php echo $row['lotno'];?>"/></td>

    <td width="69"  align="center" valign="middle" class="smalltbltext"><?php echo $totnob;?>
    <input name="txtdisptot" type="hidden" size="4" class="smalltbltext" tabindex="" maxlength="5" onchange="Bagsdcchk1(this.value);" onkeypress="return isNumberKey(event)" value="<?php echo $totnob;?>" style="background-color:#CCCCCC"  readonly="true" /></td>
    <td align="center"  valign="middle" class="smalltbltext"><?php echo $totqty;?><input name="txtqtytot" type="hidden" size="8" class="smalltbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $totqty;?>"/></td>
	<td colspan="4" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
	<td align="center"  valign="middle" class="smalltbltext" ><input name="recqtyptot" type="text" size="4" class="smalltbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC"  readonly="true" value="<?php echo $row['nob1'];?>"  />&nbsp;&nbsp;&nbsp;&nbsp;</td>

  
  <td align="center"  valign="middle" class="smalltbltext"><input name="txtrecbagptot" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onchange="Bagschk1(this.value);"  style="background-color:#CCCCCC"  readonly="true" value="<?php echo $row['qty1'];?>"  />&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtdqtyptot" type="text" size="4" class="smalltbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row['adnob'];?>" /></td>
       
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtdbagptot" type="text" size="2" class="smalltbltext" tabindex=""   maxlength="3" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row['adqty'];?>" /></td>
</tr>



<tr class="Light" height="30">
    <td align="center" valign="middle" class="smalltblheading">Drying Start</td>

    <td align="center" valign="middle" class="smalltblheading">Date</td>
	<td colspan="4" align="left" valign="middle" class="smalltbltext"  >&nbsp;<input name="datestart" id="datestart" type="text" size="20" class="smalltbltext" bndex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo $row['dsdate'];?>" maxlength="20" />&nbsp;<img src="../images/cal.gif" onclick="firstdt()" style="cursor:pointer"/>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
	
<td align="center" valign="middle" class="smalltblheading">Drying Details</td>
 <td align="center" valign="middle" class="smalltblheading">Type</td>
      <td  align="center"  valign="middle" class="smalltbltext"><select name="txtdmtyp" id="txtdmtyp" class="smalltbltext" style="size:30px;" onchange="chktime(this.value)" >
	  <option value="" selected="selected" class="smalltbltext">-Select-</option>
	  <option <?php if($row['ddtype']=="Floor") echo "selected"; ?> value="Floor">Floor</option>
	  <option <?php if($row['ddtype']=="Machine") echo "selected"; ?> value="Machine">Machine</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
	  <td align="center" valign="middle" class="smalltblheading">ID</td>
      <td align="center"  valign="middle" class="smalltbltext"><select name="txtdid" id="txtdid" class="smalltbltext" style="size:30px;" onchange="chkidtyp(this.value)" >
<option value="" selected="selected">-Select-</option>
<option <?php if($row['ddid']=="01") echo "selected"; ?> value="01">01</option>
<option <?php if($row['ddid']=="02") echo "selected"; ?> value="02">02</option>
<option <?php if($row['ddid']=="03") echo "selected"; ?> value="03">03</option>
<option <?php if($row['ddid']=="04") echo "selected"; ?> value="04">04</option>
<option <?php if($row['ddid']=="05") echo "selected"; ?> value="05">05</option>
<option <?php if($row['ddid']=="06") echo "selected"; ?> value="06">06</option>
<option <?php if($row['ddid']=="07") echo "selected"; ?> value="07">07</option>
<option <?php if($row['ddid']=="08") echo "selected"; ?> value="08">08</option>
<option <?php if($row['ddid']=="09") echo "selected"; ?> value="09">09</option>
<option <?php if($row['ddid']=="10") echo "selected"; ?> value="10">10</option>
<option <?php if($row['ddid']=="11") echo "selected"; ?> value="11">11</option>
<option <?php if($row['ddid']=="12") echo "selected"; ?> value="12">12</option>
<option <?php if($row['ddid']=="13") echo "selected"; ?> value="13">13</option>
<option <?php if($row['ddid']=="14") echo "selected"; ?> value="14">14</option>
<option <?php if($row['ddid']=="15") echo "selected"; ?> value="15">15</option>
<option <?php if($row['ddid']=="16") echo "selected"; ?> value="16">16</option>
<option <?php if($row['ddid']=="17") echo "selected"; ?> value="17">17</option>
<option <?php if($row['ddid']=="18") echo "selected"; ?> value="18">18</option>
<option <?php if($row['ddid']=="19") echo "selected"; ?> value="19">19</option>
<option <?php if($row['ddid']=="20") echo "selected"; ?> value="20">20</option>
<option <?php if($row['ddid']=="21") echo "selected"; ?> value="21">21</option>
<option <?php if($row['ddid']=="22") echo "selected"; ?> value="22">22</option>
<option <?php if($row['ddid']=="23") echo "selected"; ?> value="23">23</option>
<option <?php if($row['ddid']=="24") echo "selected"; ?> value="24">24</option>
<option <?php if($row['ddid']=="25") echo "selected"; ?> value="25">25</option>
<option <?php if($row['ddid']=="26") echo "selected"; ?> value="26">26</option>
<option <?php if($row['ddid']=="27") echo "selected"; ?> value="27">27</option>
<option <?php if($row['ddid']=="28") echo "selected"; ?> value="28">28</option>
<option <?php if($row['ddid']=="29") echo "selected"; ?> value="29">29</option>
<option <?php if($row['ddid']=="30") echo "selected"; ?> value="30">30</option>
<option <?php if($row['ddid']=="31") echo "selected"; ?> value="31">31</option>
<option <?php if($row['ddid']=="32") echo "selected"; ?> value="32">32</option>
<option <?php if($row['ddid']=="33") echo "selected"; ?> value="33">33</option>
<option <?php if($row['ddid']=="34") echo "selected"; ?> value="34">34</option>
<option <?php if($row['ddid']=="35") echo "selected"; ?> value="35">35</option>
<option <?php if($row['ddid']=="36") echo "selected"; ?> value="36">36</option>
<option <?php if($row['ddid']=="37") echo "selected"; ?> value="37">37</option>
<option <?php if($row['ddid']=="38") echo "selected"; ?> value="38">38</option>
<option <?php if($row['ddid']=="39") echo "selected"; ?> value="39">39</option>
<option <?php if($row['ddid']=="40") echo "selected"; ?> value="40">40</option>
<option <?php if($row['ddid']=="41") echo "selected"; ?> value="41">41</option>
<option <?php if($row['ddid']=="42") echo "selected"; ?> value="42">42</option>
<option <?php if($row['ddid']=="43") echo "selected"; ?> value="43">43</option>
<option <?php if($row['ddid']=="44") echo "selected"; ?> value="44">44</option>
<option <?php if($row['ddid']=="45") echo "selected"; ?> value="45">45</option>
<option <?php if($row['ddid']=="46") echo "selected"; ?> value="46">46</option>
<option <?php if($row['ddid']=="47") echo "selected"; ?> value="47">47</option>
<option <?php if($row['ddid']=="48") echo "selected"; ?> value="48">48</option>
<option <?php if($row['ddid']=="49") echo "selected"; ?> value="49">49</option>
<option <?php if($row['ddid']=="50") echo "selected"; ?> value="50">50</option>
<option <?php if($row['ddid']=="51") echo "selected"; ?> value="51">51</option>
<option <?php if($row['ddid']=="52") echo "selected"; ?> value="52">52</option>
<option <?php if($row['ddid']=="53") echo "selected"; ?> value="53">53</option>
<option <?php if($row['ddid']=="54") echo "selected"; ?> value="54">54</option>
<option <?php if($row['ddid']=="55") echo "selected"; ?> value="55">55</option>
<option <?php if($row['ddid']=="56") echo "selected"; ?> value="56">56</option>
<option <?php if($row['ddid']=="57") echo "selected"; ?> value="57">57</option>
<option <?php if($row['ddid']=="58") echo "selected"; ?> value="58">58</option>
<option <?php if($row['ddid']=="59") echo "selected"; ?> value="59">59</option>
<option <?php if($row['ddid']=="60") echo "selected"; ?> value="60">60</option>
<option <?php if($row['ddid']=="61") echo "selected"; ?> value="61">61</option>
<option <?php if($row['ddid']=="62") echo "selected"; ?> value="62">62</option>
<option <?php if($row['ddid']=="63") echo "selected"; ?> value="63">63</option>
<option <?php if($row['ddid']=="64") echo "selected"; ?> value="64">64</option>
<option <?php if($row['ddid']=="65") echo "selected"; ?> value="65">65</option>
<option <?php if($row['ddid']=="66") echo "selected"; ?> value="66">66</option>
<option <?php if($row['ddid']=="67") echo "selected"; ?> value="67">67</option>
<option <?php if($row['ddid']=="68") echo "selected"; ?> value="68">68</option>
<option <?php if($row['ddid']=="69") echo "selected"; ?> value="69">69</option>
<option <?php if($row['ddid']=="70") echo "selected"; ?> value="70">70</option>
<option <?php if($row['ddid']=="71") echo "selected"; ?> value="71">71</option>
<option <?php if($row['ddid']=="72") echo "selected"; ?> value="72">72</option>
<option <?php if($row['ddid']=="73") echo "selected"; ?> value="73">73</option>
<option <?php if($row['ddid']=="74") echo "selected"; ?> value="74">74</option>
<option <?php if($row['ddid']=="75") echo "selected"; ?> value="75">75</option>
<option <?php if($row['ddid']=="76") echo "selected"; ?> value="76">76</option>
<option <?php if($row['ddid']=="77") echo "selected"; ?> value="77">77</option>
<option <?php if($row['ddid']=="78") echo "selected"; ?> value="78">78</option>
<option <?php if($row['ddid']=="79") echo "selected"; ?> value="79">79</option>
<option <?php if($row['ddid']=="80") echo "selected"; ?> value="80">80</option>
<option <?php if($row['ddid']=="81") echo "selected"; ?> value="81">81</option>
<option <?php if($row['ddid']=="82") echo "selected"; ?> value="82">82</option>
<option <?php if($row['ddid']=="83") echo "selected"; ?> value="83">83</option>
<option <?php if($row['ddid']=="84") echo "selected"; ?> value="84">84</option>
<option <?php if($row['ddid']=="85") echo "selected"; ?> value="85">85</option>
<option <?php if($row['ddid']=="86") echo "selected"; ?> value="86">86</option>
<option <?php if($row['ddid']=="87") echo "selected"; ?> value="87">87</option>
<option <?php if($row['ddid']=="88") echo "selected"; ?> value="88">88</option>
<option <?php if($row['ddid']=="89") echo "selected"; ?> value="89">89</option>
<option <?php if($row['ddid']=="90") echo "selected"; ?> value="90">90</option>
<option <?php if($row['ddid']=="91") echo "selected"; ?> value="91">91</option>
<option <?php if($row['ddid']=="92") echo "selected"; ?> value="92">92</option>
<option <?php if($row['ddid']=="93") echo "selected"; ?> value="93">93</option>
<option <?php if($row['ddid']=="94") echo "selected"; ?> value="94">94</option>
<option <?php if($row['ddid']=="95") echo "selected"; ?> value="95">95</option>
<option <?php if($row['ddid']=="96") echo "selected"; ?> value="96">96</option>
<option <?php if($row['ddid']=="97") echo "selected"; ?> value="97">97</option>
<option <?php if($row['ddid']=="98") echo "selected"; ?> value="98">98</option>
<option <?php if($row['ddid']=="99") echo "selected"; ?> value="99">99</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

</tr>
<tr class="Light" height="30">
<td align="center" valign="middle" class="smalltblheading">Drying End</td>

    <td align="center" valign="middle" class="smalltblheading">Date</td>
	<td colspan="4" align="left" valign="middle" class="smalltbltext"  >&nbsp;<input name="dateend" id="dateend" type="text" size="20" class="smalltbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $row['dedate'];?>" maxlength="20" onblur="tdelay(this.value)" />&nbsp;<img src="../images/cal.gif" onclick="caldiff();" style="cursor:pointer"/>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
	
<td align="center" valign="middle" class="smalltblheading">Total D. Time</td>	
<td align="left" valign="middle" class="smalltblheading" colspan="4">&nbsp;<input type="text" name="txttottime" class="smalltbltext" size="35" style="background-color:#CCCCCC" readonly="true" value="<?php echo $row['dtime'];?>" /></td> 

</tr>

 <input type="hidden" name="srno2" value="<?php echo $srno2?>" />
</table>
<br />	


<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:Pointer;"  onclick="pformedtup();" />&nbsp;&nbsp;</td>
</tr>
</table></div>
