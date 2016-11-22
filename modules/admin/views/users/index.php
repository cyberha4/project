<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\grid\ActionColumn;
use app\modules\admin\models\user;

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
            // 'email_confirm_token:email',
            // 'password_hash',
            // 'password_reset_token',
             'email:email',
            [
                'filter' => User::getStatusesArray(),
                'attribute' => 'status',
                'format' => 'raw',
                //'value' => 'statusName', //если передается строка, то автоматически вызывается метод модели, если передается анонимная ф-ия, то она вызывается через call_user_func
                'value' => function ($model, $key, $index, $column) {
                        /** @var User $model */
                        /** @var \yii\grid\DataColumn $column */
                        $value = $model->{$column->attribute};
                        $value = $model->status;// не совсем корректно так делать, потому что это уже сделано в datacolumn
                        switch ($value) {
                            case User::STATUS_ACTIVE:
                                $class = 'success';
                                break;
                            case User::STATUS_WAIT:
                                $class = 'warning';
                                break;
                            case User::STATUS_BLOCKED:
                            default:
                                $class = 'default';
                        };
                        $html = Html::tag('span', Html::encode($model->getStatusName()), ['class' => 'label label-' . $class]);
                        $html .= " " . ++$index . " ||| $key";
                    return $value === null ? $column->grid->emptyCell : $html;
            }
            ],

            [
                'class' => ActionColumn::classname(),
            ],
        ],
    ]); ?>
</div>
