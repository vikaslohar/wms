var xmlHttp

function showUser(str,el,tp,d,e,i,j,k,trid)
{ showUser.el=el; //alert(d);
//alert(showUser.el);
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }
if(tp=="item")
{
var url="getuser_stitemdrop_ci.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
if(tp=="showlist")
{
var url="getuser_spcishowlist.php";
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
url=url+"&trid="+trid; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}


if(tp=="mformci")
{ 
var url="getuser_spci_update.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mformciupdate")
{ 
var url="getuser_spci_etdupdate.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="etdreci")
{ 
var url="getuser_spci_etd.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="cidelete")
{
var url="getuser_spci_dddelete.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
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