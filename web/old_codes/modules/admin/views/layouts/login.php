<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\BAppAsset;


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="/backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="/backend/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/backend/css/animate.css" rel="stylesheet">
    <link href="/backend/css/style.css" rel="stylesheet">
    <?php $this->head() ?>
</head>
<body class="gray-bg">
<?php $this->beginBody() ?>


    <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
