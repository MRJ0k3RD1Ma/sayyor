<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "report_food_category".
 *
 * @property int $id
 * @property string $name_uz
 * @property string $name_ru
 *
 * @property ReportFood[] $reportFoods
 */
class ReportFoodCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report_food_category';
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
            'id' => Yii::t('food', 'ID'),
            'name_uz' => Yii::t('food', 'Name Uz'),
            'name_ru' => Yii::t('food', 'Name Ru'),
        ];
    }

    /**
     * Gets query for [[ReportFoods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReportFoods()
    {
        return $this->hasMany(ReportFood::className(), ['cat_id' => 'id']);
    }
}
