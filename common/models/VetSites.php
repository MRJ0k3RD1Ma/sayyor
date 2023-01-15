<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vet_sites".
 *
 * @property int $id
 * @property int $code
 * @property string|null $name
 * @property int|null $soato
 * @property int $region
 * @property int $district
 * @property int $qfi
 *
 * @property Animals[] $animals
 * @property Soato $soato0
 */
class VetSites extends \yii\db\ActiveRecord
{
    public $district,$region;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vet_sites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['code', 'soato','region','district'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['soato'], 'exist', 'skipOnError' => true, 'targetClass' => Soato::className(), 'targetAttribute' => ['soato' => 'MHOBT_cod']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model.vetsites', 'ID'),
            'code' => Yii::t('model.vetsites', 'Kod'),
            'name' => Yii::t('model.vetsites', 'Nomi'),
            'soato' => Yii::t('model.vetsites', 'SOATO'),
            'district' => Yii::t('model.vetsites', 'Tuman'),
            'region' => Yii::t('model.vetsites', 'Viloyat'),
        ];
    }

    /**
     * Gets query for [[Animals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnimals()
    {
        return $this->hasMany(Animals::className(), ['vet_site_id' => 'id']);
    }

    /**
     * Gets query for [[Soato0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSoato0()
    {
        return $this->hasOne(Soato::class, ['MHOBT_cod' => 'soato']);
    }


}
