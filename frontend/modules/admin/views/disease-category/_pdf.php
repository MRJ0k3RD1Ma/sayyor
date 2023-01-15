<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\DiseaseCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.disease_category', 'Kasalliklar toyifasi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disease-category-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'disease-category-grid',
                        'summary' => '',
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
                            'name_uz',
                            'name_ru',

                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>



</div>
