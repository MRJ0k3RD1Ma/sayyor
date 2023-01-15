<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\FoodSamplingCertificateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.food_sampling_certificate', 'Mahsulot ekspertizalari');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-sampling-certificate-index">


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
'id'=>'food-sampling-certificate-grid',
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            [
                                'attribute'=>'code',
                                'value'=>function($d){
                                    $url = Yii::$app->urlManager->createUrl(['/cp/food-sampling-certificate/view','id'=>$d->id]);
                                    return "<a href='{$url}'>{$d->code}</a>";
                                },
                                'format'=>'raw'
                            ],
//            'pnfl',
//            'organization_id',
                            [
                                'label'=>Yii::t('client','Buyurtmachi'),
                                'value'=>function($d){
                                    if($d->pnfl){
                                        return $d->pnfl.'<br>'.$d->pnfl0->name.' '.$d->pnfl0->surname.' '.$d->pnfl0->middlename;
                                    }elseif($d->inn){
                                        return $d->inn.'<br>'.$d->inn0->name;
                                    }else return null;
                                },
                                'format'=>'raw'
                            ],
//            'sampling_site',
                            [
                                'attribute'=>'sampling_site',
                                'value'=>function($d){
                                    return $d->samplingSite->name;
                                }
                            ],
                            [
                                'attribute'=>'sampling_adress',
                                'value'=>function($d){
                                    $lang = Yii::$app->language;
                                    $ads = 'lot';
                                    if($lang == 'ru'){
                                        $ads = 'ru';
                                    }elseif($lang=='uz'){
                                        $ads = 'lot';
                                    }else{
                                        $ads = 'cyr';
                                    }
                                    return \common\models\Soato::Full($d->samplingSite->soato) .' '. $d->sampling_adress;
                                },
                                'format'=>'raw'
                            ],
                            [
                                'label'=>Yii::t('client','Namuna oluvchi'),
                                'value'=>function($d){
                                    if($d->sampler_person_pnfl){
                                        return $d->sampler_person_pnfl.'<br>'.@$d->personPnfl->name.' '.@$d->personPnfl->surname.' '.@$d->personPnfl->middlename;
                                    }elseif($d->sampler_person_inn){
                                        return $d->sampler_person_inn.'<br>'.$d->personInn->name;
                                    }else return null;
                                },
                                'format'=>'raw'
                            ],

                            'sampling_date',
                            'send_sample_date',

                            [
                                'attribute'=>'based_public_information',
                                'value'=>function($d){
                                    if($d->based_public_information == 0){
                                        return Yii::t('client','Yo\'q');
                                    }else{
                                        return Yii::t('client','Ha').'<br>'.'<b>№'.$d->message_number.'</b>';
                                    }

                                },
                                'format'=>'raw'
                            ],
                            [
                                'attribute'=>'status_id',
                                'value'=>function($d){
                                    $lg = 'uz';
                                    if(Yii::$app->language == 'ru'){
                                        $lg = 'ru';
                                    }
                                    return @$d->status->{'name_'.$lg};
                                }
                            ],
                        ],
                    ]); ?>
                    <?php
                    \yii\widgets\Pjax::end();
                    ?>
                </div>
            </div>
        </div>
    </div>



</div>
