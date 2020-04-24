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
$optionString = '';
if (isset($options)) {
    if (is_array($options)) {
        foreach ($options as $key => $value) {
            $optionString .= $key . '="' . $value . '"';
        }
    }
}
?>
<picture>
    <?php if (file_exists($basePath . '.webp')) {?>
    <source srcset="<?php echo $pathWithoutType . '.webp'; ?>" type="image/webp">
    <?php } ?>
    <source srcset="<?php echo $imagePath; ?>" type="image/jpeg">
    <img class="lazyload <?php echo $classString; ?>" data-src="<?php
    echo $imagePath; ?>"  alt="<?php echo $altText; ?>"  title="<?php echo $altText; ?>" <?php echo $optionString; ?>>
</picture>
