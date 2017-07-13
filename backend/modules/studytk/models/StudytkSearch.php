<?php

namespace backend\modules\studytk\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\studytk\models\Studytk;

/**
 * StudytkSearch represents the model behind the search form about `backend\modules\studytk\models\Studytk`.
 */
class StudytkSearch extends Studytk
{
    public  $adate = "";
    public  $sdate = "";
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'users', 'time', 'tions', 'daan', 'jiexi', 'type','adate','sdate'], 'safe'],
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
        $query = Studytk::find();

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
            'time' => $this->time,
        ]);
        if($this->adate == '' && $this->sdate == ''){
            $query->all();
        }else if($this->adate!='' && $this->sdate!= ''){
            $query->andFilterWhere(['between','time',$this->adate,$this->sdate.' 23:59:59']);
        }else if($this->sdate==''){
            $query->andFilterWhere(['>=','time',$this->adate]);
        }else if($this->adate == '') {
            $query->andFilterWhere(['<=', 'time', $this->sdate . ' 23:59:59']);
        }
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'users', $this->users])
            ->andFilterWhere(['like', 'tions', $this->tions])
            ->andFilterWhere(['like', 'daan', $this->daan])
            ->andFilterWhere(['like', 'jiexi', $this->jiexi])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
