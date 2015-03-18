// Get WaveSurfer started to manage audio, generate waveform
function loadWaveSurfer(audioFile, waveformDivID, context) {

    // Get waveform Div
    var waveformDiv = document.querySelector('#' + waveformDivID);

    // Instantiate and initialise
    var wavesurfer = Object.create(WaveSurfer);
    wavesurfer.init({
        audioContext: context,
        container: waveformDiv,
        waveColor: '#BFBFBF',
        progressColor: '#222222'
    });

    // Load audio file
    wavesurfer.load(audioFile);

    // Get regions going
    wavesurfer.initRegions();
    wavesurfer.enableDragSelection();

    // Set loop up when region created
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
    }

    // Setup progress bar divs
    var progressDiv = document.createElement('div');
    progressDiv.className = 'progress progress-striped active';
    var progressBarDiv = document.createElement('div');
    progressBarDiv.className = 'progress-bar progress-bar-info';
    progressDiv.appendChild(progressBarDiv);
    waveformDiv.appendChild(progressDiv);

    // Render the progress bar
    (function () {

        var showProgress = function (percent) {
            progressDiv.style.display = 'block';
            progressBarDiv.style.width = percent + '%';
        };

        var hideProgress = function () {
            progressDiv.style.display = 'none';
        };

        wavesurfer.on('loading', showProgress);
        wavesurfer.on('ready', hideProgress);
        wavesurfer.on('destroy', hideProgress);
        wavesurfer.on('error', hideProgress);
    }());

    // Return WaveSurfer object
    return wavesurfer;

}



// Connect array of audio nodes to wavesurfer, including workaround for the dual connection it normally does
function connectNodesToWaveSurfer(nodeArray, wavesurfer) {
    // Connect as normal
    wavesurfer.backend.setFilters(nodeArray);
    // Connection between analyser and gainNode is retained by WaveSurfer,
    // effectively bypassing the FX loop.
    // Disconnect the analyser to break the bypass
    wavesurfer.backend.analyser.disconnect();
    // Reconnect analyser to start of chain
    wavesurfer.backend.analyser.connect(wavesurfer.backend.filters[0]);
}



// Create sliders and nodes for a graphic EQ, return array of nodes
function createGraphicEQ(EQArray, range, containerDivID, context) {

    // Create array of nodes from spec in EQArray
    var nodeArray = EQArray.map(function (band) {
        var filterBand = context.createBiquadFilter();
        filterBand.type = band.type;
        filterBand.gain.value = 0;
        filterBand.frequency.value = band.freq;
        if(band.Q) {
            filterBand.Q.value = band.Q;
        }
        return filterBand;
    });

    // Make some sliders, bind filters to them
    nodeArray.forEach(function (filterBand) {
        // Create the HTML for the Dragdealer slider
        var sliderDivID = 'slider-' + filterBand.frequency.value + 'Hz';
        var DragdealerSlider = document.createElement('div');
        DragdealerSlider.id = sliderDivID;
        DragdealerSlider.className = 'dragdealer col-xs-1';
        DragdealerSlider.innerHTML =
            '<div class="handle dark-bar">' +
                '<span class="dBvalue"></span>' +
                'dB' +
            '</div>';
        // Put it in the container Div
        var container = document.querySelector('#' + containerDivID);
        container.appendChild(DragdealerSlider);
        // Create the Dragdealer object
        new Dragdealer(sliderDivID, {
            horizontal: false,
            vertical: true,
            y: 0.5,
            callback: function(x, y) {
                var proportion = 0.5-y;
                filterBand.gain.value = range * proportion;
            },
            animationCallback: function(x, y) {
                $('#' + sliderDivID + ' .dBvalue').text((range/2)-Math.round(y*range));
            }
        });
    });

    // Return array of nodes
    return nodeArray;

}



// Create notes for a multi-band EQ, without creating controls
// NB: required gain property in the EQArray as well as those required for createGraphicEQ();
function createBlindEQ(EQArray, context) {

    // Create array of nodes from spec in EQArray
    var nodeArray = EQArray.map(function (band) {
        var filterBand = context.createBiquadFilter();
        filterBand.type = band.type;
        filterBand.gain.value = band.gain;
        filterBand.Q.value = band.Q;
        filterBand.frequency.value = band.freq;
        return filterBand;
    });

    // Return array of nodes
    return nodeArray;

}
