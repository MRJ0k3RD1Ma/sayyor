<?php

use common\models\Sertificates;
use common\models\SertStatus;
use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SertificatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.sertificates', 'Arizalar ro\'yhati');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sertificates-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?php Pjax::begin(['enablePushState' => false, 'timeout' => false]); ?>
                <?php echo $this->render('_searchsertfood', [
                    'model' => $searchModel,
                ]);
                ?>
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'sertfood-grid-filters',
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            [
                                'attribute' => 'code',
                                'value' => function ($d) {
                                    $url = Yii::$app->urlManager->createUrl(['/district/sertfoodview', 'id' => $d->id]);
                                    return "<a href='{$url}'>{$d->code}</a>";
                                },
                                'filter' => false,
                                'format' => 'raw'
                            ],
                            [
                                'label' => Yii::t('client', 'Namuna raqamlari'),
                                'value' => function ($d) {
                                    $res = "";
                                    foreach ($d->comp as $item) {
                                        $res .= $d->status->icon . $item->sample->samp_code . '<br>';
                                    }
                                    return $res;
                                },
                                'format' => 'raw',
                            ],
                            [
                                'label' => Yii::t('register', 'Labaratoriya'),
                                'value' => function ($d) {
                                    return $d->organization->NAME_FULL;
                                },
                                'format' => 'raw'
                            ],
//                            'is_research',
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

                            'sender_name',
                            'sender_phone',
                            'created',
                            [
                                'attribute' => 'status_id',
                                'label' => "Status",
                                'value' => function ($model) {
                                    return SertStatus::findOne(['id' => (int)$model->status_id])->name_uz;
                                }
                            ]
                        ],
                    ]) ?>
                    <?php Pjax::end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
