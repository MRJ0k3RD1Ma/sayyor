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
            <div class="card-header flex">
                <div></div>
                <div class="btns flex">
                    <div class="search">

                        <input type="text">
                        <button class="btn" type="submit"><span class="fa fa-search"></span></button>

                    </div>
                    <div class="export">

                        <button class="btn btn-primary"> <span class="fa fa-cloud-download-alt"></span> <?= Yii::t('cp','Export')?></button>
                        <div class="export-btn">
                            <button value="excel" class="export"><span class="fa fa-file-excel"></span>  <?= Yii::t('cp','Excel')?></button>
                            <button value="excel" class="export"><span class="fa fa-file-pdf"></span>  <?= Yii::t('cp','Pdf')?></button>
                        </div>
                    </div>

                </div>



            </div><!-- end card header -->
            <div class="card-body">

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