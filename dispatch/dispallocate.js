var xmlHttp
function showUser(str,el,tp,d,e,i,j,k,trid,o,p,s,t,x,y,z)
{ 
	showUser.el=el; 
	//alert(showUser.el);
	xmlHttp=GetXmlHttpObject();
	
	if(xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request");
		return;
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
		var url="getuser_disallocpparty.php";
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
		var url="getuser_orderno.php";
		url=url+"?a="+str;
		url=url+"&sid="+Math.random();
		xmlHttp.onreadystatechange=stateChanged ;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
	
	if(tp=="barchk1")
	{
		var url="getuser_barchkalloc.php";
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
	
	if(tp=="barchk2")
	{
		var url="getuser_barchkalloc2.php";
		url=url+"?a="+str;
		url=url+"&b="+d;
		url=url+"&c="+e;
		url=url+"&h="+i;
		url=url+"&g="+j;
		url=url+"&l="+k;
		url=url+"&m="+trid;
		url=url+"&n="+o;
		url=url+"&q="+p;
		url=url+"&r="+s;
		url=url+"&sid="+Math.random();
		xmlHttp.onreadystatechange=stateChanged ;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
	
	if(tp=="barchk3")
	{
		var url="getuser_barchkalloc3.php";
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
	
	if(tp=="barchkmmc")
	{
		var url="getuser_barchkmmc.php";
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
	
	if(tp=="ordrbar")
	{
		var url="getuser_ordrbaralloc.php";
		url=url+"?a="+str;
		url=url+"&b="+d;
		url=url+"&c="+e;
		url=url+"&h="+i;
		url=url+"&g="+j;
		url=url+"&l="+k;
		url=url+"&m="+trid;
		url=url+"&n="+o;
		url=url+"&q="+p;
		url=url+"&r="+s;
		url=url+"&sid="+Math.random();
		xmlHttp.onreadystatechange=stateChanged ;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
	
	if(tp=="unalordrbar")
	{
		var url="getuser_ordrbarunalloc.php";
		url=url+"?a="+str;
		url=url+"&b="+d;
		url=url+"&c="+e;
		url=url+"&h="+i;
		url=url+"&g="+j;
		url=url+"&l="+k;
		url=url+"&m="+trid;
		url=url+"&n="+o;
		url=url+"&q="+p;
		url=url+"&r="+s;
		url=url+"&sid="+Math.random();
		xmlHttp.onreadystatechange=stateChanged ;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
	
	if(tp=="fralordrbar")
	{
		var url="getuser_ordrbarfralloc.php";
		url=url+"?a="+str;
		url=url+"&b="+d;
		url=url+"&c="+e;
		url=url+"&h="+i;
		url=url+"&g="+j;
		url=url+"&l="+k;
		url=url+"&m="+trid;
		url=url+"&n="+o;
		url=url+"&q="+p;
		url=url+"&r="+s;
		url=url+"&sid="+Math.random();
		xmlHttp.onreadystatechange=stateChanged ;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
	
	
	if(tp=="lotshow")
	{
		var url="getuser_dalloclotshow.php";
		url=url+"?a="+str;
		url=url+"&b="+d;
		url=url+"&c="+e;
		url=url+"&h="+i;
		url=url+"&g="+j;
		url=url+"&l="+k;
		url=url+"&m="+trid;
		url=url+"&n="+o;
		url=url+"&q="+p;
		url=url+"&r="+s;
		url=url+"&u="+t;
		url=url+"&sid="+Math.random();
		xmlHttp.onreadystatechange=stateChanged ;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
	
	if(tp=="lotshowmmc")
	{
		var url="getuser_dalloclotshowmmc.php";
		url=url+"?a="+str;
		url=url+"&b="+d;
		url=url+"&c="+e;
		url=url+"&h="+i;
		url=url+"&g="+j;
		url=url+"&l="+k;
		url=url+"&m="+trid;
		url=url+"&n="+o;
		url=url+"&q="+p;
		url=url+"&r="+s;
		url=url+"&u="+t;
		url=url+"&sid="+Math.random();
		xmlHttp.onreadystatechange=stateChanged ;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
	
	if(tp=="orderdet")
	{
		var url="getuser_orderdetalloc.php";
		url=url+"?a="+str;
		url=url+"&sid="+Math.random();
		xmlHttp.onreadystatechange=stateChanged ;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
	
	if(tp=="bardet")
	{ 
		var url="getuser_bardetshow.php";
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
		var url="getuser_bardetupdate.php";
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
		var url="getuser_dallocdtsubsubform.php";
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
	
	if(tp=="subformedtmmc")
	{ 
		var url="getuser_dallocmmcdtsubsubform.php";
		url=url+"?a="+str;
		url=url+"&b="+d;
		url=url+"&c="+e;
		url=url+"&h="+i;
		url=url+"&g="+j;
		url=url+"&l="+k;
		url=url+"&m="+trid;
		url=url+"&n="+o;
		url=url+"&q="+p;
		url=url+"&r="+s;
		url=url+"&u="+t;
		url=url+"&sid="+Math.random();
		xmlHttp.onreadystatechange=stateChanged ;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
	
	if(tp=="mainformedtmmc")
	{ 
		var url="getuser_dallocmmcedtsubform.php";
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
	
	//alert(tp);
	if(tp=="mainformedt")
	{ 
		var url="getuser_dallocedtsubform.php";
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
	
	if(tp=="mbform")
	{ 
		var url="getuser_dallocnxtupdateform.php";
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
	
	if(tp=="mbform2")
	{ 
		var url="getuser_dallocnxtupdateform2.php";
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
		var url="getuser_dallocpackmmcform.php";
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
		var url="getuser_dallocupdateform.php";
		var params=str;
		xmlHttp.open("POST", url, true);
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.setRequestHeader("Content-length", params.length);
		xmlHttp.setRequestHeader("Connection", "close");
		xmlHttp.onreadystatechange=stateChanged ;
		xmlHttp.send(params);
	}
	
	if(tp=="mformbarcode")
	{ 
		var url="getuser_dallocupdateform2.php";
		var params=str;
		xmlHttp.open("POST", url, true);
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.setRequestHeader("Content-length", params.length);
		xmlHttp.setRequestHeader("Connection", "close");
		xmlHttp.onreadystatechange=stateChanged ;
		xmlHttp.send(params);
	}
	
	if(tp=="mformbarcode3")
	{ 
		var url="getuser_dallocupdateform3.php";
		var params=str;
		xmlHttp.open("POST", url, true);
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.setRequestHeader("Content-length", params.length);
		xmlHttp.setRequestHeader("Connection", "close");
		xmlHttp.onreadystatechange=stateChanged ;
		xmlHttp.send(params);
	}
	
	if(tp=="mmcform")
	{ 
		var url="getuser_dallocmmcupdateform.php";
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
		var url="getuser_dallocmmcupdate.php";
		var params=str;
		xmlHttp.open("POST", url, true);
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.setRequestHeader("Content-length", params.length);
		xmlHttp.setRequestHeader("Connection", "close");
		xmlHttp.onreadystatechange=stateChanged ;
		xmlHttp.send(params);
	}
	
	if(tp=="mformbar")
	{ 
		var url="getuser_dallocbarcupdateform.php";
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
		var url="getuser_dalloceditsubupdate.php";
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
		var url="getuser_dallocmmceditsubupdate.php";
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
		var url="getuser_dallocdelete.php";
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
		var url="getuser_showorselalloc.php";
		url=url+"?a="+str;
		url=url+"&b="+d;
		url=url+"&c="+e;
		url=url+"&h="+i;
		url=url+"&g="+j;
		url=url+"&l="+k;
		url=url+"&m="+trid;
		url=url+"&n="+o;
		url=url+"&sid="+Math.random();
		xmlHttp.onreadystatechange=stateChanged ;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
	
	if(tp=="showordselmmc")
	{
		var url="getuser_showorselallocmmc.php";
		url=url+"?a="+str;
		url=url+"&b="+d;
		url=url+"&c="+e;
		url=url+"&h="+i;
		url=url+"&g="+j;
		url=url+"&l="+k;
		url=url+"&m="+trid;
		url=url+"&n="+o;
		url=url+"&q="+p;
		url=url+"&r="+s;
		url=url+"&u="+t;
		url=url+"&sid="+Math.random();
		xmlHttp.onreadystatechange=stateChanged ;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
	
	if(tp=="showordresmmc")
	{
		var url="getuser_showorresallocmmc.php";
		url=url+"?a="+str;
		url=url+"&b="+d;
		url=url+"&c="+e;
		url=url+"&h="+i;
		url=url+"&g="+j;
		url=url+"&l="+k;
		url=url+"&m="+trid;
		url=url+"&n="+o;
		url=url+"&q="+p;
		url=url+"&r="+s;
		url=url+"&u="+t;
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
		if(xmlHttp.status == 200) 
		{
		// alert(showUser.tp);
		document.getElementById(showUser.el).innerHTML=xmlHttp.responseText ;
		// alert(document.getElementById('txtbarcod').value);
		if(showUser.el=="barcwise"){
		document.getElementById('txtbarcod').focus(); 
		//alert(document.getElementById('txtbarcod').value);
		}
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