<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\BAppAsset;

BAppAsset::register($this);
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
    <script>
        var statuschanger = function(){
            return 1;
        }
        var resetform = function(){
            return 1;
        }
        var updatemodal = function(){

        }
    </script>
    <style>
        .select2-chosen{
            margin-left:15px;
        }
        .ibox-title{
            height:auto !important;
        }
    </style>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>



<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <?= $this->render('_sidebar')?>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">

        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" method="post" action="#">
                        <div class="form-group">
                            <input type="text" placeholder="Qidiruv..." class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">

                    <li>
                        <a href="<?= Yii::$app->urlManager->createUrl(['admin/news'])?>">
                            <span class="fa fa-newspaper-o"></span>
                            Yangiliklarni o'zgartirish
                        </a>
                    </li>
                    <li>
                        <a href="<?= Yii::$app->urlManager->createUrl(['admin/news/create'])?>">
                            <span class="fa fa-plus"></span>
                            Yangilik qo'shish
                        </a>
                    </li>
                    <li>
                        <a href="<?= Yii::$app->urlManager->createUrl(['admin/category'])?>">
                            <span class="fa fa-table"></span>
                            Menu
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="#" class="pull-left">
                                        <img alt="image" class="img-circle" src="/backend/img/a7.jpg">
                                    </a>
                                    <div class="media-body">
                                        <small class="pull-right">46h ago</small>
                                        <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="#" class="pull-left">
                                        <img alt="image" class="img-circle" src="/backend/img/a4.jpg">
                                    </a>
                                    <div class="media-body ">
                                        <small class="pull-right text-navy">5h ago</small>
                                        <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                        <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="#" class="pull-left">
                                        <img alt="image" class="img-circle" src="/backend/img/profile.jpg">
                                    </a>
                                    <div class="media-body ">
                                        <small class="pull-right">23h ago</small>
                                        <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                        <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a href="#">
                                        <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a href="#">
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>


                    <li>
                        <?php $form = \yii\widgets\ActiveForm::begin(['action'=>'/admin/default/logout'])?>
                        <button type="submit" class="btn btn-link" style="text-decoration: none;">
                            <i class="fa fa-sign-out"></i> Log out
                        </button>
                        <?php \yii\widgets\ActiveForm::end()?>
                    </li>
                </ul>

            </nav>
        </div>
        <?php if(Yii::$app->controller->id != 'default' or Yii::$app->controller->action->id == 'index'){?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-9">
                <h2><?= $this->title?></h2>
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
        </div>
        <?php } ?>

        <?php echo $content ?>
    </div>
</div>


<style>

    .checkboxcustom>input[type="checkbox"]{
        position: relative;
        width:60px;
        height:30px;
        -webkit-appearance: none;
        background-color: #c6c6c6;
        outline: none;
        border-radius: 15px;
        box-shadow: inset 0 0 5px rgba(0,0,0,0.2);
        transition: .5s;
    }
    .checkboxcustom>input:checked[type="checkbox"]{
        background-color: #03a9f4;
    }
    .checkboxcustom>input[type="checkbox"]:before{
        content: '';
        position: absolute;
        width:30px;
        height:30px;
        border-radius: 15px;
        top:0;
        left:0;
        background-color: #fff;
        transform: scale(1.1);
        box-shadow: 0 2px 5px rgba(0,0,0,.2);
        transition: .5s;
    }
    .checkboxcustom>input:checked[type="checkbox"]:before{
        left:30px;
    }

</style>


<?php

$this->registerJs("
    
   resetform = function(){
        $('#w1')[0].reset();
   }
   
    $(\".select2_list\").select2({
                theme: 'bootstrap3',
                placeholder: \"Давлатни танланг...\",
                allowClear: true
            });
")
?>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
