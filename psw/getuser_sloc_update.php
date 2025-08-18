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
	
	$tp="Pack";
	
//frm_action=submit&code=1&txtmtype=&rettyp=&oBags=116&oqty=2320&txtdate=08-04-2013&txtcrop=33&txtvariety=338&itmdchk=&txtlot1=DA00140%2F00000P&rowid_1=1&txtBagsg=116&txtnopsg=0&txtqtyg=2320&srno=2&chkbox=&srno1=&edtrowid=&orwoid=1&trid=0&osubid=2641&otBags=116&otnop=0&otqty=2320&wtinmp=20.000&packtyp=500.000&txtslwhg1=1&txtslbing1=133&txtslsubbg1=2641&exnopsg1=0&exBagsg1=116&exqtyg1=2320&txtslnopsg1=0&txtslBagsg1=66&txtslqtyg1=1320&balnopg1=&balnompg1=66&balqtyg1=1320&dorowig1=0&txtslwhg2=1&txtslbing2=133&txtslsubbg2=2643&exnopsg2=&exBagsg2=&exqtyg2=&txtslnopsg2=&txtslBagsg2=50&txtslqtyg2=1000&balnopg2=&balnompg2=50&balqtyg2=1000&dorowig2=0&txtslwhg3=WH&txtslbing3=Bin&txtslsubbg3=SBin&exnopsg3=&exBagsg3=&exqtyg3=&txtslnopsg3=&txtslBagsg3=&txtslqtyg3=&balnopg3=&balnompg3=&balqtyg3=&dorowig3=0&txtslwhg4=WH&txtslbing4=Bin&txtslsubbg4=SBin&exnopsg4=&exBagsg4=&exqtyg4=&txtslnopsg4=&txtslBagsg4=&txtslqtyg4=&balnopg4=&balnompg4=&balqtyg4=&dorowig4=0&txtslwhg5=WH&txtslbing5=Bin&txtslsubbg5=SBin&exnopsg5=&exBagsg5=&exqtyg5=&txtslnopsg5=&txtslBagsg5=&txtslqtyg5=&balnopg5=&balnompg5=&balqtyg5=&dorowig2=0&txtslwhg6=WH&txtslbing6=Bin&txtslsubbg6=SBin&exnopsg6=&exBagsg6=&exqtyg6=&txtslnopsg6=&txtslBagsg6=&txtslqtyg6=&balnopg6=&balnompg6=&balqtyg6=&dorowig6=0&txtslwhg7=WH&txtslbing7=Bin&txtslsubbg7=SBin&exnopsg7=&exBagsg7=&exqtyg7=&txtslnopsg7=&txtslBagsg7=&txtslqtyg7=&balnopg7=&balnompg7=&balqtyg7=&dorowig7=0&txtslwhg8=WH&txtslbing8=Bin&txtslsubbg8=SBin&exnopsg8=&exBagsg8=&exqtyg8=&txtslnopsg8=&txtslBagsg8=&txtslqtyg8=&balnopg8=&balnompg8=&balqtyg8=&dorowig8=0&tblslocnod=0

	if(isset($_GET['code'])) { $code = $_GET['code']; }
	if(isset($_GET['txtdate'])) { $txtdate = $_GET['txtdate']; }
	if(isset($_GET['trid'])) { $trid = $_GET['trid']; }
	if(isset($_GET['txtcrop'])) { $txtcrop = $_GET['txtcrop']; }
	if(isset($_GET['txtvariety'])) { $txtvariety = $_GET['txtvariety']; }	
	if(isset($_GET['txtlot1'])) { $txtlot1 = $_GET['txtlot1']; }	
	
	if(isset($_GET['oBags'])) { $oBags = $_GET['oBags']; }	
	if(isset($_GET['oqty'])) { $oqty = $_GET['oqty']; }	
	
	if(isset($_GET['otBags'])) { $otBags = $_GET['otBags']; }	
	if(isset($_GET['otqty'])) { $otqty = $_GET['otqty']; }	
		
	if(isset($_GET['tblslocnod'])) { $tblslocnod = $_GET['tblslocnod']; }
	
	if(isset($_GET['wtinmp'])) { $wtinmp = $_GET['wtinmp']; }
	if(isset($_GET['packtyp'])) { $packtyp = $_GET['packtyp']; }
	if(isset($_GET['txtnopsg'])) { $txtnopsg = $_GET['txtnopsg']; }
	if(isset($_GET['txtBagsg'])) { $txtBagsg = $_GET['txtBagsg']; }
	if(isset($_GET['txtqtyg'])) { $txtqtyg = $_GET['txtqtyg']; }	
	
	/*if(isset($_GET['txtslwhg1'])) { $w1 = $_GET['txtslwhg1']; }
	if(isset($_GET['txtslbing1'])) { $b1 = $_GET['txtslbing1']; }
	if(isset($_GET['txtslsubbg1'])) { $sb11 = $_GET['txtslsubbg1']; }
	
	if(isset($_GET['txtslnopsg1'])) { $np1 = $_GET['txtslnopsg1']; } else { $np1=0; }
	if(isset($_GET['txtslBagsg1'])) { $mp1 = $_GET['txtslBagsg1']; } else { $mp1=0; }
	if(isset($_GET['exnopsg1'])) { $exnopsg1 = $_GET['exnopsg1']; } else { $exnopsg1=0; }
	if(isset($_GET['exBagsg1'])) { $exBagsg1 = $_GET['exBagsg1']; } else { $exBagsg1=0; }
	if(isset($_GET['exqtyg1'])) { $exqtyg1 = $_GET['exqtyg1']; } else { $exqtyg1=0; }
	
	if(isset($_GET['txtslwhg2'])) { $w2 = $_GET['txtslwhg2']; }
	if(isset($_GET['txtslbing2'])) { $b2= $_GET['txtslbing2']; }
	if(isset($_GET['txtslsubbg2'])) { $sb2 = $_GET['txtslsubbg2']; }
	
	if(isset($_GET['txtslnopsg2'])) { $np2 = $_GET['txtslnopsg2']; } else { $np2=0; }
	if(isset($_GET['txtslBagsg2'])) { $mp2 = $_GET['txtslBagsg2']; } else { $mp2=0; }
	if(isset($_GET['exnopsg2'])) { $exnopsg2 = $_GET['exnopsg2']; } else { $exnopsg2=0; }
	if(isset($_GET['exBagsg2'])) { $exBagsg2 = $_GET['exBagsg2']; } else { $exBagsg2=0; }
	if(isset($_GET['exqtyg2'])) { $exqtyg2 = $_GET['exqtyg2']; } else { $exqtyg2=0; }
	
	if(isset($_GET['txtslwhg3'])) { $w3 = $_GET['txtslwhg3']; }
	if(isset($_GET['txtslbing3'])) { $b3= $_GET['txtslbing3']; }
	if(isset($_GET['txtslsubbg3'])) { $sb3 = $_GET['txtslsubbg3']; }
	
	if(isset($_GET['txtslnopsg3'])) { $np3 = $_GET['txtslnopsg3']; } else { $np3=0; }
	if(isset($_GET['txtslBagsg3'])) { $mp3 = $_GET['txtslBagsg3']; } else { $mp3=0; }
	if(isset($_GET['exnopsg3'])) { $exnopsg3 = $_GET['exnopsg3']; } else { $exnopsg3=0; }
	if(isset($_GET['exBagsg3'])) { $exBagsg3 = $_GET['exBagsg3']; } else { $exBagsg3=0; }
	if(isset($_GET['exqtyg3'])) { $exqtyg3 = $_GET['exqtyg3']; } else { $exqtyg3=0; }
	
	if(isset($_GET['txtslwhg4'])) { $w4 = $_GET['txtslwhg4']; }
	if(isset($_GET['txtslbing4'])) { $b4= $_GET['txtslbing4']; }
	if(isset($_GET['txtslsubbg4'])) { $sb4 = $_GET['txtslsubbg4']; }
	
	if(isset($_GET['txtslnopsg4'])) { $np4 = $_GET['txtslnopsg4']; } else { $np4=0; }
	if(isset($_GET['txtslBagsg4'])) { $mp4 = $_GET['txtslBagsg4']; } else { $mp4=0; }
	if(isset($_GET['exnopsg4'])) { $exnopsg4 = $_GET['exnopsg4']; } else { $exnopsg4=0; }
	if(isset($_GET['exBagsg4'])) { $exBagsg4 = $_GET['exBagsg4']; } else { $exBagsg4=0; }
	if(isset($_GET['exqtyg4'])) { $exqtyg4 = $_GET['exqtyg4']; } else { $exqtyg4=0; }
	
	if(isset($_GET['txtslwhg5'])) { $w5 = $_GET['txtslwhg5']; }
	if(isset($_GET['txtslbing5'])) { $b5= $_GET['txtslbing5']; }
	if(isset($_GET['txtslsubbg5'])) { $sb5 = $_GET['txtslsubbg5']; }
	
	if(isset($_GET['txtslnopsg5'])) { $np5 = $_GET['txtslnopsg5']; } else { $np5=0; }
	if(isset($_GET['txtslBagsg5'])) { $mp5 = $_GET['txtslBagsg5']; } else { $mp5=0; }
	if(isset($_GET['exnopsg5'])) { $exnopsg5 = $_GET['exnopsg5']; } else { $exnopsg5=0; }
	if(isset($_GET['exBagsg5'])) { $exBagsg5 = $_GET['exBagsg5']; } else { $exBagsg5=0; }
	if(isset($_GET['exqtyg5'])) { $exqtyg5 = $_GET['exqtyg5']; } else { $exqtyg5=0; }
	
	if(isset($_GET['txtslwhg6'])) { $w6 = $_GET['txtslwhg6']; }
	if(isset($_GET['txtslbing6'])) { $b6= $_GET['txtslbing6']; }
	if(isset($_GET['txtslsubbg6'])) { $sb6 = $_GET['txtslsubbg6']; }
	
	if(isset($_GET['txtslnopsg6'])) { $np6 = $_GET['txtslnopsg6']; } else { $np6=0; }
	if(isset($_GET['txtslBagsg6'])) { $mp6 = $_GET['txtslBagsg6']; } else { $mp6=0; }
	if(isset($_GET['exnopsg6'])) { $exnopsg6 = $_GET['exnopsg6']; } else { $exnopsg6=0; }
	if(isset($_GET['exBagsg6'])) { $exBagsg6 = $_GET['exBagsg6']; } else { $exBagsg6=0; }
	if(isset($_GET['exqtyg6'])) { $exqtyg6 = $_GET['exqtyg6']; } else { $exqtyg6=0; }
	
	if(isset($_GET['txtslwhg7'])) { $w7 = $_GET['txtslwhg7']; }
	if(isset($_GET['txtslbing7'])) { $b7= $_GET['txtslbing7']; }
	if(isset($_GET['txtslsubbg7'])) { $sb7 = $_GET['txtslsubbg7']; }
	
	if(isset($_GET['txtslnopsg7'])) { $np7 = $_GET['txtslnopsg7']; } else { $np7=0; }
	if(isset($_GET['txtslBagsg7'])) { $mp7 = $_GET['txtslBagsg7']; } else { $mp7=0; }
	if(isset($_GET['exnopsg7'])) { $exnopsg7 = $_GET['exnopsg7']; } else { $exnopsg7=0; }
	if(isset($_GET['exBagsg7'])) { $exBagsg7 = $_GET['exBagsg7']; } else { $exBagsg7=0; }
	if(isset($_GET['exqtyg7'])) { $exqtyg7 = $_GET['exqtyg7']; } else { $exqtyg7=0; }
	
	if(isset($_GET['txtslwhg8'])) { $w8 = $_GET['txtslwhg8']; }
	if(isset($_GET['txtslbing8'])) { $b8= $_GET['txtslbing8']; }
	if(isset($_GET['txtslsubbg8'])) { $sb8 = $_GET['txtslsubbg8']; }
	
	if(isset($_GET['txtslnopsg8'])) { $np8 = $_GET['txtslnopsg8']; } else { $np8=0; }
	if(isset($_GET['txtslBagsg8'])) { $mp8 = $_GET['txtslBagsg8']; } else { $mp8=0; }
	if(isset($_GET['exnopsg8'])) { $exnopsg8 = $_GET['exnopsg8']; } else { $exnopsg8=0; }
	if(isset($_GET['exBagsg8'])) { $exBagsg8 = $_GET['exBagsg8']; } else { $exBagsg8=0; }
	if(isset($_GET['exqtyg8'])) { $exqtyg8 = $_GET['exqtyg8']; } else { $exqtyg8=0; }*/
	
	if(isset($_GET['txtslqtyg1'])) { $q1 = $_GET['txtslqtyg1']; } else { $q1=0; }
	if(isset($_GET['txtslqtyg2'])) { $q2 = $_GET['txtslqtyg2']; } else { $q2=0; }
	if(isset($_GET['txtslqtyg3'])) { $q3 = $_GET['txtslqtyg3']; } else { $q3=0; }
	if(isset($_GET['txtslqtyg4'])) { $q4 = $_GET['txtslqtyg4']; } else { $q4=0; }
	if(isset($_GET['txtslqtyg5'])) { $q5 = $_GET['txtslqtyg5']; } else { $q5=0; }
	if(isset($_GET['txtslqtyg6'])) { $q6 = $_GET['txtslqtyg6']; } else { $q6=0; }
	if(isset($_GET['txtslqtyg7'])) { $q7 = $_GET['txtslqtyg7']; } else { $q7=0; }
	if(isset($_GET['txtslqtyg8'])) { $q8 = $_GET['txtslqtyg8']; } else { $q8=0; }
	
	if(isset($_GET['orwoid'])) { $orwoid = $_GET['orwoid']; }	
	
	$x=0;
	
	if($q1!="" && $q1 > 0)$x++;
	if($q2!="" && $q2 > 0)$x++;
	if($q3!="" && $q3 > 0)$x++;
	if($q4!="" && $q4 > 0)$x++;
	if($q5!="" && $q5 > 0)$x++;
	if($q6!="" && $q6 > 0)$x++;
	if($q7!="" && $q7 > 0)$x++;
	if($q8!="" && $q8 > 0)$x++;
	
	
//frm_action=submit&code=1&txtmtype=&rettyp=&oBags=116&oqty=2320&txtdate=08-04-2013&txtcrop=33&txtvariety=338&itmdchk=&txtlot1=DA00140%2F00000P&rowid_1=1&txtBagsg=116&txtnopsg=0&txtqtyg=2320&srno=2&chkbox=&srno1=&edtrowid=&orwoid=1&trid=0&osubid=2641&otBags=116&otnop=0&otqty=2320&wtinmp=20.000&packtyp=500.000&txtslwhg1=1&txtslbing1=133&txtslsubbg1=2641&exnopsg1=0&exBagsg1=116&exqtyg1=2320&txtslnopsg1=0&txtslBagsg1=66&txtslqtyg1=1320&balnopg1=&balnompg1=66&balqtyg1=1320&dorowig1=0&txtslwhg2=1&txtslbing2=133&txtslsubbg2=2643&exnopsg2=&exBagsg2=&exqtyg2=&txtslnopsg2=&txtslBagsg2=50&txtslqtyg2=1000&balnopg2=&balnompg2=50&balqtyg2=1000&dorowig2=0&txtslwhg3=WH&txtslbing3=Bin&txtslsubbg3=SBin&exnopsg3=&exBagsg3=&exqtyg3=&txtslnopsg3=&txtslBagsg3=&txtslqtyg3=&balnopg3=&balnompg3=&balqtyg3=&dorowig3=0&txtslwhg4=WH&txtslbing4=Bin&txtslsubbg4=SBin&exnopsg4=&exBagsg4=&exqtyg4=&txtslnopsg4=&txtslBagsg4=&txtslqtyg4=&balnopg4=&balnompg4=&balqtyg4=&dorowig4=0&txtslwhg5=WH&txtslbing5=Bin&txtslsubbg5=SBin&exnopsg5=&exBagsg5=&exqtyg5=&txtslnopsg5=&txtslBagsg5=&txtslqtyg5=&balnopg5=&balnompg5=&balqtyg5=&dorowig2=0&txtslwhg6=WH&txtslbing6=Bin&txtslsubbg6=SBin&exnopsg6=&exBagsg6=&exqtyg6=&txtslnopsg6=&txtslBagsg6=&txtslqtyg6=&balnopg6=&balnompg6=&balqtyg6=&dorowig6=0&txtslwhg7=WH&txtslbing7=Bin&txtslsubbg7=SBin&exnopsg7=&exBagsg7=&exqtyg7=&txtslnopsg7=&txtslBagsg7=&txtslqtyg7=&balnopg7=&balnompg7=&balqtyg7=&dorowig7=0&txtslwhg8=WH&txtslbing8=Bin&txtslsubbg8=SBin&exnopsg8=&exBagsg8=&exqtyg8=&txtslnopsg8=&txtslBagsg8=&txtslqtyg8=&balnopg8=&balnompg8=&balqtyg8=&dorowig8=0&tblslocnod=0
	
	$tdate=$txtdate;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$tdate=$tyear."-".$tmonth."-".$tday;
		
		
		
if($trid == 0)
{
 $sql_in1="insert into tbl_sloc_psw (code, sldate, crop, variety, lotno, yearcode, surole,stage, plantcode) values ('$code', '$tdate', '$txtcrop', '$txtvariety', '$txtlot1', '$yearid_id', '$lgnid','$tp', '$plantcode')";
 
if(mysqli_query($link,$sql_in1) or die(mysqli_error($link)))
{
 $mainid=mysqli_insert_id($link);

for($i=1; $i<=$x; $i++)
{
	$a="txtslwhg".$i;
	$b="txtslbing".$i;
	$c="txtslsubbg".$i;
	$d="txtslnopsg".$i;
	$e="txtslBagsg".$i;
	$f="txtslqtyg".$i;
	$g="exnopsg".$i;
	$h="exBagsg".$i;
	$j="exqtyg".$i;
	$k="balnopg".$i;
	$l="balnompg".$i;
	$m="balqtyg".$i;

	if(isset($_GET[$a])) { $a1 = $_GET[$a]; }
	if(isset($_GET[$b])) { $b1 = $_GET[$b]; }
	if(isset($_GET[$c])) { $c1 = $_GET[$c]; }
	if(isset($_GET[$d])) { $d1 = $_GET[$d]; } 
	if(isset($_GET[$e])) { $e1 = $_GET[$e]; }
	if(isset($_GET[$f])) { $f1 = $_GET[$f]; }
	if(isset($_GET[$g])) { $g1 = $_GET[$g]; }
	if(isset($_GET[$h])) { $h1 = $_GET[$h]; }
	if(isset($_GET[$j])) { $j1 = $_GET[$j]; }
	if(isset($_GET[$k])) { $k1 = $_GET[$k]; }
	if(isset($_GET[$l])) { $l1 = $_GET[$l]; }
	if(isset($_GET[$m])) { $m1 = $_GET[$m]; }
	
	$sql_in="insert into tbl_sloc_psw_sub(slocid, crop, variety, lotno, whid, binid, subbinid, opnop, opnomp, opqty, nop, nomp, qty, balnop, balnomp, balqty, rowid, wtinmp, packtype, plantcode) values('$mainid', '$txtcrop', '$txtvariety', '$txtlot1', '$a1', '$b1', '$c1', '$g1', '$h1', '$j1', '$d1', '$e1', '$f1', '$k1', '$l1', '$m1', '$orwoid', '$wtinmp', '$packtyp', '$plantcode')";
	mysqli_query($link,$sql_in) or die(mysqli_error($link));
}

}
$trid=$mainid;
}
else
{
$sql_in1="update tbl_sloc_psw set crop='$txtcrop', variety='$txtvariety', lotno='$txtlot1', yearcode='$yearid_id', stage='$tp',surole='$lgnid' where slid='".$trid."'";
if(mysqli_query($link,$sql_in1) or die(mysqli_error($link)))
{
$mainid=$trid;
for($i=1; $i<=$x; $i++)
{
	$a="txtslwhg".$i;
	$b="txtslbing".$i;
	$c="txtslsubbg".$i;
	$d="txtslnopsg".$i;
	$e="txtslBagsg".$i;
	$f="txtslqtyg".$i;
	$g="exnopsg".$i;
	$h="exBagsg".$i;
	$j="exqtyg".$i;
	$k="balnopg".$i;
	$l="balnompg".$i;
	$m="balqtyg".$i;

	if(isset($_GET[$a])) { $a1 = $_GET[$a]; }
	if(isset($_GET[$b])) { $b1 = $_GET[$b]; }
	if(isset($_GET[$c])) { $c1 = $_GET[$c]; }
	if(isset($_GET[$d])) { $d1 = $_GET[$d]; } 
	if(isset($_GET[$e])) { $e1 = $_GET[$e]; }
	if(isset($_GET[$f])) { $f1 = $_GET[$f]; }
	if(isset($_GET[$g])) { $g1 = $_GET[$g]; }
	if(isset($_GET[$h])) { $h1 = $_GET[$h]; }
	if(isset($_GET[$j])) { $j1 = $_GET[$j]; }
	if(isset($_GET[$k])) { $k1 = $_GET[$k]; }
	if(isset($_GET[$l])) { $l1 = $_GET[$l]; }
	if(isset($_GET[$m])) { $m1 = $_GET[$m]; }
	
	$sql_in="insert into tbl_sloc_psw_sub(slocid, crop, variety, lotno, whid, binid, subbinid, opnop, opnomp, opqty, nop, nomp, qty, balnop, balnomp, balqty, rowid, wtinmp, packtype, plantcode) values('$mainid', '$txtcrop', '$txtvariety', '$txtlot1', '$a1', '$b1', '$c1', '$g1', '$h1', '$j1', '$d1', '$e1', '$f1', '$k1', '$l1', '$m1', '$orwoid', '$wtinmp', '$packtyp', '$plantcode')";
	mysqli_query($link,$sql_in) or die(mysqli_error($link));
}

}
}
?>

<?php 
$trid=$mainid;
//exit;
?>
<div id="subdiv" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
   <td colspan="6" align="center" valign="middle" class="tblheading">Existing Sloc </td>
   <td colspan="4" align="center" valign="middle" class="tblheading">Updated Sloc </td>
   <td width="59" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
 </tr>
 <tr class="tblsubtitle" height="25">
<td width="45" align="center" valign="middle" class="tblheading">#</td>
<td width="119" align="center" valign="middle" class="tblheading">UPS</td>
<td width="119" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="103" align="center" valign="middle" class="tblheading">NoP</td>
<td width="103" align="center" valign="middle" class="tblheading">NoMP</td>
<td width="110" align="center" valign="middle" class="tblheading">Qty</td>
<td width="129" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="103" align="center" valign="middle" class="tblheading">NoP</td>
<td width="103" align="center" valign="middle" class="tblheading">NoMP</td>
 <td width="74" align="center" valign="middle" class="tblheading">Qty</td>
 </tr>
<?php
$cnt=0;

$sql_issue=mysqli_query($link,"select distinct whid, subbinid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$txtcrop."' and lotldg_variety='".$txtvariety."' and lotno='".$txtlot1."'") or die(mysqli_error($link));

$srno=1;
$totnop=0; $totnomp=0; $totqty=0; $totnnop=0; $totnnomp=0; $totnqty=0;
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotldg_variety='".$txtvariety."' and lotno='".$txtlot1."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 $sloc1=""; $cnt++; $nop=""; $nomp=""; $bqty=""; $nop1=0; 
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh1=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn1=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn1=$row_subbinn['sname'];

$sloc1=$wareh1.$binn1.$subbinn1;

$nop1=0; $nop2=0; $b1=0; $b2=0;
$ups=$row_issuetbl['packtype'];
$wtinmp=$row_issuetbl['wtinmp'];
$packtp=explode(" ",$row_issuetbl['packtype']);
$packtyp=$packtp[0]; 
if($packtp[1]=="Gms")
{ 
	$ptp2=(1000/$packtp[0]);
}
else
{
	$ptp2=$packtp[0];
}
$bl=($row_issuetbl['balqty']*100)/100;
$b2=(($wtinmp*$row_issuetbl['balnomp'])*100)/100;
if($b1===$b2)
$penqty=0;
else
$penqty=$bl-$b2;


if($penqty > 0)
{
	if($packtp[1]=="Gms")
	{
		$nop1=($ptp2*$penqty);
	}
	else
	{
		$nop1=($penqty/$ptp2);
	}
}
if($packtp[1]=="Gms")
{
	$nop2=($ptp2*$row_issuetbl['balqty']);
}
else
{
	$nop2=($row_issuetbl['balqty']/$ptp2);
}

$nop2;
$zz=str_split($txtlot1);
$ltno=$zz[0].$zz[1].$zz[2].$zz[3].$zz[4].$zz[5].$zz[6].$zz[7].$zz[8].$zz[9].$zz[10].$zz[11].$zz[12].$zz[13].$zz[14].$zz[15];


$qtys=0; $nomps=0; $nops=0; $qtyl=0; $nompl=0; $nopl=0; $nopnl=0; $nopns=0; $qtynl=0; $qtyns=0; $qtym=0; $nompm=0; $nopm=0; $tot_mps=0; $tot_mpl=0; $tot_mpm=0;
$totextpouches=0; $totextqtys=0;
$sql_mps=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKSMC' and mpmain_lotno='$txtlot1' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mps=mysqli_num_rows($sql_mps);
if($tot_mps > 0)
{
	while($row_mps=mysqli_fetch_array($sql_mps))
	{
		$crparr=$row_mps['mpmain_crop'];
		$verarr=$row_mps['mpmain_variety'];
		$lotarr=explode(",", $row_mps['mpmain_lotno']);
		$upsarr=$row_mps['mpmain_upssize'];
		$noparr=explode(",", $row_mps['mpmain_mptnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr)
			{
				$nops=$nops+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtys=$qtys+($ptp*$noparr[$i]); $nomps=$nomps+$ct; 
			}
		}
		
	}
}

$sql_mpl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKLMC' and mpmain_variety='$txtvariety' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpl=mysqli_num_rows($sql_mpl);
if($tot_mpl > 0)
{
	while($row_mpl=mysqli_fetch_array($sql_mpl))
	{
		$crparr=$row_mpl['mpmain_crop'];
		$verarr=$row_mpl['mpmain_variety'];
		$lotarr=explode(",", $row_mpl['mpmain_lotno']);
		$upsarr=$row_mpl['mpmain_upssize'];
		$noparr=explode(",", $row_mpl['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr)
			{
				$nopl=$nopl+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtyl=$qtyl+($ptp*$noparr[$i]); $nompl=$nompl+$ct; 
			}
		}
		
	}
}

$sql_mpm=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKMMC' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpm=mysqli_num_rows($sql_mpm);
if($tot_mpm > 0)
{
	while($row_mpm=mysqli_fetch_array($sql_mpm))
	{
		$crparr=explode(",", $row_mpm['mpmain_crop']);
		$verarr=explode(",", $row_mpm['mpmain_variety']);
		$lotarr=explode(",", $row_mpm['mpmain_lotno']);
		$upsarr=explode(",", $row_mpm['mpmain_upssize']);
		$noparr=explode(",", $row_mpm['mpmain_lotnop']);
		
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr[$i])
			{
				$nopm=$nopm+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtym=$qtym+($ptp*$noparr[$i]); $nompm=$nompm+$ct; 
			}
		}
		
	}
}

$sql_mpns=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNMC' and mpmain_lotno='$txtlot1' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpns=mysqli_num_rows($sql_mpns);
if($tot_mpns > 0)
{
	while($row_mpns=mysqli_fetch_array($sql_mpns))
	{
		$crparr=$row_mpns['mpmain_crop'];
		$verarr=$row_mpns['mpmain_variety'];
		$lotarr=explode(",", $row_mpns['mpmain_lotno']);
		$upsarr=$row_mpns['mpmain_upssize'];
		$noparr=explode(",", $row_mpns['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr)
			{
				$nopns=$nopns+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtyns=$qtyns+($ptp*$noparr[$i]); $nompns=$ct; 
			}
		}
		
	}
}

$sql_mpnl=mysqli_query($link,"Select * from tbl_mpmain where plantcode='$plantcode' and mpmain_trtype='PACKNLC' and mpmain_variety='$txtvariety' and mpmain_dflg!=1 and mpmain_upflg=0") or die(mysqli_error($link));
$tot_mpnl=mysqli_num_rows($sql_mpnl);
if($tot_mpnl > 0)
{
	while($row_mpnl=mysqli_fetch_array($sql_mpnl))
	{
		$crparr=$row_mpnl['mpmain_crop'];
		$verarr=$row_mpnl['mpmain_variety'];
		$lotarr=explode(",", $row_mpnl['mpmain_lotno']);
		$upsarr=$row_mpnl['mpmain_upssize'];
		$noparr=explode(",", $row_mpnl['mpmain_lotnop']);
		
		$ct=0;
		$variety;
		$crop;
		for ($i=0; $i<count($lotarr); $i++)
		{
			if($txtlot1==$lotarr[$i] && $ups==$upsarr)
			{
				$nopnl=$nopnl+$noparr[$i];
				$ct++;
				$up=explode(" ", $ups);
				if($up[1]=="Gms")
				{
					$ptp=$up[0]/1000;
				}
				else
				{
					$ptp=$up[0];
				}
				$qtynl=$qtynl+($ptp*$noparr[$i]); $nompnl=$ct; 
			}
		}
		
	}
}
//echo $nops."  -  ".$nopl;
$totextpouches=$nops+$nopl+$nopm+$nopns+$nopnl;
$totextqtys=$qtys+$qtyl+$qtym+$qtyns+$qtynl; 	
$qty=$row_issuetbl['balqty']-$totextqtys;
$nop=$nop2-$totextpouches;
if($row_issuetbl['balqty']>0)
$nop=$nop2-$totextpouches;
//$qty=$nob*$ptp2;

/*$totnop=$totnop+$nop1;
$totnomp=$totnomp+$row_issuetbl['balnomp'];
$totqty=$totqty+$row_issuetbl['balqty'];
$nomp=$row_issuetbl['balnomp'];
$bqty=$row_issuetbl['balqty'];
$aq1=explode(".",$nop1);
$aq2=explode(".",$row_issuetbl['balnomp']);
$aq3=explode(".",$row_issuetbl['balqty']);
if($aq1[1]==000){$nop=$aq1[0];}else{$nop=$nop1;}
if($aq2[1]==000){$nomp=$aq2[0];}else{$nomp=$row_issuetbl['balnomp'];}
if($aq3[1]==000){$bqty=$aq3[0];}else{$bqty=$row_issuetbl['balqty'];}*/
$nomp=$row_issuetbl['balnomp'];
$bqty=$row_issuetbl['balqty'];
$aq1=explode(".",$nop1);
$aq2=explode(".",$row_issuetbl['balnomp']);
$aq3=explode(".",$row_issuetbl['balqty']);
if($aq1[1]==000){$nop=$aq1[0];}else{$nop=$nop1;}
if($aq2[1]==000){$nomp=$aq2[0];}else{$nomp=$row_issuetbl['balnomp'];}
if($aq3[1]==000){$bqty=$aq3[0];}else{$bqty=$row_issuetbl['balqty'];}

$totnop=$totnop+$nop;
$totnomp=$totnomp+$nomp;
$totqty=$totqty+$bqty;

if($nomp<=0){$nomp=0;}
if($totnomp<=0){$totnomp=0;}
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['packtype'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $nop;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $nomp;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $bqty;?><input type="hidden" name="rowid_<?php echo $srno;?>" value="<?php echo $row_issuetbl['lotdgp_id']?>" /></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $snop=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $balnp=0; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0; $blnp=0;
$sql_sloc=mysqli_query($link,"select * from tbl_sloc_psw_sub where plantcode='$plantcode' and slocid='".$trid."' and rowid='".$row_issue1[0]."' order by slocsubid") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slBags=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['slocsubid']; else $subrid=$row_sloc['slocsubid'];
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slnop=$row_sloc['nop'];
if($sBags!="")
$snop=$snop.$slnop."<br/>";
else
$snop=$slnop."<br/>";

$slBags=$row_sloc['nomp'];
if($sBags!="")
$sBags=$sBags.$slBags."<br/>";
else
$sBags=$slBags."<br/>";

$slqty=$row_sloc['qty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$orwoid=$row_sloc['rowid'];

$totnnop=$totnnop+$slnop;
$totnnomp=$totnnomp+$slBags;
$totnqty=$totnqty+$slqty;
}
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $snop;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sBags;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:pointer" onclick="showsloc('<?php echo $row_issuetbl['balnomp'];?>','<?php echo $row_issuetbl['balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" style="cursor:pointer" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $orwoid;?>','<?php echo $txtlot1;?>')" /><?php } ?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['packtype'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $nop1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $nomp;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $bqty;?><input type="hidden" name="rowid_<?php echo $srno;?>" value="<?php echo $row_issuetbl['lotdgp_id']?>" /></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $snop=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $balnp=0; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0; $blnp=0;
$sql_sloc=mysqli_query($link,"select * from tbl_sloc_psw_sub where plantcode='$plantcode' and slocid='".$trid."' and rowid='".$row_issue1[0]."'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slBags=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['slocsubid']; else $subrid=$row_sloc['slocsubid'];
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slnop=$row_sloc['nop'];
if($sBags!="")
$snop=$snop.$slBags."<br/>";
else
$snop=$slBags."<br/>";

$slBags=$row_sloc['nomp'];
if($sBags!="")
$sBags=$sBags.$slBags."<br/>";
else
$sBags=$slBags."<br/>";

$slqty=$row_sloc['qty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$orwoid=$row_sloc['rowid'];

$totnnop=$totnnop+$slnop;
$totnnomp=$totnnomp+$slBags;
$totnqty=$totnqty+$slqty;
}
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $snop;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sBags;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:pointer" onclick="showsloc('<?php echo $row_issuetbl['balnomp'];?>','<?php echo $row_issuetbl['balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" style="cursor:pointer" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $orwoid;?>','<?php echo $txtlot1;?>')" /><?php } ?></td>
 </tr>
 <?php
 }$srno++;
 } 
 } 
 ?>
<tr class="Dark" height="25">
	<td align="center" valign="middle" class="tblheading" colspan="3">Total</td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totnop;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totnomp;?><input type="hidden" name="extenomp" value="<?php echo $totnomp;?>" /></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?><input type="hidden" name="exteqty" value="<?php echo $totqty;?>" /></td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totnnop;?></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totnnomp;?><input type="hidden" name="extnnomp" value="<?php echo $totnnomp;?>" /></td>
	<td align="center" valign="middle" class="tblheading"><?php echo $totnqty;?><input type="hidden" name="extnqty" value="<?php echo $totnqty;?>" /></td>
	<td align="center" valign="middle" class="tblheading">&nbsp;</td>
</tr>
 <?php
 if($cnt==0) 
 {
 ?>
  <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="11">Variety not in Stock</td>
 </tr>
 <?php
 }
 ?>
 <input type="hidden" name="txtBagsg" value="<?php echo $totnomp;?>" /> <input type="hidden" name="txtnopsg" value="<?php echo $totnop;?>" /><input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" /><input type="hidden" name="orwoid" value="" />
</table><input type="hidden" name="trid" value="<?php echo $trid;?>" /></div>
<div id="subsubdiv">
</div><br />