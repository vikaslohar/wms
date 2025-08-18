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
	//$logid="OP1";
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
	
$s_sub="delete from tblarrival_sub where arrsub_id='".$b."'";
mysqli_query($link,$s_sub) or die(mysqli_error($link));
$s_sub_sub="delete from tblarr_sloc where arr_id='".$b."'";
mysqli_query($link,$s_sub_sub) or die(mysqli_error($link));

$sql_t_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$a."'") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_t_sub);
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#F1B01E" style="border-collapse:collapse">
 <?php
 $sql_tbl=mysqli_query($link,"select * from tblarrival where arrival_id='".$a."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
 $arrival_id=$row_tbl['arrival_id'];

if($tot_sub > 0)
$tid=$a;
else
$tid=0;
$arrival_id=$tid;
?>
 
  <?php
$sql_tbl=mysqli_query($link,"select * from tblarrival where arr_role='".$logid."' and arrival_type='Unidentified' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<tr class="tblsubtitle" height="20">
  <td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    
    <!--<td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Crop</td>-->
    <td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="8%" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	 <td align="center" valign="middle" class="tblheading" colspan="2">Actual</td>
	 <!--/* <td width="10%" align="center" valign="middle" class="tblheading" colspan="2">Actual</td>
 <td width="10%" align="center" valign="middle" class="tblheading" colspan="2">Difference</td>*/-->
 <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstage'];?></td>
	 	 <td align="center" valign="middle" class="tblheading" colspan="2">Preliminary QC</td>

		  <td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">QC Status </td>	 
		  <!-- <td width="9%" rowspan="2" align="center" valign="middle" class="tblheading">GOT Type</td>-->
		 	 <td width="9%" rowspan="2" align="center" valign="middle" class="tblheading">GOT Status</td>
		 <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">Seed Status </td>
    <td colspan="1" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
    <td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
 
  <tr class="tblsubtitle">
    <td width="5%" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
     <!--<td width="7%" align="center" valign="middle" class="tblheading">NoB </td>
     <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>
   <td width="7%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>-->
	  <td width="5%" align="center" valign="middle" class="tblheading">Moist %</td>
      <td width="7%" align="center" valign="middle" class="tblheading">PP</td>
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
		$itmdchk=$itmdchk.$row_tbl_sub['lotvariety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['lotvariety'].",";
	}
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl['lotcrop']."'"); 
	$row31=mysqli_fetch_array($quer3);

if($row_tbl_sub['vchk']=="Acceptable")
{
$cc="ACC";
}
else if($row_tbl_sub['vchk']=="Not-Acceptable")
{
$cc="NAC";
}
if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotcrop'];?></td>
	<td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotvariety'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	 <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty'];?></td>
	  <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstage'];?></td>
     <!-- <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
      <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff'];?></td>-->
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
	 <!--<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>-->
 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got1'];?></td>
  
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>
  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
    <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="7%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'Unidentified');" /></td>
  </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotcrop'];?></td>
	<td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotvariety'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
	 <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty'];?></td>
	  <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstage'];?></td>
     <!-- <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
     <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff'];?></td>-->
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
	 <!--<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>-->
 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got1'];?></td>
  
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>
   <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
    <td width="10%" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="7%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'Unidentified');" /></td>
  </tr>
  <?php
}
$srno++;
}
}

?>
<input type="hidden" name="itmdchk" value="<?php echo $subtbltot;?>" />
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#F1B01E"  style="border-collapse:collapse" > 
<tr class="Light" height="30">
<td align="right" width="204" valign="middle" class="tblheading" style="border-color:#F1B01E">&nbsp;Lot Number</td>
<td align="left" width="272" valign="middle" class="tbltext" style="border-color:#F1B01E">&nbsp;<input name="txtlot1" type="text" size="6" class="tblheading" tabindex=""  maxlength="6"  value="<?php echo $mode;?>" onchange="ltchk(this.value);"  />
</span>&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="366" valign="middle" class="tblheading" style="border-color:#F1B01E">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a>&nbsp;(After selection of lot no. click on 'Get Details')</td>
</tr>
</table>
		  <br />
<div id="postingsubtable" style="display:block">
</div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>
