<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\LinkPager;
    use yii\widgets\LinkSorter;
    use yii\widgets\ActiveForm;
    use yii\grid\GridView;
    use common\models\User;

    if ($searchModel->regionNameTp)
    {
        $this->title = 'Коворкинги в '.$searchModel->regionNameTp;
        $this->registerMetaTag(['name' => 'description', 'content' => 'Коворкинги в '.$searchModel->regionNameTp.': полный список. Цены, условия, фото, отзывы посетителей']);
        $this->registerMetaTag(['name' => 'keywords', 'content' => 'коворкинг, коворкинг-центр, '.$searchModel->regionName]);
    }
    else
    {
        $this->title = 'Коворкинги: поиск';
        $this->registerMetaTag(['name' => 'description', 'content' => 'Каталог коворкингов в Москве и регионах РФ. Цены, условия, фото, отзывы посетителей']);
        $this->registerMetaTag(['name' => 'keywords', 'content' => 'коворкинг, коворкинг-центры в россии']);
    }

    $this->params['showCounters'] = true;
?>

<div class="row">
    <div class="col-xs-12">
        <h1><p>
            Новости
        </p></h1>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 serp-text">
        Всего новостей: <?= $dataProvider->getTotalCount() ?>

        <br/><br/>
        <script type="text/javascript" src="http://yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
        <script type="text/javascript" src="http://yastatic.net/share2/share.js" charset="utf-8"></script>
        <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,twitter"></div>
        <br/>

    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php
            if (User::isAdmin())
                echo Html::a('Создать новость', ['create'], ['class' => 'btn btn-default']);
        ?>
    </div>
</div>

<?php foreach ($dataProvider->getModels() as $model): ?>
    <?php $url = Url::to(['view', 'id' => $model->id]); ?>
    <div class="row">
      <div class="col-xs-12 card arenda" onclick="location.href='<?= $url ?>';">
          <div class="clearfix" >
            <?php if ($model->anons3x2) echo '<image class="card-image" src="'.$model->anons3x2.'">'; ?>
            <h3><a href="<?=$url?>"><?=Html::encode("{$model->title}")?></a></h3>
            <?php
            ?>
            <?php
                echo '<div class="card-params">';
                    echo '<p>'.$model->regionName.'</p>';
                echo '</div>';
            ?>

            <div class="card-text">
                <?= '<p>'.$model->anons_text.'</p>' ?>
                <?= '<p>'.$model->date.'</p>' ?>
            </div>
        </div>
      </div>
    </div>
<?php endforeach; ?>

<?= LinkPager::widget(['pagination' => $dataProvider->getPagination()]) ?>
