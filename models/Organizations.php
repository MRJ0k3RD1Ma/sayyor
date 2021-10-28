<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organizations".
 *
 * @property int $id
 * @property string $name
 * @property int $parent_id
 * @property int|null $state
 * @property int|null $district_id
 * @property int|null $type_id
 *
 * @property Districts $district
 * @property EmpPosts[] $empPosts
 * @property EmpPostsHistory[] $empPostsHistories
 * @property StateList $state0
 * @property OrganizationType $type
 */
class Organizations extends \yii\db\ActiveRecord
{
    public $reg,$yuqori_reg,$yuqori_dist,$yuqori_type;
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
            [['name', 'state', 'district_id', 'type_id'], 'required'],
            [['parent_id','yuqori_dist','yuqori_reg','reg', 'state', 'district_id', 'type_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['state'], 'exist', 'skipOnError' => true, 'targetClass' => StateList::className(), 'targetAttribute' => ['state' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'state' => Yii::t('app', 'State'),
            'district_id' => Yii::t('app', 'District ID'),
            'type_id' => Yii::t('app', 'Type ID'),
            'reg' => Yii::t('app', 'Region ID'),
        ];
    }

    /**
     * Gets query for [[District]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(Districts::className(), ['id' => 'district_id']);
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

    /**
     * Gets query for [[State0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getState0()
    {
        return $this->hasOne(StateList::className(), ['id' => 'state']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(OrganizationType::className(), ['id' => 'type_id']);
    }
}
