<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "template_animal_types".
 *
 * @property int $template_id
 * @property int $type_id
 *
 * @property TamplateAnimal $template
 * @property Animaltype $type
 */
class TemplateAnimalTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'template_animal_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['template_id', 'type_id'], 'required'],
            [['template_id', 'type_id'], 'integer'],
            [['template_id', 'type_id'], 'unique', 'targetAttribute' => ['template_id', 'type_id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animaltype::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['template_id'], 'exist', 'skipOnError' => true, 'targetClass' => TamplateAnimal::className(), 'targetAttribute' => ['template_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'template_id' => Yii::t('cp', 'Template ID'),
            'type_id' => Yii::t('cp', 'Type ID'),
        ];
    }

    /**
     * Gets query for [[Template]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(TamplateAnimal::className(), ['id' => 'template_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Animaltype::className(), ['id' => 'type_id']);
    }
}
