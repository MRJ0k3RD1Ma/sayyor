<ul class="nav" id="side-menu">
    <li class="nav-header">
        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="/backend/img/profile_small.jpg" />
                             </span>
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?= Yii::$app->admin->identity->name?></strong>
                             </span> <span class="text-muted text-xs block"><?= Yii::$app->admin->identity->share ==0 ? 'Администратор' : 'Супер Администратор' ?><b class="caret"></b></span> </span> </a>
            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                <li><a href="<?= Yii::$app->urlManager->createUrl(['/admin/default/profile'])?>">Профил</a></li>
                <li><a href="#">Хабар юбориш</a></li>
                <li><a href="#">Келган хабардар</a></li>
                <li class="divider"></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
        <div class="logo-element">
            AKT
        </div>
    </li>

    <li class="<?= Yii::$app->controller->id == 'default' ? 'active' : ''?>">
        <a href="<?= Yii::$app->urlManager->createUrl(['admin/'])?>"><i class="fa fa-dashboard"></i>  <span class="nav-label">Asosiy sahifa</span></a>
    </li>


    <li class="<?= (Yii::$app->controller->id == 'role' or Yii::$app->controller->id == 'user')  ?  'active' : ''?>">
        <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Фойдаланувчилар</span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href="<?= Yii::$app->urlManager->createUrl(['admin/user'])?>">Фойдаланувчилар рўйҳати</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl(['admin/user/create'])?>">Фойдаланувчи қўшиш</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl(['admin/role'])?>">Фойдаланувчи ҳуқуқлари</a></li>
        </ul>
    </li>

    <li class="<?= (Yii::$app->controller->id == 'complex')  ?  'active' : ''?>">
        <a href="#"><i class="fa fa-bank"></i> <span class="nav-label">Комплекслар</span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href="<?= Yii::$app->urlManager->createUrl(['admin/complex'])?>">Комплекслар рўйҳати</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl(['admin/complex/create'])?>">Комплекс қўшиш</a></li>
        </ul>
    </li>






    <li class="<?= (Yii::$app->controller->id == 'minestory'
    or Yii::$app->controller->id == 'company'
        or Yii::$app->controller->id == 'managment'
        or Yii::$app->controller->id == 'minestory-type'
        or Yii::$app->controller->id == 'work-part'
        or Yii::$app->controller->id == 'work-type'
    )  ?  'active' : ''?>">
        <a href="#"><i class="fa fa-bank"></i> <span class="nav-label">Ташкилотлар</span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href="<?= Yii::$app->urlManager->createUrl(['admin/company'])?>">Ташкилотлар рўйҳати</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl(['admin/managment'])?>">Вилоят бошқарув органи рўйҳати</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl(['admin/minestory'])?>">Бошқарув органлари рўйҳати</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl(['admin/minestory-type'])?>">Бошқарув органи турлари рўйҳати</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl(['admin/work-part'])?>">Бўлимлар рўйҳати</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl(['admin/work-type'])?>">Лавозимлар рўйҳати</a></li>

        </ul>
    </li>


    <li class="<?= (Yii::$app->controller->id == 'country' or Yii::$app->controller->id == 'region' or Yii::$app->controller->id == 'district')  ?  'active' : ''?>">
        <a href="#"><i class="fa fa-map-marker"></i> <span class="nav-label">Жойлашув</span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li class="<?= Yii::$app->controller->id == 'country' ? 'active' : ''?>"><a href="<?= Yii::$app->urlManager->createUrl(['admin/country'])?>">Давлатлар рўйҳати</a></li>
            <li class="<?= Yii::$app->controller->id == 'region' ? 'active' : ''?>"><a href="<?= Yii::$app->urlManager->createUrl(['admin/region'])?>">Вилоятлар рўйҳати</a></li>
            <li class="<?= Yii::$app->controller->id == 'district' ? 'active' : ''?>"><a href="<?= Yii::$app->urlManager->createUrl(['admin/district'])?>">Туманлар рўйҳати</a></li>

        </ul>
    </li>



    <li class="<?= Yii::$app->controller->id == 'admin' ? 'active' : ''?>">
        <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Администраторлар</span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <li><a href="<?= Yii::$app->urlManager->createUrl(['admin/admin'])?>">Администраторлар рўйҳати</a></li>
            <li><a href="<?= Yii::$app->urlManager->createUrl(['admin/admin/create'])?>">Администратор қўшиш</a></li>

        </ul>
    </li>


</ul>