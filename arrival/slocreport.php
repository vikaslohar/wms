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
		 $whid1=trim($_POST['txtslwhg11']);
		 $sid=trim($_POST['txtslsubbg1']);
		 $bid=trim($_POST['txtslbing1']);
		 $bid1=trim($_POST['txtslbing11']);
		 $txtcrop=trim($_POST['txtcrop']);
		 $txtvariety=trim($_POST['txtvariety']);
		 $txtstage=trim($_POST['txtstage']);
		 $reptyp=trim($_POST['reptyp']);
		
		//exit;
			
			echo "<script>window.location='slocreport1.php?txtslwhg1=$whid&txtslwhg11=$whid1&txtslsubbg1=$sid&txtslbing1=$bid&txtslbing11=$bid1&txtcrop=$txtcrop&txtvariety=$txtvariety&txtstage=$txtstage&reptyp=$reptyp'</script>";	
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
<title>Arrival - Utility - SLOC Search</title>
<link href="../include/main_arrival.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
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
		showUser(bin1val,'sbing1','bin','txtslsubbg1','','','','');
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
function wh11(wh1val1)
{ 
//alert("wh1val");
	if(document.frmaddDepartment.txtslwhg11.value!="")
	{
		showUser(wh1val1,'bing11','wh1','bing11','','','','');
	}
	
}


/*function bin11(bin1val1)
{
alert(bin1val1);
	if(document.frmaddDepartment.txtslwhg11.value!="")
	{
		showUser(bin1val1,'sbing11','bin1','txtslsubbg11','','','');
	}
	}*/
function typchk(opt)
{
document.frmaddDepartment.txt11.value=opt;
		if(opt!="")
	{
		if(opt=="select")
		{
			document.getElementById('trans').style.display="block";
			document.getElementById('courier').style.display="none";
			document.getElementById('byhand').style.display="none";
		
		}
		else if(opt=="lotno")
		{
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="block";
			document.getElementById('byhand').style.display="none";
			
		}	
		else 
		{
			document.getElementById('trans').style.display="none";
			document.getElementById('courier').style.display="none";
			document.getElementById('byhand').style.display="block";
	}
	}
}
function modetchk(classval)
{
	//alert(classval);
	showUser(classval,'vitem','item1','','','','','');
	//document.frmaddDepartment.txtlot1.value==""
	}

function mySubmit()
{ var maintyp=document.frmaddDepartment.reptyp.value=document.frmaddDepartment.txt11.value;
	if(maintyp=="")
	{
		alert("Please Select Option");
		return false;
	}
	if(maintyp=="select")
		{
			val1=document.frmaddDepartment.txtcrop.value;
			val2=document.frmaddDepartment.txtvariety.value;
			val4=document.frmaddDepartment.txtstage.value;
			//val5=document.frmaddDepartment.txtlot1.value;
			val3="";
			if(val1=="")
			{
				alert("Please Select Crop");
				return false;
			}
			if(val2=="")
			{
				alert("Please Select Variety");
				return false;
			}
			if(val4=="")
			{
				alert("Please Select Stage");
				return false;
			}
			}
			if(maintyp=="lotno")
		{
			if(document.frmaddDepartment.txtslwhg1.value=="")
	{
	alert("Please Select Werehouse");
	document.frmaddDepartment.txtslwhg1.focus();
	return false;
	}
	if(document.frmaddDepartment.txtslbing1.value=="")
	{
	alert("Please Select Bin");
	document.frmaddDepartment.txtslbing1.focus();
	return false;
	}
	if(document.frmaddDepartment.txtslsubbg1.value=="")
	{
	alert("Please Select SubBin");
	document.frmaddDepartment.txtslsubbg1.focus();
	return false;
	}
	}
		if(maintyp=="sno")
		{
		if(document.frmaddDepartment.txtslwhg11.value=="")
	{
	alert("Please Select Werehouse ");
	document.frmaddDepartment.txtslwhg11.focus();
	return false;
	}
	if(document.frmaddDepartment.txtslbing11.value=="")
	{
	alert("Please Select Bin");
	document.frmaddDepartment.txtslbing11.focus();
	return false;
	}
}
	/**/
return true;
}
</script>



<body>

<!-- actual page start--->	
  
		
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="500"  style="border-collapse:collapse">
<br />

<tr class="tblsubtitle" height="25">
                  <td colspan="4" align="center" class="tblheading">SLOC Search</td>
                </tr>
<tr>
<td>
 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />	 
<table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >

                <tr class="tblsubtitle" height="25">
                  <td colspan="4" align="center" class="tblheading">Select an Option</td>
                </tr>
  		
				<tr class="Light" height="25">
                  <td width="193" align="right"  valign="middle" ><input type="radio" name="reptyp" value="select" onClick="typchk(this.value);" /></td>
					<td width="351" height="30" align="left" valign="middle" class="tblheading">&nbsp;Product wise Search &nbsp;</td>
                </tr>
				<tr class="Dark" height="25">
                    <td align="right"  valign="middle" ><input type="radio" name="reptyp" value="lotno" onClick="typchk(this.value);" /></td>
					<td align="left" height="30" valign="middle" class="tblheading">&nbsp;Bin wise Search&nbsp;</td>
                </tr>
				<tr class="Light" height="25">
           <td align="right"  valign="middle" ><input type="radio" name="reptyp" value="sno" onClick="typchk(this.value);" /></td>
		   <td align="left" height="30" valign="middle" class="tblheading">&nbsp;Empty Bin Search&nbsp;</td>
               </tr>
              </table>
			  
<div id="trans" style="display:none">
           <table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#F1B01E"  style="border-collapse:collapse"  > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Search</td>
</tr>
<tr height="15">
<td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

<tr class="Dark" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");

?>

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' and vertype='PV' order by popularname Asc"); 
?>
	<td width="60" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="186" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
         <tr class="Light" height="30" id="vitem">
		 <td width="97" align="right" valign="middle" class="tblheading">Seed Stage&nbsp;</td>
<td width="197"  align="left" valign="middle" class="tbltext" colspan="3" >&nbsp;<select class="tbltext" name="txtstage" style="width:170px;">
    <option value="" selected>--Select--</option>
    <option value="Raw" >Raw</option>
    <!--<option value="Condition">Condition </option>
	 <option value="Pack">Pack </option>-->
  </select>&nbsp;<font color="#FF0000">*</font>	</td>
             </tr>
	</table>		  
		   
</div>

<div id="courier" style="display:none">
           <table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#F1B01E"  style="border-collapse:collapse"  > 

  <tr class="tblsubtitle" height="25">
    <td colspan="2" align="center" class="tblheading">SLOC Search </td>
  </tr>
  <tr height="15">
    <td colspan="2" align="right" class="tblheading"><font color="#FF0000">*</font>indicates required field&nbsp;</td>
  </tr>
   <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse order by perticulars") or die(mysqli_error($link));
?>
  <td width="223"  align="right"  valign="middle" class="tblheading">&nbsp;Select Warehouse&nbsp; </td>
      <td width="295" align="left"  valign="middle">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:80px;" onchange="wh1(this.value);"  >
            <option value="" selected>-----WH---</option>
            <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
            <option value="<?php echo $noticia_whg1['whid'];?>" />    
            <?php echo $noticia_whg1['perticulars'];?>
            <?php } ?>
          </select>
        &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
  <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin") or die(mysqli_error($link));
?>
  <tr class="Dark" height="25">
    <td width="223" height="24"  align="right"  valign="middle" class="tblheading">Select Bin &nbsp;</td>
    <td width="295" align="left"  valign="middle" class="tbltext" id="bing1">&nbsp;<select class="tbltext" name="txtslbing1" style="width:80px;" onchange="bin1(this.value);" >
          <option value="" selected>------Bin-------</option>
        </select>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
  <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin") or die(mysqli_error($link));
?>
  <tr class="Light" height="25">
    <td width="223" height="24"  align="right"  valign="middle" class="tblheading"> Select Sub Bin &nbsp;</td>
    <td width="295" align="left"  valign="middle" class="tbltext" id="sbing1">&nbsp;<select class="tbltext" name="txtslsubbg1" style="width:80px;"   >
        <option value="ALL" selected>-----ALL---</option>
      </select>      &nbsp;&nbsp;</td>
  </tr>
</table>
</div>
	
		   

<div id="byhand" style="display:none">
           <table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse"  > 
		   <tr class="tblsubtitle" height="25">
    <td colspan="2" align="center" class="tblheading">SLOC Search </td>
  </tr>
		  <tr height="15">
    <td colspan="2" align="right" class="tblheading"><font color="#FF0000">*</font>indicates required field&nbsp;</td>
  </tr>
  <?php
$whg1_query1=mysqli_query($link,"select whid, perticulars from tbl_warehouse order by perticulars") or die(mysqli_error($link));
?>
  <td width="223"  align="right"  valign="middle" class="tblheading">&nbsp;Select Warehouse&nbsp; </td>
      <td width="295" align="left"  valign="middle">&nbsp;<select class="tbltext" name="txtslwhg11" style="width:80px;" onchange="wh11(this.value);"  >
            <option value="" selected>-----WH---</option>
            <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query1)) { ?>
            <option value="<?php echo $noticia_whg1['whid'];?>" />    
            <?php echo $noticia_whg1['perticulars'];?>
            <?php } ?>
          </select>
        &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
  <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin") or die(mysqli_error($link));
?>
  <tr class="Dark" height="25">
    <td width="223" height="24"  align="right"  valign="middle" class="tblheading">Select Bin &nbsp;</td>
    <td width="295" align="left"  valign="middle" class="tbltext" id="bing11">&nbsp;<select class="tbltext" name="txtslbing11" style="width:80px;" >
          <option value="ALL" selected>------ALL-------</option>
        </select>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
 
</table>		  
</div>
<!----><table width="250" align="center" cellpadding="5" cellspacing="5" border="0" >
                  <tr >
                    <td valign="top" align="center">&nbsp;<input name="Submit" type="image" src="../images/next.gif" alt="next Value"  border="0" style="display:inline;cursor:pointer;" onClick="return mySubmit();" />
                        <input type="hidden" name="txtinv" />
                      <input name="txt11" value="" type="hidden"> 
                      <input type="hidden" name="flagcode1" value=""/><a href="excel-binall.php?txtslwhg1=1"><img src="../../stores/images/excelicon1.jpg" border="0" /></a></td>
                  </tr>
              </table>



</form> 
</td>
</tr>
</table>
		  
		  