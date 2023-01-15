<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TamplateAnimalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Hayvon kasalliklari tashhisi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tamplate-animal-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Hayvon kasalliklari tashhisi qo\'shish'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'attribute' => 'diseases_id',
                'value' => function (\common\models\TamplateAnimal $model) {
                    return $model->diseases->name_uz;
                }
            ],
            [
                'attribute' => 'test_method_id',
                'value' => function (\common\models\TamplateAnimal $model) {
                    return $model->testMethod->name_uz;
                }
            ],
            //'test_method_id',
            'name_uz',
            'name_ru',
            //'unit_id',
            'min',
            'min_1',
            'max',
            'max_1',
            //'is_vaccination',
            //'dead_days',
            //'creator_id',
            //'consent_id',
            //'created',
            //'updated',
            //'state_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \common\models\TamplateAnimal $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
