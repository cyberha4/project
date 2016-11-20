<?php

namespace app\modules\main\controllers;
 
use app\modules\main\models\ContactForm;
use yii\web\Controller;
use Yii;
use yii\base\Event;
use yii\db\ActiveRecord;
use app\modules\user\models\User;


class ContactController extends Controller
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
 
    public function actionIndex()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
 
            return $this->refresh();
        } else {
            //Добавлено событие по приколу еже
            Event::on(ActiveRecord::className(), ActiveRecord::EVENT_AFTER_FIND, function ($event) {
            Yii::trace(get_class($event->sender) . ' найден');
            });
            //Yii::$app->session->setFlash('contactFormSubmitted');
            User::findByUsername('kiberha4');

            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }
}
