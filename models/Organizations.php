<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organizations".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $parent_id
 * @property int|null $state
 * @property int|null $district_id
 *
 * @property Regions $district
 * @property EmpPosts[] $empPosts
 * @property EmpPostsHistory[] $empPostsHistories
 * @property StateList $state0
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
            [['parent_id', 'state', 'district_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['state'], 'exist', 'skipOnError' => true, 'targetClass' => StateList::className(), 'targetAttribute' => ['state' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'parent_id' => 'Parent ID',
            'state' => 'State',
            'district_id' => 'District ID',
        ];
    }

    /**
     * Gets query for [[District]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(Regions::className(), ['id' => 'district_id']);
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
}
