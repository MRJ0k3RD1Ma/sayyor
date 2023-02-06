<?php

/* @var $regmodel common\models\FoodRegistration */
/* @var $model common\models\FoodSamples */
/* @var $composite common\models\FoodCompose */
/* @var $result common\models\ResultFood */
/* @var $samples \common\models\FoodSamples*/
/* @var $sertificate common\models\Sertificates */

use common\models\Employees;
use common\models\FoodRoute;
use common\models\Individuals;
use common\models\LegalEntities;
use common\models\Regulations;
use common\models\ResultAnimal;
use common\models\ResultFood;
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
use yii\helpers\VarDumper;

$composite = \common\models\FoodCompose::findOne(['registration_id'=>$regmodel->id]);
$samples = $composite->sample;
$sertificate = $samples->sert;
$resultfood = ResultFood::find()->where('sample_id in 
(select food_samples.id from food_samples inner join food_compose on food_compose.registration_id='.$regmodel->id.' 
where food_samples.is_group=1 and food_compose.status_id<>6)')->all();
$route = FoodRoute::findOne(['sample_id' => $samples->id]);
$routesert = $route->registration_id;

$lg = 'uz';


?>

<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th style="width: 50%;height: 100px;text-align: center;vertical-align: middle">
            <?php
            echo $regmodel->organization->NAME_FULL;
            ?>
            <p style="font-size: 12px; font-weight: normal">STIR(INN): <?= $regmodel->organization->TIN?> Manzil: <?= Soato::Full($regmodel->organization->soato).' '. $regmodel->organization->ADDRESS ?> Telefon: <?= $regmodel->organization->TELEFON?></p>
            <p>Sertifikat: <?= @$regmodel->conformity->code ?></p>
        </th>
        <th style="width: 50%;height: 100px;text-align: center;vertical-align: middle">
            <?php

            $qr = Builder::create()
                ->writer(new PngWriter())
                ->writerOptions([])
                ->data(Yii::$app->urlManager->createAbsoluteUrl(['/site/viewsertmultifood', 'id' => $samples->id]))
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
            if($done) {
                echo "<img src='{$qr->getDataUri()}'>";
            }else{echo "<h4 style='text-align: center; color: red'>Namuna bayonnomasi hali tasdiqlanmagan</h4>";}
            ?>
        </th>
    </tr>
    </thead>

</table>
<div class="align-content-center" style="text-align: center">
    <b>TEKSHIRUV BAYONNOMASI № <?= @$regmodel->res ?></b>
</div>
<br>
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
            . Soato::Full($legal->soato_id);

    }else {
        $ind = Individuals::findOne(['pnfl' => $regmodel->pnfl]);
        echo $regmodel->pnfl . " " . $regmodel->inn . " "
            . $ind->surname . " "
            . $ind->name . " "
            . $ind->middlename . " "
            . Soato::Full($ind->soato_id);
    }
    ?>
</div>
<br>

<?php $true=false; foreach ($resultfood as $resanim): ?>
<?php if($true){ echo "<pagebreak>"; }else{$true = true;} ?>
 <?php

    $sample = $resanim->sample;
    $route = FoodRoute::findOne(['sample_id'=>$resanim->sample_id]);
    ?>
<div>
    <b>Tekshiruv obyekti:</b>
    <b>Mahsulot guruhi:</b><?= $sample->category->{'name_'.$lg}.'-'.$sample->food->{'name_'.$lg} ?>
    <b>Qo'shimcha ma'lumotlar:</b>
    <b>Ishlab chiqarilgan davlat:</b> <?= @$sample->country->name_uz ?>
    <b>Ishlab chiqaruvchi:</b> <?= $sample->producer?>
    <b>Namuna kodi:</b> <?= $sample->samp_code?>

</div>
<br>
<div>
    <b>Namuna olish joyi:</b> <?= $sertificate->samplingSite->name ?>, <b>manzili:</b> <?= Soato::Full($sertificate->samplingSite->soato) ?>
</div>
<br>
<div>
    <b>Tekshiruv maqsadi va vazifasi:</b> <?= @$sertificate->verificationPupose->name_uz?>
</div>
<br>

    <?php $tpu=false; foreach (FoodRoute::find()->where(['sample_id'=>$samples->id])->all() as $route):
        $cond = \common\models\ResultFoodConditions::findOne(['sample_id' => $route->sample_id, 'route_id' => $route->id, 'result_id' => $resanim->id]) ?>

        <?php if($tpu){ echo "<pagebreak>"; }else{$tpu = true;} ?>
        <div style="text-align: center">
            <b>TEKSHIRUV NATIJALARI</b>
        </div>
        <div>
            <b>Tekshirish o'tkazilgan shartoit: Tempratura:</b><?= @$cond->temprature?>, <b>Namlik:</b> <?= @$cond->humidity?>, <b>Reaktivlar:</b> <?= @$cond->reagent_series.' '.@$cond->reagent_name?>, <b>Boshqa sharoitlar:</b><?= @$cond->conditions?>
        </div>
        <?php
        $docs = \common\models\Regulations::find()->select(['regulations.*'])->innerJoin('template_food_regulations', 'template_food_regulations.regulation_id = regulations.id')
            ->innerJoin('template_food', 'template_food.id=template_food_regulations.template_id')
            ->where('template_food.id in (select result_food_tests.template_id from result_food_tests where result_food_tests.checked = 1 and result_id=' . $resanim->id . ' and route_id='.$route->id.')')
            ->groupBy('regulations.id')->all();
        ;
        ?>
        <div>
            <b>Tekshirish usuli bo'yicha NH:</b> <?php $n=0; foreach ($docs as $item){$n++; echo '<br>'.$n.'.'.$item->{'name_'.$lg}.' ';} ?>
        </div>

<table class="table table-bordered table-hover" style="text-align: center">
    <thead>
    <tr>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">
            Parametr guruhi
        </th>
        <th rowspan="2" style="text-align: center;vertical-align: middle;">
            Parametr (talab) nomi
        </th>
        <th colspan="4">
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
        <th>
            Normativga mosligi
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Namuna raqami</td>
        <td colspan="3"><?= $samples->samp_code?> - <?= $samples->coments ?></td>
    </tr>
    <?php foreach ($resanim->tests as $item): ?>
        <tr>
            <td><?= $item->template->group->name_uz ?></td>
            <td><?= $item->template->name_uz?></td>
            <td><?= $item->unit->{'name_' . $lg} ?></td>
            <?php $type = $item->unit->type_id; if ($type == 1) { ?>
                <td><?= $item->ch_min1 . '-' . $item->ch_max1 ?></td>
            <?php } elseif ($type == 2) { ?>
                <td><?= Yii::$app->params['result'][intval($item->ch_min1)].'-'.Yii::$app->params['result'][intval($item->ch_max1)] ?></td>
            <?php } elseif ($type == 3) { ?>
                <td><?= $item->ch_min1 . '-' . $item->ch_max1 . ' %' ?></td>
            <?php } elseif ($type == 4) { ?>
                <td><?= $item->ch_min1 . '-' . $item->ch_max1 ?>
                    <br> <?= $item->ch_min2 . '-' . $item->ch_max2 ?></td>
            <?php }elseif($type == 5){ ?>
                <td><?= Yii::$app->params['unit_belgi'][intval($item->ch_min1)].' - '.Yii::$app->params['unit_belgi'][intval($item->ch_max1)]?></td>
            <?php }?>
            <td>
                <?php if ($type == 1) { ?>
                    <?= $item->result ?>
                <?php } elseif ($type == 2) { ?>
                    <?= Yii::$app->params['result'][intval($item->result)] ?>
                <?php } elseif ($type == 3) { ?>
                    <?= $item->result . ' %' ?>
                <?php } elseif ($type == 4) { ?>
                    <?= $item->result . '-' . $item->result_2 ?>
                <?php }elseif($type == 5){ ?>
                    <?= Yii::$app->params['unit_belgi'][intval($item->result)]?>
                <?php }?>
            </td>
            <td><?= @$item->resultType->name_uz?></td>


        </tr>
    <?php endforeach;?>
    </tbody>
</table>


<?php $ra = [null=>'Kiritilmagan',0=>'Tasdiqlanmadi',1=>'Tasdiqlandi']; $color = [null=>'Kiritilmagan',0=>'',1=>'red'];?>
<p>Umumlashgan natija: <span style="color: <?= $color[$resanim->ads]?>"><?= $ra[$resanim->ads] ?></span></p>

<p>Tekshirish sanasi: <?= $route->updated ?></p>
<p>Qo'shimcha ma`lumot: Ushbu sinov bayoni faqat tekshirilgan namuna uchun taaluqlidir</p>
<p>
    Tekshirish o'tkazdi: <?= @$route->executor->name ?>
</p>
<p>Labaratoriya mudir: <?= @$route->leader->name ?></p>
<p>
    Tasdiqladi: <?= @$route->director->name ?>
</p>

<?php endforeach; endforeach;?>