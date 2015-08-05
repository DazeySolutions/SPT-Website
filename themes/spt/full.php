<!DOCTYPE html>
<html lang="en">
    <?php $this->inc('elements/head.php'); ?> 
    <body>
	    <div class="conquered_home_page <?php echo $c->getPageWrapperClass()?>">
	        <?php $this->inc('elements/navigation.php'); ?>
			<div class="conquered_headerimage">
				<div class="flexslider">
					<ul class="slides">
					<li><img src="<?php echo $view->getThemePath() ?>/assets/images/slider/1.jpg" alt="Slide 1"></li>
					<li><img src="<?php echo $view->getThemePath() ?>/assets/images/slider/2.jpg" alt="Slide 2"></li>
					<li><img src="<?php echo $view->getThemePath() ?>/assets/images/slider/3.jpg" alt="Slide 3"></li>
					</ul>
				</div>
			</div>
	        <?php $this->inc('elements/footer.php'); ?> 
	    </div>
	    <?php Loader::element('footer_required')?>
    </body>
</html>
