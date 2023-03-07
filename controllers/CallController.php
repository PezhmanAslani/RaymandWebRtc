<?php

namespace app\controllers;

use yii\rest\ActiveController;

class CallController extends ActiveController
{
    public $enableCsrfValidation = false;
    public $serializer = [
        'class' => \yii\rest\Serializer::class,
        'collectionEnvelope' => 'items',
    ];
}