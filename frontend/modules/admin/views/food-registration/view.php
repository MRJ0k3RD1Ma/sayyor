<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\FoodRegistration */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp', 'Food Registrations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="food-registration-view">



    <div class="sertificates-view">



        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'code',
                [
                    'label' => Yii::t('register', 'Yuboruvchi'),
                    'value' => function ($d) {
                        if ($d->inn) {
                            return $d->inn . '<br>' . $d->inn0->name;
                        } elseif ($d->pnfl) {
                            return $d->pnfl . '<br>' . $d->pnfl0->name . ' ' . $d->pnfl0->surname . ' ' . $d->pnfl0->middlename;
                        } else {
                            return null;
                        }
                    },
                    'format' => 'raw'
                ],
//                            'is_research',
                [
                    'attribute' => 'is_research',
                    'value' => function ($d) {
                        $s = [0 => 'Shoshilinch emas', 1 => 'Shohilinch'];
                        return $s[$d->is_research];
                    }
                ],

                [
                    'attribute' => 'research_category_id',
                    'value' => function ($d) {
                        return $d->researchCategory->name_uz;
                    }
                ],

                'sender_name',
                'sender_phone',
                'created',
                [
                    'attribute' => 'status_id',
                    'value' => function ($d) {
                        $lg = 'uz';
                        if (Yii::$app->language == 'ru') $lg = 'ru';
                        return $d->status->{'name_' . $lg};
                    }
                ],
                //'updated',
            ],
        ]) ?>

    </div>


    <div class="row">
        <div class="col-md-12 table-responsive">
            <div>
                <h4 style="float: left">Namunalar ro'yhati</h4>

                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered  table-hover mt-3">
                    <thead>
                    <tr>
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

                            <td><a href="#"></a>
                                <?php if ($item->status_id < 3) { ?>
                                    <a href="<?= Yii::$app->urlManager->createUrl(['/register/incomefood', 'id' => $item->id, 'regid' => $model->id]) ?>"><?= $item->status->icon . ' ' . $item->samp_code ?></a>
                                <?php } else { ?>
                                    <?php $cnt = 0;
                                    $destruction_id = @\common\models\DestructionSampleFood::findOne(['state_id' => 1, 'sample_id' => $item->id])->id;
                                    $RouteSert = @\common\models\FoodRoute::findOne(['sample_id' => $item->id, 'status_id' => 3]);
                                    ?>
                                    <?= ($RouteSert) ? Html::a($item->status->icon . ' ' . $item->samp_code, ['/ind/food-pdf', 'id' => $item->id], ['class' => 'btn btn-warning']) : $item->status->icon . ' ' . $item->samp_code ?>
                                    <?= ($destruction_id) ? Html::a("Yo'q qilish dalolatnomasi", ['/ind/pdfdestfood', 'id' => $destruction_id], ['class' => 'btn btn-danger']) : '' ?>
                                <?php } ?>
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
        </div>
    </div>


</div>
