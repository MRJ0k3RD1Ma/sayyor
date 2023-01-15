<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RolesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.roles', 'Foydalanuvchi huquqlari');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roles-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header flex">
                    <div class="btns flex">
                        <?= Html::a(Yii::t('cp.roles', 'Foydalanuvchi huquqi qo\'shish'), ['create'], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
                <div class="card-body">

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//            'id',
                            'name',

//                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>


</div>
