<?php defined('C5_EXECUTE') or die("Access Denied.");
$gl = new GroupList();
$gl->includeAllGroups();
$groups = $gl->getResults();
?>
<div class="page-header">
	<h2><?php echo t('Choose Group')?></h2>
</div>
<div class="form-group">
 	<label for="title">Section Title <small>ex(Staff)</small></label>
	<?php echo $form->text('title', $title);?>
</div>
<div class="form-group">
	<?php echo $form->label('groupName', t('Select Member Group Name')); ?>
	<select name="groupName" class="form-control">
		<?php foreach($groups as $group) { ?>
			<option value="<?php echo $group->getGroupName()?>"><?php echo $group->getGroupName()?> </option>
		<?php } ?>
	</select>
</div>