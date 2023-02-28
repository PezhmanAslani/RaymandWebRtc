<?php 

namespace app\controllers;

use app\models\Contact\TblContactSearch;
use app\tools\RestfulController;

class ContactController extends RestfulController {
    public $enableCsrfValidation=false;
    public $modelClass='app\models\Contact\TblContact';

    public $serializer = [
        'class' => \yii\rest\Serializer::class,
        'collectionEnvelope' => 'items',
    ];

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = function ($action) {
            $model = new  TblContactSearch();
            $query = $model->search(\Yii::$app->request->queryParams);
            $query->sort->defaultOrder = ['id' => SORT_ASC];
            $query->pagination->defaultPageSize = 10;
            return $query;
        };

        return $actions;
    }
}