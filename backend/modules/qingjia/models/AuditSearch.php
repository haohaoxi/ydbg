<?php

namespace backend\modules\qingjia\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\qingjia\models\Qingjia;

/**
 * AuditSearch represents the model behind the search form about `backend\modules\qingjia\models\Qingjia`.
 */
class AuditSearch extends Qingjia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','audit_status','dept', 'position', 'qj_type', 'dept_leader', 'dept_audit', 'branch_leader', 'branch_audit', 'zzc', 'zzc_audit', 'jcz', 'jcz_audit', 'user_delete', 'dept_delete', 'branch_delete', 'zzc_delete', 'jcz_delete'], 'integer'],
            [['apply_time','qingjiaren', 'qj_time', 'end_time', 'qj_reason', 'dept_audit_time', 'dept_reason', 'branch_audit_time', 'branch_reason', 'zzc_audit_time', 'zzc_reason', 'jcz_audit_time', 'jcz_reason'], 'safe'],
            [['qj_day'], 'number'],
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
        $query = Qingjia::find()->where('(dept_leader=:dept_leader and dept_delete=:dept_delete)
                    or (branch_leader=:dept_leader and branch_delete=:dept_delete and dept_audit=:dept_audit)
                    or (zzc=:dept_leader and zzc_delete=:dept_delete and dept_audit=:dept_audit and branch_audit=:dept_audit)
                    or (jcz=:dept_leader and jcz_delete=:dept_delete and dept_audit=:dept_audit and branch_audit=:dept_audit and zzc_audit=:dept_audit)',
            [':dept_leader'=>$userId,':dept_delete'=>0,':dept_audit'=>1])->orderBy('audit_status asc,apply_time desc');
        if(isset($params['AuditSearch']['audit_status']) && $params['AuditSearch']['audit_status']!=''){
            $status=$params['AuditSearch']['audit_status'];//审核的查询状态
            $query = Qingjia::find()->where('(dept_leader=:dept_leader and dept_delete=:dept_delete and dept_audit=:audit_status)
                    or (branch_leader=:dept_leader and branch_delete=:dept_delete and dept_audit=:dept_audit and branch_audit=:audit_status)
                    or (zzc=:dept_leader and zzc_delete=:dept_delete and dept_audit=:dept_audit and branch_audit=:dept_audit and zzc_audit=:audit_status)
                    or (jcz=:dept_leader and jcz_delete=:dept_delete and dept_audit=:dept_audit and branch_audit=:dept_audit and zzc_audit=:dept_audit and jcz_audit=:audit_status)',
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
            'qj_ren' => $this->qj_ren,
            'apply_time' => $this->apply_time,
            'dept' => $this->dept,
            'position' => $this->position,
            'qj_type' => $this->qj_type,
//            'qj_time' => $this->qj_time,
//            'end_time' => $this->end_time,
            'qj_day' => $this->qj_day,
            'dept_leader' => $this->dept_leader,
            'dept_audit' => $this->dept_audit,
            'dept_audit_time' => $this->dept_audit_time,
            'branch_leader' => $this->branch_leader,
            'branch_audit' => $this->branch_audit,
            'branch_audit_time' => $this->branch_audit_time,
            'zzc' => $this->zzc,
            'zzc_audit' => $this->zzc_audit,
            'zzc_audit_time' => $this->zzc_audit_time,
            'jcz' => $this->jcz,
            'jcz_audit' => $this->jcz_audit,
            'jcz_audit_time' => $this->jcz_audit_time,
            'user_delete' => $this->user_delete,
            'dept_delete' => $this->dept_delete,
            'branch_delete' => $this->branch_delete,
            'zzc_delete' => $this->zzc_delete,
            'jcz_delete' => $this->jcz_delete,
        ]);

        if($this->qj_time == '' && $this->end_time == ''){
            $query->all();
        }else if($this->qj_time!='' && $this->end_time!=''){
            $query->andFilterWhere(['between','qj_time',$this->qj_time,$this->end_time.' 23:59:59']);
        }else if($this->end_time==''){
            $query->andFilterWhere(['>=', 'qj_time', $this->qj_time]);
        }else if($this->qj_time == ''){
            $query->andFilterWhere(['<=','qj_time' , $this->end_time.' 23:59:59']);
        }else if($this->qj_time == $this->end_time){
            $query->andFilterWhere(['like','qj_time' , $this->qj_time,]);
        }

        $query->andFilterWhere(['like', 'qj_reason', $this->qj_reason])
            ->andFilterWhere(['like', 'qingjiaren', $this->qingjiaren])
            ->andFilterWhere(['like', 'dept_reason', $this->dept_reason])
            ->andFilterWhere(['like', 'branch_reason', $this->branch_reason])
            ->andFilterWhere(['like', 'zzc_reason', $this->zzc_reason])
            ->andFilterWhere(['like', 'jcz_reason', $this->jcz_reason]);

        return $dataProvider;
    }
}
