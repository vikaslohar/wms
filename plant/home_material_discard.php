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
		$code=trim($_POST['txtid']);
		$date=trim($_POST['date']);
		$classification=trim($_POST['txtpname']);
		$address=trim($_POST['txtaddress']);
		$drno=trim($_POST['txtdrno']);
		$txt=trim($_POST['txt1']);
		//$txt12=trim($_POST['txt12']);
		$tname=trim($_POST['txttname']);
		$lorryno=trim($_POST['txtlrn']);
		$vno=trim($_POST['txtvn']);
		$pmode=trim($_POST['txt12']);
		$cname=trim($_POST['txtcname']);
		$dc=trim($_POST['txtdc']);
			
		$tdate=$date;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		/*$query=mysqli_query($link,"SELECT * FROM tbl_bin where binname='$perticulars'") or die("Error: " . mysqli_error($link));
   		$numofrecords=mysqli_num_rows($query);
	 	 if( $numofrecords > 0)
		 {
		 ?>
		 <script>
		  alert("This bin is Already Present.");
		  </script>
		 <?php }
		 else 
		{*/
	 	
		
 	  
			   $sql_in="insert into tbl_discard(code, date, p_id ,drno,address, mode, tname, lrno, vno,cname, dcno,pmode, plantcode) values ('$code','$tdate','$classification', '$drno','$address','$txt', '$tname', '$lorryno', '$vno','$cname','$dc','$pmode', '$plantcode')";
					//exit;							
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{
			echo "<script>window.location='home_material_return.php'</script>";	
		}
		
	
}
//}
//}
$sql_code="SELECT MAX(code) FROM tbl_discard where plantcode='$plantcode' ORDER BY code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1="AV".$code;
		}
		else
		{
			$code=1;
			$code1="AV".$code;
		}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
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
<script language="javascript" type="text/javascript">
var x = 0;
function imgOnClick(dt, xind, yind)
	{document.frmaddDepartment.reset();
	 popUpCalendar(document.frmaddDepartment.date,dt,document.frmaddDepartment.date, "dd-mmm-yyyy", xind, yind);
	}  


function isNumberKey(evt)
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
alert(val);
document.frmaddDepartment.txt14.value=val;
}

function mySubmit()
{ 
	
	if(document.frmaddDepartment.txtdrno.value=="")
	{
	alert("Please enter Discard Instruction Ref. No.");
	document.frmaddDepartment.txtdrno.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtdrno.value.charCodeAt() == 32)
	{
	alert("Discard Instruction Ref. No cannot start with space.");
	document.frmaddDepartment.txtdrno.focus();
	return false;
	}
		

	if(document.frmaddDepartment.txt11.value!="")
	{
	if(document.frmaddDepartment.txt11.value=="Yes")
	{
	if(document.frmaddDepartment.txttname.value=="")
	{
	alert("Please enter Transport Name");
	document.frmaddDepartment.txttname.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txttname.value.charCodeAt() == 32)
	{
	alert("Transport Name cannot start with space.");
	document.frmaddDepartment.txttname.focus();
	return false;
	}
				
	if(document.frmaddDepartment.txtlrn.value=="")
	{
	alert("Please enter Lorry Receipt No");
	document.frmaddDepartment.txtlrn.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtlrn.value.charCodeAt() == 32)
	{
	alert("Lorry Receipt No cannot start with space.");
	document.frmaddDepartment.txtlrn.focus();
	return false;
	}
	if(document.frmaddDepartment.txtvn.value=="")
	{
	alert("Please enter Vehicle No");
	document.frmaddDepartment.txtvn.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtvn.value.charCodeAt() == 32)
	{
	alert("Vehicle No cannot start with space.");
	document.frmaddDepartment.txtvn.focus();
	return false;
	}
	if(document.frmaddDepartment.txt14.value=="")
	{
	alert("Please select Payment Mode");
	return false;
	}
	}
	else
	{
	if(document.frmaddDepartment.txtcname.value=="")
	{
	alert("Please enter Courier Name");
	document.frmaddDepartment.txtcname.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtcname.value.charCodeAt() == 32)
	{
	alert("Courier Name cannot start with space.");
	document.frmaddDepartment.txtcname.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtdc.value=="")
	{
	alert("Please enter Docket No.");
	document.frmaddDepartment.txtdc.focus();
	return false;
	}
	
	if(document.frmaddDepartment.txtdc.value.charCodeAt() == 32)
	{
	alert("Docket No. cannot start with space.");
	document.frmaddDepartment.txtdc.focus();
	return false;
	}
	}
	}
	else
	{
	alert("Please select Mode of Transit");
	return false;
	}
	
	return false;	 
}

</SCRIPT>
<script language="javascript" type="text/javascript">
function clk(opt)
{
	if(opt!="")
	{
		if(opt=="Yes")
		{
			document.getElementById('trans').style.display="block";
			document.getElementById('courier').style.display="none";
			document.frmaddDepartment.txt11.value=opt;
		}
		else
		{
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="block";
			document.frmaddDepartment.txt11.value=opt;
		}	
	}
	else
	{
		alert("Please Select Mode of Transport");
	}
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_plant.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>  <td width="100%" valign="top"  height="500" align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	       <td width="813" height="25" class="Mainheading">&nbsp;Transaction -Material Discard </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
 <?php
	/* $sql1=mysqli_query($link,"select * from tbl_bin")or die(mysqli_error($link));
    	$noticia=mysqli_fetch_array($sql1);*/
	
	 ?> 
	  
	    <td align="center" colspan="4" >
		<form name="frmaddDept" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr>
<td><br />

<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#2e81c1" style="border-collapse:collapse">
            <tr class="tblsubtitle" height="35">
              <td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td width="13%" align="center" rowspan="2" valign="middle" class="tblheading">Classification</td>
              <td width="17%" rowspan="2" align="center" valign="middle" class="tblheading">Items</td>
			   <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">UOM</td>
			    <td width="10%" rowspan="2" align="center" valign="middle" class="tblheading">Good/Damage</td>
			     <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">UPS</td>
                  <td width="11%" rowspan="2" align="center" valign="middle" class="tblheading">Qty</td>
                    <td width="13%" align="center" valign="middle" class="tblheading">Edit</td>
					 <td width="22%"  colspan="1" rowspan="" align="center" valign="middle" class="tblheading">Delete</td>
		                    </tr>
			<tr class="<?php echo $trcls;?>" height="25">
              <td align="center" class="smalltbltext" valign="middle"><a href="faclaimdetails_view.php?month=<?php echo $month;?>&empid=<?php echo $row['emp_id'];?>&dept=<?php if(isset($_REQUEST['dept'])){ echo $dept;} else { echo "0";} ?>&vid=<?php echo $row['claim_id'];?>"></a></td>
              <td align="center" class="smalltbltext" valign="middle">&nbsp;</td>
				 <td align="center" class="smalltbltext" valign="middle">&nbsp;</td>
				 <td align="center" class="smalltbltext" valign="middle">&nbsp;</td>
				 <td align="center" class="smalltbltext" valign="middle">&nbsp;</td>
             
            <td valign="middle" class="tbltext" align="center">&nbsp;</td>
              <td valign="middle" class="tbltext" align="center"><a href="edit_classification.php?clid=<?php echo $row['clid_id'];?>"><img src="../images/edit.png" border="0" /></a></td>
              <td valign="middle" class="tbltext" align="center"><a href="../include/delete.php?print=classification&code=<?php echo $row['clid_id']?>" onClick="return confirm('Do you really want to delete this Record?')">

<img border="0" src="../images/delete.png"  /></a></td>
              </tr>
            <?php //$srno=$srno+1;							 ?>
         </table>
<br/>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<td width="189"  align="right"  valign="middle" class="tblheading">&nbsp;Classification&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Classification--</option>
	<?php while($noticia_class = mysqli_fetch_array($classqry)) { ?>
		<option value="<?php echo $noticia_class['classification_id'];?>" />   
		<?php echo $noticia_class['classification'];?>
		<?php } ?>
	</select><font color="#FF0000">*</font>	</td></tr>
 <?php 
$itemqry=mysqli_query($link,"select items_id, stores_item from tbl_stores where plantcode='$plantcode'") or die(mysqli_error($link));
?>            
         <tr class="Light" height="30">
<td align="right" valign="middle" class="tblheading">Stores Items&nbsp;</td>
<td align="left" valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" name="txtitem" style="width:170px;" onchange="classchk();" >
<option value="" selected>--Select Item--</option>
	<?php while($noticia_item = mysqli_fetch_array($itemqry)) { ?>
		<option value="<?php echo $noticia_item['items_id'];?>" />   
		<?php echo $noticia_item['stores_item'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="123" align="right"  valign="middle" class="tblheading" >UOM&nbsp;</td>
<td width="221" colspan="3" align="left" valign="middle" class="tbltext" >&nbsp;
  <input name="txtuom" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;</td>
</tr>

<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Discard From Good/Damage&nbsp;</td>
<td width="307" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txt1" type="radio" class="tbltext" value="Yes" onClick="clk(this.value);" />&nbsp;Good&nbsp;&nbsp;&nbsp;&nbsp;<input name="txt1" type="radio" class="tbltext" value="No" onClick="clk(this.value);" />&nbsp;Damage&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Quantitiy as per D.C&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtydc" type="text" size="10" class="tbltext" tabindex=""   maxlength="7" onchange="upsdcchk();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Stock In Hand</td>
</tr>
 <tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">UPS &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtexshqty" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Quantity &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtexshqty" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">SLOC&nbsp;</td>
<td width="307" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtexshqty" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">SLOC Selection&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtqtyd" type="checkbox" size="10" class="tbltext" tabindex=""  maxlength="7" onchange="qtychk1(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

 
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtexshups" type="text" size="10" class="tbltext" tabindex="" maxlength="5" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Bin&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtexshqty" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		 		 <tr class="Dark" height="25">
           <td width="189"  align="right"  valign="middle" class="tblheading">&nbsp;SubBin&nbsp; </td>
           <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txtperticulars" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC" /> &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		 <tr class="Light" height="25">
           <td width="189" height="24"  align="right"  valign="middle" class="tblheading">UPS &nbsp;</td>
           <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txtperticulars" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		 <tr class="Dark" height="25">
           <td width="189" height="24"  align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
           <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txtperticulars" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		 <tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Discard Quantity</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtwh" style="width:170px;"  onchange="showUser(this.value)">
<option value="" selected>--Select classification--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['whid'];?>" />   
		<?php echo $noticia['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Bin&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtwh" style="width:170px;"  onchange="showUser(this.value)">
<option value="" selected>--Select classification--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['whid'];?>" />   
		<?php echo $noticia['perticulars'];?>
		<?php } ?>
	</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
 <tr class="Dark" height="25">
           <td width="189"  align="right"  valign="middle" class="tblheading">&nbsp;SubBin&nbsp; </td>           
           <td align="left"  valign="middle" colspan="3">&nbsp;<select class="tbltext" name="txtwh" style="width:170px;"  onchange="showUser(this.value)">
<option value="" selected>--Select classification--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['whid'];?>" />   
		<?php echo $noticia['perticulars'];?>
		<?php } ?>
	</select>
              
              &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		 <tr class="Light" height="25">
           <td width="189" height="24"  align="right"  valign="middle" class="tblheading">UPS&nbsp;</td>
           <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txtqtydc" type="text" size="10" class="tbltext" tabindex=""   maxlength="7" onchange="upsdcchk();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		 <tr class="Dark" height="25">
           <td width="189" height="24"  align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
           <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txtqtydc" type="text" size="10" class="tbltext" tabindex=""   maxlength="7" onchange="upsdcchk();" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		 <tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Balance Quantity</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">WH&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtexshups" type="text" size="10" class="tbltext" tabindex="" maxlength="5" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Bin&nbsp;</td>
<td align="left" valign="middle" class="tbltext">&nbsp;<input name="txtexshqty" type="text" size="10" class="tbltext" tabindex="" maxlength="7" readonly="true" style="background-color:#CCCCCC"  />&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		 		 <tr class="Dark" height="25">
           <td width="189"  align="right"  valign="middle" class="tblheading">&nbsp;SubBin&nbsp; </td>
           <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txtperticulars" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC" /> &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		 <tr class="Light" height="25">
           <td width="189" height="24"  align="right"  valign="middle" class="tblheading">UPS &nbsp;</td>
           <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txtperticulars" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		 <tr class="Dark" height="25">
           <td width="189" height="24"  align="right"  valign="middle" class="tblheading">Qty&nbsp;</td>
           <td align="left"  valign="middle" colspan="3">&nbsp;<input name="txtperticulars" type="text" size="10" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
		 <tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">&nbsp;Mode &nbsp;</td>
 <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<input name="txt11" type="radio" class="tbltext" value="Yes" onClick="clk(this.value);" />&nbsp;Returnableble&nbsp;&nbsp;&nbsp;&nbsp;<input name="txt11" type="radio" class="tbltext" value="No" onClick="clk(this.value);" />
 &nbsp;Non Returnableble&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="220" align="right"  valign="middle" class="tblheading">&nbsp;Reason for Discard&nbsp;</td>
<td width="624" align="left"  valign="middle" class="tbltext">&nbsp;<textarea name="txtremarks" cols="50" rows="5" tabindex="" ></textarea>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="add_material_discard.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"></a>&nbsp;
  <input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" onclick="return mySubmit();"  border="0" style="display:inline;cursor:hand;" /></td>
</tr>
</table></td><td width="30"><span class="footer"><img src="images/vnrlogo.gif"  align="right"/></span></td>
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
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="images/istratlogo.gif"  align="left"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
