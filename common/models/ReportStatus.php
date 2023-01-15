<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "report_status".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 *
 * @property ReportAnimal[] $reportAnimals
 */
class ReportStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report_status';
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
            'id' => Yii::t('report', 'ID'),
            'name_uz' => Yii::t('report', 'Name Uz'),
            'name_ru' => Yii::t('report', 'Name Ru'),
        ];
    }

    /**
     * Gets query for [[ReportAnimals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReportAnimals()
    {
        return $this->hasMany(ReportAnimal::className(), ['report_status_id' => 'id']);
    }
}
