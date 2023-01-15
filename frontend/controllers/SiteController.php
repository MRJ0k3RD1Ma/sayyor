<?php

namespace frontend\controllers;

use common\models\DistrictView;
use common\models\EmpPosts;
use common\models\Individuals;
use common\models\LegalEntities;
use common\models\QfiView;
use common\models\VetSites;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\BaseObject;
use yii\base\InvalidArgumentException;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'login';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }
        if ($model->errors) {
            Yii::$app->session->setFlash('error', Yii::t('client', 'Login yoki parol xato'));
            return $this->redirect(['/site/']);
        }
        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    // send funksiya

    public function actionSend($phone, $text)
    {
        if ($phone[0] == '+') {
            $phone = substr($phone, 1, strlen($phone) - 1);
        }
        $token = json_decode($this->getToken(), true);
        $token = $token['data']['token'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'notify.eskiz.uz/api/message/sms/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('mobile_phone' => $phone, 'message' => $text, 'from' => '4546', 'callback_url' => Yii::$app->urlManager->createAbsoluteUrl(['/site/message'])),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        exit;
    }

    public function getToken()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'notify.eskiz.uz/api/auth/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('email' => Yii::$app->params['eskiz']['email'], 'password' => Yii::$app->params['eskiz']['password']),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }


    public function actionGetInd($pnfl, $doc)
    {
        if ($model = Individuals::find()->where(['pnfl' => $pnfl])->andWhere(['passport' => $doc])->one()) {
            $res = "{
                \"code\":200,
                \"value\":{\"pnfl\":\"{$pnfl}\",
                    \"name\":\"{$model->name}\",
                    \"surname\":\"{$model->surname}\",
                    \"middlename\":\"{$model->middlename}\",
                    \"region_id\":\"{$model->soato->region_id}\",
                    \"district_id\":\"{$model->soato->district_id}\",
                    \"soato_id\":\"{$model->soato_id}\",
                    \"passport\":\"{$model->passport}\",
                    \"adress\":\"{$model->adress}\"
                }
            }";
        } else {
            $res = get_web_page(Yii::$app->params['hamsa']['url']['getfizinfo'] . '?pinfl=' . $pnfl . '&document=' . $doc, 'hamsa');
            $model = new Individuals();
            $res = json_decode($res, true);
            if ($res['code']['result'] != 2200 or (isset($res['data']['result']) and $res['data']['result'] == 0)) {
                return -1;
            }

            $model->passport = $res['data']['inf']['document'];
            $model->surname = $res['data']['inf']['surname_latin'];
            $model->name = $res['data']['inf']['name_latin'];
            $model->middlename = $res['data']['inf']['patronym_latin'];
            $model->pnfl = $pnfl;
            $res = "{
                \"code\":200,
                \"value\":{\"pnfl\":\"{$pnfl}\",
                    \"name\":\"{$model->name}\",
                    \"surname\":\"{$model->surname}\",
                    \"middlename\":\"{$model->middlename}\",
                    \"region_id\":\"-1\",
                    \"district_id\":\"-1\",
                    \"soato_id\":\"-1\",
                    \"passport\":\"{$model->passport}\",
                    \"adress\":\"{$model->adress}\"
                }
            }";
        }
        echo $res;
        exit;
    }


    public function actionGetDistrict($id)
    {
        $model = DistrictView::find()->where(['region_id' => $id])->all();
        $text = Yii::t('cp.vetsites', '- Tumanni tanlang -');
        $res = "<option value=''>{$text}</option>";
        $lang = Yii::$app->language;
        foreach ($model as $item) {
            if ($lang == 'ru') {
                $name = $item->name_ru;
            } elseif ($lang == 'oz') {
                $name = $item->name_cyr;
            } else {
                $name = $item->name_lot;
            }
            $res .= "<option value='{$item->district_id}'>{$name}</option>";
        }
        echo $res;
        exit;
    }

    public function actionGetQfi($id, $regid)
    {
        $model = QfiView::find()->where(['district_id' => $id])->andWhere(['region_id' => $regid])->all();
        $text = Yii::t('cp.vetsites', '- QFYni tanlang -');
        $res = "<option value=''>{$text}</option>";
        $lang = Yii::$app->language;
        foreach ($model as $item) {
            if ($lang == 'ru') {
                $name = $item->name_ru;
            } elseif ($lang == 'oz') {
                $name = $item->name_cyr;
            } else {
                $name = $item->name_lot;
            }
            $res .= "<option value='{$item->MHOBT_cod}'>{$name}</option>";
        }
        echo $res;
        exit;
    }

    public function actionGetinn($inn)
    {
        if ($model = LegalEntities::findOne(['inn' => $inn])) {
            $res = "{
                \"code\":200,
                \"value\":{\"inn\":\"{$inn}\",
                    \"name\":\"{$model->name}\",
                    \"region\":\"{$model->soato->region_id}\",
                    \"district\":\"{$model->soato->district_id}\",
                    \"soato_id\":\"{$model->soato_id}\",
                    \"tshx_id\":\"{$model->tshx_id}\",
                    \"soogu\":\"{$model->soogu}\"
                }
            }";
            return $res;
        } else {
            return -1;
        }
    }

    public function actionGetvetsites($id)
    {
        $model = VetSites::find()->where(['soato' => $id])->all();
        $text = Yii::t('cp.vetsites', '- Vet uchstkani tanlang -');
        $res = "<option value=''>{$text}</option>";
        foreach ($model as $item) {

            $res .= "<option value='{$item->id}'>{$item->name}</option>";
        }
        echo $res;
        exit;
    }
}
