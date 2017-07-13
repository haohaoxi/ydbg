<?php

namespace backend\modules\message\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\message\models\Message;

/**
 * MessageSearch represents the model behind the search form about `backend\modules\message\models\Message`.
 */
class MessageSearch extends Message
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fsr','jsr'], 'integer'],
            [['type', 'contet', 'time', 'is_reader', 'url'], 'safe'],
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
        $query = Message::find()->where('jsr = '.Yii::$app->user->identity->id)->orderBy('is_reader asc,id desc');

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
            'fsr' => $this->fsr,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'contet', $this->contet])
            ->andFilterWhere(['like', 'jsr', $this->jsr])
            ->andFilterWhere(['like', 'is_reader', $this->is_reader])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
