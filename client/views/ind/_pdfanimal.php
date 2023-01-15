<?php

use common\models\RouteSert;
use common\models\Sertificates;
use common\models\SertStatus;
use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\helpers\VarDumper;

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
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
//                            'code',
                            [
                                'attribute' => 'code',
                                'value' => function ($d) {
                                    $url = Yii::$app->urlManager->createUrl(['/ind/sertappview', 'id' => $d->id]);
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
                                        $res .= $d->status->icon . $item->sample->kod . '<br>';
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
                                'label' => "Status",
                                'value' => function ($model) {
                                    return SertStatus::findOne(['id' => (int)$model->status_id])->name_uz;
                                }
                            ]
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>