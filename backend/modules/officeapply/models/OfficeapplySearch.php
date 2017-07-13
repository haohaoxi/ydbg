<?php

namespace backend\modules\officeapply\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\officeapply\models\OfficeApply;

/**
 * OfficeapplySearch represents the model behind the search form about `backend\modules\officeapply\models\Officeapply`.
 */
class OfficeapplySearch extends Officeapply
{
    public $apply_sq_time_s;
    public $apply_sq_time_e;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apply_id', 'apply_num', 'apply_office_id', 'apply_mee_id', 'apply_mee_id_is_del', 'apply_pack_id', 'apply_pack_id_is_del', 'apply_genneral_id', 'apply_genneral_id_is_del', 'apply_department'], 'integer'],
            [['apply_mee_text', 'apply_sq_time', 'apply_pack_status', 'apply_pack_result', 'apply_pack_time', 'apply_genneral_status', 'apply_genneral_result', 'apply_genneral_time', 'apply_remarks', 'apply_lq_status', 'apply_lq_time','apply_money','apply_pack_text','apply_genneral_text','apply_price','apply_office_name','apply_sq_time_s','apply_sq_time_e'], 'safe'],
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
        $query = Officeapply::find();

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

       // if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
        //    return $dataProvider;
      //  }

        $query->andFilterWhere([
            'apply_id' => $this->apply_id,
            'apply_num' => $this->apply_num,
            'apply_mee_id' => Yii::$app->user->identity->id,
            'apply_mee_id_is_del' => 1,
            'apply_pack_id' => $this->apply_pack_id,
            'apply_pack_id_is_del' => $this->apply_pack_id_is_del,
            'apply_pack_time' => $this->apply_pack_time,
            'apply_genneral_id' => $this->apply_genneral_id,
            'apply_genneral_id_is_del' => $this->apply_genneral_id_is_del,
            'apply_genneral_time' => $this->apply_genneral_time,
            'apply_lq_time' => $this->apply_lq_time,
        ]);

        $query->andFilterWhere(['like', 'apply_pack_status', $this->apply_pack_status])
            ->andFilterWhere(['like', 'apply_pack_result', $this->apply_pack_result])
            ->andFilterWhere(['like', 'apply_office_name', $this->apply_office_name])
            ->andFilterWhere(['like', 'apply_genneral_status', $this->apply_genneral_status])
            ->andFilterWhere(['like', 'apply_genneral_result', $this->apply_genneral_result])
            ->andFilterWhere(['like', 'apply_remarks', $this->apply_remarks])
            ->andFilterWhere(['like', 'apply_lq_status', $this->apply_lq_status])
            ->andFilterWhere(['between','apply_sq_time',$this->apply_sq_time_s,$this->apply_sq_time_e])
        ;
       // echo $query->createCommand()->getRawSql();exit;
        return $dataProvider;
    }


    public function searchRecord($params)
    {

        $sql = '(apply_pack_id = '.Yii::$app->user->identity->id.' and apply_pack_id_is_del = 1) or (apply_pack_status = "同意" and apply_genneral_id='.Yii::$app->user->identity->id.' and apply_genneral_id_is_del = 1)';

        $query = Officeapply::find()->where($sql);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        //if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
       //     return $dataProvider;
      //  }

        $query->andFilterWhere([
            'apply_id' => $this->apply_id,
            'apply_num' => $this->apply_num,
            //'apply_mee_id' => Yii::$app->user->identity->id,
            //'apply_mee_id_is_del' => 1,
            'apply_pack_id' => $this->apply_pack_id,
            'apply_pack_id_is_del' => $this->apply_pack_id_is_del,
            'apply_pack_time' => $this->apply_pack_time,
            'apply_genneral_id' => $this->apply_genneral_id,
            'apply_genneral_id_is_del' => $this->apply_genneral_id_is_del,
            'apply_genneral_time' => $this->apply_genneral_time,
            'apply_lq_time' => $this->apply_lq_time,
            'apply_department' => $this->apply_department,
        ]);

        $query->andFilterWhere(['like', 'apply_pack_status', $this->apply_pack_status])
            ->andFilterWhere(['like', 'apply_pack_result', $this->apply_pack_result])
            ->andFilterWhere(['like', 'apply_mee_text', $this->apply_mee_text])
            ->andFilterWhere(['like', 'apply_office_name', $this->apply_office_name])
            ->andFilterWhere(['like', 'apply_genneral_status', $this->apply_genneral_status])
            ->andFilterWhere(['like', 'apply_genneral_result', $this->apply_genneral_result])
            ->andFilterWhere(['like', 'apply_remarks', $this->apply_remarks])
            ->andFilterWhere(['like', 'apply_lq_status', $this->apply_lq_status])
            ->andFilterWhere(['between','apply_sq_time',$this->apply_sq_time_s,$this->apply_sq_time_e])
        ;
        // echo $query->createCommand()->getRawSql();exit;
        return $dataProvider;
    }


    public function searchMyget($params)
    {

        $sql = '(apply_pack_status = "同意" and apply_genneral_id = "") or (apply_pack_status = "同意" and apply_genneral_status = "同意")';

        $query = Officeapply::find()->where($sql)->orderBy("apply_lq_status asc");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        //if (!$this->validate()) {
        // uncomment the following line if you do not want to return any records when validation fails
        // $query->where('0=1');
        //     return $dataProvider;
        //  }

        $query->andFilterWhere([
            'apply_id' => $this->apply_id,
            'apply_num' => $this->apply_num,
            'apply_mee_id' => Yii::$app->user->identity->id,
            'apply_mee_id_is_del' => 1,
            'apply_pack_id' => $this->apply_pack_id,
            'apply_pack_id_is_del' => $this->apply_pack_id_is_del,
            'apply_pack_time' => $this->apply_pack_time,
            'apply_genneral_id' => $this->apply_genneral_id,
            'apply_genneral_id_is_del' => $this->apply_genneral_id_is_del,
            'apply_genneral_time' => $this->apply_genneral_time,
            'apply_lq_time' => $this->apply_lq_time,
            'apply_department' => $this->apply_department,
        ]);

        $query->andFilterWhere(['like', 'apply_pack_status', $this->apply_pack_status])
            ->andFilterWhere(['like', 'apply_pack_result', $this->apply_pack_result])
            ->andFilterWhere(['like', 'apply_mee_text', $this->apply_mee_text])
            ->andFilterWhere(['like', 'apply_office_name', $this->apply_office_name])
            ->andFilterWhere(['like', 'apply_genneral_status', $this->apply_genneral_status])
            ->andFilterWhere(['like', 'apply_genneral_result', $this->apply_genneral_result])
            ->andFilterWhere(['like', 'apply_remarks', $this->apply_remarks])
            ->andFilterWhere(['like', 'apply_lq_status', $this->apply_lq_status])
            ->andFilterWhere(['between','apply_sq_time',$this->apply_sq_time_s,$this->apply_sq_time_e])
        ;
        // echo $query->createCommand()->getRawSql();exit;
        return $dataProvider;
    }
}
