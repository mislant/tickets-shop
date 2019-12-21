<?php

namespace app\models;

use yii\db\ActiveRecord;

class TicketType extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%ticket_type}}';
    }

    public function attributeLabels()
    {
        return
            [
                'id' => 'ID',
                'type' => 'Type'
            ];
    }

    public static function GiveAll()
    {
        $ticket_type = new Ticket_type;
        return $ticket_type->find()->all();
    }
}