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
$sql_arr_home=mysqli_query($link,"select * from tbl_densitydata where (density_rawwtflg=1 OR density_conwtflg=1) and density_orlot LIKE '%$srval%' order by density_crop, density_variety, density_orlot asc ") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="2%"align="center" valign="middle" class="tblheading">#</td>
              <td width="9%" align="center" valign="middle" class="tblheading">Date</td>
              <td width="11%" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="19%" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="11%" align="center" valign="middle" class="tblheading">Lot No.</td>
              <td width="8%" align="center" valign="middle" class="tblheading">Sample No.</td>
              <td width="8%" align="center" valign="middle" class="tblheading">Raw Density Data</td>
			  <td width="8%" align="center" valign="middle" class="tblheading">Condition Density Data</td>
            </tr>
<?php
//$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	if($row_arr_home['density_conwtflg']==1)
	{$trdate=$row_arr_home['density_conwtdate'];}
	else
	{$trdate=$row_arr_home['density_rawwtdate'];}
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	//$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['density_id'];
	
	$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_arr_home['density_crop']."' order by cropname Asc")or die(mysqli_error($link));
	$noticia = mysqli_fetch_array($quer3);
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr_home['density_variety']."' order by popularname Asc")or die(mysqli_error($link)); 
	$noticia4 = mysqli_fetch_array($quer4);

	$crop=$noticia['cropname'];
	$variety=$noticia4['popularname'];	
	if($variety==""){$variety=$row_arr_home['density_variety'];}
	if($row_arr_home['density_conwtflg']==1)
	{$lotno=$row_arr_home['density_clotno'];}
	else
	{$lotno=$row_arr_home['density_lotno'];}
	$orlot=$row_arr_home['density_orlot'];
	$rawsampwt=$row_arr_home['density_rawsampwt'];
	$consampwt=$row_arr_home['density_consampwt'];
	$samplenumber=$row_arr_home['density_consampleno'];
	
	$quer6=mysqli_query($link,"SELECT density_id FROM tbl_density where density_lotno='".$lotno."' order by density_lotno Asc")or die(mysqli_error($link)); 
	if($noticia6 = mysqli_num_rows($quer6)==0)
	{	
	
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td width="2%" align="center" valign="middle" class="smalltblheading"><?php echo $srno;?></td>
	<td width="9%" align="center" valign="middle" class="smalltblheading"><?php echo $trdate;?></td>
	<td width="11%" align="center" valign="middle" class="smalltblheading"><?php echo $crop?></td>
	<td width="19%" align="center" valign="middle" class="smalltblheading"><?php echo $variety?></td>
	<td width="11%" align="center" valign="middle" class="smalltblheading"><?php echo $lotno?></td>
	<td width="8%" align="center" valign="middle" class="smalltblheading"><?php echo $samplenumber?></td>
	<td width="9%" align="center" valign="middle" class="smalltblheading"><?php echo $rawsampwt?></td>
	<td width="9%" align="center" valign="middle" class="smalltblheading"><?php echo $consampwt?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td width="2%" align="center" valign="middle" class="smalltblheading"><?php echo $srno;?></td>
	<td width="9%" align="center" valign="middle" class="smalltblheading"><?php echo $trdate;?></td>
	<td width="11%" align="center" valign="middle" class="smalltblheading"><?php echo $crop?></td>
	<td width="19%" align="center" valign="middle" class="smalltblheading"><?php echo $variety?></td>
	<td width="11%" align="center" valign="middle" class="smalltblheading"><?php echo $lotno?></td>
	<td width="8%" align="center" valign="middle" class="smalltblheading"><?php echo $samplenumber?></td>
	<td width="9%" align="center" valign="middle" class="smalltblheading"><?php echo $rawsampwt?></td>
	<td width="9%" align="center" valign="middle" class="smalltblheading"><?php echo $consampwt?></td>
</tr>
<?php
}
$srno=$srno+1;
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
  
$targetpage = $PHP_SELF; 
	$adjacents = 2;
	$limit = 10; 								
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	
		
	$sql_arr_home=mysqli_query($link,"select * from tbl_densitydata where (density_rawwtflg=1 OR density_conwtflg=1) order by density_crop, density_variety, density_orlot asc LIMIT $start, $limit") or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);
	
	//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest where bflg=1   and qcflg=0"),0); 
	
	$query = "select * from tbl_densitydata where (density_rawwtflg=1 OR density_conwtflg=1)";
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
			$pagination.= "<a href=\"$targetpage?page=$prev\">&laquo; Previous </a>";
		else
			$pagination.= "<span class=\"disabled\">&laquo; Previous </span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\"> $counter </span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\"> $counter </a>";					
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
						$pagination.= "<span class=\"current\"> $counter </span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\"> $counter </a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\"> $lpm1 </a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\"> $lastpage </a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\"> 1 </a>";
				$pagination.= "<a href=\"$targetpage?page=2\"> 2 </a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\"> $counter </span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\"> $counter </a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\"> $lpm1 </a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\"> $lastpage </a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\"> 1 </a>";
				$pagination.= "<a href=\"$targetpage?page=2\"> 2 </a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\"> $counter </span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\"> $counter </a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\"> Next &raquo;</a>";
		else
			$pagination.= "<span class=\"disabled\"> Next &raquo;</span>";
		$pagination.= "</div>\n";		
	}
// if($tot_arr_home >0) { $total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tblarrival where arrtrflag=1"),0);
 $srno=($page-1)*$limit+1; $cont=1;
 
/*if(!isset($_GET['page'])) { 
		$page = 1; 
		$srno=1;
	} else { 
		$page = $_GET['page']; 
		$srno=(($page * 10)+1) - 10;
	} 
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 
	
	
$sql_arr_home=mysqli_query($link,"select * from tbl_softr where softr_tflg=1 order by softr_id desc,softr_code desc LIMIT $from, $max_results") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_softr where softr_tflg=1"),0); 

    if($tot_arr_home >0) { */
?>


<table align="center" border="1" cellspacing="0" cellpadding="0" width="800" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="2%"align="center" valign="middle" class="tblheading">#</td>
              <td width="9%" align="center" valign="middle" class="tblheading">Date</td>
              <td width="11%" align="center" valign="middle" class="tblheading">Crop</td>
              <td width="19%" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="11%" align="center" valign="middle" class="tblheading">Lot No.</td>
              <td width="8%" align="center" valign="middle" class="tblheading">Sample No.</td>
              <td width="8%" align="center" valign="middle" class="tblheading">Raw Density Data</td>
			  <td width="8%" align="center" valign="middle" class="tblheading">Condition Density Data</td>
            </tr>
<?php
//$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	if($row_arr_home['density_conwtflg']==1)
	{$trdate=$row_arr_home['density_conwtdate'];}
	else
	{$trdate=$row_arr_home['density_rawwtdate'];}
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	//$lrole=$row_arr_home['arr_role'];
	$arrival_id=$row_arr_home['density_id'];
	
	$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_arr_home['density_crop']."' order by cropname Asc")or die(mysqli_error($link));
	$noticia = mysqli_fetch_array($quer3);
	
	$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where varietyid='".$row_arr_home['density_variety']."' order by popularname Asc")or die(mysqli_error($link)); 
	$noticia4 = mysqli_fetch_array($quer4);

	$crop=$noticia['cropname'];
	$variety=$noticia4['popularname'];	
	if($variety==""){$variety=$row_arr_home['density_variety'];}
	if($row_arr_home['density_conwtflg']==1)
	{$lotno=$row_arr_home['density_clotno'];}
	else
	{$lotno=$row_arr_home['density_lotno'];}
	$orlot=$row_arr_home['density_orlot'];
	$rawsampwt=$row_arr_home['density_rawsampwt'];
	$consampwt=$row_arr_home['density_consampwt'];
	$samplenumber=$row_arr_home['density_consampleno'];
	
	$quer6=mysqli_query($link,"SELECT density_id FROM tbl_density where density_lotno='".$lotno."' order by density_lotno Asc")or die(mysqli_error($link)); 
	if($noticia6 = mysqli_num_rows($quer6)==0)
	{	
	
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td width="2%" align="center" valign="middle" class="smalltblheading"><?php echo $srno;?></td>
	<td width="9%" align="center" valign="middle" class="smalltblheading"><?php echo $trdate;?></td>
	<td width="11%" align="center" valign="middle" class="smalltblheading"><?php echo $crop?></td>
	<td width="19%" align="center" valign="middle" class="smalltblheading"><?php echo $variety?></td>
	<td width="11%" align="center" valign="middle" class="smalltblheading"><?php echo $lotno?></td>
	<td width="8%" align="center" valign="middle" class="smalltblheading"><?php echo $samplenumber?></td>
	<td width="9%" align="center" valign="middle" class="smalltblheading"><?php echo $rawsampwt?></td>
	<td width="9%" align="center" valign="middle" class="smalltblheading"><?php echo $consampwt?></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td width="2%" align="center" valign="middle" class="smalltblheading"><?php echo $srno;?></td>
	<td width="9%" align="center" valign="middle" class="smalltblheading"><?php echo $trdate;?></td>
	<td width="11%" align="center" valign="middle" class="smalltblheading"><?php echo $crop?></td>
	<td width="19%" align="center" valign="middle" class="smalltblheading"><?php echo $variety?></td>
	<td width="11%" align="center" valign="middle" class="smalltblheading"><?php echo $lotno?></td>
	<td width="8%" align="center" valign="middle" class="smalltblheading"><?php echo $samplenumber?></td>
	<td width="9%" align="center" valign="middle" class="smalltblheading"><?php echo $rawsampwt?></td>
	<td width="9%" align="center" valign="middle" class="smalltblheading"><?php echo $consampwt?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
}
?>
          </table>
<?php echo $pagination;?>	
<?php
}
?>