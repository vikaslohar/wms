<?php
	session_start();
	require_once("../include/config.php");
	require_once("../include/connection.php");
	
	if(isset($_REQUEST['id']))
	{
	$id = $_REQUEST['id'];
	
	}
		if(isset($_REQUEST['cropid']))
	{
 $cropid = $_REQUEST['cropid'];
	
	}
		if(isset($_REQUEST['type']))
	{
 $type = $_REQUEST['type'];
	
	}
	
		if(isset($_REQUEST['foc']))
	{
 $foctype = $_REQUEST['foc'];
	
	}	 

	if(isset($_REQUEST['ofocf']))
	{
	$ofocf = $_REQUEST['ofocf'];
	
	}
	if(isset($_REQUEST['ofocm']))
	{
	$ofocm = $_REQUEST['ofocm'];
	}
	$sq ="";
	if(isset($_POST['sub']))
	{
	$c1 = $_POST['c1'];
	$c2 = $_POST['c2'];
	$c3 = $_POST['c3'];
	$cc = $c1;
	if(!empty($c2)) {
	$cc.="-".$c2;
	}
	if(!empty($c3)) {
	$cc.="-".$c3;
	}
	
	$sq =" and foccode like '%$cc%'";
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Seedtrac-FSW Variety Master - FOC Code Selection</title>
<link href="../include/vnrtrac.css" rel="stylesheet" type="text/css" />
<script language='javascript'>
function test(foccode)
{
if (foccode!="")
{
document.from.foccode.value=foccode;
}
}	
function post_value(){
if(document.from.foc.checked=true)
{

var ftype='<?php echo $foctype?>';
if(ftype=="f")
{
opener.document.form1.Female.value = document.from.foccode.value;
self.close();
}
else
{
opener.document.form1.Male.value = document.from.foccode.value;
self.close();

}
}
}

function mySubmit()
{

if(document.from.foccode.value=="")
{
alert("You must select a FOC Code");
return false;
}
return true;
}

			</script>
</head>
<body topmargin="0" >
<table width="370" height="282" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr class="Dark" height="25">
  <td colspan="4" align="center" class="subheading" valign="middle">Select Foundation Original Code (FOC)</td>
</tr>
  <tr class="Dark" height="25">
  <td colspan="4" align="center" class="subheading" valign="middle"><table border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
  <td valign="top" >
  <?php
 $sql2=mysqli_query($link,"select shortname from tblcrop where cropid='$cropid'")or die(mysqli_error($link));
 
  $row2=mysqli_fetch_array($sql2);
  $shname= $row2['shortname'];
  ?>
  
  
  <form name="from1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
  <input type="text" class="tbltext" name="c1" size="5" value="<?php echo $shname?>"  maxlength="4"/>
  <input type="text" class="tbltext" name="c2" size="1" maxlength="1">
  <input type="text"  class="tbltext" name="c3" size="5" maxlength="4">
  <input type="submit"  class="tbltext" name="sub" value="Search"> 
    </form>
 </td></tr></table></td>
</tr>
  
  
  
  
  
  <tr>
  <td valign="top">
  <form name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="post_value();">
  	<!--input name="id" value="<?php echo $cropid?>" type="hidden"--> 
	 <input name="frm_action" value="submit" type="hidden"> 
	  
      <table  border="1" cellspacing="0" cellpadding="0" width="370" align="center" bordercolor="#ffffff" style="border-collapse:collapse">
	   <?php
	 $sql1=mysqli_query($link,"select foccode from tblparent where cropid='$cropid' $sq order by foccode")or die(mysqli_error($link));
  $sql_f=mysqli_query($link,"select foccode from tblparent where cropid='$cropid'")or die(mysqli_error($link));
	 ?>
	
<?php 
  if($ofocf != "" and $ofocm == "")
  { while($row1=mysqli_fetch_array($sql_f))
	{
  if($ofocf == $row1['foccode'])
  { ?>
  <tr class="Dark" height="25">
<td valign="middle" class="tblheading" colspan="4">&nbsp;Already selected FOC Code1: &nbsp;<font color="#FF0000"> <?php echo $row1['foccode'];?></font></td>
</tr>
<?php }}} else if($ofocf != "" and $ofocm != "") {
 while($row1=mysqli_fetch_array($sql_f))
	{
  if($ofocf == $row1['foccode'])
  { $f1=$row1['foccode']; }
  if($ofocm == $row1['foccode'])
  {$f2=$row1['foccode']; }
  }
  ?> 
   <tr class="Dark" height="25">
<td valign="middle" class="tblheading" colspan="4">&nbsp;Already selected <br />&nbsp;FOC Code1: &nbsp;<font color="#FF0000"> <?php echo $f1;?></font><br />&nbsp;FOC Code2: &nbsp;<font color="#FF0000"> <?php echo $f2;?></font></td>
</tr>
<?php } ?>
<tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading">#</td>
<td  align="left" valign="middle" class="tblheading">&nbsp;FOC Code</td></tr>
   
 <?php
$srno=1;
	while($row=mysqli_fetch_array($sql1))
	{
	 if($ofocf == $row['foccode'])
  {		$srno=$srno-1;
  }
  if($ofocm == $row['foccode'])
  {		$srno=$srno-1;
  }
  
	 if($ofocf != $row['foccode'] and $ofocm != $row['foccode'])
  {
	if ($srno%2 != 0)
	{

?>
<tr class="Dark" height="25">
<td width="37" valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td width="431" colspan="3" valign="middle" class="tbltext"><input type="radio" name="foc" value="<?php echo $row['foccode'];?>" onclick="test(this.value);" /><?php echo $row['foccode'];?></td>
</tr>
<?php
	}
	else
	{
?>
  
<tr class="Light" height="25">
<td width="37" valign="middle" class="tbltext" align="center"><?php echo $srno?></td>
<td width="431" colspan="3" valign="middle" class="tbltext"><input type="radio" name="foc" value="<?php echo $row['foccode'];?>" onclick="test(this.value);" /><?php echo $row['foccode'];?></td>
</tr>
<?php	}
	}
	 $srno=$srno+1;
	}
?>
<input type="hidden" name="foccode" />
</table>

<table cellpadding="5" cellspacing="5" border="0" width="370">
<tr >
<td align="center" colspan="3"><input type="hidden" name="id" value="<?php echo $id?>" /><input type="hidden" name="cropid" value="<?php echo $cropid?>" /><input type="hidden" name="type" value="<?php echo $type?>" /><img src="../images/back.gif" border="0" onClick="window.close()" />&nbsp;<input type="image" src="../images/update.gif" alt="Submit Value" border="0" style="display:inline;cursor:hand;" onclick="return mySubmit();"/></td>
</tr>
</table>


</form>
</td></tr>
</table>

</body>
</html>
