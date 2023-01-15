<?php


/* @var $this View */
/* @var $AnimalDataProvider ActiveDataProvider */
/* @var $AnimalRegProvider ActiveDataProvider */
/* @var $FoodDataProvider ActiveDataProvider */
/* @var $FoodRegProvider ActiveDataProvider */
/* @var $SoatoDataProvider ActiveDataProvider */
/* @var $SoatoModel Soato */
/* @var $AnimalDataModel SertificatesSearch */
/* @var $FoodDataModel FoodSamplingCertificateSearch */
/* @var $FoodRegModel FoodRegistrationSearch */

/* @var $searchModel SertificatesSearch */

use client\models\search\FoodRegistrationSearch;
use client\models\search\SertificatesSearch;
use common\models\search\FoodSamplingCertificateSearch;
use common\models\Sertificates;
use common\models\SertStatus;
use common\models\Soato;
use frontend\models\search\SampleRegistrationSearch;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;


?>

<div class="div" style="vertical-align: center"></div>
<?= GridView::widget([
    'dataProvider' => $SoatoDataProvider,
    'summary' => '',
    'options' => ['style' => 'vertical-align:middle'],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn',

        ],

        [
            'attribute' => 'name_lot',
            'label' => 'Hududlar',
            'format' => 'html',
            'options' => ['style' => 'align-items: center;'],
            'value' => function ($SoatoModel) {
                return Html::a($SoatoModel->name_lot, ['/region/stat', 'id' => $SoatoModel->region_id]);
            }
        ],
        [
            'label' => 'Hayvon kasalliklari tashhisi dalolatnomalari',
            'format' => 'html',
            'value' => function ($SoatoModel) use ($AnimalDataProvider) {
                $counter = array_fill(0, 7, 0);
                $out = [];
                foreach ($AnimalDataProvider->getModels() as $model) {
                    $counter[$model->status->id] += Yii::$app->request->get('id') ? ($model->vetSite->soato0->district_id == $SoatoModel->district_id) : ($model->vetSite->soato0->region_id == $SoatoModel->region_id);
                }
                foreach (SertStatus::find()->all() as $status) {
                    $out[] = Html::tag('i', $status->name_uz . ": " . $counter[$status->id]);
                }
                return 'Jami: '.array_sum($counter).'<br>'.implode('<br>', $out);
            }
        ],
        [
            'label' => 'Oziq-ovqat havfsizligi dalolatnomalari',
            'format' => 'html',
            'value' => function ($SoatoModel) use ($FoodDataProvider) {
                $counter = array_fill(0, 7, 0);
                $out = [];

                foreach ($FoodDataProvider->getModels() as $model) {

                    $counter[$model->status_id] += Yii::$app->request->get('id') ? ($model->soato0->district_id == $SoatoModel->district_id) : ($model->soato0->region_id == $SoatoModel->region_id);
                }
                foreach (SertStatus::find()->all() as $status) {
                    $out[] = Html::tag('i', $status->name_uz . ": " . $counter[$status->id]);
                }
                return 'Jami: '.array_sum($counter).'<br>'.implode('<br>', $out);
            }
        ],
        [
            'label' => 'Hayvon kasalliklari tashhisi arizalari',
            'format' => 'html',
            'value' => function ($SoatoModel) use ($AnimalRegProvider) {
                $counter = array_fill(0, 7, 0);
                $out = [];

                foreach ($AnimalRegProvider->getModels() as $model) {
                    if ($model->inn) {
                        $counter[$model->status_id] += Yii::$app->request->get('id') ? ($model->inn0->soato->district_id == $SoatoModel->district_id) : ($model->inn0->soato->region_id == $SoatoModel->region_id);
                    } elseif ($model->pnfl) {
                        $counter[$model->status_id] += Yii::$app->request->get('id') ? ($model->pnfl0->soato->district_id == $SoatoModel->district_id) : ($model->pnfl0->soato->region_id == $SoatoModel->region_id);
                    }
                }
                foreach (SertStatus::find()->all() as $status) {
                    $out[] = Html::tag('i', $status->name_uz . ": " . $counter[$status->id]);
                }
                return 'Jami: '.array_sum($counter).'<br>'.implode('<br>', $out);
            }
        ],

        [
            'label' => 'Oziq-ovqat havfsizligi arizalari',
            'format' => 'html',
            'value' => function ($SoatoModel) use ($FoodRegProvider) {
                $counter = array_fill(0, 7, 0);
                $out = [];
                foreach ($FoodRegProvider->getModels() as $model) {
                    if ($model->inn) {
                        $counter[$model->status_id] += Yii::$app->request->get('id') ? ($model->inn0->soato->district_id == $SoatoModel->district_id) : ($model->inn0->soato->region_id == $SoatoModel->region_id);
                    } elseif ($model->pnfl) {
                        $counter[$model->status_id] += Yii::$app->request->get('id') ? ($model->pnfl0->soato->district_id == $SoatoModel->district_id) : ($model->pnfl0->soato->region_id == $SoatoModel->region_id);
                    }
                }
                foreach (SertStatus::find()->all() as $status) {
                    $out[] = Html::tag('i', $status->name_uz . ": " . $counter[$status->id]);
                }
                return 'Jami: '.array_sum($counter).'<br>'.implode('<br>', $out);
            }
        ],
    ]
]) ?>
<style>
    tbody, td, tfoot, th, thead, tr {
        vertical-align: middle !important;

    }
    td:nth-child(2), td:first-child,th{
        text-align: center!important;
    }

</style>
