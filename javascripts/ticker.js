// Set variables
	var int_characterTimeout = 50;
	var int_storyTimeout = 5000;
	var str_leadString = "";

// Ticker startup
function startTicker() {
	// Define run time values
	int_currentStory = -1;
	int_currentLength = 0;
	// Locate base objects
	if (document.getElementById) {
		obj_anchor = document.getElementById("tickerAnchor");
		runTheTicker();
	}
	else {
		document.write("<style>.ticker_on{display:none;}.ticker_off{border:0px;padding:0px;}</style>");
		return true;
	}
}
// Ticker main run loop
function runTheTicker() {
	var int_thisTimeout;
	// Go for the next story data block
	if(int_currentLength == 0) {
		int_currentStory++;
		int_currentStory = int_currentStory % int_itemCount;
		str_storySummary = arr_storyTitles[int_currentStory].replace(/&quot;/g,'"');
		str_storyLink = arr_storyLinks[int_currentStory];
		obj_anchor.href = str_storyLink;
	}
	// Stuff the current ticker text into the anchor
	obj_anchor.innerHTML = str_leadString + str_storySummary.substring(0,int_currentLength);
	// Modify the length for the substring and define the timer
	if(int_currentLength != str_storySummary.length) {
		int_currentLength++;
		int_thisTimeout = int_characterTimeout;
	}
	else {
		int_currentLength = 0;
		int_thisTimeout = int_storyTimeout;
	}
	// Call up the next cycle of the ticker
	setTimeout("runTheTicker()", int_thisTimeout);
}
// Start the ticker
startTicker();