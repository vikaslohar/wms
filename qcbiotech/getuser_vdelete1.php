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
	//$logid="OP1";
	require_once("../include/config.php");
	require_once("../include/connection.php");


   	if(isset($_GET['a']))
	{
    $fet= $_GET['a'];	 
	}
	if(isset($_GET['b']))
	{
   $fet1= $_GET['b'];	 
	}
	
	$x=explode(",",$fet1);
	foreach($x as $key => $value) 
	{
      if ($value == $fet) unset($x[$key]);
    }
	array_values($x);
	$qcs=implode(",",$x);
	
/*$s_sub="delete from tbl_qctest where tid='".$a."'";
mysqli_query($link,$s_sub) or die(mysqli_error($link));*/
$sql_arr_home=mysqli_query($link,"select * from tbl_qctest where aflg=0 and bflg=1  and cflg=0  order by sampleno desc") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);
// $qcs;
?>
 

<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="23" height="19"align="center" valign="middle" class="tblheading">#</td>
			   <td width="68" align="center" valign="middle" class="tblheading">DOSR</td>
			    <td width="68" align="center" valign="middle" class="tblheading">DOSC</td>
			   <td width="118" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="139" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="105" align="center" valign="middle" class="tblheading">Lot No.</td> 
			  <td width="60" align="center" valign="middle" class="tblheading">Stage</td>
			  <td width="48" align="center" valign="middle" class="tblheading">QC Tests </td>
			    <td align="center" valign="middle" class="tblheading">Sample No. </td>
           
				 <td width="38" align="center" valign="middle" class="tblheading">Delete</td>
              </tr>
<?php
$srno=1;
if($tot_arr_home > 0)
{

while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{

$p_array=explode(",",$qcs);
			foreach($p_array as $val)
				{
				if($val <> "")
				{
				if($val==$row_arr_home['tid'])
					{ 	
					
	$trdate=$row_arr_home['srdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$trdate1=$row_arr_home['spdate'];
	$tryear=substr($trdate1,0,4);
	$trmonth=substr($trdate1,5,2);
	$trday=substr($trdate1,8,2);
	$trdate1=$trday."-".$trmonth."-".$tryear;		
	
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	$qc1=$row_arr_home['sampleno'];
		$crop=""; $variety=""; $lotno=""; $bags=""; $qty=""; $stage=""; $got=""; $qc="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_qctest where tid='".$arrival_id."'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub1=mysqli_fetch_array($sql_tbl_sub))
	{			
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub1['lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub1['lotno'];
		}

	
	$lrole=$row_arr_home['arr_role'];
	$quer3=mysqli_query($link,"SELECT business_name from tbl_partymaser  where p_id='".$row_arr_home['party_id']."'"); 
	$row3=mysqli_fetch_array($quer3);
	
		$quer3=mysqli_query($link,"SELECT * from tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	$quer3=mysqli_query($link,"SELECT * from tblvariety where varietyid ='".$row_arr_home['variety']."' and actstatus='Active'"); 
	$row=mysqli_fetch_array($quer3);
	 $tt=$row['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl_sub1['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }

	 
	$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lotno."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
//$lotldg_trid=$row_tbl['lotldg_trid'];
$stage=$row_tbl_sub1['trstage'];
$pp=$row_tbl_sub1['state'];	
$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl['lotldg_balbags'];}

$an=explode(".",$row_tbl_sub['act1']);
if($an[1]==000){$acn=$an[0];}else{$acn=$row_tbl['lotldg_balqty'];}
if($bags!="")
		{
		$bags=$bags."<br>".$acn;
		}
		else
		{
		$bags=$acn;
		}
		if($qty!="")
		{
		$qty=$qty."<br>".$ac;
		}
		else
		{
		$qty=$ac;
		}


}
	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="23" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="68" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
		   <td width="68" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td width="118" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="105" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 	<td width="60" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
		 	<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		  <td width="80" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
   <td width="43" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec('<?php echo $val?>','<?php echo $qcs?>');" /></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="23" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="68" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
		   <td width="68" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td width="118" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
          <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
         <td width="105" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
		 	<td width="60" align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
		 	<td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
		  <td width="80" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $row_arr_home['yearid']?><?php echo sprintf("%000006d",$qc1);?></td>
	 <td width="43" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec('<?php echo $val?>','<?php echo $qcs?>');" /></td>
</tr>
<?php
}
$srno=$srno+1;
}}}
}
}

?>
    	    </table> <input type="hidden" name="fet" value="<?php echo $qcs?>" />  
