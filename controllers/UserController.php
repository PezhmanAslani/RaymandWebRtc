<?php
namespace app\controllers;

use app\models\TblUsers;
use app\tools\ResponseStatusEnum;
use app\tools\RestfulController;
use Yii;
class UserController extends RestfulController{
    
    public $enableCsrfValidation = false;

    public $modelClass = TblUsers::class;
    public $serializer = [
        'class' => \yii\rest\Serializer::class,
        'collectionEnvelope' => 'items',
    ];

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = function ($action) {

        };
        return $actions;
    }
    public function actionLogin(): array
    {
        $model = TblUsers::findOne([
            'username' => Yii::$app->request->post("username"),
            'password' => md5(Yii::$app->request->post("password")),
        ]);

        if ($model == null) {
            return [
                "status" => ResponseStatusEnum::$Error,
                "auth" => false,
                "username" => null,
                "user_id" => null,
                'token' => null,
                'messages' => [
                    'Username or password is incorrect'
                ]
            ];
        }

        $now = new \DateTimeImmutable();
        $exp = $now->modify('+720 minute');
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
                "username" => $model->username,
                "user_id" => Yii::$app->user->getId(),
                'token' => $token->toString(),

            ];
        }
        return [
            "status" => ResponseStatusEnum::$Error,
            "auth" => false,
            "username" => null,
            "user_id" => null,
            'token' => null,
            'messages' => [
                'Username or password is incorrect'
            ]
        ];
    }
}