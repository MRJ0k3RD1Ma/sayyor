<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\AnimalsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="animals-search">

    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'id' => 'animals-grid-filters',
        'fieldConfig' => [
        ],
    ]); ?>

                <div class="card-header flex">
                    <div></div>
                    <div class="btns flex">
                        <div class="search" style="margin-bottom: -1rem!important;">
                            <?= $form->field($model, 'q', [
                                'template' => '<div class="input-group">{input}<span class="btn btn-primary fa fa-search"></span></div>'
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

                                    Html::a('<span class="fa fa-file-pdf"></span> PDF ', Yii::$app->request->url . $char . 'export=2', ['data-pjax' => 0,'target'=>'_blank']) ?>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>


    <?php ActiveForm::end(); ?>

</div>
