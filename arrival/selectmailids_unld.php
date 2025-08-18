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

	$pid=$_REQUEST['pid'];	
	$flg=$_REQUEST['flg'];	
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$foccode=trim($_POST['foccode']);
		$txtlot1=trim($_POST['txtlot1']);
		$trid=trim($_POST['trid']);
		if($foccode!="")
		{
			echo "<script>window.location='sendmail.php?pid=$txtlot1&flg=$flg&trid=$trid&foccode=$foccode&plant_code=$plantcode'</script>";
		}
		
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arrival - Transaction -  Fresh Seed Arrival with PDN</title>
<link href="../include/vnrtrac_arrival.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
<script language='javascript'>

function post_value()
{
/*	opener.document.frmaddDepartment.txtlot1.value=document.from.foccode.value;
	opener.document.frmaddDepartment.txtlot2.value=document.from.foccode1.value;
	self.close();*/
}

function clk(val)
{
//document.from.foccode.value=val;
}


function mySubmit()
{
	var cnt=0;
	document.from.foccode.value ="";
	document.from.foccode1.value ="";
	if(document.from.srno.value>2)
	{
		for (var i = 0; i < document.from.loc.length; i++) 
		{          
			if(document.from.loc[i].checked == true)
			{
				cnt++;
				if(document.from.foccode.value =="")
				{
					document.from.foccode.value=document.from.loc[i].value;
				}
				else
				{
					document.from.foccode.value = document.from.foccode.value +','+document.from.loc[i].value;
				}
				if(document.from.foccode1.value =="")
				{
					document.from.foccode1.value=document.from.loc[i].value;
				}
				else
				{
					document.from.foccode1.value = document.from.foccode1.value +'\n'+document.from.loc[i].value;
				}
			}
		}
	}
	else
	{
		if(document.from.loc.checked == true)
		{
			cnt++;
			if(document.from.foccode.value =="")
			{
				document.from.foccode.value=document.from.loc.value;
			}
			else
			{
				document.from.foccode.value = document.from.foccode.value +','+document.from.loc.value;
			}
			if(document.from.foccode1.value =="")
				{
					document.from.foccode1.value=document.from.loc.value;
				}
				else
				{
					document.from.foccode1.value = document.from.foccode1.value +'\n'+document.from.loc.value;
				}
		}
	}
	if(document.from.foccode.value=="")
	{
		alert("You must select E-Mail Id(s)");
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
  <form id="mainform" name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 
	 <input type="hidden" name="cnt" value="0" />
	 <input type="hidden" name="flg" value="<?php echo $_REQUEST['flg']?>" />
	
<?php 

$arrlots="";
$qr="select * from tblarrival_unld where arrival_id='".$pid."' ";
$sql_tbl_sub=mysqli_query($link,$qr)or die(mysqli_error($link));
$tot_row=mysqli_num_rows($sql_tbl_sub);
?><br />


<table align="center" border="1" width="500" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="3" align="center" class="tblheading">Select E-Mail Id(s) </td>
</tr>
<tr class="Dark" height="30">
<td width="44" align="right" valign="middle" class="tblheading">Select&nbsp;</td>
<td width="350"  align="left" valign="middle" class="tblheading">&nbsp;Production Person</td>
<td width="350"  align="left" valign="middle" class="tblheading">&nbsp;E-Mail Ids</td>
</tr>
<?php
if($tot_row > 0)
{
$srno=1;
while ($row=mysqli_fetch_array($sql_tbl_sub))
{

$lid=$row['arrival_code'];
$trid=$row['old'];
$nsflg=0; //echo $row['lotno']."<br />";
$sql_issueg2=mysqli_query($link,"select DISTINCT(lotstate) from tblarrival_sub_unld where arrival_id='".$pid."'") or die(mysqli_error($link));
$row_issueg2=mysqli_fetch_array($sql_issueg2); 

$flg=0; $flg1=0; $extnob=0; $extqty=0;
$sql_issueg21=mysqli_query($link,"select * from tblproductionpersonnel order by productionpersonnelid") or die(mysqli_error($link));
while($row_issueg21=mysqli_fetch_array($sql_issueg21))
{

$lotstates=$row_issueg21['productionstate'].",";
$parray=explode(",", $lotstates);
foreach($parray as $val)
{
	if($val<>"")
	{
		$fg=0;
		if(trim($row_issueg2['lotstate'])==trim($val))
		{
			$fg++;
		}
		if(trim($val)=="ALL" || trim($val)=="All")
		{
			$fg++;
		}
		if($fg>0)
		{
			
if($srno%2!=0)
{
?>
<tr class="Dark" height="25">
<td align="right"  valign="middle" class="tbltext"><input type="checkbox" name="loc" checked="checked" value="<?php echo $row_issueg21['emailid'];?>" onclick="clk(this.value);" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_issueg21['productionpersonnel'];?></td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_issueg21['emailid'];?></td>
</tr>
<?php
}
else
{
?>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tbltext"><input type="checkbox" name="loc" checked="checked" value="<?php echo $row_issueg21['emailid'];?>" onclick="clk(this.value);" />&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_issueg21['productionpersonnel'];?></td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $row_issueg21['emailid'];?></td>
</tr>     
<?php
}
 $srno=$srno+1;
}}} 
}
}
}
else
{
?>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;Mail ID's not found:</td>
</tr>

<?php
}
//echo $srno;
?>
<input type="hidden" name="srno" value="<?php echo $srno;?>" />
<input type="hidden" name="foccode" value="" />
<input type="hidden" name="foccode1" value="" />
<input type="Hidden" name="txtlot1" value="<?php echo $lid?>" />
<input type="Hidden" name="trid" value="<?php echo $trid?>" />
</table>
<table cellpadding="5" cellspacing="5" border="0" width="500">
<tr >
<td align="right"><img src="../images/back.gif" border="0" onClick="window.close()" />&nbsp;<input type="image" src="../images/next.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="return mySubmit();"/>&nbsp;</td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
