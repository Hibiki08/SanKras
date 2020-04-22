<?php
/** @var string $imagePath */
/** @var string $altText */

$imagePathParts = explode('.', $imagePath);
$pathWithoutType = $imagePathParts[0];
$basePath = Yii::$app->basePath . '/web' . $pathWithoutType;
?>
<picture>
    <?php if (file_exists($basePath . '.webp')) {?>
    <source srcset="<?php echo $pathWithoutType . '.webp'; ?>" type="image/webp">
    <?php } ?>
    <source srcset="<?php echo $imagePath; ?>" type="image/jpeg">
    <img class="lazyload" data-src="<?php echo $imagePath; ?>"  alt="<?php echo $altText; ?>"/>
</picture>
