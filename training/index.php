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
                    <h1>Training home</h1>
                    <ol class="breadcrumb">
                        <li class="active"><i class="fa fa-headphones"></i> Training</li>
                    </ol>
                </div>
            </div><!-- /.row -->

            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-tasks"></i> Available Exercises</h3>
                        </div>
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    Identify EQ
                                </a>
                                <a href="#" class="list-group-item">
                                    Match EQ
                                </a>
                            </div>
                        </div>
                    </div><!-- /.panel panel-primary -->
                </div>

                <div id="render-task" class="col-lg-8">
                    <!-- Exercise appears here - make this panel appear when exercise selected -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-pencil-square-o"></i> Exercise</h3>
                        </div>
                        <div class="panel-body">
                            <!-- Task appears here -->
                            <?php include "EQtest.php" ?>
                        </div>
                    </div>

                </div><!-- /#render-task -->

            </div><!-- /.row -->


        </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

</body>

</html>
