<?php

use common\models\RouteSert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $task \common\models\TaskForm */
/* @var $route \common\models\RouteSert */
/* @var $route_gr \common\models\RouteSert */
/* @var $searchModel frontend\models\search\RouteSertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('food', 'Hayvon kasalliklari tashhisi bo`yicha kelgan namunalar ro\'yhati');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-sert-index">

    <?php $form = ActiveForm::begin() ?>

    <h3>Birlashmagan namunalar ro'yhati</h3>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>№</th>
                <th>Namuna raqami</th>
                <th>Namuna bayonnomasi</th>
                <th>Bajaruvchi</th>
                <th>Muddat</th>
                <th>Izoh</th>
                <th>Kelib tushgan</th>
                <th>Holat</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="7">Birlashmagan namunalar ro'yhati</td>
            </tr>
            <?php $m = 0 ;$cnd_smp = 1; $cnt = 0; $n=0; foreach ($route as $item): $n++;

                $cnt_smp = \common\models\FoodRoute::find()->where(['sample_id'=>$item->sample_id])->count('*');
                if($m==0){
                    $m = $cnt_smp;
                }
                ?>

                <tr>
                    <?php $txtcolor = "";
                    switch ($item->status_id){
                        case 1: $txtcolor = 'text-danger'; break;
                        case 2: $txtcolor = 'text-info'; break;
                        case 3: $txtcolor = 'text-primary'; break;
                        case 4: $txtcolor = 'text-warning'; break;
                        case 5: $txtcolor = 'text-success'; break;
                    }

                    ?>
                    <td><span class="fa fa-circle <?= $txtcolor?>"></span> <?= $n?></td>
                    <td><?php $url = Yii::$app->urlManager->createUrl(['/director/viewfood', 'id' => $item->id]); echo "<a href='{$url}' target='_blank'>{$item->sample->samp_code}</a>"?></td>
                    <?php if($m == $cnt_smp){ ?>
                        <td rowspan="<?= $cnt_smp?>">
                            <a href="<?= Yii::$app->urlManager->createUrl(['/director/getpdffood','id'=>$item->sample_id])?>" target="_blank" class="btn btn-primary">PDF faylni ko'rish</a>
                        </td>
                    <?php } $m--;?>
                    <td><?= @$item->executor->name ?></td>
                    <td><?= @$item->deadline?></td>
                    <td><?= @$item->ads?></td>
                    <td><?= @$item->created?></td>
                    <td><?= @$item->status->class . ' ' . $item->status->{'name_uz' } . "</span>"?></td>
                </tr>
            <?php endforeach;?>

            <tr><td colspan="7">Birlashgan namunalar ro'yhati</td></tr>

            <?php
            $all = count($route_gr);
            $true = true;
            foreach ($route_gr as $item): $n++;?>
                <tr>
                    <?php $txtcolor = "";
                    switch ($item->status_id){
                        case 1: $txtcolor = 'text-danger'; break;
                        case 2: $txtcolor = 'text-info'; break;
                        case 3: $txtcolor = 'text-primary'; break;
                        case 4: $txtcolor = 'text-warning'; break;
                        case 5: $txtcolor = 'text-success'; break;
                    }

                    ?>

                    <td><span class="fa fa-circle <?= $txtcolor?>"></span> <?= $n?></td>
                    <td><?php $url = Yii::$app->urlManager->createUrl(['/director/viewfood', 'id' => $item->id]); echo "<a href='{$url}' target='_blank'>{$item->sample->samp_code}</a>"?></td>
                    <?php if($true){ $true = false; ?>
                        <td rowspan="<?= $all?>"><a href="<?= Yii::$app->urlManager->createUrl(['/director/getpdfmultifood','id'=>$model->id])?>" target="_blank" class="btn btn-primary">PDF faylni ko'rish</a></td>
                    <?php }?>
                    <td><?= @$item->executor->name ?></td>
                    <td><?= @$item->deadline?></td>
                    <td><?= @$item->ads?></td>
                    <td><?= @$item->created?></td>
                    <td><?= @$item->status->class . ' ' . $item->status->{'name_uz' } . "</span>"?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <?php if($cnt_not == 0){?>
        <?= $form->field($model,'results_conformity_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\ResultsConformity::find()->where(['organization_id'=>Yii::$app->user->identity->empPosts->org_id])->all(),'id','code'))?>
        <button class="btn btn-success" type="submit">Natijalarni tasdiqlash</button>
    <?php }?>

    <?php ActiveForm::end() ?>



</div>

