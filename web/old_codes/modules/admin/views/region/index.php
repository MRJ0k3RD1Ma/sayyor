<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RegionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вилоятлар';
if(isset($country_id)){
    $country = \app\models\Country::findOne($country_id);
    $this->params['breadcrumbs'][] = ['label'=>$country->name, 'url'=>['/admin/country/index']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-index">

    <div class="row  border-bottom white-bg dashboard-header">

        <div class="col-sm-12">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if(isset($country_id)){?>
            <?= Html::a('Вилоят қўшиш', ['create','country_id'=>$country_id], ['class' => 'btn btn-success']) ?>
        <?php }else{?>
            <?= Html::a('Вилоят қўшиш', ['create'], ['class' => 'btn btn-success']) ?>
        <?php }?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'code',
//            'name',
            [
                'attribute'=>'name',
                'value'=>function($d){
                    $url = Yii::$app->urlManager->createUrl(['admin/district/index','id'=>$d->id]);
                    return "<a href='{$url}'>{$d->name}</a>";
                },
                'format'=>'raw'
            ],
//            'country_id',
            [
                'attribute'=>'country_id',
                'value'=>function($d){
                    return $d->country->name;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\app\models\Country::find()->all(),'id','name')
            ],
//            'setting:ntext',

            ['class' => 'yii\grid\ActionColumn','template'=>"{update} {delete}"],
        ],
    ]); ?>
        </div>
    </div>
</div>
