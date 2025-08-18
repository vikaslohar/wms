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

if(isset($_GET['a']))
	{
   $a = $_GET['a'];	 
	}
if(isset($_GET['b']))
	{
 $b = $_GET['b'];	 
	}



	/*
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$a."'"); 
	$row31=mysqli_fetch_array($quer3);
	 $rowpp=$row31['cropname'];
	
	$quer3=mysqli_query($link,"SELECT * from tblvariety where varietyid ='".$b."'"); 
	$row=mysqli_fetch_array($quer3);
	  $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$b;
	 }
	 else
	 {
	 $vv=$tt;
	  }

	
				
		$ddate1=$date;
		$dday1=substr($ddate1,0,2);
		$dmonth1=substr($ddate1,3,2);
		$dyear1=substr($ddate1,6,4);
		$ddate1=$dyear1."-".$dmonth1."-".$dday1;*/
			

?>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse"  cols="2">
  <tr class="tblsubtitle">
    <td width="66" align="center" valign="middle" class="tblheading" >#</td>
	<td width="281" align="center" valign="middle" class="tblheading">Crop</td>
	  <td width="265" align="center" valign="middle" class="tblheading">Variety</td>
	   <td width="228" align="center" valign="middle" class="tblheading">Lot No.</td>
  </tr>
 
  <?php
 
$srno=1;
 
 
//echo $a; echo $b;
  //$wh=""; $binn=""; $slocs="";

$sql_wh=mysqli_query($link,"select whid, perticulars from tblwarehouse where whid='".$b."' order by perticulars") or die(mysqli_error($link));
$row_wh=mysqli_fetch_array($sql_wh);
$tot_row1=mysqli_num_rows($sql_wh);
 
$sql_bn=mysqli_query($link,"select binid, binname from tblbin  where binid='".$a."'") or die(mysqli_error($link));
$row_bn=mysqli_fetch_array($sql_bn);
  $tot_row11=mysqli_num_rows($sql_bn);
 
$wh1=""; $binn1=""; $slocs1="";

 $wh=$row_wh['perticulars']."/";
 $binn=$row_bn['binname'];
 $slocs=$wh.$binn;
$lotqry=mysqli_query($link,"select * from tbl_gsample where gswh ='".$b."' and gsbin='".$a."' order by gsid")or die (mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);
while($row2=mysqli_fetch_array($lotqry))
	{
 $wh1=$row2['gswhn'];
$binn1=$row2['gsbinn'];
 $crp=$row2['gscrop'];
 $vv=$row2['gsvariety'];
 $lot=$row2['lotno'];
if($srno%2!=0)
{

?> <tr class="Light" height="30">
   <td width="66" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tblwarehouse order by perticulars") or die(mysqli_error($link));
?>

   <td width="281"  align="center"  valign="middle">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="265"  align="center"  valign="middle">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="228"  align="center"  valign="middle">&nbsp;<?php echo $lot;?>&nbsp;</td>

		  <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin") or die(mysqli_error($link));
?>
   
            
  </tr>
 <?php
}
else
{
?>
  <tr class="Light" height="30">
    <td width="66" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tblwarehouse order by perticulars") or die(mysqli_error($link));
?>
   
     <td width="281"  align="center"  valign="middle">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="265"  align="center"  valign="middle">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="228"  align="center"  valign="middle">&nbsp;<?php echo $lot;?>&nbsp;</td>
	
		  <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin") or die(mysqli_error($link));
?>
   
       
  </tr>

<?php
}
$srno=$srno+1;
}
 
?>
 </table><br />

           <table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704"  style="border-collapse:collapse"  > 
 <tr class="tblsubtitle" height="25"><td colspan="4" align="center" valign="middle" class="tblheading">New SLOC</td></tr>
 
  				<tr class="Dark" height="25">
				<td width="206" height="30" align="right" valign="middle" class="tblheading">Select Ware House&nbsp;</td>
  <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tblwarehouse order by perticulars");
?>                 
				<td width="167"  align="left"  valign="middle">&nbsp;<select class="tbltext" name="txtslwhg222" style="width:80px;" onChange="wh2(this.value);"   >
            <option value="" selected>-----WH---</option>
            <?php while($noticia_whg2=mysqli_fetch_array($whg1_query)) { ?>
            <option value="<?php echo $noticia_whg2['whid'];?>" />    
            <?php echo $noticia_whg2['perticulars'];?>
            <?php } ?>
    </select><font color="#FF0000">*</font>&nbsp;</td>
	  <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin") or die(mysqli_error($link));
?>
    <td width="190" height="30" align="right" valign="middle" class="tblheading">Select Bin&nbsp;</td>
                  
       <td width="272"  align="left"  valign="middle" class="tbltext" id="bing222">&nbsp;<select class="tbltext" name="txtslbing222" style="width:80px;"  >
          <option value="" selected>------Bin-------</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	
	</tr>
</table>