<?php

namespace backend\modules\office\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\office\models\Office;

/**
 * OfficeSearch represents the model behind the search form about `backend\modules\office\models\Office`.
 */
class OfficeSearch extends Office
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['office_name', 'office_part_id', 'office_start_time', 'office_end_time', 'office_part_name', 'office_type'], 'safe'],
            [['office_price'], 'number'],
            [['office_num', 'office_id', 'office_is_del'], 'integer'],
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
        $query = Office::find()->where('find_in_set('.Yii::$app->user->identity->department.',`office_part_id`) and office_is_del=1');

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
            'office_price' => $this->office_price,
            'office_num' => $this->office_num,
            'office_start_time' => $this->office_start_time,
            'office_end_time' => $this->office_end_time,
            'office_id' => $this->office_id,
            'office_is_del' => $this->office_is_del,
        ]);
        $query->orFilterWhere([
            'office_fbr'=>Yii::$app->user->identity->id
        ]);

        $query->andFilterWhere(['like', 'office_name', $this->office_name])
            ->andFilterWhere(['like', 'office_part_id', $this->office_part_id])
            ->andFilterWhere(['like', 'office_part_name', $this->office_part_name])
            ->andFilterWhere(['like', 'office_type', $this->office_type]);
        return $dataProvider;
    }
}
