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

            <h2>The Training Page</h2>

            <?php include "EQtest.php" ?>


        </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

</body>

</html>
