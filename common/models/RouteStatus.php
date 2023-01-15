<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "route_status".
 *
 * @property int $id
 * @property string|null $name_uz
 * @property string|null $name_ru
 * @property string|null $icon
 * @property string|null $class
 *
 * @property RouteSert[] $routeSerts
 */
class RouteStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'route_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_uz', 'name_ru', 'icon','class'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('model', 'ID'),
            'name_uz' => Yii::t('model', 'Name Uz'),
            'name_ru' => Yii::t('model', 'Name Ru'),
            'icon' => Yii::t('model', 'Icon'),
        ];
    }

    /**
     * Gets query for [[RouteSerts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRouteSerts()
    {
        return $this->hasMany(RouteSert::className(), ['status_id' => 'id']);
    }
}
