<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Organizations */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organizations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="organizations-view">

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header flex">
                    <p>
                        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>
                </div>
                <div class="card-body">


                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [

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
                        ],
                    ]) ?>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header flex">
                    <div></div>
                    <div class="btns flex">

                        <div class="search">

                                <?php $form = \yii\widgets\ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false,],],'method'=>'get'])?>
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
                    <?= \yii\grid\GridView::widget([
                        'dataProvider' => $dataProvider,
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
                            'name',
                            'email:email',
                            'phone',
//                            'password',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

</div>
