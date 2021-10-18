<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DistrictsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Districts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="districts-index">

    <div class="card">
        <div class="card-header">
            <p>
                <?= Html::a(Yii::t('app', 'Create Districts'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="card-body">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//            'id',
                    'name',
//            'region_id',
                    [
                        'attribute'=>'regions',
                        'value'=>function($d){
                            return $d->region->name;
                        },
                    ],
                    'type',

                    ['class' => 'yii\grid\ActionColumn','template'=>'{update} {delete}'],
                ],
            ]); ?>

        </div>
    </div>


</div>
