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


//frm_action=submit&txt11=&txt14=&txtid=1&logid=SR1&date=18-02-2014&itmdchk=0&txtcrop=28&txtvariety=15&txtstage=Condition&pcodeo=D&ycodeeo=S&txtlot2o=06066&stcodeo=00000&stcode2o=00&pcode=D&ycodee=S&txtlot2=06066&stcode=00010&stcode2=00&lotcheck1=0&txtactnob=1&txtactqty=20&qcstatus=OK&edate=18-11-2013&txtpp=Acceptable&txtmoist=1.2&txtgemp=94&txtslwhg1=1&txtslbing1=133&txtslsubbg1=2660&txtslBagsg1=1&txtslqtyg1=20&txtslwhg2=--WH--&txtslbing2=--Bin--&txtslsubbg2=--Sub%20Bin--&txtslBagsg2=&txtslqtyg2=&orowid2=0&maintrid=0&subtrid=0
	
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

	if(isset($_GET['itmdchk']))
	{
	$itmdchk = $_GET['itmdchk'];	 
	}
	if(isset($_GET['txtcrop']))
	{
	$txtcrop = $_GET['txtcrop'];	 
	}
	if(isset($_GET['txtvariety']))
	{
	$txtvariety = $_GET['txtvariety'];	 
	}
	
	if(isset($_GET['txtstage']))
	{
	$txtstage= $_GET['txtstage'];	 
	}
	if(isset($_GET['pcodeo']))
	{
	$pcodeo = $_GET['pcodeo'];	 
	}
	if(isset($_GET['ycodeeo']))
	{
	$ycodeeo= $_GET['ycodeeo'];	
	}
	if(isset($_GET['txtlot2o']))
	{
	$txtlot2o= $_GET['txtlot2o'];	
	}
	if(isset($_GET['stcodeo']))
	{
	$stcodeo = $_GET['stcodeo'];	 
	}
	if(isset($_GET['stcode2o']))
	{
	$stcode2o = $_GET['stcode2o'];	 
	}
	
	if(isset($_GET['pcode']))
	{
	$pcode = $_GET['pcode'];	 
	}
	if(isset($_GET['ycodee']))
	{
	$ycodee= $_GET['ycodee'];	
	}
	if(isset($_GET['txtlot2']))
	{
	$txtlot2= $_GET['txtlot2'];	
	}
	if(isset($_GET['stcode']))
	{
	$stcode = $_GET['stcode'];	 
	}
	if(isset($_GET['stcode2']))
	{
	$stcode2 = $_GET['stcode2'];	 
	}
	
	if(isset($_GET['txtactnob']))
	{
	$txtactnob = $_GET['txtactnob'];	 
	}
	if(isset($_GET['txtactqty']))
	{
	$txtactqty = $_GET['txtactqty'];	 
	}
	if(isset($_GET['qcstatus']))
	{
	$qcstatus = $_GET['qcstatus'];	 
	}
	if(isset($_GET['edate']))
	{
	$edate = $_GET['edate'];	 
	}
	if(isset($_GET['txtpp']))
	{
	$txtpp = $_GET['txtpp'];	 
	}
	if(isset($_GET['txtmoist']))
	{
	$txtmoist = $_GET['txtmoist'];	 
	}
	if(isset($_GET['txtgemp']))
	{
	$txtgemp = $_GET['txtgemp'];	 
	}
	
	

	$god1=0;$god2=0;
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
	if(isset($_GET['txtslBagsg1']))
	{
	$c1 = $_GET['txtslBagsg1'];	 
	}
	

//frm_action=submit&txt11=&txt14=&txtid=1&logid=AR1&date=05-05-2011&itmdchk=0&txtcrop=Cowpea&txtvariety=Shweta&qcstatus=OK&edate=1-03-2011&txtpp=Acceptable&txtmoist=1.23&txtgemp=78&txtgottyp=GOT-NR&gotstatus=OK&sdate=30-04-2011&txtstage=Raw&pcode=G&ycodee=D&txtlot2=01234&stcode=00000&txtslwhg1=57&txtslbing1=108&txtslsubbg1=1151&txtslBagsg1=120&txtslqtyg1=1200&txtslwhg2=--WH--&txtslbing2=--Bin--&txtslsubbg2=--Sub%20Bin--&txtslBagsg2=&txtslqtyg2=&orowid2=0&maintrid=0&subtrid=0
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
	if(isset($_GET['txtslBagsg2']))
	{
	$h1 = $_GET['txtslBagsg2'];	 
	}

	$good1=0;$good2=0;
	
	if($b1!="" && $b1 > 0)
	{
	$good1=1; $god1=1;
	if(isset($_GET['orowid1']))
	{
	$rowid1 = $_GET['orowid1'];	 
	}
	}
	if($g1!="" && $g1 > 0)
	{
	$good2=1; $god2=1;
	if(isset($_GET['orowid2']))
	{
	$rowid2 = $_GET['orowid2'];	 
	}
	}

//		main field for the query i.e. if its is 0 then insert query should run & insblock should be replaced else the query should be update query & updblock should be replaced.
	
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
	
	
	$ddate1=explode("-",$date);
		$date=$ddate1[2]."-".$ddate1[1]."-".$ddate1[0];
		
	$edate1=explode("-",$edate);
	$dot=$edate1[2]."-".$edate1[1]."-".$edate1[0];
		
		
if($txtstage=="Raw") $chr="R";
if($txtstage=="Condition") $chr="C";		
if($txtstage=="Pack") $chr="P";

if($qcstatus!="Ok" || $qcstatus!="Fail")$edate="";

$sstatus="";

$olotno=$pcodeo.$ycodeeo.$txtlot2o."/".$stcodeo."/".$stcode2o.$chr;	
$oln=$pcodeo.$ycodeeo.$txtlot2o."/".$stcodeo."/".$stcode2o;	

$glotno=$pcode.$ycodee.$txtlot2."/".$stcode."/".$stcode2.$chr;	
$gln=$pcode.$ycodee.$txtlot2."/".$stcode."/".$stcode2;	

if($z1 == 0)
{
  $sql_main="insert into tbl_salesr (salesr_yearcode, salesr_trtype, salesr_tcode, salesr_date, salesr_logid, plantcode)values('$yearid_id', 'Opening Stock Condition', '$txtid', '$date', '$logid', '$plantcode')";

if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=mysqli_insert_id($link);

$sql_sub="insert into tbl_salesr_sub (salesr_id, salesrs_crop, salesrs_variety, salesrs_moist, salesrs_gemp, salesrs_pp, salesrs_qc, salesrs_dot, salesrs_stage, salesrs_oldlot, salesrs_newlot, salesrs_orlot, salesrs_nob, salesrs_qty, salesrs_yearcode, plantcode) values('$mainid', '$txtcrop', '$txtvariety', '$txtmoist', '$txtgemp', '$txtpp', '$qcstatus', '$dot', '$txtstage', '$olotno', '$glotno', '$gln', '$txtactnob', '$txtactqty', '$yearid_id', '$plantcode')";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=mysqli_insert_id($link);

if($god1==1)
{
$sql_sub_sub="insert into tbl_salesrsub_sub (salesr_id, salesrs_id, salesrss_wh, salesrss_bin, salesrss_subbin, salesrss_qty, salesrss_nob, plantcode) values('$mainid', '$subid', '$y', '$z', '$a1', '$b1', '$c1', '$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
if($god2==1)
{
$sql_sub_sub="insert into tbl_salesrsub_sub (salesr_id, salesrs_id, salesrss_wh, salesrss_bin, salesrss_subbin, salesrss_qty, salesrss_nob, plantcode) values('$mainid', '$subid', '$d1', '$e1', '$f1', '$g1', '$h1', '$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}

}
}
$z1=$mainid;
}
else
{
$sql_main="update tbl_salesr set salesr_yearcode='$yearid_id', salesr_trtype='Opening Stock Condition', salesr_tcode='$txtid', salesr_date='$date', salesr_logid='$logid'  where salesr_id = '$z1'";
if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=$z1;

$sql_sub="update tbl_salesr_sub set salesr_id='$mainid', salesrs_crop='$txtcrop', salesrs_variety='$txtvariety', salesrs_moist='$txtmoist', salesrs_gemp='$txtgemp', salesrs_pp='$txtpp', salesrs_qc='$qcstatus', salesrs_dot='$dot', salesrs_stage='$txtstage', salesrs_oldlot='$olotno', salesrs_newlot='$glotno', salesrs_orlot='$gln', salesrs_nob='$txtactnob', salesrs_qty='$txtactqty', salesrs_yearcode='$yearid_id' where salesrs_id='$subtrid'";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=$subtrid;
$sql_del=mysqli_query($link,"delete from tbl_salesrsub_sub where salesrs_id='$subtrid'") or die(mysqli_error($link));

if($god1==1)
{
$sql_sub_sub="insert into tbl_salesrsub_sub (salesr_id, salesrs_id, salesrss_wh, salesrss_bin, salesrss_subbin, salesrss_qty, salesrss_nob, plantcode) values('$mainid', '$subid', '$y', '$z', '$a1', '$b1', '$c1', '$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
if($god2==1)
{
$sql_sub_sub="insert into tbl_salesrsub_sub (salesr_id, salesrs_id, salesrss_wh, salesrss_bin, salesrss_subbin, salesrss_qty, salesrss_nob, plantcode) values('$mainid', '$subid', '$d1', '$e1', '$f1', '$g1', '$h1', '$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}

}
}
}
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#a8a09e" style="border-collapse:collapse">
<?php
 $tid=$z1;

$sql_tbl=mysqli_query($link,"select * from tbl_salesr where plantcode='$plantcode' AND salesr_logid='".$logid."' and salesr_trtype='Opening Stock Condition' and salesr_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesr_sub where plantcode='$plantcode' AND salesr_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
	<td width="22" align="center" valign="middle" class="tblheading">#</td>
	<td width="85" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="105" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="90" align="center" valign="middle" class="tblheading">Old Lot No.</td>
	<td width="66" align="center" valign="middle" class="tblheading">New Lot No.</td>
	<td width="66" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="70" align="center" valign="middle" class="tblheading">Qty</td>
	<td width="66" align="center" valign="middle" class="tblheading">Stage</td>
	<td width="51" align="center" valign="middle" class="tblheading">QC Status</td>
	<td width="78" align="center" valign="middle" class="tblheading">DoT</td>
	<td width="39" align="center" valign="middle" class="tblheading">Gemp %</td>
	<td width="128" align="center" valign="middle" class="tblheading">SLOC</td>
	<td width="35" align="center" valign="middle" class="tblheading">Edit</td>
    <td width="39" align="center" valign="middle" class="tblheading">Delete</td>
</tr>
  <?php
 $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		
	$tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
			else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}
						

$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['salesrs_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['salesrs_variety'].",";
	}

if($row_tbl_sub['salesrs_pp']=="Acceptable")
{
$cc="ACC";
}
else if($row_tbl_sub['salesrs_pp']=="Not-Acceptable")
{
$cc="NAC";
}

	$trdate=$row_tbl_sub['salesrs_dot'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
		
if($row_tbl_sub['salesrs_qc']!="OK" && $row_tbl_sub['salesrs_qc']!="Fail")
{
$trdate="--";
}


$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";$slups=0; $slqty=0;
$sql_sloc=mysqli_query($link,"select * from tbl_salesrsub_sub where plantcode='$plantcode' AND salesr_id='".$arrival_id."' and salesrs_id='".$row_tbl_sub['salesrs_id']."' order by salesrss_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_sloc['salesrss_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' AND binid='".$row_sloc['salesrss_bin']."' and whid='".$row_sloc['salesrss_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_sloc['salesrss_subbin']."' and binid='".$row_sloc['salesrss_bin']."' and whid='".$row_sloc['salesrss_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['salesrss_nob']; 
$slqty=$slqty+$row_sloc['salesrss_qty'];
}
$diq=explode(".",$slqty);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$slqty;}

$din=explode(".",$slups);
if($din[1]==000){$difn=$din[0];}else{$difn=$slups;}

if($srno%2!=0)
{
?>
<tr class="Light" height="20">
    <td width="32" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_oldlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_newlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_stage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_qc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($trdate!="--"){ echo $trdate;}?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_gemp'] > 0 ) echo $row_tbl_sub['salesrs_gemp'];?></td>
	<td width="95" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
    <td width="34" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['salesrs_id'];?>);" /></td>
    <td width="53" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['salesrs_id'];?>,'Opening Stock');" /></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="32" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia['cropname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_oldlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_newlot'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_stage'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['salesrs_qc'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($trdate!="--"){ echo $trdate;}?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_tbl_sub['salesrs_gemp'] > 0 ) echo $row_tbl_sub['salesrs_gemp'];?></td>
	<td width="95" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
    <td width="34" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['salesrs_id'];?>);" /></td>
    <td width="53" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['salesrs_id'];?>,'Opening Stock');" /></td>
</tr>
<?php
}
$srno++;
}
}

?>
</table><br />

<div id="postingsubtable" style="display:block">		 
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");
?>

<td width="98" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" >&nbsp;<select class="smalltbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
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
	<td width="107" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="211" align="left"  valign="middle" class="smalltbltext" id="vitem">&nbsp;<select class="smalltbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           
<td width="86" align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left" width="164" valign="middle" class="smalltblheading"  >&nbsp;<input type="hidden" id="txtstage" name="txtstage" value="Condition" />Condition</td>
</tr>
<?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
?>	
   <?php
   $quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
   $row_month=mysqli_fetch_array($quer6);
  $a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>	
<tr class="Light" height="30" >
<td align="right"  valign="middle" class="tblheading">Old Lot Number&nbsp;</td>
<td align="left" width="270" valign="middle" class="smalltbltext">&nbsp;
  <select class="smalltbltext" name="pcodeo" style="width:40px;" onchange="pcdchk(this.value);">
   <option value="" >--Select--</option>
	<option value="<?php echo $a;?>" ><?php echo $a;?></option>
    <?php while($noticia = mysqli_fetch_array($quer5)) { ?>
    <option value="<?php echo $noticia['stcode'];?>" />  
    <?php echo $noticia['stcode'];?>
    <?php } ?> </select>&nbsp;&nbsp;<select class="smalltbltext" name="ycodeeo" id="ycodeeo" style="width:40px;" onchange="ycodchko();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2o" type="text" size="4" class="smalltbltext"  maxlength="5" onkeypress="return isNumberKey(event)" onchange="lot2chko();"  /> <font size="+1"><b>/</b></font> <input name="stcodeo" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey24(event)"  value="" onchange="stchko();" onblur="Javascript:this.value=this.value.toUpperCase()" /> <font size="+1"><b>/</b></font> <input name="stcode2o" type="text" size="3" class="smalltbltext" tabindex="0" maxlength="3" onkeypress="return isNumberKey24(event)"  value="000" onchange="stchko2();" onblur="Javascript:this.value=this.value.toUpperCase()" />
	   &nbsp;<font color="#FF0000">*</font>&nbsp;<div id="lotchko"><input type="hidden" name="lotchecko" value="0" /></div></td>	

<td align="right"  valign="middle" class="tblheading">New Lot Number&nbsp;</td>
<td align="left" valign="middle" class="smalltbltext" colspan="3" >&nbsp;<input type="text" class="smalltbltext" name="pcode" size="2" readonly="true" style="background-color:#ECECEC" value="" />&nbsp;&nbsp;<input type="text" class="smalltbltext" name="ycodee" id="ycodee" size="2" readonly="true" style="background-color:#ECECEC" value="" /><input name="txtlot2" type="text" size="4" class="smalltbltext"  maxlength="5" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#ECECEC"  onchange="lot2chk();"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="" onchange="stchk();" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="smalltbltext" tabindex="0" maxlength="2" readonly="true" style="background-color:#ECECEC" value="00" />
	   &nbsp;<font color="#FF0000">*</font>&nbsp;<div id="lotcheck"><input type="hidden" name="lotcheck1" value="0" /></div></td>	
</tr>

<tr class="Light" height="30">
<!--<td align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext"   >&nbsp;<input name="txtactnob" type="text" size="5" class="smalltbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" onchange="actnob(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>-->

<td align="right"  valign="middle" class="tblheading">NoB&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext"   >&nbsp;<input name="txtactnob" type="text" size="5" class="smalltbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" onchange="actnob(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="3"  >&nbsp;<input name="txtactqty" type="text" size="9" class="smalltbltext" tabindex=""   maxlength="9" onkeypress="return isNumberKey(event)" onchange="actqty(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

</tr>
<tr class="Light" height="30">
<td align="center"  valign="middle" class="tblheading" colspan="6" >QC Information</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading" >QC Status&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="qcstatus" style="width:100px;"  onchange="varchk(this.value);"  >
    <option value="" selected>--Select--</option>
  	<option value="OK" >OK</option>
	<option value="Fail" >Fail</option>
	<option value="RT" >Retest</option>
	<option value="UT" >UT</option>
    
  </select>  <font color="#FF0000">*</font>	</td>
  <td align="right"  valign="middle" class="tblheading">Date of Test (DoT)&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="3"   >&nbsp;<input name="edate" id="edate1" type="text" size="10" class="smalltbltext" tabindex="0" readonly="true"  value="<?php echo date("d-m-Y", time());?>" style="background-color:#EFEFEF" />&nbsp;<a href="javascript:void(0)" onClick="dotchk('edate1');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a></a>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;</td>
          
	 
</tr>
<tr class="Light" height="30">
 <td align="right"  valign="middle" class="tblheading">PP&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext">&nbsp;<select class="smalltbltext" name="txtpp" style="width:110px;" onchange="qcchk();">
    <option value="" selected>--Select--</option>
    <option value="Acceptable" >Acceptable</option>
    <option value="Not-Acceptable" >Not-Acceptable</option>
  </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
    <td align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtmoist" type="text" size="1" class="smalltbltext" tabindex="" onkeypress="return isNumberKey(event)" maxlength="4" onchange="moischk(this.value);" />
      &nbsp;<font color="#FF0000">*</font>&nbsp;%</td>
	   <td align="right"  valign="middle" class="tblheading">Germination&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtgemp" id="txtgerm" type="text" size="1" class="smalltbltext" tabindex=""   maxlength="3" onkeypress="return isNumberKey1(event)" onchange="gemp(this.value);"/>%&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

           </tr>
		   
</table>
<div id="subsubdivgood" style="display:block">
</div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table><input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>
</div>
