<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Diseases */

$this->title = Yii::t('cp.diseases', 'Update Diseases: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.diseases', 'Diseases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp.diseases', 'Update');
?>
<div class="diseases-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
