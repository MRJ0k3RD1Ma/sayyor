<?php

namespace app\modules\imtodb;

/**
 * imtodb module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\imtodb\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        \Yii::$app->layoutPath = "@app/modules/imtodb/views/layouts";

        // custom initialization code goes here
    }
}
