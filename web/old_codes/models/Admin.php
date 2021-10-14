<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $share
 * @property string $username
 * @property string $password
 * @property integer $pin_code
 * @property string $chat_id
 * @property string $phone
 * @property string $telegram
 * @property string $email
 * @property string $created
 * @property string $updated
 * @property integer $status
 * @property integer $isDelete
 * @property string $setting
 *
 * @property User[] $users
 */
class Admin extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'username',], 'required'],
            ['password','required', 'on'=>'insert'],
            [['share', 'pin_code', 'status', 'isDelete'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['setting'], 'string'],
            [['code', 'name'], 'string', 'max' => 255],
            [['username', 'chat_id', 'phone', 'telegram', 'email'], 'string', 'max' => 60],
            [['password'], 'string', 'max' => 500],
            [['code','username'], 'unique'],
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
            'name' => 'ФИО',
            'share' => 'Руҳсат',
            'username' => 'Логин',
            'password' => 'Парол',
            'pin_code' => 'Пин код',
            'chat_id' => 'Чат ИД',
            'phone' => 'Телефон',
            'telegram' => 'Телеграм',
            'email' => 'Эл-почта',
            'created' => 'Яратилди',
            'updated' => 'Ўзгартирилди',
            'status' => 'Статус',
            'isDelete' => 'Is Delete',
            'setting' => 'Созламалар',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['admin_id' => 'id']);
    }



    public function encrypt($true = true){
        if($true){
            $code = Yii::$app->security->generateRandomString(10);
            while (static::findOne(['code'=>$code])){
                $code = Yii::$app->security->generateRandomString(10);
            }
            $this->code = $code;
        }
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        return true;
    }



    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username'=>$username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->password;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->password === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        //return $password === $this->password;
        return Yii::$app->getSecurity()->validatePassword($password,$this->password);
    }




}
