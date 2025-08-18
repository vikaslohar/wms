<div class="headerwrapper">
            <div class="logo"><a href="index1.php"><img src="../images/dispatch_logotrac.gif" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
			<ul  id="nav"> 
						<?php
			 if($role == "dispatch")
			{
			?>
			<?php
			$oprflg=0;
			$sql_oop=mysqli_query($link,"select * from tblopr where id='$loginid' and plantcode='$plantcode'")or die(mysqli_error($link)); 
			$total_oop=mysqli_num_rows($sql_oop);
			$row_oop=mysqli_fetch_array($sql_oop);
			
			?>
            <li><a href="#">Transactions</a>
             <ul>
			    <li><a href="../dispatch/home_dispbulk.php">&nbsp;Dispatch&nbsp;Bulk Seed</a></li>
				<li><a href="../dispatch/home_dispstocktran.php">&nbsp;Stock&nbsp;Transfer - Plant&nbsp;</a></li>
				<li><a href="../dispatch/home_disppack.php">&nbsp;Direct&nbsp;Dispatch&nbsp;</a></li>
				<li><a href="../dispatch/add_discard.php">&nbsp;Material&nbsp;Discard</a></li>
				<li><a href="../dispatch/home_dispallocation.php">&nbsp;Dispatch&nbsp;Allocation</a></li>
				<li><a href="../dispatch/home_disppackalc.php">&nbsp;Allocation&nbsp;Based&nbsp;Dispatch</a></li>
				<li><a href="../dispatch/home_dispp2p_packseed.php">&nbsp;Dispatch&nbsp;Pack&nbsp;Seed&nbsp;-&nbsp;Plant</a></li>
				<!--<li><a href="../dispatch/home_disppack_rng.php">&nbsp;Direct&nbsp;Dispatch&nbsp;with&nbsp;Range&nbsp;</a></li>-->
				<li><a href="../dispatch/home_disptdf.php">&nbsp;Dispatch&nbsp;TDF&nbsp;Seed&nbsp;</a></li>
				<li><a href="../dispatch/home_remqtyspld.php">&nbsp;Pack&nbsp;Seed&nbsp;SP&nbsp;Release-RO&nbsp;</a></li>
			 </ul>
            </li>
			
            <li><a href="#">Reports</a>
            <ul>
			<li><a href="../dispatch/periodical_pack_report.php">&nbsp;Pack&nbsp;Seed&nbsp;Activity&nbsp;Report</a></li>
			<li><a href="../dispatch/periodical_cpvrtypack_report.php">&nbsp;Varety&nbsp;wise&nbsp;Pack&nbsp;Seed&nbsp;Report</a></li>
			<li><a href="../dispatch/periodical_dispatch_report_new.php">&nbsp;Periodical&nbsp;Dispatch&nbsp;Report</a></li>
			<li><a href="../dispatch/daybook_dispatch_report.php">&nbsp;Periodical&nbsp;Dispatch&nbsp;Report-&nbsp;DC&nbsp;wise</a></li>
           <li><a href="../dispatch/cons_cv_dispatch_report.php">&nbsp;Consolidated&nbsp;CV&nbsp;wise&nbsp;Dispatch&nbsp;Report</a></li>
		   <li><a href="../dispatch/report_packagingperiod.php">&nbsp;Periodical&nbsp;Packaging&nbsp;Report&nbsp;(L/N/M)</a></li>
		   <li><a href="../dispatch/cv_ret_dispatch_report.php">&nbsp;CV&nbsp;wise&nbsp;C&F&nbsp;Dispatch&nbsp;Report</a></li>
			 <!-- <li><a href="../arrival/report_unidentified.php">&nbsp;Unidentified&nbsp;Arrival&nbsp;Report</a></li>				  
			<li><a href="../arrival/report_organiser.php">&nbsp;Organiser&nbsp;Wise&nbsp;Report</a></li>
			<li><a href="../arrival/report_location.php">&nbsp;production&nbsp;Location&nbsp;Wise&nbsp;Report</a></li>
			<li><a href="../arrival/report_productionp.php">&nbsp;Production&nbsp;Personnel&nbsp;Wise&nbsp;Report</a></li>
			<li><a href="../arrival/preport_plant.php">&nbsp;Stock&nbsp;Transfer&nbsp;CropVariety&nbsp;Wise&nbsp;Report</a></li>
			<li><a href="../arrival/report_crop.php">&nbsp;Arrival&nbsp;Crop&nbsp;Variety&nbsp;Wise&nbsp;Report</a></li>-->
					  
              </ul>
            </li>
            <li>
            <a href="#">Utility</a>
			<ul>
			<!--<li><a href=" Javascript:void(0)" onClick="window.open('../dispatch/slocreport.php','WelCome','top=10,left=50,width=960,height=400,scrollbars=NO')" >&nbsp;SLOC&nbsp;Search</a></li>-->
			 <li><a href=" Javascript:void(0)" onClick="window.open('../dispatch/view_barcodes.php','WelCome','top=10,left=50,width=900,height=400,scrollbars=yes')" >&nbsp;Barcode&nbsp;View</a></li>
			   <!-- <li><a href=" Javascript:void(0)" onClick="window.open('../dispatch/utility_lot.php','WelCome','top=10,left=50,width=650,height=300,scrollbars=yes')" >&nbsp;Decode&nbsp;- SLOC Lookup</a></li>
				  <li><a href=" Javascript:void(0)" onClick="window.open('../dispatch/abbravation.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Abbreviations&nbsp;</a></li>-->
		             </ul>
            </li>
			<?php
			}
			else if($role == "dispatch")
			{
			?>
			<li><a href="index1.php">Transactions</a>
             <ul>
			    <!-- <li><a href="transaction/home_trading.php">&nbsp;Trading&nbsp;Lot</a></li>
                <li><a href="transaction/home_unidenti.php">&nbsp;Unidentified&nbsp;Lot</a></li>
                <li><a href="transaction/home_lot_mrger.php" >&nbsp;Lot&nbsp;Merger&nbsp;</a></li>
                <li><a href="transaction/home_existing.php" >&nbsp;Lot&nbsp;Regularisation</a></li>
               <li><a href="transaction/home_lot_transfer.php">&nbsp;Lot&nbsp;Destination</a></li>
				<li><a href="transaction/home_suspend.php">&nbsp;Lot&nbsp;Suspension</a></li>
				<li><a href="transaction/home_tagging.php">&nbsp;Import&nbsp;Acknowledgement</a></li>-->
              </ul>
            </li>
            <li><a href="index1.php">Reports</a>
              <ul>
			  <!--<li><a href="report/productionlocation.php" >&nbsp;Production&nbsp;Location&nbsp;wise&nbsp;Report</a></li>
                <li><a href="report/lotdesti1.php" >&nbsp;Lot&nbsp;Destination &nbsp;wise&nbsp;Report</a></li>-->
               
              </ul>
            </li>
            <li>
            <a href="index1.php">Utility</a>
			<ul> <!-- <li><a href=" Javascript:void(0)" onClick="window.open('utility/utility_lot.php','WelCome','top=10,left=50,width=960,height=400,scrollbars=NO')" >&nbsp;Lot&nbsp;Query</a></li>
		           <li><a href=" Javascript:void(0)" onClick="window.open('utility/pdn1.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;PDN&nbsp;Printing</a></li>
					   <li><a href=" Javascript:void(0)" onClick="window.open('utility/geog.php','WelCome','top=10,left=50,width=650,height=300,scrollbars=yes')" >&nbsp;GI&nbsp;Generation&nbsp;Tool</a></li>
					     <li><a href=" Javascript:void(0)" onClick="window.open('utility/abbravation.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Abbreviations&nbsp;</a></li>-->
		             </ul>
            </li>
			<?php
			}
			?>
			</ul>
            </div>
            </div> <div class="toplinks" style="vertical-align:text-top">
              <ul style="vertical-align:text-top">
                <?php if($role == "dispatch")
				{
			  ?>
               
				<li> <a href="../dispatch/operprofile.php" >Profile</a> | </li>
				<?php
				}
				?>
				 <li>&nbsp;<a href="../dispatch/faq.php">FAQ</a> | </li>
				<li>&nbsp; <a href="../dispatch/help.php">Help</a> | </li>
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