<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "report_drug_images".
 *
 * @property int $id
 * @property int|null $report_id
 * @property string|null $image
 */
class ReportDrugImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report_drug_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['report_id'], 'integer'],
            [['image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('food', 'ID'),
            'report_id' => Yii::t('food', 'Report ID'),
            'image' => Yii::t('food', 'Image'),
        ];
    }
}
