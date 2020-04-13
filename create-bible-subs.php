<?php
/*
length = 240
id = "1"
start = "00:00:00,000" 
to = "-->"
end = " 00:01:00,000"
words = "Is that you on the beach?"
toString = id + "\n" + start + "\n" + to + "\n" + end + "\n" + words + "\n\n"


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
  $books = array("Genesis");
  
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
  //echo count($books);
  return $books;
}
echo getCurrentID();
//echo $json_data;
echo count(getBooks($json_data));


function getBibleTopic($topic){
  $verses = [];  
  if ($topic=="all"){
    $verses = $json_data["bible"];
  }
  else{
    $bible = json_data["bible"];
    foreach($bible as $item){
        $verse = $item["word"];
        if (strpos($, $topic)==true){
           array_push($verses, $item);
           echo $verse;
        }
    }
  }		   
  return $verses;
 }
/* 
def getBookVerses(bookTitle):
    verses = []
    bible = json_data["bible"]
    for item in bible:
        verse = item["book"]
        if bookTitle.lower() in verse.lower():
           verses.append(item)
           print(verse)		   
    return verses
bible = []
choice = input("topic or book: ")

if choice=="book":
 books = getBooks()
 topic = input("book name: " )
 for book in books:
  if topic.lower() == book.lower():
   bookName = book
   bible = getBookVerses(bookName)
else:  
 topic = input("topic: " )
 bible = getBibleTopic(topic)  

totalVerses = len(bible)
  
def getVerse(id):

	verse = bible[id-1]
	return verse
   
def getMinute(minutes):
   result = '{:02d}:{:02d}:00,000'.format(*divmod(minutes, 60 ))
   return result
 
currentID =  getCurrentID() 
subtitles = ""
for i in range(1, length, 1):
	id = str(i)
	start = getMinute(i-1)
	end = getMinute(i)
	verse = getVerse(currentID)	
	words = verse["word"] + " " + verse["book"] + " " + str(verse["chapter"]) + ":" + str(verse["verse"])
	toString = id + "\n" + start + " " + to + " " + end + "\n" + words + "\n\n"
	print(toString)
	currentID = currentID + 1
	if currentID>totalVerses:
	  currentID = 1
	subtitles = subtitles + toString

outfile = open("bible-subtitles.srt", "w")
outfile.write(subtitles)
outfile.close()
assfile = "bible-subtitles.ass"
convertoass =  "ffmpeg -i bible-subtitles.srt " + assfile
subprocess.call(convertoass, shell=True)

subprocess.call(command, shell=True)
*/
?>
