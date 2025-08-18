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

if(isset($_GET['o']))
{
	$srval = $_GET['o'];	 
}


if($srval!="")
{
?>


<?php
$mainids='';
 $sql_arr_home=mysqli_query($link,"select distinct pnpslipmain_id from tbl_pnpslipsub where pnpslipsub_lotno LIKE '$srval%'") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);
while($row_maintbl=mysqli_fetch_array($sql_arr_home))
{
if($mainids!="")
{$mainids=$mainids.",".$row_maintbl[0];}
else
{$mainids=$row_maintbl[0];}
}
if($mainids!='')	
{
$sql_arr_home1=mysqli_query($link,"select * from tbl_pnpslipmain where pnpslipmain_ttype='Processing and Packing Slip' and pnpslipmain_tflag=2 and plantcode='$plantcode' and pnpslipmain_trtype='fc' and pnpslipmain_id IN ($mainids) order by pnpslipmain_tcode desc") or die(mysqli_error($link));
}
else
{
$sql_arr_home1=mysqli_query($link,"select * from tbl_pnpslipmain where pnpslipmain_ttype='Processing and Packing Slip' and pnpslipmain_tflag=2 and plantcode='$plantcode' and pnpslipmain_trtype='fc' order by pnpslipmain_tcode desc") or die(mysqli_error($link));

}
$tot_arr_home1=mysqli_num_rows($sql_arr_home1);


   ?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#adad11" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="17" rowspan="2"align="center" valign="middle" class="smalltblheading">#</td>
	<td width="76" rowspan="2" align="center" valign="middle" class="smalltblheading">Transaction Id</td>
	<td width="76" rowspan="2" align="center" valign="middle" class="smalltblheading">MTN No.</td>
	<td width="75" rowspan="2" align="center" valign="middle" class="smalltblheading">Date</td>
	<td width="100" rowspan="2" align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="130" rowspan="2" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="100" rowspan="2" align="center" valign="middle" class="smalltblheading">Lot No.</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Existing</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Conditioned</td>
	<td width="45" rowspan="2" align="center" valign="middle" class="smalltblheading">RM</td>
	<td width="45" rowspan="2" align="center" valign="middle" class="smalltblheading">IM</td>
	<td width="45" rowspan="2" align="center" valign="middle" class="smalltblheading">PL</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Total C. Loss</td>
	<td width="45" rowspan="2" align="center" valign="middle" class="tblheading">Pack Details</td>
	<td width="45" rowspan="2" align="center" valign="middle" class="tblheading">Processing Finalize</td>
</tr>
<tr class="tblsubtitle" height="20">
	<td width="45" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="60" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="45" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="60" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="50" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="45" align="center" valign="middle" class="smalltblheading">%</td>
</tr>
<?php
//$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home1))
{
	$trdate=$row_arr_home['pnpslipmain_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$lrole=$row_arr_home['logid'];
		
	$arrival_id=$row_arr_home['pnpslipmain_id'];
	$mtnno=$row_arr_home['pnpslipmain_mtnno'];
	
	$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_arr_home['pnpslipmain_crop']."' order by cropname Asc");
	$noticia = mysqli_fetch_array($quer3);
	$crop=$noticia['cropname'];
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr_home['pnpslipmain_variety']."'  order by popularname Asc"); 
	$noticia_item = mysqli_fetch_array($quer4);
	$variety=$noticia_item['popularname'];
	//echo $arrival_id;
	$lotno=""; $bags1=""; $qty1=""; $bags2=""; $qty2=""; $rm=""; $im=""; $pl=""; $tpl=""; $tplper="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_pnpslipsub where pnpslipmain_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
//echo $row_tbl_sub['pnpslipsub_pqty'];
$aq=explode(".",$row_tbl_sub['pnpslipsub_pnob']);
if($aq[1]==000){$onob=$aq[0];}else{$onob=$row_tbl_sub['pnpslipsub_pnob'];}

$an=explode(".",$row_tbl_sub['pnpslipsub_pqty']);
if($an[1]==000){$oqty=$an[0];}else{$oqty=$row_tbl_sub['pnpslipsub_pqty'];}

$aq2=explode(".",$row_tbl_sub['pnpslipsub_connob']);
if($aq2[1]==000){$cnob=$aq2[0];}else{$cnob=$row_tbl_sub['pnpslipsub_connob'];}

$an2=explode(".",$row_tbl_sub['pnpslipsub_conqty']);
if($an2[1]==000){$cqty=$an2[0];}else{$cqty=$row_tbl_sub['pnpslipsub_conqty'];}

$aq3=explode(".",$row_tbl_sub['pnpslipsub_rm']);
if($aq3[1]==000){$rmqty=$aq3[0];}else{$rmqty=$row_tbl_sub['pnpslipsub_rm'];}

$an3=explode(".",$row_tbl_sub['pnpslipsub_im']);
if($an3[1]==000){$imqty=$an3[0];}else{$imqty=$row_tbl_sub['pnpslipsub_im'];}

if($row_tbl_sub['pnpslipsub_pl']!="")
{
$an4=explode(".",$row_tbl_sub['pnpslipsub_pl']);
if($an4[1]==000){$plqty=$an4[0];}else{$plqty=$row_tbl_sub['pnpslipsub_pl'];}
}
else
{
$an4=explode(".",$row_tbl_sub['pnpslipsub_rpl']);
if($an4[1]==000){$plqty=$an4[0];}else{$plqty=$row_tbl_sub['pnpslipsub_rpl'];}
}

$an5=explode(".",$row_tbl_sub['pnpslipsub_tlqty']);
if($an5[1]==000){$tplqty=$an5[0];}else{$tplqty=$row_tbl_sub['pnpslipsub_tlqty'];}
		
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['pnpslipsub_lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['pnpslipsub_lotno'];
		}
		if($bags1!="")
		{
		$bags1=$bags1."<br>".$onob;
		}
		else
		{
		$bags1=$onob;
		}
		if($qty1!="")
		{
		$qty1=$qty1."<br>".$oqty;
		}
		else
		{
		$qty1=$oqty;
		}
		if($bags2!="")
		{
		$bags2=$bags2."<br>".$cnob;
		}
		else
		{
		$bags2=$cnob;
		}
		if($qty2!="")
		{
		$qty2=$qty2."<br>".$cqty;
		}
		else
		{
		$qty2=$cqty;
		}
		if($rm!="")
		{
		$rm=$rm."<br>".$rmqty;
		}
		else
		{
		$rm=$rmqty;
		}
		if($im!="")
		{
		$im=$im."<br>".$imqty;
		}
		else
		{
		$im=$imqty;
		}
		if($pl!="")
		{
		$pl=$pl."<br>".$plqty;
		}
		else
		{
		$pl=$plqty;
		}
		if($tpl!="")
		{
		$tpl=$tpl."<br>".$tplqty;
		}
		else
		{
		$tpl=$tplqty;
		}
		if($tplper!="")
		{
		$tplper=$tplper."<br>".$row_tbl_sub['pnpslipsub_tlper'];
		}
		else
		{
		$tplper=$row_tbl_sub['pnpslipsub_tlper'];
		}
		
	}
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><a href="add_pronpslipmtn_view_fc.php?p_id=<?php echo $arrival_id;?>"><?php echo "PS".$row_arr_home['pnpslipmain_tcode']."/".$yearid_id."/".$lrole;?></a></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $mtnno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags2?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty2?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rm?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $im?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pl?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tpl?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplper?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['pnpslipmain_wbactflag']==1) { ?><a href="Javascript:void(0)" onclick="openpackdetails(<?php echo $arrival_id;?>)">View</a><?php } else { ?>Pending<?php } ?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['pnpslipmain_wbactflag']==1 && $row_arr_home['pnpslipmain_prolossupdflg']==0) { ?><a href="add_pronpslipmtn_finalize_fc.php?p_id=<?php echo $arrival_id;?>">Update</a><?php } else { ?>Pending<?php } ?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><a href="add_pronpslipmtn_view_fc.php?p_id=<?php echo $arrival_id;?>"><?php echo "PS".$row_arr_home['pnpslipmain_tcode']."/".$yearid_id."/".$lrole;?></a></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $mtnno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags2?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty2?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rm?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $im?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pl?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tpl?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplper?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['pnpslipmain_wbactflag']==1) { ?><a href="Javascript:void(0)" onclick="openpackdetails(<?php echo $arrival_id;?>)">View</a><?php } else { ?>Pending<?php } ?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['pnpslipmain_wbactflag']==1 && $row_arr_home['pnpslipmain_prolossupdflg']==0) { ?><a href="add_pronpslipmtn_finalize_fc.php?p_id=<?php echo $arrival_id;?>">Update</a><?php } else { ?>Pending<?php } ?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
          </table>

<?php 
} 
else
{
?>

  <?php
  $targetpage = $_SERVER['PHP_SELF']; 
	$adjacents = 2;
	$limit = 10; 								
	if(isset($_GET['page']))								
	{$page = $_GET['page'];}
	else {$page = 0;}
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	
		
  $sql_arr_home=mysqli_query($link,"select * from tbl_pnpslipmain where pnpslipmain_ttype='Processing and Packing Slip' and pnpslipmain_tflag=2 and plantcode='$plantcode' and pnpslipmain_trtype='fc' order by pnpslipmain_tcode desc LIMIT $start, $limit") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest where bflg=1   and qcflg=0");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 

$query = "select * from tbl_pnpslipmain where pnpslipmain_ttype='Processing and Packing Slip' and pnpslipmain_tflag=2 and plantcode='$plantcode' and pnpslipmain_trtype='fc' order by pnpslipmain_tcode desc";
$total_pages = mysqli_num_rows(mysqli_query($link,$query));
//echo	$total_pages = $total_pages[num];
	
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\" align=\"right\">";
		//previous button
		if ($page > 1) 
			$pagination.= " <a href=\"$targetpage?page=$prev\">&laquo; Previous </a> ";
		else
			$pagination.= " <span class=\"disabled\">&laquo; Previous </span> ";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= " <span class=\"current\"> $counter </span> ";
				else
					$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\"> $lastpage </a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= " <a href=\"$targetpage?page=1\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\"> $lastpage </a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= " <a href=\"$targetpage?page=1\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= " <a href=\"$targetpage?page=$next\"> Next &raquo;</a> ";
		else
			$pagination.= " <span class=\"disabled\"> Next &raquo;</span> ";
		$pagination.= "</div>\n";		
	}
	 $srno=($page-1)*$limit+1;

    if($tot_arr_home >0) { 
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="970" bordercolor="#adad11" style="border-collapse:collapse">

<tr class="tblsubtitle" height="20">
	<td width="17" rowspan="2"align="center" valign="middle" class="smalltblheading">#</td>
	<td width="76" rowspan="2" align="center" valign="middle" class="smalltblheading">Transaction Id</td>
	<td width="76" rowspan="2" align="center" valign="middle" class="smalltblheading">MTN No.</td>
	<td width="75" rowspan="2" align="center" valign="middle" class="smalltblheading">Date</td>
	<td width="100" rowspan="2" align="center" valign="middle" class="smalltblheading">Crop</td>
	<td width="130" rowspan="2" align="center" valign="middle" class="smalltblheading">Variety</td>
	<td width="100" rowspan="2" align="center" valign="middle" class="smalltblheading">Lot No.</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Existing</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Conditioned</td>
	<td width="45" rowspan="2" align="center" valign="middle" class="smalltblheading">RM</td>
	<td width="45" rowspan="2" align="center" valign="middle" class="smalltblheading">IM</td>
	<td width="45" rowspan="2" align="center" valign="middle" class="smalltblheading">PL</td>
	<td colspan="2" align="center" valign="middle" class="smalltblheading">Total C. Loss</td>
	<td width="45" rowspan="2" align="center" valign="middle" class="tblheading">Pack Details</td>
	<td width="45" rowspan="2" align="center" valign="middle" class="tblheading">Processing Finalize</td>
</tr>
<tr class="tblsubtitle" height="20">
	<td width="45" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="60" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="45" align="center" valign="middle" class="smalltblheading">NoB</td>
	<td width="60" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="50" align="center" valign="middle" class="smalltblheading">Qty</td>
	<td width="45" align="center" valign="middle" class="smalltblheading">%</td>
</tr>
<?php
//$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['pnpslipmain_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
	$lrole=$row_arr_home['logid'];
		
	$arrival_id=$row_arr_home['pnpslipmain_id'];
	$mtnno=$row_arr_home['pnpslipmain_mtnno'];
	
	$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_arr_home['pnpslipmain_crop']."' order by cropname Asc");
	$noticia = mysqli_fetch_array($quer3);
	$crop=$noticia['cropname'];
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr_home['pnpslipmain_variety']."'  order by popularname Asc"); 
	$noticia_item = mysqli_fetch_array($quer4);
	$variety=$noticia_item['popularname'];
	//echo $arrival_id;
	$lotno=""; $bags1=""; $qty1=""; $bags2=""; $qty2=""; $rm=""; $im=""; $pl=""; $tpl=""; $tplper="";
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_pnpslipsub where pnpslipmain_id='".$arrival_id."' and plantcode='$plantcode'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
	{
//echo $row_tbl_sub['pnpslipsub_pqty'];
$aq=explode(".",$row_tbl_sub['pnpslipsub_pnob']);
if($aq[1]==000){$onob=$aq[0];}else{$onob=$row_tbl_sub['pnpslipsub_pnob'];}

$an=explode(".",$row_tbl_sub['pnpslipsub_pqty']);
if($an[1]==000){$oqty=$an[0];}else{$oqty=$row_tbl_sub['pnpslipsub_pqty'];}

$aq2=explode(".",$row_tbl_sub['pnpslipsub_connob']);
if($aq2[1]==000){$cnob=$aq2[0];}else{$cnob=$row_tbl_sub['pnpslipsub_connob'];}

$an2=explode(".",$row_tbl_sub['pnpslipsub_conqty']);
if($an2[1]==000){$cqty=$an2[0];}else{$cqty=$row_tbl_sub['pnpslipsub_conqty'];}

$aq3=explode(".",$row_tbl_sub['pnpslipsub_rm']);
if($aq3[1]==000){$rmqty=$aq3[0];}else{$rmqty=$row_tbl_sub['pnpslipsub_rm'];}

$an3=explode(".",$row_tbl_sub['pnpslipsub_im']);
if($an3[1]==000){$imqty=$an3[0];}else{$imqty=$row_tbl_sub['pnpslipsub_im'];}

if($row_tbl_sub['pnpslipsub_pl']!="")
{
$an4=explode(".",$row_tbl_sub['pnpslipsub_pl']);
if($an4[1]==000){$plqty=$an4[0];}else{$plqty=$row_tbl_sub['pnpslipsub_pl'];}
}
else
{
$an4=explode(".",$row_tbl_sub['pnpslipsub_rpl']);
if($an4[1]==000){$plqty=$an4[0];}else{$plqty=$row_tbl_sub['pnpslipsub_rpl'];}
}

$an5=explode(".",$row_tbl_sub['pnpslipsub_tlqty']);
if($an5[1]==000){$tplqty=$an5[0];}else{$tplqty=$row_tbl_sub['pnpslipsub_tlqty'];}
		
		if($lotno!="")
		{
		$lotno=$lotno."<br>".$row_tbl_sub['pnpslipsub_lotno'];
		}
		else
		{
		$lotno=$row_tbl_sub['pnpslipsub_lotno'];
		}
		if($bags1!="")
		{
		$bags1=$bags1."<br>".$onob;
		}
		else
		{
		$bags1=$onob;
		}
		if($qty1!="")
		{
		$qty1=$qty1."<br>".$oqty;
		}
		else
		{
		$qty1=$oqty;
		}
		if($bags2!="")
		{
		$bags2=$bags2."<br>".$cnob;
		}
		else
		{
		$bags2=$cnob;
		}
		if($qty2!="")
		{
		$qty2=$qty2."<br>".$cqty;
		}
		else
		{
		$qty2=$cqty;
		}
		if($rm!="")
		{
		$rm=$rm."<br>".$rmqty;
		}
		else
		{
		$rm=$rmqty;
		}
		if($im!="")
		{
		$im=$im."<br>".$imqty;
		}
		else
		{
		$im=$imqty;
		}
		if($pl!="")
		{
		$pl=$pl."<br>".$plqty;
		}
		else
		{
		$pl=$plqty;
		}
		if($tpl!="")
		{
		$tpl=$tpl."<br>".$tplqty;
		}
		else
		{
		$tpl=$tplqty;
		}
		if($tplper!="")
		{
		$tplper=$tplper."<br>".$row_tbl_sub['pnpslipsub_tlper'];
		}
		else
		{
		$tplper=$row_tbl_sub['pnpslipsub_tlper'];
		}
		
	}
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><a href="add_pronpslipmtn_view_fc.php?p_id=<?php echo $arrival_id;?>"><?php echo "PS".$row_arr_home['pnpslipmain_tcode']."/".$yearid_id."/".$lrole;?></a></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $mtnno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags2?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty2?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rm?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $im?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pl?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tpl?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplper?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['pnpslipmain_wbactflag']==1) { ?><a href="Javascript:void(0)" onclick="openpackdetails(<?php echo $arrival_id;?>)">View</a><?php } else { ?>Pending<?php } ?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['pnpslipmain_wbactflag']==1 && $row_arr_home['pnpslipmain_prolossupdflg']==0) { ?><a href="add_pronpslipmtn_finalize_fc.php?p_id=<?php echo $arrival_id;?>">Update</a><?php } else { ?>Pending<?php } ?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td align="center" valign="middle" class="smalltbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><a href="add_pronpslipmtn_view_fc.php?p_id=<?php echo $arrival_id;?>"><?php echo "PS".$row_arr_home['pnpslipmain_tcode']."/".$yearid_id."/".$lrole;?></a></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $mtnno;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $crop?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $variety?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $lotno?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty1?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $bags2?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $qty2?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $rm?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $im?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $pl?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tpl?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php echo $tplper?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['pnpslipmain_wbactflag']==1) { ?><a href="Javascript:void(0)" onclick="openpackdetails(<?php echo $arrival_id;?>)">View</a><?php } else { ?>Pending<?php } ?></td>
	<td align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['pnpslipmain_wbactflag']==1 && $row_arr_home['pnpslipmain_prolossupdflg']==0) { ?><a href="add_pronpslipmtn_finalize_fc.php?p_id=<?php echo $arrival_id;?>">Update</a><?php } else { ?>Pending<?php } ?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
          </table>
<?php
}
?>
<!--<table align="center" width="900" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="arrival_home.php"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a></td>
</tr>
</table>-->

<?php echo $pagination?>
<?php } ?>