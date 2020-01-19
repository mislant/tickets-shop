<?php

namespace app\models;

use yii\db\ActiveRecord;

class TicketType extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%ticket_type}}';
    }

    public function getEventsTicket()
    {
        return $this->hasOne(EventsTicket::className(), ['ticket_type_id' => 'id']);
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
        $ticket_type = new TicketType;
        return $ticket_type->find()->all();
    }

    public static function deleteTicketType($id)
    {
        $ticket_type = TicketType::findOne($id);
        return $ticket_type->delete();
    }
}