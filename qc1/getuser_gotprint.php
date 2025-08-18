<?php
	ob_start();session_start();
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
	
if(isset($_REQUEST['crop']))
	{
		$crop = $_REQUEST['crop'];
	}
	if(isset($_REQUEST['samplenumber']))
	{
		$samplenumber = $_REQUEST['samplenumber'];
	}
	if(isset($_REQUEST['txtpp']))
	{
		$txtpp = $_REQUEST['txtpp'];
	}
	
	$filesnames='';
	$slcode=$row_data['btsarrs_slcode'];
	$sl=explode("/",$row_data['btsarrs_slcode']);
	$file=$samplenumber.".prn";
	if($filesnames!='')
	{$filesnames=$filesnames.",".$file;}
	else
	{$filesnames=$file;}
	
	$filename="../printfiles/".$file;
	//$filename="../printfiles/SLCODE.txt";
	$myfile = fopen($filename, "w") or die("Unable to open file!");
	$txt = '<xpml><page quantity="0" pitch="20.0 mm"></xpml>"Seagull:2.1:DP
INPUT OFF
VERBOFF
INPUT ON
SYSVAR(48) = 0
ERROR 15,"FONT NOT FOUND"
ERROR 18,"DISK FULL"
ERROR 26,"PARAMETER TOO LARGE"
ERROR 27,"PARAMETER TOO SMALL"
ERROR 37,"CUTTER DEVICE NOT FOUND"
ERROR 1003,"FIELD OUT OF LABEL"
SYSVAR(35)=0
OPEN "tmp:setup.sys" FOR OUTPUT AS #1
PRINT#1,"Printing,Media,Print Area,Media Margin (X),0"
PRINT#1,"Printing,Media,Print Area,Media Width,380"
PRINT#1,"Printing,Media,Print Area,Media Length,161"
PRINT#1,"Printing,Media,Clip Default,On"
CLOSE #1
SETUP "tmp:setup.sys"
KILL "tmp:setup.sys"
CLIP ON
CLIP BARCODE ON
LBLCOND 3,2
<xpml></page></xpml><xpml><page quantity="1" pitch="20.0 mm"></xpml>CLL
OPTIMIZE "BATCH" ON
PP28,133:AN7
BARSET "QRCODE",1,1,5,2,1
PB "'.$samplenumber.'"
PP142,128:NASC 8
FT "Andale Mono Bold",10,0,99
PT "'.$crop.'"
PP148,84:FT "Andale Mono Bold",9,0,118
PT "'.$samplenumber.'"
LAYOUT RUN ""
PF5
PRINT KEY OFF
<xpml></page></xpml><xpml><end/></xpml>';
			fwrite($myfile, $txt);
			fclose($myfile);
		
	
	$filesnames=explode(",",$filesnames);
	$cnt=0; $ct=count($filesnames);
	if(count($filesnames)>0)
	{
		$filesnames2=$filesnames;
		//print_r($filesnames2); exit;
		foreach($filesnames2 as $myfile2)
		{
			if($myfile<>"")
			{
				$file_url=$_SERVER['DOCUMENT_ROOT']."/wms-d/printfiles/".$myfile2;
				//echo $file_url;
				//exit;
				//ini_set("memory_limit","1000M");
				//set_time_limit(0);
				//echo "Name     : ".$myfile;
					//exit;
				if (empty($file_url)) {
					echo "'path' cannot be empty";
					exit;
				}
				else if (!file_exists($file_url)) {
					echo "'$file_url' does not exist";
					exit;
				}else{
				//echo $file_url;
					//exit;
					//header("Cache-Control: public");
					/*header('Content-Description: File Transfer');
					header('Content-Disposition: attachment; filename='.$myfile);
					header('Content-type: application/octet-stream');*/
					header("Content-Disposition: attachment; filename=$myfile2"); 
					header("Content-Type: application/octet-stream");
					if(readfile($file_url))
					{
						$cnt++;
					}
					else
					{
						echo "Error=";
					}
				}
			}
		}	
	}
	exit;
?>
