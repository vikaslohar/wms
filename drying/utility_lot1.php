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
	
	
	/*if(isset($_REQUEST['frm_action'])=='submit')
	{*/
	if(isset($_GET['txtloc']))
	{
	 $loc = $_GET['txtloc'];
	}
	if(isset($_GET['txtlot1']))
	{
	  $lot= $_GET['txtlot1'];
	}
	if(isset($_GET['txtcrop']))
	{
	 $crop= $_GET['txtcrop'];
	}
	if(isset($_GET['txtorganizer']))
	{
	 $org= $_GET['txtorganizer'];
	}
	if(isset($_GET['txtfarmer']))
	{
	 $farmer= $_GET['txtfarmer'];
	}
	if(isset($_REQUEST['sdate']))
	{
	 $sdate = $_REQUEST['sdate'];
	}
	if(isset($_REQUEST['edate']))
	{
	 $edate = $_REQUEST['edate'];
	}
	if(isset($_REQUEST['typ']))
	{
	 $typ = $_REQUEST['typ'];
	}
	if(isset($_GET['txtlot1']))
	{
	 $lot = $_GET['txtlot1'];
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Drying - Utility - Decode SLOC Look Up</title>
<link href="../include/main_drying.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_drying.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>

</head>

<script type="text/javascript">

</script>

<body>
<table width="850" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="typ" value="<?php echo $typ;?>" />	 
 <input type="hidden" name="lot" value="<?php echo $lot;?>" />	 
 <input type="hidden" name="crop" value="<?php echo $crop;?>" />	 
 <input type="hidden" name="loc" value="<?php echo $loc;?>" />	 
 <input type="hidden" name="org" value="<?php echo $org;?>" />	 
 <input type="hidden" name="farmer" value="<?php echo $farmer;?>" />	 
 <input type="hidden" name="sdate" value="<?php echo $sdate;?>" />	 
 <input type="hidden" name="edate" value="<?php echo $edate;?>" />	 
 <table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#adad11" style="border-collapse:collapse">
 
 <tr class="tblsubtitle" height="20">
          <td align="center" valign="middle" class="tblheading" colspan="16">Decode SLOC Look Up</td>
 </tr>
        <tr class="tblsubtitle" height="20">
          <td width="2%" align="center" valign="middle" class="tblheading">#</td>
		   <td width="3%" align="center"  valign="middle" class="tblheading">Date</td>
          <td width="5%" align="center"  valign="middle" class="tblheading">Lot Number</td>
          <td width="7%" align="center"  valign="middle" class="tblheading">Old/Vendor Lot Number</td>
          <td width="7%" align="center"  valign="middle" class="tblheading">Type of Transaction</td>
          <td width="5%"align="center" valign="middle" class="tblheading">SP Code Female</td>
          <td width="4%" align="center" valign="middle" class="tblheading">SP Code Male</td>
          <td width="10%" align="center" valign="middle" class="tblheading">Crop</td>
         <td width="11%" align="center" valign="middle" class="tblheading">Variety</td>
          <td width="3%" align="center" valign="middle" class="tblheading">GI</td>
          <td width="9%" align="center" valign="middle" class="tblheading">Production Location</td>
          <td width="9%" align="center" valign="middle" class="tblheading">Production Personnel</td>
          <td width="8%" align="center" valign="middle" class="tblheading">Organiser</td>
          <td width="8%" align="center" valign="middle" class="tblheading">Farmer</td>
          <td width="3%" align="center" valign="middle" class="tblheading">Plot No.</td>
		   <td width="6%" align="center" valign="middle" class="tblheading">Status</td>
        </tr>

	 <?php


	 $sql_opr=mysqli_query($link,"select * from tblopr where plantcode='".$plantcode."' and id='".$loginid."'") or die(mysqli_error($link));
	$row_opr=mysqli_fetch_array($sql_opr);

	$trvflag=$row_opr['trvflag'];

	 if($typ=="qry")
	{	
	
/*$sql_tbl1=mysqli_query($link,"select * from tbllot where lotnumber='$lot'") or die(mysqli_error($link));
$row_clsss=mysqli_fetch_array($sql_tbl1);*/

$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
	
	
		$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;

$srno=1;
if($org=="") $org=0;
if($farmer=="") $farmer=0;

if($trvflag=="Yes" || $role=="admin")
	{	
	$sql_arr=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   ardate>='$sdate' and ardate<='$edate' and cropid='".$crop."' and productionlocationid='".$loc. "'") or die(mysqli_error($link));
	}
	else
	{
	$sql_arr=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   ardate>='$sdate' and ardate<='$edate' and cropid='".$crop."' and productionlocationid='".$loc. "' and logid='".$logid."'") or die(mysqli_error($link));
	}
	//echo $t=mysqli_num_rows($sql_arr);
	while($row_arr=mysqli_fetch_array($sql_arr))
	{
		if($org!=0 && $farmer!=0)
		{
		$sql_arr_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   arid='".$row_arr['arid']."' and orgid='".$org."' and farmerid='".$farmer."'") or die(mysqli_error($link));
		}
		else if($org!=0 && $farmer==0)
		{
		$sql_arr_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   arid='".$row_arr['arid']."' and orgid='".$org."'") or die(mysqli_error($link));
		}
		else if($org==0 && $farmer!=0)
		{
		$sql_arr_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   arid='".$row_arr['arid']."' and farmerid='".$farmer."'") or die(mysqli_error($link));
		}
	
	while($row_sub=mysqli_fetch_array($sql_arr_sub))
	{
	
		$sql_cls=mysqli_query($link,"SELECT * FROM tbllot where id='".$row_sub['lotnoid']."' order by lotno Asc") or die(mysqli_error($link));
		$row_cls=mysqli_fetch_array($sql_cls);
	
		$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr['cropid']."'") or die(mysqli_error($link));
		$row_class=mysqli_fetch_array($sql_class);
		
		$sql_item1=mysqli_query($link,"select * from tblfarmer where farmerid='".$row_sub['farmerid']."'") or die(mysqli_error($link));
		$row_item1=mysqli_fetch_array($sql_item1);
		
		$sql_item=mysqli_query($link,"select * from tblorganiser where plantcode='".$plantcode."' and orgid='".$row_sub['orgid']."'") or die(mysqli_error($link));
		$row_item=mysqli_fetch_array($sql_item);
		
		$sql_pro=mysqli_query($link,"select * from tblproductionpersonnel where plantcode='".$plantcode."' and productionpersonnelid='".$row_arr['productionpersonnelid']."'") or die(mysqli_error($link));
		$row_pro=mysqli_fetch_array($sql_pro);
		
		$sql_pp=mysqli_query($link,"select * from tblproductionlocation where productionlocationid ='".$row_arr['productionlocationid']."'") or die(mysqli_error($link));
		$row_pp=mysqli_fetch_array($sql_pp);

		$quer0=mysqli_query($link,"select * from tblvariety where varietyid='".$row_arr['varietyid']."'  and vertype='PV'") or die(mysqli_error($link));
		$row0=mysqli_fetch_array($quer0);


				$tp="";$crop="";
				if($row_arr['trtype']=="freshpdn")
				{
					$tp="Fresh Seed with PDN";
					$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr['cropid']."'") or die(mysqli_error($link));
					$row_class=mysqli_fetch_array($sql_class);
					$crop=$row_class['cropname'];
				}
				else if($row_arr['trtype']=="Trading")
				{
					$tp="Trading";
					$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr['cropid']."'") or die(mysqli_error($link));
					$row_class=mysqli_fetch_array($sql_class);
					$crop=$row_class['cropname'];
				}
				else if($row_arr['trtype']=="UnidentifiedArrival")
				{
					$tp="Unidentified";
					$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_sub['cropid']."'") or die(mysqli_error($link));
					$row_class=mysqli_fetch_array($sql_class);
					$crop=$row_class['cropname'];
				}
				else if($row_arr['trtype']=="Existing")
				{
					$tp="Lot regularisation" ;
					$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr['cropid']."'") or die(mysqli_error($link));
					$row_class=mysqli_fetch_array($sql_class);
					$crop=$row_class['cropname'];
				}
				else if($row_arr['trtype']=="LotMerger")
				{
					$tp="Lot Merger";
					$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr['cropid']."'") or die(mysqli_error($link));
					$row_class=mysqli_fetch_array($sql_class);
					$crop=$row_class['cropname'];
				}
				else
				{
				$tp="";
				$crop="";
				}

$tp1="";	$tp1="";
			if($row_cls['impflg'] ==0) { $tp1="IMP-No";}
			else if($row_cls['impflg'] ==1) { $tp1="IMP-Yes";}
			else if($row_cls['impflg'] ==2) { $tp1="Suspended";}
	
	$lotstat=$tp1;

$spcodef = $row_arr['spcodef'];
$spcodem = $row_arr['spcodem'];
$loc=$row_pp['productionlocation'];
$per=$row_pro['productionpersonnel'];
//$crop=$row_class1['cropname'];
$variety=$row0['popularname'];
$lotno=$row_cls['lotnumber'];
$gi=$row_arr['gi'];
if($row_arr['trtype']=="Trading" || $row_arr['trtype']=="Existing")
{
$oldlot = $row_sub['oldlot'];
}
else
{
$oldlot = $row_arr['oldlot'];
}
$lotmerging=$row_arr['nooflots'];
$organizer=$row_item['orgname'];
$farmer=$row_item1['farmername'];
$plotn=$row_sub['plotno'];

	$trdate=$row_arr['ardate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;

$srno=1;
if($srno%2!=0)
{
?>

        <tr class="Light" height="20">
          <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   <td align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
          <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $lotno;?></td>
          <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $oldlot;?></td>
          <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $tp;?></td>
          <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $spcodef;?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $spcodem;?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
    <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
          <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $gi;?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $loc;?></td>
          <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $per;?></td>
          <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $organizer;?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $farmer;?></td>
          <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $plotn?></td>
		   <td align="center" valign="top" class="tblheading"><?php echo $lotstat;?></td>
        </tr>
<?php
}
else
{
?>
 <tr class="Dark" height="20">
          <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   <td align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
          <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $lotno;?></td>
          <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $oldlot;?></td>
          <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $tp;?></td>
          <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $spcodef;?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $spcodem;?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
      <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
          <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $gi;?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $loc;?></td>
          <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $per;?></td>
          <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $organizer;?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $farmer;?></td>
          <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $plotn?></td>
		   <td align="center" valign="top" class="tblheading"><?php echo $lotstat;?></td>
        </tr>
<?php
}
$srno++;
}
}
}
else if($typ=="specifylot")
{

		$sql_cls=mysqli_query($link,"SELECT * FROM tbllot where plantcode='".$plantcode."' and lotnumber='$lot' order by lotno Asc") or die(mysqli_error($link));

$srno=1; $ordate="";$orstatus="";

while($row_cls=mysqli_fetch_array($sql_cls))
{

	$sql_arr_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   lotnoid='".$row_cls['id']."'") or die(mysqli_error($link));
	$row_sub=mysqli_fetch_array($sql_arr_sub);
	
	if($trvflag=="Yes" || $role=="admin")
	{	
	$sql_arr=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   arid='".$row_sub['arid']."'") or die(mysqli_error($link));
	$tot_arr=mysqli_num_rows($sql_arr);
	}
	else
	{
	$sql_arr=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   arid='".$row_sub['arid']."' and logid='".$logid."'") or die(mysqli_error($link));
	$tot_arr=mysqli_num_rows($sql_arr);
	}
	if($tot_arr > 0)
	{
	$row_arr=mysqli_fetch_array($sql_arr);
	$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr['cropid']."'") or die(mysqli_error($link));
	$row_class=mysqli_fetch_array($sql_class);
	
	$sql_item1=mysqli_query($link,"select * from tblfarmer where farmerid='".$row_sub['farmerid']."'") or die(mysqli_error($link));
	$row_item1=mysqli_fetch_array($sql_item1);
	
	$sql_item=mysqli_query($link,"select * from tblorganiser where plantcode='".$plantcode."' and orgid='".$row_sub['orgid']."'") or die(mysqli_error($link));
	$row_item=mysqli_fetch_array($sql_item);
	
	$sql_pro=mysqli_query($link,"select * from tblproductionpersonnel where plantcode='".$plantcode."' and productionpersonnelid='".$row_arr['productionpersonnelid']."'") or die(mysqli_error($link));
	$row_pro=mysqli_fetch_array($sql_pro);
	
	$sql_pp=mysqli_query($link,"select * from tblproductionlocation where productionlocationid ='".$row_arr['productionlocationid']."'") or die(mysqli_error($link));
	$row_pp=mysqli_fetch_array($sql_pp);
	
	$tp="";$crop="";
				if($row_arr['trtype']=="freshpdn")
				{
					$tp="Fresh Seed with PDN";
					$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr['cropid']."'") or die(mysqli_error($link));
					$row_class=mysqli_fetch_array($sql_class);
					$crop=$row_class['cropname'];
				}
				else if($row_arr['trtype']=="Trading")
				{
					$tp="Trading";
					$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr['cropid']."'") or die(mysqli_error($link));
					$row_class=mysqli_fetch_array($sql_class);
					$crop=$row_class['cropname'];
				}
				else if($row_arr['trtype']=="UnidentifiedArrival")
				{
					$tp="Unidentified";
					$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_sub['cropid']."'") or die(mysqli_error($link));
					$row_class=mysqli_fetch_array($sql_class);
					$crop=$row_class['cropname'];
				}
				else if($row_arr['trtype']=="Existing")
				{
					$tp="Lot regularisation" ;
					$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr['cropid']."'") or die(mysqli_error($link));
					$row_class=mysqli_fetch_array($sql_class);
					$crop=$row_class['cropname'];
				}
				else if($row_arr['trtype']=="LotMerger")
				{
					$tp="Lot Merger";
					$sql_class=mysqli_query($link,"select * from tblcrop where cropid='".$row_arr['cropid']."'") or die(mysqli_error($link));
					$row_class=mysqli_fetch_array($sql_class);
					$crop=$row_class['cropname'];
				}
				else
				{
				$tp="";
				$crop="";
				}
				
				$tp1="";	$tp1="";
			if($row_cls['impflg'] ==0) { $tp1="IMP-No";}
			else if($row_cls['impflg'] ==1) { $tp1="IMP-Yes";}
			else if($row_cls['impflg'] ==2) { $tp1="SUSPENDED";}
	
	$lotstat=$tp1;


$spcodef = $row_arr['spcodef'];
$spcodem = $row_arr['spcodem'];
$loc=$row_pp['productionlocation'];
$per=$row_pro['productionpersonnel'];
//$crop=$row_class1['cropname'];
$variety=$row0['popularname'];
$lotno=$row_cls['lotnumber'];
$gi=$row_arr['gi'];
if($row_arr['trtype']=="Trading" || $row_arr['trtype']=="Existing")
{
$oldlot = $row_sub['oldlot'];
}
else
{
$oldlot = $row_arr['oldlot'];
}
$lotmerging=$row_arr['nooflots'];
$organizer=$row_item['orgname'];
$farmer=$row_item1['farmername'];
$plotn=$row_sub['plotno'];

	$trdate=$row_arr['ardate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;				
				
if($srno%2!=0)
{
?>

        <tr class="Light" height="20">
          <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   <td align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
          <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $lotno;?></td>
          <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $oldlot;?></td>
          <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $tp;?></td>
          <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $spcodef;?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $spcodem;?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
    <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
          <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $gi;?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $loc;?></td>
          <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $per;?></td>
          <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $organizer;?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $farmer;?></td>
          <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $plotn?></td>
		   <td align="center" valign="top" class="tblheading"><?php echo $lotstat;?></td>
        </tr>
<?php
}
else
{
?>
 <tr class="Dark" height="20">
          <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   <td align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
          <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $lotno;?></td>
          <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $oldlot;?></td>
          <td width="7%" align="center" valign="middle" class="tblheading"><?php echo $tp;?></td>
          <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $spcodef;?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $spcodem;?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
      <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
          <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $gi;?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $loc;?></td>
          <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $per;?></td>
          <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $organizer;?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $farmer;?></td>
          <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $plotn?></td>
		   <td align="center" valign="top" class="tblheading"><?php echo $lotstat;?></td>
        </tr>
</table>
<br/>
<?php
}
 $srno++;
 }
 }
 }
else
{
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="950" style="border-collapse:collapse">
  	<tr class="Dark" height="30">
	<td width="950" align="left"  valign="middle" class="tblheading">&nbsp;Lot Number not found.</td>
	</tr>
</table>
<?php
}
?>
</form>

		  
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td align="right" valign="top"><a href="utility_lot.php"><img src="../images/vista_back.jpg" height="30" border="0"  style="display:inline;cursor:pointer;" class="butn"/></a>&nbsp;&nbsp;<!--<input name="Submit" type="image" src="../images/printpreview.gif" alt="" border="0" style="display:inline;cursor:pointer;" onclick="openprint('lotid=<?php echo $lot?>');">-->&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
</td><td width="30"></td>
</tr>
</table>


</body>
</html>
