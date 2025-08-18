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

if(isset($_GET['a']))
{
	$a = $_GET['a'];	 
}
$srn=0;	
if($a!='')
{
	
	$cd1='R'; $cd2='C';
	
	if(date("Y")==$year1)$yer2=$year1;
	if(date("Y")==$year2)$yer2=$year2;
	
	$sql_lgenyr=mysqli_query($link,"select * from tbl_lgenyear where lgenyear='".$yer2."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$row_lgenyr=mysqli_fetch_array($sql_lgenyr);
	$yer=$row_lgenyr['lgenyearcode'];
	if($yer=="")$yer=$yearid_id;
	
	$quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
	$row_cls=mysqli_fetch_array($quer_cn);
	$tp1=$row_cls['code'];
	
	$sql_lotm=mysqli_query($link,"SELECT MAX(lotmgen_lot) FROM tbl_lotmgen  where lotmgen_yearcode='$yer' and plantcode='$plantcode' ORDER BY lotmgen_yearcode DESC") or die(mysqli_error($link));
	$tot_lotm=mysqli_num_rows($sql_lotm);
	$tm_code=0;
	if($tot_lotm > 0)
	{
		$row_lotm=mysqli_fetch_array($sql_lotm);
		$tm_code=$row_lotm['0'];
		if($tm_code > 0)
		$lot_code=$tm_code;
		else
		$lot_code=90000;
	}
	else
	{
		$lot_code=90000;
	}
	

	
?><table align="center" border="1" cellspacing="0" cellpadding="0" width="550" bordercolor="#2e81c1" style="border-collapse:collapse">
<tr class="tblsubtitle" height="20">
<td align="center" valign="middle" class="smalltblheading">#</td>
<td align="center" valign="middle" class="smalltblheading">Stage</td>
<td align="center" valign="middle" class="smalltblheading">Lot numbers</td>
</tr>
<?php
	if($lot_code!="")
	{
		$ltn=$lot_code;
		if($a=='Raw' || $a=='Both')
		{
			for($i=1; $i<=5; $i++)
			{
				$ltn=$ltn+1;
				$lotnonew=$tp1.$yer.$ltn."/00000/00".$cd1;
				$lotnoornew=$tp1.$yer.$ltn."/00000/00";
				$srn++;
?>				
<tr class="Light" height="20">
<td align="center" valign="middle" class="smalltblheading"><?php echo $i; ?></td>
<td align="center" valign="middle" class="smalltblheading">Raw</td>
<td align="center" valign="middle" class="smalltblheading"><?php echo $lotnonew; ?></td>
</tr>	
<?php
			}
		}
		if($a=='Condition' || $a=='Both')
		{
			for($i=1; $i<=5; $i++)
			{
				$ltn=$ltn+1;
				$lotnonew=$tp1.$yer.$ltn."/00000/00".$cd2;
				$lotnoornew=$tp1.$yer.$ltn."/00000/00";
				$srn++;
?>	
<tr class="Light" height="20">
<td align="center" valign="middle" class="smalltblheading"><?php echo $i; ?></td>
<td align="center" valign="middle" class="smalltblheading">Condition</td>
<td align="center" valign="middle" class="smalltblheading"><?php echo $lotnonew; ?></td>
</tr>	
<?php
			}
		}
?>		
</table>
<?php
	}
}
?>
<input name="srn"  type="hidden" value="<?php echo $srn; ?>" />