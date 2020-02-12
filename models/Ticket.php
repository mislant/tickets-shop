<?php


namespace app\models;

use Yii;
use yii\db\ActiveRecord;


class Ticket extends ActiveRecord
{
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getTicket_type()
    {
        return $this->hasOne(TicketType::className(), ['id' => 'ticket_type_id']);
    }

    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    public static function tableName()
    {
        return '{{%ticket}}';
    }

    public function rules()
    {
        return [
            [['event_id', 'ticket_type_id'], 'safe'],
        ];
    }

    public static function back($id)
    {
        $ticket = Ticket::findOne($id);
        $events_ticket = EventsTicket::find()->where([
            'event_id' => $ticket->event_id,
            'ticket_type_id' => $ticket->ticket_type_id,
        ])->one();
        $events_ticket->amount += 1;
        $user = Yii::$app->getUser()->getIdentity();
        $user->wallet += $events_ticket->cost;
        $user->save();
        $events_ticket->save();
        $ticket->delete();
        return true;
    }
}