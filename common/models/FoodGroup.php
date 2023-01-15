<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "food_group".
 *
 * @property int $id
 * @property string $name_ru
 * @property string $name_uz
 *
 * @property TemplateFood[] $templateFoods
 */
class FoodGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_ru', 'name_uz'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_ru' => 'Nomi(Ru)',
            'name_uz' => 'Nomi(Uz)',
        ];
    }

    /**
     * Gets query for [[TemplateFoods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplateFoods()
    {
        return $this->hasMany(TemplateFood::className(), ['group_id' => 'id']);
    }
}
