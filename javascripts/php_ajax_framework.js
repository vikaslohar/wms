function ajaxHelper(functionName, additionalArgs) {
  var xmlHttp;
  // Firefox, Opera 8.0+, Safari, SeaMonkey
  try {
    xmlHttp=new XMLHttpRequest();
  }
  catch (e) {
    // Internet Explorer
    try {
      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch (e) {
      try {
        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch (e) {
        alert("Sorry, your browser does not support AJAX.");
        return false;
      }
    }
  }
 
  xmlHttp.onreadystatechange=function() {
    //The request is complete == state 4
    if (xmlHttp.readyState==4) {
      var response=xmlHttp.responseText;
      //Send reponse to _ajax hook of passed function name
      eval(functionName + "_ajax" + '(\'' + response + '\')');
    }
  }
 
  //Get request string from _setup hook of passed function name
  if (additionalArgs !== undefined && additionalArgs.length > 0) {
    var requestString = eval(functionName+"_init" + '(' + additionalArgs + ')');
  }
  else {
    var requestString = eval(functionName+"_init" + '()');
  } 
 
  if (requestString) {
    xmlHttp.open("GET", requestString, true);
    xmlHttp.send(null);
  }
}