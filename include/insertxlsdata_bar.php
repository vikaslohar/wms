<?php
	
 set_time_limit(60);
 function insertdata($xlsfilepath,$totnomp,$tid,$lotno,$txtpsrn,$subtid,$dval)
 {
	$data = new Spreadsheet_Excel_Reader(); // instantiate the object
	$data->setOutputEncoding('CP-1251'); // select output encoding
	$data->read($xlsfilepath); // specify the file to read
	/* We start reading the file from row 4 because that's where the   data in the table starts */
	$startRow = 2; 
	/* Get all the cells of the sheet */
	$dt=date("Y-m-d");
	
	$cells = $data->sheets[0]['cells'];
	$lotno1="'$lotno'";
	$txtpsrn1="'$txtpsrn'";
	$rows=($data->sheets[0]['numRows'])-1;
	if($totnomp!=$rows)
	{?>
	<script>
			alert('File Import Unsuccessfull.\nReason: Number of Barcodes to be enter as per Master Packs are not matching with number of Barcodes in Excel file.\nPlease Check the Excel file and try again.');
			window.location='getuser_pronpslip_barcode_new.php?totnomp='+<?php echo $totnomp?>+'&tid='+<?php echo $tid?>+'&lotno='+<?php echo $lotno1?>+'&txtpsrn='+<?php echo $txtpsrn1?>+'&subtid='+<?php echo $subtid?>+'&dval='+<?php echo $dval?>+'';
		</script>
	<?php }
	else
	{
	
		for ($i = $startRow; $i <= $data->sheets[0]['numRows']; $i++)  
		{
			for ($j = 1 ; $j <= $data->sheets[0]['numCols']; $j++) 
			{
			$archu[0][$j]=$data->sheets[0]['cells'][$i][$j];
			}
			$day_month_array=explode("/",$archu[0][4]);
			
			$final_date=$day_month_array[2]."-".$day_month_array[1]."-".$day_month_array[0];
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
			$barcd1=$archu[0][2];
			$sql_barcode=mysqli_query($link,"Select bar_barcodes from tbl_barcodestmp where bar_barcodes='".$barcd1."' and plantcode='$plantcode'") or die(mysqli_error($link));
			if($tot_barcode=mysqli_num_rows($sql_barcode) > 0)$flg1++;
			$sql_barcode3=mysqli_query($link,"Select bar_barcode from tbl_barcodes where bar_barcode='".$barcd1."' and plantcode='$plantcode'") or die(mysqli_error($link));
			if($tot_barcode3=mysqli_num_rows($sql_barcode3) > 0)$flg1++;	
			
			$cr="";$var="";
			$str="insert into tbl_barcodestmp (bar_barcodes, bar_lotno, bar_grosswt, bar_wtdate, bar_wttime, bar_tid, bar_subid, bar_logid, bar_yearid, bar_psrn, plantcode) values('". $archu[0][2]."', '".$lotno."', '". $archu[0][3]."', '".$final_date."', '".$archu[0][5]."', '".$tid."', '".$subtid."', '".$logid."', '".$yearid_id."', '".$txtpsrn."', '$plantcode')";
			//echo $str."<br>";
			$result=mysqli_query($link,$str) or die("Error:".mysqli_error($link));
			$cnt++;
			// } end else
		}  // end for
		
	}
	//echo $cnt;
		if($cnt>0)
		{
		?>	
		<script>
			alert('File Imported successfully');
			window.location='getuser_pronpslip_barcode2_new.php?totnomp='+<?php echo $totnomp?>+'&tid='+<?php echo $tid?>+'&lotno='+<?php echo $lotno1?>+'&txtpsrn='+<?php echo $txtpsrn1?>+'&subtid='+<?php echo $subtid?>+'&dval='+<?php echo $dval?>+'';
		</script>
		<?php
		}
		else
		{
		?>
		<script>
			alert('File Import Unsuccessfull. Please Check the Excel file and try again.');
			window.location='getuser_pronpslip_barcode_new.php?totnomp='+<?php echo $totnomp?>+'&tid='+<?php echo $tid?>+'&lotno='+<?php echo $lotno1?>+'&txtpsrn='+<?php echo $txtpsrn1?>+'&subtid='+<?php echo $subtid?>+'&dval='+<?php echo $dval?>+'';
		</script>
		<?php
		}
}

?>