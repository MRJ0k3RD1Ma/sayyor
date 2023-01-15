<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AnimalCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('cp.animal', 'Hayvon kategoriyalari');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <?php Pjax::begin(['enablePushState' => false, 'timeout' => false]); ?>
                <?php echo $this->render('_search', [
                    'model' => $searchModel,
                ]);
                ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'id' => 'animals-category-grid',
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'name_uz',
                        'name_ru',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ])
                ?>
                <?php Pjax::end(); ?>
