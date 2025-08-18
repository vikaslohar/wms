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
	if(isset($_REQUEST['department_id']))
	{
	$department_id = $_REQUEST['department_id'];
	}	
		
	if(isset($_POST['frm_action'])=='submit')
	{
		//$name=trim($_POST['txtname']);
		
		$questions=trim($_POST['questions']);
		$answers=trim($_POST['answers']);
		$roles=trim($_POST['flagcode']);
		/*$parentimage1=trim($_FILES['upload']['name']);
		 if($parentimage1<>"")
		{
		$imagepath1="../help/".$parentimage1;
		copy($_FILES['upload']['tmp_name'],$imagepath1);
		}*/
		 $sql_in="insert into tblfaq(faq_questions,faq_answer, faq_role) values(
											  '$questions',
											  '$answers',
											  '$roles')";
					//exit;					
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{		
			echo "<script>window.location='faq_home.php'</script>";	
		}
		}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Administrator-  Master - Add Operator</title>
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
	document.frmaddDepartment.questions.focus();
	}

function ucwords_w ( str ) {   return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }
function mySubmit()
{ 
	if(document.frmaddDepartment.questions.value=="")
	{
	alert("Please enter Question");
	document.frmaddDepartment.questions.focus();
	return false;
	}
	if(document.frmaddDepartment.questions.value.charCodeAt() == 32)
	{
	alert("Question cannot start with space.");
	document.frmaddDepartment.questions.focus();
	return false;
	}
	if(document.frmaddDepartment.answers.value=="")
	{
	alert("Please enter Answers");
	document.frmaddDepartment.answers.focus();
	return false;
	}
	if(document.frmaddDepartment.answers.value.charCodeAt() == 32)
	{
	alert("Answer cannot start with space.");
	document.frmaddDepartment.answers.focus();
	return false;
	}
	
	
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
alert("Please select role");
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
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="831" class="Mainheading" height="25">
	  <table width="840" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="840" height="25" class="Mainheading">&nbsp;FAQ Master </td>
	    </tr></table></td>
	  <td width="100" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolordark="#4ea1e1" cellspacing="0" cellpadding="0" width="90" style="border-collapse:collapse;">


</table></td>
	  
	  </tr>
	  </table></td></tr>
	
  
	  
	  <td align="center" colspan="4" >
	  
	  	  <form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onReset="onloadfocus();" > 
	   <input name="frm_action" value="submit" type="hidden">
		 <input name="txt11" value="" type="hidden">
		 <input type="hidden" name="code" value="<?php echo $code;?>" />
		  <input type="hidden" name="scode" value="<?php echo $code1;?>" />
		  
		  <?php
	
	$sql_sel="select * from tbldept order by department_id ";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	
	$total=mysqli_num_rows($res);
	$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbldept");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; 

	if($total >0) { 
?>
		 <br/>
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse" height="400">
<tr>
<td valign="top">
<?php //if($row_rt < 3) { ?>
<?php 
$sql_loc=mysqli_query($link,"select * from tbldept where department_id='$department_id'") or die(mysqli_error($link));
$row_loc=mysqli_fetch_array($sql_loc); ?>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
  <tr height="25" >
    <td colspan="8" align="center" class="subheading" style="color:#303918; "><?php echo ucwords($row_loc['department'])?>- FAQs List </td>
  </tr>
  </table>

<table align="center" border="0" width="443" cellspacing="0" cellpadding="0" bordercolor="#CCCCCC" style="border-collapse:collapse" > 
  <tr><td width="461">
<table width="500" border="1" cellspacing="0" cellpadding="0" align="center"  bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
<td colspan="2" align="center" class="tblheading" valign="middle">FAQ</td>
</tr>
<tr class="Dark"  height="25">
<td width="97" align="right" valign="middle" class="tblheading"> Question &nbsp;</td>
<td width="329" align="left" valign="middle" class="tbltext">&nbsp;<textarea name="questions" cols="35" rows="3" tabindex="2"></textarea> &nbsp;</td>
</tr>
<tr class="Dark"  height="25">
<td width="97" align="right" valign="middle" class="tblheading"> Answers &nbsp;</td>
<td width="329" align="left" valign="middle" class="tbltext">&nbsp;<textarea name="answers" cols="35" rows="5" tabindex="2" ></textarea> &nbsp;</td>
</tr>


<tr class="tblsubtitle" height="25">
  <td colspan="2" align="center" class="tblheading" valign="middle">Roles</td>
</tr>

</table></td></tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="500" bordercolor="#4ea1e1" style="border-collapse:collapse">
  

<tr class="tblsubtitle" height="25">
<td width="60" align="center" class="tblheading" valign="middle">#</td>
<td width="103" align="center" class="tblheading" valign="middle">Stage</td>
<td width="73" align="center" class="tblheading" valign="middle">Selection</td>
</tr>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center">1</td>
<td valign="middle" class="tbltext" align="center">Admin</td>
<td valign="middle" class="tbltext" align="center"><input type="checkbox" name="fet"  value="<?php echo $resetresult['id'];?>"  checked="checked"   style="background-color:#CCCCCC" disabled="disabled"/></a></td>
</tr>

<?php
$srno=2;
	while($row=mysqli_fetch_array($res))
	{
	$resettargetquery=mysqli_query($link,"select * from tbldept where department_id='".$row['department_id']."'");
  	while($resetresult=mysqli_fetch_array($resettargetquery))
	{
  
	if( $row['department']!="Admin")
{
	if ($srno%2 != 0)
	{
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['department'];?></td>
<td valign="middle" class="tbltext" align="center"><input type="checkbox" name="fet"  value="<?php echo $resetresult['department_id'];?>" /></a></td>
</tr>
<?php
	}
	else
	{ 
	 
?>
<tr class="Light" height="25">
<td  valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td valign="middle" class="tbltext" align="center"><?php echo $row['department'];?></td>
<td valign="middle" class="tbltext" align="center"><input type="checkbox" name="fet"  value="<?php echo $resetresult['department_id'];?>" /></a></td>
</tr>


<?php	}
	 $srno=$srno+1;
	}
}

}
}
?>
</table>
 <table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="faq_home.php"> <img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;" /></a>&nbsp;&nbsp; <a href="javascript:document.frmaddDepartment.reset()"><img src="../images/reset.gif" OnClick="myReset()"alt="reset"  border="0" style="display:inline;cursor:hand;"></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" OnClick="return mySubmit()" border="0" style="display:inline;cursor:hand;"><input type="hidden" name="flagcode" value=""/></td>
</tr>
</table>
 <?php// } else { ?>
 <!--/*<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" v >
<tr >
<td valign="top" align="center" class="tblheading">Maximum of 3 Operator Roles can be created. You have reached to maximum limit.
</td>
</tr>
<tr >
<td valign="top" align="center"><a href="operator_home.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;</td>
</tr>
</table>
*/-->
 <?php 
  ?>
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
