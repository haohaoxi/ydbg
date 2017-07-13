<?php

namespace backend\modules\chuchai\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\chuchai\models\Chuchai;

/**
 * AuditSearch represents the model behind the search form about `backend\modules\chuchai\models\Chuchai`.
 */
class AuditSearch extends Chuchai
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dept','audit_status', 'cc_count', 'dept_leader', 'dept_audit', 'branch_leader', 'branch_audit', 'chief', 'chief_audit', 'user_delete', 'dept_delete', 'branch_delete', 'chief_delete'], 'integer'],
            [['cc_ren','chuchairen', 'apply_time', 'cc_date', 'end_date', 'cc_place', 'cc_task', 'cc_transporation', 'dept_audit_time', 'dept_reason', 'branch_audit_time', 'branch_reason', 'chief_audit_time', 'chief_reason'], 'safe'],
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
    public function search($params,$userId)
    {
        $query = Chuchai::find()->where('(dept_leader=:dept_leader and dept_delete=:dept_delete)
                    or (branch_leader=:dept_leader and branch_delete=:dept_delete and dept_audit=:dept_audit)
                    or (chief=:dept_leader and chief_delete=:dept_delete and dept_audit=:dept_audit and branch_audit=:dept_audit)',
            [':dept_leader'=>$userId,':dept_delete'=>0,':dept_audit'=>1])->orderBy('audit_status asc,apply_time desc');

        if(isset($params['AuditSearch']['audit_status']) && $params['AuditSearch']['audit_status']!=''){
            $status=$params['AuditSearch']['audit_status'];//审核的查询状态

            $query = Chuchai::find()->where('(dept_leader=:dept_leader and dept_delete=:dept_delete and dept_audit=:audit_status)
                    or (branch_leader=:dept_leader and branch_delete=:dept_delete and dept_audit=:dept_audit and branch_audit=:audit_status)
                    or (chief=:dept_leader and chief_delete=:dept_delete and dept_audit=:dept_audit and branch_audit=:dept_audit and chief_audit=:audit_status)',
                [':dept_leader'=>$userId,':dept_delete'=>0,':dept_audit'=>1,':audit_status'=>$status])->orderBy('audit_status asc,apply_time desc');
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
            'dept' => $this->dept,
            'cc_count' => $this->cc_count,
            'apply_time' => $this->apply_time,
//            'cc_date' => $this->cc_date,
//            'end_date' => $this->end_date,
            'dept_leader' => $this->dept_leader,
            'dept_audit' => $this->dept_audit,
            'dept_audit_time' => $this->dept_audit_time,
            'branch_leader' => $this->branch_leader,
            'branch_audit' => $this->branch_audit,
            'branch_audit_time' => $this->branch_audit_time,
            'chief' => $this->chief,
            'chief_audit' => $this->chief_audit,
            'chief_audit_time' => $this->chief_audit_time,
            'user_delete' => $this->user_delete,
            'dept_delete' => $this->dept_delete,
            'branch_delete' => $this->branch_delete,
            'chief_delete' => $this->chief_delete,
        ]);

        if($this->cc_date == '' && $this->end_date  == ''){
            $query->all();
        }else if($this->cc_date!='' && $this->end_date!=''){
            $query->andFilterWhere(['between','cc_date',$this->cc_date,$this->end_date.' 23:59:59']);
        }else if($this->end_date==''){
            $query->andFilterWhere(['>=', 'cc_date', $this->cc_date]);
        }else if($this->cc_date == ''){
            $query->andFilterWhere(['<=','cc_date' , $this->end_date.' 23:59:59']);
        }else if($this->cc_date == $this->end_date){
            $query->andFilterWhere(['like','cc_date' , $this->cc_date,]);
        }

        $query->andFilterWhere(['like', 'cc_ren', $this->cc_ren])
            ->andFilterWhere(['like', 'chuchairen', $this->chuchairen])
            ->andFilterWhere(['like', 'cc_place', $this->cc_place])
            ->andFilterWhere(['like', 'cc_task', $this->cc_task])
            ->andFilterWhere(['like', 'cc_transporation', $this->cc_transporation])
            ->andFilterWhere(['like', 'dept_reason', $this->dept_reason])
            ->andFilterWhere(['like', 'branch_reason', $this->branch_reason])
            ->andFilterWhere(['like', 'chief_reason', $this->chief_reason]);

        return $dataProvider;
    }
}
