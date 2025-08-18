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
	
	/*$sql_delm="select * from tbl_orderrelease where orel_flg='0' and orel_logid='$logid'";
	$mqry=mysqli_query($link,$sql_delm) or die(mysqli_error($link));
	while($row_delm=mysqli_fetch_array($mqry))
	{	
		$deloid=$row_delm['orel_id'];
		$sql_dels="delete from tbl_orderrel_sub where orel_id='$deloid'";
		$mqrys=mysqli_query($link,$sql_dels) or die(mysqli_error($link));
		
		$sql_delss="delete from tbl_orderrelsub_sub where orel_id='$deloid'";
		$mqryss=mysqli_query($link,$sql_delss) or die(mysqli_error($link));
		
		$sql_del="delete from tbl_orderrelease where orel_id='$deloid'";
		$mqr=mysqli_query($link,$sql_del) or die(mysqli_error($link));
	}*/
	if(isset($_REQUEST['txtparty']))
	{
   		$party = $_REQUEST['txtparty'];
	}
	
	if(isset($_REQUEST['txttype']))
	{
		$txttype = $_REQUEST['txttype'];
	}
	
	if(isset($_REQUEST['txtpp'])) { $txtpp = $_REQUEST['txtpp']; }
	if(isset($_REQUEST['txtstatesl'])) { $txtstatesl = $_REQUEST['txtstatesl']; }
	if(isset($_REQUEST['txtlocationsl'])) { $txtlocationsl = $_REQUEST['txtlocationsl']; }
	if(isset($_REQUEST['txtcountrysl'])) { $txtcountrysl = $_REQUEST['txtcountrysl']; }
	if(isset($_REQUEST['txtptype'])) { $txtptype = $_REQUEST['txtptype']; }
	
	if(isset($_POST['frm_action'])=='submit')
	{
	
		$txtid=trim($_POST['txtid']);
	 	$tdate=trim($_POST['date']);
		$orrltyp=trim($_POST['orrltyp']);
		$party=trim($_POST['txtpty']);
		$type=trim($_POST['txttype']);
		
		$txtpp=trim($_POST['txtpp']);
		$txtptype=trim($_POST['txtptype']);
		$tdate1=explode("-",$tdate);
		$tdate=$tdate1[2]."-".$tdate1[1]."-".$tdate1[0];
		
		//exit;
		if($orrltyp=="Full")
		{	
			/*$fln=trim($_POST['tt']);
			$flnid = split(",",$fln);*/
			
			$ssid=trim($_POST['ssid']);
			$cntt=trim($_POST['cntt']);
			$fln=trim($_POST['tt']);
			$fln1=trim($_POST['tt1']);
			$foccode1=trim($_POST['foccode1']);
			$flnid = split(",",$fln);
			$flnid1 = split(",",$ssid);
			$flnid2 = split(",",$foccode1);
			
			$sql_orelm="insert into tbl_orderrelease (orel_ordermid, orel_yearid, orel_logid, orel_type, orel_date, orel_tcode, plantcode) values('$fln', '$ycode', '$logid', '$orrltyp', '$tdate', '$txtid', '$plantcode')";
			if(mysqli_query($link,$sql_orelm)or die(mysqli_error($link)))
			{
				$oid=mysqli_insert_id($link);
			}
			
			foreach($flnid as $fid)
		  	{		
				/*$sql_orderm=mysqli_query($link,"select * from tbl_orderm where orderm_id='".$fid."'")or die(mysqli_error($link));
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
						
						$sql_orels="insert into tbl_orderrel_sub (orel_id, orelsub_ordermsubid, orelsub_crop, orelsub_variety, orelsub_extqty, orelsub_upstyp, orelsub_relqty, plantcode) values('$oid','$ordersubid','$crop','$variety','$exttotqty','$upstyp','$exttotqty', '$plantcode')";
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
			$flnid = split(",",$fln);
			$flnid1 = split(",",$ssid);
			$flnid2 = split(",",$foccode1);
			
			$sql_orelm="insert into tbl_orderrelease (orel_ordermid, orel_yearid, orel_logid, orel_type, orel_date, orel_tcode, plantcode) values('$fln', '$ycode', '$logid', '$orrltyp', '$tdate', '$txtid', '$plantcode')";
			if(mysqli_query($link,$sql_orelm)or die(mysqli_error($link)))
			{
				$oid=mysqli_insert_id($link);
			}
			
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


	$sql_code="SELECT MAX(orel_tcode) FROM tbl_orderrelease where orel_yearid='$ycode'  ORDER BY orel_tcode DESC";
	$res_code=mysqli_query($link,$sql_code)or die(mysqli_error($link));
		
		if(mysqli_num_rows($res_code) > 0)
		{
			$row_code=mysqli_fetch_row($res_code);
			$t_code=$row_code['0'];
			$code=$t_code+1;
			$code1="TOR".$code."/".$ycode."/".$lgnid;
		}
		else
		{
			$code=1;
			$code1="TOR".$code."/".$ycode."/".$lgnid;
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="../include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order-Transaction - Order Release</title>
<link href="../include/main_order.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_order.css" rel="stylesheet" type="text/css" />
</head>
<script src="orrelease.js"></script>
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
	      <td width="813" height="25" class="Mainheading">&nbsp;Transaction -Order Release</td>
	    </tr></table></td>
	           
	  </tr>
	  </table></td></tr>
  
<?php
$srno24=1;
?>  
	  
	  <td align="center" colspan="4" >
	  
<form  name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="hidden" name="txtptype" value="" />
		<input type="hidden" name="txtcountry1" value="" />
		<input type="hidden" name="txtpty" value="" />
						
<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="10"></td>
</tr>
<tr>
<td width="30">	 </td><td>
<div id="postingtable" style="display:block">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Add Order Release </td>
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
<td align="left" valign="middle" class="tbltext" colspan="3">&nbsp;<input type="radio" name="orltype" value="Full" onchange="ortypchk(this.value)" />Full Release&nbsp;<input type="radio" name="orltype" value="Partial" onchange="ortypchk(this.value)" />Partial Release<input type="hidden" name="orrltyp" value="" /></td>
</tr>
<tr class="Light" height="30">
 <?php
//$quer3=mysqli_query($link,"SELECT p_id, business_name FROM tbl_partymaser  where classification='Stock Transfer'"); 
?>

<td align="right"  valign="middle" class="tblheading">Order Type &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3" >&nbsp;<select class="tbltext" name="txttype" style="width:150px;" onchange="partycatsl1(this.value)">
<option value="" selected>--Select--</option>
		<option value="Sales">Sales</option>
	<option value="Stock">Stock Transfer</option>
	<option value="TDF">TDF</option>
	</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
           </tr>
		   </table>
		   <div id="vitem11">
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<?php
$sql_month=mysqli_query($link,"select * from tblclassification  order by classification")or die(mysqli_error($link));
$t=mysqli_num_rows($sql_month);
?>
		<tr class="Dark" height="30">
<td width="206" align="right"  valign="middle" class="tblheading">Party Type&nbsp;</td>
<td width="638" colspan="3" align="left"  valign="middle" class="tbltext" >&nbsp;<select class="tbltext" name="txtpp" style="width:120px;" onchange="modetchk1(this.value)" tabindex="" >
<option value="" selected>--Select--</option>
	<?php while($noticia = mysqli_fetch_array($sql_month)) { ?>
		<option value="<?php echo $noticia['classification'];?>" />   
		<?php echo $noticia['classification'];?>
		<?php } ?>
	</select>&nbsp;&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	</tr>  
</table>

<div id="selectpartylocation"style="display:none" ></div>		   
<div id="vitem1"style="display:none" >
<!--<div id="vitem1">--->
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
 <tr class="Dark" height="30">
<td width="206" align="right"  valign="middle" class="tblheading" >Party Name &nbsp;</td>
<td align="left"  valign="middle" class="tbltext" colspan="3">&nbsp;<select class="tbltext" name="txtparty" style="width:220px;" onchange="party(this.value)" >
<option value="" selected="selected">--Select--</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;  </td>
</tr>
<tr class="Light" height="30">
<td width="206" align="right"  valign="middle" class="tblheading" >Address&nbsp;</td>
<td width="638" colspan="5" align="left"  valign="middle" class="tbltext" id="vaddress">&nbsp;
  <input type="hidden" name="adddchk" value="" />  </td>
</tr>
</table>
</div></div>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#cc30cc" style="border-collapse:collapse" > 
<tr class="Dark" height="30">
<td width="207" align="right"  valign="middle" class="tblheading">Display Orders &nbsp;</td>
<td align="left" width="637" valign="middle" class="tblheading" style="border-color:#F1B01E" colspan="5">&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a><font color="#FF0000">*</font>&nbsp;</td>
</tr>
</table>
 <div id="postingsubtable" style="display:none"> <input type="hidden" name="srno" value="0" />
</div></div>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_release1.php" tabindex="20"><img src="../images/cancel.gif" border="0"style="display:inline;cursor:hand;" onclick="return confirm('Do You wish to Cancel this Transaction?');" /></a>&nbsp;<input name="Submit" type="image" src="../images/preview.gif" alt="Submit Value"  border="0" style="display:inline;cursor:hand;" tabindex="" onClick="return mySubmit();">&nbsp;&nbsp;<input type="hidden" name="chk" value="" />  
</td>
</tr>
</table>
<br />
  
 
</td><td width="30"></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>
</form> 
	  
	  
	  </td>
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

  