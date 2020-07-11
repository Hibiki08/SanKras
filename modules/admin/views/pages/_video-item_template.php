<?php
/** @var \app\models\Video $video */
/** @var \app\models\forms\EditServiceForm $model */
?>

<div class="video-item">
    <span><?php echo $video->title ?> - <?php echo $video->url ?></span>
    <span class="glyphicon glyphicon-remove js-remove-video" data-id="<?php echo $video->id; ?>"></span>
    <input name="<?php echo $model->formName(); ?>[blockVideo][]" type="hidden" value="<?php echo $video->id; ?>">
</div>
