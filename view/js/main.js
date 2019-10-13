var wavesurfer;
$(document).ready(function(){

  wavesurfer = WaveSurfer.create({
    container: '#waveform',
    waveColor: 'white',
    progressColor: 'black',
    backend: 'MediaElement'
});


wavesurfer.on('error',function(){
  //TODO: create error window
  
  
  });


  wavesurfer.on('ready', function() {
    var EQ = [
        {
            f: 32,
            type: 'lowshelf'
        },
        {
            f: 250,
            type: 'peaking'
        },
        {
            f: 2000,
            type: 'peaking'
        },
        {
            f: 16000,
            type: 'highshelf'
        }
    ];
    var filters = EQ.map(function(band) {
      var filter = wavesurfer.backend.ac.createBiquadFilter();
      filter.type = band.type;
      filter.gain.value = 0;
      filter.Q.value = 1;
      filter.frequency.value = band.f;
      return filter;
  });

  wavesurfer.backend.setFilters(filters);

 
      var onChange = function(e) {
          filter.gain.value = ~~e.target.value;
      };
      $('#lowRange').on('input', onChange);
      $('#lowRange').on('change', onChange);
      
      $('#lowMidRange').on('input', onChange);
      $('#lowMidRange').on('change', onChange);


      $('#highMidRange').on('input', onChange);
      $('#highMidRange').on('change', onChange);

      $('#highRange').on('input', onChange);
      $('#highRange').on('change', onChange);
  // For debugging
  wavesurfer.filters = filters;
});
});

$(document).on('click','.audiofile' , function(){
  var mainSrc = $(this).attr('mainSource');
  var adjustedSrc = $(this).attr('adjustedSource');
  $('#coverFigCaption').html($(this).text());
  
  var audio = $('#mediaAudio');
  audio.empty();
  var source= document.createElement('source');
  var pattern = /(flac|wav|mp3)/i;
  var extension = mainSrc.match(pattern);
  
  
  audio.attr('src',mainSrc);
  source= document.createElement('source');
  source.type= 'audio/mpeg';
  source.src= adjustedSrc;
  audio.append(source);
  
  var mediaElt = document.querySelector('audio');
  console.log(mediaElt);
  wavesurfer.load(mediaElt);
  
  });


$('#searchInput').on('change', adjustAudioList());
$('#searchInput').on('keyup',function(){adjustAudioList();
});

$('.playButton').on('click', function(){
        wavesurfer.playPause();
  });


function adjustAudioList(){
  $.ajax({
    url: "http://localhost/barfoo/view/audioFileList.php",
    dataType:"JSON",
    error: function(){
      console.log("Something went wrong");
    },
    success: function(json){
      if(json != null){
        if(typeof json !== 'undefined' && json.length > 0 ){
          $('#mainTable').empty();
          var searchString = $('#searchInput').val();
          if( searchString != ''){
           var searchResultArray = [];
           $.each( json, function(i) {
            
             if(json[i][0].indexOf(searchString) !== -1){
              searchResultArray.push(json[i]);
             }
           })
           
           $.each(searchResultArray, function(i){
            $('#mainTable').append("<tr><td class='audiofile col-12' mainSource='../resources/audioHeap/" + searchResultArray[i][0] + "." + searchResultArray[i][1] +"' adjustedSource='../resources/audioHeap/" + searchResultArray[i][0] + ".mp3' >" + searchResultArray[i][0] + "</td><tr>" );
          });
          }else{
            console.log(json);
            $.each(json , function(i) {
              $('#mainTable').append("<tr><td class='audiofile col-12' mainSource='../resources/audioHeap/" + json[i][0] + "." + json[i][1] +"' adjustedSource='../resources/audioHeap/" + json[i][0] + ".mp3' >" + json[i][0] + "</td><tr>" );
            });
          }

      }else{
        $('#mainTable').empty();
      }
    }else{
      $('#mainTable').empty();
    }

  }
  
});
}


// function sendName(){
//   if($('#nameInput').val() != "" ){
//   $.ajax({
//        url: "http://localhost/jsonl.php?name=" + $('#nameInput').val() ,
//    dataType: "JSON",
//    error: function(){
//      alert("Da gibt es einen Fehler mit den Server");
//    },
//    success: function(json){
//      if(json == null){
//        $('#bodyTbl').empty();
//      }else{
//      if(typeof json !== 'undefined' && json.length > 0 ){
//           $('#bodyTbl').empty();
//      $.each( json, function(i) {
// $('#bodyTbl').append("<tr><td>" + json[i].vorname+ "</td><td>" + json[i].nachname+ "</td><td>" + json[i].strasse+ "</td> <td>" + json[i].plz+ "</td><td>" + json[i].ort+ "</td><td>" + json[i].email+ "</td></tr>");
// });}else{
//  $('#bodyTbl').empty();
// }
//    }		
//    }
//    })
//   }else{
//     //noDataGiven();
//   }
// };


//TODO: Submit through UploadButton doesn't work, because the $_POST Array doesn't get a value
  // $("#uploadButton").change( function(){
  //   console.log("yes!");
  //   $("#uploadForm").submit();
    
  // });