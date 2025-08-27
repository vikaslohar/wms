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
	$sql_delm="select * from tbl_orderrelease where orel_flg='0' and orel_logid='$logid'";
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
	}
	
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
	
	 	//$p_id=trim($_POST['add']);
		$orrltyp=trim($_POST['orrltyp']);
		$party=trim($_POST['txtparty']);
		$type=trim($_POST['txttype']);
		
		$txtpp=trim($_POST['txtpp']);
		$txtptype=trim($_POST['txtptype']);
		//exit;
		if($orrltyp=="Full")
		{	
			$fln=trim($_POST['tt']);
			$flnid = explode(",",$fln);
			foreach($flnid as $fid)
		  	{		
				$sql_orderm=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$fid."'")or die(mysqli_error($link));
				$tot_orderm=mysqli_num_rows($sql_orderm);
				$row_orderm=mysqli_fetch_array($sql_orderm);
								
				$sql_orelm="insert into tbl_orderrelease (orel_ordermid, orel_yearid, orel_logid, orel_type, plantcode) values('$fid', '$ycode', '$logid', '$orrltyp', '$plantcode')";
				if(mysqli_query($link,$sql_orelm)or die(mysqli_error($link)))
				{
					$oid=mysqli_insert_id($link);
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
							$sql_orderm_sub_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$fid."' and order_sub_id='".$ordersubid."'") or die(mysqli_error($link));
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
			$flnid = explode(",",$ssid);
			$flnid1 = explode(",",$foccode1);
			
			$sql_orderm=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='".$fln."'")or die(mysqli_error($link));
			$tot_orderm=mysqli_num_rows($sql_orderm);
			$row_orderm=mysqli_fetch_array($sql_orderm);
								
			$sql_orelm="insert into tbl_orderrelease (orel_ordermid, orel_yearid, orel_logid, orel_type, plantcode) values('$fln', '$ycode', '$logid', '$orrltyp', '$plantcode')";
			if(mysqli_query($link,$sql_orelm)or die(mysqli_error($link)))
			{
				$oid=mysqli_insert_id($link);
				$sql_orderm_sub=mysqli_query($link,"select * from tbl_order_sub where plantcode='$plantcode' and orderm_id='".$fln."'") or die(mysqli_error($link));
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
						$cnt=count($flnid);
						for($i=0;$i<$cnt;$i++)
		  				{		
			
						$sql_orderm_sub_sub=mysqli_query($link,"select * from tbl_order_sub_sub where plantcode='$plantcode' and orderm_id='".$fln."' and order_sub_id='".$ordersubid."' and order_sub_sub_id='".$flnid[$i]."'") or die(mysqli_error($link));
						$tot_orderm_sub_sub=mysqli_num_rows($sql_orderm_sub_sub);
						while($row_orderm_sub_sub=mysqli_fetch_array($sql_orderm_sub_sub))
						{
							$ordersubsubid=$flnid[$i];
							$ups=$row_orderm_sub_sub['order_sub_sub_ups'];
							$extqty=$row_orderm_sub_sub['order_sub_subbal_qty'];
							$relqty=$flnid1[$i];
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

function openslocpop(party)
{
//var party=document.form.txtid.value;
winHandle=window.open('ronop.php?oid='+party,'WelCome','top=170,left=180,width=820,height=350,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }
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
	  <td width="820" class="Mainheading" height="25">
	  <table width="820" border="0" cellpadding="0" cellspacing="0" bordercolor="#cc30cc" style="border-bottom:solid; border-bottom-color:#cc30cc" >
	    <tr >
	      <td width="820" height="25" class="Mainheading">&nbsp;Transaction - Order Release</td>
	    </tr></table></td>
	     <td width="80" height="25" align="right" class="submenufont" >
	  <table border="3" align="right" bordercolor="#cc30cc" bordercolordark="#cc30cc" cellspacing="0" cellpadding="0" width="116" style="border-collapse:collapse;">

<tr height="15" class="tbltitle" >
<td align="center" width="100" valign="middle" class="tblbutn" style="cursor:Pointer;"><a href="home_release.php" style="text-decoration:none; color:#000000">Add </a></td>      
	  </tr>
	  </table></td></tr>
  
  
	  
	  <td align="center" colspan="4" >
	  
<form  name="from" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
		<input type="hidden" name="txtid" value="<?php echo $code?>" />
		<input type="hidden" name="logid" value="<?php echo $logid?>" />
		<input type="hidden" name="txtptype" value="" />
		<input type="hidden" name="txtcountry1" value="" />
			

<table border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="5"></td>
</tr>
<tr>
<td width="30">	 </td><td>

<?php
$targetpage = $_SERVER['PHP_SELF']; 
	$adjacents = 2;
	$limit = 10; 								
	if(isset($_GET['page']))								
	{$page = $_GET['page'];}
	else {$page = 0;}
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	
		
  $sql_arr_home=mysqli_query($link,"select * from tbl_orderrelease where plantcode='$plantcode' and orel_flg=1 order by orel_id desc LIMIT $start, $limit") or die(mysqli_error($link));
 $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_qctest where bflg=1   and qcflg=0");
//$total_results2 = mysqli_fetch_array($total_results3);
//$total_results = $total_results2[0]; 

$query = "select * from tbl_orderrelease where orel_flg=1 order by orel_id desc";
$total_pages = mysqli_num_rows(mysqli_query($link,$query));
//echo	$total_pages = $total_pages[num];
	
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\" align=\"right\" style=\"width:830px\">";
		//previous button
		if ($page > 1) 
			$pagination.= " <a href=\"$targetpage?page=$prev\">&laquo; Previous </a> ";
		else
			$pagination.= " <span class=\"disabled\">&laquo; Previous </span> ";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= " <span class=\"current\"> $counter </span> ";
				else
					$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\"> $lastpage </a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= " <a href=\"$targetpage?page=1\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\"> $lpm1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\"> $lastpage </a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= " <a href=\"$targetpage?page=1\"> 1 </a> ";
				$pagination.= " <a href=\"$targetpage?page=2\"> 2 </a> ";
				$pagination.= " ... ";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\"> $counter </span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\"> $counter </a> ";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= " <a href=\"$targetpage?page=$next\"> Next &raquo;</a> ";
		else
			$pagination.= " <span class=\"disabled\"> Next &raquo;</span> ";
		$pagination.= "</div>\n";		
	}
	 $srno=($page-1)*$limit+1;
/*if(!isset($_GET['page'])) { 
		$page = 1; 
		$srno=1;
	} else { 
		if(isset($_GET['page']))								
	{$page = $_GET['page'];}
	else {$page = 0;} 
		$srno=(($page * 10)+1) - 10;
	} 
	$max_results = 10; 
	$from = (($page * $max_results) - $max_results); 
	
	$tdate=$sdate;
	$tday=substr($tdate,0,2);
	$tmonth=substr($tdate,3,2);
	$tyear=substr($tdate,6,4);
	$tdate=$tyear."-".$tmonth."-".$tday;	
	
	
	$pdate=$edate;
	$pday=substr($pdate,0,2);
	$pmonth=substr($pdate,3,2);
	$pyear=substr($pdate,6,4);
	$pdate=$pyear."-".$pmonth."-".$pday;
	
$sql_arr_home=mysqli_query($link,"select * from tbl_orderrelease where orel_flg=1 order by orel_id desc LIMIT $from, $max_results") or die(mysqli_error($link));
$tot_arr_home=mysqli_num_rows($sql_arr_home);

$total_results3 =mysqli_query($link,"SELECT COUNT(*)  FROM tbl_orderrelease where orel_flg=1");
$total_results2 = mysqli_fetch_array($total_results3);
$total_results = $total_results2[0]; */

    if($tot_arr_home >0) { 
?>
<table align="center" border="0" width="750" cellspacing="0" cellpadding="0" bordercolor="#4ea1e1" style="border-collapse:collapse" > 
<tr class="Light">
  <td colspan="6" align="center" class="tblheading">Order Release</td>
</tr>
</table>
 <table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#cc30cc" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="5%"align="center" valign="middle" class="tblheading">#</td> 
			   <td width="10%" align="center" valign="middle" class="tblheading">Date</td>
			 <td width="12%" align="center" valign="middle" class="tblheading">Transaction Id</td>
              <td width="13%" align="center" valign="middle" class="tblheading">Order No.</td>
			  <td width="51%" align="center" valign="middle" class="tblheading">Party Name</td>
              <td align="center" valign="middle" class="tblheading">Output</td>
              </tr>
<?php
//$srno=1;
if($tot_arr_home > 0)
{
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
	$trdate=$row_arr_home['orel_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
		
	$lrole=$row_arr_home['orel_logid'];
	$arrival_id=$row_arr_home['orel_ordermid'];
	
	$orno=""; $party=""; 
	$sql_tbl_sub=mysqli_query($link,"select * from tbl_orderm where plantcode='$plantcode' and orderm_id='$arrival_id'") or die(mysqli_error($link));
	$subtbltot=mysqli_num_rows($sql_tbl_sub);
	$row_tbl_sub=mysqli_fetch_array($sql_tbl_sub);
	
	$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser where p_id='".$row_tbl_sub['orderm_party']."'"); 
	$ttee=mysqli_num_rows($quer3);
	$row3=mysqli_fetch_array($quer3);
	
	$orno=$row_tbl_sub['orderm_porderno'];
	if($ttee > 0)
	$party=$row3['business_name'];
	else
	$party=$row_tbl_sub['orderm_partyname'];
	
if($srno%2!=0)
{
?>			  
<tr class="Light">
	<td width="5%" align="center" valign="middle" class="smalltblheading"><?php echo $srno;?></td>
	<td width="10%" align="center" valign="middle" class="smalltblheading"><?php echo $trdate;?></td>
    <td width="12%" align="center" valign="middle" class="smalltblheading"><?php echo "OR".$row_arr_home['orel_code']."/".$ycode."/".$lrole;?></td>
	<td width="13%" align="center" valign="middle" class="smalltblheading"><?php echo $orno;?></td>
    <td width="51%" align="center" valign="middle" class="smalltblheading"><?php echo $party;?></td>
    <td width="9%" align="center" valign="middle" class="smalltblheading"><a href="Javascript:void(0)" onClick="openslocpop('<?php echo $row_arr_home['orel_id'];?>');">RON</a></td>
</tr>
<?php
}
else
{
?>
<tr class="Dark">
	<td width="5%" align="center" valign="middle" class="smalltblheading"><?php echo $srno;?></td>
	<td width="10%" align="center" valign="middle" class="smalltblheading"><?php echo $trdate;?></td>
    <td width="12%" align="center" valign="middle" class="smalltblheading"><?php echo "OR".$row_arr_home['orel_code']."/".$ycode."/".$lrole;?></td>
	<td width="13%" align="center" valign="middle" class="smalltblheading"><?php echo $orno;?></td>
    <td width="51%" align="center" valign="middle" class="smalltblheading"><?php echo $party;?></td>
    <td width="9%" align="center" valign="middle" class="smalltblheading"><a href="Javascript:void(0)" onClick="openslocpop('<?php echo $row_arr_home['orel_id'];?>');">RON</a></td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
          </table>
<?php
	/*$total_pages = ceil($total_results / $max_results); 
	$no=(($page * $max_results)+1) - $max_results;
	$tono=$srno-1;
	echo "<table width='750' align='center' class='tbltext'><tr><td align='left' >$no - $tono of $total_results Records</td><td align='right'>Select a Page    "; 
 
	
	// Build Previous Link 
	if($page > 1)
	{ 
		$prev = ($page - 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$prev\" STYLE='text-decoration: none'><< Previous </a> "; 
	} 
	
	for($i = 1; $i <= $total_pages; $i++)
	{ 
		if(($page) == $i)
		{ 
		echo "$i "; 
		} else
		{ 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$i\" STYLE='text-decoration: none'>$i</a> "; 
		} 
	} 
	
	// Build Next Link 
	if($page < $total_pages)
	{ 
		$next = ($page + 1); 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?page=$next\" STYLE='text-decoration: none'>Next>></a>"; 
	} 
	
		echo "</td></tr></table>";*/
		 }
else
{
?>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#ffffff" style="border-collapse:collapse">
  <tr  height="25"><td colspan="10" align="center" class="subheading">No Records found for selected Period</td></tr>
  </table>
<?php
}
?>	
<?php echo $pagination?>	  
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