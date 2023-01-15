<?php


/* @var $this View */
/* @var $AnimalDataProvider ActiveDataProvider */
/* @var $AnimalRegProvider ActiveDataProvider */
/* @var $FoodDataProvider ActiveDataProvider */
/* @var $FoodRegProvider ActiveDataProvider */
/* @var $SoatoDataProvider ActiveDataProvider */
/* @var $SoatoModel Soato */
/* @var $AnimalDataModel SertificatesSearch */
/* @var $AnimalRegModel SampleRegistrationSearch */
/* @var $FoodDataModel FoodSamplingCertificateSearch */
/* @var $FoodRegModel FoodRegistrationSearch */
/* @var $status array */
/* @var $counter array */
/* @var $title string */

/* @var $searchModel SertificatesSearch */

use client\models\search\FoodRegistrationSearch;
use client\models\search\SertificatesSearch;
use common\models\search\FoodSamplingCertificateSearch;
use common\models\Soato;
use frontend\models\search\SampleRegistrationSearch;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;

$this->title = $title;
?>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>
            #
        </th>
        <th>
            Hududlar nomi
        </th>
        <th>
            Jami
        </th>
        <?php foreach ($status as $name): ?>
            <th>
                <?= $name ?>
            </th>
        <?php endforeach; ?>
    </tr>

    </thead>
    <tbody>
    <?php foreach ($SoatoDataProvider->getModels() as $key => $model): ?>
        <tr>
            <td>
                <?= $key + 1 ?>
            </td>
            <td>
                <?php if(Yii::$app->request->get('id')):?>
                <?= $model->name_lot ?>
                <?php else:?>

                <a href="<?= \yii\helpers\Url::to([Yii::$app->request->url, 'id' => $model->region_id]) ?>">
                    <?= $model->name_lot ?>
                </a>
                <?php endif;?>
            </td>
            <td>
                <?= array_sum($counter[$key]) ?>
            </td>
            <?php foreach (array_keys($status) as $id => $val): ?>
                <td>

                    <?= $counter[$key][$id] ?>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<style>
    tbody, td, tfoot, th, thead, tr {
        vertical-align: middle !important;

    }

    td:nth-child(2), td:first-child, th {
        text-align: center !important;
    }

</style>
