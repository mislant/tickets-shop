<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event}}`.
 */
class m191117_075913_create_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'adress' => $this->string()->notNull(),
            'date' => $this->date(),
            'amount_of_tickets' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%event}}');
    }
}
