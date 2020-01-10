<?php

namespace app\controllers;

use app\models\BuyTicketForm;
use app\models\Event;
use app\models\Ticket;
use app\models\UsersTicket;
use Yii;
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
            return $this->redirect('log-in');
        }
    }

    public function actionPersonalList()
    {
        $user = Yii::$app->getUser()->getIdentity();
        $users_ticket = $user->ticket;
        return $this->render('user-info', compact('user','users_ticket'));
    }

    public function actionAddMoney($id)
    {
        $user = User::findOne($id);
        $user->wallet = $user->wallet + 10000;
        $user->save(false);
        $this->redirect('/user/personal-list');
    }

    public function actionBuyTicket($id)
    {
        $event = Event::findOne($id);
        $events_tickets = $event->eventsTickets;
        $model = new BuyTicketForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->buy()){
            $this->redirect(['/user/buy-ticket', 'id' => $id]);
        } else {
                Yii::$app->session->setFlash('error_mesage','Вы не можете совершить данную операцию');
                return $this->redirect(['/user/buy-ticket','id' => $id]);
            }
        }
        return $this->render('buy-ticket', compact('model', 'event', 'events_tickets'));
    }

    public function actionReturnTicket($id)
    {
        if(Ticket::back($id))
        {
            return $this->redirect('/user/personal-list');
        }
        Yii::$app->session->setFlash('error_message','Ошибка');
        return $this->redirect('/user/personal-list');
    }
}
