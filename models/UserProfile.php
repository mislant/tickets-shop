<?php


namespace app\models;

use yii\base\Model;

class UserProfile extends Model
{
    public $username;
    public $firstname;
    public $surname;
    public $photo;
    public $wallet;
    public $amount_of_tickets;

    public function attributeLabels()
    {
        return
            [
                'username' => 'Логин пользователя',
                'firstname' => 'Имя',
                'surname' => 'Фаимилия',
                'photo' => 'Фото',
                'wallet' => 'Кошелек',
                'amount_of_tickets' => 'Количесвто билетов',
            ];
    }

    public function rules()
    {
        return [
            [['firstname','surname'] , 'string'],
            ['photo' , 'file' , 'extensions' => ['png','jpg','gif'] , 'maxSize' => 1024*1024],
            ['wallet' , 'integer' , 'max' => 10000000]
        ];
    }
}