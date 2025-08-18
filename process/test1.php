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

function checkDate(dateform) 
{
alert("HI");
 date1 = new Date();
 date2 = new Date();
 diff = new Date();
 
 if (isValidDate(dateform.firstdate.value) && isValidTime(dateform.firsttime.value)) { // Validates first Date
  date1temp = new Date(dateform.firstdate.value + " " + dateform.firsttime.value);
  date1.setTime(date1temp.getTime());
 }
 else return false; // otherwise exits
 
 if (isValidDate(dateform.seconddate.value) && isValidTime(dateform.secondtime.value)) { // Validates Second Date
  date2temp = new Date(dateform.seconddate.value + " " + dateform.secondtime.value);
  date2.setTime(date2temp.getTime());
 }
 else return false; // otherwise exits
 
 // sets difference Date To difference of first Date And Second Date
 var zx=date1.getTime();
 var zy=date2.getTime();
 var zz=(Math.abs(zx))-(Math.abs(zy));
 diff.setTime(Math.abs(zz));
 
 timediff = diff.getTime();
 
 weeks = Math.floor(timediff / (1000 * 60 * 60 * 24 * 7));
 timediff -= weeks * (1000 * 60 * 60 * 24 * 7);
 
 days = Math.floor(timediff / (1000 * 60 * 60 * 24));
 timediff -= days * (1000 * 60 * 60 * 24);
 
 hours = Math.floor(timediff / (1000 * 60 * 60));
 timediff -= hours * (1000 * 60 * 60);
 
 mins = Math.floor(timediff / (1000 * 60));
 timediff -= mins * (1000 * 60);
 
 secs = Math.floor(timediff / 1000);
 timediff -= secs * 1000;
 
 alert("Difference = " + weeks + " weeks, " + days + " days, " + hours + " hours, " + mins + " minutes, and " + secs + " seconds");

 return false; // form should never submit, returns False
}

</script>

<body>
<form onSubmit="return checkDate(this);">
<table>
 <tr>
  <td>
   <pre>
   First Date:<input type="text" name="firstdate" value="" size=10 maxlength=10> (MM/DD/YYYY format)<br/>
   Time: <input type="text" name="firsttime" value="" size=10 maxlength=10> (HH:MM:SS format)<br/>
   
   Second Date: Date: <input type="text" name="seconddate" value="" size=10 maxlength=10> (MM/DD/YYYY format)<br/>
   Time: <input type="text" name="secondtime" value="" size=10 maxlength=10> (HH:MM:SS format)<br/>
   
   <center><input type="submit" value="Get Difference!"></center>
   </pre>
  </td>
 </tr>
</table>
</form>
</body>
</html>
 