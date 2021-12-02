<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AnimalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.animals', 'Hayvonlar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animals-index">

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
                        <?= Html::a(Yii::t('cp.animals', 'Hayvon qo\'shish'), ['create'], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
//            'cat_id',
//            'gender',
            'birthday',
            'inn',
            'pnfl',
            'adress',
            //'vet_site_id',
            //'bsual_tag',
            //'type_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
