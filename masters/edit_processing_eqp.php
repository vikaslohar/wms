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
	if(isset($_REQUEST['cropid']))
	{
	$id=trim($_REQUEST['cropid']);
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$crop=trim($_POST['txtcrop']);
		$sig=trim($_POST['txtsig']);
		$mac=$crop;
		
		$query=mysqli_query($link,"SELECT * FROM tbl_rm_promac where promac_type='$crop' and promac_macid='$sig' and promac_id!='$id'") or die("Error: " . mysqli_error($link));
   		$numofrecords=mysqli_num_rows($query);
		
	 	 if( $numofrecords > 0)
		 {?>
		 <script>
		  alert("This Processing Equipment with this Id is already present");
		  </script>
		 <?php }
		 else 
		 {
		$sql_in="Update tbl_rm_promac set promac_type='$crop', promac_mac='$mac', promac_macid='$sig' where promac_id='$id'";
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{
			echo "<script>window.location='home_processing_eqp.php?print=add'</script>";	
		}
		}
	}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Administration - Processing Machine Code Master -Add Processing Machine Code</title>
<link href="../include/main_adm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">

//SuckerTree Horizontal Menu (Sept 14th, 06)
//By Dynamic Drive: http://www.dynamicdrive.com/style/

var menuids=["nav"] //Enter id(s) of SuckerTree UL menus, separated by commas

function buildsubmenus_horizontal(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
		if (ultags[t].parentNode.parentNode.id==menuids[i]){ //if this is a first level submenu
			ultags[t].style.top=ultags[t].parentNode.offsetHeight+"px" //dynamically position first level submenus to be height of main menu item
			ultags[t].parentNode.getElementsByTagName("a")[0].className="mainfoldericon"
		}
		else{ //else if this is a sub level menu (ul)
		  ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    	ultags[t].parentNode.getElementsByTagName("a")[0].className="subfoldericon"
		}
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.visibility="visible"
    }
    ultags[t].parentNode.onmouseout=function(){
  this.getElementsByTagName("ul")[0].style.visibility="hidden"
    }
    }
  }
}

if (window.addEventListener)
window.addEventListener("load", buildsubmenus_horizontal, false)
else if (window.attachEvent)
window.attachEvent("onload", buildsubmenus_horizontal)

</script>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
function ucwords_w(str) { return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }

function onloadfocus()
	{
	document.frmaddcrop.txtcrop.focus();
	}
 
function isCharKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode != 32 && charCode != 8 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
return false;

//return true;
}
function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }


function chkcode(val)
{
	if(document.frmaddcrop.txtcrop.value=="")
	{
		alert("Enter Type");
	 	document.frmaddcrop.txtcrop.focus();
	 	return false;
	}
	else
	{
		if(document.frmaddcrop.txtcrop.value < 2)
		{
			alert("Enter Two Alphabets.");
			document.frmaddcrop.txtcrop.focus();
			return false;
		}
		if(!isNaN(document.frmaddcrop.txtcrop.value))
		{
			alert("Enter Two Alphabets.");
			document.frmaddcrop.txtcrop.focus();
			return false;
		}
	}
}


function mySubmit()
{
	if(document.frmaddcrop.txtcrop.value=="")
	{
		alert("Enter Type");
		document.frmaddcrop.txtcrop.focus();
		return false;
	}
    if (document.frmaddcrop.txtsig.value=="") 
    {
		alert ("Select Id");
		document.frmaddcrop.txtsig.focus();
		return false;
	} 
return true;
}


</SCRIPT>

<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"  onLoad="return onloadfocus()">
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_adm1.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="500" align="center"  class="midbgline">

		  
<!-- actual page start--->	
	  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Processing Machine Code Master - Edit</td>
	    </tr></table></td>
	    	 </tr>
	  </table></td></tr>
   	  <td align="center" colspan="4" >
	   
	  <form name="frmaddcrop" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return confirm('You are adding:\nType:  '+document.frmaddcrop.txtcrop.value+'\nId: ' +document.frmaddcrop.txtsig.value);" onReset="onloadfocus();"> 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="499" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1"style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="subheading">Edit Processing Machine Code</td>
</tr>
<tr height="30">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
<?php
$query=mysqli_query($link,"SELECT * FROM tbl_rm_promac where promac_id='$id'") or die("Error: " . mysqli_error($link));
$numofrecords=mysqli_num_rows($query);
$row=mysqli_fetch_array($query);
?>  
<tr class="Light" height="25">
<td width="223" align="right" height="30" valign="middle" class="tblheading">Type&nbsp;</td>
<td width="270" align="left"  valign="middle">&nbsp;<input type="text" name="txtcrop" class="tbltext" size="1" maxlength="2" onChange="chkcode(this.value);" onKeyPress="return isCharKey(event)" value="<?php echo $row['promac_mac'];?>" >&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr>
<tr class="Light" height="25">
<td width="223" align="right" height="30" valign="middle" class="tblheading">Id&nbsp;</td>
<td width="270" align="left"  valign="middle">&nbsp;<select name="txtsig" class="tbltext" style="size:60px;" >
<option value="" selected="selected">--Select--</option>
<option <?php if($row['promac_macid']=="01") echo "selected"; ?> value="01">01</option>
<option <?php if($row['promac_macid']=="02") echo "selected"; ?> value="02">02</option>
<option <?php if($row['promac_macid']=="03") echo "selected"; ?> value="03">03</option>
<option <?php if($row['promac_macid']=="04") echo "selected"; ?> value="04">04</option>
<option <?php if($row['promac_macid']=="05") echo "selected"; ?> value="05">05</option>
<option <?php if($row['promac_macid']=="06") echo "selected"; ?> value="06">06</option>
<option <?php if($row['promac_macid']=="07") echo "selected"; ?> value="07">07</option>
<option <?php if($row['promac_macid']=="08") echo "selected"; ?> value="08">08</option>
<option <?php if($row['promac_macid']=="09") echo "selected"; ?> value="09">09</option>
<option <?php if($row['promac_macid']=="10") echo "selected"; ?> value="10">10</option>
<option <?php if($row['promac_macid']=="11") echo "selected"; ?> value="11">11</option>
<option <?php if($row['promac_macid']=="12") echo "selected"; ?> value="12">12</option>
<option <?php if($row['promac_macid']=="13") echo "selected"; ?> value="13">13</option>
<option <?php if($row['promac_macid']=="14") echo "selected"; ?> value="14">14</option>
<option <?php if($row['promac_macid']=="15") echo "selected"; ?> value="15">15</option>
<option <?php if($row['promac_macid']=="16") echo "selected"; ?> value="16">16</option>
<option <?php if($row['promac_macid']=="17") echo "selected"; ?> value="17">17</option>
<option <?php if($row['promac_macid']=="18") echo "selected"; ?> value="18">18</option>
<option <?php if($row['promac_macid']=="19") echo "selected"; ?> value="19">19</option>
<option <?php if($row['promac_macid']=="20") echo "selected"; ?> value="20">20</option>
<option <?php if($row['promac_macid']=="21") echo "selected"; ?> value="21">21</option>
<option <?php if($row['promac_macid']=="22") echo "selected"; ?> value="22">22</option>
<option <?php if($row['promac_macid']=="23") echo "selected"; ?> value="23">23</option>
<option <?php if($row['promac_macid']=="24") echo "selected"; ?> value="24">24</option>
<option <?php if($row['promac_macid']=="25") echo "selected"; ?> value="25">25</option>
<option <?php if($row['promac_macid']=="26") echo "selected"; ?> value="26">26</option>
<option <?php if($row['promac_macid']=="27") echo "selected"; ?> value="27">27</option>
<option <?php if($row['promac_macid']=="28") echo "selected"; ?> value="28">28</option>
<option <?php if($row['promac_macid']=="29") echo "selected"; ?> value="29">29</option>
<option <?php if($row['promac_macid']=="30") echo "selected"; ?> value="30">30</option>
<option <?php if($row['promac_macid']=="31") echo "selected"; ?> value="31">31</option>
<option <?php if($row['promac_macid']=="32") echo "selected"; ?> value="32">32</option>
<option <?php if($row['promac_macid']=="33") echo "selected"; ?> value="33">33</option>
<option <?php if($row['promac_macid']=="34") echo "selected"; ?> value="34">34</option>
<option <?php if($row['promac_macid']=="35") echo "selected"; ?> value="35">35</option>
<option <?php if($row['promac_macid']=="36") echo "selected"; ?> value="36">36</option>
<option <?php if($row['promac_macid']=="37") echo "selected"; ?> value="37">37</option>
<option <?php if($row['promac_macid']=="38") echo "selected"; ?> value="38">38</option>
<option <?php if($row['promac_macid']=="39") echo "selected"; ?> value="39">39</option>
<option <?php if($row['promac_macid']=="40") echo "selected"; ?> value="40">40</option>
<option <?php if($row['promac_macid']=="41") echo "selected"; ?> value="41">41</option>
<option <?php if($row['promac_macid']=="42") echo "selected"; ?> value="42">42</option>
<option <?php if($row['promac_macid']=="43") echo "selected"; ?> value="43">43</option>
<option <?php if($row['promac_macid']=="44") echo "selected"; ?> value="44">44</option>
<option <?php if($row['promac_macid']=="45") echo "selected"; ?> value="45">45</option>
<option <?php if($row['promac_macid']=="46") echo "selected"; ?> value="46">46</option>
<option <?php if($row['promac_macid']=="47") echo "selected"; ?> value="47">47</option>
<option <?php if($row['promac_macid']=="48") echo "selected"; ?> value="48">48</option>
<option <?php if($row['promac_macid']=="49") echo "selected"; ?> value="49">49</option>
<option <?php if($row['promac_macid']=="50") echo "selected"; ?> value="50">50</option>
<option <?php if($row['promac_macid']=="51") echo "selected"; ?> value="51">51</option>
<option <?php if($row['promac_macid']=="52") echo "selected"; ?> value="52">52</option>
<option <?php if($row['promac_macid']=="53") echo "selected"; ?> value="53">53</option>
<option <?php if($row['promac_macid']=="54") echo "selected"; ?> value="54">54</option>
<option <?php if($row['promac_macid']=="55") echo "selected"; ?> value="55">55</option>
<option <?php if($row['promac_macid']=="56") echo "selected"; ?> value="56">56</option>
<option <?php if($row['promac_macid']=="57") echo "selected"; ?> value="57">57</option>
<option <?php if($row['promac_macid']=="58") echo "selected"; ?> value="58">58</option>
<option <?php if($row['promac_macid']=="59") echo "selected"; ?> value="59">59</option>
<option <?php if($row['promac_macid']=="60") echo "selected"; ?> value="60">60</option>
<option <?php if($row['promac_macid']=="61") echo "selected"; ?> value="61">61</option>
<option <?php if($row['promac_macid']=="62") echo "selected"; ?> value="62">62</option>
<option <?php if($row['promac_macid']=="63") echo "selected"; ?> value="63">63</option>
<option <?php if($row['promac_macid']=="64") echo "selected"; ?> value="64">64</option>
<option <?php if($row['promac_macid']=="65") echo "selected"; ?> value="65">65</option>
<option <?php if($row['promac_macid']=="66") echo "selected"; ?> value="66">66</option>
<option <?php if($row['promac_macid']=="67") echo "selected"; ?> value="67">67</option>
<option <?php if($row['promac_macid']=="68") echo "selected"; ?> value="68">68</option>
<option <?php if($row['promac_macid']=="69") echo "selected"; ?> value="69">69</option>
<option <?php if($row['promac_macid']=="70") echo "selected"; ?> value="70">70</option>
<option <?php if($row['promac_macid']=="71") echo "selected"; ?> value="71">71</option>
<option <?php if($row['promac_macid']=="72") echo "selected"; ?> value="72">72</option>
<option <?php if($row['promac_macid']=="73") echo "selected"; ?> value="73">73</option>
<option <?php if($row['promac_macid']=="74") echo "selected"; ?> value="74">74</option>
<option <?php if($row['promac_macid']=="75") echo "selected"; ?> value="75">75</option>
<option <?php if($row['promac_macid']=="76") echo "selected"; ?> value="76">76</option>
<option <?php if($row['promac_macid']=="77") echo "selected"; ?> value="77">77</option>
<option <?php if($row['promac_macid']=="78") echo "selected"; ?> value="78">78</option>
<option <?php if($row['promac_macid']=="79") echo "selected"; ?> value="79">79</option>
<option <?php if($row['promac_macid']=="80") echo "selected"; ?> value="80">80</option>
<option <?php if($row['promac_macid']=="81") echo "selected"; ?> value="81">81</option>
<option <?php if($row['promac_macid']=="82") echo "selected"; ?> value="82">82</option>
<option <?php if($row['promac_macid']=="83") echo "selected"; ?> value="83">83</option>
<option <?php if($row['promac_macid']=="84") echo "selected"; ?> value="84">84</option>
<option <?php if($row['promac_macid']=="85") echo "selected"; ?> value="85">85</option>
<option <?php if($row['promac_macid']=="86") echo "selected"; ?> value="86">86</option>
<option <?php if($row['promac_macid']=="87") echo "selected"; ?> value="87">87</option>
<option <?php if($row['promac_macid']=="88") echo "selected"; ?> value="88">88</option>
<option <?php if($row['promac_macid']=="89") echo "selected"; ?> value="89">89</option>
<option <?php if($row['promac_macid']=="90") echo "selected"; ?> value="90">90</option>
<option <?php if($row['promac_macid']=="91") echo "selected"; ?> value="91">91</option>
<option <?php if($row['promac_macid']=="92") echo "selected"; ?> value="92">92</option>
<option <?php if($row['promac_macid']=="93") echo "selected"; ?> value="93">93</option>
<option <?php if($row['promac_macid']=="94") echo "selected"; ?> value="94">94</option>
<option <?php if($row['promac_macid']=="95") echo "selected"; ?> value="95">95</option>
<option <?php if($row['promac_macid']=="96") echo "selected"; ?> value="96">96</option>
<option <?php if($row['promac_macid']=="97") echo "selected"; ?> value="97">97</option>
<option <?php if($row['promac_macid']=="98") echo "selected"; ?> value="98">98</option>
<option <?php if($row['promac_macid']=="99") echo "selected"; ?> value="99">99</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
</tr>

</table>


<table align="center" width="509" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td width="489" align="center" valign="top"><a href="home_processing_eqp.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;&nbsp;<a href="javascript:document.frmaddcrop.reset()"><img src="../images/reset.gif" OnClick="myReset()"alt="reset"  border="0" style="display:inline;cursor:pointer;"></a>&nbsp;
  <input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" OnClick="return mySubmit()" border="0" style="display:inline;cursor:pointer;"></td>
</tr>
</table>
</td>
<td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	  
	  </td>
	  </tr>
	  </table>
		  
<!-- actual page end--->			  
		  </td>
        </tr>
        <tr>
          <td width="989" valign="top" align="center"  class="border_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
