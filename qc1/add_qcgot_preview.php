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
	
	/*if(isset($_GET['fet']))
	{
	 $qcs1 = $_GET['fet'];	 
	}
	*/
	if(isset($_GET['tid']))
	{
    $tid = $_GET['tid'];
	}
	
	/*if(isset($_GET['txtcla']))
	{
	$txtcla = $_GET['txtcla'];
	}
	if(isset($_GET['txt11']))
	{
	$txt11 = $_GET['txt11'];
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
	if(isset($_GET['txt14']))
	{
	 $txt14 = $_GET['txt14'];
	}
	if(isset($_GET['txtcname']))
	{
	$txtcname = $_GET['txtcname'];
	}
	if(isset($_GET['txtdc']))
	{
	$txtdc = $_GET['txtdc'];
	}
	if(isset($_GET['txtpname']))
	{
	 $txtpname = $_GET['txtpname'];
	}
	 if(isset($_GET['contact']))
	{
	$contact = $_GET['contact'];	 
	}
	if(isset($_GET['txtparty']))
	{
	$party = $_GET['txtparty'];	 
	}
	if(isset($_GET['txtaddress']))
	{
   $txtaddress = $_GET['txtaddress'];	 
	}
	if(isset($_GET['address1']))
	{
	$txtaddress1 = $_GET['address1'];	 
	}	
if(isset($_GET['city']))
	{
	$city = $_GET['city'];	 
	}	
if(isset($_GET['pin']))
	{
	$pin = $_GET['pin'];	 
	}	
if(isset($_GET['state']))
	{
	$state = $_GET['state'];	 
	}
	if(isset($_GET['rettyp']))
	{
	$rettyp = $_GET['rettyp'];	 
	}	
if(isset($_GET['txt12']))
	{
	$txt12 = $_GET['txt12'];	 
	}
	if(isset($_GET['txtvn']))
	{
	$trans_vehno = $_GET['txtvn'];	 
	}
if(isset($_GET['date']))
	{
	$date = $_GET['date'];	 
	}
if(isset($_GET['txtvn']))
	{
	$txtvn = $_GET['txtvn'];	 
	}
	   
   	 $txtcname= $_GET['txtcname'];	 
	$txtdc = $_GET['txtdc'];
	$pname = $_GET['txtpname'];	
	 $qcs1 = $_GET['fet'];
	 	
	 $tdate=$date;
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;	*/ 
	
	
	/* $sql_main="update tbl_gotqc set pname='$txtpname',party_name='$party',address='$txtaddress',address1='$txtaddress1',city='$city',pin='$pin',state='$state',contactno='$contact',tmode='$txt11',trans_name='$txttname',trans_lorryrepno='$txtlrn',trans_vehno='$trans_vehno',trans_paymode='$txt14',courier_name='$txtcname',docket_no='$txtdc' ,party_id='$txtcla',pid='$txt12'  where arrival_id ='$pid'";
	
	 $a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
*/
	if(isset($_POST['frm_action'])=='submit')
	{
		$sql_tbl=mysqli_query($link,"select * from tbl_gotqc where arr_role='".$logid."' and arrival_id='".$tid."'") or die(mysqli_error($link));
		$row=mysqli_fetch_array($sql_tbl);	
		$date=$row['arrival_date'];
		$flnid = split(",",$row['lotno']);
		foreach($flnid as $fid)
		{		
			$sql_arr_home3=mysqli_query($link,"select distinct sampleno from tbl_qctest where tid='".$fid."' and aflg=0 and bflg=1 and cflg=0 and gotflg=0 and gotsmpdflg=0 and got='UT' and qcstatus!='RT' order by sampleno desc") or die(mysqli_error($link));
			$tot_arr_home3=mysqli_num_rows($sql_arr_home3);
			while($row_arr_home3=mysqli_fetch_array($sql_arr_home3))
			{
				$sql_sub_sub12="update tbl_qctest set dosdate='$date', gotsmpdflg=1 where sampleno='".$row_arr_home3['sampleno']."'";
				$res_code1=mysqli_query($link,$sql_sub_sub12) or die(mysqli_error($link));
			}
		}
			
	$sql_code="SELECT MAX(gsdn) FROM tbl_gotqc";
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
		
	$sql_code1="SELECT MAX(gid) FROM tbl_gate";
	$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code1) > 0)
		{
				$row_code1=mysqli_fetch_row($res_code1);
				$t_code1=$row_code1['0'];
				$code1=$t_code1+1;
		}
		else
		{
			$code1=1;
		}
		
			
	$sql_main22="insert into tbl_gate (gid, trid, trtype, gdate) values ('$code1', '$tid', 'GOT Dispatch' ,'$date')";
	$aa22=mysqli_query($link,$sql_main22) or die(mysqli_error($link));
			
	$sql_main="update tbl_gotqc set arrtrflag=1, gsdn='$code' where arrival_id='".$tid."'";
	$aa=mysqli_query($link,$sql_main) or die(mysqli_error($link));
	
		echo "<script>window.location='select_qc_op1.php?tid=$tid'</script>";	
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Qtyl- Transaction -GOT Sample Dispatch- Preview</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
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
//var remarks=document.mainform.remarks.value
winHandle=window.open('qc_view.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
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
          <td valign="top"><?php require_once("../include/arr_qcs.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - GOT Sample Dispatch  - Preview</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form name="mainform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $tid?>" />
		<input type="hidden" name="remarks" value="<?php echo $remarks?>" />
		<input type="hidden" name="date" value="<?php echo $date?>" />

		</br>

<?php 

 // $tid=$pid;

$sql_tbl=mysqli_query($link,"select * from tbl_gotqc where arrival_id='".$tid."'") or die(mysqli_error($link));
$row=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row['arrival_id'];

	$code1="TQG".$row['arr_code']."/".$yearid_id."/".$lgnid;
	
	$tdate=$row['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="900" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">GOT Sample Dispatch  Preview </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="173" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="196"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>

<td width="207" align="right"  valign="middle" class="tblheading" >&nbsp;DOSD&nbsp;</td>
<td align="left" width="264" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $tdate;?></td>
</tr>

<tr class="Light" height="20">
<?php
if($row['pid']=="Yes")
{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	//$tot=mysqli_num_rows($row3);		
 $business_name=$row3['business_name'];
	$address=$row3['address'].", ".$row3['city'].", ".$row3['state'];
	
	if ($row3['phone']!="" && $row3['phone']!=0)
	{
	$phone="0".$row3['std']." ".$row3['phone'];
	}
	}
	else
	{
	$business_name=$row['party_name'];
	$address=$row['address'];
	if($row['city']!="")
	{
	$address=$address."  ".$row['city'];
	}
	if($row['pin']!="" && $row['pin']!=0)
	{
	$address=$address." - ".$row['pin'];
	}
	if($row['state']!="")
	{
	$address=$address.", ".$row['state'];
	}
	if($row['contactno']!="" && $row['contactno']!=0)
	{
	$phone="0".$row['std']." ".$row['contactno'];
	}
	if($row['mobileno']!="" && $row['mobileno']!=0)
	{
	if($phone!="")
	$phone=$phone.", <b>Mobile No:</b> ".$row['mobileno'];
	else
	$phone=$row['mobileno'];
	}
	
	}
?>

<td align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="5" >&nbsp;<?php echo $business_name;?></td>
</tr>
<tr class="Dark" height="20">
<td align="right"  valign="middle" class="tblheading">&nbsp;Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $address;?></div></td>
</tr>
<tr class="Dark" height="20">
<td align="right"  valign="middle" class="tblheading">&nbsp;Phone&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="6"><div align="justify" class="tbltext" style="padding:2px 5px 5px 5px"><?php echo $phone;?></div></td>
</tr>
<?php
$txt11=$row['tmode'];
if($txt11!= "") 
{
?>
<tr class="Light" height="20"> 
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5" >&nbsp;<?php echo $txt11;?></td>
</tr>
<?php

if($txt11 == "Transport")
{
?>
<tr class="Dark" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Transport Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['trans_name'];?></td>
<td width="168" align="right"  valign="middle" class="tblheading">Lorry Receipt No.&nbsp;</td>
<td align="left" width="194" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row['trans_lorryrepno'];?></td>
</tr>

<tr class="Light" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Vehicle No.&nbsp;</td>
<td align="left" width="204" valign="middle" class="tbltext" >&nbsp;<?php echo $row['trans_vehno']?></td>
<td align="right"  valign="middle" class="tblheading">&nbsp;Payment Mode&nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<?php echo $row['trans_paymode'];?>&nbsp;(Transport)</td>
</tr>
<?php
}
else if($txt11 == "Courier")
{
?>
<tr class="Dark" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Courier Name&nbsp;</td>
<td align="left" width="204" valign="middle" class="tbltext">&nbsp;<?php echo $row['courier_name'];?></td>
<td align="right" width="168" valign="middle" class="tblheading">&nbsp;Docket No.&nbsp;</td>
<td align="left" width="194" valign="middle" class="tbltext">&nbsp;<?php echo $row['docket_no'];?></td>
</tr>
<?php
}
else 
{
?> 
<tr class="Dark" height="20">
<td align="right" width="174" valign="middle" class="tblheading">&nbsp;Name of Person&nbsp;</td>
<td colspan="5" align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row['pname'];?></td>
</tr>
<?php
}
?>
</table>
<br />
<?php
 $sql_arr_home=mysqli_query($link,"select * from tbl_qctest where aflg=0 and bflg=1  and cflg=0  order by sampleno desc") or die(mysqli_error($link));
  $tot_arr_home=mysqli_num_rows($sql_arr_home);

 if($tot_arr_home >0) { 
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="900" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="28" height="19"align="center" valign="middle" class="tblheading">#</td>
			   <td width="83" align="center" valign="middle" class="tblheading">DOSR</td>
			    <td width="83" align="center" valign="middle" class="tblheading">DOSC</td>
			   <td width="145" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="171" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="129" align="center" valign="middle" class="tblheading">Lot No.</td> 
			  <td width="74" align="center" valign="middle" class="tblheading">Stage</td>
			  <td width="59" align="center" valign="middle" class="tblheading">QC Tests </td>
			    <td align="center" valign="middle" class="tblheading">Sample No. </td>
				 </tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{

$p_array=explode(",",$row['lotno']);
			foreach($p_array as $val)
				{
				if($val <> "")
				{
				if($val==$row_arr_home['tid'])
					{ 	
					
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$trdate1=$row_arr_home['spdate'];
	$tryear=substr($trdate1,0,4);
	$trmonth=substr($trdate1,5,2);
	$trday=substr($trdate1,8,2);
	$trdate1=$trday."-".$trmonth."-".$tryear;		
	
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
	$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{			
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}

	
	$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name from tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
		$quer3=mysqli_query($link,"SELECT * from tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * from tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$row33=mysqli_fetch_array($quer3);
	 $tt=$row33['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl_sub1['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }

	 
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
//$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl_sub1['trstage'];
$pp=$row_tbl_sub1['state'];	
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

$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters");
	$row_cls=mysqli_fetch_array($quer_cn);
	$tp1=$row_cls['code'];
}
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="28" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="83" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
		   <td width="83" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td width="145" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="129" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 	<td width="74" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
		 	<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		  <td width="119" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $yearid_id?><?php echo sprintf("%000006d",$qc1);?></td>
   </tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="28" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="83" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
		   <td width="83" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td width="145" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="129" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 	<td width="74" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
		 	<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		  <td width="119" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $yearid_id?><?php echo sprintf("%000006d",$qc1);?></td>
	 </tr>
<?php
}
$srno=$srno+1;
}}}
}
}
}
}
?>
          </table>
<br />

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_qcrequest.php?p_id=<?php echo $tid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  