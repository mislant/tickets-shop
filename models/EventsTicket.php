<?php 

namespace app\models;

use yii\db\ActiveRecord;

class Events_ticket extends ActiveRecord
{
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    public function attributeLabels()
    {
        return
        [
            'id' => 'ID',
            'event_id' => 'Event id',
            'ticket_type' => 'Ticket type',
            'cost' => 'Cost',
            'amount' => 'Amount'
        ];
    }
}