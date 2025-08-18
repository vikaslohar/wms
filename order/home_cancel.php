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
	
/*$s_sub="update tbl_orderm set  orderm_cancelflag=0";
mysqli_query($link,$s_sub) or die(mysqli_error($link));	*/
	
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

	$s_sub="Update tbl_orderm set orderm_cancelflag=0 where logid='".$logid."' and orderm_cancelflag=2";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));	
		
	if(isset($_REQUEST['txtpp'])) { $txtpp = $_REQUEST['txtpp']; }
	if(isset($_REQUEST['txtstatesl'])) { $txtstatesl = $_REQUEST['txtstatesl']; }
	if(isset($_REQUEST['txtlocationsl'])) { $txtlocationsl = $_REQUEST['txtlocationsl']; }
	if(isset($_REQUEST['txtcountrysl'])) { $txtcountrysl = $_REQUEST['txtcountrysl']; }
	if(isset($_REQUEST['txtptype'])) { $txtptype = $_REQUEST['txtptype']; }
	
	if(isset($_POST['frm_action'])=='submit')
	{
	 	$txtid=trim($_POST['txtid']);
		$date=trim($_POST['date']);
		$party=trim($_POST['txtparty']);
		$type=trim($_POST['txttype']);
		$fln=trim($_POST['tt']);
		$flnid = split(",",$fln);
		$txtpp=trim($_POST['txtpp']);
		$txtptype=trim($_POST['txtptype']);
		
			
		foreach($flnid as $fid)
		  	{		
					 $sql_in1="update tbl_orderm set orderm_cancelflag=2 where orderm_id='$fid'";	
					$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));	
			}	
		//exit;
	
		
		echo "<script>window.location='add_cancel_preview.php?candate=$date&txtparty=$party&txttype=$type&txtpp=$txtpp&txtptype=$txtptype&txtcountrysl=$txtcountrysl&txtlocationsl=$txtlocationsl&txtstatesl=$txtstatesl&txtid=$txtid'</script>";	
		}

//$a="c";
	//$a="c";
	/**/$sql_code="SELECT MAX(order_cancode) FROM tbl_orderm where yearcode='$ycode' ORDER BY order_cancode DESC";
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
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order-Transaction - Order Cancel </title>
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
//alert("statesl");
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

if(document.from.txttype.value!="" && document.from.txttype.value!="TDF")
{
	if(document.from.txtparty.value=="")
	{
		alert("Please Select Party");
		document.from.txtparty.focus();
		fl=1;
		return false;
	}
}
if(document.from.txttype.value!="" && document.from.txttype.value!="TDF")
{	
var stage=document.from.txtparty.value;
}
else
{
var stage=document.from.txtpp.value;
}
var ortyp=document.from.txttype.value;
//alert(stage);
showUser(stage,'postingsubtable','get',stage,ortyp,'');
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction -Order Cancel </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form  name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="hidden" name="txtptype" value="" />
		<input type="hidden" name="txtcountry1" value="" />
						</br>
<?php
/*$tid=0; $subtid=0;
if(isset($_GET['a']))
	{
	  $a = $_GET['a'];	 
	}

$sql_crop=mysqli_query($link,"select * from  tbl_orderm where orderm_party='".$a."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
   $tot_crop=mysqli_num_rows($sql_crop);*/

?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Order Cancel </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
 <td width="205" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="220" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
<td width="206" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="209"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>
</tr>

<tr class="Light" height="30">
 <?php
//$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer'"); 
?>

<td align="right"  valign="middle" class="tblheading">Order Type &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<select class="tbltext" name="txttype" style="width:150px;" onchange="partycatsl1(this.value)">
<option value="" selected>--Select--</option>
		<option value="Sales">Sales</option>
	<option value="Stock">Stock Transfer</option>
	<option value="TDF">TDF</option>
	</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
		   </table>
		   <div id="vitem11">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
		<tr class="Dark" height="30">
<td width="206" align="right"  valign="middle" class="tblheading">Party Type&nbsp;</td>
<td width="638" colspan="3" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtpp" style="width:120px;" onchange="modetchk1(this.value)" tabindex="" >
<option value="" selected>--Select--</option>
	<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia['classification'];?>" />   
		<?php echo $noticia['classification'];?>
		<?php } ?>
	</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>  
</table>
</div>
<div id="selectpartylocation"style="display:none" ></div>		   
<div id="vitem1"style="display:none" >
<!--<div id="vitem1">--->
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="206" align="right"  valign="middle" class="tblheading" >Party Name &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtparty" style="width:220px;" onchange="party(this.value)" >
<option value="" selected="selected">--Select--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;  </td>
</tr>
<tr class="Light" height="30">
<td width="206" align="right"  valign="middle" class="tblheading" >Address&nbsp;</td>
<td width="638" colspan="5" align="left"  valign="middle" class="tbltext" id="vaddress">&nbsp;
  <input type="hidden" name="adddchk" value="" />  </td>
</tr>
</table>
</div>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td width="207" align="right"  valign="middle" class="tblheading">Display Orders &nbsp;</td>
<td align="left" width="637" valign="middle" class="tblheading" style="border-color:#F1B01E" colspan="5">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a><font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
 <div id="postingsubtable" style="display:none"> <input type="hidden" name="srno" value="0" />
</div></div>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_cancel.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:hand;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;<input type="hidden" name="chk" value="" />  
</td>
</tr>
</table>
<br />
  
 
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

  