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
	
if(isset($_REQUEST['tid']))
	{
		$itmid = $_REQUEST['tid'];
	}
	if(isset($_POST['frm_action'])=='submit')
	{
	echo "<script>window.opener.location.href = window.opener.location.href;
						   self.close();</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction-Qc Sampling slip</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }

</style>
<table align="center" border="0" width="800" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<?php
/*$itm=explode(",",$itmid);
$cont=0;$cnt=0;$v1=array();
foreach($itm as $tid)
{
if($tid <> "")
{
if($cont < 1)
{
if($v1[$cnt]!="")
$v1[$cnt]=$v1[$cnt].",".$tid;
else
$v1[$cnt]=$tid;
$cont++;
}
if($cont==1)
{
$cont=0;$cnt++;
}

}
}
echo $cnt;
for($i=0; $i<$cnt; $i++)
{
echo $v1[$i];
}
*/

$tid=460;
?>
    <tr>

<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);
 if($tot_arr_home >0) { 
?>
	
    <td>
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
      <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
      <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
    <td>&nbsp;</td>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) {
?>	
	<td>
	
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
       <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
      <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>
	<td>&nbsp;</td>
	<td>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
       <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
     <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
  </tr>
	 <tr>
    <td >&nbsp;</td>
     </tr>
  <tr>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>
 <td>
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
      <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
      <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
    <td>&nbsp;</td>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>	
	<td>
<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
       <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
      <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
<td>&nbsp;</td>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>	
	<td>
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
       <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
      <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
	
  </tr>
  
  
	 <tr>
    <td >&nbsp;</td>
     </tr>
  <tr>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>
 <td>
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
       <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
      <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
    <td>&nbsp;</td>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>	
	<td>
<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
       <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
     <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
<td>&nbsp;</td>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>	
	<td>
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
       <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
      <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
	
  </tr>
  
    <tr>
    <td >&nbsp;</td>
     </tr>
  <tr>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>
 <td>
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
      <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
     <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
    <td>&nbsp;</td>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>	
	<td>
<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
       <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
      <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
<td>&nbsp;</td>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>	
	<td>
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
       <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
     <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
	
  </tr>
  <tr><td>&nbsp;</td></tr>
      <tr>

<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);
 if($tot_arr_home >0) { 
?>
	
    <td>
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
      <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
      <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
    <td>&nbsp;</td>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) {
?>	
	<td>
	
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
       <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
      <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>
	<td>&nbsp;</td>
	<td>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
       <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
     <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
  </tr>
	 <tr>
    <td >&nbsp;</td>
     </tr>
  <tr>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>
 <td>
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
      <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
      <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
    <td>&nbsp;</td>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>	
	<td>
<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
       <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
      <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
<td>&nbsp;</td>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>	
	<td>
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
       <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
      <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
	
  </tr>
  
  
	 <tr>
    <td >&nbsp;</td>
     </tr>
  <tr>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>
 <td>
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
       <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
      <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
    <td>&nbsp;</td>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>	
	<td>
<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
       <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
     <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
<td>&nbsp;</td>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>	
	<td>
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
       <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
      <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
	
  </tr>
  
    <tr>
    <td >&nbsp;</td>
     </tr>
  <tr>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>
 <td>
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
      <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
     <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
    <td>&nbsp;</td>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>	
	<td>
<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
       <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
      <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
<td>&nbsp;</td>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
$tot_arr_home = mysqli_num_rows($sql_arr_home);if($tot_arr_home >0) { 
?>	
	<td>
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
       <tr class="tblsubtitle" height="15">
        <td colspan="4"  align="center" class="tblheading">QC Sample Slip</td>
      </tr>
      <?php
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub1['crop'];
		}
		else
		{
		$crop=$row_tbl_sub1['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub1['variety'];
		}
		else
		{
		$variety=$row_tbl_sub1['variety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl['lotldg_sstage'];
$pp=$row_tbl['lotldg_qc'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
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
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_arr_home['plantcode'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
     <tr class="Light" height="15">
        <td width="54" align="right"  valign="middle" class="smalltblheading">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $lotno?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $stage?></td>
      </tr>
      <tr class="Light" height="15">
        <td  align="right"  valign="middle" class="smalltblheading">&nbsp;NoB&nbsp;</td>
        <td width="77"  align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
        <td width="33" align="right"  valign="middle" class="smalltblheading">Qty&nbsp;</td>
        <td width="80" align="left"  valign="middle" class="smalltblheading" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Dark" height="15">
        <td align="right"  valign="middle" class="smalltblheading">Smp No.&nbsp;</td>
        <td align="left"  valign="middle" class="smalltblheading" colspan="3" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
    </table></td>
<?php
}
}
?>	
	
  </tr>
</table>

<br/>
<table width="800" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="542" align="right"><img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" />&nbsp;&nbsp;</td>
</tr>
</table>

