<?php

namespace app\modules\main\controllers;

use app\modules\main\models\forms\ContactForm;
use app\modules\user\models\User;
use SebastianBergmann\CodeCoverage\InvalidArgumentException;
use Yii;
use yii\base\Model;
use yii\web\BadRequestHttpException;

class ContactController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Change view path
     */
    public function init()
    {
        $this->setViewPath('@main/views/testContact');
        parent::init();
    }

    /**
     * @override
     * Render without layout
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render($view, $params = [])
    {
        return $this->getView()->render($view, $params, $this);
    }

    /**
     * Render with layout (use old method render)
     * @param $view
     * @param array $params
     * @return string
     */
    public function oldRender($view, $params = [])
    {
        return parent::render($view, $params);
    }

    /**
     * With a probability of 50 percent render page with layout(header, footer)
     * or not. And if you are not logged, you will log with default profile
     * @throws BadRequestHttpException
     * @return string
     */
    public function actionIndex()
    {
        $model = new ContactForm();
//        Yii::$app->session->setFlash('contactFormSubmitted');
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }

        /** @var User $testUser */
        $testUser = Yii::createObject([
            'class' => User::class,
            'username' => "username",
            'email' => "email@email.com",
        ]);

//        $testUser = new User();
//        $testUser->email = "test@mail.ru";
//        $testUser->username = "username";

        try {
            $this->loginUser($testUser);
        } catch(\InvalidArgumentException $e){
            throw new BadRequestHttpException($e->getMessage());
        } catch(\Exception $e){
            throw new BadRequestHttpException("We have some problems, sorry for it");
        }

        $this->autoFillInputField($model);

        return $this->oldRender('index', [
            'model' => $model,
        ]);

        if (mt_rand(0,100)%2 === 0){
            return $this->render('index', [
                'model' => $model,
            ]);
        } else {
            return $this->oldRender('index', [
                'model' => $model,
            ]);
        }

    }

    /**
     * If user is <i>authorised</i> , <b>autofield</b> username and email fields<br>
     * If app at dev-mode, <b>autofield</b> verification code
     * @param  ContactForm $model
     */
    private function autoFillInputField(ContactForm $model){
        if($user = Yii::$app->user->identity){
            /** @var User $user */
            $model->name = $user->username;
            $model->email = $user->email;
        }

        if(YII_ENV_DEV){
            $captchaText = Yii::$app->session->get('__captcha/main/contact/captcha');
            $model->fillCaptchaInput($captchaText);
        }
    }

    /**
     * Loggining user
     * @param User $user
     * @return User loggined User
     */
    private function loginUser(User $user) : User{
        if(empty($user->username) || empty($user->email))
            throw new \InvalidArgumentException("User must have an username");

        if(Yii::$app->user->isGuest)
            Yii::$app->user->login($user);

        return $user;
    }

}
