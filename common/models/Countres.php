<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "countres".
 *
 * @property string $code
 * @property string|null $name_uz
 * @property string|null $name_ru
 */
class Countres extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countres';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['code'], 'string', 'max' => 11],
            [['name_uz'], 'string', 'max' => 50],
            [['name_ru'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => Yii::t('app', 'Code'),
            'name_uz' => Yii::t('app', 'Name Uz'),
            'name_ru' => Yii::t('app', 'Name Ru'),
        ];
    }
}
