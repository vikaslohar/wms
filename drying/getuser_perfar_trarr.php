<?php
session_start();
	require_once("../include/config.php");
	require_once("../include/connection.php");

$q=$_GET["a"];

/*$sql="SELECT * FROM tblproductionpersonnel WHERE productionlocationid = '".$q."'";

$result = mysqli_query($link,$sql);*/
//$row = mysqli_fetch_array($result);
?>&nbsp;<select class="tbltext" name="txtfar" style="width:190px;" tabindex="19" >
        
        <option value="" selected="selected">--Select Farmer--</option>
       <?php
	   $sql_f="select * from tblfarmer order by farmername"; 
		$res_f=mysqli_query($link,$sql_f)or die (mysqli_error($link));
		$co=0;
		
		while($row_f=mysqli_fetch_array($res_f))
	{
			$p_array=explode(";",$row_f['productionpersonnelid']);
			$k=0;
			$p=array();
			
			foreach($p_array as $val)
				{
				if($val <> "")
				{
				if($val==$q)
				//if($val==$_REQUEST['productionpersonnelid'])
				{ 
					$sql_r="select farmerid,farmername from tblfarmer where farmerid =".$row_f['farmerid']; 
					$res_r=mysqli_query($link,$sql_r) or die (mysqli_error($link));
					$row_r = mysqli_fetch_array($res_r);	
					?> <option value="<?php echo $row_r['farmerid'];?>" />       
		<?php echo $row_r['farmername'];?> 	
			<?php	
				//$co++;
				}
				}
				}
	} //echo $co;
	   
	   
	   
	   
	   
	   
	 /*  $sql = "select * from tblfarmer where production[ersonnelid";
	   $re = mysqli_query($link,$sql);
	   while($row = mysqli_fetch_array($re))
	   {
	  ?>
	   <option value="<?php echo $row['productionlocationid'];?>" />      
		<?php echo $row['productionlocation'];?> 
		<?php } ?>*/
	  
	   ?>
	</select>

	  
   