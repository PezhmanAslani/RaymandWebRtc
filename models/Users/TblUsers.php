<?php

namespace app\models;

use Lcobucci\JWT\Token;
use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "tblUsers".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 */
class TblUsers extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblUsers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'authKey', 'accessToken'], 'required'],
            [['username'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 32],
            [['authKey', 'accessToken'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'authKey' => Yii::t('app', 'Auth Key'),
            'accessToken' => Yii::t('app', 'Access Token'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return TblUsersQuery the active query used by this AR class.
     */
    public static function find(): TblUsersQuery
    {
        return new TblUsersQuery(get_called_class());
    }

    public static function findIdentity($id): ?TblUsers
    {
        return TblUsers::findOne(['id' => $id]);

    }

    private static function getJwt($token): Token
    {
        return Yii::$app->jwt->parse($token);
    }

    public static function findIdentityByAccessToken($token, $type = null): ?TblUsers
    {
        $now = new \DateTimeImmutable();
        if (self::getJwt($token)->isExpired($now)) {
            return null;
        }
        return TblUsers::findOne(['accessToken' => $token]);
    }

    public static function findByUsername($username): ?TblUsers
    {
        return TblUsers::findOne(['username' => $username]);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthKey(): string
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password): bool
    {
        return $this->password === md5($password);
    }
}
