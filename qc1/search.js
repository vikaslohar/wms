var xmlHttp1
function searchUser(str,el,tp,a,b,c,d,e,f,g,h,i,j,k,l,m,n,a1,a2)
{
 searchUser.el=el;
 xmlHttp1=GetXmlHttpObject()
 
if (xmlHttp1==null)
{
	alert ("Browser does not support HTTP Request")
	return
}

if(tp=="binserch")
{
	var url="searchresult_binserch.php"
	url=url+"?o="+str
	url=url+"&p="+a
	url=url+"&q="+b
	url=url+"&r="+c
	url=url+"&s="+d
	url=url+"&t="+e
	url=url+"&u="+f
	url=url+"&v="+g
	url=url+"&w="+h
	url=url+"&x="+i
	url=url+"&y="+j
	url=url+"&z="+k
	url=url+"&z1="+a1
	url=url+"&z2="+a2
	url=url+"&sid="+Math.random()
	xmlHttp1.onreadystatechange=stateChanged1
	xmlHttp1.open("GET",url,true)
	xmlHttp1.send(null)
}

if(tp=="lotserch")
{
	var url="searchresult_lotserch1.php"
	url=url+"?o="+str
	url=url+"&p="+a
	url=url+"&q="+b
	url=url+"&r="+c
	url=url+"&s="+d
	url=url+"&t="+e
	url=url+"&u="+f
	url=url+"&v="+g
	url=url+"&w="+h
	url=url+"&x="+i
	url=url+"&y="+j
	url=url+"&z="+k
	url=url+"&z1="+a1
	url=url+"&z2="+a2
	url=url+"&sid="+Math.random()
	xmlHttp1.onreadystatechange=stateChanged1
	xmlHttp1.open("GET",url,true)
	xmlHttp1.send(null)
}

if(tp=="couserch")
{
	var url="searchresult_courier.php"
	url=url+"?q="+str
	url=url+"&sid="+Math.random()
	xmlHttp1.onreadystatechange=stateChanged1
	xmlHttp1.open("GET",url,true)
	xmlHttp1.send(null)
}

if(tp=="insursearch")
{
	var url="searchresult_insurance.php"
	url=url+"?q="+str
	url=url+"&sid="+Math.random()
	xmlHttp1.onreadystatechange=stateChanged1
	xmlHttp1.open("GET",url,true)
	xmlHttp1.send(null)
}

if(tp=="cfasearch")
{
	var url="searchresult_cfamaster.php"
	url=url+"?q="+str
	url=url+"&sid="+Math.random()
	xmlHttp1.onreadystatechange=stateChanged1
	xmlHttp1.open("GET",url,true)
	xmlHttp1.send(null)
}

if(tp=="companysearch")
{
	var url="searchresult_com.php"
	url=url+"?q="+str
	url=url+"&sid="+Math.random()
	xmlHttp1.onreadystatechange=stateChanged1
	xmlHttp1.open("GET",url,true)
	xmlHttp1.send(null)
}

if(tp=="productsearch")
{
	var url="searchresult_pro.php"
	url=url+"?q="+str
	url=url+"&proid="+a
	url=url+"&sid="+Math.random()
	xmlHttp1.onreadystatechange=stateChanged1
	xmlHttp1.open("GET",url,true)
	xmlHttp1.send(null)
}

if(tp=="transsearch")
{
	var url="searchresult_trans.php"
	url=url+"?q="+str
	url=url+"&trtype="+a
	url=url+"&sid="+Math.random()
	xmlHttp1.onreadystatechange=stateChanged1
	xmlHttp1.open("GET",url,true)
	xmlHttp1.send(null)
}

if(tp=="transRatesearch")
{
	var url="searchresult_transRate.php"
	url=url+"?q="+str
	url=url+"&sid="+Math.random()
	xmlHttp1.onreadystatechange=stateChanged1
	xmlHttp1.open("GET",url,true)
	xmlHttp1.send(null)
}

if(tp=="disserch")
{
	var url="searchresult_distributor.php"
	url=url+"?q="+str
	url=url+"&sid="+Math.random()
	xmlHttp1.onreadystatechange=stateChanged1
	xmlHttp1.open("GET",url,true)
	xmlHttp1.send(null)
}

if(tp=="agentsearch")
{
	var url="searchresult_agent.php"
	url=url+"?q="+str
	url=url+"&sid="+Math.random()
	xmlHttp1.onreadystatechange=stateChanged1
	xmlHttp1.open("GET",url,true)
	xmlHttp1.send(null)
}

if(tp=="rtosearch")
{
	var url="searchresult_rtoagent.php"
	url=url+"?q="+str
	url=url+"&sid="+Math.random()
	xmlHttp1.onreadystatechange=stateChanged1
	xmlHttp1.open("GET",url,true)
	xmlHttp1.send(null)
}

if(tp=="expsearch")
{
	var url="searchresult_exp.php"
	url=url+"?q="+str
	url=url+"&sid="+Math.random()
	xmlHttp1.onreadystatechange=stateChanged1
	xmlHttp1.open("GET",url,true)
	xmlHttp1.send(null)
}

if(tp=="cfacomsearch")
{
	var url="company.php"
	url=url+"?q="+str
	url=url+"&sid="+Math.random()
	xmlHttp1.onreadystatechange=stateChanged1
	xmlHttp1.open("GET",url,true)
	xmlHttp1.send(null)
}

if(tp=="vehiclesearch")
{
	var url="searchresult_vehicle1.php"
	url=url+"?q="+str
	url=url+"&sid="+Math.random()
	xmlHttp1.onreadystatechange=stateChanged1
	xmlHttp1.open("GET",url,true)
	xmlHttp1.send(null)
}

if(tp=="vehiclemastsearch")
{
	var url="searchresult_vehiclemaster.php"
	url=url+"?q="+str
	url=url+"&sid="+Math.random()
	xmlHttp1.onreadystatechange=stateChanged1
	xmlHttp1.open("GET",url,true)
	xmlHttp1.send(null)
}

if(tp=="zonesearch")
{
	var url="searchresult_zone.php"
	url=url+"?q="+str
	url=url+"&sid="+Math.random()
	xmlHttp1.onreadystatechange=stateChanged1
	xmlHttp1.open("GET",url,true)
	xmlHttp1.send(null)
}

}
function stateChanged1()
{
	if (xmlHttp1.readyState==4 || xmlHttp1.readyState=="complete")
	{
		document.getElementById(searchUser.el).innerHTML=xmlHttp1.responseText
	}
}
function GetXmlHttpObject()
{
var xmlHttp1=null;
	
if (xmlHttp1 != null && xmlHttp1.readyState != 0 && xmlHttp1.readyState != 4)
 {
   xmlHttp1.abort();
 } 
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp1=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 	try
	{
  		xmlHttp1=new ActiveXObject("Msxml2.XMLHTTP");
  	}
 	catch (e)
  	{
 		 xmlHttp1=new ActiveXObject("Microsoft.XMLHTTP");
  	}
 }
return xmlHttp1;
}
