<?php

/* @var $this \yii\web\View */
/* @var $content string */

use client\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>




<!-- <body data-layout="horizontal"> -->

<!-- Begin page -->
<div id="layout-wrapper">



    <?= $this->render('_header')?>

    <?php if(Yii::$app->session->has('doc_type')){
       echo $this->render('_menu_'.Yii::$app->session->get('doc_type'));
    }else{echo $this->render('_menu_'.Yii::$app->session->get('doc_type'));}?>


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">

            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18"><?= $this->title?></h4>

                            <div class="page-title-right">
                                <?= Breadcrumbs::widget([
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]) ?>
                            </div>



                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <?= $content?>



            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>


<?php
if(Yii::$app->session->hasFlash('error')){
    $txt = Yii::$app->session->getFlash('error');
    $xato = Yii::t('reg','Xatolik');
    $this->registerJs("
        $(document).ready(function(){
            Swal.fire({
              icon: 'error',
              title: \"{$xato}\",
              text: \"{$txt}\"
            })
        })
    ");

}
if(Yii::$app->session->hasFlash('success')){
    $txt = Yii::$app->session->getFlash('success');
    $xato = Yii::t('reg','Muvvofaqiyatli');
    $this->registerJs("
        $(document).ready(function(){
            Swal.fire({
              icon: 'success',
              title: \"{$xato}\",
              text: \"{$txt}\"
            })
        })
    ");

}
?>

<?php
$this->registerJs("
    $(document).ready(function(){
        $('.select2list').select2();
    })
")
?>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
