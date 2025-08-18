<div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/viewer_logotrac.jpg" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
			<ul  id="nav"> 
			<?php 
			  /*	$sql_opr=mysqli_query($link,"select * from tbl_viewer where vid='".$loginid."'") or die(mysqli_error($link));
			  	$row_opr=mysqli_fetch_array($sql_opr);
				$scd=$row_opr['vcode'];
				if($scd=="1")
				{
				?>
			  <li><a href="index1.php">Transactions</a>
             <ul>
			    <li><a href="../viewer/add_lotps.php">&nbsp;Settlement </a></li>
               <!-- <li><a href="../csw/home_sloc.php">&nbsp;SLOC&nbsp;Updation</a></li>
                <li><a href="../csw/home_lot_mrger.php" >&nbsp;Status&nbsp;Updation&nbsp;</a></li>
              <li><a href="transaction/home_existing.php" >&nbsp;Lot&nbsp;Regularisation</a></li>
                <li><a href="transaction/home_lot_transfer.php">&nbsp;Lot&nbsp;Destination</a></li>
				<li><a href="transaction/home_suspend.php">&nbsp;Lot&nbsp;Suspension</a></li>
				<li><a href="transaction/home_tagging.php">&nbsp;Import&nbsp;Acknowledgement</a></li>-->
              </ul>
            </li> <?php } */?>
            <li><a href="index1.php">Reports</a>
              <ul>
			  <?php 
			  /*	$sql_opr=mysqli_query($link,"select * from tbl_viewer where vid='".$loginid."'") or die(mysqli_error($link));
			  	$row_opr=mysqli_fetch_array($sql_opr);
				$scd=$row_opr['vcode'];
				if($scd=="1")
				{
				?>
			 <li><a href="../viewer/report_orgw_prosts.php">&nbsp;Organiser wise&nbsp;Processing&nbsp;Report</a></li>
			 <li><a href="../viewer/report_dailarr_prosts.php">&nbsp;Periodical&nbsp;Arrival&nbsp;Report</a></li>
			 <li><a href="../viewer/report_orgw_ps.php">&nbsp;Organiser wise&nbsp;Settlement&nbsp;Report</a></li>
			 <?php } else { */?>
			 <li><a href="../viewer/preport_plant.php">&nbsp;Consolidated&nbsp;Arrival&nbsp;Report</a></li>
			 <li><a href="../viewer/report_variety.php">&nbsp;Crop&nbsp;Variety&nbsp;Wise&nbsp;Arrival&nbsp;Report</a></li>
			 <li><a href="../viewer/report_rawcrop.php">&nbsp;Crop&nbsp;Variety&nbsp;Wise&nbsp;Stock&nbsp;Report</a></li>
			 <li><a href="../viewer/report_rawcropq.php">&nbsp;Quality&nbsp;based&nbsp;Stock&nbsp;Report</a></li>
			 <li><a href="../viewer/stock_report.php">&nbsp;Stock&nbsp;Report</a></li>
			 <li><a href="../viewer/crop_ver_sr_report.php">&nbsp;Crop&nbsp;Variety&nbsp;wise&nbsp;SR&nbsp;Report</a></li>
             <li><a href="../viewer/partywise_sr_report.php">&nbsp;Party&nbsp;Wise&nbsp;SR&nbsp;Report</a></li>
			 <li><a href="../viewer/statewise_sr_report.php">&nbsp;State&nbsp;Wise&nbsp;SR&nbsp;Report</a></li>	
			 <li><a href="../viewer/sr_pwdamage_report.php">&nbsp;Party&nbsp;Wise&nbsp;Damage&nbsp;SR&nbsp;Report</a></li>
			 <li><a href="../viewer/cvwisedamage_sr_report.php">&nbsp;Crop&nbsp;Variety&nbsp;Wise&nbsp;Damage&nbsp;SR</a></li>
			 <li><a href="../viewer/usefullstock_report.php">&nbsp;Ready&nbsp;Stock&nbsp;Report</a></li>
			 <li><a href="../viewer/report_stockladgerbob.php">&nbsp;Stock&nbsp;Ladger&nbsp;Report</a></li>
			 <li><a href="../viewer/report_pswstock.php">&nbsp;Pack&nbsp;Seed&nbsp;Stock&nbsp;Report</a></li>
			 <?php //} ?>
              </ul>
            </li>
            <!--<li>
            <a href="index1.php">Utility</a>
			<ul> <li><a href=" Javascript:void(0)" onClick="window.open('../viewer/utility_lot.php','WelCome','top=10,left=50,width=960,height=400,scrollbars=NO')" >&nbsp;Lot&nbsp;Query</a></li>
		           <li><a href=" Javascript:void(0)" onClick="window.open('../viewer/slocreport.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;PDN&nbsp;Printing</a></li>
					   <li><a href=" Javascript:void(0)" onClick="window.open('utility/geog.php','WelCome','top=10,left=50,width=650,height=300,scrollbars=yes')" >&nbsp;GI&nbsp;Generation&nbsp;Tool</a></li>
					     <li><a href=" Javascript:void(0)" onClick="window.open('utility/abbravation.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Abbreviations&nbsp;</a></li>
		             </ul>
            </li>-->
			
			</ul>
            </div>
            </div> <div class="toplinks" style="vertical-align:text-top">
              <ul style="vertical-align:text-top">
   			<li> <a href="../viewer/operprofile.php" >Profile</a> | </li>
				 <li>&nbsp;<a href="../viewer/faq.php">FAQ</a> | </li>
				<li>&nbsp; <a href="../viewer/help.php">Help</a> | </li>
                <li> &nbsp;<a href="../logout.php">Logout</a> </li>
              </ul>
			 </div>
			<!--<div style="border: 0px solid red; float: right; width: 290px; clear: right; font-size:5px; font-weight:bold; list-style-type:none;"/>
			 <ul style="vertical-align:text-bottom; text-align:left; text-decoration:none;">
			 <li style="float:left; position:relative; display:inline; vertical-align:text-bottom; text-align:left; color:#000000">&nbsp;</li>
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
				else if($role=="viewer")
				{
					$sql_opr=mysqli_query($link,"select * from tbl_viewer where vid='".$loginid."' and plantcode='$plantcode'") or die(mysqli_error($link));
					$row_opr=mysqli_fetch_array($sql_opr);
					$logname=$row_opr['name'];
				}
				else
				{
					$sql_opr=mysqli_query($link,"select * from tblopr where id='".$loginid."' and plantcode='$plantcode'") or die(mysqli_error($link));
					$row_opr=mysqli_fetch_array($sql_opr);
					$logname=$row_opr['name'];
				}
				?>
			  <ul style="vertical-align:text-bottom; text-align:right; text-decoration:none;">
			  <li style="float:right; position:relative; display:inline; vertical-align:text-bottom; text-align:left; color:#000000">&nbsp;Wel-Come&nbsp;&nbsp;<?php echo ucwords($logname);?>&nbsp;|&nbsp;<?php echo ucwords($plantname);?>&nbsp;&nbsp;&nbsp;&nbsp;</li>
			  </ul>
			  </div>	
            </div>
