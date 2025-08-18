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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order- Utility - Abbreviations</title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
</head>




  <tr valign="top">
  <td width="750" colspan="3" align="center" valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
  	<?php

 if(($role =="admin" || "production" ||"plant"||"arrival"))
 {
		 ?> 
	  <table align="center" border="1" width="630" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse"> 
<tr class="tblsubtitle">
       <td colspan="100" class="tblheading" align="center" bordercolor="#cc30cc" >&nbsp;List of Abbreviation/Short forms </td>
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
<td align="left" class="tbltext">&nbsp;C&amp;F</td>
<td align="left" class="tbltext">&nbsp;Carrying and Forwarding </td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">4</td>
<td align="left" class="tbltext">&nbsp;CST </td>
<td align="left" class="tbltext">&nbsp;Central Sales Tax</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">5</td>
<td align="left" class="tbltext">&nbsp;DON</td>
<td align="left" class="tbltext">&nbsp;Demo Order Note </td>
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
<td align="left" class="tbltext">&nbsp;Hyb.</td>
<td align="left" class="tbltext">&nbsp;Hybrid</td>
</tr>

<tr class="Light">
<td align="center" class="tbltext">9</td>
<td align="left" class="tbltext">&nbsp;Id No. </td>
<td align="left" class="tbltext">&nbsp;Identification number </td>
</tr>


<tr class="Dark">
<td align="center" class="tbltext">10</td>
<td align="left" class="tbltext">&nbsp;Ltd.</td>
<td align="left" class="tbltext">&nbsp;Limited</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">11</td>
<td align="left" class="tbltext">&nbsp;NoMP</td>
<td align="left" class="tbltext">&nbsp;Number of Master Packs </td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">12</td>
<td align="left" class="tbltext">&nbsp;NoP</td>
<td align="left" class="tbltext">&nbsp;Number of Pouches</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">13</td>
<td align="left" class="tbltext">&nbsp;NoWB</td>
<td align="left" class="tbltext">&nbsp;Number of Master Window Packs </td>
</tr>
<tr class="Dark">
  <td align="center" class="tbltext">14</td>
  <td align="left" class="tbltext">&nbsp;NST</td>
  <td align="left" class="tbltext">&nbsp;Non Standard </td>
</tr>



<tr class="Light">
<td align="center" class="tbltext">15</td>
<td align="left" class="tbltext">&nbsp;O/P</td>
<td align="left" class="tbltext">&nbsp;Output</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">16</td>
<td align="left" class="tbltext">&nbsp;OHN</td>
<td align="left" class="tbltext">&nbsp;Order Hold Note </td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">17</td>
<td align="left" class="tbltext">&nbsp;OP</td>
<td align="left" class="tbltext">&nbsp;Open Pollinated</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">18</td>
<td align="left" class="tbltext">&nbsp;OR No. </td>
<td align="left" class="tbltext">&nbsp;Order Number </td>
</tr>



<tr class="Light">
<td align="center" class="tbltext">19</td>
<td align="left" class="tbltext">&nbsp;PAN </td>
<td align="left" class="tbltext">&nbsp;Permanent Account Number </td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">20</td>
<td align="left" class="tbltext">&nbsp;Party Order Ref. No. </td>
<td align="left" class="tbltext">&nbsp;Party Order Reference Number </td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">21</td>
<td align="left" class="tbltext">&nbsp;PT</td>
<td align="left" class="tbltext">&nbsp;Pack Type</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">22</td>
<td align="left" class="tbltext">&nbsp;Pvt.</td>
<td align="left" class="tbltext">&nbsp;Private</td>
</tr>


<tr class="Dark">
  <td align="center" class="tbltext">23</td>
  <td align="left" class="tbltext">&nbsp;Qty</td>
  <td align="left" class="tbltext">&nbsp;Quantity</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">24</td>
<td align="left" class="tbltext">&nbsp;Ref.</td>
<td align="left" class="tbltext">&nbsp;Reference</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">25</td>
<td align="left" class="tbltext">&nbsp;Seed Lic. No.</td>
<td align="left" class="tbltext">&nbsp;Seed License Number</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">26</td>
<td align="left" class="tbltext">&nbsp;SON</td>
<td align="left" class="tbltext">&nbsp;Sales Order Note </td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">27</td>
<td align="left" class="tbltext">&nbsp;ST</td>
<td align="left" class="tbltext">&nbsp;Standard</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">28</td>
<td align="left" class="tbltext">&nbsp;Std P</td>
<td align="left" class="tbltext">&nbsp;Standard Pack weight in Kgs.</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">29</td>
<td align="left" class="tbltext">&nbsp;TDF</td>
<td align="left" class="tbltext">&nbsp;Trial/Demo/Free </td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">30</td>
<td align="left" class="tbltext">&nbsp;TIN</td>
<td align="left" class="tbltext">&nbsp;Tax Identification Number</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">31</td>
<td align="left" class="tbltext">&nbsp;TOD</td>
<td align="left" class="tbltext">&nbsp;Transaction Order T/D/F</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">32</td>
<td align="left" class="tbltext">&nbsp;TON</td>
<td align="left" class="tbltext">&nbsp;Transfer Order Note</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">33</td>
<td align="left" class="tbltext">&nbsp;TOR</td>
<td align="left" class="tbltext">&nbsp;Temporary Order</td>
</tr>


<tr class="Light">
<td align="center" class="tbltext">34</td>
<td align="left" class="tbltext">&nbsp;TOS</td>
<td align="left" class="tbltext">&nbsp;Temporary Order Sales </td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">35</td>
<td align="left" class="tbltext">&nbsp;TOT</td>
<td align="left" class="tbltext">&nbsp;Temporary Stock Transfer </td>
</tr>


<tr class="Light">
<td align="center" class="tbltext">37</td>
<td align="left" class="tbltext">&nbsp;UDF</td>
<td align="left" class="tbltext">&nbsp;User Define Fields </td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">36</td>
<td align="left" class="tbltext">&nbsp;UPS</td>
<td align="left" class="tbltext">&nbsp;Unit Pack Size </td>
</tr>

<tr class="Light">
<td align="center" class="tbltext">38</td>
<td align="left" class="tbltext">&nbsp;Var. No. </td>
<td align="left" class="tbltext">&nbsp;Number of Varities </td>
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
