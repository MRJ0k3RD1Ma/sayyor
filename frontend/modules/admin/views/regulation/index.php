<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\RegulationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Normativ hujjatlar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regulations-index">


    <p>
        <?= Html::a(Yii::t('app', 'Normativ hujjat qo\'shish'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name_uz',
            'name_ru',
            'file',
            [
                'attribute'=>'type_id',
                'value'=>function($d){
                    $lg = 'uz'; if(Yii::$app->language == 'ru')$lg='ru';
                    return $d->type->{'name_'.$lg};
                }
            ],
            [
                'attribute' => 'creator_id',
                'value' => function (\common\models\Regulations $model) {
                    return $model->creator->name;
                }
            ],
            'created',
            //'updated',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \common\models\Regulations $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
