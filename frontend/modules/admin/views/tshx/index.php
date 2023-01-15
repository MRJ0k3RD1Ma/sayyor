<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TshxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.tshx', 'Tashkiliy huquqiy shakllar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tshx-index">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php \yii\widgets\Pjax::begin(['enablePushState' => false, 'timeout' => false]); ?>
                    <?php echo $this->render('_search', [
                        'model' => $searchModel,
                    ]);
                    ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'tshx-grid',
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
                            'name_uz',
                            'name_ru',
//                            'code',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                    <?php \yii\widgets\Pjax::end();?>
                </div>
            </div>
        </div>
    </div>



</div>
