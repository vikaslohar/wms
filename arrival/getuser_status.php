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
	//$yearid_id="09-10";
	require_once("../include/config.php");
	require_once("../include/connection.php");
	if(isset($_REQUEST['tp']))
	{
		$tp = $_REQUEST['tp'];
	}

	if(isset($_POST['frm_action'])=='submit')
	{
	/*$c1=$_POST['foccode'];
	
					$sql_in1="insert into tbllotimp(lotimpid, lotnumber) values('$lid', '$c1')";	
					$flid=mysqli_query($link,$sql_in1)or die(mysqli_error($link));*/
			
	/*echo "<script>window.opener.location.href = window.opener.location.href;
						   self.close();</script>";	*/
	
	
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival- Transaction-Existing Lot selection</title>
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
<script language='javascript'>

function post_value()
{
var cnt=0;
for (var i = 0; i < document.from.sstatus.length; i++) {          
		 
		  if(document.from.sstatus[i].checked == true)
			{
				if(document.from.foccode.value =="")
				{
				document.from.foccode.value=document.from.sstatus[i].value;
				//document.from.foccode1.value=document.from.sstatus[i].value;
				}
				else
				{
				document.from.foccode.value = document.from.foccode.value +'/'+document.from.sstatus[i].value;
				//document.from.foccode1.value = document.from.foccode1.value +'\n'+document.from.sstatus[i].value;
				}
				cnt++;
			}
			
		}
		
opener.document.frmaddDepartment.sstatus.value=document.from.foccode.value;
self.close();
}
/*function post_value()
{
opener.document.frmaddDepartment.sstatus.value=document.from.cnt.value;
self.close();
}*/

function clk(val)
{
document.from.foccode.value=val;
}

function mySubmit()
{
if(document.from.foccode.value=="")
{
alert("You must select Lot");
return false;
}
return true;
}	
	
			</script>
</head>
<body topmargin="0" >
  
<table width="400" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form id="mainform" name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
		  <input type="hidden" name="cnt" value="0" />
		</br>


<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="2" align="center" class="tblheading">Select Seed Status</td>
</tr>
<tr class="Dark" height="30">
<td width="44" height="23" align="right" valign="middle" class="tblheading">Select&nbsp;</td>
<td width="350"  align="left" valign="middle" class="tblheading">&nbsp;Status</td>
</tr>
<?php


//echo $arrlots;
/*	$sql_qry=mysqli_query($link," select * from tblarrival  ")or die("Error".mysqli_error($link));
  $row_qry=mysqli_fetch_array($sql_qry);
 $total=mysqli_num_rows($sql_qry);

$parray=explode("/" );
foreach($parray as $val)
{
	if($val<>"")
	{
		if($row['status']==$val1)
		{
		
		}
	}
}*/
//echo $ct;

?><tr class="Light" height="25">
<td align="right"  valign="middle" class="tbltext">&nbsp;<input type="checkbox" readonly="true" name="sstatus" <?php $p1_array=explode("/",$tp);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
					if($val1 == "D") { $i++;}
				 }
				}
				if($i !=0) { echo "checked";}?> value="D"/>&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;Drying (D)&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tbltext">&nbsp;<input type="checkbox" readonly="true" name="sstatus" <?php $p1_array=explode("/",$tp);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
					if($val1 == "F") { $i++;}
				 }
				}
				if($i !=0) { echo "checked";}?> value="F"/>&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;Fumigation (F)</td>
</tr> 
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tbltext"><input type="checkbox" readonly="true" name="sstatus" <?php $p1_array=explode("/",$tp);
			$i=0;
			$p1=array();
			foreach($p1_array as $val1)
				{
				 if($val1<>"")
				 {
					if($val1 == "Q") { $i++;}
				 }
				}
				if($i !=0) { echo "checked";}?> value="Q"/>&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;Quarantine (Q)</td> </tr>   
<input type="hidden" name="foccode" value="" />
<input type="hidden" name="foccode1" value="" />
</table>
<table cellpadding="5" cellspacing="5" border="0" width="400">
<tr >
<td align="center" colspan="3"><img src="../images/back.gif" border="0" onClick="window.close()" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="post_value();"/></td>
</tr>
</table>

</form>
</td></tr>
</table>

</body>
</html>
