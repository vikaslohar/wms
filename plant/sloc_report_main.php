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
	
	$crop = $_REQUEST['txtcrop'];
	$variety = $_REQUEST['txtvariety'];
	$sdate = $_REQUEST['sdate'];
	$edate = $_REQUEST['edate'];
	
	if(isset($_POST['frm_action'])=='submit')
	{
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SLOC Report</title>
<link href="../include/main_plantm.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_plantm.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript">

//SuckerTree Horizontal Menu (Sept 14th, 06)
//By Dynamic Drive: http://www.dynamicdrive.com/style/

var menuids=["nav"] //Enter id(s) of SuckerTree UL menus, separated by commas

function buildsubmenus_horizontal(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
		if (ultags[t].parentNode.parentNode.id==menuids[i]){ //if this is a first level submenu
			ultags[t].style.top=ultags[t].parentNode.offsetHeight+"px" //dynamically position first level submenus to be height of main menu item
			ultags[t].parentNode.getElementsByTagName("a")[0].className="mainfoldericon"
		}
		else{ //else if this is a sub level menu (ul)
		  ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    	ultags[t].parentNode.getElementsByTagName("a")[0].className="subfoldericon"
		}
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.visibility="visible"
    }
    ultags[t].parentNode.onmouseout=function(){
  this.getElementsByTagName("ul")[0].style.visibility="hidden"
    }
    }
  }
}

if (window.addEventListener)
window.addEventListener("load", buildsubmenus_horizontal, false)
else if (window.attachEvent)
window.attachEvent("onload", buildsubmenus_horizontal)

</script>
<SCRIPT language="JavaScript">

function openprint()
{
	
	var itemid=document.frmaddDepartment.txtcrop.value;
	var vv=document.frmaddDepartment.txtvariety.value;
	//var age=document.frmaddDepartment.age.value;
	//alert(ite)
	//var ite=document.frmaddDepartment.txtitem.value;
	winHandle=window.open('report_crop2.php?txtcrop='+itemid+'&txtvariety='+vv,'WelCome','top=20,left=80,width=850,height=600,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); } 
}
</script>


<body>

<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td valign="top"><?php require_once("../include/arr_plant.php");?></td>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/plantm_curvetop.jpg" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" align="center"  class="midbgline">
		  <!-- actual page start--->	
  
  <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
  <tr><td>

   <?php
	// $edate=date("Y-m-d");
	
	// $crp="ALL"; $ver="ALL";
	//$qry="SELECT * from tbl_lot_ldg where lotldg_sstage='Condition' and lotldg_resverstatus=1 and lotldg_trdate<='$edate'";	
 
	
	$sdate = date("Y-m-d", strtotime($sdate));
	$edate = date("Y-m-d", strtotime($edate));

  	// $qry="SELECT * FROM `tbl_slocnew` as tbl1 LEFT JOIN tbl_slocnew_from as tbl2 ON tbl2.slnew_id = tbl1.slnew_id LEFT JOIN tbl_slocnew_to as tbl3 ON tbl3.slnew_id = tbl1.slnew_id WHERE tbl1.slnew_fromflg = 1 AND tbl1.slnew_toflg = 1 AND tbl1.slnew_tflg = 1 AND tbl1.slnew_date >= date('$sdate') AND tbl1.slnew_date <= date('$edate') ";
  	$qry="SELECT * FROM `tbl_slocnew` as tbl1 WHERE tbl1.slnew_fromflg = 1 AND tbl1.slnew_toflg = 1 AND tbl1.slnew_tflg = 1 AND tbl1.slnew_date >= date('$sdate') AND tbl1.slnew_date <= date('$edate');";
	
	



	
	
	$sql_arr_home=mysqli_query($link,$qry) or die(mysqli_error($link));
	$tot_arr_home=mysqli_num_rows($sql_arr_home);



	?>
	<table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#2e81c1" style="border-bottom:solid; border-bottom-color:#2e81c1" >
	    <tr >
	      <td width="813" height="25">SLOC Report </td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
	   	  
	  <td align="center" colspan="4" >
	  
	  
	  	<form name="frmaddDepartment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" > 
	 	<input name="frm_action" value="submit" type="hidden"> 
	   	<input name="txtvariety" value="<?php echo $variety?>" type="hidden"> 
	    <input name="txtcrop" value="<?php echo $crop;?>" type="hidden">  
		<input name="slchk" value="<?php echo $slchk;?>" type="hidden">  
		<input name="slchk2" value="<?php echo $slchk2;?>" type="hidden">  
		<input name="sdate" value="<?php echo $sdate;?>" type="hidden">  
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>

<tr>
<td width="30"></td> <td>

	<table align="center" border="0" cellspacing="0" cellpadding="0" width="850" style="border-collapse:collapse">
	   <tr height="25">
	 		<td align="center" class="subheading" style="color:#303918; " colspan="3">SLOC Report From <?php echo $_GET['sdate'];?> To <?php echo $_GET['edate'] ?></td>
	   </tr>
	 </table>
   
   <table  border="1" cellspacing="0" cellpadding="0" width="986" bordercolor="#2e81c1" style="border-collapse:collapse" align="center">
		<thead>
			<tr class="tblsubtitle" height="25">
				<th rowspan="2" width="19" align="center" valign="middle" class="tblheading">#</th>
				<th rowspan="2" width="70" align="center" valign="middle" class="tblheading">Date</th>
				<th rowspan="2" width="40"  align="center" valign="middle" class="tblheading">Stage</th>
				<th rowspan="2" width="80"  align="center" valign="middle" class="tblheading">Crop</th>
				<th rowspan="2" width="80"  align="center" valign="middle" class="tblheading">Variety</th>
				<th rowspan="2" width="80"  align="center" valign="middle" class="tblheading">Lot No.</th>
				<th width="100"  align="center" valign="middle" class="tblheading" colspan="5">FROM SLOC</th>
				<th width="100"  align="center" valign="middle" class="tblheading" colspan="5">TO SLOC</th>
				<th rowspan="2" width="40"  align="center" valign="middle" class="tblheading">User</th>
			</tr>

			<tr class="tblsubtitle" height="25">
				
				<th valign="middle" class="tblheading">SLOC</th>
				<th valign="middle" class="tblheading">NoB/NoP</th>
				<th valign="middle" class="tblheading">Qty</th>
				<th valign="middle" class="tblheading">NoMP</th>
				<th valign="middle" class="tblheading">Wb</th>
				
				<th valign="middle" class="tblheading">SLOC</th>
				<th valign="middle" class="tblheading">NoB/NoP</th>
				<th valign="middle" class="tblheading">Qty</th>
				<th valign="middle" class="tblheading">NoMP</th>
				<th valign="middle" class="tblheading">Wb</th>
			</tr>

		</thead>



		<tbody>
		
			<?php

			$srno=1;
			// echo($qry);

			// echo("<br>".$tot_arr_home);

			if ($tot_arr_home > 0) {
				while ($row_arr_home = mysqli_fetch_array($sql_arr_home)) {
					$slnew_id = $row_arr_home['slnew_id'];
					$tdate = $row_arr_home['slnew_date'];
					$slnew_logid = $row_arr_home['slnew_logid'];
			
					$qry_to = "SELECT * FROM tbl_slocnew_from WHERE slnew_id = $slnew_id ";
			
					if ($crop != "ALL") {
						$qry_to .= " AND slnf_crop='$crop' ";
					}
					if ($variety != "ALL") {
						$qry_to .= " AND slnf_variety='$variety' ";
					}
			
					$qry_to .= " ;";
			
					$sql_q2 = mysqli_query($link, $qry_to) or die(mysqli_error($link));
					$tot_arr_q2 = mysqli_num_rows($sql_q2);
			
					if ($tot_arr_q2 > 0) {
						while ($row_q2 = mysqli_fetch_array($sql_q2)) {
							
							$slnf_id = $row_q2['slnf_id'];
							
							
							$lotno = $row_q2['slnf_lotno'];
							$stage = $row_q2['slnf_stage'];

							$slnf_fwh = $row_q2['slnf_fwh'];
							$slnf_fbin = $row_q2['slnf_fbin'];
							$slnf_fsbin = $row_q2['slnf_fsbin'];

							$slnf_fnob = $row_q2['slnf_fnob'];
							$slnf_fnomp = $row_q2['slnf_fnomp'];
							$slnf_fwb = $row_q2['slnf_fwb'];
							$slnf_fqty = $row_q2['slnf_fqty'];

							$fwhid = $row_q2['slnf_fwh'];
							$fbinid = $row_q2['slnf_fbin'];
							$fsubbinid = $row_q2['slnf_fsbin'];

							$from_qWh = "SELECT perticulars FROM `tbl_warehouse` WHERE whid = $fwhid LIMIT 1;";
							$from_qBin = "SELECT binname FROM `tbl_bin` WHERE binid = $fbinid LIMIT 1;";
							$from_qSubBin = "SELECT sname FROM `tbl_subbin` WHERE sid = $fsubbinid LIMIT 1;";
							
							$sql_wh = mysqli_query($link, $from_qWh) or die(mysqli_error($link));
							$tot_sql_wh = mysqli_num_rows($sql_wh);
			
							$from_whname = ""; $from_binname = ""; $from_subbinname = "";

							if ($tot_sql_wh > 0) {
								while ($whx = mysqli_fetch_array($sql_wh)) {
									$from_whname = $whx['perticulars'];
								}
							}

							$sql_bin = mysqli_query($link, $from_qBin) or die(mysqli_error($link));
							$tot_sql_bin = mysqli_num_rows($sql_bin);
			

							if ($tot_sql_bin > 0) {
								while ($binx = mysqli_fetch_array($sql_bin)) {
									$from_binname = $binx['binname'];
								}
							}

							$sql_subbin = mysqli_query($link, $from_qSubBin) or die(mysqli_error($link));
							$tot_sql_subbin = mysqli_num_rows($sql_subbin);
			

							if ($tot_sql_subbin > 0) {
								while ($subbinx = mysqli_fetch_array($sql_subbin)) {
									$from_subbinname = $subbinx['sname'];
								}
							}

							$from_sloc = $from_whname . "/" . $from_binname . "/" . $from_subbinname; 


							
							$qry_three = "SELECT * FROM tbl_slocnew_to WHERE slnf_id = $slnf_id;";
							$sql_q3 = mysqli_query($link, $qry_three) or die(mysqli_error($link));
							$tot_arr_q3 = mysqli_num_rows($sql_q3);
			
							if ($tot_arr_q3 > 0) {
								while ($row_q3 = mysqli_fetch_array($sql_q3)) {
									$crop_name = $row_q3['slnt_crop'];
									$variety_name = $row_q3['slnt_variety'];
			
									$slnt_tnob = $row_q3['slnt_tnob'];
									$slnt_tnomp = $row_q3['slnt_tnomp'];
									$slnt_twb = $row_q3['slnt_twb'];
									$slnt_tqty = $row_q3['slnt_tqty'];
		




									$twhid = $row_q3['slnt_twh'];
									$tbinid = $row_q3['slnt_tbin'];
									$tsubbinid = $row_q3['slnt_tsbin'];
		
									$to_qWh = "SELECT perticulars FROM `tbl_warehouse` WHERE whid = $twhid LIMIT 1;";
									$to_qBin = "SELECT binname FROM `tbl_bin` WHERE binid = $tbinid LIMIT 1;";
									$to_qSubBin = "SELECT sname FROM `tbl_subbin` WHERE sid = $tsubbinid LIMIT 1;";
									
									$tsql_wh = mysqli_query($link, $to_qWh) or die(mysqli_error($link));
									$ttot_sql_wh = mysqli_num_rows($tsql_wh);
					
									$to_whname = ""; $to_binname = ""; $to_subbinname = "";
		
									if ($ttot_sql_wh > 0) {
										while ($twhx = mysqli_fetch_array($tsql_wh)) {
											$to_whname = $twhx['perticulars'];
										}
									}
		
									$tsql_bin = mysqli_query($link, $to_qBin) or die(mysqli_error($link));
									$ttot_sql_bin = mysqli_num_rows($tsql_bin);
					
		
									if ($ttot_sql_bin > 0) {
										while ($tbinx = mysqli_fetch_array($tsql_bin)) {
											$to_binname = $tbinx['binname'];
										}
									}
		
									$tsql_subbin = mysqli_query($link, $to_qSubBin) or die(mysqli_error($link));
									$ttot_sql_subbin = mysqli_num_rows($tsql_subbin);
					
		
									if ($ttot_sql_subbin > 0) {
										while ($tsubbinx = mysqli_fetch_array($tsql_subbin)) {
											$to_subbinname = $tsubbinx['sname'];
										}
									}
		
									$to_sloc = $to_whname . "/" . $to_binname . "/" . $to_subbinname; 
		




									// Output the table row
									?>
									<tr class="Light" height="25">
										<td align="center" valign="middle" class="tblheading"><?php echo $srno?></td>
										<td align="center" valign="middle" class="tblheading"><?php echo $tdate?></td>
										<td align="center" valign="middle" class="tblheading"><?php echo $stage?></td>
										<td align="center" valign="middle" class="tblheading"><?php echo $crop_name?></td>
										<td align="center" valign="middle" class="tblheading"><?php echo $variety_name?></td>
										<td align="center" valign="middle" class="tblheading"><?php echo $lotno?></td>
										<td align="center" valign="middle" class="tblheading"><?php echo $from_sloc?></td>
										<td align="center" valign="middle" class="tblheading"><?php echo $slnf_fnob?></td>
										<td align="center" valign="middle" class="tblheading"><?php echo $slnf_fqty?></td>
										<td align="center" valign="middle" class="tblheading"><?php echo $slnf_fnomp?></td>
										<td align="center" valign="middle" class="tblheading"><?php echo $slnf_fwb?></td>
										<td align="center" valign="middle" class="tblheading"><?php echo $to_sloc?></td>
										<td align="center" valign="middle" class="tblheading"><?php echo $slnt_tnob?></td>
										<td align="center" valign="middle" class="tblheading"><?php echo $slnt_tqty?></td>
										<td align="center" valign="middle" class="tblheading"><?php echo $slnt_tnomp?></td>
										<td align="center" valign="middle" class="tblheading"><?php echo $slnt_twb?></td>
										<td align="center" valign="middle" class="tblheading"><?php echo $slnew_logid?></td>
									</tr>
									<?php
									$srno++;
								}
							}
						}
					}
				}
			}

			?>

		
		</tbody>
   </table>
<table width="974" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td height="49" align="center" valign="top"><a href="select_page_sloc_report.php"><img src="../images/back.gif" border="0"  style="display:inline;cursor:pointer;"/></a><!--&nbsp;&nbsp;<img src="../images/printpreview.gif" onclick="openprint()" style="cursor:pointer" border="0" />-->
  <input type="hidden" name="txtinv" /></td>
</tr>
</table>
</td><td ></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  </td>
	  </tr>
	  </table>
<!-- actual page end--->			  
		  </td>
        </tr>
        <tr>
          <td width="989" valign="top" align="center"  class="border_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>   
</body>
</html>
