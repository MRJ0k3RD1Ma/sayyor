<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "animaltype".
 *
 * @property array $id
 */
class TestForm extends Model
{
    public $temprature,$humidity,$reagent_series,$reagent_name,$conditions,$end_date ;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['temprature','humidity'], 'integer'],
            [['reagent_series','reagent_name','conditions','end_date'],'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'temprature' => Yii::t('model', 'Xona tempraturasi'),
            'humidity' => Yii::t('model', 'Xona namligi'),
            'reagent_name' => Yii::t('model', 'Reaktiv nomi'),
            'reagent_series' => Yii::t('model', 'Reaktiv seriyasi'),
            'conditions' => Yii::t('model', 'Boshqa sharoitlar'),
            'end_date' => Yii::t('model', 'Test tugash vaqti'),
        ];
    }
}
