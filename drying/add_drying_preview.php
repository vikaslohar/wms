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

	if(isset($_REQUEST['p_id']))
	{
		$pid = $_REQUEST['p_id'];
	}
	if(isset($_REQUEST['remarks']))
	{
		$remarks = $_REQUEST['remarks'];
	}
	
	 $sql_main="update tbl_cobdrying set remarks='$remarks' where trid='".$pid."'";
	 mysqli_query($link,$sql_main) or die(mysqli_error($link));

	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
	
		$sql_arr=mysqli_query($link,"select * from tbl_cobdrying where plantcode='".$plantcode."' and   trid='".$pid."'") or die(mysqli_error($link));
		while($row_arr=mysqli_fetch_array($sql_arr))
		{
			$sql_arrsub=mysqli_query($link,"select * from tbl_cobdryingsub where plantcode='".$plantcode."' and   trid='".$pid."'") or die(mysqli_error($link));
			$a_arrsub=mysqli_num_rows($sql_arrsub);
			while($row_arrsub=mysqli_fetch_array($sql_arrsub))
			{
				$lotno=$row_arrsub['lotno'];
				$sqlsub="update tbl_dryarrival_sub set dryflg='1' where lotno='$lotno' and dryflg=0";
				$zaxa=mysqli_query($link,$sqlsub) or die(mysqli_error($link));
			}
		}
		$sql_code1="SELECT MAX(ar_code) FROM tbl_cobdrying where plantcode='".$plantcode."'  ORDER BY ar_code DESC";
		$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
			
		if(mysqli_num_rows($res_code1) > 0)
		{
			$row_code1=mysqli_fetch_row($res_code1);
			$t_code1=$row_code1['0'];
			$ncode1=$t_code1+1;
		}
		else
		{ 
			$ncode1=1;
		}
			
		$sql_main="update tbl_cobdrying set dflg=1, arrflg=1, ar_code=$ncode1 where trid ='$pid'";
		$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
		//exit;
		echo "<script>window.location='select_drying_op.php?p_id=$pid'</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Drying -Transaction - Cob Drying Slip - Preview</title>
<link href="../include/main_drying.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_drying.css" rel="stylesheet" type="text/css" />
</head>
<script src="trading.js"></script>
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
<script language="javascript" type="text/javascript">

function formPost(top_element){
	var inputs=top_element.getElementsByTagName('*');
	var qstring=new Array();
	for(var i=0;i<inputs.length;i++){
		if(!inputs[i].disabled&&inputs[i].getAttribute('name')!=""&&inputs[i].getAttribute('name')){
			qs_str=inputs[i].getAttribute('name')+"="+encodeURIComponent(inputs[i].value);
			switch(inputs[i].tagName.toLowerCase()){
				case "select":
					if(inputs[i].getAttribute("multiple")){
						var len2=inputs[i].length;
						for(var j=0;j<len2;j++){
							if(inputs[i].options[j].selected){
								var targ=(inputs[i].options[j].value) ? inputs[i].options[j].value : inputs[i].options[j].text;
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
							}
						}
					}
					else{
						var targ=(inputs[i].options[inputs[i].selectedIndex].value) ? inputs[i].options[inputs[i].selectedIndex].value : inputs[i].options[inputs[i].selectedIndex].text
						qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
					}
				break;
				case "textarea":
					qstring[qstring.length]=qs_str;
				break;
				case "input":
					switch(inputs[i].getAttribute("type").toLowerCase()){
						case "radio":
							if(inputs[i].checked){
								qstring[qstring.length]=qs_str;
							}
						break;
						case "checkbox":
							if(inputs[i].value!=""){
								if(inputs[i].checked){
									qstring[qstring.length]=qs_str;
								}
							}
							else{
								var stat=(inputs[i].checked) ? "true" : "false"
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+stat;
							}
						break;
						case "text":
							qstring[qstring.length]=qs_str;
						break;
						case "password":
							qstring[qstring.length]=qs_str;
						break;
						case "hidden":
							qstring[qstring.length]=qs_str;
						break;
					}
				break;
			}
		}
	}
	return qstring.join("&");
}

function openslocpopprint()
{
	//alert(txtcrop);
	if(document.frmaddDepartment.txtitem.value!="")
	{
		var itm=document.frmaddDepartment.txtitem.value;
		winHandle=window.open('drying_print.php?itmid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
	else
	{
		alert("Please Select Crop first.");
		document.frmaddDepartment.txtcrop.focus();
	}
}

function mySubmit()
{ 
	if(confirm('Have You completed the Transaction?\nDo You wish to Final Submit it?')==true)
	{
		return true;	 
	}
	else
	{
		return false;
	} 
}

</script>

<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_drying.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/arr_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#adad11" style="border-bottom:solid; border-bottom-color:#adad11" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Cob Drying slip - Preview </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
<?php
	$tid=$pid;
	$sql_tbl=mysqli_query($link,"select * from tbl_cobdrying where plantcode='".$plantcode."' and   trid='".$tid."'") or die(mysqli_error($link));
	$row_tbl=mysqli_fetch_array($sql_tbl);
	 $total_tbl=mysqli_num_rows($sql_tbl);		
	$arrival_id=$row_tbl['trid'];
	
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_cobdryingsub where plantcode='".$plantcode."' and   trid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	$subtid=0;

	$tdate=$row_tbl['dryingdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
?>
 	  
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $pid?>" />
		<input type="hidden" name="remarks" value="<?php echo $remarks?>" />
		</br>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Cob Drying Preview</td>
</tr>

 <tr class="Dark" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TPD".$row_tbl['arr_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="269" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="179" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate;?>&nbsp;</td>
</tr>
<?php
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where popularname ='".$row_tbl['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	if($totver=mysqli_num_rows($quer3) > 0)
	{
		$vername=$rowvv['popularname'];
		$verid=$rowvv['varietyid'];
	}
	else
	{
		$vername=$row_tbl['variety'];
		$verid=$row_tbl['variety'];
	}	
		
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
?>
<tr class="Light" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext" >&nbsp;<?php echo $row31['cropname'];?></td>

<td align="right"  valign="middle" class="tblheading">Variety�&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $vername;?></td>
 </tr>
 <tr class="Dark" height="30">
 <td align="right"  valign="middle" class="tblheading">Drying slip reference No.�&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $row_tbl['drefno'];?></td>
 </tr>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#adad11" style="border-collapse:collapse">
                    <tr class="tblsubtitle" height="20">
              <td width="17" align="center" valign="middle" class="smalltblheading" rowspan="2">#</td>
			   <td width="83" align="center" valign="middle" class="smalltblheading" rowspan="2">Lot No. </td>
			   <td width="106" align="center" valign="middle" class="smalltblheading" rowspan="2">Existing SLOC</td>
			   <td align="center" valign="middle" class="smalltblheading"  colspan="2">Before Drying </td>
			    <td width="107" align="center" valign="middle" class="smalltblheading"rowspan="2" >Updated SLOC</td>
			   <td align="center" valign="middle" class="smalltblheading" colspan="2">After Drying  </td>
			   <td align="center" valign="middle" class="smalltblheading" colspan="2">Drying Loss </td>
			   <td width="75" rowspan="2" align="center" valign="middle" class="smalltblheading" >Drying Start</td>
			    <td width="75" rowspan="2" align="center" valign="middle" class="smalltblheading" >Drying End</td>
				<td width="168" align="center" valign="middle" class="smalltblheading" rowspan="2">Total D.Time</td>
				 <td width="47" align="center" valign="middle" class="smalltblheading" rowspan="2">Drying Details</td>
              </tr>
  <tr class="tblsubtitle">
                    <td width="38" align="center" valign="middle" class="smalltblheading" >NoB</td>
                    <td width="51" align="center" valign="middle" class="smalltblheading">Qty</td>
                    <td width="36" align="center" valign="middle" class="smalltblheading">NoB</td>
                    <td width="56" align="center" valign="middle" class="smalltblheading">Qty</td>
                    <td width="45" align="center" valign="middle" class="smalltblheading">Qty</td>
                    <td width="36" align="center" valign="middle" class="smalltblheading">%</td>
                            </tr>
  <?php
 
$srno=1; 
 $total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
$arrival_id=$row_tbl_sub['trid'];
$difq="";$difq1="";
$sloc=""; $sloc1=""; $cnt++;
					
$sql_tbl_subsub=mysqli_query($link,"select * from tbl_cobdryingsubsub where plantcode='".$plantcode."' and   plantcode='".$plantcode."' and   subtrid='".$row_tbl_sub['subtrid']."' and trid='".$arrival_id."'") or die(mysqli_error($link));
$subsubtbltot=mysqli_num_rows($sql_tbl_subsub);
while($row_tbl_subsub=mysqli_fetch_array($sql_tbl_subsub))
{
 $nb1=0; $qt1=0; $nb2=0; $qt2=0; $wareh=""; $binn=""; $subbinn=""; $wareh1=""; $binn1=""; $subbinn1="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_tbl_subsub['owh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_tbl_subsub['obin']."' and whid='".$row_tbl_subsub['owh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_tbl_subsub['osubbin']."' and binid='".$row_tbl_subsub['obin']."' and whid='".$row_tbl_subsub['owh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];


$sql_whouse1=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_tbl_subsub['nwh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse1=mysqli_fetch_array($sql_whouse1);
$wareh1=$row_whouse1['perticulars']."/";

$sql_binn1=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_tbl_subsub['nbin']."' and whid='".$row_tbl_subsub['nwh']."'") or die(mysqli_error($link));
$row_binn1=mysqli_fetch_array($sql_binn1);
$binn1=$row_binn1['binname']."/";

$sql_subbinn1=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_tbl_subsub['nsubbin']."' and binid='".$row_tbl_subsub['nbin']."' and whid='".$row_tbl_subsub['nwh']."'") or die(mysqli_error($link));
$row_subbinn1=mysqli_fetch_array($sql_subbinn1);
$subbinn1=$row_subbinn1['sname'];

$nb1=$row_tbl_subsub['onob']; 
//$qt1=$row_tbl_subsub['oqty']; 
$nb2=$row_tbl_subsub['nnob']; 
//$qt2=$row_tbl_subsub['nqty'];

$diq=explode(".",$row_tbl_subsub['oqty']);
if($diq[1]==000){$qt1=$diq[0];}else{$qt1=$row_tbl_subsub['oqty'];}

$diq=explode(".",$row_tbl_subsub['nqty']);
if($diq[1]==000){$qt2=$diq[0];}else{$qt2=$row_tbl_subsub['nqty'];}

if($sloc!=""){
$sloc=$sloc."<BR/>".$wareh.$binn.$subbinn."|".$nb1."|".$qt1;}
else{
$sloc=$wareh.$binn.$subbinn."|".$nb1."|".$qt1;}

if($sloc1!=""){
$sloc1=$sloc1."<BR/>".$wareh1.$binn1.$subbinn1."|".$nb2."|".$qt2;}
else{
$sloc1=$wareh1.$binn1.$subbinn1."|".$nb2."|".$qt2;}

}	
$diq=explode(".",$row_tbl_sub['oqty']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['oqty'];}

$diq=explode(".",$row_tbl_sub['qty1']);
if($diq[1]==000){$difq1=$diq[0];}else{$difq1=$row_tbl_sub['qty1'];}

if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['onob'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $difq;?></td>
    <td width="107" align="center" valign="middle" class="smalltbltext"><?php echo $sloc1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['nob1'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $difq1;?></td>
	<td width="45" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adnob'];?></td>
	<td width="36" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adqty'];?></td>
	 <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dsdate'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dedate'];?></td>
	<td width="168" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>
	<td width="47" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['ddtype'];?> <?php echo $row_tbl_sub['ddid'];?></td>
        </tr>
  <?php
}
else
{
?>
<tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $sloc;?></td>
	<td align="center"  valign="middle" class="smalltbltext" ><?php echo $row_tbl_sub['onob'];?></td>
	 <td align="center"  valign="middle" class="smalltbltext" ><?php echo $difq;?></td>
    <td width="107" align="center" valign="middle" class="smalltbltext"><?php echo $sloc1;?></td>
    <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['nob1'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $difq1;?></td>
	<td width="45" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adnob'];?></td>
	<td width="36" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['adqty'];?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dsdate'];?></td>
	  <td align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dedate'];?></td>
	<td width="168" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['dtime'];?></td>
	<td width="47" align="center" valign="middle" class="smalltbltext"><?php echo $row_tbl_sub['ddtype'];?> <?php echo $row_tbl_sub['ddid'];?></td>
        </tr>
  <?php
}
$srno++;
}
}
?>
</table>
<table align="center" border="1" width="970" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<tr class="light" height="30">
  <td width="61" align="right" class="smalltblheading">Remarks&nbsp;</td>
  <td width="903" align="left" class="smalltbltext">&nbsp;<?php echo $remarks;?></td>
</tr>
</table>
<table align="center" width="970" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_drying.php?cropid=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
</tr>
</table>
</td><td width="30"></td>
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

  