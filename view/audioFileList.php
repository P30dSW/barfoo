<?php

//Creating the list of avaliable music files
$avaliableFiles = [];
$files = scandir('../resources/audioHeap/');
$avaliableFilesMP3 = [];
foreach($files as $file) {
    $addFileToList = false;
    $fileData = pathinfo('../resources/audioHeap/'. $file);
    if($fileData['extension'] != 'mp3'){
        $avaliableFiles[] = [$fileData['filename'], $fileData['extension']];
    }
    //TODO: insert array of filename and extension
            
}

 unset($avaliableFiles[0]);
 unset($avaliableFiles[1]);
 $isAlreadyOnTheList = [];
 foreach($avaliableFiles as $avFiles){
    $isAlreadyOnTheList[] = $avFiles[0];
 }
 foreach($files as $file) {
    $addFileToList = false;
    $fileData = pathinfo('../resources/audioHeap/'. $file);
    if($fileData['extension'] == 'mp3'){
        $insertable = false;
        foreach($isAlreadyOnTheList as $fileFromList){
            if($fileFromList ==$fileData['filename']){
                $insertable = true;
            }
            

        }
        if($insertable == false){
            $avaliableFiles[] = [$fileData['filename'], $fileData['extension']];
        }
    }
    //TODO: insert array of filename and extension
            
}
 //Converting it to json

 echo json_encode(array_values($avaliableFiles));


?>