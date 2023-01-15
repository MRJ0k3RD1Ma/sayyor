<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "template_unit_type".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 *
 * @property TemplateUnit[] $templateUnits
 */
class TemplateUnitType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'template_unit_type';
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
            'id' => Yii::t('app', 'ID'),
            'name_uz' => Yii::t('app', 'Name Uz'),
            'name_ru' => Yii::t('app', 'Name Ru'),
        ];
    }

    /**
     * Gets query for [[TemplateUnits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplateUnits()
    {
        return $this->hasMany(TemplateUnit::className(), ['type_id' => 'id']);
    }
}
