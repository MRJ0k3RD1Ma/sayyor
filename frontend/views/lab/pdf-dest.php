<?php


/*@var DestructionSampleAnimal $model*/
?>
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th style="width: 50%;height: 100px;text-align: center;vertical-align: middle">
            <?php

            use common\models\DestructionSampleAnimal;

            echo "OK";// $model->organization->NAME_FULL;
            ?>
        </th>
        <th style="width: 50%;height: 100px;text-align: center;vertical-align: middle">
            <img src="<?=   "http://sayyor.loc/img.png" ?>" alt="">
        </th>
    </tr>
    </thead>

</table>
<div class="align-content-center" style="text-align: center">
    <b>Yo'q qilish bayonnomasi № <?= $model->code ?></b>
</div>
<br>
<div>
    <?php
    $about = function ($model) {
        $d = $model->sample;
        $lg = 'uz';
        if (Yii::$app->language == 'ru') $lg = 'ru';
        $res = "";
        $res .= $d->animal->type->{'name_' . $lg} . ', ';
        $res .= Yii::t('lab', 'Holati:') . ' ' . $d->animal->cat->{'name_' . $lg} . ', ';
        $res .= Yii::t('lab', 'Jinsi:') . ' ' . Yii::$app->params['gender'][$d->animal->gender] . ', ';
        $d1 = new DateTime($d->animal->birthday);
        $d2 = new DateTime(date('Y-m-d'));
        $interval = $d1->diff($d2);
        $diff = $interval->m + ($interval->y * 12);
        $res .= Yii::t('lab', 'Tug\'ilgan sanasi:') . ' ' . $d->animal->birthday . '(' . $diff . ' oy)';

        return $res;
    };
    ?>
    Hayvon haqida ma'lumot <?= $about($model) ?>
</div>
<br>
<div>
    Текширув объекти: намуна номи:,кушимча маълумот:,намуна
    коди:<?= $model->sample->kod ?> Izoh: <?= $model->ads ?>
</div>
<br>
<div>
    Tasdiqladi: <?= $model->consent->name ?>
</div>
<br>
<div>
    Namuna yo'q qilingan sana: <?= $model->destruction_date ?>
</div>
<br>
<div>
    Laborant : <?= $model->creator->name ?>
</div>
<br>
<div>
    Текшириш усули буйича НХ: (танланган шаблон буйича 07102 да танланган шаблонда келтирилган «норматив хужжат» поляси,
    бир нечта булиши мумкин, факат такрорланмасин)
</div>
<br>
<div>
    Текширувни утказиш шароити: (Натижани кайд этиш (07101) дан олинади: температура, намлик, регантлар, бошка шартлар,
    изох полялари)
</div>
<br>
<div style="text-align: center">
    <b>Текширув натижалари:</b>
</div>
<br>