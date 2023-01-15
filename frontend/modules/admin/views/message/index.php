<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp', 'Messages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'translation:ntext',
            [
                'attribute'=>'translation',
                'value'=>function($d){
                    $url = \yii\helpers\Url::to(['update','id'=>$d->id,'lang'=>$d->language]);
                    return "<a href='$url'>{$d->translation}</a>";
                },
                'format'=>'raw'
            ],
            'language',
            [
                'value'=>function($d){
                    return $d->id0->category;
                },
                'attribute'=>'category'
            ],
            [
                'attribute'=>'message',
                'value'=>function($d){
                    return $d->id0->message;
                }
            ],


        ],
    ]); ?>


</div>
