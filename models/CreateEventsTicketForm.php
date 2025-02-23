<?php

namespace app\models;

use yii\base\Model;

class CreateEventsTicketForm extends Model
{
    public $event_id;
    public $ticket_type_id;
    public $cost;
    public $amount;

    public function attributeLabels()
    {
        return
            [
                'ticket_type_id' => 'Тип билета',
                'cost' => 'Цена билета',
                'amount' => 'Количество билетов'
            ];
    }

    public function rules()
    {
        return
            [
                [['cost', 'amount'], 'integer', 'max' => 1000000],
                [['ticket_type_id','cost', 'amount'], 'default', 'value' => null]
            ];
    }

    public function create()
    {
        $tickets = new EventsTicket();
        $tickets->event_id = $this->event_id;
        $tickets->ticket_type_id = $this->ticket_type_id;
        $tickets->cost = $this->cost;
        $tickets->amount = $this->amount;
        return $tickets->save();
    }

    public function uniqueTicketType($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!EventsTicket::uniqueTicketType($this->event_id, $this->ticket_type_id)) {
                $this->addError($attribute, 'Нельзя два раза задавать один и тот же тип билета');
            }
        }
    }
}
