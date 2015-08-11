<!DOCTYPE html>
<html lang="en">
    <?php $this->inc('elements/head.php'); ?> 
    <body>
	    <div class="conquered_home_page <?php echo $c->getPageWrapperClass()?>">
	        <?php $this->inc('elements/navigation.php'); ?>
            <div class="conquered_headerimage">
            <?php
                $a = new Area('Header Image');
                $a->display($c);
            ?>
			</div>
	        <?php $this->inc('elements/footer.php'); ?> 
	    </div>
	    <?php Loader::element('footer_required')?>
    </body>
</html>
