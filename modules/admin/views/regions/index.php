<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RegionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Regions');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="card">
    <div class="card-header">
        <div class="page-title-right">
            <?= Html::a(Yii::t('app', 'Create Regions'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div><!-- end card header -->

    <div class="card-body">
        <div class="row">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
//                    'name',
                    [
                        'attribute'=>'name',
                        'value'=>function($d){
                            return Yii::t('app',$d->name);
                        },
                    ],

                    ['class' => 'yii\grid\ActionColumn','template'=>'{update} {delete}'],
                ],
            ]); ?>
        </div>
    </div>
    <!-- end card body -->
</div>