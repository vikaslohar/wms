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
<link href="../include/vnrtrac_rsw.css" rel="stylesheet" type="text/css" />

<title>Arrival - Utility - Abbreviations</title>

</head>
<table width="630" border="0" bordercolor="#ffffff" align="center" cellpadding="0" cellspacing="0" >


  <tr valign="top">
  <td width="750" colspan="3" align="center" valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
  	<?php

 if(($role =="admin" || "production" ||"plant"||"arrival"))
 {
		 ?> 
		 
   <table align="center" border="1" width="630" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse">

<tr class="tblsubtitle">
       <td colspan="100" class="tblheading" align="center" bordercolor="#F1B01E" >&nbsp;List of Abbreviation/Short forms </td>
     </tr>
<tr class="Light">
<td width="5%" align="center" class="tblheading">#</td>
<td width="17%" align="left" class="tblheading">&nbsp;Abbreviation </td>
<td width="78%" align="left" class="tblheading">&nbsp;Expansion</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">1</td>
<td align="left" class="tbltext">&nbsp;#</td>
<td align="left" class="tbltext">&nbsp;Serial Number</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">2</td>
<td align="left" class="tbltext">&nbsp;Acc</td>
<td align="left" class="tbltext">&nbsp;Acceptable</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">3</td>
<td align="left" class="tbltext">&nbsp;Admin</td>
<td align="left" class="tbltext">&nbsp;Administrator</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">4</td>
<td align="left" class="tbltext">&nbsp;AF</td>
<td align="left" class="tbltext">&nbsp;Arrival Fresh</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">5</td>
<td align="left" class="tbltext">&nbsp;AR1</td>
<td align="left" class="tbltext">&nbsp;Arrival Operator 1</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">6</td>
<td align="left" class="tbltext">&nbsp;AS</td>
<td align="left" class="tbltext">&nbsp;Arrival Stock Transfer</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">7</td>
<td align="left" class="tbltext">&nbsp;AT</td>
<td align="left" class="tbltext">&nbsp;Arrival Trading</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">8</td>
<td align="left" class="tbltext">&nbsp;AU</td>
<td align="left" class="tbltext">&nbsp;Arrival Unidentified</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">9</td>
<td align="left" class="tbltext">&nbsp;CST</td>
<td align="left" class="tbltext">&nbsp;Central Sales Tax</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">10</td>
<td align="left" class="tbltext">&nbsp;D</td>
<td align="left" class="tbltext">&nbsp;Drying  (Seed Status)</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">11</td>
<td align="left" class="tbltext">&nbsp;DC</td>
<td align="left" class="tbltext">&nbsp;Delivary Challan</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">12</td>
<td align="left" class="tbltext">&nbsp;DoGT</td>
<td align="left" class="tbltext">&nbsp;Date of GOT Test</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">13</td>
<td align="left" class="tbltext">&nbsp;DoT</td>
<td align="left" class="tbltext">&nbsp;Date of QC Test</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">14</td>
<td align="left" class="tbltext">&nbsp;EDOR</td>
<td align="left" class="tbltext">&nbsp;Expected Date of Result</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">15</td>
<td align="left" class="tbltext">&nbsp;E-mail</td>
<td align="left" class="tbltext">&nbsp;Electronic Mail</td>
</tr>

<tr class="Light">
<td align="center" class="tbltext">16</td>
<td align="left" class="tbltext">&nbsp;F</td>
<td align="left" class="tbltext">&nbsp;Fumigation  (Seed Status)</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">17</td>
<td align="left" class="tbltext">&nbsp;FAQ</td>
<td align="left" class="tbltext">&nbsp;Frequently Asked Question</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">18</td>
<td align="left" class="tbltext">&nbsp;FRN</td>
<td align="left" class="tbltext">&nbsp;Fresh Seed Receipt Note</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">19</td>
<td align="left" class="tbltext">&nbsp;Germ%</td>
<td align="left" class="tbltext">&nbsp;Germination Percentage</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">20</td>
<td align="left" class="tbltext">&nbsp;GH</td>
<td align="left" class="tbltext">&nbsp;Guard Warehouse</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">21</td>
<td align="left" class="tbltext">&nbsp;GI</td>
<td align="left" class="tbltext">&nbsp;Geographical Index</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">22</td>
<td align="left" class="tbltext">&nbsp;Gms.</td>
<td align="left" class="tbltext">&nbsp;Grams</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">23</td>
<td align="left" class="tbltext">&nbsp;GOT</td>
<td align="left" class="tbltext">&nbsp;Grow Out Test</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">24</td>
<td align="left" class="tbltext">&nbsp;GOT-NR</td>
<td align="left" class="tbltext">&nbsp;Grow Out Test-Not Recommended</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">25</td>
<td align="left" class="tbltext">&nbsp;GOT-R</td>
<td align="left" class="tbltext">&nbsp;Grow Out Test-Recommended</td>
</tr>

<tr class="Light">
<td align="center" class="tbltext">26</td>
<td align="left" class="tbltext">&nbsp;GS</td>
<td align="left" class="tbltext">&nbsp;Guard Sample </td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">27</td>
<td align="left" class="tbltext">&nbsp;GSRP</td>
<td align="left" class="tbltext">&nbsp;Guard Sample Retention Period</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">28</td>
<td align="left" class="tbltext">&nbsp;ID</td>
<td align="left" class="tbltext">&nbsp;Identification</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">29</td>
<td align="left" class="tbltext">&nbsp;Kgs.</td>
<td align="left" class="tbltext">&nbsp;Kilograms</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">30</td>
<td align="left" class="tbltext">&nbsp;Moist%</td>
<td align="left" class="tbltext">&nbsp;Moisture Percentage</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">31</td>
<td align="left" class="tbltext">&nbsp;No.</td>
<td align="left" class="tbltext">&nbsp;Number </td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">32</td>
<td align="left" class="tbltext">&nbsp;NoB</td>
<td align="left" class="tbltext">&nbsp;Number of Bags </td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">33</td>
<td align="left" class="tbltext">&nbsp;NoWB</td>
<td align="left" class="tbltext">&nbsp;Number of Window Box</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">34</td>
<td align="left" class="tbltext">&nbsp;OLNL</td>
<td align="left" class="tbltext">&nbsp;Old Lot to New Lot Note</td>
</tr>

<tr class="Dark">
<td align="center" class="tbltext">35</td>
<td align="left" class="tbltext">&nbsp;OP</td>
<td align="left" class="tbltext">&nbsp;Open Pollination</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">36</td>
<td align="left" class="tbltext">&nbsp;OP</td>
<td align="left" class="tbltext">&nbsp;Opening Stock</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">37</td>
<td align="left" class="tbltext">&nbsp;PAN</td>
<td align="left" class="tbltext">&nbsp;Pernmant Account number</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">38</td>
<td align="left" class="tbltext">&nbsp;PDN</td>
<td align="left" class="tbltext">&nbsp;Production Dispatch Number</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">39</td>
<td align="left" class="tbltext">&nbsp;PHSRN</td>
<td align="left" class="tbltext">&nbsp;Post Harvest Seed Receipt Note</td>
</tr>

<tr class="Light">
<td align="center" class="tbltext">40</td>
<td align="left" class="tbltext">&nbsp;PM</td>
<td align="left" class="tbltext">&nbsp;Plant Manager</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">41</td>
<td align="left" class="tbltext">&nbsp;PP</td>
<td align="left" class="tbltext">&nbsp;Physical Purity</td>
</tr>

<tr class="Light">
<td align="center" class="tbltext">42</td>
<td align="left" class="tbltext">&nbsp;Prod. Loc.</td>
<td align="left" class="tbltext">&nbsp;Production Location</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">43</td>
<td align="left" class="tbltext">&nbsp;Prod. Pers.</td>
<td align="left" class="tbltext">&nbsp;Production Personnel</td>
</tr>

<tr class="Light">
<td align="center" class="tbltext">44</td>
<td align="left" class="tbltext">&nbsp;Q</td>
<td align="left" class="tbltext">&nbsp;Quarantine (Seed Status)</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">45</td>
<td align="left" class="tbltext">&nbsp;QC</td>
<td align="left" class="tbltext">&nbsp;Quality Control</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">46</td>
<td align="left" class="tbltext">&nbsp;Qty</td>
<td align="left" class="tbltext">&nbsp;Quantity</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">47</td>
<td align="left" class="tbltext">&nbsp;R</td>
<td align="left" class="tbltext">&nbsp;Reserve  (Seed Status)</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">48</td>
<td align="left" class="tbltext">&nbsp;Ref.</td>
<td align="left" class="tbltext">&nbsp;Reference</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">49</td>
<td align="left" class="tbltext">&nbsp;RSW</td>
<td align="left" class="tbltext">&nbsp;Raw Seed Warehouse</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">50</td>
<td align="left" class="tbltext">&nbsp;RT</td>
<td align="left" class="tbltext">&nbsp;Retest</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">51</td>
<td align="left" class="tbltext">&nbsp;Seed Lic. No.</td>
<td align="left" class="tbltext">&nbsp;Seed License Number</td>
</tr>


<tr class="Light">
<td align="center" class="tbltext">52</td>
<td align="left" class="tbltext">&nbsp;SIG%</td>
<td align="left" class="tbltext">&nbsp;Significant Indicative Germination Percentage </td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">53</td>
<td align="left" class="tbltext">&nbsp;SLOC </td>
<td align="left" class="tbltext">&nbsp;Storage Location </td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">54</td>
<td align="left" class="tbltext">&nbsp;SP </td>
<td align="left" class="tbltext">&nbsp;Seed Production</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">55</td>
<td align="left" class="tbltext">&nbsp;SPC-F</td>
<td align="left" class="tbltext">&nbsp;Seed Production Code-Female</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">56</td>
<td align="left" class="tbltext">&nbsp;SPC-M</td>
<td align="left" class="tbltext">&nbsp;Seed Production Code-Male</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">57</td>
<td align="left" class="tbltext">&nbsp;STRN</td>
<td align="left" class="tbltext">&nbsp;Stock Transfer Receipt Note</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">58</td>
<td align="left" class="tbltext">&nbsp;T</td>
<td align="left" class="tbltext">&nbsp;Temporary (Before Transaction ID)</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">59</td>
<td align="left" class="tbltext">&nbsp;TBB</td>
<td align="left" class="tbltext">&nbsp;To Be Billed</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">60</td>
<td align="left" class="tbltext">&nbsp;TDF</td>
<td align="left" class="tbltext">&nbsp;Trial/Demo/Free</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">61</td>
<td align="left" class="tbltext">&nbsp;TIN</td>
<td align="left" class="tbltext">&nbsp;Tax Identification Number </td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">62</td>
<td align="left" class="tbltext">&nbsp;TRN-I</td>
<td align="left" class="tbltext">&nbsp;Trading Seed Receipt Note-Internal</td>
</tr>

<tr class="Dark">
<td align="center" class="tbltext">63</td>
<td align="left" class="tbltext">&nbsp;TRN-P</td>
<td align="left" class="tbltext">&nbsp;Trading Seed Receipt Note-Party</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">64</td>
<td align="left" class="tbltext">&nbsp;UAN</td>
<td align="left" class="tbltext">&nbsp;Unidentified Arrival Note</td>
</tr>
<tr class="Dark">
  <td align="center" class="tbltext">65</td>
  <td align="left" class="tbltext">&nbsp;UoM</td>
  <td align="left" class="tbltext">&nbsp;Unit of Measurement</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">66</td>
<td align="left" class="tbltext">&nbsp;UPS</td>
<td align="left" class="tbltext">&nbsp;Unit Pack Size</td>
</tr>

<tr class="Dark">
<td align="center" class="tbltext">67</td>
<td align="left" class="tbltext">&nbsp;UT</td>
<td align="left" class="tbltext">&nbsp;Under Test</td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">68</td>
<td align="left" class="tbltext">&nbsp;V. Lot No.</td>
<td align="left" class="tbltext">&nbsp;Vendor Lot Number</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">69</td>
<td align="left" class="tbltext">&nbsp;WB</td>
<td align="left" class="tbltext">&nbsp;Window Box </td>
</tr>
<tr class="Light">
<td align="center" class="tbltext">70</td>
<td align="left" class="tbltext">&nbsp;WH</td>
<td align="left" class="tbltext">&nbsp;Ware House</td>
</tr>
<tr class="Dark">
<td align="center" class="tbltext">71</td>
<td align="left" class="tbltext">&nbsp;Wt</td>
<td align="left" class="tbltext">&nbsp;Weight </td>
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
