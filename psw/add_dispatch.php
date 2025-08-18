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
	require_once('../include/reader.php'); // include the class
	require_once("../include/insertxlsdata_rembar.php");	
	
	if(isset($_POST['frm_action'])=='submit')
	{
	//exit;
		set_time_limit(120);
	   	$txtid=trim($_POST['txtid']);
	   	$date=trim($_POST['date']);
		$dcdate=trim($_POST['dcdate']);
		$txtdcno=trim($_POST['txtdcno']);
		$txtpp=trim($_POST['txtpp']);
		$txtstatesl=trim($_POST['txtstatesl']);
		$txtlocationsl=trim($_POST['txtlocationsl']);
		$locationname=trim($_POST['locationname']);
		$txtcountrysl=trim($_POST['txtcountrysl']);
		$txtptype=trim($_POST['txtptype']);
		$txtcountrysl=trim($_POST['txtcountrysl']);
		$txtcountryl=trim($_POST['txtcountryl']);
		$txtstfp=trim($_POST['txtstfp']);
		//$txtbrowse=trim($_POST['txtbrowse']);
		$txtcountryl=trim($_POST['txtcountryl']);
		$txtcountryl=trim($_POST['txtcountryl']);
		
		//$txtbrowse=trim($_POST['txtbrowse']);
		$cnt=0;
		$filename=$_FILES['txtbrowse']['name'];
		$filepath='../ExcelFileData/'.$filename;
		$name_tmp = $_FILES['txtbrowse']['tmp_name'];
		move_uploaded_file($name_tmp,$filepath);
		chmod($filepath, 0777);
		
		$tdate11=$date;
		$tday1=substr($tdate11,0,2);
		$tmonth1=substr($tdate11,3,2);
		$tyear1=substr($tdate11,6,4);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;
		
		$tdate12=$date;
		$tday12=substr($tdate12,0,2);
		$tmonth12=substr($tdate12,3,2);
		$tyear12=substr($tdate12,6,4);
		$tdate2=$tyear12."-".$tmonth12."-".$tday12;
		
		$sql_main="insert into tbl_pswrem(pswrem_tcode, pswrem_date, logid, yearcode, pswrem_typ, pswrem_dcno, pswrem_dcdate, pswrem_ptype, pswrem_state, pswrem_location, pswrem_country, pswrem_party, plantcode)values('$txtid','$tdate1','$logid', '$yearid_id', 'barcodes','$txtdcno','$tdate2','$txtpp','$txtstatesl','$locationname','$txtcountryl','$txtstfp', '$plantcode')";
		if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
		{
			$mainid=mysqli_insert_id($link);
			$cnt=insertdata($filepath,$mainid);
		}
		if($cnt>0)
		{
		echo "<script>window.location='trn_rembarqty_preview.php?pid=$mainid'</script>";	
		}
		else
		{
		$s_sub="delete from tbl_pswrem where logid='$logid' and  pswrem_tflg=0 and pswrem_typ='barcodes' and pswrem_id='$mainid'";
		mysqli_query($link,$s_sub) or die(mysqli_error($link));	
		?>
		<script>
			alert('File Import Unsuccessfull. Please Check the Excel file and try again.');
		</script>
		<?php
		}
		
		//exit;
		
			
	}
	
	$sql_code="SELECT MAX(pswrem_tcode) FROM tbl_pswrem where plantcode='$plantcode'  ORDER BY pswrem_tcode DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
			$code1="TCR".$code."/".$yearid_id."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="TCR".$code."/".$yearid_id."/".$lgnid;
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>

<!--- Calender code --->
<link href="../calendar/calendar-blue.css" rel="stylesheet" />
<script type="text/javascript" src="../calendar/calendar.js"></script>
<script type="text/javascript" src="../calendar/calendar-en.js"></script>
<!--- Calender code --->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>psw - Transaction - Packaged Seed Release</title>
<link href="../include/main_psw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_psw.css" rel="stylesheet" type="text/css" />
</head>
<script src="qtyrem1.js"></script>
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
	dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.date.value,"-");
	var fl=0;	
	
	if(dt3 > dt4)
	{
		alert("Please select Valid Party DC Date.");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtdcno.value=="")
	{
		alert("Please enter Party DC Number");
		document.frmaddDepartment.txtdcno.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtdcno.value.charCodeAt()==32)
	{
		alert("Party DC Number cannot start with Space");
		document.frmaddDepartment.txtdcno.focus();
		fl=1;
		return false;
	}
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
	if(document.frmaddDepartment.txtbrowse.value=="")
	{
		alert("Please Transport Rate Excel file to Upload");
		document.frmaddDepartment.txtbrowse.focus();
		return false;
	}
	var filename=document.frmaddDepartment.txtbrowse.value;
	var filearr1=filename.split(".");
	var tarr=filearr1[0].split("_");
	var filearr=tarr[0].split(" ");
	var filechk=filearr[0]+' '+filearr[1];
	var destchk="";
	if(filechk=="Barcodes Dispatch")
	destchk=(tarr[1]).trim();
	var flg=0;
	var dt=document.frmaddDepartment.date.value;
	var dtarr=dt.split("-");
	var cdate=(dtarr[0]+dtarr[1]+dtarr[2]).trim();
		
	if(document.frmaddDepartment.txtbrowse.value != "")
	{
		var extArray = new Array(".xls");
		var fileName = document.frmaddDepartment.txtbrowse.value;
						
		if(!fileName) {return false;}
		ext = fileName.substring(fileName.lastIndexOf(".")).toLowerCase();
						
		for (var i = 0; i < extArray.length; i++) {
		   if (extArray[i] == ext) flg=1;
		}
		/*alert("Please only upload files that end in type:  "
		+ (extArray.join("  ")) + "\nPlease select a new "
		+ "file to upload and submit again.");
		document.frmaddDepartment.txtbrowse.focus();
		return false;*/
	}
	if(flg==1)
	{
		if(filechk!="Barcodes Dispatch")
		{
			alert("Excel File attached is Invalid. ");
			document.frmaddDepartment.txtbrowse.value==""
			//document.frmaddDepartment.txtbrowse.focus();
			return false;
		}
		if(destchk!=cdate)
		{
			alert("Excel File attached is Invalid. ");
			document.frmaddDepartment.txtbrowse.value==""
			//document.frmaddDepartment.txtbrowse.focus();
			return false;
		}
		
	}
	else
	{
				alert("Please only upload files that end in type: .xls "
				+ "\nPlease select a new "
				+ "file to upload and submit again.");
				document.frmaddDepartment.txtbrowse.focus();
				return false;
	}	
	alert(document.frmaddDepartment.txtbrowse.value);
	if(fl==1)
	{
		return false;
	}
	else
	{
		var a=formPost(document.getElementById('mainform'));
		alert(a);
		//showUser(a,'postingtable','mform','','','','','');
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
	
	if(document.frmaddDepartment.getdetflg.value==0)
	{
		alert("Please click on Get Details first to remove Pack Seed Quantity");
		f=1;
		return false;
	}
	
	/*if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select Lot");
		document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}*/
	
	var val=document.frmaddDepartment.srno1.value;
	if(val!="")
	{	
		var v_1=0;
		var qtyd=0;
		var qtyo=0;
		var qtyb=0;
		var nop=0;
		var nomp=0;
		for(var i=1; i<=val; i++)
		{ 
			var dc="txtqty_"+i;
			var rem="recqtyp_"+i;
			var bal="txtdqtyp_"+i;
			var nop="txtrecbagp_"+i;
			var nomp="txtrecnomp_"+i;
			nop=parseInt(nop)+parseInt(document.getElementById(nop).value);
			nomp=parseInt(nomp)+parseInt(document.getElementById(nomp).value);
			if(document.getElementById(rem).value=="")
			{
				v_1++;
			}
				var q=document.getElementById(dc).value;
				var rq=document.getElementById(rem).value;
				var bq=document.getElementById(bal).value;
				
				if(rq=="")rq=0;
				
				var qtyd=parseFloat(qtyd)+parseFloat(rq);
				var qtyo=parseFloat(qtyo)+parseFloat(q);
				var qtyb=parseFloat(qtyb)+parseFloat(bq);
		}
		if(nop==0 && nomp==0)
		{
			alert("Please Enter NoP/NoMP to Remove");
			f=1;
			return false;
		}
		if(v_1>=val)
		{
			alert("Please Enter NoP/NoMP to Remove");
			f=1;
			return false;
		}					
		if(parseFloat(qtyd) > parseFloat(qtyo))
		{
			alert("Please check. Total Quantity Removed not matching with Total Quantity in Stock");
			return false;
			f=1;
		}		
	}
		
		if(f==1)
		{
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
	dt3=getDateObject(document.frmaddDepartment.dcdate.value,"-");
	dt4=getDateObject(document.frmaddDepartment.date.value,"-");
	var fl=0;	
	
	if(dt3 > dt4)
	{
		alert("Please select Valid Party DC Date.");
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtdcno.value=="")
	{
		alert("Please enter Party DC Number");
		document.frmaddDepartment.txtdcno.focus();
		fl=1;
		return false;
	}
	if(document.frmaddDepartment.txtdcno.value.charCodeAt()==32)
	{
		alert("Party DC Number cannot start with Space");
		document.frmaddDepartment.txtdcno.focus();
		fl=1;
		return false;
	}
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
	if(document.frmaddDepartment.txtbrowse.value=="")
	{
		alert("Please Transport Rate Excel file to Upload");
		document.frmaddDepartment.txtbrowse.focus();
		return false;
	}
	var filename=document.frmaddDepartment.txtbrowse.value;
	var filearr1=filename.split(".");
	var tarr=filearr1[0].split("_");
	var filearr=tarr[0];
	var filechk=filearr;
	var destchk="";
	if(filechk==document.frmaddDepartment.txtdcno.value)
	destchk=(tarr[1]).trim();
	var flg=0;
	var dt=document.frmaddDepartment.date.value;
	var dtarr=dt.split("-");
	var cdate=(dtarr[0]+dtarr[1]+dtarr[2]).trim();
		
	if(document.frmaddDepartment.txtbrowse.value != "")
	{
		var extArray = new Array(".xls");
		var fileName = document.frmaddDepartment.txtbrowse.value;
						
		if(!fileName) {return false;}
		ext = fileName.substring(fileName.lastIndexOf(".")).toLowerCase();
						
		for (var i = 0; i < extArray.length; i++) {
		   if (extArray[i] == ext) flg=1;
		}
		/*alert("Please only upload files that end in type:  "
		+ (extArray.join("  ")) + "\nPlease select a new "
		+ "file to upload and submit again.");
		document.frmaddDepartment.txtbrowse.focus();
		return false;*/
	}
	if(flg==1)
	{
		if(filechk!=document.frmaddDepartment.txtdcno.value)
		{
			alert("Excel File attached is Invalid. ");
			document.frmaddDepartment.txtbrowse.value==""
			//document.frmaddDepartment.txtbrowse.focus();
			return false;
		}
		if(destchk!=cdate)
		{
			alert("Excel File attached is Invalid. ");
			document.frmaddDepartment.txtbrowse.value==""
			//document.frmaddDepartment.txtbrowse.focus();
			return false;
		}
		
	}
	else
	{
				alert("Please only upload files that end in type: .xls "
				+ "\nPlease select a new "
				+ "file to upload and submit again.");
				document.frmaddDepartment.txtbrowse.focus();
				return false;
	}	
	if(fl==1)
	{
		return false;
	}
	else
	{
		return true;
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


function qtychk1(qtyval1,val)
{
	if(qtyval1!="" && qtyval1 > 0)
	{
		var z1="txtdqtyp_"+val;
		var z2="txtqty_"+val;
		var z3="recqtyp_"+val;
		var b1="txtdbagp_"+val;
		if(parseFloat(document.getElementById(z3).value) > parseFloat(document.getElementById(z2).value))
		{
			alert( "Qty can be either equal or less than Actual Qty");
			document.getElementById(z1).value="";
			document.getElementById(z3).focus();
		}
		else
		{
		document.getElementById(z1).value=parseFloat(document.getElementById(z2).value)-parseFloat(qtyval1);
		if(document.getElementById(z1).value > 0 && document.getElementById(b1).value<=0)document.getElementById(b1).value=1;
		}
	}
	else
	{
		alert( "Qty can not be Zero");
		document.getElementById(z1).value="";
		document.getElementById(z3).value="";
		document.getElementById(z3).focus();
	}
}


function Bagschk1(Bagsval1, val)
{
	var z1="txtdisp_"+val;
	var z2="txtrecbagp_"+val;
	var z3="txtdbagp_"+val;
		
	var q1="txtqty_"+val;
	var q2="recqtyp_"+val;
	var q3="txtdqtyp_"+val;
		
	var m1="txtnomp_"+val;
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
	//alert(ptp);
	if(Bagsval1!="" && Bagsval1 > 0)
	{	
		if(parseInt(document.getElementById(z2).value)>parseInt(document.getElementById(z1).value))
		{
			alert( "NoP can be either equal or less than Actual NoP");
			document.getElementById(z2).value="";
			document.getElementById(z3).value="";
			document.getElementById(z2).focus();
		}
		else
		{
			
			if(document.getElementById(m2).value!="" && document.getElementById(m2).value>0)
			{
				qty=(parseFloat(document.getElementById(m2).value)*parseFloat(document.getElementById(wtinmp).value))+(parseFloat(document.getElementById(z2).value)*parseFloat(ptp));
			}
			else
			{
				qty=(parseFloat(document.getElementById(z2).value)*parseFloat(ptp));
			}
			
			document.getElementById(z3).value=parseInt(document.getElementById(z1).value)-parseInt(document.getElementById(z2).value);
			document.getElementById(q2).value=parseFloat(qty);
			document.getElementById(q3).value=parseFloat(document.getElementById(q1).value)-parseFloat(qty);
			document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
			//if(document.getElementById(z1).value<0)document.getElementById(z1).value=0;
		}
	}
	else
	{
			if(document.getElementById(m2).value!="" && document.getElementById(m2).value>0)
			{
				qty=(parseFloat(document.getElementById(m2).value)*parseFloat(document.getElementById(wtinmp).value));
				document.getElementById(z3).value=parseInt(document.getElementById(z1).value)-parseInt(document.getElementById(z2).value);
				document.getElementById(q2).value=parseFloat(qty);
				document.getElementById(q3).value=parseFloat(qty);
				document.getElementById(q3).value=parseFloat(document.getElementById(q3).value).toFixed(3);
			}
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
		
	var m1="txtnomp_"+val;
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
	showUser(statesl,'locations','location','','','','','','');
}
function stateslchk(valloc)
{
	document.frmaddDepartment.locationname.value="";
	if(document.frmaddDepartment.txtstatesl.value=="")
	{
		alert("Please Select State for Location");
		document.frmaddDepartment.txtlocationsl.selectedIndex=0;
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
		}

}

function onloadfocus()
{
document.frmaddDepartment.txtdcno.focus();
}
</script>
<body onLoad="onloadfocus();">

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
        <tr>
           <td valign="top"><?php require_once("../include/arr_psw.php");?></td>
        </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/psw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#0BC5F4" style="border-bottom:solid; border-bottom-color:#0BC5F4" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Dispatch</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
	  
	  <td align="center" colspan="4" >
<?php
$extdcno="";
$sql_arr_home=mysqli_query($link,"select * from tbl_pswrem where plantcode='$plantcode' and pswrem_tflg=1 and pswrem_typ='barcodes'  order by pswrem_code desc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home > 0)
{
	while($row_arr_home=mysqli_fetch_array($sql_arr_home))
	{
		if($extdcno!="")
		$extdcno=$extdcno.",".$row_arr_home['pswrem_dcno'];
		else
		$extdcno=$row_arr_home['pswrem_dcno'];
	}
}
?>	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" enctype="multipart/form-data"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
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
		</br>
<?php
$tid=0; $subtid=0;

?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Dispatch</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;PR1/F/PS1</td>

<td width="172" align="right" valign="middle" class="tblheading">Date&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
</tr>
 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">Dispatch Challan Date&nbsp;</td>
<td width="234" align="left" valign="middle" class="tbltext">&nbsp;<input name="dcdate" id="dcdate" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;<a href="javascript:void(0)" onClick="showCalendar('dcdate');" tabindex="6"><img src="../images/cal.gif" alt="Calender" border="0" align="absmiddle"></a><script type="text/javascript" language="javascript" src="../include/popcalender.js"></script> </td>
<td width="172" align="right" valign="middle" class="tblheading">&nbsp;Dispatch Challan No.&nbsp;</td>
<td width="229" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdcno" type="text" size="20" class="tbltext" maxlength="20" onChange="dcdchk();" tabindex="0"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<?php
$quer3=mysqli_query($link,"SELECT * FROM tblclassification  where (main='Channel' or main='Stock Transfer') order by classification"); 
?>
 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Party Type&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtpp" style="width:120px;" onChange="modetchk1(this.value)">
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
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" >   
 <tr class="Dark" height="30">
<td width="206"  align="right"  valign="middle" class="tblheading">Party Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="3" id="vitem1">&nbsp;<select class="tbltext"  id="itm1" name="txtstfp" style="width:220px;" onChange="showUser(this.value,'vaddress','vendor','','','','','');" >
<option value="" selected="selected">--Select--</option>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>

<tr class="Dark" height="30">
<td width="206" align="right"  valign="middle" class="tblheading">Address&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" id="vaddress">&nbsp;<input type="hidden" name="adddchk" value="" />  </td>
</tr>
</table>
</div>	
<!--<br />

<table align="center" border="0" cellspacing="0" cellpadding="0" width="850" bordercolor="#0BC5F4" style="border-collapse:collapse">
<tr class="" height="20">
  <td colspan="4" align="center" class="tblheading">Uploaded Barcodes Details</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#0BC5F4" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="17" align="center" valign="middle" class="tblheading">#</td>
	<td width="132" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="204" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="206" align="center" valign="middle" class="tblheading">Lot No.</td>
	<td width="132" align="center" valign="middle" class="tblheading">UPS</td>
	<td width="113" align="center" valign="middle" class="tblheading">Qty Removed</td>
	<td width="150" align="center" valign="middle" class="tblheading">Barcodes</td>
</tr>

			  <?php $subtbltot=0;?>
			 <input type="hidden" name="itmdchk" value="<?php echo $subtbltot;?>" />
          </table>-->
<br />
<table align="center" border="0" cellspacing="0" cellpadding="0" width="850" bordercolor="#0BC5F4" style="border-collapse:collapse">
<tr class="" height="20">
  <td colspan="4" align="center" class="tblheading"><font color="#FF0000">Data entered above cannot be edited, therefore please double check data before proceeding to next step</font></td>
</tr>
</table>
<br />
		  
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Upload Barcode Excel File</td>
</tr>

<tr class="Dark" height="25">
<td width="206"  align="right"  valign="middle" class="tblheading">Excel File&nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtbrowse" class="tbltext" type="file" size="30"   />&nbsp;<font color="#FF0000" >*</font>&nbsp;&nbsp;.xls extension only</td></tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="850" bordercolor="#0BC5F4" style="border-collapse:collapse">
<tr class="" height="20">
  <td colspan="4" align="center" class="tblheading"><font color="#FF0000">Name of excel file needs to be in format: Dispatch challan number_date of Transaction. e.g. DC1234/14-15_23092104 <br />
Otherwise, excel file data will not be imported</font></td>
</tr>
</table>
<!-- <table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<br />
<table align="center" border="0" cellspacing="0" cellpadding="0" width="850" bordercolor="#0BC5F4" style="border-collapse:collapse">
<tr class="" height="20">
  <td colspan="4" align="center" class="tblheading">NoP Release Details</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#0BC5F4" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
	<td width="14" align="center" valign="middle" class="tblheading">#</td>
	<td width="101" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="156" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="152" align="center" valign="middle" class="tblheading">Lot No.</td>
	<td width="144" align="center" valign="middle" class="tblheading">UPS</td>
	<td width="122" align="center" valign="middle" class="tblheading">NoP</td>
	<td width="117" align="center" valign="middle" class="tblheading">Qty Removed</td>
	<td width="65" align="center" valign="middle" class="tblheading">Edit</td>
	<td width="79" align="center" valign="middle" class="tblheading">Delete</td>
</tr>
</table>
<br />
		  
<div id="postingsubtable" style="display:block">		 
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");
/*$quer3=mysqli_fetch_array($quer3);
		$quer3=$row_cls['cropname'];
*/	
?>

<td width="92" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' order by popularname Asc"); 
?>
	<td width="95" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="258" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	<td width="80" align="right"  valign="middle" class="tblheading" >UPS&nbsp;</td>
    <td width="193" align="left"  valign="middle" class="tbltext" id="vitem2">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:70px;"  onchange="modetchk1(this.value)">
<option value="" selected>--UPS-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
           </tr>

         <tr class="Light" height="30" id="vitem">
           <td align="right"  valign="middle" class="tblheading">Lot Number &nbsp;</td>
           <td align="left" width="238" valign="middle" class="tbltext" style="border-color:#0BC5F4" >&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a><input type="hidden" name="txtlotnoid" /></td>
	<td width="95" align="right"  valign="middle" class="tblheading" >NoP&nbsp;</td>
    <td width="258" align="left"  valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0"  value="" maxlength="10"/>&nbsp;</td>
	<td width="80" align="right"  valign="middle" class="tblheading" >Qty&nbsp;</td>
    <td width="193" align="left"  valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" bndex="0"  value="" maxlength="10"/>&nbsp;</td> 
		   
</table>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>

<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div>-->
</div>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_rembarqty.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:Pointer;" onClick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/next.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  