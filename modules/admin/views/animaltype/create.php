<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Animaltype */

$this->title = Yii::t('cp.animaltype', 'Create Animaltype');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.animaltype', 'Animaltypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animaltype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
