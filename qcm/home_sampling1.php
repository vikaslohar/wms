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
	
	$sql_tbl=mysqli_query($link,"select * from tbl_gotqc where arrtrflag=0") or die(mysqli_error($link));
while($row_tbl=mysqli_fetch_array($sql_tbl))
{
		/*<!--$s_sub="delete from tbl_gotqc where arr_role='".$logid."'  and arrtrflag=0";
	mysqli_query($link,$s_sub) or die(mysqli_error($link));		-->*/
}
	
	/**/	
	if(isset($_POST['frm_action'])=='submit')
	{
			
			
		if($sdate1!="" && $edate1!="")
		{
		echo "<script>window.location='home_trading1.php?sdate=$sdate1&edate=$edate1'</script>";
		}
		
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="include/animatedcollapse.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>QC- Transaction -Sampling</title>
<link href="../include/main_quality.css" rel="stylesheet" type="text/css" />
<link href="../include/vnrtrac_quality.css" rel="stylesheet" type="text/css" />
</head>
<script src="samp.js"></script>
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

function openslocpopprint1(a,b)
{
winHandle=window.open('gsdn.php?tid='+b,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null){
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); }

}


function openslocpopprint(a,b)
{
winHandle=window.open('gatepass.php?tid='+b,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null)
{
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
}
}
function openpop(b)
{
winHandle=window.open('getuser_grs.php?tid='+b,'WelCome','top=170,left=180,width=820,height=450,scrollbars=yes');
if(winHandle==null)
{
alert("While Launching New Window...\nYour browser maybe blocking up Popup windows. \n\n  Please check your Popup Blocker Settings or ..\n Please hold Ctrl Key and Click on link to open new Browser"); 
}
}

function imgOnClick(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.sdate,dt,document.frmaddDept.sdate, "dd-mmm-yyyy", xind, yind);
	}
	
	function imgOnClick1(dt, xind, yind)
	{
	 popUpCalendar(document.frmaddDept.edate,dt,document.frmaddDept.edate, "dd-mmm-yyyy", xind, yind);
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
function mySubmit()
{	
	dt1=getDateObject(document.frmaddDept.sdate.value,"-");
	dt2=getDateObject(document.frmaddDept.edate.value,"-");
		
	if(dt1 > dt2)
	{
	alert("Please select Valid Date Range.");
	return false;
	}
return true;
}
function editrec(edtrecid)
{
//alert(edtrecid);
showUser(edtrecid,'postingsubtable','subformedt','','','','','');
}

</script>
<body>
<table width="1003" height="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <td valign="top"><table width="1003" height="72" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
         <tr>
           <td valign="top"><?php require_once("../include/arr_qcm.php");?></td>
         </tr>
        </tr>
      </table>
      <table width="100%" style=" z-index:-1;" height="auto" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" align="center"><img src="../images/qty_curvetop.gif" /></td>
        </tr>
        <tr>
          <td width="100%" valign="top" height="auto" align="center"  class="midbgline">
  
		  <!-- actual page start--->		  
		 <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
  <tr><td>
   <table  width="974" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" >
	   <tr style="padding:0px 0px 0px 0px" >
	  <td width="34" height="25"><img src="../images/rupee1.jpg" align="right" width="30" height="30" />&nbsp;</td>
	  <td width="940" class="Mainheading" height="25">
	  <table width="940" border="0" cellpadding="0" cellspacing="0" bordercolor="#d21704" style="border-bottom:solid; border-bottom-color:#d21704" >
	    <tr >
	      <td width="940" height="25">&nbsp;Transaction - GOT Sample Dispatch</td>
	    </tr></table></td>
		  
	  </tr>
	  </table></td></tr>
    	  	  <td align="center" colspan="4" >
	  	  <form name="frmaddDept" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return mySubmit();"  > 
	 <input name="frm_action" value="submit" type="hidden"> 
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="974"  style="border-collapse:collapse">
<tr height="7"><td height="7"></td></tr>
<tr>
<td width="30">	 </td><td>

<?php
	$targetpage = $PHP_SELF; 
	$adjacents1 = 2;
	$limit1 = 10; 								
	$page1 = $_GET['page1'];
	if($page1) 
		$start1 = ($page1 - 1) * $limit1; 			//first item to display on this page
	else
		$start1 = 0;	
	
	$sql_dtchk=mysqli_query($link,"select * from tbl_gotqc where arrtrflag=1 and gruflg=0 order by arrival_id desc LIMIT 0,1") or die(mysqli_error($link));
	$tot_dtchk=mysqli_num_rows($sql_dtchk);
	$row_dtchk=mysqli_fetch_array($sql_dtchk);
	$lasttdate=$row_dtchk['arrival_date'];
	$trdate=$row_dtchk['arrival_date'];
	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;
	
		$m=$trmonth;
		$de=$trday;
		$y=$tryear;
		$dt=6;
		for($i=0; $i<=$dt; $i++) { $dt1=date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); }

	$sql_arr_home=mysqli_query($link,"select * from tbl_gotqc where arrtrflag=1 and arrival_date>='$dt1' and gruflg=0 order by arrival_id desc LIMIT $start1, $limit1") or die(mysqli_error($link));
  $tot_arr_home=mysqli_num_rows($sql_arr_home);

//$total_results = mysql_result(mysqli_query($link,"SELECT COUNT(*) as Num FROM tbl_qctest where bflg=1   and qcflg=0"),0); 

$query = "SELECT COUNT(*) as num1 FROM tbl_gotqc where arrtrflag=1 and arrival_date>='$dt1'";
	$total_pages1 = mysqli_fetch_array(mysqli_query($link,$query));
	$total_pages1 = $total_pages1[num1];
	
	if ($page1 == 0) $page1 = 1;					//if no page var is given, default to 1.
	$prev1 = $page1 - 1;							//previous page is page - 1
	$next1 = $page1 + 1;							//next page is page + 1
	$lastpage1 = ceil($total_pages1/$limit1);		//lastpage is = total pages / items per page, rounded up.
	$lpm11 = $lastpage1 - 1;						//last page minus 1
	
$pagination1 = "";
	if($lastpage1 > 1)
	{	
		$pagination1 .= "<div class=\"pagination\" align=\"right\">";
		//previous button
		if ($page1 > 1) 
			$pagination1.= "<a href=\"$targetpage?page1=$prev1\">&laquo; Previous </a>";
		else
			$pagination1.= "<span class=\"disabled\">&laquo; Previous </span>";	
		
		//pages	
		if ($lastpage1 < 7 + ($adjacents1 * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter1 = 1; $counter1 <= $lastpage1; $counter1++)
			{
				if ($counter1 == $page1)
					$pagination1.= "<span class=\"current\"> $counter1 </span>";
				else
					$pagination1.= "<a href=\"$targetpage?page1=$counter1\"> $counter1 </a>";					
			}
		}
		elseif($lastpage1 > 5 + ($adjacents1 * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page1 < 1 + ($adjacents1 * 2))		
			{
				for ($counter1 = 1; $counter1 < 4 + ($adjacents1 * 2); $counter1++)
				{
					if ($counter1 == $page1)
						$pagination1.= "<span class=\"current\"> $counter1 </span>";
					else
						$pagination1.= "<a href=\"$targetpage?page1=$counter1\"> $counter1 </a>";					
				}
				$pagination1.= "...";
				$pagination1.= "<a href=\"$targetpage?page1=$lpm11\"> $lpm11 </a>";
				$pagination1.= "<a href=\"$targetpage?page1=$lastpage1\"> $lastpage1 </a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage1 - ($adjacents1 * 2) > $page1 && $page1 > ($adjacents1 * 2))
			{
				$pagination1.= "<a href=\"$targetpage?page1=1\"> 1 </a>";
				$pagination1.= "<a href=\"$targetpage?page1=2\"> 2 </a>";
				$pagination1.= "...";
				for ($counter1 = $page1 - $adjacents1; $counter1 <= $page1 + $adjacents1; $counter1++)
				{
					if ($counter1 == $page1)
						$pagination1.= "<span class=\"current\"> $counter1 </span>";
					else
						$pagination1.= "<a href=\"$targetpage?page1=$counter1\"> $counter1 </a>";					
				}
				$pagination1.= "...";
				$pagination1.= "<a href=\"$targetpage?page1=$lpm11\"> $lpm11 </a>";
				$pagination1.= "<a href=\"$targetpage?page1=$lastpage1\"> $lastpage1 </a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination1.= "<a href=\"$targetpage?page1=1\"> 1 </a>";
				$pagination1.= "<a href=\"$targetpage?page1=2\"> 2 </a>";
				$pagination1.= "...";
				for ($counter1 = $lastpage1 - (2 + ($adjacents1 * 2)); $counter1 <= $lastpage1; $counter1++)
				{
					if ($counter1 == $page1)
						$pagination1.= "<span class=\"current\"> $counter1 </span>";
					else
						$pagination1.= "<a href=\"$targetpage?page1=$counter1\"> $counter1 </a>";					
				}
			}
		}
		
		//next button
		if ($page1 < $counter1 - 1) 
			$pagination1.= "<a href=\"$targetpage?page1=$next1\"> Next &raquo;</a>";
		else
			$pagination1.= "<span class=\"disabled\"> Next &raquo;</span>";
		$pagination1.= "</div>\n";		
	}
?>
<table align="center" border="0" width="600" cellspacing="0" cellpadding="0" bordercolor="#d21704" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="6" align="center" class="tblheading">GOT Sample Dispatch List &nbsp;&nbsp;(last <?php echo $dt+1;?> days Records)</td>
</tr>
</table>
<table align="center" border="1" cellspacing="0" cellpadding="0" width="850" bordercolor="#d21704" style="border-collapse:collapse">

            <tr class="tblsubtitle" height="20">
              <td width="5%"align="center" valign="middle" class="tblheading">#</td>
			   <td width="9%" align="center" valign="middle" class="tblheading">DOSD</td>
			   <td width="9%" align="center" valign="middle" class="tblheading">GSDN No.</td>
			   <td width="54%" align="center" valign="middle" class="tblheading">Party</td>
             <!-- <td width="17%" align="center" valign="middle" class="tblheading">Variety</td>
              <td width="14%" align="center" valign="middle" class="tblheading">Lot No.</td>
			  <td align="center" valign="middle" class="tblheading">Sample No. </td>-->
			  <td colspan="3" align="center" valign="middle" class="tblheading">Output</td>
              </tr>
<?php
if($tot_arr_home >0) 
{ 
  $srno=($page1-1)*$limit1+1;
while($row_arr_home=mysqli_fetch_array($sql_arr_home))
{
// $tot_arr_home=mysqli_num_rows($sql_arr_home);
 $txtcla=$row_arr_home['party_id'];
$city=$row_arr_home['city'];
$pin=$row_arr_home['pin'];
$state=$row_arr_home['state'];
$party=$row_arr_home['party_name'];
 $txtaddress=$row_arr_home['address'];
$txtcontact=$row_arr_home['contactno'];
 $txt12=$row_arr_home['pid'];
$trdate=$row_arr_home['arrival_date'];
$tot=mysqli_num_rows($sql_tbl);					
$txtvn=$row_arr_home['trans_vehno'];
$city=$row_arr_home['city'];
$txtdc=$row_arr_home['docket_no'];
$txtcname=$row_arr_home['courier_name'];
$txt14=$row_arr_home['trans_paymode '];
$txtlrn=$row_arr_home['trans_lorryrepno'];
$txttname=$row_arr_home['trans_name'];
$state=$row_arr_home['state'];
$address=$row_arr_home['address'];
$party=$row_arr_home['party_id'];
$contact=$row_arr_home['contact_no'];
$txt11=$row_arr_home['tmode'];
$pin=$row_arr_home['pin'];
 $tid=$row_arr_home['arrival_id'];
$txtpname=$row_arr_home['pname'];
$tdate1=$row_arr_home['arrival_date'];
$txtcla=$row_arr_home['party_id'];
$pname=$row_arr_home['party_name'];
$txtcontact=$row_arr_home['contactno'];
$arrival_id=$row_arr_home['arrival_id'];

	$tryear=substr($trdate,0,4);
	$trmonth=substr($trdate,5,2);
	$trday=substr($trdate,8,2);
	$trdate=$trday."-".$trmonth."-".$tryear;	
if($txt12=="Yes")
{
$quer3=mysqli_query($link,"SELECT * FROM tbl_partymaser  where p_id=$txtcla"); 
	$row3=mysqli_fetch_array($quer3);
	//$tot=mysqli_num_rows($row3);		
     $business_name=$row3['business_name'];
	$address=$row3['address'].", ".$row3['city'].", ".$row3['state'];
	$phone="0".$row3['std']." ".$row3['phone'];
	}
	else
	{
	 $business_name=$pname;
	$address=$txtaddress."  ".$city." - ".$pin.", ".$state;
	$phone=$txtcontact;
	}

$code1="GSD"."/".$row_arr_home['year_code']."/".$row_arr_home['gsdn'];

if($srno%2!=0)
{
?>			  
<tr class="Light">
         <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
          <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $code1?></td>
          <td width="54%" align="center" valign="middle" class="tblheading"><?php echo $business_name;?>, <?php echo $address;?></td>
  	<td width="7%" align="center" valign="middle" class="smalltblheading"><a href="Javascript:void(0);" onclick="openslocpopprint1('<?php echo $arrival_id;?>','<?php echo $tid;?>');">GSDN</a></td>
         <td width="10%" align="center" valign="middle" class="smalltblheading"><a href="Javascript:void(0)" onClick="openslocpopprint('<?php echo $arrival_id;?>','<?php echo $tid;?>');">Gate Pass</a></td>
		 <td width="6%" align="center" valign="middle" class="smalltblheading"><a href="Javascript:void(0)" onClick="openpop('<?php echo $arrival_id;?>');">GRS</a></td>
         </tr>
<?php
}
else
{
?>
<tr class="Dark">
         <td width="5%" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
		  <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $trdate;?></td>
          <td width="9%" align="center" valign="middle" class="tblheading"><?php echo $code1?></td>
          <td width="54%" align="center" valign="middle" class="tblheading"><?php echo $business_name;?>, <?php echo $address;?></td>
 	
	<td width="7%" align="center" valign="middle" class="smalltblheading"><a href="Javascript:void(0);" onclick="openslocpopprint1('<?php echo $arrival_id;?>','<?php echo $tid;?>');">GSDN</a></td>
         <td width="10%" align="center" valign="middle" class="smalltblheading"><a href="Javascript:void(0)" onClick="openslocpopprint('<?php echo $arrival_id;?>','<?php echo $tid;?>');">Gate Pass</a></td>
		 <td width="6%" align="center" valign="middle" class="smalltblheading"><a href="Javascript:void(0)" onClick="openpop('<?php echo $arrival_id;?>');">GRS</a></td>
       </tr>
<?php
}

//}
$srno=$srno+1;
}}
//}}
//}

?> <input type="hidden" name="fet" value="<?php echo $arrival_id?>" />
   <input type="hidden" name="tid" value="<?php echo $tid?>" />
   <input type="hidden" name="txtcla" value="<?php echo $txtcla?>" />
   <input type="hidden" name="txt11" value="<?php echo $txt11?>" />
   <input type="hidden" name="contact" value="<?php echo $contact?>" />
 <input type="hidden" name="txtparty" value="<?php echo $txtcontact?>" />
  <input type="hidden" name="txtaddress" value="<?php echo $address?>" />
   <input type="hidden" name="state" value="<?php echo $state?>" />
   <input type="hidden" name="date" value="<?php echo $tdate1?>" />
   <input type="hidden" name="txttname" value="<?php echo $txttname?>" />
   <input type="hidden" name="txtlrn" value="<?php echo $txtlrn?>" />
   <input type="hidden" name="txtvn" value="<?php echo $txtvn?>" />
   <input type="hidden" name="txt14" value="<?php echo $txt14?>" />
   <input type="hidden" name="txtcname" value="<?php echo $txtcname?>" />
   <input type="hidden" name="txtdc" value="<?php echo $txtdc?>" />
   <input type="hidden" name="city" value="<?php echo $city?>" />
   <input type="hidden" name="txt12" value="<?php echo $txt12?>" />
   <input type="hidden" name="txtvn" value="<?php echo $txtvn?>" />
    <input type="hidden" name="pin" value="<?php echo $pin?>" />
	 <input type="hidden" name="txtpname" value="<?php echo $txtpname?>" />
	  <input type="hidden" name="pname" value="<?php echo $pname?>" />
          </table>
<?php echo $pagination1?>
		  </br>
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="select.php" tabindex="20"><img src="../images/back.gif" border="0"style="display:inline;cursor:Pointer;" /></a>&nbsp;</td>
</tr>
</table>


</td>
<td width="30"></td>
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
