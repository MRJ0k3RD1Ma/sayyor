<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OrganizationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp', 'Tashkilotlar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizations-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('cp', 'Tashkilot qo\'shish'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'id_from_api',
            'TIN',
//            'NA1_CODE',
//            'NS10_CODE',
            //'NS11_CODE',
            'NAME_FULL',
            'ADDRESS',
            //'REG_DATE',
            //'DATE_TIN',
            //'REG_NUM',
            //'NS13_CODE',
            'TELEFON',
            //'TELEX',
            //'FAX',
            //'GD_FULL_NAME',
            //'GD_TIN',
            //'GD_TEL_WORK',
            //'GD_TEL_HOME:boolean',
            //'GD_EMAIL:email',
            //'GB_FULL_NAME',
            //'GB_TIN',
            //'GB_TEL_WORK',
            //'GB_TEL_HOME',
//            'OKED',
            //'OKPO',
            //'OKONX',
            //'soato',
            //'EMAIL:email',
            //'DATE_END',
            //'CREATED',
            //'CHANGED',
            //'GD_MOBILE',
            //'BUDJET:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
