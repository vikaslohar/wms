var xmlHttp
function searchUser(str,el,tp,a,c,e,g,i,k)
{
	searchUser.el=el;
	xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
{
alert ("Browser does not support HTTP Request")
return
}
	//alert(tp);
if(tp=="barsearch")
{
var url="searchresult_barsearch.php"
url=url+"?q="+str
url=url+"&a="+a
url=url+"&b="+c
url=url+"&d="+e
url=url+"&f="+g
url=url+"&sid="+Math.random()
xmlHttp.onreadystatechange=stateChanged
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
}
if(tp=="barsearchedit")
{
var url="searchresult_barsearchedit.php"
url=url+"?q="+str
url=url+"&a="+a
url=url+"&b="+c
url=url+"&d="+e
url=url+"&f="+g
url=url+"&h="+i
url=url+"&j="+k
url=url+"&sid="+Math.random()
xmlHttp.onreadystatechange=stateChanged
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
}



if(tp=="lotserch")
{
var url="searchresult_lotserch.php"
url=url+"?o="+str
url=url+"&sid="+Math.random()
xmlHttp.onreadystatechange=stateChanged
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
}


if(tp=="fclotserch")
{
var url="searchresult_lotserch_fc.php"
url=url+"?o="+str
url=url+"&sid="+Math.random()
xmlHttp.onreadystatechange=stateChanged
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
}



}
function stateChanged()
{
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{
	document.getElementById(searchUser.el).innerHTML=xmlHttp.responseText
	}
}
function GetXmlHttpObject()
{
var xmlHttp=null;
	
if (xmlHttp != null && xmlHttp.readyState != 0 && xmlHttp.readyState != 4)
 {
   xmlHttp.abort();
 } 
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 	try
	 {
  		xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  	}
 	catch (e)
  	{
 		 xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}
 }
return xmlHttp;
}
