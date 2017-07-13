<?php

namespace backend\modules\deptcontact\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\deptcontact\models\DeptContact;

/**
 * DeptcontactSearch represents the model behind the search form about `backend\modules\deptcontact\models\Deptcontact`.
 */
class DeptcontactSearch extends DeptContact
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'principal', 'branch_leader'], 'integer'],
            [['dept_name', 'dept_type'], 'safe'],
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
        $query = Deptcontact::find()->orderBy('id asc');

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
            'id' => $this->id,
            'principal' => $this->principal,
            'branch_leader' => $this->branch_leader,
        ]);

        $query->andFilterWhere(['like', 'dept_name', $this->dept_name])
            ->andFilterWhere(['like', 'dept_type', $this->dept_type]);

        return $dataProvider;
    }
}
