<?php

namespace backend\modules\studyjl\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\studyjl\models\Studyjl;

/**
 * StudyjlSearch represents the model behind the search form about `backend\modules\studyjl\models\Studyjl`.
 */
class StudyjlSearch extends Studyjl
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'result'], 'integer'],
            [['name', 'start_date', 'username', 'mechan', 'pate_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Studyjl::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pagesize'=>'20']
        ]);

        $this->load($params);
        $dataProvider->setSort([
                'attributes' => [
                    []
                ],
            ]
        );

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
//            'start_date' => $this->start_date,
            'result' => $this->result,
//            'pate_date' => $this->pate_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'start_date', $this->start_date])
            ->andFilterWhere(['like', 'pate_date', $this->pate_date])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'mechan', $this->mechan]);

        return $dataProvider;
    }
}
