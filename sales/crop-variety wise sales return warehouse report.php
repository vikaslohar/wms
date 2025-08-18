<table align="center" border="1" width="600" cellspacing="0" cellpadding="0" bordercolor="#adad11" >
  <tr class="tblsubtitle" height="25">
    <td height="31" colspan="4" align="center" class="tblheading" bgcolor="#D4BF55"><b>Crop Variety Wise Sales Return Ware House Report</b></td>
  </tr>
  <tr height="15">
    <td height="29" colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font><b>indicates required field&nbsp;</b></td>
  </tr>
  <tr class="Light" height="25">
    <td width="282" height="36" align="right"  valign="middle" class="tblheading">Crop&nbsp;</td>
    <td width="312" align="left"  valign="middle" class="tbltext" >&nbsp;
        <select class="tbltext" name="txtcrop" style="width:170px;" onchange="modetchk(this.value)">
          <option value="ALL" selected>--ALL--</option>
          <?php while($noticia = mysqli_fetch_array($quer3)) { ?>
          <option value="<?php echo $noticia['cropid'];?>" />  
          <?php echo $noticia['cropname'];?>
          <?php } ?>
        </select>
        <font color="#FF0000">*</font>&nbsp;</td>
  </tr>
  <tr class="Dark" height="25">
    <?php
$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety where actstatus='Active' order by popularname Asc"); 
?>
    <td height="36" align="right"  valign="middle" class="tblheading" >Variety&nbsp;</td>
    <td align="left"  valign="middle" class="tbltext" id="vitem" >&nbsp;
        <select class="tbltext" id="itm" name="txtvariety" style="width:170px;" >
          <option value="ALL" selected>--ALL--</option>
          <?php while($noticia_item = mysqli_fetch_array($sql_month)) { ?>
          <option value="<?php echo $noticia_item['varietyid'];?>" />  
          <?php echo $noticia_item['popularname'];?>
          <?php } ?>
        </select>
      &nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  </tr>
</table>
<table width="600" align="center" cellpadding="5" cellspacing="5">
                  <tr >
                    <td valign="top" align="center"><input name="Submit" type="image" src="../images/submit_1.gif" alt="Submit Value"  border="0" style="display:inline;cursor:pointer;" onClick="return mySubmit();" /></td>
                  </tr>
</table>