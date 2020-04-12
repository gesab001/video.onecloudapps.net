<!DOCTYPE html> 
<html> 
<body> 

<button onclick="getCurTime()" type="button">Get current time position</button>
<button onclick="setCurTime()" type="button">Set time position to 5 seconds</button><br> 

<video id="myVideo" width="320" height="176" controls>
  <source src="../videos/rooster.mp4" type="video/mp4">
  <source src="mov_bbb.ogg" type="video/ogg">
   <track label="English" kind="subtitles" srclang="en" src="../videos/bible-subtitles.vtt" default>
  Your browser does not support HTML5 video.
</video>
<p>Playback position: <span id="demo"></span></p>
<p>Playback position: <span id="demo"></span></p>


<script>
var vid = document.getElementById("myVideo");

function getCurTime() { 
  alert(vid.currentTime);
} 

function setCurTime() { 
  vid.currentTime=5;
} 


// Assign an ontimeupdate event to the video element, and execute a function if the current playback position has changed
vid.ontimeupdate = function() {myFunction()};

function myFunction() {
  // Display the current position of the video in a p element with id="demo"
  document.getElementById("demo").innerHTML = vid.currentTime;
  if (vid.currentTime>3){
     vid.muted = true;
  }
  if (vid.currentTime>7){
     vid.muted = false;
  }
  
}
</script> 

<p>Video courtesy of <a href="../videos/rooster.mp4" target="_blank">Big Buck Bunny</a>.</p>

</body> 
</html>

