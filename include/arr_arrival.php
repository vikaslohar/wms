<div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/arr_logotrac.gif" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
			<ul  id="nav"> 
						<?php
			 if($role == "arrival")
			{
			?>
			<?php
			$sql_oop=mysqli_query($link,"select * from tblopr where id='$loginid' and plantcode='$plantcode'")or die(mysqli_error($link)); 
			$total_oop=mysqli_num_rows($sql_oop);
			$row_oop=mysqli_fetch_array($sql_oop);
			?>
            <li><a href="index1.php">Transactions</a>
             <ul>
			    <li><a href="../arrival/home_freshpdn.php">&nbsp;Fresh&nbsp;Seed&nbsp;Arrival&nbsp;with&nbsp;PDN</a></li>
				<li><a href="../arrival/select.php">&nbsp;Stock&nbsp;Transfer - Plant&nbsp;</a></li>
				<li><a href="../arrival/select1.php">&nbsp;Trading&nbsp;Arrival</a></li>
				<li><a href="../arrival/home_bag.php">&nbsp;Unidentified&nbsp;Arrival</a></li>
				<li><a href="../arrival/home_optrn.php">&nbsp;Opening&nbsp;Stock</a></li>
				<li><a href="../arrival/add_arrival_maizedry2.php">&nbsp;Maize-Dried&nbsp;Seed&nbsp;Arrival</a></li>
				<li><a href="../arrival/home_freshpdn_unld.php">&nbsp;Unloading&nbsp;Arrival&nbsp;</a></li>
			 </ul>
            </li>
            <li><a href="index1.php">Reports</a>
            <ul>
				<li><a href="../arrival/report_arrival.php">&nbsp;Daily&nbsp;Arrival&nbsp;Report</a></li>
			 <li><a href="../reportarrival/arreports.php">&nbsp;Arrival&nbsp;Report - PM&nbsp;</a></li>
           <!-- <li><a href="../arrival/report_con.php">&nbsp;Trading&nbsp;Arrival&nbsp;Report</a></li>
			<li><a href="../arrival/report_unidentified.php">&nbsp;Unidentified&nbsp;Arrival&nbsp;Report</a></li>				  
			<li><a href="../arrival/report_organiser.php">&nbsp;Organiser&nbsp;Wise&nbsp;Report</a></li>
			<li><a href="../arrival/report_location.php">&nbsp;production&nbsp;Location&nbsp;Wise&nbsp;Report</a></li>
			<li><a href="../arrival/report_productionp.php">&nbsp;Production&nbsp;Personnel&nbsp;Wise&nbsp;Report</a></li>
			<li><a href="../arrival/preport_plant.php">&nbsp;Stock&nbsp;Transfer&nbsp;CropVariety&nbsp;Wise&nbsp;Report</a></li>
					 
						<li><a href="../arrival/report_crop.php">&nbsp;Arrival&nbsp;Crop&nbsp;Variety&nbsp;Wise&nbsp;Report</a></li>-->
					  
              </ul>
            </li>
            <li>
            <a href="index1.php">Utility</a>
			<ul><li><a href=" Javascript:void(0)" onClick="window.open('../arrival/slocreport.php','WelCome','top=10,left=50,width=960,height=400,scrollbars=yes')" >&nbsp;SLOC&nbsp;Search</a></li>
			 <li><a href=" Javascript:void(0)" onClick="window.open('../arrival/utility.php','WelCome','top=10,left=50,width=900,height=400,scrollbars=yes')" >&nbsp;Lot&nbsp;Biography</a></li>
			    <li><a href=" Javascript:void(0)" onClick="window.open('../arrival/utility_lot.php','WelCome','top=10,left=50,width=650,height=300,scrollbars=yes')" >&nbsp;Decode&nbsp;- SLOC Lookup</a></li>
				  <li><a href=" Javascript:void(0)" onClick="window.open('../arrival/abbravation.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Abbreviations&nbsp;</a></li>
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
			<ul> <!-- <li><a href=" Javascript:void(0)" onClick="window.open('utility/utility_lot.php','WelCome','top=10,left=50,width=960,height=400,scrollbars=NO')" >&nbsp;Lot&nbsp;Query</a></li>
		           <li><a href=" Javascript:void(0)" onClick="window.open('utility/pdn1.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;PDN&nbsp;Printing</a></li>
					   <li><a href=" Javascript:void(0)" onClick="window.open('utility/geog.php','WelCome','top=10,left=50,width=650,height=300,scrollbars=yes')" >&nbsp;GI&nbsp;Generation&nbsp;Tool</a></li>-->
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
				<li> <a href="../arrival/operprofile.php" >Profile</a> | </li>
				<?php
				}
				?>
				 <li>&nbsp;<a href="../arrival/faq.php" >FAQ</a> | </li>
				<li>&nbsp; <a href="../arrival/help.php" >Help</a> | </li>
                <li> &nbsp;<a href="../logout.php" >Logout</a> </li>
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
			 	$sql_plant=mysqli_query($link,"select * from tbl_parameters where code='$plantcode' 	") or die(mysqli_error($link));
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
