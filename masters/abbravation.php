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
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Master- Utility - Abbreviations</title>
<link href="../include/main_adm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>





  <tr valign="top">
  <td width="750" colspan="3" align="center" valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
  	<?php

 if(($role =="admin" || "production" ||"plant"||"arrival"))
 {
		 ?> 
	  <table align="center" border="1" width="630" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse"> 
<tr class="tblsubtitle">
       <td colspan="100" class="tblheading" align="center" bordercolor="#4ea1e1" >&nbsp;List of Abbreviation/Short forms </td>
     </tr>
<tr class="Light">
<td width="5%" align="center" class="tblheading">#</td>
<td width="33%" align="left" class="tblheading">&nbsp;Abbreviation </td>
<td width="62%" align="left" class="tblheading">&nbsp;Expansion</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">1</td>
<td align="left" class="tbltext">&nbsp;#</td>
<td align="left" class="tbltext">&nbsp;Serial Number</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">2</td>
<td align="left" class="tbltext">&nbsp;Admin</td>
<td align="left" class="tbltext">&nbsp;Administrator</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">3</td>
<td align="left" class="tbltext">&nbsp;CST </td>
<td align="left" class="tbltext">&nbsp;Central Sales Tax</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">4</td>
<td align="left" class="tbltext">&nbsp;CSW</td>
<td align="left" class="tbltext">&nbsp;Condition Seed Warehouse </td>
</tr>
<tr class="Dark">
  <td align="center" class="tbltext">5</td>
  <td align="left" class="tbltext">&nbsp;EDOR </td>
  <td align="left" class="tbltext">&nbsp;Expected Date of Result</td>
</tr>
<tr class="Light">
  <td align="center" class="tbltext">6</td>
  <td align="left" class="tbltext">&nbsp;E-mail </td>
  <td align="left" class="tbltext">&nbsp;Electronic Mail </td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">7</td>
<td align="left" class="tbltext">&nbsp;FAQs</td>
<td align="left" class="tbltext">&nbsp;Frequently Asked Questions</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">8</td>
<td align="left" class="tbltext">&nbsp;GH</td>
<td align="left" class="tbltext">&nbsp;Guard Warehouse</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">9</td>
<td align="left" class="tbltext">&nbsp;Gms</td>
<td align="left" class="tbltext">&nbsp;Grams</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">10</td>
<td align="left" class="tbltext">&nbsp;GOT</td>
<td align="left" class="tbltext">&nbsp;Grow Out Test </td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">11</td>
<td align="left" class="tbltext">&nbsp;GS</td>
<td align="left" class="tbltext">&nbsp;Guard Sample  </td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">12</td>
<td align="left" class="tbltext">&nbsp;GSRP</td>
<td align="left" class="tbltext">&nbsp;Guard Sample Retention Period </td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">13</td>
<td align="left" class="tbltext">&nbsp;ID</td>
<td align="left" class="tbltext">&nbsp;Identification </td>
</tr>

<tr class="Light">
<td align="center" class="tbltext">14</td>
<td align="left" class="tbltext">&nbsp;Kgs.</td>
<td align="left" class="tbltext">&nbsp;Kilograms</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">15</td>
<td align="left" class="tbltext">&nbsp;No.</td>
<td align="left" class="tbltext">&nbsp;Number  </td>
</tr>

<tr class="Light">
  <td align="center" class="tbltext">16</td>
  <td align="left" class="tbltext">&nbsp;NoWB</td>
  <td align="left" class="tbltext">&nbsp;Numbers of Window Box</td>
</tr>
<tr class="Dark">
  <td align="center" class="tbltext">17</td>
  <td align="left" class="tbltext">&nbsp;OP</td>
  <td align="left" class="tbltext">&nbsp;Open Pollinated</td>
</tr>

<tr class="Light">
<td align="center" class="tbltext">18</td>
<td align="left" class="tbltext">&nbsp;PAN</td>
<td align="left" class="tbltext">&nbsp;Pernmant Account number</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">19</td>
<td align="left" class="tbltext">&nbsp;PSW</td>
<td align="left" class="tbltext">&nbsp;Pack Seed Warehouse </td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">20</td>
<td align="left" class="tbltext">&nbsp;RSW</td>
<td align="left" class="tbltext">&nbsp;Raw Seed Warehouse</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">21</td>
<td align="left" class="tbltext">&nbsp;RV</td>
<td align="left" class="tbltext">&nbsp;Report Viewer</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">22</td>
<td align="left" class="tbltext">&nbsp;Seed Lic. No.</td>
<td align="left" class="tbltext">&nbsp;Seed License Number</td>
</tr>


<tr class="Dark">
<td align="center" class="tbltext">23</td>
<td align="left" class="tbltext">&nbsp;SIG%</td>
<td align="left" class="tbltext">&nbsp;Significant Indicative Germination Percentage </td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">24</td>
<td align="left" class="tbltext">&nbsp;SLOC </td>
<td align="left" class="tbltext">&nbsp;Storage Location </td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">25</td>
<td align="left" class="tbltext">&nbsp;TDF</td>
<td align="left" class="tbltext">&nbsp;Trial/Demo/Free</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">26</td>
<td align="left" class="tbltext">&nbsp;TIN</td>
<td align="left" class="tbltext">&nbsp;Tax Identification Number </td>
</tr>


<tr class="Dark">
  <td align="center" class="tbltext">27</td>
  <td align="left" class="tbltext">&nbsp;UoM</td>
  <td align="left" class="tbltext">&nbsp;Unit of Measurement</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">28</td>
<td align="left" class="tbltext">&nbsp;UPS</td>
<td align="left" class="tbltext">&nbsp;Unit Pack Size</td>
</tr>

<tr class="Dark">
<td align="center" class="tbltext">29</td>
<td align="left" class="tbltext">&nbsp;WB</td>
<td align="left" class="tbltext">&nbsp;Window Box </td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">30</td>
<td align="left" class="tbltext">&nbsp;WH</td>
<td align="left" class="tbltext">&nbsp;Ware House</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">31</td>
<td align="left" class="tbltext">&nbsp;Wt</td>
<td align="left" class="tbltext">&nbsp;Weight </td>
</tr>

<tr class="tblsubtitle">
       <td colspan="100" class="tblheading"><div align="justify" class="tbltext" style="padding:0px 5px 0px 5px; color:#0000FF">Abbreviations are defined by Application Administrator. Their expansions are available in data entry form and as part of help manual.</div></td>		
     </tr>

<!---table code..--->
</table>
   <br />
   <?php
}
?>
  </form>
</td></tr>
<table align="center" cellpadding="5" cellspacing="5" border="0" width="630">
<tr >
<td align="right" colspan="3">&nbsp;<img src="../images/Vista-printer.png" height="29" width="35" border="0" onClick="javascript:window.print();" />&nbsp;<img src="../images/close_icon2.jpg" height="30"  border="0" onClick="window.close()" />&nbsp;&nbsp;</td>
</tr>
</table>
</body>
</html>
