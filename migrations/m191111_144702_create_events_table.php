<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%events}}`.
 */
class m191111_144702_create_events_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%events}}', [
            'id' => $this->primaryKey(),
            'name' => $this ->string(),
            'adress' => $this ->string(),
            'amount_of_tickets' => $this ->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%events}}');
    }
}
