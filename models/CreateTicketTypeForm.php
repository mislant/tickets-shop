<?php 

namespace app\models;

use yii\base\Model;

class CreateTicketTypeForm extends Model
{
    public $id;
    public $type;

    public function rules()
    {
        return
        [
            ['type' , 'required']
        ];
    }

    public function attributeLabels()
    {
        return
        [
            'type' => 'Тип билета'
        ];
    }
    
    public function createTicketType()
    {
        $model = new TicketType();
        $model->type = $this->type;
        return $model->save();
    }
}