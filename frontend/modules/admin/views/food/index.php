<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\FoodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Oziq-ovqatlar ro\'yhati';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-index">

    <p>
        <?= Html::a('Oziq-ovqat guruhi qo\'shish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name_uz',
            'name_ru',
//            'category_id',
            [
                'attribute'=>'category_id',
                'value'=>function($d){
                    $lg = 'uz'; if(Yii::$app->language == 'ru'){$lg='ru';}
                    return $d->category->{'name_'.$lg};
                }
            ],
            'animal_type_id',

//            'for_all',
            [
                'attribute'=>'for_all',
                'value'=>function($d){
                    if($d->for_all == 1){
                        return Yii::t('cp','Barcha kat. uchun');
                    }
                    return Yii::t('cp','Aloqasiz');
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
