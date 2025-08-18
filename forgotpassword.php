<?php 
//require_once("include/config.php");
//require_once("include/connection.php");
//$radio_button_usertype=trim($_REQUEST['radio_button_usertype']);
//if ($radio_button_usertype =='admin'){ $label='admin'; }
//else { $label='';  }
if(isset($_POST['posted']))
{
	if( isset($_POST['username']))
	{
	
		

		//$radio_button_usertype=trim($_REQUEST['radio_button_usertype']);
		$loginid=strtolower(trim($_POST['username']));
		//$year=$_POST['year'];
		
		require_once("include/config.php");
		require_once("include/connection.php");
		
		//if( 'admin' == $radio_button_usertype ) 
			$sql=mysqli_query($link,"select * from tbluser where loginid='".$loginid."'");
		//else 	
		//   $sql=mysqli_query($link,"select * from tbluser where loginid='".$loginid."' and role!='admin'");
		   
			//$row=mysqli_fetch_array($sql);
			$numofrows=mysqli_num_rows($sql);
			if( $numofrows >0 )
			{
				echo "<script language=JavaScript type='text/JavaScript'>";
				echo "window.location='forgotpassword4.php?loginid=$loginid'";
				echo "</script>";
			}
			else
			{ ?>
				<script language=JavaScript type='text/JavaScript'>
				alert('Incorrect Login ID');
				</script>
				<?php
			}
     }
}
?>
<html>
<head>
<title>Administration-  Forgot Password</title>
<meta http-equiv=Content-Type content=text/html; charset=iso-8859-1>
<link href="include/vnrtrac.css" rel="stylesheet" type="text/css">
<link href="include/main.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="includes/validation.js"></script>
<script language="javascript">
function onloadfocus() 
{
document.form1.username.focus();
}

function mySubmit()
{
	if (document.form1.username.value != "")
		{
		
			var str=document.form1.username.value;
			if(str.length < 4 )
			{
				//alert("Invalid login ID");
				document.form1.username.value();
				return(false);
			}

				for(var k=0;k<str.length;k++)
				{
					
					if(document.form1.username.value.charCodeAt(k) == 32)
					{
					 alert("White Space Is Not Allow");
 					 document.form1.username.value="";
					 document.form1.username.focus();
						return(false);
					}		
				}	
				for(var k=0;k<str.length;k++)
				{
				
					for(var i=64 ;i<91;i++)
					{
						if(document.form1.username.value.charCodeAt(k) == i)
						{
						 alert("Capiletter is not Allow");
						 document.form1.username.value="";
						 document.form1.username.focus();
							return(false);
						}
					}		
				}

		}

	if(document.form1.username.value=="")
	{
	alert("Please Enter Login id");
	document.form1.username.focus();
	return(false);
	}
}
/*function myReset()
{
	document.form1.username.focus();
}*/
</script>

</head>
<body topmargin="0" bottommargin="0" rightmargin="0" leftmargin="0" onLoad="return onloadfocus();" style="background-color:#FFFFFF">
<table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%">
<tr height="10"><td valign="middle" colspan="2" align="center"></td></tr>
<tr height="10"><td valign="middle" colspan="2" align="center"></td></tr>
<tr height="10"><td valign="middle" colspan="2" align="center"></td></tr>
<tr height="10"><td valign="middle" colspan="2" align="center"></td></tr>
<tr height="10"><td valign="middle" colspan="2" align="center"></td></tr>
<tr height="10"><td valign="middle" colspan="2" align="center"></td></tr>
<tr height="10"><td valign="middle" colspan="2" align="center"></td></tr>
<tr height="10"><td valign="middle" colspan="2" align="center"></td></tr>
<tr><td align="center" colspan="2" valign="bottom"><img src="images/logo.gif"></td></tr>
<tr height="10"><td valign="middle" colspan="2" align="center"></td></tr>
<tr>
<td width="85%" valign="top">
<form method="post" name="form1" onSubmit="return mySubmit()"> 
<table width="400" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="border-collapse:collapse">
<tr class="Dark" height="25">
<td valign="middle" colspan="3" align="center" class="tblheading">Forgot Password  </td>
</tr>
<tr class="Light" height="25">
<td colspan="4" align="right" class="tbltext"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
</tr>
<tr class="Dark" height="25">
<td width="50%" align="right" valign="middle" class="tblheading">&nbsp;<font color="#FF0000">*</font>&nbsp;Login id&nbsp;</td>
<td width="50%" align="left" valign="middle">&nbsp;<input name="username" type="text" class="tbltext" size="25" maxlength="25" onKeyPress=" capsDetect(arguments[0]);"> 
</td>
</tr>
</table>
<table width="" border="0" align="center" cellpadding="5" cellspacing="5">
<tr><td> <a href="login.php"><img src="images/back.gif" border="0" onClick="javascript:location.href('login.php')" style="display:inline;cursor:pointer;"></a></td><td valign="middle"><input type="hidden" name="posted" value="posted">
<input type="image" src="images/submit_1.gif" border=0 alt="Submit Value" style="display:inline;cursor:pointer;"></td>
</tr>
</table>
</form>
</table>
</body>
</html>

