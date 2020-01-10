<?php


namespace app\models;

use yii\db\ActiveRecord;


class UsersTicket extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%users_ticket}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'ticket_id'] , 'safe'],
        ];
    }
}