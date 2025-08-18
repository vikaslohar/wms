<div class="headerwrapper">
            <div class="logo"><a href="#"><img src="../images/order_logotrac.gif" border="0" /></a></div>
            <div class="menuswrapper">
            <div  id="navigation">
			<ul  id="nav"> 
						<?php
			 if($role == "orderbooking")
			{
			?>
			<?php
			$sql_oop=mysqli_query($link,"select * from tblopr where id='$loginid' and plantcode='$plantcode'")or die(mysqli_error($link)); 
			$total_oop=mysqli_num_rows($sql_oop);
			$row_oop=mysqli_fetch_array($sql_oop);
			?>
            <li><a href="index1.php">Transactions</a>
             <ul>
			    <li><a href="../order/home_ordersa.php">&nbsp;Order&nbsp;-&nbsp;Sales&nbsp;</a></li>
				<li><a href="../order/home_orst.php">&nbsp;Order&nbsp;-&nbsp;Stock Transfer&nbsp;</a></li>
				<li><a href="../order/home_trial.php">&nbsp;Order&nbsp;-&nbsp;Trial/Demo/Free</a></li>
				<li><a href="../order/home_hold.php">&nbsp;Order&nbsp;-&nbsp;Holding/Unholding</a></li><!---->
				<li><a href="../order/home_cancel.php">&nbsp;Order&nbsp;-&nbsp;Cancel</a></li>
				<li><a href="../order/home_release1.php">&nbsp;Order&nbsp;-&nbsp;Release</a></li><!---->
			 </ul>
            </li>
            <li><a href="index1.php">Reports</a>
            <ul>
			<li><a href="../order/report_bookedorder.php">&nbsp;Booked&nbsp;Order&nbsp;Status&nbsp;Report</a></li>
			<li><a href="../order/report_pending.php">&nbsp;Pending&nbsp;Order&nbsp;Report</a></li>
			<li><a href="../order/report_hold.php">&nbsp;Item&nbsp;on&nbsp;Hold &nbsp;Report&nbsp;</a></li>
            <li><a href="../order/report_release.php">&nbsp;Release&nbsp;Order&nbsp;Report</a></li>
			<li><a href="../order/report_cancel.php">&nbsp;Cancel&nbsp;Order&nbsp;Report</a></li>
			<li><a href="../order/report_suspended.php">&nbsp;Suspended&nbsp;Order&nbsp;Report</a></li>
			<li><a href="../order/report_periodbookedorder.php">&nbsp;Periodical&nbsp;Booked&nbsp;Order&nbsp;Report</a></li>		  
              </ul>
            </li>
            <li>
            <a href="index1.php">Utility</a>
			<ul><li><a href=" ../order/utility_hold.php" >&nbsp;Holding&nbsp;Status&nbsp;&nbsp;</a></li>
			 <li><a href="../order/select_order.php">&nbsp;Order&nbsp;Search</a></li>
			
			   <!-- <li><a href=" Javascript:void(0)" onClick="window.open('../arrival/utility_lot.php','WelCome','top=10,left=50,width=650,height=300,scrollbars=yes')" >&nbsp;Decode&nbsp;- SLOC Lookup</a></li>-->
				  <li><a href=" Javascript:void(0)" onClick="window.open('../order/abbravation.php','WelCome','top=10,left=50,width=850,height=400,scrollbars=yes')" >&nbsp;Abbreviations&nbsp;</a></li>
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
                <li> <a href="../order/adminprofile.php" >Profile</a> | </li>
				<?php
				}
				else
				{
				?>
				<li> <a href="../order/operprofile.php" >Profile</a> | </li>
				<?php
				}
				?>
                 <li>&nbsp;<a href="../order/faq.php">FAQ</a> | </li>
				<li>&nbsp;<a href="../order/help.php">Help</a> | </li>
                <li>&nbsp;<a href="../logout.php">Logout</a></li>
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
			  <li style="float:right; position:relative; display:inline; vertical-align:text-bottom; text-align:left; color:#000000">&nbsp;Wel-Come&nbsp;&nbsp;<?php echo ucwords($logname);?>&nbsp;|&nbsp;<?php echo ucwords($plantname);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
			  </ul>
			  </div>	
            </div>