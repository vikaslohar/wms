<?php
session_start();
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
	}
	require_once("../include/config.php");
	require_once("../include/connection.php");

if(isset($_GET['a']))
{
	$a = $_GET['a'];	 
}
$flag=0; 
//echo $a;
$tt=0;

?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="650" bordercolor="#d21704" style="border-collapse:collapse">
<input type="hidden" name="totemp" value="" onChange="f6(this.value);"/>
<tr class="Dark"><td height="20" colspan="3" class="tblheading" align="center">&nbsp;Assign Farmer to Location(s)</td>
</tr>
<tr>
<td  align="center" valign="top" class="tbltext">&nbsp;<span class="tblheading">Select Location(s) </span>&nbsp;

<?php
$sqstates=mysqli_query($link,"Select * from tbl_state where state_id='".$a."' order by state_name asc") or die(mysqli_error($link));
$tstates=mysqli_num_rows($sqstates);
$rostates=mysqli_fetch_array($sqstates);

	$test=mysqli_query($link,"select distinct gotloc_name from tbl_gotloc where gotloc_state ='".$rostates['state_id']."' and gotloc_status='Active'  order by gotloc_name asc");
	//echo mysqli_num_rows($test);
if(mysqli_num_rows($test)>0)
{ 
?>
<select name="lstfrmdb" size="12" multiple style="width:160px" class="tbltext">
<?php
 
   while($rowstr=mysqli_fetch_array($test))
	{
	echo "select gotloc_name, gotloc_id from tbl_gotloc where gotloc_state ='".$rostates['state_id']."' and gotloc_status='Active' and gotloc_name='".$rowstr['gotloc_name']."'  order by gotloc_name asc";
	$test2=mysqli_query($link,"select gotloc_name, gotloc_id from tbl_gotloc where gotloc_state ='".$rostates['state_id']."' and gotloc_status='Active' and gotloc_name='".$rowstr['gotloc_name']."'  order by gotloc_name asc");
	$rowstr2=mysqli_fetch_array($test2)
 ?>
<option value="<?php echo $rowstr2['gotloc_name']?>" ><?php echo $rowstr2['gotloc_name'];?></option>
	<?php
	}
    ?>	
</select>  
<?php
}
else
{
?>
<select name="lstfrmdb" size="12" multiple style="width:160px" class="tbltext">
<option value="" ></option>
</select>  
<?php
	}
?>  
</td>
<td width="100" valign="top">
<div align="center">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p ><input name="add" src="../images/add3.gif" type="button" width="91" onClick="MoveOption(this.form.lstfrmdb,this.form.list_production_presonal)" value="&nbsp;&nbsp;&nbsp; Add -&gt;" class="tbltext">
<br><br> <input name="remove" src="../images/remove.gif" type="button" width="91"  value="&lt;- Remove &nbsp;&nbsp;&nbsp;" class="tbltext" onClick="MoveOption(this.form.list_production_presonal,this.form.lstfrmdb)">
<input type="hidden" name="hidtxt" value="" />
</p>

<p>&nbsp;</p>
</div></td>
<td align="center" valign="top" class="tbltext">&nbsp;
<span class="tblheading">Selected Location(s) </span>&nbsp;
<select name="lstselectpart" size="12" multiple class="tbltext" id="list_production_presonal" style="width: 160px">
</select></td>
</tr>
</table>