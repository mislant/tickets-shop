<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ticket}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%event}}`
 * - `{{%ticket_type}}`
 */
class m191117_080423_create_ticket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ticket}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'event_id' => $this->integer()->notNull(),
            'ticket_type_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-ticket-user_id}}',
            '{{%ticket}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-ticket-user_id}}',
            '{{%ticket}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `event_id`
        $this->createIndex(
            '{{%idx-ticket-event_id}}',
            '{{%ticket}}',
            'event_id'
        );

        // add foreign key for table `{{%event}}`
        $this->addForeignKey(
            '{{%fk-ticket-event_id}}',
            '{{%ticket}}',
            'event_id',
            '{{%event}}',
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
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-ticket-user_id}}',
            '{{%ticket}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-ticket-user_id}}',
            '{{%ticket}}'
        );

        // drops foreign key for table `{{%event}}`
        $this->dropForeignKey(
            '{{%fk-ticket-event_id}}',
            '{{%ticket}}'
        );

        // drops index for column `event_id`
        $this->dropIndex(
            '{{%idx-ticket-event_id}}',
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
