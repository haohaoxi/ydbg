<?php

namespace backend\modules\kaoqinquery\models;

use common\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\kaoqinquery\models\KaoqinDay;

/**
 * KaoqindaySearch represents the model behind the search form about `backend\modules\kaoqinquery\models\KaoqinDay`.
 */
class KaoqindaySearch extends KaoqinDay
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['deptname', 'username', 'kq_time', 'kq_endtime','weekday', 'shangban_type', 'shuaka_time1', 'shuaka_time2'], 'safe'],
            [['yingkq_minutes', 'yingkq_hours', 'yingkq_days', 'shicq_hours', 'shicq_days', 'kg_minutes', 'qj_minutes', 'qj_hours'], 'number'],
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
        $gonghao=User::findOne($userId)->gonghao;
        $query = KaoqinDay::find()->where('worker_no=:worker_no or uploader=:uploader',[':worker_no'=>$gonghao,':uploader'=>$userId]);

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
            'worker_no' => $this->worker_no,
//            'kq_time' => $this->kq_time,
            'yingkq_minutes' => $this->yingkq_minutes,
            'yingkq_hours' => $this->yingkq_hours,
            'yingkq_days' => $this->yingkq_days,
            'shicq_hours' => $this->shicq_hours,
            'shicq_days' => $this->shicq_days,
            'kg_minutes' => $this->kg_minutes,
            'qj_minutes' => $this->qj_minutes,
            'qj_hours' => $this->qj_hours,
        ]);
        if($this->kq_time == '' && $this->kq_endtime  == ''){
            $query->all();
        }else if($this->kq_time!='' && $this->kq_endtime!=''){
            $query->andFilterWhere(['between','kq_time',$this->kq_time,$this->kq_endtime.' 23:59:59']);
        }else if($this->kq_endtime==''){
            $query->andFilterWhere(['>=', 'kq_time', $this->kq_time]);
        }else if($this->kq_time == ''){
            $query->andFilterWhere(['<=','kq_time' , $this->kq_endtime.' 23:59:59']);
        }else if($this->kq_time == $this->kq_endtime){
            $query->andFilterWhere(['like','kq_time' , $this->kq_time,]);
        }
        $query->andFilterWhere(['like', 'deptname', $this->deptname])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'weekday', $this->weekday])
            ->andFilterWhere(['like', 'shangban_type', $this->shangban_type])
            ->andFilterWhere(['like', 'shuaka_time1', $this->shuaka_time1])
            ->andFilterWhere(['like', 'shuaka_time2', $this->shuaka_time2]);

        return $dataProvider;
    }
}
