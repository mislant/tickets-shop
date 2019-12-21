<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;

    public function attributeLabels()
    {
        return
            [
                'username' => 'Логин',
                'email' => 'Почта',
                'password' => 'Пароль',
                'password_repeat' => 'Повторный пароль'
            ];
    }

    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required', 'message' => 'Заполните поле'],
            ['username', 'string', 'min' => 4, 'message' => 'Минимум 4 символа'],
            ['password', 'string', 'min' => 2],
            ['password_repeat', 'string'],
            ['password', 'comparePassword'],
            ['email', 'email'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'Этот логин уже занят'],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => 'Этот E-mail уже зарегистрирован']
        ];
    }

    public function comparePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!($this->password === $this->password_repeat)) {
                $this->addError($attribute, 'Повторный пароль введен не верно');
            }
        }
    }

    public function signup()
    {
        $user = new User();
        $user->email = $this->email;
        $user->username = $this->username;
        $user->password = $user->generatePassword($this->password);
        $user->save();
        $userRole = Yii::$app->authManager->getRole('user');
        return Yii::$app->authManager->assign($userRole, $user->id);
    }
}