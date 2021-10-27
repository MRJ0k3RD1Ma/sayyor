<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OrganizationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp', 'Organizations');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="card">
    <div class="card-header flex">
        <div></div>
        <div class="btns flex">

            <div class="search">
                <?php $form = \yii\widgets\ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false,],],])?>
                    <?= $form->field($searchModel,'q',['template' => "{label}\n{input}"])->textInput(['class'=>''])->label(Yii::t('cp','Qidiruv:'))?>
                    <button class="btn" type="submit"><span class="fa fa-search"></span></button>
                <?php \yii\widgets\ActiveForm::end()?>
            </div>
            <div class="export">

                <button class="btn btn-primary"><span class="fa fa-cloud-download-alt"></span> Export</button>
                <div class="export-btn">
                    <button><span class="fa fa-file-excel"></span> Excel</button>
                    <button><span class="fa fa-file-pdf"></span> Pdf</button>
                </div>
            </div>

            <?= Html::a(Yii::t('cp', 'Create Organizations'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>



    </div><!-- end card header -->

    <div class="card-body">
        <div class="row">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
//                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'name',
                    [
                        'label'=>Yii::t('cp','Viloyat'),
                        'value'=>function($d){
                            return $d->district->region_id;
                        },
                    ],
                    [
                        'attribute'=>'district_id',
                        'value'=>function($d){
                            return $d->district->name;
                        },
                    ],
                    [
                        'label'=>Yii::t('cp','Turi'),
                        'value'=>function($d){
                            return $d->type->name;
                        },
                    ],
//                    'state',
                    [
                        'attribute'=>'state',
                        'value'=>function($d){
                            return $d->state0->name;
                        },
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
    </div>
    <!-- end card body -->
</div>
