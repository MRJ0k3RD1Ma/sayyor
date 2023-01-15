<?php

use app\models\search\lab\DestructionSampleAnimalSearch;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel DestructionSampleAnimalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('food', 'Oziq-ovqat tashhisi bo`yicha kelgan namunalarni yo\'q qilish dalolatnomalari ro\'yhati');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-sert-index">
    <div class="row">
        <div class="col-md-12">
            <div class="card">


                <?php Pjax::begin(['enablePushState' => 0, 'timeout' => false]); ?>
                <?php /*echo $this->render('_searchdest', [
                    'model' => $searchModel,
                ]);
                */?>
                <div class="card-body">

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'dest-grid',
//        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'code',
                            [
                                'attribute' => 'code',
                                'value' => function ($d) {
                                    $url = Yii::$app->urlManager->createUrl(['/lab/destfoodview', 'id' => $d->id]);
                                    return "<a href='{$url}'>{$d->code}</a>";
                                },
                                'format' => 'raw'
                            ],
//            'code_id',
//            'sample_id',
                            [
                                'attribute' => 'sample_id',
                                'value' => function ($d) {
                                    return $d->sample->samp_code;
                                },
                            ],

                            'ads',
                            //'creator_id',
                            //'created',
                            //'updated',
//            'consent_id',
                            [
                                'attribute' => 'consent_id',
                                'value' => function ($d) {
                                    return $d->consent->name;
                                }
                            ],
                            'destruction_date',
                            //'approved_date',
//            'state_id',
                            [
                                'attribute' => 'state_id',
                                'value' => function ($d) {
                                    $s = [
                                        1 => Yii::t('lab', 'Namuna yo\'q qilingan'),
                                        2 => Yii::t('lab', 'Rahbar tasdiqlashi kutilmoqda'),
                                        3 => Yii::t('lab', 'Namuna yo\'q qilinish jarayonida')
                                    ];
                                    return @$s[$d->state_id];
                                }
                            ],
                            //'org_id',

                        ],
                    ]) ?>
                <?php Pjax::end() ?>
            </div>
