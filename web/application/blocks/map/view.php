<?php defined('C5_EXECUTE') or die("Access Denied.");

$c = Page::getCurrentPage();
if ($c->isEditMode()) { ?>
	<div class="ccm-edit-mode-disabled-item" style="width: <?php echo $width; ?>; height: <?php echo $height; ?>">
		<div style="padding: 80px 0px 0px 0px"><?php echo t('Google Map disabled in edit mode.')?></div>
	</div>
<?php  } else { ?>
	<?php  if( strlen($title)>0){ ?><h1 class="text-center"><?php echo $title?></h1><?php  } ?>
	<div onclick="window.open('http://maps.google.com/maps?daddr=<?php echo $location?>&amp;ll=','_blank')" id="googleMapCanvas<?php echo $unique_identifier?>" class="googleMapCanvas" style="margin: auto; width: <?php echo $width; ?>; height: <?php echo $height; ?>; cursor:pointer;" data-toggle="tooltip" data-placement="bottom" title="Click for Directions!"></div>
<?php  } ?>



<?php
/*
    Note - this goes in here because it's the only way to preserve block caching for this block. We can't
    set these values through the controller
*/
?>

<script type="text/javascript">
	$(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip(); 
	});
    function googleMapInit<?php echo $unique_identifier?>() {
        try{
            var latlng = new google.maps.LatLng(<?php echo $latitude?>, <?php echo $longitude?>);
            <?php if($customstyle) { ?>
            	var styleAr = <?php echo $styles; ?>;
            <?php } ?>
            var mapOptions = {
                zoom: <?php echo $zoom?>,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                streetViewControl: false,
                scrollwheel: <?php echo !!$scrollwheel ? "true" : "false"?>,
                mapTypeControl: false,
                draggable: <?php echo !!$draggable ? "true" : "false"?>,
                <?php if($customstyle){ ?>
                styles: styleAr,	
                <?php } ?> 
                disableDefaultUI: <?php echo !!$defaultui ? "true" : "false"?>
            };
            var map = new google.maps.Map(document.getElementById('googleMapCanvas<?php echo $unique_identifier?>'), mapOptions);
            <?php if (is_object($f)) { ?>
	            var img = '<?php echo $f->getRelativePath(); ?>';
            <?php } ?>
            
            var marker = new google.maps.Marker({
                position: latlng,
                <?php  if (is_object($f)) {?>
                map: map,
                icon: img
                <?php } else { ?>
                map: map
                <?php } ?>
            });
        }catch(e){
            $("#googleMapCanvas<?php echo $unique_identifier?>").replaceWith("<p>Unable to display map: "+e.message+"</p>")}
    }
    $(function() {
        var t;
        var startWhenVisible = function (){
            if ($("#googleMapCanvas<?php echo $unique_identifier?>").is(":visible")){
                window.clearInterval(t);
                googleMapInit<?php echo $unique_identifier?>();
                return true;
            }
            return false;
        };
        if (!startWhenVisible()){
            t = window.setInterval(function(){startWhenVisible();},100);
        }
    });
</script>
