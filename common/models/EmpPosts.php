<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "emp_posts".
 *
 * @property int $id
 * @property int|null $emp_id
 * @property int|null $post_id
 * @property string|null $date Лавозими ёки статуси ўзгарган вақти.
 * @property int|null $state_id Ходимнинг холати. Актив, ноактив
 * @property int|null $status_id Лавозим статуси :  асосий лавозим, вақтинчалик вазифасини бажарувчи, ва ҳ.к.
 * @property int|null $org_id Ташкилот (Бўлим)
 * @property int|null $gov_id Ташкилот (Бўлим)
 * @property int|null $orgtype
 *
 * @property Employees $emp
 * @property Organizations $org
 * @property PostList $post
 * @property StateList $state
 * @property StatusList $status
 * @property Goverments $gov
 */
class EmpPosts extends \yii\db\ActiveRecord
{
    public $orgtype;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'emp_posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['emp_id', 'orgtype', 'post_id', 'gov_id', 'state_id', 'status_id', 'org_id'], 'integer'],
            [['date'], 'safe'],
            ['date', 'default', 'value' => date('Y-m-d')],
            [['emp_id'], 'unique'],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusList::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['org_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organizations::className(), 'targetAttribute' => ['org_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostList::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => StateList::className(), 'targetAttribute' => ['state_id' => 'id']],
            [['emp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['emp_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'emp_id' => Yii::t('app', 'Hodim'),
            'post_id' => Yii::t('app', 'Lavozim'),
            'date' => Yii::t('app', 'Tayinlangan sana'),
            'state_id' => Yii::t('app', 'Holati'),
            'status_id' => Yii::t('app', 'Status'),
            'org_id' => Yii::t('app', 'Tashkilot'),
            'gov_id' => Yii::t('app', 'Bo\'lim'),
            'orgtype' => Yii::t('app', 'Tashkilot turi'),
        ];
    }

    /**
     * Gets query for [[Emp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmp()
    {
        return $this->hasOne(Employees::className(), ['id' => 'emp_id']);
    }

    /**
     * Gets query for [[Org]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrg()
    {
        return $this->hasOne(Organizations::className(), ['id' => 'org_id']);
    }

    public function getGov()
    {
        return $this->hasOne(Goverments::className(), ['id' => 'gov_id']);
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(PostList::className(), ['id' => 'post_id']);
    }

    /**
     * Gets query for [[State]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(StateList::className(), ['id' => 'state_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(StatusList::className(), ['id' => 'status_id']);
    }

    public static function isDirector($id)
    {
        return self::find()->where(['emp_id' => $id, 'post_id' => 4])->exists();
    }

    public static function isLeader($id)
    {
        return self::find()->where(['emp_id' => $id, 'post_id' => 3])->exists();
    }

    public static function isLabor($id)
    {
        return self::find()->where(['emp_id' => $id, 'post_id' => 2])->exists();
    }
    public static function isRegister($id)
    {
        return self::find()->where(['emp_id' => $id, 'post_id' => 1])->exists();
    }
}
