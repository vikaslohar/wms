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
	}require_once("../include/config.php");
	require_once("../include/connection.php");


if(isset($_GET['a']))
	{
  $a = $_GET['a'];	 
	}
	
		
$sql_tbl_sub=mysqli_query($link,"select * from tbl_gsample1 where gsid='".$a."'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
 //$tot_tbl_sub=mysqli_num_rows($sql_tbl_sub);
 
  $tid=$row_tbl_sub['gsid'];
//$subtid=$a;


?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="10" align="center" class="tblheading">Post Item Form</td>
  </tr>
  
  <tr class="tblsubtitle">
    <td width="69" align="center" valign="middle" class="tblheading" >Srno</td>
    <td width="146" align="center" valign="middle" class="tblheading">Old SLOC</td>
   
    <td width="211" align="center" valign="middle" class="tblheading">New SLOC </td>
    <td align="center" valign="middle" class="tblheading" colspan="3">Bin</td>
  </tr>
  <tr class="Light" height="30">
  <?php
  $tot_row=0;
$tot_arrsub=0;

$srno=1;
$lotqry=mysqli_query($link,"select * from tbl_gsample where gscrop ='".$rowpp."' and gsvariety='".$tt."' and lotno='$lotno'")or die (mysqli_error($link));
$row= mysqli_fetch_array($lotqry);
$tot_row=mysqli_num_rows($lotqry);
if($tot_row > 0)
{

  $wh=""; $binn=""; $slocs="";
$wh="GH"."-".$row['gswh']."/";
$binn=$row['gsbin'];
$slocs=$wh.$binn;

  $wh1=""; $binn1=""; $slocs1="";
$wh1="GH"."-".$wh."/";
$binn1=$bin;
 $slocs1=$wh.$binn;
  


if($srno%2!=0)
{?>
    <td width="69" align="center" valign="middle" class="tblheading"><input name="txtlotno"  type="checkbox" size="15" class="tbltext"  maxlength="15" style="background-color:#CCCCCC" value="<?php echo $slocs;?>"/></td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtlotno" type="text" size="15" class="tbltext"  maxlength="15" style="background-color:#CCCCCC" readonly="true" value="<?php echo $slocs;?>"/></td>

   <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tblwarehouse order by perticulars") or die(mysqli_error($link));
?>

   <td colspan="3" align="left"  valign="middle">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:80px;" onchange="wh1(this.value);"  >
            <option value="" selected>-----WH---</option>
            <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
            <option value="<?php echo $noticia_whg1['whid'];?>" />    
            <?php echo $noticia_whg1['perticulars'];?>
            <?php } ?>
          </select><font color="#FF0000">*</font>&nbsp;
		  <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin") or die(mysqli_error($link));
?>
    <td width="411" colspan="3" align="left"  valign="middle" class="tbltext" id="bing1">&nbsp;<select class="tbltext" name="txtslbing1" style="width:80px;" onchange="bin1(this.value);" >
          <option value="" selected>------Bin-------</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
     
	  </tr>
 <?php
}
else
{
?>
  <tr class="Light" height="30">
    <td width="69" align="center" valign="middle" class="tblheading"><input name="txtlotno"  type="checkbox" size="15" class="tbltext"  maxlength="15" style="background-color:#CCCCCC" value="<?php echo $slocs;?>"/></td>
    <td align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtlotno" type="text" size="15" class="tbltext"  maxlength="15" style="background-color:#CCCCCC" readonly="true" value="<?php echo $slocs;?>"/></td>
<?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tblwarehouse order by perticulars") or die(mysqli_error($link));
?>
   
      <td colspan="3" align="left"  valign="middle">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:80px;" onchange="wh1(this.value);"  >
            <option value="" selected>-----WH---</option>
            <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
            <option value="<?php echo $noticia_whg1['whid'];?>" />    
            <?php echo $noticia_whg1['perticulars'];?>
            <?php } ?>
          </select><font color="#FF0000">*</font>&nbsp;
		  <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin") or die(mysqli_error($link));
?>
    <td align="left"  valign="middle" class="tbltext" id="bing1" colspan="3">&nbsp;<select class="tbltext" name="txtslbing1" style="width:80px;" onchange="bin1(this.value);" >
          <option value="" selected>------Bin-------</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
  <?php
  }
  }
  ?>
</table>


<br />
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:Pointer;"  onclick="pformedtup();" />&nbsp;&nbsp;</td>
</tr>
</table>