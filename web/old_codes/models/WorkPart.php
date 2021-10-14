<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work_part".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $setting
 *
 * @property User[] $users
 */
class WorkPart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work_part';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
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
            'name' => 'Бўлим',
            'setting' => 'Setting',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['work_part_id' => 'id']);
    }
}
