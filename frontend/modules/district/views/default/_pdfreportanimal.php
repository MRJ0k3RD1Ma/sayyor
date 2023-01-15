<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ReportAnimalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hayvon kasalliklari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-animal-index">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'reportanimal-grid',
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'code',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return \yii\bootstrap4\Html::a($model->code, '/district/reportanimalview?id=' . $model->id);
                                }
                            ],
                            [
                                'attribute' => 'type_id',
                                'value' => function ($model) {
                                    return \common\models\Animaltype::find()->where(['id' => $model->type_id])->one()->name_uz;
                                }
                            ],
                            [
                                'attribute' => 'cat_id',
                                'value' => function (\common\models\ReportAnimal $model) {
                                    return \common\models\AnimalCategory::find()->where(['id' => $model->cat_id])->one()->name_uz;
                                }
                            ],
                            [
                                'attribute' => 'soato_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return \common\models\Soato::Full($model->soato_id);
                                }
                            ],
//            'lat',
//            'long',
//            'detail:ntext',
//            'operator_id',
//            'is_true',
                            [
                                'attribute' => 'report_status_id',
                                'value' => function ($model) {
                                    return \common\models\ReportStatus::findOne(['id' => $model->report_status_id])->name_uz;
                                }
                            ],
//            'phone',
//            'created',
//            'updated',
//            'rep_id',
                            'lang',
//            'organization_id',
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>


</div>
