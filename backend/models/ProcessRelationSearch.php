<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProcessRelation;

/**
 * ProcessRelationSearch represents the model behind the search form about `app\models\ProcessRelation`.
 */
class ProcessRelationSearch extends ProcessRelation
{
    public $processName;
    public $parentProcessName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'process_id', 'parent_process_id'], 'integer'],
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
        $query = ProcessRelation::find();

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
            'process_id' => $this->process_id,
            'parent_process_id' => $this->parent_process_id,
        ]);

        return $dataProvider;
    }
}
