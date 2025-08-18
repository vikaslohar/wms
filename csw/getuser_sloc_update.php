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
	
$tp="Condition";

if(isset($_GET['code']))
	{
	$code = $_GET['code'];	 
	}
if(isset($_GET['txtdate']))
	{
	$txtdate = $_GET['txtdate'];	 
	}
if(isset($_GET['trid']))
	{
	$trid = $_GET['trid'];	 
	}
if(isset($_GET['txtcrop']))
	{
	$txtcrop = $_GET['txtcrop'];	 
	}
if(isset($_GET['txtvariety']))
	{
	$txtvariety = $_GET['txtvariety'];	 
	}	

if(isset($_GET['txtlot1']))
	{
	$txtlot1 = $_GET['txtlot1'];	 
	}	

	if(isset($_GET['oBags']))
	{
	$oBags = $_GET['oBags'];	 
	}	
	if(isset($_GET['oqty']))
	{
	$oqty = $_GET['oqty'];	 
	}	
	
	if(isset($_GET['otBags']))
	{
	$otBags = $_GET['otBags'];	 
	}	
	if(isset($_GET['otqty']))
	{
	$otqty = $_GET['otqty'];	 
	}	
	
	if(isset($_GET['tblslocnog']))
	{
	$tblslocnog = $_GET['tblslocnog'];	 
	}
	
	$rowid1=0;$rowid2=0;$god1=0;$god2=0;
	if(isset($_GET['txtslwhg1']))
	{
	$y = $_GET['txtslwhg1'];	 
	}
	if(isset($_GET['txtslbing1']))
	{
	$z = $_GET['txtslbing1'];	 
	}
	if(isset($_GET['txtslsubbg1']))
	{
	$a1 = $_GET['txtslsubbg1'];	 
	}
	if(isset($_GET['txtslqtyg1']))
	{
	$b1 = $_GET['txtslqtyg1'];	 
	}
	else
	{
	$b1=0;
	}
	if(isset($_GET['txtslBagsg1']))
	{
	$c1 = $_GET['txtslBagsg1'];	 
	}
	if(isset($_GET['txtslwhg2']))
	{
	$d1 = $_GET['txtslwhg2'];	 
	}
	if(isset($_GET['txtslbing2']))
	{
	$e1= $_GET['txtslbing2'];	 
	}
	if(isset($_GET['txtslsubbg2']))
	{
	$f1 = $_GET['txtslsubbg2'];	 
	}
	if(isset($_GET['txtslqtyg2']))
	{
	$g1 = $_GET['txtslqtyg2'];	 
	}
	else
	{
	$g1=0;
	}
	if(isset($_GET['txtslBagsg2']))
	{
	$h1 = $_GET['txtslBagsg2'];	 
	}
	
	if(isset($_GET['orwoid']))
	{
	$orwoid = $_GET['orwoid'];	 
	}	
	if(isset($_GET['ocnt']))
	{
	$ocnt = $_GET['ocnt'];	 
	}
	
	$good1=0;$good2=0;
	
	if($b1!="" && $b1 > 0)
	{
	$good1=1; $god1=1;
		if(isset($_GET['rowid_1']))
		{
			$rowid1 = $_GET['rowid_1'];	 
		}
		if(isset($_GET['exBagsg1']))
		{
			$exBags1 = $_GET['exBagsg1'];	 
		}
		if(isset($_GET['exqtyg1']))
		{
			$exqty1 = $_GET['exqtyg1'];	 
		}
		
		$balup1=$c1;
		$balqt1=$b1;
		
		if($balqt1 > 0 && $balup1 == 0) $balup1=1;
		if($balqt1 == 0 && $balup1 == 0) $balup1=0;
		if($balqt1 == 0 && $balup1 > 0) $balup1=0;
	}
	
	if($g1!="" && $g1 > 0)
	{
		$good2=1; $god2=1;
		if(isset($_GET['rowid_2']))
		{
			$rowid2 = $_GET['rowid_2'];	 
		}
		if(isset($_GET['exBagsg2']))
		{
			$exBags2 = $_GET['exBagsg2'];	 
		}
		if(isset($_GET['exqtyg2']))
		{
			$exqty2 = $_GET['exqtyg2'];	 
		}
		
		
		$balup2=$h1;
		$balqt2=$g1;
		
		if($balqt2 > 0 && $balup2 == 0) $balup2=1;
		if($balqt2 == 0 && $balup2 == 0) $balup2=0;
		if($balqt2 == 0 && $balup2 > 0) $balup2=0;
	}
	
	$x=$good1+$good2;
	
//frm_action=submit&code=1&txtmtype=&rettyp=&oBags=5&oqty=5.000&txtdate=22-02-2010&txtcrop=23&txtvariety=66&itmdchk=&txtlot1=GK00022%2F00000R&rowid_1=8&txtBagsg=5&txtqtyg=5&srno=2&chkbox=&srno1=&edtrowid=&orwoid=8&trid=0&osubid=2167&otBags=0&otqty=5&txtslwhg1=59&txtslbing1=158&txtslsubbg1=2167&exBagsg1=5&exqtyg1=5&txtslBagsg1=5&txtslqtyg1=5&balBagsg1=5&balqtyg1=5&dorowig1=0&txtslwhg2=--WH--&txtslbing2=--Bin--&txtslsubbg2=--Sub%20Bin--&exBagsg2=&exqtyg2=&txtslBagsg2=&txtslqtyg2=&balBagsg2=&balqtyg2=&dorowig2=0&tblslocnod=0
	
		$tdate=$txtdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
		
		
if($trid == 0)
{
 $sql_in1="insert into tbl_sloc_csw (code, sldate, crop, variety, lotno, yearcode, surole,stage,plantcode) values ('$code', '$tdate', '$txtcrop', '$txtvariety', '$txtlot1', '$yearid_id', '$lgnid','$tp','$plantcode')";
 
if(mysqli_query($link,$sql_in1) or die(mysqli_error($link)))
{
	$mainid=mysqli_insert_id($link);

	for($j=1; $j<=$ocnt; $j++)
	{
		$txtwhgx="txtslwhg".$j;
		$txtbingx="txtslbing".$j;
		$txtsubbgx="txtslsubbg".$j;
		$exBagsgx="exBagsg".$j;
		$exqtygx="exqtyg".$j;
		$txtslBagsgx="txtslBagsg".$j;
		$txtslqtygx="txtslqtyg".$j;
		$balBagsgx="balBagsg".$j;
		$balqtygx="balqtyg".$j;
		$dorowigx="dorowig".$j;
		if(isset($_GET[$txtwhgx])) { $txtwhg= $_GET[$txtwhgx]; }
		if(isset($_GET[$txtbingx])) { $txtbing= $_GET[$txtbingx]; }
		if(isset($_GET[$txtsubbgx])) { $txtsubbg= $_GET[$txtsubbgx]; }
		if(isset($_GET[$exBagsgx])) { $exBagsg= $_GET[$exBagsgx]; }
		if(isset($_GET[$exqtygx])) { $exqtyg= $_GET[$exqtygx]; }
		if(isset($_GET[$txtslBagsgx])) { $txtslBagsg= $_GET[$txtslBagsgx]; }
		if(isset($_GET[$txtslqtygx])) { $txtslqtyg= $_GET[$txtslqtygx]; }
		if(isset($_GET[$balBagsgx])) { $balBagsg= $_GET[$balBagsgx]; }
		if(isset($_GET[$balqtygx])) { $balqtyg= $_GET[$balqtygx]; }
		if(isset($_GET[$dorowigx])) { $dorowig= $_GET[$dorowigx]; }
		if($txtslqtyg!="" && $txtsubbg!="")
		{
			$sql_in="insert into tbl_sloc_csw_sub(slocid, crop, variety, lotno, whid, binid, subbinid, opbags, opqty, balbags, balqty, bags, qty, rowid,plantcode) values('$mainid', '$txtcrop', '$txtvariety', '$txtlot1', '$txtwhg', '$txtbing', '$txtsubbg', '$exBagsg', '$exqtyg', '$balBagsg', '$balqtyg', '$txtslBagsg', '$txtslqtyg', '$orwoid','$plantcode')";
			mysqli_query($link,$sql_in) or die(mysqli_error($link));
		}
	}


}
$trid=$mainid;
}
else
{
$sql_in1="update tbl_sloc_csw set crop='$txtcrop', variety='$txtvariety', lotno='$txtlot1', yearcode='$yearid_id', stage='$tp',surole='$lgnid' where plantcode='".$plantcode."' and  slid='".$trid."'";
 
if(mysqli_query($link,$sql_in1) or die(mysqli_error($link)))
{

	$mainid=$trid;
	
	for($j=1; $j<=$ocnt; $j++)
	{
		$txtwhgx="txtslwhg".$j;
		$txtbingx="txtslbing".$j;
		$txtsubbgx="txtslsubbg".$j;
		$exBagsgx="exBagsg".$j;
		$exqtygx="exqtyg".$j;
		$txtslBagsgx="txtslBagsg".$j;
		$txtslqtygx="txtslqtyg".$j;
		$balBagsgx="balBagsg".$j;
		$balqtygx="balqtyg".$j;
		$dorowigx="dorowig".$j;
		if(isset($_GET[$txtwhgx])) { $txtwhg= $_GET[$txtwhgx]; }
		if(isset($_GET[$txtbingx])) { $txtbing= $_GET[$txtbingx]; }
		if(isset($_GET[$txtsubbgx])) { $txtsubbg= $_GET[$txtsubbgx]; }
		if(isset($_GET[$exBagsgx])) { $exBagsg= $_GET[$exBagsgx]; }
		if(isset($_GET[$exqtygx])) { $exqtyg= $_GET[$exqtygx]; }
		if(isset($_GET[$txtslBagsgx])) { $txtslBagsg= $_GET[$txtslBagsgx]; }
		if(isset($_GET[$txtslqtygx])) { $txtslqtyg= $_GET[$txtslqtygx]; }
		if(isset($_GET[$balBagsgx])) { $balBagsg= $_GET[$balBagsgx]; }
		if(isset($_GET[$balqtygx])) { $balqtyg= $_GET[$balqtygx]; }
		if(isset($_GET[$dorowigx])) { $dorowig= $_GET[$dorowigx]; }
		if($txtslqtyg!="" && $txtsubbg!="")
		{
			$sql_in="insert into tbl_sloc_csw_sub(slocid, crop, variety, lotno, whid, binid, subbinid, opbags, opqty, balbags, balqty, bags, qty, rowid,plantcode) values('$mainid', '$txtcrop', '$txtvariety', '$txtlot1', '$txtwhg', '$txtbing', '$txtsubbg', '$exBagsg', '$exqtyg', '$balBagsg', '$balqtyg', '$txtslBagsg', '$txtslqtyg', '$orwoid','$plantcode')";
			mysqli_query($link,$sql_in) or die(mysqli_error($link));
		}
	}
/* if($god1==1)
{
$sql_in="insert into tbl_sloc_csw_sub(slocid, crop, variety, lotno, whid, binid, subbinid, opbags, opqty, balbags, balqty, bags, qty, rowid) values('$mainid', '$txtcrop', '$txtvariety', '$txtlot1', '$y', '$z', '$a1', '$exBags1', '$exqty1', '$balup1', '$balqt1', '$c1', '$b1', '$orwoid')";
mysqli_query($link,$sql_in) or die(mysqli_error($link));
}
if($god2==1)
{
$sql_in="insert into tbl_sloc_csw_sub(slocid, crop, variety, lotno, whid, binid, subbinid, opbags, opqty, balbags, balqty, bags, qty, rowid) values('$mainid', '$txtcrop', '$txtvariety', '$txtlot1', '$d1', '$e1', '$f1', '$exBags2', '$exqty2', '$balup2', '$balqt2', '$h1', '$g1', '$orwoid')";
mysqli_query($link,$sql_in) or die(mysqli_error($link));
}
*/
}
}
?>

<?php 
$trid=$mainid;
//exit;
?>
<div id="subdiv" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" > 
  <tr class="tblsubtitle" height="25">
   <td colspan="4" align="center" valign="middle" class="tblheading">Existing Sloc </td>
   <td colspan="3" align="center" valign="middle" class="tblheading">Updated Sloc </td>
   <td width="59" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
 </tr>
 <tr class="tblsubtitle" height="25">
<td width="45" align="center" valign="middle" class="tblheading">#</td>
<td width="119" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="103" align="center" valign="middle" class="tblheading">NoB</td>
<td width="110" align="center" valign="middle" class="tblheading">Qty</td>
<td width="129" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="93" align="center" valign="middle" class="tblheading">NoB</td>
 <td width="74" align="center" valign="middle" class="tblheading">Qty</td>
 </tr>
<?php
$cnt=0;

$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_crop='".$txtcrop."' and lotldg_variety='".$txtvariety."' and lotldg_lotno='".$txtlot1."'") or die(mysqli_error($link));

$srno=1;
$totBags=0; $totqty=0;
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_variety='".$txtvariety."' and lotldg_lotno='".$txtlot1."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 $sloc1=""; $cnt++;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh1=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn1=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn1=$row_subbinn['sname'];
$sloc1=$wareh1.$binn1.$subbinn1;
$totBags=$totBags+$row_issuetbl['lotldg_balbags'];
$totqty=$totqty+$row_issuetbl['lotldg_balqty'];

 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['lotldg_balbags'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['lotldg_balqty'];?><input type="hidden" name="rowidd_<?php echo $srno;?>" value="<?php echo $row_issuetbl['lotldg_id']?>" /></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysqli_query($link,"select * from tbl_sloc_csw_sub where plantcode='".$plantcode."' and  slocid='".$trid."' and rowid='".$row_issue1[0]."'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slBags=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['slocsubid']; else $subrid=$row_sloc['slocsubid'];
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."/";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."/";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname'];
else*/
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slBags=$slBags+$row_sloc['bags'];
if($sBags!="")
$sBags=$sBags.$slBags."<br/>";
else
$sBags=$slBags."<br/>";
$slqty=$slqty+$row_sloc['qty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balu=$balu+$slBags;
$balq=$balq+$slqty;

$blu=$blu+$row_sloc['balbags'];
$blq=$blq+$row_sloc['balqty'];
$orwoid=$row_sloc['rowid'];
}
$balu=$row_issuetbl['lotldg_balbags']; if($balu < 0 && $balq==0)$balu=0;
$balq=$row_issuetbl['lotldg_balqty']-$balq; if($balu<=0 && $balq > 0)$balu=1;
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sBags;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:pointer" onclick="showsloc('<?php echo $row_issuetbl['lotldg_balbags'];?>','<?php echo $row_issuetbl['lotldg_balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" style="cursor:pointer" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $orwoid;?>','<?php echo $txtlot1;?>')" /><?php } ?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['lotldg_balbags'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['lotldg_balqty'];?><input type="hidden" name="rowidd_<?php echo $srno;?>" value="<?php echo $row_issuetbl['lotldg_id']?>" /></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysqli_query($link,"select * from tbl_sloc_csw_sub where plantcode='".$plantcode."' and  slocid='".$trid."' and rowid='".$row_issue1[0]."'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slBags=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['slocsubid']; else $subrid=$row_sloc['slocsubid'];
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."/";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."/";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname'];
else*/
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slBags=$slBags+$row_sloc['bags'];
if($sBags!="")
$sBags=$sBags.$slBags."<br/>";
else
$sBags=$slBags."<br/>";
$slqty=$slqty+$row_sloc['qty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balu=$balu+$slBags;
$balq=$balq+$slqty;

$blu=$blu+$row_sloc['balbags'];
$blq=$blq+$row_sloc['balqty'];
$orwoid=$row_sloc['rowid'];
}
$balu=$row_issuetbl['lotldg_balbags']; if($balu < 0 && $balq==0)$balu=0;
$balq=$row_issuetbl['lotldg_balqty']-$balq; if($balu<=0 && $balq > 0)$balu=1;
?>		
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sBags;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:pointer" onclick="showsloc('<?php echo $row_issuetbl['lotldg_balbags'];?>','<?php echo $row_issuetbl['lotldg_balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" style="cursor:pointer" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $orwoid;?>','<?php echo $txtlot1;?>')" /><?php } ?></td>
 </tr>
 <?php
 }$srno++;
 } 
 } 
  
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="2">Total</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totBags;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
 <td colspan="4" align="center" valign="middle" class="tblheading">&nbsp;</td>
 </tr>
 <?php
 if($cnt==0) 
 {
 ?>
  <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="10">Variety not in Stock</td>
 </tr>
 <?php
 }
 ?>
 <input type="hidden" name="txtBagsg" value="<?php echo $totBags;?>" /> <input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" /><input type="hidden" name="orwoid" value="" />
</table><input type="hidden" name="trid" value="<?php echo $trid;?>" /></div>
<div id="subsubdiv">
</div><br />

