<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "report_food_images".
 *
 * @property int $id
 * @property string|null $image
 * @property int|null $report_id
 *
 * @property ReportFood $report
 */
class ReportFoodImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report_food_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['report_id'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['report_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReportFood::className(), 'targetAttribute' => ['report_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('food', 'ID'),
            'image' => Yii::t('food', 'Image'),
            'report_id' => Yii::t('food', 'Report ID'),
        ];
    }

    /**
     * Gets query for [[Report]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReport()
    {
        return $this->hasOne(ReportFood::className(), ['id' => 'report_id']);
    }
}
