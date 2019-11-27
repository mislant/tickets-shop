<?php 

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\SignupForm;
use app\models\LoginForm;

class UserController extends Controller
{
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()))
        {
            if($model->validate() && $model->signup())
            {   
                return $this->goHome();
            }   
        }
        return $this->render('signup',compact('model'));
    }

    public function actionLogin()
    {
        if(!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }
        $model = new LoginForm();
        if(Yii::$app->request->post('LoginForm'))
        {
            $model->attributes = Yii::$app->request->post('LoginForm');
            if($model->validate())
            {
                Yii::$app->user->login($model->getUser());
                return $this->goHome();
            }
        }
        return $this->render('login',compact('model'));
    }

    public function actionLogout()
    {
        if(!Yii::$app->user->isGuest)
        {
            Yii::$app->user->logout();
            return $this->redirect('login');
        }
        
    }

    public function actionTest()
    {
        return $this->render('test');
    }
}
