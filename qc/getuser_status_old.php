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
	//$yearid_id="09-10";
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
if(isset($_REQUEST['tid']))
	{
		 $tid = $_REQUEST['tid'];
	}
	if(isset($_POST['frm_action'])=='submit')
	{
	/*$c1=$_POST['foccode'];
	
					$sql_in1="insert into tbllotimp(lotimpid, lotnumber) values('$lid', '$c1')";	
					$flid=mysqli_query($link,$sql_in1)or die(mysqli_error($link));*/
			
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
<script language='javascript'>

function post_value()
{
var cnt=0;
for (var i = 0; i < document.from.sstatus.length; i++) {          
		 
		  if(document.from.sstatus[i].checked == true)
			{
				if(document.from.foccode.value =="")
				{
				document.from.foccode.value=document.from.sstatus[i].value;
				//document.from.foccode1.value=document.from.sstatus[i].value;
				}
				else
				{
				document.from.foccode.value = document.from.foccode.value +'/'+document.from.sstatus[i].value;
				//document.from.foccode1.value = document.from.foccode1.value +'\n'+document.from.sstatus[i].value;
				}
				cnt++;
			}
			
		}
		
opener.document.frmaddDepartment.sstatus.value=document.from.foccode.value;
self.close();
}
/*function post_value()
{
opener.document.frmaddDepartment.sstatus.value=document.from.cnt.value;
self.close();
}*/

function clk(val)
{
document.from.foccode.value=val;
}

function mySubmit()
{
if(document.from.foccode.value=="")
{
alert("You must select Lot");
return false;
}
if(document.from.sstatus.value=="")
{
alert("You must Qc Test");
return false;
}

return true;
}	
	
			</script>
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
 if($tot_arr_home >0) { //$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblarrival where arrtrflag=1"),0);
?>
<table align="center" border="0" width="513" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
    <tr>
    <td><table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
      <tr class="tblsubtitle" height="20" align="">
        <td colspan="2"  align="center" class="tblheading">QC Sample Slip </td>
      </tr>
      <?php

$srno=1;
if($tot_arr_home > 0)
{
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

/*
		if($qc1!="")
		{
		
		}
		else
		{
		
		}
		*/
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
		/*if($moist!="")
		{
		$moist=$moist."<br>".$row_tbl_sub1['moist'];
		}
		else
		{
		$moist=$row_tbl_sub1['moist'];	
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub1['got'];
		}
		else
		{
	$got=$row_tbl_sub1['got'];	
		}
		if($pp!="")
		{
		$pp=$pp."<br>".$row_tbl_sub1['lotldg_qc'];
		}
		else
		{
		$pp=$row_tbl_sub1['lotldg_qc'];	
		}
		if($gemp!="")
		{
		$gemp=$gemp."<br>".$row_tbl_sub1['gemp'];
		}
		else
		{
		$gemp=$row_tbl_sub1['gemp'];	
		}*/
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	/*if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub1['lotldg_sstage'];
		}
		else
		{
		$stage=$row_tbl_sub1['lotldg_sstage'];
		}*/
		
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	
	/* $tdate11=$row_tbl['dc_date'];
		$tday1=substr($tdate11,0,4);
		$tmonth1=substr($tdate11,5,2);
		$tyear1=substr($tdate11,8,2);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;*/

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

$tp1=$row_param['code'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 

?>
      <tr class="Light" height="25">
        <td width="83" align="right"  valign="middle" class="tbltext">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="30">
        <td align="right"  valign="middle" class="tbltext">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="30">
        <td align="right"  valign="middle" class="tbltext">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $lotno?>
            <?php
}
}
}

?></td>
      </tr>
      <tr class="Dark" height="30">
        <td align="right"  valign="middle" class="tbltext">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $stage?></td>
      </tr>
      <tr class="Light" height="25">
        <td width="83" align="right"  valign="middle" class="tbltext">&nbsp;NoB&nbsp;</td>
        <td width="182" align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $row_tbl['lotldg_trbags'];?></td>
      </tr>
      <tr class="Dark" height="30">
        <td align="right"  valign="middle" class="tbltext">Qty&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Light" height="30">
        <td align="right"  valign="middle" class="tbltext">Sample No.&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
           </td></tr>
        
          
                  
      
      <input type="hidden" name="foccode2" value="" />
      <input type="hidden" name="foccode12" value="" />
    </table></td>
    <td>&nbsp;</td>
	
	<td>
	<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
 if($tot_arr_home >0) { //$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblarrival where arrtrflag=1"),0);
?>
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
      <tr class="tblsubtitle" height="20" align="">
        <td colspan="2"  align="center" class="tblheading">QC Sample Slip </td>
      </tr>
      <?php

$srno=1;
if($tot_arr_home > 0)
{
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

/*
		if($qc1!="")
		{
		
		}
		else
		{
		
		}
		*/
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
		/*if($moist!="")
		{
		$moist=$moist."<br>".$row_tbl_sub1['moist'];
		}
		else
		{
		$moist=$row_tbl_sub1['moist'];	
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub1['got'];
		}
		else
		{
	$got=$row_tbl_sub1['got'];	
		}
		if($pp!="")
		{
		$pp=$pp."<br>".$row_tbl_sub1['lotldg_qc'];
		}
		else
		{
		$pp=$row_tbl_sub1['lotldg_qc'];	
		}
		if($gemp!="")
		{
		$gemp=$gemp."<br>".$row_tbl_sub1['gemp'];
		}
		else
		{
		$gemp=$row_tbl_sub1['gemp'];	
		}*/
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	/*if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub1['lotldg_sstage'];
		}
		else
		{
		$stage=$row_tbl_sub1['lotldg_sstage'];
		}*/
		
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	
	/* $tdate11=$row_tbl['dc_date'];
		$tday1=substr($tdate11,0,4);
		$tmonth1=substr($tdate11,5,2);
		$tyear1=substr($tdate11,8,2);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;*/

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

$tp1=$row_param['code'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 

?>
      <tr class="Light" height="25">
        <td width="83" align="right"  valign="middle" class="tbltext">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="30">
        <td align="right"  valign="middle" class="tbltext">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="30">
        <td align="right"  valign="middle" class="tbltext">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $lotno?>
            <?php
}
}
}

?></td>
      </tr>
      <tr class="Dark" height="30">
        <td align="right"  valign="middle" class="tbltext">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $stage?></td>
      </tr>
      <tr class="Light" height="25">
        <td width="83" align="right"  valign="middle" class="tbltext">&nbsp;NoB&nbsp;</td>
        <td width="182" align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $row_tbl['lotldg_trbags'];?></td>
      </tr>
      <tr class="Dark" height="30">
        <td align="right"  valign="middle" class="tbltext">Qty&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Light" height="30">
        <td align="right"  valign="middle" class="tbltext">Sample No.&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>  
          
         
          
             
      </tr>
      <input type="hidden" name="foccode2" value="" />
      <input type="hidden" name="foccode12" value="" />
    </table></td>
  </tr>
  <tr>
    <td >&nbsp;</td>
     </tr>
  <tr>
    <td><?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
 if($tot_arr_home >0) { //$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblarrival where arrtrflag=1"),0);
?>
	<table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
      <tr class="tblsubtitle" height="20" align="">
        <td colspan="2"  align="center" class="tblheading">QC Sample Slip </td>
      </tr>
      <?php

$srno=1;
if($tot_arr_home > 0)
{
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

/*
		if($qc1!="")
		{
		
		}
		else
		{
		
		}
		*/
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
		/*if($moist!="")
		{
		$moist=$moist."<br>".$row_tbl_sub1['moist'];
		}
		else
		{
		$moist=$row_tbl_sub1['moist'];	
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub1['got'];
		}
		else
		{
	$got=$row_tbl_sub1['got'];	
		}
		if($pp!="")
		{
		$pp=$pp."<br>".$row_tbl_sub1['lotldg_qc'];
		}
		else
		{
		$pp=$row_tbl_sub1['lotldg_qc'];	
		}
		if($gemp!="")
		{
		$gemp=$gemp."<br>".$row_tbl_sub1['gemp'];
		}
		else
		{
		$gemp=$row_tbl_sub1['gemp'];	
		}*/
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	/*if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub1['lotldg_sstage'];
		}
		else
		{
		$stage=$row_tbl_sub1['lotldg_sstage'];
		}*/
		
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	
	/* $tdate11=$row_tbl['dc_date'];
		$tday1=substr($tdate11,0,4);
		$tmonth1=substr($tdate11,5,2);
		$tyear1=substr($tdate11,8,2);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;*/

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

$tp1=$row_param['code'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 

?>
      <tr class="Light" height="25">
        <td width="83" align="right"  valign="middle" class="tbltext">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="30">
        <td align="right"  valign="middle" class="tbltext">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="30">
        <td align="right"  valign="middle" class="tbltext">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $lotno?>
            <?php
}
}
}

?></td>
      </tr>
      <tr class="Dark" height="30">
        <td align="right"  valign="middle" class="tbltext">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $stage?></td>
      </tr>
      <tr class="Light" height="25">
        <td width="83" align="right"  valign="middle" class="tbltext">&nbsp;NoB&nbsp;</td>
        <td width="182" align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $row_tbl['lotldg_trbags'];?></td>
      </tr>
      <tr class="Dark" height="30">
        <td align="right"  valign="middle" class="tbltext">Qty&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Light" height="30">
        <td align="right"  valign="middle" class="tbltext">Sample No.&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
            </td>
      </tr>
      <input type="hidden" name="foccode2" value="" />
      <input type="hidden" name="foccode12" value="" />
    </table></td>
    <td>&nbsp;</td>
	<td><?php
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where tid='$tid'") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest"),0); 
 if($tot_arr_home >0) { //$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblarrival where arrtrflag=1"),0);
?><table  align="center" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
      <tr class="tblsubtitle" height="20" align="">
        <td colspan="2"  align="center" class="tblheading">QC Sample Slip </td>
      </tr>
      <?php

$srno=1;
if($tot_arr_home > 0)
{
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

/*
		if($qc1!="")
		{
		
		}
		else
		{
		
		}
		*/
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
		/*if($moist!="")
		{
		$moist=$moist."<br>".$row_tbl_sub1['moist'];
		}
		else
		{
		$moist=$row_tbl_sub1['moist'];	
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub1['got'];
		}
		else
		{
	$got=$row_tbl_sub1['got'];	
		}
		if($pp!="")
		{
		$pp=$pp."<br>".$row_tbl_sub1['lotldg_qc'];
		}
		else
		{
		$pp=$row_tbl_sub1['lotldg_qc'];	
		}
		if($gemp!="")
		{
		$gemp=$gemp."<br>".$row_tbl_sub1['gemp'];
		}
		else
		{
		$gemp=$row_tbl_sub1['gemp'];	
		}*/
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	/*if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub1['lotldg_sstage'];
		}
		else
		{
		$stage=$row_tbl_sub1['lotldg_sstage'];
		}*/
		
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	
	/* $tdate11=$row_tbl['dc_date'];
		$tday1=substr($tdate11,0,4);
		$tmonth1=substr($tdate11,5,2);
		$tyear1=substr($tdate11,8,2);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;*/

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

$tp1=$row_param['code'];

$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 

?>
      <tr class="Light" height="25">
        <td width="83" align="right"  valign="middle" class="tbltext">&nbsp;Crop&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $row31['cropname'];?></td>
      </tr>
      <tr class="Dark" height="30">
        <td align="right"  valign="middle" class="tbltext">&nbsp;Variety&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $rowvv['popularname'];?></td>
      </tr>
      <tr class="Light" height="30">
        <td align="right"  valign="middle" class="tbltext">Lot No.&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $lotno?>
            <?php
}
}
}

?></td>
      </tr>
      <tr class="Dark" height="30">
        <td align="right"  valign="middle" class="tbltext">Stage&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $stage?></td>
      </tr>
      <tr class="Light" height="25">
        <td width="83" align="right"  valign="middle" class="tbltext">&nbsp;NoB&nbsp;</td>
        <td width="182" align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $row_tbl['lotldg_trbags'];?></td>
      </tr>
      <tr class="Dark" height="30">
        <td align="right"  valign="middle" class="tbltext">Qty&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;
            <?php echo $row_tbl['lotldg_trqty'];?></td>
      </tr>
      <tr class="Light" height="30">
        <td align="right"  valign="middle" class="tbltext">Sample No.&nbsp;</td>
        <td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?>
          </td>
      </tr>
      <input type="hidden" name="foccode2" value="" />
      <input type="hidden" name="foccode12" value="" />
    </table></td>
  </tr>
</table>

<!--<table align="center" border="0" width="513" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 

  <tr>
    <td><table align="left" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="2"  align="center" class="tblheading">QC Sample Slip </td>
</tr>
<?php

$srno=1;
if($tot_arr_home > 0)
{
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

/*
		if($qc1!="")
		{
		
		}
		else
		{
		
		}
		*/
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
		/*if($moist!="")
		{
		$moist=$moist."<br>".$row_tbl_sub1['moist'];
		}
		else
		{
		$moist=$row_tbl_sub1['moist'];	
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub1['got'];
		}
		else
		{
	$got=$row_tbl_sub1['got'];	
		}
		if($pp!="")
		{
		$pp=$pp."<br>".$row_tbl_sub1['lotldg_qc'];
		}
		else
		{
		$pp=$row_tbl_sub1['lotldg_qc'];	
		}
		if($gemp!="")
		{
		$gemp=$gemp."<br>".$row_tbl_sub1['gemp'];
		}
		else
		{
		$gemp=$row_tbl_sub1['gemp'];	
		}*/
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	/*if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub1['lotldg_sstage'];
		}
		else
		{
		$stage=$row_tbl_sub1['lotldg_sstage'];
		}*/
		
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	
	/* $tdate11=$row_tbl['dc_date'];
		$tday1=substr($tdate11,0,4);
		$tmonth1=substr($tdate11,5,2);
		$tyear1=substr($tdate11,8,2);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;*/

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
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

$tp1=$row_param['code'];
}

//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 

?><tr class="Light" height="25">
<td width="83" align="right"  valign="middle" class="tbltext">&nbsp;Crop&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row31['cropname'];?></td>
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tbltext">&nbsp;Variety&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $rowvv['popularname'];?></td>
</tr> 
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tbltext">Lot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $lotno?>
  <?php
}
?></td> 
</tr>  
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tbltext">Stage&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $stage?></td> 
</tr> 
<tr class="Light" height="25">
<td width="83" align="right"  valign="middle" class="tbltext">&nbsp;NoB&nbsp;</td>
<td width="182" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tbltext">Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
</tr> 
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tbltext">Sample No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $tp1?>
		    <?php echo $row_arr_home['yearid']?>/00000<?php echo $qc1?></td> 
 
<input type="hidden" name="foccode" value="" />
<input type="hidden" name="foccode1" value="" />
</table>
     </form></td>
	   <td><table align="left" border="1" width="254" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="2"  align="center" class="tblheading">QC Sample Slip </td>
</tr>
<?php

$srno=1;
if($tot_arr_home > 0)
{
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

/*
		if($qc1!="")
		{
		
		}
		else
		{
		
		}
		*/
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
		/*if($moist!="")
		{
		$moist=$moist."<br>".$row_tbl_sub1['moist'];
		}
		else
		{
		$moist=$row_tbl_sub1['moist'];	
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub1['got'];
		}
		else
		{
	$got=$row_tbl_sub1['got'];	
		}
		if($pp!="")
		{
		$pp=$pp."<br>".$row_tbl_sub1['lotldg_qc'];
		}
		else
		{
		$pp=$row_tbl_sub1['lotldg_qc'];	
		}
		if($gemp!="")
		{
		$gemp=$gemp."<br>".$row_tbl_sub1['gemp'];
		}
		else
		{
		$gemp=$row_tbl_sub1['gemp'];	
		}*/
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}
	/*if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub1['lotldg_sstage'];
		}
		else
		{
		$stage=$row_tbl_sub1['lotldg_sstage'];
		}*/
		
	}
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	
	/* $tdate11=$row_tbl['dc_date'];
		$tday1=substr($tdate11,0,4);
		$tmonth1=substr($tdate11,5,2);
		$tyear1=substr($tdate11,8,2);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;*/

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
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
}

//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 

?><tr class="Light" height="25">
<td width="83" align="right"  valign="middle" class="tbltext">&nbsp;Crop&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row31['cropname'];?></td>
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tbltext">&nbsp;Variety&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $rowvv['popularname'];?></td>
</tr> 
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tbltext">Lot No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $lotno?>
  <?php
}
?></td> 
</tr>  
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tbltext">Stage&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $stage?></td> 
</tr> 
<tr class="Light" height="25">
<td width="83" align="right"  valign="middle" class="tbltext">&nbsp;NoB&nbsp;</td>
<td width="182" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['lotldg_trbags'];?></td>
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tbltext">Qty&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['lotldg_trqty'];?></td>
</tr> 
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tbltext">Sample No.&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $tp1?>
		    <?php echo $row_arr_home['yearid']?>/00000<?php echo $qc1?></td> 
 
<input type="hidden" name="foccode" value="" />
<input type="hidden" name="foccode1" value="" />
</table>
     </td>
  </tr>
</table>-->
<br/>
<table width="516" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="542" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

