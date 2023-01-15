<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SampleRegistrationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp', 'Hayvon kasalliklari tashhisi bo`yicha arizalar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sample-registration-index">



    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?php Pjax::begin(['enablePushState' => 0, 'timeout' => false]); ?>
                <?php
                echo $this->render('_searchregtest', [
                    'model' => $searchModel,
                ]);

                ?>
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'regtest-grid',
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
//                            'code',

                            [
                                'label' => Yii::t('register', 'Yuboruvchi'),
                                'value' => function ($d) {
                                    if ($d->inn) {
                                        return $d->inn . '<br>' . $d->inn0->name;
                                    } elseif ($d->pnfl) {
                                        return $d->pnfl . '<br>' . $d->pnfl0->name . ' ' . $d->pnfl0->surname . ' ' . $d->pnfl0->middlename;
                                    } else {
                                        return null;
                                    }
                                },
                                'format' => 'raw'
                            ],
//                            'is_research',
                            [
                                'attribute' => 'is_research',
                                'value' => function ($d) {
                                    $s = [0 => 'Shoshilinch emas', 1 => 'Shohilinch'];
                                    return $s[$d->is_research];
                                }
                            ],
//                            'code_id',
                            //'code',
                            //'research_category_id',
                            [
                                'attribute' => 'research_category_id',
                                'value' => function ($d) {
                                    return $d->researchCategory->name_uz;
                                }
                            ],
                            //'results_conformity_id',
                            //'organization_id',
                            //'emp_id',
//                            'reg_date',
                            //'reg_id',
                            'sender_name',
                            'sender_phone',
                            'created',
                            [
                                'attribute' => 'status_id',
                                'format' => 'html',
                                'value' => function ($d) {
                                    $lg = 'uz';
                                    if (Yii::$app->language == 'ru') $lg = 'ru';
                                    return "<span class='" . $d->status->class . "'>" . @$d->status->icon . ' ' . $d->status->{'name_' . $lg} . "</span>";
                                    return $d->status->{'name_' . $lg};
                                }
                            ],
                            [
                                'attribute'=>'org_id',
                                'value'=>function($d){return $d->organization->NAME_FULL;}
                            ],
//                            'updated',
                            [
                                'class' => ActionColumn::className(),
                                'urlCreator' => function ($action, $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model->id]);
                                }
                            ],
                        ],
                    ]) ?>
                    <?php Pjax::end() ?>
                </div>
            </div>
        </div>
    </div>


</div>
