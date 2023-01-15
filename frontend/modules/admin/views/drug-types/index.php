<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ReportDrugTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Dori turlari haqida hisobot');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-drug-type-index">

    <div class="card-header flex">
        <div></div>
        <div class="btns flex">
            <?= Html::a(Yii::t('app', 'Dori turlari haqida hisobot yaratish'), ['create'], ['class' => 'btn btn-success']) ?>

        </div>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name_uz',
            'name_ru',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \common\models\ReportDrugType $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
