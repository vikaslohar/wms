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
	
	if(isset($_REQUEST['pid']))
	{
	$pid = $_REQUEST['pid'];	 
	}
	
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$trid=trim($_POST['trid']);
		//$code=trim($_POST['code']);
		/*$date=trim($_POST['date']);
		$classification=trim($_POST['txtclass']);
		$item=trim($_POST['txtitem']);
		$uom=trim($_POST['txtuom']);
		$totups=trim($_POST['txtupsg']);
		$totqty=trim($_POST['txtqtyg']);
		$slocnog=trim($_POST['tblslocnog']);
		$slocnod=trim($_POST['tblslocnod']);
		$itmtype=trim($_POST['txtmtype']);
		
		if($itmtype=="good")$slocnod=0;
		else
		$slocnog=0;
		
		if($slocnog > 0)
		{
		$wh1=trim($_POST['txtslwhg1']);
		$bin1=trim($_POST['txtslbing1']);
		$subbin1=trim($_POST['txtslsubbg1']);
		$ups1=trim($_POST['txtslupsg1']);
		$qty1=trim($_POST['txtslqtyg1']);
		$rowid1=trim($_POST['rowid_1']);
		if($ups1 <=0)$ups1=1;
		
		if($slocnog >=2)
		{
		$wh2=trim($_POST['txtslwhg2']);
		$bin2=trim($_POST['txtslbing2']);
		$subbin2=trim($_POST['txtslsubbg2']);
		$ups2=trim($_POST['txtslupsg2']);
		$qty2=trim($_POST['txtslqtyg2']);
		$rowid2=trim($_POST['rowid_2']);
		if($ups2 <=0)$ups2=1;
		}
		
		if($slocnog ==3)
		{
		$wh3=trim($_POST['txtslwhg3']);
		$bin3=trim($_POST['txtslbing3']);
		$subbin3=trim($_POST['txtslsubbg3']);
		$ups3=trim($_POST['txtslupsg3']);
		$qty3=trim($_POST['txtslqtyg3']);
		$rowid3=trim($_POST['rowid_3']);
		if($ups3 <=0)$ups3=1;
		}
		}
		
		if($slocnod > 0)
		{
		$wh4=trim($_POST['txtslwhd1']);
		$bin4=trim($_POST['txtslbind1']);
		$subbin4=trim($_POST['txtslsubbd1']);
		$ups4=trim($_POST['txtslupsd1']);
		$qty4=trim($_POST['txtslqtyd1']);
		$rowidd1=trim($_POST['rowidd_1']);
		if($ups4 <=0)$ups4=1;
		
		if($slocnod ==2)
		{
		$wh5=trim($_POST['txtslwhd2']);
		$bin5=trim($_POST['txtslbind2']);
		$subbin5=trim($_POST['txtslsubbd2']);
		$ups5=trim($_POST['txtslupsd2']);
		$qty5=trim($_POST['txtslqtyd2']);
		$rowidd2=trim($_POST['rowidd_2']);
		if($ups5 <=0)$ups5=1;
		}
		}
		
		$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
						
 	 $sql_in="update tbl_sloc_csw set yearcode='$yearid_id', classification_id='$classification', items_id='$item', noofbinsg='$slocnog', noofbinsd='$slocnod', itmtype='$itmtype', surole='$lgnid' where slid='$pid'";
							
	if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
	{
		$slid=$pid;
		
		$s_sub_sub="delete from tbl_sloc_csw_sub where slocid='".$slid."'";
		mysqli_query($link,$s_sub_sub) or die(mysqli_error($link));

		if($itmtype=="good")
		{
		$flash=0;
		for($i=0; $i<$slocnog; $i++)
		{
			if($flash==0)
			{
				$sql_in1="insert into tbl_sloc_csw_sub (slocid, whid, binid, subbinid, ups, qty, rowid) values ('$slid', '$wh1', '$bin1', '$subbin1', '$ups1', '$qty1', '$rowid1')";
			}
			else if($flash==1)
			{
				$sql_in1="insert into tbl_sloc_csw_sub (slocid, whid, binid, subbinid, ups, qty, rowid) values ('$slid', '$wh2', '$bin2', '$subbin2', '$ups2', '$qty2', '$rowid2')";
			}
			else if($flash==2)
			{
				$sql_in1="insert into tbl_sloc_csw_sub (slocid, whid, binid, subbinid, ups, qty, rowid) values ('$slid', '$wh3', '$bin3', '$subbin3', '$ups3', '$qty3', '$rowid3')";
			}
			mysqli_query($link,$sql_in1)or die(mysqli_error($link));
			$flash++;
		}
		}
		else
		{
		$flash=0;
		for($i=0; $i<$slocnod; $i++)
		{
			if($flash==0)
			{
				$sql_in1="insert into tbl_sloc_csw_sub (slocid, whid, binid, subbinid, ups, qty, rowid) values ('$slid', '$wh4', '$bin4', '$subbin4', '$ups4', '$qty4', '$rowidd1')";
			}
			else if($flash==1)
			{
				$sql_in1="insert into tbl_sloc_csw_sub (slocid, whid, binid, subbinid, ups, qty, rowid) values ('$slid', '$wh5', '$bin5', '$subbin5', '$ups5', '$qty5', '$rowidd2')";
			}
			mysqli_query($link,$sql_in1)or die(mysqli_error($link));
			$flash++;
		}
		} */
			echo "<script>window.location='add_slocnew_preview.php?pid=$trid'</script>";	
	}
		
	
//}
//}
//}

	
	/*$a="SU";
	$sql_code="SELECT MAX(code) FROM tbl_sloc_csw ORDER BY code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1=$a.$code;
		}
		else
		{
			$code=1;
			$code1=$a.$code;
		}*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CSW-Transction-Sloc Updation</title>
<link href="../include/main_csw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_csw.css" rel="stylesheet" type="text/css" />
</head>
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

<script src="slocupnew,js"></script>
<script language="javascript" type="text/javascript">
var x = 0;

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

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
	  function isNumberKey1(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }
/*function onloadfocus()
	{
	document.frmaddDepartment.txtdrno.focus();
	}*/
	

function clks(val)
{
//alert(val);
document.frmaddDepartment.txt14.value=val;
}

function mySubmit()
{ 
	
/*	if(document.frmaddDepartment.txtdate.value=="00-00-0000" || document.frmaddDepartment.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}*/
	if(document.frmaddDepartment.txtcrop.value=="")
	{
	alert("Please select Crop first");
	document.frmaddDepartment.txtcrop.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtvariety.value=="")
	{
	alert("Please select Variety first");
	document.frmaddDepartment.txtvariety.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please select Lot No.");
		return false;
	} 
	
	if(document.frmaddDepartment.trid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
		
	return true;	 
}

function modetchk(classval) 
{
document.frmaddDepartment.txtlot1.value=""
document.frmaddDepartment.trid.value=0;
document.getElementById('subdiv').style.display="none";
showUser(classval,'vitem','item','','','','','');
}

function modetchk1(val)
{
document.frmaddDepartment.txtlot1.value=""
document.frmaddDepartment.trid.value=0;
document.getElementById('subdiv').style.display="none";
}

function chktp(val)
{
//document.frmaddDepartment.txtmtype.value=val;
document.getElementById('subdiv').style.display="block";
setTimeout('chktyp()',200);

}
function chktyp()
{ 
	if(document.frmaddDepartment.txtlot1.value!="")
	{
			var opttyp=document.frmaddDepartment.txtlot1.value;
			var clasid=document.frmaddDepartment.txtcrop.value;
			var itmid=document.frmaddDepartment.txtvariety.value;
			var trid=document.frmaddDepartment.trid.value;
			if(opttyp !="")
			{
			showUser(opttyp,'subdiv','slocshowmrv',opttyp,clasid,itmid,trid,'');
			}
			else
			{
			alert("please select LOT Number");
			}
			
	}
	else
	{
		alert("please select LOT Number");
		
	}
}


function wh1(wh2val,typ)
{ //alert(wh1val);
	/*if(wh2val==14 && document.frmaddDepartment.ocnt.value!=10 && typ=='add')
	{
		var val3=document.frmaddDepartment.orwoid.value;
		var trid=document.frmaddDepartment.trid.value;
		//alert(val3);
		var opttyp=document.frmaddDepartment.txtlot1.value;
		var clasid=document.frmaddDepartment.txtcrop.value;
		var itmid=document.frmaddDepartment.txtvariety.value;
		//alert(opttyp);
		showUser(opttyp,'subsubdiv','slocshowsubdamage',itmid,clasid,trid,val3,'CS-01');
		//document.getElementById('sloc1').style.display="block";
		setTimeout(function() {showUser(wh2val,'bing1','wh','bing1','','','','');},400)
	}
	else*/
	{
		showUser(wh2val,'bing1','wh','bing1','','','','');
	}
}

function wh2(wh2val,typ)
{ //alert(wh1val);
	/*if(wh2val==14 && document.frmaddDepartment.ocnt.value!=10 && typ=='add')
	{
		var val3=document.frmaddDepartment.orwoid.value;
		var trid=document.frmaddDepartment.trid.value;
		//alert(val3);
		var opttyp=document.frmaddDepartment.txtlot1.value;
		var clasid=document.frmaddDepartment.txtcrop.value;
		var itmid=document.frmaddDepartment.txtvariety.value;
		//alert(opttyp);
		showUser(opttyp,'subsubdiv','slocshowsubdamage',itmid,clasid,trid,val3,'CS-01');
		//document.getElementById('sloc1').style.display="block";
		setTimeout(function() {showUser(wh2val,'bing2','wh','bing2','','','','');},400)
	}
	else*/
	{
		showUser(wh2val,'bing2','wh','bing2','','','','');
	}
}

function wh3(wh2val,typ)
{ //alert(wh1val);
	/*if(wh2val==14 && document.frmaddDepartment.ocnt.value!=10 && typ=='add')
	{
		var val3=document.frmaddDepartment.orwoid.value;
		var trid=document.frmaddDepartment.trid.value;
		//alert(val3);
		var opttyp=document.frmaddDepartment.txtlot1.value;
		var clasid=document.frmaddDepartment.txtcrop.value;
		var itmid=document.frmaddDepartment.txtvariety.value;
		//alert(opttyp);
		showUser(opttyp,'subsubdiv','slocshowsubdamage',itmid,clasid,trid,val3,'CS-01');
		//document.getElementById('sloc1').style.display="block";
		setTimeout(function() {showUser(wh2val,'bing3','wh','bing3','','','','');},400)
	}
	else*/
	{
		showUser(wh2val,'bing3','wh','bing3','','','','');
	}
}

function wh4(wh2val,typ)
{ //alert(wh1val);
	/*if(wh2val==14 && document.frmaddDepartment.ocnt.value!=10 && typ=='add')
	{
		var val3=document.frmaddDepartment.orwoid.value;
		var trid=document.frmaddDepartment.trid.value;
		//alert(val3);
		var opttyp=document.frmaddDepartment.txtlot1.value;
		var clasid=document.frmaddDepartment.txtcrop.value;
		var itmid=document.frmaddDepartment.txtvariety.value;
		//alert(opttyp);
		showUser(opttyp,'subsubdiv','slocshowsubdamage',itmid,clasid,trid,val3,'CS-01');
		//document.getElementById('sloc1').style.display="block";
		setTimeout(function() {showUser(wh2val,'bing4','wh','bing4','','','','');},400)
	}
	else*/
	{
		showUser(wh2val,'bing4','wh','bing4','','','','');
	}
}

function wh5(wh2val,typ)
{ //alert(wh1val);
	/*if(wh2val==14 && document.frmaddDepartment.ocnt.value!=10 && typ=='add')
	{
		var val3=document.frmaddDepartment.orwoid.value;
		var trid=document.frmaddDepartment.trid.value;
		//alert(val3);
		var opttyp=document.frmaddDepartment.txtlot1.value;
		var clasid=document.frmaddDepartment.txtcrop.value;
		var itmid=document.frmaddDepartment.txtvariety.value;
		//alert(opttyp);
		showUser(opttyp,'subsubdiv','slocshowsubdamage',itmid,clasid,trid,val3,'CS-01');
		//document.getElementById('sloc1').style.display="block";
		setTimeout(function() {showUser(wh2val,'bing5','wh','bing5','','','','');},400)
	}
	else*/
	{
		showUser(wh2val,'bing5','wh','bing5','','','','');
	}
}

function wh6(wh2val,typ)
{ //alert(wh1val);
	/*if(wh2val==14 && document.frmaddDepartment.ocnt.value!=10 && typ=='add')
	{
		var val3=document.frmaddDepartment.orwoid.value;
		var trid=document.frmaddDepartment.trid.value;
		//alert(val3);
		var opttyp=document.frmaddDepartment.txtlot1.value;
		var clasid=document.frmaddDepartment.txtcrop.value;
		var itmid=document.frmaddDepartment.txtvariety.value;
		//alert(opttyp);
		showUser(opttyp,'subsubdiv','slocshowsubdamage',itmid,clasid,trid,val3,'CS-01');
		//document.getElementById('sloc1').style.display="block";
		setTimeout(function() {showUser(wh2val,'bing6','wh','bing6','','','','');},400)
	}
	else*/
	{
		showUser(wh2val,'bing6','wh','bing6','','','','');
	}
}

function wh7(wh2val,typ)
{ //alert(wh1val);
	/*if(wh2val==14 && document.frmaddDepartment.ocnt.value!=10 && typ=='add')
	{
		var val3=document.frmaddDepartment.orwoid.value;
		var trid=document.frmaddDepartment.trid.value;
		//alert(val3);
		var opttyp=document.frmaddDepartment.txtlot1.value;
		var clasid=document.frmaddDepartment.txtcrop.value;
		var itmid=document.frmaddDepartment.txtvariety.value;
		//alert(opttyp);
		showUser(opttyp,'subsubdiv','slocshowsubdamage',itmid,clasid,trid,val3,'CS-01');
		//document.getElementById('sloc1').style.display="block";
		setTimeout(function() {showUser(wh2val,'bing7','wh','bing7','','','','');},400)
	}
	else*/
	{
		showUser(wh2val,'bing7','wh','bing7','','','','');
	}
}

function wh8(wh2val,typ)
{ //alert(wh1val);
	/*if(wh2val==14 && document.frmaddDepartment.ocnt.value!=10 && typ=='add')
	{
		var val3=document.frmaddDepartment.orwoid.value;
		var trid=document.frmaddDepartment.trid.value;
		//alert(val3);
		var opttyp=document.frmaddDepartment.txtlot1.value;
		var clasid=document.frmaddDepartment.txtcrop.value;
		var itmid=document.frmaddDepartment.txtvariety.value;
		//alert(opttyp);
		showUser(opttyp,'subsubdiv','slocshowsubdamage',itmid,clasid,trid,val3,'CS-01');
		//document.getElementById('sloc1').style.display="block";
		setTimeout(function() {showUser(wh2val,'bing8','wh','bing8','','','','');},400)
	}
	else*/
	{
		showUser(wh2val,'bing8','wh','bing8','','','','');
	}
}

function wh9(wh2val,typ)
{ //alert(wh1val);
	/*if(wh2val==14 && document.frmaddDepartment.ocnt.value!=10 && typ=='add')
	{
		var val3=document.frmaddDepartment.orwoid.value;
		var trid=document.frmaddDepartment.trid.value;
		//alert(val3);
		var opttyp=document.frmaddDepartment.txtlot1.value;
		var clasid=document.frmaddDepartment.txtcrop.value;
		var itmid=document.frmaddDepartment.txtvariety.value;
		//alert(opttyp);
		showUser(opttyp,'subsubdiv','slocshowsubdamage',itmid,clasid,trid,val3,'CS-01');
		//document.getElementById('sloc1').style.display="block";
		setTimeout(function() {showUser(wh2val,'bing9','wh','bing9','','','','');},400)
	}
	else*/
	{
		showUser(wh2val,'bing9','wh','bing9','','','','');
	}
}

function wh10(wh2val,typ)
{ //alert(wh1val);
	/*if(wh2val==14 && document.frmaddDepartment.ocnt.value!=10 && typ=='add')
	{
		var val3=document.frmaddDepartment.orwoid.value;
		var trid=document.frmaddDepartment.trid.value;
		//alert(val3);
		var opttyp=document.frmaddDepartment.txtlot1.value;
		var clasid=document.frmaddDepartment.txtcrop.value;
		var itmid=document.frmaddDepartment.txtvariety.value;
		//alert(opttyp);
		showUser(opttyp,'subsubdiv','slocshowsubdamage',itmid,clasid,trid,val3,'CS-01');
		//document.getElementById('sloc1').style.display="block";
		setTimeout(function() {showUser(wh2val,'bing10','wh','bing10','','','','');},400)
	}
	else*/
	{
		showUser(wh2val,'bing10','wh','bing10','','','','');
	}
}



function bin1(bin1val)
{
	if(document.frmaddDepartment.txtslwhg1.value!="")
	{
		showUser(bin1val,'sbing1','bin','txtslsubbg1','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bin2(bin2val)
{
	if(document.frmaddDepartment.txtslwhg2.value!="")
	{
		showUser(bin2val,'sbing2','bin','txtslsubbg2','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}


function bin3(bin2val)
{
	if(document.frmaddDepartment.txtslwhg3.value!="")
	{
		showUser(bin2val,'sbing3','bin','txtslsubbg3','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}
function bin4(bin2val)
{
	if(document.frmaddDepartment.txtslwhg4.value!="")
	{
		showUser(bin2val,'sbing4','bin','txtslsubbg4','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}
function bin5(bin2val)
{
	if(document.frmaddDepartment.txtslwhg5.value!="")
	{
		showUser(bin2val,'sbing5','bin','txtslsubbg5','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}
function bin6(bin2val)
{
	if(document.frmaddDepartment.txtslwhg6.value!="")
	{
		showUser(bin2val,'sbing6','bin','txtslsubbg6','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}
function bin7(bin2val)
{
	if(document.frmaddDepartment.txtslwhg7.value!="")
	{
		showUser(bin2val,'sbing7','bin','txtslsubbg7','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}
function bin8(bin2val)
{
	if(document.frmaddDepartment.txtslwhg8.value!="")
	{
		showUser(bin2val,'sbing8','bin','txtslsubbg8','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}
function bin9(bin2val)
{
	if(document.frmaddDepartment.txtslwhg9.value!="")
	{
		showUser(bin2val,'sbing9','bin','txtslsubbg9','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}
function bin10(bin2val)
{
	if(document.frmaddDepartment.txtslwhg10.value!="")
	{
		showUser(bin2val,'sbing10','bin','txtslsubbg10','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function subbin1(subbin1val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	var itemcrpv=document.frmaddDepartment.txtcrop.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		if(w1==w2)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDepartment.txtslsubbg1.selectedIndex=0;
		}
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var seedstage=document.frmaddDepartment.seedstage.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.txtslBagsg1.value!="")
		var Bagsv1=document.frmaddDepartment.txtslBagsg1.value;
		else
		var Bagsv1="";
		if(document.frmaddDepartment.txtslqtyg1.value!="")
		var qtyv1=document.frmaddDepartment.txtslqtyg1.value;
		else
		var qtyv1="";
		var wh=document.frmaddDepartment.txtslwhg1.value;
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,Bagsv1,qtyv1,trid,seedstage,wh,itemcrpv);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing1.focus();
	}
}

function subbin2(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	var itemcrpv=document.frmaddDepartment.txtcrop.value;
	if(document.frmaddDepartment.txtslbing2.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		if(w2==w1)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDepartment.txtslsubbg2.selectedIndex=0;
		}
		
		var seedstage=document.frmaddDepartment.seedstage.value;
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.txtslBagsg2.value!="")
		var Bagsv2=document.frmaddDepartment.txtslBagsg2.value;
		else
		var Bagsv2="";
		if(document.frmaddDepartment.txtslqtyg2.value!="")
		var qtyv2=document.frmaddDepartment.txtslqtyg2.value;
		else
		var qtyv2="";
		var wh=document.frmaddDepartment.txtslwhg2.value;
		showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2',slocnogood,Bagsv2,qtyv2,trid,seedstage,wh,itemcrpv);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing2.focus();
	}
}



function subbin3(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	var itemcrpv=document.frmaddDepartment.txtcrop.value;
	if(document.frmaddDepartment.txtslbing3.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		var w9=document.frmaddDepartment.txtslwhg9.value+document.frmaddDepartment.txtslbing9.value+document.frmaddDepartment.txtslsubbg9.value;
		var w10=document.frmaddDepartment.txtslwhg10.value+document.frmaddDepartment.txtslbing10.value+document.frmaddDepartment.txtslsubbg10.value;
		if(w3==w1 || w3==w2 || w3==w4 || w3==w5 || w3==w6 || w3==w7 || w3==w8 || w3==w9 || w3==w10)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDepartment.txtslsubbg3.selectedIndex=0;
		}
		
		var seedstage=document.frmaddDepartment.seedstage.value;
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.txtslBagsg3.value!="")
		var Bagsv2=document.frmaddDepartment.txtslBagsg3.value;
		else
		var Bagsv2="";
		if(document.frmaddDepartment.txtslqtyg3.value!="")
		var qtyv2=document.frmaddDepartment.txtslqtyg2.value;
		else
		var qtyv2="";
		var wh=document.frmaddDepartment.txtslwhg3.value;
		showUser(subbin2val,'slocrow3','subbin',itemv,'txtslsubbg3',slocnogood,Bagsv2,qtyv2,trid,seedstage,wh,itemcrpv);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing3.focus();
	}
}
function subbin4(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	var itemcrpv=document.frmaddDepartment.txtcrop.value;
	if(document.frmaddDepartment.txtslbing4.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		var w9=document.frmaddDepartment.txtslwhg9.value+document.frmaddDepartment.txtslbing9.value+document.frmaddDepartment.txtslsubbg9.value;
		var w10=document.frmaddDepartment.txtslwhg10.value+document.frmaddDepartment.txtslbing10.value+document.frmaddDepartment.txtslsubbg10.value;
		if(w4==w1 || w4==w3 || w4==w2 || w4==w5 || w4==w6 || w4==w7 || w4==w8 || w4==w9 || w4==w10)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDepartment.txtslsubbg4.selectedIndex=0;
		}
		
		var seedstage=document.frmaddDepartment.seedstage.value;
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.txtslBagsg4.value!="")
		var Bagsv2=document.frmaddDepartment.txtslBagsg4.value;
		else
		var Bagsv2="";
		if(document.frmaddDepartment.txtslqtyg4.value!="")
		var qtyv2=document.frmaddDepartment.txtslqtyg4.value;
		else
		var qtyv2="";
		var wh=document.frmaddDepartment.txtslwhg4.value;
		showUser(subbin2val,'slocrow4','subbin',itemv,'txtslsubbg4',slocnogood,Bagsv2,qtyv2,trid,seedstage,wh,itemcrpv);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing4.focus();
	}
}
function subbin5(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	var itemcrpv=document.frmaddDepartment.txtcrop.value;
	if(document.frmaddDepartment.txtslbing5.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		var w9=document.frmaddDepartment.txtslwhg9.value+document.frmaddDepartment.txtslbing9.value+document.frmaddDepartment.txtslsubbg9.value;
		var w10=document.frmaddDepartment.txtslwhg10.value+document.frmaddDepartment.txtslbing10.value+document.frmaddDepartment.txtslsubbg10.value;
		if(w5==w1 || w5==w3 || w5==w4 || w2==w5 || w5==w6 || w5==w7 || w5==w8 || w5==w9 || w5==w10)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDepartment.txtslsubbg5.selectedIndex=0;
		}
		
		var seedstage=document.frmaddDepartment.seedstage.value;
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.txtslBagsg5.value!="")
		var Bagsv2=document.frmaddDepartment.txtslBagsg5.value;
		else
		var Bagsv2="";
		if(document.frmaddDepartment.txtslqtyg5.value!="")
		var qtyv2=document.frmaddDepartment.txtslqtyg5.value;
		else
		var qtyv2="";
		var wh=document.frmaddDepartment.txtslwhg5.value;
		showUser(subbin2val,'slocrow5','subbin',itemv,'txtslsubbg5',slocnogood,Bagsv2,qtyv2,trid,seedstage,wh,itemcrpv);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing5.focus();
	}
}
function subbin6(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	var itemcrpv=document.frmaddDepartment.txtcrop.value;
	if(document.frmaddDepartment.txtslbing6.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		var w9=document.frmaddDepartment.txtslwhg9.value+document.frmaddDepartment.txtslbing9.value+document.frmaddDepartment.txtslsubbg9.value;
		var w10=document.frmaddDepartment.txtslwhg10.value+document.frmaddDepartment.txtslbing10.value+document.frmaddDepartment.txtslsubbg10.value;
		if(w6==w1 || w6==w3 || w6==w4 || w6==w5 || w6==w2 || w6==w7 || w6==w8 || w6==w9 || w6==w10)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDepartment.txtslsubbg6.selectedIndex=0;
		}
		
		var seedstage=document.frmaddDepartment.seedstage.value;
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.txtslBagsg6.value!="")
		var Bagsv2=document.frmaddDepartment.txtslBagsg6.value;
		else
		var Bagsv2="";
		if(document.frmaddDepartment.txtslqtyg6.value!="")
		var qtyv2=document.frmaddDepartment.txtslqtyg6.value;
		else
		var qtyv2="";
		var wh=document.frmaddDepartment.txtslwhg6.value;
		showUser(subbin2val,'slocrow6','subbin',itemv,'txtslsubbg6',slocnogood,Bagsv2,qtyv2,trid,seedstage,wh,itemcrpv);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing6.focus();
	}
}
function subbin7(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	var itemcrpv=document.frmaddDepartment.txtcrop.value;
	if(document.frmaddDepartment.txtslbing7.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		var w9=document.frmaddDepartment.txtslwhg9.value+document.frmaddDepartment.txtslbing9.value+document.frmaddDepartment.txtslsubbg9.value;
		var w10=document.frmaddDepartment.txtslwhg10.value+document.frmaddDepartment.txtslbing10.value+document.frmaddDepartment.txtslsubbg10.value;
		if(w7==w1 || w7==w3 || w7==w4 || w7==w5 || w7==w6 || w2==w7 || w7==w8 || w7==w9 || w7==w10)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDepartment.txtslsubbg7.selectedIndex=0;
		}
		
		var seedstage=document.frmaddDepartment.seedstage.value;
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.txtslBagsg7.value!="")
		var Bagsv2=document.frmaddDepartment.txtslBagsg7.value;
		else
		var Bagsv2="";
		if(document.frmaddDepartment.txtslqtyg7.value!="")
		var qtyv2=document.frmaddDepartment.txtslqtyg7.value;
		else
		var qtyv2="";
		var wh=document.frmaddDepartment.txtslwhg7.value;
		showUser(subbin2val,'slocrow7','subbin',itemv,'txtslsubbg7',slocnogood,Bagsv2,qtyv2,trid,seedstage,wh,itemcrpv);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing7.focus();
	}
}
function subbin8(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	var itemcrpv=document.frmaddDepartment.txtcrop.value;
	if(document.frmaddDepartment.txtslbing8.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		var w9=document.frmaddDepartment.txtslwhg9.value+document.frmaddDepartment.txtslbing9.value+document.frmaddDepartment.txtslsubbg9.value;
		var w10=document.frmaddDepartment.txtslwhg10.value+document.frmaddDepartment.txtslbing10.value+document.frmaddDepartment.txtslsubbg10.value;
		if(w8==w1 || w8==w3 || w8==w4 || w8==w5 || w8==w6 || w8==w7 || w2==w8 || w8==w9 || w8==w10)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDepartment.txtslsubbg8.selectedIndex=0;
		}
		
		var seedstage=document.frmaddDepartment.seedstage.value;
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.txtslBagsg8.value!="")
		var Bagsv2=document.frmaddDepartment.txtslBagsg8.value;
		else
		var Bagsv2="";
		if(document.frmaddDepartment.txtslqtyg2.value!="")
		var qtyv2=document.frmaddDepartment.txtslqtyg8.value;
		else
		var qtyv2="";
		var wh=document.frmaddDepartment.txtslwhg8.value;
		showUser(subbin2val,'slocrow8','subbin',itemv,'txtslsubbg8',slocnogood,Bagsv2,qtyv2,trid,seedstage,wh,itemcrpv);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing8.focus();
	}
}
function subbin9(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	var itemcrpv=document.frmaddDepartment.txtcrop.value;
	if(document.frmaddDepartment.txtslbing9.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		var w9=document.frmaddDepartment.txtslwhg9.value+document.frmaddDepartment.txtslbing9.value+document.frmaddDepartment.txtslsubbg9.value;
		var w10=document.frmaddDepartment.txtslwhg10.value+document.frmaddDepartment.txtslbing10.value+document.frmaddDepartment.txtslsubbg10.value;
		if(w9==w1 || w9==w3 || w9==w4 || w9==w5 || w9==w6 || w9==w7 || w9==w8 || w2==w9 || w9==w10)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDepartment.txtslsubbg9.selectedIndex=0;
		}
		
		var seedstage=document.frmaddDepartment.seedstage.value;
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.txtslBagsg9.value!="")
		var Bagsv2=document.frmaddDepartment.txtslBagsg9.value;
		else
		var Bagsv2="";
		if(document.frmaddDepartment.txtslqtyg9.value!="")
		var qtyv2=document.frmaddDepartment.txtslqtyg9.value;
		else
		var qtyv2="";
		var wh=document.frmaddDepartment.txtslwhg9.value;
		showUser(subbin2val,'slocrow9','subbin',itemv,'txtslsubbg9',slocnogood,Bagsv2,qtyv2,trid,seedstage,wh,itemcrpv);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing9.focus();
	}
}
function subbin10(subbin2val)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	var itemcrpv=document.frmaddDepartment.txtcrop.value;
	if(document.frmaddDepartment.txtslbing10.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		var w3=document.frmaddDepartment.txtslwhg3.value+document.frmaddDepartment.txtslbing3.value+document.frmaddDepartment.txtslsubbg3.value;
		var w4=document.frmaddDepartment.txtslwhg4.value+document.frmaddDepartment.txtslbing4.value+document.frmaddDepartment.txtslsubbg4.value;
		var w5=document.frmaddDepartment.txtslwhg5.value+document.frmaddDepartment.txtslbing5.value+document.frmaddDepartment.txtslsubbg5.value;
		var w6=document.frmaddDepartment.txtslwhg6.value+document.frmaddDepartment.txtslbing6.value+document.frmaddDepartment.txtslsubbg6.value;
		var w7=document.frmaddDepartment.txtslwhg7.value+document.frmaddDepartment.txtslbing7.value+document.frmaddDepartment.txtslsubbg7.value;
		var w8=document.frmaddDepartment.txtslwhg8.value+document.frmaddDepartment.txtslbing8.value+document.frmaddDepartment.txtslsubbg8.value;
		var w9=document.frmaddDepartment.txtslwhg9.value+document.frmaddDepartment.txtslbing9.value+document.frmaddDepartment.txtslsubbg9.value;
		var w10=document.frmaddDepartment.txtslwhg10.value+document.frmaddDepartment.txtslbing10.value+document.frmaddDepartment.txtslsubbg10.value;
		if(w10==w1 || w10==w3 || w10==w4 || w10==w5 || w10==w6 || w10==w7 || w10==w8 || w10==w9 || w2==w10)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDepartment.txtslsubbg10.selectedIndex=0;
		}
		
		var seedstage=document.frmaddDepartment.seedstage.value;
		var slocnogood=document.frmaddDepartment.txtlot1.value;
		var trid=document.frmaddDepartment.trid.value;
		if(document.frmaddDepartment.txtslBagsg10.value!="")
		var Bagsv2=document.frmaddDepartment.txtslBagsg10.value;
		else
		var Bagsv2="";
		if(document.frmaddDepartment.txtslqtyg10.value!="")
		var qtyv2=document.frmaddDepartment.txtslqtyg10.value;
		else
		var qtyv2="";
		var wh=document.frmaddDepartment.txtslwhg10.value;
		showUser(subbin2val,'slocrow10','subbin',itemv,'txtslsubbg10',slocnogood,Bagsv2,qtyv2,trid,seedstage,wh,itemcrpv);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing10.focus();
	}
}





function Bagsf1(Bags1val)
{
	if(document.frmaddDepartment.txtslsubbg1.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslBagsg1.value="";
		//document.frmaddDepartment.txtslsubbg1.focus();
	}
	if(document.frmaddDepartment.txtslBagsg1.value!="")
	{
		/*if(parseInt(document.frmaddDepartment.txtslBagsg1.value)==0 || document.frmaddDepartment.txtslBagsg1.value=="")
		{
			alert("Bags can not be ZERO");
			document.frmaddDepartment.txtslBagsg1.value="";
			//document.frmaddDepartment.txtslBagsg1.focus();
			
		}*/
		var exu=0;
		if(document.frmaddDepartment.exBagsg1.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exBagsg1.value);
			document.frmaddDepartment.balBagsg1.value=parseInt(document.frmaddDepartment.txtslBagsg1.value);
	}
	else
	{
	document.frmaddDepartment.balBagsg1.value="";
	}
}
function Bagsf2(Bags2val)
{
	//alert(document.frmaddDepartment.txtslsubbg2.value);
	if(document.frmaddDepartment.txtslsubbg2.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslBagsg2.value="";
		//document.frmaddDepartment.txtslsubbg2.focus();
	}
	if(document.frmaddDepartment.txtslBagsg2.value!="")
	{
		/*if(document.frmaddDepartment.txtslBagsg2.value==0 || document.frmaddDepartment.txtslBagsg2.value=="0")
		{
			alert("Bags can not be ZERO");
			document.frmaddDepartment.txtslBagsg2.value="";
			document.frmaddDepartment.txtslBagsg2.focus();
		}*/
		var exu=0;
		if(document.frmaddDepartment.exBagsg2.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exBagsg2.value);
			document.frmaddDepartment.balBagsg2.value=parseInt(document.frmaddDepartment.txtslBagsg2.value);
	}
	else
	{
	document.frmaddDepartment.balBagsg2.value="";
	}
}
function Bagsf3(Bags2val)
{
	//alert(document.frmaddDepartment.txtslsubbg3.value);
	if(document.frmaddDepartment.txtslsubbg3.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslBagsg3.value="";
		//document.frmaddDepartment.txtslsubbg3.focus();
	}
	if(document.frmaddDepartment.txtslBagsg3.value!="")
	{
		/*if(document.frmaddDepartment.txtslBagsg3.value==0 || document.frmaddDepartment.txtslBagsg3.value=="0")
		{
			alert("Bags can not be ZERO");
			document.frmaddDepartment.txtslBagsg3.value="";
			document.frmaddDepartment.txtslBagsg3.focus();
		}*/
		var exu=0;
		if(document.frmaddDepartment.exBagsg3.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exBagsg3.value);
			document.frmaddDepartment.balBagsg3.value=parseInt(document.frmaddDepartment.txtslBagsg3.value);
	}
	else
	{
	document.frmaddDepartment.balBagsg3.value="";
	}
}


function Bagsf4(Bags2val)
{
	//alert(document.frmaddDepartment.txtslsubbg4.value);
	if(document.frmaddDepartment.txtslsubbg4.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslBagsg4.value="";
		//document.frmaddDepartment.txtslsubbg4.focus();
	}
	if(document.frmaddDepartment.txtslBagsg4.value!="")
	{
		/*if(document.frmaddDepartment.txtslBagsg4.value==0 || document.frmaddDepartment.txtslBagsg4.value=="0")
		{
			alert("Bags can not be ZERO");
			document.frmaddDepartment.txtslBagsg4.value="";
			document.frmaddDepartment.txtslBagsg4.focus();
		}*/
		var exu=0;
		if(document.frmaddDepartment.exBagsg4.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exBagsg4.value);
			document.frmaddDepartment.balBagsg4.value=parseInt(document.frmaddDepartment.txtslBagsg4.value);
	}
	else
	{
	document.frmaddDepartment.balBagsg4.value="";
	}
}
function Bagsf5(Bags2val)
{
	//alert(document.frmaddDepartment.txtslsubbg5.value);
	if(document.frmaddDepartment.txtslsubbg5.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslBagsg5.value="";
		//document.frmaddDepartment.txtslsubbg5.focus();
	}
	if(document.frmaddDepartment.txtslBagsg5.value!="")
	{
		/*if(document.frmaddDepartment.txtslBagsg5.value==0 || document.frmaddDepartment.txtslBagsg5.value=="0")
		{
			alert("Bags can not be ZERO");
			document.frmaddDepartment.txtslBagsg5.value="";
			document.frmaddDepartment.txtslBagsg5.focus();
		}*/
		var exu=0;
		if(document.frmaddDepartment.exBagsg5.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exBagsg5.value);
			document.frmaddDepartment.balBagsg5.value=parseInt(document.frmaddDepartment.txtslBagsg5.value);
	}
	else
	{
	document.frmaddDepartment.balBagsg5.value="";
	}
}
function Bagsf6(Bags2val)
{
	//alert(document.frmaddDepartment.txtslsubbg6.value);
	if(document.frmaddDepartment.txtslsubbg6.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslBagsg6.value="";
		//document.frmaddDepartment.txtslsubbg6.focus();
	}
	if(document.frmaddDepartment.txtslBagsg6.value!="")
	{
		/*if(document.frmaddDepartment.txtslBagsg6.value==0 || document.frmaddDepartment.txtslBagsg6.value=="0")
		{
			alert("Bags can not be ZERO");
			document.frmaddDepartment.txtslBagsg6.value="";
			document.frmaddDepartment.txtslBagsg6.focus();
		}*/
		var exu=0;
		if(document.frmaddDepartment.exBagsg6.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exBagsg6.value);
			document.frmaddDepartment.balBagsg6.value=parseInt(document.frmaddDepartment.txtslBagsg6.value);
	}
	else
	{
	document.frmaddDepartment.balBagsg6.value="";
	}
}
function Bagsf7(Bags2val)
{
	//alert(document.frmaddDepartment.txtslsubbg7.value);
	if(document.frmaddDepartment.txtslsubbg7.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslBagsg7.value="";
		//document.frmaddDepartment.txtslsubbg7.focus();
	}
	if(document.frmaddDepartment.txtslBagsg7.value!="")
	{
		/*if(document.frmaddDepartment.txtslBagsg7.value==0 || document.frmaddDepartment.txtslBagsg7.value=="0")
		{
			alert("Bags can not be ZERO");
			document.frmaddDepartment.txtslBagsg7.value="";
			document.frmaddDepartment.txtslBagsg7.focus();
		}*/
		var exu=0;
		if(document.frmaddDepartment.exBagsg7.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exBagsg7.value);
			document.frmaddDepartment.balBagsg7.value=parseInt(document.frmaddDepartment.txtslBagsg7.value);
	}
	else
	{
	document.frmaddDepartment.balBagsg7.value="";
	}
}
function Bagsf8(Bags2val)
{
	//alert(document.frmaddDepartment.txtslsubbg8.value);
	if(document.frmaddDepartment.txtslsubbg8.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslBagsg8.value="";
		//document.frmaddDepartment.txtslsubbg8.focus();
	}
	if(document.frmaddDepartment.txtslBagsg8.value!="")
	{
		/*if(document.frmaddDepartment.txtslBagsg8.value==0 || document.frmaddDepartment.txtslBagsg8.value=="0")
		{
			alert("Bags can not be ZERO");
			document.frmaddDepartment.txtslBagsg8.value="";
			document.frmaddDepartment.txtslBagsg8.focus();
		}*/
		var exu=0;
		if(document.frmaddDepartment.exBagsg8.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exBagsg8.value);
			document.frmaddDepartment.balBagsg8.value=parseInt(document.frmaddDepartment.txtslBagsg8.value);
	}
	else
	{
	document.frmaddDepartment.balBagsg8.value="";
	}
}
function Bagsf9(Bags2val)
{
	//alert(document.frmaddDepartment.txtslsubbg9.value);
	if(document.frmaddDepartment.txtslsubbg9.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslBagsg9.value="";
		//document.frmaddDepartment.txtslsubbg9.focus();
	}
	if(document.frmaddDepartment.txtslBagsg9.value!="")
	{
		/*if(document.frmaddDepartment.txtslBagsg9.value==0 || document.frmaddDepartment.txtslBagsg9.value=="0")
		{
			alert("Bags can not be ZERO");
			document.frmaddDepartment.txtslBagsg9.value="";
			document.frmaddDepartment.txtslBagsg9.focus();
		}*/
		var exu=0;
		if(document.frmaddDepartment.exBagsg9.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exBagsg9.value);
			document.frmaddDepartment.balBagsg9.value=parseInt(document.frmaddDepartment.txtslBagsg9.value);
	}
	else
	{
	document.frmaddDepartment.balBagsg9.value="";
	}
}
function Bagsf10(Bags2val)
{
	//alert(document.frmaddDepartment.txtslsubbg10.value);
	if(document.frmaddDepartment.txtslsubbg10.value=="")
	{
		alert("Please select Sub Bin");
		document.frmaddDepartment.txtslBagsg10.value="";
		//document.frmaddDepartment.txtslsubbg10.focus();
	}
	if(document.frmaddDepartment.txtslBagsg10.value!="")
	{
		/*if(document.frmaddDepartment.txtslBagsg10.value==0 || document.frmaddDepartment.txtslBagsg10.value=="0")
		{
			alert("Bags can not be ZERO");
			document.frmaddDepartment.txtslBagsg10.value="";
			document.frmaddDepartment.txtslBagsg10.focus();
		}*/
		var exu=0;
		if(document.frmaddDepartment.exBagsg10.value=="")
		exu=0;
		else
		exu=parseInt(document.frmaddDepartment.exBagsg10.value);
			document.frmaddDepartment.balBagsg10.value=parseInt(document.frmaddDepartment.txtslBagsg10.value);
	}
	else
	{
	document.frmaddDepartment.balBagsg10.value="";
	}
}



function qtyf1(qty1val)
{	
	if(document.frmaddDepartment.txtslBagsg1.value=="")
	{
		alert("Please enter Bags");
		document.frmaddDepartment.txtslqtyg1.value="";
	}
	if(document.frmaddDepartment.txtslqtyg1.value!="")
	{
			/*if(document.frmaddDepartment.txtslqtyg1.value==0 || document.frmaddDepartment.txtslqtyg1.value=="0")
			{
				alert("Quantity can not be ZERO");
				document.frmaddDepartment.txtslqtyg1.value="";
				document.frmaddDepartment.txtslqtyg1.focus();
			}*/
			
		var exq=0;
		if(document.frmaddDepartment.exqtyg1.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqtyg1.value);
		document.frmaddDepartment.balqtyg1.value=parseFloat(document.frmaddDepartment.txtslqtyg1.value);
	}
	else
	{
	document.frmaddDepartment.balqtyg1.value="";
	}

}

function qtyf2(qty2val)
{
	if(document.frmaddDepartment.txtslBagsg2.value=="")
	{
		alert("Please enter Bags");
		document.frmaddDepartment.txtslqtyg2.value="";
		//document.frmaddDepartment.txtslBagsg2.focus();
	}
	document.frmaddDepartment.txtslqtyg2.value=parseFloat(qty2val);
	//alert(qty2val);
	//alert(document.frmaddDepartment.txtslqtyg2.value);
	if(document.frmaddDepartment.txtslqtyg2.value!="")
	{
		/*if(document.frmaddDepartment.txtslqtyg2.value==0 || document.frmaddDepartment.txtslqtyg2.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDepartment.txtslqtyg2.value="";
			document.frmaddDepartment.txtslqtyg2.focus();
		}*/
		var exq=0;
		if(document.frmaddDepartment.exqtyg2.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqtyg2.value);
		//alert(document.frmaddDepartment.txtslqtyg2.value);
		document.frmaddDepartment.balqtyg2.value=parseFloat(document.frmaddDepartment.txtslqtyg2.value);
	}
	else
	{
	document.frmaddDepartment.balqtyg2.value="";
	}
}


function qtyf3(qty2val)
{
	if(document.frmaddDepartment.txtslBagsg3.value=="")
	{
		alert("Please enter Bags");
		document.frmaddDepartment.txtslqtyg3.value="";
		//document.frmaddDepartment.txtslBagsg3.focus();
	}
	document.frmaddDepartment.txtslqtyg3.value=parseFloat(qty2val);
	if(document.frmaddDepartment.txtslqtyg3.value!="")
	{
		/*if(document.frmaddDepartment.txtslqtyg3.value==0 || document.frmaddDepartment.txtslqtyg3.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDepartment.txtslqtyg3.value="";
			document.frmaddDepartment.txtslqtyg3.focus();
		}*/
		var exq=0;
		if(document.frmaddDepartment.exqtyg3.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqtyg3.value);
		document.frmaddDepartment.balqtyg3.value=parseFloat(document.frmaddDepartment.txtslqtyg3.value);
	}
	else
	{
	document.frmaddDepartment.balqtyg3.value="";
	}
}
function qtyf4(qty2val)
{
	if(document.frmaddDepartment.txtslBagsg4.value=="")
	{
		alert("Please enter Bags");
		document.frmaddDepartment.txtslqtyg4.value="";
		//document.frmaddDepartment.txtslBagsg4.focus();
	}
	document.frmaddDepartment.txtslqtyg4.value=parseFloat(qty2val);
	if(document.frmaddDepartment.txtslqtyg4.value!="")
	{
		/*if(document.frmaddDepartment.txtslqtyg4.value==0 || document.frmaddDepartment.txtslqtyg4.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDepartment.txtslqtyg4.value="";
			document.frmaddDepartment.txtslqtyg4.focus();
		}*/
		var exq=0;
		if(document.frmaddDepartment.exqtyg4.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqtyg4.value);
		document.frmaddDepartment.balqtyg4.value=parseFloat(document.frmaddDepartment.txtslqtyg4.value);
	}
	else
	{
	document.frmaddDepartment.balqtyg4.value="";
	}
}
function qtyf5(qty2val)
{
	if(document.frmaddDepartment.txtslBagsg5.value=="")
	{
		alert("Please enter Bags");
		document.frmaddDepartment.txtslqtyg5.value="";
		//document.frmaddDepartment.txtslBagsg5.focus();
	}
	document.frmaddDepartment.txtslqtyg5.value=parseFloat(qty2val);
	if(document.frmaddDepartment.txtslqtyg5.value!="")
	{
		/*if(document.frmaddDepartment.txtslqtyg5.value==0 || document.frmaddDepartment.txtslqtyg5.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDepartment.txtslqtyg5.value="";
			document.frmaddDepartment.txtslqtyg5.focus();
		}*/
		var exq=0;
		if(document.frmaddDepartment.exqtyg5.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqtyg5.value);
		document.frmaddDepartment.balqtyg5.value=parseFloat(document.frmaddDepartment.txtslqtyg5.value);
	}
	else
	{
	document.frmaddDepartment.balqtyg5.value="";
	}
}
function qtyf6(qty2val)
{
	if(document.frmaddDepartment.txtslBagsg6.value=="")
	{
		alert("Please enter Bags");
		document.frmaddDepartment.txtslqtyg6.value="";
		//document.frmaddDepartment.txtslBagsg6.focus();
	}
	document.frmaddDepartment.txtslqtyg6.value=parseFloat(qty2val);
	if(document.frmaddDepartment.txtslqtyg6.value!="")
	{
		/*if(document.frmaddDepartment.txtslqtyg6.value==0 || document.frmaddDepartment.txtslqtyg6.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDepartment.txtslqtyg6.value="";
			document.frmaddDepartment.txtslqtyg6.focus();
		}*/
		var exq=0;
		if(document.frmaddDepartment.exqtyg6.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqtyg6.value);
		document.frmaddDepartment.balqtyg6.value=parseFloat(document.frmaddDepartment.txtslqtyg6.value);
	}
	else
	{
	document.frmaddDepartment.balqtyg6.value="";
	}
}

function qtyf7(qty2val)
{
	if(document.frmaddDepartment.txtslBagsg7.value=="")
	{
		alert("Please enter Bags");
		document.frmaddDepartment.txtslqtyg7.value="";
		//document.frmaddDepartment.txtslBagsg2.focus();
	}
	document.frmaddDepartment.txtslqtyg7.value=parseFloat(qty2val);
	if(document.frmaddDepartment.txtslqtyg7.value!="")
	{
		/*if(document.frmaddDepartment.txtslqtyg7.value==0 || document.frmaddDepartment.txtslqtyg7.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDepartment.txtslqtyg7.value="";
			document.frmaddDepartment.txtslqtyg7.focus();
		}*/
		var exq=0;
		if(document.frmaddDepartment.exqtyg7.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqtyg7.value);
		document.frmaddDepartment.balqtyg7.value=parseFloat(document.frmaddDepartment.txtslqtyg7.value);
	}
	else
	{
	document.frmaddDepartment.balqtyg2.value="";
	}
}
function qtyf8(qty2val)
{
	if(document.frmaddDepartment.txtslBagsg8.value=="")
	{
		alert("Please enter Bags");
		document.frmaddDepartment.txtslqtyg8.value="";
		//document.frmaddDepartment.txtslBagsg8.focus();
	}
	document.frmaddDepartment.txtslqtyg8.value=parseFloat(qty2val);
	if(document.frmaddDepartment.txtslqtyg8.value!="")
	{
		/*if(document.frmaddDepartment.txtslqtyg8.value==0 || document.frmaddDepartment.txtslqtyg8.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDepartment.txtslqtyg8.value="";
			document.frmaddDepartment.txtslqtyg8.focus();
		}*/
		var exq=0;
		if(document.frmaddDepartment.exqtyg8.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqtyg8.value);
		document.frmaddDepartment.balqtyg8.value=parseFloat(document.frmaddDepartment.txtslqtyg8.value);
	}
	else
	{
	document.frmaddDepartment.balqtyg8.value="";
	}
}
function qtyf9(qty2val)
{
	if(document.frmaddDepartment.txtslBagsg9.value=="")
	{
		alert("Please enter Bags");
		document.frmaddDepartment.txtslqtyg9.value="";
		//document.frmaddDepartment.txtslBagsg9.focus();
	}
	document.frmaddDepartment.txtslqtyg9.value=parseFloat(qty2val);
	if(document.frmaddDepartment.txtslqtyg9.value!="")
	{
		/*if(document.frmaddDepartment.txtslqtyg9.value==0 || document.frmaddDepartment.txtslqtyg9.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDepartment.txtslqtyg9.value="";
			document.frmaddDepartment.txtslqtyg9.focus();
		}*/
		var exq=0;
		if(document.frmaddDepartment.exqtyg9.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqtyg9.value);
		document.frmaddDepartment.balqtyg9.value=parseFloat(document.frmaddDepartment.txtslqtyg9.value);
	}
	else
	{
	document.frmaddDepartment.balqtyg9.value="";
	}
}
function qtyf10(qty2val)
{
	if(document.frmaddDepartment.txtslBagsg10.value=="")
	{
		alert("Please enter Bags");
		document.frmaddDepartment.txtslqtyg10.value="";
		//document.frmaddDepartment.txtslBagsg10.focus();
	}
	document.frmaddDepartment.txtslqtyg10.value=parseFloat(qty2val);
	if(document.frmaddDepartment.txtslqtyg10.value!="")
	{
		/*if(document.frmaddDepartment.txtslqtyg10.value==0 || document.frmaddDepartment.txtslqtyg10.value=="0")
		{
			alert("Quantity can not be ZERO");
			document.frmaddDepartment.txtslqtyg10.value="";
			document.frmaddDepartment.txtslqtyg10.focus();
		}*/
		var exq=0;
		if(document.frmaddDepartment.exqtyg10.value=="")
		exq=0;
		else
		exq=parseFloat(document.frmaddDepartment.exqtyg10.value);
		document.frmaddDepartment.balqtyg10.value=parseFloat(document.frmaddDepartment.txtslqtyg10.value);
	}
	else
	{
	document.frmaddDepartment.balqtyg10.value="";
	}
}

	function pform()
	{
		/*<!--if(document.frmaddDepartment.txtdate.value=="00-00-0000" || document.frmaddDepartment.txtdate.value=="")
		{
			alert("Please Check Transaction Date");
			//document.frmaddDepartment.txtcla.focus();
			return false;
		}-->*/
		if(document.frmaddDepartment.txtcrop.value=="")
		{
			alert("Please select Crop first");
			document.frmaddDepartment.txtcrop.focus();
			return false;
		}
		if(document.frmaddDepartment.txtvariety.value=="")
		{
			alert("Please select Variety first");
			document.frmaddDepartment.txtvariety.focus();
			return false;
		}
		if(document.frmaddDepartment.txtlot1.value=="")
		{
			alert("Please select Lot No.");
			return false;
		} 
		
		if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslwhg1.value==""))
		{
			alert("Warehouse Not selected");	
			//document.frmaddDepartment.tblslocnog.focus();
			return false;
		} 
		if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslbing1.value==""))
		{
			alert("Bin Not selected");	
			//document.frmaddDepartment.tblslocnog.focus();
			return false;
		} 
		if((document.frmaddDepartment.txtslqtyg1.value > 0) && (document.frmaddDepartment.txtslsubbg1.value==""))
		{
		
			alert("Sub Bin Not selected");	
			//document.frmaddDepartment.txtslsubbg1.focus();
			return false;		
				
		}
		if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslwhg2.value==""))
		{
			alert("Warehouse Not selected");	
			//document.frmaddDepartment.tblslocnog.focus();
			return false;
		} 
		if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslbing2.value==""))
		{
			alert("Bin Not selected");	
			//document.frmaddDepartment.tblslocnog.focus();
			return false;
		} 
		if((document.frmaddDepartment.txtslqtyg2.value > 0) && (document.frmaddDepartment.txtslsubbg2.value==""))
		{
			alert("Sub Bin Not selected");	
			//document.frmaddDepartment.txtslsubbg2.focus();
			return false;		
		
		}
		if(document.frmaddDepartment.ocnt.value==10)
		{
			if((document.frmaddDepartment.txtslqtyg3.value > 0) && (document.frmaddDepartment.txtslsubbg3.value==""))
			{
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg2.focus();
				return false;		
			
			}
			if((document.frmaddDepartment.txtslqtyg4.value > 0) && (document.frmaddDepartment.txtslsubbg4.value==""))
			{
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg2.focus();
				return false;		
			
			}
			if((document.frmaddDepartment.txtslqtyg5.value > 0) && (document.frmaddDepartment.txtslsubbg5.value==""))
			{
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg2.focus();
				return false;		
			
			}
			if((document.frmaddDepartment.txtslqtyg6.value > 0) && (document.frmaddDepartment.txtslsubbg6.value==""))
			{
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg2.focus();
				return false;		
			
			}
			if((document.frmaddDepartment.txtslqtyg7.value > 0) && (document.frmaddDepartment.txtslsubbg7.value==""))
			{
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg2.focus();
				return false;		
			
			}
			if((document.frmaddDepartment.txtslqtyg8.value > 0) && (document.frmaddDepartment.txtslsubbg8.value==""))
			{
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg2.focus();
				return false;		
			
			}
			if((document.frmaddDepartment.txtslqtyg9.value > 0) && (document.frmaddDepartment.txtslsubbg9.value==""))
			{
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg2.focus();
				return false;		
			
			}
			if((document.frmaddDepartment.txtslqtyg10.value > 0) && (document.frmaddDepartment.txtslsubbg10.value==""))
			{
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg2.focus();
				return false;		
			
			}
		}
	
		if(document.frmaddDepartment.txtlot1.value!="")
		{
			var u1=document.frmaddDepartment.txtslBagsg1.value;
			var u2=document.frmaddDepartment.txtslBagsg2.value;
			var q1=document.frmaddDepartment.txtslqtyg1.value;
			var q2=document.frmaddDepartment.txtslqtyg2.value;
			var d=document.frmaddDepartment.otqty.value;
			var u=document.frmaddDepartment.otBags.value;
					
			if(q1=="")q1=0;if(q2=="")q2=0;
			if(u1=="")u1=0;if(u2=="")u2=0;
			if(d=="")d=0;
			if(u=="")u=0;
			var qtyd=parseFloat(q1)+parseFloat(q2);
			var Bagsd=parseInt(u1)+parseInt(u2);
			var f=0;
			if(document.frmaddDepartment.ocnt.value>2)
			{
				for(var i=3; i<=document.frmaddDepartment.ocnt.value; i++)
				{
					var Bags="Bags"+[i];
					var qty="qty"+[i];
					var u1=document.getElementById(Bags).value;
					var q1=document.getElementById(qty).value;
					
					if(q1=="")q1=0;
					if(u1=="")u1=0;
					//alert(i);alert(q1);alert(u1);
					qtyd=parseFloat(qtyd)+parseFloat(q1);
					Bagsd=parseInt(Bagsd)+parseInt(u1);
					//alert(Bagsd1);alert(qtyd1);alert(u);alert(d);
				}
			}
			/*if(document.frmaddDepartment.ocnt.value==10)
			{
				var u3=document.frmaddDepartment.txtslBagsg3.value;
				var u4=document.frmaddDepartment.txtslBagsg4.value;
				var u5=document.frmaddDepartment.txtslBagsg5.value;
				var u6=document.frmaddDepartment.txtslBagsg6.value;
				var u7=document.frmaddDepartment.txtslBagsg7.value;
				var u8=document.frmaddDepartment.txtslBagsg8.value;
				var u9=document.frmaddDepartment.txtslBagsg9.value;
				var u10=document.frmaddDepartment.txtslBagsg10.value;
				var q3=document.frmaddDepartment.txtslqtyg3.value;
				var q4=document.frmaddDepartment.txtslqtyg4.value;
				var q5=document.frmaddDepartment.txtslqtyg5.value;
				var q6=document.frmaddDepartment.txtslqtyg6.value;
				var q7=document.frmaddDepartment.txtslqtyg7.value;
				var q8=document.frmaddDepartment.txtslqtyg8.value;
				var q9=document.frmaddDepartment.txtslqtyg9.value;
				var q10=document.frmaddDepartment.txtslqtyg10.value;
				
				if(q1=="")q1=0;if(q2=="")q2=0;if(q3=="")q3=0;if(q4=="")q4=0;if(q5=="")q5=0;if(q6=="")q6=0;if(q7=="")q7=0;if(q8=="")q8=0;if(q9=="")q9=0;if(q10=="")q10=0;
				if(u1=="")u1=0;if(u2=="")u2=0;if(u3=="")u3=0;if(u4=="")u4=0;if(u5=="")u5=0;if(u6=="")u6=0;if(u7=="")u7=0;if(u8=="")u8=0;if(u9=="")u9=0;if(u10=="")u10=0;
				if(d=="")d=0;
				if(u=="")u=0;
				var qtyd=parseFloat(q1)+parseFloat(q2)+parseFloat(q3)+parseFloat(q4)+parseFloat(q5)+parseFloat(q6)+parseFloat(q7)+parseFloat(q8)+parseFloat(q9)+parseFloat(q10);
				var Bagsd=parseInt(u1)+parseInt(u2)+parseInt(u3)+parseInt(u4)+parseInt(u5)+parseInt(u6)+parseInt(u7)+parseInt(u8)+parseInt(u9)+parseInt(u10);
			}*/
				/*if(parseFloat(d) != parseFloat(qtyd))
				{
				alert("Please check. Quantity distributed in Bins not matching with Quantity to be Update");
				return false;
				f=1;
				}*/
				if(parseFloat(document.frmaddDepartment.txtqtyg.value) != parseFloat(qtyd))
				{
				alert("Please check. Balance Quantity distributed in Bins not matching with  Total Quantity");
				return false;
				f=1;
				}
				/*if(qtyd==0)
				{
				alert("Please check. Quantity distributed in Bins cannot be Zero or Blank");
				return false;
				f=1;
				}*/
				if(parseFloat(d) == parseFloat(qtyd))
				{
				document.frmaddDepartment.otBags.value=0;
				}
				if((parseFloat(d) > parseFloat(qtyd)) && (parseInt(Bagsd) >= parseInt(u)))
				{
				document.frmaddDepartment.otBags.value=1;
				}
				if(f==1)
				{
				return false;
				}
				else
				{
				var a=formPost(document.getElementById('mainform'));
				//alert(a);
				//document.frmaddDepartment.tttt.value=a;
				showUser(a,'maindiv','mformcc','','','','','');
				}
			}
			else
			{
				alert("Please select Lot No.");
				return false;
			}
}	

function pformupdate()
{

/*if(document.frmaddDepartment.txtdate.value=="00-00-0000" || document.frmaddDepartment.txtdate.value=="")
	{
		alert("Please Check Transaction Date");
		//document.frmaddDepartment.txtcla.focus();
		return false;
	}*/
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please select Crop first");
		document.frmaddDepartment.txtcrop.focus();
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please select Variety first");
		document.frmaddDepartment.txtvariety.focus();
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please select Lot No.");
		return false;
	} 
	
	if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslwhg1.value==""))
	{
		alert("Warehouse Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg1.value>0) && (document.frmaddDepartment.txtslbing1.value==""))
	{
		alert("Bin Not selected");	
		//document.frmaddDepartment.tblslocnog.focus();
		return false;
	} 
	if((document.frmaddDepartment.txtslqtyg1.value > 0) && (document.frmaddDepartment.txtslsubbg1.value==""))
		{
			
				alert("Sub Bin Not selected");	
				//document.frmaddDepartment.txtslsubbg1.focus();
				return false;		
			
		}
	
//alert(document.frmaddDepartment.cntchk.value);
			if(document.frmaddDepartment.txtlot1.value!="")
			{
				var q1=0;var q2=0;var q3=0;var q4=0;var q5=0;var q6=0;var q7=0;var q8=0;var q9=0;var q10=0;
				var u1=0;var u2=0;var u3=0;var u4=0;var u5=0;var u6=0;var u7=0;var u8=0;var u9=0;var u10=0;
				var q1=document.frmaddDepartment.txtslqtyg1.value;
				var u1=document.frmaddDepartment.txtslBagsg1.value;
				for(var i=2; i<=document.frmaddDepartment.cntchk.value; i++)
				{
					if(i==2)
					{
						if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslwhg2.value==""))
						{
							alert("Warehouse Not selected");	
							//document.frmaddDepartment.tblslocnog.focus();
							return false;
						} 
						if((document.frmaddDepartment.txtslqtyg2.value>0) && (document.frmaddDepartment.txtslbing2.value==""))
						{
							alert("Bin Not selected");	
							//document.frmaddDepartment.tblslocnog.focus();
							return false;
						} 
						if((document.frmaddDepartment.txtslqtyg2.value > 0) && (document.frmaddDepartment.txtslsubbg2.value==""))
						{
							alert("Sub Bin Not selected");	
							//document.frmaddDepartment.txtslsubbg2.focus();
							return false;		
						
						}
						var u2=document.frmaddDepartment.txtslBagsg2.value;
						var q2=document.frmaddDepartment.txtslqtyg2.value;
					}
					if(i==3)
					{
						var u3=document.frmaddDepartment.txtslBagsg3.value;
						var q3=document.frmaddDepartment.txtslqtyg3.value;
					}
					if(i==4)
					{
						var u4=document.frmaddDepartment.txtslBagsg4.value;
						var q4=document.frmaddDepartment.txtslqtyg4.value;
					}
					if(i==5)
					{
						var u5=document.frmaddDepartment.txtslBagsg5.value;
						var q5=document.frmaddDepartment.txtslqtyg5.value;
					}
					if(i==6)
					{
						var u6=document.frmaddDepartment.txtslBagsg6.value;
						var q6=document.frmaddDepartment.txtslqtyg6.value;
					}
					if(i==7)
					{
						var u7=document.frmaddDepartment.txtslBagsg7.value;
						var q7=document.frmaddDepartment.txtslqtyg7.value;
					}
					if(i==8)
					{
						var u8=document.frmaddDepartment.txtslBagsg8.value;
						var q8=document.frmaddDepartment.txtslqtyg8.value;
					}
					if(i==9)
					{
						var u9=document.frmaddDepartment.txtslBagsg9.value;
						var q9=document.frmaddDepartment.txtslqtyg9.value;
					}
					if(i==10)
					{
						var u10=document.frmaddDepartment.txtslBagsg10.value;
						var q10=document.frmaddDepartment.txtslqtyg10.value;
					}
				}
				var d=document.frmaddDepartment.otqty.value;
				var u=document.frmaddDepartment.otBags.value;
				//alert(q1);alert(q2);alert(q3);alert(q4);alert(q5);
				if(q1=="")q1=0;if(q2=="")q2=0;if(q3=="")q3=0;if(q4=="")q4=0;if(q5=="")q5=0;if(q6=="")q6=0;if(q7=="")q7=0;if(q8=="")q8=0;if(q9=="")q9=0;if(q10=="")q10=0;
				if(u1=="")u1=0;if(u2=="")u2=0;if(u3=="")u3=0;if(u4=="")u4=0;if(u5=="")u5=0;if(u6=="")u6=0;if(u7=="")u7=0;if(u8=="")u8=0;if(u9=="")u9=0;if(u10=="")u10=0;
				if(d=="")d=0;
				if(u=="")u=0;
				var qtyd=parseFloat(q1)+parseFloat(q2)+parseFloat(q3)+parseFloat(q4)+parseFloat(q5)+parseFloat(q6)+parseFloat(q7)+parseFloat(q8)+parseFloat(q9)+parseFloat(q10);
				var Bagsd=parseInt(u1)+parseInt(u2)+parseInt(u3)+parseInt(u4)+parseInt(u5)+parseInt(u6)+parseInt(u7)+parseInt(u8)+parseInt(u9)+parseInt(u10);
				var f=0;
				//alert(qtyd);alert(document.frmaddDepartment.txtqtyg.value);
				/*if(parseFloat(d) != parseFloat(qtyd))
				{
				alert("Please check. Quantity distributed in Bins not matching with Quantity to be Update");
				return false;
				f=1;
				}*/
				if(parseFloat(document.frmaddDepartment.txtqtyg.value) != parseFloat(qtyd))
				{
				alert("Please check. Balance Quantity distributed in Bins not matching with  Total Quantity");
				return false;
				f=1;
				}
				/*if(qtyd==0)
				{
				alert("Please check. Quantity distributed in Bins cannot be Zero or Blank");
				return false;
				f=1;
				}*/
				if(parseFloat(d) == parseFloat(qtyd))
				{
				document.frmaddDepartment.otBags.value=0;
				}
				if((parseFloat(d) > parseFloat(qtyd)) && (parseInt(Bagsd) >= parseInt(u)))
				{
				document.frmaddDepartment.otBags.value=1;
				}
				if(f==1)
				{
				return false;
				}
				else
				{
					var a=formPost(document.getElementById('mainform'));
					//alert(a);
					//document.frmaddDepartment.txtremarks.value=a;
					showUser(a,'maindiv','mformccupdate','','','','','');
				}
		}
		else
		{
				alert("Please select Lot No.");
				return false;
		}
	//}
}



function showsloc(val1, val2, val3, whn)
{
document.frmaddDepartment.oBags.value=val1;
document.frmaddDepartment.oqty.value=val2;
document.frmaddDepartment.orwoid.value=val3;
var trid=document.frmaddDepartment.trid.value;
//alert(val3);
			var opttyp=document.frmaddDepartment.txtlot1.value;
			var clasid=document.frmaddDepartment.txtcrop.value;
			var itmid=document.frmaddDepartment.txtvariety.value;
			//alert(opttyp);
showUser(opttyp,'subsubdiv','slocshowsubdamage',itmid,clasid,trid,val3,whn);
//document.getElementById('sloc1').style.display="block";
}

function editrec(v1,v2,v3,v4)
{
//alert(v1);
//alert(v2);
//alert(v3);
//etdrecgd
showUser(v1,'subsubdiv','etdrecsl',v2,v3,v4,'','');
//showUser(opttyp,'subsubdiv','slocshowsubdamage',itmid,clasid,itmid,'','');
}

function openslocpop()
{
if(document.frmaddDepartment.txtvariety.value=="")
{
 alert("Please Select Variety.");
 //document.frmaddDepartment.txt1.focus();
}
else
{
//var itm="Trading";
var crop=document.frmaddDepartment.txtcrop.value;
var variety=document.frmaddDepartment.txtvariety.value;
winHandle=window.open('getuser_sloc_lotno.php?crop='+crop+'&variety='+variety,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
}
function openprintsubbin(subid, bid, wid, lid)
{
/*alert(subid);
alert(bid);
alert(wid);*/
var itm="";
var tp="";
winHandle=window.open('subbin_sloc_details_print.php?slid='+subid+'&bid='+bid+'&wid='+wid+'&tp='+tp+'&pid='+itm+'&lid='+lid,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
//showUser(edtrecid,'postingsubtable','subformedt','','','','',''); 
}

</script>
<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_csw.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/csw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"   align="center"  class="midbgline">

		  
		  <!-- actual page start--->		  
		<table  width="974" cellpadding="0" cellspacing="0" bordercolor="#fa8283"  border="0">
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#fa8283" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#fa8283" style="border-bottom:solid; border-bottom-color:#fa8283" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - SLOC Updation </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	$sql1=mysqli_query($link,"select * from tbl_sloc_csw where slid='".$pid."' and plantcode='".$plantcode."'")or die(mysqli_error($link));
    $row=mysqli_fetch_array($sql1);

	$trid=$pid;	
	
	$tdate=$row['sldate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

	$sql_sub=mysqli_query($link,"select * from tbl_sloc_csw_sub where slocid='".$pid."' and plantcode='".$plantcode."'")or die(mysqli_error($link));
    $row_sub=mysqli_fetch_array($sql_sub);
	
$c=$row['crop'];
$f=$row['variety'];
$a=$row['lotno'];
	
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input name="code" value="<?php echo $row['code'];?>" type="hidden">
	  <input name="txtmtype" value="" type="hidden">
	   <input type="hidden" name="rettyp" value="" />
	  <input type="hidden" name="oups" value="" />
	  <input type="hidden" name="oqty" value="" />
	    <input type="hidden" name="oBags" value="" />
	   <input type="hidden" name="txtdate" value="<?php echo $tdate;?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">SLOC Updation </td>
</tr>
  <tr height="30">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
//$quer3=mysqli_query($link,"SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>

 <?php 
$quer3=mysqli_query($link,"select * from tblcrop order by cropname") or die(mysqli_error($link));
?>
		 <tr class="Dark" height="25">
           <td width="376"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" >--Select Crop--</option>
	<?php while($noticia_class = mysqli_fetch_array($quer3)) { ?>
		<option <?php if($row['crop']==$noticia_class['cropid']) { echo "Selected";} ?> value="<?php echo $noticia_class['cropid'];?>" />   
		<?php echo $noticia_class['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		<?php 
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where cropname='".$row['crop']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
$sql_qc=mysqli_query($link,"SELECT distinct(variety) FROM tbl_qctest WHERE crop='".$row['crop']."' and plantcode='".$plantcode."' and variety NOT RLIKE '^[-+0-9.E]+$'");
$tt=mysqli_num_rows($sql_qc);
?> 
		  <tr class="Dark" height="30">
<td align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td width="568" align="left" valign="middle" class="tbltext" id="vitem"  colspan="3">&nbsp;<select class="tbltext" name="txtvariety" id="itm" style="width:170px;"onchange="modetchk1(this.value)" >
<option value="" >--Select Variety--</option>
	<?php while($noticia_item = mysqli_fetch_array($itemqry)) { ?>
<option <?php if($row['variety']==$noticia_item['varietyid']){ echo "Selected";} ?> value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?>
		<?php while($noticia_item1 = mysqli_fetch_array($sql_qc)) { ?>
		<option <?php if($row['variety']==$noticia_item1['variety']){ echo "Selected";} ?> value="<?php echo $noticia_item1['variety'];?>" />   
		<?php echo $noticia_item1['variety'];?>
		<?php } ?>
		</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         
      </tr>	 <input type="hidden" name="itmdchk" value="" />
	   <tr class="Light" height="25">
            <td width="376" height="24"  align="right"  valign="middle" class="tblheading">Lot No.&nbsp;</td>
           <td align="left"  valign="middle" colspan="3"  class="tbltext">&nbsp;<input name="txtlot1" id="smt" type="text" class="tbltext" value="<?php echo $row['lotno'];?>" size="20" maxlength="20" style="background-color:#CCCCCC" readonly="true"  />&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
         </tr>	

</table>
<br />
<div id="maindiv">
<div id="subdiv" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" > 
  <tr class="tblsubtitle" height="25">
   <td colspan="4" align="center" valign="middle" class="tblheading">Existing Sloc </td>
   <td colspan="3" align="center" valign="middle" class="tblheading">Updated Sloc </td>
   <td width="59" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
 </tr>
 <tr class="tblsubtitle" height="25">
<td width="45" align="center" valign="middle" class="tblheading">#</td>
<td width="119" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="103" align="center" valign="middle" class="tblheading">NoB</td>
<td width="110" align="center" valign="middle" class="tblheading">Qty</td>
<td width="129" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="93" align="center" valign="middle" class="tblheading">NoB</td>
 <td width="74" align="center" valign="middle" class="tblheading">Qty</td>
 </tr>
<?php
$cnt=0;

$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_crop='".$c."' and lotldg_variety='".$f."' and lotldg_lotno='".$a."'") or die(mysqli_error($link));

$srno=1;
$totBags=0; $totqty=0;
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_variety='".$f."' and lotldg_lotno='".$a."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 $sloc1=""; $cnt++;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh1=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn1=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn1=$row_subbinn['sname'];
$sloc1=$wareh1.$binn1.$subbinn1;
$totBags=$totBags+$row_issuetbl['lotldg_balbags'];
$totqty=$totqty+$row_issuetbl['lotldg_balqty'];

 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['lotldg_balbags'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['lotldg_balqty'];?><input type="hidden" name="rowidd_<?php echo $srno;?>" value="<?php echo $row_issuetbl['lotldg_id']?>" /></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysqli_query($link,"select * from tbl_sloc_csw_sub where plantcode='".$plantcode."' and slocid='".$trid."' and rowid='".$row_issue1[0]."'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slBags=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['slocsubid']; else $subrid=$row_sloc['slocsubid'];
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."/";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."/";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname'];
else*/
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slBags=$slBags+$row_sloc['bags'];
if($sBags!="")
$sBags=$sBags.$slBags."<br/>";
else
$sBags=$slBags."<br/>";
$slqty=$slqty+$row_sloc['qty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balu=$balu+$slBags;
$balq=$balq+$slqty;

$blu=$blu+$row_sloc['balbags'];
$blq=$blq+$row_sloc['balqty'];
$orwoid=$row_sloc['rowid'];
}
$balu=$row_issuetbl['lotldg_balbags']; if($balu < 0 && $balq==0)$balu=0;
$balq=$row_issuetbl['lotldg_balqty']-$balq; if($balu<=0 && $balq > 0)$balu=1;
?>	
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sBags;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:pointer" onclick="showsloc('<?php echo $row_issuetbl['lotldg_balbags'];?>','<?php echo $row_issuetbl['lotldg_balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" style="cursor:pointer" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $orwoid;?>','<?php echo $txtlot1;?>')" /><?php } ?></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc1;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['lotldg_balbags'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['lotldg_balqty'];?><input type="hidden" name="rowidd_<?php echo $srno;?>" value="<?php echo $row_issuetbl['lotldg_id']?>" /></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $balu=0; $balq=0; $subrid=""; $blu=0; $blq=0;
$sql_sloc=mysqli_query($link,"select * from tbl_sloc_csw_sub where plantcode='".$plantcode."' and slocid='".$trid."' and rowid='".$row_issue1[0]."'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slBags=0; $slqty=0; if($subrid!="")$subrid=$subrid.",".$row_sloc['slocsubid']; else $subrid=$row_sloc['slocsubid'];
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
/*if($wareh!="")
$wareh=$wareh.$row_whouse['perticulars']."/";
else*/
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
/*if($binn!="")
$binn=$binn.$row_binn['binname']."/";
else*/
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and sid='".$row_sloc['subbinid']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
/*if($subbinn!="")
$subbinn=$subbinn.$row_subbinn['sname'];
else*/
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slBags=$slBags+$row_sloc['bags'];
if($sBags!="")
$sBags=$sBags.$slBags."<br/>";
else
$sBags=$slBags."<br/>";
$slqty=$slqty+$row_sloc['qty'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balu=$balu+$slBags;
$balq=$balq+$slqty;

$blu=$blu+$row_sloc['balbags'];
$blq=$blq+$row_sloc['balqty'];
$orwoid=$row_sloc['rowid'];
}
$balu=$row_issuetbl['lotldg_balbags']; if($balu < 0 && $balq==0)$balu=0;
$balq=$row_issuetbl['lotldg_balqty']-$balq; if($balu<=0 && $balq > 0)$balu=1;
?>		
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sBags;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sqty;?></td>
<td align="center" valign="middle" class="tblheading"><?php if($subrid=="") { ?><img src="../images/addnew.jpg" border="0" style="cursor:pointer" onclick="showsloc('<?php echo $row_issuetbl['lotldg_balbags'];?>','<?php echo $row_issuetbl['lotldg_balqty'];?>','<?php echo $row_issue1[0]?>');" /><?php } else {?><img src="../images/edit.png" border="0" style="cursor:pointer" onclick="editrec('<?php echo $trid;?>','<?php echo $subrid;?>', '<?php echo $orwoid;?>','<?php echo $txtlot1;?>')" /><?php } ?></td>
 </tr>
 <?php
 }$srno++;
 } 
 } 
  
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="2">Total</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totBags;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
 <td colspan="4" align="center" valign="middle" class="tblheading">&nbsp;</td>
 </tr>
 <?php
 if($cnt==0) 
 {
 ?>
  <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="10">Variety not in Stock</td>
 </tr>
 <?php
 }
 ?>
 <input type="hidden" name="txtBagsg" value="<?php echo $totBags;?>" /> <input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" /><input type="hidden" name="orwoid" value="" />
</table><input type="hidden" name="trid" value="<?php echo $trid;?>" /></div>
<div id="subsubdiv">
</div><br />
</div>


<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >

<tr >
<td valign="top" align="right"><a href="home_slocnew.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');"/></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;" />&nbsp;&nbsp;</td>
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
