<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "soato".
 *
 * @property int $MHOBT_cod
 * @property int|null $res_id
 * @property int|null $region_id
 * @property int|null $district_id
 * @property int|null $qfi_id
 * @property string|null $name_lot
 * @property string|null $center_lot
 * @property string|null $name_cyr
 * @property string|null $center_cyr
 * @property string|null $name_ru
 * @property string|null $center_ru
 */
class Soato extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'soato';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MHOBT_cod'], 'required'],
            [['MHOBT_cod', 'res_id', 'region_id', 'district_id', 'qfi_id'], 'integer'],
            [['name_lot', 'name_cyr', 'name_ru'], 'string', 'max' => 100],
            [['center_lot', 'center_cyr', 'center_ru'], 'string', 'max' => 50],
            [['MHOBT_cod'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MHOBT_cod' => Yii::t('app', 'Kodi'),
            'res_id' => Yii::t('app', 'Res ID'),
            'region_id' => Yii::t('app', 'Viloyat'),
            'district_id' => Yii::t('app', 'Ko`cha'),
            'qfi_id' => Yii::t('app', 'QFY'),
            'name_lot' => Yii::t('app', 'Nomi(Lotin)'),
            'center_lot' => Yii::t('app', 'Markazi'),
            'name_cyr' => Yii::t('app', 'Nomi(Kril)'),
            'center_cyr' => Yii::t('app', 'Markazi(Kril)'),
            'name_ru' => Yii::t('app', 'Nomi(Rus)'),
            'center_ru' => Yii::t('app', 'Markazi(Rus)'),
        ];
    }

    public static function Full($code, $lang = null)
    {
       if($lang){
           $lg = $lang;
       }else{
           $lg = Yii::$app->language;
           if ($lg == 'uz') {
               $lang = 'lot';
           } elseif ($lg == 'ru') {
               $lang = 'ru';
           } else {
               $lang = 'cyr';
           }
       }
        if($soato = self::findOne($code)){
            $region = self::find()->where(['region_id' => $soato->region_id])->one();
            $district = self::find()->where(['region_id' => $soato->region_id])->andWhere(['district_id' => $soato->district_id])->one();
            if ($soato->qfi_id) {
                return  $region->{'name_' . $lang} . " " . $district->{'name_' . $lang} . ' ' . $soato->{'name_' . $lang};
            }
            return $region->{'name_' . $lang} . " " . $district->{'name_' . $lang};
        }else{
            return null;
        }

    }

    public static function getRegion(int $MHOBT_cod = null)
    {
        return ($MHOBT_cod) ? self::findOne(['MHOBT_cod' => $MHOBT_cod])->region_id : null;
    }

}
