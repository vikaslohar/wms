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
		$sltyp=trim($_POST['sltyp']);
		$whid="";$sid="";$bid="";$crop="";$variety="";$wh="";$bin="";$txtlot1="";
		if($sltyp=="whwise")
		{
			$whid=trim($_POST['txtslwhg1']);
			$sid=trim($_POST['txtslsubbg1']);
			$bid=trim($_POST['txtslbing1']);
		}
		else if($sltyp=="ebwise")
		{
			$wh=trim($_POST['txtwh']);
			$bin=trim($_POST['txtbin']);
		}
		else
		{
			$crop=trim($_POST['txtcrop']);
			$variety=trim($_POST['txtvariety']);
			$lotsltyp=trim($_POST['lotsltyp']);
			if($lotsltyp!="all")
			{
				$pcode = trim($_POST['pcode']);	 
				$ycodee= trim($_POST['ycodee']);	
				$txtlot2= trim($_POST['txtlot2']);	
				$stcode = trim($_POST['stcode']);
				$stcode2 = trim($_POST['stcode2']);		 
		
				$chr="C";	
				$txtlot1=$pcode.$ycodee.$txtlot2."/".$stcode."/".$stcode2.$chr;
			}
		}
		
			echo "<script>window.location='slocreport1.php?txtslwhg1=$whid&txtslsubbg1=$sid&txtslbing1=$bid&txtcrop=$crop&txtvariety=$variety&sltyp=$sltyp&txtwh=$wh&txtbin=$bin&lotsltyp=$lotsltyp&txtlot1=$txtlot1'</script>";	
	}
		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CSW - Utility - SLOC Search</title>
<link href="../include/main_csw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_csw.css" rel="stylesheet" type="text/css" />
</head>
<script src="sloc1.js"></script>
<script src="../include/validation.js"></script>
<SCRIPT language=JavaScript>
function modetchk(classval)
{	//alert("hi");
			showUser(classval,'vitem','item','','','','','');
}

function wh(whval)
{ //alert(wh1val);
	if(document.frmaddDepartment.txtwh.value!="")
	{
		showUser(whval,'bin1','wh1','bin1','','','','');
	}
	
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
		showUser(bin1val,'sbing1','bin','txtslsubbg1','','','','');
	}
	
}

function subbin1(subbin1val)
{	
	//var itemv=document.frmaddDepartment.txtitem.value;
	if(document.frmaddDepartment.txtslbing1.value!="")
	{	//alert("subbin");
		var slocnogood=document.frmaddDepartment.tblslocnog.value;
		//var slocnodamage=document.frmaddDepartment.tblslocnod.value;
		if(document.frmaddDepartment.txtslupsg1.value!="")
		var upsv1=document.frmaddDepartment.txtslupsg1.value;
		else
		var upsv1="";
		if(document.frmaddDepartment.txtslqtyg1.value!="")
		var qtyv1=document.frmaddDepartment.txtslqtyg1.value;
		else
		var qtyv1="";
		showUser(subbin1val,'slocrow1','subbin',itemv,'txtslsubbg1',slocnogood,upsv1,qtyv1);
	}
	
}

function sltypchk(sltyp)
{ 
	if(sltyp!="")
	{
		if(sltyp=="whwise")
		{
			document.getElementById("slw").style.display="block";
			document.getElementById("cvw").style.display="none";
			document.getElementById("ebw").style.display="none";
			document.getElementById("lotsl").style.display="none";
			document.frmaddDepartment.lotsltyp.value="all";
			document.frmaddDepartment.sltyp.value=sltyp;
		}
		else if(sltyp=="cvwise")
		{
			document.getElementById("slw").style.display="none";
			document.getElementById("cvw").style.display="block";
			document.getElementById("ebw").style.display="none";
			document.getElementById("lotsl").style.display="none";
			document.frmaddDepartment.lotsltyp.value="all";
			document.frmaddDepartment.sltyp.value=sltyp;
		}
		else
		{
			document.getElementById("slw").style.display="none";
			document.getElementById("cvw").style.display="none";
			document.getElementById("ebw").style.display="block";
			document.getElementById("lotsl").style.display="none";
			document.frmaddDepartment.lotsltyp.value="all";
			document.frmaddDepartment.sltyp.value=sltyp;
		}
	}
	else
	{
		document.frmaddDepartment.sltyp.value="";
	}
}

function lotnslchk(lotval)
{
		if(lotval=="fill")
		{
			document.getElementById("lotsl").style.display="block";
			document.frmaddDepartment.lotsltyp.value=lotval;
		}
		else
		{
			document.getElementById("lotsl").style.display="none";
			document.frmaddDepartment.lotsltyp.value=lotval;
		}
}
function mySubmit()
{ 
	if(document.frmaddDepartment.sltyp.value!="")
	{
		if(document.frmaddDepartment.sltyp.value=="whwise")
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
		}
		else if(document.frmaddDepartment.sltyp.value=="ebwise")
		{
			if(document.frmaddDepartment.txtwh.value=="")
			{
				alert("Please Select Wheare house ");
				document.frmaddDepartment.txtwh.focus();
				return false;
			}
			/*if(document.frmaddDepartment.txtslbing1.value=="")
			{
				alert("Please Select Bin house ");
				document.frmaddDepartment.txtslbing1.focus();
				return false;
			}*/
		}
		else
		{
			if(document.frmaddDepartment.txtcrop.value=="")
			{
				alert("Please Select Crop");
				document.frmaddDepartment.txtcrop.focus();
				return false;
			}
			if(document.frmaddDepartment.txtvariety.value=="")
			{
				alert("Please Select Variety");
				document.frmaddDepartment.txtvariety.focus();
				return false;
			}
			if(document.frmaddDepartment.lotsltyp.value!="all")
			{
				val2=document.frmaddDepartment.ycodee.value;
				val5=document.frmaddDepartment.txtlot2.value;
				val6=document.frmaddDepartment.stcode.value;
				val7=document.frmaddDepartment.pcode.value;
				val8=document.frmaddDepartment.stcode2.value;
				if(val7=="")
				{
					alert("Please Select Plant code");
					f=1;
					return false;
				}
				if(val2=="")
				{
					alert("Please Select Year Code");
					f=1;
					return false;
				}	
				if(val5=="")
				{
					alert("Please Enter Lot No.");
					f=1;
					return false;
				}
				if(val5.length < 5)
				{
					alert("Invalid Lot No.");
					f=1;
					return false;
				}
				if(val6=="")
				{
					alert("Please Enter Lot No.");
					f=1;
					return false;
				}
				if(val6.length < 5)
				{
					alert("Invalid Lot No.");
					f=1;
					return false;
				}
				if(val8=="")
				{
					alert("Please Enter Lot No.");
					f=1;
					return false;
				}
				if(val8.length < 2)
				{
					alert("Invalid Lot No.");
					f=1;
					return false;
				}
			}
		}
	}
	else
	{
		alert("Please Select SLOC search type");
		return false;
	}
return true;
}
</script>



<body>

<!-- actual page start--->	
  
		
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="489"  style="border-collapse:collapse">
<br />
<tr class="tblsubtitle" height="25">
    <td width="489" align="center" class="tblheading">SLOC Search </td>
  </tr>
<tr>
<td>
 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />	 
	  <input type="hidden" name="sltyp" value="" />
	  <input type="hidden" name="lotsltyp" value="all" />
<table align="center" border="1" width="489" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="25">
    <td colspan="2" align="center" class="tblheading">Select Option </td>
  </tr>
  
  <tr class="dark" height="25">
    <td align="right" width="208" class="tblheading"><input type="radio" name="slocsearch" value="whwise" onclick="sltypchk(this.value);" /></td>
    <td align="left" class="tblheading">&nbsp;Bin wise Search</td>
  </tr>
  <tr class="Light" height="25">
    <td align="right" class="tblheading"><input type="radio" name="slocsearch" value="cvwise" onclick="sltypchk(this.value);" /></td>
    <td align="left" class="tblheading">&nbsp;Product wise Search</td>
  </tr>
  <tr class="Light" height="25">
    <td align="right" class="tblheading"><input type="radio" name="slocsearch" value="ebwise" onclick="sltypchk(this.value);" /></td>
    <td align="left" class="tblheading">&nbsp;Empty Bin Search</td>
  </tr>
</table>
<div id="slw" style="display:none">
<table align="center" border="1" width="489" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >
  
  <tr height="15">
    <td colspan="2" align="right" class="tblheading"><font color="#FF0000">*</font>indicates required field&nbsp;</td>
  </tr>
   <tr class="Light" height="25">
  <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='".$plantcode."' order by perticulars") or die(mysqli_error($link));
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
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='".$plantcode."'") or die(mysqli_error($link));
?>
  <tr class="Dark" height="25">
    <td width="223" height="24"  align="right"  valign="middle" class="tblheading">Select Bin &nbsp;</td>
    <td width="295" align="left"  valign="middle" class="tbltext" id="bing1">&nbsp;<select class="tbltext" name="txtslbing1" style="width:80px;" onchange="bin1(this.value);" >
          <option value="" selected>------Bin-------</option>
        </select>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
  <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='".$plantcode."'") or die(mysqli_error($link));
?>
  <tr class="Light" height="25">
    <td width="223" height="24"  align="right"  valign="middle" class="tblheading"> Select Sub Bin &nbsp;</td>
    <td width="295" align="left"  valign="middle" class="tbltext" id="sbing1">&nbsp;<select class="tbltext" name="txtslsubbg1" style="width:80px;" onchange="subbin1(this.value);"  >
          <option value="ALL" selected>-----ALL---</option>
        </select>
      &nbsp;&nbsp;</td>
  </tr>
</table>
</div>
<div id="cvw" style="display:none">
<table align="center" border="1" width="489" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >
 <tr height="15">
    <td colspan="2" align="right" class="tblheading"><font color="#FF0000">*</font>indicates required field&nbsp;</td>
  </tr>
                <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>
 <tr class="Light" height="25">
<td align="right" width="208" valign="middle" class="tblheading" >Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onChange="modetchk(this.value)">
<option value="" selected>--Select--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
</tr>
                <tr class="Dark" height="25">
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem" >&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;" >
<option value="" selected>--Select--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>

<tr class="Light" height="25">
<td align="right" width="208" valign="middle" class="tblheading" >Lot Number&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"><input type="radio" name="lotnsl" value="all" checked="checked" onclick="lotnslchk(this.value);" />ALL&nbsp;&nbsp;<input type="radio" name="lotnsl" value="fill" onclick="lotnslchk(this.value);" />Fill</td>
</tr>
</table>
</div>
<div id="lotsl" style="display:none">
<table align="center" border="1" width="489" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >
		   <tr class="Light" height="25">
		  <td width="208"  align="right"  valign="middle" class="tblheading">&nbsp;Fill Lot Number&nbsp; </td><?php
$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
?>	
   <?php
   $quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode'   order by code asc");
   $row_month=mysqli_fetch_array($quer6);
  $a=$row_month['code'];
$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
?>	
                                   
           <td colspan="3" align="left"  valign="middle">&nbsp;<input type="hidden" name="pcode" value="<?php echo $a;?>"><?php echo $a;?>&nbsp;&nbsp;<select class="tbltext" name="ycodee" id="ycodee" style="width:40px;" onchange="ycodchk();">
    <option value="" selected="selected">--Select--</option>
    <?php while($noticia = mysqli_fetch_array($quer4)) { ?>
    <option value="<?php echo $noticia['ycode'];?>" />  
    <?php echo $noticia['ycode'];?>
    <?php } ?></select><input name="txtlot2" type="text" size="4" class="tbltext"  maxlength="5" onkeypress="return 
  isNumberKey(event)"  onchange="lot2chk();"  /> <font size="+1"><b>/</b></font> <input name="stcode" type="text" size="4" class="tbltext" tabindex="0" maxlength="5" onkeypress="return isNumberKey(event)"  value="00000" onchange="slocshow();" /> <font size="+1"><b>/</b></font> <input name="stcode2" type="text" size="2" class="tbltext" tabindex="0" maxlength="2" onkeypress="return isNumberKey(event)"  value="00"  />
	   <b>C</b>&nbsp;<font color="#FF0000">*</font>&nbsp;</td></tr>
	   
</table>
</div>

<div id="ebw" style="display:none">
<table align="center" border="1" width="489" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >
 <tr height="15">
    <td colspan="2" align="right" class="tblheading"><font color="#FF0000">*</font>indicates required field&nbsp;</td>
  </tr>
   <tr class="Light" height="25">
  <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='".$plantcode."' order by perticulars") or die(mysqli_error($link));
?>
  <td width="223"  align="right"  valign="middle" class="tblheading">&nbsp;Select Warehouse&nbsp; </td>
      <td width="295" colspan="3" align="left"  valign="middle">&nbsp;<select class="tbltext" name="txtwh" style="width:80px;" onchange="wh(this.value);"  >
            <option value="" selected>-----WH---</option>
            <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
            <option value="<?php echo $noticia_whg1['whid'];?>" />    
            <?php echo $noticia_whg1['perticulars'];?>
            <?php } ?>
          </select>
        &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
  <tr class="Dark" height="25">
    <td width="223" height="24"  align="right"  valign="middle" class="tblheading">Select Bin &nbsp;</td>
    <td width="295" align="left"  valign="middle" class="tbltext" id="bin1">&nbsp;<select class="tbltext" name="txtbin" style="width:80px;" >
          <option value="ALL" selected>--ALL--</option>
        </select>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
</table>
</div>

<table align="center" width="489" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center">&nbsp;&nbsp;<input name="Submit" type="image" src="../images/next.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;"><input type="hidden" name="typ" value="" /></td>
</tr>
</table>
</form> 
</td>
</tr>
</table>
		  
		  