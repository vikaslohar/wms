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

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../include/vnrtrac_csw.css" rel="stylesheet" type="text/css" />

<title>CSW - Utility - Abbreviations</title>

</head>
<table width="630" border="0" bordercolor="#ffffff" align="center" cellpadding="0" cellspacing="0" >


  <tr valign="top">
  <td width="750" colspan="3" align="center" valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
  	<?php

 if(($role =="admin" || "production" ||"plant"||"arrival"))
 {
		 ?> 
		 
   <table align="center" border="1" width="630" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse">

<tr class="tblsubtitle">
       <td colspan="100" class="tblheading" align="center" bordercolor="#fa8283" >&nbsp;List of Abbreviation/Short forms </td>
     </tr>
<tr class="Light">
<td width="5%" align="center" class="tblheading">#</td>
<td width="17%" align="left" class="tblheading">&nbsp;Abbreviation </td>
<td width="78%" align="left" class="tblheading">&nbsp;Expansion</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">1</td>
<td align="left" class="tbltext">&nbsp;#.</td>
<td align="left" class="tbltext">&nbsp;Serial Number</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">2</td>
<td align="left" class="tbltext">&nbsp;D</td>
<td align="left" class="tbltext">&nbsp;Drying  (Seed Status)</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">3</td>
<td align="left" class="tbltext">&nbsp;DoT</td>
<td align="left" class="tbltext">&nbsp;Date of QC Test</td>
</tr>

<tr class="Light">
<td align="center" class="tbltext">4</td>
<td align="left" class="tbltext">&nbsp;E-mail</td>
<td align="left" class="tbltext">&nbsp;Electronic Mail</td>
</tr>

<tr class="Dark">
<td align="center" class="tbltext">5</td>
<td align="left" class="tbltext">&nbsp;F</td>
<td align="left" class="tbltext">&nbsp;Fumigation  (Seed Status)</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">6</td>
<td align="left" class="tbltext">&nbsp;FAQ</td>
<td align="left" class="tbltext">&nbsp;Frequently Asked Question</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">7</td>
<td align="left" class="tbltext">&nbsp;Germ%</td>
<td align="left" class="tbltext">&nbsp;Germination Percentage</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">8</td>
<td align="left" class="tbltext">&nbsp;GOT</td>
<td align="left" class="tbltext">&nbsp;Grow Out Test</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">9</td>
<td align="left" class="tbltext">&nbsp;GOT-NR</td>
<td align="left" class="tbltext">&nbsp;Grow Out Test-Not Recommended</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">10</td>
<td align="left" class="tbltext">&nbsp;GOT-R</td>
<td align="left" class="tbltext">&nbsp;Grow Out Test-Recommended</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">11</td>
<td align="left" class="tbltext">&nbsp;Moist%</td>
<td align="left" class="tbltext">&nbsp;Moisture Percentage</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">12</td>
<td align="left" class="tbltext">&nbsp;No.</td>
<td align="left" class="tbltext">&nbsp;Number </td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">13</td>
<td align="left" class="tbltext">&nbsp;NoB</td>
<td align="left" class="tbltext">&nbsp;Number of Bags </td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">14</td>
<td align="left" class="tbltext">&nbsp;PP</td>
<td align="left" class="tbltext">&nbsp;Physical Purity</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">15</td>
<td align="left" class="tbltext">&nbsp;Q</td>
<td align="left" class="tbltext">&nbsp;Quarantine (Seed Status)</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">16</td>
<td align="left" class="tbltext">&nbsp;QC</td>
<td align="left" class="tbltext">&nbsp;Quality Control</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">17</td>
<td align="left" class="tbltext">&nbsp;Qty</td>
<td align="left" class="tbltext">&nbsp;Quantity</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">18</td>
<td align="left" class="tbltext">&nbsp;RQ</td>
<td align="left" class="tbltext">&nbsp;Condition QC Sampling</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">19</td>
<td align="left" class="tbltext">&nbsp;CSW</td>
<td align="left" class="tbltext">&nbsp;Condition Seed Warehouse</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">20</td>
<td align="left" class="tbltext">&nbsp;RT</td>
<td align="left" class="tbltext">&nbsp;Retest</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">21</td>
<td align="left" class="tbltext">&nbsp;SLOC </td>
<td align="left" class="tbltext">&nbsp;Storage Location </td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">22</td>
<td align="left" class="tbltext">&nbsp;T</td>
<td align="left" class="tbltext">&nbsp;Temporary (Before Transaction ID)</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">23</td>
<td align="left" class="tbltext">&nbsp;UT </td>
<td align="left" class="tbltext">&nbsp;Under Test</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">24</td>
<td align="left" class="tbltext">&nbsp;WH</td>
<td align="left" class="tbltext">&nbsp;Ware House</td>
</tr>

<tr class="tblsubtitle">
       <td colspan="100" class="tblheading"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px; color:#0000FF">Abbreviations are defined by Arrival Administrator. Their expansions are available in data entry form and as part of help manual.</div></td>		
     </tr>

<!---table code..--->
</table>
   <br />
   <?php
}
?>
  </form>
</td></tr>
<table align="center" border="0" width="630" cellspacing="0" cellpadding="0" bordercolor="#b9d647" style="border-collapse:collapse">
<tr >
<td align="right">&nbsp;&nbsp;&nbsp;<a href="abbravation-word.php?role=<?php echo $role?>"></a>&nbsp;&nbsp;&nbsp;<img src="../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;&nbsp;<img src="../images/close_icon2.jpg" border="0" class="butn" height="30" alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>

</body>
</html>
