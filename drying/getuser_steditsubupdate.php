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


//  			main arrival table fields
if(isset($_GET['a']))
	{
	$a = $_GET['a'];	 
	}
if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}
if(isset($_GET['c']))
	{
	$c = $_GET['c'];	 
	}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$b."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crop=$row_crop['cropname'];

$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$c."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
$row_variety=mysqli_fetch_array($sql_variety);
$variet=$row_variety['popularname'];

$tot_row=0;
$lotqry=mysqli_query($link,"select * from tbllotimp where    lotnumber='".$a."' and lotcrop='".$crop."' and lotvariety='".$variet."'")or die (mysqli_error($link));
$row= mysqli_fetch_array($lotqry);
$tot_row=mysqli_num_rows($lotqry);
$lot=$row['lotcrop'];	

 
 if($row['lotvariety']!="")
 {
 	$variety=$row['lotvariety'];
 	$lotqry1=mysqli_query($link,"select * from tblvariety where popularname='".$variety."' and actstatus='Active' and vertype='PV'");
	$t=mysqli_num_rows($lotqry1);
	$row11=mysqli_fetch_array($lotqry1)or die (mysqli_error($link));
	$qctyp=$row11['opt'];
	$i=$row11['varietyid'];
 }
 else
 {
 	$sql_spc=mysqli_query($link,"select * from tblspcodes where  spcodem='".$row['lotspcodem']."' and spcodef='".$row['lotspcodef']."'") or die(mysqli_error($link));
	$row_spc=mysqli_fetch_array($sql_spc);
	$xx=mysqli_num_rows($sql_spc);
	if($xx > 0)
	{
	$x=$row_spc['variety'];
	$z=$row_spc['crop'];
	$lotqry1=mysqli_query($link,"select * from tblvariety where varietyid='".$x."' and actstatus='Active' and vertype='PV'");
	$t=mysqli_num_rows($lotqry1);
	$row11=mysqli_fetch_array($lotqry1)or die (mysqli_error($link));
	$variety=$row11['popularname'];
	$qctyp=$row11['opt'];
	}
	else
	{
	$variety="";
	$qctyp="";
	$x=0;
	}
 }
if(isset($_GET['txt11']))
	{
	$txt11 = $_GET['txt11'];	 
	}
	if(isset($_GET['txt14']))
	{
	$txt14 = $_GET['txt14'];	 
	}
	if(isset($_GET['txtid']))
	{
	$txtid = $_GET['txtid'];	 
	}
	if(isset($_GET['txtid1']))
	{
	$txtid1 = $_GET['txtid1'];	 
	}
	if(isset($_GET['date']))
	{
	$date = $_GET['date'];	 
	}
	if(isset($_GET['txtcrop']))
	{
	$txtcrop = $_GET['txtcrop'];	 
	}
	if(isset($_GET['txtvariety']))
	{
	$txtvariety = $_GET['txtvariety'];	 
	}
	if(isset($_GET['sstage']))
	{
	$sstage = $_GET['sstage'];	 
	}
	
	if(isset($_GET['txt1']))
	{
	$txt1 = $_GET['txt1'];	 
	}
	if(isset($_GET['txttname']))
	{
    $txttname = $_GET['txttname'];	 
	}
	if(isset($_GET['txtlrn']))
	{
	$txtlrn = $_GET['txtlrn'];	 
	}
	if(isset($_GET['txtvn']))
	{
	$txtvn = $_GET['txtvn'];	 
	}
	if(isset($_GET['txt13']))
	{
	$txt13 = $_GET['txt13'];	 
	}

	if(isset($_GET['txtcname']))
	{
	$txtcname= $_GET['txtcname'];	 
	}
	if(isset($_GET['txtdc']))
	{
	$txtdc = $_GET['txtdc'];	 
	}
	if(isset($_GET['txtpname']))
	{
	$txtpname = $_GET['txtpname'];	 
	}
	
		if(isset($_REQUEST['txtdcno']))
	{
		$txtdcno = $_REQUEST['txtdcno'];
	}
	if(isset($_GET['dcdate']))
	{
    $ee1= $_GET['dcdate'];	 
	}
	
	if(isset($_GET['gscheckbox']))
	{
	$sample= $_GET['gscheckbox'];	 
	}
	if(isset($_GET['txtmoist']))
	{
	$txtmoist = $_GET['txtmoist'];	 
	}
	if(isset($_GET['txtgermi']))
	{
	$txtgermi = $_GET['txtgermi'];	 
	}
	if(isset($_GET['txtqc1']))
	{
	$txtqc1 = $_GET['txtqc1'];	 
	}
	if(isset($_GET['sstatus']))
	{
	 $status= $_GET['sstatus'];	 
	}
	if(isset($_GET['txtvisualck']))
	{
	$txtvisualck = $_GET['txtvisualck'];	 
	}
	
	if(isset($_GET['gotstatus']))
	{
	$gotstatus = $_GET['gotstatus'];	 
	}
if(isset($_GET['qc3']))
	{
	$got1= $_GET['qc3'];	 
	}
	if(isset($_GET['txtgot']))
	{
	$txtgot= $_GET['txtgot'];	 
	}
	//2ed
	if(isset($_GET['txtlot']))
	{
	$txtlot = $_GET['txtlot'];	 
	}
	if(isset($_GET['txtstfp']))
	{
	 $txtstfp= $_GET['txtstfp'];	 
	}
	if(isset($_GET['txtlotp22']))
	{
	$txtlotp = $_GET['txtlotp22'];	 
	}
	if(isset($_GET['txtqtystat']))
	{
	$txtqtystat = $_GET['txtqtystat'];	 
	}
	
	if(isset($_GET['txtrawp']))
	{
	$txtrawp = $_GET['txtrawp'];	 
	}
	if(isset($_GET['txtdisp']))
	{
	$txtdisp = $_GET['txtdisp'];	 
	}
	if(isset($_GET['txtrecbagp']))
	{
	$txtrecbagp = $_GET['txtrecbagp'];	 
	}
	if(isset($_GET['recqtyp']))
	{
	$recqtyp = $_GET['recqtyp'];	 
	}
	if(isset($_GET['txtdbagp']))
	{
	$txtdbagp = $_GET['txtdbagp'];	 
	}
	if(isset($_GET['txtdqtyp']))
	{
	$txtdqtyp = $_GET['txtdqtyp'];	 
	}
	
	
//			End of Main table fields	
	
	
//			2nd table fields start

	
	$god1=0;$god2=0;
	if(isset($_GET['txtslwhg1']))
	{
	$y = $_GET['txtslwhg1'];	 
	}
	if(isset($_GET['txtslbing1']))
	{
	$z = $_GET['txtslbing1'];	 
	}
	if(isset($_GET['txtslsubbg1']))
	{
	$a1 = $_GET['txtslsubbg1'];	 
	}
	if(isset($_GET['txtslqtyg1']))
	{
	$b1 = $_GET['txtslqtyg1'];	 
	}
	if(isset($_GET['txtslBagsg1']))
	{
	$c1 = $_GET['txtslBagsg1'];	 
	}
	if(isset($_GET['balqty1']))
	{
	$balqty1 = $_GET['balqty1'];	 
	}
	if(isset($_GET['balBags1']))
	{
	$balbags1 = $_GET['balBags1'];	 
	}
	
	if(isset($_GET['txtslwhg2']))
	{
	$d1 = $_GET['txtslwhg2'];	 
	}
	if(isset($_GET['txtslbing2']))
	{
	$e1= $_GET['txtslbing2'];	 
	}
	if(isset($_GET['txtslsubbg2']))
	{
	$f1 = $_GET['txtslsubbg2'];	 
	}
	if(isset($_GET['txtslqtyg2']))
	{
	$g1 = $_GET['txtslqtyg2'];	 
	}
	if(isset($_GET['txtslBagsg2']))
	{
	$h1 = $_GET['txtslBagsg2'];	 
	}
	if(isset($_GET['balqty2']))
	{
	$balqty2 = $_GET['balqty2'];	 
	}
	if(isset($_GET['balBags2']))
	{
	$balbags2 = $_GET['balBags2'];	 
	}
	$good1=0;$good2=0;
	
	if($b1!="" && $b1 > 0)
	{
	$good1=1; $god1=1;
	if(isset($_GET['orowid1']))
	{
	$rowid1 = $_GET['orowid1'];	 
	}
	}
	if($g1!="" && $g1 > 0)
	{
	$good2=1; $god2=1;
	if(isset($_GET['orowid2']))
	{
	$rowid2 = $_GET['orowid2'];	 
	}
	}
// 		end of 2nd table fields


//		main field for the query i.e. if its is 0 then insert query should run & insblock should be replaced else the query should be update query & updblock should be replaced.
	
	if(isset($_GET['txtremarks']))
	{
	$txtremarks = $_GET['txtremarks'];	 
	}

	if(isset($_GET['maintrid']))
	{
	$z1 = $_GET['maintrid'];	 
	}
	if(isset($_GET['subtrid']))
	{
	  $subtrid = $_GET['subtrid'];	 
	}
	
	if(isset($_GET['logid']))
	{
	$logid = $_GET['logid'];	 
	}
	if(isset($_GET['txtlotp12']))
	{
	$st1 = $_GET['txtlotp12'];	 
	}
	if(isset($_GET['txtlotp1']))
	{
	$st2 = $_GET['txtlotp1'];	 
	}
	if(isset($_GET['txtlotp2']))
	{
	$st3 = $_GET['txtlotp2'];	 
	}

if(isset($_GET['txtlotp3']))
	{
	$st4 = $_GET['txtlotp3'];	 
	}
	if(isset($_GET['txtlotp']))
	{
	$st5 = $_GET['txtlotp'];	 
	}
	if(isset($_GET['dcdate1']))
	{
	$dcdate1 = $_GET['dcdate1'];	 
	}
if(isset($_GET['dcdate12']))
	{
	$dcdate12 = $_GET['dcdate12'];	 
	}
	if(isset($_GET['txtreason']))
	{
	$txtreason = $_GET['txtreason'];	 
	}
	if(isset($_GET['txtlotnoid']))
	{
	$txtlotnoid = $_GET['txtlotnoid'];	 
	}
	
//frm_action=submit&txt11=By%20Hand&txt14=&txtid=69&logid=ARR1&date=01-02-2010&txtcrop=23&txtvariety=44&sstage=conditioned&txt1=By%20Hand&txttname=&txtlrn=&txtvn=&txt13=Select&txtcname=&txtdc=&txtpname=Mishraji&txtlot=2&txtstfp=96&txtsttp=VNR%20SEEDS%20Pvt.%20Ltd.%2C%20Gomchi&txtlotp=H-K01234-00000&txtqtystat=GOTOk&txtrawp=1&txtdisp=10&itmdchk=&txtrecbagp=1&recqtyp=10&txtdbagp=1&txtdqtyp=10&txtslwhg1=60&txtslbing1=155&txtslsubbg1=2100&exusp1=&exqty1=&orowid1=0&txtslBagsg1=1&txtslqtyg1=5&balBags1=1&balqty1=5&txtslwhg2=64&txtslbing2=166&txtslsubbg2=2320&exusp2=&exqty2=&txtslBagsg2=1&txtslqtyg2=5&balBags2=1&balqty2=5&orowid2=0&maintrid=0&subtrid=0&abc=&txtremarks=
	
	
		$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
		 $tdate11=$ee1;
		$tday1=substr($tdate11,0,2);
		$tmonth1=substr($tdate11,3,2);
		$tyear1=substr($tdate11,6,4);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;
		
		$ddate1=$dcdate1;
		$dday1=substr($ddate1,0,2);
		$dmonth1=substr($ddate1,3,2);
		$dyear1=substr($ddate1,6,4);
		$ddate=$dyear1."-".$dmonth1."-".$dday1;
		
		$ddate12=$dcdate12;
		$dday1=substr($ddate12,0,2);
		$dmonth1=substr($ddate12,3,2);
		$dyear1=substr($ddate12,6,4);
		$ddate12=$dyear1."-".$dmonth1."-".$dday1;
		
		$zzz=str_split($txtlotp);
		$olot=$zzz[0].$zzz[1].$zzz[2].$zzz[3].$zzz[4].$zzz[5].$zzz[6].$zzz[7].$zzz[8].$zzz[9].$zzz[10].$zzz[11].$zzz[12].$zzz[13].$zzz[14].$zzz[15];
		
if($z1 == 0)
{
$sql_main="insert into tblarrival (yearcode, arrival_type, arrival_code, arrival_date,  party_id, nolot, tmode, trans_name, trans_lorryrepno, trans_vehno, trans_paymode, courier_name, docket_no, pname_byhand, remarks, arr_role,dc_date,dcno,plantcode) values ('$yearid_id', 'StockTransfer Arrival', '$txtid', '$tdate', '$txtcrop', '$txtstfp', '$txtlot', '$txt1', '$txttname', '$txtlrn', '$txtvn', '$txt13', '$txtcname', '$txtdc', '$txtpname', '$txtremarks', '$logid','$tdate1','$txtdcno','$plantcode')";

if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=mysqli_insert_id($link);

$sql_sub="insert into tblarrival_sub (arrival_id, qty, act, diff, qty1, act1, diff1, qc, lotno,moisture,vchk,sstatus,got,qcstatus,gemp,got1,orlot,lotcrop, lotvariety,sstage,remarks,testd,gotdate,dc_date,lotimpid,plantcode) values('$mainid', '$txtdisp', '$recqtyp', '$txtdqtyp', '$txtrawp', '$txtrecbagp', '$txtdbagp', '$txtqtystat', '$txtlotp','$txtmoist','$txtvisualck','$status','$txtgot','$txtqc1','$txtgermi','$gotstatus','$olot', '$txtcrop', '$txtvariety', '$sstage','$txtreason','$ddate','$ddate12','$tdate1','$txtlotnoid','$plantcode')";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=mysqli_insert_id($link);
if($god1==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety,plantcode) values('StockTransfer Arrival', '$mainid', '$subid', '$y', '$z', '$a1',  '$rowid1', '$b1', '$c1', '$balqty1', '$balbags1', '$txtcrop', '$txtvariety','$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
if($god2==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety,plantcode) values('StockTransfer Arrival', '$mainid', '$subid', '$d1', '$e1', '$f1', '$rowid1', '$g1', '$h1', '$balqty2', '$balbags2', '$txtcrop', '$txtvariety','$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}

}
}
$z1=$mainid;
}
else
{
$sql_main="update tblarrival set yearcode='$yearid_id', arrival_type='StockTransfer Arrival', arrival_code='$txtid', arrival_date='$tdate', party_id='$txtstfp', nolot='$txtlot', tmode='$txt1', trans_name='$txttname', trans_lorryrepno='$txtlrn', trans_vehno='$txtvn', trans_paymode='$txt13', courier_name='$txtcname', docket_no='$txtdc', pname_byhand='$txtpname', remarks='$txtremarks', dc_date='$tdate1',dcno='$txtdcno',arr_role='$logid'  where arrival_id = '$z1'";

if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=$z1;
 //$status;
 $sql_sub="update tblarrival_sub set arrival_id='$mainid', qty='$txtdisp', act='$recqtyp', diff='$txtdqtyp', qty1='$txtrawp', act1='$txtrecbagp', diff1='$txtdbagp', qc='$txtqtystat', moisture='$txtmoist',vchk='$txtvisualck',sstatus='$status',got='$txtgot',sample='$sample',got1='$gotstatus',qcstatus='$txtqc1',gemp='$txtgermi',lotno='$txtlotp', sstage='$sstage',lotcrop='$txtcrop', lotvariety='$txtvariety',remarks='$txtreason' ,testd='$ddate',gotdate='$ddate12', dc_date='$tdate1', orlot='$olot' where arrsub_id='$subtrid'";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=$subtrid;
$sql_del=mysqli_query($link,"delete from tblarr_sloc where arr_id='$subtrid'") or die(mysqli_error($link));

if($god1==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety) values('StockTransfer Arrival', '$mainid', '$subid', '$y', '$z', '$a1',  '$rowid1', '$b1', '$c1', '$balqty1', '$balbags1', '$txtcrop', '$txtvariety')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
if($god2==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, whid, binid, subbin, rowid, qty, bags, balqty, balbags, lotcrop, lotvariety,plantcode) values('StockTransfer Arrival', '$mainid', '$subid', '$d1', '$e1', '$f1',  '$rowid1', '$g1', '$h1', '$balqty2', '$balbags2', '$txtcrop', '$txtvariety','$plantcode')";
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}

}
}
}
// $tid=$z1;
?>
<?php
$tid=$z1;
?>
<?php

$sql_tbl=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   arr_role='".$logid."' and arrival_type='StockTransfer Arrival' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];
$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add  Arrival Stock Transfer Plant</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="228" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="262"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TAS".$row_tbl['arrival_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="192" align="right" valign="middle" class="tblheading">&nbsp;Date &nbsp;</td>
<td width="258" align="left" valign="middle" class="tbltext">&nbsp;
  <input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>
<?php
$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['party_id']."'"); 
$row31=mysqli_fetch_array($quer3);
 $tot=mysqli_num_rows($quer3);
 $row_tbl['party_id'];	
  $row31['business_name'];	
  $row31['p_id'];
?>
 <tr class="light" height="30">
<td align="right"  valign="middle" class="tblheading">Stock Transfer from Plant &nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="3">&nbsp;<input name="txtstfp1" type="text" size="40" class="tbltext" tabindex="" maxlength="40" value="<?php echo $row31['business_name'];?>"  style="background-color:#CCCCCC" readonly="true"/>  <font color="#FF0000">*</font>&nbsp;<input type="hidden" name="adddchk" value="<?php echo $row31['stcode'];?>" /></td><input type="hidden" name="txtstfp" value="<?php echo $row31['p_id'];?>" />
	</tr>
<?php 
		$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$city1=$row_cls['pcity'];
		$plname=$row_cls['company_name'];
			$code=$row_cls['code'];
?>
<!--<td width="159" align="right"  valign="middle" class="tblheading">Stock Tranasfer To Plant &nbsp;</td>
<td width="228" align="left"  valign="middle" class="tbltext">&nbsp;
  <input name="txtsttp" type="text" size="35" class="tbltext" tabindex="" value="<?php echo $plname.", ".$city1;?>" onkeypress="return isNumberKey(event)" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;</td>-->

<?php
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_tbl['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
?>
		  <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" id="vaddress">&nbsp;<?php echo $row3['address']?>,<?php echo $row3['city'];?>,<?php echo $row3['state'];?></td>
</tr>
<!--<tr class="Light" height="30">

	<td align="right"  valign="middle" class="tblheading">STN&nbsp;No.&nbsp;</td>
  <td width="228" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdcno" type="text" size="20" class="tbltext" tabindex=""    maxlength="20" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>-->
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="6"><input name="txt1" type="radio" class="tbltext" value="Transport" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="Transport"){ echo "checked"; }?> />Transport&nbsp;<input name="txt1" type="radio" class="tbltext" value="Courier" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="Courier"){ echo "checked"; }?> />Courier&nbsp;<input name="txt1" type="radio" class="tbltext" value="By Hand" onClick="clk(this.value);" <?php if($row_tbl['tmode']=="By Hand"){ echo "checked"; }?> />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>

<div id="trans" style="display:<?php if($row_tbl['tmode'] == "Transport"){ echo "block";}else{ echo "none";} ?>" >
<table  align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse"  > 
<tr class="Dark" height="30">
<td align="right" width="228" valign="middle" class="tblheading" >&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txttname" type="text" size="21" class="tbltext" tabindex="" maxlength="20" value="<?php echo $row_tbl['trans_name'];?>" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td width="172" align="right"  valign="middle" class="tblheading" style="border-color:#adad11">Lorry Receipt No.&nbsp;</td>
<td align="left" width="235" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtlrn" type="text" size="15" class="tbltext" tabindex="" value="<?php echo $row_tbl['trans_lorryrepno'];?>"  maxlength="15"/>&nbsp;</td>
</tr>

<tr class="Light" height="25">
<td align="right" width="228" valign="middle" class="tblheading" >&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="305" valign="middle" class="tbltext" >&nbsp;<input name="txtvn" type="text" size="12" class="tbltext" tabindex="" maxlength="12" value="<?php echo $row_tbl['trans_vehno'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp; </td>
<td align="right"  valign="middle" class="tblheading" >&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext"colspan="3">&nbsp;<select class="tbltext" name="txt13" style="width:100px;" onchange="clk1(this.value);"  > 
<option value="">--Select Mode--</option>
<option <?php if($row_tbl['trans_paymode']=="TBB"){ echo "Selected";} ?> value="TBB">TBB</option>
<option <?php if($row_tbl['trans_paymode']=="To Pay"){ echo "Selected";} ?> value="To Pay" >To Pay</option>
<option <?php if($row_tbl['trans_paymode']=="Paid"){ echo "Selected";} ?> value="Paid">Paid</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;(Transport)</td>
</tr>
</table>
</div>
<div id="courier" style="display:<?php if($row_tbl['tmode'] == "Courier"){ echo "block";}else{ echo "none";} ?>"  >
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td align="right" width="228" valign="middle" class="tblheading" >&nbsp;Courier Name&nbsp;</td>
<td align="left" width="305" valign="middle" class="tbltext">&nbsp;<input name="txtcname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" value="<?php echo $row_tbl['courier_name'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right" width="172" valign="middle" class="tblheading" s>&nbsp;Docket No.&nbsp;</td>
<td align="left" width="235" valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdc" type="text" size="15" class="tbltext" tabindex="" maxlength="15" value="<?php echo $row_tbl['docket_no'];?>"   />&nbsp;<font color="#FF0000">*</font></td>
</tr>
 
</table>
 
</div>
<div id="byhand" style="display:<?php if($row_tbl['tmode'] == "By Hand"){ echo "block";}else{ echo "none";} ?>" >
<table  align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11"  style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td align="right" width="228" valign="middle" class="tblheading" >&nbsp;Name of Person&nbsp;</td>
<td width="716" colspan="8" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtpname" type="text" size="20" class="tbltext" tabindex=""  maxlength="20" value="<?php echo $row_tbl['pname_byhand'];?>" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
</div>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#adad11" style="border-collapse:collapse">
<?php
 $tid=$z1;
?>
<?php
$sql_tbl=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   arr_role='".$logid."' and arrival_type='StockTransfer Arrival' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."'") or die(mysqli_error($link));
 $subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

?>
			 <tr class="tblsubtitle" height="20">
              <td width="17" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			  	 <td width="32" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
              <td width="44" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
			 <td width="55" align="center" rowspan="2" valign="middle" class="tblheading">Lot No.</td>
              <td colspan="2" align="center" valign="middle" class="tblheading">Dispatch</td>
			    <td colspan="2" align="center" valign="middle" class="tblheading">Received</td>
				<td colspan="2" align="center" valign="middle" class="tblheading">Difference</td>
				 <td width="35" rowspan="2" align="center" valign="middle" class="tblheading">Stage </td>
                <td width="48" rowspan="2" align="center" valign="middle" class="tblheading">Quality Status</td>
				<td width="22" rowspan="2" align="center" valign="middle" class="tblheading">PP</td>
			   <td width="43" rowspan="2" align="center" valign="middle" class="tblheading">Moist %</td>
			   <td width="42" rowspan="2" align="center" valign="middle" class="tblheading">Germ. %</td>
			    <td width="46" rowspan="2" align="center" valign="middle" class="tblheading">GOT Type</td>
			    <td width="50" rowspan="2" align="center" valign="middle" class="tblheading">Seed Status </td>
				<td colspan="3" align="center" valign="middle" class="tblheading">SLOC</td>
                  <td width="30" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="60" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
			<tr class="tblsubtitle">
			  <td width="36" align="center" valign="middle" class="tblheading">NoB</td>
			  <td width="34" align="center" valign="middle" class="tblheading">Qty</td>
               <td width="39" align="center" valign="middle" class="tblheading">NoB</td>
			  <td width="33" align="center" valign="middle" class="tblheading">Qty</td>
			   <td width="46" align="center" valign="middle" class="tblheading">NoB</td>
			  <td width="43" align="center" valign="middle" class="tblheading">Qty</td>
			  <td width="85" align="center" valign="middle" class="tblheading">WH</td>
			   <td width="37" align="center" valign="middle" class="tblheading">NoB</td>
			  <td width="27" align="center" valign="middle" class="tblheading">Qty</td>
               
  </tr>
<?php
$srno=1;
  $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub['lotcrop']."'"); 
	$row31=mysqli_fetch_array($quer3);

$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub['lotvariety']."' and actstatus='Active' and vertype='PV'"); 
$rowvv=mysqli_fetch_array($quer3);
	
$dq=explode(".",$row_tbl_sub['qty']);
if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}

$dcn=$row_tbl_sub['qty1'];

$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

$diq=explode(".",$row_tbl_sub['diff']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['diff'];}

$difn=$row_tbl_sub['diff1'];

	$tdate1=$row_tbl_sub['dc_date'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate1=$tday1."-".$tmonth1."-".$tyear1;
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
    <td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="32" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotcrop'];?>&nbsp;</td>
    <td width="44" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotvariety'];?>&nbsp;</td>
    <td width="55" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
    <td width="36" align="center" valign="middle" class="tblheading"><?php echo $dcn;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $dcq;?></td>
 	<td width="39" align="center" valign="middle" class="tblheading"><?php echo $acn;?></td>
    <td width="33" align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td width="46" align="center" valign="middle" class="tblheading"><?php echo $difn;?></td>
    <td width="43" align="center" valign="middle" class="tblheading"><?php echo $difq;?></td>
	 <td width="35" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstage'];?></td>
    <td width="48" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
    <td width="22" align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
    <td width="43" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
    <td width="42" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['gemp'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>
     <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $act1=""; $act="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where plantcode='".$plantcode."' and   arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
if($act1!="")
$act1=$act1.$row_sloc['bags']."<br/>";
else
$act1=$row_sloc['bags']."<br/>";
if($act!="")
$act=$act.$row_sloc['qty']."<br/>";
else
$act=$row_sloc['qty']."<br/>";

}
?>	 
	<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
	<td width="37" align="center" valign="middle" class="tblheading"><?php echo $act1;?></td>
	<td width="27" align="center" valign="middle" class="tblheading"><?php echo $act;?></td>
	<td width="30" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec('<?php echo $row_tbl_sub['arrsub_id'];?>','<?php echo $tid;?>');" /></td>
 	<td width="60" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'StockTransfer Arrival');"   /></td>
 </tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="32" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotcrop'];?>&nbsp;</td>
    <td width="44" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotvariety'];?>&nbsp;</td>
    <td width="55" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
    <td width="36" align="center" valign="middle" class="tblheading"><?php echo $dcn;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $dcq;?></td>
 	<td width="39" align="center" valign="middle" class="tblheading"><?php echo $acn;?></td>
    <td width="33" align="center" valign="middle" class="tblheading"><?php echo $ac;?></td>
	<td width="46" align="center" valign="middle" class="tblheading"><?php echo $difn;?></td>
    <td width="43" align="center" valign="middle" class="tblheading"><?php echo $difq;?></td>
	<td width="35" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstage'];?></td>
    <td width="48" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
    <td width="22" align="center" valign="middle" class="tblheading"><?php echo $cc;?></td>
    <td width="43" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
    <td width="42" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['gemp'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>
     <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $act1=""; $act="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where plantcode='".$plantcode."' and   arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
if($act1!="")
$act1=$act1.$row_sloc['bags']."<br/>";
else
$act1=$row_sloc['bags']."<br/>";
if($act!="")
$act=$act.$row_sloc['qty']."<br/>";
else
$act=$row_sloc['qty']."<br/>";
}
?>
	<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
    <td width="37" align="center" valign="middle" class="tblheading"><?php echo $act1;?></td>
	<td width="27" align="center" valign="middle" class="tblheading"><?php echo $act;?></td>
	<td width="30" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec('<?php echo $row_tbl_sub['arrsub_id'];?>','<?php echo $tid;?>');" /></td>
 	<td width="60" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'StockTransfer Arrival');"   /></td>
 </tr> 
<?php
}
$srno++;
}
}
?> 
<input type="hidden" name="itmdchk" value="<?php echo $subtbltot;?>" /> 			  
</table>
		  <br />
		  <div id="postingsubtable" style="display:block"><table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse"  > 
<tr class="Dark" height="30">
<td align="right" width="204" valign="middle" class="tblheading">&nbsp;Lot Number</td>
<td align="left" width="272" valign="middle" class="tbltext">&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" readonly="true" style="background-color:#CCCCCC" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();">&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpopp();">Select</a><input type="hidden" name="txtlotnoid" /></td>
<td align="left" width="366" valign="middle" class="tblheading" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get details')</td>
</tr>
</table>
<br />

<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<!--<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>-->
</div>