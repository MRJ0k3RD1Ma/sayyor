<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "report_drug_type".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 *
 * @property ReportDrugs[] $reportDrugs
 */
class ReportDrugType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report_drug_type';
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
     * Gets query for [[ReportDrugs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReportDrugs()
    {
        return $this->hasMany(ReportDrugs::className(), ['type_id' => 'id']);
    }
}
