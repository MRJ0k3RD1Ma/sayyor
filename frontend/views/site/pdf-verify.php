<?php

/* @var $regmodel common\models\SampleRegistration */
/* @var $model common\models\Samples */
/* @var $composite common\models\CompositeSamples */

/* @var $sertificate common\models\Sertificates */

use common\models\Individuals;
use common\models\LegalEntities;
use common\models\ResultAnimal;
use common\models\RouteSert;
use common\models\Soato;
use common\models\Tshx;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

$composite = $regmodel->comp;
$samples = $model;
$sertificate = $samples->sert;
$resultanimal = ResultAnimal::findOne(['sample_id' => $samples->id]);


$route = RouteSert::findOne(['sample_id' => $samples->id]);
$routesert = $route->registration_id;

$lg = 'uz';
$qr =function() use ($samples) {
    $data=Builder::create()
        ->writer(new PngWriter())
        ->writerOptions([])
        ->data(Yii::$app->urlManager->createAbsoluteUrl(['/site/viewsert','id'=>$samples->id]))
        ->encoding(new Encoding('UTF-8'))
        ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
        ->size(100)
        ->margin(3)
        ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
//                        ->logoPath(Yii::$app->basePath.'/web/favicon.ico')
        ->labelText('')
        ->labelFont(new NotoSans(20))
        ->labelAlignment(new LabelAlignmentCenter())
        ->build();
    return $data->getDataUri();
};

?>
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th style="width: 50%;height: 100px;text-align: center;vertical-align: middle">
            <?php
            echo $regmodel->organization->NAME_FULL;
            ?>
            <p style="font-size: 12px; font-weight: normal">STIR(INN): <?= $regmodel->organization->TIN?> Manzil: <?= Soato::Full($regmodel->organization->soato).' '. $regmodel->organization->ADDRESS ?> Telefon: <?= $regmodel->organization->TELEFON?></p>
        </th>
        <th style="width: 50%;height: 100px;text-align: center;vertical-align: middle">

            <?= "<img src='{$qr()}'>";?>
        </th>
    </tr>
    </thead>

</table>
<div class="align-content-center" style="text-align: center">
    <b>TEKSHIRISH BAYONNOMASI № <?= $resultanimal->code ?></b>
</div>
<div>
    <b>Buyurtmachi nomi va manzili:</b> <?php
    if ($regmodel->inn) {
        $legal = LegalEntities::findOne(['inn' => $regmodel->inn]);
        echo $legal->inn
            . " "
            . $legal->name
            . " "
            . Tshx::findOne(['id' => $legal->tshx_id])->name_uz
            . " "
            . Soato::Full($legal->soato_id,'lot');

    } else {
        $ind = Individuals::findOne(['pnfl' => $regmodel->pnfl]);
        echo $regmodel->pnfl . " " . $regmodel->inn . " "
            . $ind->surname . " "
            . $ind->name . " "
            . $ind->middlename . " "
            . Soato::Full($ind->soato_id,'lot');
    }
    ?>
</div>
<div>
    <?php
    $res = "";
    $d = $samples;
    $res .= $d->animal->type->{'name_' . $lg} . ' ';
    $res .= Yii::t('lab', 'Holati:') . ' ' . $d->animal->cat->{'name_' . $lg} . ' ';
    $res .= Yii::t('lab', 'Jinsi:') . ' ' . Yii::$app->params['gender'][$d->animal->gender] . ' ';
    $d1 = new DateTime($d->animal->birthday);
    $d2 = new DateTime(date('Y-m-d'));
    $interval = $d1->diff($d2);
    $diff = $interval->m + ($interval->y * 12);
    $res .= Yii::t('lab', 'Tug\'ilgan sanasi:') . ' ' . $d->animal->birthday . '(' . $diff . ' oy)';
    ?>
    <b>Tekshiruv obyekti: Namuna nomi:</b> <?= $samples->sampleTypeIs->name_uz ?> <br>
    <b>Hayvon ma'lumotlari:</b> <?= $res?>
</div>

<div>
    <b>Namuna olingan joy:</b> <?= $sertificate->vetSite->name ?>, <b>manzili:</b> <?= Soato::Full($sertificate->vetSite->soato) ?>
</div>

<div>
    <b>Tekshirish usuli bo'yicha NH:</b> <?php $n=0; foreach ($docs as $item){$n++; echo '<br>'.$n.'.'.$item->{'name_'.$lg}.' ';} ?>
</div>

<div>
    <b>Tekshirish maqsadi va vazifasi: Kasallikga tashhisi:</b> <?= $samples->suspectedDisease->name_uz?>
</div>

<div>
    <b>Tekshirish o'tkazilgan shartoit: Tempratura:</b><?= $resultanimal->temprature?>, <b>Namlik:</b> <?= $resultanimal->humidity?>, <b>Reaktivlar:</b> <?= $resultanimal->reagent_series.' '.$resultanimal->reagent_name?>, <b>Boshqa sharoitlar:</b><?= $resultanimal->conditions?>
</div>

<div style="text-align: center">
    <b>TEKSHIRUV NATIJALARI</b>
</div>

<p><b>Namuna raqami:</b> <?= $samples->kod?></p>
<table class="table table-bordered table-hover" style="text-align: center">
    <thead>
    <tr>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">
            Parametr (talab) nomi
        </th>
        <th colspan="3">
            Parametr qiymatlari
        </th>

    </tr>
    <tr>
        <th>Birlik</th>
        <th>
            NH bo'yicha
        </th>
        <th>
            Haqiqatda
        </th>

    </tr>
    </thead>
    <tbody>
    <tr>
        <td>4Vet</td>
        <td colspan="4"><?= $route->vet4?></td>
    </tr>
    <?php foreach ($resultanimal->tests as $item): ?>
        <tr>
            <td><?= $item->template->name_uz?></td>
            <td><?= $item->template->unit->name_uz ?></td>
            <?php if ($item->template->unit->type_id == 1) { ?>
                <td><?= $item->template->min . '-' . $item->template->max ?></td>
            <?php } elseif ($item->template->unit->type_id == 2) { ?>
                <td><?= Yii::$app->params['result'][$item->template->min] ?></td>
            <?php } elseif ($item->template->unit->type_id == 3) { ?>
                <td><?= $item->template->min . '-' . $item->template->max . ' %' ?></td>
            <?php } elseif ($item->template->unit->type_id == 4) { ?>
                <td><?= $item->template->min . '-' . $item->template->max ?>
                    <br> <?= $item->template->min_1 . '-' . $item->template->max_1 ?></td>
            <?php } ?>


            <?php if ($item->template->unit->type_id == 1) { ?>
                <td><?= $item->result ?></td>
            <?php } elseif ($item->template->unit->type_id == 2) { ?>
                <td><?= @Yii::$app->params['result'][$item->result] ?></td>
            <?php } elseif ($item->template->unit->type_id == 3) { ?>
                <td><?= $item->template->min . '-' . $item->template->max ?></td>
            <?php } elseif ($item->template->unit->type_id == 4) { ?>
                <td><?= $item->result.'-'.$item->result_2?></td>
            <?php } ?>



        </tr>
    <?php endforeach;?>
    </tbody>
</table>

<?php $ra = [0=>'Tasdiqlanmadi',1=>'Tasdiqlandi']; $color = [0=>'',1=>'red'];?>
<p>Umumlashgan natija: <span style="color: <?= $color[$resultanimal->ads]?>"><?= $ra[$resultanimal->ads] ?></span></p>
<p>Tekshirish sanasi: <?= $route->updated ?></p>
<p>
    Tekshirish o'tkazdi: <?= $route->executor->name ?>
</p>
<p>
    Tasdiqladi: <?= $route->director->name ?>
</p>