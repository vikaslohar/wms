<?php
 set_time_limit(0);
 function excelDateToDate($readDate){
				$phpexcepDate = $readDate-25569; //to offset to Unix epoch
				return strtotime("+$phpexcepDate days", mktime(0,0,0,1,1,1970));
			}
 function insertdata($xlsfilepath)
 {
	$data = new Spreadsheet_Excel_Reader(); // instantiate the object
	$data->setOutputEncoding('CP-1251'); // select output encoding
	$data->read($xlsfilepath); // specify the file to read
	/* We start reading the file from row 4 because that's where the   data in the table starts */
	$startRow = 2; 
	/* Get all the cells of the sheet */
	$dt=date("Y-m-d");
	$cnt=0;
	$cells = $data->sheets[0]['cells'];
		for ($i = $startRow; $i <= $data->sheets[0]['numRows']; $i++)  
		{
			for ($j = 1 ; $j <= $data->sheets[0]['numCols']; $j++) 
			{
			$archu[0][$j]=$data->sheets[0]['cells'][$i][$j];
			}
			/*$UNIX_DATE = ($archu[0][1] - 25569) * 86400;
			$exldate=gmdate("d-m-Y", $UNIX_DATE);
			$day_month_array=explode("-",$exldate);*/
			//print_r($day_month_array);
			
			//$cut_year=explode("-",$periodfrom);
			
			//$year=$cut_year[0];
			//$month=$cut_year[1];
			//$day=$cut_year[2];
			
			
			
			//echo excelDateToDate($archu[0][1])." ";
			
			//$final_date=$day_month_array[2]."-".$day_month_array[1]."-".$day_month_array[0];
			//$tablename='tbltransaction'.$year;
			//code to create table
			set_time_limit(120);
			
			//coding to create table
			
			/*$result_tbl = mysqli_query($link,"SHOW TABLES FROM crams"); 
			$tables = array(); 
			while ($row = mysqli_fetch_row($result_tbl)) { 
			$tables[] = $row[0]; 
			
			
			} 
			$array = array_search($tablename,$tables);
			
			if(strlen($array) >0 && $array >=0 )	
			{
			$query="CREATE TABLE '".$tablename."' (
			id int(3) unsigned NOT NULL auto_increment,
			pid int(10) unsigned NOT NULL default '0',
			empid int(10) unsigned NOT NULL default '0',
			xlsfiledate date default NULL,
			calldate date default NULL,
			starttime varchar(50) default NULL,
			contact_no varchar(20) default NULL,
			duration varchar(50) default NULL,
			callunits varchar(50) default NULL,
			charges varchar(70) default NULL,
			drflag varchar(10) default NULL,
			PRIMARY KEY  (id)
			) TYPE=MyISAM;
			";
			$result=mysqli_query($link,$query);
			}
			else
			{
			
			}
			*/
			$cr="";$var="";
			//code to check to avoid the dublication of records 
			/*$strdublicate=mysqli_query($link,"select * from tblspctmp where spcodeft='". $archu[0][2]."' and spcodemt='". $archu[0][3]."'");
			$numofrecords=mysqli_num_rows($strdublicate);
			if($numofrecords > 0 )
			{
			//echo "Record Found"."<br>";	
			}
			else 
			{*/
			$str="insert into tblspctmp (spcodeft, spcodemt, altdatet, cropt, varietyt, altflagt) values('". $archu[0][2]."', '".$archu[0][3]."', '".$dt."', '".$archu[0][4]."', '".$archu[0][5]."', 2)";
			//echo $str."<br>";
			$result=mysqli_query($link,$str) or die("Error:".mysqli_error($link));
			$cnt++;
			// } end else
		}  // end for
	/*if($cnt > 0)
	{
		$sql_code="SELECT MAX(scode) FROM tblspdec ORDER BY scode DESC";
		$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
			{
				$row_code=mysqli_fetch_row($res_code);
				$t_code=$row_code['0'];
				$code=$t_code+1;
			}
			else
			{
				$code=1;
			}
			
			$sql_code2="SELECT MAX(spcdeccode) FROM tblspdec ORDER BY spcdeccode DESC";
			$res_code2=mysqli_query($link,$sql_code2)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code2) > 0)
			{
				$row_code2=mysqli_fetch_row($res_code2);
				$t_code2=$row_code2['0'];
				$code2=$t_code2+1;
			}
			else
			{
				$code2=1;
			}
			$str1="insert into tblspdec (spdecdate, spdectype, spdectflg, scode, spcdeccode) values('$dt', 'DE','1', '".$code."', '".$code2."')";
			//echo $str1."<br>";
			if(mysqli_query($link,$str1) or die("Error:".mysqli_error($link)))
			{
			$id=mysqli_insert_id($link); 
			$str2="update tblspcodes set spdecid=$id, altflag=0 where altflag=2";
			//echo $str2."<br>";
			$result2=mysqli_query($link,$str2) or die("Error:".mysqli_error($link));
			}
	}
	else
	{
	echo "Records Found Already";
	}*/
}
?>