var activeInfoWindow;
var schoolArray = [];
//Default Bootstrap
function initAll(){
	window.map = initMap();
	
	var facilityArray = [];
	var blackspotArray = [];
	var infoArray = [];
	
	var schoolFilterArray = [];
	for(var i=0;i<4;i++) {
		schoolFilterArray[i] = [];
	}
	
	var facilityFilterArray = [];
	for(var i=0;i<5;i++) {
		facilityFilterArray[i] = [];
	}
	
	var blackspotFilterArray = [];
	
	var geocoder = new google.maps.Geocoder();
	
	loadData(map, schoolArray, schoolFilterArray, schoolList, "school");
	loadData(map, facilityArray, facilityFilterArray, facilityList, "facility", infoArray, 0);
	loadData(map, blackspotArray, blackspotFilterArray, blackspotList, "blackspot", infoArray, facilityList.length);
	initListeners(map, schoolArray, facilityArray, blackspotArray, schoolFilterArray, facilityFilterArray);
	checkGET(map, geocoder);
}

function initMap() {
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 12,
		center: {lat: 1.3675, lng: 103.8198},
		disableDefaultUI: true
	});
	return map;
}

function loadData(map, markerArray, filterArray, phpList, type, infoArray, offset) {
	var count = phpList.length;
	for(var i=0;i<count;i++) (function(i){
		
		var markerAddress = (phpList[i].location_address);
		var markerPostalcode = (phpList[i].location_postalcode);
		
		if(type == "school"){
			var markerTitle = (phpList[i].sch_name);
			var markerCategory = (phpList[i].sch_education_level);
		} else {
			if (type == 'facility') {
				var markerTitle = (phpList[i].facility_name);
				var markerCategory = (phpList[i].facility_category);
				if (markerCategory == "PARK") {
					markerAddress = "";
					markerPostalcode = "";
				}
			} else {
				var markerTitle = 'BLACKSPOT SITE';
				var markerCategory = 'BLACKSPOT';
				markerPostalcode = "";
			}
			var contentString = 
			'<div id="infoLocationIcon" class="col-xs-4">' + 
			'</div>' + 
			'<div id="infoLocationDetails" class="col-xs-8">' + 
				'<div id="infoLocationCategory">' + 
					markerCategory + 
				'</div>' + 
				'<div id="infoLocationName">' + 
					markerTitle + 
				'</div>' + 
				'<div id="infoLocationAddress">' + 
					markerAddress + 
				'</div>' + 
				'<div id="infoLocationPostalcode">' + 
					markerPostalcode + 
				'</div>'+ 
			'</div>';
			
			infoArray[i+offset] = new google.maps.InfoWindow({
			  content: contentString
			});
		}
		
		var icon = {
			url: "images/maps/"+getIcon(markerCategory)+".svg", // url
			scaledSize: new google.maps.Size(20, 20), // scaled size
			origin: new google.maps.Point(0,0), // origin
			anchor: new google.maps.Point(0, 0) // anchor
		};
		
		markerArray[i] = new google.maps.Marker({
			position: {lat: parseFloat(phpList[i].location_latitude), lng: parseFloat(phpList[i].location_longitude)},
			map: map,
			title: markerTitle,
			icon: icon
		});
		
		markerArray[i].addListener('click', function() {
			map.setZoom(17);
			map.panTo(markerArray[i].getPosition());
			
			if(type == "school"){
				showInfo(markerTitle, phpList[i].location_address, phpList[i].location_postalcode, markerCategory);
				increaseVisited();
				var modal = document.getElementById("infoModal");
				modal.style.display = "block";
			} else {
				if(activeInfoWindow){
					activeInfoWindow.close();
				}
				activeInfoWindow = infoArray[i+offset];
				infoArray[i+offset].open(map, markerArray[i]);
				document.getElementById("infoLocationIcon").innerHTML = "<img class=\"locationInfoIcon\" src=\"images/info/"+getIcon(markerCategory)+".png\">";
			}
		});
		
		markerArray[i].setVisible(false);
		markerSort(markerArray[i], filterArray, markerCategory);
		
	}(i));
}

function markerSort(marker, filterArray, category) {
	switch(category){
		case 'PRIMARY':
			filterArray[0].push(marker);
			break;
		case 'SECONDARY':
			filterArray[1].push(marker);
			break;
		case 'JUNIOR COLLEGE':
			filterArray[2].push(marker);
			break;
		case 'CENTRALISED INSTITUTE':
			filterArray[2].push(marker);
			break;
		case 'MIXED LEVEL':
			filterArray[3].push(marker);
			break;
		case 'PARK':
			filterArray[0].push(marker);
			break;
		case 'GYM':
			filterArray[1].push(marker);
			break;
		case 'WATER':
			filterArray[2].push(marker);
			break;
		case 'SPORTS':
			filterArray[3].push(marker);
			break;
		case 'COMMUNITY CENTRE':
			filterArray[4].push(marker);
			break;
		case 'BLACKSPOT':
			break;
	}
}

function initListeners(map, schoolArray, facilityArray, blackspotArray, schoolFilterArray, facilityFilterArray) {
	document.getElementById("infoCloseBtn").addEventListener("click", function(){
		document.getElementById("infoPanel").style.display = "none";
		document.getElementById("infoModal").style.display = "none";
	});
	
	document.getElementById("infoModal").addEventListener("click", function(){
		document.getElementById("infoPanel").style.display = "none";
		this.style.display = "none";
	});
	
	document.getElementById("flagModal").addEventListener("click", function(){
		document.getElementById("flagConfirm").style.display = "none";
		this.style.display = "none";
	});
	
	addMainVisibilityListeners('school', schoolList.length, schoolArray)
	addMainVisibilityListeners('facility', facilityList.length, facilityArray)
	addMainVisibilityListeners('blackspot', blackspotList.length, blackspotArray)
	
	addSubVisibilityListeners('schoolFilter', schoolFilterArray)
	addSubVisibilityListeners('facilityFilter', facilityFilterArray)
}

function addMainVisibilityListeners(name, markerCount, markerArray) {
	var mainBox = document.getElementsByName(name)[0];
	mainBox.addEventListener("click", function(){
		if (mainBox.checked == true){
			var visibility = true;
		}
		else {
			var visibility = false;
		}
		for(var i=0;i<markerCount;i++){
			markerArray[i].setVisible(visibility);
		};
	});
}

function addSubVisibilityListeners(name, markerArray) {
	var subBoxes = document.getElementsByName(name);
	for(var i=0;i<subBoxes.length;i++) (function(i) { 
		subBoxes[i].addEventListener("click", function() {
			if (subBoxes[i].checked == true){
				var visibility = true;
			} else {
				var visibility = false;
			}
			for(var j=0;j<markerArray[i].length;j++){
				markerArray[i][j].setVisible(visibility);
			};
		});
	}(i));
}

function toggleFilters(divID) {
	if(divID == "schoolGroup") {
		var mainBox = document.getElementsByName("school")[0];
		var subBoxes = document.getElementsByName("schoolFilter")
	} else {
		var mainBox = document.getElementsByName("facility")[0];
		var subBoxes = document.getElementsByName("facilityFilter")
	}
	
	if(mainBox.checked){
		var currentState = false;
		var setState = true;
	} else {
		var currentState = true;
		var setState = false;
	}
	for(var i=0;i<subBoxes.length;i++) { 
		if(subBoxes[i].checked == currentState){
			subBoxes[i].checked = setState;
		}
	}
}

function toggleSubFilters(divID) {
	if(divID == "schoolGroup") {
		var mainBox = document.getElementsByName("school")[0];
		var subBoxes = document.getElementsByName("schoolFilter")
	} else {
		var mainBox = document.getElementsByName("facility")[0];
		var subBoxes = document.getElementsByName("facilityFilter")
	}
	
	var checkCount = 0;
	
	for(var i=0;i<subBoxes.length;i++) { 
		if(subBoxes[i].checked == true){
			checkCount += 1;
		}
	}
	
	if(checkCount == subBoxes.length) {
		mainBox.checked = true;
	} else {
		mainBox.checked = false;
	}
}

function showInfo(name, address, postalcode, category) {
	var displayState = document.getElementById("infoPanel").style.display;
	if (displayState != "block") {
		document.getElementById("infoPanel").style.display = "block";
	}
	document.getElementById("locationIcon").innerHTML = "<img class=\"locationIcon\" src=\"images/info/"+getIcon(category)+".png\">";
	document.getElementById("locationCategory").innerHTML = category;
	document.getElementById("locationName").innerHTML = name;
	document.getElementById("locationAddress").innerHTML = address;
	document.getElementById("locationPostalcode").innerHTML = postalcode;
	
	getFeedback(name, 1);
	resetFeedbackSubmission();
	
	$("#infoPanel").animate({ scrollTop: 0 }, "fast");
}

function getIcon(category) {
	switch(category){
		case 'PRIMARY':
			var icon = 'school';
			break;
		case 'SECONDARY':
			var icon = 'school';
			break;
		case 'JUNIOR COLLEGE':
			var icon = 'school';
			break;
		case 'CENTRALISED INSTITUTE':
			var icon = 'school';
			break;
		case 'MIXED LEVEL':
			var icon = 'school';
			break;
		case 'PARK':
			var icon = 'park';
			break;
		case 'GYM':
			var icon = 'gym';
			break;
		case 'WATER':
			var icon = 'water';
			break;
		case 'SPORTS':
			var icon = 'sports';
			break;
		case 'COMMUNITY CENTRE':
			var icon = 'community';
			break;
		case 'BLACKSPOT':
			var icon = 'blackspot';
			break;
	};
	return icon;
}

function resetZoom() {
	window.map.setZoom(12);
	window.map.panTo({lat: 1.3675, lng: 103.8198});
}

function getSearchResults(name) {
	if(name != "") {
		var phpString = "php/getSearchResults.php?name="+name;
		ajaxRequest(phpString, getSearchResultsResponse);
	} else {
		document.getElementById("searchResults").style.display = "none";
	}
}

function getSearchResultsResponse(xmlHttpRequest) {
	document.getElementById("searchResults").innerHTML = xmlHttpRequest.responseText;
	
	document.getElementById("searchResults").style.display = "block";
	
	var resultList = document.getElementsByClassName("searchResult");
	for(var i=0;i<resultList.length;i++){
		resultList[i].addEventListener("click", function(){
			searchResultRedirect(schoolArray, this.innerHTML);
		});
	};
}

function searchResultRedirect(markerArray, name) {
	for(var i = 0; i < markerArray.length; i++) {
		if(markerArray[i].title == name) {			
			document.getElementById("search").value = "";
			document.getElementById("searchResults").style.display = "none";
			if(document.getElementsByName("school")[0].checked == false) {
				document.getElementsByName("school")[0].click();
			}
			window.map.setZoom(17);
			window.map.panTo(markerArray[i].getPosition());
		}
	}
}

function getFeedback(name, page) {
	var phpString = "php/getFeedback.php?name="+name+"&page="+page;
	ajaxRequest(phpString, getFeedbackResponse);
}

function getFeedbackResponse(xmlHttpRequest) {
	document.getElementById("locationFeedbackComments").innerHTML = xmlHttpRequest.responseText;
	initFlagListeners();
	
	var avgRating = document.getElementById("locationAverageRating").innerHTML;
	if (avgRating != "") {
		var stars = '<p>Average Rating</p>';
		var starsLeft = Math.floor(5 - avgRating);
		while(avgRating != 0) {
			if ((avgRating-1) > 0 || (avgRating-1) == 0) {
				stars += '<i class="fa fa-star" aria-hidden="true"></i> ';
				avgRating = avgRating - 1;
			} else if ((avgRating-0.5) == 0) {
				stars += '<i class="fa fa-star-half-o" aria-hidden="true"></i> ';
				avgRating = avgRating - 0.5;
			}
		}
		while (starsLeft != 0) {
			stars += '<i class="fa fa-star-o" aria-hidden="true"></i> ';
			starsLeft = starsLeft - 1;
		}
		document.getElementById("locationAverageRating").innerHTML = stars;
	}
}

function initFlagListeners() {
	var flags = document.getElementsByClassName("feedbackFlag");
	var confirmDialog = document.getElementById("flagConfirm");
	var confirmModal = document.getElementById("flagModal");
	for(var i=0;i<flags.length;i++){
		flags[i].addEventListener("click", function(){
			confirmModal.style.display = "block";
			confirmDialog.style.display = "block";
			confirmDialog.setAttribute("name", this.getAttribute("name"));
			resetFlag();
		});
	};
}

function cancelFlag() {
	document.getElementById("flagConfirm").setAttribute("name", "");
	document.getElementById("flagConfirm").style.display = "none";
	document.getElementById("flagModal").style.display = "none";
}

function confirmFlag() {
	var id = document.getElementById("flagConfirm").getAttribute("name");
	var phpString = "php/doFlagComment.php?id="+id;
	ajaxRequest(phpString, flagConfirmFeedback);
}

function resetFlag() {
	var phpString = "php/doResetFlag.php";
	ajaxRequest(phpString, flagConfirmFeedback);
}

function flagConfirmFeedback(xmlHttpRequest) {
	document.getElementById("flagConfirm").innerHTML = xmlHttpRequest.responseText;
}

function increaseVisited() {
	var name = document.getElementById("locationName").innerHTML;
	var phpString = "php/doIncreaseVisited.php?name="+name;
	ajaxRequest(phpString, flagConfirmFeedback);
}

function submitFeedback(rating, comment) {
	if (userID != "") {
		var name = document.getElementById("locationName").innerHTML;
		var phpString = "php/doAddFeedback.php?name="+name+"&rating="+rating+"&comment="+comment+"&userID="+userID;
		ajaxRequest(phpString, submitFeedbackResponse);
	} else {
		document.getElementById("locationFeedbackSubmission").innerHTML = '<p>Please login to submit feedback!</p>';
	}
}

function submitFeedbackResponse(xmlHttpRequest) {
	var name = document.getElementById("locationName").innerHTML;
	document.getElementById("locationFeedbackSubmission").innerHTML = xmlHttpRequest.responseText;
	getFeedback(name, 1);
}

function resetFeedbackSubmission() {
	var phpString = "php/doResetFeedback.php";
	ajaxRequest(phpString, resetFeedbackSubmissionResponse);
}

function resetFeedbackSubmissionResponse(xmlHttpRequest) {
	document.getElementById("locationFeedbackSubmission").innerHTML = xmlHttpRequest.responseText;
	document.getElementsByClassName("submitFeedbackBtn")[0].addEventListener("click", function(){
		var ratingButtons = document.getElementsByName("rating");
		var ratingCheck = 0;
		for(var i=0;i<ratingButtons.length;i++){
			if (ratingButtons[i].checked) {
				ratingCheck += 1;
			}
		};
		if (ratingCheck == 0) {
			document.getElementById("ratingField").style.border = "1px solid red";
		} else {
			document.getElementById("ratingField").style.border = "";
		}
	});
}

function ajaxRequest(phpFileArgument, toDoFunction) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			toDoFunction(this);
		}
	};
	xmlhttp.open("GET",phpFileArgument,true);
	xmlhttp.send();
}

function checkGET(map, geocoder) {
	if(level != "") {
		if(level != 'primary' && level != 'secondary' && level != 'tertiary') {
			return;
		}
		if (level == 'primary'){
			document.getElementsByName("schoolFilter")[0].click();
		} else if (level == 'secondary'){
			document.getElementsByName("schoolFilter")[1].click();
		} else {
			document.getElementsByName("schoolFilter")[2].click();
		}
	}
	if(postalcode != "") {
		geocoder.geocode({'address': postalcode}, function(results, status) {
          if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
			map.setZoom(17);
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
	}
}