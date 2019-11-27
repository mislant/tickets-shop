<?php

namespace app\models;

use yii\db\ActiveRecord;

class Event extends ActiveRecord
{
    public function getEvents_tickets()
    {
        return $this->hasMany(Events_ticket::className(),['event_id' => 'id']);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'adress' => 'Adress',
            'date' => 'Date',
            'amount_of_tickets' => 'Amount og tickets'
        ];
    }

    public static function GiveAll()
    {
        $event = new Event;
        return $event->find()->all();
    }

    public static function GiveLastId()
    {
        $events = Event::find()->asArray()->all();
        $reversed_events = array_reverse($events);
        $last_event = $reversed_events[0];
        $id = 0 + $last_event['id'];
        return $id;
    }

    public static function countTotal()
    {
        $event = Event::findOne(Event::GiveLastId());
        $event_tickets = $event->events_tickets;
        $total = 0;
        foreach ($event_tickets as $tickets) 
        {
            $total += $tickets['amount'];
        }
        $event->amount_of_tickets = $total;
        return $event->save();
    }
}


