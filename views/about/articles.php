<?php
use yii\widgets\LinkPager;
use app\models\Blog;
use yii\helpers\StringHelper;
use yii\helpers\Url;

$this->title = 'Статьи по сантехнике: специалисты компании СанКрас делятся опытом';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Специалисты компании СанКрас делятся опытом и рассказывают, почему в частном доме необходимо установить систему водоочистки или как выбрать радиаторы отпления.'
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'статьи по сантехнике'
]);

$this->params['breadcrumbs'][] = 'Статьи';
?>
<section class="articles" id="about" style="padding-top:115px;">
    <div class="width">
        <div class="head">
            <h1 class="title exo asphalt">Статьи</h1>
        </div>
        <div class="block-articles">
            <?php if (!empty($articles)) { ?>
                <?php foreach ($articles as $article) {?>
                    <a href="<?php echo Yii::$app->urlManager->createUrl(['stati/'.$article->url]); ?>" class="article">
                        <?php if (!empty($article->preview)) { ?>
                            <?php echo $this->render('/part/_picture-source-template', [
                                'imagePath' => '/images/blog/articles/' . $article->preview,
                                'altText' => '',
                            ]); ?>
                        <?php } ?>
                        <div class="articles-text clear">
                            <div class="article-title"><?php echo $article->title; ?></div>
                            <div class="short"><?php echo strip_tags(StringHelper::truncate($article->text, 230, '...')); ?></div>
                            <span class="date"><?php echo Yii::$app->formatter->asDate($article->date, 'd MMMM yyyy'); ?></span>
                            <span class="cat asphalt exo"><?php echo !is_null($article->category->parent_id) ? $article->category->description : ''; ?></span>
                        </div>
                    </a>
                <?php } ?>
            <?php } else { ?>
                <span class="no-video">В этом разделе пока нет статей. В скором времени они появятся.</span>
            <?php } ?>
        </div>
        <div class="pagination">
            <?php echo LinkPager::widget([
                'pagination' => $pager,
                'prevPageLabel' => '',
                'nextPageLabel' => '',
                'maxButtonCount' => 5
            ]); ?>
        </div>
    </div>
</section>