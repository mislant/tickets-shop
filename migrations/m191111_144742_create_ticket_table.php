<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ticket}}`.
 */
class m191111_144742_create_ticket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ticket}}', [
            'id' => $this->primaryKey(),
            'events_id' => $this->integer()->notNull(),
            'ticket_type_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `events_id`
        $this->createIndex(
            '{{%idx-ticket-events_id}}',
            '{{%ticket}}',
            'events_id'
        );

        // add foreign key for table `{{%events}}`
        $this->addForeignKey(
            '{{%fk-ticket-events_id}}',
            '{{%ticket}}',
            'events_id',
            '{{%events}}',
            'id',
            'CASCADE'
        );

        // creates index for column `ticket_type_id`
        $this->createIndex(
            '{{%idx-ticket-ticket_type_id}}',
            '{{%ticket}}',
            'ticket_type_id'
        );

        // add foreign key for table `{{%ticket_type}}`
        $this->addForeignKey(
            '{{%fk-ticket-ticket_type_id}}',
            '{{%ticket}}',
            'ticket_type_id',
            '{{%ticket_type}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%events}}`
        $this->dropForeignKey(
            '{{%fk-ticket-events_id}}',
            '{{%ticket}}'
        );

        // drops index for column `events_id`
        $this->dropIndex(
            '{{%idx-ticket-events_id}}',
            '{{%ticket}}'
        );

        // drops foreign key for table `{{%ticket_type}}`
        $this->dropForeignKey(
            '{{%fk-ticket-ticket_type_id}}',
            '{{%ticket}}'
        );

        // drops index for column `ticket_type_id`
        $this->dropIndex(
            '{{%idx-ticket-ticket_type_id}}',
            '{{%ticket}}'
        );

        $this->dropTable('{{%ticket}}');
    }
}
