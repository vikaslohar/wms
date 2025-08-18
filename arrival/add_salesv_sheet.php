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
	
	if(isset($_REQUEST['cropid']))
	{
	$pid = $_REQUEST['cropid'];
	}
	
	if(isset($_REQUEST['txtlot']))
	{
		$txtlot=trim($_REQUEST['txtlot']);
	}
	
	if(isset($_REQUEST['txtstfp']))
	{
		$txtstfp=trim($_REQUEST['txtstfp']);
	}
	
	if(isset($_REQUEST['txtcrop']))
	{
		$txtcrop=trim($_REQUEST['txtcrop']);
	}
	
	if(isset($_REQUEST['txtvariety']))
	{
		$txtvariety=trim($_REQUEST['txtvariety']);
	}
	
	if(isset($_REQUEST['sstage']))
	{
		$sstage=trim($_REQUEST['sstage']);
	}
	
	if(isset($_REQUEST['txtstfp']))
	{
		$txtstfp=trim($_REQUEST['txtstfp']);
	}
	
	if(isset($_REQUEST['txt11']))
	{
		$txt11 = $_REQUEST['txt11'];
	}
	
	if(isset($_REQUEST['txttname']))
	{
		$txttname = $_REQUEST['txttname'];
	}
	
	if(isset($_REQUEST['txtlrn']))
	{
		$txtlrn = $_REQUEST['txtlrn'];
	}
	
	if(isset($_REQUEST['txtvn']))
	{
		$txtvn = $_REQUEST['txtvn'];
	}
	
	if(isset($_REQUEST['txt14']))
	{
		$txt14 = $_REQUEST['txt14'];
	}
	
	if(isset($_REQUEST['txtcname']))
	{
		$txtcname = $_REQUEST['txtcname'];
	}
	
	if(isset($_REQUEST['txtdc']))
	{
		$txtdc = $_REQUEST['txtdc'];
	}
	
		if(isset($_REQUEST['txtdcno']))
	{
		$txtdcno = $_REQUEST['txtdcno'];
	}
	
	if(isset($_REQUEST['txtpname']))
	{
		$txtpname = $_REQUEST['txtpname'];
	}
	
	if(isset($_REQUEST['remarks']))
	{
		$remarks = $_REQUEST['remarks'];
	}
	
	if(isset($_REQUEST['txtsttp']))
	{
		$txtsttp=trim($_REQUEST['txtsttp']);
	}
	
		
$sql_main="update tblarrival set lotcrop='$txtcrop', lotvariety='$txtvariety', nolot='$txtlot', sstage='$sstage',  tmode='$txt11', trans_name='$txttname', trans_lorryrepno='$txtlrn', trans_vehno='$txtvn', trans_paymode='$txt14', courier_name='$txtcname', docket_no='$txtdc', pname_byhand='$txtpname', remarks='$remarks',dcno='$txtdcno',party_id='$txtstfp' where arrival_id = '$pid'";
$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));


	
	if(isset($_POST['frm_action'])=='submit')
	{
	//exit;
		 $pid=trim($_POST['txtitem']);
		 
		$sql_arr=mysqli_query($link,"select * from tblarrival where arrival_id='".$pid."' and plantcode='$plantcode'") or die(mysqli_error($link));
	while($row_arr=mysqli_fetch_array($sql_arr))
	{
	//$partyid=$row_arr['party_id'];
	$tdate11=$row_arr['arrival_date'];
	$stage=$row_arr['sstage'];	
	$sql_arrsub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$pid."' and plantcode='$plantcode'") or die(mysqli_error($link));
	while($row_arrsub=mysqli_fetch_array($sql_arrsub))
	{
		$classid=$row_arr['lotcrop'];
		$itemid=$row_arr['lotvariety'];
		$ststus=$row_arr['sstage'];
		$lotno=$row_arrsub['lotno'];
		$oldlotno=$row_arrsub['old'];
	$sstatus=$row_arrsub['sstatus'];
		$moist=$row_arrsub['moisture'];
		$gemp=$row_arrsub['gemp'];
		$vchk=$row_arrsub['vchk'];
		$qc=$row_arrsub['qc'];
		$got=$row_arrsub['got1'];
		$gln=$row_arrsub['orlot'];
		$sql_arrsub_sub=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$pid."' and arr_id='".$row_arrsub['arrsub_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
		while($row_arrsub_sub=mysqli_fetch_array($sql_arrsub_sub))
		{
			$whid=$row_arrsub_sub['whid'];
			$binid=$row_arrsub_sub['binid'];
			$subbinid=$row_arrsub_sub['subbin'];
			$ups=$row_arrsub_sub['bags'];
			$qty=$row_arrsub_sub['qty'];
			//$ups1=$row_arrsub_sub['ups_damage'];
			//$qty1=$row_arrsub_sub['qty_damage'];
			
				$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$subbinid."' and lotldg_binid='".$binid."' and lotldg_whid='".$whid."' and lotldg_variety='".$itemid."' and lotldg_crop='".$classid."' and plantcode='$plantcode'") or die(mysqli_error($link));
				$row_issue1=mysqli_fetch_array($sql_issue1); 
				$tot_issue1=mysqli_num_rows($sql_issue1);
				
				if($tot_issue1 > 0)
				{		
				$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and plantcode='$plantcode'") or die(mysqli_error($link)); 
				$row_issuetbl=mysqli_fetch_array($sql_issuetbl);
				$opups=$row_issuetbl['lotldg_opbags'];
				$opqty=$row_issuetbl['lotldg_opqty'];
				$balups=$opups+$ups;
				$balqty=$opqty+$qty;
				}
				else
				{
				$opups=0;
				$opqty=0;
				$balups=$opups+$ups;
				$balqty=$opqty+$qty;
				}
				
				$sql_sub_sub="insert into tbl_lot_ldg (yearcode, lotldg_lotno, lotldg_trtype, lotldg_trid, lotldg_trdate, lotldg_crop, lotldg_variety, lotldg_whid, lotldg_binid, lotldg_subbinid, lotldg_opbags, lotldg_opqty, lotldg_trbags, lotldg_trqty, lotldg_balbags, lotldg_balqty,lotldg_sstage,lotldg_moisture,lotldg_gemp,lotldg_vchk,lotldg_qc,lotldg_got1,lotldg_sstatus,orlot, plantcode) values('$yearid_id', '$lotno', 'StockTransfer Arrival', '$pid', '$tdate11', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$opups', '$opqty', '$ups', '$qty', '$balups', '$balqty','$stage', '$moist', '$gemp', '$vchk', '$qc', '$got','$sstatus','$gln', '$plantcode')";
				mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
				
				$sql_itm="update tbl_subbin set status='$ststus' where sid='$subbinid'";
				mysqli_query($link,$sql_itm) or die(mysqli_error($link));
	
		}
		
			$sql_code1="SELECT MAX(sampleno) FROM tbl_qctest where  plantcode='$plantcode'  ORDER BY tid DESC";
	$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code1) > 0)
			{
				$row_code1=mysqli_fetch_row($res_code1);
				$t_code1=$row_code1['0'];
				$ncode1=$t_code1+1;
				//$ncode=sprintf("%004d",$ncode);
		}
		else
		{
			$ncode1=1;
		}
		if($row_arrsub['qc']=="UT" || $row_arrsub['got']=="UT" )
				{
		$sql_sub_sub12="insert into tbl_qctest(pp,moist, got,lotno,srdate, crop, variety,gemp,sampleno,trstage,qc, plantcode)values('$vchk','$moist','$got','$lotno','$tdate11','$classid','$itemid','$gemp','$ncode1','$stage','$qc', '$plantcode')";
		
				mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
				}
			$sql_sub_upd="update tbllotimp set lotimpflg=1, trid='".$pid."' where lotnumber='".$oldlotno."'";
			$z12345=mysqli_query($link,$sql_sub_upd) or die(mysqli_error($link));
	}
}

		
	$sql_code="SELECT MAX(arr_code) FROM tblarrival where yearcode='$yearid_id' and arrival_type='StockTransfer Arrival' and plantcode='$plantcode' ORDER BY arrival_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
		}
		else
		{
			$code=1;
		}
		
		$sql_code1="SELECT MAX(ncode) FROM tblarrival where yearcode='$yearid_id' and arrival_type='StockTransfer Arrival' and plantcode='$plantcode' ORDER BY ncode DESC";
	$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code1) > 0)
			{
				$row_code1=mysqli_fetch_row($res_code1);
				$t_code1=$row_code1['0'];
				$ncode=$t_code1+1;
				//$ncode=sprintf("%004d",$ncode);
		}
		else
		{
			$ncode=1;
		}
		
	$sql_main="update tblarrival set arrtrflag=1, arr_code=$code, ncode='$ncode' where arrival_id = '$pid'";

	$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));



		echo "<script>window.location='select_arrival_stockop.php?p_id=$pid'</script>";	
	}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival- Transaction - Stock Transfer Arrival - Preview</title>
<link href="../include/main_Sales.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_Sales.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschk.js"></script>
<script type="text/javascript">

//SuckerTree Horizontal Menu (Sept 14th, 06)
//By Dynamic Drive: http://www.dynamicdrive.com/style/

var menuids=["nav"] //Enter id(s) of SuckerTree UL menus, separated by commas

function buildsubmenus_horizontal(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
		if (ultags[t].parentNode.parentNode.id==menuids[i]){ //if this is a first level submenu
			ultags[t].style.top=ultags[t].parentNode.offsetHeight+"px" //dynamically position first level submenus to be height of main menu item
			ultags[t].parentNode.getElementsByTagName("a")[0].className="mainfoldericon"
		}
		else{ //else if this is a sub level menu (ul)
		  ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    	ultags[t].parentNode.getElementsByTagName("a")[0].className="subfoldericon"
		}
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.visibility="visible"
    }
    ultags[t].parentNode.onmouseout=function(){
  this.getElementsByTagName("ul")[0].style.visibility="hidden"
    }
    }
  }
}

if (window.addEventListener)
window.addEventListener("load", buildsubmenus_horizontal, false)
else if (window.attachEvent)
window.attachEvent("onload", buildsubmenus_horizontal)

</script>
<script language="javascript" type="text/javascript">

function formPost(top_element){
	var inputs=top_element.getElementsByTagName('*');
	var qstring=new Array();
	for(var i=0;i<inputs.length;i++){
		if(!inputs[i].disabled&&inputs[i].getAttribute('name')!=""&&inputs[i].getAttribute('name')){
			qs_str=inputs[i].getAttribute('name')+"="+encodeURIComponent(inputs[i].value);
			switch(inputs[i].tagName.toLowerCase()){
				case "select":
					if(inputs[i].getAttribute("multiple")){
						var len2=inputs[i].length;
						for(var j=0;j<len2;j++){
							if(inputs[i].options[j].selected){
								var targ=(inputs[i].options[j].value) ? inputs[i].options[j].value : inputs[i].options[j].text;
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
							}
						}
					}
					else{
						var targ=(inputs[i].options[inputs[i].selectedIndex].value) ? inputs[i].options[inputs[i].selectedIndex].value : inputs[i].options[inputs[i].selectedIndex].text
						qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
					}
				break;
				case "textarea":
					qstring[qstring.length]=qs_str;
				break;
				case "input":
					switch(inputs[i].getAttribute("type").toLowerCase()){
						case "radio":
							if(inputs[i].checked){
								qstring[qstring.length]=qs_str;
							}
						break;
						case "checkbox":
							if(inputs[i].value!=""){
								if(inputs[i].checked){
									qstring[qstring.length]=qs_str;
								}
							}
							else{
								var stat=(inputs[i].checked) ? "true" : "false"
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+stat;
							}
						break;
						case "text":
							qstring[qstring.length]=qs_str;
						break;
						case "password":
							qstring[qstring.length]=qs_str;
						break;
						case "hidden":
							qstring[qstring.length]=qs_str;
						break;
					}
				break;
			}
		}
	}
	return qstring.join("&");
}
function openslocpopprint()
{
if(document.mainform.txtitem.value!="")
{
var itm=document.mainform.txtitem.value;
var remarks=document.mainform.remarks.value
winHandle=window.open('stock_view.php?itmid='+itm+'&remarks='+remarks,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{
alert("Please Select Item first.");
document.mainform.txtitem.focus();
}
}



function mySubmit()
{ 
		if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
	{
	return true;	 
	}
	else
	{
	return false;
	} 
}

</script>


<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_sales.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/sales_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#a8a09e" style="border-bottom:solid; border-bottom-color:#a8a09e" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Arrival from Stock Transfer - Preview</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form name="mainform" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $pid?>" />
		<input type="hidden" name="remarks" value="<?php echo $remarks?>" />
		<input type="hidden" name="date" value="<?php echo $tdate?>" />
		<input type="hidden" name="txtid" value="<?php echo $row_tbl['arrival_code']?>" />

		</br>

<?php 

 $tid=$pid;
?>
<?php
$sql_tbl=mysqli_query($link,"select * from tblarrival where arr_role='".$logid."' and arrival_type='StockTransfer Arrival' and arrival_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
 $arrival_id=$row_tbl['arrival_id'];


	$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tdate1=$row_tbl['dc_date'];
	$tyear1=substr($tdate1,0,4);
	$tmonth1=substr($tdate1,5,2);
	$tday1=substr($tdate1,8,2);
	$tdate1=$tday1."-".$tmonth1."-".$tyear1;

?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Sales Return Verification </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="173" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="196"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TAS".$row_tbl['arrival_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="207" align="right"  valign="middle" class="tblheading" >&nbsp;Date of Arrival &nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $tdate;?></td>
</tr>

<tr class="Light" height="30">
 
<?php
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl['lotcrop']."'"); 
	$row31=mysqli_fetch_array($quer3);
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

<td align="right"  valign="middle" class="tblheading">Part Name &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row31['cropname'];?></td>
 <?php
$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl['lotvariety']."' and actstatus='Active' and vertype='PV'"); 
	$rowvv=mysqli_fetch_array($quer3);
//$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>

	<td align="right"  valign="middle" class="tblheading">Grn No.&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $rowvv['popularname'];?></td>
           </tr>
		   
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Stage&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6" >&nbsp;<?php echo $row_tbl['sstage'];?></td>
</tr>
<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<?php echo $row_tbl['tmode'];?></td>
</tr>
<?php
if($row_tbl['tmode'] == "Transport")
{
?>
<tr class="Light" height="30">
<td align="right" width="173" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_name'];?></td>
<td width="207" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="25">
<td align="right" width="173" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="196" valign="middle" class="tbltext" >&nbsp;<?php echo $row_tbl['trans_vehno'];?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['trans_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($row_tbl['tmode'] == "Courier")
{
?>
<tr class="Dark" height="30">
<td align="right" width="173" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="196" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['courier_name'];?></td>
<td align="right" width="207" valign="middle" class="tblheading">&nbsp;Docket No. &nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="30">
<td align="right" width="173" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['pname_byhand'];?></td>
</tr>
<tr class="Dark" height="25">
           <td width="173"  align="right"  valign="middle" class="tblheading">&nbsp;No. of Packages&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<?php echo $row_tbl['nolot'];?></td>
 </tr>

<?php
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_tbl['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
?>

 <tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">No. of Packages &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row3['business_name'];?></td>
<?php 
		$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$city1=$row_cls['pcity'];
		$plname=$row_cls['company_name'];
?>
<td align="right"  valign="middle" class="tblheading">Date of Return  &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $plname.", ".$city1;?></td>
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Type of Packages &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $tdate1?></td>
<?php 
		$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$city1=$row_cls['pcity'];
		$plname=$row_cls['company_name'];
?>
<td align="right"  valign="middle" class="tblheading">Date of Verification &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row_tbl['dcno'];?></td>
</tr>
<?php
}
?>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#a8a09e" style="border-collapse:collapse">
  <?php
 $tid=$pid;
?>
  <?php
$sql_tbl=mysqli_query($link,"select * from tblarrival where arr_role='".$logid."' and arrival_type='StockTransfer Arrival' and arrival_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

?>
  <tr class="tblsubtitle" height="20">
    <td width="58" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    <td width="63" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
    <td width="71" rowspan="2" align="center" valign="middle" class="tblheading">Vaiety</td>
    <td width="33" rowspan="2" align="center" valign="middle" class="tblheading">UPS</td>
    <td  colspan="2" align="center" valign="middle" class="tblheading" > As Per SRT </td>
    <td width="47" rowspan="2" align="center" valign="middle" class="tblheading">Lot No.</td>
    <td width="48" rowspan="2" align="center" valign="middle" class="tblheading">Exp Date </td>
    <td colspan="3"  align="center" valign="middle" class="tblheading">Actual Qty </td>
    <td   align="center" valign="middle" class="tblheading" colspan="2">Excess shortage </td>
  <!--  <td width="59" rowspan="2" align="center" valign="middle" class="tblheading">Moisture%</td>
    <td width="34" rowspan="2" align="center" valign="middle" class="tblheading">PP</td>
    <td width="43" rowspan="2" align="center" valign="middle" class="tblheading">GOT Type </td>
    <td width="103" rowspan="2" align="center" valign="middle" class="tblheading">Seed Status </td>-->
  </tr>
  <tr class="tblsubtitle">
    <td width="35" align="center" valign="middle" class="tblheading">NOP</td>
    <td width="26" align="center" valign="middle" class="tblheading">Qty</td>
	 <td align="center" valign="middle" class="tblheading">UPS</td>
     <td align="center" valign="middle" class="tblheading">NOP</td>
	 <td align="center" valign="middle" class="tblheading">Qty</td>
    <td align="center" valign="middle" class="tblheading">Units</td>
	 <td width="37" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
  <?php
$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="58" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="63" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
    <td width="71" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
}
?>
    <td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
    <td width="47" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act'];?></td>
    <td width="48" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty'];?></td>
    <td width="24" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
    <td width="31" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff'];?></td>
    <td width="48" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
    <td width="54" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['vchk'];?></td>
   <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>
    <!-- <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>-->
  
  </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="58" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="63" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
    <td width="71" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
}
?>
    <td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
    <td width="47" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act'];?></td>
    <td width="48" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty'];?></td>
    <td width="24" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
    <td width="31" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff'];?></td>
    <td width="48" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
    <td width="54" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['vchk'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>
  <!--  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>-->
  
  </tr>
  <?php
}
$srno++;
}
}

?>
  
</table>
<br/>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#a8a09e" style="border-collapse:collapse">
  <?php
 $tid=$pid;
?>
  <?php
$sql_tbl=mysqli_query($link,"select * from tblarrival where arr_role='".$logid."' and arrival_type='StockTransfer Arrival' and arrival_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where arrival_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

?>
  <tr class="tblsubtitle" height="20">
    <td width="58" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    <td align="center" colspan="2" valign="middle" class="tblheading">Good Condition </td>
    <td colspan="2" align="center" valign="middle" class="tblheading">Damge Condition </td>
    <td colspan="2" align="center" valign="middle" class="tblheading">UPS</td>
    <td  rowspan="2" align="center" valign="middle" class="tblheading" > Packed</td>
    <td width="53" rowspan="2" align="center" valign="middle" class="tblheading">Condition</td>
    <td width="48" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
    <td rowspan="2"  align="center" valign="middle" class="tblheading">QCSR</td>
    <!--  <td   align="center" valign="middle" class="tblheading" colspan="2">Excess shortage </td>
  <td width="59" rowspan="2" align="center" valign="middle" class="tblheading">Moisture%</td>
    <td width="34" rowspan="2" align="center" valign="middle" class="tblheading">PP</td>
    <td width="43" rowspan="2" align="center" valign="middle" class="tblheading">GOT Type </td>
    <td width="103" rowspan="2" align="center" valign="middle" class="tblheading">Seed Status </td>-->
  </tr>
  <tr class="tblsubtitle">
    <td width="63" align="center" valign="middle" class="tblheading">NOP</td>
    <td width="71" align="center" valign="middle" class="tblheading">Qty</td>
	 <td width="137" align="center" valign="middle" class="tblheading">UPS</td>
     <td width="124" align="center" valign="middle" class="tblheading">NOP</td>
	 <td width="88" align="center" valign="middle" class="tblheading">Qty</td>
    <td align="center" valign="middle" class="tblheading">Units</td>
	<!-- <td width="37" align="center" valign="middle" class="tblheading">Qty</td>-->
  </tr>
  <?php
$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="58" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="63" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
    <td width="71" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
}
?>
    <td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
    <td width="73" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act'];?></td>
    <td width="63" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty'];?></td>
    <td width="53" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
    <td width="48" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff'];?></td>
    <td width="48" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
   <!--  <td width="54" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['vchk'];?></td>
   <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>-->
  
  </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="58" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="63" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
    <td width="71" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_sloc['whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
}
?>
    <td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
    <td width="73" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act'];?></td>
    <td width="63" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty'];?></td>
    <td width="53" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
    <td width="48" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff'];?></td>
    <td width="48" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
   <!-- <td width="54" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['vchk'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>-->
  
  </tr>
  <?php
}
$srno++;
}
}

?>
  
</table>
<br />

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_arrival_stocktransfer.php?cropid=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
</tr>
</table>
</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	  
	  </td>
	  </tr>
	  </table>
<!-- actual page end--->			  
		  </td>
        </tr>
        <tr>
          <td width="989" valign="top" align="center"  class="border_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>

  