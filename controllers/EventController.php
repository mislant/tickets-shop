<?php 

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Event;
use app\models\CreateEventForm;
use app\models\Ticket_type;
use app\models\CreateTicket_typeForm;
use app\models\Events_ticket;
use app\models\CreateEvents_ticketForm;

class EventController extends Controller
{
    public function actionShowEvents()
    {
        $data = Event::GiveAll();
        return $this->render('event', compact('data'));
    }

    public function actionEventCreate()
    {
        $model = new CreateEventForm();
        if(Yii::$app->request->post('CreateEventForm'))
        {
            $model->attributes = Yii::$app->request->post('CreateEventForm');
            if ($model->validate() && $model->createEvent())
            {
                return $this->redirect('events_ticket-create');
            }
        }
        return $this->render('create_event',compact('model'));
    }

    public function actionShowTicket_type()
    {
        $data = Ticket_type::GiveAll();
        return $this->render('tickettype',compact('data'));
    }

    public function actionTicket_typeCreate()
    {
        $model = new CreateTicket_typeForm;
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->validate() && $model->createTicket_type())
            {
                return $this->goHome();
            }
        }
        return $this->render('create_ticket_type' , compact('model'));
    }

    public function actionEvents_ticketCreate()
    {
        $model = new CreateEvents_ticketForm();
        $model->event_id = Event::GiveLastId();
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->validate() && $model->create())
            {
                return $this->redirect('events_ticket-create');
            }
        }
        return $this->render('create_events_ticket',compact('model'));
    }

    public function actionTotalTickets()
    {
        if (Event::countTotal())
        {
            return $this->goHome();
        }
    }

//==============================================================

    public function actionAddevent()
    {
        $event = new Event;
        $event->title = 'Мероприяте';
        $event->adress = 'Мироприятия';
        $event->amount_of_tickets = '10000';
        return $event->save();
    }
}