<div class="btn-group" role="group" aria-label="...">
    <button type="button" class="btn btn-default" onclick="wavesurfer.playPause()">Play/Pause</button>
    <button type="button" class="btn btn-default" onclick="togglePan()">Transform</button>
</div>

<div id="waveform">
    <!-- Waveform goes here -->
</div>
<input id="filter-freq" type="range" min="100" max="10000" value="5000" />

<script src="js/wavesurfer.min.js"></script>
<script type="text/javascript">

// Instantiate and initialise
var wavesurfer = Object.create(WaveSurfer);

wavesurfer.init({
    container: document.querySelector('#waveform'),
    waveColor: '#EBEBEB',
    progressColor: '#222222'
});

// Load audio file
wavesurfer.load('test.wav');

// Do a filter
var filter = wavesurfer.backend.ac.createBiquadFilter();
filter.type = 'lowpass';
filter.frequency.value = 5000;
wavesurfer.backend.setFilter(filter);
// Bind slider to filter frequency
var freqSlider = document.querySelector('#filter-freq');
freqSlider.addEventListener('input', function (e) {
    filter.frequency.value = parseInt(e.target.value);
});


</script>
