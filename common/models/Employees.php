<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $password
 *
 * @property EmpPosts $empPosts
 */
class Employees extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone',], 'required'],
            ['password', 'required', 'on' => 'insert'],
            [['name', 'email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
            [['password'], 'string', 'min' => 8, 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'FIO'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Telefon'),
            'password' => Yii::t('app', 'Parol'),
        ];
    }

    /**
     * Gets query for [[EmpPosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpPosts()
    {
        return $this->hasOne(EmpPosts::className(), ['emp_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        /*$sql = '(
         (`active_to` IS NOT NULL and `active_each`IS NOT NULL) and (CURDATE() BETWEEN `active_to` and `active_each`)
         ) OR (
         (`active_to` IS NOT NULL and `active_each` IS NULL) and (CURDATE()>=`active_to`)
         ) OR (
         (`active_to` IS NULL and `active_each` IS NOT NULL) and (CURDATE()<=`active_each`)
         ) OR (`active_to` IS NULL and `active_each` IS NULL)
         ';*/
        return static::find()->where(['id' => $id])->one();
//    return static::findOne($id);

    }

    /**
     * @inheritdoc
     */
    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        /*$sql = '(
         (`active_to` IS NOT NULL and `active_each`IS NOT NULL) and (CURDATE() BETWEEN `active_to` and `active_each`)
         ) OR (
         (`active_to` IS NOT NULL and `active_each` IS NULL) and (CURDATE()>=`active_to`)
         ) OR (
         (`active_to` IS NULL and `active_each` IS NOT NULL) and (CURDATE()<=`active_each`)
         ) OR (`active_to` IS NULL and `active_each` IS NULL)
         ';
        return static::find()->where(['email'=>$username])->andWhere(['status'=>1])->andWhere($sql)->one();*/
        return static::findOne(['email' => $username]);
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
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public function encrypt()
    {
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        return true;
    }

    public function getPosts()
    {
        return $this->hasOne(EmpPosts::class, ['emp_id' => 'id']);
    }

}
