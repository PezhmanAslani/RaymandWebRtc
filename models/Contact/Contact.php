<?php

namespace app\models\contact;

use Yii;

/**
 * This is the model class for table "tblContact".
 *
 * @property int $id
 * @property string $name
 * @property string $phoneNumber
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblContact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phoneNumber'], 'required'],
            [['name', 'phoneNumber'], 'string', 'max' => 255],
            [['phoneNumber'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phoneNumber' => 'Phone Number',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ContactQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContactQuery(get_called_class());
    }
}
