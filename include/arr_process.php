<div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/process_logotrac.gif" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
			<ul  id="nav"> 
						<?php
			 if($role == "processing")
			{
			?>
			<?php
			$sql_oop=mysqli_query($link,"select * from tblopr where id='$loginid' and plantcode='$plantcode'")or die(mysqli_error($link)); 
			$total_oop=mysqli_num_rows($sql_oop);
			$row_oop=mysqli_fetch_array($sql_oop);
			?>
            <li><a href="index1.php">Transactions</a>
             <ul>
				 <li><a href="../process/home_drying.php">&nbsp;Drying&nbsp;Slip&nbsp;</a></li>
			     <li><a href="../process/home_pslip.php">&nbsp;Processing&nbsp;Slip&nbsp;</a></li>
                <li><a href="../process/home_pronpslip.php">&nbsp;Processing&nbsp&amp;&nbsp;Packing&nbsp;Slip</a></li>
				<li><a href="../process/home_pronpslip_fc.php">&nbsp;Processing&nbsp&amp;&nbsp;Packing&nbsp;Slip&nbsp;(FC)</a></li>
				<li><a href="../process/home_merger.php">&nbsp;Lot&nbsp;Blending</a></li>
                
			 </ul>
            </li>
            <li><a href="index1.php">Reports</a>
            <ul>
				<li><a href="../process/report_daily.php">&nbsp;Periodical&nbsp;Processing&nbsp;Report</a></li>
                <li><a href="../process/report_orgw_prosts.php">&nbsp;Organiser wise&nbsp;Processing&nbsp;Report</a></li>
				<li><a href="../process/report_prodperw_prosts.php">&nbsp;Prod.&nbsp;Per.&nbsp;wise&nbsp;Processing&nbsp;Report</a></li>
				<li><a href="../process/report_drying.php">&nbsp;Periodical&nbsp;Drying&nbsp;Report</a></li>
              <!-- <li><a href="report/report_organiser.php">&nbsp;Organiser&nbsp;Wise&nbsp;Seed&nbsp;Analysis&nbsp;Report</a></li>
                <li><a href="report/lotdesti1.php">&nbsp;Composit&nbsp;Organiser&nbsp;Wise&nbsp;Seed&nbsp;Analysis&nbsp;Report</a></li>
				<li><a href="report/lotdesti1.php">&nbsp;Seed&nbsp;Analysis&nbsp;Report - Farmere Wise</a></li>-->
				<li><a href="../process/qc_report_ondtage.php">&nbsp;QC&nbsp;Ageing&nbsp;Status&nbsp;Report&nbsp;</a></li>
				<li><a href="../process/report_dailycons.php">&nbsp;Consolidated&nbsp;Processing&nbsp;Report</a></li>
              </ul>
            </li>
            <li>
            <a href="index1.php">Utility</a>
			<ul><!--<li><a href=" Javascript:void(0)" onClick="window.open('utility/utility_lot.php','WelCome','top=10,left=50,width=960,height=400,scrollbars=NO')" >&nbsp;Lot&nbsp;Query</a></li>-->
			  <li><a href="../process/utility.php" >&nbsp;Lot&nbsp;Query</a></li>
			  <li><a href=" Javascript:void(0)" onClick="window.open('../process/dav_calculator.php','WelCome','top=100,left=130,width=750,height=400,scrollbars=NO')" >&nbsp;Calculator - Date of Validity (DoV)</a></li>
			  <li><a href=" Javascript:void(0)" onClick="window.open('../process/batch_finder.php','WelCome','top=100,left=130,width=750,height=600,scrollbars=NO')" >&nbsp;Batch No. Finder</a></li>
			   <!-- <li><a href=" Javascript:void(0)" onClick="window.open('../csw/slocreport.php','WelCome','top=10,left=50,width=650,height=300,scrollbars=yes')" >&nbsp;SLOC&nbsp;search&nbsp;</a></li>
				  <li><a href=" Javascript:void(0)" onClick="window.open('../csw/abbravation.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Abbreviations&nbsp;</a></li>-->
		             </ul>
            </li>
			<?php
			}
			else if($role != "processing")
			{
			?>
			<li><a href="index1.php">Transactions</a>
             <ul>
			    <li><a href="../csw/home_qc.php">&nbsp;QC&nbsp;Sampling&nbsp;Request </a></li>
                <li><a href="../csw/home_sloc.php">&nbsp;SLOC&nbsp;Updation</a></li>
                <li><a href="../csw/home_lot_mrger.php" >&nbsp;Status&nbsp;Updation&nbsp;</a></li>
               <!-- <li><a href="transaction/home_existing.php" >&nbsp;Lot&nbsp;Regularisation</a></li>
                <li><a href="transaction/home_lot_transfer.php">&nbsp;Lot&nbsp;Destination</a></li>
				<li><a href="transaction/home_suspend.php">&nbsp;Lot&nbsp;Suspension</a></li>
				<li><a href="transaction/home_tagging.php">&nbsp;Import&nbsp;Acknowledgement</a></li>-->
              </ul>
            </li>
            <li><a href="index1.php">Reports</a>
              <ul>
			 
              </ul>
            </li>
            <li>
            <a href="index1.php">Utility</a>
			<ul> <li><a href=" Javascript:void(0)" onClick="window.open('../csw/utility_lot.php','WelCome','top=10,left=50,width=960,height=400,scrollbars=NO')" >&nbsp;Lot&nbsp;Query</a></li>
		           <li><a href=" Javascript:void(0)" onClick="window.open('../csw/slocreport.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;PDN&nbsp;Printing</a></li>
					   <li><a href=" Javascript:void(0)" onClick="window.open('utility/geog.php','WelCome','top=10,left=50,width=650,height=300,scrollbars=yes')" >&nbsp;GI&nbsp;Generation&nbsp;Tool</a></li>
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
                <?php if($role == "processing")
				{
			  ?>
   			<li> <a href="../process/operprofile.php" >Profile</a> | </li>
				<?php
				}
				?>
				 <li>&nbsp;<a href="../process/faq.php">FAQ</a> | </li>
				<li>&nbsp; <a href="../process/help.php">Help</a> | </li>
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
