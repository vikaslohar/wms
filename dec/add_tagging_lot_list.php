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
	//$yearid_id="09-10";
	require_once("../include/config.php");
	require_once("../include/connection.php");

	//$logid="OP1";
	//$lgnid="OP1";
	if(isset($_REQUEST['sdate']))
	{
	 $sdate = $_REQUEST['sdate'];
	}
	if(isset($_REQUEST['edate']))
	{
	 $edate = $_REQUEST['edate'];
	}
	
	if(isset($_POST['frm_action'])=='submit')
	{
		
		
		$sql_cls=mysqli_query($link,"SELECT * FROM tblspctmp where altflagt=5  order by spcodesidt Asc") or die(mysqli_error($link));
		while($row_cls=mysqli_fetch_array($sql_cls))
		{
			$fl=1;
			$sql_class=mysqli_query($link,"select * from tblcrop where cropname='".$row_cls['cropt']."'") or die(mysqli_error($link));
			$row_class=mysqli_fetch_array($sql_class);
			$cropid=$row_class['cropid'];
			$spcf=$row_cls['spcodeft'];
			$spcm=$row_cls['spcodemt'];
			$dt=$row_cls['altdatet'];
			
			$quer0=mysqli_query($link,"SELECT * FROM tblvariety where popularname='".$row_cls['varietyt']."' and cropname='".$row_class['cropid']."' and actstatus='Active' and vertype='PV'"); 
			$row0=mysqli_fetch_array($quer0);
			$varietyid=$row0['varietyid'];
			
			$str="insert into tblspcodes (spcodef, spcodem, altdate, crop, variety, altflag) values('". $spcf."', '".$spcm."', '$dt', '".$cropid."', '".$varietyid."', 2)";
			$result=mysqli_query($link,$str) or die("Error:".mysqli_error($link));
		}
		
		$sql_code="SELECT MAX(scode) FROM tblspdec  ORDER BY scode DESC";
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
			
			$sql_code2="SELECT MAX(spcdeccode) FROM tblspdec  ORDER BY spcdeccode DESC";
			$res_code2=mysqli_query($link,$sql_code2)or die(mysqli_error($link));
		
			if(mysqli_num_rows($res_code2) > 0)
			{
				$row_code2=mysqli_fetch_row($res_code2);
				$t_code2=$row_code2['0'];
				$code2=$t_code2+1;
			}
			else
			{
				$code2=1;
			}
			$str1="insert into tblspdec (spdecdate, spdectype, spdectflg, scode, spcdeccode, plantcode) values('$dt', 'DE','1', '".$code."', '".$code2."', '$plantcode')";
			if(mysqli_query($link,$str1) or die("Error:".mysqli_error($link)))
			{
				$id=mysqli_insert_id($link); 
				$str2="update tblspcodes set spdecid=$id, altflag=0 where altflag=2";
				$result2=mysqli_query($link,$str2) or die("Error:".mysqli_error($link));
			}
			
			/*echo "<script>window.location='home_tagging.php'</script>";	*/
			header('Location: home_tagging.php');
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Decode -Transaction - Add Filel Import</title>
<link href="../include/main_dec.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_dec.css" rel="stylesheet" type="text/css" />
</head>
<script src="staddresschk.js"></script>
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
function openselect(lid)
{
winHandle=window.open('dest_select.php?lid='+lid,'WelCome','top=170,left=180,width=420,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}

function openedit(lid,dstid)
{
winHandle=window.open('dest_edit.php?lid='+lid+'&dstid='+dstid,'WelCome','top=170,left=180,width=420,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}

function updaterec(dstid,arid,arsubid,lgdt,trtyp,lid)
{
winHandle=window.open('dest_update.php?dstid='+dstid+'&arid='+arid+'&arsubid='+arsubid+'&lgdt='+lgdt+'&trtyp='+trtyp+'&lid='+lid,'WelCome','top=170,left=180,width=420,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - File Import List</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   > 
<input name="frm_action" value="submit" type="hidden"> 
<input name="txt11" value="" type="hidden"> 
<input name="txt14" value="" type="hidden"> 
<input type="hidden" name="txtid" value="<?php echo $code?>" />
<input type="hidden" name="logid" value="<?php echo $logid?>" />
		</br>
<?php
/*$tid=0; $subtid=0;

	$tdate=$sdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;
	
	
	$tdate=$edate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$edate=$tyear."-".$tmonth."-".$tday;*/
		
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="800" cellspacing="0" cellpadding="0" bordercolor="#7a9931"
 style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">File Import List</td>
</tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#7a9931"
 style="border-collapse:collapse">
  <tr class="tblsubtitle" height="25">
     <td width="30"align="center" valign="middle" class="tblheading">#</td>
			  <td width="65" align="center" valign="middle" class="tblheading">Date</td>
			  <td width="96" align="center" valign="middle" class="tblheading">SP Code-Female</td>
              <td width="96" align="center" valign="middle" class="tblheading">SP Code-Male</td>
			  <td width="135" align="left" valign="middle" class="tblheading">&nbsp;Crop</td>
              <td width="262" align="left" valign="middle" class="tblheading">&nbsp;Variety</td>
			  <td width="100" align="center" valign="middle" class="tblheading">Remarks</td>
	  </tr>
<?php
$srno=1; $orstatus="";
$sql_cls=mysqli_query($link,"SELECT * FROM tblspctmp  order by spcodesidt Asc") or die(mysqli_error($link));
while($row_cls=mysqli_fetch_array($sql_cls))
{
	$fl=1;
	$sql_class=mysqli_query($link,"select * from tblcrop where cropname='".$row_cls['cropt']."'") or die(mysqli_error($link));
	$row_class=mysqli_fetch_array($sql_class);
	$t_class=mysqli_num_rows($sql_class);
	
	$quer0=mysqli_query($link,"SELECT * FROM tblvariety where cropname='".$row_class['cropid']."' and actstatus='Active' and vertype='PV' order by cropname, popularname Asc"); 
	while($row0=mysqli_fetch_array($quer0))
	{
		if($row0['popularname'] == $row_cls['varietyt']){ $fl=0; break;}
		//break;
		//echo $row_cls['cropt']."  ".$row0['popularname']."  ".$row_cls['varietyt']."  ".$fl."<br>";
	}
	//echo $row_class['cropid']."  ".$row_cls['cropt']."  ".$row_cls['varietyt']."  ".$fl."<br>";
	$strdublicate=mysqli_query($link,"select * from tblspcodes where spcodef='". $row_cls['spcodeft']."' and spcodem='". $row_cls['spcodemt']."' ");
	$numofrecords=mysqli_num_rows($strdublicate);
			
$tp="";
$flg=0;
if($numofrecords > 0)
{
$tp="Duplicate SP Code";
$flg=1;
}
else if($t_class == 0)
{
$tp="Crop Unlisted";
$flg=1;
}
else if($fl > 0)
{
$tp="Variety Mismatch";
$flg=1;
}
else
{
$sq=mysqli_query($link,"update tblspctmp set altflagt=5 where spcodesidt='".$row_cls['spcodesidt']."'") or die(mysqli_error($link));
$tp="";
$flg=0;
}
 	$tdate=$row_cls['altdatet'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;



 if ($srno%2 != 0)
	{	
?>
  <tr class="Light" height="25"  style="background-color:<?php if($flg==0) { echo "#f6ffe0"; }else { echo"#FFFF00";}?>">
    <td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $tdate;?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_cls['spcodeft'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_cls['spcodemt'];?></td>
	<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row_cls['cropt'];?></td>
	<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row_cls['varietyt'];?></td>
	<td valign="middle" class="tblheading" align="center"><?php echo $tp;?></td>
    </tr>
  <?php
	}
	else
	{ 
	 
?>
  <tr class="Dark" height="25"  style="background-color:<?php if($flg==0) { echo "#f6ffe0"; }else { echo"#FFFF00";}?>">
    <td  valign="middle" class="tbltext" align="center"><?php echo $srno;?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $tdate;?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_cls['spcodeft'];?></td>
    <td valign="middle" class="tbltext" align="center"><?php echo $row_cls['spcodemt'];?></td>
	<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row_cls['cropt'];?></td>
	<td valign="middle" class="tbltext" align="left">&nbsp;<?php echo $row_cls['varietyt'];?></td>
	<td valign="middle" class="tblheading" align="center"><?php echo $tp;?></td>
    </tr>
<?php	
}
 $srno=$srno+1;
}
?>
</table>


<br />

<table align="center" width="800" cellpadding="0" cellspacing="1" border="0" >
<tr >
<td valign="top" align="left" class="tblheading">Note:</td>
</tr>
<tr >
<td valign="top" align="left" class="tbltext">1. If current records in File are uploaded then "Yellow field Records" (having mistakes) will not be imported. </td>
</tr>
<tr >
<td valign="top" align="left" class="tbltext">2. If you wish to import all the records in one incidence then "Cancel" the transaction, Rectify or mistake proof the excel sheet and try to upload file again. </td>
</tr>
<tr >
<td valign="top" align="left" class="tbltext">3. If the Remarks column does not carry any comment than the record is fit to be imported.</td>
</tr>
</table>
<table align="center" width="800" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_tagging.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:pointer;" onclick="return confirm('This will cancel the Importing of SP code Decoading.\nDo You want to Cancel?');" /></a>&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;"></td>
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

  