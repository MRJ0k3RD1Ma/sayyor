<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "template_food_regulations".
 *
 * @property int $regulation_id
 * @property int $template_id
 * @property int|null $state_id
 *
 * @property Regulations $regulation
 * @property TemplateFood $template
 */
class TemplateFoodRegulations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'template_food_regulations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['regulation_id', 'template_id'], 'required'],
            [['regulation_id', 'template_id', 'state_id'], 'integer'],
            [['regulation_id', 'template_id'], 'unique', 'targetAttribute' => ['regulation_id', 'template_id']],
            [['regulation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Regulations::className(), 'targetAttribute' => ['regulation_id' => 'id']],
            [['template_id'], 'exist', 'skipOnError' => true, 'targetClass' => TemplateFood::className(), 'targetAttribute' => ['template_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'regulation_id' => Yii::t('app', 'Regulation ID'),
            'template_id' => Yii::t('app', 'Template ID'),
            'state_id' => Yii::t('app', 'State ID'),
        ];
    }

    /**
     * Gets query for [[Regulation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegulation()
    {
        return $this->hasOne(Regulations::className(), ['id' => 'regulation_id']);
    }

    /**
     * Gets query for [[Template]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(TemplateFood::className(), ['id' => 'template_id']);
    }
}
