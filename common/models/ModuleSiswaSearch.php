<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ModuleSiswa;

/**
 * common\models\ModuleSiswaSearch represents the model behind the search form about `common\models\ModuleSiswa`.
 */
 class ModuleSiswaSearch extends ModuleSiswa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'kelas_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['nama', 'tempat_lahir', 'tanggal_lahir', 'avatar', 'no_telp', 'nama_wali', 'no_telp_wali', 'deleted_at'], 'safe'],
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
        $query = ModuleSiswa::find();

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
            'user_id' => $this->user_id,
            'kelas_id' => $this->kelas_id,
            'tanggal_lahir' => $this->tanggal_lahir,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'deleted_by' => $this->deleted_by,
            'deleted_at' => $this->deleted_at,
            'lock' => $this->lock,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'no_telp', $this->no_telp])
            ->andFilterWhere(['like', 'nama_wali', $this->nama_wali])
            ->andFilterWhere(['like', 'no_telp_wali', $this->no_telp_wali]);

        return $dataProvider;
    }



    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchRestore($params)
    {
        $query = ModuleSiswa::findDeleted();

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
            'user_id' => $this->user_id,
            'kelas_id' => $this->kelas_id,
            'tanggal_lahir' => $this->tanggal_lahir,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'deleted_by' => $this->deleted_by,
            'deleted_at' => $this->deleted_at,
            'lock' => $this->lock,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'no_telp', $this->no_telp])
            ->andFilterWhere(['like', 'nama_wali', $this->nama_wali])
            ->andFilterWhere(['like', 'no_telp_wali', $this->no_telp_wali]);

        return $dataProvider;
    }
}
