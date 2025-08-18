<?
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
	
	if(isset($_REQUEST['yrsid']))
	{
	$yrsid = $_REQUEST['yrsid'];
	}
	/*if(isset($_REQUEST['month']))
	{
	$month = $_REQUEST['month'];
	}*/
	
	if(isset($_POST['frm_action'])=='submit')
	{
		/*$locdate=$_POST['locdate'];
		//$empid=trim($_POST['empi']);
		if($typ!="a")
		{
		$sql_in="update tbllock set lockdate='$locdate' where lockid='$locid'";
		}
		else
		{
		$sql_in="insert into tbllock (lockdate) values('$locdate')";
		}								
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{*/
			echo "<script>window.opener.location.href = window.opener.location.href;
						   self.close();</script>";		
		//}
		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administration- Master- Financial Year cosing</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />

</head>
<body topmargin="0" >
<table width="370" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="subheading" valign="middle" height="25">Year Closing</td>
</tr>
   
  <tr>
  <td valign="top">
  <form name="from" method="post" action="<? $_SERVER['PHP_SELF']; ?>">
  	<!--input name="id" value="<? //=$cropid?>" type="hidden"--> 
	<input name="frm_action" value="submit" type="hidden"> 
	 <table  border="1" cellspacing="0" cellpadding="0" width="370" align="center" bordercolor="#ffffff" style="border-collapse:collapse">

 <?
	/*$conn = mysql_connect("localhost","vnrseeds","ZWDAHcMBBb") or die("Error:".mysqli_error($link));
	$db = mysql_select_db("vnrseeds_years") or die("Error:".mysqli_error($link));
	*/
 	$quer3=mysqli_query($link,"select * from tblfnyears where yearsid='$yrsid'"); 
	$noticia3 = mysqli_fetch_array($quer3);
	$yr=$noticia3['year_name'];
	$yrid=$yrsid+1;
	
	$sql_yr2=mysqli_query($link,"update tblfnyears set years_flg=0, years_status='c' where yearsid='$yrsid'")or die("Error:".mysqli_error($link));
	
	$sql_yr3=mysqli_query($link,"update tblfnyears set years_flg=1, years_status='a' where yearsid='$yrid'")or die("Error:".mysqli_error($link));
	
	//$yrs="vnrseeds_expro$yr";
	
	
/* backup the db OR just a table */
/*function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	$return='';
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysqli_query($link,'SHOW TABLES');
		while($row = mysqli_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		$result = mysqli_query($link,'SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		//$return.='DROP TABLE '.$table.';';
		$row2 = mysqli_fetch_row(mysqli_query($link,'SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysqli_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	$sflie='../dbbackup/'.$name;
	$handle = fopen($sflie.'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}

backup_tables('localhost','vnrseeds','ZWDAHcMBBb',$yrs);


	$query=mysqli_query($link,"DROP DATABASE $yrs") or die("Error: " . mysqli_error($link));*/
	
 	/*$sql_f=mysqli_query($link,"select * from tblclaim where empid='$empid' and month='$month'")or die(mysqli_error($link));
	$tot=mysqli_num_rows($sql_f);	
	$row=mysqli_fetch_array($sql_f);
	
	$sql_emp=mysqli_query($link,"select * from tblemp where emp_id='".$row['empid']."'")or die(mysqli_error($link));
	$row_emp=mysqli_fetch_array($sql_emp);
	$empname=$row_emp['emp_fname']." ".$row_emp['emp_lname'];
	
	$sql_in1="update tblclaim set loc=0 where empid='$empid' and month='$month'";
	mysqli_query($link,$sql_in1)or die(mysqli_error($link));*/
?>
<tr class="Dark" height="25">
<td align="center"  valign="middle" class="tblheading">You have successfully closed year: <?=$yr;?></td>
</tr>

</table>
<table cellpadding="5" cellspacing="5" border="0" width="370">
<tr >
<td align="center" colspan="3"><input type="image" src="../images/close_1.gif" alt="Close" border="0" style="display:inline;cursor:hand;"/></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
