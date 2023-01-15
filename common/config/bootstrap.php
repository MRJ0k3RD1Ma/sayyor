<?php

use yii\helpers\VarDumper;

Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@client', dirname(dirname(__DIR__)) . '/client');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@tmp', dirname(dirname(__DIR__)) . '/client/web/tmp');
Yii::setAlias('@messages', dirname(dirname(__DIR__)) . '/messages');
Yii::setAlias('@uploads', dirname(dirname(__DIR__)) . '/frontend/web/uploads');
Yii::setAlias('@pdf', dirname(dirname(__DIR__)) . '/frontend/web/pdf');
function dd(...$variables)
{
    foreach ($variables as $variable) {
        VarDumper::dump($variable, 10, true);
    }
    exit();
}