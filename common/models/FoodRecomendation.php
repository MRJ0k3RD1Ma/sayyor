<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "food_recomendation".
 *
 * @property int $id
 * @property string $name
 * @property int|null $sample_id
 */
class FoodRecomendation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food_recomendation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
