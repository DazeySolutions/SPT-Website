<!DOCTYPE html>
<html lang="en">
    <?php $this->inc('elements/head.php'); ?> 
    <?php if($c->isEditMode()){ ?>
	<style>
		body.editmode *{transition: none;}
	</style>
    <body class="editmode">
    <?php } else {?>
    <body>
    <?php } ?>
	    <div class="conquered_home_page <?php echo $c->getPageWrapperClass()?>">
	        <?php $this->inc('elements/navigation.php'); ?>
            <div class="conquered_headerimage">
            <?php
                $a = new Area('Header Image');
                $a->display($c);
            ?>
			</div>
			<div class="container-fluid">
                <?php
                    $a = new Area('Main');
                    $a->setAreaGridMaximumColumns(12);
                    $a->display($c);
                ?>
            </div>
	        <?php $this->inc('elements/footer.php'); ?> 
	    </div>
	    <?php Loader::element('footer_required')?>
    </body>
</html>
