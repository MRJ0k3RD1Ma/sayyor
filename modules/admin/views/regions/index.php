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
        <div></div>
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

<style>
    .flex{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .btns .export{
        margin: 0 10px;
        position: relative;

    }
    .btns .export:hover .export-btn{
        display: flex !important;

    }
    .btns .export-btn{
        display: none;
        position: absolute;
        background: #fff;
        flex-direction: column;
        width: 100%;
        box-shadow: 0px 0px 3px;
    }
    .btns .export-btn button{
        background: transparent;
        border: 0;
        padding: 5px;
        text-align: left;
        width: 100%;
    }
    .btns .export-btn button:hover{
        background: #d9d9d9;
    }
    .btns .search{
        display: flex;
        align-items: center;

    }

    .btns .search input{
        line-height: 1.5;
        padding: 0.47rem 0.75rem;
        border: 1px solid #c5c5c5;
        border-right: 0;
        border-radius: 0.25rem 0 0 0.25rem ;
    }
    .btns .search input:focus{
        outline: none;
    }
    .btns .search button{
        border: 1px solid #c5c5c5;
        background: #5156be;
        border-radius: 0  0.25rem 0.25rem 0;
    }
    .btns .search button{
        color: #fff;
    }



</style>