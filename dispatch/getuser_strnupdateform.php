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

if(isset($_REQUEST['txtid'])) { $txtid = $_REQUEST['txtid']; }
if(isset($_REQUEST['date'])) { $date = $_REQUEST['date']; }
if(isset($_REQUEST['txtstfp'])) { $txtstfp= $_REQUEST['txtstfp']; }
if(isset($_REQUEST['txtcrop'])) { $txtcrop = $_REQUEST['txtcrop'];	}
if(isset($_REQUEST['txtvariety'])) { $txtvariety = $_REQUEST['txtvariety']; }
if(isset($_REQUEST['txtstage'])) { $txtstage = $_REQUEST['txtstage']; }
if(isset($_REQUEST['txtlot1'])) { $txtlot1 = $_REQUEST['txtlot1']; }
if(isset($_REQUEST['sn'])) { $sn = $_REQUEST['sn']; }
if(isset($_REQUEST['txtremarks'])) { $txtremarks= $_REQUEST['txtremarks']; }
$txtremarks=str_replace("&","and",$txtremarks);

if(isset($_REQUEST['txt11'])) { $txt11=$_REQUEST['txt11']; }
if(isset($_REQUEST['txttname'])) { $txttname=$_REQUEST['txttname']; }
if(isset($_REQUEST['txtlrn'])) { $txtlrn=$_REQUEST['txtlrn']; }
if(isset($_REQUEST['txtvn'])) { $txtvn=$_REQUEST['txtvn']; }
if(isset($_REQUEST['txt13'])) { $txt13=$_REQUEST['txt13']; }
if(isset($_REQUEST['txtcname'])) { $txtcname=$_REQUEST['txtcname']; }
if(isset($_REQUEST['txtdc'])) { $txtdc=$_REQUEST['txtdc']; }
if(isset($_REQUEST['txtpname'])) { $txtpname=$_REQUEST['txtpname']; }
	
if(isset($_REQUEST['maintrid'])) { $maintrid= $_REQUEST['maintrid']; }
if(isset($_REQUEST['subtrid'])) { $subtrid= $_REQUEST['subtrid']; }
	
//frm_action=submit&txt11=&txt14=&txtid=1&logid=DP1&date=19-12-2014&txtstfp=401&txtcrop=51&txtvariety=528&txtstage=Condition&txtlot1=DF90175%2F00000%2F00C%2CDF90324%2F00000%2F00C%2CDF90351%2F00000%2F00C%2CDF90352%2F00000%2F00C%2CDF90353%2F00000%2F00C%2CDF90354%2F00000%2F00C%2CDF90355%2F00000%2F00C%2CDF90376%2F00000%2F00C&ecrop1=51&evariety1=528&eltno1=DF90175%2F00000%2F00C&estage1=Condition&eqc1=OK&edot1=29-09-2014&epp1=Acceptable&emoist1=7.90&egemp1=88&egotyp1=GOT-NR&egot1=OK&edogt1=13-09-2014&enob1=1&eqty1=30&ecrop2=51&evariety2=528&eltno2=DF90324%2F00000%2F00C&estage2=Condition&eqc2=OK&edot2=28-11-2014&epp2=Acceptable&emoist2=9.00&egemp2=78&egotyp2=GOT-NR&egot2=OK&edogt2=19-11-2014&enob2=8&eqty2=470&ecrop3=51&evariety3=528&eltno3=DF90351%2F00000%2F00C&estage3=Condition&eqc3=UT&edot3=&epp3=Acceptable&emoist3=&egemp3=&egotyp3=GOT-NR&egot3=OK&edogt3=02-12-2014&enob3=24&eqty3=935&ecrop4=51&evariety4=528&eltno4=DF90352%2F00000%2F00C&estage4=Condition&eqc4=UT&edot4=&epp4=Acceptable&emoist4=&egemp4=&egotyp4=GOT-NR&egot4=OK&edogt4=02-12-2014&enob4=24&eqty4=939&ecrop5=51&evariety5=528&eltno5=DF90353%2F00000%2F00C&estage5=Condition&eqc5=UT&edot5=&epp5=Acceptable&emoist5=&egemp5=&egotyp5=GOT-NR&egot5=OK&edogt5=02-12-2014&enob5=24&eqty5=942&ecrop6=51&evariety6=528&eltno6=DF90354%2F00000%2F00C&estage6=Condition&eqc6=UT&edot6=&epp6=Acceptable&emoist6=&egemp6=&egotyp6=GOT-NR&egot6=OK&edogt6=02-12-2014&enob6=25&eqty6=970&ecrop7=51&evariety7=528&eltno7=DF90355%2F00000%2F00C&estage7=Condition&eqc7=UT&edot7=&epp7=Acceptable&emoist7=&egemp7=&egotyp7=GOT-NR&egot7=OK&edogt7=03-12-2014&enob7=24&eqty7=956&ecrop8=51&evariety8=528&eltno8=DF90376%2F00000%2F00C&estage8=Condition&eqc8=UT&edot8=&epp8=Acceptable&emoist8=&egemp8=&egotyp8=GOT-NR&egot8=OK&edogt8=05-12-2014&enob8=16&eqty8=612&sn=9&maintrid=0&maintrid=0&subtrid=0&txtremarks=test

	$z1=$maintrid;
		
	$tdate11=$date;
	$tday1=substr($tdate11,0,2);
	$tmonth1=substr($tdate11,3,2);
	$tyear1=substr($tdate11,6,4);
	$tdate1=$tyear1."-".$tmonth1."-".$tday1;
	
	$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
	$row_month=mysqli_fetch_array($quer6);
	$pltcode=$row_month['code'];
	
	$quer5=mysqli_query($link,"SELECT distinct stcode FROM tbl_partymaser where p_id='$txtstfp' order by stcode asc"); 
	$noticia2 = mysqli_fetch_array($quer5); 
	$plantcodes=$noticia2['stcode'];
		
if($z1 == 0)
{
   $sql_main="insert into tbl_stoutm(stoutm_tcode, stoutm_date, stoutm_fromplant, stoutm_toplant, stoutm_plant, stoutm_ramarks, stoutm_logid, stoutm_yearid, tmode, trans_name, trans_lorryrepno, trans_vehno, trans_paymode, courier_name, docket_no, pname_byhand,plantcode) values ('$txtid','$tdate1','$pltcode','$plantcodes','$txtstfp','$txtremarks', '$logid', '$yearid_id', '$txt11', '$txttname', '$txtlrn', '$txtvn', '$txt13', '$txtcname', '$txtdc', '$txtpname','$plantcode')";
if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
	$mainid=mysqli_insert_id($link);
	for($j=1; $j<$sn; $j++)
	{
		$eltnox="eltno".$j;
		$estagex="estage".$j;
		$eqcx="eqc".$j;
		$edotx="edot".$j;
		$eppx="epp".$j;
		$emoistx="emoist".$j;
		$egempx="egemp".$j;
		$egotypx="egotyp".$j;
		$egotx="egot".$j;
		$edogtx="edogt".$j;
		$enobx="enob".$j;
		$eqtyx="eqty".$j;
		if(isset($_REQUEST[$eltnox])) { $eltno= $_REQUEST[$eltnox]; }
		if(isset($_REQUEST[$estagex])) { $estage= $_REQUEST[$estagex]; }
		if(isset($_REQUEST[$eqcx])) { $eqc= $_REQUEST[$eqcx]; }
		if(isset($_REQUEST[$edotx])) { $edot= $_REQUEST[$edotx]; }
		if(isset($_REQUEST[$eppx])) { $epp= $_REQUEST[$eppx]; }
		if(isset($_REQUEST[$emoistx])) { $emoist= $_REQUEST[$emoistx]; }
		if(isset($_REQUEST[$egempx])) { $egemp= $_REQUEST[$egempx]; }
		if(isset($_REQUEST[$egotypx])) { $egotyp= $_REQUEST[$egotypx]; }
		if(isset($_REQUEST[$egotx])) { $egot= $_REQUEST[$egotx]; }
		if(isset($_REQUEST[$edogtx])) { $edogt= $_REQUEST[$edogtx]; }
		if(isset($_REQUEST[$enobx])) { $enob= $_REQUEST[$enobx]; }
		if(isset($_REQUEST[$eqtyx])) { $eqty= $_REQUEST[$eqtyx]; }
		if($edot!="")
		{
			$tdate=$edot;
			$tday=substr($tdate,0,2);
			$tmonth=substr($tdate,3,2);
			$tyear=substr($tdate,6,4);
			$edot=$tyear."-".$tmonth."-".$tday;
		}
		if($edogt!="")
		{
			$tdate12=$edogt;
			$tday12=substr($tdate12,0,2);
			$tmonth12=substr($tdate12,3,2);
			$tyear12=substr($tdate12,6,4);
			$edogt=$tyear12."-".$tmonth12."-".$tday12;
		}
		
		if($eqty!="" || $eqty>0)
		{
			$sql_subsub4="insert into tbl_stouts (stoutm_id, stouts_crop, stouts_variety, stouts_stage, stouts_lotno, stouts_nob, stouts_qty, stouts_qc, stouts_dot, stouts_pp, stouts_moist, stouts_germ, stouts_gottype, stouts_got, stouts_dogt,plantcode) values ('$mainid', '$txtcrop', '$txtvariety', '$estage', '$eltno', '$enob', '$eqty', '$eqc', '$edot', '$epp', '$emoist', '$egemp', '$egotyp', '$egot', '$edogt','$plantcode')";
			mysqli_query($link,$sql_subsub4) or die(mysqli_error($link));
		}
	}

}
 $z1=$mainid;
}
else
{
	$sql_main="update tbl_stoutm set stoutm_fromplant='$pltcode', stoutm_toplant='$plantcodes', stoutm_plant='$txtstfp', stoutm_ramarks='$txtremarks', stoutm_logid='$logid', stoutm_yearid='$yearid_id', tmode='$txt11', trans_name='$txttname', trans_lorryrepno='$txtlrn', trans_vehno='$txtvn', trans_paymode='$txt13', courier_name='$txtcname', docket_no='$txtdc', pname_byhand='$txtpname' where stoutm_id='$z1'";
	$asdf=mysqli_query($link,$sql_main) or die(mysqli_error($link));
	$mainid=$z1;
	for($j=1; $j<$sn; $j++)
	{
		$eltnox="eltno".$j;
		$estagex="estage".$j;
		$eqcx="eqc".$j;
		$edotx="edot".$j;
		$eppx="epp".$j;
		$emoistx="emoist".$j;
		$egempx="egemp".$j;
		$egotypx="egotyp".$j;
		$egotx="egot".$j;
		$edogtx="edogt".$j;
		$enobx="enob".$j;
		$eqtyx="eqty".$j;
		if(isset($_REQUEST[$eltnox])) { $eltno= $_REQUEST[$eltnox]; }
		if(isset($_REQUEST[$estagex])) { $estage= $_REQUEST[$estagex]; }
		if(isset($_REQUEST[$eqcx])) { $eqc= $_REQUEST[$eqcx]; }
		if(isset($_REQUEST[$edotx])) { $edot= $_REQUEST[$edotx]; }
		if(isset($_REQUEST[$eppx])) { $epp= $_REQUEST[$eppx]; }
		if(isset($_REQUEST[$emoistx])) { $emoist= $_REQUEST[$emoistx]; }
		if(isset($_REQUEST[$egempx])) { $egemp= $_REQUEST[$egempx]; }
		if(isset($_REQUEST[$egotypx])) { $egotyp= $_REQUEST[$egotypx]; }
		if(isset($_REQUEST[$egotx])) { $egot= $_REQUEST[$egotx]; }
		if(isset($_REQUEST[$edogtx])) { $edogt= $_REQUEST[$edogtx]; }
		if(isset($_REQUEST[$enobx])) { $enob= $_REQUEST[$enobx]; }
		if(isset($_REQUEST[$eqtyx])) { $eqty= $_REQUEST[$eqtyx]; }
		if($edot!="")
		{
			$tdate=$edot;
			$tday=substr($tdate,0,2);
			$tmonth=substr($tdate,3,2);
			$tyear=substr($tdate,6,4);
			$edot=$tyear."-".$tmonth."-".$tday;
		}
		if($edogt!="")
		{
			$tdate12=$edogt;
			$tday12=substr($tdate12,0,2);
			$tmonth12=substr($tdate12,3,2);
			$tyear12=substr($tdate12,6,4);
			$edogt=$tyear12."-".$tmonth12."-".$tday12;
		}
		
		if($eqty!="" || $eqty>0)
		{
			$sql_subsub4="insert into tbl_stouts (stoutm_id, stouts_crop, stouts_variety, stouts_stage, stouts_lotno, stouts_nob, stouts_qty, stouts_qc, stouts_dot, stouts_pp, stouts_moist, stouts_germ, stouts_gottype, stouts_got, stouts_dogt,plantcode) values ('$mainid', '$txtcrop', '$txtvariety', '$estage', '$eltno', '$enob', '$eqty', '$eqc', '$edot', '$epp', '$emoist', '$egemp', '$egotyp', '$egot', '$edogt','$plantcode')";
			mysqli_query($link,$sql_subsub4) or die(mysqli_error($link));
		}
	}
}

$tid=$z1;

$sql_tbl=mysqli_query($link,"select * from tbl_stoutm where plantcode='".$plantcode."' and  stoutm_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		

$arrival_id=$row_tbl['stoutm_id'];
	
$subtid=0;
?>	

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="14" align="center" class="tblheading">Stock Transfer Lots Details</td>
</tr>
<tr class="tblsubtitle" height="25">
	<td width="26" align="center" class="smalltblheading">#</td>
	<td width="136" align="center" class="smalltblheading">Crop</td>
	<td width="234" align="center" class="smalltblheading">Variety</td>
	<td width="143" align="center" class="smalltblheading">Lot No.</td>
	<td width="88" align="center" class="smalltblheading">Stage</td>
	<td width="73" align="center" class="smalltblheading">NoB</td>
	<td width="85" align="center" class="smalltblheading">Qty</td>
	<!--<td width="73" align="center" class="smalltblheading">Edit</td>-->
	<td width="72" align="center" class="smalltblheading">Delete</td>
</tr>
<?php 
$srno=1;
$sql_sub=mysqli_query($link,"Select * from tbl_stouts where plantcode='".$plantcode."' and  stoutm_id='$tid'") or die(mysqli_error($link));
if($tot_sub=mysqli_num_rows($sql_sub) > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{

$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_sub['stouts_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);
$crop=$noticia_class['cropname'];

$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_sub['stouts_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);
$variety=$noticia_item['popularname'];

$lotn=$row_sub['stouts_lotno'];
$stgw=$row_sub['stouts_stage'];
$nobs=$row_sub['stouts_nob'];
$qtys=$row_sub['stouts_qty'];

if($srno%2!=0)
{
?>
<tr class="Light" height="25">
	<td align="center" class="smalltblheading"><?php echo $srno;?></td>
	<td align="center" class="smalltblheading"><?php echo $crop;?></td>
	<td align="center" class="smalltblheading"><?php echo $variety;?></td>
	<td align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td align="center" class="smalltblheading"><?php echo $stgw;?></td>
	<td align="center" class="smalltblheading"><?php echo $nobs;?></td>
	<td align="center" class="smalltblheading"><?php echo $qtys;?></td>
	<td align="center" class="smalltblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_sub['stouts_id'];?>);" /></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark" height="25">
	<td align="center" class="smalltblheading"><?php echo $srno;?></td>
	<td align="center" class="smalltblheading"><?php echo $crop;?></td>
	<td align="center" class="smalltblheading"><?php echo $variety;?></td>
	<td align="center" class="smalltblheading"><?php echo $lotn;?></td>
	<td align="center" class="smalltblheading"><?php echo $stgw;?></td>
	<td align="center" class="smalltblheading"><?php echo $nobs;?></td>
	<td align="center" class="smalltblheading"><?php echo $qtys;?></td>
	<td align="center" class="smalltblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_sub['stouts_id'];?>);" /></td>
</tr>
<?php
}
$srno++;
}
}
?>
</table>
<br />

<div id="postingsubtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Form</td>
</tr>

<?php
$quer33=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop order by cropname Asc"); 
?>
  <tr class="Dark" height="30">
<td width="144" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="327" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onChange="modetchk(this.value);" >
<option value="" selected="selected">--Select--</option>
<?php while($noticia33 = mysqli_fetch_array($quer33)) { ?>
		<option value="<?php echo $noticia33['cropid'];?>" />   
		<?php echo $noticia33['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="122" align="right"  valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="347" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext"  id="itm" name="txtvariety" style="width:170px;" onChange="modetchk1(this.value);" >
<option value="" selected="selected">--Select--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
	</tr>
 <tr class="Dark" height="30">
<td width="144" align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td width="327" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtstage" style="width:100px;" onChange="verchk(this.value);" >
<option value="" selected="selected">--Select--</option>
<option value="Raw">Raw</option>
<option value="Condition">Condition</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="122" align="right"  valign="middle" class="tblheading"> Select Lot Nos.&nbsp;</td>
<td width="347" align="left"  valign="middle" class="tbltext">&nbsp;<a href="Javascript:void(0);" onclick="openslocpop()">Select</a><input type="hidden" name="txtlot1" value="" /></td>	
	</tr>
</table>
<br />

<div id="showlots"></div>
<br />

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onClick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>

<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>
