<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m230228_053929_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tblUsers', [
            'id' => $this->primaryKey(),
            'username' => $this->string(20)->notNull()->unique(),
            'password' => $this->string(32)->notNull(),
            'authKey' => $this->string()->notNull(),
            'accessToken' => $this->string()->notNull(),
        ]);

        $this->insert('tblUsers', ['username' => 'admin', 'password' => md5('admin'), 'authKey' => '', 'accessToken' => '']);
        $this->insert('tblUsers', ['username' => 'test', 'password' => md5('test'), 'authKey' => '', 'accessToken' => '']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
