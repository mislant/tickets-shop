<?php


namespace app\models;


use yii\db\ActiveRecord;

class EventsPhotos extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%events_photos}}';
    }

    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    public function rules()
    {
        return [
            [['id', 'event_id'], 'safe'],
        ];
    }
}