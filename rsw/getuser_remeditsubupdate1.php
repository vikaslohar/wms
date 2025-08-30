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



if(isset($_GET['txt11']))
	{
	 $txt11 = $_GET['txt11'];	 
	}
if(isset($_GET['txt14']))
	{
	$txt14 = $_GET['txt14'];	 
	}
if(isset($_GET['txtid']))
	{
	$txtid = $_GET['txtid'];	 
	}
if(isset($_GET['date']))
	{
	$date = $_GET['date'];	 
	}
if(isset($_GET['txtcrop']))
	{
	$txtcrop = $_GET['txtcrop'];	 
	}
	
if(isset($_GET['txtvariety']))
	{
	 $txtvariety= $_GET['txtvariety'];	 
	}
if(isset($_GET['itmdchk']))
	{
	 $itmdchk = $_GET['itmdchk'];	 
	}
		
	if(isset($_GET['maintrid']))
	{
	  $z1 = $_GET['maintrid'];	 
	}
	
	if(isset($_GET['srno1']))
	{
	  $srno1 = $_GET['srno1'];	 
	}

if(isset($_GET['subtrid']))
	{
$subtrid = $_GET['subtrid'];	 
	}
if(isset($_GET['txtlotno_1']))
	{
$txtlotno_1 = $_GET['txtlotno_1'];	 
	}	
	$remarks=trim($_REQUEST['remarks']);
	
		 $tdate11=$date;
		$tday1=substr($tdate11,0,2);
		$tmonth1=substr($tdate11,3,2);
		$tyear1=substr($tdate11,6,4);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;


//frm_action=submit&txt11=&txt14=&txtid=1&logid=RS1&date=07-04-2011&itmdchk=0&txtcrop1=Cowpea&txtcrop=33&txtvariety1=Baramasi&txtvariety=124&txtlotno_1=GD04193%2F00000R&sloc_1=WH-01%2FA1%2F1&wh_1=57&bin_1=104&sbin_1=1071&txtdisp_1=1&txtqty_1=100.000&txtrecbagp_1=1&recqtyp_1=10&txtdbagp_1=1&txtdqtyp_1=90&maintrid=0&subtrid=0&srno1=1

if($z1 == 0)
{
   $sql_main="insert into tbl_rswrem(rswrem_tcode, rswrem_date, logid, plantcode, remarks)values('$txtid','$tdate1','$logid','$plantcode','$remarks')";
	if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
	{
		$mainid=mysqli_insert_id($link);
		$sql_sub="insert into tbl_rswrem_sub (rswrem_id, crop, variety, lotnumber, plantcode)values('$mainid', '$txtcrop', '$txtvariety', '$txtlotno_1','$plantcode')";
		if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
		{	
			$subid=mysqli_insert_id($link);
			for($i=1; $i<=$srno1;$i++)
			{
				$wh="wh_".$i;
				$bin="bin_".$i;
				$sbin="sbin_".$i;
				$onob="txtdisp_".$i;
				$oqty="txtqty_".$i;
				$rnob="txtrecbagp_".$i;
				$rqty="recqtyp_".$i;
				$balnob="txtdbagp_".$i;
				$balqty="txtdqtyp_".$i;
				
				$wh2=$_GET[$wh];
				$bin2=$_GET[$bin];
				$sbin2=$_GET[$sbin];
				$onob2=$_GET[$onob];
				$oqty2=$_GET[$oqty];
				$rnob2=$_GET[$rnob];
				$rqty2=$_GET[$rqty];
				$balnob2=$_GET[$balnob];
				$balqty2=$_GET[$balqty];
				
				  $sql_sub="insert into tbl_rswremsub_sub (rswremsub_id, rswrem_id, whid, binid, subbinid, opnob, opqty, remnob, remqty, balnob, balqty)values('$subid','$mainid', '$wh2', '$bin2', '$sbin2', '$onob2', '$oqty2', '$rnob2', '$rqty2', '$balnob2', '$balqty2')";
				mysqli_query($link,$sql_sub) or die(mysqli_error($link));
			}
		}
	}
	$z1=$mainid;
}
else
{
	$sql_main="update tbl_rswrem set  rswrem_date='$tdate1', logid='$logid', remarks='$remarks' where rswrem_id='".$z1."'";
	if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
	{
		$mainid=$z1;
		$sql_sub="update tbl_rswrem_sub set rswrem_id='$mainid', crop='$txtcrop', variety='$txtvariety', lotnumber='$txtlotno_1' where rswremsub_id='".$subtrid."'";
			if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
			{	
				$subid=$subtrid;
				$sql_del=mysqli_query($link,"delete from tbl_rswremsub_sub where rswremsub_id='".$subtrid."'") or die(mysqli_error($link));
				for($i=1; $i<=$srno1;$i++)
				{
					$wh="wh_".$i;
					$bin="bin_".$i;
					$sbin="sbin_".$i;
					$onob="txtdisp_".$i;
					$oqty="txtqty_".$i;
					$rnob="txtrecbagp_".$i;
					$rqty="recqtyp_".$i;
					$balnob="txtdbagp_".$i;
					$balqty="txtdqtyp_".$i;
					
					$wh2=$_GET[$wh];
					$bin2=$_GET[$bin];
					$sbin2=$_GET[$sbin];
					$onob2=$_GET[$onob];
					$oqty2=$_GET[$oqty];
					$rnob2=$_GET[$rnob];
					$rqty2=$_GET[$rqty];
					$balnob2=$_GET[$balnob];
					$balqty2=$_GET[$balqty];
					
					  $sql_sub="insert into tbl_rswremsub_sub (rswremsub_id, rswrem_id, whid, binid, subbinid, opnob, opqty, remnob, remqty, balnob, balqty, plantcode)values('$subid','$mainid', '$wh2', '$bin2', '$sbin2', '$onob2', '$oqty2', '$rnob2', '$rqty2', '$balnob2', '$balqty2','$plantcode')";
					mysqli_query($link,$sql_sub) or die(mysqli_error($link));
				}
			}
	}
}

?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" > 
<?php  

 $tid=$z1;

$sql_tbl=mysqli_query($link,"select * from tbl_rswrem where rswrem_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
  $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['rswrem_id'];

$tdate=$row_tbl['rswrem_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
/*$sql_tbl_sub=mysqli_query($link,"select * from tbl_dryingsub where trid='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);*/
$subtid=0;
?>	

<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Raw Seed Release</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TRR".$row_tbl['rswrem_tcode']."/".$yearid_id."/".$lgnid;?></td>

<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="229" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $tdate;?>" maxlength="10"/>&nbsp;</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#e48324" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_rswrem_sub where rswrem_id='".$arrival_id."'") or die(mysqli_error($link));
 $subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
              <td width="17" align="center" valign="middle" class="tblheading" rowspan="2">#</td>
			   <td width="92" align="center" valign="middle" class="tblheading"rowspan="2" >Lot No.</td>
			    <td width="123" align="center" valign="middle" class="tblheading"rowspan="2" >Crop</td>
			    <td width="123" align="center" valign="middle" class="tblheading"rowspan="2" >Variety</td>
			    <td width="91" align="center" valign="middle" class="tblheading"rowspan="2" >SLOC</td>
			   <td align="center" valign="middle" class="tblheading"  colspan="2">Actual Quantity</td>
			   <td align="center" valign="middle" class="tblheading" colspan="2">Quantity Removed</td>
			   <td align="center" valign="middle" class="tblheading" colspan="2">Balance Quantity</td>
			   <td width="30" align="center" valign="middle" class="tblheading" rowspan="2">Edit</td>
    			<td width="39" align="center" valign="middle" class="tblheading"rowspan="2" >Delete</td>
</tr>
<tr class="tblsubtitle">
                    <td width="50" align="center" valign="middle" class="tblheading" >NoB</td>
                    <td width="55" align="center" valign="middle" class="tblheading">Qty</td>
                    <td width="49" align="center" valign="middle" class="tblheading">NoB</td>
                    <td width="53" align="center" valign="middle" class="tblheading">Qty</td>
                    <td width="48" align="center" valign="middle" class="tblheading">NoB</td>
                    <td width="52" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
  <?php
$srno=1; $difq="";
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$arrival_id=$row_tbl_sub['rswrem_id'];

$sql_tbl_subsub=mysqli_query($link,"select * from tbl_rswremsub_sub where rswremsub_id='".$row_tbl_sub['rswremsub_id']."' and rswrem_id='".$row_tbl_sub['rswrem_id']."'") or die(mysqli_error($link));
while($row_subsub=mysqli_fetch_array($sql_tbl_subsub))
{

  $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=""; $slocs=""; $gd=""; $slups=0; $slqty=0; $onob=0; $oqty=0; $nob=0; $qty=0; $baln=0; $balq=0;
  
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_subsub['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_subsub['binid']."' and whid='".$row_subsub['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_subsub['subbinid']."' and binid='".$row_subsub['binid']."' and whid='".$row_subsub['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$onob=$onob+$row_subsub['opnob'];
$oqty=$oqty+$row_subsub['opqty'];
$nob=$nob+$row_subsub['remnob'];
$qty=$qty+$row_subsub['remqty'];
$baln=$baln+$row_subsub['balnob'];
$balq=$balq+$row_subsub['balqty'];

}
$sql_crp=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['crop']."' order by cropname Asc"); 
$row_crp = mysqli_fetch_array($sql_crp);

$sql_var=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_tbl_sub['variety']."' and actstatus='Active' and vertype='PV' order by popularname Asc"); 
$row_var = mysqli_fetch_array($sql_var);

if($srno%2!=0)
{
/*$diq=explode(".",$row_tbl_sub['adqty']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['adqty'];}
*/
?>
  <tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tblheading" ><?php echo $row_tbl_sub['lotnumber'];?></td>
	<td align="center"  valign="middle" class="tblheading" ><?php echo $row_crp['cropname'];?></td>
	<td align="center"  valign="middle" class="tblheading" ><?php echo $row_var['popularname'];?></td>
	<td align="center"  valign="middle" class="tblheading" ><?php echo $slocs;?></td>
	 <td align="center"  valign="middle" class="tblheading" ><?php echo $onob;?></td>
    <td width="55" align="center" valign="middle" class="tblheading"><?php echo $oqty;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $nob;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $qty;?></td>
	<td width="48" align="center" valign="middle" class="tblheading"><?php echo $baln;?></td>
	<td width="52" align="center" valign="middle" class="tblheading"><?php echo $balq;?></td>
        <td width="30" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['rswremsub_id'];?>);" /></td>
    <td width="39" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['rswremsub_id'];?>);" /></td>
  </tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tblheading" ><?php echo $row_tbl_sub['lotnumber'];?></td>
	<td align="center"  valign="middle" class="tblheading" ><?php echo $row_crp['cropname'];?></td>
	<td align="center"  valign="middle" class="tblheading" ><?php echo $row_var['popularname'];?></td>
	<td align="center"  valign="middle" class="tblheading" ><?php echo $slocs;?></td>
	 <td align="center"  valign="middle" class="tblheading" ><?php echo $onob;?></td>
    <td width="55" align="center" valign="middle" class="tblheading"><?php echo $oqty;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $nob;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $qty;?></td>
	<td width="48" align="center" valign="middle" class="tblheading"><?php echo $baln;?></td>
	<td width="52" align="center" valign="middle" class="tblheading"><?php echo $balq;?></td>
        <td width="30" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['rswremsub_id'];?>);" /></td>
    <td width="39" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['rswremsub_id'];?>);" /></td>
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
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");
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
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' and vertype='PV' order by popularname Asc"); 
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          </tr>

         <tr class="Light" height="30" id="vitem">
           <td align="right"  valign="middle" class="tblheading">Lot Number &nbsp;</td>
           <td align="left" width="272" valign="middle" class="tbltext" style="border-color:#F1B01E" >&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a><input type="hidden" name="txtlotnoid" /></td>
	<td align="left" width="366" valign="middle" class="tblheading" colspan="2" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get Details')</td>	  
		   
</table>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /></div>


