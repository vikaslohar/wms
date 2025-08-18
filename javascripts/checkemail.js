function check_email_init() {
  var user_field = document.getElementById('txtemailid');
  return 'email_exists.php?emailld=' + user_field.value;
}
function check_email_ajax(results) {
  var results_div = document.getElementById('resultsemail_div');
  resultsemail_div.innerHTML = results;
}
function check_email(EId) {
  var user_field = document.getElementById('txtemailid');
  if (user_field.value.length > 0) {
    //call our AJAX function in the PHP AJAX Framework
    ajaxHelper('check_email');
  }
  else {
    //clear results field 
    var results_div = document.getElementById('resultsemail_div');
    resultsemail_div.innerHTML = '';
  }
}

