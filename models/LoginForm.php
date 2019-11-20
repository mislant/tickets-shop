<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $email;
    public $password;

    public function attributeLabels()
    {
        return
        [
            'email' => 'Почта',
            'password' => 'Пароль',
        ];
    }

    public function rules()
    {
        return
        [
            [['email','password'] , 'required'],
            ['password' , 'validatePassword']
        ];
    }

    public function validatePassword($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password))
            {
                $this->addError($attribute,'Пароль или email введены не верно');
            } 
        }
    }

    public function getUser()
    {
        return User::findOne(['email' => $this->email]);
    }
}