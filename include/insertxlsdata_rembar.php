<?php
set_time_limit(0);
 function insertdata($xlsfilepath,$tid)
 {
	$data = new Spreadsheet_Excel_Reader(); // instantiate the object
	$data->setOutputEncoding('CP-1251'); // select output encoding
	$data->read($xlsfilepath); // specify the file to read
	/* We start reading the file from row 4 because that's where the   data in the table starts */
	$startRow = 2; 
	/* Get all the cells of the sheet */
	$dt=date("Y-m-d");
	
	$cells = $data->sheets[0]['cells'];
	$rows=($data->sheets[0]['numRows'])-1;
	
	$plantcodes=""; $yearcodes="";
		$quer4=mysqli_query($link,"SELECT yearsid, ycode FROM tblyears where years_status!='u' order by ycode asc"); 
		while($noticia = mysqli_fetch_array($quer4)) 
		{
			if($yearcodes!="")
				$yearcodes=$yearcodes.",".$noticia['ycode'];
			else
				$yearcodes=$noticia['ycode'];
		}
		$quer6=mysqli_query($link,"SELECT  distinct code FROM tbl_parameters where plantcode='$plantcode' order by code asc");
		$row_month=mysqli_fetch_array($quer6);
		$plantcodes=$row_month['code'];
		$quer5=mysqli_query($link,"SELECT  distinct stcode FROM tbl_partymaser where stcode!=''  order by stcode asc"); 
		while($noticia2 = mysqli_fetch_array($quer5)) 
		{
			if($plantcodes!="")
				$plantcodes=$plantcodes.",".$noticia2['stcode'];
			else
				$plantcodes=$noticia2['stcode'];
		}
		
	 $cnt=0; $totrec=0; $relrec=0; $invrec=0; $nosrec=0; $duprec=0;
		
	for ($i = $startRow; $i <= $data->sheets[0]['numRows']; $i++)  
	{
		for ($j = 1 ; $j <= $data->sheets[0]['numCols']; $j++) 
		{
			$archu[0][$j]=$data->sheets[0]['cells'][$i][$j];
		}
		
		if($archu[0][2]!="")	
		{
			$flg=0;
			$totrec++;
			//echo $totrec."  =>  ".$archu[0][2]."  ";
			if(strlen($archu[0][2])!=11)
			{
				$flg++; $invrec++; //echo $archu[0][2]."   ";
			}
			else
			{
				 $flg1=0;
				//echo $archu[0][2]."   ";
				$pcodes=explode(",", $plantcodes);
				$ycodes=explode(",", $yearcodes);
				$barcd1=implode(",", str_split($archu[0][2]));
				
				$barcd=explode(",", $barcd1);
				$test_string2=$barcd[0].$barcd[1];
				//if((!in_array($barcd[0], $pcodes)) || (!in_array($barcd[1],$ycodes)))
				if(preg_match('/[^A-Za-z]/',$test_string2))
				{
					$flg1++; $invrec++; //echo " Invalid ".$archu[0][2]."   ";
				}
				else
				{
					$test_string=$barcd[2].$barcd[3].$barcd[4].$barcd[5].$barcd[6].$barcd[7].$barcd[8].$barcd[9].$barcd[10];
					if(preg_match('/[^0-9]/',$test_string))
					{
						$flg1++; $invrec++; //echo " Invalid ".$archu[0][2]."   ";
					}
				}
			//}
			
				if($flg1==0)
				{
					$mptyp=""; $mplotnos=""; $mpups=""; $mpwtmp="";
					$sql_barcode2=mysqli_query($link,"Select bar_barcode from tbl_barcodes where bar_barcode='".$archu[0][2]."' and plantcode='$plantcode'") or die(mysqli_error($link));
					$tot_barcode2=mysqli_num_rows($sql_barcode2);
						
					$sql_barcode1=mysqli_query($link,"Select * from tbl_mpmain where mpmain_barcode='".$archu[0][2]."' and plantcode='$plantcode'") or die(mysqli_error($link));
					$tot_barcode1=mysqli_num_rows($sql_barcode1);
					if($tot_barcode2==0 || $tot_barcode1==0) 
					{
						$flg++; $nosrec++; //echo " NoS ".$archu[0][2]."   ";
					}
						
					//else
					{
						$sql_barcode24=mysqli_query($link,"Select mpmain_barcode from tbl_mpmain where mpmain_barcode='".$archu[0][2]."' and (mpmain_dflg>0 OR mpmain_upflg>0 OR mpmain_spremflg>0) and plantcode='$plantcode'") or die(mysqli_error($link));
						if($tot_barcode24=mysqli_num_rows($sql_barcode24) > 0)
						{
							$flg++; $relrec++; //echo " Rel ".$archu[0][2]."   ";
						}
			
						if($tot_barcode1>0)
						{
							$row_barcodes24=mysqli_fetch_array($sql_barcode1);
							$mptyp=$row_barcodes24['mpmain_trtype']; 
							$mplotnos=$row_barcodes24['mpmain_lotno']; 
							$mpups=$row_barcodes24['mpmain_upssize']; 
							$mpwtmp=$row_barcodes24['mpmain_wtmp'];
							$mplotnop=$row_barcodes24['mpmain_lotnop'];
						}
					}
					$sql_barcode23=mysqli_query($link,"Select barcodes from tbl_pswrem_bar where barcodes='".$archu[0][2]."' and plantcode='$plantcode'") or die(mysqli_error($link));
					if($tot_barcode23=mysqli_num_rows($sql_barcode23) > 0)
					{
						$flg++; $duprec++; //echo " Dup ".$archu[0][2]."   ";
					}				
				}
				if($flg1>0)$flg++;
				//echo $data[1]."<br/>";
				if($flg == 0)
				{
					$str="insert into tbl_pswrem_bar (pswrem_id, barcodes, mptype, mplotno, mpups, mpwtmp, mplotnop, plantcode) values('".$tid."','". $archu[0][2]."', '$mptyp', '$mplotnos', '$mpups', '$mpwtmp', '$mplotnop', '$plantcode')";
					//echo $str;
					$result=mysqli_query($link,$str) or die("Error:".mysqli_error($link));
					$cnt++;
				}
			}
		}//echo "<br>";
		// } end else 
	}  // end for
	
	$sql_main="update tbl_pswrem set pswrem_totrec='$totrec', pswrem_remrec='$cnt', pswrem_relrec='$relrec', pswrem_invrec='$invrec', pswrem_nosrec='$nosrec', pswrem_duprec='$duprec' where pswrem_id='$tid'";
	$ascd=mysqli_query($link,$sql_main) or die(mysqli_error($link));
	//exit;
	return $cnt; 	
}

?>