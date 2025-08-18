<?php
	/*session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../../login.php' ";
	echo '</script>';
	}*/
	require_once("../../include/config.php");
	require_once("../../include/connection.php");
	
if(isset($_POST['frm_action'])=='submit')
{
}
?>
<link href="../../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
<?php 
		$sdate1 = $_REQUEST['sdate'];
		$qcti = $_REQUEST['qcti'];
		$rvalt = $_REQUEST['rvalt'];
		$cid = $_REQUEST['cid'];
		$itemid = $_REQUEST['itemid'];	
		
		if($qcti=="ut")$qti="UT";if($qcti=="rt")$qti="RT";if($qcti=="both")$qti="Both";
		if($rvalt=="all")$qtyp="All TIP";if($rvalt=="")$qtyp="All TIP";if($rvalt=="edorm")$qtyp="EDOR Matured";
		
	$quer_var=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$itemid."'"); 
	$row_var=mysqli_fetch_array($quer_var);
	 $tt_var=$row_var['popularname'];
	  $tot_var=mysqli_num_rows($quer_var);	
	 if($tot_var==0)
	 {
	 $vv_var=$itemid;
	 }
	 else
	 {
	  $vv_var=$tt_var;
	 }
		
    $quer_crp=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$cid."'"); 
	$row_crp=mysqli_fetch_array($quer_crp);
	$tot_crp=mysqli_num_rows($quer_crp);
	if($tot_crp==0)
	{
	$crp=$cid;
	}
	else
	{
	$crp=$row_crp['cropname'];
	}
		$tdate=$sdate1;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$sdate=$tyear."-".$tmonth."-".$tday;

if($cid=="ALL" && $itemid=="ALL")	
{
	if($qcti=="rt")
	{
		$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where qcstatus='RT' and  srdate <='$sdate' and qcflg=0 and state!='T' and plantcode='$plantcode' order by spdate asc ") or die(mysqli_error($link));
	}
	else if($qcti=="ut")
	{
		$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where qcstatus='UT' and srdate <='$sdate' and qcflg=0 and state!='T' and plantcode='$plantcode' order by spdate asc ") or die(mysqli_error($link));
	}
	else
	{
		$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where srdate <='$sdate' and qcflg=0 and state!='T' and plantcode='$plantcode' order by spdate asc ") or die(mysqli_error($link));
	}
}
else if($cid!="ALL" && $itemid=="ALL")	
{
	if($qcti=="rt")
	{
		$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where qcstatus='RT' and  srdate <= '$sdate' and crop='$cid' and qcflg=0 and state!='T' and plantcode='$plantcode' order by spdate asc ") or die(mysqli_error($link));
	}
	else if($qcti=="ut")
	{
		$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where qcstatus='UT' and srdate <= '$sdate' and  qcflg=0 and crop='$cid' and state!='T' and plantcode='$plantcode' order by spdate asc ") or die(mysqli_error($link));
	}
	else
	{
		$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where srdate <='$sdate' and crop='$cid' and qcflg=0 and state!='T' and plantcode='$plantcode' order by spdate asc ") or die(mysqli_error($link));
	}
}
else if($cid!="ALL" && $itemid!="ALL")	
{
	if($qcti=="rt")
	{
		$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where qcstatus='RT' and  srdate <= '$sdate' and crop='$cid' and variety='$itemid' and state!='T' and qcflg=0 and plantcode='$plantcode' order by spdate asc ") or die(mysqli_error($link));
	}
	else  if($qcti=="ut")
	{
		$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where qcstatus='UT' and srdate <= '$sdate' and qcflg=0 and crop='$cid' and variety='$itemid' and state!='T' and plantcode='$plantcode' order by spdate asc ") or die(mysqli_error($link));
	}
	else
	{
		$sql_arr_home=mysqli_query($link,"select distinct(sampleno) from tbl_qctest where srdate <='$sdate' and crop='$cid' and variety='$itemid' and qcflg=0 and state!='T' and plantcode='$plantcode' order by spdate asc ") or die(mysqli_error($link));
	}
}

$tot_arr_home=mysqli_num_rows($sql_arr_home);
?>
	 	 
<title>Quality-Report -QC Result Pending Report</title><table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="916" align="right">&nbsp;&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-underqc.php?sdate=<?php echo $sdate1;?>&qcti=<?php echo $qcti;?>&rvalt=<?php echo $rvalt;?>&cid=<?php echo $cid;?>&itemid=<?php echo $itemid;?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
<table align="center" border="0" cellspacing="0" cellpadding="0" width="750" style="border-collapse:collapse">
 <tr height="25" >
    <td align="center" class="subheading" style="color:#303918; ">QC Result Pending Report as on date: <?php echo $_GET['sdate'];?></td>
  	</tr>
  	<tr height="25">
    <td align="left" class="tblheading" style="color:#303918; ">&nbsp;&nbsp;Crop: <?php echo $crp;?>&nbsp;&nbsp;|&nbsp;&nbsp;Variety: <?php echo $vv_var;?>&nbsp;&nbsp;|&nbsp;&nbsp;QC Test Instance: <?php echo $qti;?>&nbsp;&nbsp;|&nbsp;&nbsp;Type: <?php echo $qtyp;?></td>
  	</tr>
</table>
  
    <table  border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse" align="center">
<tr class="tblsubtitle" height="25">
			<td width="17" align="center" valign="middle" class="tblheading">#</td>
			<td width="77"  align="center" valign="middle" class="tblheading">Crop</td>
			<td width="119"  align="center" valign="middle" class="tblheading">Variety</td>
			<td width="105"  align="center" valign="middle" class="tblheading">Lot No.</td>
			<td width="41"  align="center" valign="middle" class="tblheading">NoB</td>
			<td width="39"  align="center" valign="middle" class="tblheading">Qty</td>
			<td width="61" align="center" valign="middle" class="tblheading">QC Status</td>
			<td width="68" align="center" valign="middle" class="tblheading">DOSR</td>
			<td width="65" align="center" valign="middle" class="tblheading">DOSC </td>
		    <td width="64" align="center" valign="middle" class="tblheading">EDOR</td>
			<td width="70" align="center" valign="middle" class="tblheading">Sample No.</td>
</tr>

<?php
$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home2=mysqli_fetch_array($sql_arr_home))
{

if($cid!="ALL" && $itemid=="ALL")	
{
	$sql_arr_home2=mysqli_query($link,"select MAX(tid) from tbl_qctest where sampleno='".$row_arr_home2['sampleno']."' and qcflg=0 and state!='T' and crop='$cid' and plantcode='$plantcode' order by tid desc ") or die(mysqli_error($link));
}
else if($cid!="ALL" && $itemid!="ALL")	
{
	$sql_arr_home2=mysqli_query($link,"select MAX(tid) from tbl_qctest where sampleno='".$row_arr_home2['sampleno']."' and qcflg=0 and state!='T' and crop='$cid' and variety='$itemid' and plantcode='$plantcode' order by tid desc ") or die(mysqli_error($link));
}
else
{
	$sql_arr_home2=mysqli_query($link,"select MAX(tid) from tbl_qctest where sampleno='".$row_arr_home2['sampleno']."' and qcflg=0 and state!='T' and plantcode='$plantcode' order by tid desc ") or die(mysqli_error($link));
}	
$row_arr_home3=mysqli_fetch_array($sql_arr_home2);

$sql_arr_home3=mysqli_query($link,"select * from tbl_qctest where tid ='".$row_arr_home3[0]."' and sampleno='".$row_arr_home2['sampleno']."' and qcflg=0 and state!='T' and plantcode='$plantcode' order by spdate asc ") or die(mysqli_error($link));
while($row_arr_home=mysqli_fetch_array($sql_arr_home3))
{
	$flgg=0;
	$trdate=$row_arr_home['spdate'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	if($trdate=="" || $trdate=="--")$trdate="";


	$trdate1=$row_arr_home['srdate'];
	$tryear1=substr($trdate1,0,4);
	$trmonth1=substr($trdate1,5,2);
	$trday1=substr($trdate1,8,2);
	$trdate1=$trday1."-".$trmonth1."-".$tryear1;
	
	if($trdate1=="" || $trdate1=="--")$trdate1="";
	
	$trdatet=$row_arr_home['testdate'];
	$tryeart=substr($trdatet,0,4);
	$trmontht=substr($trdatet,5,2);
	$trdayt=substr($trdatet,8,2);
	$trdatet=$trdayt."-".$trmontht."-".$tryeart;
	
	if($trdatet=="" || $trdatet=="--")$trdatet="";
			
	$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['tid'];
	 $lotno=$row_arr_home['lotno'];
	$sstatus=$row_arr_home['qcstatus'];
	if($sstatus=="")$sstatus="UT";
	
	$slqty=0; $slups=0;
	 $sql_sloc=mysqli_query($link,"select lotldg_subbinid from tbl_lot_ldg where lotldg_lotno='$lotno' and lotldg_trdate<='".$sdate."'  and plantcode='$plantcode' group by lotldg_subbinid order by lotldg_lotno") or die(mysqli_error($link));
	 $tot=mysqli_num_rows($sql_sloc);
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$sql_sloc1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where lotldg_subbinid='".$row_sloc['lotldg_subbinid']."' and lotldg_lotno='$lotno' and lotldg_trdate<='".$sdate."' and plantcode='$plantcode' order by lotldg_lotno ") or die(mysqli_error($link));
	$row_sloc1=mysqli_fetch_array($sql_sloc1);
	$tot1=mysqli_num_rows($sql_sloc1);
	if($tot1 > 0)
	{
	$sql_sloc2=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_sloc1[0]."' and plantcode='$plantcode'") or die(mysqli_error($link));
	while($row_sloc2=mysqli_fetch_array($sql_sloc2))
	{
	$slqty=$slqty+$row_sloc2['lotldg_balqty'];
	$slups=$slups+$row_sloc2['lotldg_balbags'];
	}
	}
	}
	

$aq=explode(".",$slqty);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$slqty;}

$an=explode(".",$slups);
if($an[1]==000){$acn=$an[0];}else{$acn=$slups;}

		
		if($crop!="")
		{
		$crop=$crop."<br>".$row_arr_home['crop'];
		
		}
		else
		{
		$crop=$row_arr_home['crop'];
		}
		if($variety!="")
		{
		$variety=$variety."<br>".$row_arr_home['variety'];
		}
		else
		{
		$variety=$row_arr_home['variety'];	
		}
		
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
		if($qc!="")
		{
		$qc=$qc."<br>".$row_arr_home['qc'];
		}
		else
		{
		$qc=$row_arr_home['qc'];
		}
		if($got!="")
		{
		$got=$got."<br>".$row_arr_home['got'];
		}
		else
		{
		$got=$row_arr_home['got'];
		}
		if($stage!="")
		{
		$stage=$stage."<br>".$row_arr_home['sstage'];
		}
		else
		{
		$stage=$row_arr_home['sstage'];
		}
		if($per!="")
		{
		$per=$per."<br>".$row_arr_home['pper'];
		}
		else
		{
		$per=$row_arr_home['pper'];
		}
		if($loc1!="")
		{
		$loc1=$loc1."<br>".$row_arr_home['ploc'];
		}
		else
		{
		$loc1=$row_arr_home['ploc'];
		}
		
		
	
	$dt=""; $dt1=date("Y-m-d"); 
	$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_arr_home['variety']."'"); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_arr_home['variety'];
	 	$quer333=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
		$row313=mysqli_fetch_array($quer333);
		$m= date("m");
		$de= date("d");
		$y= date("Y");
		$dt=$row313['expdt'];
		for($i=0; $i<=$dt; $i++) { $dt1=date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y)); } 
	 }
	 else
	 {
	  $vv=$tt;
		$m= date("m");
		$de= date("d");
		$y= date("Y");
		$dt=$rowvv['expdt'];
		for($i=0; $i<=$dt; $i++) { $dt1=date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y)); } 
	  }
	if($dt==0) $dt="";
		
    $quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_arr_home['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
	
	
$rflg=0;$dt2="";$dt22="";
if($qcti=="rt")
{
	$rflg=1; 
	if($dt1!="")
	{
		$m=$trmontht;
		$de=$trdayt;
		$y=$tryeart;
		$dt22=$dt;
		if($dt!="")
		{
			for($i=0; $i<=$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y)); } 
		}
		else
		$dt2="";
	}
	else
	$dt2="";
}
else if($qcti=="ut" && $rvalt=="all")
{
		$rflg=1; 
		if($dt1!="")
		{
				$m=$trmonth;
				$de=$trday;
				$y=$tryear;
				$dt22=$dt;
				if($dt!="")
				{
				for($i=0; $i<=$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y)); } 
				}
				else
				$dt2="";
		}
		else
		$dt2="";
}
else if($qcti=="ut" && $rvalt=="edorm")
{
		if($dt1!="")
		{
				$m=$trmonth;
				$de=$trday;
				$y=$tryear;
				$dt22=$dt;
				if($dt!="")
				{
				for($i=0; $i<=$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y)); } 
				}
				else
				$dt2="";
		}
		else
		$dt2="";
	if($dt2!="" && $row_arr_home['spdate']<=$dt2)
	{ 
	$rflg=1;
	}
}
else if($qcti=="both" && $rvalt=="all")
{
	if($row_arr_home['qcstatus']=="RT")
	{
		$rflg=1; 
		if($dt1!="")
		{
				$m=$trmontht;
				$de=$trdayt;
				$y=$tryeart;
				$dt22=$dt;
				if($dt!="")
				{
				for($i=0; $i<=$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y)); } 
				}
				else
				$dt2="";
		}
		else
		$dt2="";
	}
	else
	{
		$rflg=1; 
		if($dt1!="")
		{
				$m=$trmonth;
				$de=$trday;
				$y=$tryear;
				$dt22=$dt;
				if($dt!="")
				{
				for($i=0; $i<=$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y)); } 
				}
				else
				$dt2="";
		}
		else
		$dt2="";
	}
}
else if($qcti=="both" && $rvalt=="edorm")
{ 
	if($row_arr_home['qcstatus']=="RT")
	{
		
			if($dt1!="")
			{ 
				$m=$trmontht;
				$de=$trdayt;
				$y=$tryeart;
				$dt22=$dt;
				if($dt!="")
				{
				for($i=0; $i<=$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y)); } 
				}
				else
				$dt2="";
			}
			else
			$dt2="";
		if($dt2!="" && $row_arr_home['testdate']<=$dt2)
		{ 
		$rflg=1;	
		} 
	}
	else
	{
		
			if($dt1!="")
			{
				$m=$trmonth;
				$de=$trday;
				$y=$tryear;
				$dt22=$dt;
				if($dt!="")
				{
				for($i=0; $i<=$dt22; $i++) { $dt2=date('Y-m-d',mktime(0,0,0,$m,($de+$i),$y)); } 
				}
				else
				$dt2="";
			}
			else
			$dt2="";
			
		if($dt2!="" && $row_arr_home['spdate']<=$dt2)
		{
		$rflg=1;	
		}
	}
}
$d=date("Y-m-d");
if(($trdate=="" || $trdate=="--") || ($rvalt=="edorm" && $dt2>=$d))$rflg=0;
	$trdate12=$dt2;
	$tryear12=substr($trdate12,0,4);
	$trmonth12=substr($trdate12,5,2);
	$trday12=substr($trdate12,8,2);
	$trdate12=$trday12."-".$trmonth12."-".$tryear12;
	
	if($trdate12=="" || $trdate12=="--")$trdate12="";
	if($trdate=="")$trdate12="";
			
	$sql_param=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code']; $qc1=$row_arr_home['sampleno'];

if($sstatus=="UT" && $trdatet!="")
$flgg++;
if($rflg > 0)
{ 
if($flgg==0)
{
	if($srno%2!=0)
{

?>
	  

<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			  <td width="77" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="119" align="center" valign="middle" class="tblheading"><?php echo $vv?></td>
		 <td width="105" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="41" align="center" valign="middle" class="tblheading"><?php echo $slups?></td>
         <td width="39" align="center" valign="middle" class="tblheading"><?php echo $slqty?></td>
         <td width="61" align="center" valign="middle" class="tblheading"><?php echo $sstatus;?></td>
         <td width="68" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td width="65" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="64" align="center" valign="middle" class="tblheading"><?php echo $trdate12;?></td>
         <td width="70" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $yearid_id?><?php echo sprintf("%000006d",$qc1);?></td>
</tr
>
<?php
}
else
{
?>
<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
			  <td width="77" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname']?></td>
         <td width="119" align="center" valign="middle" class="tblheading"><?php echo $vv?></td>
		 <td width="105" align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
         <td width="41" align="center" valign="middle" class="tblheading"><?php echo $slups?></td>
         <td width="39" align="center" valign="middle" class="tblheading"><?php echo $slqty?></td>
         <td width="61" align="center" valign="middle" class="tblheading"><?php echo $sstatus;?></td>
         <td width="68" align="center" valign="middle" class="tblheading"><?php echo $trdate1;?></td>
         <td width="65" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
         <td width="64" align="center" valign="middle" class="tblheading"><?php echo $trdate12;?></td>
         <td width="70" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $yearid_id?><?php echo sprintf("%000006d",$qc1);?></td>
</tr
>
<?php
}
$srno=$srno+1;
}
}
}
}
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="700" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found for selected Period</td></tr>
  </table>
<?php
}

?>
</table>			
  <br/>
<table width="750" border="0" cellpadding="0" cellspacing="0" bordercolor="#ffffff" style="border-collapse:collapse" align="center">
<tr >
<td width="916" align="right">&nbsp;&nbsp;&nbsp;<img src="../../images/Vista-printer.png" border="0" class="butn" height="29" width="35" alt="Print" style="display:inline;cursor:pointer;" onclick="javascript:window.print();" />&nbsp;&nbsp;<a href="excel-underqc.php?sdate=<?php echo $sdate1;?>&qcti=<?php echo $qcti;?>&rvalt=<?php echo $rvalt;?>&cid=<?php echo $cid;?>&itemid=<?php echo $itemid;?>" target="_blank"><img src="../../images/excelicon1.jpg" border="0" height="30" width="30" class="butn" alt="Export to Excel" style="display:inline;cursor:pointer;" /></a>&nbsp;<img src="../../images/close_icon2.jpg" border="0" class="butn" height="30"  alt="Close" style="display:inline;cursor:pointer;" onClick="window.close()" /></td>
</tr>
</table>
