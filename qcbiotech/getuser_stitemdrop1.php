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
	}require_once("../include/config.php");
	require_once("../include/connection.php");

if(isset($_GET['a']))
	{
 $a = $_GET['a'];	 
	}
if(isset($_GET['b']))
	{
	$b = $_GET['b'];	 
	}
if(isset($_GET['c']))
	{
	$c = $_GET['c'];	 
	}
	
	
	//if($a==1)
	//{
	//$a=13;
	//}
//$flag=0; 
 //$a;

//$sap=$tp1"."$yearid_id/00000"."$qc1;
	$tdate=$e;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
		 $tdate11=$ee1;
		$tday1=substr($tdate11,0,2);
		$tmonth1=substr($tdate11,3,2);
		$tyear1=substr($tdate11,6,4);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;	  

	
//$row_month=mysqli_fetch_array($sql_month);
$tt=mysqli_num_rows($sql_month);

/*/*<table align="center" border="1" cellspacing="0" cellpadding="0" width="574" bordercolor="#F1B01E" style="border-collapse:collapse">

                <tr class="Light" height="25">
	<td width="191" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left" width="377" valign="middle" class="tbltext" id="vitem" colspan="3">&nbsp;<input name="txtvariety" class="tbltext" id="itm"  style="width:170px;background-color:#CCCCCC" size="30" maxlength="30" readonly="true" value="<?php echo $variety;?>" ></td>
                </tr>
</table>*/




//}
?>