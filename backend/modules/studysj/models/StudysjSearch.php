<?php

namespace backend\modules\studysj\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\studysj\models\Studysj;

/**
 * StudysjSearch represents the model behind the search form about `backend\modules\studysj\models\Studysj`.
 */
class StudysjSearch extends Studysj
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'questions'], 'integer'],
            [['name', 'mechanism', 'standard', 'start_time', 'end_time', 'user', 'offen','p_id'], 'safe'],
            [['name', 'mechanism', 'standard', 'start_time', 'end_time', 'user', 'offen'], 'safe'],
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
        $query = Studysj::find()->orderBy('create_time desc');

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
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status' => $this->status,
            'questions' => $this->questions,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mechanism', $this->mechanism])
            ->andFilterWhere(['like', 'standard', $this->standard])
            ->andFilterWhere(['like', 'user', $this->user])
            ->andFilterWhere(['like', 'offen', $this->offen])
            ->andFilterWhere(['like', 'p_id', $this->p_id])
            ->andFilterWhere(['like', 'offen', $this->offen]);

        return $dataProvider;
    }
}
