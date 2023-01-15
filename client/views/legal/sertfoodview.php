<?php

use common\models\DestructionSampleFood;
use common\models\FoodRoute;
use common\models\ResultFood;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SampleRegistration */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cp.sertificates', 'Arizalar ro\'yhati'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sertificates-view">


    <p style="font-weight: bold">
        <a href="#" class="btn btn-primary"><?= $model->status->icon ?> <?= $model->status->name_uz ?></a>
    </p>

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
                    <th>Qo'shimcha ma`lumot</th>
                    <th>Soni</th>
                    <th>O'rami</th>
                    <th>Holati</th>
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
                        <?php
                        $cnt = 0;
                        $destruction_id = @DestructionSampleFood::findOne(['state_id' => 1, 'sample_id' => $item->id])->id;
                        $RouteSert=@ResultFood::find()->where('end_date is not null')->andWhere(['sample_id' => $item->id])->one();
                        ?>
                        <td rowspan="
                            <?= $cnt + 1 ?>">
                            <div style="margin: 5px; color: #ffffff!important;">
                                <?= ($RouteSert) ? Html::a($item->status->icon . ' ' . $item->samp_code, ['/legal/food-pdf', 'id' => $item->id], ['class' => 'btn btn-success']) : $item->status->icon . ' ' . $item->samp_code ?>
                            </div>
                            <div style="margin: 5px;">
                                <?= ($destruction_id) ? Html::a("Namunani yo'q qilish dalolatnomasi", ['/legal/pdf-food', 'id' => $destruction_id], ['class' => 'btn btn-danger']) : '' ?>
                            </div>
                        </td>
                        <td><?= $item->category->{'name_'.$lg}.' '.$item->food->{'name_'.$lg} ?></td>
                        <td><?= @$item->coments?></td>
                        <td><?= $item->count . ' ' . $item->unit->{'name_' . $lg} ?></td>
                        <td><?= $item->sampleBox->{'name_' . $lg} ?></td>
                        <td><?= $item->sampleCondition->{'name_' . $lg} ?></td>
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
