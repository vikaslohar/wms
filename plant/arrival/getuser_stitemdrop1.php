<?php
session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../../login.php' ";
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
	}require_once("../../include/config.php");
	require_once("../../include/connection.php");
	
	
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
	 $d = $_GET['f'];	 
	}

if(isset($_POST['frm_action'])=='submit')
	{
		$f=trim($_POST['sstatus']);
	
}

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$a."' order by cropname Asc"); 
$noticia = mysqli_fetch_array($quer3);
$crop=$noticia['cropname'];

$sql_month=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$crop."' and lotldg_variety='".$b."' and lotldg_lotno='".$c."'and lotldg_sstage='".$tp."' and plantcode='$plantcode' order by lotldg_sstatus")or die(mysqli_error($link));
$row= mysqli_fetch_array($sql_month);
 $variety=$row['lotldg_sstatus'];
?>

<table align="center" border="1" width="600" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Lot Details</td>
</tr>

<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$c."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
  $tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
 $tid=$row_tbl_sub['lotldg_id'];
   $row_tbl_sub['lotldg_sstatus'];

$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub['lotldg_crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub['lotldg_variety']."'"); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl_sub['lotldg_variety'];
	 }
	 else
	 {
	$vv=$tt;
	  }
	  
	  $aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl_sub['lotldg_balqty'];}
if($bags!="")
		{
		$bags=$bags."<br>".$acn;
		}
		else
		{
		$bags=$acn;
		}
		if($qty!="")
		{
		$qty=$qty."<br>".$ac;
		}
		else
		{
		$qty=$ac;
		}
?>
          <tr class="Dark" height="25">
            <td width="99" align="right"  valign="middle"  class="tblheading">&nbsp;NoB&nbsp;</td>
            <td width="140" align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl_sub['lotldg_trbags'];?></td>
            <td align="right"  valign="middle"  class="tblheading">Qty&nbsp;</td>
            <td align="left"  valign="middle" class="tblheading" >&nbsp;<?php echo $row_tbl_sub['lotldg_trqty'];?></td>
          </tr>
		  <tr class="Dark" height="25">
          				  <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tbl_sub['lotldg_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tbl_sub['lotldg_binid']."' and whid='".$row_tbl_sub['lotldg_whid']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tbl_sub['lotldg_subbinid']."' and binid='".$row_tbl_sub['lotldg_binid']."' and whid='".$row_tbl_sub['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
$tp1=12;

?>
			   <td align="right"  valign="middle" class="tblheading">SLOC&nbsp;</td>
                 <td align="left"  valign="middle" class="tblheading" colspan="6">&nbsp;<?php echo $slocs?></td>
	      </tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tbltext">&nbsp; <input type="checkbox" name="sstatus"  readonly="true"<?php $p1_array=explode("/",$row_tbl_sub['lotldg_sstatus']);
//echo $row_tbl_sub['lotldg_sstatus']=="D";
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == "R") { $i++;}
				}
				}
				if($i !=0) { echo "checked";}?>  value="R">&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6">&nbsp;Reserve (R)&nbsp;</td>
</tr>
 <?php
 $p1_array=explode("/",$row_tbl_sub['lotldg_sstatus']);
			$i=0; $pl="";
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 != "R") { if($pl!="")$pl=$pl."/".$val1; else $pl=$val1;}
				 }
				}
 ?>
 <tr class="Light" height="25">
<td align="right"  valign="middle" class="tbltext">Reserve Remarks&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6">&nbsp;<input type="text" name="txtremarks" size="75" class="smalltbltext" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<input type="hidden" name="foccode" value="" />
<input type="hidden" name="foccode1" value="<?php echo $pl;?>" />
<input type="hidden" name="lotid" value="<?php echo $c;?>" />
</table>
