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
/*if(isset($_GET['f']))
	{
	$f = $_GET['f'];	 
	}
*/if(isset($_GET['g']))
	{
	$tid = $_GET['g'];	 
	}
if(isset($_GET['txt1']))
	{
	 $a= $_GET['txt1'];	 
	}
if(isset($_GET['txt12']))
	{
	 $b = $_GET['txt12'];	 
	}
	if(isset($_GET['txt14']))
	{
	 $f = $_GET['txt14'];	 
	}
	if(isset($_GET['txt16']))
	{
	 $d = $_GET['txt16'];	 
	}
	
if(isset($_GET['txtid']))
	{
	$c = $_GET['txtid'];	 
	}
	if(isset($_GET['date']))
	{
    $ee1= $_GET['date'];	 
	}
	
	if(isset($_GET['txtlot1']))
	{
	$lot2= $_GET['txtlot1'];	
	}
	/*
	$quer_cn=mysqli_query($link,"SELECT * FROM tblcrop ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$o=$row_cls['cropname'];
		*/
	if(isset($_GET['txtcrop']))
	{
	$o = $_GET['txtcrop'];	 
	}
	/*
	$quer_cn=mysqli_query($link,"SELECT * FROM tblvariety ");
		$row_cls=mysqli_fetch_array($quer_cn);
		$p=$row_cls['popularname'];*/
	if(isset($_GET['txtvariety']))
	{
	$p = $_GET['txtvariety'];	 
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
if(isset($_GET['txtremarks']))
	{
	$y1 = $_GET['txtremarks'];	 
	}
	
	


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
		
		 $tdate11=$ee1;
		$tday1=substr($tdate11,0,2);
		$tmonth1=substr($tdate11,3,2);
		$tyear1=substr($tdate11,6,4);
		$tdate1=$tyear1."-".$tmonth1."-".$tday1;
if($z1 == 0)
{
   $sql_main="insert into tbl_psw_main (year_code,arr_code, arrival_date,arr_role, plantcode)values('$yearid_id','$c','$tdate1','$logid', '$plantcode')";
if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=mysqli_insert_id($link);

  $sql_sub="insert into tbl_psw (crop, variety, pp,moist,gemp,got,arr_role,lotno ,arrival_id,arrival_date, plantcode)values('$o','$p','$a','$b','$f','$d','$logid','$lot2','$mainid','$tdate1', '$plantcode')";
mysqli_query($link,$sql_sub) or die(mysqli_error($link));
}
$z1=$mainid;
}
else
{
 $sql_main="update tbl_psw_main set year_code='$yearid_id', arrival_date='$tdate1',arr_role='$logid' where arrival_id = '$z1'";

if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=$z1;
 $sql_sub="insert into tbl_psw (crop, variety, pp,moist,gemp,got,arr_role,lotno ,arrival_id,arrival_date, plantcode)values('$o','$p','$a','$b','$f','$d','$logid','$lot2','$mainid','$tdate1', '$plantcode')"; /*$sql_sub="insert into tbl_psw (crop, variety,yearcode,arr_code,pp,moist,gemp,got,arr_role,lotno ,arrival_id)values('$o','$p','$yearid_id','$c','$a','$b','$f','$d','$logid','$lot2','$mainid')";*/
mysqli_query($link,$sql_sub) or die(mysqli_error($link));
}
}

?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#0BC5F4" style="border-collapse:collapse">
  <?php
 $tid=$z1;
?>
  <?php
$sql_tbl=mysqli_query($link,"select * from tbl_psw_main where plantcode='$plantcode' and arr_role='".$logid."'  and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tbl_psw where plantcode='$plantcode' and arrival_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
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
	<td width="17" align="center" valign="middle" class="tblheading">#</td>
			 
			  <td width="99" align="center" valign="middle" class="tblheading">Crop</td>
			  <td width="99" align="center" valign="middle" class="tblheading">Variety</td>
			  <td width="71" align="center" valign="middle" class="tblheading">Lot No. </td>
			  <td width="93" align="center" valign="middle" class="tblheading">NoP</td>
			  <td width="93" align="center" valign="middle" class="tblheading">NoMP</td>
              <td width="82" align="center" valign="middle" class="tblheading">Qty</td>
			   <td width="132" align="center" valign="middle" class="tblheading">SLOC</td>
              <td width="90" align="center" valign="middle" class="tblheading">QC Tests </td>
			   <td width="71" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="74" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
  <?php
 
$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{

 $quer3=mysqli_query($link,"SELECT * FROM tblvariety where varietyid ='".$row_tbl_sub['variety']."' and actstatus='Active'"); 
	$rowvv=mysqli_fetch_array($quer3);
	 $tt=$rowvv['popularname'];
	  $tot=mysqli_num_rows($quer3);	
	 if($tot==0)
	 {
	 $vv=$row_tbl_sub['variety'];
	 }
	 else
	 {
	  $vv=$tt;
	  }
	
$quer3=mysqli_query($link,"SELECT * FROM tblcrop  where cropid='".$row_tbl_sub['crop']."'"); 
$row31=mysqli_fetch_array($quer3);
 $lot=$row_tbl_sub['lotno'];

 $row_tbl_sub['lotno'];
 $totqty=0; $totnob=0; $totnomp=0; $totqc=""; $totdot=""; $totmost=""; $totgemp=""; $totgot=""; $reserve=""; $totsst=""; 	$sloc=""; 
	$sql_issue=mysqli_query($link,"select distinct subbinid, whid, binid from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$row_tbl_sub['lotno']."' ") or die(mysqli_error($link));

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."' and lotno='".$row_tbl_sub['lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 
 $row_issue1[0];
$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
 
$nop1=0;
$wtinmp=$row_issuetbl['wtinmp'];
$upspacktype=$row_issuetbl['packtype'];
$packtp=explode(" ",$upspacktype);
$packtyp=$packtp[0]; 
if($packtp[1]=="Gms")
{ 
	$ptp=($packtp[0]/1000);
}
else
{
	$ptp=$packtp[0];
}
$penqty=(($row_issuetbl['balqty'])-($wtinmp*$row_issuetbl['balnomp']));
if($penqty > 0)
{
	$nop1=($ptp*$penqty);
}

	$totqty=$totqty+$row_issuetbl['balqty']; 
	$totnob=$totnob+$nop1; 
	$totnomp=$totnomp+$row_issuetbl['balnomp'];

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd="";
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sups=$row_issuetbl['balnomp'];
 $sqty=$row_issuetbl['balqty'];

if($sloc!="")
$sloc=$sloc.$wareh.$binn.$subbinn." | ".$nop1." | ".$sups." | ".$sqty."<br/>";
else
$sloc=$wareh.$binn.$subbinn." | ".$nop1." | ".$sups." | ".$sqty."<br/>";$tp1=12;

}


}




$pp="";
	 if($row_tbl_sub['pp']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['pp'];
}
else
{
$pp=$row_tbl_sub['pp'];
}
}
if($row_tbl_sub['gemp']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['gemp'];
}
else
{
$pp=$row_tbl_sub['gemp'];
}
}
if($row_tbl_sub['got']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['got'];
}
else
{
$pp=$row_tbl_sub['got'];
}
}
if($row_tbl_sub['moist']!=""){
if($pp!="")
{
$pp=$pp.",".$row_tbl_sub['moist'];
}
else
{
$pp=$row_tbl_sub['moist'];
}
}


if($srno%2!=0)
{
?>
  <tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row31['cropname'];?></td>
	 <td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $vv;?></td>
    <td width="71" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
   <td align="center" valign="middle" class="tblheading"><?php echo $totnob?></td>
   <td align="center" valign="middle" class="tblheading"><?php echo $totnomp?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
		<td width="132" align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
        <td width="71" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="74" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
  </tr>
  <?php
}
else
{
?>
   <tr class="Light" height="20">
    <td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $row31['cropname'];?></td>
	 <td align="center"  valign="middle" class="tblheading" >&nbsp;<?php echo $vv;?></td>
    <td width="71" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
   <td align="center" valign="middle" class="tblheading"><?php echo $totnob?></td>
   <td align="center" valign="middle" class="tblheading"><?php echo $totnomp?></td>
		   	<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
		<td width="132" align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
	  <td align="center" valign="middle" class="tblheading"><?php echo $pp;?></td>
	        <td width="71" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec(<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
    <td width="74" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>);" /></td>
  </tr>
  <?php
}
$srno++;
}
}

?>
</table>
  <div id="postingsubtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse" > 
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

<td align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
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
	<td align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem">&nbsp;<select class="tbltext" id="itm" name="txtvariety" style="width:170px;"  onchange="modetchk1(this.value)">
<option value="" selected>--Select Variety-</option>
	<?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia_item['varietyid'];?>" />   
		<?php echo $noticia_item['popularname'];?>
		<?php } ?></select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>

         <tr class="Light" height="30" id="vitem">
           <td align="right"  valign="middle" class="tblheading">Lot Number &nbsp;</td>
           <td align="left" width="272" valign="middle" class="tbltext" style="border-color:#0BC5F4" >&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();" readonly="true"  style="background-color:#CCCCCC">&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a></td>
		  
		   <td align="right"  valign="middle" class="tblheading">&nbsp;Select QC Tests&nbsp;</td>
  <td  align="left"  valign="middle" class="tbltext" ><input name="txt1" <?php if($row_tbl_sub['pp']=="P"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0" readonly="true" value="P" onclick="clk(this.value);"/>PP   
   &nbsp;
  <input name="txt12" <?php if($row_tbl_sub['moist']=="M"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0" readonly="true" value="M" onclick="clk(this.value);"/>  
    Moisture  
    &nbsp;
    <input name="txt14" <?php if($row_tbl_sub['gemp']=="G"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0" readonly="true" value="G" onclick="clk(this.value);"/>
    Germination 
    &nbsp;
    <!--<input name="txt16" <?php if($row_tbl_sub['got']=="T"){ echo "checked";}  ?>  type="checkbox" class="tbltext" tabindex="0" readonly="true" value="T" onclick="clk(this.value);" />
GOT <font color="#FF0000">*</font>&nbsp;--></td>
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
