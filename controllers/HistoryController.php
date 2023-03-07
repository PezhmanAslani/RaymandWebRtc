<?php

namespace app\controllers;

use app\tools\RestfulController;
use yii\rest\Serializer;

class HistoryController extends RestfulController
{
    public $serializer=[
        'class'=>Serializer::class,
        'collectionEnvelope'=>"data",
        'metaEnvelope'=>"meta"
    ];
    public $enableCsrfValidation=false;


}