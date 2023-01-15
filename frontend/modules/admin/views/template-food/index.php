<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TemplateFoodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp', 'Oziq-ovqat ekspertizasi shablonlari');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-food-index">

    <p>
        <?= Html::a(Yii::t('cp', 'Shablon qo`shish'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'category_id',
//            'food_id',
//            'group_id',
            [
                'attribute'=>'category_id',
                'value'=>function($d){
                    $lg = Yii::$app->language=='ru'?'ru':'uz';
                    return $d->category->{'name_'.$lg};
                }
            ],
            [
                'attribute'=>'food_id',
                'value'=>function($d){
                    $lg = Yii::$app->language=='ru'?'ru':'uz';
                    return $d->group->{'name_'.$lg};
                }
            ],
            [
                'attribute'=>'food_id',
                'value'=>function($d){
                    $lg = Yii::$app->language=='ru'?'ru':'uz';
                    return $d->food->{'name_'.$lg};
                }
            ],
            'name_ru',
            'name_uz',
//            'unit_id',
            [
                'attribute'=>'unit_id',
                'value'=>function($d){
                    $lg = Yii::$app->language=='ru'?'ru':'uz';
                    return $d->unit->{'name_'.$lg};
                }
            ],
            'min_1',
            'min_2',
            'max_1',
            'max_2',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
