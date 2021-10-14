<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ComplexSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Комплекслар рўйҳати';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complex-index">
    <div class="row  border-bottom white-bg dashboard-header">

        <div class="col-sm-12">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Комплекс қўшиш', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        //    'id',
            'code',
            'name',
        //    'user_id',
//            'director_id',
            [
                 'attribute'=>'director_id',
                'value'=>function($d){
                    return $d->director->name;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\app\models\User::find()->all(),'id','name')
            ],
             'phone',
            // 'telegram',
            // 'chat_id',
             'email:email',
            // 'fax',
             'created',
            // 'updated',
//             'status',
            [

            ],
            // 'isDelete',
            // 'setting:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        </div>
    </div>
</div>
