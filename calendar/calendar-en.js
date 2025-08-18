// ** I18N
Calendar._DN = new Array
("Sunday",
 "Monday",
 "Tuesday",
 "Wednesday",
 "Thursday",
 "Friday",
 "Saturday",
 "Sunday");
Calendar._MN = new Array
("January",
 "February",
 "March",
 "April",
 "May",
 "June",
 "July",
 "August",
 "September",
 "October",
 "November",
 "December");

// tooltips
Calendar._TT = {};
Calendar._TT["TOGGLE"] = "Toggle first day of week";
Calendar._TT["PREV_YEAR"] = "Prev. year (hold for menu)";
Calendar._TT["PREV_MONTH"] = "Prev. month (hold for menu)";
Calendar._TT["GO_TODAY"] = "Go Today";
Calendar._TT["NEXT_MONTH"] = "Next month (hold for menu)";
Calendar._TT["NEXT_YEAR"] = "Next year (hold for menu)";
Calendar._TT["SEL_DATE"] = "Select date";
Calendar._TT["DRAG_TO_MOVE"] = "Drag to move";
Calendar._TT["PART_TODAY"] = " (today)";
Calendar._TT["MON_FIRST"] = "Display Monday first";
Calendar._TT["SUN_FIRST"] = "Display Sunday first";
Calendar._TT["CLOSE"] = "Close";
Calendar._TT["TODAY"] = "Today";

// date formats
Calendar._TT["DEF_DATE_FORMAT"] = "dd-mm-y";
Calendar._TT["TT_DATE_FORMAT"] = "D, M d";

Calendar._TT["WK"] = "wk";

// added on  20-2-2010

// JavaScript Document
//Date picket calendar functions
function selected(cal, date) {
  cal.sel.value = date; 
  if (cal.sel.id == "sel1" || cal.sel.id == "sel3")
      cal.callCloseHandler();
}

function closeHandler(cal) {
  cal.hide();                        // hide the calendar
}
function showCalendar(id) {
  var el = document.getElementById(id);
  if (calendar != null) {
    calendar.hide();                 // so we hide it first.
  } else {
    var cal = new Calendar(false, null, selected, closeHandler);
    calendar = cal;                  // remember it in the global var
    cal.setRange(1900, 2070);        // min/max year allowed.
    cal.create();
  }
  calendar.setDateFormat('d-mm-y');    // set the specified date format
  calendar.parseDate(el.value);      // try to parse the text in field
  calendar.sel = el;                 // inform it what input field we use
  calendar.showAtElement(el);        // show the calendar below it

  return false;
}