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
        return[
            [['username','password','email'],'required', 'message' => 'Заполните поле'],
            ['password' , 'string', 'min' => 2],
            ['password_repeat', 'compare','compareAttribute' => 'password'],
            ['email','email'],
            ['username','unique', 'targetClass' =>User::className(), 'message' => 'Этот логин уже занят'],
            ['email','unique', 'targetClass' =>User::className(),'message' => 'Этот E-mail уже зарегистрирован']
        ];
    }

    public function signup()
    {
        $user = new User();
        $user->email = $this->email;
        $user->username = $this->username;
        $user->password = $user->generatePassword($this->password);
        return $user->save();
    }
}