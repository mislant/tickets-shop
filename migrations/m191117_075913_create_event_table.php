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
            'created_by' => $this->integer(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'adress' => $this->string()->notNull(),
            'date' => $this->dateTime(),
            'amount_of_tickets' => $this->integer()->defaultValue(0),
        ]);

        $this->createIndex(
            '{{%idx-event-created_by}}',
            '{{%event}}',
            'created_by'
        );

        $this->addForeignKey(
            '{{%fk-event-created_by}}',
            '{{%event}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%event}}`
        $this->dropForeignKey(
            '{{%fk-event-created_by}}',
            '{{%event}}'
        );

        // drops index for column `event_id`
        $this->dropIndex(
            '{{%idx-event-created_by}}',
            '{{%event}}'
        );

        $this->dropTable('{{%event}}');
    }
}
