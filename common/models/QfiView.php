<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "qfi_view".
 *
 * @property int $MHOBT_cod
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
class QfiView extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'qfi_view';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MHOBT_cod'], 'required'],
            [['MHOBT_cod', 'district_id','region_id', 'qfi_id'], 'integer'],
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
            'MHOBT_cod' => Yii::t('model.qfiview', 'Mhobt Cod'),
            'district_id' => Yii::t('model.qfiview', 'District ID'),
            'region_id' => Yii::t('model.qfiview', 'Region ID'),
            'qfi_id' => Yii::t('model.qfiview', 'Qfi ID'),
            'name_lot' => Yii::t('model.qfiview', 'Name Lot'),
            'center_lot' => Yii::t('model.qfiview', 'Center Lot'),
            'name_cyr' => Yii::t('model.qfiview', 'Name Cyr'),
            'center_cyr' => Yii::t('model.qfiview', 'Center Cyr'),
            'name_ru' => Yii::t('model.qfiview', 'Name Ru'),
            'center_ru' => Yii::t('model.qfiview', 'Center Ru'),
        ];
    }
}
