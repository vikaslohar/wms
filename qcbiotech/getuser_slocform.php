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
if(isset($_GET['b']))
	{
	 $b = $_GET['b'];	 
	}
if(isset($_GET['txtid']))
	{
	$c = $_GET['txtid'];	 
	}

if(isset($_GET['txtslwhg1']))
	{
	$wh= $_GET['txtslwhg1'];	 
	}
if(isset($_GET['txtslbing1']))
	{
	$bin = $_GET['txtslbing1'];	 
	}
	
	

	if(isset($_GET['date']))
	{
  $date= $_GET['date'];	 
	}
	
	if(isset($_GET['txtlot1']))
	{
	$lot2= $_GET['txtlot1'];	
	}
	if(isset($_GET['txtlot2']))
	{
	 $sloc= $_GET['txtlot2'];	
	}
	
	if(isset($_GET['txtcrop']))
	{
	 $crop = $_GET['txtcrop'];	 
	}
	
	if(isset($_GET['txtvariety']))
	{
	$variety = $_GET['txtvariety'];	 
	}
	if(isset($_GET['maintrid']))
	{
	  $z1 = $_GET['maintrid'];	 
	}

if(isset($_GET['subtrid']))
	{
	 $subtrid = $_GET['subtrid'];	 
	}
	if(isset($_GET['logid']))
	{
	$logid = $_GET['logid'];	 
	}
//		
if(isset($_GET['gsid']))
	{
	 $gsid = $_GET['gsid'];	 
	}
	//	End of Main table fields	
	
	
//			2nd table fields start


//frm_action=submit&txt11=&txt14=&txtid=19&txtid1=AV19&date=15-05-2009&txtcla=--Select%20Vendor--&txtdcno=&txtporn=&txttname=&txtlrn=&txtvn=&txtcname=&txtdc=&txtclass=--Select%20Classification--&txtitem=--Select%20Item--&txtqtydc=&txtupsdc=&txtupsg=&txtqtyg=&txtqtyd=&txtupsd=&txtexshqty=&txtexshups=&tblslocnog=--Bin--&txtwhslg1=-WH--&txtbinslg1=--Bin--&txtslsubbg1=--Sub%20Bin--&txtslqtyg1=&txtslupsg1=&txtslwhg2=--WH--&txtslbing2=--Bin--&txtslsubbg2=--Sub%20in--&txtslqtyg2=&txtslupsg2=&txtslwhg3=--WH--&txtslbing3=--Bin--&txtslsubbg3=--Sub%20Bin--&txtslqtyg3=&txtslupsg3=&tblslocnod=--Bin-&txtslwhd1=--WH--&txtslbind1=--Bin--&txtslsubbd1=--Sub%20Bin-&txtslqtyd1=&txtslupsd1=&txtslwhd2=--WH--&txtslbind2=--Bin--&txtslsubd2=--Sub%20Bin--&txtslqtyd2=&txtslupsd2=&txtremarks=&maintrid=0
//echo $a; echo $b; exit;
	
	
		
		$ddate1=$date;
		$dday1=substr($ddate1,0,2);
		$dmonth1=substr($ddate1,3,2);
		$dyear1=substr($ddate1,6,4);
		$ddate1=$dyear1."-".$dmonth1."-".$dday1;	

if($z1 == 0)
{
  $sql_main="insert into tbl_gsample1(gscrop,gsvariety,gsbinn,gswhn,gssloc,gsdate,gscode,gsflg,lotno)values('$crop','$variety','$bin', '$wh','$sloc','$date', '$c','0','$lot2')";
mysqli_query($link,$sql_main) or die(mysqli_error($link));
}
else
{
$sql_main="update tbl_gsample1 set gsbinn='$bin', gswhn='$wh',gssloc='$sloc',gsdate='$ddate1', gscode='$c' ,gscrop='$crop',gsvariety='$variety',lotno='$txtlot1' ,gsflg='0', gscode='$c' where gsid = '$z1'";
mysqli_query($link,$sql_main) or die(mysqli_error($link));
}


/*echo $sql_main="insert into tbl_gsample1(gscrop,gsvariety,gsbinn,gswhn,gssloc,gsdate,gscode,gsflg,lotno)values('$crop','$variety','$bin', '$wh','$sloc','$date', '$c','0','$lot2')";*/
			
		
/*  $sql_main="update tbl_gsample1 set gsbinn='$bin', gswhn='$wh',gssloc='$sloc',trdate='$ddate', gscode='$c' where gsid = '$gsid'";
mysqli_query($link,$sql_main) or die(mysqli_error($link));
*/
//exit;
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#d21704" style="border-collapse:collapse">
 
  <?php
$sql_tbl=mysqli_query($link,"select * from tbl_gsample1 where gsbinn!='' and gswhn!=''") or die(mysqli_error($link));
 $tot=mysqli_num_rows($sql_tbl);	
 
	

?>
<tr class="tblsubtitle" height="20">
              <td width="2%" align="center" valign="middle" class="tblheading">#</td>
			 
			  <td width="7%" align="center" valign="middle" class="tblheading">Crop</td>
			  <td width="14%" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="17%" align="center" valign="middle" class="tblheading">Lotno.</td>
               <td width="14%" align="center" valign="middle" class="tblheading"  >DOGS</td>
			      <td width="14%" align="center" valign="middle" class="tblheading"  > Existing SLOC</td>
				   <td width="14%" align="center" valign="middle" class="tblheading"  >New SLOC</td>
			      <td width="5%" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="9%" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
  <?php
 
$srno=1;
while($row_tbl=mysqli_fetch_array($sql_tbl))
{ 

$lotno=$row_tbl['lotno'];
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl['gscrop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	
		$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl['gsvariety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_arr_home['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
  $wh=""; $binn=""; $slocs="";
$wh="GH"."-".$row_tbl['gswhn']."/";
$binn=$row_tbl['gsbinn'];
$slocs=$wh.$binn;

  $wh1=""; $binn1=""; $slocs1="";
$wh1="GH"."-".$wh."/";
$binn1=$bin;
$slocs1=$wh.$binn;
  
$tid=$gsid;

/*$tdate=$row_tbl['gsdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;*/
	
	$sql_tbl1=mysqli_query($link,"select * from tbl_gsample where lotno='$lotno'") or die(mysqli_error($link));
  $tot=mysqli_num_rows($sql_tbl1);
 $row22=mysqli_fetch_array($sql_tbl1);
 	$tdate=$row22['gsdate'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;

if($srno%2!=0)
{



?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotno'];?></td>
	  	  <td align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['gssloc'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $slocs1;?></td>
        <td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl['gsid'];?>);" /></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_tbl['gsid'];?>);" /></td>
  </tr>
  <?php
}

else
{
?>
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
   <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row31['cropname'];?></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['gsvariety'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['lotno'];?></td>
	  	  <td align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl['gssloc'];?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $slocs1;?></td>
        <td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl['gsid'];?>);" /></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_tbl['gsid'];?>);" /></td>
  </tr>
  <?php
}
$srno++;

}
?>
</table>
  <div id="postingsubtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

<tr class="Dark" height="30">
 <?php
$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop  order by cropname Asc");
/*$quer3=mysqli_fetch_array($quer3);
		$quer3=$row_cls['cropname'];
*/	
?>

<td width="108" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia = mysqli_fetch_array($quer3)) { ?>
		<option value="<?php echo $noticia['cropid'];?>" />   
		<?php echo $noticia['cropname'];?>
		<?php } ?>
	</select>
              <font color="#FF0000">*</font>&nbsp;</td>
			   <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' order by popularname Asc"); 
?>
	<td width="97" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td width="363" align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
         <tr class="Light" height="30" id="vitem">
           <td align="right"  valign="middle" class="tblheading">Lot Number &nbsp;</td>
           <td align="left" width="272" valign="middle" class="tbltext" style="border-color:#d21704" >&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();"  >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
		   <?php $wh=""; $binn=""; $slocs="";
$wh="GH"."-".$row_arr_home['gswh']."/";
$binn=$row_arr_home['gsbin'];

$slocs=$wh.$binn;
?>
		   <td align="right"  valign="middle" class="tblheading">Existing SLOC  &nbsp;</td>
           <td  align="left"  valign="middle" class="tbltext" >&nbsp;<input name="txtlot2" type="text" size="15"  tabindex=""   value="<?php echo $slocs;?>"   readonly="true"  style="background-color:#CCCCCC" ><font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">New SLOC</td>
</tr>
<?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tblwarehouse order by perticulars") or die(mysqli_error($link));
?>

<tr class="Light" height="30" id="vitem">
           <td width="223"  align="right"  valign="middle" class="tblheading">&nbsp;Select GS Warehouse&nbsp; </td>
      <td width="295"  align="left"  valign="middle">&nbsp;<select class="tbltext" name="txtslwhg1" style="width:80px;" onchange="wh1(this.value);"  >
            <option value="" selected>-----WH---</option>
            <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
            <option value="<?php echo $noticia_whg1['whid'];?>" />    
            <?php echo $noticia_whg1['perticulars'];?>
            <?php } ?>
          </select>
        &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin") or die(mysqli_error($link));
?>
		    <td width="223" height="24"  align="right"  valign="middle" class="tblheading">Select Bin &nbsp;</td>
    <td width="295" align="left"  valign="middle" class="tbltext" id="bing1">&nbsp;<select class="tbltext" name="txtslbing1" style="width:80px;" onchange="bin1(this.value);" >
          <option value="" selected>------Bin-------</option>
        </select>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>


</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" />
<!--<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#F1B01E" style="border-collapse:collapse" >
<tr class="Light" height="30">
<td width="88" align="right"  valign="middle" class="tblheading">&nbsp;Remarks&nbsp;</td>
<td width="656" align="left"  valign="middle" class="tbltext">&nbsp;<input type="text" name="txtremarks" class="tbltext" size="100" maxlength="90" ></td>
</tr>
</table>-->
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>

</div>
