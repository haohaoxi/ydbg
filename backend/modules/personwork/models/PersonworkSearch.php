<?php

namespace backend\modules\personwork\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\personwork\models\PersonWork;

/**
 * PersonworkSearch represents the model behind the search form about `backend\modules\personwork\models\Personwork`.
 */
class PersonworkSearch extends PersonWork
{
    public $p_s_time_s;
    public $p_s_time_e;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p_id', 'p_fsq','p_del'], 'integer'],
            [['p_title', 'p_s_time', 'p_e_time', 'p_c_time', 'p_level', 'p_y_slr','p_y_slr_text', 'p_spr', 'p_details', 'p_cancel_detail','p_s_time_s','p_s_time_e'], 'safe'],
            [['p_s_time_s','p_s_time_e'],'match','pattern'=>'/^\d{4}-\d{2}-\d{2}$/','message'=>'日期格式错误'],
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
    public function search($params,$menutype)
    {
        $query = Personwork::find()->select('*');
        if($menutype == 1) { //未办工作
            $query->joinWith(['personWorkWorkflow' => function ($query) {
                $query->where('w_person_id = ' . Yii::$app->user->identity->id . ' and w_s_status in ("未受理","未审批") and w_e_status ="无" and w_type = "普通"');
            }])->where(' (p_e_time > "' . date('Y-m-d H:i:s') . '" or p_e_time="") and p_del = 1')->orderBy('w_id desc');
        }elseif($menutype == 2){ //代办工作
            $query->joinWith(['personWorkWorkflow' => function ($query) {
                $query->where('w_person_id = ' . Yii::$app->user->identity->id . ' and w_s_status in ("未受理","未审批") and w_e_status ="无" and w_type = "代办"');
            }])->where(' (p_e_time > "' . date('Y-m-d H:i:s') . '" or p_e_time="") and p_del = 1')->orderBy('w_id desc');
        }elseif($menutype == 3){ //已办工作
            $query->joinWith(['personWorkWorkflow' => function ($query) {
                $query->where('w_person_id = ' . Yii::$app->user->identity->id . ' and w_e_status !="无" and w_del = 1');
            }])->where('p_del = 1')->orderBy('w_id desc');
        }elseif($menutype == 4){ //逾期工作
            $query->joinWith(['personWorkWorkflow' => function ($query) {
                $query->where('w_person_id = ' . Yii::$app->user->identity->id . ' and w_e_status ="无"');
            }])->where(' (p_e_time < "' . date('Y-m-d H:i:s') . '")  and p_del = 1')->orderBy('w_id desc');
        }elseif($menutype == 5){ //发起工作
            $query->where('p_fsq='.Yii::$app->user->identity->id.'  and p_del = 1')->orderBy('p_level desc,p_id desc');
          //  $query->joinWith(['personWorkWorkflow'])->where('p_fsq='.Yii::$app->user->identity->id.'  and p_del = 1')->orderBy('w_id desc');
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $this->load($params);
        $dataProvider->setSort([
                'attributes' => [
                    []
                ],
            ]
        );

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'p_id' => $this->p_id,
            'p_s_time' => $this->p_s_time,
            'p_e_time' => $this->p_e_time,
            'p_c_time' => $this->p_c_time,
            'p_fsq' => $this->p_fsq,
        ]);

        $query->andFilterWhere(['like', 'p_title', $this->p_title])
            ->andFilterWhere(['like', 'p_level', $this->p_level])
            ->andFilterWhere(['like', 'p_y_slr', $this->p_y_slr])
            ->andFilterWhere(['like', 'p_y_slr_text', $this->p_y_slr])
            ->andFilterWhere(['like', 'p_spr', $this->p_spr])
            ->andFilterWhere(['like', 'p_details', $this->p_details])
            ->andFilterWhere(['like', 'p_cancel_detail', $this->p_cancel_detail])
            ->andFilterWhere(['like', 'p_y_slr_text', $this->p_y_slr_text])
            ->andFilterWhere(['between','p_s_time',$this->p_s_time_s,$this->p_s_time_e]);
        ;
        //echo $query->createCommand()->getRawSql();exit;
        return $dataProvider;
    }
}