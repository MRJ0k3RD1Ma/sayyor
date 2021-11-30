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
 * @property int|null $status_id
 *
 * @property Soato $soato0
 */
class LegalEntities extends \yii\db\ActiveRecord
{
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
            [['soato', 'status_id'], 'integer'],
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
            'inn' => Yii::t('model.legal_entities', 'Inn'),
            'name' => Yii::t('model.legal_entities', 'Name'),
            'tshx' => Yii::t('model.legal_entities', 'Tshx'),
            'soogu' => Yii::t('model.legal_entities', 'Soogu'),
            'soato' => Yii::t('model.legal_entities', 'Soato'),
            'status_id' => Yii::t('model.legal_entities', 'Status ID'),
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
