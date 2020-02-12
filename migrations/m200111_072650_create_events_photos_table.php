<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%events_photos}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%event}}`
 */
class m200111_072650_create_events_photos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%events_photos}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'photo' => $this->string(),
        ]);

        // creates index for column `event_id`
        $this->createIndex(
            '{{%idx-events_photos-event_id}}',
            '{{%events_photos}}',
            'event_id'
        );

        // add foreign key for table `{{%event}}`
        $this->addForeignKey(
            '{{%fk-events_photos-event_id}}',
            '{{%events_photos}}',
            'event_id',
            '{{%event}}',
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
            '{{%fk-events_photos-event_id}}',
            '{{%events_photos}}'
        );

        // drops index for column `event_id`
        $this->dropIndex(
            '{{%idx-events_photos-event_id}}',
            '{{%events_photos}}'
        );

        $this->dropTable('{{%events_photos}}');
    }
}
