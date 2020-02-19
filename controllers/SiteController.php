<?php


namespace app\controllers;

use app\models\AuthAssignment;
use app\models\AuthItem;
use app\models\Event;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\User;
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
                        'actions' => ['set-role', 'test', 'test-ajax'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin', 'manager'],
                        'actions' => ['show-role']
                    ],
                    [
                        'allow' => true,
                        'roles' => ['?', 'user', 'manager', 'admin'],
                        'actions' => ['index', 'error', 'render-all'],
                    ]
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $loginForm = new LoginForm();
            $signupForm = new SignupForm();
        }
        $latestAmount = 2;
        $latestEvents = Event::giveLatest($latestAmount);
        $soonEvents = Event::giveWillBeSoon();
        return $this->render('index', compact('signupForm', 'loginForm', 'latestEvents', 'latestAmount', 'soonEvents'));
    }

    public function actionRenderAll()
    {
        $events = Event::GiveAll();
        return $this->render('all' , compact('events'));
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
}
