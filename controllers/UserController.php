<?php

namespace app\controllers;

use app\models\BuyTicketForm;
use app\models\Event;
use app\models\EventSearch;
use app\models\EventsTicket;
use app\models\Ticket;
use app\models\UserProfile;
use yii\data\Sort;
use Yii;
use yii\base\Model;
use yii\data\Pagination;
use yii\web\Controller;
use app\models\SignupForm;
use app\models\LoginForm;
use app\models\User;

class UserController extends Controller
{

    public function actionSignUp()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->signup()) {
                return $this->redirect('/user/log-in');
            }
        }
        return $this->render('signup', compact('model'));
    }

    public function actionLogIn()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->user->login($model->getUser());
            return $this->goHome();
        }
        return $this->render('login', compact('model'));
    }

    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }
        return $this->redirect('log-in');
    }

    public function actionShowProfile()
    {
        $user = Yii::$app->getUser()->getIdentity();
        $sort = new Sort([
            'attributes' => [
                'event_id'
            ],
        ]);
        $query = Ticket::find()->where(['user_id' => $user->id])->orderBy($sort->orders);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 7]);
        $users_ticket = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('user-profile', compact('user', 'users_ticket', 'pages', 'sort'));

    }

    public function actionEditProfile()
    {
        $user = Yii::$app->getUser()->getIdentity();
        $model = new UserProfile();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->photoUpload() && $model->refresh()) {
                return $this->redirect('/user/show-profile');
            }
        }
        return $this->render('user-edit', compact('user', 'model'));
    }

    public function actionBuyTicket($id)
    {
        $event = Event::findOne($id);
        $events_tickets = EventsTicket::find()->where(['event_id' => $id])->joinWith('ticket_type')->all();
        if (isset($events_tickets)) {
            $models[] = new BuyTicketForm();
        } else {
            foreach ($events_tickets as $index => $events_ticket) {
                $models[] = new BuyTicketForm();
                $models[$index]->ticket_type_id = $events_ticket->ticket_type->id;
                $models[$index]->ticket_type = $events_ticket->ticket_type->type;
                $models[$index]->cost = $events_ticket->cost;
                $models[$index]->all = $events_ticket->amount;
            }
        }
        if (Model::loadMultiple($models, Yii::$app->request->post()) && Model::validateMultiple($models)) {
            return $this->redirect(['/event/buy-confirm', 'id' => $id, 'models' => $models]);
        }
        return $this->render('ticket_office', compact('models', 'event'));
    }

    public function actionReturnTicket($id)
    {
        if (Ticket::back($id)) {
            return $this->redirect('/user/show-profile');
        }
        Yii::$app->session->setFlash('error_message', 'Ошибка');
        return $this->redirect('/user/show-profile');
    }

    public function actionShowManagerTools()
    {
        $user = Yii::$app->getUser()->getIdentity();
        $model = new EventSearch();

        return $this->render('manager-tools', compact('user', 'model'));
    }


//    ==========================TemproraryFunctions======================================


    public function actionAddMoney($id)
    {
        $user = User::findOne($id);
        $user->wallet = $user->wallet + 10000;
        $user->save(false);
        $this->redirect('/user/show-profile');
    }
}
