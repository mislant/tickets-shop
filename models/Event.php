<?php

namespace app\models;

use yii\db\ActiveRecord;

class Event extends ActiveRecord
{
    public function getEventsTickets()
    {
        return $this->hasMany(EventsTicket::className(), ['event_id' => 'id']);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'adress' => 'Adress',
            'date' => 'Date',
            'amount_of_tickets' => 'Amount of tickets'
        ];
    }

    public static function dataValidate($date)
    {
        $nowDate = date('Y-m-d H:i:s');
        return $nowDate <= $date;
    }

    public static function GiveAll()
    {
        $event = new Event;
        return $event->find()->all();
    }

    public static function countTotal($id)
    {
        $event = Event::findOne($id);
        $events_tickets = $event->eventsTickets;
        $total = 0;
        foreach ($events_tickets as $tickets) {
            $total += $tickets['amount'];
        }
        $event->amount_of_tickets = $total;
        return $event->save();
    }

    public static function deleteEvent($id)
    {
        $event = Event::findOne($id);
        $events_tickets = $event->eventsTickets;
        foreach ($events_tickets as $tickets) {
            $tickets->delete();
        }
        return $event->delete();
    }

}


