<?php


namespace backend\models;
use Yii;
use yii\base\Model;

class Image extends Model
{
    public $image;

    public function rules(){
        return [
            ['image','file'],
            ['image','each','rule'=>['string']],
        ];
    }
}