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
$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
$noticia3 = mysqli_fetch_array($quer3);
$ycode=$noticia3['ycode'];

	if(isset($_REQUEST['txtparty']))
	{
   $party = $_REQUEST['txtparty'];
	}
	
	if(isset($_REQUEST['txttype']))
	{
	 $txttype = $_REQUEST['txttype'];
	}
	if(isset($_REQUEST['txtid'])) { $candate = $_REQUEST['txtid']; }
	if(isset($_REQUEST['candate'])) { $candate = $_REQUEST['candate']; }
	if(isset($_REQUEST['txtpp'])) {$txtpp = $_REQUEST['txtpp']; }
	if(isset($_REQUEST['txtstatesl'])) {  $txtstatesl = $_REQUEST['txtstatesl']; }
	if(isset($_REQUEST['txtlocationsl'])) {  $txtlocationsl = $_REQUEST['txtlocationsl']; }
	if(isset($_REQUEST['txtcountrysl'])) { $txtcountrysl = $_REQUEST['txtcountrysl']; }
	if(isset($_REQUEST['txtptype'])) { $txtptype = $_REQUEST['txtptype']; }
	
	if(isset($_POST['frm_action'])=='submit')
	{
	 	$date=trim($_POST['date']);
		$party=trim($_POST['txtparty']);
		$type=trim($_POST['txttype']);
		$fln=trim($_POST['tt']);
		$flnid =explode(",",$fln);
		$txtpp=trim($_POST['txtpp']);
		$txtptype=trim($_POST['txtptype']);
		$fln1=trim($_POST['tt1']);
		
		 foreach($flnid as $fid)
		  	{		
					 $sql_in1="update tbl_orderm set orderm_cancelflag=0 where orderm_id='$fid'";	
					$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));	
					
			}	
		$flnid1 =explode(",",$fln);
		foreach($flnid1 as $fid)
		  	{		
					 $sql_in1="update tbl_orderm set orderm_cancelflag=2 where orderm_id='$fid'";	
					$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));	
					
			}	
		//exit;
	echo "<script>window.location='add_cancel_preview.php?candate=$date&txtparty=$party&txttype=$txttype&txtpp=$txtpp&txtptype=$txtptype&txtcountrysl=$txtcountrysl&txtlocationsl=$txtlocationsl&txtstatesl=$txtstatesl&txttype=$type'</script>";	
		}
		
	/*$sql_code="SELECT MAX(order_cancode) FROM tbl_orderm  ORDER BY order_cancode DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
			$code1="TAS".$code."/".$ycode."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="TAS".$code."/".$ycode."/".$lgnid;
		}
		//exit;*/
		
			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order- Transaction -Order Cancel</title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
</head>
<script src="cancel.js"></script>
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
function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.form.sdate,dt,document.form.sdate, "dd-mmm-yyyy", xind, yind);
	}
	
	function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.form.edate,dt,document.form.edate, "dd-mmm-yyyy", xind, yind);
	}

function getDateObject(dateString,dateSeperator)
{
	//This function return a date object after accepting 
	//a date string ans dateseparator as arguments
	var curValue=dateString;
	var sepChar=dateSeperator;
	var curPos=0;
	var cDate,cMonth,cYear;

	//extract day portion
	curPos=dateString.indexOf(sepChar);
	cDate=dateString.substring(0,curPos);
	
	//extract month portion				
	endPos=dateString.indexOf(sepChar,curPos+1);			
	cMonth=dateString.substring(curPos+1,endPos);

	//extract year portion				
	curPos=endPos;
	endPos=curPos+5;			
	cYear=curValue.substring(curPos+1,endPos);
	
	//Create Date Object
	dtObject=new Date(cYear,cMonth-1,cDate);	
	return (dtObject);
} 
function party(cats)
{
document.getElementById('postingsubtable').style.display="none";
showUser(cats,'vaddress','vendor','','','','','',cats);
}
function partycatsl1(catslval)
{
document.getElementById('postingsubtable').style.display="none";
showUser(catslval,'vitem11','partytyp','','','','','',catslval);
}
function modetchk1(classval)
{	
		document.getElementById('postingsubtable').style.display="none";
		if(classval=="C&F")
		{
		(classval="CandF")
		}
		
		document.getElementById('selectpartylocation').style.display="block";
		document.getElementById('vitem1').style.display="none";
		showUser(classval,'selectpartylocation','partylocation','','','','','');
		document.from.txtptype.value=classval;
}
function locslchk(statesl)
{
showUser(statesl,'locations','location','','','','','','');
}
function stateslchk(valloc)
{
	if(document.from.txtstatesl.value=="")
	{
		alert("Please Select State for Location");
		document.from.txtlocationsl.selectedIndex=0;
	}
	else
	{
		var classval=document.from.txtptype.value;
		document.getElementById('vitem1').style.display="block";
		//showUser(classval,'vitem1','item1','','','','','',classval);
		showUser(classval,'vitem1','item1',valloc,'','','','');
		document.from.locationname.value=valloc;
	}
}
function loccontrychk(countryval)
{
		if(document.from.txtpp.value!="")
		{
			var classval=document.from.txtptype.value;
			document.getElementById('vitem1').style.display="block";
			showUser(classval,'vitem1','item1',countryval,'','','','');
			document.from.locationname.value=countryval;
			document.from.txtcountry1.value=countryval;
		}
		else
		{
			alert("Please Select Party Type");
			document.from.txtcountrysl.selectedIndex=0;
		}

}	
function getdetails()
{
if(document.from.txttype.value=="")
	{
		alert("Please Select Order Type");
		document.from.txttype.focus();
		fl=1;
		return false;
	}
	
	if(document.from.txtparty.value=="")
	{
		alert("Please Select Party");
		document.from.txtparty.focus();
		fl=1;
		return false;
	}
	
var stage=document.from.txtparty.value;
//alert(stage);
showUser(stage,'postingsubtable','get',stage,'','');
document.getElementById('postingsubtable').style.display="block";
/*if(stage=="txtparty")
			{
				document.getElementById('fill').style.display="block";
				document.from.txtparty.value=stage;
				
			}	*/
			}	

function pform()
{	
	dt3=getDateObject(document.from.dcdate.value,"-");
	dt4=getDateObject(document.from.date.value,"-");
	var fl=0;	
	
	if(dt3 > dt4)
	{
	alert("Please select Valid Delivary Challan Date.");
	fl=1;
	return false;
	}
	
	if(document.from.txttype.value=="")
	{
		alert("Please Select Order Type");
		document.from.txttype.focus();
		fl=1;
		return false;
	}
	
	if(document.from.txtparty.value=="")
	{
		alert("Please Select Party");
		document.from.txtparty.focus();
		fl=1;
		return false;
	}
	
	if(fl==1)
	{
	return false;
	}
	else
	{	//alert("hi");
	var a=formPost(document.getElementById('mainform'));
		//alert(a);
		//document.form.bbbb.value=a
		showUser(a,'postingtable','mform','','','','','');
			document.getElementById('fill').style.display="none";
		}  
	//}
}

function pformedtup()
{	
  	dt3=getDateObject(document.form.dcdate.value,"-");
	dt4=getDateObject(document.form.date.value,"-");
	var fl=0;	
	
	if(dt3 > dt4)
	{
	alert("Please select Valid Delivary Challan Date.");
	fl=1;
	return false;
	}
	
	if(document.from.txttype.value=="")
	{
		alert("Please Select Order Type");
		document.from.txttype.focus();
		fl=1;
		return false;
	}
	
	if(document.from.txtparty.value=="")
	{
		alert("Please Select Variety");
		document.from.txtparty.focus();
		fl=1;
		return false;
	}
	
	if(fl==1)
	{
	return false;
	}
	else
	{	//alert("hi");
	
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		showUser(a,'postingtable','mformsubedt','','','','');
		}
	//}
}


function openslocpop(party)
{
//var party=document.form.txtid.value;
winHandle=window.open('order_cancel_view.php?itmid='+party,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}




function editrec(edtrecid, trid)
{
showUser(edtrecid,'postingsubtable','subformedt',trid,'','','','');
}

function deleterec(v1,v2,v3)
{
	if(confirm('Do u wish to delete this item?')==true)
	{
		showUser(v1,'postingtable','delete',v2,v3,'','','');
	}
	else
	{
		return false;
	}
}




function selectall()
{
//alert("foc");
	if(document.from.srno.value > 2)
	{
		for (var i = 0; i < document.from.foc.length; i++)
		{          
			document.from.foc[i].checked = true;
		}
	}	
	else
	{
		document.from.foc.checked = true;
	}
}

function unselectall()
{
	if(document.from.srno.value > 2)
	{
		for (var i = 0; i < document.from.foc.length; i++) 
		{          
			document.from.foc[i].checked = false;
			document.from.foccode.value ="";
		}
	}
	else
	{
		document.from.foc.checked = false;
		document.from.foccode.value ="";
	}	
}
function mySubmit()
{ 

//alert(document.from.srno.value);
if(document.from.srno.value !=0)
{
	if(document.from.srno.value > 2)
	{
			for (var i = 0; i < document.from.foc.length; i++) 
			{          
			  if(document.from.foc[i].checked == true)
				{
					if(document.from.foccode.value =="")
					{
					document.from.foccode.value=document.from.foc[i].value;
					//document.from.foccode1.value=document.from.foc[i].value;
					}
					else
					{
					document.from.foccode.value = document.from.foccode.value +','+document.from.foc[i].value;
					//document.from.foccode1.value = document.from.foccode1.value +'\n'+document.from.foc[i].value;
					}
				}
			}
	}
	else
	{
		if(document.from.foc.checked == true)
		{
			if(document.from.foccode.value =="")
			{
				document.from.foccode.value=document.from.foc.value;
				//document.from.foccode1.value=document.from.foc[i].value;
			}
			else
			{
				document.from.foccode.value = document.from.foccode.value +','+document.from.foc.value;
			}
		}
	}
}
else
{
	alert("You have not Selected any Order to Cancel. Please select & then click Preview");
	return false;
}

document.from.tt.value = document.from.foccode.value;
//document.from.foc.value = document.from.foccode.value;
//alert(document.from.tt.value);
if(document.from.tt.value == "")
{
alert("Please select Option");
//alert(document.from.foccode.value);
return false;
}

return true;	 
}

</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_order.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/order_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" style="border-bottom:solid; border-bottom-color:#cc30cc" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Order Cancel - Edit</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	
	<?php 
 $tid=$p_id;

$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_cancelflag=2 and orderm_party='$party'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['orderm_id'];

	
	
?>	   
<form  name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   >
  <input name="frm_action" value="submit" type="hidden" />
  <input name="txt11" value="<?php echo $row_tbl['orderm_tmode']?>" type="hidden"> 
	    <input name="txt14" value="<?php echo $row_tbl['orderm_paymode']?>" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $txtid?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="hidden" name="gln1" value="" />
		<input type="hidden" name="txtconchk" value="<?php echo $row_tbl['orderm_consigneeapp']?>" />
		<input type="hidden" name="txtptype" value="<?php echo $row_tbl['orderm_party_type'];?>" />
		</br>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Edit  Cancel Order</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
 <td width="205" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="220" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $candate;?>" maxlength="10"/>&nbsp;</td>
<td width="206" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="209"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TAS".$txtid."/".$ycode."/".$lgnid?></td>
</tr>

<tr class="Light" height="30">
 <?php
// echo $txttype;
//$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer'"); 
?>

<td align="right"  valign="middle" class="tblheading">Order Type &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<select class="tbltext" name="txttype" style="width:150px;" onchange="modetchk1(this.value)">
<option value="" selected>--Select--</option>
  <option <?php if($txttype=="Sales"){ echo "Selected";} ?> value="Sales">Order Sales</option>
  <option <?php if($txttype=="Stock"){ echo "Selected";} ?> value="Stock">Order Stock</option>
   <option <?php if($txttype=="TDF"){ echo "Selected";} ?> value="TDF">Order TDF</option>
  </select>
	&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
</table>
 <div id="vitem11">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<?php
if($txttype=="Sales"){ $main="Channel";}
if($txttype=="Stock"){ $main="Stock Transfer";} 
if($txttype=="TDF"){ $main="TDF - Individual";}
//echo $main;  
if($main!="TDF - Individual")
{
$sql_month=mysqli_query($link,"select * from tblclassification where main='$main' order by classification")or die(mysqli_error($link));
}
else
{
$sql_month=mysqli_query($link,"select * from tblclassification where classification='$main' order by classification")or die(mysqli_error($link));
}
$t=mysqli_num_rows($sql_month);
if($txttype!="TDF"){
?>
		<tr class="Dark" height="30">
<td width="206" align="right"  valign="middle" class="tblheading">Party Type&nbsp;</td>
<td width="638" colspan="3" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtpp" style="width:120px;" onchange="modetchk1(this.value)" tabindex="" >
<option value="" selected>--Select--</option>
	<?php while($noticia = mysqli_fetch_array($sql_month)) {?>
		<option <?php if($noticia['classification']==$txtpp){ echo "Selected";} ?>  value="<?php echo $noticia['classification'];?>" />   
		<?php echo $noticia['classification'];?>
		<?php } ?>
	</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr> 
<?php } ?>
</table>
</div>
<div id="selectpartylocation"style="display:<?php if($txtpp!=""){ echo "block";} else { echo "none"; }?>" >
<?php if($txttype!="TDF"){ ?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<?php
if($txtpp!="Export Buyer")
{	

?>
<?php
$sq_states=mysqli_query($link,"Select * from tbl_state order by state_name asc") or die(mysqli_error($link));
$t_states=mysqli_num_rows($sq_states);
?>
<tr class="Light" height="30">
<td width="206" align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td width="221" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtstatesl" style="width:120px;" onchange="locslchk(this.value)">
<option value="">--Select State--</option>
<?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
	<option value="<?php echo $ro_states['state_name'];?>" <?php if($txtstatesl==$ro_states['state_name']){ echo "Selected";} ?>  ><?php echo $ro_states['state_name'];?></option>
<?php } ?> 
          
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<?php
$sql_month3=mysqli_query($link,"select * from tblproductionlocation where state='".$txtstatesl."' order by productionlocation")or die(mysqli_error($link));
//$noticia3 = mysqli_fetch_array($sql_month3);
 $txtlocationsl;
?>	
	<td width="105" align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td width="308" align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<select class="tbltext" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value)">
<option value="" selected>--Select--</option>
<?php while($noticia3 = mysqli_fetch_array($sql_month3)) { ?>
		<option <?php if($txtlocationsl==$noticia3['productionlocationid']){ echo "Selected";} ?> value="<?php echo $noticia3['productionlocationid'];?>" />   
		<?php echo $noticia3['productionlocation'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr><input type="hidden" name="locationname" value="" />
<?php
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry order by country")or die(mysqli_error($link));
?>
<tr class="Light" height="30">
<td width="206"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtcountrysl" style="width:220px;" onchange="loccontrychk(this.value)">
<option value="">--Select--</option>
<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option <?php if($noticia['country']==$row_tbl['orderm_country']){ echo "Selected";} ?> value="<?php echo $noticia['country'];?>" />   
		<?php echo $noticia['country'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr><input type="hidden" name="locationname" value="" />
<?php
}
?>
</table>
<?php } ?>
</div>		   
<div id="vitem1"style="display:<?php if($txtpp!=""){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<?php
if($txttype=="TDF")
{
$sqlpty=mysqli_query($link,"select distinct orderm_party from tbl_orderm where plantcode='$plantcode' and orderm_party!='0' and order_trtype='Order TDF'   order by orderm_date asc ") or die(mysqli_error($link));
$sqlpty1=mysqli_query($link,"select distinct orderm_partyname from tbl_orderm where plantcode='$plantcode' and orderm_party='0' and order_trtype='Order TDF'  order by orderm_date asc ") or die(mysqli_error($link));
$tot=mysqli_num_rows($sqlpty);
while($rowpty=mysqli_fetch_array($sqlpty))
{
if($partyarr!="")
$partyarr=$partyarr.",".$rowpty['orderm_party'];
else
$partyarr=$rowpty['orderm_party'];
}

while($rowpty1=mysqli_fetch_array($sqlpty1))
{
if($partyarrc!="")
$partyarrc=$partyarrc.",".$rowpty1['orderm_partyname'];
else
$partyarrc=$rowpty1['orderm_partyname'];
}

$zzz=array_values(array_unique(explode(",",$partyarrc)));
$zx=explode(",",$partyarrc);
foreach($zx as $val)
{
if($val<>"")
{ 
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where business_name='".$val."'"); 
	$tot=mysqli_num_rows($quer3);
	if($tot > 0)
	{	//echo "HI";
		$row3=mysqli_fetch_array($quer3);
		if($partyarr!="")
		$partyarr=$partyarr.",".$row3['p_id'];
		else
		$partyarr=$row3['p_id'];
		unset($zzz[$key]);
	}
}
}
//echo $partyarr;
$xc=explode(",",$partyarr);
$zc=array_merge($xc,$zzz);
$list3 = explode(",", implode(",",array_values(array_unique($xc))));
sort($list3);
//$partyar=implode(",",$list3);

?>

 <tr class="Dark" height="30">
<td width="206" align="right"  valign="middle" class="tblheading" >Party Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtparty" style="width:220px;" onchange="party(this.value)" >
<option value="" selected="selected">--Select--</option>
<?php 
		  	foreach($xc as $val1)
			{
			if($val1<>"")
			{ 
				$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$val1."'"); 
				$row3=mysqli_fetch_array($quer3);
				//echo $val1." = ".$row3['business_name'];
		?>
          <option <?php if($row3['p_id']==$party){ echo "Selected";} ?> value="<?php echo $row3['p_id'];?>" />  
          <?php echo $row3['business_name'];?>
          <?php } }
		  	foreach($zzz as $val)
			{
			if($val<>"")
			{ 
		   ?>
		   <option <?php if($val==$party){ echo "Selected";} ?> value="<?php echo $val;?>" />  
          <?php echo $val;?>
		  <?php } } ?>
		  
<?php while($noticia24 = mysqli_fetch_array($sql_month24)) { //echo $noticia24['p_id'];?>
		<option <?php if($noticia24['p_id']==$party){ echo "Selected";} ?> value="<?php echo $noticia24['p_id'];?>" />   
		<?php echo $noticia24['business_name'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<?php
}
else 
{
if($txtpp!="Export Buyer")
{
$sql_month24=mysqli_query($link,"select * from tbl_partymaser where location_id='".$txtlocationsl."' and classification='".$row_tbl['orderm_party_type']."' order by business_name")or die(mysqli_error($link));
}
else
{ 
$sql_month33=mysqli_query($link,"select * from tblcountry where country='".$txtcountrysl."' order by country")or die(mysqli_error($link));
$row_month33=mysqli_fetch_array($sql_month33); 

$sql_month24=mysqli_query($link,"select * from tbl_partymaser where country='".txtcountrysl."' and classification='".$txtpp."' order by business_name")or die(mysqli_error($link));
}

$t=mysqli_num_rows($sql_month24);
?>
 <tr class="Dark" height="30">
<td width="206" align="right"  valign="middle" class="tblheading" >Party Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtparty" style="width:220px;" onchange="party(this.value)" >
<option value="" selected="selected">--Select--</option>
<?php while($noticia24 = mysqli_fetch_array($sql_month24)) { //echo $noticia24['p_id'];?>
		<option <?php if($noticia24['p_id']==$party){ echo "Selected";} ?> value="<?php echo $noticia24['p_id'];?>" />   
		<?php echo $noticia24['business_name'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<?php } ?>
<?php
	$quer33=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl['orderm_party']."'"); 
	$row33=mysqli_fetch_array($quer33);
?>
<tr class="Light" height="30">
<td width="206" align="right"  valign="middle" class="tblheading" >Address&nbsp;</td>
<td width="638" colspan="5" align="left"  valign="middle" class="tbltext" id="vaddress"> <div style="padding-left:3px;"><?php echo $row33['address'];?><?php if($row33['city']!=""){ echo ", ".$row33['city'];}?>, <?php echo $row33['state'];?><input type="hidden" name="adddchk" value="" /></div>  </td>
</tr>
</table>
</div>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td width="206" align="right"  valign="middle" class="tblheading">Display Orders &nbsp;</td>
<td align="left" width="638" valign="middle" class="tblheading" style="border-color:#F1B01E" colspan="5">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a><font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<div id="postingsubtable" style="display:block">
<div id="fill" >
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<tr height="15"><td colspan="6" align="right" class="tblheading"> <a href="javascript:void(0)" onclick="selectall()">Select All</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="unselectall()">Clear All </a></td></tr>

<?php
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='$party' and orderm_cancelflag!=1 and  orderm_dispatchflag!=1 and orderm_holdflag=0 and orderm_supflag=0") or die(mysqli_error($link));
$total_tbl=mysqli_num_rows($sql_tbl);			
?>
  <tr class="tblsubtitle" height="20">
    <td width="31" align="center" valign="middle" class="tblheading">#</td>
			  	 <td width="55" align="center" valign="middle" class="tblheading">Order Date </td>
                 <td width="58" align="center" valign="middle" class="tblheading">Order No.</td>
			 <td width="75" align="center" valign="middle" class="tblheading">View Order</td>
			<td width="43" align="center" valign="middle" class="tblheading">Cancel</td>
              <!-- <td width="48" align="center" valign="middle" class="tblheading">Party Name</td>-->
	</tr>
  <?php
$srno=1;
if($total_tbl > 0)
{
while($row_tbl=mysqli_fetch_array($sql_tbl))
{

 	$arrival_id=$row_tbl['orderm_id'];
	$tdate=$row_tbl['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_tbl['orderm_id']."'") or die(mysqli_error($link));
$total_tbl1=0;
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
if($row_tbl_sub['order_sub_dispatch_flag']==1)$total_tbl1++;
if($row_tbl_sub['order_sub_hold_flag']==1)$total_tbl1++;
}	
  
  if($total_tbl1 == 0)
  {
	if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="55" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
    <td width="58" align="center" valign="middle" class="tblheading"><?php echo $row_tbl['orderm_porderno'];?>&nbsp;<input name="fln" type="hidden" size="52" class="tbltext" tabindex="0" readonly="true" style="background-color:#EFEFEF"  value="<?php echo $row_tbl['orderm_porderno'];?>"/></td>
    <td width="75" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onClick="openslocpop('<?php echo $row_tbl['orderm_id'];?>');">Order View</a></td>
	<td width="43" align="center" valign="middle" class="tblheading"><input type="checkbox" name="foc" <?php $sql_tbl22=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$row_tbl['orderm_id']."' and orderm_cancelflag=2") or die(mysqli_error($link));
	$total_tbl22=mysqli_num_rows($sql_tbl22);
				if($total_tbl22!=0) { echo "checked";}?>  value="<?php echo $row_tbl['orderm_id'];?>"/></td>
    </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="31" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="55" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="58" align="center" valign="middle" class="tblheading"><?php echo $row_tbl['orderm_porderno'];?>&nbsp;<input name="fln" type="hidden" size="52" class="tbltext" tabindex="0" readonly="true" style="background-color:#EFEFEF"  value="<?php echo $row_tbl['orderm_porderno'];?>"/></td>
   <td width="75" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onClick="openslocpop('<?php echo $row_tbl['orderm_id'];?>');">Order View</a></td>
	 <td width="43" align="center" valign="middle" class="tblheading"><input type="checkbox" name="foc" <?php $sql_tbl22=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and  orderm_id='".$row_tbl['orderm_id']."' and orderm_cancelflag=2") or die(mysqli_error($link));
	$total_tbl22=mysqli_num_rows($sql_tbl22);
				if($total_tbl22!=0) { echo "checked";}?>  value="<?php echo $row_tbl['orderm_id'];?>"/></td>
				</tr>
    
	 <?php
}
$srno++;
}
}
}
?>
<input type="hidden" name="foccode" value="" />
<input type="hidden" name="foccode1" value="" />
<input type="hidden" name="tt" value="" />
<input type="hidden" name="tt1" value="" />
<input type="hidden" name="srno" value="<?php echo $srno;?>" />
 </table>
</div>
</div>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_cancel.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:hand;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
</tr>
</table>
</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form>	  </td>
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

  