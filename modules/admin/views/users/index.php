<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\grid\ActionColumn;
use app\components\grid\SetColumn;
use app\modules\admin\models\user;
use app\modules\admin\components\UserStatusColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created_at',
            //'updated_at',
            [
                'attribute' => 'username',
                'format' => 'html',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model->username, ['users/' . $model->id]);
                },
                'contentOptions' => ['style' => 'background-color : rgba(51, 122, 183, 0.44);'],
            ],
            'auth_key',
            //'email_confirm_token:email',
            [
                'attribute' => 'email_confirm_token',
                'options' => ['width' => '200']

            ],
             //'password_hash',
             'password_reset_token',
             'email:email',
            [
                'class' => SetColumn::className(),
                'filter' => User::getStatusesArray(),
                'attribute' => 'status',
                'name' => 'statusName',
                'cssCLasses' => [
                    User::STATUS_ACTIVE => 'success',
                    User::STATUS_WAIT => 'warning',
                    User::STATUS_BLOCKED => 'default',
                ],
            ],

            [
                'class' => ActionColumn::classname(),
            ],
        ],
    ]); ?>
</div>

<div class="row">
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img data-src="http://elisdn.local/images/point.jpg" alt="...">
      <div class="caption">
        <h3>Ярлык эскиза</h3>
        <p>...</p>
        <p><a href="#" class="btn btn-primary" role="button">Кнопка</a> <a href="#" class="btn btn-default" role="button">Кнопка</a></p>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img data-src="http://i.stack.imgur.com/36SM0.png" alt="...">
      <div class="caption">
        <h3>Ярлык эскиза</h3>
        <p>...</p>
        <p><a href="#" class="btn btn-primary" role="button">Кнопка</a> <a href="#" class="btn btn-default" role="button">Кнопка</a></p>
      </div>
    </div>
  </div>
</div>
