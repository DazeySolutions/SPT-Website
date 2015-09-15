<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<div class="row">
	<div class="col-xs-12 col-md-10 col-md-offset-1">
    <?php if($title != ""){ ?>
    <h1 class="col-xs-12 text-center"><?php echo $title ?></h1>
		<?php }
    $count = 0;
		foreach($userData as $user){ ?>
			<?php if($count%3 == 0) {?>
			<div class="row">
			<?php } ?>
				<div class="col-xs-12 col-sm-4">
					<?php $im = $user->getAttribute('profile_image'); ?>
					<div class="text-center col-xs-12">
						<h3><?php echo $user->getAttribute('real_name'); ?></h3>
						<h5><?php echo $user->getAttribute('title'); ?></h5>
					</div>
					<a href="mailto:<?php echo $user->getUserEmail() ?>"><img src="<?php echo $im->getRelativePath(); ?>" class="col-xs-10 col-xs-offset-1"></a>
					<div class="text-center col-xs-12" style="margin-top: 7.5px;">
						<?php echo $user->getAttribute('details'); ?>
						<br />
						<a href="mailto:<?php echo $user->getUserEmail() ?>"><?php echo $user->getUserEmail() ?></a>
					</div>
				</div>
			<?php 
				$count++;
			if ($count%3 == 0) { ?>
			</div>
			<?php } ?>
		<?php } ?>
	</div>
</div>
