<?php

namespace app\models;

use yii\base\Model;
use Yii;


class BuyTicketForm extends Model
{
    public $event_id;
    public $ticket_type_id;
    public $ticket_type;
    public $amount;
    public $all;
    public $cost;

    public function rules()
    {
        return [
            [['event_id', 'ticket_type_id', 'cost','ticket_type','all'], 'safe'],
            ['amount', 'string', 'max' => 1000000]
        ];
    }

    public function attributeLabels()
    {
        return [
            'amount' => 'Количество билетов',
        ];
    }

    public function buy()
    {
        if ($this->amount == 0) {
            return true;
        } else {
            $user = Yii::$app->getUser()->getIdentity();
            $total = $this->cost * $this->amount;
            if ($user->wallet < $total) {
                return false;
            } else {
                $user->wallet = $user->wallet - $total;
                $events_ticket = EventsTicket::findOne([
                    'event_id' => $this->event_id,
                    'ticket_type_id' => $this->ticket_type_id
                ]);
                if ($this->amount > $events_ticket->amount) {
                    return false;
                }
                $events_ticket->amount = $events_ticket->amount - $this->amount;
                Event::countTotal($this->event_id);
                for ($i = $this->amount; $i > 0; $i--) {
                    $ticket = new Ticket();
                    $ticket->user_id = $user->id;
                    $ticket->event_id = $this->event_id;
                    $ticket->ticket_type_id = $this->ticket_type_id;
                    $ticket->save();
                }
                $user->save();
                $events_ticket->save();
                return true;
            }
        }
    }
}