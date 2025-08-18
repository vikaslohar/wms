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
    $pid = $_REQUEST['cropid'];
	}
	if(isset($_REQUEST['date']))
	{
	 $ee1 = $_REQUEST['date'];
	}
	 if(isset($_REQUEST['txtcrop']))
	{
	$txtcrop= $_REQUEST['txtcrop'];	 
	}
	if(isset($_REQUEST['txtvariety']))
	{
	$txtvariety = $_REQUEST['txtvariety'];	 
	}
	
	
		/*$tdate11=$ee1;
		$tday1=substr($tdate11,0,2);
		$tmonth1=substr($tdate11,3,2);
		$tyear1=substr($tdate11,6,4);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;*/
		
	$tdate1=$ee1;
	
	if(isset($_POST['frm_action'])=='submit')
	{
	//exit;
	
		$sql_arr=mysqli_query($link,"select * from tbl_rsw_main where arrival_id='".$pid."' and plantcode='$plantcode'") or die(mysqli_error($link));
	while($row_arr=mysqli_fetch_array($sql_arr))
	{
	//$partyid=$row_arr['party_id'];
	$tdate11=$row_arr['arrival_date'];
	$ststus=$row_arr['status'];	
	 $sql_arrsub=mysqli_query($link,"select * from tbl_rsw where arrival_id='".$pid."' and plantcode='$plantcode'") or die(mysqli_error($link));
	// $a=mysqli_num_rows(sql_arrsub);
	while($row_arrsub=mysqli_fetch_array($sql_arrsub))
	{
		 $crop=$row_arrsub['crop'];
		$variety=$row_arrsub['variety'];
		$lotno=$row_arrsub['lotno'];
		$arrival_date=$row_arrsub['arrival_date'];
		$pp=$row_arrsub['pp'];
		$moist=$row_arrsub['moist'];
		$gemp=$row_arrsub['gemp'];
		$got=$row_arrsub['got'];
		$qc=$row_arrsub['qc'];
		$zx=str_split($lotno,16);
		//print_r($zx);
		$state="";
	
		if($pp!="")
		{
		$state="P";
		}
		if($moist!="")
		{
		if($state!="")
		$state=$state."/"."M";
		else
		$state="M";
		}
		if($gemp!="")
		{
		if($state!="")
		$state=$state."/"."G";
		else
		$state="G";
		}
		
		$sql_code1="SELECT MAX(sampleno) FROM tbl_qctest where yearid='$yearid_id' and plantcode='$plantcode' ORDER BY tid DESC";
	$res_code1=mysqli_query($link,$sql_code1)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code1) > 0)
			{
				$row_code1=mysqli_fetch_row($res_code1);
				$t_code1=$row_code1['0'];
				$ncode1=$t_code1+1;
				//$ncode=sprintf("%004d",$ncode);
		}
		else
		{ $ncode1=1;
		}
		$sql_sub_sub="insert into tbl_qctest(lotno, oldlot, crop, variety, srdate, sampleno, state, qc, trstage, yearid,logid, plantcode) values('$lotno','$zx[0]','$crop', '$variety', '$tdate1','$ncode1', '$state', 'UT', 'Raw', '$yearid_id','$logid','$plantcode')";
		mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
/*$sql_itm="update tbl_lot_ldg set Undertest='$ststus' arrival_id = '$pid'";
				mysqli_query($link,$sql_itm) or die(mysqli_error($link));
*/			
//exit;
	
	
	  $sql="update tbl_lot_ldg set lotldg_qc='UT' where lotldg_lotno='".$lotno."'";

	$a12=mysqli_query($link,$sql) or die(mysqli_error($link));
	//exit;
	
	}
	
	
		$sql_code="SELECT MAX(arr_code) FROM tbl_rsw_main WHERE plantcode='$plantcode' ORDER BY arr_code DESC";
		
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
		}
		else
		{
			 $code=1;
		}
		
		 $sql_main="update tbl_rsw_main set arrtrflag=1 where arrival_id ='$pid'";

	$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));
	/*echo $pid;	
		echo $sql_main="update tbl_rsw set arrtrflag=1 where arrival_id ='$pid'";

	$a123456=mysqli_query($link,$sql_main) or die(mysqli_error($link));*/

/* $sql_itm="update tbl_lot_ldg set UnderTest='$ststus' arrival_id = '$pid'";
	$qq=mysqli_query($link,$sql_itm) or die(mysqli_error($link));	
*/	//}
 }
 
	echo "<script>window.location='home_qc.php'</script>";	
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC -Transaction -QC Sampling Request- Preview</title>
<link href="../include/main_rsw.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_rsw.css" rel="stylesheet" type="text/css" />
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
var remarks=document.frmaddDepartment.txtvariety.value
//alert("remarks");
winHandle=window.open('qc_print.php?itmid='+itm+'&txtvariety='+remarks,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
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
           <td valign="top"><?php require_once("../include/arr_rsw.php");?></td>
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
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#e48324" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#e48324" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#F1B01E" style="border-bottom:solid; border-bottom-color:#e48324" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - QC Sampling Request  Preview </td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
	  <?php
 $tid=$pid;

$sql_tbl=mysqli_query($link,"select * from tbl_rsw_main where arr_role='".$logid."'  and arrival_id='".$tid."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_rsw where arrival_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate1=$tday."-".$tmonth."-".$tyear;
	?>
	  
	  <td align="center" colspan="4" >
	  
<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"   > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 	<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="Hidden" name="txtitem" value="<?php echo $pid?>" />
		<input type="hidden" name="txtvariety" value="<?php echo $remarks?>" />
			<input type="hidden" name="date" value="<?php echo $tdate?>" />
		</br>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#e48324" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">QC Sampling Request  Preview</td>
</tr>

 <tr class="Dark" height="30">
<td width="159" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="233"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "TRQ".$row_tbl['arr_code']."/".$yearid_id."/".$lgnid;?></td>

<td width="269" align="right" valign="middle" class="tblheading">&nbsp;Date of Sampling Request&nbsp;</td>
<td width="179" align="left" valign="middle" class="tbltext">&nbsp;<?php echo $tdate1;?>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td width="205" align="right" valign="middle" class="tblheading">&nbsp;Stage&nbsp;</td>
<td width="234"  align="left" valign="middle" class="tbltext" colspan="3">&nbsp;Raw Seed</td>
</tr>

</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#e48324" style="border-collapse:collapse">
  
<tr class="tblsubtitle" height="20">
              <td width="24" align="center" valign="middle" class="tblheading">#</td>
			   <td width="117" align="center" valign="middle" class="tblheading">Crop</td>
			  <td width="126" align="center" valign="middle" class="tblheading">Variety</td>
			  <td width="105" align="center" valign="middle" class="tblheading">Lot No. </td>
			  <td width="73" align="center" valign="middle" class="tblheading">NoB</td>
              <td width="84" align="center" valign="middle" class="tblheading">Qty</td>
			   <td width="227" align="center" valign="middle" class="tblheading">SLOC</td>
              <td width="76" align="center" valign="middle" class="tblheading">QC Tests </td>
			    </tr>
   <?php
 
$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{

$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub['variety']."' and actstatus='Active' and vertype='PV'"); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl_sub['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
	
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub['crop']."'"); 
$row31=mysqli_fetch_array($quer3);
 $lot=$row_tbl_sub['lotno'];

 $row_tbl_sub['lotno'];
 $totqty=0; $totnob=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; 	$sloc=""; 
	$sql_issue=mysqli_query($link,"select distinct lotldg_subbinid, lotldg_whid, lotldg_binid from tbl_lot_ldg where  lotldg_lotno='".$row_tbl_sub['lotno']."' and plantcode='$plantcode' ") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_lotno='".$row_tbl_sub['lotno']."' and plantcode='$plantcode' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 
 $row_issue1[0];
$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0 and plantcode='$plantcode'") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
	$totqty=$totqty+$row_issuetbl['lotldg_balqty']; 
	$totnob=$totnob+$row_issuetbl['lotldg_balbags']; 


$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sups=$sups+$row_issuetbl['lotldg_balbags'];
 $sqty=$sqty+$row_issuetbl['lotldg_balqty'];

if($sloc!="")
$sloc=$sloc.$wareh.$binn.$subbinn." | ".$sups." | ".$sqty."<br/>";
else
$sloc=$wareh.$binn.$subbinn." | ".$sups." | ".$sqty."<br/>";$tp1=12;

}


}




$pp="";
	 if($row_tbl_sub['pp']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['pp'];
}
else
{
$pp=$row_tbl_sub['pp'];
}
}
if($row_tbl_sub['gemp']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['gemp'];
}
else
{
$pp=$row_tbl_sub['gemp'];
}
}
if($row_tbl_sub['got']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['got'];
}
else
{
$pp=$row_tbl_sub['got'];
}
}
if($row_tbl_sub['moist']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['moist'];
}
else
{
$pp=$row_tbl_sub['moist'];
}
}


if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="24" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row31['cropname'];?></td>
	 <td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $vv;?></td>
    <td width="105" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
   <td align="center" valign="middle" class="tblheading"><?php echo $totnob?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
		<td width="227" align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
       
  </tr>
  <?php
}
else
{
?>
   <tr class="Light" height="20">
    <td width="24" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row31['cropname'];?></td>
	 <td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $vv;?></td>
    <td width="105" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
   <td align="center" valign="middle" class="tblheading"><?php echo $totnob?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
		<td width="227" align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
	         </tr>
  <?php
}
$srno++;
}
}

?>
</table>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="edit_qcsamp.php?cropid=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<a href="Javascript:void(0)" onclick="openslocpopprint();"><img src="../images/printpreview.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:Pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
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

  