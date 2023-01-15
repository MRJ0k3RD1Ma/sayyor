<?php

use common\models\Requirements;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\RequirementsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp', 'Oziq-ovqat ekspertizasi talablari');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requirements-index">


    <p>
        <?= Html::a(Yii::t('cp', 'Oziq-ovqat ekspertizasi talablarini yaratish'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name_uz',
            'name_ru',
            [
                'class' => ActionColumn::class,
                'urlCreator' => static function ($action, Requirements $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
