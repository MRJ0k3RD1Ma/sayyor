<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\WorkTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Лавозимлар рўйҳати';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-type-index">
    <div class="row  border-bottom white-bg dashboard-header">

        <div class="col-sm-12">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Лавозим қўшиш', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

       //     'id',
     //       'code',
            'name',
     //       'setting:ntext',

            ['class' => 'yii\grid\ActionColumn','template'=>"{update}{delete}"],
        ],
    ]); ?>
        </div>
    </div>
</div>
