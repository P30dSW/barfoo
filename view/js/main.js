var jsmediatags = window.jsmediatags;

var wavesurfer = WaveSurfer.create({
    container: '#waveform',
    waveColor: 'white',
    progressColor: 'black'
});

wavesurfer.load('../resources/test.flac');

$('.controls .btn').on('click', function(){
    var action = $(this).data('action');
    console.log(action);
    switch (action) {
      case 'play':
        wavesurfer.playPause();
        break;
    }
  });

  jsmediatags.read("file:///../../resources/audioHeap/5d8f3c96e95de503796365.flac", {
    onSuccess: function(tag) {
      console.log(tag);
    },
    onError: function(error) {
      console.log(error);
    }
  });
//TODO: Submit through UploadButton doesn't work, because the $_POST Array doesn't get a value
  // $("#uploadButton").change( function(){
  //   console.log("yes!");
  //   $("#uploadForm").submit();
    
  // });