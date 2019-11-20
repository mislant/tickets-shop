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
        // if(\Yii::$app->user->isGuest)
        // {
        //     return $this-> goHome();
        // }
        $model = new SignupForm();
        if (isset($_POST['SignupForm']))
        {
            $model->attributes = Yii::$app->request->post('SignupForm');
            if($model->validate() && $model->signup())
            {
                return $this->goHome();
            }
            // $user = new User;
            // $user->username = $model->username;
            // $user->email = $model->email;
            // $user->password = \Yii::$app->security->generatePasswordHash($model->password);
            // if ($user->save(false))
            // {
            //     return $this->goHome();
            // }
            else
            {
                return print_r('govno');
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
