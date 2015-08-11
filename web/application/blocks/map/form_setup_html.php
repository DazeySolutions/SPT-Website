<?php defined('C5_EXECUTE') or die("Access Denied.");
$al = Loader::helper('concrete/asset_library');
$bf = null;
$bfo = null;

if ($controller->getFileID() > 0) { 
	$bf = $controller->getFileObject();
}

$args = array();

?>
<div class="ccm-google-map-block-container row">
    <div class="col-xs-12">
        <div class="form-group">
            <?php echo $form->label('title', t('Map Title (optional)'));?>
            <?php echo $form->text('title', $mapObj->title);?>
        </div>

        <div id="ccm-google-map-block-location" class="form-group">
            <?php echo $form->label('location', t('Location'));?>
            <?php echo $form->text('location', $mapObj->location);?>
            <?php echo $form->text('latitude', $mapObj->latitude);?>
            <?php echo $form->text('longitude', $mapObj->longitude);?>
            <div id="block_note" class="note"><?php echo t('Start typing a location (e.g. Apple Store or 235 W 3rd, New York) then click on the correct entry on the list.')?></div>
            <div id="map-canvas"></div>	
        </div>
    </div>

	<div class="form-group">
		<label class="control-label"><?php echo t('Image')?></label>
		<?php echo $al->image('ccm-b-image', 'fMarkerID', t('Choose Image'), $bf, $args);?>
	</div>

    <div class="col-xs-4">
        <div class="form-group">
            <?php echo $form->label('zoom', t('Zoom'));?>
            <?php
                $zoomArray = array();
                for($i=0;$i<=21;$i++) {
                    $zoomArray[$i] = $i;
                }
            ?>
            <?php echo $form->select('zoom', $zoomArray, $mapObj->zoom);?>
        </div>
    </div>

    <div class="col-xs-4">	
        <div class="form-group"> 
            <?php echo $form->label('width', t('Map Width'));?>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                <?php if(is_null($width) || $width == 0) {$width = '100%';};?>
                <?php echo $form->text('width', $width);?>
            </div>
        </div>
    </div>

    <div class="col-xs-4">
        <div class="form-group">
            <?php echo $form->label('height', t('Map Height'));?>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-arrows-v"></i></span>
                <?php if(is_null($height) || $height == 0) {$height = '400px';};?>
                <?php echo $form->text('height', $height); ?>
            </div>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
			<label class="checkbox-inline">
				<?php echo $form->checkbox('scrollwheel', 1, (is_null($scrollwheel) || $scrollwheel)); ?>
				<?php echo t("Enable Scroll Wheel")?>
			</label>
			<label class="checkbox-inline">
            	<?php echo $form->checkbox('draggable', 1, (is_null($draggable) || $draggable)); ?>
            	<?php echo t("Enable Draggable Map")?>
          	</label>
  			<label class="checkbox-inline">
            	<?php echo $form->checkbox('defaultui', 1, (is_null($defaultui) || $defaultui)); ?>
            	<?php echo t("Disable Default UI")?>
          	</label>
    		<label class="checkbox-inline">
            	<?php echo $form->checkbox('customstyle', 1, (is_null($customstyle) || $customstyle)); ?>
            	<?php echo t("Enable Custom Map Style")?>
          	</label>
          	<script>
          		$("#customstyle").change(function(){
          			if($(this).is(":checked")){
          				$(".styles").show();
          			}else{
          				$(".styles").hide();
          			}
          		});
          	</script>
    	</div>
    	<div class="form-group styles" <?php if(!$customstyle) { ?> style="display: none;" <?php } ?>>
            <?php echo $form->label('styles', t('Style'));?>
            <?php echo $form->textarea('styles', $mapObj->styles, array("rows"=>10,"placeholder"=>"Insert style here (in javascript array notation)"));?>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function() {
    window.C5GMaps.init();
});
</script>