<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public function getTicket()
    {
        return $this->hasMany(Ticket::className(),['user_id' => 'id']);
    }

//==============================================================


    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['name'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }


//==============================================================


    public function generatePassword($password)
    {
        return sha1($password);
    }

    public function validatePassword($password)
    {
        return $this->password === sha1($password);
    }

    public function getAssignment()
    {
        return AuthAssignment::findOne(['user_id' => $this->id]);
    }

    public static function getUsernameAndId($id)
    {
        $user = User::findOne($id);
        $data['id'] = $user->id;
        $data['username'] = $user->username;
        return $data;
    }

}
