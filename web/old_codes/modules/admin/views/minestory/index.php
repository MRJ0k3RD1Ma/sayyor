<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MinestorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Бошқарув органлари';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="minestory-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Бошқарув органи қўшиш', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
          //  'code',
            'name',
//            'minestory_type_id',
            [
                'attribute'=>'minestory_type_id',
                'value'=>function($d){
                    return $d->minestory_type->name;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\app\models\MinestoryType::find()->all(),'id','name'),
            ],
          //  'setting:ntext',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]); ?>
</div>
