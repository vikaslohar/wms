var xmlHttp

function showUser(str,el,tp,d,e,i,j,k,trid)
{ showUser.el=el; //alert(d);
//alert(showUser.el);
//alert(tp); 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request");
 return;
 }
if(tp=="item")
{
var url="getuser_stitemdrop_dailyrep.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="itemowpsr")
{
var url="getuser_stitemdrop_owpsr.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="item1")
{
var url="getuser_stitemdrop1.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&f="+i;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="wh")
{ 
var url="getuser_vbindrop.php";
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
var url="getuser_vsbindrop.php";
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
var url="getuser_vsbinck_proslip.php";
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

//edit
if(tp=="subformedt")
{ 
var url="getuser_prospli_vedtsubform.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mform")
{ 
var url="getuser_proslip_vupdateform.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
//update
if(tp=="mformsubedt")
{ 
var url="getuser_proslip_veditsubupdate.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}


//alert(e)
if(tp=="delete")
{
var url="getuser_proslip_vdelete.php";
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
var url="getuser_proslip_showrec.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&h="+i;
url=url+"&g="+j;
url=url+"&f="+k;
url=url+"&l="+trid;
//alert(url);
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