<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "food_category".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 *
 * @property Food[] $foods
 * @property TemplateFood[] $templateFoods
 */
class FoodCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food_category';
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
            'id' => 'ID',
            'name_uz' => 'Nomi(UZ)',
            'name_ru' => 'Nomi(RU)',
        ];
    }

    /**
     * Gets query for [[Foods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFoods()
    {
        return $this->hasMany(Food::className(), ['category_id' => 'id']);
    }

    /**
     * Gets query for [[TemplateFoods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplateFoods()
    {
        return $this->hasMany(TemplateFood::className(), ['category_id' => 'id']);
    }
}
