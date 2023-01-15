<?php

namespace client\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class InnForm extends Model
{
    public $name;
    public $inn;
    public $pnfl;
    public $passport;
    public $type;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'inn', 'pnfl', 'passport','type'], 'string'],
            // email has to be a valid email address
            // verifyCode needs to be entered correctly
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('model','Nomi'),
            'inn' => Yii::t('model','STIR(INN)'),
            'pnfl' => Yii::t('model','JSH SHIR(PINFL)'),
            'document' => Yii::t('model','Passport'),
            'type' => Yii::t('model','Kontragent turi'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
