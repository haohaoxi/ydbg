<?php

namespace backend\modules\travel\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\travel\models\Travel;
/**
 * TravelSearch represents the model behind the search form about `backend\modules\travel\models\Travel`.
 */
class TravelSearch extends Travel
{
    public $time_s;
    public $time_e;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'department', 'zmr_rs', 'glkj_rs', 'ldsp_rs', 'ldsp', 'zmr', 'glkj', 'bxr','bxr_del','zmr_del','glkj_del','ldsp_del'], 'integer'],
            [['time', 'time_s', 'time_e', 'dd', 'sy', 'ccf_zs', 'ccf_je', 'zsf_zs', 'zsf_je', 'hsbt_zs', 'hsbt_je', 'gzf', 'gj', 'zmr_time', 'zmr_detail', 'glkj_time', 'glkj_detail', 'ldsp_time', 'ldsp_detail','time_s','time_e','ldsp_text','glkj_text', 'bxr_text'], 'safe'],
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
    public function search($params,$type)
    {
        if($type == 1){
            $sql = 'bxr = '.Yii::$app->user->identity->id.' and bxr_del = 1';

            if(isset($params[$this->formName()]['zmr_rs']) && $params[$this->formName()]['zmr_rs'] !== ''){
                $zmr_rs = $params[$this->formName()]['zmr_rs'];
                if($zmr_rs == 0){ //审批中
                    $sql .= ' and (zmr_rs = 0 or glkj_rs = 0 or ldsp_rs = 0)';
                }elseif($zmr_rs == 1){ //同意
                    $sql .= ' and (zmr_rs = 1 and glkj_rs = 1 and ldsp_rs = 1)';
                }elseif($zmr_rs == 2){ //驳回
                    $sql .= ' and (zmr_rs = 2 or glkj_rs = 2 or ldsp_rs = 2)';
                }
            }
            $query = Travel::find()->where($sql)->orderBy('time desc');
        }elseif($type == 2){
            $sql = '(zmr='.Yii::$app->user->identity->id.' and zmr_del=1) or (zmr_rs = 1 and glkj='.Yii::$app->user->identity->id.' and glkj_del = 1) or (zmr_rs = 1 and glkj_rs = 1 and ldsp = '.Yii::$app->user->identity->id.' and ldsp_del =1)';
            $query = Travel::find()->where($sql)->orderBy('zmr_rs asc,glkj_rs asc,ldsp_rs asc');
        }



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
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'department' => $this->department,
            's_time' => $this->s_time,
            'e_time' => $this->e_time,
            'zmr_time' => $this->zmr_time,
           // 'zmr_rs' => $this->zmr_rs,
            'glkj_time' => $this->glkj_time,
            'glkj_rs' => $this->glkj_rs,
            'ldsp_time' => $this->ldsp_time,
            'ldsp_rs' => $this->ldsp_rs,
            'zmr' => $this->zmr,
            'glkj' => $this->glkj,
            'ldsp' => $this->ldsp
        ]);

        $query->andFilterWhere(['like', 'dd', $this->dd])
            ->andFilterWhere(['like', 'sy', $this->sy])
            ->andFilterWhere(['like', 'ccf_zs', $this->ccf_zs])
            ->andFilterWhere(['like', 'ccf_je', $this->ccf_je])
            ->andFilterWhere(['like', 'zsf_zs', $this->zsf_zs])
            ->andFilterWhere(['like', 'zsf_je', $this->zsf_je])
            ->andFilterWhere(['like', 'hsbt_zs', $this->hsbt_zs])
            ->andFilterWhere(['like', 'hsbt_je', $this->hsbt_je])
            ->andFilterWhere(['like', 'gzf', $this->gzf])
            ->andFilterWhere(['like', 'gj', $this->gj])
            ->andFilterWhere(['like', 'bxr_text', $this->bxr_text])
            ->andFilterWhere(['like', 'zmr_text', $this->zmr_text])
            ->andFilterWhere(['like', 'zmr_detail', $this->zmr_detail])
            ->andFilterWhere(['like', 'glkj_text', $this->glkj_text])
            ->andFilterWhere(['like', 'glkj_detail', $this->glkj_detail])
            ->andFilterWhere(['like', 'ldsp_text', $this->ldsp_text])
            ->andFilterWhere(['like', 'ldsp_detail', $this->ldsp_detail])
            ->andFilterWhere(['between','time',$this->time_s,$this->time_e])
        ;
        //echo $query->createCommand()->getRawSql();exit;
        return $dataProvider;
    }
}
