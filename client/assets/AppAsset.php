<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace client\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'design/assets/css/jquery-jvectormap-1.2.2.css',
        'design/assets/css/bootstrap.min.css',
        'design/assets/css/icons.min.css',
        'design/assets/css/app.min.css',
        'design/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
        'design/assets/plugins/select2/css/select2.min.css',
        'design/assets/plugins/datatables/jquery.dataTables.min.css',
        'design/assets/plugins/datatables-buttons/css/buttons.dataTables.min.css',
        'design/assets/css/custom.css',
        'design/assets/font/css/all.min.css',
        'design/assets/plugins/sweetalert2/sweetalert2.min.css',
//        'design/multiselect/css/multi-select.css',
        'eimzo/services/css.css',
    ];
    public $js = [
        'design/assets/js/bootstrap.bundle.min.js',
        'design/assets/js/metisMenu.min.js',
        'design/assets/js/simplebar.min.js',
        'design/assets/js/waves.min.js',
        'design/assets/js/feather.min.js',
        'design/assets/js/pace.min.js',
        'design/assets/js/apexcharts.min.js',
        'design/assets/js/jquery-jvectormap-1.2.2.min.js',
        'design/assets/js/jquery-jvectormap-world-mill-en.js',
        'design/assets/plugins/select2/js/select2.min.js',
        'design/assets/plugins/datatables/jquery.dataTables.min.js',
        'design/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js',
        'design/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js',
        'design/assets/plugins/sweetalert2/sweetalert2.min.js',
//        'design/multiselect/js/jquery.multi-select.js',
        'design/assets/js/app.js',
        'eimzo/services/jquery.reject.js',
        'eimzo/services/micro-ajax.js',
//        'eimzo/e-imzo.js',
//        'eimzo/e-imzo-client.js',

//        'eimzo/services/eimzo/eimzo_old.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
