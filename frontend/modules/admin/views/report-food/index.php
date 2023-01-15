<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ReportFoodCategory */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Oziq-ovqat toifalari haqida');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-food-category-index">

    <div class="card-header flex">
        <div></div>
        <div class="btns flex">
   <?= Html::a(Yii::t('app', 'Oziq ovqat xisoboti kategoriyasi yaratish'), ['create'], ['class' => 'btn btn-success']) ?>

        </div>
    </div>

    <?php // escho $this->render('_search', ['model' => $searchModel]); ?>

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
                'urlCreator' => static function ($action, \common\models\ReportFoodCategory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
