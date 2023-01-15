<?php

use common\models\Soato;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\IndividualsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.individuals', 'Jismoniy shaxslar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="individuals-index">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'ind-grid',
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'pnfl',
                            'name',
                            'surname',
                            'middlename',
                            [
                                'attribute' => 'soato_id',
                                'label' => 'Hudud nomi',
                                'value' => function ($model) {

                                    return Soato::Full($model->soato_id);

                                }
                            ],
                            'adress',
//                            'passport',

                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>


</div>
