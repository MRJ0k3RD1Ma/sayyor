<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "organizations".
 *
 * @property int $id
 * @property int|null $id_from_api
 * @property int $TIN
 * @property int $NA1_CODE
 * @property int $NS10_CODE
 * @property int $NS11_CODE
 * @property string $NAME_FULL
 * @property string|null $ADDRESS
 * @property string|null $REG_DATE
 * @property string|null $DATE_TIN
 * @property string|null $REG_NUM
 * @property string|null $NS13_CODE
 * @property int|null $TELEFON
 * @property string|null $TELEX
 * @property string|null $FAX
 * @property string $GD_FULL_NAME
 * @property int $GD_TIN
 * @property int $GD_TEL_WORK
 * @property bool $GD_TEL_HOME
 * @property string $GD_EMAIL
 * @property string $GB_FULL_NAME
 * @property string $GB_TIN
 * @property string|null $GB_TEL_WORK
 * @property string|null $GB_TEL_HOME
 * @property int $OKED
 * @property int $OKPO
 * @property int $OKONX
 * @property int $soato
 * @property string|null $EMAIL
 * @property string $DATE_END
 * @property string $CREATED
 * @property string $CHANGED
 * @property string $GD_MOBILE
 * @property bool $BUDJET
 * @property int $type_id
 *
 * @property EmpPosts[] $empPosts
 * @property EmpPostsHistory[] $empPostsHistories
 */
class Organizations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'organizations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_from_api', 'TIN', 'NA1_CODE','type_id', 'NS10_CODE', 'NS11_CODE', 'TELEFON', 'GD_TIN', 'GD_TEL_WORK', 'OKED', 'OKPO', 'OKONX', 'soato'], 'integer'],
            [['TIN',  'NAME_FULL', 'GD_FULL_NAME', 'soato',], 'required'],
            [['REG_DATE', 'DATE_TIN', 'DATE_END', 'CREATED', 'CHANGED'], 'safe'],
            [['BUDJET'], 'boolean'],
            [['NAME_FULL', 'ADDRESS', 'GD_FULL_NAME', 'GB_FULL_NAME'], 'string', 'max' => 255],
            [['REG_NUM', 'NS13_CODE', 'TELEX', 'FAX', 'GB_TIN', 'GB_TEL_WORK', 'GB_TEL_HOME', 'GD_MOBILE','GD_TEL_HOME'], 'string', 'max' => 30],
            [['GD_EMAIL', 'EMAIL'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_from_api' => Yii::t('app', 'Hamsadagi id'),
            'TIN' => Yii::t('app', 'STIR(INN)'),
            'NA1_CODE' => Yii::t('app', 'NA1  Kod'),
            'NS10_CODE' => Yii::t('app', 'NS10 Kod'),
            'NS11_CODE' => Yii::t('app', 'NS11 Kod'),
            'NAME_FULL' => Yii::t('app', 'Tashkilot nomi'),
            'ADDRESS' => Yii::t('app', 'Manzil'),
            'REG_DATE' => Yii::t('app', 'Ro\'yhatga olingan sana'),
            'DATE_TIN' => Yii::t('app', 'STIR(INN) olingan sana'),
            'REG_NUM' => Yii::t('app', 'Registratsiya raqami'),
            'NS13_CODE' => Yii::t('app', 'NS13 kod'),
            'TELEFON' => Yii::t('app', 'Telefon'),
            'TELEX' => Yii::t('app', 'Telefax'),
            'FAX' => Yii::t('app', 'Fax'),
            'GD_FULL_NAME' => Yii::t('app', 'Direktor FIO'),
            'GD_TIN' => Yii::t('app', 'Direktor STIR(INN)'),
            'GD_TEL_WORK' => Yii::t('app', 'Direktor ish telefoni'),
            'GD_TEL_HOME' => Yii::t('app', 'Direktor uy raqami'),
            'GD_EMAIL' => Yii::t('app', 'Direktor email'),
            'GB_FULL_NAME' => Yii::t('app', 'Buxgalter FIO'),
            'GB_TIN' => Yii::t('app', 'Buxgalter STIR(INN)'),
            'GB_TEL_WORK' => Yii::t('app', 'Buxgalter ish telefoni'),
            'GB_TEL_HOME' => Yii::t('app', 'Buxgalter Uy telefoni'),
            'OKED' => Yii::t('app', 'OKED'),
            'OKPO' => Yii::t('app', 'OKPO'),
            'OKONX' => Yii::t('app', 'OKONX'),
            'soato' => Yii::t('app', 'SOATO'),
            'EMAIL' => Yii::t('app', 'Email'),
            'DATE_END' => Yii::t('app', 'Date  End'),
            'CREATED' => Yii::t('app', 'Created'),
            'CHANGED' => Yii::t('app', 'Changed'),
            'GD_MOBILE' => Yii::t('app', 'Direktor qo\'l Telefoni'),
            'BUDJET' => Yii::t('app', 'Budjet'),
            'type_id' => Yii::t('app', 'Tashkilot turi'),
        ];
    }

    /**
     * Gets query for [[EmpPosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpPosts()
    {
        return $this->hasMany(EmpPosts::className(), ['org_id' => 'id']);
    }

    /**
     * Gets query for [[EmpPostsHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpPostsHistories()
    {
        return $this->hasMany(EmpPostsHistory::className(), ['org_id' => 'id']);
    }
    public function getSoato0(){
        return $this->hasOne(Soato::className(),['MHOBT_cod'=>'soato']);
    }
    public function getType(){
        return $this->hasOne(OrganizationType::className(),['id'=>'type_id']);
    }
}
