<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SampleConditionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.sample_conditions', 'Namuna holatlari');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sample-conditions-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'sample-conditions-grid',
                        'summary' => '',
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
