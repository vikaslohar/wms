var xmlHttp1
function searchUser(str,el,tp,a,b,c,d,e,f,g,h,i,j,k,l,m,n)
{
searchUser.el=el;

xmlHttp1=GetXmlHttpObject()
if (xmlHttp1==null)
{
alert ("Browser does not support HTTP Request")
return
}

if(tp=="lotserch")
{
var url="searchresult_lotserch.php"
url=url+"?o="+str
url=url+"&sid="+Math.random()
xmlHttp1.onreadystatechange=stateChanged1
xmlHttp1.open("GET",url,true)
xmlHttp1.send(null)
}

}
function stateChanged1()
{
	if (xmlHttp1.readyState==4 || xmlHttp1.readyState=="complete")
	{
	document.getElementById(searchUser.el).innerHTML=xmlHttp1.responseText
	}
}
function GetXmlHttpObject()
{
var xmlHttp1=null;
	
if (xmlHttp1 != null && xmlHttp1.readyState != 0 && xmlHttp1.readyState != 4)
 {
   xmlHttp1.abort();
 } 
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp1=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 	try
	 {
  		xmlHttp1=new ActiveXObject("Msxml2.XMLHTTP");
  	}
 	catch (e)
  	{
 		 xmlHttp1=new ActiveXObject("Microsoft.XMLHTTP");
  	}
 }
return xmlHttp1;
}
