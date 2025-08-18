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
		$baryrcode=$_SESSION['baryrcode'];
	}
	
	require_once("../include/config.php");
	require_once("../include/connection.php");
	require_once('../include/reader.php'); // include the class
	require_once("../include/insertxlsdata_bar.php");	
	
	if(isset($_REQUEST['tid'])) { $tid = $_REQUEST['tid']; }
	if(isset($_REQUEST['subtid'])) { $subtid = $_REQUEST['subtid']; }
	
	if(isset($_POST['frm_action'])=='submit')
	{
		//exit;
		set_time_limit(120);
		$tid=trim($_POST['tid']);
		$txtbrowse=trim($_POST['txtbrowse']);
		$cnt=0;
		$filename=$_FILES['txtbrowse']['name'];
		$filepath='../ExcelFileData/'.$filename;
		$name_tmp = $_FILES['txtbrowse']['tmp_name'];
		move_uploaded_file($name_tmp,$filepath);
		chmod($filepath, 0777);
		$lotno1="'$lotno'";
		$txtpsrn1="'$txtpsrn'";
		$zzz=implode(",", str_split($lotno));
		$lt=$zzz[28].$zzz[30];
		
		$row = 0; $cnt=0; $ids="";
		if (($handle = fopen($filepath, "r")) !== FALSE) 
		{
			$year1=$_SESSION['ayear1'];
			$year2=$_SESSION['ayear2'];
			$username= $_SESSION['username'];
			$yearid_id=$_SESSION['yearid_id'];
			$role=$_SESSION['role'];
			$loginid=$_SESSION['loginid'];
			$logid=$_SESSION['logid'];
			$lgnid=$_SESSION['logid'];
			$baryrcode=$_SESSION['baryrcode'];
			
			$sqlmainbarc=mysqli_query($link,"select wb_mpbarcode from tbl_wbqrcode where wb_pnptrid='".$tid."' and wb_mpblinkflg=1 ") or die(mysqli_error($link));
		 	$amainbarc=mysqli_num_rows($sqlmainbarc);
							
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
			{ 
				$num = count($data);
				$row++;
				if($row>=2)
				{
					//if(trim($lotchk)==trim($data[3]))
					{
						$sql_mainbarc=mysqli_query($link,"select wb_mpbarcode from tbl_wbqrcode where wb_mpbarcode='".$data[9]."' and wb_pnptrid='".$tid."' ") or die(mysqli_error($link));
					 	$a_mainbarc=mysqli_num_rows($sql_mainbarc);
						if($a_mainbarc > 0)
						{
						 	$str="UPDATE tbl_wbqrcode SET wb_mpgrosswt='". $data[8]."' where wb_mpbarcode='". $data[9]."' and wb_mpgrosswt!='". $data[8]."' and wb_pnptrid='".$tid."'  ";
							//echo $str."<br>";
							if($result=mysqli_query($link,$str) or die("Error:".mysqli_error($link)))
							{
								$idd=mysqli_insert_id($link);
								if($ids!="")
									$ids=$ids.",".$idd;
								else
									$ids=$idd;
								$cnt++;
							}
						}
					}
				}
			}
			fclose($handle);
		}
	//echo $cnt;
		//exit;
		$sqlmainbarc2=mysqli_query($link,"select wb_mpbarcode from tbl_wbqrcode where wb_pnptrid='".$tid."' and wb_mpblinkflg=1 and wb_mpgrosswt>0 ") or die(mysqli_error($link));
		$amainbarc2=mysqli_num_rows($sqlmainbarc2);
//echo $cnt." = ".$amainbarc2."  =  ".$amainbarc;
//exit;
		if($cnt>0 && $amainbarc2==$amainbarc)
		{?>
			<script>opener.document.frmaddDepartment.gwupdflg.value=<?php echo $cnt;?>; opener.document.getElementById('gwupdate').innerHTML='Updated'; window.close();</script>
		<?php }
		else
		{
		?>
			<script>
				alert('File Import Unsuccessfull.\n\n Please Check the Excel file and try again.');
			</script>
		<?php
		}
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Packaging - Transaction - Packing Slip</title>
<link href="../include/vnrtrac_pack.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="print">
body { font-family:Arial;}
img.butn { display:none; visibility:hidden; }
@page {size:portrait;}
</style>
<script type="text/javascript" src="../include/validation.js"></script>
<script language='javascript'>
function onloadfocus()
{
	opener.document.frmaddDepartment.detmpbno.value=0;
	document.frmaddDepartment.txtbrowse.focus();
}
function post_value()
{
}
function mySubmit()
{
	if(document.frmaddDepartment.txtbrowse.value != "")
	{
		var extArray = new Array(".csv");
		var fileName = document.frmaddDepartment.txtbrowse.value;
						
		if(!fileName) {return false;}
		ext = fileName.substring(fileName.lastIndexOf(".")).toLowerCase();
						
		for (var i = 0; i < extArray.length; i++) {
		   if (extArray[i] == ext) flg=1;
		}
		/*alert("Please only upload files that end in type:  "
		+ (extArray.join("  ")) + "\nPlease select a new "
		+ "file to upload and submit again.");
		document.frmaddDepartment.txtbrowse.focus();
		return false;*/
	}
	if(flg==1)
	{ 
		
	}
	else
	{
				alert("Please only upload files that end in type: .csv "
				+ "\nPlease select a new "
				+ "file to upload and submit again.");
				document.frmaddDepartment.txtbrowse.focus();
				return false;
	}
	 return true;

}

</script>
			
</head>
<body topmargin="0" onLoad="onloadfocus();" >
  <table width="400" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td valign="top">
  <form id="mainform" name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();" enctype="multipart/form-data"  > 
	<input name="frm_action" value="submit" type="hidden"> 
	<input type="hidden" name="cdate" value="<?php echo date("d-m-Y");?>" />
	<input type="hidden" name="totnomp" class="tbltext" value="<?php echo $totnomp;?>"  />
	<input type="hidden" name="txtpsrn" value="<?php echo $txtpsrn;?>" />
	<input type="hidden" name="tid" value="<?php echo $tid;?>" />

<table align="center" border="1" width="400" cellspacing="0" cellpadding="0" bordercolor="#1dbe03" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Select Excel with Barcode Gross Weight</td>
</tr>
<tr class="Light" height="25">
<td width="79" align="right" height="30" valign="middle" class="tblheading">Attach File&nbsp;</td>
<td width="315" align="left"  valign="middle">&nbsp;<input name="txtbrowse" type="file" size="30" class="tbltext" tabindex="0"  />&nbsp;<font color="#FF0000" >*</font>
  </tr>
</table>
<table cellpadding="5" cellspacing="5" border="0" width="400">
<tr >

<td align="center" colspan="3"><a href="getuser_pronpslip_barcode_sel.php?totnomp=<?php echo $totnomp?>&tid=<?php echo $tid?>&subtid=<?php echo $subtid?>&lotno=<?php echo $lotno?>&txtpsrn=<?php echo $txtpsrn?>&nobe=<?php echo $nobe?>&nobmos=<?php echo $nobmos?>&nnob=<?php echo $nnob?>&dval=<?php echo $dval?>&dobg=<?php echo $dobg?>&operatorcode=<?php echo $operatorcode?>&wtmaccode=<?php echo $wtmaccode?>" ><img src="../images/back.gif" border="0" style="cursor:pointer" /></a>&nbsp;<a href="javascript:document.from.reset()"><img src="../images/reset.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;<input type="image" src="../images/next.gif" alt="Next" border="0" style="display:inline;cursor:pointer;" onClick="return mySubmit();"/></td>
</tr>
</table>
</form>
</td></tr>
</table>

</body>
</html>

