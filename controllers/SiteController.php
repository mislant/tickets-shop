<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRole()
    {
        // $admin = Yii::$app->authManager->createRole('O5');
        // $admin->description = 'Главный администратор';
        // Yii::$app->authManager->add($admin);

        // $manager = Yii::$app->authManager->createRole('manager');
        // $manager->description = 'Менеджер-администратор';
        // Yii::$app->authManager->add($manager);

        // $user = Yii::$app->authManager->createRole('user');
        // $user->description = 'Обычный авторизированный пользователь';
        // Yii::$app->authManager->add($user);

        // $guest = Yii::$app->authManager->createRole('guest');
        // $guest->description = 'Гость';
        // Yii::$app->authManager->add($guest);

        // $permit = Yii::$app->authManager->createPermission('canAdmin');
        // $permit->description = 'Право на вход в админку';
        // Yii::$app->authManager->add($permit);

        // $role_a = Yii::$app->authManager->getRole('O5');
        // $permit = Yii::$app->authManager->getPermission('canAdmin');
        // Yii::$app->authManager->addChild($role_a, $permit);

        $userRole = Yii::$app->authManager->getRole('O5');
        Yii::$app->authManager->assign($userRole, Yii::$app->user->getId()); 

        return 1223;
    }
}
