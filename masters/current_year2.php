<?
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
<title>Administration- Master-Current Financial Year</title>
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
   
function Openyrclose(yrsid)
{	
	var flg=document.frmcreatedb.flg.value;
	var y2=document.frmcreatedb.y2.value;
	var flgci=document.frmcreatedb.flgci.value;
	
	if(flg!=0)
	{ alert('Can not close Year before 1st April '+y2+' of Next F.Y.');
	return false;
	}
	else if(flgci!=0)
	{ alert('Can not close Year, Cycle Inventory Transaction is under process.');
	return false;
	}
	else
	{
	if(confirm("Do you really want to close this year?"))
	{
		//var locid=document.frmcreatedb.locid.value;
		winHandle=window.open('closeyear2.php?yrsid='+yrsid,'WelCome','top=170,left=180,width=420,height=350,scrollbars=yes');
		if(winHandle==null){
		alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
	else
	{
	return false;
	}
	}
}

function mySubmit()
{

return true;
}
</SCRIPT>

<body>
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
          <td width="100%" valign="top" height="auto"  align="center"  class="midbgline">

		  
<!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#b9d647" style="border-bottom:solid; border-bottom-color:#4ea1e1" >
	    <tr >
	      <td width="810" height="25">&nbsp;Financial Year Management Master </td>
	    </tr></table></td>
	  </tr> 
	  </table></td></tr>
	  
  
	  
	  <td align="center" colspan="4" >
	  
	    <form name="frmcreatedb" method="post" action="<? $_SERVER['PHP_SELF']; ?>" > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<?
	/*$sql_sel="select * from tbllock";
	$res=mysqli_query($link,$sql_sel) or die (mysqli_error($link));
	$row=mysqli_fetch_array($res);
	$total=mysqli_num_rows($res);
	*/
?>
<tr>
<td width="30">	 </td><td>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="550" bordercolor="#b9d647" style="border-collapse:collapse">
 <tr class="light" height="25">
<td align="center" class="tblheading" valign="middle" colspan="2">Year Management</td>
</tr>
<tr class="Light">
<td align="left" valign="top">
<?
	/*$conn = mysql_connect("localhost","root","");
	$db = mysql_select_db("years");*/
	
	$sql_yr=mysqli_query($link,"select * from tblfnyears where years_flg =1 and years_status='a'")or die("Error:".mysqli_error($link));
	$tot_yr=mysqli_num_rows($sql_yr);
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="500" bordercolor="#4ea1e1" style="border-collapse:collapse">
 <tr class="tblsubtitle" height="25">
<td align="center" class="tblheading" valign="middle" colspan="5">Active Current Financial Year</td>
</tr>
<tr class="Dark" height="25">
<td width="20%" align="center" valign="middle" class="tblheading">Date From</td>
<td width="20%" align="center" valign="middle" class="tblheading">To </td>
<td width="20%" align="center" valign="middle" class="tblheading">Year</td>
<td width="20%" align="center" valign="middle" class="tblheading">Year Code </td>
<td width="20%" align="center" valign="middle" class="tblheading">&nbsp;Activity</td>
</tr>
<?

$srno=1;$a=1;$flash=0; $y=0; $y2=0;
if($tot_yr > 0)
{
while($row_yr=mysqli_fetch_array($sql_yr))
{


$d=date("d-m-Y");
		$tdate=$d;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
		if($row_yr['year1'] == $tyear)
		{ 
		$y2=$row_yr['year2']; $y=1;
		}
		else if($row_yr['year2'] == $tyear)
		{ 
		$y2=$row_yr['year2']; $y=2;
		}
		else
		{ 
		$y=0; $flash=0; 
		}
		
		if($y!=0)
		{
			$ldate=$y2."-04-01"; 
			$s=strtotime($tdate); 
			$e=strtotime($ldate);
			if($s < $e)
			{ $flash=1;}
			else
			{ $flash=0; }
		}
		else
		{
		$flash=1; $y2=$row_yr['year2'];
		}
		
		/*$sql_ci=mysqli_query($link,"select * from tbl_ci where ci_upflg=0") or die(mysqli_error($link));
		$row_ci=mysqli_fetch_array($sql_ci);
		$t_ci=mysqli_num_rows($sql_ci);
		if($t_ci > 0)
			{ $flg2=1;}
			else
			{ $flg2=0;}*/
?>
<tr class="Light" height="25">
<td align="center" class="tblheading" valign="middle">1st April</td>
<td align="center" class="tblheading" valign="middle">31st March</td>
<td align="center" class="tblheading" valign="middle"><?=$row_yr['year1']."-".$row_yr['year2'];?></td>
<td align="center" class="tblheading" valign="middle"><?=$row_yr['ycode'];?></td>
<td align="center" class="tblheading" valign="middle"><? if($tot_yr == 1) { if($row_yr['years_flg']==1) { ?><a href="Javascript:void(0);" onclick="Openyrclose('<?=$row_yr['yearsid']?>');">Close</a><? } }?></td>
</tr><input type="hidden" name="cdate" value="<?=$d;?>" /><input type="hidden" name="ldate" value="<?=$ldate;?>" />
<? $srno++; $a=$row_yr['yearsid']; 
}$a++; 
}

?> <input type="hidden" name="totyr" value="<?=$tot_yr;?>" /><input type="hidden" name="flg" value="<?=$flash;?>" /><input type="hidden" name="y2" value="<?=$y2;?>" /><input type="hidden" name="flgci" value="<?=$flg2;?>">
</table></td>

</tr>
<tr><td>&nbsp;</td></tr>
<tr class="Light">
<td align="left" valign="top">
<?
	/*$conn = mysql_connect("localhost","root","");
	$db = mysql_select_db("years");*/
	
	$sql_yrc=mysqli_query($link,"select * from tblfnyears where years_flg =0 and years_status='c'")or die("Error:".mysqli_error($link));
	$tot_yrc=mysqli_num_rows($sql_yrc);
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="500" bordercolor="#4ea1e1" style="border-collapse:collapse">
 <tr class="tblsubtitle" height="25">
<td align="center" class="tblheading" valign="middle" colspan="5">Closed Previous Financial Years</td>
</tr>
<tr class="Dark" height="25">
<td width="20%" align="center" valign="middle" class="tblheading">Date From</td>
<td width="20%" align="center" valign="middle" class="tblheading">To </td>
<td width="20%" align="center" valign="middle" class="tblheading">Year</td>
<td width="20%" align="center" valign="middle" class="tblheading">Year Code </td>
<td width="20%" align="center" valign="middle" class="tblheading">&nbsp;Status</td>
</tr>
<?

$srnoc=1;
if($tot_yr > 0)
{
while($row_yrc=mysqli_fetch_array($sql_yrc))
{
?>
<tr class="Light" height="25">
<td align="center" class="tblheading" valign="middle">1st April</td>
<td align="center" class="tblheading" valign="middle">31st March</td>
<td align="center" class="tblheading" valign="middle"><?=$row_yrc['year1']."-".$row_yrc['year2'];?></td>
<td align="center" class="tblheading" valign="middle"><?=$row_yrc['ycode'];?></td>
<td align="center" class="tblheading" valign="middle">Closed</td>
</tr>
<? $srnoc++;
}
}
?>
</table></td>

</tr>
<tr><td>&nbsp;</td></tr>
<tr class="Light">
<td align="left" valign="top">

<table align="center" border="1" cellspacing="0" cellpadding="0" width="500" bordercolor="#4ea1e1" style="border-collapse:collapse">
 <tr class="tblsubtitle" height="25">
<td align="center" class="tblheading" valign="middle" colspan="2">Notes</td>
</tr>
<tr class="Light" height="25">
<td width="15" align="center" valign="middle" class="tblheading">1</td>
<td width="479" align="left" valign="middle" class="tblheading">&nbsp;Active Current Financial year is not allowed to be closed before 1st April of next<br />&nbsp;Financial Year. It can be closed only on 1st April of next year or any date after it.
</td>
</tr>
<tr class="Light" height="25">
<td width="15" align="center" valign="middle" class="tblheading">2</td>
<td width="479" align="left" valign="middle" class="tblheading">&nbsp;When Active Current Financail Year is closed, it is transferred to the list of Closed<br />&nbsp;Previous Financial Years & next New Active Current Financial Year is opened <br />
&nbsp;automatically.</td>
</tr>
<tr class="Light" height="25">
<td width="15" align="center" valign="middle" class="tblheading">3</td>
<td width="479" align="left" valign="middle" class="tblheading">&nbsp;Once Active Current Financial Year is Closed, No Transaction can be entered in that<br />&nbsp;Financial Year.</td>
</tr>
<tr class="Light" height="25">
<td width="15" align="center" valign="middle" class="tblheading">4</td>
<td width="479" align="left" valign="middle" class="tblheading">&nbsp;When Cycle Inventory Transaction Updation is pending then Active Current Financial<br />&nbsp;Year will not allowed to be closed.</td>
</tr>
</table></td>


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
