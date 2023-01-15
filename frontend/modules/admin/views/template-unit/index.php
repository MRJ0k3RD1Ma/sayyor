<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TemplateUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Shablon birliklari');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-unit-index">

    <p>
        <?= Html::a(Yii::t('app', 'Shablon birliklari qo\'shish'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name_uz',
            'name_ru',
            [
                'attribute' => 'type_id',
                'value' => function (\common\models\TemplateUnit $model) {
                    return $model->type->name_uz;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \common\models\TemplateUnit $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
