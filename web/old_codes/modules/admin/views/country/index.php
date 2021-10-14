<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Давлатлар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">
    <div class="row  border-bottom white-bg dashboard-header">

        <div class="col-sm-12">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Давлат қўшиш', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'code',
//            'name',
             [
                 'attribute'=>'name',
                 'value'=>function($d){
                    $url = Yii::$app->urlManager->createUrl(['admin/region/index','id'=>$d->id]);
                    return "<a href='{$url}'>{$d->name}</a>";
                 },
                 'format'=>'raw'
             ],
//            'setting:ntext',

            ['class' => 'yii\grid\ActionColumn','template'=>"{update} {delete}"],
        ],
    ]); ?>
        </div>
    </div>
</div>
