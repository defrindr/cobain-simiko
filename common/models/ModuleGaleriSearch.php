<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ModuleGaleri;

/**
 * common\models\ModuleGaleriSearch represents the model behind the search form about `common\models\ModuleGaleri`.
 */
 class ModuleGaleriSearch extends ModuleGaleri
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kategori', 'uploaded_by', 'uploaded_at', 'updated_by', 'updated_at', 'lock'], 'integer'],
            [['link', 'judul', 'tahun'], 'safe'],
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
        $query = ModuleGaleri::find();

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
            'id' => $this->id,
            'kategori' => $this->kategori,
            'tahun' => $this->tahun,
            'uploaded_by' => $this->uploaded_by,
            'uploaded_at' => $this->uploaded_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'lock' => $this->lock,
        ]);

        $query->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'judul', $this->judul]);

        return $dataProvider;
    }
}
