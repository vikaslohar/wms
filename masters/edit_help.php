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
	//$logid="OP1";
	//$lgnid="OP1";
		
	
	//$res_rt=mysqli_query($link,"select * from tbl_opr");
	//$row_rt=mysqli_num_rows($res_rt);
	 
	 //$role='operator';
	//$status='active';
	
		if(isset($_REQUEST['fid']))
	{
	$fid = $_REQUEST['fid'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//$name=trim($_POST['txtname']);
		
		$title=trim($_POST['title']);
		//$upload=trim($_POST['txtemail']);
		$role1=trim($_POST['flagcode']);
		$parentimage1=trim($_FILES['upload']['name']);
		/*$query=mysqli_query($link,"SELECT * FROM tblhelp where help_title='$title' and help_id!='fid'") or die("Error: " . mysqli_error($link));
   		$numofrecords=mysqli_num_rows($query);
	 	 if( $numofrecords > 0)
		 {?>
		 <script>
		  alert("This file is Already Present.");
		  </script>
		 <?php }
		 else 
		 {*/
		 
		if($parentimage1<>"")
		{
		$imagepath1="help/".$parentimage1;
		copy($_FILES['upload']['tmp_name'],$imagepath1);
		$str="update tblhelp set help_file='$imagepath1' where help_id='$fid'";
		$result=mysqli_query($link,$str) or die("Error:".mysqli_error($link));
		}
		
		  $sql_in="UPDATE tblhelp SET help_title='$title', help_role='$role1' where help_id = '$fid'";
		//exit;
											
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{
			echo "<script>window.location='help_home.php'</script>";	
		}
	  //}	
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Administrator-  Master - Edit Help Manual</title>
<link href="../include/main_adm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript" src="../include/validation.js"></script>
<script src="vaddresschk.js"></script>
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
function onloadfocus()
	{
		document.frmaddDepartment.title.focus();
	}

function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }

function mySubmit()
{ 
	if(document.frmaddDepartment.title.value=="")
	{
	alert("Please enter title");
	document.frmaddDepartment.title.focus();
	return false;
	}
	if(document.frmaddDepartment.title.value.charCodeAt() == 32)
	{
	alert("help title cannot start with space.");
	document.frmaddDepartment.title.focus();
	return false;
	}
	
	/*
	if(document.frmaddDepartment.upload.value=="")
	{
	alert("Please  select help file");
	document.frmaddDepartment.upload.focus();
	return false;
	}
	if(document.frmaddDepartment.upload.value.charCodeAt() == 32)
	{
	alert("help File cannot start with space.");
	document.frmaddDepartment.upload.focus();
	return false;
	}
	*/
	
for (var i = 0; i < document.frmaddDepartment.fet.length; i++) 
{          
		 
		  if(document.frmaddDepartment.fet[i].checked == true)
			{
				if(document.frmaddDepartment.flagcode.value =="")
				{
				document.frmaddDepartment.flagcode.value=document.frmaddDepartment.fet[i].value;
				}
				else
				{
				document.frmaddDepartment.flagcode.value = document.frmaddDepartment.flagcode.value +','+document.frmaddDepartment.fet[i].value;
				}
			}
}

if(document.frmaddDepartment.flagcode.value == "")
{
alert("Please select Role");
return false;
}
if(document.frmaddDepartment.upload.value != "")
	{
		var extArray = new Array(".pdf");
				var fileName = document.frmaddDepartment.upload.value
						
				if (!fileName) return false;
				ext = fileName.substring(fileName.lastIndexOf(".")).toLowerCase();
						
				for (var i = 0; i < extArray.length; i++) 
				{
				   if (extArray[i] == ext) return true
				}
				alert("Please only upload files that end in types:  "
				+ (extArray.join("  ")) + "\nPlease select a new "
				+ "file to upload and submit again.");
				document.frmaddDepartment.upload.value="";
				document.frmaddDepartment.flagcode.value="";
				return false;
	}

	return true;	 
}


</script>
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
          <td width="100%" valign="top"  height="auto" align="center"  class="midbgline">

		  
<!-- actual page start--->	
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;<a href="cdinward_home.php" style="text-decoration:underline; cursor:pointer; color:#404d21;"></a>Help Manual Master</td>
	    </tr></table></td>
	    	  </tr>
	  </table></td></tr>
   	  <td align="center" colspan="4" >
	  	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onReset="onloadfocus();" enctype="multipart/form-data" > 
	   <input name="frm_action" value="submit" type="hidden">
		 <input name="txt11" value="" type="hidden">
		 <input type="hidden" name="code" value="<?php echo $code;?>" />
		  <input type="hidden" name="scode" value="<?php echo $code1;?>" />
		  
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
	
	
	$sql_sel="select * from tbldept order by department_id ";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tblopr");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

	if($total >0) { 
?>
		 <br/>
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse" height="400">
<tr>
<td valign="top">
<?php //if($row_rt < 3) { ?>

<table align="center" border="0" width="616" cellspacing="0" cellpadding="0" bordercolor="#CCCCCC" style="border-collapse:collapse" > 
  <tr><td width="616">
<table width="564" border="1" cellspacing="0" cellpadding="0" align="center"  bordercolor="#4ea1e1" style="border-collapse:collapse">
<?php
$sql_qry=mysqli_query($link," select * from tblhelp where help_id='$fid'")or die("Error".mysqli_error($link));
$row_qry=mysqli_fetch_array($sql_qry);
$total=mysqli_num_rows($sql_qry);
 $row_qry['help_role'];
?>
<tr class="tblsubtitle" height="25">
<td colspan="2" align="center" class="tblheading" valign="middle">File Upload </td>
</tr>
<tr class="Dark"  height="25">
<td width="222" align="right" valign="middle" class="tblheading"> Title &nbsp;</td>
<td width="472" align="left" valign="middle" class="tbltext">&nbsp;<input name="title" type="text" class="tbltext" tabindex="0" value="<?php echo $row_qry['help_title'];?>" size="40"  onBlur="javascript:this.value=ucwords_w(this.value.toLowerCase());" /> &nbsp; </td>
</tr>


<td width="222" align="right" valign="middle" class="tblheading">Help File</td>
<td width="472" align="left" valign="middle" class="tbltext"><?php if($row_qry['help_file'] !=""){ $path= $row_qry['help_file']; $imagename=explode("/",$path);  echo $imagename[2]; }?><br/>&nbsp;<input name="upload" class="tbltext" type="file" size="40"  /> &nbsp;</td>
</tr>

<tr class="tblsubtitle" height="25">
  <td colspan="2" align="center" class="tblheading" valign="middle">Roles</td>
</tr>

</table></td></tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="564" bordercolor="#4ea1e1" style="border-collapse:collapse">
  

<tr class="tblsubtitle" height="25">
<td width="60" align="center" class="tblheading" valign="middle">#</td>
<td width="218" align="left" class="tblheading" valign="middle">&nbsp;Operator Name</td>
<td width="103" align="center" class="tblheading" valign="middle">Stage</td>
<td width="73" align="center" class="tblheading" valign="middle">Selection</td>
</tr>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center">1</td>

<td valign="middle" class="tbltext" align="left">&nbsp;Admin</td>
<td valign="middle" class="tbltext" align="center">Admin</td>
<td valign="middle" class="tbltext" align="center"><input type="checkbox" name="fet"  value="0"  checked="checked" style="background-color:#CCCCCC" disabled="disabled" readonly="true"/></a></td>
</tr>
<?php
$srno=2;
while($row=mysqli_fetch_array($res))
	{
	$resettargetquery=mysqli_query($link,"select * from tblopr where department_id='".$row['department_id']."'");
  	while($resetresult=mysqli_fetch_array($resettargetquery))
	{	
	/*$sql_p=mysqli_query($link,"SELECT * FROM tbldept where department_id='".$row['department_id']."'")or die(mysqli_error($link));
  	$row_p=mysqli_fetch_array($sql_p);
 	$num_p=mysqli_num_rows($sql_p);
	
	$quer24=mysqli_query($link,"SELECT * FROM tbldestination where did='".$row['did']."'order by dest"); 
	$noticia24=mysqli_fetch_array($quer24);
*/
	if ($srno%2 != 0)
	{

	
?>
<!--/*<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $resetresult['name'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['department'];?></td>
<td valign="middle" class="tbltext" align="center"><input type="checkbox" name="fet"  value="admin"  checked="checked"/></a></td>
</tr>*/
-->
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $resetresult['name'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['department'];?></td>
<td valign="middle" class="tbltext" align="center"><input type="checkbox" name="fet" <?php $p1_array=explode(",",$row_qry['help_role']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
				if($val1 == $resetresult['id']) { $i++;}
				}
				}
				if($i!=0) { echo "checked";}?>  value="<?php echo $resetresult['id'];?>"/></td></tr>
<?php
	}
	else 

	{ 
	 
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $resetresult['name'];?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['department'];?></td>
<td valign="middle" class="tbltext" align="center"><input type="checkbox" name="fet" <?php $p1_array=explode(",",$row_qry['help_role']);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
					if($val1 == $resetresult['id']) { $i++;}
				}
				}
				if($i!=0) { echo "checked";}?> value="<?php echo $resetresult['id'];?>" /></td></tr>
<?php	}
	 $srno=$srno+1;
	}
}
}
//}
?>
</table>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="help_home.php"> <img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp; <a href="javascript:document.frmaddDepartment.reset()"><img src="../images/reset.gif" OnClick="myReset()"alt="reset"  border="0" style="display:inline;cursor:hand;"></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" OnClick="return mySubmit()" border="0" style="display:inline;cursor:hand;"><input type="hidden" name="flagcode" value=""/></td>
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
