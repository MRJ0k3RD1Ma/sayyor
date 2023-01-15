<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "organization_type".
 *
 * @property int $id
 * @property string $name
 *
 * @property Organizations[] $organizations
 */
class OrganizationType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'organization_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'name' => Yii::t('app', 'Nomi(Lotin)'),
        ];
    }

    /**
     * Gets query for [[Organizations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizations()
    {
        return $this->hasMany(Organizations::className(), ['type_id' => 'id']);
    }
    public function count(){
        return $this->hasMany(Organizations::className(),['type_id'=>'id'])->count();
    }
}
