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
	
	if(isset($_POST['frm_action'])=='submit')
	{
		$filename=$_FILES['brouse']['name'];
		$filepath='../ExcelFileData/'.$filename;
		$name_tmp = $_FILES['brouse']['tmp_name'];
		move_uploaded_file($name_tmp,$filepath);
		chmod($filepath, 0777);
			
		$row = 0; $cnt=0;
		if (($handle = fopen($filepath, "r")) !== FALSE) 
		{
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
			{
				$num = count($data);
				$row++;
				
				if($row>3)
				{
					//print_r($data);
					//exit;
					$dt=date("Y-m-d");
					
					if($data[5]!="")
					{
						$sowflg=0; $tplantflg=0; $fmvflg=0; $finobserflg=0;
						
						$cropnm=$data[2];
						$spcodes=$data[3];
						$varietynm=$data[4];
						$lotnum=$data[5];
						$gotcode=$data[6];
						$nob=$data[7];
						$qty=$data[8];
						$pp=$data[9];
						$moist=$data[10];
						$gotsts=$data[11];
						$prodloc=$data[12];
						$organizer=$data[13];
						$farmer=$data[14];
						$prodper=$data[15];
						$plant=$data[16];
						//$dosw=$data[17];
						
						
						$nursloc=$data[18];
						$dotplant=$data[19];
						$bedno=$data[20];
						$directn=$data[21];
						$row=$data[22];
						$range=$data[23];
						$farmloc=$data[24];
						$plotno=$data[25];
						$rtplantingdt1=$data[26];
						$rtplantingdt2=$data[27];
						$rtplantingdt3=$data[28];
						$rtplantingdt4=$data[29];
						$rtnursloc=$data[30];
						$remark=$data[31];
						
						$lot=$data[5];
						$nurseryloc='';
						if($nursloc!='')
						{
							$nursloc=$nursloc."+";
							$nurseryloc=explode("+",$nursloc);
						}
						$dottplant='';
						if($dotplant!='')
						{
							$dotplant=$dotplant."+";
							$dottplant=explode("+",$dotplant);
						}
						$bednumber='';
						if($bedno!='')
						{
							$bedno=$bedno."+";
							$bednumber=explode("+",$bedno);
						}
						$direction='';
						if($directn!='')
						{
							$directn=$directn."+";
							$direction=explode("+",$directn);
						}
						$farmlocation='';
						if($farmloc!='')
						{
							$farmloc=$farmloc."+";
							$farmlocation=explode("+",$farmloc);
						}
						$plotlocation='';
						if($plotno!='')
						{
							$plotno=$plotno."+";
							$plotlocation=explode("+",$plotno);
						}
						$rtnurseryloc='';
						if($rtnursloc!='')
						{
							$rtnursloc=$rtnursloc."+";
							$rtnurseryloc=explode("+",$rtnursloc);
						}
						
						$sql_crop=mysqli_query($link,"select * from tblcrop where cropname='".$data[2]."'") or die(mysqli_error($link));
						$row_crop=mysqli_fetch_array($sql_crop);
						$noofsamples=$row_crop['nosior'];
						$croptype=$row_crop['croptype'];
						$cropid=$row_crop['cropid'];
						
						$sql_ver=mysqli_query($link,"select * from tblvariety where popularname='".$data[4]."'") or die(mysqli_error($link));
						$row_ver=mysqli_fetch_array($sql_ver);
						$varietyid=$row_ver['varietyid'];
						
						$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
						$row_param=mysqli_fetch_array($sql_param);
						$plantcode=$row_param['code'];
						$lotnum=$plantcode.$lot."/"."00000"."/00";
						
						$sql_month=mysqli_query($link,"select orlot from tbl_lot_ldg where orlot='$lotnum' and plantcode=$plantcode")or die("Error:".mysqli_error($link));
						$row_month=mysqli_fetch_array($sql_month);
						
						
						$qry_gottest=mysqli_query($link,"select * from tbl_gottest where gottest_oldlot='".$lotnum."' and gottest_resultflg=0 and plantcode=$plantcode order by gottest_tid desc");
						$row_gottest=mysqli_fetch_array($qry_gottest);
						$sampno=$plantcode.$row_gottest['yearid'].sprintf("%000006d",$row_gottest['gottest_sampleno']);
						$dosd=$row_gottest['gottest_dosdate'];
						$gotid=$row_gottest['gottest_tid'];
						
						$dispstate='';
						if($plant=="Deorjhal"){$dispstate='Chhatisgarh';}
						
						
						$day_month_array=explode("-",$data[1]);
						$ack_date=$day_month_array[2]."/".$day_month_array[1]."/".$day_month_array[0];
						
						$day_month_array2=explode("-",$data[17]);
						$dosw=$day_month_array2[2]."/".$day_month_array2[1]."/".$day_month_array2[0];
						
						
						$ccnt=0; $one=1; $two=2;
						
						if($ccnt==0)
						{	
							$str="insert into tbl_qcgotmain (gotm_tdate, gotm_dosd, gotm_croptype, gotm_crop, gotm_variety, gotm_lotno, gotm_sampleno, gotm_noofsamples, gotm_disploc, gotm_dispstate, gotm_ackdate, gotm_ackflg, gotm_gottid, gotm_acklogid, plantcode) values('$dt','$dosd','".$croptype."', '".$cropid."', '".$varietyid."', '".$lotnum."', '".$sampno."', '".$noofsamples."', '".$plant."', '".$dispstate."', '".$ack_date."', '".$one."', '".$gotid."', '".$logid."', '".$plantcode."')";
							if(mysqli_query($link,$str) or die("Error:".mysqli_error($link)))
							{
								$mainid=mysqli_insert_id($link);	
								if($data[17]!='')
								{
									if($nursloc!='')
									{
										$str="insert into tbl_qcgotsowing (gotm_id, gotsow_dosow, gotsow_loc, gotsow_bedno, gotsow_direction, plantcode) values('$mainid','$dosw','".$data[18]."', '".$data[20]."', '".$data[21]."', '".$plantcode."')";
										if($cx=mysqli_query($link,$str) or die("Error:".mysqli_error($link)))
										{$sowflg=1; }
										if($data[19]!='')
										{
											for($i=0; $i<count($dottplant);$i++)
											{
												if($dottplant[$i]<>"")
												{
													$str_tpl="insert into tbl_qcgottranspl (gotm_id, gottransp_date, gottransp_loc, gottransp_plotno, plantcode) values('$mainid','$dottplant[$i]','".$farmlocation[$i]."', '".$plotlocation[$i]."', '".$plantcode."')";
													if($tplo=mysqli_query($link,$str_tpl) or die("Error:".mysqli_error($link)))
													{$tplantflg=1;}
												}
											}
										}
									}
									else
									{	
										$str="insert into tbl_qcgotsowing (gotm_id, gotsow_dosow, gotsow_nurplotno, gotsow_loc, gotsow_bedno, gotsow_direction, plantcode) values('$mainid','$dosw','".$plotno."', '".$data[24]."', '".$data[20]."', '".$data[21]."', '".$plantcode."')";	
										if($cx=mysqli_query($link,$str) or die("Error:".mysqli_error($link)))
										{$sowflg=1; }
									}
								}
								if($sowflg>0)
								{
									$str2="update tbl_qcgotmain set  gotm_sowingflg='$one' where gotm_id='$mainid' ";	
									$cx2=mysqli_query($link,$str2) or die("Error:".mysqli_error($link));
								}
								if($tplantflg>0)
								{
									$str3="update tbl_qcgotmain set gotm_transplantflg='$one' where gotm_id='$mainid' ";	
									$cx3=mysqli_query($link,$str3) or die("Error:".mysqli_error($link));
								}
								$cnt++;
							}
						} // end else
					}
				}
			}
			fclose($handle);
		}
		//echo $cnt;
		//exit;
		//insertdata($filepath);
		if($cnt>0)
		{
		?>	
		<script>
			alert('Data Import updated successfully');
			window.location='home_tagging.php';
		</script>
		<?php
		}
		else
		{
		?>
		<script>
			alert('Lot Import updated Unsuccessfull. Please Check the Excel file and try again.');
			window.location='home_tagging.php';
		</script>
		<?php
		}
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
var filename=document.frmaddDept.brouse.value;
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
	if(document.frmaddDept.brouse.value=="")
	{
	alert("Attach Excel File");
	//document.frmaddDept.brouse.focus();
	return false;
	}

	if(document.frmaddDept.brouse.value != "")
	{
		var extArray = new Array(".csv",".xls",".xlsx");
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
		/*if(filechk!="Lot Destination Report")
		{
			alert("Excel File attached is Invalid. ");
			document.frmaddDept.brouse.value==""
			//document.frmaddDept.brouse.focus();
			return false;
		}*/
	}
	else
	{
				alert("Please only upload files that end in type: .csv "
				+ "\nPlease select a new "
				+ "file to upload and submit again.");
				document.frmaddDept.brouse.focus();
				return false;
	}
return true;
}
</SCRIPT>
<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0"  onLoad="return onloadfocus()" ><table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_plants.php");?></td>
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
<tr height="15">
    <td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td>
  </tr>
<tr class="Dark" height="25">
<td width="206"  align="right"  valign="middle" class="tblheading">Lots Import &nbsp;</td>
<td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="brouse" class="tbltext" type="file" size="30"   />&nbsp;<font color="#FF0000" >*</font>&nbsp;</td></tr>
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