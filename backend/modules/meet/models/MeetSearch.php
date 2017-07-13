<?php

namespace backend\modules\meet\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\meet\models\Meet;

/**
 * MeetSearch represents the model behind the search form about `backend\modules\meet\models\Meet`.
 */
class MeetSearch extends Meet
{
    public $time_s;
    public $time_e;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'department', 'wddbs', 'bddbs', 'gzrys', 'chrys', 'hq', 'bxr', 'bxr_del', 'zmr', 'zmr_rs', 'zmr_del', 'glkj', 'glkj_rs', 'glkj_del', 'ldsp', 'ldsp_rs', 'ldsp_del'], 'integer'],
            [['time_s','time_e','name', 'time', 'kh_time', 'bxr_text', 'zmr_text', 'zmr_time', 'zmr_detail', 'glkj_text', 'glkj_time', 'glkj_detail', 'ldsp_text', 'ldsp_time', 'ldsp_detail'], 'safe'],
            [['hyzf', 'zsf', 'hsf', 'hyszj', 'jtf', 'wjysf', 'qtzc', 'sjkz'], 'number'],
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
            $query = Meet::find()->where($sql)->orderBy('time desc');
        }elseif($type == 2){
            $sql = '(zmr='.Yii::$app->user->identity->id.' and zmr_del=1) or (zmr_rs = 1 and glkj='.Yii::$app->user->identity->id.' and glkj_del = 1) or (zmr_rs = 1 and glkj_rs = 1 and ldsp = '.Yii::$app->user->identity->id.' and ldsp_del =1)';
            $query = Meet::find()->where($sql)->orderBy('zmr_rs asc,glkj_rs asc,ldsp_rs asc');
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
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'department' => $this->department,
            'time' => $this->time,
            'kh_time' => $this->kh_time,
            'wddbs' => $this->wddbs,
            'bddbs' => $this->bddbs,
            'gzrys' => $this->gzrys,
            'chrys' => $this->chrys,
            'hq' => $this->hq,
            'hyzf' => $this->hyzf,
            'zsf' => $this->zsf,
            'hsf' => $this->hsf,
            'hyszj' => $this->hyszj,
            'jtf' => $this->jtf,
            'wjysf' => $this->wjysf,
            'qtzc' => $this->qtzc,
            'sjkz' => $this->sjkz,
            'bxr' => $this->bxr,
            'bxr_del' => $this->bxr_del,
            'zmr' => $this->zmr,
            'zmr_time' => $this->zmr_time,
            //'zmr_rs' => $this->zmr_rs,
            'zmr_del' => $this->zmr_del,
            'glkj' => $this->glkj,
            'glkj_time' => $this->glkj_time,
            'glkj_rs' => $this->glkj_rs,
            'glkj_del' => $this->glkj_del,
            'ldsp' => $this->ldsp,
            'ldsp_time' => $this->ldsp_time,
            'ldsp_rs' => $this->ldsp_rs,
            'ldsp_del' => $this->ldsp_del,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'bxr_text', $this->bxr_text])
            ->andFilterWhere(['like', 'zmr_text', $this->zmr_text])
            ->andFilterWhere(['like', 'zmr_detail', $this->zmr_detail])
            ->andFilterWhere(['like', 'glkj_text', $this->glkj_text])
            ->andFilterWhere(['like', 'glkj_detail', $this->glkj_detail])
            ->andFilterWhere(['like', 'ldsp_text', $this->ldsp_text])
            ->andFilterWhere(['like', 'ldsp_detail', $this->ldsp_detail])
            ->andFilterWhere(['between','time',$this->time_s,$this->time_e])
        ;
        return $dataProvider;
    }
}
