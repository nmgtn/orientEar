<div class="btn-group" role="group" aria-label="...">
    <button type="button" class="btn btn-default" onclick="wavesurfer.playPause()">Play/Pause</button>
    <button type="button" class="btn btn-default" onclick="toggleTransform()">Transform</button>
    <button type="button" class="btn btn-warning" onclick="wavesurfer.clearRegions()">Clear Loop</button>
</div>

<div id="waveform">
    <!-- Waveform goes here -->
</div>

<!-- Manually created sliders for experimentation -->
<input id="filter_LoGain" type="range" min="-20" max="20" value="0" />
<input id="filter_HiGain" type="range" min="-20" max="20" value="0" />


<!-- Trying out dragdealer -->
<div id="first-slider" class="dragdealer">
    <div class="handle dark-bar">
        <span class="dBvalue">0</span>
        dB
    </div>
</div>
<script src="js/dragdealer.min.js"></script>
<style>
.dragdealer {
    position: relative;
    width: 50px;
    height: 300px;
    background: #EEE;
}
.dragdealer .handle {
    position: absolute;
    top: 0;
    left: 0;
    cursor: pointer;
}
.dragdealer .dark-bar {
    width: 50px;
    height: 50px;
    background: #222222;
    color: #FFF;
    font-size: 14px;
    line-height: 50px;
    text-align: center;
}
.dragdealer .disabled {
    background: #898989;
}
.dragdealer .handle .dBvalue {
    padding: 0 0 0 5px;
    font-size: 30px;
    font-weight: bold;
}
</style>




<script src="js/wavesurfer.min.js"></script>
<script src="js/wavesurfer.regions.js"></script>
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

wavesurfer.initRegions();
wavesurfer.enableDragSelection();

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



// Trying out dragdealer
new Dragdealer('first-slider', {
    horizontal: false,
    vertical: true,
    y: 0.5,
    animationCallback: function(x, y) {
        $('#first-slider .dBvalue').text(20-Math.round(y*40));
    }
});

// Set loop up when dragged
wavesurfer.on('region-created', setLoop);
var loopedRegion;
function setLoop(Region) {
    // Remove existing region
    if(loopedRegion) {
        loopedRegion.remove();
    }
    // Start looping
    Region.update({loop: true});
    loopedRegion = Region;
    looping = true;
};



</script>
