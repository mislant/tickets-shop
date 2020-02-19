<?php

namespace app\controllers;

use app\models\BuyTicketForm;
use app\models\Event;
use app\models\EventSearch;
use app\models\EventsTicket;
use app\models\Ticket;
use Yii;
use yii\base\Model;
use yii\helpers\Html;
use yii\web\Controller;
use app\models\SignupForm;
use app\models\LoginForm;
use app\models\User;
use yii\web\Response;
use yii\widgets\ActiveForm;

class UserController extends Controller
{

    public function actionSignUp()
    {
        $model = new SignupForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($model->validate() && $model->signup()) {
                return $this->goHome();
            } else {
                return ActiveForm::validate($model);
            }
        }
        return $this->goHome();
    }

    public function actionLogIn()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($model->validate()) {
                Yii::$app->user->login($model->getUser());
                return $this->goHome();
            } else {
                return ActiveForm::validate($model);
            }
        }
        return $this->goHome();
    }

    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }
        return $this->goHome();
    }

    public function actionShowProfile()
    {
        $user = Yii::$app->user->getIdentity();
        $tickets = Ticket::find()->where(['user_id' => Yii::$app->user->getId()])->with('ticket_type')->with('event')->all();
        return $this->render('user-profile', compact('user', 'tickets'));
    }


    public function actionBuyTicket($id)
    {
        $event = Event::find()->with('events_photos')->where(['id' => $id])->one();
        $events_tickets = EventsTicket::find()->where(['event_id' => $id])->joinWith('ticket_type')->all();
        foreach ($events_tickets as $index => $events_ticket) {
            $models[] = new BuyTicketForm();
            $models[$index]->ticket_type_id = $events_ticket->ticket_type->id;
            $models[$index]->ticket_type = $events_ticket->ticket_type->type;
            $models[$index]->cost = $events_ticket->cost;
            $models[$index]->all = $events_ticket->amount;
        }
        if (Model::loadMultiple($models, Yii::$app->request->post()) && Model::validateMultiple($models)) {
            return $this->redirect(['/event/buy-confirm', 'id' => $id, 'models' => $models]);
        }
        if(Yii::$app->user->isGuest){
            $loginForm = new LoginForm();
            $signupForm = new SignupForm();
            return$this->render('ticket_office' , compact('event','loginForm', 'signupForm','models'));
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


    public function actionAddMoney()
    {
        $user = User::findOne(Yii::$app->user->getIdentity());
        $user->wallet = $user->wallet + 10000;
        $user->save(false);
        $this->redirect('/user/show-profile');
    }
}
