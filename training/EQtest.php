<div class="btn-group" role="group" aria-label="...">
    <button type="button" class="btn btn-default" onclick="wavesurfer.playPause()">Play/Pause</button>
    <button type="button" class="btn btn-default" onclick="toggleTransform()">Transform</button>
</div>

<div id="waveform">
    <!-- Waveform goes here -->
</div>

<!-- Manually created sliders for experimentation -->
<input id="filter_LoGain" type="range" min="-20" max="20" value="0" />
<input id="filter_HiGain" type="range" min="-20" max="20" value="0" />

<script src="js/wavesurfer.min.js"></script>
<script type="text/javascript">

// Instantiate and initialise
var context = new AudioContext();
var wavesurfer = Object.create(WaveSurfer);

wavesurfer.init({
    audioContext: context,
    container: document.querySelector('#waveform'),
    waveColor: '#BFBFBF',
    progressColor: '#222222'
});

// Load audio file
wavesurfer.load('test.wav');


// Do some filters
var EQ = [
    {
        freq: 500,
        type: 'peaking'
    }, {
        freq: 4000,
        type: 'peaking'
    }
];

var filterArray = EQ.map(function (band) {
    var filterBand = context.createBiquadFilter();
    filterBand.type = band.type;
    filterBand.gain.value = 0;
    filterBand.Q.value = 1;
    filterBand.frequency.value = band.freq;
    return filterBand;
});

// Pass filters to wavesurfer
wavesurfer.backend.setFilters(filterArray);

// Bind sliders to filter gains
var sliderLoGain = document.querySelector('#filter_LoGain');
sliderLoGain.addEventListener('input', function (e) {
    filterArray[0].gain.value = parseInt(e.target.value);
});
var sliderHiGain = document.querySelector('#filter_HiGain');
sliderHiGain.addEventListener('input', function (e) {
    filterArray[1].gain.value = parseInt(e.target.value);
});

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

</script>
