<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Center;
use yii\helpers\Html;
use ReflectionClass;

/**
 * CenterSearch represents the model behind the search form about `common\models\Center`.
 */
class CenterSearch extends Center
{
    public $price_month_min;
    public $price_month_max;
    public $text;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is24x7'], 'integer'],
            [['name', 'description', 'meta_title', 'meta_description', 'meta_keywords','text'], 'safe'],
            [['gmap_lat', 'gmap_lng', 'region', 'rating', 'price_month', 'price_month_min', 'price_month_max'], 'number'],
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

    public function fields()
    {
        $fields = parent::fields();
        //if ($this->price_day_min)
            $fields['price_month_min'] = 'price_month_min';
        //if ($this->price_day_max)
            $fields['price_month_max'] = 'price_month_max';
        //if ($this->text)
            $fields['text'] = 'text';

        return $fields;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $all = false)
    {
        $query = Center::find();

        if ($all)
            $adpParams = [
              'query' => $query,
              'totalCount' => 1000,
              'pagination' => ['pageSize' => 1000],
            ];
        else
            $adpParams = ['query' => $query,
                  'pagination' => ['pageSize' => 10],
                  'sort' => [
                      'defaultOrder' => [
                          'name' => SORT_ASC,
                      ]
                  ],
            ];


        $dataProvider = new ActiveDataProvider($adpParams);

        //Yii::info($params,'myd');
        // //Загружаем данные из GET, пришедшие из текстового поля поиска (параметр CenterSearch[text])
        // if (isset($params['CenterSearch']['text']))
        //     $this->text = $params['CenterSearch']['text'];

        // Yii::info('параметры, пришедшие в search: ', 'myd');
        // Yii::info($params, 'myd');
        // Yii::info('this->is24x7: '.$this->is24x7, 'myd');
        // Yii::info('this->price_month_max: '.$this->price_month_max, 'myd');

        //Загружаем данные из GET, пришедшие из формы поиска (остальные параметры вида CenterSearch[region])
        $this->load($params);

        // Yii::info('this->is24x7: '.$this->is24x7, 'myd');
        // Yii::info('this->price_month_max: '.$this->price_month_max, 'myd');


        if (!$this->validate())
            return $dataProvider;

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'gmap_lat' => $this->gmap_lat,
            // 'gmap_lng' => $this->gmap_lng,
            'region' => $this->region,
            'is24x7' => $this->is24x7,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'meta_keywords', $this->meta_keywords])

            ->andFilterWhere(['like', 'name', $this->text]);

        $query->andFilterWhere(['>=', 'price_month', $this->price_month_min])
              ->andFilterWhere(['<=', 'price_month', $this->price_month_max]);

        return $dataProvider;
    }

    public function searchCoords($params)
    {
        $result = $this->search($params, true)->getModels();

        $coords_data = array();
        $coords_data['type'] = 'FeatureCollection';
        $coords_data['features'] = array();

        $coords_item = array();

        foreach($result as $row)
        {
            $coords_item['type'] = 'Feature';
            $coords_item['id'] = $row['id'];
            $coords_item['geometry'] =  [
                'type' => 'Point',
                'coordinates' => [$row['gmap_lat'], $row['gmap_lng']]
            ];
            $coords_item['properties'] = [
                'balloonContent' => Html::a($row['name'], ['center/view', 'id' => $row['id']]),
                'clusterCaption' => 'Еще одна метка',
                'hintContent' => $row['name']
            ];
            $coords_data['features'][] = $coords_item;
        }
        return json_encode($coords_data);
    }

    public function searchFour()
    {
        $min = 1;
        $max = 150;

        $ids = [];
        while (count($ids) < 3) {
            $candidate_id = mt_rand($min, $max);
            $id = Yii::$app->db->createCommand('SELECT id FROM center WHERE id = :candidate_id', [':candidate_id' => $candidate_id])
    			->queryScalar();
            if ($id) {
                $ids[] = $id;
            }
        }

        $query = Center::findBySql(
            'SELECT *
            FROM center
            WHERE id IN (:idone, :idtwo, :idthree)',
            [
                ':idone' => $ids[0],
                ':idtwo' => $ids[1],
                ':idthree' => $ids[2],
            ]
        );

        $adpParams = ['query' => $query,
              'pagination' => ['pageSize' => 10],
        ];

        $dataProvider = new ActiveDataProvider($adpParams);

        return $dataProvider;
    }

    public function searchClosest($center)
    {
        $query = Center::findBySql(
            'SELECT *,
            (gmap_lat-:lat)*(gmap_lat-:lat)+(gmap_lng-:lng)*(gmap_lng-:lng) AS `dist`
            FROM center
            WHERE gmap_lat IS NOT NULL
                AND gmap_lng IS NOT NULL
                AND id <> :id
            ORDER BY dist ASC
            LIMIT 3',
            [
                ':lat' => $center->gmap_lat,
                ':lng' => $center->gmap_lng,
                ':id' => $center->id,
            ]
        );

        $adpParams = ['query' => $query,
              'pagination' => ['pageSize' => 10],
        ];

        $dataProvider = new ActiveDataProvider($adpParams);

        return $dataProvider;
    }

}
