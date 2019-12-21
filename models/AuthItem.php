<?php


namespace app\models;

use yii\db\ActiveRecord;


class AuthItem extends ActiveRecord
{
    public static function GiveRoles()
    {
        return $roles = AuthItem::find()->where(['type' => 1])->all();
    }
}