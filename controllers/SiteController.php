<?php

namespace app\controllers;

use app\models\AuthAssignment;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;


class SiteController extends Controller
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
                        'actions' => ['set-role', 'rbac-init'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin', 'manager'],
                        'actions' => ['show-role']
                    ],
                    [
                        'allow' => true,
                        'roles' => ['?', 'user', 'manager', 'admin'],
                        'actions' => ['index'],
                    ]
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionShowRole()
    {
        return $this->render('show-role');
    }

    public function actionSetRole($id)
    {
        $data = User::getUsernameAndId($id);
        $model = new AuthAssignment();
        if ($model->load(Yii::$app->request->post()) && $model->SaveUserRole($id)) {
            return $this->redirect('/site/show-role');
        }
        return $this->render('set-role', compact('data', 'model'));
    }
}
