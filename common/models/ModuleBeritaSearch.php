<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ModuleBerita;

/**
 * common\models\ModuleBeritaSearch represents the model behind the search form about `common\models\ModuleBerita`.
 */
 class ModuleBeritaSearch extends ModuleBerita
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'berita_kategori_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['judul', 'isi', 'gambar', 'deleted_at'], 'safe'],
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
        $query = ModuleBerita::find();

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
            'berita_kategori_id' => $this->berita_kategori_id,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'deleted_by' => $this->deleted_by,
            'deleted_at' => $this->deleted_at,
            'lock' => $this->lock,
        ]);

        $query->andFilterWhere(['like', 'judul', $this->judul])
            ->andFilterWhere(['like', 'isi', $this->isi])
            ->andFilterWhere(['like', 'gambar', $this->gambar]);

        return $dataProvider;
    }
}
