<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Animaltype */

$this->title = Yii::t('cp.animaltype', 'Update Animaltype: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.animaltype', 'Animaltypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cp.animaltype', 'Update');
?>
<div class="animaltype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
