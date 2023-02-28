<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tblContact}}`.
 */
class m230228_082810_create_tblContact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tblContact}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull(),
            'number'=>$this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tblContact}}');
    }
}
