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
 
 
if(tp=="cltnonew")
{
	var url="getuser_cltno.php";
	url=url+"?a="+str;
	url=url+"&b="+d;
	url=url+"&c="+e;
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

if(tp=="pltnonew")
{
	var url="getuser_pltno.php";
	url=url+"?a="+str;
	url=url+"&b="+d;
	url=url+"&c="+e;
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
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
	var url="getuser_vsbinck_pronpslip.php";
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


if(tp=="slocsyncshow")
{ 
	var url="getuser_lotpackaging_barsync.php";
	url=url+"?a="+str;
	url=url+"&b="+d;
	url=url+"&c="+e;
	url=url+"&f="+i;
	url=url+"&g="+j;
	url=url+"&h="+k; 
	url=url+"&l="+trid; 
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

if(tp=="slsynchk")
{ 
	var url="getuser_smcpackslip_slsynchk.php";
	url=url+"?a="+str;
	url=url+"&b="+d; 
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

if(tp=="mformsmcbarcsl")
{ 
	var url="getuser_smcpackslip_vupdatebarcsl.php";
	var params=str;
	xmlHttp.open("POST", url, true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", params.length);
	xmlHttp.setRequestHeader("Connection", "close");
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.send(params);
	
	/*var url="getuser_smcpackslip_vupdatebarcsl.php";
	url=url+"?"+str; 
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);*/
}

//edit
if(tp=="subformedt")
{ 
	var url="getuser_pronpslip_vedtsubform.php";
	url=url+"?a="+str;
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

if(tp=="mform")
{ 
	var url="getuser_pronpslip_vupdateform.php";
	url=url+"?"+str; 
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}
//update
if(tp=="mformsubedt")
{ 
	var url="getuser_pronpslip_veditsubupdate.php";
	url=url+"?"+str; 
	url=url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}


//alert(e)
if(tp=="delete")
{
	var url="getuser_pronpslip_vdelete.php";
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
	var url="getuser_pronpslip_showrec.php";
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
	if(xmlHttp.readyState==4 )
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