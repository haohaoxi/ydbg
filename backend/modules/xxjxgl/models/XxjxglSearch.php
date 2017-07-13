<?php

namespace backend\modules\xxjxgl\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\xxjxgl\models\Xxjxgl;

/**
 * XxjxglSearch represents the model behind the search form about `backend\modules\xxjxgl\models\Xxjxgl`.
 */
class XxjxglSearch extends Xxjxgl
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
            [['title', 'title_content', 'name', 'xx_date', 'content', 'fujian','adate','sdate'], 'safe'],
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
        $query = Xxjxgl::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>['pagesize'=>'20'],
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
//            'xx_date' => $this->xx_date,
        ]);


        if($this->adate == '' && $this->sdate == ''){
            $query->all();
        }else if($this->adate!='' && $this->sdate!= ''){
            $query->andFilterWhere(['between','xx_date',$this->adate,$this->sdate.' 23:59:59']);
        }else if($this->sdate==''){
            $query->andFilterWhere(['>=','xx_date',$this->adate]);
        }else if($this->adate == ''){
            $query->andFilterWhere(['<=','xx_date',$this->sdate.' 23:59:59']);
        }else if($this->adate ==$this->sdate){
            $query->andFilterWhere(['like','xx_date',$this->adate]);
        }

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title_content', $this->title_content])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'fujian', $this->fujian]);

        return $dataProvider;
    }


}
