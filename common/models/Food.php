<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "food".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 * @property int $category_id
 * @property string|null $animal_type_id
 * @property int|null $for_all
 *
 * @property FoodCategory $category
 * @property TemplateFood[] $templateFoods
 */
class Food extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id'], 'required'],
            [['category_id', 'for_all'], 'integer'],
            [['name_uz', 'name_ru', 'animal_type_id'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => FoodCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'category_id' => 'Kategoriyasi',
            'animal_type_id' => 'Hayvon turi',
            'for_all' => 'Barchasiga tekgishli',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(FoodCategory::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[TemplateFoods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplateFoods()
    {
        return $this->hasMany(TemplateFood::className(), ['food_id' => 'id']);
    }
}
