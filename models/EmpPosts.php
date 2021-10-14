<?php

namespace app\models;

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
 *
 * @property Employees $emp
 * @property Organizations $org
 * @property PostList $post
 * @property StateList $state
 * @property StatusList $status
 */
class EmpPosts extends \yii\db\ActiveRecord
{
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
            [['emp_id', 'post_id', 'state_id', 'status_id', 'org_id'], 'integer'],
            [['date'], 'safe'],
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
            'emp_id' => Yii::t('app', 'Emp ID'),
            'post_id' => Yii::t('app', 'Post ID'),
            'date' => Yii::t('app', 'Date'),
            'state_id' => Yii::t('app', 'State ID'),
            'status_id' => Yii::t('app', 'Status ID'),
            'org_id' => Yii::t('app', 'Org ID'),
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
}
