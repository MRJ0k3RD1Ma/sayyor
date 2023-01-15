<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\FoodSamplingCertificateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.food_sampling_certificate', 'Mahsulot ekspertizalari');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-sampling-certificate-index">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php \yii\widgets\Pjax::begin(['enablePushState' => false, 'timeout' => false]); ?>
                    <?php echo $this->render('_searchfood', [
                        'model' => $searchModel,
                    ]);
                    ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'listfood-grid',
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
                            [
                                'attribute' => 'code',
                                'format' => 'html',
                                'value'=>function ($model){
                                    return Html::a($model->code,'viewfood?id='.$model->id);
                                }
                            ],
                            'food_id',
                            'inn',
                            'pnfl',
                            //'sampling_site',
                            //'sampling_adress',
                            //'sampler_person_pnfl',
                            //'sampler_person_inn',
                            //'verification_pupose_id',
                            //'sampling_date',
                            //'send_sample_date',
                            //'based_public_information',
                            //'message_number',
                            //'created',
                            //'updated',
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
