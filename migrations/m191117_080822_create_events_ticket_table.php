<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%events_ticket}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%event}}`
 * - `{{%ticket_type}}`
 */
class m191117_080822_create_events_ticket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%events_ticket}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'ticket_type_id' => $this->integer()->notNull(),
            'cost' => $this->integer()->defaultValue(0),
            'amount' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `event_id`
        $this->createIndex(
            '{{%idx-events_ticket-event_id}}',
            '{{%events_ticket}}',
            'event_id'
        );

        // add foreign key for table `{{%event}}`
        $this->addForeignKey(
            '{{%fk-events_ticket-event_id}}',
            '{{%events_ticket}}',
            'event_id',
            '{{%event}}',
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
        // drops foreign key for table `{{%event}}`
        $this->dropForeignKey(
            '{{%fk-events_ticket-event_id}}',
            '{{%events_ticket}}'
        );

        // drops index for column `event_id`
        $this->dropIndex(
            '{{%idx-events_ticket-event_id}}',
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
