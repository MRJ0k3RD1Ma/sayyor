<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "template_unit".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 * @property int|null $type_id
 *
 * @property TamplateAnimal[] $tamplateAnimals
 * @property TemplateUnitType $type
 */
class TemplateUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'template_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id'], 'integer'],
            [['name_uz', 'name_ru'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TemplateUnitType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cp', 'ID'),
            'name_uz' => Yii::t('cp', 'Nomi(UZ)'),
            'name_ru' => Yii::t('cp', 'Nomi(RU)'),
            'type_id' => Yii::t('cp', 'Turi'),
        ];
    }

    /**
     * Gets query for [[TamplateAnimals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTamplateAnimals()
    {
        return $this->hasMany(TamplateAnimal::className(), ['unit_id' => 'id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TemplateUnitType::className(), ['id' => 'type_id']);
    }
}
