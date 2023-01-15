<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SoatoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp', 'SOATO');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <?php \yii\widgets\Pjax::begin(['enablePushState' => false, 'timeout' => false]); ?>
                <?php echo $this->render('_search', [
                    'model' => $searchModel,
                ]);
                ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
//                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'MHOBT_cod',
//            'res_id',
//            'region_id',
//            'district_id',
//            'qfi_id',
                        'name_lot',
                        'center_lot',
                        'name_cyr',
                        'center_cyr',
                        'name_ru',
                        'center_ru',

//                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>

            </div>
        </div>
    </div>
</div>