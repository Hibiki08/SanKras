<?php
/** @var string $imagePath */
/** @var string $altText */

$imagePathParts = explode('.', $imagePath);
$pathWithoutType = $imagePathParts[0];
$basePath = Yii::$app->basePath . '/web' . $pathWithoutType;
$classString = '';
if (isset($class)) {
    if (is_array($class)) {
        $classString = implode(' ', $class);
    } else {
        $classString = $class;
    }
}
?>
<picture>
    <?php if (file_exists($basePath . '.webp')) {?>
    <source srcset="<?php echo $pathWithoutType . '.webp'; ?>" type="image/webp">
    <?php } ?>
    <source srcset="<?php echo $imagePath; ?>" type="image/jpeg">
    <img class="lazyload <?php echo $classString; ?>" data-src="<?php
    echo $imagePath; ?>"  alt="<?php echo $altText; ?>"  title="<?php echo $altText; ?>">
</picture>
