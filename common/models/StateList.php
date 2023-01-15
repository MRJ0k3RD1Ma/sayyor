<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "state_list".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property EmpPosts[] $empPosts
 * @property Organizations[] $organizations
 */
class StateList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'state_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Nomi'),
        ];
    }

    /**
     * Gets query for [[EmpPosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpPosts()
    {
        return $this->hasMany(EmpPosts::className(), ['state_id' => 'id']);
    }

    /**
     * Gets query for [[Organizations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizations()
    {
        return $this->hasMany(Organizations::className(), ['state' => 'id']);
    }
}
