<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sample_recomendation".
 *
 * @property int $id
 * @property string $name
 * @property int $sample_id
 */
class SampleRecomendation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sample_recomendation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['sample_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'name' => Yii::t('model', 'Tavfsiya matni'),
            'sample_id' => Yii::t('model', 'Sample ID'),
        ];
    }
}
