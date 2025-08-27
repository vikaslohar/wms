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

$quer3=mysqli_query($link,"select * from tblfnyears where years_flg != 0 and years_status='a'"); 
$noticia3 = mysqli_fetch_array($quer3);
$ycode=$noticia3['ycode'];

	if(isset($_REQUEST['txtparty']))
	{
   		$party = $_REQUEST['txtparty'];
	}
	
	if(isset($_REQUEST['txttype']))
	{
		$txttype = $_REQUEST['txttype'];
	}
	if(isset($_REQUEST['oid']))
	{
	 	$oid = $_REQUEST['oid'];
	}
	
	if(isset($_REQUEST['txtpp'])) {$txtpp = $_REQUEST['txtpp']; }
	if(isset($_REQUEST['txtstatesl'])) {  $txtstatesl = $_REQUEST['txtstatesl']; }
	if(isset($_REQUEST['txtlocationsl'])) {  $txtlocationsl = $_REQUEST['txtlocationsl']; }
	if(isset($_REQUEST['txtcountrysl'])) { $txtcountrysl = $_REQUEST['txtcountrysl']; }
	if(isset($_REQUEST['txtptype'])) { $txtptype = $_REQUEST['txtptype']; }
	
	if(isset($_POST['frm_action'])=='submit')
	{
	 	$txtid=trim($_POST['txtid']);
	 	$tdate=trim($_POST['date']);
		$party=trim($_POST['txtparty']);
		$type=trim($_POST['txttype']);
		/*$fln=trim($_POST['tt']);
		$flnid =explode(",",$fln);*/
		$txtpp=trim($_POST['txtpp']);
		$txtptype=trim($_POST['txtptype']);
		//$fln1=trim($_POST['tt1']);
		$orrltyp=trim($_POST['orrltyp']);
		//exit;
		$tdate1=explode("-",$tdate);
		$tdate=$tdate1[2]."-".$tdate1[1]."-".$tdate1[0];
		
		//$sql_delm="delete from tbl_orderrelease where orel_id='$oid'";
		//$mqry=mysqli_query($link,$sql_delm) or die(mysqli_error($link));
		
		$sql_delm="delete from tbl_orderrel_sub where orel_id='$oid'";
		$mqry=mysqli_query($link,$sql_delm) or die(mysqli_error($link));
		
		$sql_delm2="delete from tbl_orderrelsub_sub where orel_id='$oid'";
		$mqry=mysqli_query($link,$sql_delm2) or die(mysqli_error($link));
		
		if($orrltyp=="Full")
		{	
			/*$fln=trim($_POST['tt']);
			$flnid =explode(",",$fln);*/
			
			$ssid=trim($_POST['ssid']);
			$cntt=trim($_POST['cntt']);
			$fln=trim($_POST['tt']);
			$fln1=trim($_POST['tt1']);
			$foccode1=trim($_POST['foccode1']);
			$flnid =explode(",",$fln);
			$flnid1 =explode(",",$ssid);
			$flnid2 =explode(",",$foccode1);
			
			$sql_orelm="update tbl_orderrelease set orel_ordermid='$fln', orel_type='$orrltyp', orel_date='$tdate' where orel_id='".$oid."'";
			mysqli_query($link,$sql_orelm)or die(mysqli_error($link));
			foreach($flnid as $fid)
		  	{		
				/*$sql_orderm=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$fid."'")or die(mysqli_error($link));
				$tot_orderm=mysqli_num_rows($sql_orderm);
				$row_orderm=mysqli_fetch_array($sql_orderm);
								
				$sql_orelm="insert into tbl_orderrelease (orel_ordermid, orel_yearid, orel_logid, orel_type, orel_date, orel_tcode) values('$fid', '$ycode', '$logid', '$orrltyp', '$tdate', '$txtid')";
				if(mysqli_query($link,$sql_orelm)or die(mysqli_error($link)))
				{
					$oid=mysqli_insert_id($link);
					*/
					
					$sql_orderm_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$fid."'") or die(mysqli_error($link));
					$tot_orderm_sub=mysqli_num_rows($sql_orderm_sub);
					while($row_orderm_sub=mysqli_fetch_array($sql_orderm_sub))
					{
						$ordersubid=$row_orderm_sub['order_sub_id'];
						$crop=$row_orderm_sub['order_sub_crop'];
						$variety=$row_orderm_sub['order_sub_variety'];
						$upstyp=$row_orderm_sub['order_sub_ups_type'];
						$exttotqty=$row_orderm_sub['order_sub_totbal_qty'];
						
						$sql_orels="insert into tbl_orderrel_sub (orel_id, orelsub_ordermsubid, orelsub_crop, orelsub_variety, orelsub_extqty, orelsub_upstyp, orelsub_relqty, plantcode) values('$oid','$ordersubid','$crop','$variety','$exttotqty','$upstyp','$exttotqty' ,'$plantcode')";
						if(mysqli_query($link,$sql_orels)or die(mysqli_error($link)))
						{
							$osid=mysqli_insert_id($link);
							$relqt=0;
							$sql_orderm_sub_sub=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$fid."' and order_sub_id='".$ordersubid."'") or die(mysqli_error($link));
							$tot_orderm_sub_sub=mysqli_num_rows($sql_orderm_sub_sub);
							while($row_orderm_sub_sub=mysqli_fetch_array($sql_orderm_sub_sub))
							{
								$ordersubsubid=$row_orderm_sub_sub['order_sub_sub_id'];
								$ups=$row_orderm_sub_sub['order_sub_sub_ups'];
								$extqty=$row_orderm_sub_sub['order_sub_sub_qty'];
								$relqt=$relqt+$extqty;
								$sql_orelss="insert into tbl_orderrelsub_sub (orel_id, orelsub_id, orelsub_ordermsubsubid, orelsubsub_ups, orelsubsub_extqty, orelsubsub_relqty, plantcode) values('$oid','$ordersubid','$ordersubsubid','$ups','$extqty','$extqty', '$plantcode')";
								$xz=mysqli_query($link,$sql_orelss)or die(mysqli_error($link));
							}
							$sql_orels_upd="update tbl_orderrel_sub set orelsub_relqty='$relqt' where orelsub_id='$osid'";
							$xc=mysqli_query($link,$sql_orels_upd)or die(mysqli_error($link));
						}
						
					}
				//}
				
				//$sql_in1="update tbl_orderm set orderm_dispatchflag=1 where orderm_id='$fid'";	
				//$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));	
			}
		}
		else
		{	
			$ssid=trim($_POST['ssid']);
			$cntt=trim($_POST['cntt']);
			$fln=trim($_POST['tt']);
			$fln1=trim($_POST['tt1']);
			$foccode1=trim($_POST['foccode1']);
			$flnid =explode(",",$fln);
			$flnid1 =explode(",",$ssid);
			$flnid2 =explode(",",$foccode1);
			
			$sql_orelm="update tbl_orderrelease set orel_ordermid='$fln', orel_type='$orrltyp', orel_date='$tdate' where orel_id='".$oid."'";
			mysqli_query($link,$sql_orelm)or die(mysqli_error($link));
			
			foreach($flnid as $fid)
		  	{
				$sql_orderm_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$fid."'") or die(mysqli_error($link));
				$tot_orderm_sub=mysqli_num_rows($sql_orderm_sub);
				while($row_orderm_sub=mysqli_fetch_array($sql_orderm_sub))
				{
					$ordersubid=$row_orderm_sub['order_sub_id'];
					$crop=$row_orderm_sub['order_sub_crop'];
					$variety=$row_orderm_sub['order_sub_variety'];
					$upstyp=$row_orderm_sub['order_sub_ups_type'];
					$exttotqty=$row_orderm_sub['order_sub_totbal_qty'];
					
					$sql_orels="insert into tbl_orderrel_sub (orel_id, orelsub_ordermsubid, orelsub_crop, orelsub_variety, orelsub_extqty, orelsub_upstyp, plantcode) values('$oid','$ordersubid','$crop','$variety','$exttotqty','$upstyp', '$plantcode')";
					if(mysqli_query($link,$sql_orels)or die(mysqli_error($link)))
					{
						$osid=mysqli_insert_id($link);
						$relqt=0;
						$cnt=count($flnid1);
						for($i=0;$i<$cnt;$i++)
		  				{		
			
						$sql_orderm_sub_sub=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$fid."' and order_sub_id='".$ordersubid."' and order_sub_sub_id='".$flnid1[$i]."'") or die(mysqli_error($link));
						$tot_orderm_sub_sub=mysqli_num_rows($sql_orderm_sub_sub);
						while($row_orderm_sub_sub=mysqli_fetch_array($sql_orderm_sub_sub))
						{
							$ordersubsubid=$flnid1[$i];
							$ups=$row_orderm_sub_sub['order_sub_sub_ups'];
							$extqty=$row_orderm_sub_sub['order_sub_subbal_qty'];
							$relqty=$flnid2[$i];
							$relqt=$relqt+$relqty;
							$sql_orelss="insert into tbl_orderrelsub_sub (orel_id, orelsub_id, orelsub_ordermsubsubid, orelsubsub_ups, orelsubsub_extqty, orelsubsub_relqty, plantcode) values('$oid','$ordersubid','$ordersubsubid','$ups','$extqty','$relqty', '$plantcode')";
							$xz=mysqli_query($link,$sql_orelss)or die(mysqli_error($link));
						}
						}
							$sql_orels_upd="update tbl_orderrel_sub set orelsub_relqty='$relqt' where orelsub_id='$osid'";
							$xc=mysqli_query($link,$sql_orels_upd)or die(mysqli_error($link));
					}
				}
			}
				//$sql_in1="update tbl_orderm set orderm_dispatchflag=2 where orderm_id='$fid'";	
				//$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));	
		}	
		//exit;		
		echo "<script>window.location='add_release_preview.php?txtparty=$party&txttype=$type&txtpp=$txtpp&txtptype=$txtptype&txtcountrysl=$txtcountrysl&txtlocationsl=$txtlocationsl&txtstatesl=$txtstatesl&oid=$oid'</script>";	
		}
		/*if($orrltyp=="Full")
		{	
			$fln=trim($_POST['tt']);
			$flnid =explode(",",$fln);
			foreach($flnid as $fid)
		  	{		
				$sql_orderm=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$fid."'")or die(mysqli_error($link));
				$tot_orderm=mysqli_num_rows($sql_orderm);
				$row_orderm=mysqli_fetch_array($sql_orderm);
								
				$sql_orelm="update tbl_orderrelease set orel_ordermid='$fid', orel_type='$orrltyp', orel_date='$tdate' where orel_id='".$oid."'";
				if(mysqli_query($link,$sql_orelm)or die(mysqli_error($link)))
				{
					//$oid=mysqli_insert_id($link);
					$sql_orderm_sub=mysqli_query($link,"select * from tbl_order_sub where orderm_id='".$fid."'") or die(mysqli_error($link));
					$tot_orderm_sub=mysqli_num_rows($sql_orderm_sub);
					while($row_orderm_sub=mysqli_fetch_array($sql_orderm_sub))
					{
						$ordersubid=$row_orderm_sub['order_sub_id'];
						$crop=$row_orderm_sub['order_sub_crop'];
						$variety=$row_orderm_sub['order_sub_variety'];
						$upstyp=$row_orderm_sub['order_sub_ups_type'];
						$exttotqty=$row_orderm_sub['order_sub_totbal_qty'];
						
						$sql_orels="insert into tbl_orderrel_sub (orel_id, orelsub_ordermsubid, orelsub_crop, orelsub_variety, orelsub_extqty, orelsub_upstyp, orelsub_relqty) values('$oid','$ordersubid','$crop','$variety','$exttotqty','$upstyp','$exttotqty')";
						if(mysqli_query($link,$sql_orels)or die(mysqli_error($link)))
						{
							$osid=mysqli_insert_id($link);
							$relqt=0;
							$sql_orderm_sub_sub=mysqli_query($link,"select * from tbl_order_sub_sub where orderm_id='".$fid."' and order_sub_id='".$ordersubid."'") or die(mysqli_error($link));
							$tot_orderm_sub_sub=mysqli_num_rows($sql_orderm_sub_sub);
							while($row_orderm_sub_sub=mysqli_fetch_array($sql_orderm_sub_sub))
							{
								$ordersubsubid=$row_orderm_sub_sub['order_sub_sub_id'];
								$ups=$row_orderm_sub_sub['order_sub_sub_ups'];
								$extqty=$row_orderm_sub_sub['order_sub_sub_qty'];
								$relqt=$relqt+$extqty;
								$sql_orelss="insert into tbl_orderrelsub_sub (orel_id, orelsub_id, orelsub_ordermsubsubid, orelsubsub_ups, orelsubsub_extqty, orelsubsub_relqty) values('$oid','$ordersubid','$ordersubsubid','$ups','$extqty','$extqty')";
								$xz=mysqli_query($link,$sql_orelss)or die(mysqli_error($link));
							}
							$sql_orels_upd="update tbl_orderrel_sub set orelsub_relqty='$relqt' where orelsub_id='$osid'";
							$xc=mysqli_query($link,$sql_orels_upd)or die(mysqli_error($link));
						}
						
					}
				}
				
				//$sql_in1="update tbl_orderm set orderm_dispatchflag=1 where orderm_id='$fid'";	
				//$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));	
			}
		}
		else
		{	
			$ssid=trim($_POST['ssid']);
			$cntt=trim($_POST['cntt']);
			$fln=trim($_POST['tt']);
			$fln1=trim($_POST['tt1']);
			$foccode1=trim($_POST['foccode1']);
			$flnid =explode(",",$ssid);
			$flnid1 =explode(",",$foccode1);
			
			$sql_orderm=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$fln."'")or die(mysqli_error($link));
			$tot_orderm=mysqli_num_rows($sql_orderm);
			$row_orderm=mysqli_fetch_array($sql_orderm);
			
			$sql_orelm="update tbl_orderrelease set orel_ordermid='$fln', orel_type='$orrltyp', orel_date='$tdate' where orel_id='".$oid."'";					
			if(mysqli_query($link,$sql_orelm)or die(mysqli_error($link)))
			{
				//$oid=mysqli_insert_id($link);
				$sql_orderm_sub=mysqli_query($link,"select * from tbl_order_sub where orderm_id='".$fln."'") or die(mysqli_error($link));
				$tot_orderm_sub=mysqli_num_rows($sql_orderm_sub);
				while($row_orderm_sub=mysqli_fetch_array($sql_orderm_sub))
				{
					$ordersubid=$row_orderm_sub['order_sub_id'];
					$crop=$row_orderm_sub['order_sub_crop'];
					$variety=$row_orderm_sub['order_sub_variety'];
					$upstyp=$row_orderm_sub['order_sub_ups_type'];
					$exttotqty=$row_orderm_sub['order_sub_totbal_qty'];
					
					$sql_orels="insert into tbl_orderrel_sub (orel_id, orelsub_ordermsubid, orelsub_crop, orelsub_variety, orelsub_extqty, orelsub_upstyp) values('$oid','$ordersubid','$crop','$variety','$exttotqty','$upstyp')";
					if(mysqli_query($link,$sql_orels)or die(mysqli_error($link)))
					{
						$osid=mysqli_insert_id($link);
						$relqt=0;
						$cnt=count($flnid);
						for($i=0;$i<$cnt;$i++)
		  				{		
			
						$sql_orderm_sub_sub=mysqli_query($link,"select * from tbl_order_sub_sub where orderm_id='".$fln."' and order_sub_id='".$ordersubid."' and order_sub_sub_id='".$flnid[$i]."'") or die(mysqli_error($link));
						$tot_orderm_sub_sub=mysqli_num_rows($sql_orderm_sub_sub);
						while($row_orderm_sub_sub=mysqli_fetch_array($sql_orderm_sub_sub))
						{
							$ordersubsubid=$flnid[$i];
							$ups=$row_orderm_sub_sub['order_sub_sub_ups'];
							$extqty=$row_orderm_sub_sub['order_sub_subbal_qty'];
							$relqty=$flnid1[$i];
							$relqt=$relqt+$relqty;
							$sql_orelss="insert into tbl_orderrelsub_sub (orel_id, orelsub_id, orelsub_ordermsubsubid, orelsubsub_ups, orelsubsub_extqty, orelsubsub_relqty) values('$oid','$ordersubid','$ordersubsubid','$ups','$extqty','$relqty')";
							$xz=mysqli_query($link,$sql_orelss)or die(mysqli_error($link));
						}
						}
							$sql_orels_upd="update tbl_orderrel_sub set orelsub_relqty='$relqt' where orelsub_id='$osid'";
							$xc=mysqli_query($link,$sql_orels_upd)or die(mysqli_error($link));
					}
				}
			}
				//$sql_in1="update tbl_orderm set orderm_dispatchflag=2 where orderm_id='$fid'";	
				//$aa=mysqli_query($link,$sql_in1)or die(mysqli_error($link));	
		}	
		//exit;
	echo "<script>window.location='add_release_preview.php?txtparty=$party&txttype=$type&txtpp=$txtpp&txtptype=$txtptype&txtcountrysl=$txtcountrysl&txtlocationsl=$txtlocationsl&txtstatesl=$txtstatesl&oid=$oid'</script>";	
		}*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order- Transaction -Order Release</title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
</head>
<script src="cancel.js"></script>
<script type="text/javascript">

//SuckerTree Horizontal Menu (Sept 14th, 06)
//By Dynamic Drive: http://www.dynamicdrive.com/style/

var menuids=["nav"] //Enter id(s) of SuckerTree UL menus, separated by commas

function buildsubmenus_horizontal(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
		if (ultags[t].parentNode.parentNode.id==menuids[i]){ //if this is a first level submenu
			ultags[t].style.top=ultags[t].parentNode.offsetHeight+"px" //dynamically position first level submenus to be height of main menu item
			ultags[t].parentNode.getElementsByTagName("a")[0].className="mainfoldericon"
		}
		else{ //else if this is a sub level menu (ul)
		  ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
    	ultags[t].parentNode.getElementsByTagName("a")[0].className="subfoldericon"
		}
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.visibility="visible"
    }
    ultags[t].parentNode.onmouseout=function(){
  this.getElementsByTagName("ul")[0].style.visibility="hidden"
    }
    }
  }
}

if (window.addEventListener)
window.addEventListener("load", buildsubmenus_horizontal, false)
else if (window.attachEvent)
window.attachEvent("onload", buildsubmenus_horizontal)

</script>
<script language="javascript" type="text/javascript">

function formPost(top_element){
	var inputs=top_element.getElementsByTagName('*');
	var qstring=new Array();
	for(var i=0;i<inputs.length;i++){
		if(!inputs[i].disabled&&inputs[i].getAttribute('name')!=""&&inputs[i].getAttribute('name')){
			qs_str=inputs[i].getAttribute('name')+"="+encodeURIComponent(inputs[i].value);
			switch(inputs[i].tagName.toLowerCase()){
				case "select":
					if(inputs[i].getAttribute("multiple")){
						var len2=inputs[i].length;
						for(var j=0;j<len2;j++){
							if(inputs[i].options[j].selected){
								var targ=(inputs[i].options[j].value) ? inputs[i].options[j].value : inputs[i].options[j].text;
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
							}
						}
					}
					else{
						var targ=(inputs[i].options[inputs[i].selectedIndex].value) ? inputs[i].options[inputs[i].selectedIndex].value : inputs[i].options[inputs[i].selectedIndex].text
						qstring[qstring.length]=inputs[i].getAttribute('name')+"="+encodeURIComponent(targ);
					}
				break;
				case "textarea":
					qstring[qstring.length]=qs_str;
				break;
				case "input":
					switch(inputs[i].getAttribute("type").toLowerCase()){
						case "radio":
							if(inputs[i].checked){
								qstring[qstring.length]=qs_str;
							}
						break;
						case "checkbox":
							if(inputs[i].value!=""){
								if(inputs[i].checked){
									qstring[qstring.length]=qs_str;
								}
							}
							else{
								var stat=(inputs[i].checked) ? "true" : "false"
								qstring[qstring.length]=inputs[i].getAttribute('name')+"="+stat;
							}
						break;
						case "text":
							qstring[qstring.length]=qs_str;
						break;
						case "password":
							qstring[qstring.length]=qs_str;
						break;
						case "hidden":
							qstring[qstring.length]=qs_str;
						break;
					}
				break;
			}
		}
	}
	return qstring.join("&");
}
function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.form.sdate,dt,document.form.sdate, "dd-mmm-yyyy", xind, yind);
	}
	
	function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.form.edate,dt,document.form.edate, "dd-mmm-yyyy", xind, yind);
	}

function getDateObject(dateString,dateSeperator)
{
	//This function return a date object after accepting 
	//a date string ans dateseparator as arguments
	var curValue=dateString;
	var sepChar=dateSeperator;
	var curPos=0;
	var cDate,cMonth,cYear;

	//extract day portion
	curPos=dateString.indexOf(sepChar);
	cDate=dateString.substring(0,curPos);
	
	//extract month portion				
	endPos=dateString.indexOf(sepChar,curPos+1);			
	cMonth=dateString.substring(curPos+1,endPos);

	//extract year portion				
	curPos=endPos;
	endPos=curPos+5;			
	cYear=curValue.substring(curPos+1,endPos);
	
	//Create Date Object
	dtObject=new Date(cYear,cMonth-1,cDate);	
	return (dtObject);
} 
function party(cats)
{
var typ=document.from.txttype.value;
document.from.txtpty.value=cats;
document.getElementById('postingsubtable').style.display="none";
showUser(cats,'vaddress','vendor',typ,'','','','',cats);
}
function ortypchk(ortypval)
{
document.getElementById('postingsubtable').style.display="none";
document.from.orrltyp.value=ortypval;
}
function partycatsl1(catslval)
{
	if(document.from.orrltyp.value=="")
	{
		alert("Please Select Order Release Type");
		document.from.txttype.selectedIndex=0;
		document.getElementById('postingsubtable').style.display="none";
		return false;
	}
	else
	{
		document.getElementById('postingsubtable').style.display="none";
		showUser(catslval,'vitem11','partytyp','','','','','',catslval);
	}
}
function modetchk1(classval)
{	
		document.getElementById('postingsubtable').style.display="none";
		if(classval=="C&F")
		{
		(classval="CandF")
		}
		
		document.getElementById('selectpartylocation').style.display="block";
		document.getElementById('vitem1').style.display="none";
		showUser(classval,'selectpartylocation','partylocation','','','','','');
		document.from.txtptype.value=classval;
}
function locslchk(statesl)
{
//alert("statesl");
showUser(statesl,'locations','location','','','','','','');
}
function stateslchk(valloc)
{
	if(document.from.txtstatesl.value=="")
	{
		alert("Please Select State for Location");
		document.from.txtlocationsl.selectedIndex=0;
	}
	else
	{
		var classval=document.from.txtptype.value;
		document.getElementById('vitem1').style.display="block";
		//showUser(classval,'vitem1','item1','','','','','',classval);
		showUser(classval,'vitem1','item1',valloc,'','','','');
		document.from.locationname.value=valloc;
	}
}
function loccontrychk(countryval)
{

		if(document.from.txtpp.value!="")
		{
			var classval=document.from.txtptype.value;
			document.getElementById('vitem1').style.display="block";
			showUser(classval,'vitem1','item1',countryval,'','','','');
			document.from.locationname.value=countryval;
			document.from.txtcountry1.value=countryval;
		}
		else
		{
			alert("Please Select Party Type");
			document.from.txtcountrysl.selectedIndex=0;
		}

}	
function getdetails()
{
if(document.from.txttype.value=="")
	{
		alert("Please Select Order Type");
		document.from.txttype.focus();
		fl=1;
		return false;
	}
	
	if(document.from.txtparty.value=="")
	{
		alert("Please Select Party");
		document.from.txtparty.focus();
		fl=1;
		return false;
	}
	
var stage=document.from.txtpty.value;
var orrltyp=document.from.orrltyp.value;
var typ=document.from.txttype.value;
//alert(stage);
showUser(stage,'postingsubtable','get',orrltyp,typ,'');
document.getElementById('postingsubtable').style.display="block";
/*if(stage=="txtparty")
			{
				document.getElementById('fill').style.display="block";
				document.from.txtparty.value=stage;
				
			}	*/
			}	

function pform()
{	
	dt3=getDateObject(document.from.dcdate.value,"-");
	dt4=getDateObject(document.from.date.value,"-");
	var fl=0;	
	
	if(dt3 > dt4)
	{
	alert("Please select Valid Delivary Challan Date.");
	fl=1;
	return false;
	}
	
	if(document.from.txttype.value=="")
	{
		alert("Please Select Order Type");
		document.from.txttype.focus();
		fl=1;
		return false;
	}
	
	if(document.from.txtparty.value=="")
	{
		alert("Please Select Party");
		document.from.txtparty.focus();
		fl=1;
		return false;
	}
	
	if(fl==1)
	{
	return false;
	}
	else
	{	//alert("hi");
	var a=formPost(document.getElementById('mainform'));
		//alert(a);
		//document.form.bbbb.value=a
		showUser(a,'postingtable','mform','','','','','');
			document.getElementById('fill').style.display="none";
		}  
	//}
}

function pformedtup()
{	
  	dt3=getDateObject(document.form.dcdate.value,"-");
	dt4=getDateObject(document.form.date.value,"-");
	var fl=0;	
	
	if(dt3 > dt4)
	{
	alert("Please select Valid Delivary Challan Date.");
	fl=1;
	return false;
	}
	
	if(document.from.txttype.value=="")
	{
		alert("Please Select Order Type");
		document.from.txttype.focus();
		fl=1;
		return false;
	}
	
	if(document.from.txtparty.value=="")
	{
		alert("Please Select Variety");
		document.from.txtparty.focus();
		fl=1;
		return false;
	}
	
	if(fl==1)
	{
	return false;
	}
	else
	{	//alert("hi");
	
		var a=formPost(document.getElementById('mainform'));
		//alert(a);
		showUser(a,'postingtable','mformsubedt','','','','');
		}
	//}
}


function openslocpop(party)
{
	var typ=document.from.txttype.value;
	if(typ=="Sales")
	{
	winHandle=window.open('son.php?itmid='+party,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
	else if(typ=="Stock")
	{
	winHandle=window.open('ton.php?itmid='+party,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
	else if(typ=="TDF")
	{
	winHandle=window.open('don.php?itmid='+party,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
	if(winHandle==null){
	alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
	}
	else
	{
		alert("Please select Order Type");
		document.from.txttype.focus();
		return false;
	}
}

function showorddet(orderval, orreltyp, orn)
{
	var fg=0;
	var focid="foc"+orn;
	if(document.getElementById(focid).checked == true)fg++;
	if(fg>0)
	{
	var xzxz="orderdet"+orn;
	showUser(orderval,xzxz,'orderdetails',orreltyp,orn,orn,'');
	}
	else
	{
		var xzxz="orderdet"+orn;
		document.getElementById(xzxz).innerHTML="";
	}
}

function relorqtychk(relqty, srn, orn)
{
	var extqty="extorqty"+orn+"_"+srn;
	var rlqty="relqty"+orn+"_"+srn;
	var blqty="orbalqty"+orn+"_"+srn;
	if(parseFloat(document.getElementById(rlqty).value) > parseFloat(document.getElementById(extqty).value))
	{
		alert("Release Quantity cannot be more than Existing Quantity");
		document.getElementById(rlqty).value="";
		return false;
	}
	else
	{
		if(relqty!="")
		document.getElementById(blqty).value=parseFloat(document.getElementById(extqty).value)-parseFloat(document.getElementById(rlqty).value);
		else
		document.getElementById(blqty).value="";
	}
}

function editrec(edtrecid, trid)
{
showUser(edtrecid,'postingsubtable','subformedt',trid,'','','','');
}

function deleterec(v1,v2,v3)
{
	if(confirm('Do u wish to delete this item?')==true)
	{
		showUser(v1,'postingtable','delete',v2,v3,'','','');
	}
	else
	{
		return false;
	}
}




function selectall()
{
//alert("foc");
	if(document.from.srno.value > 2)
	{
		for (var i = 0; i < document.from.foc.length; i++)
		{          
			document.from.foc[i].checked = true;
		}
	}	
	else
	{
		document.from.foc.checked = true;
	}
}

function unselectall()
{
	if(document.from.srno.value > 2)
	{
		for (var i = 0; i < document.from.foc.length; i++) 
		{          
			document.from.foc[i].checked = false;
			document.from.foccode.value ="";
		}
	}
	else
	{
		document.from.foc.checked = false;
		document.from.foccode.value ="";
	}	
}
function mySubmit()
{ 
//alert(document.from.srno.value);
document.from.foccode.value="";
document.from.foccode1.value="";
document.from.ssid.value="";
if(document.from.orrltyp.value=="Full")
{
	
if(document.from.srno.value !=0)
{
	if(document.from.srno.value > 2)
	{
			for (var i = 0; i < document.from.foc.length; i++) 
			{          
			  if(document.from.foc[i].checked == true)
				{
					if(document.from.foccode.value =="")
					{
					document.from.foccode.value=document.from.foc[i].value;
					//document.from.foccode1.value=document.from.foc[i].value;
					}
					else
					{
					document.from.foccode.value = document.from.foccode.value +','+document.from.foc[i].value;
					//document.from.foccode1.value = document.from.foccode1.value +'\n'+document.from.foc[i].value;
					}
				}
			}
	}
	else
	{
		if(document.from.foc.checked == true)
		{
			if(document.from.foccode.value =="")
			{
				document.from.foccode.value=document.from.foc.value;
				//document.from.foccode1.value=document.from.foc[i].value;
			}
			else
			{
				document.from.foccode.value = document.from.foccode.value +','+document.from.foc.value;
			}
		}
	}
}
else
{
	alert("You have not Selected any Order to Release. Please select & then click Preview");
	return false;
}
	document.from.tt.value = document.from.foccode.value;
	if(document.from.tt.value == "")
	{
		alert("Please select Order");
		return false;
	}
}
else
{
	if(document.from.srno.value > 2)
	{
		for (var i = 0; i < document.from.foc.length; i++) 
		{          
			if(document.from.foc[i].checked == true)
			{
				if(document.from.foccode.value =="")
				{
					document.from.foccode.value=document.from.foc[i].value;
				}
				else
				{
					document.from.foccode.value = document.from.foccode.value +','+document.from.foc[i].value;
				}
			}
		}
	}
	else
	{
		if(document.from.foc.checked == true)
		{
			if(document.from.foccode.value =="")
			{
				document.from.foccode.value=document.from.foc.value;
			}
			else
			{
				document.from.foccode.value = document.from.foccode.value +','+document.from.foc.value;
			}
		}
	}
	document.from.tt.value = document.from.foccode.value;
	if(document.from.tt.value == "")
	{
		alert("Please select Order");
		return false;
	}
	else
	{
		var ccnntt=0;
		if(document.from.srno.value > 2)
		{	
			for (var i = 0; i < document.from.foc.length; i++) 
			{   
				var k=i;       
				if(document.from.foc[k].checked == true)
				{
					i++; var srno24="srno24"+i;
					var subsubid="subsubid"+i;
					if(document.from.tt1.value!="")
					{
						document.from.tt1.value = document.from.tt1.value+","+((document.getElementById(srno24).value)-1);
					}
					else
					{
						document.from.tt1.value = ((document.getElementById(srno24).value)-1);
					}
					if(document.getElementById(srno24).value > 1)
					{	
						var relqty="relqty"+i;
						var relqty1=relqty+"_1"; 
						for (var j = 1; j < document.getElementById(srno24).value; j++) 
						{         
							var relqty2=relqty+"_"+j;
							var subsubid2=subsubid+"_"+j;
							if(document.from.ssid.value!="")
							{
								document.from.ssid.value=document.from.ssid.value+","+document.getElementById(subsubid2).value;
							}
							else
							{
								document.from.ssid.value=document.getElementById(subsubid2).value;
							}
							
							if(document.getElementById(relqty2).value =="")document.getElementById(relqty2).value=0;
							if(document.getElementById(relqty2).value>0)ccnntt++; 
							
							
							if(document.from.foccode1.value!="")
							{
								document.from.foccode1.value=document.from.foccode1.value+","+document.getElementById(relqty2).value;
							}
							else
							{
								document.from.foccode1.value=document.getElementById(relqty2).value;
							}
						}
					}
					else
					{
						document.from.ssid.value=document.getElementById(subsubid).value;
						if(document.getElementById(relqty1).value =="")document.getElementById(relqty1).value=0;
						if(document.getElementById(relqty1).value>0)ccnntt++;
						
						document.from.foccode1.value=document.getElementById(relqty1).value;
					}
					if(ccnntt==0)
					{
						alert("Please enter Release Quantity");
						return false;
					}
					document.from.cntt.value=document.getElementById(relqty1).length;
					i=k;
				}
			}
		}
		else
		{	
			if(document.from.foc.checked == true)
			{
				var i=1;	var relqty="relqty"+i; var relqty1="relqty"+i+"_1"; var srno24="srno24"+i; var subsubid="subsubid"+i;
				//alert(subsubid);
				document.from.tt1.value = ((document.getElementById(srno24).value)-1);
				if(document.getElementById(srno24).value > 1)
				{
					for (var j = 1; j < document.getElementById(srno24).value; j++) 
					{          
						var relqty2="relqty"+i+"_"+j; var subsubid2="subsubid"+i+"_"+j;
						if(document.from.ssid.value!="")
						{
							document.from.ssid.value=document.from.ssid.value+","+document.getElementById(subsubid2).value;
						}
						else
						{
							document.from.ssid.value=document.getElementById(subsubid2).value;
						}
						if(document.getElementById(relqty2).value =="")document.getElementById(relqty2).value=0;
						if(document.getElementById(relqty2).value>0)ccnntt++; 
						
						if(document.from.foccode1.value!="")
						{
							document.from.foccode1.value=document.from.foccode1.value+","+document.getElementById(relqty2).value;
						}
						else
						{
							document.from.foccode1.value=document.getElementById(relqty2).value;
						}
					}
				}
				else
				{
					document.from.ssid.value=document.getElementById(subsubid).value;
					if(document.getElementById(relqty1).value =="")document.getElementById(relqty1).value=0;
					if(document.getElementById(relqty1).value>0)ccnntt++;
					document.from.foccode1.value=document.getElementById(relqty1).value;
				}
				if(ccnntt==0)
				{
					alert("Please enter Release Quantity");
					return false;
				}
				document.from.cntt.value=document.getElementById(relqty1).length;
			}
		}
	}
}
if(document.from.foccode.value=="" && document.from.foccode1.value=="")
{
	alert("Please select option OR enter Release Quantity");
	return false;
}

return true;	 
}

</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_order.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/order_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">

		  <!-- actual page start--->	
  
 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="32" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" style="border-bottom:solid; border-bottom-color:#cc30cc" >
	    <tr >
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction - Order Release - Edit</td>
	    </tr></table></td>
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	
	<?php 
 $sql_orrelm=mysqli_query($link,"Select * from tbl_orderrelease where plantcode='$plantcode' and orel_id='$oid'") or die(mysqli_error($link));
$tot_orrelm=mysqli_num_rows($sql_orrelm);
$row_orrelm=mysqli_fetch_array($sql_orrelm);
$tid240=explode(",",$row_orrelm['orel_ordermid']);  
foreach($tid240 as $tid6)
{
if($tid6<>"")
{
$tid=$tid6;
}
}
$code1="TOR".$row_orrelm['orel_tcode']."/".$ycode."/".$lgnid;

$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$row_tbl=mysqli_fetch_array($sql_tbl);			
$arrival_id=$row_tbl['orderm_id'];

	
	
?>	   
<form  name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return mySubmit();"   >
  <input name="frm_action" value="submit" type="hidden" />
  <input name="txt11" value="<?php echo $row_tbl['orderm_tmode']?>" type="hidden"> 
	    <input name="txt14" value="<?php echo $row_tbl['orderm_paymode']?>" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $row_orrelm['orel_tcode']?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="hidden" name="gln1" value="" />
		<input type="hidden" name="txtconchk" value="<?php echo $row_tbl['orderm_consigneeapp']?>" />
		<input type="hidden" name="txtptype" value="<?php echo $row_tbl['orderm_party_type'];?>" />
		<input type="hidden" name="txtpty" value="<?php echo $party;?>" />
		</br>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="16"></td>
</tr>
<tr>
<td width="30">	 </td><td>

<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Edit  Release Order</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>

 <tr class="Dark" height="30">
 <td width="205" align="right" valign="middle" class="tblheading">&nbsp;Date&nbsp;</td>
<td width="220" align="left" valign="middle" class="tbltext">&nbsp;<input name="date" type="text" size="10" class="tbltext" tabindex="0" readonly="true"  style="background-color:#CCCCCC" value="<?php echo date("d-m-Y");?>" maxlength="10"/>&nbsp;</td>
<td width="206" align="right" valign="middle" class="tblheading">&nbsp;Transaction Id &nbsp;</td>
<td width="209"  align="left" valign="middle" class="tbltext">&nbsp;<?php echo $code1?></td>
</tr>
<tr class="Dark" height="30">
 <td width="205" align="right" valign="middle" class="tblheading">&nbsp;Order Release Type&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input type="radio" name="orltype" value="Full" onchange="ortypchk(this.value)" <?php if($row_orrelm['orel_type']=="Full") echo "checked";?> />Full Release&nbsp;<input type="radio" name="orltype" value="Partial" onchange="ortypchk(this.value)" <?php if($row_orrelm['orel_type']=="Partial") echo "checked";?>  />Partial Release<input type="hidden" name="orrltyp" value="<?php echo $row_orrelm['orel_type']?>" /></td>
</tr>
<tr class="Light" height="30">
 <?php
// echo $txttype;
//$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer'"); 
?>

<td align="right"  valign="middle" class="tblheading">Order Type &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<select class="tbltext" name="txttype" style="width:150px;" onchange="modetchk1(this.value)">
<option value="" selected>--Select--</option>
  <option <?php if($txttype=="Sales"){ echo "Selected";} ?> value="Sales">Order Sales</option>
  <option <?php if($txttype=="Stock"){ echo "Selected";} ?> value="Stock">Order Stock</option>
   <option <?php if($txttype=="TDF"){ echo "Selected";} ?> value="TDF">Order TDF</option>
  </select>
	&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
</table>
 <div id="vitem11">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<?php
if($txttype=="Sales"){ $main="Channel";}
if($txttype=="Stock"){ $main="Stock Transfer";} 
if($txttype=="TDF"){ $main="TDF - Individual";}
//echo $main;  
if($txttype!="TDF")
{
$sql_month=mysqli_query($link,"select * from tblclassification where plantcode='$plantcode' and main='$main' order by classification")or die(mysqli_error($link));
$t=mysqli_num_rows($sql_month);
//echo $txtpp;
?>
		<tr class="Dark" height="30">
<td width="206" align="right"  valign="middle" class="tblheading">Party Type&nbsp;</td>
<td width="638" colspan="3" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtpp" style="width:120px;" onchange="modetchk1(this.value)" tabindex="" >
<option value="" selected>--Select--</option>
	<?php while($noticia = mysqli_fetch_array($sql_month)) {?>
		<option <?php if($noticia['classification']==$txtpp){ echo "Selected";} ?>  value="<?php echo $noticia['classification'];?>" />   
		<?php echo $noticia['classification'];?>
		<?php } ?>
	</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>  
</table>

<div id="selectpartylocation"style="display:<?php if($txtpp!=""){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<?php
if($txtpp!="Export Buyer")
{	

?>
<?php
$sq_states=mysqli_query($link,"Select * from tbl_state order by state_name asc") or die(mysqli_error($link));
$t_states=mysqli_num_rows($sq_states);
?>
<tr class="Light" height="30">
<td width="206" align="right"  valign="middle" class="tblheading">State&nbsp;</td>
<td width="221" align="left"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtstatesl" style="width:120px;" onchange="locslchk(this.value)">
 <option value="">--Select State--</option>
<?php while($ro_states=mysqli_fetch_array($sq_states)) {?>
	<option value="<?php echo $ro_states['state_name'];?>" <?php if($txtstatesl==$ro_states['state_name']){ echo "Selected";} ?>  ><?php echo $ro_states['state_name'];?></option>
<?php } ?>  
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>

<?php
$sql_month3=mysqli_query($link,"select * from tblproductionlocation where state='".$txtstatesl."' order by productionlocation")or die(mysqli_error($link));
//$noticia3 = mysqli_fetch_array($sql_month3);
 $txtlocationsl;
?>	
	<td width="105" align="right"  valign="middle" class="tblheading">Location&nbsp;</td>
<td width="308" align="left"  valign="middle" class="tbltext" id="locations">&nbsp;<select class="tbltext" name="txtlocationsl" style="width:160px;" onchange="stateslchk(this.value)">
<option value="" selected>--Select--</option>
<?php while($noticia3 = mysqli_fetch_array($sql_month3)) { ?>
		<option <?php if($txtlocationsl==$noticia3['productionlocationid']){ echo "Selected";} ?> value="<?php echo $noticia3['productionlocationid'];?>" />   
		<?php echo $noticia3['productionlocation'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr><input type="hidden" name="locationname" value="" />
<?php
}
else
{
$sql_month=mysqli_query($link,"select * from tblcountry order by country")or die(mysqli_error($link));
?>
<tr class="Light" height="30">
<td width="206"  align="right"  valign="middle" class="tblheading">Country&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtcountrysl" style="width:220px;" onchange="loccontrychk(this.value)">
<option value="">--Select--</option>
<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option <?php if($noticia['country']==$row_tbl['orderm_country']){ echo "Selected";} ?> value="<?php echo $noticia['country'];?>" />   
		<?php echo $noticia['country'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr><input type="hidden" name="locationname" value="" />
<?php
}
?>
</table>
</div>		   
<div id="vitem1"style="display:<?php if($txtpp!=""){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<?php

if($txtpp!="Export Buyer")
{
$sql_month24=mysqli_query($link,"select * from tbl_partymaser where location_id='".$txtlocationsl."' and classification='".$txtpp."' order by business_name")or die(mysqli_error($link));
}
else
{ 
$sql_month33=mysqli_query($link,"select * from tblcountry where country='".$txtcountrysl."' order by country")or die(mysqli_error($link));
$row_month33=mysqli_fetch_array($sql_month33); 

$sql_month24=mysqli_query($link,"select * from tbl_partymaser where country='".txtcountrysl."' and classification='".$txtpp."' order by business_name")or die(mysqli_error($link));
}

$t=mysqli_num_rows($sql_month24);
?>
 <tr class="Dark" height="30">
<td width="206" align="right"  valign="middle" class="tblheading" >Party Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtparty" style="width:220px;" onchange="party(this.value)" >
<option value="" selected="selected">--Select--</option>
<?php while($noticia24 = mysqli_fetch_array($sql_month24)) { //echo $noticia24['p_id'];?>
		<option <?php if($noticia24['p_id']==$party){ echo "Selected";} ?> value="<?php echo $noticia24['p_id'];?>" />   
		<?php echo $noticia24['business_name'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<?php

$sql_month22=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='$party' and orderm_dispatchflag!=1 order by orderm_party")or die("Error:".mysqli_error($link));
$tott=mysqli_num_rows($sql_month22);

if($tott==0)
{
$sql_month22=mysqli_query($link,"select * from tbl_partymaser where p_id='$party'")or die("Error:".mysqli_error($link));
$row_month22=mysqli_fetch_array($sql_month22);
$addrs=$row_month22['address']; if($row_month22['city']!="") { $add=$add.", ".$row_month22['city']; } $add=$add.", ".$row_month22['state'];
}
else
{
$row_month22=mysqli_fetch_array($sql_month22);
$addrs=$row_month22['orderm_partyaddress']; if($row_month22['orderm_partycity']!="") { $addrs=$addrs.", ".$row_month22['orderm_partycity']; } $addrs=$addrs.", ".$row_month22['orderm_partystate'];
}
?>
<tr class="Light" height="30">
<td width="206" align="right"  valign="middle" class="tblheading" >Address&nbsp;</td>
<td width="638" colspan="5" align="left"  valign="middle" class="tbltext" id="vaddress"> <div style="padding-left:3px;"><?php echo $addrs;?><input type="hidden" name="adddchk" value="" /></div>  </td>
</tr>

</table>
</div>
<?php
}
else
{
?>
<div id="vitem1"style="display:<?php if($txtpp!=""){ echo "block";} else { echo "none"; }?>" >
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<?php
$pnmeid="";$pnme="";
$sql_month=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and order_trtype='Order TDF' and orderm_partyselect='selectp' and orderm_dispatchflag!=1 order by orderm_party")or die(mysqli_error($link));
while($noticia = mysqli_fetch_array($sql_month)) 
{ 
$pn=$noticia['orderm_party'];
 if($pnmeid!="")
 $pnmeid=$pnmeid.","."'$pn'";
 else
 $pnmeid="'$pn'";
}
//echo $pnmeid;
if($pnmeid!="")
{
	$sql_month2=mysqli_query($link,"select * from tbl_partymaser where p_id IN ($pnmeid) order by business_name")or die(mysqli_error($link));
	$tot=mysqli_num_rows($sql_month2);
	while($noticia2 = mysqli_fetch_array($sql_month2)) 
	{
		if($pnme!="")
		$pnme=$pnme.",".$noticia2['business_name'];
		else
		$pnme=$noticia2['business_name'];
	}
}
//echo $pnme;
$sql_month3=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and order_trtype='Order TDF' and orderm_partyselect!='selectp' and orderm_dispatchflag!=1 order by orderm_party")or die(mysqli_error($link));
while($noticia3 = mysqli_fetch_array($sql_month3)) 
{ 
	if($pnme!="")
	$pnme=$pnme.",".$noticia3['orderm_partyname'];
	else
	$pnme=$noticia3['orderm_partyname'];
}
?>
 <tr class="Dark" height="30">
<td width="206" align="right"  valign="middle" class="tblheading" >Party Name&nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtparty" style="width:220px;" onchange="party(this.value)" >
<option value="" selected="selected">--Select--</option>
<?php $p_array=explode(",",$pnme);
foreach($p_array as $parr)
{
if($parr<>"")
{?>
	<option <?php if($party==$parr) echo "selected";?> value="<?php echo $parr;?>" />   
		<?php echo $parr;?>
<?php }} ?>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<?php

$sql_month=mysqli_query($link,"select * from tbl_partymaser where business_name='".$party."'")or die("Error:".mysqli_error($link));
$tott=mysqli_num_rows($sql_month);
if($tott > 0)
{
$row_month=mysqli_fetch_array($sql_month);
$add=$row_month['address']; if($row_month['city']!="") { $add=$add.", ".$row_month['city']; } $add=$add.", ".$row_month['state'];
}
else
{
$sql_month=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='".$party."' and orderm_dispatchflag!=1 order by orderm_party")or die("Error:".mysqli_error($link));
$row_month=mysqli_fetch_array($sql_month);
$add=$row_month['orderm_partyaddress']; if($row_month['orderm_partycity']!="") { $add=$add.", ".$row_month['orderm_partycity']; } $add=$add.", ".$row_month['orderm_partystate'];
}
?>
<tr class="Light" height="30">
<td width="206" align="right"  valign="middle" class="tblheading" >Address&nbsp;</td>
<td width="638" colspan="5" align="left"  valign="middle" class="tbltext" id="vaddress"> <div style="padding-left:3px;"><?php echo $add;?><input type="hidden" name="adddchk" value="" /></div>  </td>
</tr>

</table>
</div>
<?php
}
?>
</div>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td width="206" align="right"  valign="middle" class="tblheading">Display Orders &nbsp;</td>
<td align="left" width="638" valign="middle" class="tblheading" style="border-color:#F1B01E" colspan="5">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a><font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>

<div id="postingsubtable" style="display:block">  
<?php
if($row_orrelm['orel_type']=="Full")
{
?>
<?php
$srno=0;
if($txttype!="TDF")
{
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and  orderm_party='$party' and order_trtype!='Order TDF' and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=0 and orderm_supflag=0") or die(mysqli_error($link));
$sqlarrhome=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and  orderm_party='$party' and order_trtype!='Order TDF' and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=0 and orderm_supflag=0") or die(mysqli_error($link));
}
else
{
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and  orderm_partyname='$party' and order_trtype='Order TDF' and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=0 and orderm_supflag=0") or die(mysqli_error($link));
$sqlarrhome=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and  orderm_partyname='$party' and order_trtype='Order TDF' and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=0 and orderm_supflag=0") or die(mysqli_error($link));
$tott=mysqli_num_rows($sql_tbl);
if($tott==0)
{
$sql_month22=mysqli_query($link,"select * from tbl_partymaser where business_name='$party'")or die("Error:".mysqli_error($link));
$row_month22=mysqli_fetch_array($sql_month22);
$partid=$row_month22['p_id'];
if($partid!="" && $partid > 0)
{
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='$partid' and order_trtype='Order TDF' and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=0 and orderm_supflag=0") or die(mysqli_error($link));
$sqlarrhome=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='$partid' and order_trtype='Order TDF' and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=0 and orderm_supflag=0") or die(mysqli_error($link));
}
else
{
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='$party' and order_trtype='Order TDF' and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=0 and orderm_supflag=0");
$sqlarrhome=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='$party' and order_trtype='Order TDF' and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=0 and orderm_supflag=0");
}
}
}
$total_tbl=mysqli_num_rows($sql_tbl);	
if($total_tbl > 0)
{		
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<!--<tr height="15"><td colspan="6" align="right" class="tblheading"> <a href="javascript:void(0)" onclick="selectall()">Check  All</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="unselectall()">Clear  All</a></td></tr>-->
  <tr class="tblsubtitle" height="20">
    <td width="31" align="center" valign="middle" class="tblheading">#</td>
			  	 <td width="55" align="center" valign="middle" class="tblheading">Order Date </td>
                 <td width="58" align="center" valign="middle" class="tblheading">Order No.</td>
			 <td width="76" align="center" valign="middle" class="tblheading">View Order</td>
			<td width="42" align="center" valign="middle" class="tblheading">Select</td>
	</tr>
	</table>
  <?php
$srno=1;
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
$parortot=0; //$parortot1=0;
	//while($rowarrhome=mysqli_fetch_array($sqlarrhome))
	{ 
		$sqltblsub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_tbl['orderm_id']."'") or die(mysqli_error($link));
		$subtbl_tot=mysqli_num_rows($sqltblsub);
		while($rowtblsub=mysqli_fetch_array($sqltblsub))
		{
			/*$sqlsloc=mysqli_query($link,"select * from tbl_order_sub_sub where orderm_id='".$rowarrhome['orderm_id']."' and order_sub_id='".$rowtblsub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
			while($rowsloc=mysqli_fetch_array($sqlsloc))
			{
				$parortot1=$parortot1+$rowsloc['order_sub_subbal_qty'];
			}*/
			$parortot=$parortot+$rowtblsub['order_sub_totbal_qty'];
		}
	}
	//echo $parortot." - ".$parortot1;
if($parortot > 0)
{
	$arrival_id=$row_tbl['orderm_id'];
	$tdate=$row_tbl['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	$tid=$arrival_id;
		
$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$total_tbl1=0;
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
if($row_tbl_sub['order_sub_dispatch_flag']==1)$total_tbl1++;
if($row_tbl_sub['order_sub_hold_flag']==1)$total_tbl1++;
}	
//echo $total_tbl1; 
  if($total_tbl1 == 0)
  {
	if($srno%2!=0)
{

?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse" >
  <tr class="Light" height="20">
     <td width="100" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="175" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="185" align="center" valign="middle" class="tblheading"><?php echo $row_tbl['orderm_porderno'];?>&nbsp;
	  <input name="fln" type="hidden" class="tbltext" tabindex="0" readonly="true" style="background-color:#EFEFEF"  value="<?php echo $row_tbl['orderm_porderno'];?>"/></td>
   <td width="241" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onClick="openslocpop('<?php echo $row_tbl['orderm_id'];?>');">Order View</a></td>
	 <td width="137" align="center" valign="middle" class="tblheading"><input type="checkbox" name="foc" id="foc<?php echo $srno;?>"  value="<?php echo $row_tbl['orderm_id'];?>" onclick="showorddet('<?php echo $row_tbl['orderm_id'];?>','Full','<?php echo $srno?>')" <?php 
	 $tid24=explode(",",$row_orrelm['orel_ordermid']);  
foreach($tid24 as $tid2)
{
if($tid2<>"")
{
if($tid2==$row_tbl['orderm_id']) echo "checked";
}
}
?>
 />
	  </td>
     
    </tr>
	</table>
	<div id="orderdet<?php echo $srno?>">  
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$tid."' and order_sub_dispatch_flag!=1 and order_sub_hold_flag!=1") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

?>
<tr class="tblsubtitle" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading">#</td>
		<td width="116" align="center" valign="middle" class="tblheading">Crop</td>
        <td width="167" align="center" valign="middle" class="tblheading">Variety</td>
		<td width="39" align="center" valign="middle" class="tblheading">UPS Type</td>
		<td width="73" align="center" valign="middle" class="tblheading">UPS</td>
		<td width="76" align="center" valign="middle" class="tblheading">Quantity (Kgs.)</td>
        <td width="129" align="center" valign="middle" class="tblheading">Released Quantity (Kgs.)</td>
        <td width="129" align="center" valign="middle" class="tblheading">Balance Quantity (Kgs.)</td>
        <!--<td width="38" align="center" valign="middle" class="tblheading">PT</td>
        <td width="39" align="center" valign="middle" class="tblheading">StdP</td>
        <td width="40" align="center" valign="middle" class="tblheading">NoP</td>
		<td width="45" align="center" valign="middle" class="tblheading">NoWB</td>
		<td width="45" align="center" valign="middle" class="tblheading">NoMP</td>-->
</tr>
  <?php
$srno24=1;$itmdchk="";$itmdchk1="";
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['order_sub_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['order_sub_variety'].",";
	}
	if($itmdchk1!="")
	{
		$itmdchk1=$itmdchk1.$row_tbl_sub['order_sub_ups_type'].",";
	}
	else
	{
		$itmdchk1=$row_tbl_sub['order_sub_ups_type'].",";
	}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['order_sub_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crop=$row_crop['cropname'];

		
$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['order_sub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$p_1=mysqli_fetch_array($sql_veriety);
$variety=$p_1['popularname'];
		

$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$tid."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{

$up=""; $qt=""; $np=""; $qt1=""; $nowbp=""; $nompp=""; $nowb=""; $nomp=""; $ptp=""; $stdptv=""; $pt=""; $stdpt="";$zz="";$up1=""; $subsaubsubid="";
$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
$dq=explode(".",$zz[0]);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}

$up1=$qt1." ".$zz[1];

if($up!="")
$up=$up.$up1."<br/>";
else
$up=$up1."<br/>";

$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}

if($qt!="")
$qt=$qt.$qt1."<br/>";
else
$qt=$qt1."<br/>";

$subsaubsubid=$row_sloc['order_sub_sub_id'];


if($np!="")
$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
else
$np=$row_sloc['order_sub_sub_nop']."<br/>";

$nowb=$row_sloc['order_sub_sub_nowb'];
if($nowb==0)$nowb="";
if($nowbp!="")
$nowbp=$nowbp.$nowb."<br/>";
else
$nowbp=$nowb."<br/>";

$nomp=$row_sloc['order_sub_sub_nomp'];
if($nomp==0)$nomp="";
if($nompp!="")
$nompp=$nompp.$nomp."<br/>";
else
$nompp=$nomp."<br/>";

$pt=$row_sloc['order_sub_sub_pt'];
if($ptp!="")
$ptp=$ptp.$pt."<br/>";
else
$ptp=$pt."<br/>";

$stdpt=$row_sloc['order_sub_sub_stdpt'];
if($stdptv!="")
$stdptv=$stdptv.$stdpt."<br/>";
else
$stdptv=$stdpt."<br/>";


if($up==0)$up=""; 
if($np==0) $np="";
if($row_tbl_sub['order_sub_ups_type']=="Yes")
{
  $up1="ST";
}
else if($row_tbl_sub['order_sub_ups_type']=="No")
{
$up1="NST";
}

$sql_orrelss=mysqli_query($link,"Select * from tbl_orderrelsub_sub where plantcode='$plantcode' and orelsub_ordermsubsubid='$subsaubsubid' and orel_id='$oid'")or die(mysqli_error($link));
$tot_orrelss=mysqli_num_rows($sql_orrelss);
$row_orrelss=mysqli_fetch_array($sql_orrelss);


if($srno24%2!=0)
{
?>
<tr class="Light" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno24;?><input type="hidden" name="subsubid<?php echo $srno?>" id="subsubid<?php echo $srno?>_<?php echo $srno24?>" value="<?php echo $subsaubsubid;?>"></td>
		<td width="116" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="167" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="39" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="73" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="76" align="center" valign="middle" class="tblheading"><?php echo $qt;?><input type="hidden" name="extorqty<?php echo $srno?>" id="extorqty<?php echo $srno?>_<?php echo $srno24?>" value="<?php echo $qt;?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="relqty<?php echo $srno?>" id="relqty<?php echo $srno?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" onChange="relorqtychk(this.value,<?php echo $srno24?>,<?php echo $srno?>);" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_orrelss['orelsubsub_relqty'];?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="orbalqty<?php echo $srno?>" id="orbalqty<?php echo $srno?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_orrelss['orelsubsub_extqty']-$row_orrelss['orelsubsub_relqty'];?>"></td>
		<!--<td width="38" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="39" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="40" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>-->
</tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno24;?><input type="hidden" name="subsubid<?php echo $srno?>" id="subsubid<?php echo $srno?>_<?php echo $srno24?>" value="<?php echo $subsaubsubid;?>"></td>
		<td width="116" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="167" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="39" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="73" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="76" align="center" valign="middle" class="tblheading"><?php echo $qt;?><input type="hidden" name="extorqty<?php echo $srno?>" id="extorqty<?php echo $srno?>_<?php echo $srno24?>" value="<?php echo $qt;?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="relqty<?php echo $srno?>" id="relqty<?php echo $srno?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" onChange="relorqtychk(this.value,<?php echo $srno24?>,<?php echo $srno?>);" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_orrelss['orelsubsub_relqty'];?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="orbalqty<?php echo $srno?>" id="orbalqty<?php echo $srno?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_orrelss['orelsubsub_extqty']-$row_orrelss['orelsubsub_relqty'];?>"></td>
		<!--<td width="38" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="39" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="40" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>-->
</tr>		
<?php
}
$srno24++;
}
}
//}
?>
 <input type="hidden" name="srno24" id="srno24<?php echo $srno?>" value="<?php echo $srno24?>" />
</table>


 </div>

<?php
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse" >
  <tr class="Light" height="20">
     <td width="100" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="175" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="185" align="center" valign="middle" class="tblheading"><?php echo $row_tbl['orderm_porderno'];?>&nbsp;
	  <input name="fln" type="hidden" class="tbltext" tabindex="0" readonly="true" style="background-color:#EFEFEF"  value="<?php echo $row_tbl['orderm_porderno'];?>"/></td>
   <td width="241" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onClick="openslocpop('<?php echo $row_tbl['orderm_id'];?>');">Order View</a></td>
	 <td width="137" align="center" valign="middle" class="tblheading"><input type="checkbox" name="foc" id="foc<?php echo $srno;?>"  value="<?php echo $row_tbl['orderm_id'];?>" onclick="showorddet('<?php echo $row_tbl['orderm_id'];?>','Full','<?php echo $srno?>')" <?php 
	 $tid24=explode(",",$row_orrelm['orel_ordermid']);  
foreach($tid24 as $tid2)
{
if($tid2<>"")
{
if($tid2==$row_tbl['orderm_id']) echo "checked";
}
}
?> />
	  </td>
	</tr>			
</table>
	<div id="orderdet<?php echo $srno?>">   
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

?>
<tr class="tblsubtitle" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading">#</td>
		<td width="116" align="center" valign="middle" class="tblheading">Crop</td>
        <td width="167" align="center" valign="middle" class="tblheading">Variety</td>
		<td width="39" align="center" valign="middle" class="tblheading">UPS Type</td>
		<td width="73" align="center" valign="middle" class="tblheading">UPS</td>
		<td width="76" align="center" valign="middle" class="tblheading">Quantity (Kgs.)</td>
        <td width="129" align="center" valign="middle" class="tblheading">Released Quantity (Kgs.)</td>
        <td width="129" align="center" valign="middle" class="tblheading">Balance Quantity (Kgs.)</td>
        <!--<td width="38" align="center" valign="middle" class="tblheading">PT</td>
        <td width="39" align="center" valign="middle" class="tblheading">StdP</td>
        <td width="40" align="center" valign="middle" class="tblheading">NoP</td>
		<td width="45" align="center" valign="middle" class="tblheading">NoWB</td>
		<td width="45" align="center" valign="middle" class="tblheading">NoMP</td>-->
</tr>
  <?php
$srno24=1;$itmdchk="";$itmdchk1="";
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['order_sub_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['order_sub_variety'].",";
	}
	if($itmdchk1!="")
	{
		$itmdchk1=$itmdchk1.$row_tbl_sub['order_sub_ups_type'].",";
	}
	else
	{
		$itmdchk1=$row_tbl_sub['order_sub_ups_type'].",";
	}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['order_sub_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crop=$row_crop['cropname'];

		
$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['order_sub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$p_1=mysqli_fetch_array($sql_veriety);
$variety=$p_1['popularname'];
		

$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$tid."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{

$up=""; $qt=""; $np=""; $qt1=""; $nowbp=""; $nompp=""; $nowb=""; $nomp=""; $ptp=""; $stdptv=""; $pt=""; $stdpt="";$zz="";$up1=""; $subsaubsubid="";
$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
$dq=explode(".",$zz[0]);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}

$up1=$qt1." ".$zz[1];

if($up!="")
$up=$up.$up1."<br/>";
else
$up=$up1."<br/>";

$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}

if($qt!="")
$qt=$qt.$qt1."<br/>";
else
$qt=$qt1."<br/>";

$subsaubsubid=$row_sloc['order_sub_sub_id'];


if($np!="")
$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
else
$np=$row_sloc['order_sub_sub_nop']."<br/>";

$nowb=$row_sloc['order_sub_sub_nowb'];
if($nowb==0)$nowb="";
if($nowbp!="")
$nowbp=$nowbp.$nowb."<br/>";
else
$nowbp=$nowb."<br/>";

$nomp=$row_sloc['order_sub_sub_nomp'];
if($nomp==0)$nomp="";
if($nompp!="")
$nompp=$nompp.$nomp."<br/>";
else
$nompp=$nomp."<br/>";

$pt=$row_sloc['order_sub_sub_pt'];
if($ptp!="")
$ptp=$ptp.$pt."<br/>";
else
$ptp=$pt."<br/>";

$stdpt=$row_sloc['order_sub_sub_stdpt'];
if($stdptv!="")
$stdptv=$stdptv.$stdpt."<br/>";
else
$stdptv=$stdpt."<br/>";


if($up==0)$up=""; 
if($np==0) $np="";
if($row_tbl_sub['order_sub_ups_type']=="Yes")
{
  $up1="ST";
}
else if($row_tbl_sub['order_sub_ups_type']=="No")
{
$up1="NST";
}

$sql_orrelss=mysqli_query($link,"Select * from tbl_orderrelsub_sub where plantcode='$plantcode' and orelsub_ordermsubsubid='$subsaubsubid' and orel_id='$oid'")or die(mysqli_error($link));
$tot_orrelss=mysqli_num_rows($sql_orrelss);
$row_orrelss=mysqli_fetch_array($sql_orrelss);


if($srno24%2!=0)
{
?>
<tr class="Light" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno24;?><input type="hidden" name="subsubid<?php echo $srno?>" id="subsubid<?php echo $srno?>_<?php echo $srno24?>" value="<?php echo $subsaubsubid;?>"></td>
		<td width="116" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="167" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="39" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="73" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="76" align="center" valign="middle" class="tblheading"><?php echo $qt;?><input type="hidden" name="extorqty<?php echo $srno?>" id="extorqty<?php echo $srno?>_<?php echo $srno24?>" value="<?php echo $qt;?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="relqty<?php echo $srno?>" id="relqty<?php echo $srno?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" onChange="relorqtychk(this.value,<?php echo $srno24?>,<?php echo $srno?>);" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_orrelss['orelsubsub_relqty'];?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="orbalqty<?php echo $srno?>" id="orbalqty<?php echo $srno?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_orrelss['orelsubsub_extqty']-$row_orrelss['orelsubsub_relqty'];?>"></td>
		<!--<td width="38" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="39" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="40" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>-->
</tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno24;?><input type="hidden" name="subsubid<?php echo $srno?>" id="subsubid<?php echo $srno?>_<?php echo $srno24?>" value="<?php echo $subsaubsubid;?>"></td>
		<td width="116" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="167" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="39" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="73" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="76" align="center" valign="middle" class="tblheading"><?php echo $qt;?><input type="hidden" name="extorqty<?php echo $srno?>" id="extorqty<?php echo $srno?>_<?php echo $srno24?>" value="<?php echo $qt;?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="relqty<?php echo $srno?>" id="relqty<?php echo $srno?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" onChange="relorqtychk(this.value,<?php echo $srno24?>,<?php echo $srno?>);" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_orrelss['orelsubsub_relqty'];?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="orbalqty<?php echo $srno?>" id="orbalqty<?php echo $srno?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_orrelss['orelsubsub_extqty']-$row_orrelss['orelsubsub_relqty'];?>"></td>
		<!--<td width="38" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="39" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="40" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>-->
</tr>		
<?php
}
$srno24++;
}
}
//}
?>
<input type="hidden" name="srno24" id="srno24<?php echo $srno?>" value="<?php echo $srno24?>" />
</table>
 </div> 
<?php
}
$srno++;
}
}
}
}
?>

<?php
}
else if($row_orrelm['orel_type']=="Partial")
{ 
$sql_crop=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='".$party."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$tot_crop=mysqli_num_rows($sql_crop);
?>
<?php
$srno=0;
if($txttype!="TDF")
{
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and  orderm_party='$party' and order_trtype!='Order TDF' and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=0 and orderm_supflag=0") or die(mysqli_error($link));
}
else
{
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and  orderm_partyname='$party' and order_trtype='Order TDF' and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=0 and orderm_supflag=0") or die(mysqli_error($link));
$tott=mysqli_num_rows($sql_tbl);
if($tott==0)
{
$sql_month22=mysqli_query($link,"select * from tbl_partymaser where business_name='$party'")or die("Error:".mysqli_error($link));
$row_month22=mysqli_fetch_array($sql_month22);
$partid=$row_month22['p_id'];
if($partid!="" && $partid > 0)
$sql_tbl=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_party='$partid' and order_trtype='Order TDF' and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=0 and orderm_supflag=0") or die(mysqli_error($link));
else
$sqltbl="select * from tbl_orderm where plantcode='$plantcode' and orderm_partyname='$party' and order_trtype='Order TDF' and orderm_cancelflag=0 and orderm_dispatchflag!=1 and orderm_holdflag=0 and orderm_supflag=0";
}
}
$total_tbl=mysqli_num_rows($sql_tbl);
if($total_tbl > 0)
{			
?>
    <table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse" >

  <tr class="tblsubtitle" height="20">
    <td width="31" align="center" valign="middle" class="tblheading">#</td>
			  	 <td width="55" align="center" valign="middle" class="tblheading">Order Date </td>
                 <td width="58" align="center" valign="middle" class="tblheading">Order No.</td>
			 <td width="76" align="center" valign="middle" class="tblheading">View Order</td>
			<td width="42" align="center" valign="middle" class="tblheading">Select</td>
	</tr>
	</table>
  <?php
$srno=1;
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
 	$parortot=0; //$parortot1=0;
	//while($rowarrhome=mysqli_fetch_array($sqlarrhome))
	{ 
		$sqltblsub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_tbl['orderm_id']."'") or die(mysqli_error($link));
		$subtbl_tot=mysqli_num_rows($sqltblsub);
		while($rowtblsub=mysqli_fetch_array($sqltblsub))
		{
			/*$sqlsloc=mysqli_query($link,"select * from tbl_order_sub_sub where orderm_id='".$rowarrhome['orderm_id']."' and order_sub_id='".$rowtblsub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
			while($rowsloc=mysqli_fetch_array($sqlsloc))
			{
				$parortot1=$parortot1+$rowsloc['order_sub_subbal_qty'];
			}*/
			$parortot=$parortot+$rowtblsub['order_sub_totbal_qty'];
		}
	}
	//echo $parortot." - ".$parortot1;
if($parortot > 0)
{
	$arrival_id=$row_tbl['orderm_id'];
	$tdate=$row_tbl['orderm_date'];
	$tyear=substr($tdate,0,4);
	$tmonth=substr($tdate,5,2);
	$tday=substr($tdate,8,2);
	$tdate=$tday."-".$tmonth."-".$tyear;
	
	$tid=$arrival_id;
	
$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$row_tbl['orderm_id']."'") or die(mysqli_error($link));
$total_tbl1=0;
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
if($row_tbl_sub['order_sub_dispatch_flag']==1)$total_tbl1++;
//if($row_tbl_sub['order_sub_hold_flag']==1)$total_tbl1++;
}	
//echo $total_tbl1; 
  if($total_tbl1 == 0)
  {
	if($srno%2!=0)
{

?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse" >
  <tr class="Light" height="20">
     <td width="100" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="175" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="185" align="center" valign="middle" class="tblheading"><?php echo $row_tbl['orderm_porderno'];?>&nbsp;
	  <input name="fln" type="hidden" class="tbltext" tabindex="0" readonly="true" style="background-color:#EFEFEF"  value="<?php echo $row_tbl['orderm_porderno'];?>"/></td>
   <td width="241" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onClick="openslocpop('<?php echo $row_tbl['orderm_id'];?>');">Order View</a></td>
	 <td width="137" align="center" valign="middle" class="tblheading"><input type="checkbox" name="foc" id="foc<?php echo $srno;?>"  value="<?php echo $row_tbl['orderm_id'];?>" onclick="showorddet('<?php echo $row_tbl['orderm_id'];?>','Partial','<?php echo $srno?>')" <?php 
	 $tid24=explode(",",$row_orrelm['orel_ordermid']);  
foreach($tid24 as $tid2)
{
if($tid2<>"")
{
if($tid2==$row_tbl['orderm_id']) echo "checked";
}
}
?> />
	  </td>
     
    </tr>
	</table>
	<div id="orderdet<?php echo $srno?>"> 
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$tid."' and order_sub_dispatch_flag!=1 and order_sub_hold_flag!=1") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

?>
<tr class="tblsubtitle" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading">#</td>
		<td width="116" align="center" valign="middle" class="tblheading">Crop</td>
        <td width="167" align="center" valign="middle" class="tblheading">Variety</td>
		<td width="39" align="center" valign="middle" class="tblheading">UPS Type</td>
		<td width="73" align="center" valign="middle" class="tblheading">UPS</td>
		<td width="76" align="center" valign="middle" class="tblheading">Quantity (Kgs.)</td>
        <td width="129" align="center" valign="middle" class="tblheading">Released Quantity (Kgs.)</td>
        <td width="129" align="center" valign="middle" class="tblheading">Balance Quantity (Kgs.)</td>
        <!--<td width="38" align="center" valign="middle" class="tblheading">PT</td>
        <td width="39" align="center" valign="middle" class="tblheading">StdP</td>
        <td width="40" align="center" valign="middle" class="tblheading">NoP</td>
		<td width="45" align="center" valign="middle" class="tblheading">NoWB</td>
		<td width="45" align="center" valign="middle" class="tblheading">NoMP</td>-->
</tr>
  <?php
$srno24=1;$itmdchk="";$itmdchk1="";
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['order_sub_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['order_sub_variety'].",";
	}
	if($itmdchk1!="")
	{
		$itmdchk1=$itmdchk1.$row_tbl_sub['order_sub_ups_type'].",";
	}
	else
	{
		$itmdchk1=$row_tbl_sub['order_sub_ups_type'].",";
	}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['order_sub_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crop=$row_crop['cropname'];

		
$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['order_sub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$p_1=mysqli_fetch_array($sql_veriety);
$variety=$p_1['popularname'];
		

$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$tid."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{

$up=""; $qt=""; $np=""; $qt1=""; $nowbp=""; $nompp=""; $nowb=""; $nomp=""; $ptp=""; $stdptv=""; $pt=""; $stdpt="";$zz="";$up1=""; $subsaubsubid="";
$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
$dq=explode(".",$zz[0]);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}

$up1=$qt1." ".$zz[1];

if($up!="")
$up=$up.$up1."<br/>";
else
$up=$up1."<br/>";

$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}

if($qt!="")
$qt=$qt.$qt1."<br/>";
else
$qt=$qt1."<br/>";

$subsaubsubid=$row_sloc['order_sub_sub_id'];


if($np!="")
$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
else
$np=$row_sloc['order_sub_sub_nop']."<br/>";

$nowb=$row_sloc['order_sub_sub_nowb'];
if($nowb==0)$nowb="";
if($nowbp!="")
$nowbp=$nowbp.$nowb."<br/>";
else
$nowbp=$nowb."<br/>";

$nomp=$row_sloc['order_sub_sub_nomp'];
if($nomp==0)$nomp="";
if($nompp!="")
$nompp=$nompp.$nomp."<br/>";
else
$nompp=$nomp."<br/>";

$pt=$row_sloc['order_sub_sub_pt'];
if($ptp!="")
$ptp=$ptp.$pt."<br/>";
else
$ptp=$pt."<br/>";

$stdpt=$row_sloc['order_sub_sub_stdpt'];
if($stdptv!="")
$stdptv=$stdptv.$stdpt."<br/>";
else
$stdptv=$stdpt."<br/>";


if($up==0)$up=""; 
if($np==0) $np="";
if($row_tbl_sub['order_sub_ups_type']=="Yes")
{
  $up1="ST";
}
else if($row_tbl_sub['order_sub_ups_type']=="No")
{
$up1="NST";
}

$sql_orrelss=mysqli_query($link,"Select * from tbl_orderrelsub_sub where plantcode='$plantcode' and orelsub_ordermsubsubid='$subsaubsubid' and orel_id='$oid'")or die(mysqli_error($link));
$tot_orrelss=mysqli_num_rows($sql_orrelss);
$row_orrelss=mysqli_fetch_array($sql_orrelss);


if($srno24%2!=0)
{
?>
<tr class="Light" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno24;?><input type="hidden" name="subsubid<?php echo $srno?>" id="subsubid<?php echo $srno?>_<?php echo $srno24?>" value="<?php echo $subsaubsubid;?>"></td>
		<td width="116" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="167" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="39" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="73" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="76" align="center" valign="middle" class="tblheading"><?php echo $qt;?><input type="hidden" name="extorqty<?php echo $srno?>" id="extorqty<?php echo $srno?>_<?php echo $srno24?>" value="<?php echo $qt;?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="relqty<?php echo $srno?>" id="relqty<?php echo $srno?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" onChange="relorqtychk(this.value,<?php echo $srno24?>,<?php echo $srno?>);" value="<?php echo $row_orrelss['orelsubsub_relqty'];?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="orbalqty<?php echo $srno?>" id="orbalqty<?php echo $srno?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_orrelss['orelsubsub_extqty']-$row_orrelss['orelsubsub_relqty'];?>"></td>
		<!--<td width="38" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="39" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="40" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>-->
</tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno24;?><input type="hidden" name="subsubid<?php echo $srno?>" id="subsubid<?php echo $srno?>_<?php echo $srno24?>" value="<?php echo $subsaubsubid;?>"></td>
		<td width="116" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="167" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="39" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="73" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="76" align="center" valign="middle" class="tblheading"><?php echo $qt;?><input type="hidden" name="extorqty<?php echo $srno?>" id="extorqty<?php echo $srno?>_<?php echo $srno24?>" value="<?php echo $qt;?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="relqty<?php echo $srno?>" id="relqty<?php echo $srno?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" onChange="relorqtychk(this.value,<?php echo $srno24?>,<?php echo $srno?>);" value="<?php echo $row_orrelss['orelsubsub_relqty'];?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="orbalqty<?php echo $srno?>" id="orbalqty<?php echo $srno?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_orrelss['orelsubsub_extqty']-$row_orrelss['orelsubsub_relqty'];?>"></td>
		<!--<td width="38" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="39" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="40" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>-->
</tr>		
<?php
}
$srno24++;
}
}
//}
?>
<input type="hidden" name="srno24" id="srno24<?php echo $srno?>" value="<?php echo $srno24?>" />
</table>

</div>
<?php
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse" >
  <tr class="Light" height="20">
     <td width="100" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="175" align="center" valign="middle" class="tblheading"><?php echo $tdate;?></td>
	<td width="185" align="center" valign="middle" class="tblheading"><?php echo $row_tbl['orderm_porderno'];?>&nbsp;
	  <input name="fln" type="hidden" class="tbltext" tabindex="0" readonly="true" style="background-color:#EFEFEF"  value="<?php echo $row_tbl['orderm_porderno'];?>"/></td>
   <td width="241" align="center" valign="middle" class="tblheading"><a href="Javascript:void(0)" onClick="openslocpop('<?php echo $row_tbl['orderm_id'];?>');">Order View</a></td>
	 <td width="137" align="center" valign="middle" class="tblheading"><input type="checkbox" name="foc" id="foc<?php echo $srno;?>"  value="<?php echo $row_tbl['orderm_id'];?>" onclick="showorddet('<?php echo $row_tbl['orderm_id'];?>','Partial','<?php echo $srno?>')" <?php 
	 $tid24=explode(",",$row_orrelm['orel_ordermid']);  
foreach($tid24 as $tid2)
{
if($tid2<>"")
{
if($tid2==$row_tbl['orderm_id']) echo "checked";
}
}
?> />
	  </td>
	</tr>
	</table>
	<div id="orderdet<?php echo $srno?>">
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#cc30cc" style="border-collapse:collapse">
<?php
$sql_tbl_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$tid."'") or die(mysqli_error($link));
$subtbltot=mysqli_num_rows($sql_tbl_sub);
$subtid=0;

?>
<tr class="tblsubtitle" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading">#</td>
		<td width="116" align="center" valign="middle" class="tblheading">Crop</td>
        <td width="167" align="center" valign="middle" class="tblheading">Variety</td>
		<td width="39" align="center" valign="middle" class="tblheading">UPS Type</td>
		<td width="73" align="center" valign="middle" class="tblheading">UPS</td>
		<td width="76" align="center" valign="middle" class="tblheading">Quantity (Kgs.)</td>
        <td width="129" align="center" valign="middle" class="tblheading">Released Quantity (Kgs.)</td>
        <td width="129" align="center" valign="middle" class="tblheading">Balance Quantity (Kgs.)</td>
        <!--<td width="38" align="center" valign="middle" class="tblheading">PT</td>
        <td width="39" align="center" valign="middle" class="tblheading">StdP</td>
        <td width="40" align="center" valign="middle" class="tblheading">NoP</td>
		<td width="45" align="center" valign="middle" class="tblheading">NoWB</td>
		<td width="45" align="center" valign="middle" class="tblheading">NoMP</td>-->
</tr>
  <?php
$srno24=1;$itmdchk="";$itmdchk1="";
while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{
	if($itmdchk!="")
	{
		$itmdchk=$itmdchk.$row_tbl_sub['order_sub_variety'].",";
	}
	else
	{
		$itmdchk=$row_tbl_sub['order_sub_variety'].",";
	}
	if($itmdchk1!="")
	{
		$itmdchk1=$itmdchk1.$row_tbl_sub['order_sub_ups_type'].",";
	}
	else
	{
		$itmdchk1=$row_tbl_sub['order_sub_ups_type'].",";
	}

$sql_crop=mysqli_query($link,"select * from tblcrop where cropid='".$row_tbl_sub['order_sub_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crop=$row_crop['cropname'];

		
$sql_veriety=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tbl_sub['order_sub_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$p_1=mysqli_fetch_array($sql_veriety);
$variety=$p_1['popularname'];
		

$sql_sloc=mysqli_query($link,"select * from tbl_order_sub_sub where orderm_id='".$tid."' and order_sub_id='".$row_tbl_sub['order_sub_id']."' order by order_sub_sub_id") or die(mysqli_error($link));
while($row_sloc=mysqli_fetch_array($sql_sloc))
{

$up=""; $qt=""; $np=""; $qt1=""; $nowbp=""; $nompp=""; $nowb=""; $nomp=""; $ptp=""; $stdptv=""; $pt=""; $stdpt="";$zz="";$up1=""; $subsaubsubid="";
$zz=explode(" ",$row_sloc['order_sub_sub_ups']);
$dq=explode(".",$zz[0]);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_sub_ups'];}

$up1=$qt1." ".$zz[1];

if($up!="")
$up=$up.$up1."<br/>";
else
$up=$up1."<br/>";

$dq=explode(".",$row_sloc['order_sub_subbal_qty']);
if($dq[1]==000){$qt1=$dq[0];}else{$qt1=$row_sloc['order_sub_subbal_qty'];}

if($qt!="")
$qt=$qt.$qt1."<br/>";
else
$qt=$qt1."<br/>";

$subsaubsubid=$row_sloc['order_sub_sub_id'];


if($np!="")
$np=$np.$row_sloc['order_sub_sub_nop']."<br/>";
else
$np=$row_sloc['order_sub_sub_nop']."<br/>";

$nowb=$row_sloc['order_sub_sub_nowb'];
if($nowb==0)$nowb="";
if($nowbp!="")
$nowbp=$nowbp.$nowb."<br/>";
else
$nowbp=$nowb."<br/>";

$nomp=$row_sloc['order_sub_sub_nomp'];
if($nomp==0)$nomp="";
if($nompp!="")
$nompp=$nompp.$nomp."<br/>";
else
$nompp=$nomp."<br/>";

$pt=$row_sloc['order_sub_sub_pt'];
if($ptp!="")
$ptp=$ptp.$pt."<br/>";
else
$ptp=$pt."<br/>";

$stdpt=$row_sloc['order_sub_sub_stdpt'];
if($stdptv!="")
$stdptv=$stdptv.$stdpt."<br/>";
else
$stdptv=$stdpt."<br/>";


if($up==0)$up=""; 
if($np==0) $np="";
if($row_tbl_sub['order_sub_ups_type']=="Yes")
{
  $up1="ST";
}
else if($row_tbl_sub['order_sub_ups_type']=="No")
{
$up1="NST";
}

$sql_orrelss=mysqli_query($link,"Select * from tbl_orderrelsub_sub where plantcode='$plantcode' and orelsub_ordermsubsubid='$subsaubsubid' and orel_id='$oid'")or die(mysqli_error($link));
$tot_orrelss=mysqli_num_rows($sql_orrelss);
$row_orrelss=mysqli_fetch_array($sql_orrelss);


if($srno24%2!=0)
{
?>
<tr class="Light" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno24;?><input type="hidden" name="subsubid<?php echo $srno?>" id="subsubid<?php echo $srno?>_<?php echo $srno24?>" value="<?php echo $subsaubsubid;?>"></td>
		<td width="116" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="167" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="39" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="73" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="76" align="center" valign="middle" class="tblheading"><?php echo $qt;?><input type="hidden" name="extorqty<?php echo $srno?>" id="extorqty<?php echo $srno?>_<?php echo $srno24?>" value="<?php echo $qt;?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="relqty<?php echo $srno?>" id="relqty<?php echo $srno?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" onChange="relorqtychk(this.value,<?php echo $srno24?>,<?php echo $srno?>);" value="<?php echo $row_orrelss['orelsubsub_relqty'];?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="orbalqty<?php echo $srno?>" id="orbalqty<?php echo $srno?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_orrelss['orelsubsub_extqty']-$row_orrelss['orelsubsub_relqty'];?>"></td>
		<!--<td width="38" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="39" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="40" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>-->
</tr>
  <?php
}
else
{
?>
  <tr class="Light" height="20">
    	<td width="17" align="center" valign="middle" class="tblheading"><?php echo $srno24;?><input type="hidden" name="subsubid<?php echo $srno?>" id="subsubid<?php echo $srno?>_<?php echo $srno24?>" value="<?php echo $subsaubsubid;?>"></td>
		<td width="116" align="center" valign="middle" class="tblheading"><?php echo $crop;?></td>
        <td width="167" align="center" valign="middle" class="tblheading"><?php echo $variety;?></td>
		<td width="39" align="center" valign="middle" class="tblheading"><?php echo $up1;?></td>
		<td width="73" align="center" valign="middle" class="tblheading"><?php echo $up;?></td>
        <td width="76" align="center" valign="middle" class="tblheading"><?php echo $qt;?><input type="hidden" name="extorqty<?php echo $srno?>" id="extorqty<?php echo $srno?>_<?php echo $srno24?>" value="<?php echo $qt;?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="relqty<?php echo $srno?>" id="relqty<?php echo $srno?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" onChange="relorqtychk(this.value,<?php echo $srno24?>,<?php echo $srno?>);" value="<?php echo $row_orrelss['orelsubsub_relqty'];?>"></td>
		<td width="129" align="center" valign="middle" class="tblheading"><input type="text" name="orbalqty<?php echo $srno?>" id="orbalqty<?php echo $srno?>_<?php echo $srno24?>" size="10" maxlength="9" class="tbltext" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_orrelss['orelsubsub_extqty']-$row_orrelss['orelsubsub_relqty'];?>"></td>
		<!--<td width="38" align="center" valign="middle" class="tblheading"><?php echo $ptp;?></td>
        <td width="39" align="center" valign="middle" class="tblheading"><?php echo $stdptv;?></td>
        <td width="40" align="center" valign="middle" class="tblheading"><?php echo $np;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nowbp;?></td>
		<td width="45" align="center" valign="middle" class="tblheading"><?php echo $nompp;?></td>-->
</tr>		
<?php
}
$srno24++;
}
}
//}
?>
 <input type="hidden" name="srno24" id="srno24<?php echo $srno?>" value="<?php echo $srno24?>" />
</table>
</div>			
<?php
}
$srno++;
}
}
}
}
?>

<?php
}
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr><td height="10"></td></tr>
  <tr  height="25">
    <td colspan="10" align="center" class="subheading">No Records found for selected Party</td>
  </tr>
</table>
<?php
}
?>

<input type="hidden" name="foccode" value="" />
<input type="hidden" name="foccode1" value="" />
<input type="hidden" name="tt" value="" />
<input type="hidden" name="tt1" value="" />
<input type="hidden" name="cntt" value="" />
<input type="hidden" name="ssid" value="" />
  <input type="hidden" name="srno" value="<?php echo $srno;?>" />
  </div>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_release1.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:hand;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;</td>
</tr>
</table>

</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form>	  </td>
	  </tr>
	  </table>
<!-- actual page end--->			  
		  </td>
        </tr>
        <tr>
          <td width="989" valign="top" align="center"  class="border_bottom">&nbsp;</td>
        </tr>
        <tr>
          <td width="989" valign="top" align="left" ><div class="footer" ><img src="../images/istratlogo.gif"  align="left"/><img src="../images/vnrlogo.gif"  align="right"/></div></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>

  