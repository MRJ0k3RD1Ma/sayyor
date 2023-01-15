<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PostListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp', 'Lavozimlar ro\'yhati');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-list-index">

    <p>
        <?= Html::a(Yii::t('cp', 'Lavozim qo\'shish'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
//            'def_role',
            [
                'attribute'=>'def_role',
                'value'=>function($d){
                    return $d->defRole->name;
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \common\models\PostList $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
