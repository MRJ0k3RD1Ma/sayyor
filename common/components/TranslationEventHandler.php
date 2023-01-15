<?php

namespace common\components;

use common\models\Message;
use common\models\SourceMessage;
use yii\base\BaseObject;
use yii\i18n\MissingTranslationEvent;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TranslationEventHandler
{
    public static function handleMissingTranslation(MissingTranslationEvent $event) {
        $id = -1;
        if($event->language == 'uz'){
            $mes = new SourceMessage();
            $mes->category = $event->category;
            $mes->message  = $event->message;
            $mes->save();
            $id = $mes->id;
        }else{
            if($mes = SourceMessage::findOne(['message'=>$event->message])){
                $id = $mes->id;
            }else{
                $mes = new SourceMessage();
                $mes->category = $event->category;
                $mes->message  = $event->message;
                $mes->save();
                $id = $mes->id;
            }
        }
        if($id != -1){
            $m = new Message();
            $m->language = $event->language;
            $m->id = $id;
            $m->translation = $event->message;
            $m->save();
        }else{
            if (YII_ENV_DEV) {
                $event->translatedMessage = "@MISSING: {$event->category}.{$event->message} FOR LANGUAGE {$event->language} @";
            }
        }

    }
}