<!-- Dragdealer dependencies -->
<script src="js/dragdealer.min.js"></script>
<link rel="stylesheet" href="css/dragdealer.css" />

<!-- Wavesurfer dependencies -->
<script src="js/wavesurfer.min.js"></script>
<script src="js/wavesurfer.regions.js"></script>




<script src="js/orientEar.renderTask.js"></script>


<script type="text/javascript">

$('#render-task').load('templates/matchEQ.html');

$(document).ready(function () {


    // // Instantiate and initialise
    // var context = new AudioContext();
    // var wavesurfer = Object.create(WaveSurfer);
    //
    // wavesurfer.init({
    //     audioContext: context,
    //     container: document.querySelector('#waveform'),
    //     waveColor: '#BFBFBF',
    //     progressColor: '#222222'
    // });
    //
    // wavesurfer.initRegions();
    // wavesurfer.enableDragSelection();
    //
    // // Load audio file
    // wavesurfer.load('test.wav');


    // // Do some filters
    // var EQ = [
    //     {
    //         freq: 500,
    //         type: 'peaking',
    //         Q: 1
    //     }, {
    //         freq: 4000,
    //         type: 'peaking',
    //         Q: 1
    //     }
    // ];

    // var filterArray = createGraphicEQ(EQ, 40, 'graphic-EQ', context);
    //
    // // Pass filters to wavesurfer
    // wavesurfer.backend.setFilters(filterArray);

    // // Toggle transformation
    // var transformActive = true;
    // function toggleTransform() {
    //     if(transformActive) {
    //         wavesurfer.backend.setFilters();
    //         transformActive = false;
    //     } else {
    //         wavesurfer.backend.setFilters(filterArray);
    //         transformActive = true;
    //     }
    // }

    // // Set loop up when dragged
    // wavesurfer.on('region-created', setLoop);
    // var loopedRegion;
    // function setLoop(Region) {
    //     // Remove existing region
    //     if(loopedRegion) {
    //         loopedRegion.remove();
    //     }
    //     // Start looping
    //     Region.update({loop: true});
    //     loopedRegion = Region;
    //     looping = true;
    // };

})

</script>
