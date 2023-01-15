<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "regulation_types".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 *
 * @property Regulations[] $regulations
 */
class RegulationTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regulation_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz', 'name_ru'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'name_uz' => Yii::t('model', 'Nomi(UZ)'),
            'name_ru' => Yii::t('model', 'Nomi(RU)'),
        ];
    }

    /**
     * Gets query for [[Regulations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegulations()
    {
        return $this->hasMany(Regulations::className(), ['type_id' => 'id']);
    }
}
