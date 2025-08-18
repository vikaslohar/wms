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

	if(isset($_REQUEST['tid']))
	{
		$tid = $_REQUEST['tid'];
	}

	
	
		
if(isset($_POST['frm_action'])=='submit')
{
	$wh = $_POST['txtslwhg1'];
	$bin = $_POST['txtslbing1'];
	$dt=date("Y-m-d");
	
	$cnt=0;
	$ti=explode(",",$tid);
	foreach($ti as $val)
	{
		if($val <> "")
		{
			$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$val."'") or die(mysqli_error($link));
			$subtbltot=mysqli_num_rows($sql_tbl_sub);
			$row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub);
			
			$trdate=$row_tbl_sub1['srdate'];
			$lotno=$row_tbl_sub1['lotno'];
			$lotno1=$row_tbl_sub1['oldlot'];
				
			$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub1['variety']."' and actstatus='Active'"); 
			$row=mysqli_fetch_array($quer3);
			$tt=$row['popularname'];
			$tot=mysqli_num_rows($quer3);	
			if($tot==0)
			{
				$vv=$row_tbl_sub1['variety'];
				$gsdis="";
			}
			else
			{
				$vv=$tt;
				$gsdis=$row['gsdis'];
			}
			
			$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub1['crop']."'"); 
			$row31=mysqli_fetch_array($quer3);
			$crp=$row31['cropname'];
			
			$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where lotno='".$lotno."'") or die(mysqli_error($link));
			$subtbltot=mysqli_fetch_array($sql_tbl_sub);
			$arrival_id=$subtbltot['arrival_id'];
			
			$sql_tbl=mysqli_query($link,"select * from tblarrival where arrival_id='".$arrival_id."'") or die(mysqli_error($link));
			$row_tbl=mysqli_fetch_array($sql_tbl);
			$arrdate=$row_tbl['arrival_date'];
			if($arrdate=="0000-00-00" || $arrdate=="--" || $arrdate=="- -" || $arrdate="NULL")$arrdate=$trdate;
			
			$sql_in1="insert into tbl_gsample(trdate, gscrop, gsvariety, lotno, gsdate, gswh, gsbin, oldlot, gsdis, arrivaldate) values('$dt', '$crp', '$vv', '$lotno', '$trdate', '$wh', '$bin', '$lotno1', '$gsdis', '$arrdate')";	
			if(mysqli_query($link,$sql_in1)or die(mysqli_error($link)))
			{				
				$sql_in="update tbl_qctest set gsflg=1 where oldlot='".$lotno1."'";
				$fli=mysqli_query($link,$sql_in)or die(mysqli_error($link));	
				$cnt++;
			}
		}
	}
	if($cnt>0)
	{
		echo "<script>window.opener.location.href = window.opener.location.href;
						   self.close();</script>";	
	}
	else
	{
		echo "<script>alert('GS Updation Incomplete');</script>";	
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quality- Transaction-SLOC Updation</title>
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }

</style>
<script src="stockaddresschk.js"></script>
<script language='javascript'>

function post_value()
{
if(document.from.txtslwhg1.value=="")
{
alert("Please Select Guard House");
return false;
}
if(document.from.txtslbing1.value=="")
{
alert("Please Select Bin");
return false;
}
}

function clk(val)
{
document.from.foccode.value=val;
}

function wh1(wh1val)
{ 
	{
		showUser(wh1val,'bing1','wh','bing1','','','','');
	}
	
}
function bin1(bin1val)
{
//alert("bin1val");
	if(document.form.txtslwhg1.value!="")
	{
		showUser(bin1val,'sbing1','bin','txtslsubbg1','','','','');
	}
	else
	{
		alert("Please select Warehouse");
	}
}
function mySubmit()
{
	var f=0;
	//alert(document.from.txtslwhg1.value);
	if(document.from.txtslwhg1.value=="")
	{
		alert("Please Select GS Warehouse");
		f=1;
		return false;
	}
	if(document.from.txtslbing1.value=="")
	{
		alert("Please Select Bin");
		f=1;
		return false;
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
</head>
<body topmargin="0" >
  
<table width="400" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
	  <input type="hidden" name="cnt" value="0" />
		</br>

<table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Guard  Sample SLOC Updation</td>
</tr>
</table>
<table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
 <tr class="tblsubtitle" height="25">
	<td width="174" align="center"  valign="middle"  class="tblheading">&nbsp;Crop&nbsp;</td>
	<td width="194" align="center"  valign="middle"  class="tblheading">&nbsp;Variety&nbsp;</td>
	<td width="174" align="center"  valign="middle"  class="tblheading">&nbsp;Lot No&nbsp;</td>
</tr>
<?php 
$crop=""; $vv=""; $lotno="";
$ti=explode(",",$tid);
foreach($ti as $val)
{
if($val <> "")
{
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$val."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{
    $trdate=$row_tbl_sub1['srdate'];
	$lotno=$row_tbl_sub1['lotno'];
	
		 $lotno1=$row_tbl_sub1['oldlot'];
$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub1['variety']."' and actstatus='Active'"); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl_sub1['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub1['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	 $crp=$row31['cropname'];
?>
<tr class="Light" height="25">
	<td width="174" align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $crp;?></td>
	<td width="194" align="center"  valign="middle" class="tblheading">&nbsp;<?php echo $vv;?></td>
	<td width="174" align="center"  valign="middle" class="tblheading">&nbsp;<?php echo $lotno?></td>
</tr>
<?php
}
}
}
?>		  
</table><br />
<table align="center" border="1" width="550" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >		  
<tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Select SLOC</td>
</tr>
<?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tblwarehouse order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="25">
<td width="171"  align="right"  valign="middle" class="tblheading">&nbsp;Select GS Warehouse&nbsp; </td>
      <td colspan="3" align="left"  valign="middle">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:80px;" onchange="wh1(this.value);"  >
            <option value="" selected>-----WH---</option>
            <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
            <option value="<?php echo $noticia_whg1['whid'];?>" />    
            <?php echo $noticia_whg1['perticulars'];?>
            <?php } ?>
          </select><font color="#FF0000">*</font>&nbsp;</td>
       
  <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin") or die(mysqli_error($link));
?>
    <td width="106" height="24"  align="right"  valign="middle" class="tblheading">Select Bin &nbsp;</td>
    <td width="129" colspan="3" align="left"  valign="middle" class="tbltext" id="bing1">&nbsp;
      <select class="tbltext" name="txtslbing1" style="width:80px;" onchange="bin1(this.value);" >
          <option value="" selected>------Bin-------</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
      
</tr>     

<input type="hidden" name="foccode" value="" />
<input type="hidden" name="foccode1" value="" />
</table>
<table cellpadding="5" cellspacing="5" border="0" width="550">
<tr >
<td align="center" colspan="3"><img src="../images/back.gif" border="0" onClick="window.close()" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:pointer;" onclick="return mySubmit();"/></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>
