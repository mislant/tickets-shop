<?php

namespace app\models;

use yii\base\Model;
use Yii;

class CreateEventForm extends Model
{
    public $id;
    public $title;
    public $description;
    public $adress;
    public $date;
    public $amount_of_tickets;

    public function attributeLabels()
    {
        return
            [
                'id' => 'ID',
                'title' => "Название мероприятия",
                'adress' => 'Место проведения мероприятия',
                'description' => 'Описание мероприятия',
                'date' => 'Время проведения мероприятия',
                'amount_of_tickets' => 'Количесвто билетов на мероприятие'
            ];
    }

    public function rules()
    {
        return [
            [['title', 'adress', 'date'], 'required'],
            ['date', 'dateValidate'],
            ['description', 'safe'],
        ];
    }

    public function dateValidate($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!Event::dataValidate($this->date)) {
                $this->addError($attribute, 'Нельзя указывать прошедшую дату');
            }
        }
    }

    public function create()
    {
        $event = new Event();
        $id = Yii::$app->user->getId();
        $event->created_by = $id;
        $event->title = $this->title;
        $event->adress = $this->adress;
        $event->date = $this->date;
        $event->amount_of_tickets = $this->amount_of_tickets;
        $event->save();
        return $event;
    }

    public function update($id)
    {
        $event = Event::findOne($id);
        $event->title = $this->title;
        $event->description = $this->description;
        $event->date = $this->date;
        $event->adress = $this->adress;
        return $event->save();
    }

}