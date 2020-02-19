<?php

namespace app\models;

use yii\db\ActiveRecord;

class EventsTicket extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%events_ticket}}';
    }

    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    public function getTicket_type()
    {
        return $this->hasOne(TicketType::className(),['id' => 'ticket_type_id']);
    }

    public function attributeLabels()
    {
        return
            [
                'id' => 'ID',
                'event_id' => 'Event id',
                'ticket_type_id' => 'Ticket type',
                'cost' => 'Cost',
                'amount' => 'Amount'
            ];
    }

    public function rules()
    {
        return [
            [['id', 'event_id', 'ticket_type_id'], 'safe'],
            [['cost', 'amount'], 'integer', 'max' => 10000000],
        ];
    }

    public static function uniqueTicketType($event_id, $ticket_type_id)
    {
        $events_tickets = EventsTicket::findAll(['event_id' => $event_id,]);
        foreach ($events_tickets as $event_ticket) {
            if ($event_ticket->ticket_type_id == $ticket_type_id) {
                return false;
            }
        }
        return true;
    }

    public static function deleteEventsTickets($type_id,$event_id)
    {
        $eventsTickets = EventsTicket::find()->where(['event_id' => $event_id , 'ticket_type_id' => $type_id])->one();
        return $eventsTickets->delete();
    }
}