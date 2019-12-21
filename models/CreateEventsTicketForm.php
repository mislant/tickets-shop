<?php 

namespace app\models;

use yii\base\Model;

class CreateEvents_ticketForm extends Model
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
            [['ticket_type_id','cost','amount'] , 'required'],
        ];
    }

    public function create()
    {
        $tickets = new Events_ticket();
        $tickets->event_id = $this->event_id;
        $tickets->ticket_type_id = $this->ticket_type_id;
        $tickets->cost = $this->cost;
        $tickets->amount = $this->amount;
        return $tickets->save();  
    }
}
