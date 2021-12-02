<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LegalEntities */

$this->title = Yii::t('cp.legal_entities', 'Yuridik shaxs qo\'shish');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.legal_entities', 'Yuridik shaxslar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="legal-entities-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
