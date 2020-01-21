<?php


namespace app\models;

use yii\base\Model;


class AjaxTest extends Model
{
    public $text;

    public function rules()
    {
        return [
            [
                [
                    'text'
                ],
                'string'
            ]
        ];
    }
}