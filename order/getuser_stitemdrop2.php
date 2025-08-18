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
	}require_once("../include/config.php");
	require_once("../include/connection.php");

if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}
/*if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}
if(isset($_GET['c']))
	{
	$c = $_GET['c'];	 
	}
*/
	//if($a==1)
	//{
	//$a=13;
	//}
//$flag=0; 
//echo $a;
/*$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$a."' order by cropname Asc"); 
$noticia = mysqli_fetch_array($quer3);
 $crop=$noticia['cropname'];*/

$sql_month=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_ncode='".$a."' order by orderm_ncode")or die(mysqli_error($link));
$row= mysqli_fetch_array($sql_month);
  $variety=$row['orderm_ncode'];
//$row_month=mysqli_fetch_array($sql_month);
 $tt=mysqli_num_rows($sql_month);
if($tt > 0)
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse" id="vitem">
<tr class="tblsubtitle" height="25">
			<td width="17" align="center" valign="middle" class="tblheading">#</td>
			<td width="90"  align="center" valign="middle" class="tblheading">Order Date</td>
			<td width="80"  align="center" valign="middle" class="tblheading">Order No.</td>
				<td width="68" align="center" valign="middle" class="tblheading">Order Type </td>
			    <td width="105"  align="center" valign="middle" class="tblheading">Party</td>
			    <td width="117" align="center" valign="middle" class="tblheading">Detail</td>
			    <td width="84" align="center" valign="middle" class="tblheading">Status</td>
	        <!--<td width="53" align="center" valign="middle" class="tblheading">GOT Status</td>
            <td width="40" align="center" valign="middle" class="tblheading">Status</td>-->
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
	$arrival_id=$row_arr_home['arrival_id'];
	
	
	$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='$plantcode' and arrival_id='".$arrival_id."'") or die(mysqli_error($link));
			 $subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc=""; $sstatus=""; $loc1=""; $per="";$per1="";
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_tbl_sub['lotcrop'];
		// $row_tbl_sub['lotcrop'];
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
		$got=$got."<br>".$row_tbl_sub['got1'];
		}
		else
		{
		$got=$row_tbl_sub['got1'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_tbl_sub['sstage'];
		}
		else
		{
		$stage=$row_tbl_sub['sstage'];
		}
		if($row_tbl_sub['vchk'] =="Acceptable") { $per="Acc";}
		else	if($row_tbl_sub['vchk'] =="Not-Acceptable") { $per="NAcc";}
		if($per1!="")
		{
		$per1=$per1."<br>".$row_tbl_sub['moisture'];
		}
		else
		{
		$per1=$row_tbl_sub['moisture'];
		}
		if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_tbl_sub['ploc'];
		}
		else
		{
		$loc1=$row_tbl_sub['ploc'];
		}
		if($sstatus!="")
		{
		$sstatus=$sstatus."<br>".$row_tbl_sub['sstatus'];
		}
		else
		{
		$sstatus=$row_tbl_sub['sstatus'];
		}
	 //$row_tbl_sub['arrsub_id'];
	if($srno%2!=0)
{

	
?>

	  

<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			  <td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
         <td width="80" align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
		   <td width="68" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
         <td width="105" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
             <td width="71" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
                <!--
			<td align="center" valign="middle" class="smalltbltext"><?php echo $loc1;?></td>	
			<td width="56" align="center" valign="middle" class="smalltbltext"><?php echo $qc?></td>-->
		
		
            <td align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
		</tr
>
<?php
}
else
{
?>
<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			  <td width="90" align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
         <td width="80" align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
		   <td width="68" align="center" valign="middle" class="smalltbltext"><?php echo $stage?></td>
         <td width="105" align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
             <td width="71" align="center" valign="middle" class="smalltbltext"><?php echo $slocs;?></td>
		 	<td align="center" valign="middle" class="smalltbltext"><?php echo $loc1;?></td>
			<!--<td align="center" valign="middle" class="smalltbltext"><?php echo $got?></td>
				<td align="center" valign="middle" class="smalltbltext"><?php echo $sstatus;?></td>-->
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
</table>
<table align="center" width="574" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center">&nbsp;&nbsp;<img src="../images/next.gif" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;"><input type="hidden" name="typ" value="" /></td>
</tr>
</table>
<?php
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="574" bordercolor="#cc30cc" style="border-collapse:collapse">

                <tr class="Light" height="25">
	<td align="left"  valign="middle" class="tblheading" >&nbsp;Record Not Found.</td>
                </tr>
</table>
<?php
}
?><input type="hidden" name="typ" value="" />