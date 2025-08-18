var xmlHttp
function showUser(str,el,tp,d,e,i,j,k,trid,o,p,u,v,w)
{  
	showUser.el=el; //alert(d);
	//alert(showUser.el);
	//alert(tp); 
	xmlHttp=GetXmlHttpObject();

if (xmlHttp==null)
{
	alert ("Browser does not support HTTP Request");
	return;
}

if(tp=="partylocation")
{
	var url="getuser_partylocation1.php";
	url=url+"?a="+str;
	url=url+"&b="+d; 
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

if(tp=="item1")
{
	var url="getuser_party.php";
	url=url+"?a="+str;
	url=url+"&b="+d;
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

if(tp=="location")
{
	var url="getuser_location.php";
	url=url+"?a="+str;
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}
if(tp=="item")
{
var url="getuser_stitemdrop22.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
if(tp=="itemrep")
{
var url="getuser_repitemdrop.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

/*if(tp=="item1")
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
}*/

if(tp=="lotno1")
{
var url="getuser_add.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
 if(tp=="vendor")
{
var url="getuser_vaddresschktdf.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

 if(tp=="ordrno")
{
var url="getuser_orderno.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

 if(tp=="ordetshow")
{
var url="getuser_ordrlotshowtdf.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&h="+i;
url=url+"&g="+j;
url=url+"&l="+k;
url=url+"&m="+trid;
url=url+"&n="+o;
url=url+"&q="+p;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="orderdet")
{
var url="getuser_orderdettdf.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&h="+i;
url=url+"&g="+j;
url=url+"&l="+k;
url=url+"&m="+trid;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="lotshow")
{
var url="getuser_dtdflotshow.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&h="+i;
url=url+"&g="+j;
url=url+"&l="+k;
url=url+"&m="+trid;
url=url+"&n="+o;
url=url+"&q="+p;
url=url+"&r="+u;
url=url+"&s="+v;
url=url+"&t="+w;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

//edit Main
if(tp=="mainformedt")
{ 
var url="getuser_dtdfedtsubform.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

//edit
if(tp=="subformedt")
{ 
var url="getuser_dtdfsedtsubform.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&h="+i;
url=url+"&g="+j;
url=url+"&l="+k;
url=url+"&m="+trid;
url=url+"&n="+o;
url=url+"&q="+p;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mbform")
{ 
var url="getuser_dtdfnxtupdateform.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mform")
{ 
var url="getuser_dtdfupdateform.php";
/*url=url+"?"+str; 
alert(url);
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);*/
var params=str;
xmlHttp.open("POST", url, true);
xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlHttp.setRequestHeader("Content-length", params.length);
xmlHttp.setRequestHeader("Connection", "close");
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.send(params);
}

//update
if(tp=="mformsubedtup")
{ 
var url="getuser_dtdfeditsubupdate.php";
/*url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);*/
var params=str;
xmlHttp.open("POST", url, true);
xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlHttp.setRequestHeader("Content-length", params.length);
xmlHttp.setRequestHeader("Connection", "close");
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.send(params);
}

//update
if(tp=="mformsubedt")
{ 
var url="getuser_dtdfeditsubupdate.php";
/*url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);*/
var params=str;
xmlHttp.open("POST", url, true);
xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlHttp.setRequestHeader("Content-length", params.length);
xmlHttp.setRequestHeader("Connection", "close");
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.send(params);
}

//alert(e)
if(tp=="delete")
{
var url="getuser_dtdfdelete.php";
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
var url="getuser_qtyrem_showrec.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&h="+i;
url=url+"&g="+j;
//alert(url);
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="barchkmmc")
{
	var url="getuser_dtdfbarchkmmc.php";
	url=url+"?a="+str;
	url=url+"&b="+d;
	url=url+"&c="+e;
	url=url+"&h="+i;
	url=url+"&g="+j;
	url=url+"&l="+k;
	url=url+"&m="+trid;
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

if(tp=="lotshowmmc")
{
	var url="getuser_dtdflotshowmmc.php";
	url=url+"?a="+str;
	url=url+"&b="+d;
	url=url+"&c="+e;
	url=url+"&h="+i;
	url=url+"&g="+j;
	url=url+"&l="+k;
	url=url+"&m="+trid;
	url=url+"&n="+o;
	url=url+"&q="+p;
	url=url+"&r="+u;
	url=url+"&s="+v;
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}
	
if(tp=="subformedtmmc")
{ 
	var url="getuser_dtdfmmcdtsubsubform.php";
	url=url+"?a="+str;
	url=url+"&b="+d;
	url=url+"&c="+e;
	url=url+"&h="+i;
	url=url+"&g="+j;
	url=url+"&l="+k;
	url=url+"&m="+trid;
	url=url+"&n="+o;
	url=url+"&q="+p;
	url=url+"&r="+u;
	url=url+"&s="+v;
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}
	
if(tp=="mainformedtmmc")
{ 
	var url="getuser_dtdfmmcedtsubform.php";
	url=url+"?a="+str;
	url=url+"&b="+d;
	url=url+"&c="+e;
	url=url+"&h="+i;
	url=url+"&g="+j;
	url=url+"&l="+k;
	url=url+"&m="+trid;
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}
	
if(tp=="packmmc")
{ 
	var url="getuser_dtdfpackmmcform.php";
	url=url+"?a="+str;
	url=url+"&b="+d;
	url=url+"&c="+e;
	url=url+"&h="+i;
	url=url+"&g="+j;
	url=url+"&l="+k;
	url=url+"&m="+trid;
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}
	
if(tp=="mmcform")
{ 
	var url="getuser_dtdfmmcupdateform.php";
	var params=str;
	xmlHttp.open("POST", url, true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.send(params);
}
	
if(tp=="mmcupdate")
{ 
	var url="getuser_dtdfmmcupdate.php";
	var params=str;
	xmlHttp.open("POST", url, true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.send(params);
}
	
if(tp=="mmcformsubedt")
{ 
	var url="getuser_dtdfmmceditsubupdate.php";
	var params=str;
	xmlHttp.open("POST", url, true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.send(params);
}
if(tp=="showordselmmc")
	{
		var url="getuser_showorseldtdfmmc.php";
		url=url+"?a="+str;
		url=url+"&b="+d;
		url=url+"&c="+e;
		url=url+"&h="+i;
		url=url+"&g="+j;
		url=url+"&l="+k;
		url=url+"&m="+trid;
		url=url+"&n="+o;
		url=url+"&q="+p;
		url=url+"&r="+u;
		url=url+"&s="+v;
		url=url+"&sid="+Math.random();
		xmlHttp.onreadystatechange=stateChanged ;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
	
	if(tp=="showordresmmc")
	{
		var url="getuser_showorresdtdfmmc.php";
		url=url+"?a="+str;
		url=url+"&b="+d;
		url=url+"&c="+e;
		url=url+"&h="+i;
		url=url+"&g="+j;
		url=url+"&l="+k;
		url=url+"&m="+trid;
		url=url+"&n="+o;
		url=url+"&q="+p;
		url=url+"&r="+u;
		url=url+"&s="+v;
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