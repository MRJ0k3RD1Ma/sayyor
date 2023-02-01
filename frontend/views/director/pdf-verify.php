<?php

/* @var $regmodel common\models\SampleRegistration */
/* @var $model common\models\Samples */
/* @var $composite common\models\CompositeSamples */

/* @var $sertificate common\models\Sertificates */

use common\models\Individuals;
use common\models\LegalEntities;
use common\models\ResultAnimal;
use common\models\ResultAnimalTests;
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
$anim  = $resultanimal;


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
                <p>Sertifikat: <?= @$regmodel->conformity->code ?></p>
            </th>
            <th style="width: 50%;height: 100px;text-align: center;vertical-align: middle">
                <?php if($done){?>
                    <?= "<img src='{$qr()}'>";?>
                <?php }else{?>
                    <h4 style="text-align: center; color: red">Bayonnoma hali tayyor emas</h4>
                <?php }?>
            </th>
        </tr>
        </thead>

    </table>
    <div class="align-content-center" style="text-align: center">
        <b>TEKSHIRISH BAYONNOMASI № <?= @$regmodel->res ?></b>
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

        $samples = $model;
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
        <b>Hayvon ma'lumotlari:</b> <?= $res ?>
    </div>

    <div>
        <b>Namuna olingan joy:</b> <?= $sertificate->vetSite->name ?>, <b>manzili:</b> <?= Soato::Full($sertificate->vetSite->soato) ?>
    </div>
    <div>
        <b>Tekshirish maqsadi va vazifasi: Kasallikga tashhisi:</b> <?= $samples->suspectedDisease->name_uz?>
    </div>

<?php $true=false; foreach (RouteSert::find()->where(['sample_id'=>$samples->id])->all() as $route):
    $cond = \common\models\ResultAnimalConditions::findOne(['sample_id' => $model->id, 'route_id' => $route->id, 'result_id' => $anim->id]) ?>


    <?php if($true){ echo "<pagebreak>"; }else{$true = true;} ?>
    <div style="text-align: center">
        <b>TEKSHIRUV NATIJALARI</b>
    </div>
    <?php
    $docs = \common\models\Regulations::find()->select(['regulations.*'])->innerJoin('template_animal_regulations', 'template_animal_regulations.regulation_id = regulations.id')
        ->innerJoin('tamplate_animal', 'tamplate_animal.id=template_animal_regulations.template_id')
        ->where('tamplate_animal.id in (select result_animal_tests.template_id from result_animal_tests where result_animal_tests.checked = 1 and result_id=' . $anim->id . ' and route_id='.$route->id.')')
        ->groupBy('regulations.id')->all();
    ;
    ?>
    <div>
        <b>Tekshirish usuli bo'yicha NH:</b> <?php $n=0; foreach ($docs as $item){$n++; echo '<br>'.$n.'.'.$item->{'name_'.$lg}.' ';} ?>
    </div>


    <div>
        <b>Tekshirish o'tkazilgan shartoit: Tempratura:</b><?= @$cond->temprature?>, <b>Namlik:</b> <?= @$cond->humidity?>, <b>Reaktivlar:</b> <?= @$cond->reagent_series.' '.@$cond->reagent_name?>, <b>Boshqa sharoitlar:</b><?= @$cond->conditions?>
    </div>



    <p><b>Namuna raqami:</b> <?= $samples->kod?></p>
    <table class="table table-bordered table-hover" style="text-align: center">
        <thead>
        <tr>
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
            <th>Normativga mosligi</th>

        </tr>
        </thead>
        <tbody>
        <tr>
            <td>4Vet</td>
            <td colspan="4"><?php  $route->vet4 ?></td>
        </tr>
        <?php foreach (ResultAnimalTests::find()->indexBy('id')->where(['result_id' => $anim->id,'route_id'=>$route->id])->andWhere(['checked'=>1])->all() as $item): ?>
            <tr>
                <td><?= $item->template->name_uz?></td>
                <td><?= $item->unit->name_uz ?></td>
                <?php $type = $item->unit->type_id; if ($type == 1) { ?>
                    <td><?= $item->ch_min1 . '-' . $item->ch_max1 ?></td>
                <?php } elseif ($type == 2) { ?>
                    <td><?= Yii::$app->params['result'][intval($item->ch_min1)] ?></td>
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
                <td>
                    <?= @$item->resultType->name_uz?>
                </td>



            </tr>
        <?php endforeach;?>
        </tbody>
    </table>


    <?php @$cond->ads = intval(@$cond->ads); $ra = [0=>'Tasdiqlanmadi',1=>'Tasdiqlandi',null=>'Kiritilmagan']; $color = [0=>'',1=>'red',null=>''];?>
    <p>Umumlashgan natija: <span style="color: <?= $color[@$cond->ads]?>"><?= $ra[@$cond->ads] ?></span></p>

    <p>Tekshirish sanasi: <?= $route->updated ?></p>
    <p>Qo'shimcha ma`lumot: Ushbu sinov bayoni faqat tekshirilgan namuna uchun taaluqlidir</p>

    <p>
        Tekshirish o'tkazdi: <?= @$route->executor->name ?>
    </p>
    <p>Labaratoriya mudir: <?= @$route->leader->name ?></p>

    <p>
        Tasdiqladi: <?= @$route->director->name ?>
    </p>
<?php endforeach;?>