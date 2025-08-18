var xmlHttp
function showUser(str,el,tp,d,e,i,j,k,trid,m,n,o,p)
{ showUser.el=el; //alert(d);
	//alert(showUser.el);
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
{
alert ("Browser does not support HTTP Request");
return;
}

if(tp=="etdrec")
{
var url="getuser_fpdnedtsubform_unld.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="getledet")
{ 
var url="getuser_fpdnvarietyle_unld.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}


if(tp=="wh")
{ 
var url="getuser_vbindrop_unld.php";
url=url+"?a="+str;
url=url+"&b="+d; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="bin")
{ 
var url="getuser_vsbindrop_unld.php";
url=url+"?a="+str;
url=url+"&b="+d; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="subbin")
{ 
var url="getuser_vsbinck_new_unld.php";
url=url+"?a="+str;
url=url+"&b="+d; 
url=url+"&c="+e;
url=url+"&f="+i;
url=url+"&g="+j;
url=url+"&h="+k; 
url=url+"&trid="+trid; 
url=url+"&l="+m; 
url=url+"&q="+n; 
url=url+"&r="+o; 
url=url+"&s="+p; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="get")
{
var url="getuser_farrival_showrec_unld.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mformlotsetup")
{ 
//alert(str);
var url="getuser_fpdnlotsetupform_unld.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mformupdate")
{ 
//alert(str);
var url="getuser_fpdnupdateform_unld.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mformsubedt")
{ 
//alert(str);
var url="getuser_fpdneditupdateform_unld.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}



if(tp=="fpdndelete")
{
var url="getuser_fpdndelete_unld.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="slocshowsubgood")
{ 
var url="getuser_arrv_slocshowg_new_unld.php";
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