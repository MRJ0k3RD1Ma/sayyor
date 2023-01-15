<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.diseases', 'Kasalliklar ro`yhati');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diseases-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'disease-grid',
                        'summary' => '',
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
                            'name_uz',
                            'name_ru',
//                            'category_id',
//                            'group_id',
                            [
                                'attribute' => 'category_id',
                                'value' => function ($d) {
                                    $lang = Yii::$app->language;
                                    if ($lang == 'ru') {
                                        return $d->category->name_ru;
                                    } else {
                                        return $d->category->name_uz;
                                    }
                                }
                            ],
                            [
                                'attribute' => 'group_id',
                                'value' => function ($d) {
                                    $lang = Yii::$app->language;
                                    if ($lang === 'ru') {
                                        return $d->group->name_ru;
                                    }

                                    return $d->group->name_uz;
                                }
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>


</div>
