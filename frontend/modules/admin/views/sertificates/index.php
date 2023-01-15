<?php

use common\models\Sertificates;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SertificatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('client', 'Hayvon kasalliklari tashhisi bo\'yicha namuna olish dalolatnomalari');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sertificates-index">

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

//                            'sert_id',
                            [
                                'attribute'=>'sert_full',
                                'format'=>'raw',
                                'value'=>function($d){
                                    $url = Yii::$app->urlManager->createUrl(['/cp/sertificates/view','id'=>$d->id]);
                                    return "<a href='{$url}'>{$d->sert_full}</a>";
                                },
                            ],
                            'sert_num',
                            'sert_date',

                            [
                                'label'=>'Hayvon egasi',
                                'value'=>function($d){
                                    if($d->owner_pnfl){
                                        return $d->owner_pnfl.'<br>'.$d->ownerPnfl->name.' '.$d->ownerPnfl->surname.' '.$d->ownerPnfl->middlename;
                                    }elseif($d->owner_inn){
                                        return $d->owner_inn.'<br>'.$d->ownerInn->name;
                                    }else{
                                        return "Hayvon egasi haqida ma'lumot kiritilmagan";
                                    }
                                },
                                'format'=>'raw'
                            ],
                            [
                                'attribute'=>'vet_site_id',
                                'value'=>function($d){
                                    return $d->vetSite->name;
                                }
                            ],
                            //'operator',
                            [
                                'attribute'=>'status_id',
                                'value'=>function($d){
                                    if(Yii::$app->language == 'ru'){
                                        return $d->status->name_ru;
                                    }
                                    return $d->status->name_uz;
                                }
                            ],

                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>



</div>
