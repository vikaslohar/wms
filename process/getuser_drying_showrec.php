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

if(isset($_GET['a']))
	{
  $a = $_GET['a'];	 
	}
if(isset($_GET['b']))
	{
	  $b = $_GET['b'];	 
	}
	if(isset($_GET['c']))
	{
	 $c = $_GET['c'];	 
	}
	if(isset($_GET['h']))
	{
	  $h= $_GET['h'];	 
	}
	if(isset($_GET['g']))
	{
	  $g = $_GET['g'];	 
	}
	if(isset($_GET['f']))
	{
	  $f = $_GET['f'];	 
	}
	if(isset($_GET['l']))
	{
	  $stge = $_GET['l'];	 
	}
	
$tot_row=0;
$tot_arrsub=0;

$srno=1;
$lotqry=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_crop ='".$b."' and lotldg_variety='".$c."' and lotldg_sstage='$stge' and lotldg_lotno='$a' and plantcode='$plantcode'")or die (mysqli_error($link));

$tot_row=mysqli_num_rows($lotqry);
if($tot_row > 0)
{

?>
<!--<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="4" align="center" class="tblheading">Post Item Form</td>
  </tr>
  <tr class="Light" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='$b'  order by cropname Asc");
$noticia=mysqli_fetch_array($quer3);
/*		$quer3=$row_cls['cropname'];
*/	
?>

<td width="173" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td width="256" align="left"  valign="middle" class="tbltext" >&nbsp;<?php echo $noticia['cropname'];?>
  <input type="hidden" name="txtcrop" size="25" class="tbltext" value="<?php echo $noticia['cropid'];?>" /></td>
<?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='$c' and actstatus='Active' order by popularname Asc"); 
$noticia_item=mysqli_fetch_array($quer4);
?>
	<td width="84" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="327" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<?php echo $noticia_item['popularname'];?>
    <input type="hidden" class="tbltext" id="itm" name="txtvariety" value="<?php echo $noticia_item['varietyid'];?>" /></td>
  </tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Drying slip reference No. &nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $f;?><input name="txtdrefno" type="hidden" size="20" class="tbltext" tabindex="" maxlength="20" value="<?php echo $f;?>" /></td>
	</tr>
	</table>-->
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >	
  <tr class="tblsubtitle" height="20">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>-->
    <td width="106" align="center" valign="middle" class="smalltblheading" rowspan="2" >Existing SLOC</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Before Drying</td>
	<td align="center" valign="middle" class="smalltblheading" rowspan="2">Store in same Bin</td>
    <td colspan="3" align="center" valign="middle" class="smalltblheading">Updated SLOC</td>
	<td align="center" valign="middle" class="smalltblheading" colspan="2">After Drying </td>
    <td align="center" valign="middle" class="smalltblheading" colspan="2">Drying Loss </td>
  </tr>
  <tr class="tblsubtitle">
    <td width="69" align="center" valign="middle" class="smalltblheading" >NoB</td>
    <td width="81" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="96" align="center" valign="middle" class="smalltblheading">WH</td>
    <td width="109" align="center" valign="middle" class="smalltblheading">Bin</td>
    <td width="89" align="center" valign="middle" class="smalltblheading">Subbin</td>
	<td width="89" align="center" valign="middle" class="smalltblheading">NoB</td>
    <td width="89" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="56" align="center" valign="middle" class="smalltblheading">Qty</td>
    <td width="100" align="center" valign="middle" class="smalltblheading">%</td>
  </tr>
  <?php

$totqty=0; $totnob=0; $tqty=0; $tnob=0; $srno2=0;
$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where lotldg_lotno='".$a."'  and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$a."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { $srno2++;
 	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 
	$tqty=$row_issuetbl['lotldg_balqty']; 
	$tnob=$row_issuetbl['lotldg_balbags']; 

$wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sloc=$wareh."/".$binn."/".$subbinn;
?>
  <tr class="Light" height="30">
    <!--<td width="24" align="center" valign="middle" class="smalltblheading"><?php echo $srno2;?></td>-->
    <td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?><!--<input name="sloc<?php echo $srno2?>" type="text" size="10" class="smalltbltext"  maxlength="12" style="background-color:#CCCCCC" value=""/>--><input type="hidden" name="extslwhg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_whid'];?>" /><input type="hidden" name="extslbing<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_binid'];?>" /><input type="hidden" name="extslsubbg<?php echo $srno2?>" value="<?php echo $row_issuetbl['lotldg_subbinid'];?>" /></td>

    <td width="69"  align="center" valign="middle" class="smallsmalltbltext"><?php echo $tnob;?>
    <input name="txtdisp<?php echo $srno2?>" id="txtdisp<?php echo $srno2?>" type="hidden" size="4" class="smalltbltext" tabindex="" maxlength="5"  onkeypress="return isNumberKey(event)" value="<?php echo $tnob;?>" style="background-color:#CCCCCC"  readonly="true" /></td>
    <td width="81" align="center"  valign="middle" class="smalltbltext"><?php echo $tqty;?>
    <input name="txtqty<?php echo $srno2?>" id="txtqty<?php echo $srno2?>" type="hidden" size="8" class="smalltbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $tqty;?>"/></td>
	<td width="62" align="center"  valign="middle" class="smalltbltext"><input type="checkbox" name="chkbox<?php echo $srno2;?>" id="chkbox<?php echo $srno2;?>" onclick="chkboxchk(<?php echo $srno2?>,<?php echo $row_issuetbl['lotldg_whid'];?>,<?php echo $row_issuetbl['lotldg_binid'];?>,<?php echo $row_issuetbl['lotldg_subbinid'];?>)" value="samebin" /> <input type="hidden" name="samebin<?php echo $srno2;?>" id="samebin<?php echo $srno2;?>" value="No" /></td>

    <td  align="center"  colspan="3" valign="middle" class="smalltbltext">
<div id="samesloc<?php echo $srno2?>">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >	
<tr>	
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
?>

<td width="96" align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtslwhg<?php echo $srno2?>" name="txtslwhg<?php echo $srno2?>" style="width:70px;" onchange="wh<?php echo $srno2?>(this.value,<?php echo $srno2?>);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='$plantcode' order by binname") or die(mysqli_error($link));
?>

<td width="109" align="center"  valign="middle" class="smalltbltext" id="bing<?php echo $srno2?>"><select class="smalltbltext" name="txtslbing<?php echo $srno2?>" style="width:60px;" onchange="bin<?php echo $srno2?>(this.value,<?php echo $srno2?>);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

<?php
$subbind1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' order by sname") or die(mysqli_error($link));
?>	

<td width="89" align="center"  valign="middle" class="smalltbltext" id="sbing<?php echo $srno2?>"><select class="smalltbltext" name="txtslsubbg<?php echo $srno2?>" id="txtslsubbg<?php echo $srno2?>" style="width:60px;" onchange="subbin<?php echo $srno2?>(this.value,<?php echo $srno2?>);"  >
<option value="" selected>Subbin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  </tr>
</table>
</div>


<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno2;?>">
<table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" >		
<tr>
 <td width="50%" align="center"  valign="middle" class="smalltbltext" ><input name="recqtyp<?php echo $srno2?>" id="recqtyp<?php echo $srno2?>" type="text" size="4" class="smalltbltext" tabindex=""   maxlength="7" onkeypress="return isNumberKey1(event)" onchange="qtychk1(this.value,<?php echo $srno2?>);"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

  
  <td width="50%" align="center"  valign="middle" class="smalltbltext"><input name="txtrecbagp<?php echo $srno2?>" id="txtrecbagp<?php echo $srno2?>" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onchange="Bagschk1(this.value,<?php echo $srno2?>);"  onkeypress="return isNumberKey(event)"  />&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
  </tr>
  </table>
  </div>
</td>

      <td align="center"  valign="middle" class="smalltbltext"><input name="txtdqtyp<?php echo $srno2?>" id="txtdqtyp<?php echo $srno2?>" type="text" size="4" class="smalltbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" /></td>
       
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtdbagp<?php echo $srno2?>" id="txtdbagp<?php echo $srno2?>" type="text" size="2" class="smalltbltext" tabindex=""   maxlength="3" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" /></td>
  </tr>
 <?php
  }
}
?>


<tr class="Light" height="30">
    <td align="center" valign="middle" class="smalltblheading">Total<input name="txtlotno" type="hidden" size="15" class="smalltbltext"  maxlength="15" style="background-color:#CCCCCC" value="<?php echo $a;?>"/></td>

    <td width="69"  align="center" valign="middle" class="smalltbltext"><?php echo $totnob;?>
    <input name="txtdisptot" type="hidden" size="4" class="smalltbltext" tabindex="" maxlength="5" onchange="Bagsdcchk1(this.value);" onkeypress="return isNumberKey(event)" value="<?php echo $totnob;?>" style="background-color:#CCCCCC"  readonly="true" /></td>
    <td align="center"  valign="middle" class="smalltbltext"><?php echo $totqty;?><input name="txtqtytot" type="hidden" size="8" class="smalltbltext"  maxlength="9" style="background-color:#CCCCCC" value="<?php echo $totqty;?>"/></td>
	<td colspan="4" align="left"  valign="middle" class="smalltbltext">&nbsp;</td>
	<td align="center"  valign="middle" class="smalltbltext" ><input name="recqtyptot" type="text" size="4" class="smalltbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC"  readonly="true"  />&nbsp;&nbsp;&nbsp;&nbsp;</td>

  
  <td align="center"  valign="middle" class="smalltbltext"><input name="txtrecbagptot" type="text" size="5" class="smalltbltext" tabindex="" maxlength="7" onchange="Bagschk1(this.value);"  style="background-color:#CCCCCC"  readonly="true"  />&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtdqtyptot" type="text" size="4" class="smalltbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" readonly="true" /></td>
       
      <td align="center"  valign="middle" class="smalltbltext"><input name="txtdbagptot" type="text" size="2" class="smalltbltext" tabindex=""   maxlength="3" onkeypress="return isNumberKey1(event)" style="background-color:#CCCCCC" readonly="true" /></td>
</tr>



<tr class="Light" height="30">
    <td align="center" valign="middle" class="smalltblheading">Drying Start</td>

    <td align="center" valign="middle" class="smalltblheading">Date</td>
	<td colspan="4" align="left" valign="middle" class="smalltbltext"  >&nbsp;<input name="datestart" id="datestart" type="text" size="20" class="smalltbltext" bndex="0" readonly="true" style="background-color:#CCCCCC"  value="" maxlength="20" />&nbsp;<img src="../images/cal.gif" onclick="firstdt()" style="cursor:pointer"/>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
	
	
<td align="center" valign="middle" class="smalltblheading">Drying Details</td>
 <td align="center" valign="middle" class="smalltblheading">Type</td>
      <td  align="center"  valign="middle" class="smalltbltext"><select name="txtdmtyp" id="txtdmtyp" class="smalltbltext" style="size:30px;" onchange="chktime(this.value)" >
	  <option value="" selected="selected" class="smalltbltext">-Select-</option>
	  <option value="Floor">Floor</option>
<option value="Machine">Machine</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
	  <td align="center" valign="middle" class="smalltblheading">ID</td>
      <td align="center"  valign="middle" class="smalltbltext"><select name="txtdid" id="txtdid" class="smalltbltext" style="size:30px;" onchange="chkidtyp(this.value)" >
<option value="" selected="selected">-Select-</option>
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
<option value="32">32</option>
<option value="33">33</option>
<option value="34">34</option>
<option value="35">35</option>
<option value="36">36</option>
<option value="37">37</option>
<option value="38">38</option>
<option value="39">39</option>
<option value="40">40</option>
<option value="41">41</option>
<option value="42">42</option>
<option value="43">43</option>
<option value="44">44</option>
<option value="45">45</option>
<option value="46">46</option>
<option value="47">47</option>
<option value="48">48</option>
<option value="49">49</option>
<option value="50">50</option>
<option value="51">51</option>
<option value="52">52</option>
<option value="53">53</option>
<option value="54">54</option>
<option value="55">55</option>
<option value="56">56</option>
<option value="57">57</option>
<option value="58">58</option>
<option value="59">59</option>
<option value="60">60</option>
<option value="61">61</option>
<option value="62">62</option>
<option value="63">63</option>
<option value="64">64</option>
<option value="65">65</option>
<option value="66">66</option>
<option value="67">67</option>
<option value="68">68</option>
<option value="69">69</option>
<option value="70">70</option>
<option value="71">71</option>
<option value="72">72</option>
<option value="73">73</option>
<option value="74">74</option>
<option value="75">75</option>
<option value="76">76</option>
<option value="77">77</option>
<option value="78">78</option>
<option value="79">79</option>
<option value="80">80</option>
<option value="81">81</option>
<option value="82">82</option>
<option value="83">83</option>
<option value="84">84</option>
<option value="85">85</option>
<option value="86">86</option>
<option value="87">87</option>
<option value="88">88</option>
<option value="89">89</option>
<option value="90">90</option>
<option value="91">91</option>
<option value="92">92</option>
<option value="93">93</option>
<option value="94">94</option>
<option value="95">95</option>
<option value="96">96</option>
<option value="97">97</option>
<option value="98">98</option>
<option value="99">99</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>

</tr>
<tr class="Light" height="30">
<td align="center" valign="middle" class="smalltblheading">Drying End</td>

    <td align="center" valign="middle" class="smalltblheading">Date</td>
	<td colspan="4" align="left" valign="middle" class="smalltbltext"  >&nbsp;<input name="dateend" id="dateend" type="text" size="20" class="smalltbltext" bndex="0" readonly="true"  style="background-color:#CCCCCC" value="" maxlength="20" onblur="tdelay(this.value)" />&nbsp;<img src="../images/cal.gif" onclick="caldiff();" style="cursor:pointer"/>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td align="center" valign="middle" class="smalltblheading">Total D. Time</td>	
<td align="left" valign="middle" class="smalltblheading" colspan="4">&nbsp;<input type="text" name="txttottime" class="smalltbltext" size="35" style="background-color:#CCCCCC" readonly="true" /></td> 

</tr>



	  <input type="hidden" name="srno2" value="<?php echo $srno2?>" />
</table>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
<?php
}
else
{
?>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;Lot details cannot display reasons:</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;1. Lot number not Imported</td>
</tr>
<tr class="light" height="20">
  <td colspan="4" align="left" class="tblheading">&nbsp;2. Lot number already arrived.</td>
</tr>
</table>
<?php
}
?>
