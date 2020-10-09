<?php
ob_start();

	//Create a database connection
	/*Note: The search is much faster if the connection to the database is made 
	when the page loads.
	*/
	require 'createconnection.php';
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta name="keywords" content="deaf, translation, learn">
	<meta name="description" content="A south african sign language video dictionary 
	for the Rhema Church sign language course. ">
	<title>Fabulous SASL | Rhema Church Sign Language Course Video Dictionary</title>

<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="mysasl.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oxygen">

<!--Link to Font Awesome icons-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

<!--Favicon-->
<link rel="shortcut icon" type="image/x-icon" href="https://mysasl.com/mysasl1.png">

		<!--The Shiv. This allows older Internet Explorer browsers to undertsand the new elements
	introduced in HTML5. Elements like section and nav. Although it's inside comments, older
	browsers can read it.-->
	<!--[if lt IE 9]> 
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js">
  </script>
  <![endif]-->

<!--The following Javascript code disables the Enter key
so the page does not reload if the user presses the Enter key.-->

<script type="text/javascript"> 

function stopRKey(evt) { 
  var evt = (evt) ? evt : ((event) ? event : null); 
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
} 

document.onkeypress = stopRKey; 

</script>

<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Oxygen", helvetica, arial, sans-serif}

h1 {font-size: 20px}
</style>

</head>


<body class="w3-white">

<!-- w3-content defines a container for fixed size centered content,
and is wrapped around the whole page content. -->
<div class="w3-content w3-white" style="max-width:1200px">

<!--1. HOME PAGE TAB-->

<div class="tabbed" id="frontpage">

<header class="header-style add-margin header1 w3-padding radius-border1">
	<h1 class="set-display1 w3-text-white w3-margin-left space-letters set-size"><b><span class="w3-text-yellow">&#10048;</span> Fabulous SASL</b></h1>
	<!--<h5 class="set-display1 space-letters w3-right w3-text-yellow w3-margin-right w3-padding w3-round"><b>Sign Language Video Dictionary</b></h5>-->
</header>


<!--========================-->
<!--CELLPHONE SCREEN HEADER
<div class="add-margin1 w3-container header2 w3-margin-top w3-tag w3-pale-red">
	<h3 class="w3-text-indigo space-letters w3-margin-0"><b><span class="w3-text-red">&#10048;</span> Fabu!ous SASL</b></h3>
	
</div>-->

<!--=======================-->





<!--Video Screen & Controls-->
<div id="videoscreen">

<div class="add-margin1 video-screen w3-round w3-padding-top">
	<div class="" style="text-align:center">

		<video autoplay src="Videos/youarewelcome.mp4" preload="auto" ondurationchange="insertSpin()" oncanplaythrough="videoReady()" id="video1" class="w3-black w3-card-4" >
    <!--The logo3.mp4 video is set to preload when the page loads-->
    
    Sorry, your Internet browser does not support HTML5 video. In other words - your Internet browser is a bit old. To make this problem magically disappear, simply return to this site using the latest version of Firefox, Google Chrome, Safari or Internet Explorer. 
  	</video>
  
  	<div id="statusmessage">
  	</div><br>
  
  	<button class="w3-btn w3-border w3-round w3-large w3-pale-red space-letters w3-margin-right w3-margin-top" onclick="playVideo()">Play <i class="fa fa-play" style="font-size:18px"></i></button>
  	
  	<button class="w3-btn w3-border w3-round w3-large w3-pale-red space-letters
  	w3-margin-right w3-margin-top" onclick="playSlow()">Play Slow <i class="fa fa-forward" style="font-size:18px"></i></button>
  
  	<button class="w3-btn w3-border w3-round w3-large w3-pale-red space-letters w3-margin-top" onclick="pauseVideo()"> <i class="fa fa-pause" style="font-size:18px"></i></button>
  
	</div>
	
	
<script>

function newvideo() {
	document.getElementById("video3").src = "vid1.mp4";
}


var myVideo = document.getElementById("video1");

function pauseVideo() {
	myVideo.pause();
}

function playVideo() {

		myVideo.playbackRate = 1;
    myVideo.play();
    
}


function playSlow() {

		myVideo.playbackRate = 0.3;
    myVideo.play();
    
}


function insertSpin() {

//alert("Starting to load video");

	document.getElementById("statusmessage").innerHTML = '<h5 class="set-display1"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i></h5>';
}

function videoReady() {
	document.getElementById("statusmessage").innerHTML = "";
}


</script>

</div>

</div>



<!-- SEARCH AREA-->
<div class="w3-center w3-round form-width add-padding2" style="margin: 0 auto">

<div class="" style="max-width:960px;position:relative">

	<div class="w3-display-container w3-padding-large">
  	<form>
  	<!--Note: The Enter key has been disabled using Javascript
  	code that's been placed in the head section. Not doing this
  	causes the page to reload if the user presses Enter.-->
  	
				<label class="w3-label w3-text-pink w3-xlarge w3-left"><b><i class="fa fa-search" style=""></i> Enter a word</b></label>
				<div class="w3-padding-8">
				
				<!--NOTE: Including a placeholder makes the input field non responsive (does not auto scale) in cellphones - when rotating from landscape back to portrait. Therefore, leave the placeholder blank-->
					<input onkeyup="ajaxSearch(searchWordID.value)" class="w3-input w3-border" type="text" placeholder="" id="searchWordID">
				</div>
				
				<!--Search response appears here-->
				<div class="w3-left-align w3-container w3-pale-red w3-text-indigo" id="searchResponse">
					
				</div>
			
			</form>
	</div>
</div>
</div>


<script>
//AJAX SECTION

	function ajaxSearch(searchWordID) {
	
		var xhttp;
		
  	if (window.XMLHttpRequest) {
    	// code for modern browsers
    	xhttp = new XMLHttpRequest();
    } else {
    	// code for IE6, IE5
    	xhttp = new ActiveXObject("Microsoft.XMLHTTP");
 	 	}
		
		
		//Check if empty form fields were submitted. If so don't do anything
		if (searchWordID.length == "") {
			//document.getElementById("demo1").innerHTML = "";
			return;
			
		} else {
		
		//Clear the form fields
		//document.getElementById("searchWordID").value = "";
		
		
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById("searchResponse").innerHTML = xhttp.responseText;
			}
		};
		//Just like for GET but without the question mark ?
		var parameters = "&searchWordID=" + searchWordID;
		
		xhttp.open("POST", "videosearchAjax.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(parameters);
		}
	}

	
</script>



<footer class="header1 radius-border w3-container w3-light-grey  w3-border w3-margin-right w3-margin-left w3-padding">
	<small class="w3-text-pink space-letters set-display1 w3-left">South African Sign Language</small>
	<small class="w3-text-pink space-letters w3-right set-display1">Rhema Church Sign Language Course</small>
</footer>

<!--======================-->
<!--CELLPHONE SCREEN FOOTER-->
<footer class="header2 w3-container w3-pale-red w3-padding w3-margin-bottom">
	<small class="w3-text-pink space-letters set-display1 w3-left"><b>mySASL.com</b></small>
	<small class="w3-text-indigo space-letters w3-right set-display1"><b>Rhema Church Sign Language Course</b></small>
</footer>
<!--======================-->


</div><!--END OF HOME PAGE TAB-->



</body>
</html>

<?php
ob_flush();
?>