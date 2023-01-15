<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "research_category".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 *
 * @property SampleRegistration[] $sampleRegistrations
 */
class ResearchCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'research_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz'], 'string', 'max' => 50],
            [['name_ru'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_uz' => Yii::t('app', 'Name Uz'),
            'name_ru' => Yii::t('app', 'Name Ru'),
        ];
    }

    /**
     * Gets query for [[SampleRegistrations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSampleRegistrations()
    {
        return $this->hasMany(SampleRegistration::className(), ['research_category_id' => 'id']);
    }
}
