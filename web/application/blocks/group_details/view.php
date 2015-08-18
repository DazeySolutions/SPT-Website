<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>
<div class="row section">
	<div class="col-xs-12 col-md-10 col-md-offset-1">
		<!--<hr class="hidden-xs col-sm-3">
		<h2 class="col-xs-12 col-sm-6"><?php echo h($title)?></h2>
		<hr class="hidden-xs col-sm-3"> -->
		<?php foreach($userData as $user){ ?>
		<div class="col-xs-12 col-sm-4">
			<?php $im = $user->getAttribute('profile_image'); ?>
			<div class="text-center col-xs-12">
				<h4><?php echo $user->getAttribute('real_name'); ?></h4>
				<h5><?php echo $user->getAttribute('title'); ?></h5>
			</div>
			<img src="<?php echo $im->getRelativePath(); ?>" class="col-xs-10 col-xs-offset-1">
			<div class="text-center col-xs-12">
				<?php echo $user->getAttribute('details'); ?>
			</div>
		</div>
		<?php } ?>
	</div>
</div>