var xmlHttp1
function searchUser1(str,el,tp,a,c,e,g,i,k)
{
	searchUser1.el=el;
	xmlHttp1=GetXmlHttpObject1()
if (xmlHttp1==null)
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
xmlHttp1.onreadystatechange=stateChanged1
xmlHttp1.open("GET",url,true)
xmlHttp1.send(null)
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
xmlHttp1.onreadystatechange=stateChanged1
xmlHttp1.open("GET",url,true)
xmlHttp1.send(null)
}

}
function stateChanged1()
{
	if (xmlHttp1.readyState==4 || xmlHttp1.readyState=="complete")
	{
	document.getElementById(searchUser1.el).innerHTML=xmlHttp1.responseText
	}
}
function GetXmlHttpObject1()
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
