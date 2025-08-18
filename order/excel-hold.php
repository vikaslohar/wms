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
	
	if(isset($_REQUEST['cdate'])) { $cdate = $_REQUEST['cdate']; }
	if(isset($_REQUEST['txttypchk'])) { $txttypchk = $_REQUEST['txttypchk']; }
	if(isset($_REQUEST['txt11'])) { $txt11=trim($_REQUEST['txt11']); }
	if(isset($_REQUEST['foccode'])) { $foccode=trim($_REQUEST['foccode']); }
	if(isset($_REQUEST['foccode1'])) { $foccode1=trim($_REQUEST['foccode1']); }
	if(isset($_REQUEST['txtcrop'])) { $txtcrop=trim($_REQUEST['txtcrop']); }
	if(isset($_REQUEST['txtvariety'])) { $txtvariety=trim($_REQUEST['txtvariety']); }
	if(isset($_REQUEST['txtpartycat1'])) { $txtpartycat1=trim($_REQUEST['txtpartycat1']); }
	if(isset($_REQUEST['fillpartyname1'])) { $fillpartyname1=trim($_REQUEST['fillpartyname1']); }
	if(isset($_REQUEST['orsrval'])) { $orsrval = $_REQUEST['orsrval']; }
	if(isset($_REQUEST['orderno'])) { $orderno = $_REQUEST['orderno']; }
	if(isset($_REQUEST['txtlot'])) { $txtlot = $_REQUEST['txtlot']; }
	if(isset($_REQUEST['txtlot1'])) { $txtlot1 = $_REQUEST['txtlot1']; }
	if(isset($_REQUEST['txtlot2'])) { $txtlot2 = $_REQUEST['txtlot2']; }
	if(isset($_REQUEST['partyname'])) { $partyname = $_REQUEST['partyname']; }
	if(isset($_REQUEST['txtpartycat'])) { $txtpartycat=trim($_REQUEST['txtpartycat']); }
	if(isset($_REQUEST['fillpartyname'])) { $fillpartyname=trim($_REQUEST['fillpartyname']); }
	if(isset($_REQUEST['sdate'])) { $sdate = $_REQUEST['sdate']; }
	if(isset($_REQUEST['edate'])) { $edate = $_REQUEST['edate']; }
	if(isset($_REQUEST['txtpp'])) { $txtpp = $_REQUEST['txtpp']; }
	if(isset($_REQUEST['txtstatesl'])) { $txtstatesl = $_REQUEST['txtstatesl']; }
	if(isset($_REQUEST['txtlocationsl'])) { $txtlocationsl = $_REQUEST['txtlocationsl']; }
	if(isset($_REQUEST['txtcountrysl'])) { $txtcountrysl = $_REQUEST['txtcountrysl']; }
	if(isset($_REQUEST['txtptype'])) { $txtptype = $_REQUEST['txtptype']; }
	if(isset($_REQUEST['txtparty'])) { $txtparty = $_REQUEST['txtparty']; }
	$partyname_org=$partyname;
	
if($txttypchk=="Consolidated")
{
$mtyp="Consolidated";
$mtyp1="Consolidated Hold";
}
if($txttypchk=="Variety")
{
$mtyp="Variety";
$mtyp1="Variety Hold";
}
else if($txttypchk=="Party")
{
$mtyp="Party";
$mtyp1="Party Hold";
}
else if($txttypchk=="Order")
{
$mtyp="Order(s) of Party";
$mtyp1="Order(s) of Party Hold";
}
	
   
if($txttypchk=="Consolidated")
{
$datahead1 = array("Type:",$mtyp1);
}
else
{
	$datahead1 = array("Type:",$mtyp1,"Category",$txt11);
	
	if($txttypchk=="Variety")
	{
		$quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$txtcrop."' order by cropname Asc"); 
		$noticia = mysqli_fetch_array($quer3);
		$crop=$noticia['cropname'];
		$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$txtvariety."' order by popularname Asc");
		$noticia_item = mysqli_fetch_array($quer4);
		$variety=$noticia_item['popularname'];
		array_push($datahead1,"\n","Crop:",$crop,"Variety:",$variety);
	}
	else if($txttypchk=="Party")
	{
		if($fillpartyname1=="")
		{
			$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$partyname."'"); 
			$row3=mysqli_fetch_array($quer3);
			$partyname1=$row3['business_name']; 
			array_push($datahead1,"\n","Order Type:",$txtpartycat1,"Party Type:",$txtpp);
			//$datahead1 = array("Order Type - " ,$txtpartycat1; , " "," ", " ","Party Type - " ,$txtpp);
			
			$sql_month=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$txtlocationsl."' order by productionlocation")or die(mysqli_error($link));
			$noticia = mysqli_fetch_array($sql_month);
			if($txtpp!="Export Buyer")
			{	
			$pl=$noticia['productionlocation'];
			array_push($datahead1,"\n","State:",$txtstatesl,"Location:",$pl);
			//$datahead1 = array("State - " ,$txtstatesl; , " "," ", " ","Location - " ,$noticia['productionlocation']);
			}
			else
			{
			array_push($datahead1,"\n","country:",$txtcountrysl);
			//$datahead1 = array("country - " ,$txtcountrysl;);
			}
			array_push($datahead1,"\n","Party Name:",$partyname1);
		}
		else
		{
			array_push($datahead1,"\n","Party Name:",$partyname);
		}
	}
	else if($txttypchk=="Order")
	{
		$sql_m=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$orderno%' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
		$row_m=mysqli_fetch_array($sql_m);
		$orderno1=$row_m['orderm_porderno'];
		
		if($orsrval=="ordersearch")
		{
		$styp="Order Search";
		}
		else if($orsrval=="partysearch")
		{
		$styp="Party Search";
		}
		else if($orsrval=="datesearch")
		{
		$styp="Date Search";
		}
		array_push($datahead1,"\n","Search Type:",$styp);
		if($orsrval=="ordersearch")
		{	
			array_push($datahead1,"\n","Order No.:",$orderno1);
		}
		else if($orsrval=="partysearch")
		{
			if($fillpartyname=="")
			{
				$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$partyname."'"); 
				$row3=mysqli_fetch_array($quer3);
				$partyname1=$row3['business_name']; 
				
				array_push($datahead1,"\n","Order Type:",$txtpartycat,"Party Type:",$txtpp);
				
				$sql_month=mysqli_query($link,"select * from tblproductionlocation where productionlocationid='".$txtlocationsl."' order by productionlocation")or die(mysqli_error($link));
				$noticia = mysqli_fetch_array($sql_month);
					if($txtpp!="Export Buyer")
					{	
						$pl=$noticia['productionlocation'];
						array_push($datahead1,"\n","State:",$txtstatesl,"Location:",$pl);
						//$datahead1 = array("State - " ,$txtstatesl; , " "," ", " ","Location - " ,$noticia['productionlocation']);
					}
					else
					{
						array_push($datahead1,"\n","country:",$txtcountrysl);
						//$datahead1 = array("country - " ,$txtcountrysl;);
					}
				array_push($datahead1,"\n","Party Name:",$partyname1);
			}
			else
			{
				array_push($datahead1,"\n","Party Name:",$partyname);
			}
		}
		else if($orsrval=="datesearch")
		{
			array_push($datahead1,"\n","Period - From Date:",$sdate,"To Date:",$edate);
		}
	}
}
	$data1 = array();
	function cleanData(&$str)
	  {
	  	 $str = preg_replace("/\t/", "\\t", $str); 
		 $str = preg_replace("/\n/", "\\n", $str);
	  } 
	   
	    # file name for download $filename = "Order Details.xls";
		$dh="Item_on_Hold_Report_".$cdate;
	    $filename=$dh.".xls";  
	   //exit;
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/vnd.ms-excel");

 $datatitle3 = array("#","Order Date","Order No"," Order Type","Party Name","Crop","Variety","UPS","Qty","NoP","Hold Type");
$d=1;
$a=$txttypchk;   $b=$txt11;
if($a=="Consolidated")
{ 		
	$rec=0;
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));

	$tot_main=mysqli_num_rows($sql_main);
	while($row_main=mysqli_fetch_array($sql_main))
	{
	if($row_main['orderm_holdflag']==1)
	{
	$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
	}
	else
	{
	$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0 and order_sub_hold_flag=1 group by orderm_id") or die(mysqli_error($link));
	}
	
	$tot_sub=mysqli_num_rows($sql_sub);
	if($tot_sub > 0)
	{
	$flgtyp="";
	while($row_sub=mysqli_fetch_array($sql_sub))
	{
	
	if($row_main['orderm_holdflag']==1)
	{
	$flgtyp=$row_main['orderm_holdtype'];
	}
	else
	{
	$flgtyp=$row_sub['order_sub_hold_type'];
	}
		
		$tdate=$row_main['orderm_date'];
		$tyear=substr($tdate,0,4);
		$tmonth=substr($tdate,5,2);
		$tday=substr($tdate,8,2);
		$tdate=$tday."-".$tmonth."-".$tyear;
		
		if($row_main['orderm_party']!="" && $row_main['orderm_party'] > 0)
		{
		$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_main['orderm_party']."'"); 
		$row3=mysqli_fetch_array($quer3);
		$partyname=$row3['business_name'];
		}
		else
		{
		$partyname=$row_main['orderm_partyname'];
		}
		
		$quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$row_sub['order_sub_crop']."' order by cropname Asc"); 
		$noticia = mysqli_fetch_array($quer3);
		$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$row_sub['order_sub_variety']."' order by popularname Asc");
		$noticia_item = mysqli_fetch_array($quer4);
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
		$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
		while($row_sloc=mysqli_fetch_array($sql_sloc))
		{
		$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
		$dq=explode(".",$zz[0]);
		if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
		
		$up1=$qt1." ".$zz[1];
		
		if($up!="")
		$up=$up.",".$up1;
		else
		$up=$up1;
		
		$dq=explode(".",$row_sloc['order_sub_sub_qty']);
		if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}
		
		if($qt!="")
		$qt=$qt.",".$qt1;
		else
		$qt=$qt1;
		
		if($np!="")
		$np=$np.",".$row_sloc['order_sub_sub_nop'];
		else
		$np=$row_sloc['order_sub_sub_nop'];
		}
		$or=$row_main['orderm_porderno'];
		$tr=$row_main['order_trtype'];	
		$crop=$noticia['cropname'];	
		$variety=$noticia_item['popularname'];	
		$hldtype=$flgtyp;			
	if($tot_main > 0)			
	{
	$data1[$d]=array($d,$tdate,$or,$tr,$partyname,$crop,$variety,$up,$qt,$np,$hldtype); 
	$d++;
	}
	}
	}
	}
}
else if($a=="Variety")
{
$srno=1; $cnt=0;
$sql_main=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and order_sub_crop='".$txtcrop."' and order_sub_variety='".$txtvariety."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0 and order_sub_hold_flag=1 group by orderm_id") or die(mysqli_error($link));
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{

if($b=="Commercial")
{ $ortyp="Order TDF";
$sql_sub=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1") or die(mysqli_error($link));
}
else if($b=="TDF")
{
$ortyp="Order TDF";
$sql_sub=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1") or die(mysqli_error($link));
}
else
{
$sql_sub=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1") or die(mysqli_error($link));
}
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{
	$tdate=$row_sub['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_sub['orderm_party']!="" && $row_sub['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_sub['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_sub['orderm_partyname'];
	}
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$txtcrop."' order by cropname Asc"); 
	$noticia = mysqli_fetch_array($quer3);
	$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$txtvariety."' order by popularname Asc");
	$noticia_item = mysqli_fetch_array($quer4);

	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_main['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.",".$up1;
	else
	$up=$up1;
	
	$dq=explode(".",$row_sloc['order_sub_sub_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}
	
	if($qt!="")
	$qt=$qt.",".$qt1;
	else
	$qt=$qt1;
	
	if($np!="")
	$np=$np.",".$row_sloc['order_sub_sub_nop'];
	else
	$np=$row_sloc['order_sub_sub_nop'];
	}
	
		$or=$row_sub['orderm_porderno'];
		$tr=$row_sub['order_trtype'];	
		$crop=$noticia['cropname'];	
		$variety=$noticia_item['popularname'];	
		$hldtype=$row_main['order_sub_hold_type'];			
	if($tot_main > 0)			
	{
	$data1[$d]=array($d,$tdate,$or,$tr,$partyname,$crop,$variety,$up,$qt,$np,$hldtype); 
	$d++;
	}
	
	}
	}
	}
}
else if($a=="Party")
{ 
	$srno=1;  $rec=0;
$ortyp="Order TDF"; 
if($b=="Commercial")
{ $ortyp="Order TDF";
$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
}
else if($b=="TDF")
{
$ortyp="Order TDF";
	if($fillpartyname1!="")
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_holdflag=1 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
else
{
	if($fillpartyname1!="")
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{

	$tdate=$row_main['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_main['orderm_party']!="" && $row_main['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_main['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_main['orderm_partyname'];
	}
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$row_sub['order_sub_crop']."' order by cropname Asc"); 
	$noticia = mysqli_fetch_array($quer3);
	$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$row_sub['order_sub_variety']."' order by popularname Asc");
	$noticia_item = mysqli_fetch_array($quer4);

	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.",".$up1;
	else
	$up=$up1;
	
	$dq=explode(".",$row_sloc['order_sub_sub_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}
	
	if($qt!="")
	$qt=$qt.",".$qt1;
	else
	$qt=$qt1;
	
	if($np!="")
	$np=$np.",".$row_sloc['order_sub_sub_nop'];
	else
	$np=$row_sloc['order_sub_sub_nop'];
	}
	
		$or=$row_main['orderm_porderno'];
		$tr=$row_main['order_trtype'];	
		$crop=$noticia['cropname'];	
		$variety=$noticia_item['popularname'];	
		$hldtype=$row_main['orderm_holdtype'];			
	if($tot_main > 0)			
	{
	$data1[$d]=array($d,$tdate,$or,$tr,$partyname,$crop,$variety,$up,$qt,$np,$hldtype); 
	$d++;
	}
	
	}
	}
	}
	
}
else if($a=="Order")
{ 
	if($orsrval!="partysearch")
	{
	
	$srno=1; $cnt=0; 
$ortyp="Order TDF"; 
if($orsrval=="ordersearch")
{
	if($b=="Commercial")
	{ $ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$orderno%' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else if($b=="TDF")
	{
	$ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$orderno%' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_porderno like '$orderno%' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
else
{

		$sdate=$sdate;
		$sday=substr($sdate,0,2);
		$smonth=substr($sdate,3,2);
		$syear=substr($sdate,6,4);
		$sdate1=$syear."-".$smonth."-".$sday;
		
		$edate=$edate;
		$eday=substr($edate,0,2);
		$emonth=substr($edate,3,2);
		$eyear=substr($edate,6,4);
		$edate1=$eyear."-".$emonth."-".$eday;	
			
	if($b=="Commercial")
	{ $ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_date <= '$edate1' and orderm_date >='$sdate1' and order_trtype!='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_holdflag=1 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else if($b=="TDF")
	{
	$ortyp="Order TDF";
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_date <= '$edate1' and orderm_date >='$sdate1' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_holdflag=1 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_date <= '$edate1' and orderm_date >='$sdate1' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{

	$tdate=$row_main['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_main['orderm_party']!="" && $row_main['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_main['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_main['orderm_partyname'];
	}
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$row_sub['order_sub_crop']."' order by cropname Asc"); 
	$noticia = mysqli_fetch_array($quer3);
	$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$row_sub['order_sub_variety']."' order by popularname Asc");
	$noticia_item = mysqli_fetch_array($quer4);

	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.",".$up1;
	else
	$up=$up1;
	
	$dq=explode(".",$row_sloc['order_sub_sub_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}
	
	if($qt!="")
	$qt=$qt.",".$qt1;
	else
	$qt=$qt1;
	
	if($np!="")
	$np=$np.",".$row_sloc['order_sub_sub_nop'];
	else
	$np=$row_sloc['order_sub_sub_nop'];
	}
	
		$or=$row_main['orderm_porderno'];
		$tr=$row_main['order_trtype'];	
		$crop=$noticia['cropname'];	
		$variety=$noticia_item['popularname'];	
		$hldtype=$row_main['orderm_holdtype'];			
	if($tot_main > 0)			
	{
	$data1[$d]=array($d,$tdate,$or,$tr,$partyname,$crop,$variety,$up,$qt,$np,$hldtype); 
	$d++;
	}
	
	}
	}
	}
	
	}
	else
	{
	
	$srno=1;  $rec=0;
$ortyp="Order TDF"; 
if($b=="Commercial")
{ $ortyp="Order TDF";
$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
}
else if($b=="TDF")
{
$ortyp="Order TDF";
	if($fillpartyname!="")
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_holdflag=1 and orderm_dispatchflag!=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
else
{
	if($fillpartyname!="")
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$partyname."' and order_trtype='".$ortyp."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
	else
	{
	$sql_main=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$partyname."' and orderm_tflag=1 and orderm_supflag=0 and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=1 order by orderm_date, orderm_porderno asc") or die(mysqli_error($link));
	}
}
$tot_main=mysqli_num_rows($sql_main);
while($row_main=mysqli_fetch_array($sql_main))
{
$sql_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_dispatch_flag=0 and order_sub_sup_flag=0") or die(mysqli_error($link));
$tot_sub=mysqli_num_rows($sql_sub);
if($tot_sub > 0)
{
while($row_sub=mysqli_fetch_array($sql_sub))
{

	$tdate=$row_main['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	if($row_main['orderm_party']!="" && $row_main['orderm_party'] > 0)
	{
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id='".$row_main['orderm_party']."'"); 
	$row3=mysqli_fetch_array($quer3);
	$partyname=$row3['business_name'];
	}
	else
	{
	$partyname=$row_main['orderm_partyname'];
	}
	
	$quer3=mysqli_query($link,"SELECT * FROM tblcrop where cropid='".$row_sub['order_sub_crop']."' order by cropname Asc"); 
	$noticia = mysqli_fetch_array($quer3);
	$quer4=mysqli_query($link,"SELECT * FROM tblvariety where varietyid='".$row_sub['order_sub_variety']."' order by popularname Asc");
	$noticia_item = mysqli_fetch_array($quer4);
	
	$up=""; $up1=""; $qt=""; $qt1=""; $zz=""; $np="";
	$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$row_main['orderm_id']."' and order_sub_id='".$row_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
	while($row_sloc=mysqli_fetch_array($sql_sloc))
	{
	$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
	$dq=explode(".",$zz[0]);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$dq[0].".".$dq[1];}
	
	$up1=$qt1." ".$zz[1];
	
	if($up!="")
	$up=$up.",".$up1;
	else
	$up=$up1;
	
	$dq=explode(".",$row_sloc['order_sub_sub_qty']);
	if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_qty'];}
	
	if($qt!="")
	$qt=$qt.",".$qt1;
	else
	$qt=$qt1;
	
	if($np!="")
	$np=$np.",".$row_sloc['order_sub_sub_nop'];
	else
	$np=$row_sloc['order_sub_sub_nop'];
	}
	
		$or=$row_main['orderm_porderno'];
		$tr=$row_main['order_trtype'];	
		$crop=$noticia['cropname'];	
		$variety=$noticia_item['popularname'];	
		$hldtype=$row_main['orderm_holdtype'];			
	if($tot_main > 0)			
	{
	$data1[$d]=array($d,$tdate,$or,$tr,$partyname,$crop,$variety,$up,$qt,$np,$hldtype); 
	$d++;
	}
	
	}
	}
	}
	}

}
//},$per,$sstatus


# coading ends here............
/**/echo implode("\t",$datahead1) ;
	echo "\n";

/*echo implode($datahead2) ;
echo "\n";

echo implode("\t", $datatitle1) ;
echo "\n";*/
echo implode("\t", $datatitle3) ;
echo "\n";

/*echo implode("\t", $datatitle2) ;
echo "\n";*/
	
	foreach($data1 as $row1)
		 { 
		 	#array_walk($row1, 'cleanData'); 
			echo implode("\t", array_values($row1))."\n"; 
		 }
#echo implode("\t", $datatitle3) ;