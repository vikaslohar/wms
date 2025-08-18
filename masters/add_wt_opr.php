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
		$txtsrno=trim($_POST['txtsrno']);
		$txtfname=trim($_POST['txtfname']);
		$txtlname=trim($_POST['txtlname']);
		$txtshcode=trim($_POST['txtshcode']);
		$oprstatus=trim($_POST['oprstatus']);
		
		$query=mysqli_query($link,"SELECT * FROM tbl_rm_wtopr where wtopr_code='$txtshcode'") or die("Error: " . mysqli_error($link));
   		$numofrecords=mysqli_num_rows($query);
		
	 	 if( $numofrecords > 0)
		 {?>
		 <script>
		  alert("The Weighing Machine Operator with this Short Code is already present");
		  </script>
		 <?php }
		 else 
		 {
		$sql_in="insert into tbl_rm_wtopr(wtopr_srno, wtopr_fname, wtopr_lname, wtopr_code, wtopr_status) values('$txtsrno', '$txtfname', '$txtlname', '$txtshcode', '$oprstatus')";
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{
			echo "<script>window.location='home_wt_opr.php?print=add'</script>";	
		}
		}
	}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Administration - Weighing Machine Operator Master - Add Processing Operator</title>
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
function ucwords_w(str) { return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }

function onloadfocus()
	{
	document.frmaddcrop.txtcrop.focus();
	}
 
function isCharKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode != 32 && charCode != 8 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
return false;

//return true;
}
function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }

function fnamechk()
{
	if(document.frmaddcrop.txtfname.value=="")
	{
		alert("Enter First Name");
		document.frmaddcrop.txtfname.focus();
		return false;
	}
}

function lnamechk()
{
	if(document.frmaddcrop.txtlname.value=="")
	{
		alert("Enter Last Name");
		document.frmaddcrop.txtlname.focus();
		return false;
	}
}

function shcodechk(cval)
{
	document.frmaddcrop.txtshcode.value.toUpperCase();
	if(document.frmaddcrop.txtshcode.value=="")
	{
		alert("Enter Short Code");
		document.frmaddcrop.txtshcode.focus();
		return false;
	}
	else if(document.frmaddcrop.txtshcode.value < 5)
	{
		alert("Incorrect Short Code");
		document.frmaddcrop.txtshcode.focus();
		return false;
	}
	else
	{
		document.frmaddcrop.oprstatus.value=cval;
	}
}

function mySubmit()
{
	if(document.frmaddcrop.txtfname.value=="")
	{
		alert("Enter First Name");
		document.frmaddcrop.txtfname.focus();
		return false;
	}
	if(document.frmaddcrop.txtlname.value=="")
	{
		alert("Enter Last Name");
		document.frmaddcrop.txtlname.focus();
		return false;
	}
	document.frmaddcrop.txtshcode.value.toUpperCase();
	if(document.frmaddcrop.txtshcode.value=="")
	{
		alert("Enter Short Code");
		document.frmaddcrop.txtshcode.focus();
		return false;
	}
	if(document.frmaddcrop.txtshcode.value < 5)
	{
		alert("Incorrect Short Code");
		document.frmaddcrop.txtshcode.focus();
		return false;
	}
	if(document.frmaddcrop.oprstatus.value=="")
	{
		alert("Select Status");
		document.frmaddcrop.txtshcode.focus();
		return false;
	}
return true;
}

</SCRIPT>

<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"  onLoad="return onloadfocus()">
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
          <td width="100%" valign="top" height="500" align="center"  class="midbgline">

		  
<!-- actual page start--->	
	  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Weighing Machine Operator Master - Add</td>
	    </tr></table></td>
	    	 </tr>
	  </table></td></tr>
   	  <td align="center" colspan="4" >
	   
	  <form name="frmaddcrop" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return confirm('You are adding:\nTreatment Type:  '+document.frmaddcrop.txtcrop.value+'\nTreatment Details: ' +document.frmaddcrop.txtsig.value);" onReset="onloadfocus();"> 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="499" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1"style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="subheading">Add a NEW Weighing Machine Operator</td>
</tr>
<tr height="30">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
<?php
$sql_code="SELECT MAX(wtopr_srno) FROM tbl_rm_wtopr ORDER BY wtopr_srno DESC";
$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
if(mysqli_num_rows($res_code) > 0)
{
	$row_code=mysqli_fetch_row($res_code);
	$t_code=$row_code['0'];
	$code=$t_code+1;
}
else
{
	$code=1;
}
?>  
  <tr class="Light" height="25">
<td width="246" align="right" height="30" valign="middle" class="tblheading">Sr.No.&nbsp;</td>
<td width="247" align="left"  valign="middle">&nbsp;<input type="text" name="txtsrno" class="tbltext" size="10" maxlength="10" readonly="true" value="<?php echo $code;?>" style="background-color:#CCCCCC" /></td>
</tr>
<tr class="Light" height="25">
<td width="246" align="right" height="30" valign="middle" class="tblheading">First Name&nbsp;</td>
<td width="247" align="left"  valign="middle">&nbsp;<input type="text" name="txtfname" class="tbltext" size="20" maxlength="20" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td width="246" align="right" height="30" valign="middle" class="tblheading">Last Name&nbsp;</td>
<td width="247" align="left"  valign="middle">&nbsp;<input type="text" name="txtlname" class="tbltext" size="20" maxlength="20" onChange="fnamechk();" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td width="246" align="right" height="30" valign="middle" class="tblheading">Short Code&nbsp;</td>
<td width="247" align="left"  valign="middle">&nbsp;<input type="text" name="txtshcode" class="tbltext" size="5" maxlength="5" onKeyPress="return isCharKey(event)" onBlur="javascript:this.value=this.value.toUpperCase();" onChange="lnamechk();" />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td width="246" align="right" height="30" valign="middle" class="tblheading">Status&nbsp;</td>
<td width="247" align="left"  valign="middle" class="tbltext"><input type="radio" name="sstatus" value="Active" onChange="shcodechk(this.value);" />Active&nbsp;&nbsp;<input type="radio" name="sstatus" value="Inactive" onChange="shcodechk(this.value);" />Inactive&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr>
<input type="hidden" name="oprstatus" value="" />
</table>


<table align="center" width="509" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td width="489" align="center" valign="top"><a href="home_wt_opr.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<a href="javascript:document.frmaddcrop.reset()"><img src="../images/reset.gif" OnClick="myReset()"alt="reset"  border="0" style="display:inline;cursor:pointer;"></a>&nbsp;
  <input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" OnClick="return mySubmit()" border="0" style="display:inline;cursor:pointer;"></td>
</tr>
</table>
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
