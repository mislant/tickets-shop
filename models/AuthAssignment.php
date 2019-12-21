<?php


namespace app\models;

use yii\db\ActiveRecord;


class AuthAssignment extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%auth_assignment}}';
    }

    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'item_name' => 'Role name',
            'user_id' => 'User id'
        ];
    }

    public function SaveUserRole($id)
    {
        $current_user = AuthAssignment::findOne(['user_id' => $id]);
        if (!$current_user) {
            $new_user = new AuthAssignment();
            $new_user->user_id = $id;
            $new_user->item_name = $this->item_name;
            $new_user->created_at = date('U');
            return $new_user->save(false);
        } else {
            $current_user->item_name = $this->item_name;
            $current_user->created_at = date('U');
            return $current_user->save(false);
        }
    }
}