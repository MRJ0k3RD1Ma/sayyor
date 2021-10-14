<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">
    <div class="row  border-bottom white-bg dashboard-header">

        <div class="col-sm-12">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Администратор қўшиш', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'code',
            'name',
//            'share',
            'username',

            [
                'attribute'=>'share',
                'value'=>function($d){
                    $s = [
                        0=>'Администратор',
                        1=>'Супер Администратор'
                    ];
                    return $s[$d->share];
                },
                'filter'=> [
                    0=>'Администратор',
                    1=>'Супер Администратор'
                ]
            ],
            // 'password',
             'pin_code',
            // 'chat_id',
             'phone',
             'telegram',
             'email:email',
             'created',
            // 'updated',
             'status',
            // 'isDelete',
            // 'setting:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

    </div>
</div>