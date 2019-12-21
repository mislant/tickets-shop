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

    public function search($params)
    {
        $query = Event::find();

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