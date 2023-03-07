<?php
namespace app\controllers;
use app\models\contact\ContactSearch;
use app\tools\RestfulController;
class ContactController extends RestfulController {
    public $enableCsrfValidation=false;
    public $modelClass='app\models\contact\Contact';
    public $serializer = [
        'class' => \yii\rest\Serializer::class,
        'collectionEnvelope' => 'items',
        'metaEnvelope'=>'totalItems',
        'linksEnvelope'=>'pageLinks'
    ];
    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = function ($action) {
            $model = new  ContactSearch();
            $query = $model->search(\Yii::$app->request->queryParams);
            $query->sort->defaultOrder = ['id' => SORT_ASC];
            $query->pagination->defaultPageSize = 20;
            return $query;
        };
        return $actions;
    }
}