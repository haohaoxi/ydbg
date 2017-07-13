<?php

namespace backend\modules\meeting\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\meeting\models\Meeting;

/**
 * MeetingSearch represents the model behind the search form about `backend\modules\meeting\models\Meeting`.
 */
class MeetingSearch extends Meeting
{
    public $time_s;
    public $time_e;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'initiator', 'initiate_dept', 'isdelete'], 'integer'],
            [['time_e', 'time_s','subject', 'start_time', 'end_time', 'place', 'agenda', 'arrangement', 'attachment', 'initiate_time', 'join_rens'], 'safe'],
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
        $userId= Yii::$app->user->id;
        $query = Meeting::find()->where('initiator=:initiator and {{%meeting}}.isdelete=:isdelete',[':initiator'=>$userId,':isdelete'=>0])->orderBy('start_time desc');
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
//            'start_time' => $this->start_time,
//            'end_time' => $this->end_time,
            'initiator' => $this->initiator,
            'initiate_time' => $this->initiate_time,
            'initiate_dept' => $this->initiate_dept,
            'isdelete' => $this->isdelete,
        ]);

        if($this->time_s == '' && $this->time_e == ''){
            $query->all();
        }else if($this->time_s!='' && $this->time_e!=''){
            $query->andFilterWhere(['between','start_time',$this->time_s,$this->time_e.' 23:59:59']);
        }else if($this->time_e==''){
            $query->andFilterWhere(['>=', 'start_time', $this->time_s]);
        }else if($this->time_s == ''){
            $query->andFilterWhere(['<=','start_time' , $this->time_e.' 23:59:59']);
        }else if($this->time_s == $this->time_e){
            $query->andFilterWhere(['like','start_time' , $this->time_s,]);
        }

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'agenda', $this->agenda])
            ->andFilterWhere(['like', 'arrangement', $this->arrangement])
            ->andFilterWhere(['like', 'attachment', $this->attachment])
            ->andFilterWhere(['between','start_time',$this->time_s,$this->time_e])

            ->andFilterWhere(['like', 'join_rens', $this->join_rens]);

        return $dataProvider;
    }
}
