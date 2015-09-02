<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo $view->getThemePath() ?>/assets/css/animate.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $view->getThemePath() ?>/assets/css/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $view->getThemePath() ?>/assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $view->getThemePath() ?>/assets/css/styles.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700,800' rel='stylesheet' type='text/css'>
    <?php Loader::element('header_required')?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="rgb(7.493591%,22.601318%,44.927979%)">
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
		$(document).ready(function(){
		    $("body .section:even").addClass("even");
		    $("body .section:odd").addClass("odd");
		});
		<?php if($c->isEditMode()){ ?>
		    MutationObserver = window.MutationObserver || window.WebKitMutationObserver;
		
		    var observer = new MutationObserver(function(mutations, observer) {
		        $("body .section:odd").addClass("even");
		        $("body .section:even").addClass("odd");
		    });
		    observer.observe(document, {
		      subtree: true,
		      attributes: true
		    });
		<?php } ?>
    </script>
    <script src="<?php echo $view->getThemePath() ?>/assets/js/jquery.min.js"></script>
    <script src="<?php echo $view->getThemePath() ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo $view->getThemePath() ?>/assets/js/jquery.singlePageNav.js"></script>
    <script src="<?php echo $view->getThemePath() ?>/assets/js/jquery.flexslider.js"></script>
    <script src="<?php echo $view->getThemePath() ?>/assets/js/main.js"></script>
    <script src="<?php echo $view->getThemePath() ?>/assets/js/jquery.lightbox.min.js"></script>
    <script src="<?php echo $view->getThemePath() ?>/assets/js/tmeplatemo.js"></script>
    <script src="<?php echo $view->getThemePath() ?>/assets/js/responsive-carousel.min.js"></script>
</head>