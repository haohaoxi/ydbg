<?php

namespace backend\modules\welfare\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\welfare\models\Welfare;

/**
 * WelfareSearch represents the model behind the search form about `backend\modules\welfare\models\Welfare`.
 */
class WelfareSearch extends Welfare
{
    public $time_s;
    public $time_e;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['welfare_name', 'welfare_type', 'welfare_start_time', 'welfare_end_time', 'welfare_part_id', 'welfare_part_name', 'welfare_detail','time_s','time_e'], 'safe'],
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
        $query = Welfare::find()->where('find_in_set('.Yii::$app->user->identity->department.',`welfare_part_id`)');;

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
            'welfare_start_time' => $this->welfare_start_time,
            'welfare_end_time' => $this->welfare_end_time,
            'welfare_is_del' => 1,
        ]);

        $query->andFilterWhere(['like', 'welfare_name', $this->welfare_name])
            ->andFilterWhere(['like', 'welfare_type', $this->welfare_type])
            ->andFilterWhere(['like', 'welfare_part_id', $this->welfare_part_id])
            ->andFilterWhere(['like', 'welfare_part_name', $this->welfare_part_name])
            ->andFilterWhere(['like', 'welfare_detail', $this->welfare_detail])
            ->andFilterWhere(['between','welfare_start_time',$this->time_s,$this->time_e])
        ;

        return $dataProvider;
    }

    public static function getName(){
        $getJigou = Welfare::getJigou();
        if($getJigou != false){
            foreach($getJigou as $key=>$value){
                $jigou[$value['id']] = $value['dept_name'];
//                $id =$value['id'].',';
//                $name =$value['dept_name'].',';
            }
        }
//        $ids=substr($id,-strlen($id),-1);
//        $names=substr($name,-strlen($name),-1);
//        $jigou[$ids]=$names;
        return $jigou;
    }
}
