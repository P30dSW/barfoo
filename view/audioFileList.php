<?php

//Creating the list of avaliable music files
$avaliableFiles = [];
$files = scandir('../resources/audioHeap/');
$avaliableFilesMP3 = [];
foreach($files as $file) {
    $addFileToList = false;
    $fileData = pathinfo('../resources/audioHeap/'. $file);
    //TODO: if contains mp3, then dont insert it!
    if($fileData['extension'] != 'mp3'){
        $avaliableFiles[] = [$fileData['filename'], $fileData['extension']];
    }
    //TODO: insert array of filename and extension
            
}

 unset($avaliableFiles[0]);
 unset($avaliableFiles[1]);
 //Converting it to json

 echo json_encode(array_values($avaliableFiles));


?>