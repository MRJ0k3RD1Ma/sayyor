<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AnimaltypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.animaltype', 'Hayvon turlari');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animaltype-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'animal-type-grid',
                        'summary' => '',
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
                            'code',
                            'name_uz',
                            'name_ru',

                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>


</div>
