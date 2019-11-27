<?php 

namespace app\models;

use yii\base\Model;
use app\models\Ticket_type;

class CreateTicket_typeForm extends Model
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
    
    public function createTicket_type()
    {
        $model = new Ticket_type();
        $model->type = $this->type;
        return $model->save();
    }
}