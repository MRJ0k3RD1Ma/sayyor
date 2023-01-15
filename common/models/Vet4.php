<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Vet4 extends Model
{
    public $date_to,$date_do,$country,$region,$district,$org,$type;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['country', 'region', 'district', 'org','type'], 'integer'],
            [['date_to','date_do'],'required'],
            // email has to be a valid email address
            [['date_to','date_do'], 'safe'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'country' => 'Respublika',
            'region' => 'Viloyat',
            'district' => 'Tuman',
            'org' => 'Tashkilot',
            'type' => 'Qidiruv turi',
            'date_to' => 'Dan..',
            'date_do' => '..Gacha',
        ];
    }


}
