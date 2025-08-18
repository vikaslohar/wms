<?php
	session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	/*echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';*/
	header('Location: ../login.php');
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
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$arcode=0;
		$sql_ar=mysqli_query($link,"select max(spcdeccode) from tblspdec  order by spcdeccode desc") or die(mysqli_error($link));
		$row_ar=mysqli_fetch_array($sql_ar);
		$arcode=$row_ar[0];
		$arcode1=$arcode+1;
		$sql_up_arr="update tblspdec set spcdeccode='$arcode1', spdectflg=1 where spdecid='$pid'";
		
		if(mysqli_query($link,$sql_up_arr)or die(mysqli_error($link)))
		{
		
		$sql_dec=mysqli_query($link,"select * from tblspdec where spdecid='$pid' ") or die(mysqli_error($link));
		$tot_dec=mysqli_num_rows($sql_dec);
		$row_dec=mysqli_fetch_array($sql_dec);
		
		$sql_spcdec=mysqli_query($link,"select * from tblspcodes where spdecid='".$pid."' ") or die(mysqli_error($link));
		$tot_spcdec=mysqli_num_rows($sql_spcdec);
		while($row_spcdec=mysqli_fetch_array($sql_spcdec))
		{
			$sql_arr_sub=mysqli_query($link,"select * from tblarrival_sub where spcodef='".$row_spcdec['spcodef']."' and spcodem='".$row_spcdec['spcodem']."' ") or die(mysqli_error($link));
			$tot_arr_sub=mysqli_num_rows($sql_arr_sub);
			if($tot_arr_sub > 0)
			{
				while($row_arr_sub=mysqli_fetch_array($sql_arr_sub))
				{
					$vv=$row_arr_sub['lotcrop']."Coded";
					$fl=0;
					$sql_crop=mysqli_query($link,"select * from tblcrop where cropname='".$row_arr_sub['lotcrop']."'") or die(mysqli_error($link));
					$tot_crop=mysqli_num_rows($sql_crop);
					$row_crop=mysqli_fetch_array($sql_crop);
					
					if($vv!=$row_arr_sub['lotvariety'])
					{
						$sql_variety=mysqli_query($link,"SELECT * FROM tblvariety where popularname='".$row_arr_sub['lotvariety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
						$tot_variety=mysqli_num_rows($sql_variety);
						if($tot_variety==0)
						{
							$f=1;
						}
						else
						{
							$row_variety=mysqli_fetch_array($sql_variety);
							$f=0;
						}
					}
					else
					{
						$fl=1;
					}
					
					if($f==1)
					{
						$sql_lotldg="update tbl_lot_ldg set lotldg_crop='".$row_spcdec['crop']."', lotldg_variety='".$row_spcdec['variety']."' where orlot='".$row_arr_sub['orlot']."'";
						$zz=mysqli_query($link,$sql_lotldg)or die(mysqli_error($link));
					
						$sql_crop22=mysqli_query($link,"select * from tblcrop where cropid='".$row_spcdec['crop']."'") or die(mysqli_error($link));
						$row_crop22=mysqli_fetch_array($sql_crop22);
						
						$sql_variety22=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$row_spcdec['variety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
						$row_variety22=mysqli_fetch_array($sql_variety22);
						
						$sql_qctest="update tbl_qctest set crop='".$row_spcdec['crop']."', variety='".$row_spcdec['variety']."' where oldlot='".$row_arr_sub['orlot']."'";
						$zzz=mysqli_query($link,$sql_qctest)or die(mysqli_error($link));
						
						$sql_gottest="update tbl_gottest  set gottest_crop='".$row_spcdec['crop']."', gottest_variety='".$row_spcdec['variety']."' where gottest_oldlot='".$row_arr_sub['orlot']."'";
						$zzzgot=mysqli_query($link,$sql_gottest)or die(mysqli_error($link));
						
						$sql_gssmaple="update tbl_gsample set gsvariety='".$row_variety22['popularname']."' where oldlot='".$row_arr_sub['orlot']."'";
						$gss=mysqli_query($link,$sql_gssmaple)or die(mysqli_error($link));
						
						$sqltblarsub="update tblarrival_sub set lotvariety='".$row_variety22['popularname']."' where spcodef='".$row_spcdec['spcodef']."' and spcodem='".$row_spcdec['spcodem']."'";
						$xxxx=mysqli_query($link,$sqltblarsub) or die(mysqli_error($link));
						
					}
					
					
					
				}
			}
			
			$sql_variety22=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$row_spcdec['variety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
			$row_variety22=mysqli_fetch_array($sql_variety22);
			
			$sql_arr2_sub=mysqli_query($link,"select * from tblarrival_sub_unld where spcodef='".$row_spcdec['spcodef']."' and spcodem='".$row_spcdec['spcodem']."' ") or die(mysqli_error($link));
			$tot_arr2_sub=mysqli_num_rows($sql_arr2_sub);
			if($tot_arr2_sub > 0)
			{
				while($row_arr2_sub=mysqli_fetch_array($sql_arr2_sub))
				{
					$sqltblarsub="update tblarr_sloc_unld set lotvariety='".$row_variety22['popularname']."' where arr_id='".$row_arr2_sub['arrsub_id']."'";
					$xxxx=mysqli_query($link,$sqltblarsub) or die(mysqli_error($link));
				}
			}
			
			
			$sqltblarsub="update tblarrival_sub_unld set lotvariety='".$row_variety22['popularname']."' where spcodef='".$row_spcdec['spcodef']."' and spcodem='".$row_spcdec['spcodem']."'";
			$xxxx=mysqli_query($link,$sqltblarsub) or die(mysqli_error($link));
			
			$sqlarr_sub=mysqli_query($link,"select * from tbl_dryarrival_sub where spcodef='".$row_spcdec['spcodef']."' and spcodem='".$row_spcdec['spcodem']."' ") or die(mysqli_error($link));
			$totarr_sub=mysqli_num_rows($sqlarr_sub);
			if($totarr_sub > 0)
			{
				while($rowarr_sub=mysqli_fetch_array($sqlarr_sub))
				{
					$vv=$rowarr_sub['lotcrop']."Coded";
					$fl=0;
					$sql_crop=mysqli_query($link,"select * from tblcrop where cropname='".$rowarr_sub['lotcrop']."'") or die(mysqli_error($link));
					$tot_crop=mysqli_num_rows($sql_crop);
					$row_crop=mysqli_fetch_array($sql_crop);
					
					if($vv!=$rowarr_sub['lotvariety'])
					{
						$sql_variety=mysqli_query($link,"SELECT * FROM tblvariety where popularname='".$rowarr_sub['lotvariety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
						$tot_variety=mysqli_num_rows($sql_variety);
						if($tot_variety==0)
						{
							$f=1;
						}
						else
						{
							$row_variety=mysqli_fetch_array($sql_variety);
							$f=0;
						}
					}
					else
					{
						$fl=1;
					}
					
					if($f==1)
					{
					
						$sql_crop22=mysqli_query($link,"select * from tbl_cobdryingsub where lotno='".$rowarr_sub['lotno']."' ") or die(mysqli_error($link));
						$row_crop22=mysqli_fetch_array($sql_crop22);
						
						$sql_qctest="update tbl_cobdrying set crop='".$row_spcdec['crop']."', variety='".$row_spcdec['variety']."' where trid='".$row_crop22['trid']."'";
						$zzz=mysqli_query($link,$sql_qctest)or die(mysqli_error($link));
						
						$sql_gssmaple="update tbl_dryarr_sloc set lotvariety='".$row_variety22['popularname']."' where arr_id='".$rowarr_sub['arrsub_id']."'";
						$gss=mysqli_query($link,$sql_gssmaple)or die(mysqli_error($link));
						
						$sqltblarsub="update tbl_dryarrival_sub set lotvariety='".$row_variety22['popularname']."' where spcodef='".$row_spcdec['spcodef']."' and spcodem='".$row_spcdec['spcodem']."'";
						$xxxx=mysqli_query($link,$sqltblarsub) or die(mysqli_error($link));
					}
					
					
					
				}
			}
			
			
		}
		
		//exit;
		/*echo "<script>window.location='select_op.php?p_id=$pid'</script>";*/
		header('Location: select_op.php?p_id='.$pid);	
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Decode - Transaction - Decode Manual - Preview</title>
<link href="../include/main_dec.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dec.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript" src="../include/validation.js"></script>
<script src="vaddresschk.js"></script>
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
function preview()
{
if(document.frmaddDepartment.txtcrop.value!="")
{
var itm=document.frmaddDepartment.txtcrop.value;
//alert(itm);
winHandle=window.open('arival_preview.php?cropid='+itm,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
}
else
{
alert("Please Select Crop first.");
document.frmaddDepartment.txtcrop.focus();
}
}

//}
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
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_adm.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/dec_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#7a9931" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#7a9931" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/dec_rupee1.gif" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#7a9931" style="border-bottom:solid; border-bottom-color:#7a9931" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Decode Manual - Preview</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	<input type="hidden" name="txtcrop" value="<?php echo $pid?>" />
		</br>

<?php 
$tid=$pid;
$sql_tbl=mysqli_query($link,"select * from tblspdec where spdecid='".$tid."' ") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['spdecid'];

	$tdate=$row_tbl['spdecdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
/*$sql_tbl=mysqli_query($link,"select * from tblarrival where arid='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['arid'];
*/
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#7a9931"
 style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Decode Manual - Preview</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
 <tr class="Light" height="30">
<td width="173" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="266"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo "DM".$row_tbl['scode']."/".$yearid_id."/".$logid;?></td>
<td width="142" align="right"  valign="middle" class="tblheading" >&nbsp;Date&nbsp;</td>
<td align="left" width="259" valign="middle" class="tbltext" colspan="3">&nbsp;<?php echo $tdate;?></td>
</tr>
</table>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#7a9931"
 style="border-collapse:collapse">
  <tr class="tblsubtitle" height="20">
   			  <td width="5%"  align="center" valign="middle" class="tblheading">#</td>
			  <td width="12%" align="center" r valign="middle" class="tblheading">SP Code-Female</td>
              <td width="12%"  align="center" valign="middle" class="tblheading">SP Code-Male</td>
			  <td width="27%"  align="left" valign="middle" class="tblheading">&nbsp;Crop </td>
              <td width="31%"  align="left" valign="middle" class="tblheading">&nbsp;Variety</td>
			  </tr>
  <?php

$sql_tbl_sub=mysqli_query($link,"select * from tblspcodes where spdecid='".$arrival_id."' ") or die(mysqli_error($link));

$srno=1; $spfdchk=""; $spmdchk=""; $spcodedchk=0;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{

/*if($spfdchk!="")
{
$spfdchk=$spfdchk.$row_tbl_sub['spcodef'].",";
}
else
{
$spfdchk=$row_tbl_sub['spcodef'].",";
}

if($spmdchk!="")
{
$spmdchk=$spmdchk.$row_tbl_sub['spcodem'].",";
}
else
{
$spmdchk=$row_tbl_sub['spcodem'].",";
}*/

	$quer3=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['crop']."'"); 
	$row3=mysqli_fetch_array($quer3);

	$quer4=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['variety']."' and actstatus='Active' and vertype='PV'"); 
	$row4=mysqli_fetch_array($quer4);


if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['spcodef'];?></td>
    <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['spcodem'];?></td>
    <td width="27%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row3['cropname'];?></td>
    <td width="31%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row4['popularname'];?></td>
    </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['spcodef'];?></td>
    <td width="12%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['spcodem'];?></td>
    <td width="27%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row3['cropname'];?></td>
    <td width="31%" align="left" valign="middle" class="tblheading">&nbsp;<?php echo $row4['popularname'];?></td>
    </tr>
  <?php
}
$srno++;
}
}
?>
</table>
<br />

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="add_edit.php?cropid=<?php echo $pid;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:pointer;" /></a>&nbsp;&nbsp;<img src="../images/printpreview.gif" border="0"style="display:inline;cursor:pointer;" onClick="preview();"/>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/finalsubmit.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
</tr>
</table>
</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form>	  </td>
	  </tr>
	  </table>
<!-- actual page end--->		  </td>
        </tr>
        <tr>
          <td width="989" valign="top" align="center"  class="border_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td width="989" valign="top" align="left" ><div class="footer" ><a href="Javascript:void(0)" onclick="openslocpop();"></a><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>

  