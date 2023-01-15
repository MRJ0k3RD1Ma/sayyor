<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sample_status".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 * @property int|null $type
 */
class SampleStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sample_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['name_uz', 'name_ru'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sample', 'ID'),
            'name_uz' => Yii::t('sample', 'Name Uz'),
            'name_ru' => Yii::t('sample', 'Name Ru'),
            'type' => Yii::t('sample', 'Type'),
        ];
    }
}
