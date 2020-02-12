<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $emailnick;
    public $password;

    public function attributeLabels()
    {
        return
            [
                'emailnick' => 'Почта или логин',
                'password' => 'Пароль',
            ];
    }

    public function rules()
    {
        return
            [
                [['emailnick', 'password'], 'required'],
                ['password', 'validatePassword']
            ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Пароль или email введены не верно');
            }
        }
    }

    public function getUser()
    {
        return !User::findOne(['email' => $this->emailnick])?User::findOne(['username' => $this->emailnick]):User::findOne(['email' => $this->emailnikc]);
    }
}