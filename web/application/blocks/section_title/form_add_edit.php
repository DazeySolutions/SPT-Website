<?php defined('C5_EXECUTE') or die("Access Denied.");?>

<div class="form-group">
    <?php echo $form->label('titleText', t('Section Title'))?>
    <?php echo $form->text('titleText', $titleText); ?>
</div>
<div class="form-group">
    <?php echo $form->label('formatting', t('Formatting Style'))?>
    <select class="form-control" name="formatting" id="formatting">
    	<option value="h1" <?php echo ($this->controller->formatting=="h1"?"selected":"")?>><?php echo t('H1')?></option>
        <option value="h2" <?php echo ($this->controller->formatting=="h2"?"selected":"")?>><?php echo t('H2')?></option>
        <option value="h4" <?php echo ($this->controller->formatting=="h4"?"selected":"")?>><?php echo t('H4')?></option>
    </select>
</div>

