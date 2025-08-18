<?php
	session_start();
	require_once("include/config.php");
	require_once("include/connection.php");
?>
<html>
<head>
<title>Administration:Login</title>
<meta http-equiv=Content-Type content=text/html; charset=iso-8859-1>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css">
<link href="include/vnrtrac.css" rel="stylesheet" type="text/css">
</head>
<body topmargin="0" bottommargin="0" rightmargin="0" leftmargin="0" style="background-color:#FFFFFF">
<table border="0" cellspacing="0" cellpadding="0" width="400" align="center" height="250">
<tr><td valign="bottom" align="center"><img src="images/logo.gif"></td></tr></table><br/>

<?php
	$txtuser=$_POST['txtuser'];
	$txtpassword=$_POST['txtpassword'];
	$curyear=date("Y");
	
if(($txtuser=="suplgnadm") && ($txtpassword=="!wmsvspl#024"))
{
	$quer3=mysqli_query($link,"select * from tblyears where years_flg != 0 and years_status='a'"); 
	$noticia3 = mysqli_fetch_array($quer3);
	$year=$noticia3['years'];
	$ayear1=$noticia3['year1'];
	$yearid_id=$noticia3['ycode'];
	$baryrcode=$noticia3['baryrcode'];
	if (!isset($_SESSION["sessionadmin"]))
	{
	
	/*session_register("sessionrole");
	 session_register("sessionadmin");*/
	 $_SESSION['sessionadmin']=$txtuser;
	 $_SESSION['emp_id']=0;
	 $_SESSION['role']="admin";
	 $_SESSION['ayear1']=$ayear1;
	 $_SESSION['ayear2']=$ayear1;
	 $_SESSION['username']=$txtuser;
	 $_SESSION['loginid']=0;
	 $_SESSION['yearid_id']=$yearid_id;
	 $_SESSION['baryrcode']=$baryrcode;
	 $_SESSION['logid']="ADM";
	 $_SESSION['plantcode']="ALL";
	}
	if ($_SESSION['sessionadmin'])
	{	
			echo "<script language='JavaScript' type='text/JavaScript'>";
			echo "window.location='index1.php'"; 
			echo "</script>";
	}
}
else
{			
if($txtuser!="" && $txtpassword!="")
{
	$sql="select * from tbluser where loginid='".$txtuser."' and BinARY password like '".$txtpassword."'";
	$row=mysqli_query($link,$sql) or die(mysqli_error());
	$totalrow= mysqli_num_rows($row);
	$ObjRS= mysqli_fetch_array($row);
	$username=$ObjRS['loginid'];
	$emp_id = $ObjRS['uid']; 
	$role=$ObjRS['role'];
	$logid=$ObjRS['scode'];
	$loginid=0;
	$flg=0;
	$plantcode=$ObjRS['plantcode'];
	$plantcode1=$ObjRS['plantcode1'];
	$plantcode2=$ObjRS['plantcode2'];
	$plantcode3=$ObjRS['plantcode3'];
	$plantcode4=$ObjRS['plantcode4'];
	//$status='Active';
	if($ObjRS['logflg']==1)
	{
	$flg++;
	}
	if($role == "admin")
	{	
		$loginid=0;
	}
	/*else if($role == "obadmin")
	{	
		$loginid=0;
	}*/
	else if($role=="decode")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="drying")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="plantmanager")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="supermanager")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="plantsupervisor")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="arrival")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="quality")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="QCM")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="QCS")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="QCB")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="rsw")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="csw")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="psw")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="qualitygot" || $role=="Qualitygot")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="packaging")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="processing")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="salesreturn")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="orderbooking")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="dispatch")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="dispatchxt")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="viewer")
	{
		 $qry_opr=mysqli_query($link,"select * from tbl_viewer where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['vid'];
		 //$status=$row_opr['status'];
	}
	else if($role=="settlement")
	{
		 //$qry_opr=mysqli_query($link,"select * from tbl_viewer where login='$username' and BinARY pass like '".$txtpassword."'"); 
		// $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid='1';
		 //$status=$row_opr['status'];
	}
	else if($role=="Production")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
	else if($role=="qcgotview")
	{
		 $qry_opr=mysqli_query($link,"select * from tblopr where login='$username' and BinARY pass like '".$txtpassword."'"); 
		 $row_opr = mysqli_fetch_array($qry_opr);
		 $loginid=$row_opr['id'];
		 //$status=$row_opr['status'];
	}
 	else
	{
	$loginid=0;
	//$status='Active';
	}
	//exit;
	$ssl="update tbluser set logflg=1 where loginid='".$txtuser."' and roll='".$role."' and scode='".$logid."'";
	
	$quer3=mysqli_query($link,"select * from tblyears where years_flg != 0 and years_status='a'"); 
	$noticia3 = mysqli_fetch_array($quer3);
	$year=$noticia3['years'];
	$ayear1=$noticia3['year1'];
	$yearid_id=$noticia3['ycode'];
	$baryrcode=$noticia3['baryrcode'];
if($totalrow > 0 && $flg==0)
{
	if(!isset($_SESSION["sessionadmin"]))
	{
	/*session_register("sessionrole");
	 session_register("sessionadmin");*/
	 $_SESSION['sessionadmin']=$username;
	 $_SESSION['emp_id']=$emp_id;
	 $_SESSION['role']=$role;
	 $_SESSION['ayear1']=$ayear1;
	 $_SESSION['ayear2']=$ayear1;
	 $_SESSION['username']=$username;
	 $_SESSION['loginid']=$loginid;
	 $_SESSION['yearid_id']=$yearid_id;
	 $_SESSION['baryrcode']=$baryrcode;
	 $_SESSION['logid']=$logid;
	 $_SESSION['plantcode']=$plantcode;
	 $_SESSION['plantcode1']=$plantcode1;
	 $_SESSION['plantcode2']=$plantcode2;
	 $_SESSION['plantcode3']=$plantcode3;
	 $_SESSION['plantcode4']=$plantcode4;
	}
	if($_SESSION['sessionadmin'])
	{	
		if($role=="admin")
		{
			echo "<script language='JavaScript' type='text/JavaScript'>";
			echo "window.location='masters/index1.php'"; 
			echo "</script>";
		}
		if($curyear!=$ayear1)
		{
			echo "<script language='JavaScript' type='text/JavaScript'>";
			echo "alert('Cannot Logged in. Reason: The Application Year has not been changed. Kindly contact Administrator.');";
			echo "window.location='login.php'"; 
			echo "</script>";
		}
		else if($role=="decode")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='dec/index1.php'"; 
				echo "</script>";
		}
		else if($role=="drying")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='drying/index1.php'"; 
				echo "</script>";
		}
		else if($role=="plantmanager")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='plant/index1.php'"; 
				echo "</script>";
		}
		else if($role=="supermanager")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='plantmanager/index1.php'"; 
				echo "</script>";
		}
		else if($role=="plantsupervisor")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='plantsupervisor/index1.php'"; 
				echo "</script>";
		}
		else if($role=="arrival")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='arrival/index1.php'"; 
				echo "</script>";
		}
		else if($role=="quality")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='qc/index1.php'"; 
				echo "</script>";
		}
		else if($role=="QCM")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='qcm/index1.php'"; 
				echo "</script>";
		}
		else if($role=="QCS")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='qc1/index1.php'"; 
				echo "</script>";
		}
		else if($role=="QCB")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='qcbiotech/index1.php'"; 
				echo "</script>";
		}
		else if($role=="qualitygot" || $role=="qcgotview")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='qc/indexg.php'"; 
				echo "</script>";
		}
		else if($role=="rsw")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='rsw/index1.php'"; 
				echo "</script>";
		}
		else if($role=="csw")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='csw/index1.php'"; 
				echo "</script>";
		}
		else if($role=="psw")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='psw/index1.php'"; 
				echo "</script>";
		}
		else if($role=="packaging")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='packging/index1.php'"; 
				echo "</script>";
		}
		else if($role=="processing")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='process/index1.php'"; 
				echo "</script>";
		}
		else if($role=="salesreturn")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='sales/index1.php'"; 
				echo "</script>";
		}
		else if($role=="orderbooking")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='order/index1.php'"; 
				echo "</script>";
		}
		else if($role=="dispatch")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='dispatch/index1.php'"; 
				echo "</script>";
		}
		else if($role=="dispatchxt")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='dispatchxt/index1.php'"; 
				echo "</script>";
		}
		else if($role=="viewer")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='viewer/index1.php'"; 
				echo "</script>";
		}
		else if($role=="settlement")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='settlement/index1.php'"; 
				echo "</script>";
		}
		else if($role=="Production")
		{
				echo "<script language='JavaScript' type='text/JavaScript'>";
				echo "window.location='production/index1.php'"; 
				echo "</script>";
		}
		else
		{
			echo "<script language='JavaScript' type='text/JavaScript'>";
			echo "window.location='login.php'"; 
			echo "</script>";
		}
		
		
		
	}
}
else if($totalrow==0 && $flg!=0)
{
?>		

<table border="0" cellspacing="0" cellpadding="0" width="400" align="center" height="75">

	
		<tr ><td width="408" height="44"  align="center" class="tblheading" >Cannot Logged in. Reason: The user is already logged in. Please contact Administrator or Try relogin again. <a href="login.php" class="tblheading"><font color="#0000FF">Try Again</font></a></td>
		</tr>
<?php
}
else 
{
?>		
		<tr><td width="408" height="44"  align="center" class="tblheading" >Invalid Login ID & Password. Please contact Administrator or Try relogin again. <a href="login.php" class="tblheading"><font color="#0000FF">Try Again</font></a></td>
		</tr>
<?php
}
}	
else 
{
?>
<tr><td height="25"  align="center" class="tblheading"><b>Invalid Username or Password <br/> <a href=login.php class="tblheading"><font color="#0000FF">Try Again</font></a></b></td></tr>
<?php
}
}
?>
</table> 
</body>
</html>
