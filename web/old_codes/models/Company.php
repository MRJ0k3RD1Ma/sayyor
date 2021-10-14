<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $complex_id
 * @property integer $minestory_id
 * @property string $email
 * @property string $phone
 * @property string $telegram
 * @property string $chat_id
 * @property integer $director_id
 * @property integer $managment_id
 * @property integer $country_id
 * @property integer $region_id
 * @property integer $district_id
 * @property string $address
 * @property integer $status
 * @property integer $isDelete
 * @property string $created
 * @property string $updated
 * @property string $setting
 * @property string $active_begin
 * @property string $active_end
 * @property string $activation_key
 * @property string $inn
 *
 * @property Complex $complex
 * @property Country $country
 * @property User $director
 * @property District $district
 * @property Managment $managment
 * @property Minestory $minestory
 * @property Region $region
 * @property User[] $users
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'complex_id', 'minestory_id', 'active_begin', 'active_end'], 'required'],
            [['complex_id', 'minestory_id', 'director_id', 'managment_id', 'country_id', 'region_id', 'district_id', 'status', 'isDelete'], 'integer'],
            [['created', 'updated', 'active_begin', 'active_end'], 'safe'],
            [['setting'], 'string'],
            [['code', 'name', 'address', 'activation_key'], 'string', 'max' => 255],
            [['email', 'phone', 'telegram', 'chat_id', 'inn'], 'string', 'max' => 60],
            [['code'], 'unique'],
            [['complex_id'], 'exist', 'skipOnError' => true, 'targetClass' => Complex::className(), 'targetAttribute' => ['complex_id' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['director_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['director_id' => 'id']],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['managment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Managment::className(), 'targetAttribute' => ['managment_id' => 'id']],
            [['minestory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Minestory::className(), 'targetAttribute' => ['minestory_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
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
            'complex_id' => 'Complex ID',
            'minestory_id' => 'Minestory ID',
            'email' => 'Email',
            'phone' => 'Phone',
            'telegram' => 'Telegram',
            'chat_id' => 'Chat ID',
            'director_id' => 'Director ID',
            'managment_id' => 'Managment ID',
            'country_id' => 'Country ID',
            'region_id' => 'Region ID',
            'district_id' => 'District ID',
            'address' => 'Address',
            'status' => 'Status',
            'isDelete' => 'Is Delete',
            'created' => 'Created',
            'updated' => 'Updated',
            'setting' => 'Setting',
            'active_begin' => 'Active Begin',
            'active_end' => 'Active End',
            'activation_key' => 'Activation Key',
            'inn' => 'Inn',
        ];
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
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
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
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManagment()
    {
        return $this->hasOne(Managment::className(), ['id' => 'managment_id']);
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
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['company_id' => 'id']);
    }
}
