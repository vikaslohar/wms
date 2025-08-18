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
	if(isset($_GET['c']))
	{
	$c = $_GET['c'];	 
	}
if(isset($_GET['txtlrn']))
	{
	 $txtlrn = $_GET['txtlrn'];	 
	}
	if(isset($_GET['txtvn']))
	{
 $txtvn= $_GET['txtvn'];	 
	}
	if(isset($_GET['g']))
	{
	$tid = $_GET['g'];	 
	}
if(isset($_GET['txtcity']))
	{
	$city = $_GET['txtcity'];	 
	}	
if(isset($_GET['txtpin']))
	{
	$pin = $_GET['txtpin'];	 
	}	
if(isset($_GET['txtstate']))
	{
	$state = $_GET['txtstate'];	 
	}	
	 if(isset($_GET['txtparty']))
	{
	$party = $_GET['txtparty'];	 
	}
	if(isset($_GET['txtpname']))
	{
	 $pname = $_GET['txtpname'];	 
	}
if(isset($_GET['txtaddress']))
	{
	$txtaddress = $_GET['txtaddress'];	 
	}
if(isset($_GET['txtaddress1']))
	{
	$txtaddress1 = $_GET['txtaddress1'];	 
	}	
	if(isset($_GET['txtcla']))
	{
	$f = $_GET['txtcla'];	 
	}	
if(isset($_GET['txtid']))
	{
	$c = $_GET['txtid'];	 
	}
	if(isset($_GET['date']))
	{
  $dcdate= $_GET['date'];	 
	}
	if(isset($_GET['txt11']))
	{
	$txt11 = $_GET['txt11'];	 
	}
	if(isset($_GET['txttname']))
	{
 $txttname = $_GET['txttname'];	 
	}
	if(isset($_GET['txtlot1']))
	{
	$lot2= $_GET['txtlot1'];	
	}
		if(isset($_GET['txtstage']))
	{
	$stage= $_GET['txtstage'];	
	}
	if(isset($_GET['txt13']))
	{
 $txt13 = $_GET['txt13'];	 
	}
	if(isset($_GET['txtcla']))
	{
 $txt12 = $_GET['txtcla'];	 
	}
	if(isset($_GET['txtcrop']))
	{
	$contact = $_GET['txtcrop'];	 
	}
	
	if(isset($_GET['txtvariety']))
	{
	$p = $_GET['txtvariety'];	 
	}
	if(isset($_GET['maintrid']))
	{
  $z1 = $_GET['maintrid'];	 
	}
if(isset($_GET['txtcname']))
	{
	$txtcname= $_GET['txtcname'];	 
	}
if(isset($_GET['txtdc']))
	{
	$txtdc = $_GET['txtdc'];	 
	}
if(isset($_GET['txtcname']))
	{
	$txtcname= $_GET['txtcname'];	 
	}
	if(isset($_GET['logid']))
	{
	$logid = $_GET['logid'];	 
	}
//		


if(isset($_GET['subtrid']))
	{
	  $subtrid = $_GET['subtrid'];	 
	}

//		
//	End of Main table fields	
	
	
//			2nd table fields start


//frm_action=submit&txt11=&txt14=&txtid=19&txtid1=AV19&date=15-05-2009&txtcla=--Select%20Vendor--&txtdcno=&txtporn=&txttname=&txtlrn=&txtvn=&txtcname=&txtdc=&txtclass=--Select%20Classification--&txtitem=--Select%20Item--&txtqtydc=&txtupsdc=&txtupsg=&txtqtyg=&txtqtyd=&txtupsd=&txtexshqty=&txtexshups=&tblslocnog=--Bin--&txtwhslg1=-WH--&txtbinslg1=--Bin--&txtslsubbg1=--Sub%20Bin--&txtslqtyg1=&txtslupsg1=&txtslwhg2=--WH--&txtslbing2=--Bin--&txtslsubbg2=--Sub%20in--&txtslqtyg2=&txtslupsg2=&txtslwhg3=--WH--&txtslbing3=--Bin--&txtslsubbg3=--Sub%20Bin--&txtslqtyg3=&txtslupsg3=&tblslocnod=--Bin-&txtslwhd1=--WH--&txtslbind1=--Bin--&txtslsubbd1=--Sub%20Bin-&txtslqtyd1=&txtslupsd1=&txtslwhd2=--WH--&txtslbind2=--Bin--&txtslsubd2=--Sub%20Bin--&txtslqtyd2=&txtslupsd2=&txtremarks=&maintrid=0
//echo $a; echo $b; exit;
	
	/*
		$tdate=$e;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;*/
		
		$ddate1=$dcdate;
		$dday1=substr($ddate1,0,2);
		$dmonth1=substr($ddate1,3,2);
		$dyear1=substr($ddate1,6,4);
		$ddate1=$dyear1."-".$dmonth1."-".$dday1;	
if($z1 == 0)
{
 $sql_main="insert into tbl_gotqc (year_code,arr_code, arrival_date,arr_role, party_id, pid,pname, party_name, address, address1, city, pin, state, contactno ,tmode, trans_name, trans_lorryrepno, trans_vehno, trans_paymode, courier_name, docket_no )values('$yearid_id','$c','$ddate1','$logid','$f','$txt12','$pname','$party','$txtaddress','$txtaddress1', '$city', '$pin', '$state','$contact','$txt11','$txttname','$txtlrn', '$txtvn', '$txt13', '$txtcname', '$txtdc')";
  //exit;
if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
  $mainid=mysqli_insert_id($link);
  $sql_sub="insert into tbl_gotqc1(arrival_id,arr_role,lotno )values('$mainid','$logid','$lot2')";
mysqli_query($link,$sql_sub) or die(mysqli_error($link));
}
$z1=$mainid;
}
else
{
$sql_main="update tbl_gotqc set year_code='$yearid_id', arr_code='$c',arrival_date='$ddate1',party_id='$f', pname='$pname',party_name='$party',address='$txtaddress',address1='$txtaddress1',city='$city',pin='$pin',state='$state',contactno='$contact',tmode='$txt11',trans_name='$txttname',trans_lorryrepno='$txtlrn',trans_vehno='$txtvn',trans_paymode='$txt13',courier_name='$txtcname',docket_no='$txtdc',pid='$txt12' ,arr_role='$logid' where arrival_id = '$z1'";

if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=$z1;
 $sql_sub="insert into tbl_gotqc1(arrival_id,arr_role,lotno )values('$mainid','$logid','$lot2')";
 mysqli_query($link,$sql_sub) or die(mysqli_error($link));
}
}

?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#d21704" style="border-collapse:collapse">
  <?php
 $tid=$z1; 	$sql_param=mysqli_query($link,"select * from tbl_parameters") or die(mysqli_error($link));
$row_param=mysqli_fetch_array($sql_param);

$tp1=$row_param['code'];
?>
  <?php
$sql_tbl=mysqli_query($link,"select * from tbl_gotqc where arr_role='".$logid."'  and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_gotqc1 where arrival_id='".$arrival_id."'") or die(mysqli_error($link));
$row_tbl_sub=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

$tdate=$row_tbl['arrival_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
?>
<tr class="tblsubtitle" height="20">
  <!--<td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
    
    <td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Crop</td>
    <td width="9%" rowspan="3" align="center" valign="middle" class="tblheading">Variety</td>-->
	<td width="2%" align="center" valign="middle" class="tblheading">#</td>
			 
			  <td width="7%" align="center" valign="middle" class="tblheading">Sample No. </td>
			  <td width="14%" align="center" valign="middle" class="tblheading">Lot No. </td>
<!--              <td width="17%" align="center" valign="middle" class="tblheading">Qty</td>-->
			   <td width="17%" align="center" valign="middle" class="tblheading">Crop</td>
               <td width="14%" align="center" valign="middle" class="tblheading">Variety</td>
			   <td width="5%" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="9%" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
 <?php
 
$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
 $lot=$row_tbl_sub['lotno'];
$sql_tbl=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_lotno='".$lot."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$lotldg_trid=$row_tbl['lotldg_trid'];
$lot=$row_tbl['lotldg_lotno'];



$sql_tbl=mysqli_query($link,"select * from tbl_qctest where lotno='".$lot."'") or die(mysqli_error($link));
$row_tbl1=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
 $qc1=$row_tbl1['sampleno'];
 $cc= $row_tbl1['crop'];
 $cc1= $row_tbl1['variety'];
 /* $quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where cropname='".$row_tbl1['crop']."' order by popularname Asc");*/ 
	  
$quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl1['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
 $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl1['variety'];
		 }
	 else
	 {
	  $vv=$tt;
	  }
	
	
	
	
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl1['crop']."'"); 
	$row31=mysqli_fetch_array($quer3);
	 $crp=$row31['cropname'];
if($srno%2!=0)
{
?>

 
  <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $yearid_id?><?php echo sprintf("%000006d",$qc1);?></td>
		   
      <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
      <td align="center" valign="middle" class="tblheading"><?php echo $crp;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
	  <!-- <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['gemp'];?></td>
	    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moist'];?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>-->
        <td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
  </tr>
  <?php
}
else
{
?>
   <tr class="Light" height="20">
    <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $tp1?><?php echo $yearid_id?><?php echo sprintf("%000006d",$qc1);?></td>

       <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
     <td align="center" valign="middle" class="tblheading"><?php echo $crp;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $vv;?></td>
	  <!-- /*<td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['gemp'];?></td>
	    <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moist'];?></td>
		 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>*/-->
        <td width="3%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="5%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
  </tr>
  <?php
}
$srno++;
}
}

?>
</table>
  <div id="postingsubtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
 
		   
          

         <tr class="Light" height="30" id="vitem">
           <td width="421" align="right"  valign="middle" class="tblheading">Lot Number &nbsp;</td>
           <td align="left" width="423" valign="middle" class="tbltext" style="border-color:#d21704" >&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();"  >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
		  
		</tr>


</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<input type="hidden" name="chk1" value="" />
<input type="hidden" name="chk2" value="" />
<input type="hidden" name="chk3" value="" />
<input type="hidden" name="chk4" value="" />

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/Post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>

</div>
