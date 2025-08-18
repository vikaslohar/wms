var xmlHttp
function showUser(str,el,tp,d,e,i,j,k,trid,m)
{ 
showUser.el=el; //alert(d);
//alert(showUser.el);
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
{
 alert ("Browser does not support HTTP Request");
 return;
}
 
if(tp=="vitem")
{
var url="getuser_stitemdrop_rep.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
if(tp=="partylocation")
{
var url="getuser_partylocation_rep.php";
url=url+"?a="+str;
url=url+"&b="+d; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
if(tp=="item1")
{
var url="getuser_party_rep.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
if(tp=="location")
{
var url="getuser_location_rep.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

}



function stateChanged() 
{ 
if (xmlHttp.readyState==4 )
 { 
 if(xmlHttp.status == 200) {
	// alert(showUser.el);
 document.getElementById(showUser.el).innerHTML=xmlHttp.responseText ;
 }
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