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

/*if(isset($_GET['frm_action']))
	{
	$a11= $_GET['txt11'];	 
	}
*/	
//  			main arrival table fields

if(isset($_GET['txt11']))
	{
	$a = $_GET['txt11'];	 
	}
	if(isset($_GET['txt14']))
	{
	$b = $_GET['txt14'];	 
	}
	if(isset($_GET['txtid']))
	{
	$c = $_GET['txtid'];	 
	}
	if(isset($_GET['txtid1']))
	{
	$d = $_GET['txtid1'];	 
	}
	if(isset($_GET['date']))
	{
	$e = $_GET['date'];	 
	}
	
	
	if(isset($_GET['txtporn']))
	{
	$h = $_GET['txtporn'];	 
	}
	if(isset($_GET['txttname']))
	{
	$i = $_GET['txttname'];	 
	}
	if(isset($_GET['txtlrn']))
	{
	$j = $_GET['txtlrn'];	 
	}
	if(isset($_GET['txtvn']))
	{
	$k = $_GET['txtvn'];	 
	}
	if(isset($_GET['txtcname']))
	{
	$l= $_GET['txtcname'];	 
	}
	if(isset($_GET['txtdc']))
	{
	$m = $_GET['txtdc'];	 
	}
	
	if(isset($_GET['txtcrop']))
	{
	$n = $_GET['txtcrop'];	 
	}
	if(isset($_GET['txtvariety']))
	{
	$o = $_GET['txtvariety'];	 
	}
	if(isset($_GET['txtstage']))
	{
	$Q = $_GET['txtstage'];	 
	}
	
	
	if(isset($_GET['txtlot']))
	{
	$r = $_GET['txtlot'];	 
	}
	if(isset($_GET['txtraw']))
	{
	$s = $_GET['txtraw'];	 
	}
	if(isset($_GET['txtqty']))
	{
	$t = $_GET['txtqty'];	 
	}
	if(isset($_GET['txtaqty']))
	{
	$u = $_GET['txtaqty'];	 
	}
	if(isset($_GET['txtbag']))
	{
	$v = $_GET['txtbag'];	 
	}
	if(isset($_GET['txtdbag']))
	{
	$w = $_GET['txtdbag'];	 
	}
	if(isset($_GET['txtdqty']))
	{
	$x = $_GET['txtdqty'];	 
	}
	if(isset($_GET['txtstfp']))
	{
	$y = $_GET['txtstfp'];	 
	}
if(isset($_GET['txtsttp']))
	{
	$z= $_GET['txtsttp'];	 
	}
//			End of Main table fields	
	
	
//			2nd table fields start

	
	if(isset($_GET['txtlotp']))
	{
	$r1 = $_GET['txtlotp'];	 
	}
	if(isset($_GET['txtrawp']))
	{
	$s1 = $_GET['txtrawp'];	 
	}
	if(isset($_GET['txtdisp']))
	{
	$t1 = $_GET['txtdisp'];	 
	}
	if(isset($_GET['txtqtystat']))
	{
	$u1 = $_GET['txtqtystat'];	 
	}
	if(isset($_GET['recqtyp']))
	{
	$v1 = $_GET['recqtyp'];	 
	}
	if(isset($_GET['txtrecbagp']))
	{
	$w1 = $_GET['txtrecbagp'];	 
	}
	if(isset($_GET['txtdbagp']))
	{
	$x1 = $_GET['txtdbagp'];	 
	}
	if(isset($_GET['txtdqtyp']))
	{
	$yy1 = $_GET['txtdqtyp'];	 
	}
		
//	/*	end 2nd table fields


// start of 3rd table fields
	
	/*if(isset($_GET['txtwhslg1']))
	{
	$y = $_GET['txtwhslg1'];	 
	}
	if(isset($_GET['txtbinslg1']))
	{
	$z = $_GET['txtbinslg1'];	 
	}
	if(isset($_GET['txtslsubbg1']))
	{
	$a1 = $_GET['txtslsubbg1'];	 
	}
	if(isset($_GET['txtslqtyg1']))
	{
	$b1 = $_GET['txtslqtyg1'];	 
	}
	if(isset($_GET['txtslupsg1']))
	{
	$c1 = $_GET['txtslupsg1'];	 
	}
	if(isset($_GET['txtslwhg2']))
	{
	$d1 = $_GET['txtslwhg2'];	 
	}
	if(isset($_GET['txtslbing2']))
	{
	$e1= $_GET['txtslbing2'];	 
	}
	if(isset($_GET['txtslsubbg2']))
	{
	$f1 = $_GET['txtslsubbg2'];	 
	}
	if(isset($_GET['txtslqtyg2']))
	{
	$g1 = $_GET['txtslqtyg2'];	 
	}
	if(isset($_GET['txtslupsg2']))
	{
	$h1 = $_GET['txtslupsg2'];	 
	}
	if(isset($_GET['txtslwhg3']))
	{
	$i1 = $_GET['txtslwhg3'];	 
	}
	if(isset($_GET['txtslbing3']))
	{
	$j1 = $_GET['txtslbing3'];	 
	}
	if(isset($_GET['txtslsubbg3']))
	{
	$k1 = $_GET['txtslsubbg3'];	 
	}
	if(isset($_GET['txtslqtyg3']))
	{
	$l1 = $_GET['txtslqtyg3'];	 
	}
	if(isset($_GET['txtslupsg3']))
	{
	$m1 = $_GET['txtslupsg3'];	 
	}
	*/
//		end of 3rd table fields

//		start of 2nd table fields
	
	if(isset($_GET['tblslocnod']))
	{
	$n1 = $_GET['tblslocnod'];	 
	}

// 		end of 2nd table fields

//		start of 3rd table fields
	
	if(isset($_GET['txtslwhd1']))
	{
	$o1 = $_GET['txtslwhd1'];	 
	}
	if(isset($_GET['txtslbind1']))
	{
	$p1 = $_GET['txtslbind1'];	 
	}
	if(isset($_GET['txtslsubbd1']))
	{
	$q1 = $_GET['txtslsubbd1'];	 
	}
	if(isset($_GET['txtslqtyd1']))
	{
	$r1 = $_GET['txtslqtyd1'];	 
	}
	if(isset($_GET['txtslupsd1']))
	{
	$s1 = $_GET['txtslupsd1'];	 
	}
	if(isset($_GET['txtslwhd2']))
	{
	$t1 = $_GET['txtslwhd2'];	 
	}
	if(isset($_GET['txtslbind2']))
	{
	$u1 = $_GET['txtslbind2'];	 
	}
	if(isset($_GET['txtslsubbd2']))
	{
	$v1 = $_GET['txtslsubbd2'];	 
	}
	if(isset($_GET['txtslqtyd2']))
	{
	$w1 = $_GET['txtslqtyd2'];	 
	}
	if(isset($_GET['txtslupsd2']))
	{
	$x1 = $_GET['txtslupsd2'];	 
	}
	
//		end of 3rd table fields

//		start of 2nd table fields	
	if(isset($_GET['txtremarks']))
	{
	$y1 = $_GET['txtremarks'];	 
	}
	
// 		end of 2nd table fields


//		main field for the query i.e. if its is 0 then insert query should run & insblock should be replaced else the query should be update query & updblock should be replaced.
	
	if(isset($_GET['maintrid']))
	{
	$z1 = $_GET['maintrid'];	 
	}

	if(isset($_GET['logid']))
	{
	$logid = $_GET['logid'];	 
	}
	
	if(isset($_GET['txtpname']))
	{
	$pname = $_GET['txtpname'];	 
	}

//frm_action=submit&txt11=&txt14=&txtid=19&txtid1=AV19&date=15-05-2009&txtcla=--Select%20Vendor--&txtdcno=&txtporn=&txttname=&txtlrn=&txtvn=&txtcname=&txtdc=&txtclass=--Select%20Classification--&txtitem=--Select%20Item--&txtqtydc=&txtupsdc=&txtupsg=&txtqtyg=&txtqtyd=&txtupsd=&txtexshqty=&txtexshups=&tblslocnog=--Bin--&txtwhslg1=-WH--&txtbinslg1=--Bin--&txtslsubbg1=--Sub%20Bin--&txtslqtyg1=&txtslupsg1=&txtslwhg2=--WH--&txtslbing2=--Bin--&txtslsubbg2=--Sub%20in--&txtslqtyg2=&txtslupsg2=&txtslwhg3=--WH--&txtslbing3=--Bin--&txtslsubbg3=--Sub%20Bin--&txtslqtyg3=&txtslupsg3=&tblslocnod=--Bin-&txtslwhd1=--WH--&txtslbind1=--Bin--&txtslsubbd1=--Sub%20Bin-&txtslqtyd1=&txtslupsd1=&txtslwhd2=--WH--&txtslbind2=--Bin--&txtslsubd2=--Sub%20Bin--&txtslqtyd2=&txtslupsd2=&txtremarks=&maintrid=0
//echo $a; echo $b; exit;
	
	
		$tdate=$e;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;
		
if($z1 == 0)
{
$sql_main="insert into tblstock (date_arr, trcode,cropid, varietyid,  st_id, modeoftran, trans_name, lr_no, vehicle_no, paymode, courier_name, docket_no, nameof_person,tlot_no,tdisp_raw,tdisp_qty,tact_qty,tact_bag,tdiff_bag,tdiff_qty,tstock_fromplant,  	tstock_toplant,remarks,plantcode)values('$tdate','$c','$n','$o','$Q','$a','$i','$j','$k','$b','$l','$m','$pname','$r','$s','$t','$u','$v','$w','$x','$y','$z','$y1','$plantcode')";
//'$c',stn_no,st_code,'$b',
if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=mysqli_insert_id($link);

 $sql_sub="insert into tblstock_sub (tran_id, lot_no, disp_raw, disp_qty, status, rec_bag, diff_bag,rec_qty,diff_qty,plantcode) values('$mainid','$r1','$s1','$t1','$u1','$v1','$w1','$x1','$yy1','$plantcode')";
if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=mysqli_insert_id($link);
/*for($num=0; $num<$x; $num++)
{
if($num==0)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$y','$z','$a1','$b1','$c1','0','0')";
}
if($num==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$d1','$e1','$f1','$g1','$h1','0','0')";
}
if($num==2)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$i1','$j1','$k1','$l1','$m1','0','0')";
}
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}

for($num1=0; $num1<$n1; $num1++)
{
if($num1==0)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$o1','$p1','$q1','0','0','$r1','$s1')";
}
if($num1==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$t1','$u1','$v1','0','0','$w1','$x1')";
}
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
}
}*/
$z1=$mainid;
}
else
{
$sql_main="update tblstock set date_arr='$tdate', trcode='$c', cropid='$n', varietyid='$o',st_id='$Q', modeoftran='$a', trans_name='$i', lr_no='$j', trans_vehno='$k', trans_paymode='$b', courier_name='$l' ,docket_no='$m',nameof_person='$pname',tlot_no='$r' ,tdisp_raw='$s',tdisp_qty='$t',tact_qty='$u',tact_bag='$v',tdiff_bag='$w',tdiff_qty='$x',tstock_fromplant='$y',tstock_toplant='$z',remarks='$y1', where tran_id = '$z1'";

if(mysqli_query($link,$sql_main) or die(mysqli_error($link)))
{
$mainid=$z1;

 $sql_sub="insert into tblstock_sub (tran_id, lot_no, disp_raw, disp_qty, status, rec_bag, diff_bag,rec_qty,diff_qty,plantcode) values('$mainid','$r1','$s1','$t1','$u1','$v1','$w1','$x1','$yy1','$plantcode')";
 if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=mysqli_insert_id($link);
/*for($num=0; $num<$x; $num++)
{
if($num==0)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$y','$z','$a1','$b1','$c1','0','0')";
}
if($num==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$d1','$e1','$f1','$g1','$h1','0','0')";
}
if($num==2)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$i1','$j1','$k1','$l1','$m1','0','0')";
}
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}

for($num1=0; $num1<$n1; $num1++)
{
if($num1==0)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$o1','$p1','$q1','0','0','$r1','$s1')";
}
if($num1==1)
{
$sql_sub_sub="insert into tblarr_sloc (arr_type, arr_tr_id, arr_id, classification_id, item_id, whid, binid, subbin, qty_good, ups_good, qty_damage, ups_damage) values('Stock & Transfer','$mainid','$subid','$n','$o','$t1','$u1','$v1','0','0','$w1','$x1')";
}
mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));*/
}
}
}
}
}
	
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#adad11" style="border-collapse:collapse">
<?php
 $tid=$z1;
?>
<?php
$sql_tbl=mysqli_query($link,"select * from tblarrival where plantcode='".$plantcode."' and   arr_role='".$logid."' and arrival_type='StockTransfer Arrival' and arrival_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);
 $tot=mysqli_num_rows($sql_tbl);		
$arrival_id=$row_tbl['arrival_id'];

$sql_tbl_sub=mysqli_query($link,"select * from tblarrival_sub where plantcode='".$plantcode."' and   arrival_id='".$arrival_id."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

?>
			 <tr class="tblsubtitle" height="20">
              <td width="2%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			 <td width="14%" align="center" rowspan="2" valign="middle" class="tblheading">Lot No.</td>
              <td width="15%" rowspan="2" align="center" valign="middle" class="tblheading">Dispatch No. of Bags</td>
			  <td width="8%" rowspan="2" align="center" valign="middle" class="tblheading">Dispatch Qty</td>
               <td width="10%" rowspan="2" align="center" valign="middle" class="tblheading">SLOC</td>
			   <td width="11%" rowspan="2" align="center" valign="middle" class="tblheading">Quality Status</td>
			    <td width="11%" rowspan="2" align="center" valign="middle" class="tblheading">Received Qty</td>
			    <td width="8%" rowspan="2" align="center" valign="middle" class="tblheading">Recived No. of Bags</td>
                  <td colspan="2"  align="center" valign="middle" class="tblheading">Diff</td>
              <td width="8%" rowspan="2" align="center" valign="middle" class="tblheading">Moisture%</td>
               <td width="10%" rowspan="2" align="center" valign="middle" class="tblheading">PP</td>
			   <td width="11%" rowspan="2" align="center" valign="middle" class="tblheading">GOT Status</td>
			    <td width="11%" rowspan="2" align="center" valign="middle" class="tblheading">Seed Status </td>
                  <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="9%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
			<tr class="tblsubtitle">
			  <td align="center" valign="middle" class="tblheading">Bag</td>
			  <td align="center" valign="middle" class="tblheading">Qty</td>
               
              </tr>
<?php
$srno=1;
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
if($srno%2!=0)
{
?>			  
 <tr class="Light" height="20">
             <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="14%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
             <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where plantcode='".$plantcode."' and   arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
}
?>			 
             <td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
             <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act'];?></td>
             <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
             <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff'];?></td>
			  <td width="14%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
             <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['vchk'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
			 <td width="5%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec('<?php echo $row_tbl_sub['arrsub_id'];?>','<?php echo $tid;?>');" /></td>
 		     <td width="9%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'StockTransfer Arrival');"   /></td>
 </tr>
<?php
}
else
{
?>
<tr class="Light" height="20">
            <td width="2%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
			 <td width="14%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['lotno'];?></td>
             <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty1'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act1'];?></td>
<?php
$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs="";
$sql_sloc=mysqli_query($link,"select * from tblarr_sloc where plantcode='".$plantcode."' and   arr_tr_id='".$arrival_id."' and arr_id='".$row_tbl_sub['arrsub_id']."'") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{$slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_sloc['subbin']."' and binid='".$row_sloc['binid']."' and whid='".$row_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
}
?>			 
             <td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
             <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qc'];?></td>
             <td width="11%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['act'];?></td>
             <td width="8%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['qty'];?></td>
             <td width="4%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff1'];?></td>
             <td width="3%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['diff'];?></td>
			  <td width="14%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['moisture'];?></td>
             <td width="15%" align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['vchk'];?></td>
			 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['got'];?></td>
	 <td align="center" valign="middle" class="tblheading"><?php echo $row_tbl_sub['sstatus'];?></td>
			 <td width="5%" align="center" valign="middle" class="tblheading"><img src="../images/edit.png" border="0" style="display:inline;cursor:Pointer;" onclick="editrec('<?php echo $row_tbl_sub['arrsub_id'];?>','<?php echo $tid;?>');" /></td>
 		     <td width="9%" align="center" valign="middle" class="tblheading"><img border="0" src="../images/delete.png"  onclick="deleterec(<?php echo $tid?>,<?php echo $row_tbl_sub['arrsub_id'];?>,'StockTransfer Arrival');"   /></td>
 </tr> 
<?php
}
$srno++;
}
}
?> 
<input type="hidden" name="itmdchk" value="<?php echo $subtbltot;?>" /> 			  
</table>
		  <br />
		  <div id="postingsubtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#f1bo1e" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item From</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<?php 
//$classqry=mysqli_query($link,"select classification_id, classification from tbl_classification  order by classification") or die(mysqli_error($link));
?>
 <tr class="Dark" height="25">
           <td width="226"  align="right"  valign="middle" class="tblheading">&nbsp;No. Of&nbsp;Lot&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input name="txtlotp" type="text" size="10" class="tbltext" tabindex="" maxlength="5" onkeypress="return isNumberKey(event)" onchange="itemcheck();"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
 </tr>
 <?php 
/*$itemqry=mysqli_query($link,"select items_id, stores_item from tbl_stores order by stores_item") or die(mysqli_error($link));
*/?>            
         <tr class="Light" height="30" id="vitem">
<td height="26" align="right" valign="middle" class="tblheading">Dispatch Total Raw &nbsp;</td>
<td align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtrawp" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="upsdcchk();" /></a>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<td width="231" align="right"  valign="middle" class="tblheading" >Dispatch Total No. of Qty &nbsp;</td>
<td width="142" colspan="3" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtdisp" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onchange="upsdcchk1();" /  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<input type="hidden" name="itmdchk" value="" />
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Quality Status .&nbsp;</td>
<td width="241" align="left"  valign="middle" class="tbltext">&nbsp;<select name="txtqtystat" class="tbltext"  style="width:120px;" tabindex=""  onchange="upsdcchk2();">
		<option value="">---Select Status---</option>
		<option value="Ok">Ok</option>
		<option value="GOTOk">GOTOk</option>
	  </select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
<td align="right"  valign="middle" class="tblheading">Received Qty &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="recqtyp" type="text" size="10" class="tbltext" tabindex="" maxlength="7"  onchange="qtychk1(this.value);" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Receive No. Of Bags &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<input name="txtrecbagp" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey(event)" onchange="upschk1(this.value);"/>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<tr class="Dark" height="30">
<td align="right"  valign="middle" class="tblheading">Difference Bag &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdbagp" type="text" size="10" class="tbltext" tabindex=""   maxlength="5" onkeypress="return isNumberKey(event)" onchange="upschk(this.value);" style="background-color:#CCCCCC" readonly="true" />  &nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<td align="right"  valign="middle" class="tblheading">Difference Qty &nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtdqtyp" type="text" size="10" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000"  readonly="true" >*</font>&nbsp;</td>
</tr>
<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Preliminary Quality</td>
</tr>
<tr class="Light" height="30">
<td align="right"  valign="middle" class="tblheading">Moisture&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtmoist" type="text" size="1" class="tbltext" tabindex=""    maxlength="4" onchange="moischk();" onkeypress="return isNumberKey(event)"  value="<?php echo $row_tbl_sub['moisture'];?>" //>%&nbsp;<font color="#FF0000">*</font>	</td>

<td align="right"  valign="middle" class="tblheading">Physical Purity&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtvisualck" style="width:100px;" onchange="visuchk()">
   <option <?php if($row_tbl_sub['vchk']=="Acceptable"){ echo "Selected";} ?> value="Acceptable">Acceptable</option>
	<option <?php if($row_tbl['vchk']=="Not-Acceptable"){ echo "Selected";} ?>   value="Not-Acceptable" >Not- Acceptable</option>

     
  </select>  <font color="#FF0000">*</font>	</td>
</tr>

<tr class="Dark" height="20">
 <!--/*<td align="right"  valign="middle" class="tblheading">QC&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="qc" style="width:100px;" onchange="visuchk1()">
      <option <?php if($row_tbl_sub['qc']=="UT"){ echo "Selected";} ?> value="UT">UT</option>
	   <option <?php if($row_tbl_sub['qc']=="OK"){ echo "Selected";} ?> value="OK">OK</option>
	    <option <?php if($row_tbl_sub['qc']=="Fail"){ echo "Selected";} ?> value="Fail">Fail</option>
		 <option <?php if($row_tbl_sub['qc']=="RT"){ echo "Selected";} ?> value="RT">RT</option>
  </select>  <font color="#FF0000">*</font>	</td>*/-->
  <td align="right"  valign="middle" class="tblheading">Seed status&nbsp;</td>
<td align="left"  valign="middle" class="tbltext"  colspan="3" >&nbsp;<input name="sstatus" type="text" size="6" class="tbltext" tabindex=""  maxlength="6"  value="<?php echo $row_tbl_sub['sstatus'];?>" style="background-color:#CCCCCC" readonly="true"><a href="Javascript:void(0);" onclick="openslocpop1();">Select</a></td>
  </tr>
  <tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Grow Out Test (GOT) </td>
</tr>
<tr class="Dark" height="25">
    <td align="right"  valign="middle" class="tblheading">GOT Type&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtgot" style="width:100px;" onchange="visuchk(this.value)">
 <option <?php if($row_tbl_sub['got']=="GOT-R"){ echo "Selected";} ?> value="GOT-R">GOT-R</option>
  <option <?php if($row_tbl_sub['got']=="GOT-R"){ echo "Selected";} ?> value="GOT-NR">GOT-NR</option>
   
  </select>  <font color="#FF0000">*</font>	</td>
  <td align="right"  valign="middle" class="tblheading">GOT Status &nbsp;</td>
 <td align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtgo" style="width:100px;" onchange="visuchk(this.value)">
   <option <?php if($row_tbl_sub['qc']=="OK"){ echo "Selected";} ?> value="OK">OK</option>
	    <option <?php if($row_tbl_sub['qc']=="Fail"){ echo "Selected";} ?> value="Fail">Fail</option>
		 <option <?php if($row_tbl_sub['qc']=="RT"){ echo "Selected";} ?> value="RT">RT</option>
    
  </select>  <font color="#FF0000">*</font>
  </td>
  </tr>
   <td align="right"  valign="middle" class="tblheading">Germination&nbsp;</td>
<td align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtgermi" type="text" size="1" class="tbltext" tabindex=""    maxlength="4" onchange="moischk();" onkeypress="return isNumberKey(event)"   value="<?php echo $row_tbl_sub['gemp'];?>"  />%&nbsp;<font color="#FF0000">*</font>	</td>
  <td align="right"  valign="middle" class="tblheading">QC Status &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtqc" style="width:100px;" onchange="visuchk(this.value)">
   <option <?php if($row_tbl_sub['qc']=="UT"){ echo "Selected";} ?> value="UT">UT</option>
	   <option <?php if($row_tbl_sub['qc']=="OK"){ echo "Selected";} ?> value="OK">OK</option>
	    <option <?php if($row_tbl_sub['qc']=="Fail"){ echo "Selected";} ?> value="Fail">Fail</option>
		 <option <?php if($row_tbl_sub['qc']=="RT"){ echo "Selected";} ?> value="RT">RT</option>
    
  </select>  <font color="#FF0000">*</font><input name="txtqc1" type="hidden" size="30" class="tbltext" tabindex="0" readonly="true" style="background-color:#CCCCCC" value="" maxlength="30"/></td>
</tr>
</table>

<!--<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" >
<tr class="Dark" height="30">
<td width="225" align="right"  valign="middle" class="tblheading">SLOC > Good Item > No of Bins&nbsp;</td>
<td width="619" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="tblslocnog" style="width:60px;" onchange="bingood(this.value);" >
<option value="">--Bin--</option>
<option value="1" >1</option>
<option value="2" >2</option>
<option value="3" >3</option>   
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>-->

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:Pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>