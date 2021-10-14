<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "managment".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $register_id
 * @property integer $complex_id
 * @property integer $minestory_id
 * @property string $email
 * @property string $phone
 * @property string $telegram
 * @property string $chat_id
 * @property integer $country_id
 * @property integer $region_id
 * @property integer $district_id
 * @property integer $director_id
 * @property string $address
 * @property string $created
 * @property string $updated
 * @property integer $status
 * @property integer $isDelete
 * @property string $setting
 *
 * @property Company[] $companies
 * @property Complex $complex
 * @property Country $country
 * @property District $district
 * @property Minestory $minestory
 * @property Region $region
 * @property Admin $register
 * @property User $director
 */
class Managment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'managment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name',], 'required'],
            [['register_id', 'complex_id', 'minestory_id', 'country_id', 'region_id', 'district_id', 'director_id', 'status', 'isDelete'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['setting'], 'string'],
            [['code', 'name', 'address'], 'string', 'max' => 255],
            [['email', 'phone', 'telegram', 'chat_id'], 'string', 'max' => 60],
            [['code'], 'unique'],
            [['complex_id'], 'exist', 'skipOnError' => true, 'targetClass' => Complex::className(), 'targetAttribute' => ['complex_id' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['minestory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Minestory::className(), 'targetAttribute' => ['minestory_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
            [['director_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['director_id' => 'id']],
            ['register_id','default','value'=>Yii::$app->admin->identity->id],
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
            'name' => 'Ташкилот номи',
            'register_id' => 'Регистратор',
            'complex_id' => 'Комклекс',
            'minestory_id' => 'Юқори турувчи ташкилот',
            'email' => 'Email',
            'phone' => 'Телефон',
            'telegram' => 'Телеграм',
            'chat_id' => 'Чат ид',
            'country_id' => 'Давлат',
            'region_id' => 'Вилоят',
            'district_id' => 'Туман',
            'director_id' => 'Директор',
            'address' => 'Манзил',
            'created' => 'Яратилди',
            'updated' => 'Ўзгартирилди',
            'status' => 'Статус',
            'isDelete' => 'Ўчирилганлик',
            'setting' => 'Setting',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['managment_id' => 'id']);
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
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
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
}
