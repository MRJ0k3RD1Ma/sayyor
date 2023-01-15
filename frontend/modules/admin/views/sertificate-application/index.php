<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SertificateApplicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.sertificate_application', 'Labaratoriya tekshiruvi o\'tkazish uchun arizalar ro\'yhati');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sertificate-application-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header flex">
                    <div></div>
                    <div class="btns flex">
                        <div class="search">

                            <input type="search">
                            <button class="btn"><span class="fa fa-search"></span></button>

                        </div>
                        <div class="export">
                            <button class="btn btn-primary"><span class="fa fa-cloud-download-alt"></span> Export</button>
                            <div class="export-btn">
                                <button class=""><span class="fa fa-file-excel"></span> Excel</button>
                                <button class=""><span class="fa fa-file-pdf"></span> PDF</button>
                            </div>

                        </div>
                        <?= Html::a(Yii::t('cp.sertificate_application', 'Ariza to\'ldirish'), ['create'], ['class' => 'btn btn-success']) ?>

                    </div>
                </div>
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
//                            'code',
                            'pnfl',
                            'inn',
                            'fsc_id',
                            //'vet_site_id',
                            //'labaratory_test_type_id',
                            //'emergency_check',
                            //'cat_id',
                            'phone',
                            'name',
                            'check_date',
                            //'status',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>




</div>
