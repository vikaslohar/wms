<div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/psw_logotrac.gif" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
			<ul  id="nav"> 
						<?php
			 if($role == "psw")
			{
			?>
			<?php
			$sql_oop=mysqli_query($link,"select * from tblopr where id='$loginid' and plantcode='$plantcode'")or die(mysqli_error($link)); 
			$total_oop=mysqli_num_rows($sql_oop);
			$row_oop=mysqli_fetch_array($sql_oop);
			?>
            <li><a href="index1.php">Transactions</a>
             <ul>
			    <!--<li><a href="../psw/home_qc.php">&nbsp;QC&nbsp;Sampling&nbsp;Request </a></li>-->
                 <li><a href="../psw/home_sloc_main.php">&nbsp;SLOC&nbsp;Updation</a></li>
               <!-- <li><a href="../psw/StatusUpdation.php">&nbsp;Seed&nbsp;Status&nbsp;Updation&nbsp;</a></li>-->
				<li><a href="../psw/home_remqty.php">&nbsp;Pack&nbsp;Seed&nbsp;Release&nbsp;</a></li>
				<li><a href="../psw/home_rembarqty.php">&nbsp;Pack&nbsp;Seed&nbsp;Barcodes&nbsp;Release&nbsp;</a></li>
				<li><a href="../psw/home_remqtyspl.php">&nbsp;Pack&nbsp;Seed&nbsp;SP&nbsp;Release&nbsp;</a></li>
				<li><a href="../psw/home_p2c.php">&nbsp;Pack&nbsp;Seed&nbsp;SP&nbsp;Unpacking -P2C&nbsp;</a></li>
			 </ul>
            </li>
            <li><a href="index1.php">Reports</a>
            <ul>
			<li><a href="../psw/report_quality.php">&nbsp;Quality&nbsp;Based&nbsp;Pack&nbsp;Seed&nbsp;Report</a></li>
			<li><a href="../psw/report_rawcrop.php">&nbsp;Crop&nbsp;Variety&nbsp;Wise&nbsp;Pack&nbsp;Seed&nbsp;Report</a></li>
			<li><a href="../psw/report_pswstock.php">&nbsp;Pack&nbsp;Seed&nbsp;Stock&nbsp;Report</a></li>
			<li><a href="../psw/report_rawsscrop.php">&nbsp;Substandard&nbsp;Seed&nbsp;Report</a></li>
			<!--<li><a href="../csw/report_variety.php">&nbsp;Coded&nbsp;Condition&nbsp;Seed&nbsp;Report</a></li>
			<li><a href="../psw/report_crop.php">&nbsp;Reserve&nbsp;Pack&nbsp;Seed&nbsp;Report</a></li >	-->
			<li><a href="../psw/report_whwise.php">&nbsp;Warehouse&nbsp;wise&nbsp;Pack&nbsp;Seed&nbsp;Report</a></li>
			<li><a href="../psw/daily_qc_report.php">&nbsp;Daily&nbsp;QC&nbsp;Result&nbsp;Report&nbsp;</a></li>
			<li><a href="../psw/qc_report_ondtage.php">&nbsp;QC&nbsp;Ageing&nbsp;Status&nbsp;Report&nbsp;</a></li>
			<!--<li><a href="../psw/daily_got_report.php">&nbsp;Daily&nbsp;GOT&nbsp;Result&nbsp;Report&nbsp;</a></li>-->
              </ul>
            </li>
            <li>
            <a href="index1.php">Utility</a>
			<ul>
			 <li><a href=" Javascript:void(0)" onClick="window.open('../psw/utility_bs.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Barcode&nbsp;Search</a></li>
			 <!--<li><a href=" Javascript:void(0)" onClick="window.open('../psw/utility.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Lot&nbsp;Biography</a></li>
			    <li><a href=" Javascript:void(0)" onClick="window.open('../psw/slocreport.php','WelCome','top=10,left=50,width=650,height=300,scrollbars=yes')" >&nbsp;SLOC&nbsp;search&nbsp;</a></li>-->
				  <li><a href=" Javascript:void(0)" onClick="window.open('../psw/abbravation.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Abbreviations&nbsp;</a></li>
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
				<li> <a href="../psw/operprofile.php" >Profile</a> | </li>
				<?php
				}
				?>
				 <li>&nbsp; <a href="../arrival/faq.php">FAQ</a> | </li>
				<li>&nbsp; <a href="../arrival/help.php">Help</a> | </li>
                <li> &nbsp; <a href="../logout.php">Logout</a> </li>
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