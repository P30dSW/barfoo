<?php   
//No more session needed, because the application isn't based to a usersystem anymore
if(isset($_POST['submit'])){
    $valid_extension = array('.mp3', '.mp4', '.wav', '.flac');
    $file_extension = strtolower( strrchr( $_FILES["file"]["name"], "." ) );
    if( in_array( $file_extension, $valid_extension )){
    //TODO: Check for size
        $newAudioName = uniqid('',true);
        $newDicretory = "../resources/audioHeap/" . $newAudioName  . $file_extension;
        move_uploaded_file($_FILES["file"]['tmp_name'],$newDicretory);
       //Converting file for a mp3 version
       echo 'sox ' . $newDicretory . ' ' . "../resources/audioHeap/" . $newAudioName  . '.mp3';
       exec('sox ' . $newDicretory . ' ' . "../resources/audioHeap/" . $newAudioName  . '.mp3');
    }else{
        //TODO: Error message
        
    }
   
       
    }
    // if($file['name'] != ""){
    //   $isFile = true;
    //   echo "TRUE";
    // }else{
    //     echo "FALSE";
    // }

  
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
                                <img id="coverImage" src="../resources/okcomputer.jpg" style="max-width: 100% !important">
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
                                            <th class="col-4" scope="col">Title</th>
                                            <th class="col-4" scope="col">Artist</th>
                                            <th class="col-4" scope="col">Ablum</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="col-4">No Surprises</td>
                                            <td class="col-4">Radiohead</td>
                                            <td class="col-4">OK Computer</td>
                                        </tr>
                                        <tr>
                                            <td class="col-4">Computer Love</td>
                                            <td class="col-4">Kraftwerk</td>
                                            <td class="col-4">Computer World</td>
                                        </tr>
                                        <tr>
                                            <td class="col-4">Army of Me</td>
                                            <td class="col-4">Björk</td>
                                            <td class="col-4">Post</td>
                                        </tr>
                                        <tr>
                                            <td class="col-4">Loser</td>
                                            <td class="col-4">Beck</td>
                                            <td class="col-4">Mellow Gold</td>
                                        </tr>
                                        <tr>
                                            <td class="col-4">Blue Monday</td>
                                            <td class="col-4">New Order</td>
                                            <td class="col-4">12" Blue Monday</td>
                                        </tr>
                                        <tr>
                                            <td class="col-4">Teardrop</td>
                                            <td class="col-4">Massive Attack</td>
                                            <td class="col-4">Mezzanine</td>
                                        </tr>
                                        <tr>
                                            <td class="col-4">Rabbit in your headlight</td>
                                            <td class="col-4">Unkle</td>
                                            <td class="col-4">Psyence Fiction</td>
                                         </tr>
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
