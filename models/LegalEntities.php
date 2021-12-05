<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "legal_entities".
 *
 * @property string $inn
 * @property string|null $name
 * @property string|null $tshx
 * @property string|null $soogu
 * @property int|null $soato
 * @property int $region
 * @property int $district
 * @property int|null $status_id
 *
 * @property Soato $soato0
 */
class LegalEntities extends \yii\db\ActiveRecord
{
    public $region,$district;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'legal_entities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inn'], 'required'],
            [['soato', 'status_id','region','district'], 'integer'],
            [['inn', 'name', 'tshx', 'soogu'], 'string', 'max' => 255],
            [['inn'], 'unique'],
            [['soato'], 'exist', 'skipOnError' => true, 'targetClass' => Soato::className(), 'targetAttribute' => ['soato' => 'MHOBT_cod']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'inn' => Yii::t('model.legal_entities', 'STIR(INN)'),
            'name' => Yii::t('model.legal_entities', 'Nomi'),
            'tshx' => Yii::t('model.legal_entities', 'TSHX'),
            'soogu' => Yii::t('model.legal_entities', 'Soogu'),
            'soato' => Yii::t('model.legal_entities', 'Soato'),
            'region' => Yii::t('model.legal_entities', 'Viloyat'),
            'district' => Yii::t('model.legal_entities', 'Tuman'),
            'status_id' => Yii::t('model.legal_entities', 'Status'),
        ];
    }

    /**
     * Gets query for [[Soato0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSoato0()
    {
        return $this->hasOne(Soato::className(), ['MHOBT_cod' => 'soato']);
    }
}
