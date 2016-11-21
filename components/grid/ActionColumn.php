<?php
namespace app\components\grid;
 
use yii\grid\ActionColumn as Column;
 
class ActionColumn extends Column
{
    public $contentOptions = [
        'class' => 'action-column',
    ];
}