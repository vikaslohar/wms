var xmlHttp
function showUser(str,el,tp,d,e,i,j,k,trid,r,s,t)
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
var url="getuser_dispparty_rng.php";
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
var url="getuser_vaddresschk.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

 if(tp=="ordrno")
{
var url="getuser_orderno_rng.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

 if(tp=="barchk1")
{
var url="getuser_barchk_rng.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&h="+i;
url=url+"&g="+j;
url=url+"&l="+k;
url=url+"&m="+trid;
url=url+"&n="+r;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

 if(tp=="ordrbar")
{
var url="getuser_ordrbar_rng.php";
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

if(tp=="orderdet")
{
var url="getuser_orderdet_rng.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="bardet")
{ 
var url="getuser_dispdetshow_rng.php";
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

if(tp=="bardetupdate")
{ 
var url="getuser_dispdetupdate_rng.php";
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

//edit
if(tp=="subformedt")
{ 
var url="getuser_remedtsubform.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
//alert(tp);
if(tp=="mainformedt")
{ 
var url="getuser_dispedtsubform_rng.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&h="+i;
url=url+"&g="+j;
url=url+"&l="+k;
url=url+"&m="+trid;
url=url+"&n="+r;
url=url+"&o="+s;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mbform")
{ 
var url="getuser_dispnxtupdateform_rng.php";
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

if(tp=="mbform2")
{ 
var url="getuser_dispnxtupdateform2_rng.php";
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

if(tp=="mform")
{ 
var url="getuser_dispupdateform_rng.php";
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
var url="getuser_remeditsubupdate.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}


//alert(e)
if(tp=="delete")
{
var url="getuser_remdelete.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="showordsel")
{
var url="getuser_showorsel_rng.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&h="+i;
url=url+"&g="+j;
url=url+"&l="+k;
url=url+"&m="+trid;
url=url+"&n="+r;
url=url+"&o="+s;
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

}




function stateChanged() 
{ 
if (xmlHttp.readyState==4 )
 { 
 if(xmlHttp.status == 200) {
	// alert(showUser.el);
 document.getElementById(showUser.el).innerHTML=xmlHttp.responseText ;
// alert(document.getElementById('txtbarcod').value);
 document.getElementById('txtbarcod').focus(); 
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