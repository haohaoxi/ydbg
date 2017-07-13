<?php

namespace backend\modules\tzgggl\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\tzgggl\models\Announcement;

/**
 * TzggglSearch represents the model behind the search form about `backend\modules\tzgggl\models\Announcement`.
 */
class TzggglSearch extends Announcement
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
            [['title', 'pubdate', 'author', 'attachment', 'content','adate','sdate'], 'safe'],
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
        $query = Announcement::find()->orderBy('pubdate DESC');

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
//            'pubdate' => $this->pubdate,
        ]);

        if($this->adate == '' && $this->sdate == ''){
            $query->all();
        }else if($this->adate!='' && $this->sdate!= ''){
            $query->andFilterWhere(['between','pubdate',$this->adate,$this->sdate.' 23:59:59']);
        }else if($this->sdate==''){
            $query->andFilterWhere(['>=','pubdate',$this->adate]);
        }else if($this->adate == ''){
            $query->andFilterWhere(['<=','pubdate',$this->sdate.' 23:59:59']);
        }else if($this->adate ==$this->sdate){
            $query->andFilterWhere(['like','pubdate',$this->adate]);
        }

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'attachment', $this->attachment])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
