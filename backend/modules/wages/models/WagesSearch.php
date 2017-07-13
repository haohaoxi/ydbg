<?php

namespace backend\modules\wages\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\wages\models\Wages;
use \backend\functions\functions;
/**
 * WagesSearch represents the model behind the search form about `backend\modules\wages\models\Wages`.
 */
class WagesSearch extends Wages
{
    public $_s_year = '';
    public $_s_month = '';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['time', 'dwbh', 'number', 'name', 'yfgz', 'zwdjgz', 'jbgz', 'jcgz', 'gjhljt', 'jxjt', 'gzjt', 'shbt', 'gwjt', 'zwjt', 'dqjt', 'kqj', 'hyxjt', 'tzbt', 'blgz', 'fdgz', 'qtyf', 'ycxbk', 'dkje', 'zfgjj', 'ylaobxj', 'sybxj', 'ylbxj', 'grsds', 'sdf', 'fz', 'qtdk', 'sfgz','_s_year','_s_month'], 'safe'],
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
        $query = Wages::find();

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

        if(!functions::hasPermissionOne('wages','wages','loadexcel')){
            $query->andFilterWhere([
                'number' => \Yii::$app->user->identity->number,
            ]);
        }
        $query->andFilterWhere([
            'id' => $this->id,
          //  'time' => $this->_s_year.$this->_s_month,
            'number' => $this->number,
        ]);

        if($this->_s_year !='' && $this->_s_month == ''){
            $query->andFilterWhere(['like', 'time', $this->_s_year]);
        }elseif($this->_s_year !='' && $this->_s_month != ''){
            $query->andFilterWhere(['like', 'time', $this->_s_year.'-'.$this->_s_month]);
        }

        $query->andFilterWhere(['like', 'dwbh', $this->dwbh])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'yfgz', $this->yfgz])
            ->andFilterWhere(['like', 'zwdjgz', $this->zwdjgz])
            ->andFilterWhere(['like', 'jbgz', $this->jbgz])
            ->andFilterWhere(['like', 'jcgz', $this->jcgz])
            ->andFilterWhere(['like', 'gjhljt', $this->gjhljt])
            ->andFilterWhere(['like', 'jxjt', $this->jxjt])
            ->andFilterWhere(['like', 'gzjt', $this->gzjt])
            ->andFilterWhere(['like', 'shbt', $this->shbt])
            ->andFilterWhere(['like', 'gwjt', $this->gwjt])
            ->andFilterWhere(['like', 'zwjt', $this->zwjt])
            ->andFilterWhere(['like', 'dqjt', $this->dqjt])
            ->andFilterWhere(['like', 'kqj', $this->kqj])
            ->andFilterWhere(['like', 'hyxjt', $this->hyxjt])
            ->andFilterWhere(['like', 'tzbt', $this->tzbt])
            ->andFilterWhere(['like', 'blgz', $this->blgz])
            ->andFilterWhere(['like', 'fdgz', $this->fdgz])
            ->andFilterWhere(['like', 'qtyf', $this->qtyf])
            ->andFilterWhere(['like', 'ycxbk', $this->ycxbk])
            ->andFilterWhere(['like', 'dkje', $this->dkje])
            ->andFilterWhere(['like', 'zfgjj', $this->zfgjj])
            ->andFilterWhere(['like', 'ylaobxj', $this->ylaobxj])
            ->andFilterWhere(['like', 'sybxj', $this->sybxj])
            ->andFilterWhere(['like', 'ylbxj', $this->ylbxj])
            ->andFilterWhere(['like', 'grsds', $this->grsds])
            ->andFilterWhere(['like', 'sdf', $this->sdf])
            ->andFilterWhere(['like', 'fz', $this->fz])
            ->andFilterWhere(['like', 'qtdk', $this->qtdk])
            ->andFilterWhere(['like', 'sfgz', $this->sfgz]);
        //echo $query->createCommand()->getRawSql();exit;
        return $dataProvider;
    }
}
