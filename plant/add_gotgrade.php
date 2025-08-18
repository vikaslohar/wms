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
	//require_once('../include/reader.php'); // include the class
	//require_once("../include/insertxlsdata_arrimp.php");	
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	ini_set('memory_limit', '-1');
	include ('../Classes/PHPExcel/IOFactory.php');

	set_time_limit(0);
	$errtext = "";
	$errtext2 = "";
	$exist_reports ="";
	$post_errors = "";
	$toc_errors="";
	$merrors = "";
	$new_reports ="";
	$notuploaded = "";
	$barins=0;
	$destfile="";
	date_default_timezone_set('UTC');
	if(isset($_POST['frm_action'])=='submit')
	{
		if (empty($_FILES['csv_import']['tmp_name'])) 
		  {
				$notuploaded = '<span style="color:red;">Please select the file.</span> ';
		  } else {
		$invalidcvserr=1;
		 $file = $_FILES['csv_import']['tmp_name'];
		 $fileext=explode(".",$_FILES['csv_import']['name']);
		//if($fileext[1]=='csv')	
		{
				
			if($_FILES['csv_import']['error']==0)
			{
				if(move_uploaded_file($file, '../ExcelFileData/'.$_FILES['csv_import']['name'] ))
				{
					chmod('../ExcelFileData/'.$_FILES['csv_import']['name'],0777);
					$destfile=$_FILES['csv_import']['name'];
					$Filepath = '../ExcelFileData/'.$_FILES['csv_import']['name'];
				}
				else
				{
					//$notuploaded = 'Failed Uploading.Please try again ';
					$destfile=$_FILES['csv_import']['name'];
					$notuploaded = '<span style="color:red;">Failed Uploading.Please try again.</span> ';
					
				}
			}
		}
		/*else
		{
			$notuploaded = '<span style="color:red;">Invalid file format. Please upload only Excel File with .csv extension.</span> ';
		}	*/
		if ($notuploaded) 
		{
			if($notuploaded=='')
			$notuploaded = '<span style="color:red;">Failed Uploading.Please try again.</span> ';
		} else {
		$datas = array();
		$m_array = array();
		
		$row22 = 1;
		$barins=0;
		$inputFileType = 'CSV'; 
		$inputFileName = $Filepath; 
		try {
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
			
		} catch(Exception $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}
		
		//$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$mtblcnt=0; $mainid=0; $dt=date("Y-m-d");
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();
		//exit;
		//  Loop through each row of the worksheet in turn
		for ($row = 2; $row <= $highestRow; $row++)
		{ 
			//  Read a row of data into an array
			$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
											NULL,
											TRUE,
											FALSE);
			$data=$rowData[0];									
			if($data[2]!="" && $data[4]!="")
			{ 	
				$num = count($data);       
				$invalidcvserr=2;	
				$err="";
				$err_miss="";
				$mis = 0;
				$errors=0; 
				
				
				if($errors==1)
				{
					$exist_reports.= "<br/>Duplicate Grade: <b>$data[4]</b>&nbsp;&nbsp;&nbsp;Excel Row id = <b>".$row22."</b>";
				}
				else
				{
					$qry = "UPDATE tbl_gottest SET grade='".trim($data[4])."' where gottest_oldlot='".trim($data[1])."' and (grade!='".trim($data[4])."' OR grade IS NULL) ";
					if(mysqli_query($link,$qry) or die(mysqli_error($link)))
					{
						$barins++;
						$err=$err."UPDATE tbl_gottest SET grade='".trim($data[4])."' where gottest_oldlot='".trim($data[1])."' and (grade!='".trim($data[4])."' OR grade IS NULL)<br />";
					}		
				}
				
			} else	{
					$errtext.="<br><b>Excel Row id:&nbsp;</b>".$row22." &nbsp;&nbsp; <b>Missing Fields: </b> Lot Number ".$data[1]." - Grade ".$data[4];
					}
		$row22 = $row22+1;
			 
		 } 
		}
		}
		//echo $barins;
		//echo $err;
}	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plant -Transaction - Add Tagging</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
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
function ucwords_w(str) { return str.replace(/^(.)|\s(.)/g, function ( $1 ) { return $1.toUpperCase ( ); } ); }

function onloadfocus()
	{
	document.frmaddDept.brouse.focus();
	}
  
   /*
   
//   For only Numbers validation
   
   function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }	

//   For only Numbers with Decimal validation
	  
	function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 45 || charCode == 47 || charCode > 57) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
            return false;

         return true;
      }

//   For only Character with space validation
	   
function isCharKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode != 32 && charCode != 8 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
return false;

return true;
}

 
//   For only Characters validation
	   
function isCharKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode != 8 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && evt.keyCode!=35 && evt.keyCode!=36 && evt.keyCode!=37 && evt.keyCode!=39)
return false;

return true;
}	  
	  
	  */



function mySubmit()
{ //alert(document.frmaddDept.brouse.value);
var filename=document.frmaddDept.csv_import.value;
var f=filename.split("fakepath\\");
//alert(f[1]);
if(f[1]!="")
var filearr=f[1].split("_");
else
var filearr=filename.split("_");
var filechk=filearr[0]+' '+filearr[1]+' '+filearr[2];
var destchk=filearr[3];
var flg=0;
//alert(filename);
	if(document.frmaddDept.csv_import.value=="")
	{
	alert("Attach Excel File");
	//document.frmaddDept.brouse.focus();
	return false;
	}

	if(document.frmaddDept.csv_import.value != "")
	{
		var extArray = new Array(".csv",".xls",".xlsx");
				var fileName = document.frmaddDept.csv_import.value;
						
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
	
return true;
}
</SCRIPT>
<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"  onLoad="return onloadfocus()" ><table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_plant.php");?></td>
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Add Lots Import </td>
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
  <td colspan="4" align="center" class="tblheading">Add Lots Import </td>
</tr>
<?php 
				if($destfile!="")
				{
				echo "<span style='font-weight:bold; font-size:16px; color:blue;'>File Uploaded:  ".$destfile."</span><br>";
				}
				if($barins>0)
				{
					echo "<br />";
					echo "<span style='font-weight:bold; font-size:16px; color:green;'>Total number of Records Imported: <b>$barins</b></span><br>";
					//echo $exist_reports;
					echo "<br />";
				}

				if($notuploaded)
				{
					echo "<br />";
					//echo "<span style='font-weight:bold; font-size:16px; color:green;'>Following Reports are updated successfully...</span><br>";
					echo $notuploaded;
					echo "<br />";
				}
				
				if($exist_reports)
				{
					echo "<br />";
					echo "<span style='font-weight:bold; font-size:16px; color:green;'>Following Duplicate not Imported: </span><br>";
					echo $exist_reports;
					echo "<br />";
				}

				if($errtext)
				{
					echo "<br />";
					echo "<span style='font-weight:bold; font-size:16px; color:#ff0000;'>Following Records are not inserted. Please check missing fields.</span><br>";
					echo $errtext;
				}

				if($post_errors)
				{
					echo "<br />";
					echo "<span style='font-weight:bold; font-size:16px; color:#ff0000;'>Following list is of Invalid Records.</span><br>";
					echo $post_errors;					
					echo "<br />";
				}
				
				if($errtext2)
				{
					echo "<br />";
					echo "<span style='font-weight:bold; font-size:16px; color:#ff0000;'>Following Records are not inserted. Please check missing fields.</span><br>";
					echo $errtext2;
					echo "<br />";
				}
				if(isset($invalidcvserr) && $invalidcvserr!=2)
				{
					echo "<br /><br /><br />";
					echo "<span style='font-weight:bold; font-size:16px; color:red;'>Invalid file format. Please check your Excel File</span><br>";
					echo "<br />";
				}				
			?>
<tr height="15">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
<tr class="Dark" height="25">
<td width="206"  align="right"  valign="middle" class="tblheading">Lots Import &nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="csv_import" id="csv_import" class="tbltext" type="file" size="30"   />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td></tr>
  </table>

<table align="center" width="650" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="center"><a href="home_tagging.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a>&nbsp;<a href="javascript:document.frmaddDept.reset()"></a>&nbsp;<input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value" onClick="return mySubmit();"  border="0" style="display:inline;cursor:pointer;"></td>
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