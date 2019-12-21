<?php

namespace app\rbac;

use yii\rbac\Rule;

class AuthorRule extends Rule
{
    public $name = 'isAuthor';

    public function execute($user, $item, $params)
    {
        return isset($params['event']) ? $params['event']->created_by == $user || \Yii::$app->user->can('admin') : false;
    }
}