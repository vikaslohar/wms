<div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/plantm_logotrac.jpg" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
			<ul  id="nav"> 
						<?php
			// if($role == "plantmanager")
			//{
			?>
			<?php
			$sql_oop=mysqli_query($link,"select * from tblopr where id='$loginid' and plantcode='$plantcode'")or die(mysqli_error($link)); 
			$total_oop=mysqli_num_rows($sql_oop);
			$row_oop=mysqli_fetch_array($sql_oop);
			?>
           <!-- <li><a href="index1.php">Transactions</a>
             <ul>
			    <li><a href="../plant/home_tagging.php">&nbsp;Lot&nbsp;Importing</a></li>
				<li><a href="../plant/add_lgenyr.php">&nbsp;Year&nbsp;code&nbsp;Import-Lotgen</a></li>
				<li><a href="../plant/home_stlotimp.php ">&nbsp;StockTransfer&nbsp;Lot&nbsp;Import&nbsp;List</a></li>
				<li><a href="../plant/home_impack_tagging.php ">&nbsp;Lot&nbsp;Import&nbsp;Acknowledgement</a></li>
				<li><a href="../plant/StatusUpdation.php ">&nbsp;Lot&nbsp;Reserve</a></li>
				<li><a href="../plant/unidntoidnseed.php ">&nbsp;Unidentified&nbsp;to&nbsp;Identify</a></li>
				<li><a href="../plant/home_softrelease.php ">&nbsp;Soft&nbsp;Release</a></li>
				<li><a href="../plant/home_softrelease2.php ">&nbsp;Super&nbsp;Soft&nbsp;Release</a></li>
				<li><a href="../plant/add_discard.php">&nbsp;Material&nbsp;Discard</a></li>
				<li><a href="../plant/home_merger.php">&nbsp;Lot&nbsp;Merger</a></li>
				<li><a href="../plant/home_blre.php">&nbspBlending&nbsp;Lot&nbsp;Reservation</a></li>
				<li><a href="../plant/home_spci.php">&nbsp;SP&nbsp;Cycle&nbsp;Inventory</a></li>
				<li><a href="../plant/home_stlotimp_pack.php">&nbsp;Pack&nbsp;Seed&nbsp;Arrival&nbsp;Importing</a></li>
				
			 </ul>
            </li>-->
            <li><a href="index1.php">Reports</a>
            <ul>
				<li><a href="../plantmanager/stock_reportnew.php">&nbsp;Stock&nbsp;on&nbsp;Hand&nbsp;Report</a></li>				
				<!--<li><a href="../plantmanager/report_rawcropq.php">&nbsp;Quality&nbsp;based&nbsp;Stock&nbsp;Report</a></li>
				<li><a href="../plantmanager/preport_plant.php">&nbsp;Consolidated&nbsp;Arrival&nbsp;Report</a></li>
				<li><a href="../plantmanager/preport_plant.php">&nbsp;Consolidated&nbsp;Arrival&nbsp;Report</a></li>
				<li><a href="../plantmanager/report_packingperiod.php">&nbsp;Periodical&nbsp;Packing&nbsp;Report</a></li>
				<li><a href="../plantmanager/stock_report.php">&nbsp;Stock&nbsp;on&nbsp;Hand&nbsp;Report</a></li>-->
            </ul>
            </li>
            <!--<li>
            <a href="index1.php">Utility</a>
			<ul> 
			<li><a href="../plant/utility.php">&nbsp;Lot&nbsp;Biography</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('utility.php','WelCome','top=10,left=50,width=960,height=400,scrollbars=NO')" >&nbsp;Lot&nbsp;Biography</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('utility/pdn1.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;PDN&nbsp;Printing</a></li>
			    <li><a href=" Javascript:void(0)" onClick="window.open('../plant/utility_lot.php','WelCome','top=10,left=50,width=650,height=300,scrollbars=yes')" >&nbsp;Decode&nbsp;- SLOC Lookup</a></li>
				  <li><a href=" Javascript:void(0)" onClick="window.open('../plant/abbravation.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Abbreviations&nbsp;</a></li>
				  <li><a href=" Javascript:void(0)" onClick="window.open('../plant/batch_finder.php','WelCome','top=100,left=130,width=750,height=600,scrollbars=NO')" >&nbsp;Batch No. Finder</a></li>
				  <li><a href="../plant/bctest.php">&nbsp;Barcode Test</a></li>
		             </ul>
            </li>-->
			
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
				<li> <a href="../plant/operprofile.php" >Profile</a> | </li>
				<?php
				}
				?>
				 <li>&nbsp;<a href="../plant/faq.php">FAQ</a> | </li>
				<li>&nbsp; <a href="../plant/help.php">Help</a> | </li>
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
