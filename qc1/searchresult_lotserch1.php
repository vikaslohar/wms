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
$sql_arr_home=mysqli_query($link,"select * from tbl_blendm where blendm_aflg=1 order by blendm_date desc,blendm_code desc ") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
?>
  
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="4%"align="center" valign="middle" class="smalltblheading">#</td>
			 <td width="9%" align="center" valign="middle" class="smalltblheading">Transaction Id</td>
			 <td width="8%" align="center" valign="middle" class="smalltblheading">Blending Date</td>
              <td width="11%" align="center" valign="middle" class="smalltblheading">Crop</td>
              <td width="15%" align="center" valign="middle" class="smalltblheading">Variety</td>
              <td width="11%" align="center" valign="middle" class="smalltblheading">Lot No.</td>
			  <td width="5%" align="center" valign="middle" class="smalltblheading">NoB</td>
              <td width="6%" align="center" valign="middle" class="smalltblheading">Qty</td>
              <td width="18%" align="center" valign="middle" class="smalltblheading">SLOC</td>
              <td width="8%" align="center" valign="middle" class="smalltblheading">No. of Blending Lots</td>
              <!--<td width="4%" align="center" valign="middle" class="smalltblheading">NoB</td>
              <td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>-->
              <td align="center" valign="middle" class="smalltblheading">Output</td>
              </tr>
<?php

if($tot_arr_home > 0)
{$srno1=1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{

	$trdate=$row_arr_home['blendm_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	$trid=$row_arr_home['blendm_id'];
	$drole=$row_arr_home['blendm_logid'];
	
	$dq=explode(".",$row_arr_home['blendm_qty']);
	if($dq[1]==000){$mqty=$dq[0];}else{$mqty=$row_arr_home['blendm_qty'];}

$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_arr_home['blendm_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);

$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_arr_home['blendm_variety']."'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);	

$flg=0;
$nsloc2=""; $lotn=""; $nob2=""; $qty2="";
$sql_eindent_sub=mysqli_query($link,"select distinct blendss_newlot from tbl_blendss where blendm_id=$trid and blendss_newlot LIKE '%$srval%'") or die(mysqli_error($link));
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{
$nob=0; $qty=0; $nsloc=""; $flg=1;
$sql_eindent_sub2=mysqli_query($link,"select * from tbl_blendss where blendm_id='$trid' and blendss_newlot='".$row_eindent_sub['blendss_newlot']."'") or die(mysqli_error($link));
while($row_eindent_sub2=mysqli_fetch_array($sql_eindent_sub2))
{

$wareh=""; $binn=""; $subbinn=""; $nnob=""; $nqty=""; 
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_eindent_sub2['blendss_whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_eindent_sub2['blendss_binid']."' and whid='".$row_eindent_sub2['blendss_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_eindent_sub2['blendss_subbinid']."' and binid='".$row_eindent_sub2['blendss_binid']."' and whid='".$row_eindent_sub2['blendss_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$nnob=$row_eindent_sub2['blendss_nob'];

$dq=explode(".",$row_eindent_sub2['blendss_qty']);
if($dq[1]==000){$nqty=$dq[0];}else{$nqty=$row_eindent_sub2['blendss_qty'];}

if($nsloc!="")
$nsloc=$nsloc."<br>".$wareh.$binn.$subbinn."  ".$nnob." | ".$nqty;
else
$nsloc=$wareh.$binn.$subbinn."  ".$nnob." | ".$nqty;


$nob=$nob+$nnob;
$qty=$qty+$nqty;
}
if($lotn!="")
$lotn=$lotn."<br>".$row_eindent_sub['blendss_newlot'];
else
$lotn=$row_eindent_sub['blendss_newlot'];

if($nsloc2!="")
$nsloc2=$nsloc2."<br>".$nsloc;
else
$nsloc2=$nsloc;

if($nob2!="")
$nob2=$nob2."<br>".$nob;
else
$nob2=$nob;

if($qty2!="")
$qty2=$qty2."<br>".$qty;
else
$qty2=$qty;
}
$extlotno=$row_arr_home['blendm_nolots'];
if($flg>0)
{
if($srno1%2!=0)
{
?>			  
<tr class="Light">
         <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
         <td width="9%" align="center" valign="middle" class="smalltbltext"><a href="Lot_merger_view2.php?p_id=<?php echo $trid;?>"><?php echo "LB".$row_arr_home['blendm_code']."/".$row_arr_home['blendm_yearid']."/".$drole;?></a></td>
		 <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
         <td width="11%" align="center" valign="middle" class="smalltbltext"><?php echo $noticia_class['cropname'];?></td>
         <td width="15%" align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
         <td width="11%" align="center" valign="middle" class="smalltbltext"><?php echo $lotn;?></td>
         <td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $nob2?></td>
         <td width="6%" align="center" valign="middle" class="smalltbltext"><?php echo $qty2?></td>
         <td width="18%" align="center" valign="middle" class="smalltbltext"><?php echo $nsloc2;?></td>
         <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $extlotno;?></td>
         <td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['blendm_bflg']!=0){?><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $trid;?>');">LBN</a><?php }else echo "";?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
         <td width="9%" align="center" valign="middle" class="smalltbltext"><a href="Lot_merger_view2.php?p_id=<?php echo $trid;?>"><?php echo "LB".$row_arr_home['blendm_code']."/".$row_arr_home['blendm_yearid']."/".$drole;?></a></td>
		 <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
         <td width="11%" align="center" valign="middle" class="smalltbltext"><?php echo $noticia_class['cropname'];?></td>
         <td width="15%" align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
         <td width="11%" align="center" valign="middle" class="smalltbltext"><?php echo $lotn;?></td>
         <td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $nob2?></td>
         <td width="6%" align="center" valign="middle" class="smalltbltext"><?php echo $qty2?></td>
         <td width="18%" align="center" valign="middle" class="smalltbltext"><?php echo $nsloc2;?></td>
         <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $extlotno;?></td>
         <td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['blendm_bflg']!=0){?><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $trid;?>');">LBN</a><?php }else echo "";?></td>
</tr>
<?php
}
$srno1=$srno1+1;
}
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
	$targetpage1 = $PHP_SELF; 
	$adjacents1 = 2;
	$limit1 = 10; 								
	$page1 = $_GET['page1'];
	if($page1) 
		$start1 = ($page1 - 1) * $limit1; 			//first item to display on this page
	else
		$start1 = 0;	
		
  $sql_arr_home1=mysqli_query($link,"select * from tbl_blendm where blendm_aflg=1 order by blendm_date desc,blendm_code desc LIMIT $start1, $limit1") or die(mysqli_error($link));
 $tot_arr_home1=mysqli_num_rows($sql_arr_home1);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest where bflg=1   and qcflg=0"),0); 

$query1 = "select * from tbl_blendm where blendm_aflg=1 order by blendm_date desc,blendm_code desc";
$total_pages1 = mysqli_num_rows(mysqli_query($link,$query1));
//echo	$total_pages = $total_pages[num];
	
	if ($page1 == 0) $page1 = 1;					//if no page var is given, default to 1.
	$prev1 = $page1 - 1;							//previous page is page - 1
	$next1 = $page1 + 1;							//next page is page + 1
	$lastpage1 = ceil($total_pages1/$limit1);		//lastpage is = total pages / items per page, rounded up.
	$lpm11 = $lastpage1 - 1;						//last page minus 1
	
$pagination1 = "";
	if($lastpage1 > 1)
	{	
		$pagination1 .= "<div class=\"pagination1\" align=\"right\">";
		//previous button
		if ($page1 > 1) 
			$pagination1.= " <a href=\"$targetpage1?page1=$prev1\">&laquo; Previous </a> ";
		else
			$pagination1.= " <span class=\"disabled1\">&laquo; Previous </span> ";	
		
		//pages	
		if ($lastpage1 < 7 + ($adjacents1 * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter1 = 1; $counter1 <= $lastpage1; $counter1++)
			{
				if ($counter1 == $page1)
					$pagination1.= " <span class=\"current1\"> $counter1 </span> ";
				else
					$pagination1.= " <a href=\"$targetpage1?page1=$counter1\"> $counter1 </a> ";					
			}
		}
		elseif($lastpage1 > 5 + ($adjacents1 * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page1 < 1 + ($adjacents1 * 2))		
			{
				for ($counter1 = 1; $counter1 < 4 + ($adjacents1 * 2); $counter1++)
				{
					if ($counter1 == $page1)
						$pagination1.= " <span class=\"current1\"> $counter1 </span> ";
					else
						$pagination1.= " <a href=\"$targetpage1?page1=$counter1\"> $counter1 </a> ";					
				}
				$pagination1.= " ... ";
				$pagination1.= " <a href=\"$targetpage1?page1=$lpm11\"> $lpm11 </a> ";
				$pagination1.= " <a href=\"$targetpage1?page1=$lastpage1\"> $lastpage1 </a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage1 - ($adjacents1 * 2) > $page1 && $page1 > ($adjacents1 * 2))
			{
				$pagination1.= " <a href=\"$targetpage1?page1=1\"> 1 </a> ";
				$pagination1.= " <a href=\"$targetpage1?page1=2\"> 2 </a> ";
				$pagination1.= " ... ";
				for ($counter1 = $page1 - $adjacents1; $counter1 <= $page1 + $adjacents1; $counter1++)
				{
					if ($counter1 == $page1)
						$pagination1.= " <span class=\"current1\"> $counter1 </span> ";
					else
						$pagination1.= " <a href=\"$targetpage1?page1=$counter1\"> $counter1 </a> ";					
				}
				$pagination1.= " ... ";
				$pagination1.= " <a href=\"$targetpage1?page1=$lpm11\"> $lpm11 </a> ";
				$pagination1.= " <a href=\"$targetpage1?page1=$lastpage1\"> $lastpage1 </a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination1.= " <a href=\"$targetpage1?page1=1\"> 1 </a> ";
				$pagination1.= " <a href=\"$targetpage1?page1=2\"> 2 </a> ";
				$pagination1.= " ... ";
				for ($counter1 = $lastpage1 - (2 + ($adjacents1 * 2)); $counter1 <= $lastpage1; $counter1++)
				{
					if ($counter1 == $page1)
						$pagination1.= " <span class=\"current1\"> $counter1 </span> ";
					else
						$pagination1.= " <a href=\"$targetpage1?page1=$counter1\"> $counter1 </a> ";					
				}
			}
		}
		
		//next button
		if ($page1 < $counter1 - 1) 
			$pagination1.= " <a href=\"$targetpage1?page1=$next1\"> Next &raquo;</a> ";
		else
			$pagination1.= " <span class=\"disabled1\"> Next &raquo;</span> ";
		$pagination1.= "</div>\n";		
	}
// if($tot_arr_home >0) { $total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblarrival where arrtrflag=1"),0);
 $srno1=($page1-1)*$limit1+1;
/*if(!isset($_GET['page'])) { 
		$page = 1; 
		$srno=1;
	} else { 
		$page = $_GET['page']; 
		$srno=(($page * 10)+1) - 10;
	} 
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 
	
	
$sql_arr_home=mysqli_query($link,"select * from tbl_blendm where blendm_aflg=1 order by blendm_date desc,blendm_code desc LIMIT $from, $max_results") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_blendm where blendm_aflg=1"),0); */

   ?>
  
<table align="center" border="1" cellspacing="0" cellpadding="0" width="950" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="4%"align="center" valign="middle" class="smalltblheading">#</td>
			 <td width="9%" align="center" valign="middle" class="smalltblheading">Transaction Id</td>
			 <td width="8%" align="center" valign="middle" class="smalltblheading">Blending Date</td>
              <td width="11%" align="center" valign="middle" class="smalltblheading">Crop</td>
              <td width="15%" align="center" valign="middle" class="smalltblheading">Variety</td>
              <td width="11%" align="center" valign="middle" class="smalltblheading">Lot No.</td>
			  <td width="5%" align="center" valign="middle" class="smalltblheading">NoB</td>
              <td width="6%" align="center" valign="middle" class="smalltblheading">Qty</td>
              <td width="18%" align="center" valign="middle" class="smalltblheading">SLOC</td>
              <td width="8%" align="center" valign="middle" class="smalltblheading">No. of Blending Lots</td>
              <!--<td width="4%" align="center" valign="middle" class="smalltblheading">NoB</td>
              <td width="5%" align="center" valign="middle" class="smalltblheading">Qty</td>-->
              <td align="center" valign="middle" class="smalltblheading">Output</td>
              </tr>
<?php
//$srno=1;
if($tot_arr_home1 > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home1))
{

	$trdate=$row_arr_home['blendm_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
	
	$trid=$row_arr_home['blendm_id'];
	$drole=$row_arr_home['blendm_logid'];
	
	$dq=explode(".",$row_arr_home['blendm_qty']);
	if($dq[1]==000){$mqty=$dq[0];}else{$mqty=$row_arr_home['blendm_qty'];}

$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_arr_home['blendm_crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class=mysqli_fetch_array($classqry);

$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_arr_home['blendm_variety']."'") or die(mysqli_error($link));
$noticia_item=mysqli_fetch_array($itemqry);	


$nsloc2=""; $lotn=""; $nob2=""; $qty2="";
$sql_eindent_sub=mysqli_query($link,"select distinct blendss_newlot from tbl_blendss where blendm_id=$trid") or die(mysqli_error($link));
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{
$nob=0; $qty=0; $nsloc="";
$sql_eindent_sub2=mysqli_query($link,"select * from tbl_blendss where blendm_id='$trid' and blendss_newlot='".$row_eindent_sub['blendss_newlot']."'") or die(mysqli_error($link));
while($row_eindent_sub2=mysqli_fetch_array($sql_eindent_sub2))
{

$wareh=""; $binn=""; $subbinn=""; $nnob=""; $nqty=""; 
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_eindent_sub2['blendss_whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_eindent_sub2['blendss_binid']."' and whid='".$row_eindent_sub2['blendss_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_eindent_sub2['blendss_subbinid']."' and binid='".$row_eindent_sub2['blendss_binid']."' and whid='".$row_eindent_sub2['blendss_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$nnob=$row_eindent_sub2['blendss_nob'];

$dq=explode(".",$row_eindent_sub2['blendss_qty']);
if($dq[1]==000){$nqty=$dq[0];}else{$nqty=$row_eindent_sub2['blendss_qty'];}

if($nsloc!="")
$nsloc=$nsloc."<br>".$wareh.$binn.$subbinn."  ".$nnob." | ".$nqty;
else
$nsloc=$wareh.$binn.$subbinn."  ".$nnob." | ".$nqty;


$nob=$nob+$nnob;
$qty=$qty+$nqty;
}
if($lotn!="")
$lotn=$lotn."<br>".$row_eindent_sub['blendss_newlot'];
else
$lotn=$row_eindent_sub['blendss_newlot'];

if($nsloc2!="")
$nsloc2=$nsloc2."<br>".$nsloc;
else
$nsloc2=$nsloc;

if($nob2!="")
$nob2=$nob2."<br>".$nob;
else
$nob2=$nob;

if($qty2!="")
$qty2=$qty2."<br>".$qty;
else
$qty2=$qty;
}
$extlotno=$row_arr_home['blendm_nolots'];
if($srno1%2!=0)
{
?>			  
<tr class="Light">
         <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
         <td width="9%" align="center" valign="middle" class="smalltbltext"><a href="Lot_merger_view2.php?p_id=<?php echo $trid;?>"><?php echo "LB".$row_arr_home['blendm_code']."/".$row_arr_home['blendm_yearid']."/".$drole;?></a></td>
		 <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
         <td width="11%" align="center" valign="middle" class="smalltbltext"><?php echo $noticia_class['cropname'];?></td>
         <td width="15%" align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
         <td width="11%" align="center" valign="middle" class="smalltbltext"><?php echo $lotn;?></td>
         <td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $nob2?></td>
         <td width="6%" align="center" valign="middle" class="smalltbltext"><?php echo $qty2?></td>
         <td width="18%" align="center" valign="middle" class="smalltbltext"><?php echo $nsloc2;?></td>
         <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $extlotno;?></td>
         <td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['blendm_bflg']!=0){?><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $trid;?>');">LBN</a><?php }else echo "";?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="4%" align="center" valign="middle" class="smalltbltext"><?php echo $srno1;?></td>
         <td width="9%" align="center" valign="middle" class="smalltbltext"><a href="Lot_merger_view2.php?p_id=<?php echo $trid;?>"><?php echo "LB".$row_arr_home['blendm_code']."/".$row_arr_home['blendm_yearid']."/".$drole;?></a></td>
		 <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $trdate;?></td>
         <td width="11%" align="center" valign="middle" class="smalltbltext"><?php echo $noticia_class['cropname'];?></td>
         <td width="15%" align="center" valign="middle" class="smalltbltext"><?php echo $noticia_item['popularname'];?></td>
         <td width="11%" align="center" valign="middle" class="smalltbltext"><?php echo $lotn;?></td>
         <td width="5%" align="center" valign="middle" class="smalltbltext"><?php echo $nob2?></td>
         <td width="6%" align="center" valign="middle" class="smalltbltext"><?php echo $qty2?></td>
         <td width="18%" align="center" valign="middle" class="smalltbltext"><?php echo $nsloc2;?></td>
         <td width="8%" align="center" valign="middle" class="smalltbltext"><?php echo $extlotno;?></td>
         <td width="5%" align="center" valign="middle" class="smalltbltext"><?php if($row_arr_home['blendm_bflg']!=0){?><a href="Javascript:void(0)" onclick="openslocpopprint('<?php echo $trid;?>');">LBN</a><?php }else echo "";?></td>
</tr>
<?php
}
$srno1=$srno1+1;
}
}
?>
</table>

<?php echo $pagination1?>
<?php
}
?>