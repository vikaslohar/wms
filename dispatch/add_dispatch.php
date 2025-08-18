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
		
	if(isset($_POST['frm_action'])=='submit')
	{ 
		set_time_limit(120);
		$mainid=trim($_POST['maintrid']);
		$p_id=trim($_POST['maintrid']);
		$txt11=trim($_POST['txt11']);
		$trsbmval=trim($_POST['trsbmval']);
		
		if($trsbmval==0)
		{
			echo "<script>window.location='add_dispallocation_preview.php?pid=$mainid'</script>";	
		}
		else
		{
			$totmmc1=0;
			$sqmmc1=mysqli_query($link,"Select * from tbl_dallocmmc where plantcode='".$plantcode."' and dalloc_id='$mainid' and dmmc_flg=1") or die(mysqli_error($link));
			$totmmc1=mysqli_num_rows($sqmmc1);
			if($totmmc1>0)
			{
			?>
				<script language="javascript">alert("Cannot Cancel the Transaction. Reason: MMC Created and Allocated to this party.")</script>
			<?php
				echo "<script>window.location='add_dispallocation_preview.php?pid=$mainid'</script>";	
			}
			else
			{
				$sq=mysqli_query($link,"select * from tbl_dallocsub_sub3 where plantcode='".$plantcode."' and  dalloc_id='$mainid'") or die(mysqli_error($link));
				while($ro=mysqli_fetch_array($sq))
				{
					$sqlb1="update tbl_mpmain set mpmain_alflg=0, mpmain_altrid='0' where mpmain_barcode='".$ro['dallocss3_barcode']."'";
					$adcs=mysqli_query($link,$sqlb1) or die(mysqli_error($link));
				}
				$sqlb1="update tbl_mpmain set mpmain_alflg=0, mpmain_altrid='0' where mpmain_altrid='".$mainid."'";
				$adcs=mysqli_query($link,$sqlb1) or die(mysqli_error($link));
				
				$sq23=mysqli_query($link,"Select distinct dallocss_lotno, dallocss_ups from tbl_dallocsub_sub where plantcode='".$plantcode."' and  dalloc_id='$mainid'") or die(mysqli_error($link));
				$totre=mysqli_num_rows($sq23);
				while($row23=mysqli_fetch_array($sq23))
				{	
					$nmp=0;$tqty=0;
					$sql_dalcsubsub=mysqli_query($link,"Select * from tbl_dallocsub_sub where plantcode='".$plantcode."' and  dallocss_lotno='".$row23['dallocss_lotno']."' and dallocss_ups='".$row23['dallocss_ups']."' and dalloc_id='$mainid'") or die(mysqli_error($link));
					$tot_dalcsubsub=mysqli_num_rows($sql_dalcsubsub);
					while($row_dalcsubsub=mysqli_fetch_array($sql_dalcsubsub))
					{
						$tqty=$tqty+$row_dalcsubsub['dallocss_qty'];
						$nmp=$nmp+$row_dalcsubsub['dallocss_nomp']; 
					}
					
					$sql_lot2=mysqli_query($link,"Select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotno='".$row23['dallocss_lotno']."' and packtype='".$row23['dallocss_ups']."' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1 order by lotdgp_id DESC") or die(mysqli_error($link));
					$tot_lot2=mysqli_num_rows($sql_lot2);
					$row_lot2=mysqli_fetch_array($sql_lot2);
											
					$sql_lot=mysqli_query($link,"Select * from tbl_lot_ldg_pack where plantcode='".$plantcode."' and  lotdgp_id='".$row_lot2[0]."' and lotldg_alflg!=1 and lotldg_rvflg=0 and lotldg_dispflg!=1") or die(mysqli_error($link));
					$tot_lot=mysqli_num_rows($sql_lot);
					$row_lot=mysqli_fetch_array($sql_lot);
											
					$lotallqty=$row_lot['lotldg_alqtys'];
					$lotallqty=$lotallqty-$tqty;
					if($lotallqty<=0)$lotallqty=0;
					
					$lotallnmp=$row_lot['lotldg_alnomps'];
					$lotallnmp=$lotallnmp-$nmp;
					if($lotallnmp<=0)$lotallnmp=0;
													
					if($row_lot['lotldg_altrids']!="")
					$lotalltrids1=$row_lot['lotldg_altrids'].",";
					$ltalids="";
					$lotalltrids=explode(",",$lotalltrids1);
					
					foreach($lotalltrids as $ltalid)
					{
						if($ltalid<>"" && $ltalid!=$mainid)
						{
							if($ltalids!="")
								$ltalids=$ltalids.",".$ltalid;
							else
								$ltalids=$ltalid;
						}
					}
					if($lotallqty<=0)
					$sqlltb1="update tbl_lot_ldg_pack set lotldg_alflg=0, lotldg_altrids='', lotldg_alqtys='0', lotldg_alnomps='0' where lotno='".$row23['dallocss_lotno']."'";
					else
					$sqlltb1="update tbl_lot_ldg_pack set lotldg_alflg=2, lotldg_altrids='$ltalids', lotldg_alqtys='".$lotallqty."', lotldg_alnomps='".$lotallnmp."' where lotno='".$row23['dallocss_lotno']."'";
					$adcsltbl=mysqli_query($link,$sqlltb1) or die(mysqli_error($link));	
				}
				$sq23=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and dalloc_id='$mainid' and dallocs_dispqty>0") or die(mysqli_error($link));
				if($totre=mysqli_num_rows($sq23)>0)
				$sql_main="update tbl_dalloc set dalloc_dflg='1' where dalloc_id='$mainid'";
				else
				$sql_main="update tbl_dalloc set dalloc_tflg='0' where dalloc_id='$mainid'";
				$as=mysqli_query($link,$sql_main) or die(mysqli_error($link));
				echo "<script>window.location='home_dispallocation.php'</script>";	
			}
		}
	}
	
	$sql_code="SELECT MAX(dalloc_tcode) FROM tbl_dalloc  where plantcode='".$plantcode."' ORDER BY dalloc_tcode DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
	if(mysqli_num_rows($res_code) > 0)
	{
		$row_code=mysqli_fetch_row($res_code);
		$t_code=$row_code['0'];
		$code=$t_code+1;
		$code1="TDA".$code."/".$yearid_id."/".$lgnid;
	}
	else
	{
		$code=1;
		$code1="TDA".$code."/".$yearid_id."/".$lgnid;
	}
	
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>
<script src="search.js"></script>
<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dispatch - Transaction - Dispatch Allocation</title>
<link href="../include/main_dispatch.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dispatch.css" rel="stylesheet" type="text/css" />
</head>
<script src="dispallocate.js"></script>
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

function isNumberKey24(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && charCode != 8 && charCode != 9 && charCode != 127 && (charCode < 47 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
	return false;

	return true;
}
function isChar_o(Char) // This function accepts only alphabetic characters with no space, no special chars.
{
	var CharToChk = new String(Char);
	var LengthOfChar = CharToChk.length;
	var flag = true;
	for(var i=0;i<LengthOfChar;i++)
	{
		if((CharToChk.charCodeAt(i)<65 || CharToChk.charCodeAt(i)>90) && (CharToChk.charCodeAt(i)<97 || CharToChk.charCodeAt(i)>122)) 
		{
			flag = false;
			break;
		}	
	}
	return flag;
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

function pform()
{	
	var fl=0;
	var olbtn="<img src='../images/post.gif' border='0' style='display:inline;cursor:pointer;' onclick='pform();' />&nbsp;&nbsp;";
	document.getElementById('frmbutn').innerHTML="<img src='../images/processing2.gif' border='0' style='display:inline;cursor:wait;' />&nbsp;&nbsp;";
	
	if(document.frmaddDepartment.txtpp.value=="")
	{
		alert("Please select Party Type");
		document.frmaddDepartment.txtpp.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please select Party Name");
		document.frmaddDepartment.txtstfp.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.allocationtype.value=="")
	{
		alert("Please select Allocation Type");
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}
	
	
	var sn=document.frmaddDepartment.sn.value;
	for (var i=1; i<sn; i++)
	{
		var sls="selsh_"+i;
		//alert(document.frmaddDepartment.mchksel.value); alert(i);
		//if(document.frmaddDepartment.mchksel.value!="" && document.frmaddDepartment.mchksel.value==i)
		if(document.getElementById(sls).checked==true)
		{
			//alert(document.frmaddDepartment.txtolotno.value);
			if(document.frmaddDepartment.txtolotno.value=="")
			{
				alert("Please select Lot No.");
				document.getElementById('frmbutn').innerHTML=olbtn;
				//document.frmaddDepartment.txtbrowse.focus();
				fl=1;
				return false;
			}
			var bnop="bnop_"+i;
			
			var sno1=document.frmaddDepartment.sno1.value;
			//alert(sno1); 
			if(sno1!="")
			{
				for (var k=1; k<sno1; k++)
				{
					var inpt="lotsel_"+k;
					var inptyp="inptyp_"+k;
					//alert(document.frmaddDepartment.mchksel.value); 
					//alert(document.getElementById(inptyp).value);
					//if(document.frmaddDepartment.mchksel.value!="" && document.frmaddDepartment.mchksel.value==i)
					if(document.getElementById(inpt).checked==true)
					{ 
						if(document.getElementById(inptyp).value=="lotsel")
						{
							var val=document.frmaddDepartment.srno2.value;
							//alert(val); 
							if(val!="")
							{	
								var v_1=0;
								var qtyd=0;
								var qtyo=0;
								var qtyb=0;
								var nop=0;
								var nomp=0;
								for(var j=1; j<=val; j++)
								{ 
									var dc="recnobp"+j;
									var rem="recqtyp"+j;
									var bal="txtbalqtyp"+j;
									var nop="txtbalnobp"+j;
									nop=parseInt(nop)+parseInt(document.getElementById(dc).value);
									nomp=parseInt(rem)+parseInt(document.getElementById(rem).value);
									if(document.getElementById(rem).value=="")
									{
										v_1++;
									}
										var q=document.getElementById(dc).value;
										var rq=document.getElementById(rem).value;
										var bq=document.getElementById(bal).value;
										
										if(rq=="")rq=0;
										
										var qtyd=parseFloat(qtyd)+parseFloat(rq);
										var qtyb=parseFloat(qtyb)+parseFloat(bq);
								}
								if(nop==0 && nomp==0)
								{
									alert("Please Enter NoMP/Qty to Allocate");
									document.getElementById('frmbutn').innerHTML=olbtn;
									f=1;
									return false;
								}
								if(v_1>=val)
								{
									alert("Please Enter NoMP/Qty to Allocate");
									document.getElementById('frmbutn').innerHTML=olbtn;
									f=1;
									return false;
								}	
								//alert(parseFloat(qtyd));
								//alert(parseFloat(document.getElementById(bnop).value));				
								if(parseFloat(qtyd) > parseFloat(document.getElementById(bnop).value))
								{
									alert("Please check. Total Quantity to be Allocated not matching with Total Balance Quantity in Order(s)");
									document.getElementById('frmbutn').innerHTML=olbtn;
									f=1;
									return false;
								}	
							}
							else
							{
							f=1;
							}
						}
					}	
				}	
			}
		}
	}
	if(document.frmaddDepartment.eseltyp.value=="barsel" && (document.frmaddDepartment.binshifting.value=="no" || document.frmaddDepartment.binshifting.value==""))
	{
		alert("Barcode(s) needs to be scanned and Bin shifting needs to be done");
		document.getElementById('frmbutn').innerHTML=olbtn;
		f=1;
		return false;
	}
	if(document.frmaddDepartment.binshifting.value=="yes")
	{
		if(parseInt(document.frmaddDepartment.nslval.value)!=parseInt(document.frmaddDepartment.nbarallval.value))
		{
			alert("Please scan the Barcode(s) for Bin shifting");
			document.getElementById('frmbutn').innerHTML=olbtn;
			f=1;
			return false;
		}
		var sln=document.frmaddDepartment.sln.value;
		for(var j=1; j<sln; j++)
		{ 
			var wh="txtwhg"+j;
			var bin="txtbing"+j;
			var nop="bnnomps_"+j;
			var qtr="bnqtys_"+j;
			
			if(document.getElementById(bin).value="")
			{
				alert("Please select Bin for Bin shifting");
				document.getElementById('frmbutn').innerHTML=olbtn;
				f=1;
				return false;
			}
		}	
	}
	//alert(fl);
	if(fl==1)
	{
		document.getElementById('frmbutn').innerHTML=olbtn;
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
	var olbtn="<img src='../images/update.gif' border='0' style='display:inline;cursor:pointer;' onclick='pformedtup();' />&nbsp;&nbsp;";
	document.getElementById('frmbutn').innerHTML="<img src='../images/processing2.gif' border='0' style='display:inline;cursor:wait;' />&nbsp;&nbsp;";
	
	if(document.frmaddDepartment.txtpp.value=="")
	{
		alert("Please select Party Type");
		document.frmaddDepartment.txtpp.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please select Party Name");
		document.frmaddDepartment.txtstfp.focus();
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.edtunallocationtype.value=="")
	{
		alert("Please select Allocation Type");
		document.getElementById('frmbutn').innerHTML=olbtn;
		fl=1;
		return false;
	}
	
	var sn=document.frmaddDepartment.sn.value;
	for (var i=1; i<sn; i++)
	{
		var sls="selsh_"+i;
		//alert(document.frmaddDepartment.mchksel.value); alert(i);
		//if(document.frmaddDepartment.mchksel.value!="" && document.frmaddDepartment.mchksel.value==i)
		if(document.getElementById(sls).checked==true)
		{
			//alert("checked");
			if(document.frmaddDepartment.txtolotno.value=="")
			{
				alert("Please select Lot No.");
				document.getElementById('frmbutn').innerHTML=olbtn;
				//document.frmaddDepartment.txtbrowse.focus();
				fl=1;
				return false;
			}
			var bnop="bnop_"+i;
			
			var val=document.frmaddDepartment.srno2.value;
			//alert(val); 
			if(val!="")
			{	
				var v_1=0;
				var qtyd=0;
				var qtyo=0;
				var qtyb=0;
				var nop=0;
				var nomp=0;
				for(var j=1; j<=val; j++)
				{ 
					var dc="recnobp"+j;
					var rem="recqtyp"+j;
					var bal="txtbalqtyp"+j;
					var nop="txtbalnobp"+j;
					nop=parseInt(nop)+parseInt(document.getElementById(dc).value);
					nomp=parseInt(rem)+parseInt(document.getElementById(rem).value);
					if(document.getElementById(rem).value=="")
					{
						v_1++;
					}
						var q=document.getElementById(dc).value;
						var rq=document.getElementById(rem).value;
						var bq=document.getElementById(bal).value;
						
						if(rq=="")rq=0;
						
						var qtyd=parseFloat(qtyd)+parseFloat(rq);
						var qtyb=parseFloat(qtyb)+parseFloat(bq);
				}
				if(nop==0 && nomp==0)
				{
					alert("Please Enter NoMP/Qty to Allocate");
					document.getElementById('frmbutn').innerHTML=olbtn;
					f=1;
					return false;
				}
				if(v_1>=val)
				{
					alert("Please Enter NoMP/Qty to Allocate");
					document.getElementById('frmbutn').innerHTML=olbtn;
					f=1;
					return false;
				}	
				//alert(parseFloat(qtyd));
				//alert(parseFloat(document.getElementById(bnop).value));				
				if(parseFloat(qtyd) > parseFloat(document.getElementById(bnop).value))
				{
					alert("Please check. Total Quantity to be Allocated not matching with Total Balance Quantity in Order(s)");
					document.getElementById('frmbutn').innerHTML=olbtn;
					f=1;
					return false;
				}		
			}
		}
	}
	
	if(document.frmaddDepartment.binshifting.value=="yes")
	{
		if(parseInt(document.frmaddDepartment.nslval.value)!=parseInt(document.frmaddDepartment.nbarallval.value))
		{
			alert("Please scan the Barcode(s) for Bin shifting");
			document.getElementById('frmbutn').innerHTML=olbtn;
			return false;
		}
	}
		
	if(f==1)
	{
		document.getElementById('frmbutn').innerHTML=olbtn;
		return false;
	}
	else
	{
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		showUser(a,'postingtable','mformsubedt','','','','');
	}
}

function modetchk(classval)
{
	//document.getElementById('barcwise').style.display="none";
	//document.getElementById('lotnwise').style.display="none";
	document.getElementById('orderdetails').style.display="none";
	//document.frmaddDepartment.barcode.value="";
	//document.getElementById('lotnwise').innerHTML="";
	for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
	{
		document.frmaddDepartment.allctyp[i].checked=false;
	}
	document.frmaddDepartment.allocationtype.value="";
	showUser(classval,'vitem','item','','','','','');
	document.frmaddDepartment.txtlot1.value==""
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
	if(document.frmaddDepartment.txtvariety.value=="")
	{
		alert("Please Select Variety first.");
		document.frmaddDepartment.txtvariety.focus();
	}
	else
	{
		//var itm="Pack Seed";
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		var trid=document.frmaddDepartment.maintrid.value;
		winHandle=window.open('getuser_rem_lotno.php?crop='+crop+'&variety='+variety+'&trid='+trid,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}

function editrec(edtrecid, trid)
{
	//alert(trid);
	//showUser(edtrecid,'postingsubtable','subformedt',trid,'','','','');
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



function getdetails()
{
	if(document.frmaddDepartment.txtlot1.value=="")
	{
	 alert("Please Select or enter Lot No.");
	}
	else
	{
		var get=document.frmaddDepartment.txtlot1.value;
		
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
		if(!isChar_W(document.frmaddDepartment.txtlot1.value.charAt(0)))
		{
			alert("Lot No cannot start with Numaric value.");
			document.frmaddDepartment.txtlot1.focus();
			return false;
		}
		if(document.frmaddDepartment.txtlot1.value.length<6)
		{
			alert("Lot No cannot be less than 6 digits alphanumaric.");
			document.frmaddDepartment.txtlot1.focus();
			return false;
		}
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;					
		var tid=document.frmaddDepartment.maintrid.value;
		var lotid=document.frmaddDepartment.subtrid.value;
			
		showUser(get,'postingsubtable','get',crop,variety,tid,lotid,'','');
		document.frmaddDepartment.getdetflg.value=1;
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

function qtychk1(qtyval1,val, typ)
{
	if(qtyval1!="" && qtyval1 > 0)
	{
		var z1="txtbalnobp"+val;
		var z2="txtextnob"+val;
		var z3="recnobp"+val;
		var b1="txtbalqtyp"+val;
		var b2="txtextqty"+val;
		var b3="recqtyp"+val;
		if(parseInt(document.getElementById(z3).value) > parseInt(document.getElementById(z2).value))
		{
			alert( "Picked for Allocate NoMP(s) can only be equal or less than Available NoMP(s)");
			document.getElementById(z1).value="";
			document.getElementById(b1).value="";
			document.getElementById(z3).value="";
			document.getElementById(z3).focus();
			return false;
		}
		else
		{
		//alert(typ);
			var qty=0.000;
			qty=parseFloat(qtyval1)*parseFloat(document.frmaddDepartment.ewtmp.value);
			
			if(typ!="add")
			var x=(parseFloat(document.getElementById('txtorblqty').value)+parseFloat(qty));
			else
			var x=(parseFloat(document.getElementById('txtloqty').value)+parseFloat(qty));
			
			if(parseFloat(qty) > parseFloat(document.getElementById(b2).value))
			{
				alert("Qty picked for Allocate can only be equal or less than Available Qty");
				document.getElementById(z1).value="";
				document.getElementById(b1).value="";
				document.getElementById(b3).value="";
				document.getElementById(b3).focus();
				return false;
			}
			else if(parseFloat(document.getElementById('txttobealqty').value) < parseFloat(x))
			{
				alert( "Qty picked for Allocate at lot in progress list, can only be equal or less than 'To be Allocated Qty' at item level");
				document.getElementById(z1).value="";
				document.getElementById(b1).value="";
				document.getElementById(z3).value="";
				document.getElementById(z3).focus();
				return false;
			}
			else
			{
				document.getElementById(z1).value=parseInt(document.getElementById(z2).value)-parseInt(qtyval1);
				document.getElementById(b3).value=parseFloat(qty);
				document.getElementById(b3).value=parseFloat(document.getElementById(b3).value).toFixed(3);
				document.getElementById(b1).value=parseFloat(document.getElementById(b2).value)-parseFloat(document.getElementById(b3).value);
				document.getElementById(b1).value=parseFloat(document.getElementById(b1).value).toFixed(3);
				if(document.getElementById(b1).value<=0)document.getElementById(b1).value=0;
				//if(document.getElementById(b1).value > 0 && document.getElementById(z1).value<=0)document.getElementById(z1).value=1;
			}
		}
	}
	/*else
	{
		alert( "NoMP can not be Zero");
		document.getElementById(z1).value="";
		document.getElementById(b1).value="";
		document.getElementById(b3).value="";
		document.getElementById(z3).value="";
		document.getElementById(z3).focus();
		return false;
	}*/
}

function Bagschk1(Bagsval1, val, typ)
{
	var z1="txtbalnobp"+val;
	var z2="txtextnob"+val;
	var z3="recnobp"+val;
	var z4="recnolbp"+val;
	var b1="txtbalqtyp"+val;
	var b2="txtextqty"+val;
	var b3="recqtyp"+val;
	var extbnob="extbnob"+val
	//alert(val);
	if(Bagsval1!="" && Bagsval1 > 0)
	{
		if(parseFloat(document.getElementById(b3).value) > parseFloat(document.getElementById(b2).value))
		{
			alert("Qty picked for Allocate can only be equal or less than Available Qty");
			document.getElementById(z1).value="";
			document.getElementById(b1).value="";
			document.getElementById(b3).value="";
			document.getElementById(b3).focus();
			return false;
		}
		else
		{
			var packtp=document.frmaddDepartment.txtnups.value.split(" ");
			
			if(packtp[1]=="Gms")
			{ 
				var ptp=(1000/parseFloat(packtp[0]));
				var ptp1=(parseFloat(packtp[0])/1000);
			}
			else
			{
				if(parseFloat(packtp[0])<0)
				{
				var ptp=(1000/parseFloat(packtp[0]))/1000;
				var ptp1=(parseFloat(packtp[0])/1000)*1000;
				}
				else
				{
				var ptp=parseFloat(packtp[0]);
				var ptp1=parseFloat(packtp[0]);
				}
			}
			
			var tqt=parseFloat(document.getElementById(z2).value)*parseFloat(document.frmaddDepartment.ewtmp.value);
			//alert(tqt);
			var qst=parseFloat(document.getElementById(b2).value)-parseFloat(tqt);
			//alert(qst);
			var qty=parseFloat(Bagsval1)/parseFloat(document.frmaddDepartment.ewtmp.value);
			if(parseInt(document.getElementById(z2).value)==0)qty=0;
			qty1=parseFloat(qty).toFixed(3);
			var xs=qty1.split(".");
			var bqts=parseFloat(document.getElementById(extbnob).value)*parseFloat(ptp1);
			//alert(bqts);
			if(document.getElementById(z2).value>0)
			{
				if(parseFloat(Bagsval1)>parseFloat(document.frmaddDepartment.ewtmp.value))
				{
					var sqt=parseFloat(xs[0])*parseFloat(document.frmaddDepartment.ewtmp.value);
					//alert(sqt);
					var uqt=parseFloat(Bagsval1)-parseFloat(sqt);
					//alert(uqt);
					
					if(parseFloat(uqt)>parseFloat(bqts))
					{
						alert("ALERT\n\nThe selected Lot is not having inventory in loose pouches.\nPlease enter Qty only in NoMP's OR in available Loose Pouches Qty");
						document.getElementById(z1).value="";
						document.getElementById(b1).value="";
						document.getElementById(z3).value="";
						document.getElementById(b3).value="";
						document.getElementById(b3).focus();
						return false;
					}
				
				}
				if(parseFloat(Bagsval1)<parseFloat(document.frmaddDepartment.ewtmp.value))
				{
					if(parseFloat(Bagsval1)>parseFloat(bqts))
					{
						alert("ALERT\n\nThe selected Lot is not having inventory in loose pouches.\nPlease enter Qty only in NoMP's OR in available Loose Pouches Qty");
						document.getElementById(z1).value="";
						document.getElementById(b1).value="";
						document.getElementById(z3).value="";
						document.getElementById(b3).value="";
						document.getElementById(b3).focus();
						return false;
					}
				}
			}
			//alert(document.getElementById(extbnob).value);
			
			
			
			//alert(xs[1]);
			//if(qst<=0 && xs[1]>0)
			if(document.getElementById(extbnob).value==0)
			{
				alert("ALERT\n\nThe selected Lot is not having inventory in loose pouches.\nPlease enter Qty only in NoMP's");
				document.getElementById(z1).value="";
				document.getElementById(b1).value="";
				document.getElementById(z3).value="";
				document.getElementById(b3).value="";
				document.getElementById(b3).focus();
				return false;
			}
			
			/*if(xs[1]<0)
			{
				alert("NoMP cannot be less than or equal to ZERO");
				document.getElementById(z1).value="";
				document.getElementById(b1).value="";
				document.getElementById(b3).value="";
				document.getElementById(b3).focus();
				return false;
			}
			
			if(xs[1]>0)
			{
				alert("NoMP cannot be in Decimal value");
				document.getElementById(z1).value="";
				document.getElementById(b1).value="";
				document.getElementById(b3).value="";
				document.getElementById(b3).focus();
				return false;
			}*/
			
			
			
			document.getElementById(z1).value=parseInt(document.getElementById(z2).value)-parseInt(qty);
			document.getElementById(z3).value=parseInt(qty);
			var qqt=parseFloat(document.frmaddDepartment.ewtmp.value)*parseFloat(document.getElementById(z3).value);
			var tlsub=parseFloat(Bagsval1)-parseFloat(qqt);
			if(packtp[1]=="Gms")
			var nlps=parseFloat(tlsub)*parseFloat(ptp);
			else
			var nlps=parseFloat(tlsub)/parseFloat(ptp);
			nlps=parseFloat(nlps).toFixed(0);
			//alert(Bagsval1); alert(qqt); alert(ptp); alert(tlsub); alert(nlps);
			document.getElementById(z4).value=parseInt(nlps);
			if(parseInt(document.getElementById(z4).value)<0)
			document.getElementById(z4).value=0;
			
			if(parseInt(document.getElementById(z3).value) > parseInt(document.getElementById(z2).value))
			{
				alert( "Picked for Allocate NoMP(s) can only be equal or less than Available NoMP(s)");
				document.getElementById(z1).value="";
				document.getElementById(b1).value="";
				document.getElementById(z3).value="";
				document.getElementById(z3).focus();
				return false;
			}
			
			if(typ!="add")
			var xds=(parseFloat(document.getElementById('txtorblqty').value)+parseFloat(Bagsval1));
			else
			var xds=(parseFloat(document.getElementById('txtloqty').value)+parseFloat(Bagsval1));
			
			//if(parseFloat(document.getElementById('txttobealqty').value) < parseFloat(x))
			
			//var xds=parseFloat(document.getElementById('txtloqty').value)+parseFloat(Bagsval1);
			xds=parseFloat(xds).toFixed(3);
			//alert(parseFloat(document.getElementById('txttobealqty').value));
			//alert(xds);
			if(parseFloat(document.getElementById('txttobealqty').value) < parseFloat(xds))
			{
				alert("Qty picked for Allocate at lot in progress list, can only be equal or less than 'To be Allocated Qty' at item level");
				document.getElementById(z1).value="";
				document.getElementById(b1).value="";
				document.getElementById(b3).value="";
				document.getElementById(b3).focus();
				return false;
			}
			document.getElementById(b1).value=parseFloat(document.getElementById(b2).value)-parseFloat(document.getElementById(b3).value);
			document.getElementById(b1).value=parseFloat(document.getElementById(b1).value).toFixed(3);
			if(document.getElementById(b1).value<=0)document.getElementById(b1).value=0;
			
			//if(document.getElementById(b1).value > 0 && document.getElementById(z1).value<=0)document.getElementById(z1).value=1;
		}
	}
	else
	{
		document.getElementById(z3).value=0;
		document.getElementById(z4).value=0;
		document.getElementById(b1).value=document.getElementById(b2).value;
		document.getElementById(z1).value=document.getElementById(z2).value;
	}
}

function nompchk1(Bagsval1, val)
{
	var z1="txtdisp_"+val;
	var z2="txtrecbagp_"+val;
	var z3="txtdbagp_"+val;
		
	var q1="txtqty_"+val;
	var q2="recqtyp_"+val;
	var q3="txtdqtyp_"+val;
		
	var m1="txtallnomp_"+val;
	var m2="txtrecnomp_"+val;
	var m3="txtdnomp_"+val;
		
	var wtinmp="wtinmp_"+val;
	var pcktyp="upspacktype_"+val;
	
	var qty=0.000;
	var packtp=document.getElementById(pcktyp).value.split(" ");
			
	if(packtp[1]=="Gms")
	{ 
		var ptp=(parseFloat(packtp[0])/1000);
	}
	else
	{
		var ptp=parseFloat(packtp[0]);
	}
	
	if(Bagsval1!="" && Bagsval1 > 0)
	{	
		if(parseInt(document.getElementById(m2).value)>parseInt(document.getElementById(m1).value))
		{
			alert( "NoMP can be either equal or less than Actual NoMP");
			document.getElementById(m2).value="";
			document.getElementById(m3).value="";
			document.getElementById(m2).focus();
			return false;
		}
		else
		{
			if(document.getElementById(z2).value!="" && document.getElementById(z2).value>0)
			{
				qty=((parseFloat(document.getElementById(m2).value))*(parseFloat(document.getElementById(wtinmp).value)))+((parseFloat(document.getElementById(z2).value))*(parseFloat(ptp)));
			}
			else
			{
				qty=(parseFloat(document.getElementById(m2).value)*parseFloat(document.getElementById(wtinmp).value));
			}
			
			document.getElementById(m3).value=parseInt(document.getElementById(m1).value)-parseInt(document.getElementById(m2).value);
			document.getElementById(z3).value=parseInt(document.getElementById(z1).value)-parseInt(document.getElementById(z2).value);
			document.getElementById(q2).value=parseFloat(qty);
			document.getElementById(q3).value=parseFloat(document.getElementById(q1).value)-parseFloat(qty);
			document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
			//if(document.getElementById(z1).value<0)document.getElementById(z1).value=0;
		}
	}
	else
	{
			if(document.getElementById(z2).value!="" && document.getElementById(z2).value>0)
			{
				qty=(parseFloat(document.getElementById(z2).value)*parseFloat(ptp));
				document.getElementById(q2).value=parseFloat(qty);
				document.getElementById(q3).value=parseFloat(qty);
				document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
			}
	}
}

function spmchk()
{
}

function dcdchk()
{
	dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.date.value,"-");
	if(dt3 > dt4)
	{
		alert("Please select Valid Delivary Challan Date.");
		document.frmaddDepartment.txtdcno.value="";
		return false;
	}
	var t=0;
	var haystack=document.frmaddDepartment.extdcno.value.split(",");
	var needle=document.frmaddDepartment.txtdcno.value;
	var count=haystack.length;
	for(var i=0;i<count;i++)
	{
		if(haystack[i]===needle){t++;}
	}
	if(t>0)
	{
		alert("Duplicate Delivary Challan No.");
		document.frmaddDepartment.txtdcno.value="";
		return false;
	}
}

function inArray(needle,haystack)
{
	var count=haystack.length;
	for(var i=0;i<count;i++)
	{
		if(haystack[i]===needle){return true;}
	}
	return false;
}

function modetchk1(classval)
{	
	if(document.frmaddDepartment.txtdcno.value=="")
	{
		alert("Please enter DC Number first");
		document.frmaddDepartment.txtpp.selectedIndex=0;
		document.getElementById('selectpartylocation').style.display="none";
		document.getElementById('selectparty').style.display="none";
		document.frmaddDepartment.txtptype.value="";
		//document.frmaddDepartment.rettype.value="";
		document.frmaddDepartment.txtdcno.focus();
		return false;
	}
	else if(document.frmaddDepartment.txtdcno.value.charCodeAt()==32)
	{
		alert("DC Number cannot start with Space");
		document.frmaddDepartment.txtpp.selectedIndex=0;
		document.getElementById('selectpartylocation').style.display="none";
		document.getElementById('selectparty').style.display="none";
		document.frmaddDepartment.txtptype.value="";
		//document.frmaddDepartment.rettype.value="";
		document.frmaddDepartment.txtdcno.focus();
		return false;
	}
	else
	{
		if(classval != "")
		{
			document.getElementById('selectpartylocation').style.display="block";
			document.getElementById('selectparty').style.display="none";
			showUser(classval,'selectpartylocation','partylocation','','','','','');
			document.frmaddDepartment.txtptype.value=classval;
			/*if(classval=="Dealer" || classval=="Bulk" || classval=="Export Buyer")
			document.frmaddDepartment.rettype.value="Sales Return P to C";	
			else if(classval=="Branch" || classval=="C&F")
			document.frmaddDepartment.rettype.value="Stock Transfer P to C";	
			else
			document.frmaddDepartment.rettype.value="";	*/
		}
		else
		{
			document.getElementById('selectpartylocation').style.display="none";
			document.getElementById('selectparty').style.display="none";
			document.frmaddDepartment.txtptype.value=classval;
			//document.frmaddDepartment.rettype.value="";	
		}
	}	
}	

function modetchk2(varval)
{
	showUser(varval,'upschd','upschdc','Standard','','','','','');
}

function locslchk(statesl)
{
	document.frmaddDepartment.locationname.value="";
	//document.getElementById('barcwise').style.display="none";
	//document.getElementById('lotnwise').style.display="none";
	document.getElementById('orderdetails').style.display="none";
	//document.frmaddDepartment.barcode.value="";
	//document.getElementById('lotnwise').innerHTML="";
	for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
	{
		document.frmaddDepartment.allctyp[i].checked=false;
	}
	document.frmaddDepartment.allocationtype.value="";
	showUser(statesl,'locations','location','','','','','','');
}

function stateslchk(valloc)
{
	document.frmaddDepartment.locationname.value="";
	//document.getElementById('barcwise').style.display="none";
	//document.getElementById('lotnwise').style.display="none";
	document.getElementById('orderdetails').style.display="none";
	//document.frmaddDepartment.barcode.value="";
	//document.getElementById('lotnwise').innerHTML="";
	for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
	{
		document.frmaddDepartment.allctyp[i].checked=false;
	}
	document.frmaddDepartment.allocationtype.value="";
	if(document.frmaddDepartment.txtstatesl.value=="")
	{
		alert("Please Select State for Location");
		document.frmaddDepartment.txtlocationsl.selectedIndex=0;
		return false;
	}
	else
	{
		var classval=document.frmaddDepartment.txtptype.value;
		document.getElementById('selectparty').style.display="block";
		showUser(classval,'vitem1','item1',valloc,'','','','');
		document.frmaddDepartment.locationname.value=valloc;
	}
}

function loccontrychk(countryval)
{
	document.frmaddDepartment.locationname.value="";
	//document.getElementById('barcwise').style.display="none";
	//document.getElementById('lotnwise').style.display="none";
	document.getElementById('orderdetails').style.display="none";
	//document.frmaddDepartment.barcode.value="";
	//document.getElementById('lotnwise').innerHTML="";
	for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
	{
		document.frmaddDepartment.allctyp[i].checked=false;
	}
	document.frmaddDepartment.allocationtype.value="";
	if(document.frmaddDepartment.txtpp.value!="")
	{
		var classval=document.frmaddDepartment.txtptype.value;
		document.getElementById('selectparty').style.display="block";
		showUser(classval,'vitem1','item1',countryval,'','','','');
		document.frmaddDepartment.locationname.value=countryval;
		document.frmaddDepartment.txtcountry1.value=countryval;
	}
	else
	{
		alert("Please Select Party Type");
		document.frmaddDepartment.txtcountrysl.selectedIndex=0;
		return false;
	}
}

function onloadfocus()
{
	//document.frmaddDepartment.txtdcno.focus();
}

function showaddr(prid)
{
	//document.getElementById('barcwise').style.display="none";
	//document.getElementById('lotnwise').style.display="none";
	document.getElementById('orderdetails').style.display="block";
	//document.frmaddDepartment.barcode.value="";
	//document.getElementById('lotnwise').innerHTML="";
	for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
	{
		document.frmaddDepartment.allctyp[i].checked=false;
	}
	document.frmaddDepartment.allocationtype.value="";
	showUser(prid,'vaddress','vendor','','','','','');
	//setTimeout(function(){showUser(prid,'ordernos','ordrno','','','','','')},400);
	setTimeout(function(){showUser(prid,'orderdetails','orderdet','','','','','')},400);
}

function showordr(prid)
{
	showUser(prid,'orderdetails','orderdet','','','','','');
}

function chkbarcode1(mltval)
{
	var flg=0;
	//alert(document.frmaddDepartment.binshifting.value);
	if(document.frmaddDepartment.eseltyp.value=="barsel" && (document.frmaddDepartment.binshifting.value=="no" || document.frmaddDepartment.binshifting.value==""))
	{
		alert("Barcode(s) needs to be scanned and Bin shifting needs to be done");
		document.getElementById(txtbarcode).value="";
		document.getElementById(txtbarcode).focus();
		flg=1;
		return false;
	}
	if(document.frmaddDepartment.binshifting.value=="yes")
	{
		/*if(parseInt(document.frmaddDepartment.nslval.value)!=parseInt(document.frmaddDepartment.nbarallval.value))
		{
			alert("Please scan the Barcode(s) for Bin shifting");
			return false;
		}*/
		var sln=document.frmaddDepartment.tsln.value;
		//alert(sln);
		for(var j=1; j<=sln; j++)
		{ 
			var wh="txtwhg"+j;
			var bin="txtbing"+j;
			var nop="bnnomps_"+j;
			var qtr="bnqtys_"+j;
			var txtbarcode="txtbarcod";
			//alert(bin);
			
			if(document.getElementById(bin).value=="")
			{
				alert("Please select Bin for Bin shifting");
				document.getElementById(txtbarcode).value="";
				document.getElementById(bin).focus();
				flg=1;
				return false;
			}
		}	
	}
	
	mltval=mltval.toUpperCase();
	var txtbarcode="txtbarcod";
	document.getElementById(txtbarcode).value=mltval;
	if(mltval.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.getElementById(txtbarcode).value="";
		document.getElementById(txtbarcode).focus();
		flg=1;
		return false;
	}
	else
	{
		var z=mltval.split("");
		var a=z[0];
		var b=z[1];
		if(isChar_o(a)==false)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		if(isChar_o(b)==false)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		for(var i=2; i<z.length; i++)
		{
			if(isChar_o(z[i])==true)
			{
				alert("Invalid Barcode");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
		}
		var pcode=document.frmaddDepartment.plantcodes.value.split(",");
		var ycode=document.frmaddDepartment.yearcodes.value.split(",");
		var x=0
		var y=0;
		//alert(pcode); alert(a);
		/*for(var i=0; i<pcode.length; i++)
		{
			if(pcode[i]==a)
			{
				x++;
			}
		}
		for(var i=0; i<ycode.length; i++)
		{
			if(ycode[i]==b)
			{
				y++;
			}
		}
		if(x==0)
		{
			alert(4);
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		
		if(y==0)
		{
			alert(5);
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}*/
	}
	if(flg==0)
	{
		var bardet=document.frmaddDepartment.txteordno.value;
		var trid=document.frmaddDepartment.maintrid.value;
		var subtrid=document.frmaddDepartment.subtrid.value;
		var ver=document.frmaddDepartment.txtevariety.value;
		var ups=document.frmaddDepartment.txteups.value;
		var mchksel=document.frmaddDepartment.mchksel.value;
		var upstyp=document.frmaddDepartment.txteupstyp.value;
		var txtloqty=document.frmaddDepartment.txtloqty.value;
		var txttobealqty=document.frmaddDepartment.txttobealqty.value;
		//alert(upstyp);
		showUser(bardet,'barchk','barchk2',mltval,trid,ver,ups,mchksel,upstyp,txtloqty,txttobealqty)
		mltval="'"+mltval+"'";
		subtrid="'"+subtrid+"'";
		setTimeout('showpmode2('+mltval+','+subtrid+')', 1000);
		//alert(mltval);
		/*var bardet=document.frmaddDepartment.txtornos.value;
		var trid=document.frmaddDepartment.maintrid.value;
		var ordn=document.frmaddDepartment.txtornos.value;
		var ver=document.frmaddDepartment.txtveridno.value;
		var ups=document.frmaddDepartment.txtupsnos.value;
		var qt=document.frmaddDepartment.txteqty.value;
		var party=document.frmaddDepartment.txtstfp.value;
		var trid=document.frmaddDepartment.maintrid.value;
		var sno=document.frmaddDepartment.mchksel.value;
		var txteupstyp=document.frmaddDepartment.txteupstyp.value;
		var typ="barcodewise";
		//showUser(bardet,'barupdetails','ordrbar',mltval,trid,'','','')
		showUser(party,'barupdetails','ordrbar',sno,ordn,ver,ups,qt,trid,typ,txteupstyp)
		setTimeout(function(){document.frmaddDepartment.barcode.value=""; document.frmaddDepartment.barcode.focus();},400);*/
	}
}


function showpmode2(mltval,subtrid)
{
	var bardet=document.frmaddDepartment.txteordno.value;
	var trid=document.frmaddDepartment.maintrid.value;
	var ver=document.frmaddDepartment.txtevariety.value;
	var ups=document.frmaddDepartment.txteups.value;
	var mchksel=document.frmaddDepartment.mchksel.value;
	var brflg=document.frmaddDepartment.brflg.value;
	var subtrid=document.frmaddDepartment.subtrid.value;
	var upstyp=document.frmaddDepartment.txteupstyp.value;
	var txtloqty=document.frmaddDepartment.txtloqty.value;
	var txttobealqty=document.frmaddDepartment.txttobealqty.value;
	//alert(upstyp);
	if(document.frmaddDepartment.brchflg.value==0)
	{
		showUser(bardet,'barchk','barchk2',mltval,trid,ver,ups,mchksel,upstyp,upstyp,txtloqty,txttobealqty)
	}
	else
	{
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==0)
		{
			pformbarcode();
			setTimeout(function(){showUser(bardet,'barcwise','ordrbar',mltval,trid,ver,ups,mchksel,brflg,'barcodewise',upstyp,subtrid);},800);
			//showUser(party,'altypdetails','ordrbar',sno,ordn,ver,ups,qt,trid,typ,txteupstyp,subtrid)
			document.getElementById('txtbarcod').focus();
			//setTimeout(function(){document.getElementById('txtbarcod').value=""; document.getElementById('txtbarcod').focus();},800);
		}
		else
		{
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==1)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Barcode not present in System");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==2)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Barcode already Dispatched");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==3)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Barcode already Loaded in current OR other Operator's Transaction");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==4)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Variety not matching with Selected Line Item in Consolidated Pending Orders");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==5)
			{
				alert("Barcode cannot be Allocated.\n\nReason: UPS not matching with Selected Line Item in Consolidated Pending Orders");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==6)
			{
				alert("Barcode cannot be Allocated.\n\nReason: This Lot's current QC/GOT Status is FAIL");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==7)
			{
				alert("Barcode cannot be Allocated.\n\nReason: This Lot's current QC/GOT Status is UT and Soft Release is not activated");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==8)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Date of Validity(DoV) of this Lot is Less than or Equal to 1 Month from todays Date");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==9)
			{
				alert("Barcode cannot be Allocated.\n\nReason: This Barcode is already Unpackaged");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==10)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Lot is under Reserve Status");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==11)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Barcode already Allocated");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==12)
			{
				alert("Barcode cannot be Allocated. Reason: 'Allocated Qty' will be more than 'To be Allocated Qty' by Allocating selected Barcode");
			}
		//	pform();
			//showUser(bardet,'barcwise','ordrbar',mltval,trid,ver,ups,mchksel,brflg)
			document.getElementById('txtbarcod').value=""; document.getElementById('txtbarcod').focus();
			setTimeout(function(){document.getElementById('txtbarcod').value=""; document.getElementById('txtbarcod').focus();},400);
		}
	}
}

function pformbarcode()
{	
	var fl=0;	
	if(document.frmaddDepartment.txtpp.value=="")
	{
		alert("Please select Party Type");
		document.frmaddDepartment.txtpp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please select Party Name");
		document.frmaddDepartment.txtstfp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.allocationtype.value=="")
	{
		alert("Please select Allocation Type");
		fl=1;
		return false;
	}
	
	/*
	var sn=document.frmaddDepartment.sn.value;
	for (var i=1; i<sn; i++)
	{
		var sls="selsh_"+i;
		//alert(document.frmaddDepartment.mchksel.value); alert(i);
		//if(document.frmaddDepartment.mchksel.value!="" && document.frmaddDepartment.mchksel.value==i)
		if(document.getElementById(sls).checked==true)
		{
			//alert(document.frmaddDepartment.txtolotno.value);
			if(document.frmaddDepartment.txtolotno.value=="")
			{
				alert("Please select Lot No.");
				//document.frmaddDepartment.txtbrowse.focus();
				fl=1;
				return false;
			}
			var bnop="bnop_"+i;
			
			var sno1=document.frmaddDepartment.sno1.value;
			//alert(sno1); 
			if(sno1!="")
			{
				for (var k=1; k<sno1; k++)
				{
					var inpt="lotsel_"+k;
					var inptyp="inptyp_"+k;
					//alert(document.frmaddDepartment.mchksel.value); 
					//alert(document.getElementById(inptyp).value);
					//if(document.frmaddDepartment.mchksel.value!="" && document.frmaddDepartment.mchksel.value==i)
					if(document.getElementById(inpt).checked==true)
					{ 
						if(document.getElementById(inptyp).value=="lotsel")
						{
							var val=document.frmaddDepartment.srno2.value;
							//alert(val); 
							if(val!="")
							{	
								var v_1=0;
								var qtyd=0;
								var qtyo=0;
								var qtyb=0;
								var nop=0;
								var nomp=0;
								for(var j=1; j<=val; j++)
								{ 
									var dc="recnobp"+j;
									var rem="recqtyp"+j;
									var bal="txtbalqtyp"+j;
									var nop="txtbalnobp"+j;
									nop=parseInt(nop)+parseInt(document.getElementById(dc).value);
									nomp=parseInt(rem)+parseInt(document.getElementById(rem).value);
									if(document.getElementById(rem).value=="")
									{
										v_1++;
									}
										var q=document.getElementById(dc).value;
										var rq=document.getElementById(rem).value;
										var bq=document.getElementById(bal).value;
										
										if(rq=="")rq=0;
										
										var qtyd=parseFloat(qtyd)+parseFloat(rq);
										var qtyb=parseFloat(qtyb)+parseFloat(bq);
								}
								if(nop==0 && nomp==0)
								{
									alert("Please Enter NoMP/Qty to Allocate");
									f=1;
									return false;
								}
								if(v_1>=val)
								{
									alert("Please Enter NoMP/Qty to Allocate");
									f=1;
									return false;
								}	
								//alert(parseFloat(qtyd));
								//alert(parseFloat(document.getElementById(bnop).value));				
								if(parseFloat(qtyd) > parseFloat(document.getElementById(bnop).value))
								{
									alert("Please check. Total Quantity to be Allocated not matching with Total Balance Quantity in Order(s)");
									f=1;
									return false;
								}	
							}
						}
					}	
				}	
			}
		}
	}*/
	/*if(document.frmaddDepartment.eseltyp.value=="barsel" && (document.frmaddDepartment.binshifting.value=="no" || document.frmaddDepartment.binshifting.value==""))
	{
		alert("Barcode(s) needs to be scanned and Bin shifting needs to be done");
		return false;
	}*/
	/*if(document.frmaddDepartment.binshifting.value=="yes")
	{
		if(parseInt(document.frmaddDepartment.nslval.value)!=parseInt(document.frmaddDepartment.nbarallval.value))
		{
			alert("Please scan the Barcode(s) for Bin shifting");
			return false;
		}
		var sln=document.frmaddDepartment.sln.value;
		for(var j=1; j<sln; j++)
		{ 
			var wh="txtwhg"+j;
			var bin="txtbing"+j;
			var nop="bnnomps_"+j;
			var qtr="bnqtys_"+j;
			
			if(document.getElementById(bin).value="")
			{
				alert("Please select Bin for Bin shifting");
				return false;
			}
		}	
	}*/
	//alert(fl);
	
	if(fl==1)
	{
		return false;
	}
	else
	{
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		showUser(a,'postingtable','mformbarcode','','','','','');
		document.getElementById('txtbarcod').value=""; 
		document.getElementById('txtbarcod').focus();
	}  
}

function alloctype(typ)
{
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please Select Party First");
		//document.getElementById('barcwise').style.display="none";
		//document.getElementById('lotnwise').style.display="none";
		//document.frmaddDepartment.barcode.value="";
		//document.getElementById('lotnwise').innerHTML="";
		for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
		{
			document.frmaddDepartment.allctyp[i].checked=false;
		}
		return false;
	}
	else if(document.frmaddDepartment.mchksel.value=="")
	{
		alert("Please Select Line Item in Pending Order(s) IN Progress");
		//document.getElementById('barcwise').style.display="none";
		//document.getElementById('lotnwise').style.display="none";
		//document.frmaddDepartment.barcode.value="";
		//document.getElementById('lotnwise').innerHTML="";
		for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
		{
			document.frmaddDepartment.allctyp[i].checked=false;
		}
		return false;
	}
	else
	{
		if(typ=="lotwise")
		{
			//document.getElementById('barcwise').style.display="block";
			//document.getElementById('lotnwise').style.display="block";
			//document.frmaddDepartment.barcode.value="";
			//document.getElementById('altypdetails').innerHTML="";
			document.frmaddDepartment.allocationtype.value=typ;
			var ordn=document.frmaddDepartment.txtornos.value;
			var ver=document.frmaddDepartment.txtveridno.value;
			var ups=document.frmaddDepartment.txtupsnos.value;
			var qt=document.frmaddDepartment.txteqty.value;
			var party=document.frmaddDepartment.txtstfp.value;
			var trid=document.frmaddDepartment.maintrid.value;
			var subtrid=document.frmaddDepartment.subtrid.value;
			var sno=document.frmaddDepartment.mchksel.value;
			var txteupstyp=document.frmaddDepartment.txteupstyp.value;
			document.frmaddDepartment.eseltyp.value="lotsel";
			//alert(trid); alert(subtrid);
			showUser(party,'altypdetails','ordrbar',sno,ordn,ver,ups,qt,trid,typ,txteupstyp,subtrid)
		}
		else if(typ=="barcodewise")
		{
			//document.getElementById('barcwise').style.display="block";
			//document.getElementById('lotnwise').style.display="none";
			//document.frmaddDepartment.barcode.value="";
			//document.getElementById('altypdetails').innerHTML="";
			document.frmaddDepartment.allocationtype.value=typ;
			var ordn=document.frmaddDepartment.txtornos.value;
			var ver=document.frmaddDepartment.txtveridno.value;
			var ups=document.frmaddDepartment.txtupsnos.value;
			var qt=document.frmaddDepartment.txteqty.value;
			var party=document.frmaddDepartment.txtstfp.value;
			var trid=document.frmaddDepartment.maintrid.value;
			var subtrid=document.frmaddDepartment.subtrid.value;
			var sno=document.frmaddDepartment.mchksel.value;
			var txteupstyp=document.frmaddDepartment.txteupstyp.value;
			document.frmaddDepartment.eseltyp.value="barsel";
			//alert(trid); alert(subtrid);
			showUser(party,'altypdetails','ordrbar',sno,ordn,ver,ups,qt,trid,typ,txteupstyp,subtrid)
			//showUser(party,'barupdetails','ordrbar',sno,ordn,ver,ups,qt,trid,typ)
		}
		else
		{
			//document.getElementById('barcwise').style.display="none";
			//document.getElementById('lotnwise').style.display="none";
			//document.frmaddDepartment.barcode.value="";
			//document.getElementById('altypdetails').innerHTML="";
			document.frmaddDepartment.allocationtype.value="";
		}
	}
}

function edtunalloctype(typ)
{
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please Select Party First");
		document.getElementById('edtfrunalctyp').style.display="none";
		document.getElementById('edtfralctyp').style.display="none";
		//document.frmaddDepartment.barcode.value="";
		//document.getElementById('lotnwise').innerHTML="";
		for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
		{
			document.frmaddDepartment.allctyp[i].checked=false;
		}
		return false;
	}
	else if(document.frmaddDepartment.mchksel.value=="")
	{
		alert("Please Select Line Item in Pending Order(s) IN Progress");
		document.getElementById('edtfrunalctyp').style.display="none";
		document.getElementById('edtfralctyp').style.display="none";
		//document.frmaddDepartment.barcode.value="";
		//document.getElementById('lotnwise').innerHTML="";
		for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
		{
			document.frmaddDepartment.allctyp[i].checked=false;
		}
		return false;
	}
	else
	{
		if(typ=="edtfralcwise")
		{
			document.getElementById('edtfrunalctyp').style.display="none";
			document.getElementById('edtfralctyp').style.display="block";
			document.frmaddDepartment.edtunallocationtype.value=typ;
			document.frmaddDepartment.edtunseltyp.value="edtfralcwise";
		}
		else if(typ=="edtunalcwise")
		{
			document.getElementById('edtfrunalctyp').style.display="block";
			document.getElementById('edtfralctyp').style.display="none";
			document.frmaddDepartment.edtunallocationtype.value=typ;
			document.frmaddDepartment.edtunseltyp.value="edtunalcwise";
		}
		else
		{
			document.getElementById('edtfrunalctyp').style.display="none";
			document.getElementById('edtfralctyp').style.display="none";
			document.frmaddDepartment.edtunallocationtype.value="";
			document.frmaddDepartment.edtunseltyp.value="";
		}
	}
}

function unalloctype(typ)
{
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please Select Party First");
		for(var i=0; i<document.frmaddDepartment.unallctyp.length; i++)
		{
			document.frmaddDepartment.unallctyp[i].checked=false;
		}
		return false;
	}
	else if(document.frmaddDepartment.mchksel.value=="")
	{
		alert("Please Select Line Item in Pending Order(s) IN Progress");
		for(var i=0; i<document.frmaddDepartment.unallctyp.length; i++)
		{
			document.frmaddDepartment.unallctyp[i].checked=false;
		}
		return false;
	}
	else
	{
		if(typ=="unlotwise")
		{
			document.frmaddDepartment.unallocationtype.value=typ;
			var ordn=document.frmaddDepartment.txtornos.value;
			var ver=document.frmaddDepartment.txtveridno.value;
			var ups=document.frmaddDepartment.txtupsnos.value;
			var qt=document.frmaddDepartment.txteqty.value;
			var party=document.frmaddDepartment.txtstfp.value;
			var trid=document.frmaddDepartment.maintrid.value;
			var subtrid=document.frmaddDepartment.subtrid.value;
			var sno=document.frmaddDepartment.mchksel.value;
			var txteupstyp=document.frmaddDepartment.txteupstyp.value;
			document.frmaddDepartment.eseltyp.value="lotsel";
			//alert(trid); alert(subtrid);
			showUser(party,'altypdetails','unalordrbar',sno,ordn,ver,ups,qt,trid,typ,txteupstyp,subtrid)
		}
		else if(typ=="unbarcodewise")
		{
			document.frmaddDepartment.unallocationtype.value=typ;
			var ordn=document.frmaddDepartment.txtornos.value;
			var ver=document.frmaddDepartment.txtveridno.value;
			var ups=document.frmaddDepartment.txtupsnos.value;
			var qt=document.frmaddDepartment.txteqty.value;
			var party=document.frmaddDepartment.txtstfp.value;
			var trid=document.frmaddDepartment.maintrid.value;
			var subtrid=document.frmaddDepartment.subtrid.value;
			var sno=document.frmaddDepartment.mchksel.value;
			var txteupstyp=document.frmaddDepartment.txteupstyp.value;
			document.frmaddDepartment.eseltyp.value="barsel";
			//alert(trid); alert(subtrid);
			showUser(party,'altypdetails','unalordrbar',sno,ordn,ver,ups,qt,trid,typ,txteupstyp,subtrid)
			//showUser(party,'barupdetails','ordrbar',sno,ordn,ver,ups,qt,trid,typ)
		}
		else
		{
			document.frmaddDepartment.unallocationtype.value="";
		}
	}
}

function fralloctype(typ)
{
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please Select Party First");
		for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
		{
			document.frmaddDepartment.allctyp[i].checked=false;
		}
		return false;
	}
	else if(document.frmaddDepartment.mchksel.value=="")
	{
		alert("Please Select Line Item in Pending Order(s) IN Progress");
		for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
		{
			document.frmaddDepartment.allctyp[i].checked=false;
		}
		return false;
	}
	else
	{
		if(typ=="lotwise")
		{
			document.frmaddDepartment.allocationtype.value=typ;
			var ordn=document.frmaddDepartment.txtornos.value;
			var ver=document.frmaddDepartment.txtveridno.value;
			var ups=document.frmaddDepartment.txtupsnos.value;
			var qt=document.frmaddDepartment.txteqty.value;
			var party=document.frmaddDepartment.txtstfp.value;
			var trid=document.frmaddDepartment.maintrid.value;
			var subtrid=document.frmaddDepartment.subtrid.value;
			var sno=document.frmaddDepartment.mchksel.value;
			var txteupstyp=document.frmaddDepartment.txteupstyp.value;
			document.frmaddDepartment.eseltyp.value="lotsel";
			//alert(trid); alert(subtrid);
			showUser(party,'altypdetails','fralordrbar',sno,ordn,ver,ups,qt,trid,typ,txteupstyp,subtrid)
		}
		else if(typ=="barcodewise")
		{
			document.frmaddDepartment.allocationtype.value=typ;
			var ordn=document.frmaddDepartment.txtornos.value;
			var ver=document.frmaddDepartment.txtveridno.value;
			var ups=document.frmaddDepartment.txtupsnos.value;
			var qt=document.frmaddDepartment.txteqty.value;
			var party=document.frmaddDepartment.txtstfp.value;
			var trid=document.frmaddDepartment.maintrid.value;
			var subtrid=document.frmaddDepartment.subtrid.value;
			var sno=document.frmaddDepartment.mchksel.value;
			var txteupstyp=document.frmaddDepartment.txteupstyp.value;
			document.frmaddDepartment.eseltyp.value="barsel";
			//alert(trid); alert(subtrid);
			showUser(party,'altypdetails','fralordrbar',sno,ordn,ver,ups,qt,trid,typ,txteupstyp,subtrid)
			//showUser(party,'barupdetails','ordrbar',sno,ordn,ver,ups,qt,trid,typ)
		}
		else
		{
			document.frmaddDepartment.allocationtype.value="";
		}
	}
}

function selitm(sno,ver,ups,qt,ordn,upstyp)
{
	//alert(sno);
	document.frmaddDepartment.txtornos.value=ordn;
	document.frmaddDepartment.txtveridno.value=ver;
	document.frmaddDepartment.txtupsnos.value=ups;
	document.frmaddDepartment.txteqty.value=qt;
	var party=document.frmaddDepartment.txtstfp.value;
	var trid=document.frmaddDepartment.maintrid.value;
	showUser(party,'orderdetails','showordsel',sno,ordn,ver,ups,qt,trid,upstyp)
	//document.frmaddDepartment.barcode.focus();
}

function nompchk1(Bagsval1, val)
{
	var z1="txtdisp_"+val;
	var z2="txtrecbagp_"+val;
	var z3="txtdbagp_"+val;
		
	var q1="txtqty_"+val;
	var q2="recqtyp_"+val;
	var q3="txtdqtyp_"+val;
		
	var m1="txtallnomp_"+val;
	var m2="txtrecnomp_"+val;
	var m3="txtdnomp_"+val;
		
	var wtinmp="wtinmp_"+val;
	var pcktyp="upspacktype_"+val;
	
	var qty=0.000;
	var packtp=document.getElementById(pcktyp).value.split(" ");
			
	if(packtp[1]=="Gms")
	{ 
		var ptp=(parseFloat(packtp[0])/1000);
	}
	else
	{
		var ptp=parseFloat(packtp[0]);
	}
	
	if(Bagsval1!="" && Bagsval1 > 0)
	{	
		if(parseInt(document.getElementById(m2).value)>parseInt(document.getElementById(m1).value))
		{
			alert( "NoMP can be either equal or less than Actual NoMP");
			document.getElementById(m2).value="";
			document.getElementById(m3).value="";
			document.getElementById(m2).focus();
			return false;
		}
		else
		{
			if(document.getElementById(z2).value!="" && document.getElementById(z2).value>0)
			{
				qty=((parseFloat(document.getElementById(m2).value))*(parseFloat(document.getElementById(wtinmp).value)))+((parseFloat(document.getElementById(z2).value))*(parseFloat(ptp)));
			}
			else
			{
				qty=(parseFloat(document.getElementById(m2).value)*parseFloat(document.getElementById(wtinmp).value));
			}
			
			document.getElementById(m3).value=parseInt(document.getElementById(m1).value)-parseInt(document.getElementById(m2).value);
			document.getElementById(z3).value=parseInt(document.getElementById(z1).value)-parseInt(document.getElementById(z2).value);
			document.getElementById(q2).value=parseFloat(qty);
			document.getElementById(q3).value=parseFloat(document.getElementById(q1).value)-parseFloat(qty);
			document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
			//if(document.getElementById(z1).value<0)document.getElementById(z1).value=0;
		}
	}
	else
	{
		if(document.getElementById(z2).value!="" && document.getElementById(z2).value>0)
		{
			qty=(parseFloat(document.getElementById(z2).value)*parseFloat(ptp));
			document.getElementById(q2).value=parseFloat(qty);
			document.getElementById(q3).value=parseFloat(qty);
			document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
		}
	}
}

function nompchk()
{
	var txtornomp=document.frmaddDepartment.txtornomp.value;
	var txtallnomp=document.frmaddDepartment.txtallnomp.value;
	var txtlonomp=document.frmaddDepartment.txtlonomp.value;
	var txttlonomp=document.frmaddDepartment.txttlonomp.value;
	var txtorblnomp=document.frmaddDepartment.txtorblnomp.value;
	if(parseInt(document.frmaddDepartment.txtallnomp.value) > parseInt(document.frmaddDepartment.txtornomp.value))
	{
		alert("NoMP Allocated cannot be more than Ordered NoMP");
		document.frmaddDepartment.txtallnomp.value="";
		document.frmaddDepartment.txtlonomp.value="";
		document.frmaddDepartment.txttlonomp.value="";
		document.frmaddDepartment.txtorblnomp.value="";
		return false;
	}
	else
	{	
		document.frmaddDepartment.txttlonomp.value=parseInt(document.frmaddDepartment.txtornomp.value)-parseInt(document.frmaddDepartment.txtallnomp.value);
		var qty=(parseFloat(document.frmaddDepartment.txtallnomp.value)*parseFloat(document.frmaddDepartment.ewtmp.value));
		document.frmaddDepartment.txtlonomp.value=parseFloat(qty);
		document.frmaddDepartment.txtorblnomp.value=parseFloat(document.frmaddDepartment.txteoqty.value)-parseFloat(qty);
	}
}

function nompchk2()
{
	var txtornomp=document.frmaddDepartment.txtornomp.value;
	var txtallnomp=document.frmaddDepartment.txtallnomp.value;
	var txtlonomp=document.frmaddDepartment.txtlonomp.value;
	var txttlonomp=document.frmaddDepartment.txttlonomp.value;
	var txtorblnomp=document.frmaddDepartment.txtorblnomp.value;
	
	if(parseFloat(document.frmaddDepartment.txtlonomp.value) > parseFloat(document.frmaddDepartment.txteqty.value))
	{
		alert("Qty Allocated cannot be more than Ordered Qty");
		document.frmaddDepartment.txtallnomp.value="";
		document.frmaddDepartment.txtlonomp.value="";
		document.frmaddDepartment.txttlonomp.value="";
		document.frmaddDepartment.txtorblnomp.value="";
		return false;
	}
	else
	{	
		if(document.frmaddDepartment.txteupstyp.value=="ST")
		{
			var	qty=(parseFloat(document.frmaddDepartment.txtlonomp.value)/parseFloat(document.frmaddDepartment.ewtmp.value));
			qty=parseFloat(qty).toFixed(3);
			var packtp=qty.split(" ");
			if(packtp[1]!="000")
			{
				alert("Qty Allocated cannot be more than Ordered Qty");
				document.frmaddDepartment.txtallnomp.value="";
				document.frmaddDepartment.txtlonomp.value="";
				document.frmaddDepartment.txttlonomp.value="";
				document.frmaddDepartment.txtorblnomp.value="";
				return false;
			}
			else
			{
				document.frmaddDepartment.txtallnomp.value=parseFloat(qty);
				document.frmaddDepartment.txtorblnomp.value=parseFloat(document.frmaddDepartment.txteqty.value)-parseFloat(document.frmaddDepartment.txtlonomp.value);
				document.frmaddDepartment.txttlonomp.value=parseInt(document.frmaddDepartment.txtallnomp.value)-parseInt(document.frmaddDepartment.txtlonomp.value);
			}
		}
		else
		{
			document.frmaddDepartment.txtorblnomp.value=parseFloat(document.frmaddDepartment.txteqty.value)-parseFloat(document.frmaddDepartment.txtlonomp.value);
		}
	}
}

function bform()
{ //alert(document.frmaddDepartment.subtrid.value);
	if(document.frmaddDepartment.subtrid.value=="" || document.frmaddDepartment.subtrid.value==0)
	{
		alert("You have not posted any record for selected Crop/Variety");
		return false;
	}
	else if(parseFloat(document.frmaddDepartment.txttobealqty.value)!=parseFloat(document.frmaddDepartment.txtloqty.value))
	{
		alert("ALERT\n\n'Allocated Qty' of selected item is not equal with 'To be Allocated Qty'.\n Until that matches you will not be allowed to proceed with selection of next item.");
		return false;
	}
	else
	{
		var trid=document.frmaddDepartment.maintrid.value;
		var subtrid=document.frmaddDepartment.subtrid.value;
		var subsubtrid=document.frmaddDepartment.subsubtrid.value
		var enoordno='';
		var eordno='';
		var txtallonolp=document.frmaddDepartment.txtallonolp.value;
		var txtallnomp=document.frmaddDepartment.txtallnomp.value;
		var txttobealqty=document.frmaddDepartment.txttobealqty.value;
		
		//alert(trid);alert(subtrid);alert(subsubtrid);
		showUser(subtrid,'postingtable','mbform',trid,subsubtrid,enoordno,eordno,txtallonolp,txtallnomp,txttobealqty);
	}
}

function bform2()
{
	/*if(document.frmaddDepartment.subtrid.value=="" || document.frmaddDepartment.subtrid.value==0)
	{
		alert("You have not posted any record for selected Crop/Variety");
		return false;
	}
	else*/ if(parseFloat(document.frmaddDepartment.txttobealqty.value)!=parseFloat(document.frmaddDepartment.txtloqty.value))
	{
		alert("ALERT\n\n'Allocated Qty' of selected item is not equal with 'To be Allocated Qty'.\n Until that matches you will not be allowed to proceed with selection of next item.");
		return false;
	}
	else
	{
		var trid=document.frmaddDepartment.maintrid.value;
		var subtrid=document.frmaddDepartment.subtrid.value;
		var subsubtrid=document.frmaddDepartment.subsubtrid.value
		var enoordno='';
		var eordno='';
		var txtallonolp=document.frmaddDepartment.txtallonolp.value;
		var txtallnomp=document.frmaddDepartment.txtallnomp.value;
		var txttobealqty=document.frmaddDepartment.txttobealqty.value;
		
		//alert(trid);alert(subtrid);alert(subsubtrid);
		showUser(subtrid,'postingtable','mbform',trid,subsubtrid,enoordno,eordno,txtallonolp,txtallnomp,txttobealqty);
	}
}

function barfocus()
{
	if(document.getElementById('txtbarcod').value=="done" || document.getElementById('txtbarcod').value=="")
	{
		document.getElementById('txtbarcod').focus(); 
		document.getElementById('txtbarcod').scrollIntoView();
		document.getElementById('txtbarcod').value="";
	}
}

function editrecsub(lotn, edtrecid, trid, ups, variety)
{
	//alert(lotn);alert(edtrecid);alert(trid);alert(ups);alert(variety);
	showUser(lotn,'postingsubsubtable','subformedt',edtrecid,trid,ups,variety,'');
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

function editrecmain(edtrecid, trid, sn)
{
	//var txtallnomp=document.frmaddDepartment.txtallnomp.value;
	//alert(edtrecid);alert(trid);alert(sn);
	showUser(edtrecid,'postingtable','mainformedt',trid,sn,'','','');
}

function backupform()
{
	//alert(document.frmaddDepartment.allocationtype.value);
	if(document.frmaddDepartment.allocationtype.value!="")
	{
		if(document.frmaddDepartment.allocationtype.value=="lotwise")
		{
			//document.getElementById('lotnwise').style.display="none";
			document.getElementById('searchresult').innerHTML="";
		}
		else if(document.frmaddDepartment.allocationtype.value=="barcodewise")
		{
			document.getElementById('barcwise').style.display="none";
			document.frmaddDepartment.barcode.value="";
		}
		else
		{
		
		}
	}
	for(var i=0; i<document.frmaddDepartment.allctyp.length; i++)
	{
		document.frmaddDepartment.allctyp[i].checked=false;
	}
	document.frmaddDepartment.allocationtype.value="";
	var prid=document.frmaddDepartment.txtstfp.value;
	var trid=document.frmaddDepartment.maintrid.value;
	var subtrid=document.frmaddDepartment.subtrid.value;
	var subsubtrid=document.frmaddDepartment.subsubtrid.value
	var txtallnomp=document.frmaddDepartment.txtallnomp.value;
	
	if(trid>0)
		showUser(subtrid,'postingtable','mbform2',trid,subsubtrid,prid,'','');
	else
		showUser(prid,'orderdetails','orderdet','','','','','');
}

function showpmode(mltval)
{
	var bardet=document.frmaddDepartment.txteordno.value;
	var trid=document.frmaddDepartment.maintrid.value;
	var ver=document.frmaddDepartment.txtevariety.value;
	var ups=document.frmaddDepartment.txteups.value;
	var mchksel=document.frmaddDepartment.mchksel.value;
	var brflg=document.frmaddDepartment.brflg.value;
	if(document.frmaddDepartment.brchflg.value==0)
	{
		showUser(bardet,'barchk','barchk1',mltval,trid,ver,ups,mchksel)
	}
	else
	{
		if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==0)
		{
			//pform();
			//showUser(bardet,'bardetails','ordrbar',mltval,trid,ver,ups,mchksel,brflg)
			//setTimeout(function(){document.frmaddDepartment.barcode.value=""; document.frmaddDepartment.barcode.focus();},400);
		}
		else
		{
			/*if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==1)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Barcode not present in System");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==2)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Barcode already Dispatched");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==3)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Barcode already Loaded in current OR other Operator's Transaction");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==4)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Variety not matching with Selected Line Item in Consolidated Pending Orders");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==5)
			{
				alert("Barcode cannot be Allocated.\n\nReason: UPS not matching with Selected Line Item in Consolidated Pending Orders");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==6)
			{
				alert("Barcode cannot be Allocated.\n\nReason: This Lot's current QC/GOT Status is FAIL");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==7)
			{
				alert("Barcode cannot be Allocated.\n\nReason: This Lot's current QC/GOT Status is UT and Soft Release is not activated");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==8)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Date of Validity(DoV) of this Lot is Less than or Equal to 1 Month from todays Date");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==9)
			{
				alert("Barcode cannot be Allocated.\n\nReason: This Barcode is already Unpackaged");
			}
			if(document.frmaddDepartment.brflg.value!="" && document.frmaddDepartment.brflg.value==10)
			{
				alert("Barcode cannot be Allocated.\n\nReason: Lot is under Reserve Status");
			}*/
			
		//	pform();
			//showUser(bardet,'bardetails','ordrbar',mltval,trid,ver,ups,mchksel,brflg)
			//setTimeout(function(){document.frmaddDepartment.barcode.value=""; document.frmaddDepartment.barcode.focus();},400);
		}
	}
}

function showmbarcodes(barcodes)
{
	if(barcodes!="")
	{
		winHandle=window.open('getuser_mbarstatus.php?tp='+barcodes,'WelCome','top=170,left=180,width=750,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}

function showmlots1(barcodes)
{
	if(barcodes!="")
	{
		winHandle=window.open('getuser_lotqty.php?tp='+barcodes,'WelCome','top=170,left=180,width=800,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}

function showbarcodes(barcodes)
{
	if(barcodes!="")
	{
		winHandle=window.open('getuser_barstatus.php?tp='+barcodes,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
}

function searchlotname(searchval)
{
	var txttblwhg1=document.frmaddDepartment.txttblwhg1.value;
	var bsearch=document.frmaddDepartment.bsearch.value;
	var typ=document.frmaddDepartment.allocationtype.value;
	var ordn=document.frmaddDepartment.txtornos.value;
	var ver=document.frmaddDepartment.txtveridno.value;
	var ups=document.frmaddDepartment.txtupsnos.value;
	var qt=document.frmaddDepartment.txteqty.value;
	var party=document.frmaddDepartment.txtstfp.value;
	var trid=document.frmaddDepartment.maintrid.value;
	var sno=document.frmaddDepartment.mchksel.value;
	var sn=document.frmaddDepartment.sn.value;
	var subtrid=document.frmaddDepartment.subtrid.value;
	var subsubtrid=document.frmaddDepartment.subsubtrid.value;
	searchUser(searchval,"searchresult","lotserch",txttblwhg1,bsearch,party,sno,ordn,ver,ups,qt,trid,typ,subtrid,subsubtrid,sn);
}

function searchbinname(searchval)
{
	if(document.frmaddDepartment.txttblwhg1.value=="")
	{
		alert("Please Select Warehouse first.");
		document.frmaddDepartment.bsearch.value="";
		return false;
	}
	else
	{
		var txttblwhg1=document.frmaddDepartment.txttblwhg1.value;
		var bsearch=document.frmaddDepartment.lsearch.value;
		var typ=document.frmaddDepartment.allocationtype.value;
		var ordn=document.frmaddDepartment.txtornos.value;
		var ver=document.frmaddDepartment.txtveridno.value;
		var ups=document.frmaddDepartment.txtupsnos.value;
		var qt=document.frmaddDepartment.txteqty.value;
		var party=document.frmaddDepartment.txtstfp.value;
		var trid=document.frmaddDepartment.maintrid.value;
		var sno=document.frmaddDepartment.mchksel.value;
		var sn=document.frmaddDepartment.sn.value;
		var subtrid=document.frmaddDepartment.subtrid.value;
		var subsubtrid=document.frmaddDepartment.subsubtrid.value;
		searchUser(searchval,"searchresult","binserch",txttblwhg1,bsearch,party,sno,ordn,ver,ups,qt,trid,typ,subtrid,subsubtrid,sn);
	}
}

function sellot(val1,sno1,val2,val3,sn,val4,upsval,tidval,typ,mpwt)
{
	/*var bnop="bnop_"+sn;
	var selsh="selsh_"+sn;
	if(document.getElementById(bnop).value==0)
	{
		alert("Balance Qty to be Allocated is ZERO.");
		//document.getElementById(selsh).checked=false;
		return false;
	}
	else*/
	{
		if(document.frmaddDepartment.txteupstyp.value=="NST")
		{
			document.frmaddDepartment.ewtmp.value=mpwt;
		}
		document.frmaddDepartment.ltchksel.value=sno1;
		var trid=document.frmaddDepartment.maintrid.value;
		var subtrid=document.frmaddDepartment.subtrid.value;
		var subsubtrid=document.frmaddDepartment.subsubtrid.value;
		//if(sid!=subsubtrid)subsubtrid=sid;
		showUser(val1,'postingsubsubtable','lotshow',sno1,tidval,val2,val3,sn,subtrid,subsubtrid,val4,upsval,typ);
	}
}

function selnslsts(stsval)
{
	//alert(stsval);
	//document.getElementById('shownsloc').style.display="";
	var qt=0;
	var bcval=0;
	document.frmaddDepartment.binshifting.value=stsval;
	document.frmaddDepartment.bcvalues.value="";
	//alert(document.frmaddDepartment.srno2.value);
	for(var i=1; i<=document.frmaddDepartment.srno2.value; i++)
	{
		var txtbalqtyp="txtbalqtyp"+i;
		var recqtyp="recqtyp"+i;
		var recnobp="recnobp"+i;
		//alert(document.getElementById(recnobp).value);
		//alert(document.getElementById(recqtyp).value);
		if(document.getElementById(recqtyp).value!="" && document.getElementById(recqtyp).value > 0)
		{
			if(document.getElementById(recnobp).value!="" && document.getElementById(recnobp).value > 0)
			{
				qt++;
				bcval=parseInt(bcval)+parseInt(document.getElementById(recnobp).value);
			}
		}
	}
	if(document.frmaddDepartment.eseltyp.value=="barsel"){bcval=1; qt=1;}
	document.frmaddDepartment.nslval.value=parseInt(bcval);
		
	if(stsval=="yes")
	{
		if(qt > 0)
		{
			if(bcval > 0)
			{
			/*if(document.getElementById('shownsloc').style.display=="none")
			{
				//alert('block');
				document.getElementById('shownsloc').style.display="block";
				//alert(document.getElementById('shownsloc').innerHTML);
			} 
			else 
			{
				//alert('none');
				document.getElementById('shownsloc').style.display="block";
				//alert('block');
			}*/
			document.getElementById('shownsloc').style.display='block';
			//alert(qt);
			if(qt > 0)
			{	
				if(bcval>0)
				document.getElementById('barcupload').innerHTML="<a href=Javascript:void(0); onclick=getbarc()>Scan Barcode(s)</a>";
			
			}
			else
			{	
				document.getElementById('barcupload').innerHTML="";
			}
			}
			else
			{
				alert("NoMP not present with selected Lot.");
				for(var i=1; i<document.frmaddDepartment.binshift.length; i++)
				{
					document.frmaddDepartment.binshift[i].checked=true;
				}
				stsval='no';
				document.getElementById('shownsloc').style.display="none";
				document.getElementById('barcupload').innerHTML="";
				if(document.frmaddDepartment.nslval.value==0)
				{
					document.getElementById('shownsloc').style.display="none";
					document.getElementById('barcupload').innerHTML="";
				}
			}
		}
		else
		{
			alert("NoMP not present with selected Lot.");
			for(var i=1; i<document.frmaddDepartment.binshift.length; i++)
			{
				document.frmaddDepartment.binshift[i].checked=true;
			}
			stsval='no';
			document.getElementById('shownsloc').style.display="none";
			document.getElementById('barcupload').innerHTML="";
			if(document.frmaddDepartment.nslval.value==0)
			{
				document.getElementById('shownsloc').style.display="none";
				document.getElementById('barcupload').innerHTML="";
			}
		}	
	}
	else
	{
		for(var i=1; i<document.frmaddDepartment.binshift.length; i++)
		{
			document.frmaddDepartment.binshift[i].checked=true;
		}
		stsval='no';
		document.getElementById('shownsloc').style.display="none";
		document.getElementById('barcupload').innerHTML="";
		if(document.frmaddDepartment.nslval.value==0)
		{
			document.getElementById('shownsloc').style.display="none";
			document.getElementById('barcupload').innerHTML="";
		}
	}
	document.frmaddDepartment.binshifting.value=stsval;
}

function getbarc()
{
	var qt=0;
	var bcval=0;
	document.frmaddDepartment.bcvalues.value="";
	for(var i=1; i<=document.frmaddDepartment.srno2.value; i++)
	{
		var txtbalqtyp="txtbalqtyp"+i;
		var recqtyp="recqtyp"+i;
		var recnobp="recnobp"+i;
		if(document.getElementById(recqtyp).value!="" && document.getElementById(recqtyp).value > 0)
		{
			if(document.getElementById(recnobp).value!="" && document.getElementById(recnobp).value > 0)
			{
				qt++;
				bcval=parseInt(bcval)+parseInt(document.getElementById(recnobp).value);
			}
		}
	}
	if(document.frmaddDepartment.eseltyp.value=="barsel"){bcval=1; qt=1;}
	if(qt > 0 && bcval > 0)
	{
		//alert(bcval);
		var txtolotno=document.frmaddDepartment.txtolotno.value;
		if(document.frmaddDepartment.eseltyp.value=="barsel")
		{txtolotno=txtolotno.replace(/<br ?\/?>/g,",");}
		
		var maintrid=document.frmaddDepartment.maintrid.value;
		var txtnups=document.frmaddDepartment.txtnups.value;
		winHandle=window.open('getuser_prtbaradd.php?tp='+bcval+'&ltno='+txtolotno+'&dtrid='+maintrid+'&eups='+txtnups,'WelCome','top=170,left=180,width=750,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
	else
	{
		return false;
	}	
}

function wh(wh1val, whno)
{ 
	var bingn="bingn"+whno;
	showUser(wh1val,bingn,'wh',bingn,whno,'','','');
}

function bin(bin1val, binno)
{
	var qt=0.000;
	var bcval=0;
	var txtwhg="txtwhg"+binno;
	if(document.getElementById(txtwhg).value=="")
	{
		alert("Please select Warehouse");
		return false;
	}
	else
	{
		if(document.frmaddDepartment.eseltyp.value!="")
		{
			if(document.frmaddDepartment.eseltyp.value=="barsel")
			{
				//bcval=parseInt(bcval)+parseInt(document.getElementById('txtonob').value);
				//qt=parseFloat(qt)+parseFloat(document.getElementById('txtoqty').value);
			}
			else 
			{
				for(var i=1; i<=document.frmaddDepartment.tsln.value; i++)
				{
					var recqtyp="recqtyp"+i;
					var recnobp="recnobp"+i;
					bcval=parseInt(bcval)+parseInt(document.getElementById(recnobp).value);
					qt=parseFloat(qt)+parseFloat(document.getElementById(recqtyp).value);
				}	
			}
		}
		var recqt="bnqtys_"+binno;
		var recnob="bnnomps_"+binno;
		var nrecqt="nbinqtys_"+binno;
		var nrecnob="nbinnomps_"+binno;
		if(document.getElementById(recqt).value!="")
		{
			bcval=parseInt(bcval)+parseInt(document.getElementById(nrecnob).value);
			qt=parseFloat(qt)+parseFloat(document.getElementById(nrecqt).value); 
		}
		document.getElementById(recnob).value=parseInt(bcval);
		document.getElementById(recqt).value=parseFloat(qt);
	}
}

function addnewsl(nslval)
{
	var nval=nslval-1;
	var nwslocs="nwslocs"+nslval;
	var bnqtys="bnqtys_"+nval;
	if(document.getElementById(bnqtys).value=="")
	{
		alert("Qty not present in previous SLOC");
		return false;
	}
	else
	{
		document.getElementById(nwslocs).style.display="block";
		document.frmaddDepartment.newsloc.value=1;
	}
}

function itmqtychk(itmqtyval)
{
	var eqty=document.getElementById('txteoqty').value;
	var txtornomp=document.getElementById('txtornomp').value;
	
	var loadedqty=document.getElementById('txtloqty').value;
	var alnolp=document.getElementById('txtallonolp').value;
	var alnomp=document.getElementById('txtallnomp').value;
	
	var orbalnomp=document.getElementById('txtorblnomp').value;
	var orbalnolp=document.getElementById('txtorblnolp').value;
	var orbalqty=document.getElementById('txtorblqty').value;
	
	var ewtmp=document.frmaddDepartment.ewtmp.value;
	var txteups=document.getElementById('txteups').value;
	var txteupstyp=document.getElementById('txteupstyp').value;
	
	
	var tnomp=parseFloat(itmqtyval)/parseFloat(ewtmp);
	tnomp=Math.floor(tnomp);
	tnomp=parseInt(tnomp);
	var bnomp=parseInt(txtornomp)-parseInt(tnomp);
	
	if(parseFloat(itmqtyval) > parseFloat(eqty))
	{
		alert("Qty to be Allocated cannot be more than Ordered Qty");
		document.getElementById('txttobealqty').value=eqty;
		document.getElementById('txtallnomp').value=alnomp;
		document.getElementById('txtallonolp').value=alnolp;
		document.getElementById('txtorblnomp').value=orbalnomp;
		document.getElementById('txtorblnolp').value=orbalnolp;
		document.getElementById('txtorblqty').value=orbalqty;
		return false;
	}
	if(parseFloat(itmqtyval) < parseFloat(loadedqty))
	{
		alert("Qty to be Allocated cannot be less than Allocated Qty.\nYou need to Unallocate the Allocated Qty first then proceed to reduce Qty tobe Allocated");
		document.getElementById('txttobealqty').value=eqty;
		document.getElementById('txtallnomp').value=alnomp;
		document.getElementById('txtallonolp').value=alnolp;
		document.getElementById('txtorblnomp').value=orbalnomp;
		document.getElementById('txtorblnolp').value=orbalnolp;
		document.getElementById('txtorblqty').value=orbalqty;
		return false;
	}
	
	
	var packtp=document.frmaddDepartment.txteups.value.split(" ");
			
	if(packtp[1]=="Gms")
	{ 
		var ptp=(1000/parseFloat(packtp[0]));
		var ptp1=(parseFloat(packtp[0])/1000);
	}
	else
	{
		var ptp=parseFloat(packtp[0]);
		var ptp1=parseFloat(packtp[0]);
	}
	document.getElementById('txttobealqty').value=parseFloat(document.getElementById('txttobealqty').value).toFixed(3);
	document.getElementById('txtallnomp').value=parseInt(tnomp);
	document.getElementById('txtorblqty').value=parseFloat(eqty)-parseFloat(itmqtyval);
	document.getElementById('txtorblqty').value=parseFloat(document.getElementById('txtorblqty').value).toFixed(3);
	document.getElementById('txttobealqty').value=parseFloat(document.getElementById('txttobealqty').value).toFixed(3);
	
	var qt1=(parseFloat(document.getElementById('txtorblqty').value)/parseFloat(document.frmaddDepartment.ewtmp.value));
	qt1=Math.floor(qt1);
	qt1=parseInt(qt1);
	document.getElementById('txtorblnomp').value=parseInt(qt1);
			
	var qqt=parseFloat(document.frmaddDepartment.ewtmp.value)*parseFloat(document.getElementById('txtallnomp').value);
	var qqt1=parseFloat(document.frmaddDepartment.ewtmp.value)*parseFloat(document.getElementById('txtorblnomp').value);
	if(packtp[1]=="Gms")
	document.getElementById('txtallonolp').value=((parseFloat(itmqtyval)-parseFloat(qqt))*parseFloat(ptp));
	else
	document.getElementById('txtallonolp').value=((parseFloat(itmqtyval)-parseFloat(qqt))/parseFloat(ptp));
	document.getElementById('txtallonolp').value=parseFloat(document.getElementById('txtallonolp').value).toFixed(3);
	var x=document.getElementById('txtallonolp').value.split(".");
	if(parseInt(x[1])>0)
	{
		alert("Qty to be Allocated cannot have fractional UPS.");
		document.getElementById('txttobealqty').value=eqty;
		document.getElementById('txtallnomp').value=alnomp;
		document.getElementById('txtallonolp').value=alnolp;
		document.getElementById('txtorblnomp').value=orbalnomp;
		document.getElementById('txtorblnolp').value=orbalnolp;
		document.getElementById('txtorblqty').value=orbalqty;
		return false;
	}
	document.getElementById('txtallonolp').value=parseInt(document.getElementById('txtallonolp').value);
	if(parseFloat(document.getElementById('txtallonolp').value)<=0)
	document.getElementById('txtallonolp').value=0;
	
	document.getElementById('txtorblnolp').value=(parseInt(document.getElementById('txtenop').value)-parseInt(document.getElementById('txtallonolp').value));
	document.getElementById('txtorblnolp').value=parseInt(document.getElementById('txtorblnolp').value);
	if(parseFloat(document.getElementById('txtorblnolp').value)<=0)
	document.getElementById('txtorblnolp').value=0;
}

function myhome()
{ 
	var fl=0;	
	if(document.frmaddDepartment.maintrid.value!="" || document.frmaddDepartment.maintrid.value>0)
	{
		if(document.frmaddDepartment.subtrid.value!="" && document.frmaddDepartment.subtrid.value>0)
		{
			alert("You are in Loading Process. Click on Next to complete the Loading then click on Back.");
			fl=1;
			return false;
		}
	}		
	if(fl==1)
	{
		return false;
	}
	else
	{
		window.location='home_dispallocation.php';
		return true;
	} 	 
}

function mycancel(sbmval)
{
	if(confirm('Do You wish to Cancel this Transaction?')==true)
	{
		document.frmaddDepartment.trsbmval.value=sbmval;
		document.frmaddDepartment.submit();
		return true;
	}
	else
	{
		return false;
	}
}

function mySubmit(sbmval)
{ 
	//dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	//dt4=getDateObject(document.frmaddDepartment.date.value,"-");
	var fl=0;	
	if(document.frmaddDepartment.maintrid.value=="" || document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not posted any record. Please post record then click on Preview");
		fl=1;
		return false;
	}	
	if(document.frmaddDepartment.maintrid.value!="" || document.frmaddDepartment.maintrid.value>0)
	{
		if(document.frmaddDepartment.subtrid.value!="" && document.frmaddDepartment.subtrid.value>0)
		{
			alert("You are in Loading Process. Click on Next to complete the Loading then click on Back.");
			fl=1;
			return false;
		}
	}		
	
	if(fl==1)
	{
		return false;
	}
	else
	{
		document.frmaddDepartment.trsbmval.value=sbmval;
		document.frmaddDepartment.submit();
		return true;
	} 	 
}


function chkbarcode(mltval)
{
	var flg=0;
	mltval=mltval.toUpperCase();
	var txtbarcode="txtbarcod1";
	document.getElementById(txtbarcode).value=mltval;
	if(mltval.length < 11)
	{
		alert("Invalid Barcode. Barcode cannot be less than 11 digit");
		document.getElementById(txtbarcode).value="";
		document.getElementById(txtbarcode).focus();
		flg=1;
		return false;
	}
	else
	{
		var z=mltval.split("");
		var a=z[0];
		var b=z[1];
		if(isChar_o(a)==false)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		if(isChar_o(b)==false)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		for(var i=2; i<z.length; i++)
		{
			if(isChar_o(z[i])==true)
			{
				alert("Invalid Barcode");
				document.getElementById(txtbarcode).value="";
				document.getElementById(txtbarcode).focus();
				flg=1;
				return false;
			}
		}
		var pcode=document.frmaddDepartment.plantcodes.value.split(",");
		var ycode=document.frmaddDepartment.yearcodes.value.split(",");
		var x=0
		var y=0;
		/*for(var i=0; i<pcode.length; i++)
		{
			if(pcode[i]==a)
			{
				x++;
			}
		}
		for(var i=0; i<ycode.length; i++)
		{
			if(ycode[i]==b)
			{
				y++;
			}
		}
		if(x==0)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}
		
		if(y==0)
		{
			alert("Invalid Barcode");
			document.getElementById(txtbarcode).value="";
			document.getElementById(txtbarcode).focus();
			flg=1;
			return false;
		}*/
	}
	if(flg==0)
	{
		var bardet=document.frmaddDepartment.txteordno.value;
		var trid=document.frmaddDepartment.maintrid.value;
		var subtrid=document.frmaddDepartment.subtrid.value;
		var ver=document.frmaddDepartment.txtevariety.value;
		var ups=document.frmaddDepartment.txteups.value;
		var mchksel=document.frmaddDepartment.mchksel.value;
		var upstyp=document.frmaddDepartment.txteupstyp.value;
		showUser(bardet,'barchk3','barchk3',mltval,trid,ver,ups,mchksel,upstyp)
		mltval="'"+mltval+"'";
		subtrid="'"+subtrid+"'";
		setTimeout('showpmode3('+mltval+','+subtrid+')', 1000);

	}
}

function showpmode3(mltval,subtrid)
{
	var bardet=document.frmaddDepartment.txteordno.value;
	var trid=document.frmaddDepartment.maintrid.value;
	var ver=document.frmaddDepartment.txtevariety.value;
	var ups=document.frmaddDepartment.txteups.value;
	var mchksel=document.frmaddDepartment.mchksel.value;
	var brflg=document.frmaddDepartment.brflg3.value;
	var subtrid=document.frmaddDepartment.subtrid.value;
	var upstyp=document.frmaddDepartment.txteupstyp.value;
	if(document.frmaddDepartment.brchflg3.value==0)
	{
		showUser(bardet,'barchk3','barchk3',mltval,trid,ver,ups,mchksel,upstyp,upstyp)
	}
	else
	{
		pformbarcode1();
	}
}

function pformbarcode1()
{	
	var fl=0;	
	if(document.frmaddDepartment.txtpp.value=="")
	{
		alert("Please select Party Type");
		document.frmaddDepartment.txtpp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtstfp.value=="")
	{
		alert("Please select Party Name");
		document.frmaddDepartment.txtstfp.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.unallocationtype.value=="")
	{
		alert("Please select Un-Allocation Type");
		fl=1;
		return false;
	}
	if(fl==1)
	{
		return false;
	}
	else
	{
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		showUser(a,'postingtable','mformbarcode3','','','','','');
	}  
}

</script>

<style>
#table-wrapper {
	height:101px;
	width:970px;
	overflow:auto;
	/*overflow-y:scroll;*/  
	margin-top:0px;
}
#table-wrapper table {
	width:942px;
	float:right;
	color:#000;    
}
#table-wrapper table thead tr .text {
	position:fixed;   
	top:0px;  
	height:20px;
	width:35%;
	border:1px solid red;
}
			   
::-webkit-input-placeholder { /* WebKit browsers */
    color:#CCCCCC;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
   color:    #CCCCCC;
   opacity:  1;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
   color:    #CCCCCC;
   opacity:  1;
}
:-ms-input-placeholder { /* Internet Explorer 10+ */
   color:    #CCCCCC;
} 
</style>

<body onLoad="onloadfocus();">

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
        <tr>
           <td valign="top"><?php require_once("../include/arr_dispatch.php");?></td>
        </tr>
        </tr>
</table>
<table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/dispatch_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#378b8b" style="border-bottom:solid; border-bottom-color:#378b8b" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Dispatch Allocation</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
	  
	  <td align="center" colspan="4" >
	<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" enctype="multipart/form-data"   > 
	<input name="frm_action" value="submit" type="hidden"> 
	<input name="txt14" value="" type="hidden"> 
	<input type="hidden" name="txtid" value="<?php echo $code?>" />
	<input type="hidden" name="logid" value="<?php echo $logid?>" />
	<input type="hidden" name="getdetflg" value="0" />
	<input type="hidden" name="txtconchk" value="" />
	<input type="hidden" name="txtptype" value="" />
	<input type="hidden" name="txtcountrysl" value="" />
	<input type="hidden" name="txtcountryl" value="" />
	<input type="hidden" name="rettype" value=""  />
	<input type="hidden" name="extdcno" value="<?php echo $extdcno?>"  />
	<input type="hidden" name="plantcodes" value="<?php echo $plantcodes;?>" />
	<input type="hidden" name="yearcodes" value="<?php echo $yearcodes;?>" /> 
	<input type="hidden" name="trsbmval" value="0" /> 
		
<?php
	$tid=0; $subtid=0; $subsubtid=0;
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Dispatch Allocation</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="smalltbltext">&nbsp;<?php echo $code1;?></td>

<td width="172" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="smalltbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>
 <!--<tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">Dispatch Challan Date&nbsp;</td>
<td width="234" align="left" valign="middle" class="tbltext">&nbsp;<input name="dcdate" id="dcdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dcdate');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script> </td>
<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Dispatch Challan No.&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdcno" type="hidden" size="20" class="tbltext" maxlength="20" onChange="dcdchk();" tabindex="0" value="test"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>-->
<input name="txtdcno" type="hidden" size="20" class="tbltext" maxlength="20" onChange="dcdchk();" tabindex="0" value="test"/>
<input name="dcdate" id="dcdate" type="hidden" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>
<?php
$quer3=mysqli_query($link,"SELECT * FROM tblclassification  where (main='Channel' or main='Stock Transfer') and classification!='Bulk' order by classification"); 
?>
 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Party Type&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<select class="smalltbltext" name="txtpp" style="width:120px;" onChange="modetchk1(this.value)">
<option value="" selected>--Select--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['classification'];?>" />   
		<?php echo $noticia['classification'];?>
		<?php } ?>
	</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<div id="selectpartylocation"style="display:none" ></div>		   
<div id="selectparty"style="display:none" >		   
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >   
 <tr class="Dark" height="30">
<td width="230"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td width="714"  colspan="3" align="left"  valign="middle" class="tbltext" id="vitem1">&nbsp;<select class="tbltext"  id="itm1" name="txtstfp" style="width:220px;" onChange="showaddr(this.value);" >
<option value="" selected="selected">--Select--</option>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>

<tr class="Dark" height="30">
<td width="230" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress">&nbsp;<input type="hidden" name="adddchk" value="" />  </td>
</tr>
<!--<tr class="Light" height="25">
<td width="230" align="right"  valign="middle" class="smalltblheading">&nbsp;Mode of Transit&nbsp;</td>
 <td align="left"  valign="middle" class="smalltbltext" colspan="3" ><input name="txt1" type="radio" class="smalltbltext" value="Transport" onClick="clk(this.value);" />Transport&nbsp;<input name="txt1" type="radio" class="smalltbltext" value="Courier" onClick="clk(this.value);" />Courier&nbsp;<input name="txt1" type="radio" class="smalltbltext" value="By Hand" onClick="clk(this.value);" />Hand Delivery&nbsp;<font color="#FF0000">*</font>&nbsp;<input name="txt11" value="" type="hidden"> </td>
</tr>-->
</table>
</div>

<br />
<div id="orderdetails" ></div>	
<div id="bardetails" ></div>
<br />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Select Allocation Type</td>
</tr>

<tr class="Dark" height="25">
<td width="230"  align="right"  valign="middle" class="tblheading">Allocation type&nbsp;</td>
<td width="714" colspan="3" align="left"  valign="middle" class="tbltext"><input type="radio" name="allctyp" class="tbltext" value="lotwise" onClick="alloctype(this.value);" />&nbsp;Pick to Allocate&nbsp;&nbsp;<input type="radio" name="allctyp" class="tbltext" value="barcodewise" onClick="alloctype(this.value);" />&nbsp;Scan to Allocate&nbsp;<font color="#FF0000" >*</font>&nbsp;<input type="hidden" name="allocationtype" value="" /><input type="hidden" name="eseltyp" value="" /></td></tr>
</table><br />
<div id="altypdetails" style="display:block">
<div id="barcwise" style="display:none"></div>
<div id="lotnwise" style="display:none"></div>

<br />

<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" /><input type="hidden" name="newsloc" value="" />
</div></div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/back.gif" border="0" style="display:inline;cursor:Pointer;" onClick="return myhome();"  />&nbsp;&nbsp;<img src="../images/cancel.gif" border="0" style="display:inline;cursor:Pointer;" onClick="return mycancel('1');"  />&nbsp;&nbsp;<img src="../images/preview.gif" border="0"style="display:inline;cursor:Pointer;" onClick="return mySubmit('0');" /></td>
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
