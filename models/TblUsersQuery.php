<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[TblUsers]].
 *
 * @see TblUsers
 */
class TblUsersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TblUsers[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TblUsers|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
