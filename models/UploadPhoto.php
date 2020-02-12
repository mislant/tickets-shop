<?php


namespace app\models;


use yii\base\Model;
use yii\helpers\Url;
use yii\web\UploadedFile;

class UploadPhoto extends Model
{
    public $id;
    public $photo;

    public function rules()
    {
        return [
            ['id' , 'safe'],
            ['photo', 'file', 'extensions' => ['png', 'jpg'], 'maxSize' => 1920 * 1080],
        ];
    }

    public function uploadPhoto($event_id)
    {
        $this->photo = UploadedFile::getInstance($this, 'photo');
        $dir = substr(md5(microtime()), mt_rand(0, 30), 2) . '/' . substr(md5(microtime()), mt_rand(0, 30), 2);
        $name = (md5($this->photo->name));
        mkdir('img/eventImages/' . $dir, 0777, true);
        $path = 'img/eventImages/' . $dir . '/';
        $this->photo->saveAs("$path{$name}.{$this->photo->extension}");
        $db_path = Url::to('@web/' . $path . $name . '.' . $this->photo->extension, true);
        $eventsPhoto = new EventsPhotos();
        $eventsPhoto->photo = $db_path;
        $eventsPhoto->event_id = $event_id;
        $eventsPhoto->save();
    }

    public function photoDelete()
    {
        $eventsPhoto = EventsPhotos::find()->where(['id' => $this->id])->one();
        $dirs = explode("/", $eventsPhoto->photo);
        $dir = 'img/eventImages/' . $dirs[5];
        $this->removeDirectory($dir);
        return $eventsPhoto->delete();
    }

    public function removeDirectory($dir)
    {
        if ($objs = glob($dir . "/*")) {
            foreach ($objs as $obj) {
                is_dir($obj) ? $this->removeDirectory($obj) : unlink($obj);
            }
        }
        rmdir($dir);
    }

}