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
	}
	
	require_once("../include/config.php");
	require_once("../include/connection.php");
	ini_set('precision', -1);

	$olotno = $_REQUEST['olotno'];
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
	 	$srno=trim($_POST['srno']);
		$dt=date("Y-m-d");
		$x=1;
		for($i=1; $i<$srno; $i++)
		{
			$arrivaldate2='arrivaldate'.$i;
			$prodate2='prodate'.$i;
			$cropname2='cropname'.$i;
			$varietyname2='varietyname'.$i;
			$spcodes2='spcodes'.$i;
			$lotno2='lotno'.$i;
			$arrqty2='arrqty'.$i;
			$pqty2='arrqty'.$i;
			$conqty2='conqty'.$i;
			$loss2='loss'.$i;
			$lossper2='lossper'.$i;
			$blendlotno2='blendlotno'.$i;
			$rowdensitydata2='rowdensitydata'.$i;
			$condensitydata2='condensitydata'.$i;
			$cspotblaptap2='cspotblaptap'.$i;
			$csqirdsgm2='csqirdsgm'.$i;
			$cspicds2='cspicds'.$i;
			$rpirds2='rpirds'.$i;
			$rqitsl_apsrp2='rqitsl_apsrp'.$i;
			$correction_factor2='correction_factor'.$i;
			$rqitlkg2='rqitlkg'.$i;
			$rpitl2='rpitl'.$i;
			
			$arrivaldate=trim($_POST[$arrivaldate2]);
			$prodate=trim($_POST[$prodate2]);
			$cropname=trim($_POST[$cropname2]);
			$varietyname=trim($_POST[$varietyname2]);
			$spcodes=trim($_POST[$spcodes2]);
			$lotno=trim($_POST[$lotno2]);
			$arrqty=trim($_POST[$arrqty2]);
			$pqty=trim($_POST[$arrqty2]);
			$conqty=trim($_POST[$conqty2]);
			$loss=trim($_POST[$loss2]);
			$lossper=trim($_POST[$lossper2]);
			$blendlotno=trim($_POST[$blendlotno2]);
			$rowdensitydata=trim($_POST[$rowdensitydata2]);
			$condensitydata=trim($_POST[$condensitydata2]);
			$cspotblaptap=trim($_POST[$cspotblaptap2]);
			$csqirdsgm=trim($_POST[$csqirdsgm2]);
			$cspicds=trim($_POST[$cspicds2]);
			$rpirds=trim($_POST[$rpirds2]);
			$rqitsl_apsrp=trim($_POST[$rqitsl_apsrp2]);
			$correction_factor=trim($_POST[$correction_factor2]);
			$rqitlkg=trim($_POST[$rqitlkg2]);
			$rpitl=trim($_POST[$rpitl2]);
		
			$tdate11=explode("-",$arrivaldate);
			$arrivaldate1=$tdate11[2]."-".$tdate11[1]."-".$tdate11[0];
			
			$tdate12=explode("-",$prodate);
			$prodate1=$tdate12[2]."-".$tdate12[1]."-".$tdate12[0];
			
			$sql_blends=mysqli_query($link,"select * from tbl_blends where blends_newlot='$blendlotno'  order by blends_orlot asc") or die(mysqli_error($link));
			$row_blends=mysqli_fetch_array($sql_blends);
			
			$blendorlot=$row_blends['blends_orlot'];
		
			$sql_arr_home=mysqli_query($link,"select * from tbl_density where density_blendedorlot='".$blendorlot."' and density_lotno='".$lotno."' ") or die(mysqli_error($link));
			if($tot_arr_home=mysqli_num_rows($sql_arr_home)==0)
			{
				$sqlmain="insert into tbl_density (density_date, density_arrdate, density_prodate, density_crop, density_variety, density_spcode, density_lotno, density_arrqty, density_rawqty, density_conqty, density_proloss, density_plossper, density_blendedlot, density_blendedorlot, density_rawdensity, density_condensity, density_cspblaptap, density_cswrdsgm, density_cspcds, density_rprds, density_rwitsl, density_correctfactor, density_rqrltkg, density_remperlot)values('$dt', '$arrivaldate1', '$prodate1', '$cropname', '$varietyname', '$spcodes', '$lotno', '$arrqty', '$pqty', '$conqty', '$loss', '$lossper', '$blendlotno', '$blendorlot', '$rowdensitydata', '$condensitydata', '$cspotblaptap', '$csqirdsgm', '$cspicds', '$rpirds', '$rqitsl_apsrp', '$correction_factor', '$rqitlkg', '$rpitl')";
				//echo "<br />";
				if(mysqli_query($link,$sqlmain) or die(mysqli_error($link)))
				{
					$x++;
				}	
			}
		}
//echo $x;
		if($srno==$x)
		{
			//exit;
			echo "<script>window.location='home_density.php'</script>";	
		}
		else
		{
			echo "Records not submitted";
			exit;
		}
	}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality- Transaction - Condition Density Data Update</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="qcsample.js"></script>
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



function modetchk(classval)
{
	//alert(classval);
	//document.getElementById('lotdetails').innerHTML='';
	showUser(classval,'vitem','item','','','','','');
	//document.frmaddDepartment.txtlot1.value==""
				//document.frmaddDepartment.txt11.selectedIndex=0;
}
function modetchk1(classval)
{
	//alert(classval);
	//document.getElementById('lotdetails').innerHTML='';
	//var crop=document.frmaddDepartment.txtcrop.value;
	//showUser(classval,'lotdetails','showlotlist',crop,'','','','');
	//document.frmaddDepartment.txtlot1.value==""
	//document.frmaddDepartment.txt11.selectedIndex=0;
}
function openslocpop()
{
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		 alert("Please Select Crop.");
		 //document.frmaddDepartment.txt1.focus();
	}
	else
	{
		//var itm="Raw Seed";
		var crop=document.frmaddDepartment.txtcrop.value;
		var variety=document.frmaddDepartment.txtvariety.value;
		//var stage=document.frmaddDepartment.txtstage.value;
		winHandle=window.open('getuser_density_lotno.php?crop='+crop+'&variety='+variety,'WelCome','top=150,left=160,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
	//setTimeout("showrec()",1000);
}

function showrec()
{
	var lotno=document.frmaddDepartment.txtlot1.value;
	showUser(lotno,'lotdetails','lotdetails','','','','','');
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


/*function mySubmit()
{ 
	//alert(maintrid);
	if(document.frmaddDepartment.maintrid.value==0)
	{
		alert("You have not Posted any Item. Please post & then click Preview");
		return false;
	}
	return true;	 
}*/

function clk(cval)
{
	//alert(document.frmaddDepartment.txt1.checked);
	if(document.frmaddDepartment.txt1.checked==true) 
	{
		document.frmaddDepartment.chk1.value=document.frmaddDepartment.txt1.value;
	}
	else
	{
		document.frmaddDepartment.chk1.value="";
	}
	
	if(document.frmaddDepartment.txt12.checked==true)
	{
		document.frmaddDepartment.chk2.value=document.frmaddDepartment.txt12.value;
	}
	else
	{
		document.frmaddDepartment.chk2.value="";
	}
	
	if(document.frmaddDepartment.txt14.checked==true)
	{
		document.frmaddDepartment.chk3.value=document.frmaddDepartment.txt14.value;
	}
	else
	{
		document.frmaddDepartment.chk3.value="";
	}
	
	if(document.frmaddDepartment.txt16.checked==true)
	{
		document.frmaddDepartment.chk4.value=document.frmaddDepartment.txt16.value;
	}
	else
	{
		document.frmaddDepartment.chk4.value="";
	}
}
function optsl(optval)
{
	//document.frmaddDepartment.txtstage.value=optval;
}


function chkall()
{
	for (var i = 0; i < document.frmaddDepartment.fet.length; i++) 
	{          
		document.frmaddDepartment.fet[i].checked=true;
	} 
}

function clall()
{
	for (var i = 0; i < document.frmaddDepartment.fet.length; i++) 
	{          
		document.frmaddDepartment.fet[i].checked=false;
	} 
}
function mySubmit()
{ 
	var f=0;
	if(document.frmaddDepartment.txtcrop.value=="")
	{
		alert("Please Select Crop");
		document.frmaddDepartment.txtcrop.focus();
		f=1;
		return false;
	}
	if(document.frmaddDepartment.txtcrop.value.charCodeAt() == 32)
	{
		alert("Lot  NO. cannot start with space.");
		document.frmaddDepartment.txcrop.focus();
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
	if(document.frmaddDepartment.txtvariety.value.charCodeAt() == 32)
	{
		alert("Variety cannot start with space.");
		document.frmaddDepartment.txvariety.focus();
		f=1;
		return false;
	}
	
	if(document.frmaddDepartment.chk1.value=="" && document.frmaddDepartment.chk2.value=="" && document.frmaddDepartment.chk3.value=="" && document.frmaddDepartment.chk4.value=="")
	{
		alert("Please Select QC Tests");
		document.frmaddDepartment.txtvariety.focus();
		f=1;
		return false;
	}
	document.frmaddDepartment.txtlot1.value="";
	if(document.frmaddDepartment.srn.value > 1)
	{
		if(document.frmaddDepartment.srn.value <= 2)
		{
			if(document.frmaddDepartment.fet.checked == true)
			{  
				if(document.frmaddDepartment.txtlot1.value =="")
				{
					document.frmaddDepartment.txtlot1.value=document.frmaddDepartment.fet.value;
				}
				else
				{
					document.frmaddDepartment.txtlot1.value = document.frmaddDepartment.txtlot1.value +','+document.frmaddDepartment.fet.value;
				}
			}
		}
		else
		{ 
			for (var i = 0; i < document.frmaddDepartment.fet.length; i++) 
			{          
				if(document.frmaddDepartment.fet[i].checked == true)
				{ 
					if(document.frmaddDepartment.txtlot1.value =="")
					{
						document.frmaddDepartment.txtlot1.value=document.frmaddDepartment.fet[i].value;
					}
					else
					{
						document.frmaddDepartment.txtlot1.value = document.frmaddDepartment.txtlot1.value +','+document.frmaddDepartment.fet[i].value;
					}
				}
			}
		}
	}
	
	if(document.frmaddDepartment.txtlot1.value=="")
	{
		alert("Please Select Lot");
		//document.frmaddDepartment.txtlot1.focus();
		f=1;
		return false;
	}
	//alert(document.frmaddDepartment.txtlot1.value);
	if(f==1)
	{
		return false;
	}
	else
	{	
		return true;
	}	 
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
        <tr>
           <td valign="top"><?php require_once("../include/arr_qcs.php");?></td>
        </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/rsw_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#e48324" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#e48324" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Density Data Review and Update</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input name="txt11" value="" type="hidden"> 
	    
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		
		</br>
<?php

$tot_loss=0; $tot_rqitsl_apsrp=0; $tot_rawqty=0; $tot_conqty=0;

$sql_raw2=mysqli_query($link,"select * from tbl_blends where blends_orlot='$olotno'  order by blends_orlot asc") or die(mysqli_error($link));
$tot_raw2=mysqli_num_rows($sql_raw2);
if($tot_raw2 > 0)
{
	while($row_raw2=mysqli_fetch_array($sql_raw2))
	{
		$lotno=$row_raw2['blends_lotno'];
		$blendlotno=$row_raw2['blends_newlot'];
		
		
		$oltn=str_split($lotno);
		$oldlotnm=$oltn[1].$oltn[2].$oltn[3].$oltn[4].$oltn[5].$oltn[6];
		if($oltn[16]=="R")
		{
			$sql_prosub=mysqli_query($link,"SELECT * FROM tbl_proslipsub where proslipsub_lotno='".$blendlotno."' order by proslipsub_id Asc")or die(mysqli_error($link)); 
			$row_prosub = mysqli_fetch_array($sql_prosub);
			
			$tot_rawqty=$tot_rawqty+$row_raw2['blends_qty'];			
			$totloss=$row_prosub['proslipsub_tlqty'];
			$tot_loss=$totloss;
		}
	}
}	

$tot_conqty=$tot_rawqty-$tot_loss;


$sql_r2=mysqli_query($link,"select * from tbl_blends where blends_orlot='$olotno'  order by blends_orlot asc") or die(mysqli_error($link));
$tot_r2=mysqli_num_rows($sql_r2);
if($tot_r2 > 0)
{
	while($row_r2=mysqli_fetch_array($sql_r2))
	{
		$arrqty=0; $pqty=0; $cqty=0; $totloss=''; $totlossper=''; $totlossper2=''; $loss=''; $lossper=''; $conqty=0; $cspotblaptap=''; $rowdensitydata=''; $condensitydata=''; $csqirdsgm=''; $cspicds=''; $rpirds=''; $rqitsl_apsrp='';
		$lotno=$row_r2['blends_lotno'];
		$blendlotno=$row_r2['blends_newlot'];
		
		$oltn=str_split($lotno);
		$oltn2=str_split($blendlotno);
		$oldlotnm=$oltn[1].$oltn[2].$oltn[3].$oltn[4].$oltn[5].$oltn[6];
		$oldnm2=$oltn2[0].$oltn2[1].$oltn2[2].$oltn2[3].$oltn2[4].$oltn2[5].$oltn2[6];
		if($oltn[16]=="R")
		{
			$sql_arrsub=mysqli_query($link,"select * from tblarrival_sub where old='".$oldlotnm."'") or die(mysqli_error($link));
			$row_arrsub=mysqli_fetch_array($sql_arrsub);
			
			$spcf=$row_arrsub['spcodef'];
			$spcm=$row_arrsub['spcodem'];
			$spcodes=$spcf." x ".$spcm;

			$arrqty=$row_r2['blends_qty'];
			
			$sql_prosub=mysqli_query($link,"SELECT * FROM tbl_proslipsub where proslipsub_lotno='".$blendlotno."' order by proslipsub_id Asc")or die(mysqli_error($link)); 
			$row_prosub = mysqli_fetch_array($sql_prosub);
			
			$pqty=$tot_rawqty;
			$cqty=$tot_conqty;
			$totloss=$row_prosub['proslipsub_tlqty'];
			
			$totlossper=($totloss/$pqty)*100;
			$totlossper2=($totloss/$pqty);
			
			$loss=($arrqty*$totlossper2);
			$lossper=(($loss/$arrqty)*100);
			$conqty=($arrqty-$loss);
			//$tot_loss=$totloss;
			
			$cspotblaptap=(($tot_conqty/$tot_rawqty)*100);
			$cspotblaptap=number_format((float)$cspotblaptap, 14);


			$sql_lotldg=mysqli_query($link,"SELECT * FROM tbl_lot_ldg where lotldg_trid='".$row_prosub['proslipmain_id']."' AND `lotldg_trtype`='PROSLIPSUC' AND SUBSTRING(orlot, 1, 7)='".$oldnm2."' ")or die(mysqli_error($link)); 
			$row_lotldg = mysqli_fetch_array($sql_lotldg);
			
			$conlotn=$row_lotldg['lotldg_lotno'];
			
			$sql_densitydata=mysqli_query($link,"SELECT * FROM tbl_densitydata where density_lotno='".$lotno."' ")or die(mysqli_error($link)); 
			$row_densitydata = mysqli_fetch_array($sql_densitydata);
			$rowdensitydata=$row_densitydata['density_rawsampwt'];
			
			$sql_dendatac=mysqli_query($link,"SELECT * FROM tbl_densitydata where density_clotno='".$conlotn."' ")or die(mysqli_error($link)); 
			$row_dendatac = mysqli_fetch_array($sql_dendatac);
			$condensitydata=$row_dendatac['density_consampwt'];


/*
			$sql_lotldg=mysqli_query($link,"SELECT * FROM tbl_lot_ldg where lotldg_trid='".$row_prosub['proslipmain_id']."' AND `lotldg_trtype`='PROSLIPSUC' ")or die(mysqli_error($link)); 
			$row_lotldg = mysqli_fetch_array($sql_lotldg);
			
			$conlotn=$row_lotldg['lotldg_lotno'];
			
			$sql_densitydata=mysqli_query($link,"SELECT * FROM tbl_densitydata where density_lotno='".$lotno."' ")or die(mysqli_error($link)); 
			$row_densitydata = mysqli_fetch_array($sql_densitydata);
			$rowdensitydata=$row_densitydata['density_rawsampwt'];
			
			$sql_dendatac=mysqli_query($link,"SELECT * FROM tbl_densitydata where density_clotno='".$conlotn."' ")or die(mysqli_error($link)); 
			$row_dendatac = mysqli_fetch_array($sql_dendatac);
			$condensitydata=$row_dendatac['density_consampwt'];
*/			
			
			/*$csqirdsgm=($rowdensitydata*($cspotblaptap/100));
$csqirdsgm=number_format((float)$csqirdsgm, 14);
			$cspicds=(($csqirdsgm/$condensitydata)*100);
$cspicds=number_format((float)$cspicds, 14);
			$rpirds=(100-$cspicds);
			$rqitsl_apsrp=($arrqty*($rpirds/100));
$rqitsl_apsrp=number_format((float)$rqitsl_apsrp, 14);*/

		$csqirdsgm=($rowdensitydata*($cspotblaptap/100));
$csqirdsgm=number_format((float)$csqirdsgm, 14);
//echo $csqirdsgm." / ".$condensitydata."  =  ";
 		$cspicds=(($csqirdsgm/$condensitydata)*100); 
$cspicds=number_format((float)$cspicds, 14);
		$rpirds=(100-$cspicds);
		$rqitsl_apsrp=($arrqty*($rpirds/100));
 $rqitsl_apsrp=number_format((float)$rqitsl_apsrp, 14);
			$tot_rqitsl_apsrp=$tot_rqitsl_apsrp+$rqitsl_apsrp;
		}
	}	
}

$correction_factor=($tot_loss/$tot_rqitsl_apsrp);

//echo $tot_rawqty." = ".$tot_conqty."  =  ".$tot_rqitsl_apsrp;

$sql_rr22=mysqli_query($link,"select * from tbl_blends where blends_orlot='$olotno'  order by blends_orlot asc") or die(mysqli_error($link));
$tot_rr22=mysqli_num_rows($sql_rr22);
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="960" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Dark" height="20">
  <td colspan="6" align="center" class="tblheading">Density Data Update</td>
</tr>
</table>
<div style="overflow:scroll; height:300px; width:974px;">
<table width="2000" align="center" border="1" cellspacing="0" cellpadding="0" bordercolor="#d21704" id="example" >
<thead >
<tr class="tblsubtitle" height="20">
	<td width="2%" align="center" valign="middle" class="smalltblheading" >#</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading" >Arrival Date</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Processing Date</td>
	<td width="7%" align="center" valign="middle" class="smalltblheading" >Crop</td>
	<td width="8%" align="center" valign="middle" class="smalltblheading" >Variety</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading" >SP Codes</td>
	<td align="center" valign="middle" class="smalltblheading" >Lot No.</td>
	<td width="3%" align="center" valign="middle" class="smalltblheading" >Arrival Qty</td>
	<td width="3%" align="center" valign="middle" class="smalltblheading" >Raw Seed Qty</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Condition Seed Qty</td>
	<td align="center" valign="middle" class="smalltblheading"  >Condition Loss</td>
	<td align="center" valign="middle" class="smalltblheading"  >Condition Loss %</td>
	<td align="center" valign="middle" class="smalltblheading" >Blended Lot No.</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading" >Density - Raw</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading" >Density - Condition</td>
	<td align="center" valign="middle" class="smalltblheading"  >Conditioned  Seed  % of  the blend lot as per the actual processing</td>
	<td align="center" valign="middle" class="smalltblheading"  >Conditioned  seed Qty  in Raw Density sample (gm)</td>
	<td width="4%" align="center" valign="middle" class="smalltblheading" >Conditioned Seed % in condition Density sample</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading" >Remnant  % in Raw density sample </td>
	<td width="5%" align="center" valign="middle" class="smalltblheading" >Remnant  qty in the seed lot (as per sample remnant %)</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading" >Correction Factor</td>
	<td width="5%"  align="center" valign="middle" class="smalltblheading" >Remnant qty in the lot (kg)</td>
	<td width="5%" align="center" valign="middle" class="smalltblheading" >Remmamt  % in the lot</td>
</tr>
	
 </thead>
 <tbody>
<?php

$srno=1; $lotno=""; $enob=""; $eqty=""; $pnob=""; $pqty=""; $rmqty1=""; $rmper1=""; $imqty1=""; $imper1=""; $plqty1=""; $plper1=""; $tplqty=""; $tplper=""; $pmc=""; $psn=""; $treats=""; $oprname="";
$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
if($tot_rr22 > 0)
{
while($row_rr22=mysqli_fetch_array($sql_rr22))
{
	$arrqty=0; $pqty=0; $cqty=0; $totloss=''; $totlossper=''; $totlossper2=''; $loss=''; $lossper=''; $conqty=0; $cspotblaptap=''; $rowdensitydata=''; $condensitydata=''; $csqirdsgm=''; $cspicds=''; $rpirds=''; $rqitsl_apsrp='';
	
	$sql_blendmain=mysqli_query($link,"select * from tbl_blendm where blendm_id='".$row_rr22['blendm_id']."' ") or die(mysqli_error($link));
	$row_blendmain=mysqli_fetch_array($sql_blendmain);
	
	$arrqty=$row_rr22['blends_qty'];
	
	$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_blendmain['blendm_crop']."'") or die(mysqli_error($link));
	$row31=mysqli_fetch_array($sql_crop);
	$cropname=$row31['cropname'];	
		
	$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_blendmain['blendm_variety']."' ") or die(mysqli_error($link));
	$ttt=mysqli_num_rows($sql_variety);
	if($ttt > 0)
	{
		$rowvv=mysqli_fetch_array($sql_variety);
		$varietyname=$rowvv['popularname'];
	}
	else
	{
		$varietyname=$row_blendmain['blendm_variety'];
	}
	

	$lotno=$row_rr22['blends_lotno'];
	$blendlotno=$row_rr22['blends_newlot'];
	
	$oltn=str_split($lotno);
	$oltn2=str_split($blendlotno);
	$oldlotnm=$oltn[1].$oltn[2].$oltn[3].$oltn[4].$oltn[5].$oltn[6];
	$oldnm2=$oltn2[0].$oltn2[1].$oltn2[2].$oltn2[3].$oltn2[4].$oltn2[5].$oltn2[6];
	
	if($oltn[16]=="R")
	{
		$sql_arrsub=mysqli_query($link,"select * from tblarrival_sub where old='".$oldlotnm."'") or die(mysqli_error($link));
		$row_arrsub=mysqli_fetch_array($sql_arrsub);
		
		$spcf=$row_arrsub['spcodef'];
		$spcm=$row_arrsub['spcodem'];
		$spcodes=$spcf." x ".$spcm;
		
		
		
		
		
		$hardate=$row_arrsub['harvestdate'];
		$hardtyear=substr($hardate,0,4);
		$hardtmonth=substr($hardate,5,2);
		$hardtday=substr($hardate,8,2);
		$harvestdate=$hardtday."-".$hardtmonth."-".$hardtyear;
		if($harvestdate=="0000-00-00"){$harvestdate='';}
		
		$sql_arrmain=mysqli_query($link,"select * from tblarrival where arrival_id='".$row_arrsub['arrival_id']."'") or die(mysqli_error($link));
		$row_arrmain=mysqli_fetch_array($sql_arrmain);
		
		$arrdate=$row_arrmain['arrival_date'];
		$arrdtyear=substr($arrdate,0,4);
		$arrdtmonth=substr($arrdate,5,2);
		$arrdtday=substr($arrdate,8,2);
		$arrivaldate=$arrdtday."-".$arrdtmonth."-".$arrdtyear;
		if($arrivaldate=="0000-00-00"){$arrivaldate='';}
		
		
		$sql_prosub=mysqli_query($link,"SELECT * FROM tbl_proslipsub where proslipsub_lotno='".$blendlotno."' order by proslipsub_id Asc")or die(mysqli_error($link)); 
		$row_prosub = mysqli_fetch_array($sql_prosub);
		
		$pro_id=0;
		$sql_promain=mysqli_query($link,"SELECT * FROM tbl_proslipmain where proslipmain_id='".$row_prosub['proslipmain_id']."' order by proslipmain_id Asc")or die(mysqli_error($link)); 
		$row_promain = mysqli_fetch_array($sql_promain);
		
		$pro_id=$row_promain['proslipmain_id'];
		$prdate=$row_promain['proslipmain_date'];
		$tryear=substr($prdate,0,4);
		$trmonth=substr($prdate,5,2);
		$trday=substr($prdate,8,2);
		$prodate=$trday."-".$trmonth."-".$tryear;
		
		$pqty=$tot_rawqty;
		$cqty=$tot_conqty;
		$totloss=$row_prosub['proslipsub_tlqty'];
		
		
		
		$totlossper=($totloss/$pqty)*100;
		$totlossper2=($totloss/$pqty);
		
		/*$loss=($arrqty*$totlossper2);
		$lossper=(($loss/$arrqty)*100);
		$conqty=($arrqty-$loss);*/
		//$tot_loss=$tot_loss+$loss;
		
		$cspotblaptap=(($cqty/$pqty)*100);
		$cspotblaptap=number_format((float)$cspotblaptap, 14);

		$sql_lotldg=mysqli_query($link,"SELECT * FROM tbl_lot_ldg where lotldg_trid='".$row_prosub['proslipmain_id']."' AND `lotldg_trtype`='PROSLIPSUC' AND SUBSTRING(orlot, 1, 7)='".$oldnm2."' ")or die(mysqli_error($link)); 
		$row_lotldg = mysqli_fetch_array($sql_lotldg);
		
		$conlotn=$row_lotldg['lotldg_lotno'];
		
		$sql_densitydata=mysqli_query($link,"SELECT * FROM tbl_densitydata where density_lotno='".$lotno."' ")or die(mysqli_error($link)); 
		$row_densitydata = mysqli_fetch_array($sql_densitydata);
		$rowdensitydata=$row_densitydata['density_rawsampwt'];
		
		$sql_dendatac=mysqli_query($link,"SELECT * FROM tbl_densitydata where density_clotno='".$conlotn."' ")or die(mysqli_error($link)); 
		$row_dendatac = mysqli_fetch_array($sql_dendatac);
		$condensitydata=$row_dendatac['density_consampwt'];
		
		
		$csqirdsgm=($rowdensitydata*($cspotblaptap/100));
$csqirdsgm=number_format((float)$csqirdsgm, 14);
		$cspicds=(($csqirdsgm/$condensitydata)*100);
$cspicds=number_format((float)$cspicds, 14);
		$rpirds=(100-$cspicds);
		$rqitsl_apsrp=($arrqty*($rpirds/100));
$rqitsl_apsrp=number_format((float)$rqitsl_apsrp, 14);
		//$tot_rqitsl_apsrp=$tot_rqitsl_apsrp+$rqitsl_apsrp;
		
		
		
		$rqitlkg=($correction_factor*$rqitsl_apsrp);
		$rpitl=(($rqitlkg/$arrqty)*100);

		
		$loss=$rqitlkg;
		$lossper=$rpitl;
		$conqty=($arrqty-$loss);
	

if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $arrivaldate;?><input type="hidden" name="arrivaldate<?php echo $srno;?>" id="arrivaldate_<?php echo $srno;?>" value="<?php echo $arrivaldate;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $prodate;?><input type="hidden" name="prodate<?php echo $srno;?>" id="prodate_<?php echo $srno;?>" value="<?php echo $prodate;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cropname?><input type="hidden" name="cropname<?php echo $srno;?>" id="cropname_<?php echo $srno;?>" value="<?php echo $cropname;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietyname?><input type="hidden" name="varietyname<?php echo $srno;?>" id="varietyname_<?php echo $srno;?>" value="<?php echo $varietyname;?>"  /></td>
	<td width="9%" align="center" valign="middle" class="smalltbltext"><?php echo $spcodes?><input type="hidden" name="spcodes<?php echo $srno;?>" id="spcodes_<?php echo $srno;?>" value="<?php echo $spcodes;?>"  /></td>
	<td width="3%" align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?><input type="hidden" name="lotno<?php echo $srno;?>" id="lotno_<?php echo $srno;?>" value="<?php echo $lotno;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $arrqty;?><input type="hidden" name="arrqty<?php echo $srno;?>" id="arrqty_<?php echo $srno;?>" value="<?php echo $arrqty;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $arrqty;?><input type="hidden" name="pqty<?php echo $srno;?>" id="pqty_<?php echo $srno;?>" value="<?php echo $arrqty;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $conqty?><input type="hidden" name="conqty<?php echo $srno;?>" id="conqty_<?php echo $srno;?>" value="<?php echo $conqty;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $loss?><input type="hidden" name="loss<?php echo $srno;?>" id="loss_<?php echo $srno;?>" value="<?php echo $loss;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lossper?><input type="hidden" name="lossper<?php echo $srno;?>" id="lossper_<?php echo $srno;?>" value="<?php echo $lossper;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blendlotno;?><input type="hidden" name="blendlotno<?php echo $srno;?>" id="blendlotno_<?php echo $srno;?>" value="<?php echo $blendlotno;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rowdensitydata;?><input type="hidden" name="rowdensitydata<?php echo $srno;?>" id="rowdensitydata_<?php echo $srno;?>" value="<?php echo $rowdensitydata;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $condensitydata;?><input type="hidden" name="condensitydata<?php echo $srno;?>" id="condensitydata_<?php echo $srno;?>" value="<?php echo $condensitydata;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cspotblaptap?><input type="hidden" name="cspotblaptap<?php echo $srno;?>" id="cspotblaptap_<?php echo $srno;?>" value="<?php echo $cspotblaptap;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $csqirdsgm?><input type="hidden" name="csqirdsgm<?php echo $srno;?>" id="csqirdsgm_<?php echo $srno;?>" value="<?php echo $csqirdsgm;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cspicds;?><input type="hidden" name="cspicds<?php echo $srno;?>" id="cspicds_<?php echo $srno;?>" value="<?php echo $cspicds;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rpirds;?><input type="hidden" name="rpirds<?php echo $srno;?>" id="rpirds_<?php echo $srno;?>" value="<?php echo $rpirds;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rqitsl_apsrp;?><input type="hidden" name="rqitsl_apsrp<?php echo $srno;?>" id="rqitsl_apsrp_<?php echo $srno;?>" value="<?php echo $rqitsl_apsrp;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $correction_factor;?><input type="hidden" name="correction_factor<?php echo $srno;?>" id="correction_factor_<?php echo $srno;?>" value="<?php echo $correction_factor;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rqitlkg;?><input type="hidden" name="rqitlkg<?php echo $srno;?>" id="rqitlkg_<?php echo $srno;?>" value="<?php echo $rqitlkg;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rpitl;?><input type="hidden" name="rpitl<?php echo $srno;?>" id="rpitl_<?php echo $srno;?>" value="<?php echo $rpitl;?>"  /></td>
	
</tr>
<?php
}
else
{
?>
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $arrivaldate;?><input type="hidden" name="arrivaldate<?php echo $srno;?>" id="arrivaldate_<?php echo $srno;?>" value="<?php echo $arrivaldate;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $prodate;?><input type="hidden" name="prodate<?php echo $srno;?>" id="prodate_<?php echo $srno;?>" value="<?php echo $prodate;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cropname?><input type="hidden" name="cropname<?php echo $srno;?>" id="cropname_<?php echo $srno;?>" value="<?php echo $cropname;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $varietyname?><input type="hidden" name="varietyname<?php echo $srno;?>" id="varietyname_<?php echo $srno;?>" value="<?php echo $varietyname;?>"  /></td>
	<td width="9%" align="center" valign="middle" class="smalltbltext"><?php echo $spcodes?><input type="hidden" name="spcodes<?php echo $srno;?>" id="spcodes_<?php echo $srno;?>" value="<?php echo $spcodes;?>"  /></td>
	<td width="3%" align="center" valign="middle" class="smalltbltext"><?php echo $lotno;?><input type="hidden" name="lotno<?php echo $srno;?>" id="lotno_<?php echo $srno;?>" value="<?php echo $lotno;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $arrqty;?><input type="hidden" name="arrqty<?php echo $srno;?>" id="arrqty_<?php echo $srno;?>" value="<?php echo $arrqty;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $arrqty;?><input type="hidden" name="pqty<?php echo $srno;?>" id="pqty_<?php echo $srno;?>" value="<?php echo $arrqty;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $conqty?><input type="hidden" name="conqty<?php echo $srno;?>" id="conqty_<?php echo $srno;?>" value="<?php echo $conqty;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $loss?><input type="hidden" name="loss<?php echo $srno;?>" id="loss_<?php echo $srno;?>" value="<?php echo $loss;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lossper?><input type="hidden" name="lossper<?php echo $srno;?>" id="lossper_<?php echo $srno;?>" value="<?php echo $lossper;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $blendlotno;?><input type="hidden" name="blendlotno<?php echo $srno;?>" id="blendlotno_<?php echo $srno;?>" value="<?php echo $blendlotno;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rowdensitydata;?><input type="hidden" name="rowdensitydata<?php echo $srno;?>" id="rowdensitydata_<?php echo $srno;?>" value="<?php echo $rowdensitydata;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $condensitydata;?><input type="hidden" name="condensitydata<?php echo $srno;?>" id="condensitydata_<?php echo $srno;?>" value="<?php echo $condensitydata;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cspotblaptap?><input type="hidden" name="cspotblaptap<?php echo $srno;?>" id="cspotblaptap_<?php echo $srno;?>" value="<?php echo $cspotblaptap;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $csqirdsgm?><input type="hidden" name="csqirdsgm<?php echo $srno;?>" id="csqirdsgm_<?php echo $srno;?>" value="<?php echo $csqirdsgm;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $cspicds;?><input type="hidden" name="cspicds<?php echo $srno;?>" id="cspicds_<?php echo $srno;?>" value="<?php echo $cspicds;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rpirds;?><input type="hidden" name="rpirds<?php echo $srno;?>" id="rpirds_<?php echo $srno;?>" value="<?php echo $rpirds;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rqitsl_apsrp;?><input type="hidden" name="rqitsl_apsrp<?php echo $srno;?>" id="rqitsl_apsrp_<?php echo $srno;?>" value="<?php echo $rqitsl_apsrp;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $correction_factor;?><input type="hidden" name="correction_factor<?php echo $srno;?>" id="correction_factor_<?php echo $srno;?>" value="<?php echo $correction_factor;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rqitlkg;?><input type="hidden" name="rqitlkg<?php echo $srno;?>" id="rqitlkg_<?php echo $srno;?>" value="<?php echo $rqitlkg;?>"  /></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rpitl;?><input type="hidden" name="rpitl<?php echo $srno;?>" id="rpitl_<?php echo $srno;?>" value="<?php echo $rpitl;?>"  /></td>
	

</tr>

<?php
}
$srno=$srno+1;
}
}
}
//}
//}

//}


?>
<input name="srno" type="hidden" value="<?php echo $srno;?>" />
</tbody>	  	
</table>
</div>	

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_density.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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
<script>
$(document).ready(function() {
var table = $('#example').DataTable( {
scrollY:        "300px",
scrollX:        true,
scrollCollapse: true,
paging:         false,
		searching: false,
ordering:  false,
fixedColumns:   {
left: 5
}
} );
} );
</script>
</body>
</html>

  
