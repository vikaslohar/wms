<div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/qty_logotrac.gif" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
			<ul  id="nav"> 
			<?php
			$sql_oop=mysqli_query($link,"select * from tblopr where id='$loginid' and plantcode='$plantcode'")or die(mysqli_error($link)); 
			$total_oop=mysqli_num_rows($sql_oop);
			$row_oop=mysqli_fetch_array($sql_oop);
			?>
            <li><a href="indexg.php">Transactions</a>
			 <ul>
			<li><a href="../qc/home_result.php">&nbsp;GOT&nbsp;Result&nbsp;Update</a></li>
			<li><a href="../qc/home_gotdata.php">&nbsp;GOT&nbsp;Data&nbsp;&amp;&nbsp;Result&nbsp;Update</a></li>
			 </ul>
            </li>
            <li><a href="indexg.php">Reports</a>
            <ul>
			<li><a href="../qc/report_got.php">&nbsp;Pending&nbsp;GOT&nbsp;Report</a></li>
			<li><a href="../qc/daily_got_report.php">&nbsp;Daily&nbsp;GOT&nbsp;Result&nbsp;Report&nbsp;</a></li>	
            <li><a href="../qc/got_period_report.php">&nbsp;GOT&nbsp;Result&nbsp;Report</a></li>
			<li><a href="../qc/gotsmpdispreport.php">&nbsp;GOT&nbsp;Sample&nbsp;Dispatch&nbsp;Report</a></li>
              </ul>
            </li>
            <li>
            <a href="indexg.php">Utility</a>
			<ul>
			    <!--<li><a href="../qc/utility_got.php">&nbsp;Lot&nbsp;Query&nbsp;</a></li>-->
				<li><a href="../qc/utility_gotbio.php">&nbsp;GOT&nbsp;Biography&nbsp;</a></li>
				  <li><a href=" Javascript:void(0)" onClick="window.open('../qc/abbravation.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Abbreviations&nbsp;</a></li>
		             </ul>
            </li>
			
			</ul>
            </div>
            </div> 
			<div class="toplinks" style="vertical-align:text-top">
              <ul style="vertical-align:text-top">
				<li> <a href="../qc/operprofile1.php" >Profile </a> | </li>
				
				 <li>&nbsp;&nbsp;<a href="../qc/faq1.php">FAQ</a>| </li>
				<li>&nbsp;&nbsp;<a href="../qc/help1.php" >Help</a>| </li>
                <li>&nbsp;&nbsp;<a href="../logout.php" >Logout</a> </li>
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
			  <li style="float:right; position:relative; display:inline; vertical-align:text-bottom; text-align:left; color:#000000">&nbsp;Wel-Come&nbsp;&nbsp;<?php echo ucwords($logname);?>&nbsp;|&nbsp;<?php echo ucwords($plantname);?>&nbsp;&nbsp;&nbsp;&nbsp;</li>
			  </ul>
			  </div>	
            </div>
