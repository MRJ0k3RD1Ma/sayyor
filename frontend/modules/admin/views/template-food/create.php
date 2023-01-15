<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TemplateFood */

$this->title = Yii::t('cp', 'Shablon qo`shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Shablonlar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-food-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
