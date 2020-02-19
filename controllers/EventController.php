<?php

namespace app\controllers;

use app\models\BuyTicketForm;
use app\models\EventSearch;
use app\models\Ticket;
use app\models\UploadPhoto;
use app\models\EventsTicket;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
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
                        'actions' => [
                            'show-ticket-type', 'ticket-type-create',
                            'ticket-type-delete', 'update-tickets-details',
                        ],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['manager', 'admin'],
                        'actions' => [
                            'delete-event', 'create-event',
                            'create-events-tickets', 'total-tickets',
                            'upload-event-photo', 'delete-event-photo',
                            'delete-events-tickets','show-events'
                        ],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['user', 'manager', 'admin'],
                        'actions' => ['show-event-details', 'buy-confirm', 'buy-ticket'],
                    ],
                ],
            ],
        ];
    }

    ///==================EventActionsBegin===========================


    public function actionShowEvents()
    {
        $model = new EventSearch();
        return $this->render('events-list', compact('model'));
    }

    public function actionCreateEvent()
    {

        $modelEvent = new CreateEventForm();
        $ticketTypes = TicketType::find()->all();
        $params = ['prompt' => 'Укажите тип билета'];
        $type = ArrayHelper::map($ticketTypes, 'id', 'type');
        foreach ($ticketTypes as $idx => $item) {
            $modelTickets[$idx] = new CreateEventsTicketForm();
        }
        if ($modelEvent->load(Yii::$app->request->post()) && $modelEvent->validate()) {
            if (Model::loadMultiple($modelTickets, Yii::$app->request->post()) && Model::validateMultiple($modelTickets)) {
                foreach ($modelTickets as $i => $model) {
                    if ($model->ticket_type_id == null) {
                        unset($modelTickets[$i]);
                    } else {
                        $checkArray[] = $model->ticket_type_id;
                    }
                }
                if (count($modelTickets) == 1) {
                    $event = $modelEvent->create();
                    foreach ($modelTickets as $model) {
                        $model->event_id = $event->id;
                        $model->create();
                    }
                } else {
                    $size = count($checkArray);
                    for ($i = 0; $i < $size; $i++) {
                        for ($j = $i + 1; $j < $size; $j++) {
                            if ($checkArray[$i] == $checkArray[$j]) {
                                Yii::$app->session->setFlash('ticket_type_err', 'Нельзя указывать два раза один и тот же тип билетов');
                                return $this->redirect('/event/create-event');
                            }
                        }
                    }
                    $event = $modelEvent->create();
                    foreach ($modelTickets as $i => $model) {
                        $model->event_id = $event->id;
                        $model->create();
                    }
                }
                Event::countTotal($event->id);
                return $this->redirect(['/event/show-event-details', 'id' => $event->id]);
            }
        }
        return $this->render('event_create', compact('modelEvent', 'modelTickets', 'params', 'type'));
    }

    public function actionShowEventDetails($id = null)
    {
        if ($id == null) {
            $id = Yii::$app->request->post('event_id');
        }
        if (Yii::$app->user->can('updateOwnEvent', ['event' => Event::findOne($id)])) {
            $event = Event::find()->with('events_photos')->where(['id' => $id])->one();
            $eventsTicket = EventsTicket::find()->where(['event_id' => $id])->joinWith('ticket_type')->all();
            $total = 0;
            foreach ($eventsTicket as $ticket) {
                $total += $ticket->amount;
            }
            $eventModel = new CreateEventForm();
            $eventPhoto = new UploadPhoto();
            if (Yii::$app->request->isAjax) {
                if ($eventModel->load(Yii::$app->request->post()) && $eventModel->validate() && $eventModel->update($id)) {
                    return $this->renderAjax('event_details', compact('event', 'eventModel', 'eventPhoto', 'eventsTicket', 'total'));
                } elseif (Model::loadMultiple($eventsTicket, Yii::$app->request->post()) && Model::validateMultiple($eventsTicket)) {
                    foreach ($eventsTicket as $ticket) {
                        $ticket->update();
                    }
                    Event::countTotal($id);
                    $total = 0;
                    foreach ($eventsTicket as $ticket) {
                        $total += $ticket->amount;
                    }
                    return $this->renderAjax('event_details', compact('event', 'eventModel', 'eventPhoto', 'eventsTicket', 'total'));
                }
            } elseif ($eventPhoto->load(Yii::$app->request->post()) && $eventPhoto->validate()) {
                if (count($event->events_photos) > 6) {
                    Yii::$app->session->setFlash('photo_warn', 'Нельзя загружать больше шести фотографий');
                    return $this->render('event_details', compact('event', 'eventModel', 'eventPhoto', 'eventsTicket', 'total'));
                } else {
                    $eventPhoto->uploadPhoto($id);
                    $event = Event::find()->with('events_photos')->where(['id' => $id])->one();
                    return $this->render('event_details', compact('event', 'eventModel', 'eventPhoto', 'eventsTicket', 'total'));
                }
            }
            return $this->render('event_details', compact('event', 'eventModel', 'eventPhoto', 'eventsTicket', 'total'));
        }
        Yii::$app->session->setFlash('access_deny' , 'В доступе отказано');
        return $this->redirect('/event/show-events');
    }

    public function actionDeleteEventPhoto()
    {
        $eventPhoto = new UploadPhoto();
        $event_id = Yii::$app->request->post('event_id');
        if ($eventPhoto->load(Yii::$app->request->post()) && $eventPhoto->photoDelete()) {
            return $this->redirect(['/event/show-event-details', 'id' => $event_id]);
        }
    }

    public function actionDeleteEvent($id)
    {
        if (Yii::$app->user->can('updateOwnEvent', ['event' => Event::find($id)->one()])) {
            Ticket::backBoughtTicket($id);
            if (Event::deleteEvent($id)) {
                return $this->redirect('event/show-events');
            }
        } else {
            Yii::$app->session->setFlash('error_message', 'У вас нет прав на данное действие!');
            return $this->redirect(['event/show-events']);
        }
    }

    public function actionDeleteEventsTickets($ticket_type_id, $event_id)
    {
        Ticket::backBoughtTicket($event_id,$ticket_type_id);
        EventsTicket::deleteEventsTickets($ticket_type_id, $event_id);
        Event::countTotal($event_id);
        return $this->redirect(['event/show-event-details', 'id' => $event_id]);
    }

    public function actionCreateEventsTickets($id)
    {
        $model = new CreateEventsTicketForm();
        $ticketTypes = TicketType::find()->all();
        $type = ArrayHelper::map($ticketTypes, 'id', 'type');
        if ($model->load(Yii::$app->request->post())) {
            $model->event_id = $id;
            if ($model->create()) {
                Event::countTotal($id);
                return $this->redirect(['event/show-event-details', 'id' => $id]);
            }
        }
        return $this->render('events_ticket_create', compact('model', 'type'));
    }

///==================EventActionsEnd===================================
///
/// =================TicketActionBegin=================================


    public function actionShowTicketType()
    {
        $query = TicketType::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => '15',
            ]
        ]);
        return $this->render('ticket_type', compact('dataProvider'));
    }

    public function actionTicketTypeCreate()
    {
        $model = new CreateTicketTypeForm;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->createTicketType()) {
                return $this->redirect('/event/show-ticket-type');
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
///
/// ==============BuyingTransactions============================

    public function actionBuyConfirm(array $models, $id)
    {
        foreach ($models as $index => $model) {
            if ($model['amount'] == 0) {
                unset($models[$index]);
            } elseif ($model['amount'] < 0) {
                Yii::$app->session->setFlash('ticket_err_msg', 'Не верное количество билетов');
                return $this->redirect(['/user/buy-ticket', 'id' => $id]);
            } elseif ($model['amount'] > $model['all']) {
                Yii::$app->session->setFlash('ticket_err_msg', 'Вы выбрали больше билетов чем есть');
                return $this->redirect(['user/buy-ticket', 'id' => $id]);
            }
        }
        if (empty($models)) {
            Yii::$app->session->setFlash('empty_ticket_err_msg', 'Вы не выбрали ни одного билета');
            return $this->redirect(['/user/buy-ticket', 'id' => $id]);
        }
        return $this->render('buy-confirm', compact('models', 'id'));
    }

    public function actionBuyTicket(array $models, $id)
    {
        foreach ($models as $model) {
            $form = new BuyTicketForm();
            $form->attributes = $model;
            if ($form->buy()) {
            } else {
                Yii::$app->session->setFlash('error_mesage', 'Вы не можете совершить данную операцию');
                return $this->redirect(['/user/buy-ticket', 'id' => $id]);
            }
        }
        Yii::$app->session->setFlash('success', 'Успех');
        Event::countTotal($id);
        return $this->redirect(['/user/buy-ticket', 'id' => $id]);
    }

}