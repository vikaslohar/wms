<?php
session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='login.php' ";
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
	?>

<div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/logotrac.gif" border="0"  /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
			<ul  id="nav"> 
			<?php if($role == "admin" || $role == "obadmin")
			{
			?>
			<li><a href="index1.php">Masters</a>
              <ul>
                <li><a href="../masters/home_crop.php">&nbsp;Crop&nbsp;Master</a></li>
				<li><a href="../masters/selectups.php">&nbsp;UPS&nbsp;Master</a></li>
                <li><a href="../masters/home_variety.php">&nbsp;Variety&nbsp;Master</a></li>
				<li><a href="../masters/home_classification.php">&nbsp;Classification&nbsp;Master</a></li>
				 <li><a href="../masters/home_country.php">&nbsp;Country&nbsp;Master</a></li>
				 <li><a href="../masters/home_location.php">&nbsp;Location&nbsp;Master</a></li>
				 <li><a href="../masters/home_gotlocation.php">&nbsp;GOT&nbsp;Location&nbsp;Master</a></li>
                <li><a href="../masters/party_masterhome.php">&nbsp;Party&nbsp;Master</a></li>
				<li><a href="../masters/home_order.php">&nbsp;Order&nbsp;Suspension&nbsp;</a></li>
				<?php
				if($role != "obadmin")
			{
			?>
				<li><a href="../masters/operator_home1.php">&nbsp;Operator&nbsp;Master</a></li>
				<li><a href="../masters/viewer_home.php">&nbsp;Report&nbsp;Viewer&nbsp;Master</a></li>
				<li><a href="../masters/help_home.php">&nbsp;Help&nbsp;Manual&nbsp;Master</a></li>
				<li><a href="../masters/faq_home.php">&nbsp;FAQ&nbsp;Master</a></li>
               	<li><a href="../masters/companyhome.php">&nbsp;Parameters&nbsp;Master</a></li>
				<li><a href="../masters/selectbin.php" >&nbsp;SLOC&nbsp;Master</a></li>
				<li><a href="../masters/selectbin1.php" >&nbsp;GS&nbsp;SLOC&nbsp;Master</a></li>
				<li><a href="../masters/selectbin2.php" >&nbsp;Damage&nbsp;SLOC&nbsp;Master</a></li>
				<li><a href="../masters/selectbin3.php" >&nbsp;SR-PV&nbsp;SLOC&nbsp;Master</a></li>
				<li><a href="../masters/selectbin4.php" >&nbsp;SR&nbsp;SLOC&nbsp;Master</a></li>
				<li><a href="../masters/home_resource.php" >&nbsp;Resource&nbsp;Master</a></li>
				<li><a href="../masters/current_year.php">&nbsp;Year&nbsp;Management&nbsp;Master</a></li>
				<li><a href="../masters/current_year2.php">&nbsp;Financial&nbsp;Year&nbsp;Management</a></li>
				<?php
				}
				?>
				
                
              </ul>
            </li>
			<li><a href="index1.php">Reports</a>
              <ul><?php
			  // $role;
				if($role == "obadmin")
			{
			?>
			<li><a href="../report/masterreports1.php" >&nbsp;Master&nbsp;Reports</a></li>
			<?php
			}
			else
			{
			?>
			  <!--<li><a href="report/productionlocation.php" >&nbsp;Production&nbsp;Location&nbsp;wise&nbsp;Report</a></li>
                 <li><a href="report/lotdesti1.php" >&nbsp;Lot&nbsp;Destination &nbsp;wise&nbsp;Report</a></li>
				   <li><a href="#" >&nbsp;Period&nbsp;wise&nbsp;Report</a></li>-->
                <li><a href="../report/masterreports.php" >&nbsp;Master&nbsp;Reports</a></li>
				<?php
				}?>
              </ul>
            </li>
            <li>
            <a href="index1.php">Utility </a>
			<ul><li><a href=" Javascript:void(0)" onClick="window.open('../masters/abbravation.php','WelCome','top=10,left=50,width=960,height=400,scrollbars=Yes')" >&nbsp;Abbreviations</a></li>
			<!--  <li><a href=" Javascript:void(0)" onClick="window.open('utility/pdn1.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;PDN&nbsp;Printing</a></li>
			   <li><a href=" Javascript:void(0)" onClick="window.open('utility/geog.php','WelCome','top=10,left=50,width=650,height=300,scrollbars=yes')" >&nbsp;GI&nbsp;Generation&nbsp;Tool</a></li>
			   <li><a href=" Javascript:void(0)" onClick="window.open('utility/abbravation.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Abbreviations&nbsp;</a></li>-->
			   <li><a href=" Javascript:void(0)" onClick="window.open('../masters/backup.php','WelCome','top=10,left=50,width=650,height=900,scrollbars=yes')" >&nbsp;Backup</a></li>
		             </ul>
            </li>
			<?php
			}
			else if($role == "decode")
			{
			?>
			<?php
			$sql_oop=mysqli_query($link,"select * from tblopr where id='$loginid' and plantcode='$plantcode'")or die(mysqli_error($link)); 
			$total_oop=mysqli_num_rows($sql_oop);
			$row_oop=mysqli_fetch_array($sql_oop);
			if($row_oop['addmflg']=="Yes")
			{
			?>
			<li><a href="index1.php">Masters</a>
              <ul>
                <li><a href="masters/home_location.php" >&nbsp;Production&nbsp;Location&nbsp;Master</a></li>
                <li><a href="masters/home_organiser.php" >&nbsp;Organiser&nbsp;Master</a></li>
				<li><a href="masters/home_farmer.php" >&nbsp;Farmer&nbsp;Master</a></li>
			  </ul>
            </li>
			<?php
			}
			?>
            <li><a href="index1.php">Transactions</a>
             <ul>
			    <li><a href="transaction/home_freshpdn.php">&nbsp;Fresh&nbsp;Seed&nbsp;with&nbsp;PDN</a></li>
				<li><a href="transaction/home_lot_transfer.php">&nbsp;Lot&nbsp;Destination</a></li>
				<!--<li><a href="transaction/home_export_eligibility.php">&nbsp;Export&nbsp;Eligibility</a></li>-->
				<li><a href="transaction/home_suspend.php">&nbsp;Lot&nbsp;Suspension</a></li>
			 </ul>
            </li>
            <li><a href="index1.php">Reports</a>
              <ul><li><a href="report/productionlocation.php" >&nbsp;Production&nbsp;Location&nbsp;wise&nbsp;Report</a></li>
                <li><a href="report/lotdesti1.php" >&nbsp;Lot&nbsp;Destination &nbsp;wise&nbsp;Report</a></li>
               
              </ul>
            </li>
            <li>
            <a href="index1.php">Utility</a>
			<ul><li><a href=" Javascript:void(0)" onClick="window.open('utility/utility_lot.php','WelCome','top=10,left=50,width=960,height=400,scrollbars=NO')" >&nbsp;Lot&nbsp;Query</a></li>
			  <li><a href=" Javascript:void(0)" onClick="window.open('utility/pdn1.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;PDN&nbsp;Printing</a></li>
			    <li><a href=" Javascript:void(0)" onClick="window.open('utility/geog.php','WelCome','top=10,left=50,width=650,height=300,scrollbars=yes')" >&nbsp;GI&nbsp;Generation&nbsp;Tool</a></li>
				  <li><a href=" Javascript:void(0)" onClick="window.open('utility/abbravation.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Abbreviations&nbsp;</a></li>
		             </ul>
            </li>
			<?php
			}
			else if($role == "plant")
			{
			?>
			<li><a href="index1.php">Transactions</a>
             <ul>
			    <li><a href="transaction/home_trading.php">&nbsp;Trading&nbsp;Lot</a></li>
                <li><a href="transaction/home_unidenti.php">&nbsp;Unidentified&nbsp;Lot</a></li>
                <li><a href="transaction/home_lot_mrger.php" >&nbsp;Lot&nbsp;Merger&nbsp;</a></li>
                <li><a href="transaction/home_existing.php" >&nbsp;Lot&nbsp;Regularisation</a></li>
                <!--<li><a href="transaction/home_lot_transfer.php">&nbsp;Lot&nbsp;Destination</a></li>
				<li><a href="transaction/home_suspend.php">&nbsp;Lot&nbsp;Suspension</a></li>-->
				<li><a href="transaction/home_tagging.php">&nbsp;Import&nbsp;Acknowledgement</a></li>
              </ul>
            </li>
            <li><a href="index1.php">Reports</a>
              <ul>
			  <!--<li><a href="report/productionlocation.php" >&nbsp;Production&nbsp;Location&nbsp;wise&nbsp;Report</a></li>-->
                <li><a href="report/lotdesti1.php" >&nbsp;Lot&nbsp;Destination &nbsp;wise&nbsp;Report</a></li>
               
              </ul>
            </li>
            <li>
            <a href="index1.php">Utility</a>
			<ul><li><a href=" Javascript:void(0)" onClick="window.open('utility/utility_lot.php','WelCome','top=10,left=50,width=960,height=400,scrollbars=NO')" >&nbsp;Lot&nbsp;Query</a></li>
		             <li><a href=" Javascript:void(0)" onClick="window.open('utility/pdn1.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;PDN&nbsp;Printing</a></li>
					   <!--<li><a href=" Javascript:void(0)" onClick="window.open('utility/geog.php','WelCome','top=10,left=50,width=650,height=300,scrollbars=yes')" >&nbsp;GI&nbsp;Generation&nbsp;Tool</a></li>-->
					     <li><a href=" Javascript:void(0)" onClick="window.open('utility/abbravation.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Abbreviations&nbsp;</a></li>
		             </ul>
            </li>
			<?php
			}
			?>
			</ul>
            </div>
            </div> <div class="toplinks" style="vertical-align:text-top">
              <ul style="vertical-align:text-top">
                <?php if($role == "admin")
				{
			  ?>
                <li> <a href="../masters/adminprofile.php" >Profile</a> | </li>
				<?php
				}
				else
				{
				?>
				<li> <a href="../masters/adminprofile.php" >Profile</a> | </li>
				<?php
				}
				?>
				 <li>&nbsp;&nbsp;<a href="#">FAQ</a> | </li>
				<li>&nbsp;&nbsp;<a href="#" >Help</a> | </li>
                <li> &nbsp;&nbsp;<a href="../logout.php" >Logout </a></li>
              </ul>
			 </div>
			<!--<div style="border: 0px solid red; float: right; width: 290px; clear: right; font-size:5px; font-weight:bold; list-style-type:none"/>
			 <ul style="vertical-align:text-bottom; text-align:left; text-decoration:none;">
			 <li style="float:left; position:relative; display:inline; vertical-align:text-bottom; text-align:left; color:#FFFFFF">&nbsp;</li>
			 </ul>
			 </div>-->
			 <div style="border:0px solid red; float:right; width: 290px; clear:right; font-size:11px;  padding-top:0px; height:15px; font-weight:bold; list-style-type:none;"/>
			 <ul style="vertical-align:text-top; text-align:left; text-decoration:none;">
			 <li style="float:right; position:relative; display:inline; vertical-align:text-top; text-align:left; color:#000000">&nbsp;<?php echo date("l, d-m-Y");?>&nbsp;&nbsp;&nbsp;&nbsp; </li>
			 </ul>
			 </div>
			   <div style="border: 0px solid red; float: right; width: 290px; clear: right; font-size:11px; font-weight:bold; list-style-type:none"/>
              
			  <?php
			  	$sql_plant=mysqli_query($link,"select * from tbl_parameters where plantcode='$plantcode'") or die(mysqli_error($link));
				$row_plant=mysqli_fetch_array($sql_plant);
				$plantname=$row_plant['pcity'];
			  	if($role=="admin")
				{
					$logname="Admin";
				}
				else if($role=="obadmin")
				{
					$logname="Obdmin";
				}
				else
				{
					$sql_opr=mysqli_query($link,"select * from tblopr where id='".$loginid."' and plantcode='$plantcode'") or die(mysqli_error($link));
					$row_opr=mysqli_fetch_array($sql_opr);
					$logname=$row_opr['name'];
				}
				?>
			  <ul style="vertical-align:text-bottom; text-align:right; text-decoration:none;">
			  <li style="float:right; position:relative; display:inline; vertical-align:text-bottom; text-align:left; color:#FFFFFF">&nbsp;Wel-Come&nbsp;&nbsp;<?php echo ucwords($logname);?>&nbsp;|&nbsp;<?php echo ucwords($plantname);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
			  </ul>
			  
			  </div>	
            </div>