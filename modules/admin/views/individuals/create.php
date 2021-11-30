<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Individuals */

$this->title = Yii::t('cp.individuals', 'Create Individuals');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.individuals', 'Individuals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="individuals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
