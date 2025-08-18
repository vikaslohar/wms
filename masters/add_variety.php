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
	
	if(isset($_REQUEST['varietyid']))
	{
	 $id = $_REQUEST['varietyid'];
	}
	if(isset($_REQUEST['cropid']))
	{
	 $cid = $_REQUEST['cropid'];
	}
	if(isset($_REQUEST['page']))
	{
	 $pageid = $_REQUEST['page'];
	}
	
	 if(isset($_POST['frm_action'])=='submit')
	{
		$trtyp=trim($_POST['trtyp']);
		$cropname=trim($_POST['crop']);
		$vname=trim($_POST['vname']);
		$opt=trim($_POST['txtopt']);
		$type=trim($_POST['txtvt']);
		$gm=trim($_POST['flagcode']);
		$wb=trim($_POST['code1']);
		$nop=trim($_POST['code2']);
	 	$wtwb=trim($_POST['code3']);
	 	$mp=trim($_POST['code4']);
		$mpytype=trim($_POST['code5']);
	 	$wtmp=trim($_POST['code6']);
		$nowb=trim($_POST['code7']);
		$mptnop=trim($_POST['code8']);
		$txtdsp=trim($_POST['txtdsp']);
		$expdtg=trim($_POST['expdtg']);
		$expdtt=trim($_POST['expdtt']);
		$moilars=trim($_POST['moilars']);
		$txtdordurtion=trim($_POST['txtdordurtion']);
		$txttwtpgmsf=trim($_POST['txttwtpgmsf']);
		$txttwtpgmst=trim($_POST['txttwtpgmst']);
		$txtstduration=trim($_POST['txtstduration']);
		$actsts=trim($_POST['actsts']);
		$txtppt=trim($_POST['txtppt']);
		$vertyp="PV";
		$txtleduration=trim($_POST['txtleduration']);
		$ytcstatus=trim($_POST['ytcstatus']);
		
		
		$query=mysqli_query($link,"SELECT * FROM tblcrop where cropid='$cropname'") or die("Error: " . mysqli_error($link));
		$row=mysqli_fetch_array($query);
		$cname=$row['cropname'];
		$query=mysqli_query($link,"SELECT * FROM tblvariety where popularname='$vname' and actstatus='Active'") or die("Error: " . mysqli_error($link));
		//exit;
   		$numofrecords=mysqli_num_rows($query);
	 	 if( $numofrecords > 0)
		 {?>
		 <script>
		  alert("This Variety is Already Present.");
		  </script>
		 <?php }
		 else 
		 {
			$sql_in="insert into tblvariety(cropname, cropid, popularname, opt, vt, gm, wbtype, wtnop, wtnopkg, mtyp, mtype, wtmp, nowb,gsdis, expdt, moinlors, mptnop, expdtt, dorduration, stlduration, twgptsf, twgptst, actstatus, ppt, vertype, leduration, ytcstatus) values('$cropname', '$cname',  '$vname', '$opt', '$type', '$gm', '$wb', '$nop', '$wtwb', '$mp', '$mpytype', '$wtmp', '$nowb','$txtdsp', '$expdtg', '$moilars', '$mptnop', '$expdtt', '$txtdordurtion', '$txtstduration', '$txttwtpgmsf', '$txttwtpgmst', '$actsts', '$txtppt', '$vertyp', '$txtleduration', '$ytcstatus')";
			if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
			{
				$id=mysqli_insert_id($link);
				$sqlin="update tblvariety set pvverid='$id' where varietyid='$id' and actstatus='Active'";
				mysqli_query($link,$sqlin)or die(mysqli_error($link));
				
				if($trtyp==0)
				echo "<script>window.location='home_variety.php?page=$pageid'</script>";
				else
				echo "<script>window.location='add_cvvariety.php?page=$pageid&varietyid=$id'</script>";	
			}
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<script type="text/javascript" src="../include/validation.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Administration- Variety Master - Add Variety Master</title>
<link href="../include/main_adm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
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
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode
	if (charCode > 31 && (charCode < 46 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
	return false;
	
	return true;
}

/*function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
	return false;
	
	return true;
}*/


function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }

function clk(val12)
{
	//alert(val12);
	//var aa='fetchk_'+[val12];
	if (document.form1.crop.value=="") 
	{
		alert ("Please Select Crop Name");
		document.getElementById('fetchk_'+[val12]).checked=false;
		document.form1.crop.focus();
		return false;
	}
	if(document.form1.crop.value.charCodeAt() == 32)
	{
		alert("Crop Name Should Not Start With Space!");
		document.form1.crop.focus();
		return false;
	} 
	if(document.form1.vname.value=="")
	{
		alert("Please Enter Variety Name ");
		document.form1.vname.focus();
		return false;
	}
	if(document.form1.vname.value.charCodeAt() == 32)
	{
		alert("Variety Name cannot start with space.");
		document.form1.vname.focus();
		return false;
	}
	
	if(document.form1.txtvt.value=="")
	{
		alert("Please Selcet Variety Type ");
		document.form1.txtvt.focus();
		return false;
	}
	if (document.form1.txtopt.value=="") 
	{
		alert ("Please Select GOT At Arrival");
		document.form1.txtopt.focus();
		return false;
	}
	if (document.form1.txtdsp.value=="") 
	{
		alert ("Please Select GS Sample Keeping Duration");
		document.form1.txtdsp.focus();
		return false;
	}
	if (document.form1.txtdordurtion.value=="") 
	{
		alert ("Please enter Dormancy Duration");
		document.form1.txtdordurtion.focus();
		return false;
	}
	if (document.form1.expdtg.value=="") 
	{
		alert("Invalid Expected Days of QC Results");
		document.form1.expdtg.focus();
		return false;
	}
	if (document.form1.expdtg.value<=0) 
	{
		alert("Invalid Expected Days of QC Results");
		document.form1.expdtg.focus();
		return false;
	}
	if (document.form1.expdtt.value=="") 
	{
		alert("Invalid Expected Days of GOT Results");
		document.form1.expdtt.focus();
		return false;
	}
	if (document.form1.expdtt.value<=0) 
	{
		alert("Invalid Expected Days of GOT Results");
		document.form1.expdtt.focus();
		return false;
	}
	if (document.form1.txttwtpgmsf.value=="") 
	{
		alert("Invalid Test Weight Gms per 1000 Seed");
		document.form1.txttwtpgmsf.focus();
		return false;
	}
	if (document.form1.txttwtpgmsf.value<=0) 
	{
		alert("Invalid Test Weight Gms per 1000 Seed");
		document.form1.txttwtpgmsf.focus();
		return false;
	}
	if (document.form1.txttwtpgmst.value=="") 
	{
		alert("Invalid Test Weight Gms per 1000 Seed");
		document.form1.txttwtpgmst.focus();
		return false;
	}
	if (document.form1.txttwtpgmst.value<=0) 
	{
		alert("Invalid Test Weight Gms per 1000 Seed");
		document.form1.txttwtpgmst.focus();
		return false;
	}
	if (document.form1.txtstduration.value=="") 
	{
		alert("Invalid Settlement Duration");
		document.form1.txtstduration.focus();
		return false;
	}  
	if(document.getElementById('fetchk_'+[val12]).checked == true)
	{
		//var val12; 
		document.getElementById('itm_'+[val12]).disabled=false;
		document.getElementById('ppt_'+[val12]).disabled=false;
		document.getElementById('id3_'+[val12]).disabled=false;
	
	}
	else
	{
		document.getElementById('itm_'+[val12]).selectedIndex=0;
		document.getElementById('ppt_'+[val12]).selectedIndex=0;
		document.getElementById('id2_'+[val12]).selectedIndex=0;
		document.getElementById('id3_'+[val12]).selectedIndex=0;
		document.getElementById('id3_'+[val12]).disabled=true;
		document.getElementById('ppt_'+[val12]).disabled=true;
		document.getElementById('itm_'+[val12]).disabled=true;
		document.getElementById('id2_'+[val12]).disabled=true;
		document.getElementById('id5_'+[val12]).value="";
		document.getElementById('id4_'+[val12]).selectedIndex=0;
		document.getElementById('id4_'+[val12]).disabled=true;
		document.getElementById('id6_'+[val12]).value="";
		document.getElementById('id7_'+[val12]).value="";
		document.getElementById('id6_'+[val12]).style.backgroundColor="#cccccc";
	}

}
function clk0(va12 , val11)
{
	if(val11=="Bag")
	{
		document.getElementById('id3_'+[va12]).disabled=true;
		document.getElementById('id3_'+[va12]).value=="No"
		document.getElementById('itm_'+[va12]).selectedIndex=2;
		document.getElementById('id3_'+[va12]).selectedIndex=2;
		document.getElementById('itm_'+[va12]).disabled=true;
		document.getElementById('itm_'+[va12]).value=="No"
	}
}

function clk1(va12 , val11)
{
	//alert(va12);
	//alert(document.getElementById('itm_'+[va12]).value);	  
	if(document.getElementById('itm_'+[va12]).value=="Yes")
	{
		document.getElementById('id2_'+[va12]).disabled=false;
	}
	else
	{
		document.getElementById('id2_'+[va12]).disabled=true;
		document.getElementById('itm_'+[va12]).value==""
		document.getElementById('id5_'+[va12]).value="";
		document.getElementById('id7_'+[va12]).value="";
		//document.getElementById('itm_'+[va12]).selectedIndex=0;
		document.getElementById('id2_'+[va12]).selectedIndex=0;
	}

}

function clk2(va12 , up, uo)
{
	//alert(document.getElementById('id2_'+[va12]).value);
	if(document.getElementById('id2_'+[va12]).value!="")
	{
		document.getElementById('id5_'+[va12]).value=uo*parseFloat(up);
		document.getElementById('id2_'+[va12]).disabled=false;
	}
	else
	{
		document.getElementById('id2_'+[va12]).disabled=true;
	}
}

function clk3(va3 , va33)
{
	if(document.getElementById('id3_'+[va3]).value=="Yes")
	{
		document.getElementById('id4_'+[va3]).disabled=false;
		document.getElementById('id6_'+[va3]).style.backgroundColor="#ffffff";
	}
	else
	{
		//document.getElementById('id3_'+[va3]).selectedIndex=0;
		document.getElementById('id4_'+[va3]).selectedIndex=0;
		//document.getElementById('id3_'+[va3]).disabled=true;
		document.getElementById('id4_'+[va3]).disabled=true;
		document.getElementById('id6_'+[va3]).value="";
		document.getElementById('id7_'+[va3]).value="";
		document.getElementById('id6_'+[va3]).style.backgroundColor="#cccccc";
	}
}

function clk4(va12 , up, uo)
{
	//alert(document.getElementById('id2_'+[va12]).value);
	if(document.getElementById('id2_'+[va12]).value=="uo")
	{
		document.getElementById('id6_'+[va12]).disabled=true;
	}
	else
	{
		document.getElementById('id6_'+[va12]).disabled=false;
	}
}
function calc(va133, up1, uo1)
{
	if(uo1>0 && uo1<=99.999)
	{
		var flg=0;
		var valwb=document.getElementById('id5_'+[va133]).value;
		var nop2=parseFloat(uo1)/parseFloat(valwb);
		var nzzz=Math.round(nop2*100)/100;
		//alert(nzzz);
		var zz=nzzz+'';
		var zzz=zz.split(".");
		if(zzz[1] > 0)
		{
			alert("Enter Valid Wt. in Master Pack.\nNoWB can not be fractional")
			document.getElementById('id6_'+[va133]).value="";
			flg=1;
			return false;
		}
		
		var n=up1*1000;
		var nop=parseFloat(uo1)*parseFloat(1000/n);
		var nzzz=Math.round(nop*100)/100;
		var zz=nzzz+'';
		var zzz=zz.split(".");
		if(zzz[1] > 0)
		{
			alert("Enter Valid Wt. in Master Pack.\nPouch can not be fractional")
			document.getElementById('id6_'+[va133]).value="";
			flg=1;
			return false;
		}
		
		if(flg==0 && document.getElementById('id5_'+[va133]).value!="")
		{
			 document.getElementById('id7_'+[va133]).value=Math.round((parseFloat(uo1)/parseFloat(valwb))*100)/100;
		}
		document.getElementById('mptnop_'+[va133]).value=nop;
	}
	else
	{
		alert("Wt. in Master Pack cannot be Zero(0) or less and cannot be more than 99.999");
		document.getElementById('id6_'+[va133]).value="";
		document.getElementById('mptnop_'+[va133]).value="";
		return false;
	}
}
function onloadfocus()
{
	document.form1.crop.focus();
}
 
function f1(val)
{
	if(document.form1.crop.value=="")
	{
		alert("select Crop Name");
		document.form1.vname.value="";
		document.form1.crop.focus();
		return false;
	}
}

function chkpvr(val)
{
	if(document.form1.vname.value=="")
	{
		alert("Add Variety Name");
		document.form1.txtvt.value="";
		document.form1.txtvt.selectedIndex=0;
		document.form1.vname.focus();
		return false;
	}
}

function chkvtyp(val)
{
	if(document.form1.txtvt.value=="")
	{
		alert("Select Variety Type");
		document.form1.txtopt.value="";
		document.form1.txtopt.selectedIndex=0;
		document.form1.txtvt.focus();
		return false;
	}
}

function chkgotarr(val)
{
	if(document.form1.txtopt.value=="")
	{
		alert("Select Set Auto GOT at Arrival");
		document.form1.txtdsp.value="";
		document.form1.txtdsp.selectedIndex=0;
		document.form1.txtopt.focus();
		return false;
	}
}

function expdtqc(expval)
{
	if(document.form1.txtdsp.value=="") 
	{
		alert ("Please Select GS Sample Keeping Duration");
		document.form1.txtdsp.focus();
		document.form1.txtdordurtion.value="";
		return false;
	}
	if(expval <0 || expval >999)
	{
		alert("Invalid Dormancy Duration");
		document.form1.txtdordurtion.value="";
		return false;
	}
}	

function gsrpchk(expval)	
{
	if(document.form1.txtdordurtion.value=="") 
	{
		alert ("Please Select GS Sample Keeping Duration");
		document.form1.txtdordurtion.focus();
		document.form1.expdtg.value="";
		return false;
	}
	if(expval <=0 || expval >999)
	{
		alert("Invalid Expected Date of QC Results");
		document.form1.expdtg.value="";
		return false;
	}
}

function ddperiod(expval)
{
	if(document.form1.expdtg.value=="") 
	{
		alert ("Please enter Expected Days of QC Results");
		document.form1.expdtg.focus();
		document.form1.expdtt.value="";
		return false;
	}
	if(expval <=0 || expval >999)
	{
		alert("Invalid Expected Days of GOT Results");
		document.form1.expdtt.value="";
		return false;
	}
}

function expdtchk(expval)
{
	if(document.form1.expdtt.value=="") 
	{
		alert ("Please enter Expected Days of GOT Results");
		document.form1.expdtt.focus();
		document.form1.txttwtpgmsf.value="";
		return false;
	}
}

function exptwtgfchk(expval)
{
	if(document.form1.txttwtpgmsf.value=="") 
	{
		alert ("Please enter Test Weight Gms per 1000 Seed");
		document.form1.txttwtpgmsf.focus();
		document.form1.txttwtpgmst.value="";
		return false;
	}
	if(document.form1.txttwtpgmsf.value>document.form1.txttwtpgmst.value) 
	{
		alert ("Please enter Valid Test Weight Gms per 1000 Seed");
		document.form1.txttwtpgmsf.focus();
		document.form1.txttwtpgmst.value="";
		return false;
	}
}

function twgpschk(expval)
{
	if(document.form1.txttwtpgmst.value=="") 
	{
		alert ("Please enter Test Weight Gms per 1000 Seed");
		document.form1.txttwtpgmst.focus();
		document.form1.txtstduration.value="";
		return false;
	}
	if(document.form1.txttwtpgmsf.value>document.form1.txttwtpgmst.value) 
	{
		alert ("Please enter Valid Test Weight Gms per 1000 Seed");
		document.form1.txttwtpgmst.focus();
		document.form1.txtstduration.value="";
		return false;
	}
}

function mySubmit(val)
{
	document.form1.trtyp.value=val;
	document.form1.flagcode.value = "";
	var z=document.form1.vname.value;
	var x=z.substr(1);
	var y=document.form1.vname.value.charAt(0);
	var zz=y.toUpperCase();
	document.form1.vname.value=zz+x;
	//return false;
	if (document.form1.crop.value=="") 
	{
		alert ("Please Select Crop Name");
		document.form1.crop.focus();
		return false;
	}
	if(document.form1.crop.value.charCodeAt() == 32)
	{
		alert("Crop Name Should Not Start With Space!");
		document.form1.crop.focus();
		return false;
	} 
	if(document.form1.vname.value=="")
	{
		alert("Please Enter Variety Name ");
		document.form1.vname.focus();
		return false;
	}
	if(document.form1.vname.value.charCodeAt() == 32)
	{
		alert("Variety Name cannot start with space.");
		document.form1.vname.focus();
		return false;
	}
	
	if(document.form1.txtvt.value=="")
	{
		alert("Please Selcet Variety Type ");
		document.form1.txtvt.focus();
		return false;
	}

	if (document.form1.txtopt.value=="") 
	{
		alert ("Please Select GOT At Arrival");
		document.form1.txtopt.focus();
		return false;
	}
	if (document.form1.txtdsp.value=="") 
	{
		alert ("Please Select GS Sample Keeping Duration");
		document.form1.txtdsp.focus();
		return false;
	}
	if (document.form1.txtdordurtion.value=="") 
	{
		alert ("Please enter Dormancy Duration");
		document.form1.txtdordurtion.focus();
		return false;
	}
	if (document.form1.expdtg.value=="") 
	{
		alert("Invalid Expected Days of QC Results");
		document.form1.expdtg.focus();
		return false;
	}
	if (document.form1.expdtg.value<=0) 
	{
		alert("Invalid Expected Days of QC Results");
		document.form1.expdtg.focus();
		return false;
	}
	if (document.form1.expdtt.value=="") 
	{
		alert("Invalid Expected Days of GOT Results");
		document.form1.expdtt.focus();
		return false;
	}
	if (document.form1.expdtt.value<=0) 
	{
		alert("Invalid Expected Days of GOT Results");
		document.form1.expdtt.focus();
		return false;
	}
	if (document.form1.txttwtpgmsf.value=="") 
	{
		alert("Invalid Test Weight Gms per 1000 Seed");
		document.form1.txttwtpgmsf.focus();
		return false;
	}
	if (document.form1.txttwtpgmsf.value<=0) 
	{
		alert("Invalid Test Weight Gms per 1000 Seed");
		document.form1.txttwtpgmsf.focus();
		return false;
	}
	if (document.form1.txttwtpgmst.value=="") 
	{
		alert("Invalid Test Weight Gms per 1000 Seed");
		document.form1.txttwtpgmst.focus();
		return false;
	}
	if (document.form1.txttwtpgmst.value<=0) 
	{
		alert("Invalid Test Weight Gms per 1000 Seed");
		document.form1.txttwtpgmst.focus();
		return false;
	}
	if (document.form1.txtstduration.value=="") 
	{
		alert("Invalid Settlement Duration");
		document.form1.txtstduration.focus();
		return false;
	}
	var cnt1=0;cnt2=0;cnt3=0;cnt4=0;cnt5=0;
	for (var i = 0; i < document.form1.fet.length; i++) 
	{          
		//alert(i);	 
		if(document.form1.fet[i].checked == true)
		{
			if(document.form1.flagcode.value =="")
			{
				document.form1.flagcode.value=document.form1.fet[i].value;
			}
			else
			{
				document.form1.flagcode.value = document.form1.flagcode.value +','+document.form1.fet[i].value;
			}
					
			if(document.form1.txtwb[i].value=="")cnt1++;
					
			if(document.form1.code1.value =="")
			{
				document.form1.code1.value=document.form1.txtwb[i].value;
			}
			else
			{
				document.form1.code1.value = document.form1.code1.value +','+document.form1.txtwb[i].value;
			}
					
			if(document.form1.txtwb[i].value=="Yes" && document.form1.txtnop[i].value=="")cnt2++;
					
			if(document.form1.code2.value =="")
			{
				document.form1.code2.value=document.form1.txtnop[i].value;
			}
			else
			{
				document.form1.code2.value = document.form1.code2.value +','+document.form1.txtnop[i].value;
			}
				
			if(document.form1.code3.value =="")
			{
				document.form1.code3.value=document.form1.txtwb1[i].value;
			}
			else
			{
				document.form1.code3.value = document.form1.code3.value +','+document.form1.txtwb1[i].value;
			}
				
				
			if(document.form1.txtmp[i].value=="")cnt3++;
				
			if(document.form1.code4.value =="")
			{
				document.form1.code4.value=document.form1.txtmp[i].value;
			}
			else
			{
				document.form1.code4.value = document.form1.code4.value +','+document.form1.txtmp[i].value;
			}
					
			if(document.form1.txtmp[i].value=="Yes" && document.form1.txtmpt[i].value=="")cnt4++;
					
			if(document.form1.code5.value =="")
			{
				document.form1.code5.value=document.form1.txtmpt[i].value;
			}
			else
			{
				document.form1.code5.value = document.form1.code5.value +','+document.form1.txtmpt[i].value;
			}
					
			if(document.form1.txtmp[i].value=="Yes" && document.form1.txtmpt[i].value!="" && document.form1.txt1[i].value=="")cnt5++;
			
			if(document.form1.code6.value =="")
			{
				document.form1.code6.value=document.form1.txt1[i].value;
			}
			else
			{
				document.form1.code6.value = document.form1.code6.value +','+document.form1.txt1[i].value;
			}
									
			if(document.form1.code7.value =="")
			{
				document.form1.code7.value=document.form1.txt2[i].value;
			}
			else
			{
				document.form1.code7.value = document.form1.code7.value +','+document.form1.txt2[i].value;
			}
			//alert(document.getElementById("mptnop_"+[i+1]).value);						
			if(document.form1.code8.value =="")
			{
				document.form1.code8.value=document.getElementById("mptnop_"+[i+1]).value;
			}
			else
			{
				document.form1.code8.value = document.form1.code8.value +','+document.getElementById("mptnop_"+[i+1]).value;
			}
			//alert(document.form1.code8.value);
		}
	}
	//alert(cnt1);alert(cnt2);alert(cnt3);alert(cnt4);alert(cnt5);
	if(cnt1 > 0)
	{
		alert("Select Window Box");
		return false;
	}
	if(cnt2 > 0)
	{
		alert("Select No. of Packs");
		return false;
	}
	if(cnt3 > 0)
	{
		alert("Select Master Pack");
		return false;
	}
	if(cnt4 > 0)
	{
		alert("Select Master Pack Type");
		return false;
	}
	if(cnt5 > 0)
	{
		alert("Enter Wt. in Master Pack");
		return false;
	}
	//document.getElementById('id5_'+[flagcode]).value = document.from1.txtwb1.value;
	//alert(document.form1.txtwb1.value);
	if(document.form1.flagcode.value == "")
	{
		alert("Please select UPS");
		return false;
	}
	if(val==0)
	{
		if(confirm("You have not entered any Commercial Variety.\n\nDo you Still want to Submit?")==true)
		return true;
		else
		return false;
	}
	else
	{
	return true;
	}
}

function boilarschk(valle)
{
	if(document.form1.txtstduration.value=="") 
	{
		alert("Please enter Settlement Duration");
		document.form1.txtleduration.valu="";
		document.form1.txtstduration.focus();
		return false;
	}
}
</SCRIPT>

<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"  onLoad="return onloadfocus()" >
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_adm1.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

		<?php
	
	if(!isset($_GET['page'])) { 
		$page = 1; 
		$srno=1;
	} else { 
		$page = $_GET['page']; 
		$srno=(($page * 10)+1) - 10;
	} 
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 
	
	
	$sql_sel="select * from tblups order by uom  Asc";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblups");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

	if($total >0) { 
?>
<!-- actual page start--->	
	  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Variety  Master - Add Production Variety</td>
	    </tr></table></td>
	    	 </tr>
	  </table></td></tr>
   	  <td align="center" colspan="4" >
	 <form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return confirm('You are Adding Variety:\nCrop: '+document.form1.crop.value+'\nPopular Variety Name: '+document.form1.vname.value+'\nType:') " onReset="onloadfocus();"> 
  <input name="frm_action" value="submit" type="hidden"> 
    <input name="txt" value="" type="hidden"> 
	<input type="hidden" name="pageid" value="<?php echo $pageid;?>" />
	<input type="hidden" name="trtyp" value="" />
  	 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse"  vspace=""> 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Add Variety - Production Variety</td>
</tr>
<tr class="Light" height="15">
    <td colspan="4" align="right" class="smalltblheading"><font color="#FF0000" >*</font>indicates required field&nbsp;</td>
  </tr>
 <tr class="Dark" height="15"> 
   <?php
		$quer2=mysqli_query($link,"SELECT DISTINCT cropname,cropid FROM tblcrop order by cropname Asc"); 
	 ?> 
<td width="234" align="right"  valign="middle" class="smalltblheading">&nbsp;Select Crop&nbsp;</td>
<td align="left"  valign="middle" >&nbsp;<select class="smalltbltext" name="crop" style="width:170px;" >
    <?php
if(!isset($_GET['lo']))
{
?>
    <option value="">--Select Crop--</option>
    <?php } ?>
    <?php while($noticia = mysqli_fetch_array($quer2)) { ?>
    <option  <?php if(isset($_GET['lo'])) { $cropid=$_GET['lo']; if($noticia['cropid'] == $_GET['lo']) {$cropname=$noticia['cropname']; echo "selected"; } } ?> value="					<?php echo $noticia['cropid'];?>" />  
    <?php echo $noticia['cropname'];?>
    <?php } ?>
    <?php /* while($noticia = mysqli_fetch_array($quer2)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />      
		<?php echo $noticia['cropname'];?>
		<?php } */ ?>
  </select>&nbsp;<font color="#FF0000" >*</font>	</td>
	 <?php
	 if(isset($_GET['lo']))
{
	 $lo1=$_GET['lo'];
		$quer_cn=mysqli_query($link,"SELECT DISTINCT cropname,cropid FROM tblcrop where cropid=$lo1 ");
		 $res_cn=mysqli_fetch_array($quer_cn);
		 $cropname1=$res_cn['cropname'];

	 ?> 
	<input type="hidden" name="cropname" value="<?php echo $cropname1;?>" />
	
	<?php } ?>

<td align="right"  valign="middle" class="smalltblheading">Production Variety Name&nbsp;</td>
<td align="left"  valign="middle" >&nbsp;<input name="vname" type="text" size="30" class="smalltbltext" tabindex="0" onChange="f1(this.value);"  maxlength="30" onKeyPress="return isCharKey270(event)" />&nbsp;<font color="#FF0000" >*</font></td>
</tr>
<tr class="Light" height="15">
<td align="right"  valign="middle" class="smalltblheading"> Variety Type&nbsp;</td>
<td width="241" align="left"  valign="middle">&nbsp;<select name="txtvt" class="smalltbltext"  style="width:110px;" tabindex="" onChange="chkpvr(this.value);" >
    <option value="">--Select Type--</option>
    <option value="Hybrid">Hybrid</option>
    <option value="OP">OP</option>
  </select>  &nbsp;<font color="#FF0000" >*</font></td>
		 <td width="213" align="right" valign="middle" class="smalltblheading">&nbsp;Set Auto GOT at Arrival&nbsp;</td>
         <td width="252"  align="left"  valign="middle" class="smalltbltext">&nbsp;<select name="txtopt" class="smalltbltext"  style="width:100px;" tabindex="" onChange="chkvtyp(this.value);" >
		<option value="" >--Select--</option>
		<option value="Mandatory">Mandatory</option>
		<option value="Optional">Optional</option>
		</select>&nbsp;<font color="#FF0000" >*</font></td>
		</tr>
	
		<tr class="Dark" height="25">
		<td width="234" align="right"  valign="middle" class="smalltblheading">Guard Sample Retention Period (GSRP)&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" >&nbsp;<select name="txtdsp" class="smalltbltext"  style="width:80px;" tabindex="" onChange="chkgotarr(this.value);" >
		<option value="">--Select--</option>
		<option value="6">6</option>
		<option value="12">12</option>
		<option value="18">18</option>
		<option value="24">24</option>
		</select>&nbsp;<font color="#FF0000" >*</font>&nbsp;Months</td>
		<td width="213" align="right" valign="middle" class="smalltblheading">&nbsp;Dormancy Duration&nbsp;</td>
         <td width="252"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtdordurtion" type="text" size="2" class="smalltbltext" tabindex="0" onChange="expdtqc(this.value);" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;Days&nbsp;&nbsp; From Date of Harvest</td>
		</tr>
		<tr class="Light" height="25">
		<td width="234" align="right"  valign="middle" class="smalltblheading">Expected Days of QC Result (EDOR-G)&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="expdtg" type="text" size="1" class="smalltbltext" tabindex="0" onChange="gsrpchk(this.value);" onKeyPress="return isNumberKey(event)"  maxlength="2" />&nbsp;<font color="#FF0000" >*</font>&nbsp;From Date of Sample Collection</td>
		<td width="213" align="right" valign="middle" class="smalltblheading">&nbsp;Expected Days of GOT Result (EDOR-T)&nbsp;</td>
         <td width="252"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="expdtt" type="text" size="2" class="smalltbltext" tabindex="0" onChange="ddperiod(this.value);" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;From Date of Sample Collection</td>
		</tr>
		<tr class="Dark" height="25">
		<td width="234" align="right"  valign="middle" class="smalltblheading">Test Weight Gms per 1000 Seed&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" >&nbsp;From&nbsp;<input name="txttwtpgmsf" type="text" size="3" class="smalltbltext" tabindex="0" onChange="expdtchk(this.value);" onKeyPress="return isNumberKey(event)"  maxlength="4" />&nbsp;&nbsp;To&nbsp;&nbsp;<input name="txttwtpgmst" type="text" size="3" class="smalltbltext" tabindex="0" onChange="exptwtgfchk(this.value);" onKeyPress="return isNumberKey(event)"  maxlength="4" />&nbsp;<font color="#FF0000" >*</font>&nbsp;Gms.</td>
		<td width="213" align="right" valign="middle" class="smalltblheading">&nbsp;Settlement Duration&nbsp;</td>
         <td width="252"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtstduration" type="text" size="2" class="smalltbltext" tabindex="0" onChange="twgpschk(this.value);" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;Days&nbsp;&nbsp; Max Duration from Date of Arrival</td>
		</tr>
		
		<tr class="Light" height="25">
		<td width="234" align="right"  valign="middle" class="smalltblheading">Blending of Inorganic Lots at Raw Stage&nbsp;</td>
		<td align="left"  valign="middle" class="smalltbltext" ><input type="radio" name="moilars" value="Yes" class="smalltbltext" />Allowed&nbsp;&nbsp;<input type="radio" name="moilars" value="No" checked="checked" class="smalltbltext" />Not-allowed&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
		<td width="213" align="right" valign="middle" class="smalltblheading">&nbsp;Life Expectancy (LE)&nbsp;</td>
        <td width="252"  align="left"  valign="middle" class="smalltbltext">&nbsp;<input name="txtleduration" type="text" size="2" class="smalltbltext" tabindex="0" onChange="boilarschk(this.value);" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;Months&nbsp;&nbsp;</td>
</tr>
<tr class="Light" height="25">
		<td width="234" align="right"  valign="middle" class="smalltblheading">Yet To Commercialized (YTC) Status&nbsp;</td>
		<td align="left"  valign="middle" class="smalltbltext" colspan="3" ><input type="radio" name="ytcstatus" value="Yes" class="smalltbltext" />Yes&nbsp;&nbsp;<input type="radio" name="ytcstatus" value="No" checked="checked" class="smalltbltext" />No&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
</tr>
</table>


		
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse"  vspace=""> 
<tr class="tblsubtitle" height="15">
	<td colspan="15" align="center" class="smalltblheading">Base Pair Molecular Marker</td>
</tr>
<tr class="Dark" height="25">
		<td width="449" align="right"  valign="middle" class="smalltblheading">Marker 1 Name&nbsp;</td>
<td width="499" align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtmarker1" type="text" size="10" class="smalltbltext" tabindex="0"   maxlength="10" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="25">
<td colspan="4">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse"  vspace=""> 
<tr class="Dark" height="25">
<td width="293" align="center" valign="middle" class="smalltblheading">&nbsp;Set&nbsp;</td>
<td width="293" align="center" valign="middle" class="smalltblheading">&nbsp;Female&nbsp;</td>
<td width="193" align="center"  valign="middle" class="smalltblheading">Male&nbsp;</td>
<td width="456" align="center" valign="middle" class="smalltblheading">&nbsp;Hybrid&nbsp;</td>
</tr>
<tr class="Dark" height="25">		
         <td width="293"  align="center"  valign="middle" class="smalltbltext">1</td>
		 <td width="293"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1female1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1female2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtm1male1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1male2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
         <td width="456"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
</tr>

<tr class="Dark" height="25">		
         <td width="293"  align="center"  valign="middle" class="smalltbltext">2</td>
		 <td width="293"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1female1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1female2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtm1male1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1male2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
         <td width="456"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
</tr>

<tr class="Dark" height="25">		
         <td width="293"  align="center"  valign="middle" class="smalltbltext">3</td>
		 <td width="293"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1female1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1female2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtm1male1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1male2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
         <td width="456"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3"  readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
</tr>		
</table>		 
</td>
</tr>


<tr class="Dark" height="25">
		<td width="449" align="right"  valign="middle" class="smalltblheading">Marker 2 Name&nbsp;</td>
<td width="499" align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtmarker1" type="text" size="10" class="smalltbltext" tabindex="0"   maxlength="10" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="25">
<td colspan="4">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse"  vspace=""> 
<tr class="Dark" height="25">
<td width="293" align="center" valign="middle" class="smalltblheading">&nbsp;Set&nbsp;</td>
<td width="293" align="center" valign="middle" class="smalltblheading">&nbsp;Female&nbsp;</td>
<td width="193" align="center"  valign="middle" class="smalltblheading">Male&nbsp;</td>
<td width="456" align="center" valign="middle" class="smalltblheading">&nbsp;Hybrid&nbsp;</td>
</tr>
<tr class="Dark" height="25">		
         <td width="293"  align="center"  valign="middle" class="smalltbltext">1</td>
		 <td width="293"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1female1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1female2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtm1male1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1male2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
         <td width="456"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
</tr>

<tr class="Dark" height="25">		
         <td width="293"  align="center"  valign="middle" class="smalltbltext">2</td>
		 <td width="293"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1female1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1female2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtm1male1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1male2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
         <td width="456"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
</tr>

<tr class="Dark" height="25">		
         <td width="293"  align="center"  valign="middle" class="smalltbltext">3</td>
		 <td width="293"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1female1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1female2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtm1male1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1male2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
         <td width="456"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3"  readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
</tr>		
</table>		 
</td>
</tr>


<tr class="Dark" height="25">
		<td width="449" align="right"  valign="middle" class="smalltblheading">Marker 3 Name&nbsp;</td>
<td width="499" align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtmarker1" type="text" size="10" class="smalltbltext" tabindex="0"   maxlength="10" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="25">
<td colspan="4">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse"  vspace=""> 
<tr class="Dark" height="25">
<td width="293" align="center" valign="middle" class="smalltblheading">&nbsp;Set&nbsp;</td>
<td width="293" align="center" valign="middle" class="smalltblheading">&nbsp;Female&nbsp;</td>
<td width="193" align="center"  valign="middle" class="smalltblheading">Male&nbsp;</td>
<td width="456" align="center" valign="middle" class="smalltblheading">&nbsp;Hybrid&nbsp;</td>
</tr>
<tr class="Dark" height="25">		
         <td width="293"  align="center"  valign="middle" class="smalltbltext">1</td>
		 <td width="293"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1female1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1female2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtm1male1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1male2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
         <td width="456"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
</tr>

<tr class="Dark" height="25">		
         <td width="293"  align="center"  valign="middle" class="smalltbltext">2</td>
		 <td width="293"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1female1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1female2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtm1male1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1male2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
         <td width="456"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
</tr>

<tr class="Dark" height="25">		
         <td width="293"  align="center"  valign="middle" class="smalltbltext">3</td>
		 <td width="293"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1female1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1female2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtm1male1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1male2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
         <td width="456"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3"  readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
</tr>		
</table>		 
</td>
</tr>


<tr class="Dark" height="25">
		<td width="449" align="right"  valign="middle" class="smalltblheading">Marker 4 Name&nbsp;</td>
<td width="499" align="left"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtmarker1" type="text" size="10" class="smalltbltext" tabindex="0"   maxlength="10" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="25">
<td colspan="4">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse"  vspace=""> 
<tr class="Dark" height="25">
<td width="293" align="center" valign="middle" class="smalltblheading">&nbsp;Set&nbsp;</td>
<td width="293" align="center" valign="middle" class="smalltblheading">&nbsp;Female&nbsp;</td>
<td width="193" align="center"  valign="middle" class="smalltblheading">Male&nbsp;</td>
<td width="456" align="center" valign="middle" class="smalltblheading">&nbsp;Hybrid&nbsp;</td>
</tr>
<tr class="Dark" height="25">		
         <td width="293"  align="center"  valign="middle" class="smalltbltext">1</td>
		 <td width="293"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1female1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1female2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtm1male1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1male2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
         <td width="456"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
</tr>

<tr class="Dark" height="25">		
         <td width="293"  align="center"  valign="middle" class="smalltbltext">2</td>
		 <td width="293"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1female1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1female2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtm1male1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1male2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
         <td width="456"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
</tr>

<tr class="Dark" height="25">		
         <td width="293"  align="center"  valign="middle" class="smalltbltext">3</td>
		 <td width="293"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1female1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1female2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
<td align="center"  valign="middle" class="smalltbltext" >&nbsp;<input name="txtm1male1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;&nbsp;<input name="txtm1male2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
         <td width="456"  align="center"  valign="middle" class="smalltbltext">&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3"  readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<input name="txtm1hybrid1" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;&nbsp;<input name="txtm1hybrid2" type="text" size="2" class="smalltbltext" tabindex="0" onKeyPress="return isNumberKey(event)"  maxlength="3" readonly="true" style="background-color:#CCCCCC" />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
</tr>		
</table>		 
</td>
</tr>


	
</table>





<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse"  vspace=""> 
<tr class="tblsubtitle" height="15">
	<td colspan="15" align="center" class="smalltblheading">UPS Allocation </td>
</tr>
<tr class="tblsubtitle" height="15">
	<td width="30"  align="center" class="smalltblheading"># </td>
	<td width="47"  align="center" class="smalltblheading">UPS</td>
	<td width="43"  align="center" class="smalltblheading">UOM</td>
	<td width="38"  align="center" class="smalltblheading">UPS in Kgs.</td>
	<td width="47"  align="center" class="smalltblheading">Select</td>
	<td width="117"  align="center" class="smalltblheading">PPT</td>
	<td width="117"  align="center" class="smalltblheading">Window Box</td>
	<td width="118"  align="center" class="smalltblheading">No. of Packs</td>
	<td width="73"  align="center" class="smalltblheading">Wt. in WB</td>
	<td width="122"  align="center" class="smalltblheading">Master Pack</td>
	<td width="121"  align="center" class="smalltblheading">Master Pack Type</td>
	<td width="99"  align="center" class="smalltblheading">Wt. in Master Pack</td>
	<td width="69"  align="center" class="smalltblheading">NoWB</td>
</tr>
<?php
$srno=1;
while($row=mysqli_fetch_array($res))
{
	$resettargetquery=mysqli_query($link,"select * from tblups where uid='".$row['uid']."'");
  	while($resetresult=mysqli_fetch_array($resettargetquery))
	{
  	
	if ($srno%2 != 0)
	{

?>
<tr class="Dark" height="25">
	<td  valign="middle" class="smalltbltext" align="center"><?php echo $srno?></td>
	<td valign="middle" class="smalltbltext" align="center">&nbsp;<?php echo $row['ups'];?></td>
	<td valign="middle" class="smalltbltext" align="center">&nbsp;<?php echo $row['wt'];?></td>
	<td valign="middle" class="smalltbltext" align="center">&nbsp;<?php echo $row['uom'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><input type="checkbox" name="fet"  value="<?php echo $row['uid'];?>"  onClick="clk('<?php echo $srno?>');" id="fetchk_<?php echo $srno?>"/></td>
	<td valign="middle" class="smalltbltext" align="center"><select name="txtppt" class="smalltbltext"  style="width:60px;" tabindex="" id="ppt_<?php echo $srno?>" disabled="disabled" onChange="clk0('<?php echo $srno?>',this.value);">
		<option value=""  >Select</option>
		<option value="Pouch">Pouch</option>
		<option value="Tin">Tin</option>
		<option value="Bag">Bag</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
	<td valign="middle" class="smalltbltext" align="center"><select name="txtwb" class="smalltbltext"  style="width:60px;" tabindex="" id="itm_<?php echo $srno?>" disabled="disabled" onChange="clk1('<?php echo $srno?>',this.value);">
		<option value=""  >Select</option>
		<option value="Yes">Yes</option>
		<option value="No">No</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
	<td valign="middle" class="smalltbltext" align="center"><select name="txtnop" class="smalltbltext"  style="width:60px;" tabindex=""disabled="disabled"  id="id2_<?php echo $srno?>"  onchange="clk2('<?php echo $srno?>','<?php echo $row['uom'];?>',this.value);">
		<option value="" >Select</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
		<option value="32">32</option>
		<option value="33">33</option>
		<option value="34">34</option>
		<option value="35">35</option>
		<option value="36">36</option>
		<option value="37">37</option>
		<option value="38">38</option>
		<option value="39">39</option>
		<option value="40">40</option>
		<option value="41">41</option>
		<option value="42">42</option>
		<option value="43">43</option>
		<option value="44">44</option>
		<option value="45">45</option>
		<option value="46">46</option>
		<option value="47">47</option>
		<option value="48">48</option>
		<option value="49">49</option>
		<option value="50">50</option>
		<option value="51">51</option>
		<option value="52">52</option>
		<option value="53">53</option>
		<option value="54">54</option>
		<option value="55">55</option>
		<option value="56">56</option>
		<option value="57">57</option>
		<option value="58">58</option>
		<option value="59">59</option>
		<option value="60">60</option>
		<option value="61">61</option>
		<option value="62">62</option>
		<option value="63">63</option>
		<option value="64">64</option>
		<option value="65">65</option>
		<option value="66">66</option>
		<option value="67">67</option>
		<option value="68">68</option>
		<option value="69">69</option>
		<option value="70">70</option>
		<option value="71">71</option>
		<option value="72">72</option>
		<option value="73">73</option>
		<option value="74">74</option>
		<option value="75">75</option>
		<option value="76">76</option>
		<option value="77">77</option>
		<option value="78">78</option>
		<option value="79">79</option>
		<option value="80">80</option>
		<option value="81">81</option>
		<option value="82">82</option>
		<option value="83">83</option>
		<option value="84">84</option>
		<option value="85">85</option>
		<option value="86">86</option>
		<option value="87">87</option>
		<option value="88">88</option>
		<option value="89">89</option>
		<option value="90">90</option>
		<option value="91">91</option>
		<option value="92">92</option>
		<option value="93">93</option>
		<option value="94">94</option>
		<option value="95">95</option>
		<option value="96">96</option>
		<option value="97">97</option>
		<option value="98">98</option>
		<option value="99">99</option>
		
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
	<td valign="middle" class="smalltbltext" align="center"><input name="txtwb1" type="text" size="6" class="smalltbltext" tabindex=""  maxlength="9"   style="background-color:#CCCCCC"  readonly="true"  id="id5_<?php echo $srno?>" ></td>
	<td valign="middle" class="smalltbltext" align="center"><select name="txtmp" class="smalltbltext"  style="width:60px;" tabindex="" disabled="disabled" id="id3_<?php echo $srno?>" onChange="clk3('<?php echo $srno?>',this.value);">
		<option value="" >Select</option>
		<option value="Yes">Yes</option>
		<option value="No">No</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
	<td valign="middle" class="smalltbltext" align="center"><select name="txtmpt" class="smalltbltext"  style="width:60px;" tabindex=""disabled="disabled" id="id4_<?php echo $srno?>" onChange="clk4('<?php echo $srno?>','<?php echo $row['uom'];?>',this.value);" >
		<option value="" >Select</option>
		<option value="Carton">Carton</option>
		<option value="Bag">Bag</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>

	<td align="center" width="99" valign="middle" class="smalltbltext"><input name="txt1" type="text" size="6" class="smalltbltext" tabindex=""  maxlength="6"   style="background-color:#CCCCCC" id="id6_<?php echo $srno?>" disabled="disabled" onChange="calc('<?php echo $srno?>','<?php echo $row['uom'];?>',this.value);" onKeyPress="return isNumberKey(event)">&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	
	<td align="center" width="69" valign="middle" class="smalltbltext"><input name="txt2" type="text" size="2" class="smalltbltext" tabindex=""  maxlength="2" readonly="true"  style="background-color:#CCCCCC" id="id7_<?php echo $srno?>"   >&nbsp;<input type="hidden" name="mptnop<?php echo $srno?>" id="mptnop_<?php echo $srno?>" value="" /></td>
</tr>
<?php
	}
	else
	{ 
?>
<tr class="Light" height="25">
	<td  valign="middle" class="smalltbltext" align="center"><?php echo $srno?></td>
	<td valign="middle" class="smalltbltext" align="center">&nbsp;<?php echo $row['ups'];?></td>
	<td valign="middle" class="smalltbltext" align="center">&nbsp;<?php echo $row['wt'];?></td>
	<td valign="middle" class="smalltbltext" align="center">&nbsp;<?php echo $row['uom'];?></td>
	<td valign="middle" class="smalltbltext" align="center"><input type="checkbox" name="fet"  value="<?php echo $row['uid'];?>"  onClick="clk('<?php echo $srno?>');" id="fetchk_<?php echo $srno?>"/></td>
	<td valign="middle" class="smalltbltext" align="center"><select name="txtppt" class="smalltbltext"  style="width:60px;" tabindex="" id="ppt_<?php echo $srno?>" disabled="disabled" onChange="clk0('<?php echo $srno?>',this.value);">
		<option value=""  >Select</option>
		<option value="Pouch">Pouch</option>
		<option value="Tin">Tin</option>
		<option value="Bag">Bag</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
	<td valign="middle" class="smalltbltext" align="center"><select name="txtwb" class="smalltbltext"  style="width:60px;" tabindex="" id="itm_<?php echo $srno?>" disabled="disabled" onChange="clk1('<?php echo $srno?>',this.value);">
		<option value=""  >Select</option>
		<option value="Yes">Yes</option>
		<option value="No">No</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
	<td valign="middle" class="smalltbltext" align="center"><select name="txtnop" class="smalltbltext"  style="width:60px;" tabindex=""disabled="disabled"  id="id2_<?php echo $srno?>"  onchange="clk2('<?php echo $srno?>','<?php echo $row['uom'];?>',this.value);">
		<option value="" >Select</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
		<option value="32">32</option>
		<option value="33">33</option>
		<option value="34">34</option>
		<option value="35">35</option>
		<option value="36">36</option>
		<option value="37">37</option>
		<option value="38">38</option>
		<option value="39">39</option>
		<option value="40">40</option>
		<option value="41">41</option>
		<option value="42">42</option>
		<option value="43">43</option>
		<option value="44">44</option>
		<option value="45">45</option>
		<option value="46">46</option>
		<option value="47">47</option>
		<option value="48">48</option>
		<option value="49">49</option>
		<option value="50">50</option>
		<option value="51">51</option>
		<option value="52">52</option>
		<option value="53">53</option>
		<option value="54">54</option>
		<option value="55">55</option>
		<option value="56">56</option>
		<option value="57">57</option>
		<option value="58">58</option>
		<option value="59">59</option>
		<option value="60">60</option>
		<option value="61">61</option>
		<option value="62">62</option>
		<option value="63">63</option>
		<option value="64">64</option>
		<option value="65">65</option>
		<option value="66">66</option>
		<option value="67">67</option>
		<option value="68">68</option>
		<option value="69">69</option>
		<option value="70">70</option>
		<option value="71">71</option>
		<option value="72">72</option>
		<option value="73">73</option>
		<option value="74">74</option>
		<option value="75">75</option>
		<option value="76">76</option>
		<option value="77">77</option>
		<option value="78">78</option>
		<option value="79">79</option>
		<option value="80">80</option>
		<option value="81">81</option>
		<option value="82">82</option>
		<option value="83">83</option>
		<option value="84">84</option>
		<option value="85">85</option>
		<option value="86">86</option>
		<option value="87">87</option>
		<option value="88">88</option>
		<option value="89">89</option>
		<option value="90">90</option>
		<option value="91">91</option>
		<option value="92">92</option>
		<option value="93">93</option>
		<option value="94">94</option>
		<option value="95">95</option>
		<option value="96">96</option>
		<option value="97">97</option>
		<option value="98">98</option>
		<option value="99">99</option>
		
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
	<td valign="middle" class="smalltbltext" align="center"><input name="txtwb1" type="text" size="6" class="smalltbltext" tabindex=""  maxlength="9"   style="background-color:#CCCCCC"  readonly="true"  id="id5_<?php echo $srno?>" ></td>
	<td valign="middle" class="smalltbltext" align="center"><select name="txtmp" class="smalltbltext"  style="width:60px;" tabindex="" disabled="disabled" id="id3_<?php echo $srno?>" onChange="clk3('<?php echo $srno?>',this.value);">
		<option value="" >Select</option>
		<option value="Yes">Yes</option>
		<option value="No">No</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>
	<td valign="middle" class="smalltbltext" align="center"><select name="txtmpt" class="smalltbltext"  style="width:60px;" tabindex=""disabled="disabled" id="id4_<?php echo $srno?>" onChange="clk4('<?php echo $srno?>','<?php echo $row['uom'];?>',this.value);" >
		<option value="" >Select</option>
		<option value="Carton">Carton</option>
		<option value="Bag">Bag</option>
		</select>  &nbsp;<font color="#FF0000" >*</font></td>

	<td align="center" width="99" valign="middle" class="smalltbltext"><input name="txt1" type="text" size="6" class="smalltbltext" tabindex=""  maxlength="6"   style="background-color:#CCCCCC" id="id6_<?php echo $srno?>" disabled="disabled" onChange="calc('<?php echo $srno?>','<?php echo $row['uom'];?>',this.value);" onKeyPress="return isNumberKey(event)">&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	
	<td align="center" width="69" valign="middle" class="smalltbltext"><input name="txt2" type="text" size="2" class="smalltbltext" tabindex=""  maxlength="2" readonly="true"  style="background-color:#CCCCCC" id="id7_<?php echo $srno?>"   >&nbsp;<input type="hidden" name="mptnop<?php echo $srno?>" id="mptnop_<?php echo $srno?>" value="" /></td>
</tr>
<?php	
}
 $srno=$srno+1;
}
}
}
?>
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse"  vspace=""> 
<tr class="Dark" height="25">
	<td width="50%" align="right"  valign="middle" class="smalltblheading">Status&nbsp;</td>
<td align="left"  valign="middle" class="smalltbltext" colspan="3"><input type="radio" name="actsts" value="Active" checked="checked" class="smalltbltext" />Active&nbsp;&nbsp;<input type="radio" name="actsts" value="In-Active" class="smalltbltext" />In-Active&nbsp;<font color="#FF0000" >*</font>&nbsp;</td>
</tr>
</table>


<table align="center" border="0" width="950" cellspacing="5" cellpadding="7" > 
<tr height="25">
	<td align="right"  valign="middle" class="smalltblheading"><input name="Submit" type="image" src="../images/addacv.gif" alt="Submit Value" onClick="return mySubmit('1');"  border="0" style="display:inline;cursor:pointer;">&nbsp;</td>
</tr>
</table>


<table align="center" width="950" cellpadding="7" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><input type="hidden" name="flagcode" value=""/><input type="hidden" name="code1" value=""/><input type="hidden" name="code2" value=""/><input type="hidden" name="code3" value=""/><input type="hidden" name="code4" value=""/><input type="hidden" name="code5" value=""/><input type="hidden" name="code6" value=""/><input type="hidden" name="code7" value=""/><input type="hidden" name="code8" value=""/>&nbsp;<a href="home_variety.php?page=<?php echo $pageid;?>"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;<a href="javascript:document.form1.reset()"><img src="../images/reset.gif" OnClick="myReset()"alt="reset"  border="0" style="display:inline;cursor:pointer;"></a>&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" onClick="return mySubmit('0');"  border="0" style="display:inline;cursor:pointer;">&nbsp;</td>
</tr>
</table>
</br>
</td>
<td width="30"></td>
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
