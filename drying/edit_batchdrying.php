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

	if(isset($_REQUEST['p_id']))
	{
		$pid = $_REQUEST['p_id'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
 		$p_id=trim($_POST['maintrid']);
		$remarks=trim($_POST['txtremarks']);
		$remarks=str_replace("&","and",$remarks);
		
		$date = $_POST['date'];
		$txtcrop= $_POST['txtcrop']; 
		$txtvariety = $_POST['txtvariety'];	
		$txtdrefno = $_POST['txtdrefno']; 
		$itmdchk = $_POST['itmdchk']; 
		$txtstage = $_POST['txtstage']; 
		$txtlot1= $_POST['txtlot1']; 
		$txtlotnoid = $_POST['txtlotnoid']; 
		$txtlotno = $_POST['txtlotno']; 
		
		$extslwhg1 = $_POST['extslwhg1']; 
		$extslbing1 = $_POST['extslbing1']; 
		$extslsubbg1 = $_POST['extslsubbg1']; 
		$txtdisp1 = $_POST['txtdisp1']; 
		$txtqty1 = $_POST['txtqty1']; 
		$samebin1 = $_POST['samebin1']; 
		$txtslwhg1 = $_POST['txtslwhg1']; 
		$txtslbing1 = $_POST['txtslbing1']; 
		$txtslsubbg1 = $_POST['txtslsubbg1']; 
		$recqtyp1 = $_POST['recqtyp1']; 
		$txtrecbagp1 = $_POST['txtrecbagp1']; 
		$txtdqtyp1 = $_POST['txtdqtyp1']; 
		$txtdbagp1 = $_POST['txtdbagp1']; 
		$txtlotnumber = $_POST['txtlotnumber']; 
		$orlot = $_POST['orlot']; 
		
		$srno2 = $_POST['srno2']; 
		
		
		if($srno2==2)
		{
			$extslwhg2 = $_POST['extslwhg2']; 
			$extslbing2 = $_POST['extslbing2']; 
			$extslsubbg2 = $_POST['extslsubbg2']; 
			$txtdisp2 = $_POST['txtdisp2']; 
			$txtqty2 = $_POST['txtqty2']; 
			$samebin2 = $_POST['samebin2']; 
			$txtslwhg2 = $_POST['txtslwhg2']; 
			$txtslbing2 = $_POST['txtslbing2']; 
			$txtslsubbg2 = $_POST['txtslsubbg2']; 
			$recqtyp2 = $_POST['recqtyp2']; 
			$txtrecbagp2 = $_POST['txtrecbagp2']; 
			$txtdqtyp2 = $_POST['txtdqtyp2']; 
			$txtdbagp2 = $_POST['txtdbagp2']; 
		}
		
		$txtdisptot = $_POST['txtdisptot'];	
		$txtqtytot = $_POST['txtqtytot']; 
		$recqtyptot = $_POST['recqtyptot']; 
		$txtrecbagptot = $_POST['txtrecbagptot']; 
		$txtdqtyptot= $_POST['txtdqtyptot']; 
		$txtdbagptot= $_POST['txtdbagptot']; 
		$txtdbagptotfull= $_POST['txtdbagptotfull']; 
		
		$datestart= $_POST['datestart']; 
		$dateend= $_POST['dateend']; 
		$txttottime= $_POST['txttottime']; 
		$txtdmtyp= $_POST['txtdmtyp']; 
		$txtdid= $_POST['txtdid']; 
		//exit;
		
		//$txtdbagptot;
		$tdate11=$date;
		$tday1=substr($tdate11,0,2);
		$tmonth1=substr($tdate11,3,2);
		$tyear1=substr($tdate11,6,4);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;
		
		$sql_tbl_subsub=mysqli_query($link,"select * from tbl_cobdryingsubsub where plantcode='".$plantcode."' and   trid='".$p_id."'") or die(mysqli_error($link));
		$tot_tbl_subsub=mysqli_num_rows($sql_tbl_subsub);
		$o=1;
		$sql_tbl_sub=mysqli_query($link,"select * from tbl_cobdryingsub where plantcode='".$plantcode."' and   trid='".$p_id."'") or die(mysqli_error($link));
		$subtbltot=mysqli_num_rows($sql_tbl_sub);
		while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
		{
			$onob=$row_tbl_sub['onob'];
			$oqty=$row_tbl_sub['oqty'];
			$adqty=($oqty*$txtdbagptotfull)/100;
			$adnob=round((($onob*$txtdbagptotfull)/100));
			$nob=$onob-$adnob;
			$qty=$oqty-$adqty;
			$txtlotno=$row_tbl_sub['lotno'];
			$suid=$row_tbl_sub['subtrid'];
		
			$sql_sub="update tbl_cobdryingsub set nob1='$nob', qty1='$qty', adnob='$adqty' , adqty='$txtdbagptot', dsdate='$datestart', dedate='$dateend', dtime='$txttottime', ddtype='$txtdmtyp', ddid='$txtdid', drytyp='batch' where subtrid='".$suid."' and trid='$p_id'";
			if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
			{
				
				if($tot_tbl_subsub>0)
				{
					$s_sub="delete from tbl_cobdryingsubsub where subtrid='".$suid."' and trid='".$p_id."'";
					mysqli_query($link,$s_sub) or die(mysqli_error($link));
				}
				if($o==1)
				{
					$sql_sub="insert into tbl_cobdryingsubsub (subtrid, trid, owh, obin, osubbin, onob, oqty, nwh, nbin, nsubbin, nnob, nqty, dryingloss, dlossper, samebin,plantcode) values ('$suid', '$p_id', '$extslwhg1', '$extslbing1', '$extslsubbg1', '$txtdisp1', '$txtqty1', '$txtslwhg1', '$txtslbing1', '$txtslsubbg1', '$recqtyp1', '$txtrecbagp1', '$txtdqtyp1', '$txtdbagp1', '$samebin1','$plantcode')";
					mysqli_query($link,$sql_sub) or die(mysqli_error($link));
					if($srno2==2)
					{
						$sql_sub="insert into tbl_cobdryingsubsub (subtrid, trid, owh, obin, osubbin, onob, oqty, nwh, nbin, nsubbin, nnob, nqty, dryingloss, dlossper, samebin,plantcode) values ('$suid', '$p_id', '$extslwhg2', '$extslbing2', '$extslsubbg2', '$txtdisp2', '$txtqty2', '$txtslwhg2', '$txtslbing2', '$txtslsubbg2', '$recqtyp2', '$txtrecbagp2', '$txtdqtyp2', '$txtdbagp2', '$samebin2','$plantcode')";
						mysqli_query($link,$sql_sub) or die(mysqli_error($link));
					}
				}
				$o++;
			}
		}
		$sqlsub="update tbl_cobdrying set dryingdate='$tdate1', drefno ='$txtdrefno', remarks='$remarks' where trid='$p_id'";
		$zaxa=mysqli_query($link,$sqlsub) or die(mysqli_error($link));

	   	//exit;
		echo "<script>window.location='add_drying_preview2.php?p_id=$p_id&remarks=$remarks'</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Drying - Transaction - Cob Drying Slip</title>
<link href="../include/main_drying.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_drying.css" rel="stylesheet" type="text/css" />
</head>
<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->
<script src="../include/datetimepicker_css.js"></script>
<script src="drying.js"></script>
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
function isNumberKey(evt)
{
	 var charCode = (evt.which) ? evt.which : evt.keyCode
	 if (charCode > 31 && (charCode < 46 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
		return false;

	 return true;
}

function isNumberKey1(evt)
{
	 var charCode = (evt.which) ? evt.which : evt.keyCode;
	 if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
		return false;

	 return true;
}

function pform()
{	
	var f=0;
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtdrefno.value=="")
	{
		alert("Please Enter  Drying slip reference No");
		document.frmaddDepartment.txtdrefno.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please Select Stage");
		document.frmaddDepartment.txtstage.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select Lot");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.recqtyptot.value=="")
	{
		alert("Please Enter NoB");
		document.frmaddDepartment.recqtyptot.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtrecbagptot.value=="")
	{
		alert("Please Enter Qty");
		document.frmaddDepartment.txtrecbagptot.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtcrop.value==61)
	{
		if(document.frmaddDepartment.txtdbagptot.value>90)
		{
			alert("Drying Loss is More than 90 % , Please check");
			f=1;
			return false;
		}
	}
	else
	{
		if(document.frmaddDepartment.txtdbagptot.value>25)
		{
			alert("Drying Loss is More than 25 % , Please check");
			f=1;
			return false;
		}
	}
	if(document.frmaddDepartment.dateend.value=="")
	{
		alert("Please select Drying End Date");
		//document.frmaddDepartment.dateend.focus();
		f=1;
		return false;
	}
	if(parseFloat(document.frmaddDepartment.txtrecbagptot.value)>parseFloat(document.frmaddDepartment.txtqtytot.value))
	{
		alert("Total Drying Qty cannot be more than Actual Qty");
		//document.frmaddDepartment.txtrecbagptot.focus();
		f=1;
		return false;
	}
	if(f==1)
	{
		return false;
	}
	else
	{
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		showUser(a,'postingtable','mform','','','','','');
	}  
}

function pformedtup()
{	
	var f=0;
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtdrefno.value=="")
	{
		alert("Please Enter  Drying slip reference No");
		document.frmaddDepartment.txtdrefno.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please Select Stage");
		document.frmaddDepartment.txtstage.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select Lot");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.recqtyptot.value=="")
	{
		alert("Please Enter NoB");
		document.frmaddDepartment.recqtyptot.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtrecbagptot.value=="")
	{
		alert("Please Enter Qty");
		document.frmaddDepartment.txtrecbagptot.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtcrop.value==61)
	{
		if(document.frmaddDepartment.txtdbagptot.value>90)
		{
			alert("Drying Loss is More than 90 % , Please check");
			f=1;
			return false;
		}
	}
	else
	{
		if(document.frmaddDepartment.txtdbagptot.value>25)
		{
			alert("Drying Loss is More than 25 % , Please check");
			f=1;
			return false;
		}
	}
	if(document.frmaddDepartment.dateend.value=="")
	{
		alert("Please select Drying End Date");
		//document.frmaddDepartment.dateend.focus();
		f=1;
		return false;
	}
	if(parseFloat(document.frmaddDepartment.txtrecbagptot.value)>parseFloat(document.frmaddDepartment.txtqtytot.value))
	{
		alert("Total Drying Qty cannot be more than Actual Qty");
		//document.frmaddDepartment.txtrecbagptot.focus();
		f=1;
		return false;
	}
	if(f==1)
	{
		return false;
	}
	else
	{
		var a=formPost(document.getElementById('mainform'));
		showUser(a,'postingtable','mformsubedt','','','','');
		//alert(a);
	}
}

function modetchk(classval)
{
	showUser(classval,'vitem','item','','','','','');
	document.frmaddDepartment.txtlot1.value==""
	//document.frmaddDepartment.txt11.selectedIndex=0;
}

function modetchk1()
{
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
		document.frmaddDepartment.txtvariety.value="";
	}
}	
function modetchk22()
{
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety.");
		document.frmaddDepartment.txtvariety.focus();
		document.frmaddDepartment.txtstage.value="";
	}
}
function vendorchk1()
{
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
	}
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety first.");
		document.frmaddDepartment.txtvariety.focus();
	}	
}	
	
function openslocpop()
{

	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop.");
		document.frmaddDepartment.txtcrop.focus();
	}
	else if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety first.");
		document.frmaddDepartment.txtvariety.focus();
	}
	else if(document.frmaddDepartment.txtstage.value=="")
	{
		alert("Please Select Stage first.");
		document.frmaddDepartment.txtstage.focus();
	}
	else
	{
		//var itm="Raw Seed";
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		var stage=document.frmaddDepartment.txtstage.value;
		var tid=document.frmaddDepartment.maintrid.value;
		winHandle=window.open('getuser_drying_lotno2.php?crop='+crop+'&variety='+variety+'&stage='+stage+'&tid='+tid,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}

function editrec(edtrecid, trid)
{
	//alert(trid);
	showUser(edtrecid,'postingsubtable','subformedt',trid,'','','','');
} 

function deleterec(v1,v2)
{
	if(confirm('Do u wish to delete this item?')==true)
	{
		showUser(v1,'postingtable','delete',v2,'','','');
	}
	else
	{
		return false;
	}
}


function mySubmit()
{ 
	if(document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
	if(document.frmaddDepartment.txtremarks.value=="")
	{
			alert("Please enter Remarks");
			document.frmaddDepartment.txtremarks.focus();
			return false;
	}
	return true;	 
}

function getdetails()
{
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select or enter Lot No.");
	}
	else
	{
		var get=document.frmaddDepartment.txtlot1.value;
		//var grn=document.frmaddDepartment.grnnumber.value;
	
		if(document.frmaddDepartment.txtlot1.value=="")
		{
			alert("Please enter Lot No.");
			document.frmaddDepartment.txtlot1.focus();
			return false;
		}
		if(document.frmaddDepartment.txtlot1.value.charCodeAt() == 32)
		{
			alert("Lot No cannot start with space.");
			document.frmaddDepartment.txtlot1.focus();
			return false;
		}
	/*	if(!isChar_W(document.frmaddDepartment.txtlot1.value.charAt(0)))
		{
			alert("Lot No cannot start with Numaric value.");
			document.frmaddDepartment.txtlot1.focus();
			return false;
		}*/
		if(document.frmaddDepartment.txtlot1.value.length<6)
		{
			alert("Lot No cannot be less than 6 digits alphanumaric.");
			document.frmaddDepartment.txtlot1.focus();
			return false;
		}
		//alert(document.frmaddDepartment.txtcrop.value);
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;					
		var tid=document.frmaddDepartment.maintrid.value;
		var lotid=document.frmaddDepartment.subtrid.value;
		var dsrn=document.frmaddDepartment.txtdrefno.value;
		var stage=document.frmaddDepartment.txtstage.value;
		//alert(tid);
		//alert(lotid);
		//document.getElementById("postingsubtable").style.display="block";
		showUser(get,'postingsubsubtable','get',crop,variety,tid,lotid,dsrn,stage);
	}
}

function openslocpop1()
{
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select Lot No.");
		//document.frmaddDepartment.txt1.focus();
	}
	else
	{
		var itm=document.frmaddDepartment.sstatus.value;
		winHandle=window.open('getuser_status.php?tp='+itm,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}

function ltchk()
{
	document.getElementById("postingsubtable").style.display="none";

	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please enter Lot No.");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value.charCodeAt() == 32)
	{
		alert("Lot No cannot start with space.");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	if(document.frmaddDepartment.txtlot1.value.length<6)
	{
		alert("Lot No cannot be less than 6 digits alphanumaric.");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	if(!isChar_W(document.frmaddDepartment.txtlot1.value.charAt(0)))
	{
		alert("Lot No cannot start with Numaric value.");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(1)))
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(2)))
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(3)))
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(4)))
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
	if(isChar_W(document.frmaddDepartment.txtlot1.value.charAt(5)))
	{
		alert("Invalid Lot Number");
		document.frmaddDepartment.txtlot1.focus();
		return false;
	}
}


function qtychk1(qtyval1,srno)
{ //alert(srno);
	var sbin="sb"+srno;
	var nob="recqtyp"+srno;
	if(document.getElementById(sbin).value=="")
	{
		alert("Select Subbin");
		document.getElementById(sbin).focus();
		document.getElementById(nob).value="";
		return false;
	}
	//document.frmaddDepartment.txtdqtyp.value=parseFloat(document.frmaddDepartment.txtdisp.value)-parseFloat(qtyval1);
}


function Bagschk1(Bagsval1,srno)
{//alert(srno);
	var acnob="";
	var acqty="txtqty"+srno;
	var dynob="recqtyp"+srno;
	var dyqty="txtrecbagp"+srno;
	var balqty="txtdqtyp"+srno;
	var balper="txtdbagp"+srno;
	
	var dynob1="recqtyp1";
	var dyqty1="txtrecbagp1";
	var balqty1="txtdqtyp1";
	var balper1="txtdbagp1";

	if(document.getElementById(dynob).value=="")
	{
		alert("Please Enter  NoB");
		document.getElementById(balqty).value="";
		document.getElementById(balper).value="";
		document.getElementById(dynob).focus();
	}
	document.getElementById(balqty).value=parseFloat(document.getElementById(acqty).value)-parseFloat(Bagsval1);
	/*if(document.frmaddDepartment.txtrecbagp.value > document.frmaddDepartment.txtqty.value)
	{     
		alert( "Fill number either equal or less than Before Drying Qty");
		//document.frmaddDepartment.txtrecbagp.value="";
		document.frmaddDepartment.txtrecbagp.focus();
	}*/
		
	
	/*else100-((parseFloat(document.frmaddDepartment.txtnot.value)/parseFloat(document.frmaddDepartment.txtnop.value))*100);
	{*/
	var val3=(parseFloat(document.getElementById(balqty).value)/parseFloat(document.getElementById(acqty).value))*100;
	document.getElementById(balper).value=Math.round((val3)*100)/100;
	if(document.frmaddDepartment.srno2.value==2)
	{   
		var dynob2=document.frmaddDepartment.recqtyp2.value;
		var dyqty2=document.frmaddDepartment.txtrecbagp2.value;
		var balqty2=document.frmaddDepartment.txtdqtyp2.value;
		var balper2=document.frmaddDepartment.txtdbagp2.value;  
		
		if(dynob2=="")dynob2=0;
		if(dyqty2=="")dyqty2=0;
		if(balqty2=="")balqty2=0;
		if(balper2=="")balper2=0; 
		
		document.frmaddDepartment.txtdqtyptot.value=parseFloat(document.getElementById(balqty1).value)+parseFloat(balqty2);
		//document.frmaddDepartment.txtdbagptot.value=parseFloat(document.getElementById(balper1).value)+parseFloat(document.getElementById(balper2).value);
		
		document.frmaddDepartment.recqtyptot.value=parseFloat(document.getElementById(dynob1).value)+parseFloat(dynob2);
		document.frmaddDepartment.txtrecbagptot.value=parseFloat(document.getElementById(dyqty1).value)+parseFloat(dyqty2);
	}
	else
	{
		document.frmaddDepartment.txtdqtyptot.value=parseFloat(document.getElementById(balqty1).value);
		//document.frmaddDepartment.txtdbagptot.value=parseFloat(document.getElementById(balper1).value);
		
		document.frmaddDepartment.recqtyptot.value=parseFloat(document.getElementById(dynob1).value);
		document.frmaddDepartment.txtrecbagptot.value=parseFloat(document.getElementById(dyqty1).value);
	}
	//document.frmaddDepartment.txtdqtyptot.value=parseFloat(document.frmaddDepartment.txtqtytot.value)-parseFloat(document.frmaddDepartment.txtrecbagptot.value);
	//alert(document.frmaddDepartment.txtdqtyptot.value);
	var val=parseFloat(document.frmaddDepartment.txtdqtyptot.value)/parseFloat(document.frmaddDepartment.txtqtytot.value)*100;
	document.frmaddDepartment.txtdbagptotfull.value=parseFloat(val);
	document.frmaddDepartment.txtdbagptot.value=Math.round((val)*100)/100;
	//alert(document.frmaddDepartment.txtdbagptot.value);
	/*if(document.getElementById(balper).value>25)
	{
		alert("Drying Loss is More than 25 % , Please check");
	}*/
}

function dstimechk(dstval)
{
	if(document.frmaddDepartment.txtrecbagptot.value=="")
	{
		alert("Enter Drying Qty");
		document.frmaddDepartment.txtstime.value="";
		return false;
	}
}

function dstarttimechk(dstval)
{
	var stime="txtetime";
	var etime="txtetime";
	if(document.getElementById(stime).value=="")
	{
		alert("Select D. Start Time");
		document.getElementById(stime).focus();
		document.getElementById(etime).value="";
		return false;
	}
	else
	{
	
	}
}

function chktime(tval)
{
	var etime="datestart";
	var wh="txtdmtyp";
	if(document.getElementById(etime).value=="")
	{
		alert("Select D. Start Time");
		document.getElementById(etime).focus();
		document.getElementById(wh).value="";
		return false;
	}
}

function chkidtyp(idval)
{
	var etime="txtdmtyp";
	var wh="txtdid";
	if(document.getElementById(etime).value=="")
	{
		alert("Select Type in Drying Details");
		document.getElementById(etime).focus();
		document.getElementById(wh).value="";
		return false;
	}
}

function wh1(wh1val, srnval)
{ 
	var wh="txtslwhg"+srnval;
	if(document.frmaddDepartment.txtdrefno.value=="")
	{
		alert("Please enter Drying Slip Reference No.");
		document.frmaddDepartment.txtdrefno.focus();
		document.getElementById(wh).value="";
		document.getElementById(wh).selectedIndex=0;
		return false;
	}
	else
	{
	showUser(wh1val,'bing1','wh','bing1',srnval,'','','');
	}
}

function wh2(wh2val, srnval)
{   
	/*var etime="txtdid"+srnval;
	var wh="txtslwhg"+srnval;
	if(document.getElementById(etime).value=="")
	{
		alert("Select ID in Drying Details");
		document.getElementById(etime).focus();
		document.getElementById(wh).value="";
		return false;
	}
	else
	{*/
		showUser(wh2val,'bing2','wh','bing2',srnval,'','','');
	//}
}



function bin1(bin1val, srnval)
{
	if(document.frmaddDepartment.txtslwhg1.value!="")
	{
		showUser(bin1val,'sbing1','bin','txtslsubbg1',srnval,'','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}

function bin2(bin2val, srnval)
{
	if(document.frmaddDepartment.txtslwhg2.value!="")
	{
		showUser(bin2val,'sbing2','bin','txtslsubbg2',srnval,'','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}



function subbin1(subbin1val, srnval)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		if(document.frmaddDepartment.srno2.value > 1)
		{
			var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		}
		/*if(w1==w2)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDepartment.txtslsubbg1.selectedIndex=0;
		}*/
		var slocnogood='Raw';
		var trid=document.frmaddDepartment.maintrid.value;
		/*if(document.frmaddDepartment.txtslBagsg1.value!="")
		var Bagsv1=document.frmaddDepartment.txtslBagsg1.value;
		else*/
		var Bagsv1=srnval;
		/*if(document.frmaddDepartment.txtslqtyg1.value!="")
		var qtyv1=document.frmaddDepartment.txtslqtyg1.value;
		else*/
		var qtyv1="";
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,Bagsv1,qtyv1,trid);
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing1.focus();
	}
}

function subbin2(subbin2val,srnval)
{	
	var itemv=document.frmaddDepartment.txtvariety.value;
	if(document.frmaddDepartment.txtslbing2.value!="")
	{	
		var w1=document.frmaddDepartment.txtslwhg1.value+document.frmaddDepartment.txtslbing1.value+document.frmaddDepartment.txtslsubbg1.value;
		var w2=document.frmaddDepartment.txtslwhg2.value+document.frmaddDepartment.txtslbing2.value+document.frmaddDepartment.txtslsubbg2.value;
		/*if(w2==w1)
		{
		alert("Please check, No two Bin information can be similar in a given transaction");
		document.frmaddDepartment.txtslsubbg2.selectedIndex=0;
		}*/
		
		
		var slocnogood='Raw';
		var trid=document.frmaddDepartment.maintrid.value;
		/*if(document.frmaddDepartment.txtslBagsg2.value!="")
		var Bagsv2=document.frmaddDepartment.txtslBagsg2.value;
		else*/
		var Bagsv2=srnval;
		/*if(document.frmaddDepartment.txtslqtyg2.value!="")
		var qtyv2=document.frmaddDepartment.txtslqtyg2.value;
		else*/
		var qtyv2="";
		showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2',slocnogood,Bagsv2,qtyv2,trid);
		//showUser(subbin2val,'slocrow2','subbin',itemv,'txtslsubbg2','','','');
	}
	else
	{
		alert("Please select Bin");
		document.frmaddDepartment.txtslbing2.focus();
	}
}

function isValidDate(dateStr) 
{
	// Date validation Function 
	// Checks For the following valid Date formats:
	// MM/DD/YY MM/DD/YYYY MM-DD-YY MM-DD-YYYY
	
	var datePat = /^(\d{1,2})(\/|-)(\d{1,2})\2(\d{4})$/; // requires 4 digit Year
	
	var matchArray = dateStr.match(datePat); // Is the format ok?
	if (matchArray == "Null") 
	{
		alert(dateStr + " Date is not in a valid format.")
		return false;
	}
	
	Month = matchArray[1]; // parse Date into variables
	Day = matchArray[3];
	Year = matchArray[4];
	
	if (Month < 1 || Month > 12) 
	{ // check Month range
		alert("Month must be between 1 and 12.");
		return false;
	}
	
	if (Day < 1 || Day > 31) 
	{
		alert("Day must be between 1 and 31.");
		return false;
	}
	
	if ((Month==4 || Month==6 || Month==9 || Month==11) && Day==31) 
	{
		alert("Month "+Month+" doesn't have 31 days!")
		return false;
	}
	
	if (Month == 2) 
	{ // check For february 29th
		var isleap = (Year % 4 == 0 && (Year % 100 != 0 || Year % 400 == 0));
		if (Day>29 || (Day==29 && !isleap)) 
		{
			alert("February " + Year + " doesn't have " + Day + " days!");
			return false;
		}
	}
	return true;
}

function isValidTime(timeStr) 
{
	// Checks if time Is In HH:MM:SS AM/PM format.
	// The seconds And AM/PM are optional.
	
	var timePat = /^(\d{1,2}):(\d{2})(:(\d{2}))?(\s?(AM|am|PM|pm))?$/;
	
	var matchArray = timeStr.match(timePat);
	if (matchArray == "Null") 
	{
		alert("Time is not in a valid format.");
		return false;
	}
	
	Hour = matchArray[1];
	Minute = matchArray[2];
	Second = matchArray[4];
	ampm = matchArray[6];
	
	if (Second=="") { Second = "Null"; }
	if (ampm=="") { ampm = "Null" }
	
	if (Hour < 0 || Hour > 23) {
		alert("Hour must be between 1 and 12. (or 0 and 23 for military time)");
		return false;
	}
	if (Hour <= 12 && ampm == "Null") {
		if (confirm("Please indicate which time format you are using. OK = Standard Time, CANCEL = Military Time")) {
			alert("You must specify AM or PM.");
			return false;
		}
	}
	if (Hour > 12 && ampm != "Null") {
		alert("You can't specify AM or PM for military time.");
		return false;
	}
	if (Minute < 0 || Minute > 59) {
		alert ("Minute must be between 0 and 59.");
		return false;
	}
	if (Second != "Null" && (Second < 0 || Second > 59)) {
		alert ("Second must be between 0 and 59.");
		return false;
	}
	return true;
}


function checkDate(dateform) {
	date1 = new Date();
	date2 = new Date();
	date3 = new Date();
	diff = new Date();
	
	dt1=document.frmaddDepartment.datestart.value.split(" ");
	dd1=dt1[0].split("-");
	dd=dd1[1]+"/"+dd1[0]+"/"+dd1[2];
	
	firstdate=dd;
	firsttime=dt1[1]+" "+dt1[2];
	
	dt2=document.frmaddDepartment.dateend.value.split(" ");
	dd2=dt2[0].split("-");
	dd3=dd2[1]+"/"+dd2[0]+"/"+dd2[2];
	
	seconddate=dd3;
	secondtime=dt2[1]+" "+dt2[2];
	
	dt3=document.frmaddDepartment.currentdate.value.split(" ");
	dd3=dt3[0].split("-");
	dd4=dd3[1]+"/"+dd3[0]+"/"+dd3[2];
	
	thirddate=dd4;
	thirdtime=dt3[1]+" "+dt3[2];
	/* alert(firstdate);
	alert(firsttime);
	alert(seconddate);
	alert(secondtime);*/
	if (isValidDate(firstdate) && isValidTime(firsttime)) { // Validates first Date
		//alert("Valid 1");
		date1temp = new Date(firstdate + " " + firsttime);
		//alert(date1temp);
		date1.setTime(date1temp.getTime());
		//alert(date1);
	}
	else return false; // otherwise exits
	
	if (isValidDate(seconddate) && isValidTime(secondtime)) { // Validates Second Date
		// alert("Valid 2");
		date2temp = new Date(seconddate + " " + secondtime);
		// alert(date2temp);
		date2.setTime(date2temp.getTime());
		//alert(date2);
	}
	else return false; // otherwise exits
	
	if (isValidDate(thirddate) && isValidTime(thirdtime)) { // Validates Second Date
		// alert("Valid 2");
		date3temp = new Date(thirddate + " " + thirdtime);
		// alert(date2temp);
		date3.setTime(date3temp.getTime());
		//alert(date2);
	}
	else return false; // otherwise exits
	//alert(date2);
	//alert(date1);
	if(date1<date2 || date2<date3)
	{
		var dif = date2-date1;
	}
	else
	{
		var dif =-1;
	} 
	//alert(dif);
	if(dif >=0)
	{ // 2nd date is after the 1st date
		//alert("Correct");
		//return true;
		
		var zx=date1.getTime();
		var zy=date2.getTime();
		var zz=(Math.abs(zx))-(Math.abs(zy));
		diff.setTime(Math.abs(zz));
		//alert("HI");
		timediff = diff.getTime();
		
		/*weeks = Math.floor(timediff / (1000 * 60 * 60 * 24 * 7));
		timediff -= weeks * (1000 * 60 * 60 * 24 * 7);*/
		
		days = Math.floor(timediff / (1000 * 60 * 60 * 24));
		timediff -= days * (1000 * 60 * 60 * 24);
		
		hours = Math.floor(timediff / (1000 * 60 * 60));
		timediff -= hours * (1000 * 60 * 60);
		
		mins = Math.floor(timediff / (1000 * 60));
		timediff -= mins * (1000 * 60);
		
		secs = Math.floor(timediff / 1000);
		timediff -= secs * 1000;
		
		//alert("HI");
		//alert("Difference = " + weeks + " weeks, " + days + " days, " + hours + " hours, " + mins + " minutes, and " + secs + " seconds");
		var totdiff=days + " days, " + hours + " hours, and " + mins + " minutes ";
		//alert("Difference = " + days + " days, " + hours + " hours, and " + mins + " minutes ");
		document.frmaddDepartment.txttottime.value="";
		document.frmaddDepartment.txttottime.value=totdiff;
		//alert("HI");
		return true; // form should never submit, returns False
	}
	else
	{
		alert("Incorrect Date Selection");
		document.frmaddDepartment.dateend.value="";
		document.frmaddDepartment.txttottime.value="";
		return false;
	}
}

function tdelay(dval)
{
	dateform=document.frmaddDepartment.dateend.value;
	if(dateform!="")
	{
		if(dval==dateform && dval!="")
		checkDate(dateform);
		else
		setTimeout('tdelay()',100);
	}
	else
	{
		setTimeout('tdelay()',100);
	}
}

function caldiff()
{
	if(document.frmaddDepartment.txtdid.value!="")
	{
		dval=document.frmaddDepartment.dateend.value;
		NewCssCal('dateend','ddMMyyyy','arrow',true,'12');
		setTimeout('tdelay(dval)',100);
	}
	else
	{
		alert("Select Drying Details ID")
		return false;
	}
}

function firstdt()
{
	if(document.frmaddDepartment.txtrecbagptot.value!="")
	{
		document.frmaddDepartment.dateend.value="";
		document.frmaddDepartment.txttottime.value="";
		NewCssCal('datestart','ddMMyyyy','arrow',true,'12')
	}
	else
	{
		alert("Enter Drying Quantity")
		return false;
	}
}

function chkboxchk(srnval,whid,binid,sbinid)
{
	var samesl="samesloc"+srnval;
	var chkbox="chkbox"+srnval;
	var samebin="samebin"+srnval;
	if(document.getElementById(chkbox).checked==true)
	{
		//alert("Checked");
		showUser(srnval,samesl,'samesloc',whid,binid,sbinid,'checked','','');
		document.getElementById(samebin).value="Yes";
		//return false;
	}
	else
	{
		showUser(srnval,samesl,'samesloc',whid,binid,sbinid,'unchecked','','');
		document.getElementById(samebin).value="No";
	}
}
</script>

<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
        <tr>
           <td valign="top"><?php require_once("../include/arr_drying.php");?></td>
        </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/process_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" style="border-bottom:solid; border-bottom-color:#adad11" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Cob Drying </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
<?php 
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tbl_cobdrying where plantcode='".$plantcode."' and   trid='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
$tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['trid'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_cobdryingsub where plantcode='".$plantcode."' and   trid='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

	$tdate=$row_tbl['dryingdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
?>
  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    <input name="txt14" value="" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $row_tbl['arr_code']?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<?php date_default_timezone_set ("Asia/Calcutta"); ?>	  
		<input type="hidden" name="currentdate" value="<?php echo date('d-m-Y h:i A');?>" />
		</br>

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable" style="display:block">
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Edit Cob Drying </td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TPD".$row_tbl['arr_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="229" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>

<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropname='".$row_tbl['crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input type="text" class="tbltext" name="txtcrop1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropname'];?>" size="25" />   <input type="hidden" class="tbltext" name="txtcrop" style="background-color:#CCCCCC" readonly="true" value="<?php echo $noticia['cropid'];?>" />&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where popularname='".$row_tbl['variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
if($totver=mysqli_num_rows($quer4) > 0)
{
	$vername=$noticia_item['popularname'];
	$verid=$noticia_item['varietyid'];
}
else
{
	$vername=$row_tbl['variety'];
	$verid=$row_tbl['variety'];
}
?>
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<input type="text" class="tbltext" name="txtvariety1" style="background-color:#CCCCCC" readonly="true" value="<?php echo $vername;?>" size="25" />   <input type="hidden" class="tbltext" name="txtvariety" style="background-color:#CCCCCC" readonly="true" value="<?php echo $verid;?>" />&nbsp;</td>
           </tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Drying slip reference No. &nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtdrefno" type="text" size="20" class="tbltext" maxlength="20"  value="<?php echo $row_tbl['drefno'];?>" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>
</table>

<br/>


<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#adad11" style="border-collapse:collapse">
                    <tr class="tblsubtitle" height="20">
              <td width="17" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
			   <td width="89" align="center" valign="middle" class="smalltblheading" rowspan="2">Lot No. </td>
			   <td width="110" align="center" valign="middle" class="smalltblheading" rowspan="2">Existing SLOC</td>
			   <td align="center" valign="middle" class="smalltblheading"  colspan="2">Before Drying </td>
			    <td width="110" align="center" valign="middle" class="smalltblheading"rowspan="2" >Updated SLOC</td>
			   <td align="center" valign="middle" class="smalltblheading" colspan="2">After Drying  </td>
			   <td align="center" valign="middle" class="smalltblheading" colspan="2">Drying Loss </td>
			   <td width="75" rowspan="2" align="center" valign="middle" class="smalltblheading" >Drying Start</td>
			    <td width="75" rowspan="2" align="center" valign="middle" class="smalltblheading" >Drying End</td>
				<td width="91" align="center" valign="middle" class="smalltblheading" rowspan="2">Total D.Time</td>
				 <td width="49" align="center" valign="middle" class="smalltblheading" rowspan="2">Drying Details</td>
              <!--<td width="20" align="center" valign="middle" class="smalltblheading" rowspan="2">Edit</td>
              <td width="35" align="center" valign="middle" class="smalltblheading"rowspan="2" >Delete</td>-->
  </tr>
  <tr class="tblsubtitle">
                    <td width="40" align="center" valign="middle" class="smalltblheading" >NoB</td>
                    <td width="55" align="center" valign="middle" class="smalltblheading">Qty</td>
                    <td width="40" align="center" valign="middle" class="smalltblheading">NoB</td>
                    <td width="55" align="center" valign="middle" class="smalltblheading">Qty</td>
                    <td width="40" align="center" valign="middle" class="smalltblheading">Qty</td>
                    <td width="35" align="center" valign="middle" class="smalltblheading">%</td>
                            </tr>
  <?php
 
$srno=1; 
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{ $sloc1=""; $sloc=""; 
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$arrival_id=$row_tbl_sub['trid'];
$difq="";$difq1="";
$cnt++;
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_cobdryingsubsub where plantcode='".$plantcode."' and   subtrid='".$row_tbl_sub['subtrid']."' and trid='".$arrival_id."'") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
{
 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
$sql_whouse=mysqli_query($link,"select perticulars from tbldrywarehouse where plantcode='".$plantcode."' and   whid='".$row_tbl_subsub['owh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbldrybin where plantcode='".$plantcode."' and   binid='".$row_tbl_subsub['obin']."' and whid='".$row_tbl_subsub['owh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbldrysubbin where plantcode='".$plantcode."' and   sid='".$row_tbl_subsub['osubbin']."' and binid='".$row_tbl_subsub['obin']."' and whid='".$row_tbl_subsub['owh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];


$sql_whouse1=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_tbl_subsub['nwh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse1=mysqli_fetch_array($sql_whouse1);
$wareh1=$row_whouse1['perticulars']."/";

$sql_binn1=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_tbl_subsub['nbin']."' and whid='".$row_tbl_subsub['nwh']."'") or die(mysqli_error($link));
$row_binn1=mysqli_fetch_array($sql_binn1);
$binn1=$row_binn1['binname']."/";

$sql_subbinn1=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_tbl_subsub['nsubbin']."' and binid='".$row_tbl_subsub['nbin']."' and whid='".$row_tbl_subsub['nwh']."'") or die(mysqli_error($link));
$row_subbinn1=mysqli_fetch_array($sql_subbinn1);
$subbinn1=$row_subbinn1['sname'];

$nb1=$row_tbl_subsub['onob']; 
//$qt1=$row_tbl_subsub['oqty']; 
$nb2=$row_tbl_subsub['nnob']; 
//$qt2=$row_tbl_subsub['nqty'];

$diq=explode(".",$row_tbl_subsub['oqty']);
if($diq[1]==000){$qt1=$diq[0];}else{$qt1=$row_tbl_subsub['oqty'];}

$diq=explode(".",$row_tbl_subsub['nqty']);
if($diq[1]==000){$qt2=$diq[0];}else{$qt2=$row_tbl_subsub['nqty'];}

if($sloc!=""){
$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn."|".$nb1."|".$qt1;}
else{
$sloc=$wareh.$binn.$subbinn."|".$nb1."|".$qt1;}

if($sloc1!=""){
$sloc1=$sloc1."<BR/>".$wareh1.$binn1.$subbinn1."|".$nb2."|".$qt2;}
else{
$sloc1=$wareh1.$binn1.$subbinn1."|".$nb2."|".$qt2;}

}	
$diq=explode(".",$row_tbl_sub['oqty']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_subsub['oqty'];}

$diq=explode(".",$row_tbl_sub['qty1']);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$row_tbl_subsub['qty1'];}

if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['onob'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $difq;?></td>
    <td width="110" align="center" valign="middle" class="smalltbltext"><?php echo $sloc1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['nob1'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['qty1'];?></td>
	<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adnob'];?></td>
	<td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adqty'];?></td>
	 <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dsdate'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dedate'];?></td>
	<td width="91" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>
	<td width="49" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['ddtype'];?> <?php echo $row_tbl_sub['ddid'];?></td>
     <!--   <td width="20" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['subtrid'];?>);" /></td>
    <td width="35" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['subtrid'];?>);" /></td>-->
  </tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['onob'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $difq;?></td>
    <td width="110" align="center" valign="middle" class="smalltbltext"><?php echo $sloc1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['nob1'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['qty1'];?></td>
	<td width="40" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adnob'];?></td>
	<td width="35" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adqty'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dsdate'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dedate'];?></td>
	<td width="91" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>
	<td width="49" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['ddtype'];?> <?php echo $row_tbl_sub['ddid'];?></td>
        <!--<td width="20" align="center" valign="middle" class="smalltbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['subtrid'];?>);" /></td>
    <td width="35" align="center" valign="middle" class="smalltbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $arrival_id?>,<?php echo $row_tbl_sub['subtrid'];?>);" /></td>-->
  </tr>
  <?php
}
$srno++;
}
}
?>
</table>
<br/>

<div id="postingsubtable" style="display:block">
<?php
	$sqltblsub=mysqli_query($link,"select * from tbl_cobdryingsub where plantcode='".$plantcode."' and   trid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sqltblsub);
	$rowtblsub=mysqli_fetch_array($sqltblsub);
	
	
	$cd="R";
	if(date("Y")==$year1)$yer2=$year1;
	if(date("Y")==$year2)$yer2=$year2;
	$sql_lgenyr=mysqli_query($link,"select * from tbl_lgenyear where lgenyear='".$yer2."'") or die(mysqli_error($link));
	$row_lgenyr=mysqli_fetch_array($sql_lgenyr);
	$yer=$row_lgenyr['lgenyearcode'];
	if($yer=="")$yer=$yearid_id;
	
	$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='".$plantcode."' ");
	$row_cls=mysqli_fetch_array($quer_cn);
	$tp1=$row_cls['code'];
	
	$sql_lotm=mysqli_query($link,"SELECT MAX(lotcobgen_lot) FROM tbl_lotcobgen  where plantcode='".$plantcode."' and   lotcobgen_yearcode='$yer'  ORDER BY lotcobgen_yearcode DESC") or die(mysqli_error($link));
	$tot_lotm=mysqli_num_rows($sql_lotm);
	$tm_code=0;
	if($tot_lotm > 0)
	{
		$row_lotm=mysqli_fetch_array($sql_lotm);
		$tm_code=$row_lotm['0'];
		if($tm_code > 0 )
		$lot_code=$tm_code+1;
		else
		$lot_code="80001";
	}
	else
	{
		$lot_code="80001";
	}
	if($rowtblsub['newlono']=="")
	{
		$lotnonew=$tp1.$yer.$lot_code."/00000/00".$cd;
		$lotnoornew=$tp1.$yer.$lot_code."/00000/00";
	}
	else
	{
		$lotnonew=$rowtblsub['newlono'];
		$lotnoornew=$rowtblsub['norlot'];
	}
	?>		 
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr class="Light" height="30">
    <td width="50%" align="right" valign="middle" class="smalltblheading">New Lot No.</td>
	<td align="left" valign="middle" class="smalltblheading">&nbsp;<input name="txtlotnumber" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="<?php echo $lotnonew;?>" readonly="true" style="background-color:#CCCCCC" >&nbsp;<input type="hidden" name="orlot" value="<?php echo $lotnoornew;?>" />&nbsp;Drying Batch No.</td>
</tr>
</table><input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
 
<div id="postingsubsubtable" style="display:block">	
<?php



$srno=1;
$lotqry=mysqli_query($link,"select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   lotcrop='".$crop."' and lotvariety='".$variety."' and batchflg=0 and dryflg=0")or die (mysqli_error($link));

$tot_row=mysqli_num_rows($lotqry);
//if($tot_row > 0)
//{

?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>-->
    <td width="106" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Before Drying</td>
	<!--<td align="center" valign="middle" class="smalltblheading" rowspan="2">Store in same Bin</td>-->
    <td colspan="3" align="center" valign="middle" class="smalltblheading">Updated SLOC</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">After Drying </td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Drying Loss </td>
  </tr>
  <tr class="tblsubtitle">
    <td width="69" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="81" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="96" align="center" valign="middle" class="smalltblheading">WH</td>
    <td width="109" align="center" valign="middle" class="smalltblheading">Bin</td>
    <td width="89" align="center" valign="middle" class="smalltblheading">Subbin</td>
	<td width="89" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="89" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="56" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="100" align="center" valign="middle" class="smalltblheading">%</td>
  </tr>
  <?php

$totqty=0; $totnob=0; $tqty=0; $tnob=0; $srno2=0; $owh="";$obin="";$osbin=""; $sloc="";
$wareh2=""; $binn2=""; $subbinn2=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
$sqltblsub=mysqli_query($link,"select * from tbl_cobdryingsub where  trid='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sqltblsub);

while($rowtblsub=mysqli_fetch_array($sqltblsub))
{

 $srno2++;
 	$totqty=$totqty+$rowtblsub['oqty']; 
	$totnob=$totnob+$rowtblsub['onob']; 
	$tqty=$rowtblsub['oqty']; 
	$tnob=$rowtblsub['onob'];
	 
	$sql_issuetbl=mysqli_query($link,"select * from tbl_dryarrival_sub where  lotno='".$rowtblsub['lotno']."' and batchflg=1 and dryflg=0") or die(mysqli_error($link)); 
	$t=mysqli_num_rows($sql_issuetbl);
	while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
	{
		$sql_issuetbl2=mysqli_query($link,"select * from tbl_dryarr_sloc where   arr_id='".$row_issuetbl['arrsub_id']."' ") or die(mysqli_error($link)); 
		while($row_issuetbl2=mysqli_fetch_array($sql_issuetbl2))
		{
			$wareh=""; $binn=""; $subbinn="";
			$sql_whouse=mysqli_query($link,"select perticulars from tbldrywarehouse where   whid='".$row_issuetbl2['whid']."' order by perticulars") or die(mysqli_error($link));
			$row_whouse=mysqli_fetch_array($sql_whouse);
			$wareh=$row_whouse['perticulars'];
			
			$sql_binn=mysqli_query($link,"select binname from tbldrybin where  binid='".$row_issuetbl2['binid']."' and whid='".$row_issuetbl2['whid']."'") or die(mysqli_error($link));
			$row_binn=mysqli_fetch_array($sql_binn);
			$binn=$row_binn['binname'];
			
			$sql_subbinn=mysqli_query($link,"select sname from tbldrysubbin where  sid='".$row_issuetbl2['subbin']."' and binid='".$row_issuetbl2['binid']."' and whid='".$row_issuetbl2['whid']."'") or die(mysqli_error($link));
			$row_subbinn=mysqli_fetch_array($sql_subbinn);
			$subbinn=$row_subbinn['sname'];
			
			$nsbin=$row_issuetbl2['subbin'];
			$owh=$row_issuetbl2['whid'];
			$obin=$row_issuetbl2['binid'];
			$osbin=$row_issuetbl2['subbin'];
			if($subbinn2=="")
			{
				$subbinn2=$nsbin;
				if($sloc!="")
					$sloc=$sloc."<br />".$wareh."/".$binn."/".$subbinn;
				else
					$sloc=$wareh."/".$binn."/".$subbinn;
			}
			else
			{
				$sbin=explode(",",$subbinn2);
				$sbin=array_unique($sbin);
				//print_r($sbin);
				if(!in_array($nsbin,$sbin))
				{
					if($sloc!="")
						$sloc=$sloc."<br />".$wareh."/".$binn."/".$subbinn;
					else
						$sloc=$wareh."/".$binn."/".$subbinn;
					$subbinn2=$subbinn2.",".$nsbin;		
				}
				else
				{
					$subbinn2=$subbinn2.",".$nsbin;	
				}
			}
		
		}
	}
}
$srno2=1;

$sqltblsub2=mysqli_query($link,"select * from tbl_cobdryingsub where   trid='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot2=mysqli_num_rows($sqltblsub2);

$rowtblsub2=mysqli_fetch_array($sqltblsub2);

$sql_tbl_subsub=mysqli_query($link,"select * from tbl_cobdryingsubsub where   trid='".$arrival_id."' and owh='".$owh."' and obin='".$obin."' and osubbin='".$osbin."'") or die(mysqli_error($link));
$rowsubsub=mysqli_fetch_array($sql_tbl_subsub);
$tot_tbl_subsub=mysqli_num_rows($sql_tbl_subsub);
?>
  <tr class="Light" height="30">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading"><?php echo $srno2;?></td>-->
    <td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?><!--<input name="sloc<?php echo $srno2?>" type="text" size="10" class="smalltbltext"  maxlength="12" style="background-color:#CCCCCC" value=""/>--><input type="hidden" name="extslwhg<?php echo $srno2?>" value="<?php echo $owh;?>" /><input type="hidden" name="extslbing<?php echo $srno2?>" value="<?php echo $obin;?>" /><input type="hidden" name="extslsubbg<?php echo $srno2?>" value="<?php echo $osbin;?>" /></td>

    <td width="69"  align="center" valign="middle" class="smallsmalltbltext"><?php echo $totnob;?>
    <input name="txtdisp<?php echo $srno2?>" id="txtdisp<?php echo $srno2?>" type="hidden" size="4" class="smalltbltext" tabindex="" maxlength="5"  onkeypress="return isNumberKey(event)" value="<?php echo $totnob;?>" style="background-color:#CCCCCC"  readonly="true" /></td>
    <td width="81" align="center"  valign="middle" class="smalltbltext"><?php echo $totqty;?>
    <input name="txtqty<?php echo $srno2?>" id="txtqty<?php echo $srno2?>" type="hidden" size="8" class="smalltbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $totqty;?>"/><input type="hidden" name="samebin<?php echo $srno2;?>" id="samebin<?php echo $srno2;?>" value="No" /></td>
	<!--<td width="62" align="center"  valign="middle" class="smalltbltext"><input type="checkbox" name="chkbox<?php echo $srno2;?>" id="chkbox<?php echo $srno2;?>" onclick="chkboxchk(<?php echo $srno2?>,<?php echo $arrival_id;?>,<?php echo $rowtblsub['lotno'];?>,<?php echo $subbinn2;?>)" value="samebin" /> <input type="hidden" name="samebin<?php echo $srno2;?>" id="samebin<?php echo $srno2;?>" value="No" /></td>-->

    <td  align="center"  colspan="3" valign="middle" class="smalltbltext">
<div id="samesloc<?php echo $srno2?>">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<tr>	
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbldrywarehouse  where plantcode='".$plantcode."' order by perticulars") or die(mysqli_error($link));
?>

<td width="96" align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg<?php echo $srno2?>" name="txtslwhg<?php echo $srno2?>" style="width:70px;" onchange="wh<?php echo $srno2?>(this.value,<?php echo $srno2?>);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option <?php if($tot_tbl_subsub>0){if($rowsubsub['nwh']==$noticia_whd1['whid']) echo "selected"; }?> value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
if($tot_tbl_subsub>0)
$bind1_query=mysqli_query($link,"select binid, binname from tbldrybin where whid='".$rowsubsub['nwh']."' order by binname") or die(mysqli_error($link));
else
$bind1_query=mysqli_query($link,"select binid, binname from tbldrybin where plantcode='".$plantcode."' order by binname") or die(mysqli_error($link));
?>

<td width="109" align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $srno2?>"><select class="smalltbltext" name="txtslbing<?php echo $srno2?>" style="width:60px;" onchange="bin<?php echo $srno2?>(this.value,<?php echo $srno2?>);" >
<option value="" selected>Bin</option>
<?php if($tot_tbl_subsub>0){ while($noticia_bing1 = mysqli_fetch_array($bind1_query)) { ?>
		<option <?php if($rowsubsub['nbin']==$noticia_bing1['binid']) echo "selected"; ?> value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php }} ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
if($tot_tbl_subsub>0)
$subbind1_query=mysqli_query($link,"select sid, sname from tbldrysubbin where plantcode='".$plantcode."' and   binid='".$rowsubsub['nbin']."' order by sname") or die(mysqli_error($link));
else
$subbind1_query=mysqli_query($link,"select sid, sname from tbldrysubbin where plantcode='".$plantcode."' order by sname") or die(mysqli_error($link));
?>	

<td width="89" align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno2?>"><select class="smalltbltext" name="txtslsubbg<?php echo $srno2?>" id="txtslsubbg<?php echo $srno2?>" style="width:60px;" onchange="subbin<?php echo $srno2?>(this.value,<?php echo $srno2?>);"  >
<option value="" selected>Subbin</option>
<?php if($tot_tbl_subsub>0){ while($noticia_subbing1 = mysqli_fetch_array($subbind1_query)) { ?>
		<option <?php if($rowsubsub['nsubbin']==$noticia_subbing1['sid']) echo "selected"; ?> value="<?php echo $noticia_subbing1['sid'];?>" />   
		<?php echo $noticia_subbing1['sname'];?>
		<?php }} ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  </tr>
</table>
</div>


<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno2;?>">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="recqtyp<?php echo $srno2?>" id="recqtyp<?php echo $srno2?>" type="text" size="4" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,<?php echo $srno2?>);" value="<?php  if($tot_tbl_subsub>0){echo $rowsubsub['nnob'];}?>"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtrecbagp<?php echo $srno2?>" id="txtrecbagp<?php echo $srno2?>" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onchange="Bagschk1(this.value,<?php echo $srno2?>);"  onkeypress="return isNumberKey(event)" value="<?php  if($tot_tbl_subsub>0){echo $rowsubsub['nqty'];}?>"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
</td>

      <td align="center"  valign="middle" class="smalltbltext"><input name="txtdqtyp<?php echo $srno2?>" id="txtdqtyp<?php echo $srno2?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" value="<?php  if($tot_tbl_subsub>0){echo $rowsubsub['dryingloss'];}?>"  /></td>
       
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtdbagp<?php echo $srno2?>" id="txtdbagp<?php echo $srno2?>" type="text" size="2" class="smalltbltext" tabindex=""   maxlength="3" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="<?php  if($tot_tbl_subsub>0){echo $rowsubsub['dlossper'];}?>" /></td>
  </tr>
 <?php
 // }
//}
?>


<tr class="Light" height="30">
    <td align="center" valign="middle" class="smalltblheading">Total<input name="txtlotno" type="hidden" size="15" class="smalltbltext"  maxlength="15" style="background-color:#CCCCCC" value="<?php echo $a;?>"/></td>

    <td width="69"  align="center" valign="middle" class="smalltbltext"><?php echo $totnob;?>
    <input name="txtdisptot" type="hidden" size="4" class="smalltbltext" tabindex="" maxlength="5" onchange="Bagsdcchk1(this.value);" onkeypress="return isNumberKey(event)" value="<?php echo $totnob;?>" style="background-color:#CCCCCC"  readonly="true" /></td>
    <td align="center"  valign="middle" class="smalltbltext"><?php echo $totqty;?><input name="txtqtytot" type="hidden" size="8" class="smalltbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $totqty;?>"/></td>
	<td colspan="3" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
	<td align="center"  valign="middle" class="smalltbltext" ><input name="recqtyptot" type="text" size="4" class="smalltbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC"  readonly="true" value="<?php  if($tot_tbl_subsub>0){echo $rowsubsub['nnob'];}?>"  />&nbsp;&nbsp;&nbsp;&nbsp;</td>

  
  <td align="center"  valign="middle" class="smalltbltext"><input name="txtrecbagptot" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onchange="Bagschk1(this.value);"  style="background-color:#CCCCCC"  readonly="true" value="<?php  if($tot_tbl_subsub>0){echo $rowsubsub['nqty'];}?>"  />&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtdqtyptot" type="text" size="4" class="smalltbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" value="<?php  if($tot_tbl_subsub>0){echo $rowsubsub['dryingloss'];}?>" /></td>
       
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtdbagptot" type="text" size="2" class="smalltbltext" tabindex=""   maxlength="3" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" value="<?php  if($tot_tbl_subsub>0){echo $rowsubsub['dlossper'];}?>" /><input name="txtdbagptotfull" type="hidden" class="smalltbltext" tabindex=""  value="<?php  if($tot_tbl_subsub>0){echo $rowsubsub['dlossper1'];}?>" /></td>
</tr>



<tr class="Light" height="30">
    <td align="center" valign="middle" class="smalltblheading">Drying Start</td>

    <td align="center" valign="middle" class="smalltblheading">Date</td>
	<td colspan="3" align="left" valign="middle" class="smalltbltext"  >&nbsp;<input name="datestart" id="datestart" type="text" size="20" class="smalltbltext" bndex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php  if($tot_tbl_subsub>0){ echo $rowtblsub2['dsdate'];}?>" maxlength="20" />&nbsp;<img src="../images/cal.gif" onclick="firstdt()" style="cursor:pointer"/>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
	
	
<td align="center" valign="middle" class="smalltblheading">Drying Details</td>
 <td align="center" valign="middle" class="smalltblheading">Type</td>
      <td  align="center"  valign="middle" class="smalltbltext"><select name="txtdmtyp" id="txtdmtyp" class="smalltbltext" style="size:30px;" onchange="chktime(this.value)" >
	  <option value="" selected="selected" class="smalltbltext">-Select-</option>
	  <option <?php if($tot_tbl_subsub>0){if($rowtblsub2['ddtype']=="Floor") echo "selected";} ?> value="Floor">Floor</option>
	  <option <?php if($tot_tbl_subsub>0){if($rowtblsub2['ddtype']=="Machine") echo "selected";} ?> value="Machine">Machine</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
	  <td align="center" valign="middle" class="smalltblheading">ID</td>
      <td align="center"  valign="middle" class="smalltbltext"><select name="txtdid" id="txtdid" class="smalltbltext" style="size:30px;" onchange="chkidtyp(this.value)" >
<option value="" selected="selected">-Select-</option>
<option <?php if($tot_tbl_subsub>0){ if($rowtblsub2['ddid']=="01") echo "selected"; }?> value="01">01</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="02") echo "selected";} ?> value="02">02</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="03") echo "selected";} ?> value="03">03</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="04") echo "selected";} ?> value="04">04</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="05") echo "selected";} ?> value="05">05</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="06") echo "selected";} ?> value="06">06</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="07") echo "selected";} ?> value="07">07</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="08") echo "selected";} ?> value="08">08</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="09") echo "selected";} ?> value="09">09</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="10") echo "selected";} ?> value="10">10</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="11") echo "selected";} ?> value="11">11</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="12") echo "selected";} ?> value="12">12</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="13") echo "selected";} ?> value="13">13</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="14") echo "selected";} ?> value="14">14</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="15") echo "selected";} ?> value="15">15</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="16") echo "selected";} ?> value="16">16</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="17") echo "selected";} ?> value="17">17</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="18") echo "selected";} ?> value="18">18</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="19") echo "selected";} ?> value="19">19</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="20") echo "selected";} ?> value="20">20</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="21") echo "selected";} ?> value="21">21</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="22") echo "selected";} ?> value="22">22</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="23") echo "selected";} ?> value="23">23</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="24") echo "selected";} ?> value="24">24</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="25") echo "selected";} ?> value="25">25</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="26") echo "selected";} ?> value="26">26</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="27") echo "selected";} ?> value="27">27</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="28") echo "selected";} ?> value="28">28</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="29") echo "selected";} ?> value="29">29</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="30") echo "selected";} ?> value="30">30</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="31") echo "selected";} ?> value="31">31</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="32") echo "selected";} ?> value="32">32</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="33") echo "selected";} ?> value="33">33</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="34") echo "selected";} ?> value="34">34</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="35") echo "selected";} ?> value="35">35</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="36") echo "selected";} ?> value="36">36</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="37") echo "selected";} ?> value="37">37</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="38") echo "selected";} ?> value="38">38</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="39") echo "selected";} ?> value="39">39</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="40") echo "selected";} ?> value="40">40</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="41") echo "selected";} ?> value="41">41</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="42") echo "selected";} ?> value="42">42</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="43") echo "selected";} ?> value="43">43</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="44") echo "selected";} ?> value="44">44</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="45") echo "selected";} ?> value="45">45</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="46") echo "selected";} ?> value="46">46</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="47") echo "selected";} ?> value="47">47</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="48") echo "selected";} ?> value="48">48</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="49") echo "selected";} ?> value="49">49</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="50") echo "selected";} ?> value="50">50</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="51") echo "selected";} ?> value="51">51</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="52") echo "selected";} ?> value="52">52</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="53") echo "selected";} ?> value="53">53</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="54") echo "selected";} ?> value="54">54</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="55") echo "selected";} ?> value="55">55</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="56") echo "selected";} ?> value="56">56</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="57") echo "selected";} ?> value="57">57</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="58") echo "selected";} ?> value="58">58</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="59") echo "selected";} ?> value="59">59</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="60") echo "selected";} ?> value="60">60</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="61") echo "selected";} ?> value="61">61</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="62") echo "selected";} ?> value="62">62</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="63") echo "selected";} ?> value="63">63</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="64") echo "selected";} ?> value="64">64</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="65") echo "selected";} ?> value="65">65</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="66") echo "selected";} ?> value="66">66</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="67") echo "selected";} ?> value="67">67</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="68") echo "selected";} ?> value="68">68</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="69") echo "selected";} ?> value="69">69</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="70") echo "selected";} ?> value="70">70</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="71") echo "selected";} ?> value="71">71</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="72") echo "selected";} ?> value="72">72</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="73") echo "selected";} ?> value="73">73</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="74") echo "selected";} ?> value="74">74</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="75") echo "selected";} ?> value="75">75</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="76") echo "selected";} ?> value="76">76</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="77") echo "selected";} ?> value="77">77</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="78") echo "selected";} ?> value="78">78</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="79") echo "selected";} ?> value="79">79</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="80") echo "selected";} ?> value="80">80</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="81") echo "selected";} ?> value="81">81</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="82") echo "selected";} ?> value="82">82</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="83") echo "selected";} ?> value="83">83</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="84") echo "selected";} ?> value="84">84</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="85") echo "selected";} ?> value="85">85</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="86") echo "selected";} ?> value="86">86</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="87") echo "selected";} ?> value="87">87</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="88") echo "selected";} ?> value="88">88</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="89") echo "selected";} ?> value="89">89</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="90") echo "selected";} ?> value="90">90</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="91") echo "selected";} ?> value="91">91</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="92") echo "selected";} ?> value="92">92</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="93") echo "selected";} ?> value="93">93</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="94") echo "selected";} ?> value="94">94</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="95") echo "selected";} ?> value="95">95</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="96") echo "selected";} ?> value="96">96</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="97") echo "selected";} ?> value="97">97</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="98") echo "selected";} ?> value="98">98</option>
<option <?php if($tot_tbl_subsub>0){  if($rowtblsub2['ddid']=="99") echo "selected";} ?> value="99">99</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

</tr>
<tr class="Light" height="30">
<td align="center" valign="middle" class="smalltblheading">Drying End</td>

    <td align="center" valign="middle" class="smalltblheading">Date</td>
	<td colspan="3" align="left" valign="middle" class="smalltbltext"  >&nbsp;<input name="dateend" id="dateend" type="text" size="20" class="smalltbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo $rowtblsub2['dedate'];?>" maxlength="20" onblur="tdelay(this.value)" />&nbsp;<img src="../images/cal.gif" onclick="caldiff();" style="cursor:pointer"/>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td align="center" valign="middle" class="smalltblheading">Total D. Time</td>	
<td align="left" valign="middle" class="smalltblheading" colspan="4">&nbsp;<input type="text" name="txttottime" class="smalltbltext" size="35" style="background-color:#CCCCCC" readonly="true" value="<?php echo $rowtblsub2['dtime'];?>" /></td> 

</tr>



	  <input type="hidden" name="srno2" value="<?php echo $srno2?>" />
</table>
<br />



<!--<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>--></div>
</div>
</div>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="light" height="30">
  <td width="61" align="right" class="smalltblheading">Remarks&nbsp;</td>
  <td width="903" align="left" class="smalltbltext">&nbsp;<input type="text" name="txtremarks" size="140" value="<?php echo $row_tbl['remarks'];?>" class="smalltbltext" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_drying.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>

  
