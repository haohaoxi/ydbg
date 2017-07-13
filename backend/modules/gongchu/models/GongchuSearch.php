<?php

namespace backend\modules\gongchu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\gongchu\models\Gongchu;

/**
 * GongchuSearch represents the model behind the search form about `backend\modules\gongchu\models\Gongchu`.
 */
class GongchuSearch extends Gongchu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'audit_status', 'dept', 'gc_count', 'jb_ren', 'dept_leader', 'dept_audit', 'yuan_leader', 'yuan_audit'], 'integer'],
            [['gc_ren','gongchurens', 'gc_time', 'end_time', 'gc_place', 'ygwc'], 'safe'],
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
        $query = Gongchu::find()->where('user_delete=:user_delete and jb_ren=:jb_ren',[':user_delete'=>0,':jb_ren'=>$userId])->orderBy('audit_status asc,apply_time desc');//查询未删除的公出申请
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
            'gc_count' => $this->gc_count,
//            'gc_time' => $this->gc_time,
//            'end_time' => $this->end_time,
            'jb_ren' => $this->jb_ren,
            'dept_leader' => $this->dept_leader,
            'dept_audit' => $this->dept_audit,
            'yuan_leader' => $this->yuan_leader,
            'yuan_audit' => $this->yuan_audit,
            'audit_status'=>$this->audit_status,
        ]);
        if($this->gc_time == '' && $this->end_time  == ''){
            $query->all();
        }else if($this->gc_time!='' && $this->end_time!=''){
            $query->andFilterWhere(['between','gc_time',$this->gc_time,$this->end_time.' 23:59:59']);
        }else if($this->end_time==''){
            $query->andFilterWhere(['>=', 'gc_time', $this->gc_time]);
        }else if($this->gc_time == ''){
            $query->andFilterWhere(['<=','gc_time' , $this->end_time.' 23:59:59']);
        }else if($this->gc_time == $this->end_time){
            $query->andFilterWhere(['like','gc_time' , $this->gc_time,]);
        }

        $query->andFilterWhere(['like', 'gongchurens', $this->gongchurens])
            ->andFilterWhere(['like', 'gc_place', $this->gc_place])
            ->andFilterWhere(['like', 'ygwc', $this->ygwc]);
        return $dataProvider;
    }
}
