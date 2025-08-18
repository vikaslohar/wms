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
		$typ=trim($_POST['typ']);
		
		  	
			if($typ=="qry")
			{
		 	$crop=trim($_POST['txtcrop']);
		 	$variety=trim($_POST['txtvariety']);
		  	/*$org=trim($_POST['txtorganizer']);
		   	$farmer=trim($_POST['txtfarmer']);
			$sdate=trim($_POST['sdate']);
			$edate=trim($_POST['edate']);*/
			echo "<script>window.location='utility_lot1.php?typ=$typ&txtcrop=$crop&txtloc=$loc&txtorganizer=$org&txtfarmer=$farmer&sdate=$sdate&edate=$edate'</script>";	
			}
			
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
<title>Drying - Utility Decode SLOC Look Up</title>
<link href="../include/main_drying.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_drying.css" rel="stylesheet" type="text/css" />
</head>
<script src="vaddresschk1.js"></script>
<script src="../include/validation.js"></script>
 <SCRIPT language="JavaScript">
function spfchk(classval)
{	
if(document.frmaddDepartment.spcodef.value!="") 
				{
						  
				if(document.frmaddDepartment.spcodef.value.charCodeAt() == 32)
				{
					alert("Seed Production (SP) Code-Female cannot start with a Space!");
					return false;
					document.frmaddDepartment.spcodef.focus();
				} 
		   
				if(document.frmaddDepartment.spcodef.value.length < 5)
				{
				alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
				return false;
				document.frmaddDepartment.spcodef.focus();
				}
		   
				if(document.frmaddDepartment.spcodef.value!="") 
				 {
		  
					if(!isChar_W(document.frmaddDepartment.spcodef.value.charAt(0)))
					{
					alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
					document.frmaddDepartment.spcodef.focus();
					return false;
					} 
				 
					if(!isChar_W(document.frmaddDepartment.spcodef.value.charAt(1)))
					{
					alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
					document.frmaddDepartment.spcodef.focus();
					return false;
					}  
			   
					 if(isNaN(document.frmaddDepartment.spcodef.value.charAt(2)))
					 {
					 alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
					 document.frmaddDepartment.spcodef.focus();
					 return false;
					 }
			  
					if(isNaN(document.frmaddDepartment.spcodef.value.charAt(3)))
					{
					alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
					frmaddDepartment.spcodef.focus();
					return false;
					} 
				 
					if(isNaN(document.frmaddDepartment.spcodef.value.charAt(4)))
					{
					alert("Seed Production (SP) Code-Female can be of 5 alphanumric digits e.g. AA123");
					document.frmaddDepartment.spcodef.focus();
					return false;
					} 
				 
				}
				}
				else
				{
				document.getElementById("vitem").innerHTML="";
				document.getElementById("qr").innerHTML="";
				alert ("Please add Seed Production (SP) Code-Female");
				document.frmaddDepartment.spcodef.focus();
				return false;
				}
/*if(document.frmaddDepartment.txtcrop.value=="" && document.frmaddDepartment.txtvariety.value=="")
{
document.getElementById("tt").innerHTML="";
//document.getElementById("tt").display="none";	
}
else if(document.frmaddDepartment.txtcrop.value!="" && document.frmaddDepartment.txtvariety.value!="")
{
document.getElementById("tt").display="block";	
}
*/}

function spmchk(val)
{

		if(document.frmaddDepartment.spcodef.value=="") 
		{
			
			alert ("Please add Seed Production (SP) Code-Female");
			document.frmaddDepartment.spcodef.focus();
			return false;
		}
		
			if (document.frmaddDepartment.spcodem.value!="") 
			{
				///document.getElementById("vitem").style.display="block";	 
				if(document.frmaddDepartment.spcodem.value.charCodeAt() == 32)
			{
			alert("Seed Production (SP) Code-Male cannot start with a Space!");
			frmaddDepartment.spcodem.focus();
			return false;
			} 
		   
			if(document.frmaddDepartment.spcodem.value.length < 5)
			{
			alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
			document.frmaddDepartment.spcodem.focus();
			return false;
			}
		   
			if(document.frmaddDepartment.spcodem.value!="") 
			{
		  
				if(!isChar_W(document.frmaddDepartment.spcodem.value.charAt(0)))
				{
				alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
				document.frmaddDepartment.spcodem.focus();
				return false;
				}  
				
				if(!isChar_W(document.frmaddDepartment.spcodem.value.charAt(1)))
				{
				alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
				document.frmaddDepartment.spcodem.focus();
				return false;
				}  
			   
			   if(isNaN(document.frmaddDepartment.spcodem.value.charAt(2)))
				{
				alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
				document.frmaddDepartment.spcodem.focus();
				return false;
				}
			  
			  if(isNaN(document.frmaddDepartment.spcodem.value.charAt(3)))
				{
				alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
				document.frmaddDepartment.spcodem.focus();
				return false;
				}  
				
			  if(isNaN(document.frmaddDepartment.spcodem.value.charAt(4)))
				{
				alert("Seed Production (SP) Code-Male can be of 5 alphanumric digits e.g. AA123");
				document.frmaddDepartment.spcodem.focus();
				return false;
				} 
				 
			}
			//document.getElementById("tt").style.display="block";
			//var crop=document.frmaddDepartment.txtcrop.value;
			var spf=document.frmaddDepartment.spcodef.value;
			showUser(spf,'vitem','item',val,'','','');
			//
		}
		else
		{
			document.getElementById("vitem").innerHTML="";
			document.getElementById("qr").innerHTML="";
			alert ("Please add Seed Production (SP) Code-Male");
			document.frmaddDepartment.spcodem.focus();
			return false;
		}
			
}

function mySubmit()
{ 
	//var typ=document.frmaddDepartment.typ.value;
	//var crop=document.frmaddDepartment.txtcrop.value;
	var spf=document.frmaddDepartment.spcodef.value;
	var spm=document.frmaddDepartment.spcodem.value;
	//alert(crop);
	if(crop=="")
	{
			alert ("Select Crop");
			document.frmaddDepartment.txtcrop.focus();
			return false;
	}
	else if(spf=="")
	{
			alert ("Please add Seed Production (SP) Code-Female");
			document.frmaddDepartment.spcodef.focus();
			return false
	}
	else if(spm=="")
	{
			alert ("Please add Seed Production (SP) Code-Male");
			document.frmaddDepartment.spcodem.focus();
			return false
	}
	else 
	{
			document.getElementById("qr").style.display="block";	 
			showUser(spf,'qr','showsloc',spm,'','','');
	}
}
</script>


<body>

<!-- actual page start--->	
<?php

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$crop."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crop=$row_crop['cropname'];

$sql_variety=mysqli_query($link,"select * from tblvariety where varietyid='".$variety."'  and vertype='PV'") or die(mysqli_error($link));
$row_variety=mysqli_fetch_array($sql_variety);
$variet=$row_variety['popularname'];

$tot_row=0;
$lotqry=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   lotno='".$a."' and lotcrop='".$crop."' and lotvariety='".$variet."'")or die (mysqli_error($link));
$row= mysqli_fetch_array($lotqry);
$tot_row=mysqli_num_rows($lotqry);
$lot=$row['lotcrop'];	

 
 if($row['lotvariety']!="")
 {
 	$variety=$row['lotvariety'];
 	$lotqry1=mysqli_query($link,"select * from tblvariety where popularname='".$variety."'  and vertype='PV'");
	$t=mysqli_num_rows($lotqry1);
	$row11=mysqli_fetch_array($lotqry1)or die (mysqli_error($link));
	$i=$row11['varietyid'];
 }
 else
 {
 	$sql_spc=mysqli_query($link,"select * from tblspcodes where  spcodem='".$row['lotspcodem']."' and spcodef='".$row['lotspcodef']."'") or die(mysqli_error($link));
	$row_spc=mysqli_fetch_array($sql_spc);
	$xx=mysqli_num_rows($sql_spc);
	if($xx > 0)
	{
	$x=$row_spc['variety'];
	$z=$row_spc['crop'];
	$lotqry1=mysqli_query($link,"select * from tblvariety where varietyid='".$x."'  and vertype='PV'");
	$t=mysqli_num_rows($lotqry1);
	$row11=mysqli_fetch_array($lotqry1)or die (mysqli_error($link));
	$variety=$row11['popularname'];
	$qctyp=$row11['opt'];
	}
	else
	{
	$variety="";
	$qctyp="";
	$x=0;
	}
 }
 $sql_arr_home=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   arrival_type='Fresh Seed with PDN' and  arrival_date <= '$edate' and arrival_date >= '$sdate' and lotcrop='".$itemid."' and lotvariety='".$vv."' and arrtrflag=1 order by arrival_date asc ") or die(mysqli_error($link));

		?>
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="600"  style="border-collapse:collapse">
<br />

<tr>
<td>
 <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />	 
<table align="center" border="1" width="574" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Decode SLOC Look Up</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
</table>
			
<table align="center" border="1" cellspacing="0" cellpadding="0" width="574" bordercolor="#adad11" style="border-collapse:collapse">
		  <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc"); 
?>
 <!--<tr class="Light" height="25">
<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="377" colspan="3" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" >
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
            <font color="#FF0000">*</font>&nbsp;</td>
          </tr>-->
			<?php
			
	?>	 <tr class="Light" height="25">
		  <td width="191"  align="right"  valign="middle" class="tblheading">&nbsp;SP Code Female&nbsp; </td>                                   
           <td colspan="3" align="left"  valign="middle">&nbsp;<input name="spcodef" type="text" size="5" class="tbltext" tabindex="0" maxlength="5" onchange="spfchk(this.value)" onBlur="javascript:this.value=this.value.toUpperCase();"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td></tr>
		   <tr class="Light" height="25">
		  <td width="191"  align="right"  valign="middle" class="tblheading">&nbsp;SP Code Male&nbsp; </td>                                   
           <td colspan="3" align="left"  valign="middle">&nbsp;<input name="spcodem" type="text" size="5" class="tbltext" tabindex="0" maxlength="5"  onchange="spmchk(this.value)" onBlur="javascript:this.value=this.value.toUpperCase();"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td></tr>

</table>
<div id="vitem" style="display:block"><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class="subheading">Press enter after filling the SP Code Male</font></div> 
<div id="qr" style="display:block"></div>
	  

</form> 
</td>
</tr>
</table>
		  
