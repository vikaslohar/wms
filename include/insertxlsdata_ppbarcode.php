<?php
 set_time_limit(0);$cnt=0;
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
require_once("config.php");
require_once("connection.php");
 function insertdata($xlsfilepath,$totnomp,$tid,$lotno,$txtpsrn,$subtid,$dval,$lotchk,$link,$plantcode)
 {
	$data = new Spreadsheet_Excel_Reader(); // instantiate the object
	$data->setOutputEncoding('CP-1251'); // select output encoding
	$data->read($xlsfilepath); // specify the file to read
	/* We start reading the file from row 4 because that's where the   data in the table starts */
	$startRow = 3; 
	$startRow1 = 6; 
	/* Get all the cells of the sheet */
	$dt=date("Y-m-d");
	$flg=0;
	$cells = $data->sheets[0]['cells'];
	$lotno1="'$lotno'";
	$txtpsrn1="'$txtpsrn'";
	$rows=($data->sheets[0]['numRows'])-1;
	
	for ($i = $startRow; $i <= 3; $i++)  
	{
		for ($j = 1 ; $j <= $data->sheets[0]['numCols']; $j++) 
		{
			$archu[0][$j]=$data->sheets[0]['cells'][$i][$j];
		}

		$zzz2=implode(",", str_split($archu[0][2]));
		$lt2=$zzz2[28].$zzz2[30];
		
		$lotchk2=$zzz2[0].$zzz2[2].$zzz2[4].$zzz2[6].$zzz2[8].$zzz2[10].$zzz2[12].$zzz2[14].$zzz2[16].$zzz2[18].$zzz2[20].$zzz2[22].$zzz2[24].$zzz2[26].$lt2;
		//echo $archu[0][1]."  -  ".$archu[0][2]."  -  ".$archu[1][1]."  -  ".$archu[1][2]."  -  ".$archu[2][1]."  -  ".$archu[2][2]."  -  ".$archu[3][1]."  -  ".$archu[3][2]."  -  ".$archu[4][1]."  -  ".$archu[4][2]."  -  ".$archu[5][1]."  -  ".$archu[5][2]."  -  ".$lotno."<br />";
		if($lotchk2!=$lotchk)$flg++;
	}		
	//echo $flg;
	if($flg==0)
	{	$x=1; $id="";
		for ($i = $startRow1; $i <= $data->sheets[0]['numRows']; $i++)  
		{
			for ($j = 1 ; $j <= $data->sheets[0]['numCols']; $j++) 
			{
				$archu[0][$j]=$data->sheets[0]['cells'][$i][$j];
			}
			$z=$x%2;  $flg1=0;
			set_time_limit(120);
			$year1=$_SESSION['ayear1'];
			$year2=$_SESSION['ayear2'];
			$username= $_SESSION['username'];
			$yearid_id=$_SESSION['yearid_id'];
			$role=$_SESSION['role'];
			$loginid=$_SESSION['loginid'];
			$logid=$_SESSION['logid'];
			$lgnid=$_SESSION['logid'];
			$baryrcode=$_SESSION['baryrcode'];
			//$id=0;
			
			//echo $z." - ".$id." = ".$flg1." - ";
			if($z==1)
			{
				$barcd1=trim($archu[0][1]);
				$barcd1=strtoupper($barcd1);
				$barcd=str_split($barcd1);
				$ccont=count($barcd);
				
				if($ccont<11)
				{
					$flg1=$flg1+1;
				}
				$teststring=$barcd[0].$barcd[1];
				if(preg_match("/[^a-zA-Z]/i", $teststring))
				{
					$flg1=$flg1+1;
				}

				$test_string=$barcd[2].$barcd[3].$barcd[4].$barcd[5].$barcd[6].$barcd[7].$barcd[8].$barcd[9].$barcd[10];
				if(preg_match('/[^0-9]/',$test_string))
				{
					$flg1=$flg1+1; //echo " Invalid ".$archu[0][2]."   ";
				}

//echo "Select bar_barcodes from tbl_barcodestmp where bar_barcodes='".$barcd1."' ";
				$sql_barcode=mysqli_query($link,"Select bar_barcodes from tbl_barcodestmp where bar_barcodes='".$barcd1."' ") or die(mysqli_error($link));
				if($tot_barcode=mysqli_num_rows($sql_barcode) > 0){$flg1=$flg1+1;}
//echo $flg1." fdgdfsg";
				$sql_barcode3=mysqli_query($link,"Select bar_barcode from tbl_barcodes where bar_barcode='".$barcd1."' ") or die(mysqli_error($link));
				if($tot_barcode3=mysqli_num_rows($sql_barcode3) > 0){$flg1=$flg1+1;	}

//echo $flg1." sret6ywg";		
			}
			else
			{
				$grwt=trim($archu[0][1]);
				//echo " - ";
			}
			echo $flg1;	
			if($flg1==0)
			{
				$cr=""; $var="";
				
				if($z==1)
				{
				 	$str="insert into tbl_barcodestmp (bar_barcodes, bar_lotno, bar_tid, bar_subid, bar_logid, bar_yearid, bar_psrn, plantcode) values('".$barcd1."', '".$lotno."', '".$tid."', '".$subtid."', '".$logid."', '".$yearid_id."', '".$txtpsrn."', '$plantcode')";
					$result=mysqli_query($link,$str) or die("Error:".mysqli_error($link));
				 	$id=mysqli_insert_id($link);
				}
				else
				{
					if($id!="")
					{
						$str="update tbl_barcodestmp set bar_grosswt='".$grwt."' where bar_id='$id'";
						$result=mysqli_query($link,$str) or die("Error:".mysqli_error($link));
						$cnt++;
					}
				}
				//echo $str."<br>";
			}
			
			//$result=mysqli_query($link,$str) or die("Error:".mysqli_error($link));
			$x++;
			// } end else
		}  // end for
	}	
	return $cnt;
}

?>
