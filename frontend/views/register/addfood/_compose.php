<?php
    use common\models\DestructionSampleFood;
    use common\models\FoodRoute;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>

<div class="row">
    <div class="col-md-12 table-responsive">
        <div>
            <h4 style="float: left">Birlashmagan namunalar ro'yhati</h4>
        </div>
        <?php $form = ActiveForm::begin();?>

        <div class="table-responsive">
            <table class="table table-bordered  table-hover mt-3">
                <thead>
                <tr>
                    <th></th>
                    <th>№</th>
                    <th>Nomi</th>
                    <th>Soni</th>
                    <th>O'rami</th>
                    <th>Holati</th>
                    <th>Turi</th>
                    <th>To'plam</th>
                    <th>Ishlab chiqaruvchi</th>
                    <th>Serya raqami</th>
                    <th>Yaroqlilik muddati</th>
                    <th>Test turi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $lang = Yii::$app->language;
                $lg = 'uz';
                if ($lang == 'ru') {
                    $lg = 'ru';
                }
                ?>
                <?php foreach ($samp as $item): ?>
                    <tr>
                        <td>
                            <?php if($item->status_id < 3){?>
                                <?= $form->field($compose,'id['.$item->id.']')->checkbox(['value'=>1]) ?>
                            <?php }?>
                        </td>
                        <td>
                            <a href="<?= Yii::$app->urlManager->createUrl(['/register/incomefood', 'id' => $item->id, 'regid' => $model->id]) ?>"><?= $item->status->icon . ' ' . $item->samp_code ?></a>
                        </td>
                        <td><?= $item->category->{'name_'.$lg}.' '.$item->food->{'name_'.$lg} ?></td>
                        <td><?= $item->count . ' ' . $item->unit->{'name_' . $lg} ?></td>
                        <td><?= $item->sampleBox->{'name_' . $lg} ?></td>
                        <td><?= $item->sampleCondition->{'name_' . $lg} ?></td>
                        <td><?= @$item->route->sampleType->name_uz ?></td>
                        <td><?= $item->total_amount ?></td>
                        <td><?= $item->producer ?></td>
                        <td><?= $item->serial_num ?></td>
                        <td><?= $item->sell_by ?></td>
                        <td><?= $item->laboratoryTestType->{'name_' . $lg} ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </div>

        <button class="btn btn-primary" type="submit">Birlashtirish</button>
        <?php ActiveForm::end()?>
    </div>
</div>