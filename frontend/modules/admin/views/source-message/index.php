<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SourceMessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Source Messages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-message-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Source Message', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'category',
            'message:ntext',
            [
                'label'=>Yii::t('cp','Tarjimalar'),
                'format'=>'raw',
                'filter'=>false,
                'value'=>function($d){
                    $tr = \common\models\Message::find()->where(['id'=>$d->id])->all();
                    $res = "";
                    foreach ($tr as $item){
                        $res .= "<label>{$item->language}:<input type='text' value='{$item->translation}' class='updatetrans' data-lang='{$item->language}' id='$item->id'></label><br>";
                    }
                    return $res;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

<?php
    $url = Yii::$app->urlManager->createUrl(['/cp/source-message/updateone']);
    $this->registerJs("
        $('.updatetrans').keypress(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var id = this.id;
            var lang = this.dataset.lang;
            var val = this.value;
            if(keycode == '13'){
                $.get('{$url}?id='+id+'&lang='+lang+'&val='+val).done(function(data){
                    if(data==1){
                        alert('save');
                    }else{
                        alert('error');
                    }
                })
            }
        });
    ");
?>