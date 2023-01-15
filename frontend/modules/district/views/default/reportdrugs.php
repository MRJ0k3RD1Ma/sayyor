<?php

use common\models\ReportStatus;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ReportDrugsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dori darmonlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-drugs-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php \yii\widgets\Pjax::begin(['enablePushState' => false, 'timeout' => false]); ?>
                    <?php echo $this->render('_searchreportdrugs', [
                        'model' => $searchModel,
                    ]);
                    ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'reportdrugs-grid',
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            [
                                'attribute' => 'code',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return \yii\bootstrap4\Html::a($model->code, '/district/reportdrugsview?id=' . $model->id);
                                }
                            ],
                            [
                                'attribute' => 'type_id',
                                'value' => function ($model) {
                                    return \common\models\ReportDrugType::find()->where(['id' => $model->type_id])->one()->name_uz;
                                }
                            ],
                            [
                                'attribute' => 'cat_id',
                                'value' => function ($model) {
                                    return \common\models\ReportFoodCategory::find()->where(['id' => $model->cat_id])->one()->name_uz;
                                }
                            ],
                            [
                                'attribute' => 'soato_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return \common\models\Soato::Full($model->soato_id);
                                }
                            ],
//                            'lat',
//                            'long',
//                            'detail:ntext',
                            'phone',
//                            'created',
//                            'updated',
//                            'is_true',
                            [
                                'attribute' => 'status_id',
                                'value' => function ($model) {
                                    return ReportStatus::findOne(['id' => $model->status_id])->name_uz;
                                }
                            ],
                            'operator_id',

                        ],
                    ]); ?>
                    <?php
                    \yii\widgets\Pjax::end();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>