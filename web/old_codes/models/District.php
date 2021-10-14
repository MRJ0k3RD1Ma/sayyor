<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $region_id
 * @property integer $country_id
 * @property string $setting
 *
 * @property Company[] $companies
 * @property Country $country
 * @property Region $region
 * @property Managment[] $managments
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'region_id', 'country_id'], 'required'],
            [['region_id', 'country_id'], 'integer'],
            [['setting'], 'string'],
            [['code', 'name'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
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
            'name' => 'Туман номи',
            'region_id' => 'Вилоят',
            'country_id' => 'Давлат',
            'setting' => 'Setting',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['district_id' => 'id']);
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
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManagments()
    {
        return $this->hasMany(Managment::className(), ['district_id' => 'id']);
    }
}
