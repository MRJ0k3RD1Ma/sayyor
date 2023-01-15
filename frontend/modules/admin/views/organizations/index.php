<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\OrganizationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp', 'Tashkilotlar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizations-index">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?php Pjax::begin(['enablePushState' => false, 'timeout' => false]); ?>
                <?php echo $this->render('_search', [
                    'model' => $searchModel,
                ]); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'id' => 'organizations-grid',
//        'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'id',
//            'id_from_api',
                        'TIN',
//            'NA1_CODE',
//            'NS10_CODE',
                        //'NS11_CODE',
                        'NAME_FULL',
                        'ADDRESS',
                        //'REG_DATE',
                        //'DATE_TIN',
                        //'REG_NUM',
                        //'NS13_CODE',
                        'TELEFON',
                        //'TELEX',
                        //'FAX',
                        //'GD_FULL_NAME',
                        //'GD_TIN',
                        //'GD_TEL_WORK',
                        //'GD_TEL_HOME:boolean',
                        //'GD_EMAIL:email',
                        //'GB_FULL_NAME',
                        //'GB_TIN',
                        //'GB_TEL_WORK',
                        //'GB_TEL_HOME',
//            'OKED',
                        //'OKPO',
                        //'OKONX',
                        //'soato',
                        //'EMAIL:email',
                        //'DATE_END',
                        //'CREATED',
                        //'CHANGED',
                        //'GD_MOBILE',
                        //'BUDJET:boolean',
                        [
                            'attribute'=>'type_id',
                            'value'=>function($d){
                                $lg = 'uz'; if(Yii::$app->language=='ru'){$lg = 'ru';}
                                return $d->type->{'name'};
                            }
                        ],
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]) ?>
                <?php Pjax::end() ?>


            </div>
