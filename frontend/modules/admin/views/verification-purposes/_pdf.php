<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\VerificationPurposesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.verification_purposes', 'Tekshirish maqsadlari');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="verification-purposes-index">


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'verification-purposes-grid',
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
