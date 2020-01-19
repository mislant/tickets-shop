<?php


namespace app\models;

use yii\base\Model;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

class UserProfile extends Model
{
    public $firstname;
    public $surname;
    public $photo;

    public function attributeLabels()
    {
        return
            [
                'firstname' => 'Имя',
                'surname' => 'Фаимилия',
                'photo' => 'Фото',
            ];
    }

    public function rules()
    {
        return [
            [['firstname', 'surname'], 'string'],
            ['photo', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024],
        ];
    }

    public function photoUpload()
    {
        $this->photo = UploadedFile::getInstance($this, 'photo');
        if(!$this->photo)
        {
            return true;
        }
        $dir = substr(md5(microtime()), mt_rand(0, 30), 2) . '/' . substr(md5(microtime()), mt_rand(0, 30), 2);
        $name = (md5($this->photo->name));
        mkdir('img/UsrImg/' . $dir, 0777, true);
        $path = 'img/UsrImg/' . $dir . '/';
        $this->photo->saveAs("$path {$name}.{$this->photo->extension}");
        $db_path = $path . $name . $this->photo->extension;
        $user = Yii::$app->getUser()->getIdentity();
        $user->avatar = $db_path;
        return $user->save();
    }

    public function refresh()
    {
        $user = Yii::$app->getUser()->getIdentity();
        $user->firstname = $this->firstname;
        $user->surname = $this->surname;
        return $user->save();
    }
}