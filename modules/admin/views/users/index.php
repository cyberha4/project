<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use app\components\grid\ActionColumn;
use app\components\grid\SetColumn;
use app\modules\admin\models\user;
use app\modules\admin\components\UserStatusColumn;
use app\modules\admin\module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
//$searchModel->id = 2;
?>
<div class="admin-user-index">

    <h1><?= Html::encode($this->title) . module::t('module', 'test') . $expire?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
             [
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_from',
                    'attribute2' => 'date_to',
                    'type' => DatePicker::TYPE_RANGE,
                    'separator' => '-',
                    'pluginOptions' => ['format' => 'yyyy-mm-dd']
                ]),
                'attribute' => 'created_at',
                'format' => 'datetime',
                'options' => ['width' => '250'],
            ],
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
                'options' => ['width' => '200'],

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
                'template' => '{view} {update}',
            ],
        ],
    ]); ?>
</div>
<?php print_r_(\Yii::$app->params) ?>
есть скрытое поле карточек
<div hidden class="row">
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img class="img-responsive" src="http://elisdn1.local/images/point.jpg" alt="...">
      <div class="caption">
        <h3>Ярлык эскиза</h3>
        <p>...</p>
        <p><a href="#" class="btn btn-primary" role="button">Кнопка</a> <a href="#" class="btn btn-default" role="button">Кнопка</a></p>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img class="img-responsive" src="http://i.stack.imgur.com/36SM0.png" alt="...">
      <div class="caption">
        <h3>Ярлык эскиза</h3>
        <p>...</p>
        <p><a href="#" class="btn btn-primary" role="button">Кнопка</a> <a href="#" class="btn btn-default" role="button">Кнопка</a></p>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img class="img-responsive" src="http://i.stack.imgur.com/36SM0.png" alt="...">
      <div class="caption">
        <h3>Ярлык эскиза</h3>
        <p>...</p>
        <p><a href="#" class="btn btn-primary" role="button">Кнопка</a> <a href="#" class="btn btn-default" role="button">Кнопка</a></p>
      </div>
    </div>
  </div>
</div>

