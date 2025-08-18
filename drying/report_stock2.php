<?php
	/*session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}*/
	require_once("../include/config.php");
	require_once("../include/connection.php");
	if(isset($_REQUEST['sdate']))
	{
  $sdate = $_REQUEST['sdate'];
	}
	
	if(isset($_REQUEST['edate']))
	{
	  $edate = $_REQUEST['edate'];
	}
		
	
	 if(isset($_GET['print']))
	{
	 $print = $_GET['print'];
	 if($print=='add')
	 {
	   $pr="Record Added Successfully";
	 }
	 
	}
	if(isset($_POST['frm_action'])=='submit')
	{
		/*$classification=trim($_POST['txtcla']);
		//$cropshort=strtoupper(trim($_POST['txtcropshort']));
		
	$query=mysqli_query($link,"select * from tbl_classification where plantcode='".$plantcode."' and   classification='$classification'") or die("Error: " . mysqli_error($link));
   		$numofrecords=mysqli_num_rows($query);
	 	 if( $numofrecords > 0)
		 {?>
		 <script>
		  alert("This Classification is Already Present.");
		  </script>
		 <?php }
		 else 
		 {
		$sql_in="insert into tblclassification(classification) values(
											  '$class'
												)";
											
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{
			echo "<script>window.location='home_classification.php'</script>";	
		}
		}*/
}

?>

<link href="../include/vnrtrac_drying.css" rel="stylesheet" type="text/css" />
<?php 


/*$sql_arr_home=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   arrival_type='Fresh Seed with PDN' and arrtrflag=1") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
*/
$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
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
		
	$sql_arr_home=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   arrival_type='StockTransfer Arrival' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and arrtrflag=1 order by arrival_date asc ") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
	
	  
?>

<title>Drying-Report-</title><table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="527" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<!--&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;&-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="974" style="border-collapse:collapse">
   <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination Report:</td>
  	</tr>-->
  	<tr height="25">
    <td align="center" class="subheading" style="color:#303918; ">Date From: <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'];?></td>
  	</tr>
  <!--	<tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">Lot Destination: <?php echo $cls['dest'];?></td>
  	</tr>-->
	
</table>
  
  <table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#adad11" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="2%"align="center" valign="middle" class="tblheading">#</td> 
			   <td width="5%" align="center" valign="middle" class="tblheading">Date</td>
			 <td width="9%" align="center" valign="middle" class="tblheading">Transaction Id</td>
              <td width="13%" align="center" valign="middle" class="tblheading">Stock Transfer from Plant</td>
			  <td align="right"  valign="middle" class="tblheading">Stock Tranasfer To Plant &nbsp;</td>
			
              <td width="8%" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="13%" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="6%" align="center" valign="middle" class="tblheading">Lot No.</td>
              <td width="6%" align="center" valign="middle" class="tblheading">Bags</td>
              <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
              <td width="6%" align="center" valign="middle" class="tblheading">Stage</td>
			              <td align="center" valign="middle" class="tblheading">QC</td>
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
	$arrival_id=$row_arr_home['arrival_id'];
	
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{

$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['lotcrop'];
		}
		else
		{
		$crop=$row_tbl_sub['lotcrop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_tbl_sub['lotvariety'];
		}
		else
		{
		$variety=$row_tbl_sub['lotvariety'];	
		}
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['lotno'];
		}
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
		if($qc!="")
		{
		$qc=$qc."<br>".$row_tbl_sub['qc'];
		}
		else
		{
		$qc=$row_tbl_sub['qc'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_tbl_sub['got'];
		}
		else
		{
		$got=$row_tbl_sub['got'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_arr_home['sstage'];
		}
		else
		{
		$stage=$row_arr_home['sstage'];
		}
	}
	$trdate=$row_arr_home['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	
/*	 $tdate11=$row_tbl['dc_date'];
		$tday1=substr($tdate11,0,4);
		$tmonth1=substr($tdate11,5,2);
		$tyear1=substr($tdate11,8,2);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;*/

$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name FROM tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['lotvariety']."'  and vertype='PV'"); 
	$rowvv=mysqli_fetch_array($quer3);
	
	
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['lotcrop']."'"); 
	$row31=mysqli_fetch_array($quer3);
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 



		$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$city1=$row_cls['pcity'];
		$plname=$row_cls['company_name'];

if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="9%" align="center" valign="middle" class="tblheading"><?php echo "TAS".$row_arr_home['arr_code']."/".$yearid_id."/".$lrole;?></td>
		  <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $plname.", ".$city1;?></td>
         <td width="17%" align="center" valign="middle" class="tblheading"><?php echo $row3['business_name'];?></td>
       
         <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $rowvv['popularname']?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
              <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $qc?></td>
    </tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		   <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="9%" align="center" valign="middle" class="tblheading"><?php echo "TAS".$row_arr_home['arr_code']."/".$yearid_id."/".$lrole;?></td>
         <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $row3['business_name'];?></td>
		 <td width="17%" align="center" valign="middle" class="tblheading"><?php echo $plname.", ".$city1;?></td>
               <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="13%" align="center" valign="middle" class="tblheading"><?php echo $rowvv['popularname']?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $bags?></td>
         <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $qty?></td>
         <td width="6%" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
                <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $qc?></td>
    </tr>
<?php
}
$srno=$srno+1;
}
}
//}
//}
?>
          </table>			
  <br/>
<table width="850" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="550" align="right">&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;<!--&nbsp;&nbsp;<a href="word_class.php?classification_id=<?php echo $classification_id?>"><img src="../images/mswordicon.jpg" border="0" class="butn" height="30" width="30" alt="Export to MS-Word" /></a>&nbsp;&nbsp;-->&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>