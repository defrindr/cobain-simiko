<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ModuleProfile;

/**
 * common\models\ModuleProfileSearch represents the model behind the search form about `common\models\ModuleProfile`.
 */
 class ModuleProfileSearch extends ModuleProfile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'tgl_lahir', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['nama', 'tempat_lahir', 'bio', 'no_telp', 'avatar', 'deleted_at'], 'safe'],
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
        $query = ModuleProfile::find();

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
            'tgl_lahir' => $this->tgl_lahir,
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
            ->andFilterWhere(['like', 'bio', $this->bio])
            ->andFilterWhere(['like', 'no_telp', $this->no_telp])
            ->andFilterWhere(['like', 'avatar', $this->avatar]);

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
        $query = ModuleProfile::findDeleted();

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
            'tgl_lahir' => $this->tgl_lahir,
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
            ->andFilterWhere(['like', 'bio', $this->bio])
            ->andFilterWhere(['like', 'no_telp', $this->no_telp])
            ->andFilterWhere(['like', 'avatar', $this->avatar]);

        return $dataProvider;
    }
}
