<?php

namespace backend\modules\vehicle\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\vehicle\models\VehicleApply;

/**
 * AuditSearch represents the model behind the search form about `backend\modules\vehicle\models\VehicleApply`.
 */
class AuditSearch extends VehicleApply
{
    public $s_time;
    public $e_time;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','audit_status', 'vehicleid', 'dept', 'dept_leader', 'dept_audit', 'branch_leader', 'branch_audit', 'apply_delete', 'dept_delete', 'branch_delete', 'apply_ren'], 'integer'],
            [['s_time','e_time','v_user', 'driver', 'use_time', 'quxiang', 'reason', 'dept_audit_time', 'dept_reason', 'branch_audit_time', 'branch_reason', 'apply_time'], 'safe'],
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
        $userId=Yii::$app->user->id;
        $query = VehicleApply::find()->where('(dept_leader=:dept_leader and dept_delete=:dept_delete)
                    or (branch_leader=:dept_leader and branch_delete=:dept_delete and dept_audit=:dept_audit)',
            [':dept_leader'=>$userId,':dept_delete'=>0,':dept_audit'=>1])->orderBy('audit_status asc,apply_time desc');
        if(isset($params['AuditSearch']['audit_status']) && $params['AuditSearch']['audit_status']!=''){
            $status=$params['AuditSearch']['audit_status'];//审核的查询状态
            $query = VehicleApply::find()->where('(dept_leader=:dept_leader and dept_delete=:dept_delete and dept_audit=:audit_status)
                    or (branch_leader=:dept_leader and branch_delete=:dept_delete and dept_audit=:dept_audit and branch_audit=:audit_status)',
                [':dept_leader'=>$userId,':dept_delete'=>0,':dept_audit'=>1,':audit_status'=>$status])->orderBy('audit_status asc,apply_time desc');
        }
        $query->select('{{%vehicle_apply}}.*')
            ->addSelect('{{%vehicle}}.v_license,{{%vehicle}}.return_time')
            ->leftJoin('{{%vehicle}}','{{%vehicle_apply}}.vehicleid={{%vehicle}}.id');
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
            'vehicleid' => $this->vehicleid,
            '{{%vehicle_apply}}.dept' => $this->dept,
//            'use_time' => $this->use_time,
            'dept_leader' => $this->dept_leader,
            'dept_audit' => $this->dept_audit,
            'dept_audit_time' => $this->dept_audit_time,
            'branch_leader' => $this->branch_leader,
            'branch_audit' => $this->branch_audit,
            'branch_audit_time' => $this->branch_audit_time,
            'apply_delete' => $this->apply_delete,
            'dept_delete' => $this->dept_delete,
            'branch_delete' => $this->branch_delete,
            'apply_ren' => $this->apply_ren,
            'apply_time' => $this->apply_time,
        ]);

        if($this->s_time == '' && $this->e_time == ''){
            $query->all();
        }else if($this->s_time!='' && $this->e_time!=''){
            $query->andFilterWhere(['between','use_time',$this->s_time,$this->e_time.' 23:59:59']);
        }else if($this->e_time==''){
            $query->andFilterWhere(['>=', 'use_time', $this->s_time]);
        }else if($this->s_time == ''){
            $query->andFilterWhere(['<=','use_time' , $this->e_time.' 23:59:59']);
        }else if($this->s_time == $this->e_time){
            print_r($this->s_time);
            $query->andFilterWhere(['like','use_time' , $this->s_time,]);
        }

        $query->andFilterWhere(['like', 'v_user', $this->v_user])
            ->andFilterWhere(['like', 'driver', $this->driver])
            ->andFilterWhere(['like', 'quxiang', $this->quxiang])
            ->andFilterWhere(['like', 'reason', $this->reason])
            ->andFilterWhere(['like', 'dept_reason', $this->dept_reason])
            ->andFilterWhere(['like', 'branch_reason', $this->branch_reason]);

        return $dataProvider;
    }
}
