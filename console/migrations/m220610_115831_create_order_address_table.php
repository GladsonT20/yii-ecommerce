<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_address}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%orders}}`
 */
class m220610_115831_create_order_address_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_address}}', [
            //'id' => $this->primaryKey(),
            'order_id' => $this->primaryKey(),
            'address' => $this->string(255)->notNull(),
            'city' => $this->string(255)->notNull(),
            'state' => $this->string(255)->notNull(),
            'country' => $this->string(255),
            'zipcode' => $this->string(255),
        ]);

        // creates index for column `order_id`
        $this->createIndex(
            '{{%idx-order_address-order_id}}',
            '{{%order_address}}',
            'order_id'
        );

        // add foreign key for table `{{%orders}}`
        $this->addForeignKey(
            '{{%fk-order_address-order_id}}',
            '{{%order_address}}',
            'order_id',
            '{{%orders}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%orders}}`
        $this->dropForeignKey(
            '{{%fk-order_address-order_id}}',
            '{{%order_address}}'
        );

        // drops index for column `order_id`
        $this->dropIndex(
            '{{%idx-order_address-order_id}}',
            '{{%order_address}}'
        );

        $this->dropTable('{{%order_address}}');
    }
}
