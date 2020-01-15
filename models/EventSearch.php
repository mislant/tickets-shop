<?php


namespace app\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;

class EventSearch extends Model
{
    public $id;
    public $title;
    public $date;
    public $adress;
    public $amount_of_tickets;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params, $user_id = null)
    {
        if ($user_id == null) {
            $query = Event::find();
        } else {
            $query = Event::find()->where(['created_by' => $user_id]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'amount_of_tickets' => $this->amount_of_tickets,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'adress', $this->adress]);

        return $dataProvider;
    }
}