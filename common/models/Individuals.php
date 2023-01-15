<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "individuals".
 *
 * @property string $pnfl
 * @property string|null $name
 * @property string|null $surname
 * @property string|null $middlename
 * @property int|null $soato_id
 * @property int|null $region
 * @property int|null $district
 * @property string|null $adress
 * @property string|null $passport
 *
 * @property Soato $soato
 */
class Individuals extends \yii\db\ActiveRecord
{
    public $region,$district;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'individuals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['pnfl','soato_id'], 'required'],
            [['soato_id','region','district'], 'integer'],
            [['pnfl', 'name', 'surname', 'middlename', 'adress', 'passport'], 'string', 'max' => 255],
            [['pnfl'], 'unique'],
            ['pnfl','string','length'=>14],
            [['soato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Soato::className(), 'targetAttribute' => ['soato_id' => 'MHOBT_cod']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pnfl' => Yii::t('model.individuals', 'PNFL'),
            'name' => Yii::t('model.individuals', 'Ism'),
            'surname' => Yii::t('model.individuals', 'Familya'),
            'middlename' => Yii::t('model.individuals', 'Otasining ismi'),
            'soato_id' => Yii::t('model.individuals', 'QFY'),
            'adress' => Yii::t('model.individuals', 'Manzil'),
            'passport' => Yii::t('model.individuals', 'Pasport'),
            'region' => Yii::t('model.individuals', 'Viloyat'),
            'district' => Yii::t('model.individuals', 'Tuman'),
        ];
    }

    /**
     * Gets query for [[Soato]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSoato()
    {
        return $this->hasOne(Soato::className(), ['MHOBT_cod' => 'soato_id']);
    }
}
