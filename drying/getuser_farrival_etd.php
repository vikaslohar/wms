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
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#adad11" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td width="23%" align="center" rowspan="2" valign="middle" class="tblheading">Lot No. </td>
              <td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">Dispatch No. of Bags </td>
			  <td width="6%" rowspan="2" align="center" valign="middle" class="tblheading">Dispatch Qty </td>
               <td width="12%" rowspan="2" align="center" valign="middle" class="tblheading">SLOC </td>
			   <td width="13%" rowspan="2" align="center" valign="middle" class="tblheading">Quality Status </td>
			    <td width="10%" rowspan="2" align="center" valign="middle" class="tblheading">Received Qty </td>
			    <td width="8%" rowspan="2" align="center" valign="middle" class="tblheading">Recived No. of Bags  </td>
                  <td colspan="2"  align="center" valign="middle" class="tblheading">Diff</td>
             
                  <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
			<tr class="tblsubtitle">
			  <td width="6%"  align="center" valign="middle" class="tblheading">Bag</td>
			  <td width="5%"  align="center" valign="middle" class="tblheading">Qty</td>
               
              </tr>
	<?php
	$srno=1;
	while($srno<=$rid)
	{
	if($srno%2!=0)
	{	
	?>
	<tr class="Light">
	<td align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"><img src="../images/addnew.jpg" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $srno;?>);" /></td>
	<td align="center" valign="middle" class="tbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;"  /></td>
	</tr>
	<?php
	}
	else
	{
	?>	
	<tr class="Dark">
	<td align="center" valign="middle" class="tbltext"><?php echo $srno;?></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"></td>
	<td align="center" valign="middle" class="tbltext"><img src="../images/addnew.jpg" border="0" style="display:inline;cursor:pointer;" onclick="editrec(<?php echo $srno;?>);" /></td>
	<td align="center" valign="middle" class="tbltext"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;"  /></td>
	</tr>
	<?php
	}
	$srno++;
	}
	?>	 
</table>