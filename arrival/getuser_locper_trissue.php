<?php
	//session_start();
	require_once("../include/config.php");
	require_once("../include/connection.php");

$q=$_GET["a"];

$sql="select * from tblproductionpersonnel order by productionpersonnelid";
//$sql="SELECT * FROM tblproductionpersonnel WHERE productionlocationid = '".$q."' order by productionpersonnel";

$result = mysqli_query($link,$sql);
$w = mysqli_num_rows($result);
?>&nbsp;<select class="tbltext" name="txtprod" style="width:190px;" tabindex="19" onChange="farm(this.value)">
        <option value="" selected="selected">--Select Personnel--</option>
        <?php
		 while($row = mysqli_fetch_array($result))
	   { 
			$p1_array=explode(";",$row['productionlocationid']);
			$i=0;
			$p1=array();
			
			foreach($p1_array as $val1)
		{ 
				 if($val1<>"")
			 {
				if($val1==$q)
				{ 
					$sql_r="select productionpersonnelid, productionpersonnel from tblproductionpersonnel where productionpersonnelid =".$row['productionpersonnelid']; 
					$res_r=mysqli_query($link,$sql_r) or die (mysqli_error($link));
					$row_r = mysqli_fetch_array($res_r);	
				?>
	   <option value="<?php echo $row_r['productionpersonnelid'];?>" />      
		<?php echo $row_r['productionpersonnel'];?> 
			<?php  }
			}
		}
	}
				 ?>
	  
      </select>