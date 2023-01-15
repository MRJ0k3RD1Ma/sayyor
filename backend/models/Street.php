<?php


namespace backend\models;
use Yii;

class Street extends \common\models\LocStreets
{
    public function fields()
    {
        return [
            'id',
            'village_id',
            'length',
            'has_electricity',
            'has_gas',
            'has_water',
            'has_sewer',
            'has_asphalt',
            'has_shps',
            'type_id',
            'sub_roads_count',
            'repair',
            'name',
            'user',
            'type_name'=>function($d){return $d->type->name;}
        ];
    }

    public function getUser(){
        return Yii::$app->user->identity->post->village_id;
    }

}