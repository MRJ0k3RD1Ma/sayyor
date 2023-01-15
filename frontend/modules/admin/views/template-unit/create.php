<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TemplateUnit */

$this->title = Yii::t('app', 'Shablon birliklari qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shablon birliklari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-unit-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
