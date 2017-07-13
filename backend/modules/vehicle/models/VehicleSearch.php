<?php

namespace backend\modules\vehicle\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\vehicle\models\Vehicle;

/**
 * VehicleSearch represents the model behind the search form about `backend\modules\vehicle\models\Vehicle`.
 */
class VehicleSearch extends Vehicle
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'v_type', 'count', 'isdelete', 'isreturn'], 'integer'],
            [['v_usage', 'dept', 'code_no', 'v_license', 'regist_no', 'regist_date', 'xinghao', 'pailiang', 'audit'], 'safe'],
            [['money'], 'number'],
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
        $query = Vehicle::find()->where('isdelete=:isdelete',[':isdelete'=>0]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pagesize'=>'20'],
        ]);
        $dataProvider->setSort([
                'attributes' => [
                    []
                ],
            ]
        );

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'regist_date' => $this->regist_date,
            'v_type' => $this->v_type,
            'count' => $this->count,
            'money' => $this->money,
            'isdelete' => $this->isdelete,
            'isreturn' => $this->isreturn,
        ]);

        $query->andFilterWhere(['like', 'v_usage', $this->v_usage])
            ->andFilterWhere(['like', 'dept', $this->dept])
            ->andFilterWhere(['like', 'code_no', $this->code_no])
            ->andFilterWhere(['like', 'v_license', $this->v_license])
            ->andFilterWhere(['like', 'regist_no', $this->regist_no])
            ->andFilterWhere(['like', 'xinghao', $this->xinghao])
            ->andFilterWhere(['like', 'pailiang', $this->pailiang])
            ->andFilterWhere(['like', 'audit', $this->audit]);

        return $dataProvider;
    }
}
