<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "complex".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $user_id
 * @property integer $director_id
 * @property string $phone
 * @property string $telegram
 * @property string $chat_id
 * @property string $email
 * @property string $fax
 * @property string $created
 * @property string $updated
 * @property integer $status
 * @property integer $isDelete
 * @property string $setting
 *
 * @property Company[] $companies
 * @property Admin $register
 * @property User $director
 * @property Managment[] $managments
 * @property Admin[] $registers
 */
class Complex extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'complex';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name',], 'required'],
            [['register_id', 'director_id', 'status', 'isDelete'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['setting'], 'string'],
            [['code', 'name'], 'string', 'max' => 255],
            [['phone', 'telegram', 'chat_id', 'email', 'fax'], 'string', 'max' => 60],
            [['code'], 'unique'],
            ['status','default','value'=>1],
            ['register_id','default','value'=>Yii::$app->admin->getId()],
            [['director_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['director_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Комплекс коди',
            'name' => 'Комплекс номи',
            'register_id' => 'Регистратор',
            'director_id' => 'Директор',
            'phone' => 'Телефон',
            'telegram' => 'Телеграм',
            'chat_id' => 'Chat ID',
            'email' => 'Email',
            'fax' => 'Факс',
            'created' => 'Яратилди',
            'updated' => 'Янгиланди',
            'status' => 'Статус',
            'isDelete' => 'Учирилганлик',
            'setting' => 'Setting',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['complex_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegister()
    {
        return $this->hasOne(Admin::className(), ['id' => 'register_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirector()
    {
        return $this->hasOne(User::className(), ['id' => 'director_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManagments()
    {
        return $this->hasMany(Managment::className(), ['complex_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['complex_id' => 'id']);
    }
}
