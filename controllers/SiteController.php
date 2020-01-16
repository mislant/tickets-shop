<?php

namespace app\controllers;

use app\models\AuthAssignment;
use app\models\Event;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;


class   SiteController extends Controller
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
                        'actions' => ['set-role', 'test-map'],
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
        $q = Event::find()->orderBy(['date' => SORT_DESC]);
        $countQuery = clone $q;
        $pages = new Pagination(['totalCount' =>$countQuery->count(), 'pageSize' => 5]);
        $events = $q->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index',compact('events','pages'));
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

    public function actionTestMap()
    {
        return $this->render('test');
    }
}
