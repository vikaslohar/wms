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
?>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse"  cols="2">
  <tr class="tblsubtitle">
    <td width="30" align="center" valign="middle" class="tblheading" >#</td>
	<td width="58" align="center" valign="middle" class="tblheading" >Selection</td>
	 <td width="204" align="center" valign="middle" class="tblheading">Crop</td>
	  <td width="140" align="center" valign="middle" class="tblheading">Variety</td>
	   <td width="135" align="center" valign="middle" class="tblheading">Lot no.</td>
       <td align="center" valign="middle" class="tblheading" colspan="10">New SLOC </td>
  </tr>
 
  <?php
 
$srno=1;
 
$lotqry=mysqli_query($link,"select * from tbl_gsample where gswh ='".$b."' and gsbin='".$a."' and gsdisflg=0 order by gsid")or die (mysqli_error($link));
$tot_row=mysqli_num_rows($lotqry);
while($row2=mysqli_fetch_array($lotqry))
	{
	
 $wh1=$row2['gswh'];
$binn1=$row2['gsbin'];
$aa=$row2['gsid'];
 $crp=$row2['gscrop'];
 $vv=$row2['gsvariety'];
 $lot=$row2['lotno'];
if($srno%2!=0)
{

?> <tr class="Light" height="30">
   <td width="30" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtlotno"  type="checkbox" size="15" class="tbltext"  maxlength="15" style="background-color:#CCCCCC" onclick="chk2('<?php echo $srno?>',this.value)"  id="fetchk_<?php echo $srno?>" value="<?php echo $aa?>"/><input type="hidden" name="a<?php echo $srno;?>" id="a<?php echo $srno;?>" value="<?php echo $wh1;?>" /><input type="hidden" name="b<?php echo $srno;?>" id="b<?php echo $srno;?>" value="<?php echo $binn1;?>" /></td>

   <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tblwarehouse order by perticulars") or die(mysqli_error($link));
?>

     <td width="204"  align="center"  valign="middle">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="140"  align="center"  valign="middle">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="135"  align="center"  valign="middle">&nbsp;<?php echo $lot;?>&nbsp;</td>
	 <td colspan="3" align="left"  valign="middle">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:80px;" onchange="wh1(this.value, <?php echo $srno?>);"  disabled="disabled"  id="rn1_<?php echo $srno?>" >
            <option value="" selected>--WH--</option>
            <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
            <option value="<?php echo $noticia_whg1['whid'];?>" />    
            <?php echo $noticia_whg1['perticulars'];?>
            <?php } ?>
    </select><font color="#FF0000">*</font>&nbsp;</td>
		  <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin") or die(mysqli_error($link));
?>
   
       <td width="124" colspan="3" align="left"  valign="middle" class="tbltext" id="bing_<?php echo $srno?>">&nbsp;<select class="tbltext" name="txtslbing1" style="width:80px;" onchange="bin1(this.value);"  disabled="disabled" id="rn2_<?php echo $srno?>" >
          <option value="" selected>--Bin--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
     
  </tr>
 <?php
}
else
{
?>
  <tr class="Light" height="30">
    <td width="30" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtlotno"  type="checkbox" size="15" class="tbltext"  maxlength="15" style="background-color:#CCCCCC" onclick="chk2('<?php echo $srno?>',this.value)"  id="fetchk_<?php echo $srno?>" value="<?php echo $aa?>"/><input type="hidden" name="a<?php echo $srno;?>" id="a<?php echo $srno;?>" value="<?php echo $wh1;?>" /><input type="hidden" name="b<?php echo $srno;?>" id="b<?php echo $srno;?>" value="<?php echo $binn1;?>" /></td>
<?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tblwarehouse order by perticulars") or die(mysqli_error($link));
?>
   
	 <td width="204"  align="center"  valign="middle">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="140"  align="center"  valign="middle">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="135"  align="center"  valign="middle">&nbsp;<?php echo $lot;?>&nbsp;</td>
	 <td colspan="3" align="left"  valign="middle">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:80px;" onchange="wh1(this.value, <?php echo $srno?>);"  disabled="disabled"  id="rn1_<?php echo $srno?>" >
            <option value="" selected>--WH--</option>
            <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
            <option value="<?php echo $noticia_whg1['whid'];?>" />    
            <?php echo $noticia_whg1['perticulars'];?>
            <?php } ?>
    </select><font color="#FF0000">*</font>&nbsp;</td>
		  <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin") or die(mysqli_error($link));
?>
   
       <td width="124" colspan="3" align="left"  valign="middle" class="tbltext" id="bing_<?php echo $srno?>">&nbsp;<select class="tbltext" name="txtslbing1" style="width:80px;" onchange="bin1(this.value);"  disabled="disabled" id="rn2_<?php echo $srno?>" >
          <option value="" selected>--Bin--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>

<?php
}
$srno=$srno+1;
}
 
?><input type="hidden" name="srno" value="<?php echo $srno;?>" />
 </table>
  
