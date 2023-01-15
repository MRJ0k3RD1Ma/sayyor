<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ReportFoodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Oziq-ovqat ekspertizalari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-food-index">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php \yii\widgets\Pjax::begin(['enablePushState' => false, 'timeout' => false]); ?>
                    <?php echo $this->render('_searchreportfood', [
                        'model' => $searchModel,
                    ]);
                    ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'reportfood-grid',
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            [
                                'attribute' => 'code',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return \yii\bootstrap4\Html::a($model->code, '/region/reportfoodview?id=' . $model->id);
                                }
                            ],
//            'rep_id',
                            [
                                'attribute' => 'food_id',
                                'value' => function ($model) {
                                    $lg = Yii::$app->language=='ru'?'ru':'uz';
                                    return \common\models\Food::find()->where(['id' => $model->food_id])->one()->{'name_'.$lg};
                                }
                            ],
                            [
                                'attribute' => 'cat_id',
                                'value' => function ($model) {
                                    return \common\models\ReportFoodCategory::find()->where(['id' => $model->cat_id])->one()->name_uz;
                                }
                            ],
//            'lat',
//            'long',
                            [
                                'attribute' => 'soato_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return \common\models\Soato::Full($model->soato_id);
                                }
                            ],
                            'phone',
//            'detail:ntext',
//            'created',
//            'updated',
//            'is_true',
                            [
                                'attribute' => 'status_id',
                                'value' => function ($model) {
                                    return \common\models\ReportStatus::findOne(['id' => $model->status_id])->name_uz;
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
