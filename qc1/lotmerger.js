var xmlHttp

function showUser(str,el,tp,d,e,i,j,k)
{ showUser.el=el; 
//alert(showUser.el);
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
{
 alert ("Browser does not support HTTP Request");
 return;
}


if(tp=="getledet")
{ 
var url="getuser_fpdnvarietyle.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}


if(tp=="vendor")
{
var url="getuser_vaddresschk.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
if(tp=="lotshow")
{
var url="getuser_merger_lotshow.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="item")
{
var url="getuser_vitemdrop.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="itemuom")
{
var url="getuser_vitemuom.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="discard")
{
var url="getuser_discard.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="discard1")
{
var url="getuser_discard1.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="slocshowmrv")
{ 
var url="getuser_discard_slocshow.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&f="+i;
url=url+"&g="+j;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mformddupdate")
{ 
var url="getuser_disacrd_etdupdate.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="subformedt")
{ 
var url="getuser_disacrd_etd.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="discard3")
{ //alert(str);
var url="getuser_discard3.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="dddelete")
{
var url="getuser_issue_dddelete.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="get")
{
	//alert(tp); 
var url="getuser_merger_slocshow.php";
var str1="a="+str;
str1=str1+"&b="+d;
str1=str1+"&c="+e;
str1=str1+"&h="+i;
str1=str1+"&g="+j;
//alert(url);
/*url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
*/

var params=str1;
xmlHttp.open("POST", url, true);
xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlHttp.setRequestHeader("Content-length", params.length);
xmlHttp.setRequestHeader("Connection", "close");
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.send(params);

}


if(tp=="wh")
{ 
var url="getuser_vbindrop_merger.php";
url=url+"?a="+str;
url=url+"&b="+d; 
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="bin")
{ 
var url="getuser_vsbindrop_merger.php";
url=url+"?a="+str;
url=url+"&b="+d; 
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="subbin")
{ 
var url="getuser_vsbinck_merger.php";
url=url+"?a="+str;
url=url+"&b="+d; 
url=url+"&c="+e;
url=url+"&f="+i;
url=url+"&g="+j;
url=url+"&h="+k; 
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