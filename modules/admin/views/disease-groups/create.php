<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DiseaseGroups */

$this->title = Yii::t('cp.disease_groups', 'Kasallik guruhlari');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.disease_groups', 'Kasallik guruhlari'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disease-groups-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
