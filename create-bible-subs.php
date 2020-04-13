<?php

$length = 240;
$id = "1";
$start = "00:00:00.000"; 
$to = "-->";
$end = " 00:01:00,000";

$words = "Is that you on the beach?";
$toString = $id . "\n" . $start . "\n" . $to . "\n" . $end . "\n" . $words . "\n\n";

/*
file = open("bible.json", "r")
json_data = json.load(file)
*/

// Get the contents of the JSON file 
$strJsonFileContents = file_get_contents("bible.json");
// Convert to array 
$json_data = json_decode($strJsonFileContents, true);

$totalVerses = 31102;

function getCurrentID(){
  date_default_timezone_set("Pacific/Auckland");
  $originalDate = strtotime("2018-06-23 14:45:00");
  $dateToday = date("Y-m-d H:i");
  $currentDate = strtotime("now");	
  $difference_in_minutes = round(($currentDate-$originalDate)/60)+1;
   $id = $difference_in_minutes;
   while ($id>31102){
      $id = $id-31102;
   }
   return $id;
}  


function getBooks($json_data){
  $verses = $json_data["bible"];
  $books = array();
  
  foreach($verses as $verse){
    $book = $verse["book"];
    array_push($books, $book);
    /*if (in_array($book, $books)){
      echo "already";
    }else{
       array_push($books, book));
    }*/
  }
  $books = array_unique($books);
  echo count($books);
  echo "<br>";
  return $books;
}
echo getCurrentID();
//echo $json_data;
echo "<br>";
echo count(getBooks($json_data));
echo "<br>";

function getBibleTopic($topic, $json_data){
  $verses = array();
  //echo "topic: " . $topic;  
  $bible = $json_data["bible"];
  //echo $bible;
  
  foreach($bible as $item){
        $verse = $item["word"];
        if (strpos(strtolower($verse), strtolower($topic))==true){
           array_push($verses, $item);
    //       echo $verse;
        }
  }		   
  return $verses;
 }

//$topic = "Jesus";
//echo count(getBibleTopic($topic, $json_data));

 
function getBookVerses($bookTitle, $json_data){
    $verses = array();
    $bible = $json_data["bible"];
    $bookTitle = strtolower($bookTitle);
    foreach ($bible as $item){
        $book = strtolower($item["book"]);
        
        if ($book==$bookTitle){
           array_push($verses, $item);
           echo $verse;
        }
    }   
    return $verses;
}

$booktitle = "Matthew";
//getBookVerses($booktitle, $json_data);


$bible = array();
$choice = "book";

if ($choice==="book"){
 $topic = "Matthew";
 $bible = getBookVerses($topic, $json_data);
}
else{  
 $topic = "love";
 $bible = getBibleTopic($topic, $json_data);  
}

$totalVerses = count($bible);

echo "total verses: " . $totalVerses;

  
function getVerse($id, $bible){

	$verse = $bible[$id-1];
	return $verse;
}

//echo getVerse(3, $bible);

   
function convertToHoursMins($time, $format = '%02d:%02d') {
    echo "<br>";
    if ($time < 1) {
        return "00:00:00.000";
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

//echo convertToHoursMins(121, '%02d:%02d:00.000');

/*
function getMinute($minutes){
    echo "<br>";
    echo "minute: " . date('H:m:i', mktime(0,1));
    //echo "hello";

   //$result = '{:02d}:{:02d}:00,000'.format(*divmod(minutes, 60 ));
   //return $result;
 
}

getMinute(1);
*/

$myfile = fopen("bible-subs.vtt", "w") or die("Unable to open file!");


$currentID =  getCurrentID(); 
$subtitles = "WEBVTT";
fwrite($myfile, $subtitles);
fwrite($myfile, "\r\n\r\n");
echo "<br>";
echo $subtitles;
echo "<br><br>";
$substrings = "";
//echo "<br>current id: " . $currentID;

for ($i=1; $i<=$length; $i++){
	$id = $i;
	$currentID = $currentID + 1;
	if ($currentID>$totalVerses){
	  $currentID = 1;
        }
        echo "<br>" . $id . "<br>";
        fwrite($myfile, $id);
        fwrite($myfile, "\r\n");
	$start = convertToHoursMins($i-1, '%02d:%02d:00.000');
	$end = convertToHoursMins($i, '%02d:%02d:00.000');
        $time = $start .  " " . $to . " " . $end;
        fwrite($myfile, $time);
        fwrite($myfile, "\r\n");        
        echo $time . "<br>";
	$verse = getVerse($currentID, $bible);	
	$words = $verse["word"] . " " . $verse["book"] . " " . $verse["chapter"] . ":" . $verse["verse"];
 	echo $words . "<br>";
        fwrite($myfile, $words);
        fwrite($myfile, "\r\n\r\n"); 
        //$toString = $i . "\r\n" . $time . "\r\n" . $words . "\r\n\r\n";
        //$substrings .= $toString;
       
}

fclose($myfile); 
//$subtitles .= "\r\n\r\n" . $substrings;


/*




*/
//echo $substrings;

/*
outfile = open("bible-subtitles.srt", "w")
outfile.write(subtitles)
outfile.close()
assfile = "bible-subtitles.ass"
convertoass =  "ffmpeg -i bible-subtitles.srt " + assfile
subprocess.call(convertoass, shell=True)

subprocess.call(command, shell=True)
*/
?>
