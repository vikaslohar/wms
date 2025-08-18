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
  if(isset($_GET['id']))
		{
			$id=$_GET['id'];
		}
		
	$sql_f="select * from tblproductionpersonnel where productionpersonnelid='$id'";
	$result_f=mysqli_query($link,$sql_f)or die(mysqli_error($link));
	$row_f=mysqli_fetch_array($result_f);
    $per=explode(";",$row_f['productionlocationid']);
	
	if(isset($_GET['lo']))
	{
	$lo = $_GET['lo'];
	}
	else
	{
		$lo = $row_f['productionlocationid'];
	}
	
	
	
	if(isset($_POST['frm_action'])=='submit')
	{
		 $list_person_id=$_REQUEST['hidtxt'];
		 $oldlocid=trim($_POST['oldlocationid']);
		//echo $list_person_id;
		
		//$person_list=$_POST['list_production_presonal'];
		// $list_person_id=implode(";",$person_list);
		 //echo $list_person_id;
		// exit;
		
		 $oldarray=explode(";",$oldlocid);
		 $newarray=explode(";",$list_person_id);
		 $identical=array_intersect($oldarray, $newarray);
		 $dif=array_diff($oldarray, $identical);
		 $str_p1=implode(",",$dif);
		 $cont=0;
		if($str_p1 !="")
		{
		    $p_array=explode(",",$str_p1);
			$k=0;
			$p=array();
			
			foreach($p_array as $val)
				{
				if($val <> "")
				{
				$sql_f="select productionlocationid from tblfarmer where productionlocationid=$val"; 
				$res_f=mysqli_query($link,$sql_f)or die (mysqli_error($link));
				$row_f=mysqli_fetch_array($res_f);
				$tot_f=mysqli_num_rows($res_f);
				if($tot_f > 0){$cont++;}
				}
				}
		}
		else
		{
		$cont=0;
		}
		
		 
		
		 $name=trim($_POST['txtprodpersonnel']);
		 $code=trim($_POST['txtcode']);
	     $status=trim($_POST['status']);	
		 $sql_in="update tblproductionpersonnel set
											  productionlocationid='$list_person_id',
											  productionpersonnel='$name',
											  productionpersonnelcode='$code',
											  status='$status'
											 where productionpersonnelid='$id'";
											
		$query=mysqli_query($link,"SELECT * FROM tblproductionpersonnel where productionpersonnel='$name' and productionpersonnelid!='$id'") or die("Error: " . mysqli_error($link));
   		$numofrecords=mysqli_num_rows($query);
	 	 if( $numofrecords > 0)
		 {
		 ?>
		 <script>
		  alert("This Production Personnel is Already Present.");
		  </script>
		 <?php 
		 }
		 else if($cont > 0)
		 {
		 ?>
		 <script>
		  alert("You cannot remove Location(s)\nReason: Farmer(s) are present under this Location.");
		  </script>
		 <?php 
		 }
		 else 
		 { 
		if(mysqli_query($link,$sql_in)or die(mysqli_error($link)))
		{
			echo "<script>window.location='home_personnel.php?print=add'</script>";	
		}
		}
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html;$charset=iso-8859-1" />
<title>Stores -  Master - Add Viewers</title>
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
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">    
function MoveOption(objSourceElement, objTargetElement)   
{      
		var aryTempSourceOptions = new Array();        
		var x = 0;                
		//looping through source element to find selected options
		for (var i = 0; i < objSourceElement.length; i++) 
			{            
				if (objSourceElement.options[i].selected) 
				{                
					//need to move this option to target element                
					var intTargetLen = objTargetElement.length++;                
					objTargetElement.options[intTargetLen].text = objSourceElement.options[i].text;                
					objTargetElement.options[intTargetLen].value = objSourceElement.options[i].value;            
				}            
				else 
				{                
					//storing options that stay to recreate select element                
					var objTempValues = new Object();                
					objTempValues.text = objSourceElement.options[i].text;                
					objTempValues.value = objSourceElement.options[i].value;                
					aryTempSourceOptions[x] = objTempValues;                
					x++;            
				}        
			}
			//resetting length of source        
				objSourceElement.length = aryTempSourceOptions.length;        
				//looping through temp array to recreate source select element        
					for (var i = 0; i < aryTempSourceOptions.length; i++) 
					{            
						objSourceElement.options[i].text = aryTempSourceOptions[i].text;            
						objSourceElement.options[i].value = aryTempSourceOptions[i].value;            
						objSourceElement.options[i].selected = false;        
					}     
		
}

function ajy()
{
	var str="";
	for (var i = 0; i <document.SearchInternal.lstselectpart.length; i++) {    //need to move this option to target element  	
	str=str+document.SearchInternal.lstselectpart.options[i].text+";";
	}					
	this.location="DefineSenior.php?lastpart="+str+"&ss="+document.SearchInternal.ss.value+"&str="+document.SearchInternal.names.value+"&"; 
	
}
function closefun()
{
	var tt="";
	var pp="";
	var xx="";
	for(i=0;i<document.frmaddDept.lstselectpart.length;i++)
	{
		xx=document.frmaddDept.lstselectpart.options[i].value;
		tt=tt+document.frmaddDept.lstselectpart.options[i].value+";";
		pp=pp+xx.substring(0,xx.indexOf('('))+".\n";
		
	}
	//alert(pp);
   if( pp=="" )
	{ 
		
		document.frmaddDept.hidtxt.value = tt;
			
  	}
	else {
		
	document.frmaddDept.hidtxt.value = tt;
	
	}
	
}      
function loc()
{
window.location='edit_productionpersonnelmaster.php?lo='+document.frmaddDept.produc_location.value;
}
function mySubmit()
{	
	if (frmaddDept.txtprodpersonnel.value=="") 
	 {
		alert ("Production Personnel name can not be Blank");
		frmaddDept.txtprodpersonnel.focus();
		return false;
	  }
	else if(frmaddDept.txtprodpersonnel.value.charCodeAt() == 32)
	  {
		alert("Production Personnel name can not Start With Space!");
		return(false);
		frmaddDept.txtprodpersonnel.focus();
	   }
	   if(confirm('You are adding Production Personnel:\nProduction Personnel Name:  '+document.frmaddDept.txtprodpersonnel.value+'\nProduction Personnel Code: ' +document.frmaddDept.txtcode.value)) 
	   {
	   return true;
	   }
	   else
	   {
	   return false;
	   }
	return true;
}            
</SCRIPT>
<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"  onLoad="return onloadfocus()" >
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/logotrac.gif" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
            <ul  id="nav"> <li><a href="index1.php"> Masters </a>
              <ul>
                  <li><a href="home_crop.php" >&nbsp;Crop&nbsp;Master</a></li>
                <li><a href="home_variety.php" >&nbsp;Variety&nbsp;Master</a></li> <li><a href="home_location.php" >&nbsp;Production&nbsp;Location</a></li>
                <li><a href="home_personnel.php" >&nbsp;Production&nbsp;Personnel&nbsp;Master</a></li>
                <li><a href="home_organiser.php" >&nbsp;Organiser&nbsp;Master</a></li>
                <li><a href="home_farmer.php" >&nbsp;Farmer&nbsp;Master</a></li>
				<li><a href="companyhome.php" >&nbsp;Parameter&nbsp;Master</a></li>
				<li><a href="operator_home.php" >&nbsp;Operator&nbsp;Master</a></li>
                 <li><a href="current_year.php" >&nbsp;Year&nbsp;Management&nbsp;Master</a></li>
              </ul>
            </li>
            <li><a href="index1.php">Transactions </a>
             <ul>
                <li><a href="../Transaction/add_g.php" >&nbsp;Good&nbsp;to&nbsp;Damage</a></li>
                <li><a href="../Transaction/add_d.php" >&nbsp;Damage&nbsp;to&nbsp;Good</a></li>
                <li><a href="../Transaction/add_shortage.php" >&nbsp;Excess/Shortage</a></li>
                <li><a href="../Transaction/home_ci1.php" >&nbsp;Cycle&nbsp;Inventory</a></li>
				<li><a href="../Transaction/home_interitem.php" >&nbsp;Inter&nbsp;Item&nbsp;Transfer</a></li>
				<li><a href="../Transaction/home_openstock.php" >&nbsp;Opening&nbsp;Stock</a></li>
              </ul>
            </li>
            <li><a href="index1.php"> Reports </a>
              <ul>
                <li><a href="../reports/stockonhandreport.php" >&nbsp;Stock&nbsp;on&nbsp;Hand&nbsp;Report</a></li>
                <li><a href="../reports/partywiseperiodreport.php" >&nbsp;Party&nbsp;wise&nbsp;Stock&nbsp;Report</a></li>
                <li><a href="../reports/storesitamledger.php" >&nbsp;Stores&nbsp;Item&nbsp;Ledger&nbsp;Report</a></li>
				<li><a href="../reports/stocktransferreport.php" >&nbsp;Stock&nbsp;Transfer&nbsp;Report</a></li>
				<li><a href="../reports/captiveconsumptionreport.php" >&nbsp;Captive&nbsp;Consumption&nbsp;Report</a></li>
                <li><a href="../reports/discardreport.php" >&nbsp;Discard&nbsp;Report</a></li>
                <li><a href="../reports/reorderlevelreport.php" >&nbsp;Reorder&nbsp;Level&nbsp;Report</a></li>
				 <li><a href="../reports/slocreport.php" >&nbsp;SLOC&nbsp;Status&nbsp;Report</a></li>
				<li><a href="../reports/masterreports.php" >&nbsp;Masters&nbsp;Report</a></li>
              </ul>
            </li>
            <li>
            <a href="index1.php">Utility </a>
			<ul><li><a href=" Javascript:void(0)" onClick="window.open('../utility/utility_wh.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=NO')" >&nbsp;SLOC&nbsp;Search</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('../utility/utility.php','WelCome','top=10,left=40,width=850,height=300,scrollbars=Yes')" >&nbsp;Stores&nbsp;Item&nbsp;Search</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('../utility/abbravation.php','WelCome','top=10,left=50,width=650,height=900,scrollbars=yes')" >&nbsp;Abbreviations</a></li>
              </ul>
            </li>
			</ul>
            </div>
            </div> <div class="toplinks" style="vertical-align:text-top">
              <ul style="vertical-align:text-top">
                <li> <a href="../Transaction/adminprofile.php">Profile </a> | </li>
                <li>&nbsp; <a href="../Transaction/help.php">Help </a>| </li>
                <li> &nbsp;<a href="../logout.php">Logout </a> </li>
              </ul>
            </div>
            </div></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/blue_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top"  height="500" align="center"  class="midbgline">

		  
<!-- actual page start--->	
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;<a href="cdinward_home.php" style="text-decoration:underline; cursor:hand; color:#404d21;"></a > Production Personnel - Edit </td>
	    </tr></table></td>
	    	  </tr>
	  </table></td></tr>
   	  <td align="center" colspan="4" >
	  <?php
	  $sql="SELECT * FROM tblproductionpersonnel where productionpersonnelid = '$id'";
	$res=mysqli_query($link,$sql)or die(mysqli_error($link));  
	 $row1 = mysql_fetch_assoc($res);
	 echo $row1['productionlocationid'];
	  ?>
	  	  <form name="frmaddDept" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return mySubmit();" > 
<input name="frm_action" value="submit" type="hidden">
<input name="id" value="<?php echo $id?>" type="hidden">
<input name="oldlocationid" value="<?php echo $row1['productionlocationid'];?>" type="hidden">

		 <br/>
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse" height="400">
<tr>
<td valign="top">
<?php //if($row_rt < 3) { ?>
<table width="700" border="1" cellspacing="0" cellpadding="0" align="center"  bordercolor="#4ea1e1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="25">
<td colspan="2" align="center" class="tblheading" valign="middle"><span class="subheading" style="color:#303918; ">Edit Production Personnel </span></td>
</tr>

<tr height="15" class="Light">
    <td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>All fields are Mandatory&nbsp;</td>
  </tr>

 <tr class="Dark" height="30">
<td>

<table width="760" border="1" cellspacing="0" cellpadding="0" align="center"  bordercolor="#4ea1e1" style="border-collapse:collapse">
   <tr class="Light" height="25">
<td width="192" align="left"  valign="middle" class="tblheading" >&nbsp;Production Personnel&nbsp;</td>
<td width="401" align="left"  valign="middle" >&nbsp; <input name="txtprodpersonnel" type="text" size="40" maxlength="40" class="tbltext" tabindex="0"  value="<?php echo $row1['productionpersonnel']?>" /></td>
<td width="159" align="left"  valign="middle" class="tblheading">&nbsp;Code&nbsp;<input name="txtcode" type="text" size="4" class="tbltext" tabindex="0" value="<?php echo $row1['productionpersonnelcode']?>"  readonly="true" style="background-color:#CCCCCC"  /></td>
</tr>
</table>
</td></tr>

<tr><td>
<table width="760"  border="0" align="center" class="Dark">
<tr><td height="20" colspan="3" align="center" class="tblheading">&nbsp;Assign Production Personnel to Production Location(s)</td>
</tr>
<tr>
<td  align="center" valign="top" class="tbltext">&nbsp;<span class="tblheading">Select Production Location </span>&nbsp;

<?php
 if(isset($_GET['lo']))
 {
  $test=mysqli_query($link,"SELECT * FROM tblproductionlocation where productionlocationid =".$_GET['lo']." order by productionlocation");
  }
  else
  {
  $test=mysqli_query($link,"SELECT * FROM tblproductionlocation order by productionlocation");
  }     
?>
<select name="lstfrmdb" size="12" multiple class="tbltext"  style="width:160px">
<?php
  
    while($rowstr = mysqli_fetch_array($test))
	{
		echo in_array($rowstr['productionlocationid'],$per);
		
	    if(!in_array($rowstr['productionlocationid'],$per))
		{
 ?>
<option value="<?php echo $rowstr['productionlocationid']?>" ><?php echo $rowstr['productionlocation'];?></option>
<?php
  }	
	} ?>
</select>    
</td>
<td  valign="top">
<div align="center">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><input name="add" src="../images/add3.gif" type="button" onClick="MoveOption(this.form.lstfrmdb,this.form.list_production_presonal)" value="&nbsp;&nbsp;&nbsp; Add -&gt;" class="TEXTBORDER"><br><br> <input name="remove" src="../images/remove.gif" type="button" value="&lt;- Remove &nbsp;&nbsp;&nbsp;" class="TEXTBORDER" onClick="MoveOption(this.form.list_production_presonal,this.form.lstfrmdb)">
</p><input type="hidden" name="hidtxt" />


</div></td>
<td  align="center" valign="top" class="tbltext">&nbsp;
<span class="tblheading">Selected Production Location </span>&nbsp;
<?php $sql_p1=mysqli_query($link,"select productionlocationid from tblproductionpersonnel where productionpersonnelid = '$id'");
	$total_pl=mysqli_num_rows($sql_p1);
$row=mysql_fetch_assoc($sql_p1);
 	$person=$row['productionlocationid'];
?>
<select name="lstselectpart" size="12" multiple class="tbltext" id="list_production_presonal" style="width: 160px">
<?php
	
if($total_pl >0)
{
	$row=mysqli_fetch_row($total_pl);
 	//$person=$row['0'];
 if( ! empty($person)) {
 $personid=explode(";",$person);
 $zz=count($personid);
for($i=0 ; $i < $zz ; $i++)
{
$personquerylist=mysqli_query($link,"SELECT productionlocation,productionlocationid FROM tblproductionlocation where productionlocationid='$personid[$i]'");
?>
<?php	while($noticia = mysqli_fetch_array($personquerylist)) { ?>
<option value="<?php echo $noticia['productionlocationid'];?>" selected="true"><?php echo $noticia['productionlocation'];?></option>
<?php }?><?php } }}?>

<?php /*
	$sql_p1=mysqli_query($link,"select * from tblproductionpersonnel");
	echo $total_pl=mysqli_num_rows($sql_p1);
if($total_pl >0)
{
	$row=mysqli_fetch_row($total_pl);
 	$person=$row['0'];
 if( ! empty($person)) {
 $personid=explode(";",$person);
 $zz=count($personid);
for($i=0 ; $i < $zz ; $i++)
{
$personquerylist=mysqli_query($link,"SELECT productionpersonnel,productionpersonnelid FROM tblproductionpersonnel where productionpersonnelid='$personid[$i]'");
?>
<?php	while($noticia = mysqli_fetch_array($personquerylist)) { ?>
<option value="<?php echo $noticia['productionpersonnelid'];?>" selected="true"><?php echo $noticia['productionpersonnel'];?></option>
<?php }?><?php } }} */  ?>
</select></td>
</tr>
</table>
</td></tr>
<tr><td>
<table width="760" border="1" cellspacing="0" cellpadding="0" align="center"  bordercolor="#4ea1e1" style="border-collapse:collapse">

<tr class="Light" height="25">
<td align="left"  valign="middle" class="tblheading">&nbsp;Status&nbsp;</td>
<td align="left"  valign="middle" colspan="2" class="tblheading">&nbsp;<input type="radio" name="status" value="Active" checked="checked" />Active&nbsp;<input name="status" type="radio" value="Inactive" />In-active</td>
</tr></table>
</td>
</tr>

</table>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_personnel.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;&nbsp;<a href="javascript:document.frmaddDepartment.reset()"><img src="../images/reset.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" OnClick="return mySubmit()" border="0" style="display:inline;cursor:hand;"></td>
</tr>
</table>
<?php// } else { ?>
<!--/*<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" v >
<tr >
<td valign="top" align="center" class="tblheading">Maximum of 3 Operator Roles can be created. You have reached to maximum limit.
</td>
</tr>
<tr >
<td valign="top" align="center"><a href="operator_home.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:hand;"/></a>&nbsp;</td>
</tr>
</table>
*/--><?php //} ?>
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
