<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ticket_type}}`.
 */
class m191117_080026_create_ticket_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ticket_type}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ticket_type}}');
    }
}
