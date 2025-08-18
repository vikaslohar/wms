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

	
if(isset($_GET['code'])) { $code = $_GET['code']; }
if(isset($_GET['txtdate'])) { $trdate = $_GET['txtdate']; }
if(isset($_GET['txtcrop'])) { $txtcrop = $_GET['txtcrop']; }
if(isset($_GET['txtvariety'])) { $txtvariety = $_GET['txtvariety']; }
if(isset($_GET['txtlot1'])) { $txtlot1 = $_GET['txtlot1']; }
if(isset($_GET['maintrid'])) { $trid = $_GET['maintrid']; }
if(isset($_GET['txtstage'])) { $txtstage = $_GET['txtstage']; }
if(isset($_GET['txtnewqty'])) { $txtnewqty = $_GET['txtnewqty']; }	
if(isset($_GET['subtrid'])) { $subtrid = $_GET['subtrid']; }
		
$txtlotbatch=""; $txtnewlotnumber=""; $neworlot=""; $qc2=""; $txtqc="";
if(isset($_GET['txtconqty'])) { $txtconqty = $_GET['txtconqty']; }
if($txtconqty==0)
{
	if(isset($_GET['txtlotbatch'])) { $txtlotbatch = $_GET['txtlotbatch']; }
	if(isset($_GET['txtnewlotnumber'])) { $txtnewlotnumber = $_GET['txtnewlotnumber']; }
	if(isset($_GET['neworlot'])) { $neworlot = $_GET['neworlot']; }
	if(isset($_GET['qc2'])) { $qc2 = $_GET['qc2']; }
	if(isset($_GET['txtqc'])) { $txtqc = $_GET['txtqc']; }
}
else
{
$txtnewlotnumber=$txtlot1;
}
if(isset($_GET['txtslwhg1'])) { $txtslwhg1 = $_GET['txtslwhg1']; }
if(isset($_GET['txtslbing1'])) { $txtslbing1 = $_GET['txtslbing1']; }
if(isset($_GET['txtslsubbg1'])) { $txtslsubbg1= $_GET['txtslsubbg1']; }
if(isset($_GET['txtconslnob1'])) { $txtconslnob1 = $_GET['txtconslnob1']; }
if(isset($_GET['txtconslqty1'])) { $txtconslqty1 = $_GET['txtconslqty1']; }
if(isset($_GET['txtslwhg2'])) { $txtslwhg2 = $_GET['txtslwhg2']; }
if(isset($_GET['txtslbing2'])) { $txtslbing2 = $_GET['txtslbing2']; }
if(isset($_GET['txtslsubbg2'])) { $txtslsubbg2 = $_GET['txtslsubbg2']; }
if(isset($_GET['txtconslnob2'])) { $txtconslnob2 = $_GET['txtconslnob2']; }
if(isset($_GET['txtconslqty2'])) { $txtconslqty2 = $_GET['txtconslqty2']; }

if(isset($_GET['enob'])) { $enob = $_GET['enob']; }
if(isset($_GET['eqty'])) { $eqty = $_GET['eqty']; }
if(isset($_GET['eqc'])) { $eqc = $_GET['eqc']; }
if(isset($_GET['edot'])) { $edot = $_GET['edot']; }
if(isset($_GET['egot'])) { $egot = $_GET['egot']; }
if(isset($_GET['edogr'])) { $edogr = $_GET['edogr']; }
if(isset($_GET['esloc'])) { $esloc = $_GET['esloc']; }
if(isset($_GET['eqcsts'])) { $eqcsts = $_GET['eqcsts']; }

//frm_action=submit&code=1&txtdate=10-08-2015&txtcrop=49&txtvariety=1&itmdchk=&pcode=D&ycodee=D&txtlot2=07945&stcode=01210&stcode2=00&getdet=0&txtlot1=DD07945%2F01210%2F00&enob=1&eqty=0.65&eqc=Fail&edot=09-02-2015&egot=GOT-NR%20OK&edogr=02-07-2014&esloc=WH-AR%2FA02%2F6%20%7C%201%20%7C%200.650&eqcsts=Availabe&txtstage=Condition&txtnewqty=30&txtconqty=0.65&txtslwhg1=1&txtslbing1=133&txtslsubbg1=2644&txtconslnob1=1&txtconslqty1=15&txtslwhg2=1&txtslbing2=133&txtslsubbg2=2645&txtconslnob2=1&txtconslqty2=15&maintrid=0&subtrid=0
		
		$tdate11=explode("-",$trdate);
		$tdate1=$tdate11[2]."-".$tdate11[1]."-".$tdate11[0];
		
		$tdate12=explode("-",$edot);
		$tdate2=$tdate12[2]."-".$tdate12[1]."-".$tdate12[0];
		
		$tdate13=explode("-",$edogr);
		$tdate3=$tdate13[2]."-".$tdate13[1]."-".$tdate13[0];
		
if($trid == 0)
{
	$sql_in1="insert into tbl_ci(ci_tcode, ci_date, ci_crop, ci_variety, ci_yearcode, ci_logid, plantcode) values ('$code', '$tdate1', '$txtcrop', '$txtvariety', '$yearid_id', '$logid', '$plantcode')";
	if(mysqli_query($link,$sql_in1) or die(mysqli_error($link)))
	{
		$mainid=mysqli_insert_id($link);

		$sql_sub="insert into tbl_cisub(ci_id, cisub_crop, cisub_variety, cisub_lotno, cisub_stage, cisub_qty, cisub_newlotno, cisub_qcrsts, cisub_qc, cisub_eqc, cisub_edot, cisub_egot, cisub_edogr, cisub_enob, cisub_eqty, cisub_esloc, cisub_stagests, plantcode) values('$mainid', '$txtcrop', '$txtvariety', '$txtlot1', '$txtstage', '$txtnewqty', '$txtnewlotnumber', '$qc2', '$txtqc', '$eqc', '$tdate2', '$egot', '$tdate3', '$enob', '$eqty', '$esloc', '$eqcsts', '$plantcode')";
		if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
		{
			$subid=mysqli_insert_id($link);
			
			$sql_sub_sub="insert into tbl_cisub_sub(ci_id, cisub_id, ciss_whid, ciss_binid, ciss_subbinid, ciss_nob, ciss_qty, plantcode) values('$mainid', '$subid', '$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '$txtconslnob1', '$txtconslqty1', '$plantcode')";
			mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
			
			if($txtconslqty2 > 0)
			{
				$sql_sub_sub2="insert into tbl_cisub_sub(ci_id, cisub_id, ciss_whid, ciss_binid, ciss_subbinid, ciss_nob, ciss_qty, plantcode) values('$mainid', '$subid', '$txtslwhg2', '$txtslbing2', '$txtslsubbg2', '$txtconslnob2', '$txtconslqty2', '$plantcode')";
				mysqli_query($link,$sql_sub_sub2) or die(mysqli_error($link));
			}
		}
	}
	$trid=$mainid;
}
else
{
	$mainid=$trid;
	//$sql_in1="insert into tbl_ci(ci_tcode, ci_date, ci_crop, ci_variety, ci_yearcode, ci_logid) values ('$code', '$tdate1', '$txtcrop', '$txtvariety', '$yearid_id', '$logid')";
	//if(mysqli_query($link,$sql_in1) or die(mysqli_error($link)))
	{
		//$mainid=mysqli_insert_id($link);

		$sql_sub="update tbl_cisub set cisub_crop='$txtcrop', cisub_variety='$txtvariety', cisub_lotno='$txtlot1', cisub_stage='$txtstage', cisub_qty='$txtnewqty', cisub_newlotno='$txtnewlotnumber', cisub_qcrsts='$qc2', cisub_qc='$txtqc', cisub_eqc='$eqc', cisub_edot='$tdate2', cisub_egot='$egot', cisub_edogr='$tdate3', cisub_enob='$enob', cisub_eqty='$eqty', cisub_esloc='$esloc', cisub_stagests='$eqcsts' where ci_id='$mainid' and cisub_id='$subtrid' ";
		if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
		{
			$subid=$subtrid;
			
			$s_sub_sub="delete from tbl_cisub_sub where ci_id='$mainid' and cisub_id='$subtrid'";
			mysqli_query($link,$s_sub_sub) or die(mysqli_error($link));
			
			$sql_sub_sub="insert into tbl_cisub_sub(ci_id, cisub_id, ciss_whid, ciss_binid, ciss_subbinid, ciss_nob, ciss_qty, plantcode) values('$mainid', '$subid', '$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '$txtconslnob1', '$txtconslqty1', '$plantcode')";
			mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
			
			if($txtconslqty2 > 0)
			{
				$sql_sub_sub2="insert into tbl_cisub_sub(ci_id, cisub_id, ciss_whid, ciss_binid, ciss_subbinid, ciss_nob, ciss_qty, plantcode) values('$mainid', '$subid', '$txtslwhg2', '$txtslbing2', '$txtslsubbg2', '$txtconslnob2', '$txtconslqty2', '$plantcode')";
				mysqli_query($link,$sql_sub_sub2) or die(mysqli_error($link));
			}
		}
	}
}
?>

<?php 
$tid=$mainid;

$sql1=mysqli_query($link,"select * from tbl_ci where ci_id=$tid and plantcode='$plantcode'")or die(mysqli_error($link));
$row=mysqli_fetch_array($sql1);

$tdate=$row['ci_date'];
$tyear=substr($tdate,0,4);
$tmonth=substr($tdate,5,2);
$tday=substr($tdate,8,2);
$tdate=$tday."-".$tmonth."-".$tyear;
	
 ?> 
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">SP Cycle Inventory</td>
</tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
<tr class="Dark" height="25">
           <td width="200" height="24"  align="right"  valign="middle" class="tblheading">Transction ID &nbsp;</td>
            <td width="415"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TCI".$row['ci_tcode']."/".$row['ci_yearcode']."/".$row['ci_logid'];?></td>
		   
		   <td width="64" height="24"  align="right"  valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
           <td width="161" align="left"  valign="middle">&nbsp;<input name="txtdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo $tdate;?>" /></td>
		   </tr>
<?php 
$classqry=mysqli_query($link,"select * from tblcrop where cropid='".$row['ci_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class = mysqli_fetch_array($classqry);
?>
<tr class="Light" height="25">
   <td width="153"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
           <td width="268" align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $noticia_class['cropname'];?><input type="hidden" class="tbltext" name="txtcrop" value="<?php echo $noticia_class['cropid'];?>" />&nbsp;<font color="#FF0000">*</font></td>

<?php 
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row['ci_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item = mysqli_fetch_array($itemqry);
?>            
         
<td width="102" align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="317" align="left" valign="middle" class="tbltext" id="vitem">&nbsp;<?php echo $noticia_item['popularname'];?><input type="hidden" class="tbltext" name="txtvariety" value="<?php echo $noticia_item['varietyid'];?>" /></td>
</tr><input type="hidden" name="itmdchk" value="" />

<?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
?>	
   <?php
   $quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
   $row_month=mysqli_fetch_array($quer6);
  $a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>	
 <tr class="Light" height="25">
            <td width="153" height="24"  align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
           <td align="left"  valign="middle"  class="tbltext">&nbsp;<select class="tbltext" name="pcode" style="width:40px;">
    <!--<option value="" >--Select--</option>-->
	<option value="<?php echo $a;?>" selected ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="tbltext" name="ycodee" id="ycodee" style="width:40px;" onchange="ycodchk();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2" type="text" size="4" class="tbltext"  maxlength="5" onkeypress="return 
  isNumberKey(event)"  onchange="lot2chk();"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="tbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="00000" onchange="slocshow();" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="tbltext" tabindex="0" maxlength="2" onkeypress="return isNumberKey(event)"  value="00"  onchange="slocshow2();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  <td align="left"valign="middle" class="tblheading" colspan="2" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After entry of lot no. click on 'Get Details')<input type="hidden" name="getdet" value="0" /><input type="hidden" name="txtlot1" value="" /></td>	 
         </tr>	
</table>
<br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">SP Cycle Inventory Lots Details</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="26" align="center" class="smalltblheading">#</td>
	<td width="136" align="center" class="smalltblheading">Crop</td>
	<td width="234" align="center" class="smalltblheading">Variety</td>
	<td width="143" align="center" class="smalltblheading">Old Lot No.</td>
	<td width="143" align="center" class="smalltblheading">New Lot No.</td>
	<td width="88" align="center" class="smalltblheading">Stage</td>
	<td width="73" align="center" class="smalltblheading">NoB</td>
	<td width="85" align="center" class="smalltblheading">Qty</td>
	<td width="73" align="center" class="smalltblheading">Edit</td>
	<td width="72" align="center" class="smalltblheading">Delete</td>
</tr>
<?php
$sr=1;
$sql_eindent_sub=mysqli_query($link,"select * from tbl_cisub where ci_id=$tid and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{

$stage=$row_eindent_sub['cisub_stage'];
$lotn=$row_eindent_sub['cisub_newlotno'];
$olotn=$row_eindent_sub['cisub_lotno'];
	
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_eindent_sub['cisub_crop']."'") or die(mysqli_error($link));
$noticia_class = mysqli_fetch_array($classqry);
$classid=$noticia_class['cropname'];

$tto=0;
$sql_veriety=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_eindent_sub['cisub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$tto=mysqli_num_rows($sql_veriety);
if($tto>0)
{		
	$row_variety=mysqli_fetch_array($sql_veriety);
	$itemid=$row_variety['popularname'];				
}
else
{
	$itemid=$row_eindent_sub['cisub_variety'];
}
$slups=0; $slqty=0; 
$sql_tblissue=mysqli_query($link,"select * from tbl_cisub_sub where ci_id='".$trid."' and cisub_id='".$row_eindent_sub['cisub_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_tblissue=mysqli_num_rows($sql_tblissue);
while($row_tblissue=mysqli_fetch_array($sql_tblissue))
{
$slups=$slups+$row_tblissue['ciss_nob'];
$slqty=$slqty+$row_tblissue['ciss_qty'];
}

if($sr%2!=0)
{
?>
<tr class="Light" height="25">
	<td width="26" align="center" class="smalltblheading"><?php echo $sr;?></td>
	<td width="136" align="center" class="smalltblheading"><?php echo $classid;?></td>
	<td width="234" align="center" class="smalltblheading"><?php echo $itemid;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $olotn;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td width="88" align="center" class="smalltblheading"><?php echo $stage;?></td>
	<td width="73" align="center" class="smalltblheading"><?php echo $slups;?></td>
	<td width="85" align="center" class="smalltblheading"><?php echo $slqty;?></td>
	<td width="73" align="center" class="smalltblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_eindent_sub['cisub_id'];?>,<?php echo $row_eindent_sub['ci_id'];?>);" /></td>
	<td width="72" align="center" class="smalltblheading"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['ci_id'];?>,<?php echo $row_eindent_sub['cisub_id'];?>);" /></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
	<td width="26" align="center" class="smalltblheading"><?php echo $sr;?></td>
	<td width="136" align="center" class="smalltblheading"><?php echo $classid;?></td>
	<td width="234" align="center" class="smalltblheading"><?php echo $itemid;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $olotn;?></td>
	<td width="143" align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td width="88" align="center" class="smalltblheading"><?php echo $stage;?></td>
	<td width="73" align="center" class="smalltblheading"><?php echo $slups;?></td>
	<td width="85" align="center" class="smalltblheading"><?php echo $slqty;?></td>
	<td width="73" align="center" class="smalltblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_eindent_sub['cisub_id'];?>,<?php echo $row_eindent_sub['ci_id'];?>);" /></td>
	<td width="72" align="center" class="smalltblheading"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['ci_id'];?>,<?php echo $row_eindent_sub['cisub_id'];?>);" /></td>
</tr>
<?php 
}
$sr=$sr+1;	
}
?>	
</table>
<br />

<div id="postingsubtable">
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /> <input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>
