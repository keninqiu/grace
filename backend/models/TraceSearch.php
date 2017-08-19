<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Trace;

/**
 * TraceSearch represents the model behind the search form about `app\models\Trace`.
 */
class TraceSearch extends Trace
{
    public $process_name;
    public $employee_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['src_product_id', 'dest_product_id', 'process_id', 'employee_id', 'created_at','process_name','employee_name'], 'safe'],
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
        $query = Trace::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'src_product_id', $this->src_product_id])
            ->andFilterWhere(['like', 'dest_product_id', $this->dest_product_id])
            ->andFilterWhere(['like', 'process_id', $this->process_id])
            ->andFilterWhere(['like', 'employee_id', $this->employee_id]);

        return $dataProvider;
    }
}
