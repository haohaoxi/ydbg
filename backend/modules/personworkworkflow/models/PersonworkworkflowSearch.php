<?php

namespace backend\modules\personworkworkflow\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\personworkworkflow\models\Personworkworkflow;

/**
 * PersonworkworkflowSearch represents the model behind the search form about `backend\modules\personworkworkflow\models\Personworkworkflow`.
 */
class PersonworkworkflowSearch extends Personworkworkflow
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['w_id', 'w_p_id', 'w_person_id'], 'integer'],
            [['w_s_time', 'w_e_time', 'w_s_status', 'w_e_status', 'w_type','w_cancel_details','w_y_slr','w_del'], 'safe'],
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
        $query = Personworkworkflow::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 20,]
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
            'w_id' => $this->id,
            'w_p_id' => $this->w_p_id,
            'w_person_id' => $this->w_person_id,
            'w_s_time' => $this->w_s_time,
            'w_e_time' => $this->w_e_time,
        ]);

        $query->andFilterWhere(['like', 'w_s_status', $this->w_s_status])
            ->andFilterWhere(['like', 'w_e_status', $this->w_e_status])
            ->andFilterWhere(['like', 'w_type', $this->w_type]);

        return $dataProvider;
    }
}
