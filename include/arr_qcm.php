<div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/qty_logotrac.gif" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
			<ul  id="nav"> 
			<li><a href="index1.php">Masters</a>
              <ul>
                <!--<li><a href="../qcm/home_variety.php">&nbsp;Variety&nbsp;Master</a></li>-->
				 <li><a href="../qcm/home_gotlocation.php">&nbsp;GOT&nbsp;Location&nbsp;Master</a></li>
              </ul>
            </li>
						<?php
			 if($role == "QCM")
			{
			?>
			<?php
			$sql_oop=mysqli_query($link,"select * from tblopr where id='$loginid' and plantcode='$plantcode'")or die(mysqli_error($link)); 
			$total_oop=mysqli_num_rows($sql_oop);
			$row_oop=mysqli_fetch_array($sql_oop);
			?>
            <li><a href="index1.php">Transactions</a>
             <ul> 
			 	<li><a href="../qcm/home_merger.php">&nbsp;Lot&nbsp;Blending&nbsp;Authorization&nbsp;</a></li>
				<li><a href="../qcm/home_softrelease.php">&nbsp;Soft&nbsp;Release</a></li>
				<li><a href="../qcm/home_softrelease2.php">&nbsp;Super&nbsp;Soft&nbsp;Release</a></li>
				<li><a href="../qcm/home_gotfinalgrade.php">&nbsp;Final&nbsp;GOT&nbsp;Grade&nbsp;Update&nbsp;</a></li>
				<li><a href="../qcm/home_densitydata.php">&nbsp;Density&nbsp;Data&nbsp;Edit</a></li>
				<!--<li><a href="../qcm/pmupdate.php">&nbsp;PP&nbsp;&amp;&nbsp;Moisture&nbsp;Update&nbsp;</a></li>
				<li><a href="../qcm/select.php">&nbsp;GOT&nbsp;Sample&nbsp;Dispatch</a></li>
				<li><a href="../qcm/home_gspend.php">&nbsp;GS&nbsp;Pending&nbsp;</a></li>
			    <li><a href="../qcm/add_gssloc.php">&nbsp;GS&nbsp;SLOC&nbsp;Update</a></li>
				<li><a href="../qcm/home_aging.php">&nbsp;Guard&nbsp;Sample&nbsp;Ageing</a></li>
				<li><a href="../qcm/home_qc.php">&nbsp;QC&nbsp;Sampling&nbsp;Request</a></li>-->
				
			 </ul>
            </li>
            <li><a href="index1.php">Reports</a>
            <ul> 
			<li><a href="../qcm/report_qcsamp.php">&nbsp;QC&nbsp;Sample&nbsp;Pending&nbsp;Report</a></li>	
			<li><a href="../qcm/report_uqc.php">&nbsp;QC&nbsp;Result&nbsp;Pending&nbsp;Report</a></li>
			<li><a href="../qcm/daily_qc_report.php">&nbsp;Daily&nbsp;QC&nbsp;Result&nbsp;Report&nbsp;</a></li>
			<li><a href="../qcm/qc_period_report.php">&nbsp;Periodical&nbsp;QC&nbsp;Report&nbsp;</a></li>
          	<li><a href="../qcm/report_gstock.php">&nbsp;GS&nbsp;Stock&nbsp;Report</a></li>
			<li><a href="../qcm/gotsmpdispreport.php">&nbsp;GOT&nbsp;Sample&nbsp;Dispatch&nbsp;Report</a></li>
			<li><a href="../qcm/qc_report_ondt.php">&nbsp;QC&nbsp;Status&nbsp;Report&nbsp;</a></li>
			<li><a href="../qcm/qc_report_ondtage.php">&nbsp;QC&nbsp;Ageing&nbsp;Status&nbsp;Report&nbsp;</a></li>
			<li><a href="../qcm/report_rawsscrop.php">&nbsp;Substandard&nbsp;Seed&nbsp;Report</a></li>	
			<li><a href="../qcm/daily_got_report.php">&nbsp;Daily&nbsp;GOT&nbsp;Result&nbsp;Report&nbsp;</a></li>	
			<li><a href="../qcm/stock_report.php">&nbsp;Stock&nbsp;Report</a></li> 
			<li><a href="../qcm/report_pswstock.php">&nbsp;Pack&nbsp;Seed&nbsp;Stock&nbsp;Report</a></li>  
			<li><a href="../qcm/report_sfr.php">&nbsp;Soft&nbsp;Release&nbsp;Report</a></li>
			<li><a href="../qcm/report_ssfr.php">&nbsp;Super&nbsp;Soft&nbsp;Release&nbsp;Report</a></li>
			<li><a href="../qcm/report_blending.php">&nbsp;Periodical&nbsp;Blending&nbsp;Report</a></li>
			<li><a href="../qcm/report_gotsowing.php">&nbsp;GOT&nbsp;Sowing&nbsp;Pending&nbsp;Report</a></li>
			<li><a href="../qcm/report_gottransplanting.php">&nbsp;Lot&nbsp;Transplantation&nbsp;Pending&nbsp;Report</a></li>
			<li><a href="../qcm/report_gotdatapending.php">&nbsp;GOT&nbsp;Data&nbsp;Pending&nbsp;Report</a></li>
			<li><a href="../qcm/gotperiod_report.php">&nbsp;Periodical&nbsp;GOT&nbsp;Result&nbsp;Report</a></li>
			<li><a href="../qcm/report_gotdatainterra.php">&nbsp;GOT&nbsp;Data&nbsp;Report&nbsp;(In&nbsp;Terra)</a></li>
			<li><a href="../qcm/report_gotdatainsitu.php">&nbsp;GOT&nbsp;Data&nbsp;Report&nbsp;(In&nbsp;SITU)</a></li>
			<li><a href="../qcm/gotppwise_report.php">&nbsp;Prod&nbsp;Per&nbsp;Wise&nbsp;GOT&nbsp;Status&nbsp;Report</a></li>
			<li><a href="../qcm/usefullstock_report.php">&nbsp;Ready&nbsp;Stock&nbsp;Report</a></li>
			<li><a href="../qcm/report_gotgrade.php">&nbsp;GOT&nbsp;Final&nbsp;Grade&nbsp;Report</a></li>
              </ul>
            </li>
            <li>
            <a href="index1.php">Utility</a>
			<ul>
			<li><a href="../qcm/utility_got1.php">&nbsp;Lot&nbsp;Query&nbsp;</a></li>
			<li><a href="../qcm/utility_qc.php">&nbsp;QC&nbsp;Biography&nbsp;</a></li>
			<li><a href="../qcm/utility.php">&nbsp;Lot&nbsp;Biography</a></li>
			<li><a href="../qcm/utility_gs.php">&nbsp;GS&nbsp;Query&nbsp;</a></li>
			<li><a href=" Javascript:void(0)" onClick="window.open('../qcm/abbravation.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Abbreviations&nbsp;</a></li>
		             </ul>
            </li>
			<?php
			}
			?>
			</ul>
            </div>
            </div> <div class="toplinks" style="vertical-align:text-top">
              <ul style="vertical-align:text-top">
                <?php ($role == "QCM")
				
			  ?>
                
				
				<li> <a href="../qcm/operprofile.php" >Profile </a> | </li>
				
				 <li>&nbsp;<a href="../qcm/faq.php">FAQ</a>| </li>
				<li>&nbsp;<a href="../qcm/help.php" >Help </a>| </li>
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
			  <li style="float:right; position:relative; display:inline; vertical-align:text-bottom; text-align:left; color:#000000">&nbsp;Wel-Come&nbsp;&nbsp;<?php echo ucwords($logname);?>&nbsp;|&nbsp;<?php echo ucwords($plantname);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
			  </ul>
			  </div>	
            </div>