$(document).ready(function () {

    // Load AudioContext
    var oaContext = new AudioContext();

    // Load WaveSurfer
    var wavesurfer = loadWaveSurfer('./test.wav', 'waveform', oaContext);
    console.log(wavesurfer);

    // Specify filters
    var EQ = [
        {
            freq: 500,
            type: 'peaking',
            Q: 1
        }, {
            freq: 4000,
            type: 'peaking',
            Q: 1
        }
    ];

    // Create graphic EQ
    var filterArray = createGraphicEQ(EQ, 40, 'graphic-EQ', oaContext);

    // Hook filters in to wavesurfer
    wavesurfer.backend.setFilters(filterArray);


    // Toggle transformation
    var transformActive = true;
    function toggleTransform() {
        if(transformActive) {
            wavesurfer.backend.setFilters();
            transformActive = false;
        } else {
            wavesurfer.backend.setFilters(filterArray);
            transformActive = true;
        }
    }


    // Hook up buttons
    $('#btn-playpause').click(wavesurfer.playPause());
    $('#btn-toggletransform').click(toggleTransform());
    $('#btn-clearloop').click(wavesurfer.clearRegions());

});
