<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\LaboratoryTestTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.laboratory_test_type', 'Laboratoriya tadqiqot turlari');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="laboratory-test-type-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'summary' => '',
                        'id' => 'laboratory-test-type-grid',
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
                            'name_uz',
                            'name_ru',
                            'code',

                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
