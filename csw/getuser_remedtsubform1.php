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
	
	/*if(isset($_GET['b']))
	{
	$tid = $_GET['b'];	 
	}	*/

$sql_tbl_sub=mysqli_query($link,"select * from tbl_cswrem_sub where plantcode='".$plantcode."' and rswremsub_id='".$a."'") or die(mysqli_error($link));
$row=mysqli_fetch_array($sql_tbl_sub);
$tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
$tid=$row['rswrem_id'];
$subtid=$a;

$sql_tbl=mysqli_query($link,"select * from tbl_cswrem where plantcode='".$plantcode."' and rswrem_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['rswrem_id'];

$sql_tbl_subsub=mysqli_query($link,"select * from tbl_cswremsub_sub where plantcode='".$plantcode."' and rswremsub_id='".$a."' and rswrem_id='".$tid."'") or die(mysqli_error($link));
$row_subsub=mysqli_fetch_array($sql_tbl_subsub);

$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_binid, lotldg_subbinid  from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_crop ='".$row['crop']."' and lotldg_variety='".$row['variety']."' and lotldg_sstage='Condition' and lotldg_lotno='".$row['lotnumber']."'") or die(mysqli_error($link));
$tot_lot=mysqli_num_rows($sql_issue);
if($tot_lot > 0)
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row['crop']."' order by cropname Asc"); 
$noticia = mysqli_fetch_array($quer3);
?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input type="text" name="txtcrop1" readonly="true" style="background-color:#CCCCCC;" value="<?php echo $noticia['cropname'];?>" size="32"  />&nbsp;<font color="#FF0000">*</font>&nbsp;<input type="hidden" name="txtcrop" value="<?php echo $noticia['cropid'];?>" /></td>
<?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row['variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia = mysqli_fetch_array($quer4);
?>
	<td align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem" >&nbsp;<input type="text" name="txtvariety1" readonly="true" style="background-color:#CCCCCC;" value="<?php echo $noticia['popularname'];?>" size="32"  />&nbsp;<font color="#FF0000">*</font>&nbsp;<input type="hidden" name="txtvariety" value="<?php echo $noticia['varietyid'];?>" /></td>
           </tr>
</table>		   
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
              <td width="50" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
			   <td width="130" align="center" valign="middle" class="tblheading"rowspan="2" >Lot No. </td>
			    <td width="122" align="center" valign="middle" class="tblheading"rowspan="2" >SLOC</td>
			   <td align="center" valign="middle" class="tblheading"  colspan="2">Actual Quantity</td>
			   <td align="center" valign="middle" class="tblheading" colspan="2">Quantity Removed</td>
			   <td align="center" valign="middle" class="tblheading" colspan="2">Balance Quantity</td>
  </tr>
  <tr class="tblsubtitle">
                    <td width="80" align="center" valign="middle" class="tblheading" >NoB</td>
                    <td width="100" align="center" valign="middle" class="tblheading">Qty</td>
                    <td width="79" align="center" valign="middle" class="tblheading">NoB</td>
                    <td width="104" align="center" valign="middle" class="tblheading">Qty</td>
                    <td width="71" align="center" valign="middle" class="tblheading">NoB</td>
                    <td width="94" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
<?php
$srno=1; $rtotalups=0; $rtotalqty=0; $cnt=0;
$t=mysqli_num_rows($sql_issue);
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."'  and lotldg_crop ='".$row['crop']."' and lotldg_variety='".$row['variety']."' and lotldg_sstage='Condition' and lotldg_lotno='".$row['lotnumber']."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
  $cnt++;

 $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0; $nob=""; $qty="";$baln=""; $balq="";

if($row_subsub['whid']==$row_issue['lotldg_whid'] && $row_subsub['binid']==$row_issue['lotldg_binid'] && $row_subsub['subbinid']==$row_issue['lotldg_subbinid'])
{
$nob=$row_subsub['remnob'];
$qty=$row_subsub['remqty'];
$baln=$row_subsub['balnob'];
$balq=$row_subsub['balqty'];
}
  
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and whid='".$row_issue['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and binid='".$row_issue['lotldg_binid']."' and whid='".$row_issue['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and sid='".$row_issue['lotldg_subbinid']."' and binid='".$row_issue['lotldg_binid']."' and whid='".$row_issue['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn;
else
$slocs=$wareh.$binn.$subbinn;

$rtotalups=$rtotalups+$row_issuetbl['lotldg_balbags'];
$rtotalqty=$rtotalqty+$row_issuetbl['lotldg_balqty'];


if($srno%2!=0)
{
?>  
  <tr class="Light" height="30">
    <td width="50" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtlotno_<?php echo $srno;?>" id="txtlotno_<?php echo $srno;?>" type="text" size="20" class="tbltext"  maxlength="20" style="background-color:#CCCCCC" value="<?php echo $row['lotnumber'];?>"/></td>

    <td width="122"  align="left" valign="middle" class="tbltext">&nbsp;<input name="sloc_<?php echo $srno;?>" id="sloc_<?php echo $srno;?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9"  onkeypress="return isNumberKey(event)" value="<?php echo $slocs;?>" style="background-color:#CCCCCC"  readonly="true" />&nbsp;&nbsp;<input type="hidden" name="wh_<?php echo $srno;?>" value="<?php echo $row_issue['lotldg_whid'];?>" /><input type="hidden" name="bin_<?php echo $srno;?>" value="<?php echo $row_issue['lotldg_binid'];?>" /><input type="hidden" name="sbin_<?php echo $srno;?>" value="<?php echo $row_issue['lotldg_subbinid'];?>" /></td>
	<td width="80"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdisp_<?php echo $srno;?>" id="txtdisp_<?php echo $srno;?>" type="text" size="5" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" value="<?php echo $row_issuetbl['lotldg_balbags'];?>" style="background-color:#CCCCCC"  readonly="true" />&nbsp;&nbsp;</td>
    <td width="100" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<input name="txtqty_<?php echo $srno;?>" id="txtqty_<?php echo $srno;?>" type="text" size="9" class="tbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['lotldg_balqty'];?>"/>&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtrecbagp_<?php echo $srno;?>" id="txtrecbagp_<?php echo $srno;?>" type="text" size="5" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)"  onchange="Bagschk1(this.value,'<?php echo $srno;?>');" value="<?php echo $nob;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

  <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="recqtyp_<?php echo $srno;?>" id="recqtyp_<?php echo $srno;?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9"  onkeypress="return isNumberKey(event)" onchange="qtychk1(this.value,'<?php echo $srno;?>');" value="<?php echo $qty;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
      <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdbagp_<?php echo $srno;?>" id="txtdbagp_<?php echo $srno;?>" type="text" size="5" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $baln;?>" />  &nbsp; </td>
       
      <td align="left"  valign="middle" class="tbltext"> &nbsp;&nbsp;<input name="txtdqtyp_<?php echo $srno;?>" id="txtdqtyp_<?php echo $srno;?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $balq;?>" /></td>
  </tr>
 <?php
}
else
{
?>
  <tr class="Light" height="30">
     <td width="50" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtlotno_<?php echo $srno;?>" id="txtlotno_<?php echo $srno;?>" type="text" size="20" class="tbltext"  maxlength="20" style="background-color:#CCCCCC" value="<?php echo $row['lotnumber'];?>"/></td>

    <td width="122"  align="left" valign="middle" class="tbltext">&nbsp;<input name="sloc_<?php echo $srno;?>" id="sloc_<?php echo $srno;?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9"  onkeypress="return isNumberKey(event)" value="<?php echo $slocs;?>" style="background-color:#CCCCCC"  readonly="true" />&nbsp;&nbsp;<input type="hidden" name="wh_<?php echo $srno;?>" value="<?php echo $row_issue['lotldg_whid'];?>" /><input type="hidden" name="bin_<?php echo $srno;?>" value="<?php echo $row_issue['lotldg_binid'];?>" /><input type="hidden" name="sbin_<?php echo $srno;?>" value="<?php echo $row_issue['lotldg_subbinid'];?>" /></td>
	<td width="80"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdisp_<?php echo $srno;?>" id="txtdisp_<?php echo $srno;?>" type="text" size="5" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" value="<?php echo $row_issuetbl['lotldg_balbags'];?>" style="background-color:#CCCCCC"  readonly="true" />&nbsp;&nbsp;</td>
    <td width="100" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<input name="txtqty_<?php echo $srno;?>" id="txtqty_<?php echo $srno;?>" type="text" size="9" class="tbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['lotldg_balqty'];?>"/>&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtrecbagp_<?php echo $srno;?>" id="txtrecbagp_<?php echo $srno;?>" type="text" size="5" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)"  onchange="Bagschk1(this.value,'<?php echo $srno;?>');"  value="<?php echo $nob;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

  <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="recqtyp_<?php echo $srno;?>" id="recqtyp_<?php echo $srno;?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9"  onkeypress="return isNumberKey(event)" onchange="qtychk1(this.value,'<?php echo $srno;?>');" value="<?php echo $qty;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
      <td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdbagp_<?php echo $srno;?>" id="txtdbagp_<?php echo $srno;?>" type="text" size="5" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $baln;?>" />  &nbsp; </td>
       
      <td align="left"  valign="middle" class="tbltext"> &nbsp;&nbsp;<input name="txtdqtyp_<?php echo $srno;?>" id="txtdqtyp_<?php echo $srno;?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" value="<?php echo $balq;?>" /></td>

  </tr>


 <?php
}
$srno++;
}
}
?></table>
<br />
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:Pointer;"  onclick="pformedtup();" />&nbsp;&nbsp;</td>
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /> <input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="srno1" value="<?php echo $cnt;?>" />
<?php } ?>