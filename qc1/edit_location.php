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
	
	if(isset($_REQUEST['gotloc_id']))
	{
	 $id = $_REQUEST['gotloc_id'];
	}
	
		
	if(isset($_GET['id']))
	{
	 $id = $_GET['id'];
	}
	
		if(isset($_POST['frm_action'])=='submit')
	{
		$location=trim($_POST['txtlocation']);
		$state=trim($_POST['cstate']);
		$query=mysqli_query($link,"SELECT * FROM tbl_gotloc where gotloc_name='$location' and gotloc_state='$state'and gotloc_id!='$id'") or die("Error: " . mysqli_error($link));
   		$numofrecords=mysqli_num_rows($query);
	 	 if( $numofrecords > 0)
		 {?>
		 <script>
		  alert("Location is Already Present in this  State.");
		  </script>
		 <?php }
		 else 
		 {
		$sql_in="UPDATE tbl_gotloc SET gotloc_name='$location' ,gotloc_state='$state' where gotloc_id = '$id'";
											
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{
			echo "<script>window.location='home_location.php?print=add'</script>";	
		}
		}
	}
	
	/*$sql_code="SELECT MAX(`productioncode`) FROM tbl_gotloc  ORDER BY `productioncode` DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code=sprintf("%004d",$code);
		}
		else
		{
			$code=sprintf("%004d","0001");
		}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administration - GOT Location Master -Edit Location</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
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
/*function isCharKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode != 8 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
return false;

return true;
}*/
function isCharKey(evt)
{
var charCode = (evt.which) ? evt.which : evt.keyCode
if (charCode != 32 && charCode != 8 && charCode != 46 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
return false;

return true;
}
function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }function 

onloadfocus()
	{
	document.frmprodloc.txtlocation.focus();
	}
	function f2(val)
{
	if(document.frmprodloc.cstate.value=="")
	{
	alert("Please Select State");
	 document.frmprodloc.txtlocation.value="";
	 document.frmprodloc.cstate.focus();
	 return false;
	}
	}
	function mySubmit()
{  if(document.frmprodloc.cstate.value=="")
	{
		alert(" Please Select State");
		document.frmprodloc.cstate.focus();
		return false;
	}
	
	if(document.frmprodloc.txtlocation.value=="")
	{
	alert("Please Enter Location");
	document.frmprodloc.txtlocation.focus();
	return false;
	}
	if(document.frmprodloc.txtlocation.value.charCodeAt() == 32)
	{
	alert("Location cannot start with space.");
	document.frmprodloc.txtlocation.focus();
	return false;
	}
	
	return true;
}
</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
       <tr>
          <td valign="top"><?php require_once("../include/arr_qcs.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  height="500" align="center"  class="midbgline">
		  
		  
<!-- actual page start--->	
	  
		   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;GOT Location Master - Edit  Location </td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
  
  <?php
	 $sql1=mysqli_query($link,"SELECT * FROM tbl_gotloc where gotloc_id='$id'")or die(mysqli_error($link));
  	$row=mysqli_fetch_array($sql1);
	 ?>
	  
	  <td align="center" colspan="4" >
	  
	<form name="frmprodloc" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return confirm('You are adding  Location:'+document.frmprodloc.txtlocation.value+'\nState:'+document.frmprodloc.cstate.value);" > 
 <input name="frm_action" value="submit" type="hidden">
 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">&nbsp;Edit GOT Location </td>
</tr>
<tr height="30">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
  <?php
$sq_states=mysqli_query($link,"Select * from tbl_state order by state_name asc") or die(mysqli_error($link));
$t_states=mysqli_num_rows($sq_states);
?>	
  <tr class="Dark" height="25">
    <td width="184"  align="right"  valign="middle" class="tblheading">&nbsp;State&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="5">&nbsp;<select name="cstate" class="tbltext"  style="width:170px;" tabindex="" onChange="modetchk1(this.value)">
        <option value="" selected="selected">--Select State--</option>
		<?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
			<option value="<?php echo $ro_states['state_id'];?>" <?php if($row['gotloc_state']==$ro_states['state_name']){ echo "Selected";} ?>  ><?php echo $ro_states['state_name'];?></option>
		<?php } ?>  
          
        </select>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
<tr class="Light" height="25">
 <td align="right" height="30" valign="middle" class="tblheading">&nbsp;GOT Location (City/Town/Village)&nbsp;</td>
<td width="281" align="left"  valign="middle">&nbsp;<input name="txtlocation" type="text" size="35" class="tbltext" tabindex="0" value="<?php echo $row['gotloc_name'];?>" onBlur="javascript:this.value=ucwords_w(this.value.toLowerCase());" onKeyPress="return isCharKey(event)" onChange="f2(this.value);" />&nbsp;<font color="#FF0000" >* </font></td>

</tr>
</table>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_location.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/update.gif" alt="Submit Value" OnClick="return mySubmit()" border="0" style="display:inline;cursor:hand;"></td>
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
