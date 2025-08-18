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
	
if(isset($_GET['code']))
	{
	$code = $_GET['code'];	 
	}
if(isset($_GET['txtcode']))
	{
	$code1 = $_GET['txtcode'];	 
	}
if(isset($_GET['txtdate']))
	{
	$trdate = $_GET['txtdate'];	 
	}
if(isset($_GET['txtuom']))
	{
	$txtuom = $_GET['txtuom'];	 
	}
if(isset($_GET['chkbox']))
	{
	$chkbox = $_GET['chkbox'];	 
	}
if(isset($_GET['srno1']))
	{
	$srno1 = $_GET['srno1'];	 
	}
if(isset($_GET['maintrid']))
	{
	$trid = $_GET['maintrid'];	 
	}
if(isset($_GET['txtclass']))
	{
	$classid = $_GET['txtclass'];	 
	}
if(isset($_GET['txtitem']))
	{
	$itemid = $_GET['txtitem'];	 
	}	
if(isset($_GET['subtrid']))
	{
	$rid = $_GET['subtrid'];	 
	}
		

if(isset($_GET['txt12']))
	{
	$pname = $_GET['txt12'];	 
	}
 if(isset($_GET['txtdrno']))
	{
	$txtdrno = $_GET['txtdrno'];	 
	}
			
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
if(isset($_GET['txt1']))
	{
	$txt1 = $_GET['txt1'];	 
	}
if(isset($_GET['txt13']))
	{
	$txt13 = $_GET['txt13'];	 
	}
if(isset($_GET['txtdc']))
	{
	$m = $_GET['txtdc'];	 
	}
if(isset($_GET['txtpname']))
	{
	$pname = $_GET['txtpname'];	 
	}
if(isset($_GET['txtrettype']))
	{
	$txtrettype = $_GET['txtrettype'];	 
	}
 if(isset($_GET['txtparty']))
	{
	$party = $_GET['txtparty'];	 
	}
			
if(isset($_GET['txt']))
	{
	$type = $_GET['txt'];	 
	}
if(isset($_GET['txtappli']))
	{
	$txtappli = $_GET['txtappli'];	 
	}
if(isset($_GET['txt12']))
	{
	$txt12 = $_GET['txt12'];	 
	}
if(isset($_GET['txtremarks']))
	{
	$txtremarks = $_GET['txtremarks'];	 
	}
if(isset($_GET['txtaddress']))
	{
	$txtaddress = $_GET['txtaddress'];	 
	}	
if(isset($_GET['rettyp']))
	{
	$rettyp = $_GET['rettyp'];	 
	}	
if(isset($_GET['txtphone']))
	{
	$txtphone = $_GET['txtphone'];	 
	}
if(isset($_GET['txtlot1']))
	{
	$txtlot1 = $_GET['txtlot1'];	 
	}

//frm_action=submit&txt11=Transport&txt14=Paid&txt15=&txt13=&txt=&code=1&logid=PM1&txtappli=Applicable&rettyp=Not%20Returnable&txt1=&txtdate=23-11-2011&txtdrno=sfdgsfdg&txtparty=sdfgsfdg&txtaddress=dsfgsd&txtaddress1=gfsdfgsfd&txtcity=sfdsgfd&txtpin=545436&txtstate=Kerala&txtphone=546436&txtmode=Applicable&txt1=Transport&txttname=fgfdgh&txtlrn=gfh546fg&txtvn=gfd56465gfh&txt13=Paid&txtcname=&txtdc=&txtpname=&trid=0&txtclass=28&txtitem=150&itmdchk=&txtlot1=DN00202%2F00000R&txtlotnoid=&txtrettype=damage&txtrettyp=damage&upsavl_1=10&qtyavl_1=0.500&issueups_1=1&issueqty_1=0.1&balups_1=9&balqty_1=0.4&upsavl_2=10&qtyavl_2=200.000&issueups_2=2&issueqty_2=25&balups_2=8&balqty_2=175&srno=3&chkbox=236%2C237&srno1=1%2C2&ret=Not%20Returnable&txtremarks=test

		
			
		$tdate=$trdate;
		$tday=substr($tdate,0,2);
		$tmonth=substr($tdate,3,2);
		$tyear=substr($tdate,6,4);
		$tdate=$tyear."-".$tmonth."-".$tday;	
		
		$p1_array=explode(",",$chkbox);	
		$p1_array1=explode(",",$srno1);	
		$numrec=count($p1_array1);
		
if($trid == 0)
{
$sql_in1="insert into tbl_discard(tcode, tdate, drno, party_name, address, tmode, tname, lrno, vno, cname, dcno, pmode , pname, remarks, rettyp,phoneno, yearcode, ddrole, plantcode) values ('$code', '$tdate', '$drno', '$party', '$txtaddress', '$txt1', '$i', '$j', '$k','$l','$m','$txt13', '$pname', '$txtremarks', '$rettyp', '$txtphone', '$yearid_id', '$logid', '$plantcode')";

if(mysqli_query($link,$sql_in1) or die(mysqli_error($link)))
{
 $mainid=mysqli_insert_id($link);
//exit;
  $sql_sub="insert into tbl_discard_sub(did_s, crop, variety, lotnumber, remark, type, plantcode )values('$mainid','$classid','$itemid','$txtlot1','$txtremarks','$rettyp', '$plantcode')";

if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=mysqli_insert_id($link);
$totups=0; $totqty=0;
for($num=0; $num<$numrec; $num++)
{
	$p1_array[$num];
	$p1_array1[$num];
$sql_itmldg=mysqli_query($link,"select lotldg_balbags, lotldg_balqty, lotldg_id, lotldg_whid, lotldg_binid, lotldg_subbinid from tbl_lot_ldg where lotldg_id='".$p1_array[$num]."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_itmldg=mysqli_fetch_array($sql_itmldg);
$balu=$row_itmldg['lotldg_balbags'];
$balq=$row_itmldg['lotldg_balqty'];
$whid=$row_itmldg['lotldg_whid'];
$binid=$row_itmldg['lotldg_binid'];
$subbinid=$row_itmldg['lotldg_subbinid'];

$ups="issueups_".$p1_array1[$num];
$qty="issueqty_".$p1_array1[$num];
$balups="balups_".$p1_array1[$num];
$balqty="balqty_".$p1_array1[$num]; 
$stage="stage_".$p1_array1[$num]; 

if(isset($_GET[$ups]))
	{
	$ups1 = $_GET[$ups];	 
	}	
if(isset($_GET[$qty]))
	{
	$qty1 = $_GET[$qty];	 
	}	
if(isset($_GET[$balups]))
	{
	$balups1 = $_GET[$balups];	 
	}	
if(isset($_GET[$balqty]))
	{
	$balqty1 = $_GET[$balqty];	 
	}	
if(isset($_GET[$stage]))
	{
	$stage1 = $_GET[$stage];	 
	}		

$totups=$totups+$ups1;
$totqty=$totqty+$qty1;
$rowid=$p1_array[$num];
$sql_sub_sub="insert into tbl_discard_sloc(discard_type, discard_trid, discard_id, crop, variety, whid, binid, subbin, qty_discard, ups_discard, qty_balance, ups_balance, discard_rowid, eid, sstage, plantcode) values('MD', '$mainid', '$subid', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$qty1', '$ups1', '$balqty1', '$balups1', '$rowid', '$rid', '$stage1', '$plantcode')";

mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
$sql_sub_update="update tbl_discard_sub set ups='$totups', qty='$totqty' where did='$subid'";
mysqli_query($link,$sql_sub_update) or die(mysqli_error($link));

}
}
$trid=$mainid;
}
else
{
$mainid=$trid;

 $sql_sub="update tbl_discard set tcode='$code' , tdate='$tdate' , drno='$drno', party_name='$party', address='$txtaddress' , tmode='$txt1' , tname='$i', lrno='$j' , vno='$k' , cname='$l' , dcno='$m', pmode='$txt13', pname='$pname', remarks='$txtremarks', rettyp='$rettyp', phoneno='$txtphone', yearcode='$yearid_id', ddrole='$logid' where tid='$mainid'";
 
 if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{

 $sql_sub="update tbl_discard_sub set did_s='$mainid', crop='$classid', variety='$itemid', lotnumber='$txtlot1', remark='$txtremarks', type='$rettyp' where did='$rid'";

if(mysqli_query($link,$sql_sub) or die(mysqli_error($link)))
{
$subid=$rid;
$s_sub_sub="delete from tbl_discard_sloc where discard_id='".$subid."'";
mysqli_query($link,$s_sub_sub) or die(mysqli_error($link));

$totups=0; $totqty=0;
for($num=0; $num<$numrec; $num++)
{
	$p1_array[$num];
	$p1_array1[$num];
$sql_itmldg=mysqli_query($link,"select lotldg_balbags, lotldg_balqty, lotldg_id, lotldg_whid, lotldg_binid, lotldg_subbinid from tbl_lot_ldg where lotldg_id='".$p1_array[$num]."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_itmldg=mysqli_fetch_array($sql_itmldg);
$balu=$row_itmldg['lotldg_balbags'];
$balq=$row_itmldg['lotldg_balqty'];
$whid=$row_itmldg['lotldg_whid'];
$binid=$row_itmldg['lotldg_binid'];
$subbinid=$row_itmldg['lotldg_subbinid'];

$ups="issueups_".$p1_array1[$num];
$qty="issueqty_".$p1_array1[$num];
$balups="balups_".$p1_array1[$num];
$balqty="balqty_".$p1_array1[$num]; 
$stage="stage_".$p1_array1[$num]; 

if(isset($_GET[$ups]))
	{
	$ups1 = $_GET[$ups];	 
	}	
if(isset($_GET[$qty]))
	{
	$qty1 = $_GET[$qty];	 
	}	
if(isset($_GET[$balups]))
	{
	$balups1 = $_GET[$balups];	 
	}	
if(isset($_GET[$balqty]))
	{
	$balqty1 = $_GET[$balqty];	 
	}	
if(isset($_GET[$stage]))
	{
	$stage1 = $_GET[$stage];	 
	}		

$totups=$totups+$ups1;
$totqty=$totqty+$qty1;
$rowid=$p1_array[$num];
$sql_sub_sub="insert into tbl_discard_sloc(discard_type, discard_trid, discard_id, crop, variety, whid, binid, subbin, qty_discard, ups_discard, qty_balance, ups_balance, discard_rowid, eid, sstage, plantcode) values('MD', '$mainid', '$subid', '$classid', '$itemid', '$whid', '$binid', '$subbinid', '$qty1', '$ups1', '$balqty1', '$balups1', '$rowid', '$rid', '$stage1', '$plantcode')";

mysqli_query($link,$sql_sub_sub) or die(mysqli_error($link));
}
$sql_sub_update="update tbl_discard_sub set ups='$totups', qty='$totqty' where did='$subid'";
mysqli_query($link,$sql_sub_update) or die(mysqli_error($link));
}
}
}
?>

<?php 
 $tid=$mainid
?>

<table align="center" border="1" cellspacing="0" cellpadding="0" width="750" bordercolor="#2e81c1" style="border-collapse:collapse">

			<tr class="tblsubtitle">
			  <td width="3%" rowspan="2" align="center" valign="middle" class="tblheading">#</td>
			  <td width="12%" align="center" rowspan="2" valign="middle" class="tblheading">Crop</td>
			  <td width="18%" rowspan="2" align="center" valign="middle" class="tblheading">Variety</td>
			  <td width="8%" rowspan="2" align="center" valign="middle" class="tblheading">Lot No.</td>
			  <td width="7%" rowspan="2" align="center" valign="middle" class="tblheading">Stage</td>
			  <td colspan="3" align="center" valign="middle" class="tblheading">Existing</td>
			  <td colspan="2" align="center" valign="middle" class="tblheading">Damage</td>
              <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
              <td width="4%" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>
              <td width="5%" rowspan="2" align="center" valign="middle" class="tblheading">Delete</td>
  </tr>
			<tr class="tblsubtitle">
			  <td width="5%" align="center" valign="middle" class="tblheading">SLOC</td>
                    <td width="7%" align="center" valign="middle" class="tblheading">Bags</td>
                    <td width="8%" align="center" valign="middle" class="tblheading">Qty</td>
                    <td width="5%" align="center" valign="middle" class="tblheading">Bags</td>
                    <td width="7%" align="center" valign="middle" class="tblheading">Qty</td>
                  	<td width="5%" align="center" valign="middle" class="tblheading">Bags</td>
                    <td width="6%" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
<?php
$sr=1; $itmdchk="";
$sql_eindent_sub=mysqli_query($link,"select * from tbl_discard_sub where did_s=$tid and plantcode='$plantcode'") or die(mysqli_error($link));
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{

if($itmdchk!="")
	{
	$itmdchk=$itmdchk.$row_eindent_sub['variety'].",";
	}
	else
	{
	$itmdchk=$row_eindent_sub['variety'].",";
	}
	
	$wareh=""; $binn=""; $subbinn=""; $sups="";$slocs=""; $gd=""; $balups1=""; $balqty1=""; $opups1=""; $opqty1=""; $sqty=""; $slups=0; $slqty=0; $balups=0; $balqty=0; $opups=0;  $opqty=0; $stage="";
	
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_eindent_sub['crop']."'") or die(mysqli_error($link));
$noticia_class = mysqli_fetch_array($classqry);

$tto=0;
$sql_veriety=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_eindent_sub['variety']."' and actstatus='Active'") or die(mysqli_error($link));
$tto=mysqli_num_rows($sql_veriety);
if($tto>0)
{		
	$row_variety=mysqli_fetch_array($sql_veriety);
	$itemid=$row_variety['popularname'];				
}
else
{
	$itemid=$row_eindent_sub['variety'];
}

/*if($trid > 0)
{*/
$sql_tblissue=mysqli_query($link,"select * from tbl_discard_sloc where discard_trid='".$trid."' and discard_id='".$row_eindent_sub['did']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$tot_tblissue=mysqli_num_rows($sql_tblissue);



while($row_tblissue=mysqli_fetch_array($sql_tblissue))
{

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where whid='".$row_tblissue['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_tblissue['binid']."' and whid='".$row_tblissue['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where sid='".$row_tblissue['subbin']."' and binid='".$row_tblissue['binid']."' and whid='".$row_tblissue['whid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";

$slups=$row_tblissue['ups_discard'];
if($sups!="")
$sups=$sups.$slups."<br/>";
else
$sups=$slups."<br/>";


$slqty=$row_tblissue['qty_discard'];
if($sqty!="")
$sqty=$sqty.$slqty."<br/>";
else
$sqty=$slqty."<br/>";

$balups=$row_tblissue['ups_balance'];
if($balups1!="")
$balups1=$balups1.$balups."<br/>";
else
$balups1=$balups."<br/>";


$balqty=$row_tblissue['qty_balance'];
if($balqty1!="")
$balqty1=$balqty1.$balqty."<br/>";
else
$balqty1=$balqty."<br/>";

$sql_stldg1=mysqli_query($link,"select * from tbl_lot_ldg where lotldg_id='".$row_tblissue['discard_rowid']."' and plantcode='$plantcode'") or die(mysqli_error($link));
$row_stldg1=mysqli_fetch_array($sql_stldg1); 

$opups=$row_stldg1['lotldg_balbags'];
if($opups1!="")
$opups1=$opups1.$opups."<br/>";
else
$opups1=$opups."<br/>";

$opqty=$row_stldg1['lotldg_balqty'];
if($opqty1!="")
$opqty1=$opqty1.$opqty."<br/>";
else
$opqty1=$opqty."<br/>";
$erid=$row_tblissue['discard_id'];

if($stage!="")
$stage=$stage.$row_tblissue['sstage']."<br/>";
else
$stage=$row_tblissue['sstage']."<br/>";


}
/*}
else
{
 $sups="";$sqty=""; $slocs=""; $balups1=""; $balqty1=""; $opups1=""; $opqty1=""; $erid=0;
}*/
if($sr%2!=0)
{
?>		  
 <tr class="Light" height="20">
             <td width="3%" align="center" valign="middle" class="tbltext"><?php echo $sr;?></td>
			 <td width="12%" align="center" valign="middle" class="tbltext"><?php echo $noticia_class['cropname'];?></td>
             <td width="18%" align="center" valign="middle" class="tbltext"><?php echo $itemid;?></td>
			 <td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['lotnumber'];?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $stage;?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $opups1;?></td>
             <td width="8%" align="center" valign="middle" class="tbltext"><?php echo $opqty1;?></td>
		     <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $sups;?></td>
             <td width="7%" align="center" valign="middle" class="tbltext"><?php echo $sqty;?></td>
             <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $balups1;?></td>
             <td width="6%" align="center" valign="middle" class="tbltext"><?php echo $balqty1;?></td>
             <td valign="middle" class="tbltext" align="center"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrecord(<?php echo $erid;?>);" /></td>
              <td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['did_s'];?>,<?php echo $row_eindent_sub['did'];?>,'DD');" /></td>
</tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['did'];?>" />

<?php
}
else
{
?>
<tr class="Dark" height="20">
             <td width="3%" align="center" valign="middle" class="tbltext"><?php echo $sr;?></td>
			 <td width="12%" align="center" valign="middle" class="tbltext"><?php echo $noticia_class['cropname'];?></td>
             <td width="18%" align="center" valign="middle" class="tbltext"><?php echo $itemid;?></td>
			 <td align="center" valign="middle" class="tbltext"><?php echo $row_eindent_sub['lotnumber'];?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $stage;?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $slocs;?></td>
             <td align="center" valign="middle" class="tbltext"><?php echo $opups1;?></td>
             <td width="8%" align="center" valign="middle" class="tbltext"><?php echo $opqty1;?></td>
			 <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $sups;?></td>
             <td width="7%" align="center" valign="middle" class="tbltext"><?php echo $sqty;?></td>
             <td width="5%" align="center" valign="middle" class="tbltext"><?php echo $balups1;?></td>
             <td width="6%" align="center" valign="middle" class="tbltext"><?php echo $balqty1;?></td>
             <td valign="middle" class="tbltext" align="center"><img src="../images/edit.png" border="0" style="display:inline;cursor:pointer;" onclick="editrecord(<?php echo $erid;?>);" /></td>
              <td valign="middle" class="tbltext" align="center"><img border="0" src="../images/delete.png" style="display:inline;cursor:pointer;" onclick="deleterec(<?php echo $row_eindent_sub['did_s'];?>,<?php echo $row_eindent_sub['did'];?>,'DD');" /></td>
</tr><input type="hidden" name="rid" value="<?php echo $row_eindent_sub['did'];?>" />
<?php 
}
$sr=$sr+1;	
}
?>			  
</table>
<input type="hidden" name="trid" value="<?php echo $tid?>" />
<div id="subsubdiv" style="display:block">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="6" align="center" class="tblheading">Post Item Form</td>
</tr>
<tr height="15"><td colspan="6" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>		
<?php 
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop order by cropname") or die(mysqli_error($link));
?>
<tr class="Dark" height="25">
   <td width="154"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<select class="tbltext" name="txtclass" style="width:170px;" onchange="modetchk(this.value)">
<option value="" selected>--Select Crop--</option>
	<?php while($noticia_class = mysqli_fetch_array($classqry)) { ?>
		<option value="<?php echo $noticia_class['cropid'];?>" />   
		<?php echo $noticia_class['cropname'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000">*</font>
	</td></tr>
 <?php 
$itemqry=mysqli_query($link,"select varietyid, popularname from tblvariety where actstatus='Active'") or die(mysqli_error($link));
?>            
         <tr class="Light" height="30">
<td align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3" id="vitem" >&nbsp;<select class="tbltext" name="txtitem" id="itm" style="width:170px;" onchange="modetchk24(this.value);" >
<option value="" selected>---Select Variety---</option>
</select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr><input type="hidden" name="itmdchk" value="" />	
 <tr class="Dark" height="30" >
<td align="right" valign="middle" class="tblheading">Lot Number&nbsp;</td>
<td align="left" valign="middle" class="tbltext"  >&nbsp;<input name="txtlot1" type="text" size="20" class="tbltext" tabindex=""  maxlength="20"  value="" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();" readonly="true" style="background-color:#CCCCCC" >&nbsp;<font color="#FF0000">*</font>&nbsp;<a href="Javascript:void(0);" onclick="openslocpop();">Select</a><input type="hidden" name="txtlotnoid" /></td>
	<td align="left" width="366" valign="middle" class="tblheading" >&nbsp;<a href="javascript:void(0);" onclick="getdetails();" >Get Details</a> &nbsp;(After selection of lot no. click on 'Get Details')</td>
</tr>
		 
</table><input name="txtrettype" value="good" type="hidden"><input name="txtrettyp" value="good" type="hidden"> 
<div id="subdiv" style="display:block">	
<div id="subdiv24">
<!--<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#2e81c1" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">

 <td colspan="3" align="center" valign="middle" class="tblheading">Existing SLOC</td>
  <td  colspan="2" align="center" valign="middle" class="tblheading">Discard</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="60" align="center" valign="middle" class="tblheading" style="display:none">Select</td>
<td width="98" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="84" align="center" valign="middle" class="tblheading">Bags</td>
<td width="103" align="center" valign="middle" class="tblheading">Qty</td>
<td width="84" align="center" valign="middle" class="tblheading">Bags</td>
<td width="103" align="center" valign="middle" class="tblheading">Qty</td>
<td width="65" align="center" valign="middle" class="tblheading">Bags</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
 </table>

<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:pointer;" onclick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>--></div>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
</div></div>