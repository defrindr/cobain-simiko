<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ModuleSpp;

/**
 * common\models\ModuleSppSearch represents the model behind the search form about `common\models\ModuleSpp`.
 */
 class ModuleSppSearch extends ModuleSpp
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'siswa_id', 'bank_id', 'spp', 'tabungan_prakerin', 'tabungan_study_tour', 'total', 'created_by', 'status', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['bulan', 'tahun', 'bukti_bayar', 'deleted_at'], 'safe'],
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
        if(Yii::$app->user->identity->role == 30){
            $query = ModuleSpp::findDeleted()->where('siswa_id='.Yii::$app->user->id);
        }else{
            $query = ModuleSpp::find();
        }
        

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
            'siswa_id' => $this->siswa_id,
            'bank_id' => $this->bank_id,
            'tahun' => $this->tahun,
            'spp' => $this->spp,
            'tabungan_prakerin' => $this->tabungan_prakerin,
            'tabungan_study_tour' => $this->tabungan_study_tour,
            'total' => $this->total,
            'created_by' => $this->created_by,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'deleted_by' => $this->deleted_by,
            'deleted_at' => $this->deleted_at,
            'lock' => $this->lock,
        ]);

        $query->andFilterWhere(['like', 'bulan', $this->bulan])
            ->andFilterWhere(['like', 'bukti_bayar', $this->bukti_bayar]);

        return $dataProvider;
    }

}
