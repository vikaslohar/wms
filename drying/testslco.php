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

	if(isset($_POST['frm_action'])=='Submit')
	{
		 $whid=trim($_POST['txtslwhg1']);
		 $sid=trim($_POST['txtslsubbg1']);
		 $bid=trim($_POST['txtslbing1']);
		
			echo "<script>window.location='slocreport1.php?txtslwhg1=$whid&txtslsubbg1=$sid&txtslbing1=$bid'</script>";	
		}
		
	
//}
//}
//}

	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Drying- Utility-SLOC Searchr</title>
<link href="../include/main_drying.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_drying.css" rel="stylesheet" type="text/css" />
</head>
<script src="sloc.js"></script>
<script src="../include/validation.js"></script>
<SCRIPT language=JavaScript>

function openprint()
{
//var dateto=document.frmaddDept.dateto.value;
//var datefrom=document.frmaddDept.datefrom.value;
winHandle=window.open('report_operator1.php','WelCome','top=20,left=80,width=820,height=600,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}

function wh1(wh1val)
{ //alert(wh1val);
	if(document.frmaddDepartment.txtslwhg1.value!="")
	{
		showUser(wh1val,'bing1','wh','bing1','','','','');
	}
	
}

function bin1(bin1val)
{
	if(document.frmaddDepartment.txtslwhg1.value!="")
	{
	//	showUser(bin1val,'sbing1','bin','txtslsubbg1','','','','');
	}
	}

function subbin1(subbin1val)
{	
	//var itemv=document.frmaddDepartment.txtitem.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	/*//alert("subbin");
		//var slocnogood=document.frmaddDepartment.tblslocnog.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.frmaddDepartment.txtslupsg1.value!="")
		var upsv1=document.frmaddDepartment.txtslupsg1.value;
		else
		var upsv1="";
		if(document.frmaddDepartment.txtslqtyg1.value!="")
		var qtyv1=document.frmaddDepartment.txtslqtyg1.value;
		else
		var qtyv1="";
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,upsv1,qtyv1);*/
	}
	
}


function mySubmit()
{ 
	if(document.frmaddDepartment.txtslwhg1.value=="")
	{
	alert("Please Select Wheare house ");
	document.frmaddDepartment.txtslwhg1.focus();
	return false;
	}
	if(document.frmaddDepartment.txtslbing1.value=="")
	{
	alert("Please Select Bin house ");
	document.frmaddDepartment.txtslbing1.focus();
	return false;
	}
	/*if(document.frmaddDepartment.txtslsubbg1.value=="")
	{
	alert("Please Select  SubBin");
	document.frmaddDepartment.txtslsubbg1.focus();
	return false;
	}*/
return true;
}
</script>



<body>

<!-- actual page start--->	
  
		
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="600"  style="border-collapse:collapse">
<tr>
<td>
 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />	 
<table align="center" border="1" width="489" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="25">
    <td colspan="2" align="center" class="tblheading">SLOC Search </td>
  </tr>
  <tr height="15">
    <td colspan="2" align="right" class="tblheading"><font color="#FF0000">*</font>indicates required field&nbsp;</td>
  </tr>
  <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode=$plantcode order by perticulars") or die(mysqli_error($link));
?>
  <td width="223"  align="right"  valign="middle" class="tblheading">&nbsp;Select Warehouse&nbsp; </td>
      <td width="295" colspan="3" align="left"  valign="middle">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:80px;" onchange="wh1(this.value);"  >
            <option value="" selected>-----WH---</option>
            <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
            <option value="<?php echo $noticia_whg1['whid'];?>" />    
            <?php echo $noticia_whg1['perticulars'];?>
            <?php } ?>
          </select>
        &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
  <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode=$plantcode") or die(mysqli_error($link));
?>
  <tr class="Dark" height="25">
    <td width="223" height="24"  align="right"  valign="middle" class="tblheading">Select Bin &nbsp;</td>
    <td width="295" align="left"  valign="middle" class="tbltext" id="bing1">&nbsp;<select class="tbltext" name="txtslbing1" style="width:80px;" onchange="bin1(this.value);" >
          <option value="" selected>------Bin-------</option>
        </select>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
  <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode=$plantcode") or die(mysqli_error($link));
?>
  <tr class="Light" height="25">
    <td width="223" height="24"  align="right"  valign="middle" class="tblheading"> Select Sub Bin &nbsp;</td>
    <td width="295" align="left"  valign="middle" class="tbltext" id="sbing1">&nbsp;
      <select class="tbltext" name="txtslsubbg1" style="width:80px;" onchange="subbin1(this.value);"  >
        <option value="ALL" selected>-----ALL---</option>
      </select>      &nbsp;&nbsp;</td>
  </tr>
</table>
<table id="sp" align="center" border="1" cellspacing="0" cellpadding="0" width="574" bordercolor="#adad11" style="border-collapse:collapse; display:none">
		 <tr class="Light" height="25">
		  <td width="188"  align="right"  valign="middle" class="tblheading">&nbsp;Lot Number&nbsp; </td>                                   
           <td colspan="3" align="left"  valign="middle">&nbsp;<input name="txtlot1" type="text" size="6" class="tbltext" tabindex="0" maxlength="6"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td></tr>
</table>

<table align="center" width="574" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center">&nbsp;&nbsp;<input name="Submit" type="image" src="../images/next.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;"><input type="hidden" name="typ" value="" /></td>
</tr>
</table>
</form> 
</td>
</tr>
</table>
		  
		  