<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UnitsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.units', 'Birliklar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="units-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- end card header -->
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'units-grid',
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
