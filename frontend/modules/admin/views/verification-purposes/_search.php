<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\VerificationPurposesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="verification-purposes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => 'verification-purposes-grid-filters',
    ]); ?>

    <div class="card-header flex">
        <div></div>
        <div class="btns flex">
            <div class="search" style="margin-bottom: -1rem!important;">
                <?= $form->field($model, 'q', [
                    'template' => '<div class="input-group">{input}<span class="btn btn-primary fa fa-search margi"></span></div>'
                ])->textInput()->label(false) ?>
            </div>
            <div class="export">
                <?php
                $char = (count(Yii::$app->request->queryParams) > 0) ? "&" : "?";
                ?>
                <button class="btn btn-primary"><span class="fa fa-cloud-download-alt"></span> Export
                </button>
                <div class="export-btn">
                    <button>
                        <?= Html::a('<span class="fa fa-file-excel"></span> Excel ', Yii::$app->request->url . $char . 'export=1', ['data-pjax' => 0, 'export' => 1]) ?>
                    </button>
                    <button>

                        <?=

                        Html::a('<span class="fa fa-file-pdf"></span> PDF ', Yii::$app->request->url . $char . 'export=2', ['data-pjax' => 0]) ?>
                    </button>
                </div>

            </div>
            <?= Html::a(Yii::t('cp.verification_purposes', 'Tekshirish maqsadi qo\'shish'), ['create'], ['class' => 'btn btn-success']) ?>

        </div>

    </div><!-- end card header -->

    <?php ActiveForm::end(); ?>

</div>
