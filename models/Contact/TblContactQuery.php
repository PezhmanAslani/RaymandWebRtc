<?php

namespace app\models\Contact;

/**
 * This is the ActiveQuery class for [[TblContact]].
 *
 * @see TblContact
 */
class TblContactQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TblContact[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TblContact|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
