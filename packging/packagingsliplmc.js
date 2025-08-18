var xmlHttp
function showUser(str,el,tp,d,e,i,j,k,trid)
{ 
	showUser.el=el; //alert(d);
	//alert(showUser.el);
	xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
{
 alert ("Browser does not support HTTP Request");
 return;
}
 
if(tp=="item")
{
var url="getuser_stitemdrop2.php";
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

if(tp=="uspsl")
{
var url="getuser_uspsl.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="tnopinmp1")
{
var url="getuser_tnopinmp.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="wh")
{ 
var url="getuser_vbindroplmc.php";
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

if(tp=="bin")
{ 
var url="getuser_vsbindroplmc.php";
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

if(tp=="subbin")
{ 
var url="getuser_vsbinck_pronpsliplmc.php";
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

if(tp=="whnew")
{ 
var url="getuser_vbindrop_prnp1.php";
url=url+"?a="+str;
url=url+"&b="+d; 
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="binnew")
{ 
var url="getuser_vsbindrop_prnp1.php";
url=url+"?a="+str;
url=url+"&b="+d; 
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="subbinnew")
{ 
var url="getuser_vsbinck_pronpslip_prnp1.php";
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

//SMC

if(tp=="subformedtsmc")
{ 
var url="getuser_smcpackslip_vedtsubform.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mformsmc")
{ 
var url="getuser_smcpackslip_vupdateform.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
//update
if(tp=="mformsubedtsmc")
{ 
var url="getuser_smcpackslip_veditsubupdate.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}


//alert(e)
if(tp=="deletesmc")
{
var url="getuser_smcpackslip_vdelete.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="getsmc")
{
	//alert(tp); 
var url="getuser_smcpackslip_showrec.php";
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

//LMC

if(tp=="subformedtlmc")
{ 
var url="getuser_lmcpackslip_vedtsubform.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mformlmc")
{ 
var url="getuser_lmcpackslip_vupdateform.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
//update
if(tp=="mformsubedtlmc")
{ 
var url="getuser_lmcpackslip_veditsubupdate.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}


//alert(e)
if(tp=="deletelmc")
{
var url="getuser_lmcpackslip_vdelete.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="getlmc")
{
	//alert(tp); 
var url="getuser_lmcpackslip_showrec.php";
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



//MMC

if(tp=="subformedtmmc")
{ 
var url="getuser_mmcpackslip_vedtsubform.php";
url=url+"?a="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="mformmmc")
{ 
var url="getuser_mmcpackslip_vupdateform.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
//update
if(tp=="mformsubedtmmc")
{ 
var url="getuser_mmcpackslip_veditsubupdate.php";
url=url+"?"+str; 
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}


//alert(e)
if(tp=="deletemmc")
{
var url="getuser_mmcpackslip_vdelete.php";
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged ;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

if(tp=="getmmc")
{
	//alert(tp); 
var url="getuser_mmcpackslip_showrec.php";
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


//barcode search
if(tp=="barsearch")
{
var url="searchresult_barsearch.php"
url=url+"?a="+str;
url=url+"&b="+d;
url=url+"&c="+e;
url=url+"&h="+i;
url=url+"&g="+j;
url=url+"&f="+k;
url=url+"&sid="+Math.random()
xmlHttp.onreadystatechange=stateChanged
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
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