<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $username
 * @property string $password
 * @property integer $role_id
 * @property integer $company_id
 * @property integer $admin_id
 * @property integer $work_part_id
 * @property integer $work_type_id
 * @property integer $complex_id
 * @property integer $minestory_id
 * @property string $email
 * @property string $phone
 * @property string $telegram
 * @property string $chat_id
 * @property integer $pin_code
 * @property integer $status
 * @property integer $isDelete
 * @property string $created
 * @property string $updated
 * @property string $setting
 * @property string $ads
 *
 * @property Company[] $companies
 * @property Complex[] $complexes
 * @property Complex[] $complexes0
 * @property Managment[] $managments
 * @property Managment[] $managments0
 * @property Admin $admin
 * @property Company $company
 * @property Complex $complex
 * @property Minestory $minestory
 * @property Role $role
 * @property WorkPart $workPart
 * @property WorkType $workType
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'username', 'password', 'role_id', 'company_id', 'admin_id', 'work_part_id', 'work_type_id', 'complex_id', 'minestory_id', 'email'], 'required'],
            [['role_id', 'company_id', 'admin_id', 'work_part_id', 'work_type_id', 'complex_id', 'minestory_id', 'pin_code', 'status', 'esDelete'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['setting'], 'string'],
            [['code', 'name', 'username', 'ads'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 500],
            [['email', 'phone', 'telegram', 'chat_id'], 'string', 'max' => 60],
            [['code'], 'unique'],
            [['username'], 'unique'],
            [['admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Admin::className(), 'targetAttribute' => ['admin_id' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
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
            'name' => 'Name',
            'username' => 'Username',
            'password' => 'Password',
            'role_id' => 'Role ID',
            'company_id' => 'Company ID',
            'admin_id' => 'Admin ID',
            'work_part_id' => 'Work Part ID',
            'work_type_id' => 'Work Type ID',
            'complex_id' => 'Complex ID',
            'minestory_id' => 'Minestory ID',
            'email' => 'Email',
            'phone' => 'Phone',
            'telegram' => 'Telegram',
            'chat_id' => 'Chat ID',
            'pin_code' => 'Pin Code',
            'status' => 'Status',
            'esDelete' => 'Es Delete',
            'created' => 'Created',
            'updated' => 'Updated',
            'setting' => 'Setting',
            'ads' => 'Ads',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['director_id' => 'id']);
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComplexes()
    {
        return $this->hasMany(Complex::className(), ['director_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManagments()
    {
        return $this->hasMany(Managment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManagments0()
    {
        return $this->hasMany(Managment::className(), ['director_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(Admin::className(), ['id' => 'admin_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComplex()
    {
        return $this->hasOne(Complex::className(), ['id' => 'complex_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMinestory()
    {
        return $this->hasOne(Minestory::className(), ['id' => 'minestory_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkPart()
    {
        return $this->hasOne(WorkPart::className(), ['id' => 'work_part_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkType()
    {
        return $this->hasOne(WorkType::className(), ['id' => 'work_type_id']);
    }
}
