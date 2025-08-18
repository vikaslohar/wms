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
	
	
	if(isset($_POST['frm_action'])=='submit')
	{	
		$code=trim($_POST['code']);
		$txtdate=trim($_POST['txtdate']);
		$txtstage=trim($_POST['txtstage']);
		
		$tdate=$txtdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;	
		
		$sql_ins="Insert into tbl_lotmgen_exp (lme_code, lme_date, lme_stage, lme_logid, lme_flg, plantcode) values('$code', '$tdate', '$txtstage', '$logid', '1', '$plantcode')";
		//exit;
		if(mysqli_query($link,$sql_ins) or die(mysqli_error($link)))
		{
			$mainid=mysqli_insert_id($link);
			
			$cd1='R'; $cd2='C';
	
			if(date("Y")==$year1)$yer2=$year1;
			if(date("Y")==$year2)$yer2=$year2;
			
			$sql_lgenyr=mysqli_query($link,"select * from tbl_lgenyear where lgenyear='".$yer2."' AND plantcode='".$plantcode."'") or die(mysqli_error($link));
			$row_lgenyr=mysqli_fetch_array($sql_lgenyr);
			$yer=$row_lgenyr['lgenyearcode'];
			if($yer=="")$yer=$yearid_id;
			
			$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
			$row_cls=mysqli_fetch_array($quer_cn);
			$tp1=$row_cls['code'];
			
			$sql_lotm=mysqli_query($link,"SELECT MAX(lotmgen_lot) FROM tbl_lotmgen  where lotmgen_yearcode='$yer' AND plantcode='".$plantcode."' ORDER BY lotmgen_yearcode DESC") or die(mysqli_error($link));
			$tot_lotm=mysqli_num_rows($sql_lotm);
			$tm_code=0;
			if($tot_lotm > 0)
			{
				$row_lotm=mysqli_fetch_array($sql_lotm);
				$tm_code=$row_lotm['0'];
				if($tm_code > 0)
				$lot_code=$tm_code;
				else
				$lot_code=90000;
			}
			else
			{
				$lot_code=90000;
			}
			
			if($lot_code!="")
			{
				$ltn=$lot_code;
				if($txtstage=='Both')
				{
					if($txtstage=='Both') $sstage='Raw';
					for($i=1; $i<=5; $i++)
					{
						$ltn=$ltn+1;
						$lotnonew=$tp1.$yer.$ltn."/00000/00".$cd1;
						$lotnoornew=$tp1.$yer.$ltn."/00000/00";
			
						$sql_sub_sub="insert into tbl_lotmgen_expsub(lme_id, lmes_stage, lmes_lot, lmes_lotno, lmes_orlot, lmes_yearid, lmes_logid, plantcode) values('$mainid', '$sstage', '$ltn', '$lotnonew', '$lotnoornew', '$yearid_id', '$logid', '$plantcode')";
						mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
						
						$sql_sub_upd="Insert into tbl_lotmgen (lotmgen_lot, lotmgen_lotno, lotmgen_orlot, lotmgen_yearcode, lotmgen_yearid, lotmgen_logid, lotmgen_wyearcode, plantcode) values ('$ltn', '$lotnonew', '$lotnoornew', '$yer', '$yer2', '$logid', '$yearid_id', '$plantcode')";
						$z12345=mysqli_query($link,$sql_sub_upd) or die(mysqli_error($link));
					}
				
				
					if($txtstage=='Both') $sstage='Condition';
					for($i=1; $i<=5; $i++)
					{
						$ltn=$ltn+1;
						$lotnonew=$tp1.$yer.$ltn."/00000/00".$cd2;
						$lotnoornew=$tp1.$yer.$ltn."/00000/00";
			
						$sql_sub_sub="insert into tbl_lotmgen_expsub(lme_id, lmes_stage, lmes_lot, lmes_lotno, lmes_orlot, lmes_yearid, lmes_logid, plantcode) values('$mainid', '$sstage', '$ltn', '$lotnonew', '$lotnoornew', '$yearid_id', '$logid', '$plantcode')";
						mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
						
						$sql_sub_upd="Insert into tbl_lotmgen (lotmgen_lot, lotmgen_lotno, lotmgen_orlot, lotmgen_yearcode, lotmgen_yearid, lotmgen_logid, lotmgen_wyearcode, plantcode) values ('$ltn', '$lotnonew', '$lotnoornew', '$yer', '$yer2', '$logid', '$yearid_id', '$plantcode')";
						$z12345=mysqli_query($link,$sql_sub_upd) or die(mysqli_error($link));
					}
				}
				if($txtstage=='Raw')
				{
					$sstage='Raw';
					for($i=1; $i<=5; $i++)
					{
						$ltn=$ltn+1;
						$lotnonew=$tp1.$yer.$ltn."/00000/00".$cd1;
						$lotnoornew=$tp1.$yer.$ltn."/00000/00";
			
						$sql_sub_sub="insert into tbl_lotmgen_expsub(lme_id, lmes_stage, lmes_lot, lmes_lotno, lmes_orlot, lmes_yearid, lmes_logid, plantcode) values('$mainid', '$sstage', '$ltn', '$lotnonew', '$lotnoornew', '$yearid_id', '$logid', '$plantcode')";
						mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
						
						$sql_sub_upd="Insert into tbl_lotmgen (lotmgen_lot, lotmgen_lotno, lotmgen_orlot, lotmgen_yearcode, lotmgen_yearid, lotmgen_logid, lotmgen_wyearcode, plantcode) values ('$ltn', '$lotnonew', '$lotnoornew', '$yer', '$yer2', '$logid', '$yearid_id', '$plantcode')";
						$z12345=mysqli_query($link,$sql_sub_upd) or die(mysqli_error($link));
					}
				}
				if($txtstage=='Condition')
				{
					$sstage='Condition';
					for($i=1; $i<=5; $i++)
					{
						$ltn=$ltn+1;
						$lotnonew=$tp1.$yer.$ltn."/00000/00".$cd2;
						$lotnoornew=$tp1.$yer.$ltn."/00000/00";
			
						$sql_sub_sub="insert into tbl_lotmgen_expsub(lme_id, lmes_stage, lmes_lot, lmes_lotno, lmes_orlot, lmes_yearid, lmes_logid, plantcode) values('$mainid', '$sstage', '$ltn', '$lotnonew', '$lotnoornew', '$yearid_id', '$logid', '$plantcode')";
						mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
						
						$sql_sub_upd="Insert into tbl_lotmgen (lotmgen_lot, lotmgen_lotno, lotmgen_orlot, lotmgen_yearcode, lotmgen_yearid, lotmgen_logid, lotmgen_wyearcode, plantcode) values ('$ltn', '$lotnonew', '$lotnoornew', '$yer', '$yer2', '$logid', '$yearid_id', '$plantcode')";
						$z12345=mysqli_query($link,$sql_sub_upd) or die(mysqli_error($link));
					}
				}		
				echo "<script>window.location='home_blre.php'</script>";
			}
			else
			{	
				$sqlmain="DELETE from tbl_lotmgen_exp where lme_id='$mainid' ";
				$a123=mysqli_query($link,$sqlmain) or die(mysqli_error($link));
			}
		}
	}	
	
	
	$sql_code="SELECT MAX(lme_code) FROM tbl_lotmgen_exp WHERE plantcode='".$plantcode."' ORDER BY lme_code DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
				$code1="TLM".$code."/".$yearid_id."/".$lgnid;
			}
			else
			{
				$code=1;
				$code1="TLM".$code."/".$yearid_id."/".$lgnid;
			}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant -Transaction - Blending Lot Reservation - Export</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
</head>
<script src="lotmerger2.js"></script>
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

function mySubmit()
{ 
	if(document.frmaddDept.txtstage.value=="")
	{
		alert("Please Select Stage.");
		document.frmaddDept.txtstage.focus();
		return false;
	}
	if(document.frmaddDept.srn.value==0)
	{
		alert("Please Generate Lot Number(s).");
		//document.frmaddDept.txtlotnumber.focus();
		return false;
	}
	return true;	 
}

function onloadfocus()
{
//document.frmaddDept.txt12.focus();
}
function modetchk6(classval24)
{
	if(document.frmaddDept.txtstage.value=="")
	{
		alert("Please select Stage first");
		document.frmaddDept.txtstage.focus();
	}
	document.getElementById('maindiv').innerHTML="";
	document.frmaddDept.txtlot1.value="";
	document.frmaddDept.txtlotnumber.value="";
	showUser(classval24,'lotnshow','lotshow','','','','','');
}
function getdetails()
{
		var stage=document.frmaddDept.txtstage.value;
		showUser(stage,'maindiv','get',stage,stage,stage,'','','');
}

</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_plantm.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  align="center"  class="midbgline">
		  
		  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Blending Lot Reservation - Export - ADD</td>
	    </tr></table></td>
	    
	  </tr>
	  </table></td></tr>
	  
	    <td align="center" colspan="4" >
		<form id="mainform"  name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="hidden" name="code" value="<?php echo $code?>" />
	 <input type="hidden" name="logid" value="<?php echo $logid?>" />
</br>
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">

<td>
<table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" class="tblheading">Blending Lot Reservation - Export</td>
</tr>
  <tr height="15">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
   <?php
//$quer3=mysqli_query($link,"SELECT DISTINCT perticulars,whid FROM tbl_warehouse order by perticulars Asc"); 
?>
<tr class="Dark" height="25">
           <td width="159" height="24"  align="right"  valign="middle" class="tblheading">Transaction ID &nbsp;</td>
           <td width="214"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>
		   
		   <td width="142" height="24"  align="right"  valign="middle" class="tblheading">Date&nbsp;</td>
           <td width="225" align="left"  valign="middle">&nbsp;<input name="txtdate" type="text" size="12" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC"  value="<?php echo date("d-m-Y");?>" /></td>
</tr>
</table><br />
<?php
$sql_arr_home=mysqli_query($link,"select * from tbl_lotmgen_exp where lme_flg=1 AND plantcode='".$plantcode."' order by lme_date desc, lme_code desc") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
?>

<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">Previously Generated Export Lot(s) - Available for Blending</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="550" bordercolor="#2e81c1" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td align="center" valign="middle" class="smalltblheading">Stage</td>
			 <td align="center" valign="middle" class="smalltblheading">No. of Lots</td>
			 <td align="center" valign="middle" class="smalltblheading">Lot numbers</td>
              </tr>
<?php
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
$trid=$row_arr_home['lme_id'];
$extnob=""; $extqty="";
$sql_raw_sub=mysqli_query($link,"select * from tbl_lotmgen_expsub where lme_id=$trid and lmes_stage='Raw' and lmes_blendflg=0 AND plantcode'".$plantcode."'") or die(mysqli_error($link));
$totraw=mysqli_num_rows($sql_raw_sub);
while($row_raw_sub=mysqli_fetch_array($sql_raw_sub))
{
	if($extnob!="")
		$extnob=$extnob."<br/>".$row_raw_sub['lmes_lotno']; 
	else
		$extnob=$row_raw_sub['lmes_lotno']; 
}	

$sql_condition_sub=mysqli_query($link,"select * from tbl_lotmgen_expsub where lme_id=$trid and lmes_stage='Condition' and lmes_blendflg=0 AND plantcode='".$plantcode."'") or die(mysqli_error($link));
$totcondition=mysqli_num_rows($sql_condition_sub);
while($row_condition_sub=mysqli_fetch_array($sql_condition_sub))
{
	if($extqty!="")
		$extqty=$extqty."<br/>".$row_condition_sub['lmes_lotno']; 
	else
		$extqty=$row_condition_sub['lmes_lotno']; 
}	
?>			  
<tr class="Light">
         <td width="20%" align="center" valign="middle" class="smalltbltext">Raw</td>
         <td width="40%" align="center" valign="middle" class="smalltbltext"><?php echo $totraw;?></td>
		 <td width="40%" align="center" valign="middle" class="smalltbltext"><?php echo $extnob;?></td>
</tr>

<tr class="Dark">
         <td width="20%" align="center" valign="middle" class="smalltbltext">Condition</td>
         <td width="40%" align="center" valign="middle" class="smalltbltext"><?php echo $totcondition;?></td>
		 <td width="40%" align="center" valign="middle" class="smalltbltext"><?php echo $extqty;?></td>
</tr>
<?php
}
}
else
{
?>
<tr class="Light">
         <td align="center" valign="middle" class="smalltblheading" colspan="3">Records not found</td>
</tr>
<?php 
}
?>
</table><br />

<table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" >
<tr class="Light" height="20">
  <td colspan="2" align="center" class="tblheading">Generated new Lot(s)</td>
</tr>
 <tr class="Dark" height="30" >
	<td align="right" valign="middle" class="tblheading">Select Stage&nbsp;</td>
<td align="left" valign="middle" class="tbltext"  >&nbsp;<select class="tbltext" name="txtstage" id="sstage" style="width:100px;" onchange="getdetails(this.value);">
<option value="" selected>-Select Stage-</option>
<option value="Raw" >Raw</option>
<option value="Condition" >Condition</option>
<option value="Both" >Both</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>		
</table>
<br />

<div id="maindiv" style="display:block"><input name="srn" type="hidden" value="0" /></div>	
<table align="center" width="550" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_blre.php"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;<input name="Submit" type="image" src="../images/submit.gif" alt="Submit Value" onclick="return mySubmit();"   border="0" style="display:inline;cursor:pointer;"  />&nbsp;&nbsp;</td>
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
