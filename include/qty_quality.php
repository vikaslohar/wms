<div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/qty_logotrac.gif" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
			<ul  id="nav"> 
						<?php
			 if($role == "quality")
			{
			?>
			<?php
			$sql_oop=mysqli_query($link,"select * from tblopr where id='$loginid' and plantcode='$plantcode'")or die(mysqli_error($link)); 
			$total_oop=mysqli_num_rows($sql_oop);
			$row_oop=mysqli_fetch_array($sql_oop);
			?>
            <li><a href="index1.php">Transactions</a>
            <ul>  -<li><a href="../qc/home_sampling.php">&nbsp;QC&nbsp;Sample&nbsp;Pending&nbsp;</a></li>
				<li><a href="../qc/home_qc_update.php">&nbsp;QC&nbsp;Result&nbsp;Update&nbsp;</a></li>
				<li><a href="../qc/pmupdate.php">&nbsp;PP&nbsp;&amp;&nbsp;Moisture&nbsp;Update&nbsp;</a></li>
				<li><a href="../qc/select.php">&nbsp;GOT&nbsp;Sample&nbsp;Dispatch</a></li>
				<li><a href="../qc/home_gspend.php">&nbsp;GS&nbsp;Pending&nbsp;</a></li>
			    <li><a href="../qc/add_gssloc.php">&nbsp;GS&nbsp;SLOC&nbsp;Update</a></li>
				<li><a href="../qc/home_aging.php">&nbsp;Guard&nbsp;Sample&nbsp;Ageing</a></li>
				<li><a href="../qc/home_qc.php">&nbsp;QC&nbsp;Sampling&nbsp;Request</a></li>
				<li><a href="../qc/StatusUpdation.php">&nbsp;Seed&nbsp;Status&nbsp;Updation&nbsp;</a></li>
				
			 </ul>
            </li>
            <li><a href="index1.php">Reports</a>
            <ul> <li><a href="../qc/report_qcsamp.php">&nbsp;QC&nbsp;Sample&nbsp;Pending&nbsp;Report</a></li>	
			<li><a href="../qc/report_uqc.php">&nbsp;QC&nbsp;Result&nbsp;Pending&nbsp;Report</a></li>
			<li><a href="../qc/daily_qc_report.php">&nbsp;Daily&nbsp;QC&nbsp;Result&nbsp;Report&nbsp;</a></li>
			<li><a href="../qc/qc_period_report.php">&nbsp;Periodical&nbsp;QC&nbsp;Report&nbsp;</a></li>
          	<li><a href="../qc/report_gstock.php">&nbsp;GS&nbsp;Stock&nbsp;Report</a></li>
			<li><a href="../qc/gotsmpdispreport.php">&nbsp;GOT&nbsp;Sample&nbsp;Dispatch&nbsp;Report</a></li>
			<li><a href="../qc/qc_report_ondt.php">&nbsp;QC&nbsp;Status&nbsp;Report&nbsp;</a></li>
			<li><a href="../qc/qc_report_ondtage.php">&nbsp;QC&nbsp;Ageing&nbsp;Status&nbsp;Report&nbsp;</a></li>
			<li><a href="../qc/report_rawsscrop.php">&nbsp;Substandard&nbsp;Seed&nbsp;Report</a></li>	
			<li><a href="../qc/report_sfr.php">&nbsp;Soft&nbsp;Release&nbsp;Status&nbsp;Report</a></li>	  
			<li><a href="../qc/periodical_sr_report.php">&nbsp;Periodical&nbsp;Sales&nbsp;Return&nbsp;Report</a></li>  
              </ul>
            </li>
            <li>
            <a href="index1.php">Utility</a>
			<ul>
			<li><a href="../qc/utility_got1.php">&nbsp;Lot&nbsp;Query&nbsp;</a></li>
			<li><a href="../qc/utility_qc.php">&nbsp;QC&nbsp;Biography&nbsp;</a></li>
			<li><a href="../qc/utility_gs.php">&nbsp;GS&nbsp;Query&nbsp;</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('../qc/abbravation.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Abbreviations&nbsp;</a></li>
		             </ul>
            </li>
			<?php
			}
			else if($role == "quality")
			{
			?>
			<li><a href="index1.php">Transactions</a>
             <ul>
			    <li><a href="transaction/home_trading.php">&nbsp;Trading&nbsp;Lot</a></li>
                <li><a href="transaction/home_unidenti.php">&nbsp;Unidentified&nbsp;Lot</a></li>
                <li><a href="transaction/home_lot_mrger.php" >&nbsp;Lot&nbsp;Merger&nbsp;</a></li>
                <li><a href="transaction/home_existing.php" >&nbsp;Lot&nbsp;Regularisation</a></li>
           		<li><a href="transaction/home_tagging.php">&nbsp;Import&nbsp;Acknowledgement</a></li>
              </ul>
            </li>
            <li><a href="index1.php">Reports</a>
              <ul>
			
                <li><a href="report/lotdesti1.php" >&nbsp;Lot&nbsp;Destination &nbsp;wise&nbsp;Report</a></li>
               
              </ul>
            </li>
            <li>
            <a href="index1.php">Utility</a>
			<ul> 
		           <!-- <li><a href=" Javascript:void(0)" onClick="window.open('utility/pdn1.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;PDN&nbsp;Printing</a></li>
					   <li><a href=" Javascript:void(0)" onClick="window.open('utility/geog.php','WelCome','top=10,left=50,width=650,height=300,scrollbars=yes')" >&nbsp;GI&nbsp;Generation&nbsp;Tool</a></li>-->
					     <li><a href=" Javascript:void(0)" onClick="window.open('../qc/abbravation.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Abbreviations&nbsp;</a></li>
		             </ul>
            </li>
			<?php
			}
			?>
			</ul>
            </div>
            </div> <div class="toplinks" style="vertical-align:text-top">
              <ul style="vertical-align:text-top">
                <?php ($role == "quality")
				
			  ?>
                
				
				<li> <a href="../qc/operprofile.php" >Profile </a> | </li>
				
				 <li>&nbsp;<a href="../qc/faq.php">FAQ</a>| </li>
				<li>&nbsp;<a href="../qc/help.php" >Help </a>| </li>
                <li>&nbsp;<a href="../logout.php" >Logout </a> </li>
              </ul>
			 </div>
			<!--<div style="border: 0px solid red; float: right; width: 290px; clear: right; font-size:5px; font-weight:bold; list-style-type:none"/>
			 <ul style="vertical-align:text-bottom; text-align:left; text-decoration:none;">
			 <li style="float:left; position:relative; display:inline; vertical-align:text-bottom; text-align:left; color:#000000">&nbsp;</li>
			 </ul>
			 </div>-->
			 <div style="border:0px solid red; float:right; width: 290px; clear:right; font-size:11px;  padding-top:0px; height:15px; font-weight:bold; list-style-type:none;"/>
			 <ul style="vertical-align:text-top; text-align:left; text-decoration:none;">
			 <li style="float:right; position:relative; display:inline; vertical-align:text-top; text-align:left; color:#000000">&nbsp;Today is: <?php echo date("d-m-Y");?>&nbsp;&nbsp;&nbsp;&nbsp; </li>
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
			  <li style="float:right; position:relative; display:inline; vertical-align:text-bottom; text-align:left; color:#000000">&nbsp;Wel-Come&nbsp;&nbsp;<?php echo ucwords($logname);?>&nbsp;|&nbsp;<?php echo ucwords($plantname);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
			  </ul>
			  </div>	
            </div>
