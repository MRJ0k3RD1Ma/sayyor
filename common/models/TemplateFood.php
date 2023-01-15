<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "template_food".
 *
 * @property int $id
 * @property int|null $category_id
 * @property int|null $food_id
 * @property int|null $group_id
 * @property string|null $name_ru
 * @property string|null $name_uz
 * @property int|null $unit_id
 * @property string|null $min_1
 * @property string|null $min_2
 * @property string|null $max_1
 * @property string|null $max_2
 *
 * @property FoodCategory $category
 * @property Food $food
 * @property FoodGroup $group
 * @property ResultFoodTests[] $resultFoodTests
 * @property TemplateUnit $unit
 */
class TemplateFood extends \yii\db\ActiveRecord
{
    public $true_1,$true_2,$mm_1,$mm_2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'template_food';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'food_id', 'group_id', 'unit_id','name_ru', 'name_uz',],'required'],
            [['category_id', 'food_id', 'group_id', 'unit_id','mm_1','mm_2'], 'integer'],
            [['name_ru', 'name_uz', 'min_1', 'min_2', 'max_1', 'max_2','true_1','true_2'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => FoodCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['food_id'], 'exist', 'skipOnError' => true, 'targetClass' => Food::className(), 'targetAttribute' => ['food_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => FoodGroup::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => TemplateUnit::className(), 'targetAttribute' => ['unit_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'category_id' => Yii::t('model', 'Kategoriya'),
            'food_id' => Yii::t('model', 'Mahsulot'),
            'group_id' => Yii::t('model', 'Guruh'),
            'name_ru' => Yii::t('model', 'Parametr(RU)'),
            'name_uz' => Yii::t('model', 'Parametr(UZ)'),
            'unit_id' => Yii::t('model', 'Birlik'),
            'min_1' => Yii::t('model', 'Minimal'),
            'min_2' => Yii::t('model', 'Minimal(oraliq)'),
            'max_1' => Yii::t('model', 'Maximal'),
            'max_2' => Yii::t('model', 'Maximal(Oraliq)'),
            'true_1' => Yii::t('model', 'Minimal'),
            'true_2' => Yii::t('model', 'Maximal'),
            'mm_1' => Yii::t('model', 'Minimal'),
            'mm_2' => Yii::t('model', 'Maximal'),
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
     * Gets query for [[Food]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFood()
    {
        return $this->hasOne(Food::className(), ['id' => 'food_id']);
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(FoodGroup::className(), ['id' => 'group_id']);
    }

    /**
     * Gets query for [[ResultFoodTests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResultFoodTests()
    {
        return $this->hasMany(ResultFoodTests::className(), ['template_id' => 'id']);
    }
    public function getRegulations()
    {
        return $this->hasMany(Regulations::className(), ['id' => 'regulation_id'])->viaTable('template_food_regulations', ['template_id' => 'id']);
    }
    /**
     * Gets query for [[Unit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(TemplateUnit::className(), ['id' => 'unit_id']);
    }
}
