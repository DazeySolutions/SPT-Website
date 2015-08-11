<?php defined('C5_EXECUTE') or die("Access Denied.");
$navigationTypeText = ($navigationType == 0) ? 'arrows' : 'pages';
$c = Page::getCurrentPage();
if ($c->isEditMode()) { ?>
    <div class="ccm-edit-mode-disabled-item" style="width: <?php echo $width; ?>; height: <?php echo $height; ?>">
        <div style="padding: 40px 0px 40px 0px"><?php echo t('Image Slider disabled in edit mode.')?></div>
    </div>
<?php  } else { ?>
<div class="flexslider">
    <?php if(count($rows) > 0) { ?>
    <ul class="slides">
        <?php foreach($rows as $row) { ?>
            <li>
                <?php
                    $f = File::getByID($row['fID']);
                ?>
                        <img src="<?php echo $f->getRelativePath() ?>" title="<?php echo $row['title'] ?>" alt="<?php echo $row['description'] ?>" longdesc="<?php echo $row['linkURL'] ?>">
            </li>
        <?php }?>
    </ul>
    <?php } ?>
</div>
<?php } ?>
