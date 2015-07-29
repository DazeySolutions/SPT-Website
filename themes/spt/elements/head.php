<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $view->getThemePath() ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $view->getThemePath() ?>/assets/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $view->getThemePath() ?>/assets/css/flatmate.css">
    <?php Loader::element('header_required')?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
            var msViewportStyle = document.createElement('style')

            msViewportStyle.appendChild(
                document.createTextNode(
                    '@-ms-viewport{width:auto!important}'
                )
            )
            document.querySelector('head').appendChild(msViewportStyle)
        }
    </script>
    <script src="<?php echo $view->getThemePath() ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo $view->getThemePath() ?>/assets/js/angular.min.js"></script>
    <script src="<?php echo $view->getThemePath() ?>/assets/js/ngImageSlider.js"></script>
    <script src="<?php echo $view->getThemePath() ?>/assets/js/ngChurchManagement.js"></script>
    <script src="<?php echo $view->getThemePath() ?>/assets/js/hbc.js"></script>
</head>
