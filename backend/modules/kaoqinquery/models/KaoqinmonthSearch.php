<?php

namespace backend\modules\kaoqinquery\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;
use backend\modules\kaoqinquery\models\KaoqinMonth;

/**
 * KaoqinmonthSearch represents the model behind the search form about `backend\modules\kaoqinquery\models\KaoqinMonth`.
 */
class KaoqinmonthSearch extends KaoqinMonth
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['deptname', 'username', 'kq_time', 'kq_endtime'], 'safe'],
            [['ycq_hours', 'ycq_days', 'scq_hours', 'scq_days', 'kg_hours', 'kg_days', 'total_workhours', 'total_workdays', 'delay_minutes', 'zt_minutes', 'shij_days', 'sick_days', 'tiaoxiu_days', 'gc_days', 'yxnj_days'], 'number'],
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
        $query = KaoqinMonth::find()->where('worker_no=:worker_no or uploader=:uploader',[':worker_no'=>$gonghao,':uploader'=>$userId]);

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
            'card_no' => $this->card_no,
//            'kq_time' => $this->kq_time,
            'ycq_hours' => $this->ycq_hours,
            'ycq_days' => $this->ycq_days,
            'scq_hours' => $this->scq_hours,
            'scq_days' => $this->scq_days,
            'kg_hours' => $this->kg_hours,
            'kg_days' => $this->kg_days,
            'total_workhours' => $this->total_workhours,
            'total_workdays' => $this->total_workdays,
            'delay_times' => $this->delay_times,
            'zt_times' => $this->zt_times,
            'delay_minutes' => $this->delay_minutes,
            'zt_minutes' => $this->zt_minutes,
            'shij_days' => $this->shij_days,
            'sick_days' => $this->sick_days,
            'tiaoxiu_days' => $this->tiaoxiu_days,
            'gc_days' => $this->gc_days,
            'yxnj_days' => $this->yxnj_days,
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
            ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
