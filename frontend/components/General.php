<?php

namespace frontend\components;

class General
{
    public static function get3num($num){
        $num = intval($num);
        if($num<10){
            $num = '00'.$num;
        }elseif($num<100){
            $num = '0'.$num;
        }
        return $num;
    }
}