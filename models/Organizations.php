<?php

namespace app\models;

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
            [['id_from_api', 'TIN', 'NA1_CODE', 'NS10_CODE', 'NS11_CODE', 'TELEFON', 'GD_TIN', 'GD_TEL_WORK', 'OKED', 'OKPO', 'OKONX', 'soato'], 'integer'],
            [['TIN', 'NA1_CODE', 'NS10_CODE', 'NS11_CODE', 'NAME_FULL', 'GD_FULL_NAME', 'GD_TIN', 'GD_TEL_WORK', 'GD_EMAIL', 'GB_FULL_NAME', 'GB_TIN', 'OKED', 'OKPO', 'OKONX', 'soato', 'DATE_END', 'CREATED', 'CHANGED', 'GD_MOBILE'], 'required'],
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
            'id_from_api' => Yii::t('app', 'Id From Api'),
            'TIN' => Yii::t('app', 'Tin'),
            'NA1_CODE' => Yii::t('app', 'Na1  Code'),
            'NS10_CODE' => Yii::t('app', 'ns10  code'),
            'NS11_CODE' => Yii::t('app', 'Ns11  Code'),
            'NAME_FULL' => Yii::t('app', 'Name  Full'),
            'ADDRESS' => Yii::t('app', 'Address'),
            'REG_DATE' => Yii::t('app', 'Reg  Date'),
            'DATE_TIN' => Yii::t('app', 'Date  Tin'),
            'REG_NUM' => Yii::t('app', 'Reg  Num'),
            'NS13_CODE' => Yii::t('app', 'Ns13  Code'),
            'TELEFON' => Yii::t('app', 'Telefon'),
            'TELEX' => Yii::t('app', 'Telex'),
            'FAX' => Yii::t('app', 'Fax'),
            'GD_FULL_NAME' => Yii::t('app', 'Gd  Full  Name'),
            'GD_TIN' => Yii::t('app', 'Gd  Tin'),
            'GD_TEL_WORK' => Yii::t('app', 'Gd  Tel  Work'),
            'GD_TEL_HOME' => Yii::t('app', 'Gd  Tel  Home'),
            'GD_EMAIL' => Yii::t('app', 'Gd  Email'),
            'GB_FULL_NAME' => Yii::t('app', 'Gb  Full  Name'),
            'GB_TIN' => Yii::t('app', 'Gb  Tin'),
            'GB_TEL_WORK' => Yii::t('app', 'Gb  Tel  Work'),
            'GB_TEL_HOME' => Yii::t('app', 'Gb  Tel  Home'),
            'OKED' => Yii::t('app', 'Oked'),
            'OKPO' => Yii::t('app', 'Okpo'),
            'OKONX' => Yii::t('app', 'Okonx'),
            'soato' => Yii::t('app', 'Soato'),
            'EMAIL' => Yii::t('app', 'Email'),
            'DATE_END' => Yii::t('app', 'Date  End'),
            'CREATED' => Yii::t('app', 'Created'),
            'CHANGED' => Yii::t('app', 'Changed'),
            'GD_MOBILE' => Yii::t('app', 'Gd  Mobile'),
            'BUDJET' => Yii::t('app', 'Budjet'),
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
}
