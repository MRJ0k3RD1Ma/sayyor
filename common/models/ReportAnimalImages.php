<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "report_animal_images".
 *
 * @property int $id
 * @property string|null $image
 * @property int|null $report_id
 */
class ReportAnimalImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report_animal_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['report_id'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('report', 'ID'),
            'image' => Yii::t('report', 'Image'),
            'report_id' => Yii::t('report', 'Report ID'),
        ];
    }
}
