<?php
$url =  "{$_SERVER['REQUEST_URI']}";

$escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
$split = explode("=", $escaped_url);
$escaped_url = $split[1];
echo '<a href="' . $escaped_url . '">' . $escaped_url . '</a>';
?>
<!DOCTYPE html> 
<html> 
<body>

<p id="selectedVideo"><?php echo $escaped_url;?></p>

 <label for="myfile">Select a video:</label>
<input type="file" id="myfile" name="myfile" onchange="loadVideo(this.value)"> 
<br>

 <label for="mysubs">Select an srt:</label>
<input type="file" id="mysubs" name="mysubs" onchange="loadSubtitles(this.value)"> 

<video id="myVideo" width="320" height="176">
  <source id="source" src= type="video/mp4">
  <source src="mov_bbb.ogg" type="video/ogg">
  <track id="track" label="English" kind="subtitles" srclang="en">
  <track id="track2" label="Bible" kind="subtitles" srclang="en" src="bible-subs.vtt" default>
  Your browser does not support HTML5 video.
</video>
<button onclick="play()">play</button>
<p>Playback position: <span id="demo"></span></p>
<p>Playback position: <span id="demo"></span></p>

<p>Title: <span id="title"></span></p>
<p>subs: <span id="subs"></span></p>
<script>
var filename = document.getElementById("selectedVideo").innerHTML;
var vid = document.getElementById("myVideo");
var source = document.getElementById('source');
var track =  document.getElementById("track");
var path = "../videos/" + filename;
 var newStr = filename.slice(0,-4);
  var subtitle = newStr + ".vtt";
  var subpath = "../videos/" + subtitle;
  source.setAttribute('src', path);
  track.src = subpath;
  vid.load();
function loadVideo(filename){
  var string = filename.split("\\");
  var title = string[2];
  var path = "../videos/" + title;
  var newStr = title.slice(0,-4);
  var subtitle = newStr + ".vtt";
  var subpath = "../videos/" + subtitle;
  source.setAttribute('src', path);
  track.src = subpath;
  document.getElementById("title").innerHTML = source.getAttribute("src");

  vid.load();
}

function loadSubtitles(filename){
  var string = filename.split("\\");
  var title = string[2];
  var path = "../videos/" + title;
  track.setAttribute('src', path);
  document.getElementById("subs").innerHTML = track.getAttribute("src");
  vid.load();
}

function play(){
  document.getElementById("subs").innerHTML = track.getAttribute("src");
  vid.play();
}
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

