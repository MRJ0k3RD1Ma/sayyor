<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LegalEntities */

$this->title = Yii::t('cp.legal_entities', 'Update Legal Entities: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.legal_entities', 'Legal Entities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'inn' => $model->inn]];
$this->params['breadcrumbs'][] = Yii::t('cp.legal_entities', 'Update');
?>
<div class="legal-entities-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
