function check_username_init() {
  var user_field = document.getElementById('txtusername');
  return 'username_exists.php?username=' + user_field.value;
}
function check_username_ajax(results) {
  var results_div = document.getElementById('results_div');
  results_div.innerHTML = results;
}
function check_username(UName) {
  var user_field = document.getElementById('txtusername');
  if (user_field.value.length > 0) {
    //call our AJAX function in the PHP AJAX Framework
    ajaxHelper('check_username');
  }
  else {
    //clear results field 
    var results_div = document.getElementById('results_div');
    results_div.innerHTML = '';
  }
}

