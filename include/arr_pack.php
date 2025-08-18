<div class="headerwrapper">
            <div class="logo"><a href="index1.php"><img src="../images/pack_logotrac.gif" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
			<ul  id="nav"> 
						<?php
			 if($role == "packaging")
			{
			?>
			<?php
			$sql_oop=mysqli_query($link,"select * from tblopr where id='$loginid' and plantcode='$plantcode'")or die(mysqli_error($link)); 
			$total_oop=mysqli_num_rows($sql_oop);
			$row_oop=mysqli_fetch_array($sql_oop);
			?>
            <li><a href="#">Transactions</a>
             <ul>
			 <li><a href="../packging/home_packslip.php">&nbsp;Packing&nbsp;Slip</a></li>
			 <li><a href="../packging/home_pronpslip.php">&nbsp;Online&nbsp;Processing&nbsp&amp;&nbsp;Packing&nbsp;Slip</a></li>
			 <li><a href="../packging/home_pronpslip_fc.php">&nbsp;Online&nbsp;Processing&nbsp&amp;&nbsp;Packing&nbsp;Slip (FC)</a></li>
			 <li><a href="../packging/home_nstpackslip.php">&nbsp;NST&nbsp;Packing&nbsp;Slip</a></li>
			 <li><a href="../packging/home_packaging_sel.php">&nbsp;Packaging&nbsp;Slip</a></li>
			 <li><a href="../packging/home_packslip_ofl.php">&nbsp;OFL&nbsp;Packaging&nbsp;Slip</a></li>
			 <li><a href="../packging/home_unpackaging.php">&nbsp;Unpackaging</a></li>
			 <li><a href="../packging/home_bctosloc.php">&nbsp;BC To SLOC</a></li>
			 <li><a href="../packging/home_revalidate.php">&nbsp;Pack&nbsp;Seed&nbsp;Re-Printing</a></li>
			 <li><a href="../packging/home_p2c.php">&nbsp;Pack&nbsp;Seed&nbsp;Unpacking - P2C&nbsp;</a></li>
			 <li><a href="../packging/home_ivt.php">&nbsp;Inter&nbsp;Variety&nbsp;Transfer</a></li>
			 <li><a href="../packging/home_packslipwb.php">&nbsp;WB&nbsp;Packing&nbsp;Slip</a></li>
			 <li><a href="../packging/home_packslipfc.php">&nbsp;Field&nbsp;Crop&nbsp;Packing&nbsp;Slip</a></li>
			 <li><a href="../packging/home_packagingrps.php">&nbsp;Re-Printing&nbsp;Packing&nbsp;Slip</a></li>
				<!--<li><a href="../arrival/home_trading.php">&nbsp;Trading&nbsp;Arrival</a></li>
				<li><a href="../arrival/home_bag.php">&nbsp;Unidentified&nbsp;Bags</a></li>-->
			 </ul>
            </li>
            <li><a href="#">Reports</a>
            <ul>
			<li><a href="../packging/report_pswstock.php">&nbsp;Pack&nbsp;Seed&nbsp;Stock&nbsp;Report</a></li>
			<li><a href="../packging/daily_qc_report.php">&nbsp;Daily&nbsp;QC&nbsp;Result&nbsp;Report&nbsp;</a></li>
			<li><a href="../packging/qc_report_ondtage.php">&nbsp;QC&nbsp;Ageing&nbsp;Status&nbsp;Report&nbsp;</a></li>
			<li><a href="../packging/periodical_pack_report.php">&nbsp;Pack&nbsp;Seed&nbsp;Activity&nbsp;Report</a></li>
			<li><a href="../packging/periodical_cpvrtypack_report.php">&nbsp;Variety&nbsp;wise&nbsp;Pack&nbsp;Seed&nbsp;Report</a></li>
			<li><a href="../packging/report_packingperiod.php">&nbsp;Periodical&nbsp;Packing&nbsp;Report</a></li>
			<li><a href="../packging/report_packagingperiod.php">&nbsp;Periodical&nbsp;Packaging&nbsp;Report&nbsp;(L/N/M)</a></li>
			<!-- <li><a href="../arrival/report_stock.php">&nbsp;Stock&nbsp;Transfer&nbsp;From&nbsp;Plant&nbsp;Report</a></li>
            <li><a href="../arrival/report_con.php">&nbsp;Trading&nbsp;Arrival&nbsp;Report</a></li>
			<li><a href="../arrival/report_unidentified.php">&nbsp;Unidentified&nbsp;Arrival&nbsp;Report</a></li>				  
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
			<li><a href=" Javascript:void(0)" onClick="window.open('../packging/dav_calculator.php','WelCome','top=100,left=130,width=750,height=400,scrollbars=NO')" >&nbsp;Calculator - Date of Validity (DoV)</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('../packging/barcode_search.php','WelCome','top=100,left=130,width=800,height=400,scrollbars=NO')" >&nbsp;Barcode Search</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('../packging/batch_finder.php','WelCome','top=100,left=130,width=750,height=600,scrollbars=NO')" >&nbsp;Batch No. Finder</a></li>
			<!-- <li><a href=" Javascript:void(0)" onClick="window.open('../arrival/utility.php','WelCome','top=10,left=50,width=900,height=400,scrollbars=yes')" >&nbsp;Lot&nbsp;Biography</a></li>
			    <li><a href=" Javascript:void(0)" onClick="window.open('../arrival/utility_lot.php','WelCome','top=10,left=50,width=650,height=300,scrollbars=yes')" >&nbsp;Decode&nbsp;- SLOC Lookup</a></li>
				  <li><a href=" Javascript:void(0)" onClick="window.open('../arrival/abbravation.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Abbreviations&nbsp;</a></li>-->
		             </ul>
            </li>
			<?php
			}
			else if($role == "packaging")
			{
			?>
			<li><a href="#">Transactions</a>
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
            <li><a href="#">Reports</a>
              <ul>
			  <!--<li><a href="report/productionlocation.php" >&nbsp;Production&nbsp;Location&nbsp;wise&nbsp;Report</a></li>
                <li><a href="report/lotdesti1.php" >&nbsp;Lot&nbsp;Destination &nbsp;wise&nbsp;Report</a></li>-->
               
              </ul>
            </li>
            <li>
            <a href="#">Utility</a>
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
                <?php if($role == "packaging")
				{
			  ?>
               
				<li> <a href="../packging/operprofile.php" >Profile</a> | </li>
				<?php
				}
				?>
				 <li>&nbsp;<a href="../packging/faq.php">FAQ</a> | </li>
				<li>&nbsp; <a href="../packging/help.php">Help</a> | </li>
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
