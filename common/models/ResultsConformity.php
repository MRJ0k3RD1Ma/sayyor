<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "results_conformity".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $organization_id
 *
 * @property Organizations $organization
 */
class ResultsConformity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'results_conformity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code',], 'required'],
            [['organization_id'], 'integer'],
            [['name', 'code'], 'string', 'max' => 255],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organizations::class, 'targetAttribute' => ['organization_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nomi',
            'code' => 'Sertifikat kodi',
            'organization_id' => 'Tashkilot nomi',
        ];
    }

    /**
     * Gets query for [[Organization]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organizations::class, ['id' => 'organization_id']);
    }
}
