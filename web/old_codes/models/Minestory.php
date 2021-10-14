<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "minestory".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $minestory_type_id
 * @property string $setting
 *
 * @property Company[] $companies
 * @property Managment[] $managments
 */
class Minestory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'minestory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'minestory_type_id'], 'required'],
            [['minestory_type_id'], 'integer'],
            [['setting'], 'string'],
            [['code', 'name'], 'string', 'max' => 255],
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
            'code' => 'Code',
            'name' => 'Номи',
            'minestory_type_id' => 'Орган тури',
            'setting' => 'Setting',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['minestory_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManagments()
    {
        return $this->hasMany(Managment::className(), ['minestory_id' => 'id']);
    }

    public function getMinestory_type(){
        return $this->hasOne(MinestoryType::className(),['id'=>'minestory_type_id']);
    }
}
