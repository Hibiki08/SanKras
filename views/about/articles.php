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
            <?/*div class="tabs">
                <ul>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/'); ?>">О нас</a></li>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/opinions'); ?>">Отзывы</a></li>
                    <li class="exo asphalt"><a href="<?php echo Yii::$app->urlManager->createUrl('about/news'); ?>">Новости</a></li>
                    <li class="exo asphalt active"><a href="<?php echo Yii::$app->urlManager->createUrl('about/articles'); ?>">Статьи</a></li>
                </ul>
            </div>*/?>
            <h1 class="title exo asphalt">Статьи</h1>
            <?php/* if (!empty($categories)) { ?>
                <?php $group = !is_null(Yii::$app->request->get('group')) ? Yii::$app->request->get('group') : '' ; ?>
            <ul class="filter">
                <li><a class="exo <?php echo empty($group) ? 'red' : 'asphalt'; ?>" href="<?php echo Yii::$app->urlManager->createUrl('about/articles'); ?>">Все статьи</a></li>
                <?php foreach ($categories as $key => $cat) { ?>
                    <li><a class="exo <?php echo $group == $key ? 'red' : 'asphalt'; ?>"" href="<?php echo Yii::$app->urlManager->createUrl(['about/articles', 'group' => $key]); ?>"><?php echo $cat; ?></a></li>
                <?php } ?>
            </ul>
            <?php } */?>
        </div>
        <div class="block-articles">
            <?php if (!empty($articles)) { ?>
                <?php foreach ($articles as $article) {?>
                    <a href="<?php echo Yii::$app->urlManager->createUrl(['stati/'.$article->url]); ?>" class="article">
                        <?php if (!empty($article->preview)) { ?>
                            <img src="<?php echo Yii::$app->params['params']['pathToImage'] . Blog::IMG_FOLDER_ART . 'prev_' . $article->preview; ?>">
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