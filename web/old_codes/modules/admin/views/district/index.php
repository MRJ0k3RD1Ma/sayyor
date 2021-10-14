<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DistrictSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Туманлар';
if(isset($region_id)){
    $reg = \app\models\Region::findOne($region_id);
    $this->params['breadcrumbs'][] = ['label'=>$reg->country->name,'url'=>['/admin/country/']];
    $this->params['breadcrumbs'][] = ['label'=>$reg->name,'url'=>['/admin/region/','id'=>$reg->country_id]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-index">
    <div class="ibox">

        <div class="ibox-title">
    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="ibox-content">
    <p>
        <?php if(isset($region_id)){?>
            <?= Html::a('Туман қўшиш', ['create','region_id'=>$region_id], ['class' => 'btn btn-success']) ?>
        <?php }else{?>
            <?= Html::a('Туман қўшиш', ['create'], ['class' => 'btn btn-success']) ?>
        <?php }?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        //    'id',
//            'code',
            'name',
//            'region_id',
//            'country_id',
            [
                 'attribute'=>'country_id',
                'value'=>function($d){
                    return $d->country->name;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\app\models\Country::find()->all(),'id','name')
            ],
            [
                'attribute'=>'region_id',
                'value'=>function($d){
                    return $d->region->name;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\app\models\Region::find()->all(),'id','name')
            ],
            // 'setting:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        </div>
    </div>
</div>
