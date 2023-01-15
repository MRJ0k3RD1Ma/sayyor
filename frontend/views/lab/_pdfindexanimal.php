<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\RouteSertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('food', 'Hayvon kasalliklari namunalar ro\'yhati');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-sert-index">

    <?= GridView::widget([
        'id' => 'indexanimal-grid',
        'summaryOptions' => ['class' => 'summary'],
        'summary' => '',
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'sample_id',
                'value' => function ($d) {
                    $url = Yii::$app->urlManager->createUrl(['/lab/viewanimal', 'id' => $d->id]);
                    return "<a href='{$url}'>{$d->sample->kod}</a>";
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'executor_id',
                'value' => function ($d) {
                    if ($d->executor_id) {
                        return $d->executor->name;
                    }
                    return null;
                }
            ],
            'deadline',
            'ads',
            'created',
            [
                'attribute' => 'status_id',
                'format' => 'html',
                'value' => function ($d) {
                    $lg = 'uz';
                    if (Yii::$app->language == 'ru') {
                        $lg = 'ru';
                    }
                    return $d->status->{'name_' . $lg};
                }
            ],
        ],
    ]) ?>

</div>
