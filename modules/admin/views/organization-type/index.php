<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OrganizationTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp', 'Organization Types');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-header flex">
        <div></div>
        <div class="btns flex">
            <div class="search">

                <?php $form = \yii\widgets\ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false,],],'method'=>'get'])?>
                    <?= $form->field($searchModel,'name',['template' => "{label}\n{input}"])->textInput(['class'=>''])->label(Yii::t('cp','Qidiruv:'))?>
                    <button class="btn" type="submit"><span class="fa fa-search"></span></button>
                <?php \yii\widgets\ActiveForm::end()?>
            </div>
            <div class="export">

                <button class="btn btn-primary "> <span class="fa fa-cloud-download-alt"></span> <?= Yii::t('cp','Export')?></button>
                <div class="export-btn">
                    <button><span class="fa fa-file-excel"></span>  <?= Yii::t('cp','Excel')?></button>
                    <button><span class="fa fa-file-pdf"></span>  <?= Yii::t('cp','Pdf')?></button>
                </div>
            </div>

            <?= Html::a(Yii::t('app', 'Create Organization Type'), ['create'], ['class' => 'btn btn-success']) ?>

        </div>



    </div><!-- end card header -->

    <div class="card-body">
        <div class="row">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
//                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
                    'name',
                    [
                        'label'=>Yii::t('cp','Ташкилотлар сони'),
                        'value'=>function($d){
                            return $d->count();
                        }
                    ],

                    ['class' => 'yii\grid\ActionColumn','template'=>'{update} {delete}'],
                ],
            ]); ?>
        </div>
    </div>
    <!-- end card body -->
</div>
