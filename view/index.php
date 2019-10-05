<?php  
ini_set('max_execution_time', 300);  
//No more session needed, because the application isn't based to a usersystem anymore
if(isset($_POST['submit'])){
    $valid_extension = array('.mp3', '.mp4', '.wav', '.flac');
    $file_extension = strtolower( strrchr( $_FILES["file"]["name"], "." ) );
    if( in_array( $file_extension, $valid_extension )){
    //TODO: Check for size

    //TODO:Check for name (if preexists)

    //TODO:Chek for name (if it has spaces)
        $newAudioName = uniqid('',false);
        
        $newDicretory = "../resources/audioHeap/" . $_FILES["file"]['name'];
        move_uploaded_file($_FILES["file"]['tmp_name'],$newDicretory);
       //Converting file for a mp3 version
       preg_match('/^([^.]+)/',$_FILES["file"]['name'], $fileNameWithOutExtension);
       $path_parts = pathinfo($newDicretory);
       exec('sox ' . $newDicretory . ' ' . "../resources/audioHeap/" . $path_parts['filename'] . '.mp3');
    }else{
        //TODO: Error message (file type not supported)
        
    }
   
       
    }
//Creating the list of avaliable music files
$avaliableFiles[] = array();
$files = scandir('../resources/audioHeap/');
foreach($files as $file) {
    $addFileToList = false;
    $fileData = pathinfo('../resources/audioHeap/'. $file);
    
            $avaliableFiles[] = $fileData['filename'];
}
$avaliableFilesUnique = array_unique($avaliableFiles, SORT_REGULAR);
 unset($avaliableFilesUnique[0]);
 unset($avaliableFilesUnique[1]);
 unset($avaliableFilesUnique[2]);
?>
<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">

</head>

<body>
    <div class="bg-image"></div>
    <div class="container h-100 content">
        <div class="row vertical-center">
            <div class="col-12 text-light">
                <div class="row">
                    <!-- <div class="col-12 border border-dark">.col-9</div> -->
                    <div class="col-md-4 border border-white bg-dark">
                        <div class="d-flex justify-content-center">
                            <figure class="mt-2" style="max-width: 100% !important">
                                <img id="coverImage" src="../resources/coverImage.jpg" style="max-width: 100% !important">
                                <figcaption class="text-center">OK Computer
                                    </br>No Surprises - Radiohead
                                    </br>1997
                                    </br>FLAC - 789kbps
                                </figcaption>
                            </figure>

                        </div>
                    </div>

                    <div class="col-md-8 ">
                        <div class="row">
                            <div class="col-12 border border-white m-1 bg-dark">
                                <div class="row">
                                <div class="col-md-2 mt-2 mb-2">
                                    <form id="uploadForm"  action="index.php" Method="POST" enctype="multipart/form-data">
                                        <input id="submitButton" name="submit" type="submit">

                                        <input type="file" name="file" class="form-control-file" id="uploadButton">
                                        </form>
                                        <!-- <button type="file" class="btn btn-secondary" id="uploadButton">Upload</button> -->
                                </div>
                                <div class="col-md-10 mt-2 mb-2">
                                       
                                        <input type="text" class="form-control" id="basic-url"  >
                                     
                        </div>
                                <!-- Seach and uplaod button -->
                            </div>

                        </div>
                    </div>
                        <div class="row">
                            <div class="col-12 border border-white m-1 bg-dark">
                                <table class="table-fixed table table-hover table-borderless text-light">
                                    <thead>
                                        <tr>
                                            <th class="col-12" scope="col">Title Name</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        <?php
                                            foreach($avaliableFilesUnique as $file) {
                                echo '<tr><td class="col-12" >'. $file . '</td></tr>'; 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <!-- Music table -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 border border-white m-1 bg-dark">
                                <form>
                                    <div class="mt-1">
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">LOW</label>
                                    <input id="lowRange" type="range"/>
                                            </div>
                                        
                                            <div class="form-group">
                                                    <label for="exampleInputEmail1">LOW MID</label>
                                    <input id="lowMidRange" type="range"/>
                                    </div>
                                
                                    <div class="form-group">
                                            <label for="exampleInputEmail1">HIGH MID</label>
                                    <input id="highMidRange" type="range" />
                                    </div>
                                
                                    <div class="form-group">
                                            <label for="exampleInputEmail1">HIGH</label>
                                    <input id="highRange" type="range" />
                                    </div>
                                
                                    </div>
                                    </form>
                                </form>
                                <!-- Equalizer -->

                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 border border-white m-1 bg-dark">
                        <div class="row ">
                            <div class="col-1">
                                <div class="">
                                        
                                                <img class="align-middle justify-content-between" src="../resources/play-button.png" style="width: 100% !important"></img>
                                            
                                    <!-- <div class="controls">
                                        
                                        
                                        <button class="btn btn-primary button-play" data-action="play" >Play / Pause</button>
                                    </div> -->
                                </div>
                            </div>

                            <div class="col-11"> <div id="waveform"></div></div>
                        </div>   
                        
                        
                       
                        <!-- <audio controls>
                            Add mp3 source if original source isnt supported
                        </audio> -->
                        <!-- AudioPlayerRow -->
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://unpkg.com/wavesurfer.js"></script>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsmediatags/3.9.0/jsmediatags.js" integrity="sha256-j6y0xjM8ul3l0lp/rnayNHS2Im+Xaqip0iOrr+uijus=" crossorigin="anonymous"></script>
<script src="js/main.js"></script>

</html>
