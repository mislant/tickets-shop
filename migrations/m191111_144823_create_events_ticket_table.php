<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%events_ticket}}`.
 */
class m191111_144823_create_events_ticket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%events_ticket}}', [
            'id' => $this->primaryKey(),
            'events_id' => $this->integer()->notNull(),
            'ticket_type_id' => $this->integer()->notNull(),
            'cost' => $this->integer()->defaultValue(0),
            'amount_of_tickets' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `events_id`
        $this->createIndex(
            '{{%idx-events_ticket-events_id}}',
            '{{%events_ticket}}',
            'events_id'
        );

        // add foreign key for table `{{%events}}`
        $this->addForeignKey(
            '{{%fk-events_ticket-events_id}}',
            '{{%events_ticket}}',
            'events_id',
            '{{%events}}',
            'id',
            'CASCADE'
        );

        // creates index for column `ticket_type_id`
        $this->createIndex(
            '{{%idx-events_ticket-ticket_type_id}}',
            '{{%events_ticket}}',
            'ticket_type_id'
        );

        // add foreign key for table `{{%ticket_type}}`
        $this->addForeignKey(
            '{{%fk-events_ticket-ticket_type_id}}',
            '{{%events_ticket}}',
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
            '{{%fk-events_ticket-events_id}}',
            '{{%events_ticket}}'
        );

        // drops index for column `events_id`
        $this->dropIndex(
            '{{%idx-events_ticket-events_id}}',
            '{{%events_ticket}}'
        );

        // drops foreign key for table `{{%ticket_type}}`
        $this->dropForeignKey(
            '{{%fk-events_ticket-ticket_type_id}}',
            '{{%events_ticket}}'
        );

        // drops index for column `ticket_type_id`
        $this->dropIndex(
            '{{%idx-events_ticket-ticket_type_id}}',
            '{{%events_ticket}}'
        );

        $this->dropTable('{{%events_ticket}}');
    }
}
