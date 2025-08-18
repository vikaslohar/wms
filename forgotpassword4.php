<?php 
/*if(!isset($_SESSION['year']))
{$year=$_REQUEST['year'];
$_SESSION['year']=$year;*/
require_once("include/config.php");
require_once("include/connection.php");
/*}*/
   // $answer=trim($_REQUEST['answer']);
	//$txtques =trim($_REQUEST['txtques']);
	$loginid=trim($_REQUEST['loginid']);
    $result=mysqli_query($link,"select * from tbluser where loginid='".$loginid."' ") or die("Error:".mysqli_error($link));
	$totalrow= mysqli_num_rows($result);
	
	$ObjRS= mysqli_fetch_array($result);
	$password =$ObjRS['password']; 
	$login=$ObjRS['loginid']; 
	$email=$ObjRS['email'];
    $to=$email;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
		/*if(! empty($to))
		{
		$webmaster='lotgen@vnrseeds.com';
		$subject ='LotGen Mail';
		$message =$password;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From:'.$webmaster. "\r\n";
		mail($to, $subject, $message, $headers);
		
		$webmaster='lotgen@vnrseeds.com';
		$subject ='LotGen Mail';
		$message =$password;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From:'.$to. "\r\n";
		mail($webmaster, $subject, $message, $headers);
		}	
		else 
		{
		unset($answer);
		unset($txtques);
		unset($to);
		unset($email);
	   }*/
	?>

<title>Administration -  Forgot Password</title>
<meta http-equiv=Content-Type content=text/html; charset=iso-8859-1>
<link href="include/vnrtrac.css" rel="stylesheet" type="text/css">
</head>
<body topmargin="0" bottommargin="0" rightmargin="0" leftmargin="0" style="background-color:#FFFFFF">
<table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%">
<tr><td height="183" colspan="2" valign="bottom" align="center"><img src="images/logo.gif"></td>
</tr>
<tr><td valign="top">
	<?php
		if ($totalrow >0)
		{
			
			{ ?>
			<table cellpadding="5" cellspacing="5" align="center">
			<tr><td class="tbltext" align="center">Your information is processed ...</td></tr>
			<tr><td class="tbltext" align="center">Please Contact Administrator to get the Login Details</td></tr>
			</table>
			<table width="" border="0" align="center" cellpadding="5" cellspacing="5">
			<tr><td><a href="login.php"><img src="images/back.gif" border="0" style="display:inline;cursor:pointer;"></a></td>
			</tr>
			</table>
<?php }  } else { ?>
			<table cellpadding="5" cellspacing="5" align="center">
			<tr><td class="tblheading" align="center">Your information is processed ...</td></tr>
			<tr><td class="tblheading" align="center">The Information Provided is incorrect. Try again</td></tr>
			</table>
			<table width="" border="0" align="center" cellpadding="5" cellspacing="5">
			<tr><td><img src="images/back.gif" border="0" onClick="javascript:location.href('login.php')" style="display:inline;cursor:pointer;"></td>
			</tr>
			</table>
<?php } ?>
</td></tr>
<tr><td colspan="2" valign="bottom"></td></tr>
</table>
</body>
</html>

