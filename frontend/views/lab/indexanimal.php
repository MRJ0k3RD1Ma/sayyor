<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel \common\models\SampleRegistration */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('food', 'Hayvon kasalliklari tashhisi bo`yicha kelgan namunalar ro\'yhati');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-sert-index">


    <?php Pjax::begin(['enablePushState' => 0, 'timeout' => false]); ?>
    <?php
    echo $this->render('_searchregproduct', [
        'model' => $searchModel,
    ]);

    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'id' => 'regproduct-grid',
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'director_id',
            [
                'attribute' => 'code',
                'value' => function ($d) {
                    $url = Yii::$app->urlManager->createUrl(['/lab/viewreganimal', 'id' => $d->id]);
                    return "<a href='{$url}'>{$d->code}</a>";
                },
                'format' => 'raw',
            ],
            [
                'label'=>'Namunalar',
                'value'=>function($d){
                    $res = "";
                    foreach (\common\models\RouteSert::find()->where(['registration_id'=>$d->id])->andWhere(['executor_id'=>Yii::$app->user->id])->all() as $item){
                        $res .= "{$item->sample->status->icon} {$item->sample->kod}<br>";
                    }
                    return $res;
                },
                'format'=>'raw'
            ],
            [
                'attribute' => 'is_research',
                'value' => function ($d) {
                    $s = [0 => 'Shoshilinch emas', 1 => 'Shohilinch'];
                    return $s[$d->is_research];
                }
            ],
//                            'code_id',
            //'code',
            //'research_category_id',
            [
                'attribute' => 'research_category_id',
                'value' => function ($d) {
                    return $d->researchCategory->name_uz;
                }
            ],
            //'results_conformity_id',
            //'organization_id',
            //'emp_id',
//                            'reg_date',
            //'reg_id',
            'sender_name',
            'sender_phone',
            'created',
            [
                'attribute' => 'status_id',
                'format' => 'html',
                'value' => function ($d) {
                    $lg = 'uz';
                    if (Yii::$app->language == 'ru') $lg = 'ru';
                    return "<span class='" . $d->status->class . "'>" . @$d->status->icon . ' ' . $d->status->{'name_' . $lg} . "</span>";
                }
            ],
        ]
    ]); ?>


</div>
