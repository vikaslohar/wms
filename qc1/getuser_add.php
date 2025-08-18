
<?php
/*session_start();
	if(!isset($_SESSION['sessionadmin']))
	{
	echo '<script language="JavaScript" type="text/JavaScript">';
	echo "window.location='../login.php' ";
	echo '</script>';
	}
	else
	{
	$year1=$_SESSION['ayear1'];
	$year2=$_SESSION['ayear2'];
	$username= $_SESSION['username'];
	$yearid_id=$_SESSION['yearid_id'];
	$role=$_SESSION['role'];
    $loginid=$_SESSION['loginid'];
    $logid=$_SESSION['logid'];
	$lgnid=$_SESSION['logid'];
	$plantcode=$_SESSION['plantcode'];
	$plantcode1=$_SESSION['plantcode1'];
	$plantcode2=$_SESSION['plantcode2'];
	$plantcode3=$_SESSION['plantcode3'];
	$plantcode4=$_SESSION['plantcode4'];
	}*/
	require_once("../include/config.php");
	require_once("../include/connection.php");

if(isset($_GET['a']))
	{
	$rid = $_GET['a'];	 
	}
?>
<div id="post" style="display:block">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#F1B01E" style="border-collapse:collapse">

          <tr class="tblsubtitle">
              <td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    
    <!--<td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Crop</td>
    <td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Variety</td>-->
	<td width="10%" align="center" rowspan="2" valign="middle" class="tblheading">Old Variety</td>
	<td width="10%" align="center" rowspan="2" valign="middle" class="tblheading">V. Lot No.</td>
	<td width="10%" align="center" rowspan="2" valign="middle" class="tblheading"> Lot No.</td>
	 <td width="10%" align="center" valign="middle" class="tblheading" colspan="2">DC </td>
	 <td width="10%" align="center" valign="middle" class="tblheading" colspan="2">Actual</td>
 <td width="10%" align="center" valign="middle" class="tblheading" colspan="2">Diff</td>

	 	 <td width="10%" align="center" valign="middle" class="tblheading" colspan="2">Prel. Qc</td>

		  <td width="9%" rowspan="2" align="center" valign="middle" class="tblheading">Qc Sample </td>	 
		   <td width="12%" rowspan="2" align="center" valign="middle" class="tblheading">GOT</td>
		 	
		 	<!-- <td width="8%" rowspan="3" align="center" valign="middle" class="tblheading">Seed Stage </td>-->
    <td colspan="1" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
    <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
    <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
 
  <tr class="tblsubtitle">
    <td width="7%" align="center" valign="middle" class="tblheading">NoB</td>
    <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>
     <td width="7%" align="center" valign="middle" class="tblheading">NoB </td>
     <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>
   <td width="7%" align="center" valign="middle" class="tblheading">NoB </td>
    <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>
	  <td width="7%" align="center" valign="middle" class="tblheading">Moist%</td>
      <td width="8%" align="center" valign="middle" class="tblheading">Vc</td>
   </tr>
             
               
 
	<?php
	$srno=1;
	while($srno<=$rid)
	{
	if($srno%2!=0)
	{	
	?>
	<tr class="Light">
	<td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="17%" align="center" valign="middle" class="tblheading"></td>
             <td width="20%" align="center" valign="middle" class="tblheading"></td>
			 <td align="center" valign="middle" class="tblheading"></td>
             <td align="center" valign="middle" class="tblheading"></td>
             <td align="center" valign="middle" class="tblheading"></td>
             <td width="4%" align="center" valign="middle" class="tblheading"></td>
             <td width="4%" align="center" valign="middle" class="tblheading"></td>
             <td width="4%" align="center" valign="middle" class="tblheading"></td>
             <td width="6%" align="center" valign="middle" class="tblheading"></td>
             <td width="4%" align="center" valign="middle" class="tblheading"></td>
             <td width="6%" align="center" valign="middle" class="tblheading"></td>
             <td align="center" valign="middle" class="tblheading"></td>
 		     <td width="9%" align="center" valign="middle" class="tblheading"></td>
			 <td width="4%" align="center" valign="middle" class="tblheading"></td>
 		   <!--  <td width="4%" align="center" valign="middle" class="tblheading"></td>
			  <td width="4%" align="center" valign="middle" class="tblheading"></td>
			   <td width="4%" align="center" valign="middle" class="tblheading"></td>-->
	<td align="center" valign="middle" class="tbltext"><img src="../images/addnew.jpg" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $srno;?>);" /></td>
	<td align="center" valign="middle" class="tbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;"  /></td>
	</tr>
	<?php
	}
	else
	{
	?>	
	<tr class="Dark">
<td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="17%" align="center" valign="middle" class="tblheading"></td>
             <td width="20%" align="center" valign="middle" class="tblheading"></td>
			 <td align="center" valign="middle" class="tblheading"></td>
             <td align="center" valign="middle" class="tblheading"></td>
             <td align="center" valign="middle" class="tblheading"></td>
             <td width="4%" align="center" valign="middle" class="tblheading"></td>
             <td width="4%" align="center" valign="middle" class="tblheading"></td>
             <td width="4%" align="center" valign="middle" class="tblheading"></td>
             <td width="6%" align="center" valign="middle" class="tblheading"></td>
             <td width="4%" align="center" valign="middle" class="tblheading"></td>
             <td width="6%" align="center" valign="middle" class="tblheading"></td>
              <td align="center" valign="middle" class="tblheading"></td>
 		     <td width="9%" align="center" valign="middle" class="tblheading"></td>
			 <td width="4%" align="center" valign="middle" class="tblheading"></td>
 		    <!-- <td width="4%" align="center" valign="middle" class="tblheading"></td>
			  <td width="4%" align="center" valign="middle" class="tblheading"></td>
			   <td width="4%" align="center" valign="middle" class="tblheading"></td>-->
	<td align="center" valign="middle" class="tbltext"><img src="../images/addnew.jpg" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $srno;?>);" /></td>
	<td align="center" valign="middle" class="tbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;"  /></td>
	</tr>
	<?php
	}
	$srno++;
	}
	?>	 
</table>
		  <br />
		
		  
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#F1B01E"  > 
<tr class="Light" height="30">
<td align="right" width="204" valign="middle" class="tblheading" style="border-color:#F1B01E">&nbsp;Lot No.&nbsp;</td>
<td align="left" width="272" valign="middle" class="tbltext" style="border-color:#F1B01E">&nbsp;<input name="txtlot1" type="text" size="6" class="tblheading" tabindex=""  maxlength="6"  value="<?php echo $mode;?>" onchange="mode();">&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void();" onclick="openslocpop();">Select</a></td>
<td align="left" width="366" valign="middle" class="tblheading" style="border-color:#F1B01E">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get details</a></td>
</tr>

</table>
</div>