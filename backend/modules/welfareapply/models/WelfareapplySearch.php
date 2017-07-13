<?php

namespace backend\modules\welfareapply\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\welfareapply\models\WelfareApply;

/**
 * WelfareapplySearch represents the model behind the search form about `backend\modules\welfareapply\models\Welfareapply`.
 */
class WelfareapplySearch extends Welfareapply
{
    public $welfare_sq_time_s;
    public $welfare_sq_time_e;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['welfare_apply_id', 'welfare_id', 'welfare_apply_mee_id', 'welfare_sp_id'], 'integer'],
            [['welfare_name', 'welfare_apply_pack_status', 'welfare_apply_pack_cancel_detail', 'welfare_lq','welfare_lq_time','welfare_sq_time','welfare_sq_time_s','welfare_sq_time_e','welfare_department','welfare_apply_mee_name','welfare_sp_name','welfare_apply_pack_time'], 'safe'],
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
        $query = Welfareapply::find();

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
            'welfare_apply_id' => $this->welfare_apply_id,
            'welfare_name' => $this->welfare_name,
            'welfare_id' => $this->welfare_id,
            'welfare_apply_mee_id' => $this->welfare_apply_mee_id,
            'welfare_sp_id' => $this->welfare_sp_id,
            'welfare_apply_mee_id_is_del'=>1
        ]);

        $query->andFilterWhere(['like', 'welfare_name', $this->welfare_name])
            ->andFilterWhere(['like', 'welfare_apply_pack_status', $this->welfare_apply_pack_status])
            ->andFilterWhere(['like', 'welfare_apply_pack_cancel_detail', $this->welfare_apply_pack_cancel_detail])
            ->andFilterWhere(['like', 'welfare_lq', $this->welfare_lq])
            ->andFilterWhere(['between','welfare_sq_time',$this->welfare_sq_time_s,$this->welfare_sq_time_e])
        ;

        return $dataProvider;
    }


    public function searchRecord($params)
    {
        $query = Welfareapply::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'welfare_apply_id' => $this->welfare_apply_id,
            'welfare_name' => $this->welfare_name,
            'welfare_id' => $this->welfare_id,
            'welfare_apply_mee_id' => $this->welfare_apply_mee_id,
            'welfare_sp_id_is_del'=>1,
            'welfare_sp_id'=>Yii::$app->user->identity->id,
            'welfare_department'=>$this->welfare_department,
        ]);

        $query->andFilterWhere(['like', 'welfare_name', $this->welfare_name])
            ->andFilterWhere(['like', 'welfare_apply_pack_status', $this->welfare_apply_pack_status])
            ->andFilterWhere(['like', 'welfare_apply_pack_cancel_detail', $this->welfare_apply_pack_cancel_detail])
            ->andFilterWhere(['like', 'welfare_lq', $this->welfare_lq])
            ->andFilterWhere(['between','welfare_sq_time',$this->welfare_sq_time_s,$this->welfare_sq_time_e])
        ;

        return $dataProvider;
    }

    public function searchMyget($params)
    {
        $query = Welfareapply::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'welfare_apply_id' => $this->welfare_apply_id,
            'welfare_name' => $this->welfare_name,
            'welfare_id' => $this->welfare_id,
            'welfare_apply_mee_id' => $this->welfare_apply_mee_id,
            'welfare_apply_pack_status'=>'同意',
            'welfare_department'=>$this->welfare_department,
        ]);

        $query->andFilterWhere(['like', 'welfare_name', $this->welfare_name])
            ->andFilterWhere(['like', 'welfare_apply_pack_status', $this->welfare_apply_pack_status])
            ->andFilterWhere(['like', 'welfare_apply_pack_cancel_detail', $this->welfare_apply_pack_cancel_detail])
            ->andFilterWhere(['like', 'welfare_lq', $this->welfare_lq])
            ->andFilterWhere(['between','welfare_sq_time',$this->welfare_sq_time_s,$this->welfare_sq_time_e])
        ;

        return $dataProvider;
    }
}
