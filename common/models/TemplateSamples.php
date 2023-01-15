<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "template_samples".
 *
 * @property int $type_id
 * @property int $template_id
 *
 * @property TamplateAnimal $template
 * @property SampleTypes $type
 */
class TemplateSamples extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'template_samples';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'template_id'], 'required'],
            [['type_id', 'template_id'], 'integer'],
            [['type_id', 'template_id'], 'unique', 'targetAttribute' => ['type_id', 'template_id']],
            [['template_id'], 'exist', 'skipOnError' => true, 'targetClass' => TamplateAnimal::className(), 'targetAttribute' => ['template_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => SampleTypes::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'type_id' => Yii::t('cp', 'Type ID'),
            'template_id' => Yii::t('cp', 'Template ID'),
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
        return $this->hasOne(SampleTypes::className(), ['id' => 'type_id']);
    }
}
