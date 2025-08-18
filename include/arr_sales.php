<div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/sales_logotrac.gif" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
			<ul  id="nav"> 
						<?php
			 if($role == "salesreturn")
			{
			?>
			<?php
			$sql_oop=mysqli_query($link,"select * from tblopr where id='$loginid' and plantcode='$plantcode'")or die(mysqli_error($link)); 
			$total_oop=mysqli_num_rows($sql_oop);
			$row_oop=mysqli_fetch_array($sql_oop);
			?>
            <li><a href="index1.php">Transactions</a>
             <ul>
			   <!--<li><a href="../sales/home_optrn.php">&nbsp;Opening&nbsp;Stock&nbsp;Condition</a></li>-->
			   <li><a href="../sales/home_returnptc.php">&nbsp;Sales&nbsp;Return</a></li>
			   <!--<li><a href="../sales/home_bctosloc.php">&nbsp;BC To SLOC</a></li>
			   <li><a href="../sales/home_recall.php">&nbsp;Sales&nbsp;Recall</a></li>-->
			   <li><a href="../sales/home_srp2c.php">&nbsp;SR&nbsp;Unpacking - P2C&nbsp;</a></li>
				<li><a href="../sales/home_srrevalidate.php">&nbsp;SR&nbsp;Pack&nbsp;Seed&nbsp;Re-Validation</a></li>
				 <!-- <li><a href="../sales/home_bag.php">&nbsp;Unidentified&nbsp;Bags</a></li>-->
			 </ul>
            </li>
            <li><a href="index1.php">Reports</a>
            <ul>
			<li><a href="../sales/report_sropening.php">&nbsp;SR Opening Stock Report</a></li>
			<li><a href="../sales/crop_ver_sr_report.php">&nbsp;Crop&nbsp;Variety&nbsp;wise&nbsp;SR&nbsp;Report</a></li>
            <li><a href="../sales/partywise_sr_report.php">&nbsp;Party&nbsp;Wise&nbsp;SR&nbsp;Report</a></li>
			<li><a href="../sales/sr_pwdamage_report.php">&nbsp;Party&nbsp;Wise&nbsp;Damage&nbsp;SR&nbsp;Report</a></li>
			<li><a href="../sales/cvwisedamage_sr_report.php">&nbsp;Crop&nbsp;Variety&nbsp;Wise&nbsp;Damage&nbsp;SR</a></li>
			<li><a href="../sales/statewise_sr_report.php">&nbsp;State&nbsp;Wise&nbsp;SR&nbsp;Report</a></li>
			<li><a href="../sales/partytypewise_sr_report.php">&nbsp;Party&nbsp;Type&nbsp;Wise&nbsp;SR&nbsp;Report</a></li>				  
			<li><a href="../sales/report_srquality.php">&nbsp;Sales&nbsp;Return&nbsp;Quality&nbsp;Report</a></li>
			<li><a href="../sales/sr_arrival_report.php">&nbsp;Sales&nbsp;Return&nbsp;Arrival&nbsp;Report</a></li>
			<li><a href="../sales/report_srutilisation.php">&nbsp;SR&nbsp;Arrival&nbsp;vs&nbsp;Utilisation&nbsp;Report</a></li>
			<li><a href="../sales/report_rawsscrop.php">&nbsp;Substandard&nbsp;Seed&nbsp;Report</a></li>
			<!--<li><a href="../sales/preport_plant.php">&nbsp;Stock&nbsp;Transfer&nbsp;CropVariety&nbsp;Wise&nbsp;Report</a></li>
					 
						<li><a href="../sales/report_crop.php">&nbsp;Arrival&nbsp;Crop&nbsp;Variety&nbsp;Wise&nbsp;Report</a></li>-->
					  
              </ul>
            </li>
            <li>
            <a href="index1.php">Utility</a>
			<ul>
			<!--<li><a href=" Javascript:void(0)" onClick="window.open('../sales/slocreport.php','WelCome','top=10,left=50,width=960,height=400,scrollbars=NO')" >&nbsp;SLOC&nbsp;Search</a></li>
			 <li><a href=" Javascript:void(0)" onClick="window.open('../sales/utility.php','WelCome','top=10,left=50,width=900,height=400,scrollbars=yes')" >&nbsp;Lot&nbsp;Biography</a></li>
			    <li><a href=" Javascript:void(0)" onClick="window.open('../sales/utility_lot.php','WelCome','top=10,left=50,width=650,height=300,scrollbars=yes')" >&nbsp;Decode&nbsp;- SLOC Lookup</a></li>
				  <li><a href=" Javascript:void(0)" onClick="window.open('../sales/abbravation.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Abbreviations&nbsp;</a></li>-->
		             </ul>
            </li>
			<?php
			}
			else if($role == "plant")
			{
			?>
			<li><a href="index1.php">Transactions</a>
             <ul>
			    <!--<li><a href="transaction/home_trading.php">&nbsp;Trading&nbsp;Lot</a></li>
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
                <?php if($role == "admin")
				{
			  ?>
                <li> <a href="../masters/adminprofile.php" >Profile</a> | </li>
				<?php
				}
				else
				{
				?>
				<li> <a href="../sales/operprofile.php" >Profile</a> | </li>
				<?php
				}
				?>
				 <li>&nbsp;<a href="../sales/faq.php">FAQ</a> | </li>
				<li>&nbsp; <a href="../sales/help.php">Help</a> | </li>
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
			  	$sql_plant=mysqli_query($link,"select * from tbl_parameters where  plantcode='$plantcode'") or die(mysqli_error($link));
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