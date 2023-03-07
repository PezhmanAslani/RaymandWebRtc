<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%CallsHistory}}`.
 */
class m230304_121914_create_CallsHistory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%CallsHistory}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%CallsHistory}}');
    }
}
