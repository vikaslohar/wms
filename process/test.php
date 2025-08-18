<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<script>
function calfx(text1,text2,text3) {
/*In this function the start time is 10:00 AM and End time is 07:00 PM.

For the holidays you need to play with number of days. That thing is still remaining. If you can do it yourself by subtracting the number of days according to your holidays. If you wouldn't able to do so then I am here for you :)*/


    var second=1000, minute=second*60, hour=minute*60, day=hour*24, week=day*7;
	var StartTime='09:30 AM';
	var EndTime='11:30 AM';
	var StartTimeHour='00:30';
	var EndTimeHour='11:30';
	var flag=false;
	var startDateTime = new Date('08/01/2011'+' '+ StartTime);
	var EndDateTime = new Date('08/02/2011'+' '+ EndTime);
	
	date1 = document.getElementById(text1).value;
    date2 = document.getElementById(text2).value;
	
	var dt1=date1.split(" ");
	//CompareDate1=new Date(dt1[0]);
	CompareDate1=dt1[0];
	var dttt1 = dt1[1].split(":");
	dtt1=dt1[1]+' '+dt1[2];
	dttttt1=new Date('08/01/2011'+' '+ dtt1);

	if (dttttt1 < startDateTime) {alert('Please enter first date-time equal to or greater than '+StartTime);flag=true;}
	if (dttttt1 > EndDateTime) {alert('Please enter first date-time equal to or less than '+EndTime);flag=true;}
	var hrs1 = new Date();
	
	var dt2=date2.split(" ");
	//CompareDate2=new Date(dt2[0]);
	CompareDate2=dt2[0];
	var dttt2 = dt2[1].split(":");
	dtt2=dt2[1]+' '+dt2[2];
	dttttt2=new Date('08/02/2011'+' '+ dtt2);
	
	if (dttttt2 < startDateTime) {alert('Please enter second date-time equal to or greater than '+StartTime);flag=true;}
	if (dttttt2 > EndDateTime) {alert('Please enter second date-time equal to or less than '+EndTime);flag=true;}
	
	date1 = new Date(date1)
	date2 = new Date(date2)
	diff  = new Date();
	diff.setTime(Math.abs(date1.getTime() - date2.getTime()));
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
	
var str="";
var str1="";
var str2="";
var str3="";
var str4="";
if (weeks!=0){
	str =weeks + " weeks ";
}
if (days!=0){
		str1 =days + " days ";
}
if (hours!=0){
	if (CompareDate1 != CompareDate2){
				var hoursStart = 00;
				var hoursend = 00;
				if (dt1[2]=='PM'){
					hoursStart= parseInt(EndTimeHour)-parseFloat(dttt1[0]+"."+dttt1[1],2);}
				else{
				EndTimeHour1=parseInt(EndTimeHour)+12;
				hoursStart= parseInt(EndTimeHour1)-parseFloat(dttt1[0]+"."+dttt1[1],2);}
				
				if (dttt1[0]==12){hoursStart=(parseInt(EndTimeHour)+12)-parseFloat(12+"."+dttt1[1],2);}
				
				
				if (dt2[2]=='PM'){
					StartTimeHour1=parseFloat(dttt2[0]+"."+dttt2[1])+12;
					hoursEnd= parseFloat(StartTimeHour1,2)-parseInt(StartTimeHour);}
				else{
				hoursEnd= parseFloat(dttt2[0]+"."+dttt2[1],2)-parseInt(StartTimeHour);}
				
				if (dttt2[0]==12){hoursEnd=parseFloat(12+"."+dttt2[1],2)-parseInt(StartTimeHour);}
				
				if (mins==0){
					hours = Math.round(parseFloat(hoursStart) + parseFloat(hoursEnd),2);
				}
				else{	
					hours= parseInt(hoursStart) + parseInt(hoursEnd);
				}
			}
		str2 =hours + " hours ";
}

if (mins!=0){
		if(mins<15){mins=15;}
		if(mins>15 && mins<30){mins=30;}
		if(mins>30 && mins<45){mins=45;}
		if(mins>45 && mins<60){mins=60;}
		
		str3 =mins + " minutes ";
}
if (secs!=0){
	str4 =secs + " seconds ";
}

document.getElementById(text3).value = str + str1 + str2 + str3;
if (flag==true) {document.getElementById(text3).value=' ';}

}
</script>


<body>
<table>
<tr height="30">
	<td>Approved Start Date:</td><td><input type="text" name="apsd" id="apsd" value="08/01/2011 09:30 AM"/>
				Approved End Date:<input type="text" name="aped" id="aped" value="08/02/2011 11:30 AM"/>
				Approved Duration:<input type="text" name="apdu" id="apdu"/>
				<a href="javascript:calfx('apsd','aped','apdu')"><img src="../images/cal.gif" width="16" height="16" border="0" alt="Pick a date"/></a></td></tr></td></tr>
</table>
</body>
</html>
 