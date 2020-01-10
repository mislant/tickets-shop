<?php

namespace app\controllers;

use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Event;
use app\models\CreateEventForm;
use app\models\TicketType;
use app\models\CreateTicketTypeForm;
use app\models\CreateEventsTicketForm;

class EventController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                        'actions' => ['ticket-type-list', 'ticket-type-create', 'ticket-type-delete'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['manager', 'admin'],
                        'actions' => ['event-delete', 'event-create', 'events-ticket-create', 'total-tickets'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['user', 'manager', 'admin'],
                        'actions' => ['events-list', 'event-details'],
                    ],
                ],
            ],
        ];
    }

    ///==================EventActionsBegin===========================


    public function actionEventsList()
    {
        $data = Event::GiveAll();
        return $this->render('event', compact('data'));
    }

    public function actionEventDetails($id)
    {
        $event_model = new CreateEventForm();
        $ticket_model = new CreateEventsTicketForm();
        $event = Event::findOne($id);
        $events_tickets = $event->eventsTickets;
        if (Yii::$app->user->can('updateOwnEvent', ['event' => $event])) {
            if ($event_model->load(Yii::$app->request->post())) {
                if ($event_model->validate() && $event_model->update($id)) {
                    return $this->redirect(['/event/event-details', 'id' => $id]);
                }
            }
            if ($ticket_model->load(Yii::$app->request->post())) {
                if ($ticket_model->validate() && $ticket_model->update($id)) {
                    return $this->redirect(['/event/event-details', 'id' => $id]);
                }
            }
        }
        return $this->render('event_details', compact('event', 'events_tickets', 'event_model', 'ticket_model'));
    }

    public function actionEventCreate()
    {
        $model = new CreateEventForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $event = $model->create()) {
                return $this->redirect(['events-ticket-create', 'id' => $event->id]);
            }
        }
        return $this->render('event_create', compact('model'));
    }

    public function actionEventDelete($id)
    {
        if (Yii::$app->user->can('updateOwnEvent', ['event' => Event::find($id)->one()])) {
            if (Event::deleteEvent($id)) {
                return $this->redirect('events-list');
            }
        } else {
            Yii::$app->session->setFlash('error_message', 'У вас нет прав на данное действие!');
            return $this->redirect(['/event/events-list']);
        }
    }

    public function actionEventsTicketCreate($id)
    {
        $model = new CreateEventsTicketForm();
        $model->event_id = $id;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->create()) {
                Event::countTotal($id);
                return $this->redirect(['events-ticket-create', 'id' => $id]);
            }
        }
        return $this->render('events_ticket_create', compact('model'));
    }


    ///==================EventActionsEnd===================================
    ///
    /// =================TicketActionBegin=================================


    public function actionTicketTypeList()
    {
        $data = TicketType::GiveAll();
        return $this->render('ticket_type', compact('data'));
    }

    public function actionTicketTypeCreate()
    {
        $model = new CreateTicketTypeForm;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->createTicketType()) {
                return $this->redirect('/event/ticket-type-list');
            }
        }
        return $this->render('ticket_type_create', compact('model'));
    }

    public function actionTicketTypeDelete($id)
    {
        TicketType::deleteTicketType($id);
        return $this->redirect('/event/ticket-type-list');
    }



    /// =================TicketActionEnd============================


    ///==============================================================

    public function actionAddevent()
    {
        $event = new Event;
        $event->title = 'Мероприяте';
        $event->adress = 'Мироприятия';
        $event->amount_of_tickets = '10000';
        return $event->save();
    }

    public function actionTest()
    {
        return $this->render('test2');
    }
}