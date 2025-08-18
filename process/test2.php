<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<script type="text/javascript">


function isValidDate(dateStr) 
{
 // Date validation Function 
 // Checks For the following valid Date formats:
 // MM/DD/YY MM/DD/YYYY MM-DD-YY MM-DD-YYYY
 
 var datePat = /^(\d{1,2})(\/|-)(\d{1,2})\2(\d{4})$/; // requires 4 digit Year
 
 var matchArray = dateStr.match(datePat); // Is the format ok?
 if (matchArray == "Null") 
 {
  alert(dateStr + " Date is not in a valid format.")
  return false;
 }
 
 Month = matchArray[1]; // parse Date into variables
 Day = matchArray[3];
 Year = matchArray[4];
 
 if (Month < 1 || Month > 12) 
 { // check Month range
  alert("Month must be between 1 and 12.");
  return false;
 }
 
 if (Day < 1 || Day > 31) 
 {
  alert("Day must be between 1 and 31.");
  return false;
 }
 
 if ((Month==4 || Month==6 || Month==9 || Month==11) && Day==31) 
 {
  alert("Month "+Month+" doesn’t have 31 days!")
  return false;
 }
 
 if (Month == 2) 
 { // check For february 29th
  var isleap = (Year % 4 == 0 && (Year % 100 != 0 || Year % 400 == 0));
  if (Day>29 || (Day==29 && !isleap)) 
  {
   alert("February " + Year + " doesn’t have " + Day + " days!");
   return false;
  }
 }
 return true;
}

function isValidTime(timeStr) 
{
 // Checks if time Is In HH:MM:SS AM/PM format.
 // The seconds And AM/PM are optional.
 
 var timePat = /^(\d{1,2}):(\d{2})(:(\d{2}))?(\s?(AM|am|PM|pm))?$/;
 
 var matchArray = timeStr.match(timePat);
 if (matchArray == "Null") 
 {
  alert("Time is not in a valid format.");
  return false;
 }
 
 Hour = matchArray[1];
 Minute = matchArray[2];
 Second = matchArray[4];
 ampm = matchArray[6];
 
 if (Second=="") { Second = "Null"; }
 if (ampm=="") { ampm = "Null" }
 
 if (Hour < 0 || Hour > 23) {
  alert("Hour must be between 1 and 12. (or 0 and 23 for military time)");
  return false;
 }
 if (Hour <= 12 && ampm == "Null") {
  if (confirm("Please indicate which time format you are using. OK = Standard Time, CANCEL = Military Time")) {
   alert("You must specify AM or PM.");
   return false;
  }
 }
 if (Hour > 12 && ampm != "Null") {
  alert("You can’t specify AM or PM for military time.");
  return false;
 }
 if (Minute < 0 || Minute > 59) {
  alert ("Minute must be between 0 and 59.");
  return false;
 }
 if (Second != "Null" && (Second < 0 || Second > 59)) {
  alert ("Second must be between 0 and 59.");
  return false;
 }
 return true;
}


function checkDate(dateform) {
 date1 = new Date();
 date2 = new Date();
 diff = new Date();
 
 dt1=dateform.firstdate.value.split(" ");
 dd1=dt1[0].split("-");
 dd=dd1[1]+"/"+dd1[0]+"/"+dd1[2];
 
 firstdate=dd;
 firsttime=dt1[1]+" "+dt1[2];
 dt2=dateform.seconddate.value.split(" ");
 dd1=dt2[0].split("-");
 dd=dd1[1]+"/"+dd1[0]+"/"+dd1[2];
 
 seconddate=dd;
 secondtime=dt2[1]+" "+dt2[2];
 alert(firstdate);
  alert(firsttime);
   alert(seconddate);
    alert(secondtime);
  if (isValidDate(firstdate) && isValidTime(firsttime)) { // Validates first Date
  //alert("Valid 1");
  date1temp = new Date(firstdate + " " + firsttime);
  //alert(date1temp);
  date1.setTime(date1temp.getTime());
  alert(date1);
 }
 else return false; // otherwise exits
 
 if (isValidDate(seconddate) && isValidTime(secondtime)) { // Validates Second Date
// alert("Valid 2");
  date2temp = new Date(seconddate + " " + secondtime);
 // alert(date2temp);
  date2.setTime(date2temp.getTime());
  alert(date2);
 }
 else return false; // otherwise exits
 
//alert(date2);
//alert(date1);
 var dif = date2-date1;
 //alert(dif);
 if(dif >=0)
 { // 2nd date is after the 1st date
 //alert("Correct");
  //return true;
 
 var zx=date1.getTime();
 var zy=date2.getTime();
 var zz=(Math.abs(zx))-(Math.abs(zy));
 diff.setTime(Math.abs(zz));
  //alert("HI");
   alert(diff);
 timediff = diff.getTime();
  alert(timediff);
 
/* weeks = Math.floor(timediff / (1000 * 60 * 60 * 24 * 7));
 timediff -= weeks * (1000 * 60 * 60 * 24 * 7);*/
 
 days = Math.floor(timediff / (1000 * 60 * 60 * 24));
 timediff -= days * (1000 * 60 * 60 * 24);
 
 hours = Math.floor(timediff / (1000 * 60 * 60));
 timediff -= hours * (1000 * 60 * 60);
 
 mins = Math.floor(timediff / (1000 * 60));
 timediff -= mins * (1000 * 60);
 
 secs = Math.floor(timediff / 1000);
 timediff -= secs * 1000;
 
 //alert("HI");
//alert("Difference = " + weeks + " weeks, " + days + " days, " + hours + " hours, " + mins + " minutes, and " + secs + " seconds");
  alert("Difference = " + days + " days, " + hours + " hours, and " + mins + " minutes ");
 //alert("HI");
 return false; // form should never submit, returns False
 }
 else
 {
 alert("Incorrect Date Selection");
  return false;
 }
}
</script>
<script src="../include/datetimepicker_css.js"></script>
<body>
<form onSubmit="return checkDate(this);">
<table>
 <tr>
  <td>
   <pre><input name="firstdate" id="firstdate" type="text" size="20" class="smalltbltext" bndex="0" readonly="true"  style="background-color:#ECECEC; cursor:pointer" value="" maxlength="20" />&nbsp;<img src="../images/cal.gif" onclick="javascript:NewCssCal('firstdate','ddMMyyyy','arrow',true,'12')" style="cursor:pointer"/> &nbsp;<font color="#FF0000" >* </font>&nbsp;&nbsp;<input name="seconddate" id="seconddate" type="text" size="20" class="smalltbltext" bndex="0" readonly="true"  style="background-color:#ECECEC; cursor:pointer" value="" maxlength="20" />&nbsp;<img src="../images/cal.gif" onclick="javascript:NewCssCal('seconddate','ddMMyyyy','arrow',true,'12')" style="cursor:pointer"/> &nbsp;<font color="#FF0000" >* </font>&nbsp;
  
   <center><input type="submit" value="Get Difference!"></center>
   </pre>
  </td>
 </tr>
</table>
</form>
</body>
</html>
 