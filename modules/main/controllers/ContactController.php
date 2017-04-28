<?php

namespace app\modules\main\controllers;

use app\modules\main\models\forms\ContactForm;
use Yii;

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
     * or not
     * @return string
     */
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
