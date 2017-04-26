<?php

namespace app\modules\main\controllers;

use app\modules\main\models\forms\ContactForm;
use Yii;

class ContactController extends \yii\web\Controller
{
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

    public function init()
    {
        Yii::trace(Yii::getAlias('@main') . ' change view path', $this->className());
        $this->setViewPath('@main/views/testContact');
        parent::init();
    }

    public function render($view, $params = [])
    {
        return $this->getView()->render($view, $params, $this);
    }

    public function oldRender($view, $params = [])
    {
        return parent::render($view, $params);
    }

    public function actionIndex()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }

        if (mt_rand(0,100)%2 === 0){
            return $this->render('index', [
                'model' => $model,
            ]);
        }

        return $this->oldRender('index', [
            'model' => $model,
        ]);


    }
}
