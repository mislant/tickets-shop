<?php

namespace app\models;

use yii\base\Model;

class CreateEventForm extends Model
{
    public $title;
    public $adress;
    public $date;
    public $amount_of_tickets;

    public function attributeLabels()
    {
        return
        [
            'title' => "Название мероприятия",
            'adress' => 'Место проведения мероприятия',
            'date' => 'Время проведения мероприятия',
            'amount_of_tickets' => 'Количесвто билетов на мероприятие'
        ];
    }

    public function rules()
    {
        return[
            [['title','adress','date'], 'required'],
        ];
    }

    public function createEvent()
    {
        $event = new Event();
        $event->title = $this->title;
        $event->adress = $this->adress;
        $event->date = $this->date;
        $event->amount_of_tickets = $this->amount_of_tickets;
        return $event->save();
    }
}