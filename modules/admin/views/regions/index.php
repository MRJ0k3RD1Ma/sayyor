<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RegionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Regions');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="card">
    <div class="card-header flex">
        <div class="btns flex">
            <div class="search">

                <input type="search">
                <button class="btn"><span class="fa fa-search"></span></button>

            </div>
            <div class="export">

            <button class="btn btn-primary "> <span class="fa fa-cloud-download-alt"></span> Export</button>
                <div class="export-btn">
                    <button class="" ><span class="fa fa-file-excel"></span> Excel</button>
                    <button class=""><span class="fa fa-file-pdf"></span> Pdf</button>
                </div>
            </div>

            <?= Html::a(Yii::t('app', 'Create Regions'), ['create'], ['class' => 'btn btn-primary']) ?>
        </div>



    </div><!-- end card header -->

    <div class="card-body">
        <div class="row">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
//                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
                    'name',

                    ['class' => 'yii\grid\ActionColumn','template'=>'{update} {delete}'],
                ],
            ]); ?>
        </div>
    </div>
    <!-- end card body -->
</div>
