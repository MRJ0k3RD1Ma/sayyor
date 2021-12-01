<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DiseasesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.diseases', 'Kasalliklar ro`yhati');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diseases-index">

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


                    </div>
                </div>
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
                            'name_uz',
                            'name_ru',
//                            'category_id',
//                            'group_id',
                            [
                                'attribute'=>'category_id',
                                'value'=>function($d){
                                    $lang = Yii::$app->language;
                                    if($lang == 'ru'){
                                        return $d->category->name_ru;
                                    }else{
                                        return $d->category->name_uz;
                                    }
                                }
                            ],
                            [
                                'attribute'=>'group_id',
                                'value'=>function($d){
                                    $lang = Yii::$app->language;
                                    if($lang == 'ru'){
                                        return $d->group->name_ru;
                                    }else{
                                        return $d->group->name_uz;
                                    }
                                }
                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>




</div>
