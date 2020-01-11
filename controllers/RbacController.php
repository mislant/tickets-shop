<?php


namespace app\controllers;


use app\models\User;
use yii\web\Controller;
use Yii;

class RbacController extends Controller
{
    public function actionRbacInit()
    {
        $auth = Yii::$app->authManager;

        $role = Yii::$app->authManager->createRole('admin');
        $role->description = 'Админ';
        Yii::$app->authManager->add($role);
        $role = Yii::$app->authManager->createRole('manager');
        $role->description = 'Модератор';
        Yii::$app->authManager->add($role);
        $role = Yii::$app->authManager->createRole('user');
        $role->description = 'Пользователь';
        Yii::$app->authManager->add($role);
        $permit = Yii::$app->authManager->createPermission('createEvent');
        $permit->description = 'Право на создание мероприятия';
        Yii::$app->authManager->add($permit);
        $permit = Yii::$app->authManager->createPermission('watchEvent');
        $permit->description = 'Право на просмотр мероприятий';
        Yii::$app->authManager->add($permit);
        $permit = Yii::$app->authManager->createPermission('deleteEvent');
        $permit->description = 'Право на удаление мероприятий';
        Yii::$app->authManager->add($permit);
        $permit = Yii::$app->authManager->createPermission('updateEvent');
        $permit->description = 'Право на изменение мероприятий';
        Yii::$app->authManager->add($permit);
        $permit = Yii::$app->authManager->createPermission('assignRole');
        $permit->description = 'Право на назначение ролей';
        Yii::$app->authManager->add($permit);

        $user = $auth->getRole('user');
        $manager = $auth->getRole('manager');
        $admin = $auth->getRole('admin');
        $auth->addChild($user, $auth->getPermission('watchEvent'));
        $auth->addChild($manager, $user);
        $auth->addChild($manager, $auth->getPermission('createEvent'));
        $auth->addChild($manager, $auth->getPermission('updateEvent'));
        $auth->addChild($admin, $manager);
        $auth->addChild($admin, $auth->getPermission('deleteEvent'));
        $auth->addChild($admin, $auth->getPermission('assignRole'));

        $rule = new \app\rbac\AuthorRule;
        $auth->add($rule);

        $updateOwnEvent = $auth->createPermission('updateOwnEvent');
        $updateOwnEvent->description = 'Право на редактирование мероприятия';
        $updateOwnEvent->ruleName = $rule->name;
        $auth->add($updateOwnEvent);

        $updateEvent = $auth->getPermission('updateEvent');
        $auth->addChild($updateOwnEvent, $updateEvent);
        $auth->addChild($manager, $updateOwnEvent);

        return $this->goHome();
    }

    public function actionBaseUsersCreate()
    {
        $auth = Yii::$app->authManager;

        $admin = new User();
        $admin->username = 'Admin';
        $admin->password = $admin->generatePassword('admin');
        $admin->email = 'admin@mail.com';
        $admin->save();
        $adminRole = $auth->getRole('admin');
        $auth->assign($adminRole, $admin->getId());

        $manager = new User();
        $manager->username = 'Manager';
        $manager->password = $manager->generatePassword('admin');
        $manager->email = 'manager@mail.com';
        $manager->save();
        $mangerRole = $auth->getRole('manager');
        $auth->assign($mangerRole,$manager->getId());

        $user = new User();
        $user->username = 'User';
        $user->password = $user->generatePassword('123');
        $user->email = 'user@mail.com';
        $user->save();
        $userRole = $auth->getRole('user');
        $auth->assign($userRole,$user->getId());

        return $this->goHome();

    }
}