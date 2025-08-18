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
	//global $link;
	if(isset($_POST['frm_action'])=='submit')
	{
			$filename=$_FILES['brouse']['name'];
			$filepath='../ExcelFileData/'.$filename;
			$name_tmp = $_FILES['brouse']['tmp_name'];
			move_uploaded_file($name_tmp,$filepath);
			chmod($filepath, 0755); 
//error_reporting(E_ALL);
//echo "fgtrdhdgfh"; 
//print_r($link);//exit;
set_time_limit(0);
$flg1=0; $flg2=0;
function insertdata($xlsfilepath,$link, $plantcode)
{
$row = 0; $dt=date("Y-m-d"); $plname=""; $plcode=""; 
//echo "fgtrdhdgfh"; exit;
if(($handle = fopen($xlsfilepath, "r")) !== FALSE) 
{
    while(($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
	{ $stcode=$_POST['stcode'];
	   $num = count($data);
	//echo "fgtrdhdgfh"; exit;  
       $row++; $flg1=0;  $flg2=0;
		if($row == 2)
		{//echo "jhkjhk"; exit;
//print_r($link);
			$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
			$row_cls=mysqli_fetch_array($quer_cn);
			$pcode24=$row_cls['code'];
				$plname=$data[0];
				$plcode=$data[1];
				
//echo $plcode."  =  ".$pcode24;exit;
				/*if($plcode!=$pcode24)
				{
					$flg1=1;
				}
				else
				{
					$flg1=0;
				}*/	
		}
//echo $flg1;
		if($flg1==0)
		{
			if($row >= 4)
			{//echo  "fdsgfsdg";
//print_r($data);
					$flag=0; $pcode=""; $ycode="";
					$day_month_array=explode("-",$data[0]);
					if($day_month_array[2]=="")
					$day_month_array=explode("/",$data[0]);
					$year=$day_month_array[2];
					$month=sprintf("%02d",$day_month_array[1]);
					$day=sprintf("%02d",$day_month_array[0]);
					$final_date=$year."-".$month."-".$day;
					
					$day_month_array1=explode("-",$data[12]);
					if($day_month_array1[2]=="")
					$day_month_array1=explode("/",$data[12]);
					$year1=$day_month_array1[2];
					$month1=sprintf("%02d",$day_month_array1[1]);
					$day1=sprintf("%02d",$day_month_array1[0]);
					$final_date1=$year1."-".$month1."-".$day1;
					
					$day_month_array2=explode("-",$data[15]);
					if($day_month_array2[2]=="")
					$day_month_array2=explode("/",$data[15]);
					$year2=$day_month_array2[2];
					$month2=sprintf("%02d",$day_month_array2[1]);
					$day2=sprintf("%02d",$day_month_array2[0]);
					$final_date2=$year2."-".$month2."-".$day2;
					
					/*if($final_date > $dt)$flag=1;
					if($data[7]!="UT" && $data[7]!="RT")
					if($final_date1 > $dt)$flag=1;
					if($data[14]!="UT" && $data[14]!="RT" && $data[14]!="NUT")
					if($final_date2 > $dt)$flag=1;
					if($data[7]!="UT" && $data[7]!="RT")
					if($final_date1 > $final_date)$flag=1;
					if($data[14]!="UT" && $data[14]!="RT" && $data[14]!="NUT")
					if($final_date2 > $final_date)$flag=1;*/
				
					$sqlcrop=mysqli_query($link,"select * from tblcrop where cropname='".$data[1]."'") or die(mysqli_error($link));
					$row_crop=mysqli_num_rows($sqlcrop);
//echo "select * from tblcrop where cropname='".$data[1]."'";
//echo "select * from tblvariety where popularname='".$data[2]."' and actstatus='Active'";
					$sqlveriety=mysqli_query($link,"select * from tblvariety where popularname='".$data[2]."' ") or die(mysqli_error($link));
					$row_variety=mysqli_num_rows($sqlveriety);
					
					//echo  "dfgsdfg";
					//echo "<br />";
					if($row_crop == 0 || $row_variety == 0){$flag=1;}
					$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
					$row_cls=mysqli_fetch_array($quer_cn);
					$pcode=$row_cls['code'];
					$quer=mysqli_query($link,"SELECT * FROM tbl_partymaser where classification='Stock Transfer-Plant'");
					while($row_c=mysqli_fetch_array($quer))
					{
					$pcode=$pcode.",".$row_c['stcode'];
					}
					
					$quer2=mysqli_query($link,"SELECT * FROM tbl_lgenyear ");
					while($row_c2=mysqli_fetch_array($quer2))
					{
					if($ycode!="")
					$ycode=$ycode.",".$row_c2['lgenyearcode'];
					else
					$ycode=$row_c2['lgenyearcode'];
					}
					
					if(strlen($data[3])!=17) $flag=1;
					$lt=str_split($data[3]);
					//echo $lt[13];
					if($lt[7]!="/")$flag=1;
					if($lt[13]!="/")$flag=1;
					//echo $flag;
					$pc=explode(",",$pcode);
						if(!in_array($lt[0],$pc))
						{
							$flag=1;
						}
					
//exit;
					$yc=explode(",",$ycode);
						if(!in_array($lt[1],$yc))
						{
							$flag=1;
						}
					
					if($data[0]=="")$flag=1;
					if($data[1]=="")$flag=1;
					if($data[2]=="")$flag=1;
					if($data[3]=="")$flag=1;
					if($data[4]=="")$flag=1;
					if($data[5]=="")$flag=1;
					if($data[6]=="")$flag=1;
					if($data[7]=="")$flag=1;
					if($data[8]=="")$flag=1;
					/*if($data[10]=="")$flag=1;
					if($data[11]=="")$flag=1;*/
					if($data[13]=="")$data[13]="GOT-NR";
					if($data[14]=="")$data[14]="OK";
					//if($data[17]=="")$flag=1;
					/*if(!in_array($data[17],$pc))
					{
						$flag=1;
					}*/
					//if($data[17]!=$stcode)$flag=1;
					//echo $flag;
					//echo $lt[13]; echo $data[4];
					
					if($lt[16]!="R" && $lt[16]!="C" && $lt[16]!="P")$flag=1;
					if($lt[16]=="R" && $data[4]!="Raw")$flag=1;
					if($lt[16]=="C" && $data[4]!="Condition")$flag=1;
					if($data[4]!="Condition" && $data[4]!="Raw" && $data[4]!="Pack")$flag=1;
					
					if($data[5]<=0 || $data[5]>9999)$flag=1;
					if($data[6]<=0 || $data[6]>99999.999)$flag=1;
					//if($data[10]!="" && ($data[10]<0.1 || $data[10]>99.9))$flag=1;
					if($data[11]!="" && ($data[11]<=0 || $data[10]>99))$flag=1;
					if($data[8]!="Not-Acceptable" && $data[8]!="Acceptable")$flag=1;
					//if($data[8]=="Not-Acceptable" && $data[9]=="")$flag=1;
					
					$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_stlotimp where stlotimp_ddate='".$final_date."' and stlotimp_lotno='".$data[3]."' and stlotimp_qty='".$data[6]."' ");
					$total_results4 = mysqli_fetch_array($total_results3);
					$total_results = $total_results4[0]; 
					$total_results2=0;

					$sqlmonth=mysqli_query($link,"select distinct lotldg_subbinid from tbl_lot_ldg where lotldg_lotno='".$data[3]."' ")or die("Error:".mysqli_error($link));
					while($rowmonth=mysqli_fetch_array($sqlmonth))
					{
						$sqlmonth2=mysqli_query($link,"select MAX(lotldg_id) from tbl_lot_ldg where lotldg_lotno='".$data[3]."' and lotldg_subbinid='".$rowmonth['lotldg_subbinid']."' ")or die("Error:".mysqli_error($link));
						$rowmonth2=mysqli_fetch_array($sqlmonth2);
						//echo $rowmonth['lotldg_subbinid']." - ".$rowmonth2[0]." ";
						$sqlmonth3=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$rowmonth2[0]."' and lotldg_balqty>0 ")or die("Error:".mysqli_error($link));
						while($rowmonth3=mysqli_fetch_array($sqlmonth3))
						{
							$total_results2++;
						}
					}	
					//echo $total_results."  -  ".$total_results2."  -  ".$flag; exit;
					if($total_results > 0 || $total_results2 > 0 || $flag > 0)
					{
						$flg2++;
					}
					else 
					{
					 	$str="insert into tbl_stlotimp (stlotimp_plantcode, stlotimp_plantname, stlotimp_date, stlotimp_ddate, stlotimp_crop, stlotimp_variety, stlotimp_lotno, stlotimp_stage, stlotimp_nob, stlotimp_qty, stlotimp_qcstatus, stlotimp_pp, stlotimp_reason, stlotimp_moisture, stlotimp_germination, stlotimp_ltdate, stlotimp_gottype, stlotimp_gotstatus, stlotimp_gtdate, stlotimp_packtype, leduration, leupto, plantcode) values('$plcode', '$plname', '$dt', '$final_date', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$data[7]', '$data[8]', '$data[9]', '$data[10]', '$data[11]', '$final_date1', '$data[13]', '$data[14]', '$final_date2', '$data[16]', '$data[18]', '$data[19]', '$plantcode')";
						$result=mysqli_query($link,$str) or die("Error:".mysqli_error($link));
					} 
			}
		}
	}
    fclose($handle);
} 
//echo $flg1." = ".$flg2;
//exit;
if($flg1 > 0)
{
			?>	
			<script>
			alert('Can not Import Lots.\nReason: File mismatch for the Current Plant');
			window.location='add_stlotimp.php';
			</script>
			<?php
}
else if($flg2 > 0)
{
			?>	
			<script>
			alert('Lot Import updated. '+<?php echo $flg2;?>+' Lot(s) not Imported.');
			window.location='home_stlotimp.php';
			</script>
			<?php
}
else
{
			?>	
			<script>
			alert('Lot Import updated successfully');
			window.location='home_stlotimp.php';
			</script>
			<?php
}
}
//print_r($link);	
insertdata($filepath,$link, $plantcode);
			//exit;
}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Lgen -Transaction - Add Tagging</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript" src="vaddresschk.js"></script>
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
function ucwords_w(str) { return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }

function onloadfocus()
	{
	document.frmaddDept.brouse.focus();
	}
  
function mySubmit()
{ //alert(document.frmaddDept.brouse.value);
var filename=document.frmaddDept.brouse.value;
var f=filename.split("fakepath\\");
//alert(f[1]);
if(f[1]!="")
var filearr=f[1].split("_");
else
var filearr=filename.split("_");
//var filearr=filename.split("_");
var filechk=filearr[0]+' '+filearr[1]+' '+filearr[2];
//var destchk=filearr[3];
filename=f[1];
var flg=0;
//alert(filename);
	if(document.frmaddDept.txtstfp.value=="")
	{
	alert("Select Stock Transfer from Plant");
	document.frmaddDept.txtstfp.focus();
	return false;
	}
	if(document.frmaddDept.stcode.value=="")
	{
	alert("Select different Stock Transfer from Plant. \nReason Selected Plant for Stock Transfer does not have code");
	//document.frmaddDept.txtstfp.focus();
	return false;
	}
if(document.frmaddDept.brouse.value=="")
	{
	alert("Attach Excel File");
	//document.frmaddDept.brouse.focus();
	return false;
	}

	if(document.frmaddDept.brouse.value != "")
	{
		var extArray = new Array(".csv");
				var fileName = document.frmaddDept.brouse.value;
						
				if(!fileName) {return false;}
				ext = fileName.substring(fileName.lastIndexOf(".")).toLowerCase();
						
				for (var i = 0; i < extArray.length; i++) {
				   if (extArray[i] == ext) flg=1;
				}
				/*alert("Please only upload files that end in type:  "
				+ (extArray.join("  ")) + "\nPlease select a new "
				+ "file to upload and submit again.");
				document.frmaddDept.brouse.focus();
				return false;*/
	}
	if(flg==1)
	{ 
		if(filename!="Stock_Transfer_Lots.csv")
		{
			alert("Excel File attached is Invalid. ");
			document.frmaddDept.brouse.value==""
			//document.frmaddDept.brouse.focus();
			return false;
		}
	}
	else
	{
				alert("Please only upload files that end in type: .csv "
				+ "\nPlease select a new "
				+ "file to upload and submit again.");
				document.frmaddDept.brouse.focus();
				return false;
	}
	//alert(document.frmaddDept.stcode.value);
return true;
}
</SCRIPT>
<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"  onLoad="return onloadfocus()" ><table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
		  



  
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Add Stock Transfer Lots Import </td>
	    </tr></table></td>
	    	 </tr>
	  </table></td></tr>
   	  <td align="center" colspan="4" >
	  <form name="frmaddDept" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" > 
	 <input name="frm_action" value="submit" type="hidden">
	 <input name="pldestination" value="Gomchi" type="hidden"> <br />

<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>
<table align="center" border="1" width="650" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="25">
  <td colspan="4" align="center" class="tblheading">Add Stock Transfer Lots Import </td>
</tr>
<tr height="15">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
<?php
$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer-Plant'"); 
?>
  <tr class="Dark" height="25">
<td width="206"  align="right"  valign="middle" class="tblheading">Stock Transfer from Plant&nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtstfp" style="width:220px;" onChange="showUser(this.value,'codechk','stcodechk','','','','','');" >
<option value="" selected="selected">--Select--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['p_id'];?>" />   
		<?php echo $noticia['business_name'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td></tr>

<tr class="Dark" height="25">
<td width="206"  align="right"  valign="middle" class="tblheading">Stock Transfer Lots Import&nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="brouse" class="tbltext" type="file" size="30"   />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td></tr>
  </table>
<div id="codechk"><input type="hidden" name="stcode" value="" /></div>
<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_stlotimp.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"></a>&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;"></td>
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
