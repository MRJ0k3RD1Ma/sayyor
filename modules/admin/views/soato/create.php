<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Soato */

$this->title = Yii::t('cp', 'Create Soato');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Soatos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soato-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
