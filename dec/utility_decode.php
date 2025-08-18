<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	/*echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';*/
	header('Location: ../login.php');
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
		 	$typ = $_POST['tp'];
		    if($typ=="slect")
			{
			$crop=trim($_POST['txtcrop']);
		 	$loc=trim($_POST['txtloc']);
			}
			else
			{
			$crop=trim($_POST['txtcrop1']);
		 	$loc=trim($_POST['txtloc1']);
			}
		
			/*echo "<script>window.location='utility_decode1.php?txtcrop=$crop&txtloc=$loc'</script>";	*/
			header('Location: utility_decode1.php?txtcrop='.$crop.'&txtloc='.$loc);
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
<title>Decode-SP code Query</title>
<link href="../include/main_dec.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dec.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschk1.js"></script>
<script src="../include/validation.js"></script>
 <SCRIPT language=JavaScript>

function openprint()
{
//var dateto=document.frmaddDepartment.dateto.value;
//var datefrom=document.frmaddDepartment.datefrom.value;
winHandle=window.open('pdn.php','WelCome','top=20,left=10,width=800,height=180,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}




function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDepartment.sdate,dt,document.frmaddDepartment.sdate, "dd-mmm-yyyy", xind, yind);
	}
	
	function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDepartment.edate,dt,document.frmaddDepartment.edate, "dd-mmm-yyyy", xind, yind);
	}

function chk(typ)
{
		if(typ=="slect")	
		{
			document.getElementById("qr").style.display="block";
			document.getElementById("sp").style.display="none";	
			document.frmaddDepartment.tp.value=typ;
		}
		else if(typ=="fil")	
		{
			document.getElementById("qr").style.display="none";
			document.getElementById("sp").style.display="block";	
			document.frmaddDepartment.tp.value=typ;
		}
		else
		{
			alert("Select Type");
			return false;
		}
		
}

function mySubmit()
{ 
	var typ=document.frmaddDepartment.tp.value;
	if(typ=="slect")	
	{
		if(document.frmaddDepartment.txtcrop.value=="")
		{
			alert("Select SP Code Male");
			document.frmaddDepartment.txtcrop.focus();
			return false;
		}
		
			if(document.frmaddDepartment.txtloc.value=="")
		{
			alert("Select SP Code Female");
			document.frmaddDepartment.txtloc.focus();
			return false;
		}
	}
	else if(typ=="fil")	
	{
			if(document.frmaddDepartment.txtcrop1.value=="")
			{
				alert("Please add SP Code-Male");
				document.frmaddDepartment.txtcrop1.focus();
				return false;
			}
			if(document.frmaddDepartment.txtcrop1.value.charCodeAt() == 32)
	  		{
				alert("SP Code-Male cannot start with a Space!");
				return false;
				document.frmaddDepartment.txtcrop1.focus();
	   		} 
	   
	   		if(document.frmaddDepartment.txtcrop1.value.length < 5)
	  		{
				alert("SP Code-Male can be of 5 alphanumric digits e.g. AA123");
				return false;
				document.frmaddDepartment.txtcrop1.focus();
	   		}
	   
	    	if(document.frmaddDepartment.txtcrop1.value!="") 
	 		 {
	  
		   		if(!isChar_W(document.frmaddDepartment.txtcrop1.value.charAt(0)))
				{
					alert("SP Code-Male can be of 5 alphanumric digits e.g. AA123");
					document.frmaddDepartment.txtcrop1.focus();
					return false;
				} 
			 
				if(!isChar_W(document.frmaddDepartment.txtcrop1.value.charAt(1)))
			  	{
					alert("SP Code-Male can be of 5 alphanumric digits e.g. AA123");
					document.frmaddDepartment.txtcrop1.focus();
					return false;
		  		}  
		   
		   		 if(isNaN(document.frmaddDepartment.txtcrop1.value.charAt(2)))
		 		 {
					 alert("SP Code-Male can be of 5 alphanumric digits e.g. AA123");
					 document.frmaddDepartment.txtcrop1.focus();
					 return false;
		  		 }
		  
		  		if(isNaN(document.frmaddDepartment.txtcrop1.value.charAt(3)))
		  		{
					alert("SP Code-Male can be of 5 alphanumric digits e.g. AA123");
					document.frmaddDepartment.txtcrop1.focus();
					return false;
		  		} 
			 
		  		if(isNaN(document.frmaddDepartment.txtcrop1.value.charAt(4)))
		  		{
					alert("SP Code-Male can be of 5 alphanumric digits e.g. AA123");
					document.frmaddDepartment.txtcrop1.focus();
					return false;
		  		} 
	         
	  		}
		
			if(document.frmaddDepartment.txtloc1.value=="")
			{
				alert("Please add SP Code-Female");
				document.frmaddDepartment.txtloc1.focus();
				return false;
			}
			if(document.frmaddDepartment.txtloc1.value.charCodeAt() == 32)
	  		{
				alert("SP Code-Female cannot start with a Space!");
				return false;
				document.frmaddDepartment.txtloc1.focus();
	   		} 
	   
	   		if(document.frmaddDepartment.txtloc1.value.length < 5)
	  		{
				alert("SP Code-Female can be of 5 alphanumric digits e.g. AA123");
				return false;
				document.frmaddDepartment.txtloc1.focus();
	   		}
	   
	    	if(document.frmaddDepartment.txtloc1.value!="") 
	 		 {
	  
		   		if(!isChar_W(document.frmaddDepartment.txtloc1.value.charAt(0)))
				{
					alert("SP Code-Female can be of 5 alphanumric digits e.g. AA123");
					document.frmaddDepartment.txtloc1.focus();
					return false;
				} 
			 
				if(!isChar_W(document.frmaddDepartment.txtloc1.value.charAt(1)))
			  	{
					alert("SP Code-Female can be of 5 alphanumric digits e.g. AA123");
					document.frmaddDepartment.txtloc1.focus();
					return false;
		  		}  
		   
		   		 if(isNaN(document.frmaddDepartment.txtloc1.value.charAt(2)))
		 		 {
					 alert("SP Code-Female can be of 5 alphanumric digits e.g. AA123");
					 document.frmaddDepartment.txtloc1.focus();
					 return false;
		  		 }
		  
		  		if(isNaN(document.frmaddDepartment.txtloc1.value.charAt(3)))
		  		{
					alert("SP Code-Female can be of 5 alphanumric digits e.g. AA123");
					document.frmaddDepartment.txtloc1.focus();
					return false;
		  		} 
			 
		  		if(isNaN(document.frmaddDepartment.txtloc1.value.charAt(4)))
		  		{
					alert("SP Code-Female can be of 5 alphanumric digits e.g. AA123");
					document.frmaddDepartment.txtloc1.focus();
					return false;
		  		} 
	         
	  		}
		
	}
	else
	{
		alert("Select Type");
		return false;
	}

return true;
}
</script></script>


<body>

<!-- actual page start--->	
  
		
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="600"  style="border-collapse:collapse">
<tr>
<td>
 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
<br />
	  	 
<table align="center" border="1" width="574" cellspacing="0" cellpadding="0" bordercolor="#7a9931"
 style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Utility Decode</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
		 <tr class="Light" height="25">
           <td width="230" height="30" align="right" valign="middle" class="tblheading">Utility Decode type&nbsp;</td>
           <td width="338" align="left"  valign="middle" ><input type="radio" name="typ" value="slect" onclick="chk(this.value)" />Select SP Code&nbsp;&nbsp;<input type="radio" name="typ" value="fil" onclick="chk(this.value)" />Fill SP Code</td>
         </tr>
</table>

<table id="qr" align="center" border="1" cellspacing="0" cellpadding="0" width="574" bordercolor="#7a9931"
 style="border-collapse:collapse; display:none" >		 
<?php
$quer2=mysqli_query($link,"SELECT Distinct(spcodef) FROM tblspcodes order by spcodef Asc"); 
?>
		 <tr class="Light" height="25">
           <td width="232" align="right"  valign="middle" class="tblheading">SPC-Female&nbsp;</td>
           <td width="336" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtloc" style="width:170px;" onchange="farmchk(this.value)">
<option value="" selected>--Select SPC-Female--</option>
	<?php while($noticia = mysqli_fetch_array($quer2)) { ?>
		<option value="<?php echo $noticia['spcodef'];?>" />   
		<?php echo $noticia['spcodef'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
<?php
$quer3=mysqli_query($link,"SELECT Distinct(spcodem) FROM tblspcodes order by spcodem Asc"); 
?>
		 <tr class="Light" height="25">
           <td align="right"  valign="middle" class="tblheading">SPC-Male&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="crop(this.value)">
<option value="" selected>--Select SPC-Male--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['spcodem'];?>" />   
		<?php echo $noticia['spcodem'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

         </tr>
		
</table>		

<table id="sp" align="center" border="1" cellspacing="0" cellpadding="0" width="574" bordercolor="#7a9931"
 style="border-collapse:collapse; display:none" >		 
<?php
$quer2=mysqli_query($link,"SELECT Distinct(spcodef) FROM tblspcodes order by spcodef Asc"); 
?>
		 <tr class="Light" height="25">
           <td width="232" align="right"  valign="middle" class="tblheading">SPC-Female&nbsp;</td>
           <td width="336" colspan="3" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtloc1" size="4" maxlength="5" onblur="javascript:this.value=this.value.toUpperCase();" class="tbltext" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
         </tr>
<?php
$quer3=mysqli_query($link,"SELECT Distinct(spcodem) FROM tblspcodes order by spcodem Asc"); 
?>
		 <tr class="Light" height="25">
           <td align="right"  valign="middle" class="tblheading">SPC-Male&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<input type="text" name="txtcrop1" size="4" maxlength="5" onblur="javascript:this.value=this.value.toUpperCase();" class="tbltext" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

         </tr>
		
</table>	
<table align="center" width="574" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center">&nbsp;&nbsp;<input name="Submit" type="image" src="../images/next.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;"><input type="hidden" name="tp" value="" /></td>
</tr>
</table>
</form> 
</td>
</tr>
</table>
		  
		  