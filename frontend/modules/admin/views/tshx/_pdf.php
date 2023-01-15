<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TshxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.tshx', 'Tashkiliy huquqiy shakllar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tshx-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'tshx-grid',
                        'summary' => '',
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
                            'name_uz',
                            'name_ru',
                            'code',

                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>


</div>
