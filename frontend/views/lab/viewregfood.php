<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\RouteSertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('food', 'Oziq ovqat havfsizligi bo`yicha kelgan namunalar ro\'yhati');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-sert-index">



    <?php $form = ActiveForm::begin() ?>

    <h3>Birlashmagan namunalar ro'yhati</h3>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th></th>
                <th>№</th>
                <th>Namuna raqami</th>
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
            <?php $cnt = 0; $n=0; foreach ($route as $item): $n++;?>

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
                    <td><?php if($item->status_id == 1){ $cnt ++; ?><?= $form->field($task,'id['.$item->id.']')->checkbox(['value'=>1])->label(false) ?><?php }?></td>
                    <td><span class="fa fa-circle <?= $txtcolor?>"></span> <?= $n?></td>
                    <td><?php $url = Yii::$app->urlManager->createUrl(['/lab/viewfood', 'id' => $item->id]); echo "<a href='{$url}' target='_blank'>{$item->sample->samp_code}</a>"?></td>
                    <td><?= @$item->executor->name ?></td>
                    <td><?= @$item->deadline?></td>
                    <td><?= @$item->ads?></td>
                    <td><?= @$item->created?></td>
                    <td><?= "<span class='" . @$item->status->icon . "'>" . @$item->status->class . ' ' . $item->status->{'name_uz' } . "</span>"?></td>
                </tr>
            <?php endforeach;?>

            <tr><td colspan="7">Birlashgan namunalar ro'yhati</td></tr>

            <?php foreach ($route_gr as $item): $n++;?>
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
                    <td><?php if($item->status_id == 1){ $cnt ++; ?><?= $form->field($task,'id['.$item->id.']')->checkbox(['value'=>1])->label(false) ?><?php }?></td>

                    <td><span class="fa fa-circle <?= $txtcolor?>"></span> <?= $n?></td>
                    <td><?php $url = Yii::$app->urlManager->createUrl(['/lab/viewfood', 'id' => $item->id]); echo "<a href='{$url}' target='_blank'>{$item->sample->samp_code}</a>"?></td>
                    <td><?= @$item->executor->name ?></td>
                    <td><?= @$item->deadline?></td>
                    <td><?= @$item->ads?></td>
                    <td><?= @$item->created?></td>
                    <td><?= "<span class='" . @$item->status->icon . "'>" . @$item->status->class . ' ' . $item->status->{'name_uz' } . "</span>"?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <?php if(!$test->temprature){?>
        <h3>Tekshiruv sharoiti</h3>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($test, 'temprature')->textInput(['type' => 'number']) ?>

                <?= $form->field($test, 'humidity')->textInput(['type' => 'number']) ?>

                <?= $form->field($test, 'conditions')->textInput() ?>


            </div>
            <div class="col-md-6">

                <?= $form->field($test, 'reagent_series')->textInput() ?>

                <?= $form->field($test, 'reagent_name')->textInput() ?>

                <?= $form->field($test, 'end_date')->textInput(['type' => 'date']) ?>

            </div>
        </div>



        <button class="btn btn-success" type="submit">Saqlash</button>

    <?php }?>
    <?php ActiveForm::end() ?>


</div>
