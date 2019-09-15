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