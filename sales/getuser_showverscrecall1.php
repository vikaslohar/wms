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

	if(isset($_REQUEST['a']))
	{
		$txtpsrn = $_REQUEST['a'];
	}
	if(isset($_REQUEST['b']))
	{
		$trrid = $_REQUEST['b'];
	}
	if(isset($_REQUEST['c']))
	{
		$crop = $_REQUEST['c'];
	}
	if(isset($_REQUEST['f']))
	{
		$variety = $_REQUEST['f'];
	}
	if(isset($_REQUEST['g']))
	{
		$upsize = $_REQUEST['g'];
	}
	if(isset($_REQUEST['h']))
	{
		$typ = $_REQUEST['h'];
	}
	if(isset($_REQUEST['l']))
	{
		$bpch = $_REQUEST['l'];
	}
		
$sql_tbl=mysqli_query($link,"select * from tbl_salesrv where plantcode='$plantcode' AND salesr_id='".$trrid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['salesr_id'];
$ltnn=sprintf("%00005d",$row_tbl['salesr_tslrno']);
$tid=$arrival_id;
$subtid=0;
$subsubtid=0;


$sql_tbl_sub=mysqli_query($link,"select * from tbl_salesrv_sub where plantcode='$plantcode' AND salesrs_id='".$a."'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
$tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
$tid=$row_tbl_sub['salesr_id'];
$subtid=$a;


$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_tbl_sub['salesrs_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
		
$quer4=mysqli_query($link,"SELECT * FROM tblvariety  where varietyid='".$row_tbl_sub['salesrs_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);

	$wtmp="";$mptnop=""; $srnonew=0;
	$p1_array=explode(",",$noticia_item['gm']);
	$p1_array2=explode(",",$noticia_item['wtmp']);
	$p1_array3=explode(",",$noticia_item['mptnop']);
	$p1=array();
	foreach($p1_array as $val1)
	{
		if($val1<>"")
		{
			$sql_sel="select * from tblups where uid='".$val1."' order by uom Asc";
			$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
			$row12=mysqli_fetch_array($res);
			$ups=$row12['ups']." ".$row12['wt'];
			if($ups==$row_tbl_sub['salesrs_ups'])
			{
				$wtmp=$p1_array2[$srnonew];
				$mptnop=$p1_array3[$srnonew];
			}
			$srnonew++;
		}
	}
	
	$packtp=explode(" ",$row_tbl_sub['salesrs_ups']);
	$packtyp=$packtp[0]; 
	$ptp=""; $ptp1="";
	if($packtp[1]=="Gms")
	{ 
		$ptp=(1000/$packtp[0]);
		$ptp1=($packtp[0]/1000);
	}
	else
	{
		$ptp=$packtp[0];
		$ptp1=$packtp[0];
	}

?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15">
<td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
</tr>
<?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
$row_month=mysqli_fetch_array($quer6);
$a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>	
<tr class="Light" height="30" >
<td width="115" align="right"  valign="middle" class="tblheading">Lot Number&nbsp;</td>
<td align="left" width="849" valign="middle" class="smalltbltext" colspan="5">&nbsp;<select class="smalltbltext" name="pcodeo" style="width:40px;">
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
    <?php } ?></select><input name="txtlot2o" type="text" size="4" class="smalltbltext"  maxlength="5" onkeypress="return isNumberKey(event)" onchange="lot2chko();"  /> <font size="+1"><b>/</b></font> <input name="stcodeo" type="text" size="4" class="smalltbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="" onchange="stchko();" /> <font size="+1"><b>/</b></font> <input name="stcode2o" type="text" size="2" class="smalltbltext" tabindex="0" maxlength="2"  value="00" onchange="stchko2();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
</table>	
<div id="crpvershow" style="display:block"></div>
<div id="subsubdivgood" style="display:block"><div id="subsubdivdamage" style="display:block"></div></div>
<input type="hidden" name="maintrid" value="<?php echo $trrid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" /><input type="hidden" name="ptp" value="<?php echo $ptp;?>" /><input type="hidden" name="ptp1" value="<?php echo $ptp1;?>" /><input type="hidden" name="wtmp" id="wtmp" value="<?php echo $wtmp;?>" /><input type="hidden" name="wtnop" id="wtnop" value="<?php echo $mptnop;?>" /><input type="hidden" name="ocrp" value="<?php echo $crop?>" /><input type="hidden" name="overty" value="<?php echo $variety?>" /><input type="hidden" name="vtyp" value="<?php echo $typ?>" /><input type="hidden" name="oups" value="<?php echo $upsize?>" />
