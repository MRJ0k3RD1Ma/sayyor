<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\BackAsset;
use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

BackAsset::register($this);

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

    <style>
        .pagination li a{
            padding:5px;
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>




<!-- <body data-layout="horizontal"> -->

<!-- Begin page -->
<div id="layout-wrapper">



    <?= $this->render('_header')?>

    <?= $this->render('_menu')?>


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


        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> © SAYYOR.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by <a class="text-decoration-underline" href="http://www.napaautomotive.uz">WWW.NAPAAUTOMATIVE.UZ</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>




<?php
$this->registerJs("
    $(document).ready(function() {
    $('#d-table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    });
} );
")
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
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
