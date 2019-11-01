<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_characteristics_to_category}}`.
 */
class m190727_052405_create_shop_characteristics_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
				$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_characteristics_to_category}}', [
            'category_id' => $this->integer()->notNull(),
            'characteristic_id' => $this->integer()->notNull(),
        ], $tableOptions);

				$this->addPrimaryKey('{{%pk-shop_characteristics_to_category}}', '{{%shop_characteristics_to_category}}', ['category_id', 'characteristic_id']);

				$this->createIndex('{{%idx-shop_characteristics_to_category-category_id}}', '{{%shop_characteristics_to_category}}', 'category_id');
				$this->createIndex('{{%idx-shop_characteristics_to_category-characteristic_id}}', '{{%shop_characteristics_to_category}}', 'characteristic_id');

				$this->addForeignKey('{{%fk-shop_characteristics_to_category-category_id}}', '{{%shop_characteristics_to_category}}', 'category_id', '{{%shop_categories}}', 'id', 'CASCADE', 'RESTRICT');
				$this->addForeignKey('{{%fk-shop_characteristics_to_category-characteristic_id}}', '{{%shop_characteristics_to_category}}', 'characteristic_id', '{{%shop_characteristics}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop_characteristics_to_category}}');
    }
}
