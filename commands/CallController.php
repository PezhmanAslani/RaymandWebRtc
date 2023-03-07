<?php

namespace app\commands;

use yii\console\Controller;

class CallController extends Controller
{
   public function actionIndex($message)
   {
       return $message;
   }
}