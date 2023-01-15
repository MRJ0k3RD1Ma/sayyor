<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\LegalEntitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.legal_entities', 'Yuridik shaxslar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="legal-entities-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
//                        'filterModel' => $searchModel,
                        'id' => 'legal-grid',
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'inn',
                            'name',
                            [
                                'attribute' => 'tshx_id',
                                'value' => function ($model) {
                                    return $model->tshx->name_uz;
                             }
                            ],
                            'soogu',
                            [
                                'attribute' => 'soato_id',
                                'label' => 'Hudud nomi',
                                'value' => function ($model) {

                                    return \common\models\Soato::Full($model->soato_id);

                                }
                            ],
                            //'status_id',


                        ],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>



</div>
