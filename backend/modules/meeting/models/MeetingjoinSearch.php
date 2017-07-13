<?php

namespace backend\modules\meeting\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\meeting\models\Meeting;

/**
 * MeetingSearch represents the model behind the search form about `backend\modules\meeting\models\Meeting`.
 */
class MeetingjoinSearch extends Meeting
{
    public $time_s;
    public $time_e;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','status' ,'initiator', 'initiate_dept'], 'integer'],
            [['time_s', 'time_e','subject', 'start_time', 'end_time', 'place', 'agenda', 'arrangement', 'attachment', 'initiate_time','join_rens'], 'safe'],
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
        $query = Meeting::find()->orderBy('start_time desc');
        $query->select('{{%meeting}}.*')
            ->addSelect('GROUP_CONCAT({{%meet_join}}.join_ren) as join_ren,GROUP_CONCAT({{%meet_join}}.join_ren) as join_ren1,{{%meet_join}}.status')
            ->leftJoin('{{%meet_join}}','{{%meeting}}.id={{%meet_join}}.meetid')
            ->where("{{%meet_join}}.isdelete=0 and find_in_set(:join_ren,join_ren)",[':join_ren'=>$userId])
            ->groupBy('{{%meeting}}.id');

        if(isset($params['MeetingjoinSearch']['status']) && $params['MeetingjoinSearch']['status']!=''){
            $status=$params['MeetingjoinSearch']['status'];//会议的查询状态
            $currentTime=date('Y-m-d H:i:s',time());//当前时间
            if($status==0){//未开始
                $where=' and start_time>"'. $currentTime.'"';
            }elseif($status==2){//已结束
                $where=' and end_time<"'.$currentTime.'"';
            }else{//进行中的会议
                $where=' and start_time<"'. $currentTime.'" and "'.$currentTime.'"<end_time';
            }
            $query->select('{{%meeting}}.*')
                ->addSelect('GROUP_CONCAT({{%meet_join}}.join_ren) as join_ren,GROUP_CONCAT({{%meet_join}}.join_ren) as join_ren1,{{%meet_join}}.status')
//                ->leftJoin('{{%meet_join}}','{{%meeting}}.id={{%meet_join}}.meetid')
                ->where("{{%meet_join}}.isdelete=0 and find_in_set(:join_ren,join_ren)$where",[':join_ren'=>$userId])
                ->groupBy('{{%meeting}}.id');
        }
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
//            'start_time' => $this->start_time,
//            'end_time' => $this->end_time,
            'initiator' => $this->initiator,
            'initiate_time' => $this->initiate_time,
            'initiate_dept' => $this->initiate_dept,
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
            ->andFilterWhere(['like', 'join_rens', $this->join_rens])
            ->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'agenda', $this->agenda])
            ->andFilterWhere(['like', 'arrangement', $this->arrangement])
            ->andFilterWhere(['like', 'attachment', $this->attachment]);

        return $dataProvider;
    }
}
