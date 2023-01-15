<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "status_list".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property EmpPosts[] $empPosts
 */
class StatusList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status_list';
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
        return $this->hasMany(EmpPosts::className(), ['status_id' => 'id']);
    }
}
