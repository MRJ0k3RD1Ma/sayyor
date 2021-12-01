<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\VetSitesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

<<<<<<< HEAD
$this->title = Yii::t('cp.vetsites', 'Veterinariya uchastkalari');
=======
$this->title = Yii::t('cp.vetsites', 'Vet uchastkalar');
>>>>>>> b1e79cbd8920d278801889463ec1dfa2e7b18853
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vet-sites-index">

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
<<<<<<< HEAD
                        <?= Html::a(Yii::t('cp.vetsites', 'Veterinariya uchastka yaratish'), ['create'], ['class' => 'btn btn-success']) ?>
=======
                        <?= Html::a(Yii::t('cp.vetsites', 'Vet uchastka qo\'shish'), ['create'], ['class' => 'btn btn-success']) ?>
>>>>>>> b1e79cbd8920d278801889463ec1dfa2e7b18853

                    </div>
                </div>
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//            'id',
                            'code',
                            'name',
                            'soato',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>


</div>
