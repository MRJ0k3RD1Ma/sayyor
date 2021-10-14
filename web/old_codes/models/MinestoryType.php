<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "minestory_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 */
class MinestoryType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'minestory_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['name', 'code'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Орган тури',
            'code' => 'Code',
        ];
    }
    public function getMinestory(){
        return $this->hasMany(Minestory::className(),['id'=>'minestory_type_id']);
    }
}
