<?php

namespace app\modules\main\controllers;

use Yii;
use yii\web\Controller;

/**
 * Default controller for the `main` module
 */
class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Every request in this controller create trace message
     * with path to allias @main for debbuger
     */
    public function init()
    {
        Yii::trace(Yii::getAlias('@main'), $this->className());
        parent::init();
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'time' => date('H:i:s')
        ]);
    }
}
