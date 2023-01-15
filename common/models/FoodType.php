<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "food_type".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $parent_id
 */
class FoodType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name'], 'string', 'max' => 250],
        ];
    }

    public function getParent(){
        return $this->hasOne(FoodType::className(),['id'=>'parent_id']);
    }

    public function getChild(){
        return $this->hasMany(FoodType::className(),['parent_id'=>'id']);
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('food', 'ID'),
            'name' => Yii::t('food', 'Name'),
            'parent_id' => Yii::t('food', 'Parent ID'),
        ];
    }
}
