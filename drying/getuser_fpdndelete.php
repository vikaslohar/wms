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
	if(isset($_GET['b']))
	{
 		$b = $_GET['b'];	 
	}
	if(isset($_GET['c']))
	{
		$c = $_GET['c'];	 
	}
	
$s_sub="delete from tbl_dryarrival_sub where arrsub_id='".$b."'";
mysqli_query($link,$s_sub) or die(mysqli_error($link));
$s_sub_sub="delete from tbl_dryarr_sloc where arr_id='".$b."'";
mysqli_query($link,$s_sub_sub) or die(mysqli_error($link));

$sql_t_sub=mysqli_query($link,"select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$a."'") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_t_sub);
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#adad11" style="border-collapse:collapse">
<?php
if($tot_sub > 0)
	$tid=$a;
else
	$tid=0;
?>

<?php

/*$sql_tbl=mysqli_query($link,"select * from tbl_dryarrival where plantcode='".$plantcode."' and arr_role='".$logid."' and arrival_type='Fresh Seed with PDN' and arrival_id='".$pid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);	*/	
$arrival_id=$tid;

$sqlarrsub=mysqli_query($link,"select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."'") or die(mysqli_error($link));
		$totarrsub=mysqli_num_rows($sqlarrsub);
		if($totarrsub > 0)
		{
		while($rowarrsub=mysqli_fetch_array($sqlarrsub))
		{		
			$crop11=$rowarrsub['lotcrop'];
			$variety11=$rowarrsub['lotvariety'];
			$vrnew11=$crop."-"."Coded";
			
			if($variety11!="" && $variety11==$vrnew11)
			{
				$sql_spcdec=mysqli_query($link,"select * from tblspcodes where  spcodef='".$rowarrsub['spcodef']."' and spcodem='".$rowarrsub['spcodem']."'") or die(mysqli_error($link));
				$tot_spcdec=mysqli_num_rows($sql_spcdec);
				if($tot_spcdec > 0)
				{
					$row_spcdec=mysqli_fetch_array($sql_spcdec);
					
					if($row_spcdec['variety']!="")
					{
						$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_spcdec['variety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
						$row_variety=mysqli_fetch_array($sql_veriety);
						$itemname=$row_variety['popularname'];	
						
						$sqltblarsub=mysqli_query($link,"update tbl_dryarrival_sub set lotvariety='$itemname' where arrival_id='".$arrival_id."' and arrsub_id='".$rowarrsub['arrsub_id']."'") or die(mysqli_error($link));	
					}
				}	
			}
		}
		}
$sql_tbl_sub=mysqli_query($link,"select * from tbl_dryarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."' order by arrsub_id") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;
?>
            <tr class="tblsubtitle" height="20">
  <td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    
    <td width="4%" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
    <td width="6%" align="center" rowspan="2" valign="middle" class="tblheading">Variety</td>
    <td width="4%" align="center" rowspan="2" valign="middle" class="tblheading">SPC-F</td>
    <td width="5%" align="center" rowspan="2" valign="middle" class="tblheading">SPC-M</td>
    <!--<td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Crop</td>
    <td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Variety</td>-->
	<td width="6%" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	 <td height="33" colspan="2" align="center" valign="middle" class="tblheading">PDN</td>
	 <td align="center" valign="middle" class="tblheading" colspan="2">Actual</td>
 <td align="center" valign="middle" class="tblheading" colspan="2">Difference</td>
 <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Stage</td>
	 	 <td align="center" valign="middle" class="tblheading" colspan="2">Preliminary QC</td>
		  <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">QC Status </td>	 
		   <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">GOT Status</td>
		 <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">Seed Status </td>
    <td width="5%" colspan="1" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
    <td width="8%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
 
  <tr class="tblsubtitle">
    <td width="3%" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
     <td width="4%" align="center" valign="middle" class="tblheading">NoB </td>
     <td width="4%" align="center" valign="middle" class="tblheading">Qty</td>
   <td width="4%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
	  <td width="7%" align="center" valign="middle" class="tblheading">Moist %</td>
      <td width="7%" align="center" valign="middle" class="tblheading">PP</td>
  </tr>
  <?php
 $quer_cn=mysqli_query($link,"SELECT * FROM tbl_parameters where plantcode='$plantcode' ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$dept1=$row_cls['pcity'];
		
	$tp1="";
			if($row_cls['pcity'] =="Gomchi") { $tp1="G";}
			else if($row_cls['pcity'] =="Hydrabad") { $tp1="H";}
						

$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl_sub);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['lotvariety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['lotvariety'].",";
	}

$dq=explode(".",$row_tbl_sub['qty']);
if($dq[1]==000){$dcq=$dq[0];}else{$dcq=$row_tbl_sub['qty'];}

$dcn=$row_tbl_sub['qty1'];

$aq=explode(".",$row_tbl_sub['act']);
if($aq[1]==000){$ac=$aq[0];}else{$ac=$row_tbl_sub['act'];}

$acn=$row_tbl_sub['act1'];

$diq=explode(".",$row_tbl_sub['diff']);
if($diq[1]==000){$difq=$diq[0];}else{$difq=$row_tbl_sub['diff'];}

$difn=$row_tbl_sub['diff1'];

if($row_tbl_sub['vchk']=="Acceptable")
{
$cc="ACC";
}
else if($row_tbl_sub['vchk']=="Not-Acceptable")
{
$cc="NAC";
}
/*$lotqry=mysqli_query($link,"select * from tbllotimp where    lotnumber='".$a."'");
$row= mysqli_fetch_array($lotqry)or die (mysqli_error($link));

  $lot=$row['lotcrop'];	
 $variety=$row['lotvariety'];
  $oldlot=$row['lotoldlot'];		


$sql_class=mysqli_query($link,"select * from tbl_classification where plantcode='".$plantcode."' and   classification_id='".$row_tbl_sub['classification_id']."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);

$sql_item=mysqli_query($link,"select * from tbl_stores where plantcode='".$plantcode."' and   items_id='".$row_tbl_sub['item_id']."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);
*/if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotcrop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotvariety'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodef'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodem'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
	   <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstage'];?></td>
	 <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['moisture'];?></td>
	  <td align="center" valign="middle" class="tbltext"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['qc'];?></td>
	 <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['got1'];?></td>

  
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tbl_dryarr_sloc where plantcode='".$plantcode."' and   arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbldrywarehouse where plantcode='".$plantcode."' and   whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbldrybin where plantcode='".$plantcode."' and   binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbldrysubbin where plantcode='".$plantcode."' and   sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>
  <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstatus'];?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
    <td width="4%" align="center" valign="middle" class="tbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="8%" align="center" valign="middle" class="tbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'Fresh Seed with PDN');" /></td>
  </tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotcrop'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotvariety'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodef'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['spcodem'];?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['lotno'];?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcn;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $dcq;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $acn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $ac;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difn;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $difq;?></td>
	<td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstage'];?></td>
	 <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['moisture'];?></td>
	  <td align="center" valign="middle" class="tbltext"><?php echo $cc;?></td>
    <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['qc'];?></td>
	 <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['got1'];?></td>

  
    <?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_sloc=mysqli_query($link,"select * from tbl_dryarr_sloc where plantcode='".$plantcode."' and   arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."' order by arrsloc_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbldrywarehouse where plantcode='".$plantcode."' and   whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbldrybin where plantcode='".$plantcode."' and   binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbldrysubbin where plantcode='".$plantcode."' and   sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$slups+$row_sloc['ups_good']+$row_sloc['ups_damage'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";
$slqty=$slqty+$row_sloc['qty']+$row_sloc['qty_damage'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

if($row_sloc['ups_good']!=0 && $row_sloc['ups_damage']==0)
$gd=$gd."G"."<br />";
else
$gd=$gd."D"."<br />";
}
?>
   <td align="center" valign="middle" class="tbltext"><?php echo $row_tbl_sub['sstatus'];?></td>
    <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
    <td width="4%" align="center" valign="middle" class="tbltext"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="8%" align="center" valign="middle" class="tbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'Fresh Seed with PDN');" /></td>
  </tr>
  <?php
}
$srno++;
}
}

?>
</table>
		  <br />
		  <table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11"  > 
<tr class="Dark" height="30">
<td align="right" width="204" valign="middle" class="tblheading" style="border-color:#adad11">&nbsp;Lot Number&nbsp;</td>
<td align="left" width="272" valign="middle" class="tbltext" style="border-color:#adad11">&nbsp;<input name="txtlot1" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"  value="" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();">&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
<td align="left" width="366" valign="middle" class="tblheading" style="border-color:#adad11">&nbsp;<a href="javascript:void(0);" onclick="getdetails();">Get details</a> &nbsp;(After selection of lot no. click on 'Get Details')</td>
</tr>

</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<div id="postingsubtable" style="display:block">
</div>
</div>
