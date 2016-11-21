<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?> 
<br />
<?php
$rules = [
            [['newPassword', 'newPasswordRepeat'], 'required', 'on' => 2],
            ['newPassword', 'string', 'min' => 3],
            ['newPasswordRepeat', 'compare', 'compareAttribute' => '!!!!!!!!!!!!!!'],
        ];

$newArr = ArrayHelper::merge($rules, [
            [['newPassword', 'newPasswordRepeat'], 'required', 'on' => 1],
            ['newPassword', 'string', 'min' => 6],
            ['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword'],
        ]);

print_r_($newArr);
?>


</div>
