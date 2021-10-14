<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ManagmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вилоят бошқарув органлари рўйҳати';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="managment-index">
    <div class="row  border-bottom white-bg dashboard-header">

        <div class="col-sm-12">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?php


                if($searchModel->region_id){
                    $data = \yii\helpers\ArrayHelper::map(\app\models\District::find()->where(['region_id'=>$searchModel->region_id])->all(),'id','name');
                }else{
                    $data = \yii\helpers\ArrayHelper::map(\app\models\District::find()->all(),'id','name');
                }

            ?>

    <p>
        <?= Html::a('Вилоят бошқарув органи қўшиш', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
//            'code',
            'name',
//            'register_id',
            [
                'attribute'=>'register_id',
                'value'=>function($d){
                    return $d->register->name;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\app\models\Admin::find()->all(),'id','name')
            ],
//            'complex_id',
            [
                'attribute'=>'complex_id',
                'value'=>function($d){
                    return $d->complex->name;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\app\models\Complex::find()->all(),'id','name')
            ],
            [
                'attribute'=>'minestory_id',
                'value'=>function($d){
                    return $d->minestory->name;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\app\models\Minestory::find()->all(),'id','name')
            ],
            // 'minestory_id',
            // 'email:email',
             'phone',
            // 'telegram',
            // 'chat_id',
            // 'country_id',
            [
                'attribute'=>'region_id',
                'value'=>function($d){
                    return $d->region->name;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\app\models\Region::find()->all(),'id','name')
            ],
            [
                'attribute'=>'district_id',
                'value'=>function($d){
                    return $d->complex->name;
                },
                'filter'=>$data
            ],
            // 'region_id',
            // 'district_id',
            // 'director_id',
            // 'address',
             'created',
            // 'updated',
            // 'status',
            // 'isDelete',
            // 'setting:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        </div>
    </div>
</div>

