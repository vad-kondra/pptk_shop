<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%position}}`.
 */
class m200731_051226_create_position_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('position', [
            'position_id' => $this->primaryKey(),
            'job_title' => $this->string()->notNull()->unique(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%position}}');
    }
}
