<?php

use common\models\Sertificates;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

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
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'sert_id',
                            [
                                'attribute' => 'sert_full',
                                'format' => 'raw',
                                'value' => function ($d) {
                                    $url = Yii::$app->urlManager->createUrl(['/ind/view', 'id' => $d->id]);
                                    return "<a href='{$url}'>{$d->sert_full}</a>";
                                },
                            ],
                            'sert_num',
                            'sert_date',

                            [
                                'label' => 'Hayvon egasi',
                                'value' => function ($d) {
                                    if ($d->owner_pnfl) {
                                        return $d->owner_pnfl . '<br>' . $d->ownerPnfl->name . ' ' . $d->ownerPnfl->surname . ' ' . $d->ownerPnfl->middlename;
                                    } elseif ($d->owner_inn) {
                                        return $d->owner_inn . '<br>' . $d->ownerInn->name;
                                    } else {
                                        return "Hayvon egasi haqida ma'lumot kiritilmagan";
                                    }
                                },
                                'format' => 'raw'
                            ],
                            [
                                'attribute' => 'vet_site_id',
                                'value' => function ($d) {
                                    return $d->vetSite->name;
                                }
                            ],
                            //'operator',
                            [
                                'attribute' => 'status_id',
                                'value' => function ($d) {
                                    if (Yii::$app->language == 'ru') {
                                        return $d->status->name_ru;
                                    } else {
                                        return $d->status->name_uz;
                                    }
                                }
                            ],
                            /* [
                                 'class' => 'yii\grid\ActionColumn',
                                 'urlCreator' => function ($action, $model, $key, $index) {
                                     return \yii\helpers\Url::to([$action, 'id' => $model->id]);
                                 }
                             ],*/
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>


</div>
