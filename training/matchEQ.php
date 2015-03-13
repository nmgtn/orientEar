<?php
/*
orientEar by Andy Normington
Copyright (c) 2015
See LICENSE.txt
*/
// UserCake authentication
require_once("../models/config.php");
// Request method: GET
$ajax = checkRequestMode("get");
if (!securePage(__FILE__)){
    apiReturnError($ajax);
}
setReferralPage(getAbsoluteDocumentPath(__FILE__));
// Training index page
?>

<!doctype html>
<html lang="en">
<?php
/**
* Render the <head> stuff for the page.
* Using the function for Account pages here, because I want it to still be
* obvious in the Training pages if you're logged in as master account.
*/
echo renderAccountPageHeader(array("#SITE_ROOT#" => SITE_ROOT,
"#SITE_TITLE#" => SITE_TITLE,
"#PAGE_TITLE#" => "Training"));
?>











<body>
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        echo renderMenu("training");
        ?>

        <div id="page-wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <h1>Exercise</h1>
                    <ol class="breadcrumb">
                        <li class="active"><i class="fa fa-headphones"></i> Training</li>
                    </ol>
                </div>
            </div><!-- /.row -->

            <div class="row">

                <div id="render-task" class="col-lg-8">

                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-pencil-square-o"></i> Match EQ</h3>
                        </div>

                        <div class="panel-body">

                            <div class="row">
                                <div class="btn-group" role="group" aria-label="...">
                                    <button type="button" class="btn btn-default" onclick="wavesurfer.playPause()">Play/Pause</button>
                                    <button type="button" class="btn btn-default" onclick="toggleTransform()">Transform</button>
                                    <button type="button" class="btn btn-warning" onclick="wavesurfer.clearRegions()">Clear Loop</button>
                                </div>
                            </div>

                            <div class="row">
                                <div id="waveform">
                                    <!-- Waveform goes here -->
                                </div>
                            </div>

                            <div class="row">
                                <div id="graphic-EQ">
                                    <!-- Graphic EQ goes here -->
                                </div>
                            </div>

                        </div><!-- /.panel-body -->

                    </div>

                </div><!-- /#render-task -->

            </div><!-- /.row -->


        </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

</body>


<!-- Dragdealer dependencies -->
<script src="js/dragdealer.min.js"></script>
<link rel="stylesheet" href="css/dragdealer.css" />

<!-- WaveSurfer dependencies -->
<script src="js/wavesurfer.min.js"></script>
<script src="js/wavesurfer.regions.js"></script>

<!-- Dependencies for this task -->
<script src="js/orientEar.renderTask.js"></script>
<script src="matchEQ.js"></script>


</html>
