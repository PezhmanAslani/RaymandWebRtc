<?php

namespace app\models\Contact;

use Yii;

/**
 * This is the model class for table "tblContact".
 *
 * @property int $id
 * @property string $name
 * @property string $number
 */
class TblContact extends \yii\db\ActiveRecord
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
            [['name', 'number'], 'required'],
            [['name', 'number'], 'string', 'max' => 255],
            [['number'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'number' => Yii::t('app', 'Number'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return TblContactQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TblContactQuery(get_called_class());
    }
}
