<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_ticket}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%ticket}}`
 */
class m191117_080635_create_users_ticket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users_ticket}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'ticket_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-users_ticket-user_id}}',
            '{{%users_ticket}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-users_ticket-user_id}}',
            '{{%users_ticket}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `ticket_id`
        $this->createIndex(
            '{{%idx-users_ticket-ticket_id}}',
            '{{%users_ticket}}',
            'ticket_id'
        );

        // add foreign key for table `{{%ticket}}`
        $this->addForeignKey(
            '{{%fk-users_ticket-ticket_id}}',
            '{{%users_ticket}}',
            'ticket_id',
            '{{%ticket}}',
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
            '{{%fk-users_ticket-user_id}}',
            '{{%users_ticket}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-users_ticket-user_id}}',
            '{{%users_ticket}}'
        );

        // drops foreign key for table `{{%ticket}}`
        $this->dropForeignKey(
            '{{%fk-users_ticket-ticket_id}}',
            '{{%users_ticket}}'
        );

        // drops index for column `ticket_id`
        $this->dropIndex(
            '{{%idx-users_ticket-ticket_id}}',
            '{{%users_ticket}}'
        );

        $this->dropTable('{{%users_ticket}}');
    }
}
