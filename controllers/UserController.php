<?php

namespace app\controllers;

use app\models\Users\TblUsers;
use app\tools\ResponseStatusEnum;
use app\tools\RestfulController;
use DateTimeZone;
use Yii;
use yii\filters\VerbFilter;


class UserController extends RestfulController
{
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'login'  => ['post'],
            ],
        ];
        return $behaviors;
    }

    public $enableCsrfValidation = false;
    public $modelClass = TblUsers::class;

    public $serializer = [
        'class' => \yii\rest\Serializer::class,
        'collectionEnvelope' => 'items',
    ];
    public function actionLogin(): array
    {
        $model = TblUsers::findone([
            'username' => Yii::$app->request->post("username"),
            'password' => md5(Yii::$app->request->post("password")),
        ]);

        if ($model == null) {
            Yii::$app->response->statusCode = 422;
            return [
                'messages' => [
                    'Username or password is incorrect'
                ]
            ];
        }
        $now = new \DateTimeImmutable();
        $now = $now->setTimezone(new DateTimeZone('Asia/Tehran'));
        $exp = $now->modify('+10 minute');
        $token = Yii::$app->jwt->getBuilder()
            ->withClaim('uid', $model->id)
            ->issuedAt($now)
            ->canOnlyBeUsedAfter($now)
            ->expiresAt($exp)
            ->issuedBy('Raymand Web RTC')
            ->getToken(
                Yii::$app->jwt->getConfiguration()->signer(),
                Yii::$app->jwt->getConfiguration()->signingKey()
            );
        $model->accessToken = $token->toString();
        $model->authKey = "*";
        $model->save();

        if ($model->hasErrors()) {
            return $model->errors;
        }

        if (Yii::$app->user->loginByAccessToken($token->toString())) {
            return [
                "status" => ResponseStatusEnum::$Success,
                "auth" => true,
                "expire_time" => $exp,
                "username" => $model->username,
                "user_id" => Yii::$app->user->getId(),
                'token' => $token->toString(),
            ];
        }
        return [
            'messages' => [
                'Username or password is incorrect'
            ]
        ];
    }
}
