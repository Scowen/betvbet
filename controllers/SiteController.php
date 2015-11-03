<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\form\LoginForm;
use app\models\form\RegisterForm;
use app\components\api\Football;
use app\models\User;
use app\models\Activate;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

        ];
    }

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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister() {
        $model = new RegisterForm();

        if ($model->load(Yii::$app->request->post()) && $model->submit()) {
            // Set a flash to send to the user.
            Yii::$app->getSession()->setFlash('success', 'Thank you for registering, a confirmation email has been sent to your address');
            // Now redirect the user to the activation page.
            // TODO: Actually make an activation page.
            $this->redirect(['site/activate']);
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionActivation() {
        $user = Yii::$app->user->getIdentity();
        if ($user->active) {
            Yii::$app->getSession()->setFlash("info", "You have already activated your account, super activation is not a thing.");
            $this->redirect(['site/index']);
        }

        return $this->render('activation', [
        ]);
    }

    public function actionActivate($code = null, $send = false) {
        $error = null;

        if ($code) {
            // Look for a code.
            $activate = Activate::find()->where(['code' => $code])->one();
            if ($activate) {
                if ($activate->expires > time()) {
                    $user = $activate->userobject;
                    $user->active = true;
                    $user->save();
                    echo "<div class='alert alert-success'>Your account has been activated successfully.</div><meta http-equiv=\"refresh\" content=\"5;url=". Yii::getAlias('@web') . "/site/index" ."/\" />";
                    Yii::$app->getSession()->setFlash("success", "Your account has been activated successfully.");
                    $this->redirect(['site/index']);
                } else {
                    $error = "Your activation code has expired, please check your inbox for a new activation email.";
                    $activate->userobject->sendActivationEmail();
                }
            } else {
                $error = "Sorry, we could not match your activation code.";
            }
        }

        if ($send) {
            $user = User::find()->where(['id' => $send])->one();

            if ($user) {
                $user->sendActivationEmail();
                echo "<div class='alert alert-info'>An activation email has been send to <strong>" . $user->email . "</strong>, make sure to check your spam/junk folder.</div>";
            } else {
                $error = "Could not find a user with the ID: $send.";
            }
        }

        if ($error)
            echo "<div class='alert alert-danger'>$error</div>";

        exit;
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
