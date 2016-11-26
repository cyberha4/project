<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');
 
return [
    'id' => 'app-console',
    'bootstrap' => ['gii'],
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'gii' => 'yii\gii\Module',
    	//    'admin' => [
    	//    'class' => 'app\modules\admin\Module',
    	//    'controllerNamespace' => 'app\modules\admin\commands',
    	//],
    	'main' => [
    	    'class' => 'app\modules\main\Module',
    	    'controllerNamespace' => 'app\modules\main\commands',
    	],
    	'user' => [
    	    'class' => 'app\modules\user\Module',
    	    'controllerNamespace' => 'app\modules\user\commands',
    	],

    ],
];
