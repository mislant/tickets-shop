<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_ticket}}`.
 */
class m191111_144808_create_users_ticket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users_ticket}}', [
            'id' => $this->primaryKey(),
            'users_id' => $this->integer()->notNull(),
            'ticket_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `users_id`
        $this->createIndex(
            '{{%idx-users_ticket-users_id}}',
            '{{%users_ticket}}',
            'users_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-users_ticket-users_id}}',
            '{{%users_ticket}}',
            'users_id',
            '{{%users}}',
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
        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-users_ticket-users_id}}',
            '{{%users_ticket}}'
        );

        // drops index for column `users_id`
        $this->dropIndex(
            '{{%idx-users_ticket-users_id}}',
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
