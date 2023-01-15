<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel \app\models\search\director\DestructionSampleAnimalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('food', 'Hayvon kasalliklari tashhisi uchun kelgan namunalarni yo\'q qilish dalolatnomalari ro\'yhati');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-sert-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">


                <div class="card-body">

                    <?php Pjax::begin(['enablePushState' => false, 'timeout' => false]); ?>
                    <?php echo $this->render('_searchdest', [
                        'model' => $searchModel,
                    ]);
                    ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


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
                                    $url = Yii::$app->urlManager->createUrl(['/director/destview', 'id' => $d->id]);
                                    return "<a href='{$url}'>{$d->code}</a>";
                                },
                                'format' => 'raw'
                            ],
//            'code_id',
//            'sample_id',
                            [
                                'attribute' => 'sample_id',
                                'value' => function ($d) {
                                    return $d->sample->kod;
                                },
                            ],

                            'ads',
                            //'creator_id',
                            //'created',
                            //'updated',
//            'consent_id',
                            [
                                'attribute' => 'creator_id',
                                'value' => function ($d) {
                                    return $d->creator->name;
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
                                    return $s[$d->state_id];
                                }
                            ],
                            //'org_id',

                        ],
                    ]) ?>
                    <?php Pjax::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>