<?php

namespace backend\modules\qingjia\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\qingjia\models\Qingjia;

/**
 * QingjiaSearch represents the model behind the search form about `backend\modules\qingjia\models\Qingjia`.
 */
class QingjiaSearch extends Qingjia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','audit_status' ,'qj_ren', 'dept', 'position', 'qj_type', 'dept_leader', 'dept_audit', 'branch_leader', 'branch_audit', 'zzc', 'zzc_audit', 'jcz', 'jcz_audit', 'user_delete', 'dept_delete', 'branch_delete', 'zzc_delete', 'jcz_delete'], 'integer'],
            [['apply_time', 'qj_time', 'end_time', 'qj_reason', 'dept_audit_time', 'dept_reason', 'branch_audit_time', 'branch_reason', 'zzc_audit_time', 'zzc_reason', 'jcz_audit_time', 'jcz_reason'], 'safe'],
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
        $query = Qingjia::find()->where('user_delete=:user_delete and qj_ren=:qj_ren',[':user_delete'=>0,':qj_ren'=>$userId])->orderBy('audit_status asc,apply_time desc');//查询未删除的公出申请

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
            'audit_status'=>$this->audit_status,
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
            ->andFilterWhere(['=','audit_status',$this->audit_status])
            ->andFilterWhere(['like', 'dept_reason', $this->dept_reason])
            ->andFilterWhere(['like', 'branch_reason', $this->branch_reason])
            ->andFilterWhere(['like', 'zzc_reason', $this->zzc_reason])
            ->andFilterWhere(['like', 'jcz_reason', $this->jcz_reason]);

        return $dataProvider;
    }
}
