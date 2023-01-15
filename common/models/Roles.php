<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "roles".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property PostList $id0
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'roles';
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
            'id' => Yii::t('model.roles', 'ID'),
            'name' => Yii::t('model.roles', 'Name'),
        ];
    }

    public function getPost(){
        return $this->hasMany(PostList::className(),['def_role'=>'id']);
    }
}
