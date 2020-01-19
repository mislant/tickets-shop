<?php

namespace app\controllers;

use app\models\AuthAssignment;
use app\models\AuthItem;
use app\models\Event;
use app\models\User;
use app\models\AjaxTest;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
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
                        'actions' => ['set-role', 'test','test-ajax'],
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
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
        $events = $q->offset($pages->offset)->limit($pages->limit)->all();
        $user = Yii::$app->getUser()->getIdentity();
        return $this->render('index', compact('events', 'pages', 'user'));
    }

    public function actionShowRole()
    {
        $query = User::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'attributes' => ['id', 'username'],
            ],
        ]);
        return $this->render('show-role', compact('dataProvider'));
    }

    public function actionSetRole($id)
    {
        $roles = AuthItem::GiveRoles();
        $role = ArrayHelper::map($roles, 'name', 'name');
        $data = User::getUsernameAndId($id);
        $model = new AuthAssignment();
        if ($model->load(Yii::$app->request->post()) && $model->SaveUserRole($id)) {
            return $this->redirect('/site/show-role');
        }
        return $this->render('set-role', compact('data', 'model', 'role'));
    }

    public function actionTest()
    {
        $model = new AjaxTest();
        return $this->render('test',compact('model'));
    }

    public function actionTestAjax()
    {
        // Создаём экземпляр модели.
        $model = new AjaxTest();
        // Устанавливаем формат ответа JSON
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        // Если пришёл AJAX запрос
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            // Получаем данные модели из запроса
            if ($model->load($data)) {
                //Если всё успешно, отправляем ответ с данными
                return [
                    "data" => $model,
                    "error" => null
                ];
            } else {
                // Если нет, отправляем ответ с сообщением об ошибке
                return [
                    "data" => null,
                    "error" => "error1"
                ];
            }
        } else {
            // Если это не AJAX запрос, отправляем ответ с сообщением об ошибке
            return [
                "data" => null,
                "error" => "error2"
            ];
        }
    }
}
