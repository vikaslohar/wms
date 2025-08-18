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
	
	$ids=trim($_REQUEST['ids']);
	$typ=trim($_REQUEST['typ']);
			
	if(isset($_POST['frm_action'])=='submit')
	{ 
		$ids=trim($_POST['ids']);
		$typ=trim($_POST['typ']);
		//exit;	
		if($typ=="dispose")
		{
			$zzz=explode(",",$ids);
			foreach($zzz as $val)
			{
				if($val<>"")
				{ 
					$sql_in1="update tbl_gsample set gsdisflg=1 where gsid='".$val."'";	
					$flid=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
				}
			}
			echo "<script>window.location='aging_op.php?ids=$ids&typ=$typ'</script>";
		}
		else if($typ=="extend")
		{
			$zzz=explode(",",$ids);
			foreach($zzz as $val)
			{
				if($val<>"")
				{ 
					$sql_arr_home=mysqli_query($link,"select * from tbl_gsample where gsid='".$val."'") or die(mysqli_error($link));
					$row_arr_home=mysqli_fetch_array($sql_arr_home);
					$gsd=$row_arr_home['gsdis']+6;
					
					$sql_in1="update tbl_gsample set gsdis='$gsd' where gsid='".$val."'";	
					$flid=mysqli_query($link,$sql_in1)or die(mysqli_error($link));
				}
			}
			echo "<script>window.location='aging_op.php?ids=$ids&typ=$typ'</script>";
		}
		
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction - Guard Sample Ageing</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="samp.js"></script>
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
function mySubmit()
{	
	var f=0; 
	if(document.frmaddDept.typ.value=="dispose")
	{
		if(confirm('You are "Disposing"\nGuard Sample\nDo you wish to continue?')==true)
		{
		f=0;
		return true;
		}
		else
		{
		f=1;
		return false;
		}
	}
	if(document.frmaddDept.typ.value=="extend")
	{
		if(confirm('You are "Extending"\nGuard Sample Retention period\nDo you wish to continue?')==true)
		{
		f=0;
		return true;
		}
		else
		{
		f=1;
		return false;
		}
	}
	if(f==0)
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
           <td valign="top"><?php require_once("../include/qty_quality.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="940" height="25" class="Mainheading">&nbsp;Transaction - Guard Sample Ageing  - <?php if($typ=="dispose") echo "Dispose"; else if($typ=="extend") echo "Extend"; else echo " ";?></td>
	    </tr></table></td>
	 <!--  <td width="80" height="25" align="right" class="submenufont" >
	 <table border="3" align="right" bordercolor="#d21704" bordercolordark="#d21704" cellspacing="0" cellpadding="0" width="116" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:Pointer;"><?php if($flg==0 && $flg1==0 && $flg2==0) { ?><a href="add_new_request _tr.php" style="text-decoration:none; color:#FFFFFF">Add </a><?php } else { ?><a href="Javascript:void(0);" onclick="alert('Can not perform Transaction.\nReason:\n1. Todays date is not in Active Current Financial Year.\n2. Transaction after todays date has been made.\n3. Cycle Inventory transaction is under process.');" style="text-decoration:none; color:#FFFFFF">Add </a><?php } ?></td>
</tr>
</table></td>-->
	  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	 <input type="hidden" name="ids" value="<?php echo $ids;?>" />
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<?php
 if($typ=="dispose") 
 { 
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="23"align="center" valign="middle" class="tblheading">#</td>
			   <td width="116" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="164" align="center" valign="middle" class="tblheading">Variety</td>
			    <td width="118" align="center" valign="middle" class="tblheading">Lot No.</td>
              <td align="center" valign="middle" class="tblheading">SLOC</td>
			   <td width="88" align="center" valign="middle" class="tblheading">DOA</td>
			   <td width="82" align="center" valign="middle" class="tblheading">GSRP</td>
				<td width="82" align="center" valign="middle" class="tblheading">GSRP Mat. Date</td>
              </tr>
<?php
$zzz=explode(",",$ids);
foreach($zzz as $val)
{
if($val<>"")
{
 $sql_arr_home=mysqli_query($link,"select * from tbl_gsample where gsid='".$val."' order by arrivaldate asc") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrivaldate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$arrival_id=$row_arr_home['gsid'];
	$qc1=$row_arr_home['sampleno'];

	
		$lotno=$row_arr_home['lotno'];
	
	 $vv=$row_arr_home['gsdis'];
	 $tt=$row_arr_home['gsvariety'];

$wh=""; $binn=""; $slocs="";
$wh1=$row_arr_home['gswh']."/";
$binn1=$row_arr_home['gsbin'];

$quer3=mysqli_query($link,"SELECT * FROM tblbin  where binid='".$binn1."'"); 
	$row31=mysqli_fetch_array($quer3);
	  $binn=$row31['binname'];
	
	$quer4=mysqli_query($link,"SELECT * from tblwarehouse where whid ='".$wh1."'"); 
	$row=mysqli_fetch_array($quer4);
	  $wh=$row['perticulars']."/";
$slocs=$wh.$binn."<br/>";

if($vv!=0)
{
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt=$vv;
		
		for($i=0; $i<=$dt; $i++) { $dt1=date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y)); }
$cdate=date("Y-m-d");		
$flg=0;
if($dt1<=$cdate)	$flg=1; else $flg=0;
	$trdate1=$dt1;
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
}
else
{
$vv="";
$trdate1="";
}		

if($flg==1 && $vv!="")
{
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="23" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
         <td width="116" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['gscrop'];?></td>
    	 <td align="center" valign="middle" class="tblheading"><?php echo $tt;?></td>
         <td width="118" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 <td width="83" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
		 <td width="88" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="82" align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="82" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
		 </tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="23" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
         <td width="116" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['gscrop'];?></td>
    	 <td align="center" valign="middle" class="tblheading"><?php echo $tt;?></td>
         <td width="118" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 <td width="83" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
		 <td width="88" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="82" align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="82" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
		 </tr>  
<?php
}
$srno=$srno+1;
}
}
}
}
}
?>
</table>
<?php
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="23"align="center" valign="middle" class="tblheading">#</td>
			   <td width="116" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="164" align="center" valign="middle" class="tblheading">Variety</td>
			    <td width="118" align="center" valign="middle" class="tblheading">Lot No.</td>
              <td align="center" valign="middle" class="tblheading">SLOC</td>
			   <td width="88" align="center" valign="middle" class="tblheading">DOA</td>
			   <td width="82" align="center" valign="middle" class="tblheading">GSRP Ext.</td>
				<td width="82" align="center" valign="middle" class="tblheading">GSRP Mat. Date</td>
              </tr>
<?php
$zzz=explode(",",$ids);
foreach($zzz as $val)
{
if($val<>"")
{
 $sql_arr_home=mysqli_query($link,"select * from tbl_gsample where gsid='".$val."' order by arrivaldate asc") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);
if($tot_arr_home >0) 
{
$srno=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['arrivaldate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
$arrival_id=$row_arr_home['gsid'];
	$qc1=$row_arr_home['sampleno'];

	
		$lotno=$row_arr_home['lotno'];
	
	 $vv=$row_arr_home['gsdis']+6;
	 $tt=$row_arr_home['gsvariety'];

$wh=""; $binn=""; $slocs="";
$wh1=$row_arr_home['gswh']."/";
$binn1=$row_arr_home['gsbin'];

$quer3=mysqli_query($link,"SELECT * FROM tblbin  where binid='".$binn1."'"); 
	$row31=mysqli_fetch_array($quer3);
	  $binn=$row31['binname'];
	
	$quer4=mysqli_query($link,"SELECT * from tblwarehouse where whid ='".$wh1."'"); 
	$row=mysqli_fetch_array($quer4);
	  $wh=$row['perticulars']."/";
$slocs=$wh.$binn."<br/>";

if($vv!=0)
{
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt=$vv;
		
		for($i=0; $i<=$dt; $i++) { $dt1=date('Y-m-d',mktime(0,0,0,($m+$i),$de,$y)); }
$cdate=date("Y-m-d");		
$flg=0;
if($dt1>$cdate)	$flg=1; else $flg=0;
	$trdate1=$dt1;
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
}
else
{
$vv="";
$trdate1="";
}		

if($flg==1 && $vv!="")
{
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="23" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
         <td width="116" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['gscrop'];?></td>
    	 <td align="center" valign="middle" class="tblheading"><?php echo $tt;?></td>
         <td width="118" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 <td width="83" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
		 <td width="88" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="82" align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="82" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
		 </tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="23" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
         <td width="116" align="center" valign="middle" class="tblheading"><?php echo $row_arr_home['gscrop'];?></td>
    	 <td align="center" valign="middle" class="tblheading"><?php echo $tt;?></td>
         <td width="118" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 <td width="83" align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
		 <td width="88" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="82" align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="82" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
		 </tr>  
<?php
}
$srno=$srno+1;
}
}
}
}
}
?>
</table>
<?php
}
?>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_aging.php?ids=<?php echo $ids;?>&typ=<?php echo $typ;?>"><img src="../images/edit.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" onClick="return mySubmit();"><input type="hidden" name="foccode" value="" />
<input type="hidden" name="typ" value="<?php echo $typ;?>" /><input type="hidden" name="srno" value="<?php echo $srno;?>" /></td>
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
