<?php
	session_start();
	require_once("config.php");
	require_once("connection.php");
	
	if(isset($_GET['print']))
	{
	$print = $_GET['print'];
	$code = $_GET['code'];
	}
	
	if(isset($_GET['id']))
	{
	$id = $_GET['id'];
	}
	$ccnt=0;
	$sql_v2=mysqli_query($link,"select sid from tbl_subbin where binid='".$code."' order by sid asc")or die(mysqli_error($link));
  	$row_v2=mysqli_num_rows($sql_v2);
	while($num_v2=mysqli_fetch_array($sql_v2))
	{
		$sql_tbl_sub=mysqli_query($link,"select distinct(lotldg_lotno) from tbl_lot_ldg where lotldg_subbinid='".$num_v2['sid']."' order by lotldg_subbinid asc")or die(mysqli_error($link));
		$x=mysqli_num_rows($sql_tbl_sub);
		if($x > 0)
		{
			while($row_is=mysqli_fetch_array($sql_tbl_sub))
			{ 
				$sql_is1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$num_v2['sid']."' and lotldg_lotno='".$row_is['lotldg_lotno']."' order by lotldg_id desc ") or die(mysqli_error($link));
				$z=mysqli_num_rows($sql_is1);
				if($z > 0)
				{
					$row_is1=mysqli_fetch_array($sql_is1); 
					
					$sql_istbl=mysqli_query($link,"select lotldg_balqty from tbl_lot_ldg where lotldg_id='".$row_is1[0]."' order by lotldg_id desc") or die(mysqli_error($link)); 
					$t=mysqli_num_rows($sql_istbl);
					if($t > 0)
					{
						$row_istbl=mysqli_fetch_array($sql_istbl);
						if($row_istbl['lotldg_balqty'] > 0)
						{$ccnt++;}
					}
				}
			}
		}
	}
if($ccnt==0)
{ ?>
<script language="javascript" type="text/javascript">
window.location='../include/delete.php?print=bin&code='+<?php echo $code;?>+'&id='+<?php echo $id?>;
</script>
<?php exit; } else { ?>
<script language="javascript" type="text/javascript">
alert('Cannot delete Bin Records are present under this Bin');
window.location='../Masters/bin_home.php?whid='+<?php echo $id?>;
</script>
<?php exit; } ?>