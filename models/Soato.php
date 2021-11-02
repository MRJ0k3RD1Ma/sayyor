<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "soato".
 *
 * @property int|null $MHOBT_cod
 * @property int|null $res_id
 * @property int|null $region_id
 * @property int|null $district_id
 * @property int|null $qfi_id
 * @property string|null $name_lot
 * @property string|null $center_lot
 * @property string|null $name_cyr
 * @property string|null $center_cyr
 * @property string|null $name_ru
 * @property string|null $center_ru
 */
class Soato extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'soato';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MHOBT_cod', 'res_id', 'region_id', 'district_id', 'qfi_id'], 'integer'],
            [['name_lot', 'name_cyr', 'name_ru'], 'string', 'max' => 100],
            [['center_lot', 'center_cyr', 'center_ru'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MHOBT_cod' => Yii::t('app', 'Mhobt Cod'),
            'res_id' => Yii::t('app', 'Res ID'),
            'region_id' => Yii::t('app', 'Region ID'),
            'district_id' => Yii::t('app', 'District ID'),
            'qfi_id' => Yii::t('app', 'Qfi ID'),
            'name_lot' => Yii::t('app', 'Name Lot'),
            'center_lot' => Yii::t('app', 'Center Lot'),
            'name_cyr' => Yii::t('app', 'Name Cyr'),
            'center_cyr' => Yii::t('app', 'Center Cyr'),
            'name_ru' => Yii::t('app', 'Name Ru'),
            'center_ru' => Yii::t('app', 'Center Ru'),
        ];
    }
}
