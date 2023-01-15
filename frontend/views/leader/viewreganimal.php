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
                    <td><?php $url = Yii::$app->urlManager->createUrl(['/leader/viewanimal', 'id' => $item->id]); echo "<a href='{$url}' target='_blank'>{$item->sample->kod}</a>"?></td>
                    <td><?= @$item->executor->name ?></td>
                    <td><?= @$item->deadline?></td>
                    <td><?= @$item->ads?></td>
                    <td><?= @$item->created?></td>
                    <td><?= @$item->status->class . ' ' . $item->status->{'name_uz' } . "</span>"?></td>
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
                        <td><?php $url = Yii::$app->urlManager->createUrl(['/leader/viewanimal', 'id' => $item->id]); echo "<a href='{$url}' target='_blank'>{$item->sample->kod}</a>"?></td>
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

    <?php
    if($cnt != 0){
    $data = [];
    foreach ($emp as $i) {
        $data[$i->id] = RouteSert::find()->where(['executor_id' => $i->id])
                ->andWhere(['<>', 'status_id', 3])->count('id')
            . ' - ' . $i->name;
    }
    ?>
    <?= $form->field($task, 'executor_id')->dropDownList($data, ['prompt' => Yii::t('leader', 'Labarantni tanlang')]) ?>
    <?= $form->field($task, 'deadline')->textInput(['type' => 'date']) ?>
    <?= $form->field($task, 'ads')->textInput() ?>
    <button class="btn btn-success" type="submit">Saqlash</button>
    <?php }?>
    <?php ActiveForm::end() ?>

</div>