<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\VaccinesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.vaccines', 'Vaksinalar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vaccines-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'summary' => '',
                        'id' => 'vaccines-grid',
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
                            'name',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>


</div>
