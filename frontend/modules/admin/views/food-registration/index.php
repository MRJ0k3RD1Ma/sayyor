<?php

use common\models\Sertificates;
use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\FoodRegistrationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp', 'Mahsulot ekspertizasi bo`yicha arizalar');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <?php Pjax::begin(['enablePushState' => 0, 'timeout' => false]); ?>
            <?php
            echo $this->render('_searchregproduct', [
                'model' => $searchModel,
            ]);

            ?>
            <div class="card-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'id' => 'regproduct-grid',
//                        'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'code',
                        [
                            'label' => Yii::t('client', 'Namuna raqamlari'),
                            'value' => function ($d) {
                                $res = "";
                                foreach ($d->comp as $item) {
                                    $res .= $d->status->icon . $item->sample->samp_code . '<br>';
                                }
                                return $res;
                            },
                            'format' => 'raw',
                        ],
                        [
                            'label' => Yii::t('register', 'Labaratoriya'),
                            'value' => function ($d) {
                                return $d->organization->NAME_FULL;
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
                        [
                            'attribute' => 'research_category_id',
                            'value' => function ($d) {
                                return $d->researchCategory->name_uz;
                            }
                        ],

                        'sender_name',
                        'sender_phone',
                        'created',
                        [
                            'attribute' => 'status_id',
                            'value' => function ($d) {
                                $lg = 'uz';
                                if (Yii::$app->language == 'ru') $lg = 'ru';
                                return $d->status->{'name_' . $lg};
                            }
                        ],
                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action,  $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            }
                        ],
                    ],
                ]) ?>
                <?php Pjax::end()?>
            </div>
        </div>
    </div>
</div>