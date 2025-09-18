<div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/csw_logotrac.gif" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
			<ul  id="nav"> 
						<?php
			 if($role == "csw")
			{
			?>
			<?php
			$sql_oop=mysqli_query($link,"select * from tblopr where id='$loginid' and plantcode='$plantcode'")or die(mysqli_error($link)); 
			$total_oop=mysqli_num_rows($sql_oop);
			$row_oop=mysqli_fetch_array($sql_oop);
			?>
            <li><a href="index1.php">Transactions</a>
             <ul>
			 <li><a href="../csw/home_qc.php">&nbsp;QC&nbsp;Sampling&nbsp;Request </a></li>
                <li><a href="../csw/home_slocnew.php">&nbsp;SLOC&nbsp;Updation</a></li>
                <li><a href="../csw/StatusUpdation.php">&nbsp;Seed&nbsp;Status&nbsp;Updation&nbsp;</a></li>
				<li><a href="../csw/add_sloc_binw.php">&nbsp;SLOC&nbsp;Updation&nbsp;Sub-Bin&nbsp;wise</a></li>
				<li><a href="../csw/home_remqty.php">&nbsp;Condition&nbsp;Seed&nbsp;Release&nbsp;</a></li>
				<li><a href="../csw/home_slocnew.php">&nbsp;SLOC&nbsp;Updation&nbsp;New</a></li>
				<li><a href="../csw/home_newbatch.php">&nbsp;Batch&nbsp;Creation&nbsp;</a></li>
			 </ul>
            </li>
            <li><a href="index1.php">Reports</a>
            <ul>
			
			<li><a href="../csw/report_quality.php">&nbsp;Quality&nbsp;Based&nbsp;Condition&nbsp;Seed&nbsp;Report</a></li>
			<li><a href="../csw/report_rawcrop.php">&nbsp;Crop&nbsp;Variety&nbsp;Wise&nbsp;Seed&nbsp;Report</a></li>
			<li><a href="../csw/report_rawsscrop.php">&nbsp;Substandard&nbsp;Seed&nbsp;Report</a></li>
			<!--<li><a href="../csw/report_unid1.php">&nbsp;Unidentified&nbsp;Condition&nbsp;Seed&nbsp;Report</a></li>
			<li><a href="../csw/report_variety.php">&nbsp;Coded&nbsp;Condition&nbsp;Seed&nbsp;Report</a></li>-->
			<li><a href="../csw/report_crop.php">&nbsp;Reserve&nbsp;Condition&nbsp;Seed&nbsp;Report</a></li >
			<li><a href="../csw/report_whwise.php">&nbsp;Warehouse&nbsp;wise&nbsp;Report</a></li>
			<li><a href="../csw/daily_qc_report.php">&nbsp;Daily&nbsp;QC&nbsp;Result&nbsp;Report&nbsp;</a></li>
			<li><a href="../csw/qc_report_ondtage.php">&nbsp;QC&nbsp;Ageing&nbsp;Status&nbsp;Report&nbsp;</a></li>	
			<li><a href="../csw/daily_got_report.php">&nbsp;Daily&nbsp;GOT&nbsp;Result&nbsp;Report&nbsp;</a></li>
			<li><a href="../csw/report_stockprod.php">&nbsp;Condition&nbsp;Seed&nbsp;Stock&nbsp;Report&nbsp;with&nbsp;PD</a></li>
                 	 </ul>
            </li>      
             <li> <a href="index1.php">Utility</a>
			<ul>
			   <li><a href=" Javascript:void(0)" onClick="window.open('../csw/utility.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Lot&nbsp;Biography</a></li>
			    <li><a href=" Javascript:void(0)" onClick="window.open('../csw/slocreport.php','WelCome','top=10,left=50,width=650,height=300,scrollbars=yes')" >&nbsp;SLOC&nbsp;search&nbsp;</a></li>
				  <li><a href=" Javascript:void(0)" onClick="window.open('../csw/abbravation.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Abbreviations&nbsp;</a></li>
		             </ul>
            </li>
			<?php
			}
			?>
			</ul>
            </div>
            </div> <div class="toplinks" style="vertical-align:text-top">
              <ul style="vertical-align:text-top">
                <?php if($role == "csw")
				{
			  ?>
   			<li> <a href="../csw/operprofile.php" >Profile</a> | </li>
				<?php
				}
				?>
				 <li>&nbsp;<a href="../csw/faq.php">FAQ</a> | </li>
				<li>&nbsp; <a href="../csw/help.php">Help</a> | </li>
                <li>&nbsp;<a href="../logout.php">Logout</a> </li>
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
			  <li style="float:right; position:relative; display:inline; vertical-align:text-bottom; text-align:left; color:#000000">&nbsp;Wel-Come&nbsp;&nbsp;<?php echo ucwords($logname);?>&nbsp;|&nbsp;<?php echo ucwords($plantname);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
			  </ul>
			  </div>	
            </div>
